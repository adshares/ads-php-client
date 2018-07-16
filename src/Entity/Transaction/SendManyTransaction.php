<?php

namespace Adshares\Ads\Entity\Transaction;

/**
 * Transaction type=<'send_many'>.
 *
 * @package Adshares\Ads\Entity\Transaction
 */
class SendManyTransaction extends AbstractTransaction
{
    /**
     * @var int
     */
    protected $msgId;

    /**
     * @var int
     */
    protected $node;

    /**
     * @var string
     */
    protected $senderAddress;

    /**
     * @var int
     */
    protected $senderFee;

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
    protected $transactionCount;

    /**
     * @var int
     */
    protected $user;

    /**
     * @var array[SendManyTransactionWire]
     */
    protected $wires;
}
