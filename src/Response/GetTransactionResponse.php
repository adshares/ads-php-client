<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\NetworkTx;
use Adshares\Ads\Entity\Transaction\AbstractTransaction;

class GetTransactionResponse extends AbstractResponse
{
    /**
     * @var NetworkTx
     */
    protected $networkTx;

    /**
     * @var AbstractTransaction
     */
    protected $txn;

    /**
     * @return NetworkTx
     */
    public function getNetworkTx(): NetworkTx
    {
        return $this->networkTx;
    }

    /**
     * @return AbstractTransaction
     */
    public function getTxn(): AbstractTransaction
    {
        return $this->txn;
    }

    /**
     *
     * @param array $data
     */
    protected function loadData(array $data): void
    {
        parent::loadData($data);

        if (array_key_exists('network_tx', $data)) {
            $this->networkTx = EntityFactory::createNetworkTx($data['network_tx']);

            if (array_key_exists('txn', $data)) {
                // fill txn data with missing fields
                $txnData = $data['txn'];
                $txnData['id'] = $this->networkTx->getId();
                $txnData['block_id'] = $this->networkTx->getBlockId();
                $txnData['message_id'] = substr($txnData['id'], 0, 13);
                $txnData['node_id'] = $this->networkTx->getNodeId();
                $txnData['size'] = $this->networkTx->getSize();
                $this->txn = EntityFactory::createTransaction($txnData);
            }
        }
    }
}
