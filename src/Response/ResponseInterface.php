<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\Tx;

/**
 * Interface ResponseInterface
 *
 * @package Adshares\Ads\Response
 */
interface ResponseInterface
{

    /**
     * @return \DateTime Time of current block
     */
    public function getCurrentBlockTime(): \DateTime;

    /**
     * @return \DateTime Time of previous block
     */
    public function getPreviousBlockTime(): \DateTime;

    /**
     * @return Tx
     */
    public function getTx(): Tx;

    /**
     * @param  null|string $key key in data array
     * @return mixed data for given key, for null key all data is returned, if key is not present null is returned
     */
    public function getRawData(?string $key = null);
}
