<?php

namespace Adshares\Ads\Command;

class GetAccountCommand extends AbstractCommand
{
    /**
     * @var string $address
     */
    private $address;

    /**
     * GetAccountCommand constructor.
     *
     * @param string $address
     */
    public function __construct(string $address)
    {
        $this->address = $address;
    }

    /**
     *
     * @return string
     */
    public function getName(): string
    {
        return 'get_account';
    }

    public function getAttributes(): array
    {
//        if ($this->address) {
        return ["address" => $this->address];
//        } else {
//            return parent::getAttributes();
//        }
    }
}
