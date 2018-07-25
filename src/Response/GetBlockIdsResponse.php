<?php

namespace Adshares\Ads\Response;

/**
 * Response for GetBlockIds request.
 *
 * @package Adshares\Ads\Response
 */
class GetBlockIdsResponse extends AbstractResponse
{
    /**
     * Array of updated block ids (string). Can be empty, if all blocks in selected period were updated earlier.
     *
     * @var array
     */
    protected $blockIds = [];

    /**
     * Number of updated blocks. Value of 0 means that all blocks were updated in selected period.
     *
     * @var int
     */
    protected $updatedBlocks;

    /**
     * @param array $data
     */
    protected function loadData(array $data): void
    {
        parent::loadData($data);

        if (array_key_exists('blocks', $data)) {
            foreach ($data['blocks'] as $value) {
                $this->blockIds[] = $value;
            }
        }
        if (array_key_exists('updated_blocks', $data)) {
            $this->updatedBlocks = $data['updated_blocks'];
        }
    }

    /**
     * @return array Array of updated block ids (string). Can be empty,
     * if all blocks in selected period were updated earlier.
     */
    public function getBlockIds(): array
    {
        return $this->blockIds;
    }

    /**
     * @return int Number of updated blocks. Value of 0 means that all blocks were updated in selected period.
     */
    public function getUpdatedBlocks(): int
    {
        return $this->updatedBlocks;
    }
}
