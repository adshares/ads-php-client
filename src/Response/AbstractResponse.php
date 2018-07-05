<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\Tx;

abstract class AbstractResponse implements ResponseInterface
{

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var \DateTime
     */
    protected $currentBlockTime;

    /**
     * @var \DateTime
     */
    protected $previousBlockTime;

    /**
     * @var Tx
     */
    protected $tx;

    /**
     * AbstractResponse constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->loadData($data);
    }

    /**
     * @return \DateTime
     */
    public function getCurrentBlockTime(): \DateTime
    {
        return $this->currentBlockTime;
    }

    /**
     * @return \DateTime
     */
    public function getPreviousBlockTime(): \DateTime
    {
        return $this->previousBlockTime;
    }

    /**
     * @return Tx
     */
    public function getTx(): Tx
    {
        return $this->tx;
    }

    /**
     * @param array $data
     */
    protected function loadData(array $data): void
    {
        $this->data = $data;

        if (array_key_exists('current_block_time', $data)) {
            $this->currentBlockTime = new \DateTime("@{$data['current_block_time']}");
        }
        if (array_key_exists('previous_block_time', $data)) {
            $this->previousBlockTime = new \DateTime("@{$data['previous_block_time']}");
        }
        if (array_key_exists('tx', $data)) {
            $this->tx = Tx::createFromRaw($data['tx']);
        }
    }

    /**
     * @param null|string $key
     * @return mixed
     */
    public function getRawData(?string $key = null)
    {
        if (null === $key) {
            return $this->data;
        }

        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }

        return null;
    }
}