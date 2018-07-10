<?php

namespace Adshares\Ads\Driver;

use Adshares\Ads\Command\TransactionInterface;
use Adshares\Ads\Exception\CommandException;
use Adshares\Ads\Command\CommandInterface;
use Adshares\Ads\Response\ResponseInterface;
use Adshares\Ads\Response\RawResponse;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\InputStream;

class CliDriver implements DriverInterface
{

    /**
     * @var string
     */
    private $command = 'ads';

    /**
     * @var string
     */
    private $workingDir = '~/.ads';

    /**
     * @var string
     */
    private $host;

    /**
     * @var int
     */
    private $port;

    /**
     *
     * @var null|string
     */
    private $address;

    /**
     *
     * @var null|string
     */
    private $secret;

    /**
     * @var int
     */
    private $timeout = 30;

    /**
     * CliDriver constructor.
     * @param null|string $address
     * @param null|string $secret
     * @param null|string $host
     * @param int|null $port
     */
    public function __construct(
        ?string $address = null,
        ?string $secret = null,
        ?string $host = null,
        ?int $port = null
    ) {
        $this->address = $address;
        $this->secret = $secret;
        if (null !== $host) {
            $this->host = $host;
        }
        if (null !== $port) {
            $this->port = $port;
        }
    }

    /**
     * @param string $command
     */
    public function setCommand(string $command): void
    {
        $this->command = $command;
    }

    /**
     * @param string $workingDir
     */
    public function setWorkingDir(string $workingDir): void
    {
        $this->workingDir = $workingDir;
    }

    /**
     * @param string $host
     * @param int $port
     */
    public function setHost(string $host, int $port = 9001): void
    {
        $this->host = $host;
        $this->port = $port;
    }

    /**
     * @param string $address
     * @param null|string $secret
     */
    public function setAddress(string $address, ?string $secret = null): void
    {
        $this->address = $address;
        if (null !== $secret) {
            $this->secret = $secret;
        }
    }

    /**
     * @param string $secret
     */
    public function setSecret(string $secret): void
    {
        $this->secret = $secret;
    }

    /**
     * @param int $timeout
     */
    public function setTimeout(int $timeout): void
    {
        $this->timeout = $timeout;
    }

    /**
     *
     * @param  null|string $hash
     * @param  null|int $messageId
     * @return Process
     */
    private function getProcess(?string $hash = null, ?int $messageId = null): Process
    {
        $cmd = [
            $this->command,
            '--work-dir=' . $this->workingDir,
            '--nice=0'
        ];

        if (null !== $this->address) {
            $cmd[] = '--address=' . $this->address;
        }
        if (null !== $this->host) {
            $cmd[] = '--host=' . $this->host;
        }
        if (null !== $this->port) {
            $cmd[] = '--port=' . $this->port;
        }
        if (null !== $hash) {
            $cmd[] = '--hash=' . $hash;
        }
        if (null !== $messageId) {
            $cmd[] = '--msid=' . $messageId;
        }

        return new Process(
            $cmd,
            null,
            null,
            null,
            $this->timeout
        );
    }

    /**
     * @param CommandInterface $command
     * @return string
     */
    private function prepareInput(CommandInterface $command): string
    {
        $data = $command->getAttributes();
        $data['run'] = $command->getName();

        if (false === ($input = json_encode($data))) {
            throw new CommandException(
                $command,
                sprintf('Json error: %s', json_last_error_msg()),
                400
            );
        }

        return (string)$input;
    }

    /**
     * @param CommandInterface $command
     * @param string $data
     * @return array
     * @throws CommandException
     */
    private function prepareOutput(CommandInterface $command, string $data): array
    {
        $messages = [];
        $lines = explode("\n", $data);

        foreach ($lines as $line) {
            if (!$line) {
                continue;
            }
            $message = json_decode($line, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new CommandException(
                    $command,
                    sprintf('Json error: %s', json_last_error_msg()),
                    400
                );
            }
            $messages[] = $message;
        }

        if (empty($messages)) {
            throw new CommandException($command, 'Empty response', 500);
        }

        return $messages;
    }

    /**
     * @param CommandInterface $command
     * @return ResponseInterface
     * @throws CommandException
     */
    public function executeCommand(CommandInterface $command): ResponseInterface
    {
        $input = new InputStream();
        $process =
            $command instanceof TransactionInterface ?
                $this->getProcess($command->getLastHash(), $command->getLastMessageId()) :
                $this->getProcess();
        $process->setInput($input);
        $process->start();

        if (null !== $this->secret) {
            $input->write("{$this->secret}\n");
        }
        $input->write($this->prepareInput($command));
        $input->close();

        $process->wait();

        if ($process->getExitCode()) {
            throw new CommandException($command, $process->getErrorOutput());
        }

        try {
            $messages = $this->prepareOutput($command, $process->getOutput());
            $message = array_shift($messages);
        } catch (\Exception $e) {
            throw new CommandException(
                $command,
                sprintf("%s\n%s", $process->getOutput(), $process->getErrorOutput()),
                $e->getCode(),
                $e
            );
        }

        if (isset($message['error'])) {
            throw new CommandException($command, $message['error'], CommandError::getCodeByMessage($message['error']));
        }

        return new RawResponse($message);
    }
}
