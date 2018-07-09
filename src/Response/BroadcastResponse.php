<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\Account;

class BroadcastResponse extends AbstractResponse
{
    /**
     *
     * @var Account
     */
    protected $account;

    /**
     *
     * @param array $data
     */
    protected function loadData(array $data): void
    {
        parent::loadData($data);

        if (array_key_exists('account', $data)) {
            $this->account = Account::createFromRaw($data['account']);
        }
    }

    /**
     *
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }
}
