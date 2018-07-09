<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\Broadcast;

class GetBroadcastResponse extends AbstractResponse
{
    /**
     *
     * @var array[Broadcast]
     */
    protected $broadcast = [];

    /**
     *
     * @param array $data
     */
    protected function loadData(array $data): void
    {
        parent::loadData($data);

        if (array_key_exists('broadcast', $data)) {
            foreach ($data['broadcast'] as $value) {
                $this->broadcast[] = Broadcast::createFromRaw($value);
            }
        }
    }

    /**
     *
     * @return array
     */
    public function getBroadcast(): array
    {
        return $this->broadcast;
    }
}
