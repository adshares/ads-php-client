<?php

namespace Adshares\Ads\Response;

class GetBlocksResponse extends AbstractResponse
{
    /**
     *
     * @var array[string]
     */
    protected $blocks = [];

    /**
     *
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
    }

    /**
     *
     * @return array
     */
    public function getBlocks(): array
    {
        return $this->blocks;
    }
}
