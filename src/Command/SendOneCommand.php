<?php

namespace Adshares\Ads\Command;

use Adshares\Ads\Util\AdsConverter;

class SendOneCommand extends AbstractTransactionCommand
{
    /**
     * Address to which funds will be transferred
     *
     * @var string
     */
    private $address;

    /**
     * Transfer amount in clicks
     *
     * @var int
     */
    private $amount;

    /**
     * Transfer message, 32 bytes hexadecimal string without leading 0x (64 characters)
     *
     * @var null|string
     */
    private $message;

    /**
     * SendOneCommand constructor.
     *
     * @param string $address address to which funds will be transferred
     * @param int $amount transfer amount in clicks
     * @param null|string $message transfer message, 32 bytes hexadecimal string without leading 0x (64 characters)
     */
    public function __construct(string $address, int $amount, ?string $message = null)
    {
        $this->address = $address;
        $this->amount = $amount;
        $this->message = $message;
    }

    /**
     * Returns command name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'send_one';
    }

    /**
     * Returns command specific attributes.
     *
     * @return array
     */
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
