<?php

namespace Adshares\Ads\Command;

interface TransactionInterface extends CommandInterface
{

    /**
     * @return null|string
     */
    public function getLastHash(): ?string;

    /**
     * @return null|int
     */
    public function getLastMsid(): ?int;

    /**
     * @return null|string
     */
    public function getSender(): ?string;

    /**
     * @return null|string
     */
    public function getSignature(): ?string;

    /**
     * @return null|int
     */
    public function getTimestamp(): ?int;
}
