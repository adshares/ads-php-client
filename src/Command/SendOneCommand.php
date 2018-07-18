<?php

namespace Adshares\Ads\Command;

use Adshares\Ads\Util\AdsConverter;

class SendOneCommand extends AbstractTransactionCommand
{
    /**
     * @var string $address
     */
    private $address;

    /**
     * @var int $amount
     */
    private $amount;

    /**
     * @var null|string $message
     */
    private $message;

    /**
     * @param string $address
     * @param int $amount
     * @param null|string $message
     */
    public function __construct(string $address, int $amount, ?string $message)
    {
        $this->address = $address;
        $this->amount = $amount;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'send_one';
    }

    public function getAttributes(): array
    {
        $attributes["address"] = $this->address;
        $attributes["amount"] = AdsConverter::clicksToAds($this->amount);
        if ($this->message) {
            $attributes["message"] = $this->message;
        }
        return $attributes;
    }
}
