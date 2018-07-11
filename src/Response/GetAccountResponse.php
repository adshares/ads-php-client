<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\Account;
use Adshares\Ads\Entity\EntityFactory;

class GetAccountResponse extends AbstractResponse
{
    /**
     *
     * @var Account
     */
    protected $account;

    /**
     *
     * @var Account
     */
    protected $networkAccount;

    /**
     *
     * @param array $data
     */
    protected function loadData(array $data): void
    {
        parent::loadData($data);

        if (array_key_exists('account', $data)) {
            $this->account = EntityFactory::createAccount($data['account']);
        }
        if (array_key_exists('network_account', $data)) {
            $this->networkAccount = EntityFactory::createAccount($data['network_account']);
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

    /**
     *
     * @return Account
     */
    public function getNetworkAccount(): Account
    {
        return $this->networkAccount;
    }
}
