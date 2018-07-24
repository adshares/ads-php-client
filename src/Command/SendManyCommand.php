<?php

namespace Adshares\Ads\Command;

use Adshares\Ads\Util\AdsConverter;

class SendManyCommand extends AbstractTransactionCommand
{

    /**
     * @var array $wires array of wires. Each entry is pair: account address => amount in clicks.
     *                     Example: ['0001-00000000-XXXX'=>200,'0001-00000001-XXXX'=>10]
     */
    private $wires;

    /**
     * @param array $wires array of wires. Each entry is pair: account address => amount in clicks.
     *                     Example: ['0001-00000000-XXXX'=>200,'0001-00000001-XXXX'=>10]
     */
    public function __construct(array $wires)
    {
        $this->wires = $wires;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'send_many';
    }

    public function getAttributes(): array
    {
        $attributes = [];
        foreach ($this->wires as $address => $amount) {
            $attributes['wires'][$address] = AdsConverter::clicksToAds($amount);
        }
        return $attributes;
    }
}
