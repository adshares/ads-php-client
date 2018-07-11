<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\EntityFactory;

class GetPackageResponse extends AbstractResponse
{
    /**
     *
     * @var array[Transaction]
     */
    protected $transactions = [];

    /**
     *
     * @param array $data
     */
    protected function loadData(array $data): void
    {
        parent::loadData($data);

        if (array_key_exists('transactions', $data)) {
            foreach ($data['transactions'] as $value) {
                $this->transactions[] = EntityFactory::createTransaction($value);
            }
        }
    }

    /**
     *
     * @return array
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }
}
