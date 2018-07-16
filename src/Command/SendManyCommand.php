<?php

namespace Adshares\Ads\Command;

use Adshares\Ads\Util\AdsConverter;

class SendManyCommand extends AbstractTransactionCommand
{

    /**
     *
     * @var array $wires
     */
    private $wires;

    /**
     * SendManyCommand constructor.
     *
     * @param array $wires
     */
    public function __construct(array $wires)
    {
        $this->wires = $wires;
    }

    /**
     *
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
            $attributes["wires"][$address] = AdsConverter::clicksToAds($amount);
        }
        return $attributes;
    }
}
