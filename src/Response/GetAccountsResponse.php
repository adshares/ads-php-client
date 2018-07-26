<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\EntityFactory;

/**
 * Response for GetAccounts request.
 *
 * @package Adshares\Ads\Response
 */
class GetAccountsResponse extends AbstractResponse
{
    /**
     * Array of accounts \Adshares\Ads\Entity\Account
     *
     * @var array
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
     * @return array Array of accounts \Adshares\Ads\Entity\Account
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }
}
