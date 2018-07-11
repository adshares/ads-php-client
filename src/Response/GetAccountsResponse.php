<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\EntityFactory;

class GetAccountsResponse extends AbstractResponse
{
    /**
     *
     * @var array[Account]
     */
    protected $accounts;

    /**
     *
     * @param array $data
     */
    protected function loadData(array $data): void
    {
        parent::loadData($data);

        if (array_key_exists('accounts', $data)) {
            foreach ($data['accounts'] as $value) {
                $this->accounts[] = EntityFactory::createAccount($value);
            }
        }
    }

    /**
     *
     * @return array
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }
}
