<?php

namespace Adshares\Ads\Command;

/**
 * TransactionInterface is interface for transaction. Transaction is a command that is sent to blockchain network. It
 * must have defined hash of account and number of last message sent to network.
 *
 * @package Adshares\Ads\Command
 */
interface TransactionInterface extends CommandInterface
{
    /**
     * Returns hash of transaction sender account.
     *
     * @return null|string
     */
    public function getLastHash(): ?string;

    /**
     * Returns number of last sent message from transaction sender account.
     *
     * @return null|int
     */
    public function getLastMsid(): ?int;

    /**
     * Returns transaction sender address.
     *
     * @return null|string
     */
    public function getSender(): ?string;

    /**
     * Returns transaction signature.
     *
     * @return null|string
     */
    public function getSignature(): ?string;

    /**
     * Returns transaction timestamp.
     *
     * @return null|int
     */
    public function getTimestamp(): ?int;
}
