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
    public function getLastMessageId(): ?int;
}
