<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\Account;
use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\Tx;

class SendManyResponse extends AbstractResponse
{
    /**
     *
     * @var Account
     */
    protected $account;

    /**
     *
     * @var Tx
     */
    protected $tx;

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
        if (array_key_exists('tx', $data)) {
            $this->tx = EntityFactory::createTx($data['tx']);
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
     * @return Tx
     */
    public function getTx(): Tx
    {
        return $this->tx;
    }
}
