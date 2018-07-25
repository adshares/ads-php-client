<?php


namespace Adshares\Ads\Util;

use Adshares\Ads\Exception\AdsException;

/**
 * Class AdsNormalizer contains legacy code from AdsClient.
 *
 * @package Adshares\Ads\Util
 */
class AdsNormalizer
{
    /**
     * @param string $address account address
     * @return string normalized account address
     */
    public static function normalizeAddress(string $address): string
    {
        $x = preg_replace('/[^0-9A-FX]+/', '', strtoupper($address));
        if (strlen($x) != 16) {
            throw new AdsException('Invalid address');
        }
        return sprintf("%s-%s-%s", substr($x, 0, 4), substr($x, 4, 8), substr($x, 12, 4));
    }

    /**
     * @param string $txid transaction id
     * @return string normalized transaction id
     */
    public static function normalizeTxid(string $txid): string
    {
        $x = preg_replace('/[^0-9A-F]+/', '', strtoupper($txid));
        if (strlen($x) != 16) {
            throw new AdsException('Invalid transaction id');
        }
        return sprintf("%s:%s:%s", substr($x, 0, 4), substr($x, 4, 8), substr($x, 12, 4));
    }
}
