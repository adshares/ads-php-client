<?php

namespace Adshares\Ads\Command;

class GetTransactionCommand extends AbstractCommand
{
    /**
     *
     * @var string
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
     * Returns command name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'get_transaction';
    }

    /**
     * Returns command specific attributes.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return ['txid' => $this->txid];
    }
}
