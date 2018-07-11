<?php

namespace Adshares\Ads\Entity;

/**
 * Package included in getPackageList response.
 *
 * @package Adshares\Ads\Entity
 */
class Package extends AbstractEntity
{
    /**
     *
     * @var string
     */
    protected $node;

    /**
     *
     * @var int
     */
    protected $nodeMsid;

    /**
     *
     * @var string
     */
    protected $hash;

    /**
     *
     * @return string
     */
    public function getNode(): string
    {
        return $this->node;
    }

    /**
     *
     * @return int
     */
    public function getNodeMsid(): int
    {
        return $this->nodeMsid;
    }

    /**
     *
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }
}
