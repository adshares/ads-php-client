<?php

/**
 * Copyright (c) 2018-2021 Adshares sp. z o.o.
 *
 * This file is part of ADS PHP Client
 *
 * ADS PHP Client is free software: you can redistribute and/or modify it
 * under the terms of the GNU General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ADS PHP Client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ADS PHP Client. If not, see <https://www.gnu.org/licenses/>
 */

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\NetworkTx;
use Adshares\Ads\Entity\Transaction\AbstractTransaction;

/**
 * Repsonse for GetTransaction request.
 *
 * @package Adshares\Ads\Response
 */
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

    protected function loadData(array $data): void
    {
        parent::loadData($data);

        if (array_key_exists('network_tx', $data) && is_array($data['network_tx'])) {
            $this->networkTx = EntityFactory::createNetworkTx($data['network_tx']);

            if (array_key_exists('txn', $data) && is_array($data['txn'])) {
                // fill txn data with missing fields
                $txnData = $data['txn'];
                $txnData['id'] = $this->networkTx->getId();
                $txnData['block_id'] = $this->networkTx->getBlockId();
                $txnData['message_id'] = substr($this->networkTx->getId(), 0, 13);
                $txnData['node_id'] = $this->networkTx->getNodeId();
                $txnData['size'] = (string)$this->networkTx->getSize();
                $this->txn = EntityFactory::createTransaction($txnData);
            }
        }
    }
}
