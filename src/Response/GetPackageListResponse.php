<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\Package;

class GetPackageListResponse extends AbstractResponse
{
    /**
     *
     * @var array[Package]
     */
    protected $packages = [];

    /**
     *
     * @param array $data
     */
    protected function loadData(array $data): void
    {
        parent::loadData($data);

        if (array_key_exists('messages', $data)) {
            foreach ($data['messages'] as $value) {
                $this->packages[] = Package::createFromRaw($value);
            }
        }
    }

    /**
     *
     * @return array
     */
    public function getPackages(): array
    {
        return $this->packages;
    }
}
