<?php

namespace Adshares\Ads\Command;

use Adshares\Ads\Util\AdsConverter;

class SendOneCommand extends AbstractTransactionCommand
{
    /**
     * @var string $address address to which funds will be transferred
     */
    private $address;

    /**
     * @var int $amount transfer amount in clicks
     */
    private $amount;

    /**
     * @var null|string $message transfer message, 32 bytes hexadecimal string without leading 0x (64 characters)
     */
    private $message;

    /**
     * @param string $address address to which funds will be transferred
     * @param int $amount transfer amount in clicks
     * @param null|string $message transfer  message, 32 bytes hexadecimal string without leading 0x (64 characters)
     *
     */
    public function __construct(string $address, int $amount, ?string $message = null)
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
        $attributes['address'] = $this->address;
        $attributes['amount'] = AdsConverter::clicksToAds($this->amount);
        if ($this->message) {
            $attributes['message'] = $this->message;
        }
        return $attributes;
    }
}
