<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\Block;
use Adshares\Ads\Entity\EntityFactory;

/**
 * Response for GetBlock request.
 *
 * @package Adshares\Ads\Response
 */
class GetBlockResponse extends AbstractResponse
{
    /**
     *
     * @var Block
     */
    protected $block;

    /**
     *
     * @param array $data
     */
    protected function loadData(array $data): void
    {
        parent::loadData($data);

        if (array_key_exists('block', $data)) {
            $this->block = EntityFactory::createBlock($data['block']);
        }
    }

    /**
     *
     * @return Block
     */
    public function getBlock(): Block
    {
        return $this->block;
    }
}
