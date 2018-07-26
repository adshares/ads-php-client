<?php

namespace Adshares\Ads\Driver;

use Adshares\Ads\Command\TransactionInterface;
use Adshares\Ads\Exception\CommandException;
use Adshares\Ads\Command\CommandInterface;
use Adshares\Ads\Response\ResponseInterface;
use Adshares\Ads\Response\RawResponse;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\Process\Exception\ProcessTimedOutException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\InputStream;

class CliDriver implements DriverInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * response field in which error message is stored
     */
    const LABEL_ERROR = 'error';

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
     * @param LoggerInterface|null $logger
     */
    public function __construct(
        ?string $address = null,
        ?string $secret = null,
        ?string $host = null,
        ?int $port = null,
        LoggerInterface $logger = null
    ) {
        $this->address = $address;
        $this->secret = $secret;
        if (null !== $host) {
            $this->host = $host;
        }
        if (null !== $port) {
            $this->port = $port;
        }
        if (null === $logger) {
            $logger = new NullLogger();
        }
        $this->logger = $logger;
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
     * @param bool $isDryRun
     * @return Process
     */
    protected function getProcess(?string $hash = null, ?int $messageId = null, bool $isDryRun = false): Process
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
        if (null !== $this->secret) {
            // empty secret means that secret will be read from standard input
            $cmd[] = '--secret';
        }
        if (null !== $hash) {
            $cmd[] = '--hash=' . $hash;
        }
        if (null !== $messageId) {
            $cmd[] = '--msid=' . $messageId;
        }
        if ($isDryRun) {
            $cmd[] = '--dry-run=1';
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
     * @param array $data
     * @return string
     */
    private function prepareInput(CommandInterface $command, array $data): string
    {
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
        $process = $this->getProcess();
        $data = $command->getAttributes();
        $data['run'] = $command->getName();

        return $this->runProcess($command, $data, $process);
    }

    /**
     * @param TransactionInterface $transaction
     * @param bool $isDryRun if true, transaction will not be send to network
     * @return ResponseInterface
     */
    public function executeTransaction(TransactionInterface $transaction, bool $isDryRun = false): ResponseInterface
    {
        $process = $this->getProcess(
            $transaction->getLastHash(),
            $transaction->getLastMsid(),
            $isDryRun
        );
        $data = $transaction->getAttributes();
        $data['run'] = $transaction->getName();
        if ($transaction->getSender()) {
            $data['sender'] = $transaction->getSender();
        }
        if ($transaction->getSignature()) {
            $data['signature'] = $transaction->getSignature();
        }
        if ($transaction->getTimestamp()) {
            $data['time'] = $transaction->getTimestamp();
        }

        return $this->runProcess($transaction, $data, $process);
    }

    /**
     * @param CommandInterface $command
     * @param array $data
     * @param Process $process
     * @return RawResponse
     */
    protected function runProcess(CommandInterface $command, array $data, Process $process): RawResponse
    {
        $preparedInputData = $this->prepareInput($command, $data);

        $input = new InputStream();
        $process->setInput($input);
        $process->start();

        if (null !== $this->secret) {
            $input->write("{$this->secret}\n");
        }

        $input->write($preparedInputData);
        $input->close();

        $start = microtime(true);
        try {
            $process->wait();
        } catch (ProcessTimedOutException $exc) {
            throw new CommandException($command, 'Process timed out');
        }

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

        $context = [
            'time' => microtime(true) - $start,
        ];

        $this->logger->debug(sprintf('[ADS_CLIENT] %s %s', $command->getName(), $preparedInputData), $context);

        if (isset($message[self::LABEL_ERROR])) {
            throw new CommandException(
                $command,
                $message[self::LABEL_ERROR],
                CommandError::getCodeByMessage($message[self::LABEL_ERROR])
            );
        }

        return new RawResponse($message);
    }
}
