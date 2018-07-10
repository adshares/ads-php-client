<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\Account;

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
                $this->accounts[] = Account::createFromRaw($value);
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
