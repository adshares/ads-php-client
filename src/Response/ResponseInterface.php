<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\Tx;

interface ResponseInterface
{

    /**
     * @return \DateTime
     */
    public function getCurrentBlockTime(): \DateTime;

    /**
     * @return \DateTime
     */
    public function getPreviousBlockTime(): \DateTime;

    /**
     * @return Tx
     */
    public function getTx(): Tx;

    /**
     * @param null|string $key
     * @return mixed
     */
    public function getRawData(?string $key = null);
}