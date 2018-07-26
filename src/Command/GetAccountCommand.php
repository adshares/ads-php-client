<?php

namespace Adshares\Ads\Command;

class GetAccountCommand extends AbstractCommand
{
    /**
     * @var string
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
     * Returns command name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'get_account';
    }

    /**
     * Returns command specific attributes.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return ['address' => $this->address];
    }
}
