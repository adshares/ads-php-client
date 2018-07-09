<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\Account;

class GetMeResponse extends AbstractResponse
{
    /**
     * @var Account
     */
    protected $account;

    /**
     * @var Account
     */
    protected $networkAccount;

    /**
     * @param array $data
     */
    protected function loadData(array $data): void
    {
        parent::loadData($data);

        if (array_key_exists('account', $data)) {
            $this->account = Account::createFromRaw($data['account']);
        }
        if (array_key_exists('network_account', $data)) {
            $this->networkAccount = Account::createFromRaw($data['network_account']);
        }
    }

    /**
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * @return Account
     */
    public function getNetworkAccount(): Account
    {
        return $this->networkAccount;
    }


}