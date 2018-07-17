<?php

namespace Adshares\Ads\Response;

/**
 * Response for GetPackageIds.
 *
 * @package Adshares\Ads\Response
 */
class GetMessageIdsResponse extends AbstractResponse
{
    /**
     * Array of package ids
     *
     * @var array[string]
     */
    protected $packageIds = [];

    /**
     * @param array $data
     */
    protected function loadData(array $data): void
    {
        parent::loadData($data);

        if (array_key_exists('messages', $data)) {
            foreach ($data['messages'] as $value) {
                $this->packageIds[] = $value;
            }
        }
    }

    /**
     * @return array Array of package ids
     */
    public function getPackageIds(): array
    {
        return $this->packageIds;
    }
}
