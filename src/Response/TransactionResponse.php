<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\Account;
use Adshares\Ads\Entity\EntityFactory;

/**
 * Common response for most of the transactions.
 *
 * @package Adshares\Ads\Response
 */
class TransactionResponse extends AbstractResponse
{
    /**
     * Account state before executing transaction
     *
     * @var Account
     */
    protected $account;

    /**
     * @param array $data
     */
    protected function loadData(array $data): void
    {
        parent::loadData($data);

        if (array_key_exists('account', $data)) {
            $this->account = EntityFactory::createAccount($data['account']);
        }
    }

    /**
     * @return Account Account state before executing transaction
     */
    public function getAccount(): Account
    {
        return $this->account;
    }
}
