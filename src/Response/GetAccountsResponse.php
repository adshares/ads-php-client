<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\Account;
use Adshares\Ads\Entity\EntityFactory;

/**
 * Response for GetAccounts request.
 *
 * @package Adshares\Ads\Response
 */
class GetAccountsResponse extends AbstractResponse
{
    /**
     * Array of accounts
     *
     * @var Account[]
     */
    protected $accounts;

    /**
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
     * @return Account[] Array of accounts
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }
}
