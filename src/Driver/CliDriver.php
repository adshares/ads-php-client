<?php

namespace Adshares\Ads\Driver;

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
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var int
     */
    private $timeout = 30;

    /**
     * @param null|string $hash
     * @param null|string $messageId
     * @return Process
     */
    private function getProcess(?string $hash = null, ?string $messageId = null): Process
    {
        if ($this->workingDir && !file_exists($this->workingDir)) {
            mkdir($this->workingDir, 0775, true);
        }

        $cmd = [
            $this->command,
            '--address=' . $this->address,
            '--host=' . $this->host,
            '--port=' . $this->port,
            '--nice=0',
        ];

        if (null !== $hash) {
            $cmd[] = '--hash=' . $hash;
        }
        if (null !== $messageId) {
            $cmd[] = '--msid=' . $messageId;
        }

        return new Process(
            $cmd,
            $this->workingDir,
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

        return json_encode($data);
    }

    /**
     * @param string $data
     * @return array
     * @throws CommandException
     */
    private function prepareOutput(string $data): array
    {
        $messages = [];
        $lines = explode("\n", $data);

        foreach ($lines as $line) {
            if (!$line) {
                continue;
            }
            $message = json_decode($line, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new CommandException(sprintf('Json error: %s', json_last_error_msg()), 400);
            }
            $messages[] = $message;
        }

        if (empty($messages)) {
            throw new CommandException('Empty response', 500);
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
        $process = $this->getProcess($command->getLastHash(), $command->getLastMessageId());

        $input = new InputStream();

        $process->setInput($input);
        $process->start();

        $input->write("{$this->secret}\n");
        $input->write($this->prepareInput($command));
        $input->close();

        $process->wait();

//         echo("{$this->secret}\n");
//         echo($message->getText() . "\n");
//         die($process->getCommandLine());

        if ($process->getExitCode()) {
            throw new CommandException($process->getErrorOutput());
        }

        try {
            $messages = $this->prepareOutput($process->getOutput());
            $message = array_shift($messages);
        } catch (\Exception $e) {
            throw new CommandException($process->getOutput() . "\n" . $process->getErrorOutput(), $e->getCode(), $e);
        }

        if ($message['error']) {
            throw new CommandException($message);
        }

        return new RawResponse($message);
    }
}