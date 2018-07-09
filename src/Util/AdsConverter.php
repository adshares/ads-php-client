<?php


namespace Adshares\Ads\Util;

class AdsConverter
{
    /**
     * Converts Ads to clicks.
     *
     * @param mixed $amount
     * @return int
     */
    public static function adsToClicks($amount): int
    {
        $amountAsString = (string)$amount;
        if (strpos($amountAsString, '.') !== false) {
            $ar = explode('.', $amountAsString);
            $ar[1] = str_pad($ar[1], 11, "0");
            $amountAsString = implode($ar);
        } else {
            $amountAsString = $amountAsString . "00000000000";
        }
        return (int)$amountAsString;
    }

    /**
     * Converts clicks to Ads.
     *
     * @param int $amount
     * @return string
     */
    public static function clicksToAds($amount): string
    {
        $amountAsString = (string)$amount;
        $amountAsString = str_pad($amountAsString, 12, "0", STR_PAD_LEFT);
        $amountAsString = substr_replace($amountAsString, '.', strlen($amountAsString) - 11, 0);
        return $amountAsString;
    }
}
