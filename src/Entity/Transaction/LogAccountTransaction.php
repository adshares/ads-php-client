<?php

namespace Adshares\Ads\Entity\Transaction;
use Adshares\Ads\Entity\Account;

/**
 * Transaction type=<'log_account'>.
 *
 * @package Adshares\Ads\Entity\Transaction
 */
class LogAccountTransaction extends AbstractTransaction
{
    /**
     * @var int
     */
    protected $msgId;

    /**
     * @var Account
     */
    protected $networkAccount;

    /**
     * @var int
     */
    protected $node;

    /**
     * @var string
     */
    protected $signature;

    /**
     * @var \DateTime
     */
    protected $time;

    /**
     * @var int
     */
    protected $user;

    /**
     * @return int
     */
    public function getMsgId(): int
    {
        return $this->msgId;
    }

    /**
     * @return Account
     */
    public function getNetworkAccount(): Account
    {
        return $this->networkAccount;
    }

    /**
     * @return int
     */
    public function getNode(): int
    {
        return $this->node;
    }

    /**
     * @return string
     */
    public function getSignature(): string
    {
        return $this->signature;
    }

    /**
     * @return \DateTime
     */
    public function getTime(): \DateTime
    {
        return $this->time;
    }

    /**
     * @return int
     */
    public function getUser(): int
    {
        return $this->user;
    }
}
