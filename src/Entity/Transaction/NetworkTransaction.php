<?php

namespace Adshares\Ads\Entity\Transaction;

/**
 * Transaction type=<'create_account', 'create_node', 'retrieve_funds'>.
 *
 * @package Adshares\Ads\Entity\Transaction
 */
class NetworkTransaction extends AbstractTransaction
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
    protected $signature;

    /**
     * @var null|int
     */
    protected $targetNode;

    /**
     * @var null|int
     */
    protected $targetUser;

    /**
     * @var \DateTime
     */
    protected $time;

    /**
     * @var int
     */
    protected $user;
}
