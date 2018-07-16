<?php

namespace Adshares\Ads\Response;

class GetBlocksResponse extends AbstractResponse
{
    /**
     * @var array[string]
     */
    protected $blocks = [];

    /**
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
                $this->blocks[] = $value;
            }
        }
        if (array_key_exists('updated_blocks', $data)) {
            $this->updatedBlocks = $data['updated_blocks'];
        }
    }

    /**
     * @return array
     */
    public function getBlocks(): array
    {
        return $this->blocks;
    }

    /**
     * @return int
     */
    public function getUpdatedBlocks(): int
    {
        return $this->updatedBlocks;
    }
}
