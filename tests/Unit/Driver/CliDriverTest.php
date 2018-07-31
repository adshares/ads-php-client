<?php
/**
 * Copyright (C) 2018 Adshares sp. z. o.o.
 *
 * This file is part of PHP ADS Client
 *
 * PHP ADS Client is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * PHP ADS Client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with PHP ADS Client.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace Adshares\Ads\Tests\Unit\Driver;

use Adshares\Ads\Command\BroadcastCommand;
use Adshares\Ads\Command\GetMeCommand;
use Adshares\Ads\Driver\CliDriver;
use Adshares\Ads\Driver\CommandError;
use Adshares\Ads\Exception\CommandException;
use Symfony\Component\Process\Exception\ProcessTimedOutException;
use Symfony\Component\Process\Process;

class CliDriverTest extends \PHPUnit\Framework\TestCase
{
    private $address = '0001-00000000-9B6F';
    private $secret = 'BB3425F914CA9F661CA6F3B908E07092B5AFB7F2FDAE2E94EDE12C83207CA743';
    private $host = '10.69.3.43';
    private $port = 9001;

    public function testDriverInvalidExitCode()
    {
        $driver = $this->createCliDriver($this->createMockProcess(404, ''));
        $command = new GetMeCommand();

        $this->expectException(CommandException::class);
        $driver->executeCommand($command);
    }

    public function testDriverEmptyResponse()
    {
        $driver = $this->createCliDriver($this->createMockProcess(0, ''));
        $command = new GetMeCommand();

        $this->expectException(CommandException::class);
        $driver->executeCommand($command);
    }

    public function testDriverJsonResponseError()
    {
        $driver = $this->createCliDriver($this->createMockProcess(0, '{'));
        $command = new GetMeCommand();

        $this->expectException(CommandException::class);
        $driver->executeCommand($command);
    }

    public function testDriverResponseWithError()
    {
        $driver = $this->createCliDriver($this->createMockProcess(0, '{"error":"Bad user"}'));
        $command = new GetMeCommand();

        $this->expectException(CommandException::class);
        $this->expectExceptionCode(CommandError::BAD_USER);
        $driver->executeCommand($command);
    }

    public function testDriverInvalidClientApp()
    {
        $driver = new CliDriver();
        $driver->setCommand('adsd');
        $driver->setHost('1234');
        $driver->setWorkingDir('.');
        $driver->setTimeout(5);

        $command = new BroadcastCommand('11');
        $command->setLastMsid(0);
        $command->setLastHash('0000000000000000000000000000000000000000000000000000000000000000');
        $this->expectException(CommandException::class);
        $driver->executeTransaction($command, true);
    }

    public function testDriverTimeout()
    {
        // process used as exception parameter
        $processExc = new Process('test-timeout');
        // mock process - throws ProcessTimedOutException
        $process = $this->createMock(Process::class);
        $process->method('wait')->willThrowException(
            new ProcessTimedOutException($processExc, ProcessTimedOutException::TYPE_GENERAL)
        );

        /** @var Process $process */
        if ($process instanceof Process) {
            $driver = $this->createCliDriver($process);
            $driver->setCommand('adsd');
            $driver->setAddress('1234', '1234');
            $driver->setHost('1234');
            $driver->setSecret('1234');
            $driver->setWorkingDir('.');
            $driver->setTimeout(5);

            $command = new BroadcastCommand('11');
            $command->setLastMsid(0);
            $command->setLastHash('0000000000000000000000000000000000000000000000000000000000000000');
            $this->expectException(CommandException::class);
            $driver->executeTransaction($command, true);
        }
    }

    /**
     * Creates CliDriver with mocked process.
     *
     * @param Process $process process
     * @return CliDriver
     */
    private function createCliDriver(Process $process): CliDriver
    {
        $driver = $this->getMockBuilder(CliDriver::class)
            ->setConstructorArgs([$this->address, $this->secret, $this->host, $this->port])
            ->setMethods(['getProcess'])
            ->getMock();
        $driver->method('getProcess')->willReturn($process);

        if ($driver instanceof CliDriver) {
            /* @var CliDriver $driver */
            return $driver;
        }
        throw new \RuntimeException();
    }

    /**
     * @param int $processExitCode
     * @param string|array $processOutput
     * @return Process
     */
    private function createMockProcess(int $processExitCode, $processOutput): Process
    {
        $process = $this->createMock(Process::class);
        $process->method('getExitCode')->willReturn($processExitCode);
        if (is_array($processOutput)) {
            $stub = new \PHPUnit\Framework\MockObject\Stub\ConsecutiveCalls($processOutput);
        } else {
            $stub = $this->onConsecutiveCalls($processOutput);
        }
        $process->method('getOutput')->will($stub);

        if ($process instanceof Process) {
            /** @var $process Process */
            return $process;
        }
        throw new \RuntimeException();
    }
}
