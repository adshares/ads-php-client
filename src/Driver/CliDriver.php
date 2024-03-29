<?php

/**
 * Copyright (c) 2018-2021 Adshares sp. z o.o.
 *
 * This file is part of ADS PHP Client
 *
 * ADS PHP Client is free software: you can redistribute and/or modify it
 * under the terms of the GNU General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ADS PHP Client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ADS PHP Client. If not, see <https://www.gnu.org/licenses/>
 */

namespace Adshares\Ads\Driver;

use Adshares\Ads\Command\CommandInterface;
use Adshares\Ads\Command\TransactionInterface;
use Adshares\Ads\Exception\CommandException;
use Adshares\Ads\Response\RawResponse;
use Adshares\Ads\Response\ResponseInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\Process\Exception\ProcessTimedOutException;
use Symfony\Component\Process\InputStream;
use Symfony\Component\Process\Process;
use Throwable;

/**
 * CliDriver (Command line driver)
 *
 * CliDriver is driver which uses ads binary to connect ADS blockchain network.
 *
 * @package Adshares\Ads\Driver
 */
class CliDriver implements DriverInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * response field in which error message is stored
     */
    private const LABEL_ERROR = 'error';

    /**
     * ADS blockchain client app
     *
     * @var string
     */
    private $command = 'ads';

    /**
     * ADS blockchain client working dir, where cache will be stored
     *
     * @var string
     */
    private $workingDir = '~/.ads';

    /**
     * ADS node host (domain or IP address)
     *
     * @var string
     */
    private $host;

    /**
     * ADS node office port
     *
     * @var int
     */
    private $port;

    /**
     * Account address
     *
     * @var null|string
     */
    private $address;

    /**
     * Account address private key
     *
     * @var null|string
     */
    private $secret;

    /**
     * Request timeout in seconds
     *
     * @var int
     */
    private $timeout = 30;

    /**
     * CliDriver constructor.
     *
     * @param null|string $address account address
     * @param null|string $secret private key
     * @param null|string $host ADS node host (domain or IP address)
     * @param int|null $port ADS node office port
     * @param LoggerInterface|null $logger logger
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
     * @param string $command ADS blockchain client app
     */
    public function setCommand(string $command): void
    {
        $this->command = $command;
    }

    /**
     * @param string $workingDir ADS blockchain client working dir, where cache will be stored
     */
    public function setWorkingDir(string $workingDir): void
    {
        $this->workingDir = $workingDir;
    }

    /**
     * @param string $host ADS node host (domain or IP address)
     * @param int $port ADS node office port
     */
    public function setHost(string $host, int $port = 9001): void
    {
        $this->host = $host;
        $this->port = $port;
    }

    /**
     * @param string $address Account address
     * @param null|string $secret Account address private key
     */
    public function setAddress(string $address, ?string $secret = null): void
    {
        $this->address = $address;
        if (null !== $secret) {
            $this->secret = $secret;
        }
    }

    /**
     * @param string $secret Account address private key
     */
    public function setSecret(string $secret): void
    {
        $this->secret = $secret;
    }

    /**
     * @param int $timeout Request timeout in seconds
     */
    public function setTimeout(int $timeout): void
    {
        $this->timeout = $timeout;
    }

    /**
     * @param null|string $hash
     * @param null|int $messageId
     * @param bool $isDryRun
     * @return Process<string>
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

        return $this->createProcess($cmd);
    }

    /**
     * @param string[] $cmd
     * @return Process<string>
     */
    protected function createProcess(array $cmd): Process
    {
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
     * @param string $data process output (ADS client response)
     * @return string[][] array of decoded lines of response
     * @throws CommandException
     */
    private function prepareOutput(CommandInterface $command, string $data): array
    {
        $messages = [];
        $lines = explode("\n", $data);

        foreach ($lines as $line) {
            $line = trim($line);
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
     * @param int[]|string[]|string[][] $data all attributes of command
     * @param Process<string> $process process
     * @return RawResponse
     */
    protected function runProcess(CommandInterface $command, array $data, Process $process): RawResponse
    {
        $preparedInputData = (string)json_encode($data);

        $input = new InputStream();
        $process->setInput($input);
        $process->start();

        if (null !== $this->secret) {
            $input->write("$this->secret\n");
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
            $output = $process->getOutput();
            $messages = $this->prepareOutput($command, $output);
            $message = array_shift($messages);
        } catch (Throwable $e) {
            throw new CommandException(
                $command,
                sprintf("%s\n%s", $output ?? '', $process->getErrorOutput()),
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
