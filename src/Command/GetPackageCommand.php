<?php

namespace Adshares\Ads\Command;

class GetPackageCommand extends AbstractCommand
{
    /**
     * @var null|string $block
     */
    private $block;

    /**
     * @var string $packageId
     */
    private $packageId;

    /**
     * @param string $packageId
     * @param null|string $block
     */
    public function __construct($packageId, string $block = null)
    {
        $this->packageId = $packageId;
        $this->block = $block;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'get_message';
    }

    public function getAttributes(): array
    {
        $attributes = [];
        $attributes["message_id"] = $this->packageId;
        if ($this->block) {
            $attributes["block"] = $this->block;
        }
        return $attributes;
    }
}
