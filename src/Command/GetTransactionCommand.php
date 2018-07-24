<?php

namespace Adshares\Ads\Command;

class GetTransactionCommand extends AbstractCommand
{
    /**
     *
     * @var string $txid
     */
    private $txid;

    /**
     * @param string $txid
     */
    public function __construct(?string $txid)
    {
        $this->txid = $txid;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'get_transaction';
    }

    public function getAttributes(): array
    {
        return ['txid' => $this->txid];
    }
}
