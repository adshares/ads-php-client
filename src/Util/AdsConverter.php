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
        $isNegativeValue = false;
        if ('-' === $amountAsString[0]) {
            $isNegativeValue = true;
            // cut minus sign from negative value
            $amountAsString = substr($amountAsString, 1, strlen($amountAsString));
        }
        //add leading zeros
        $amountAsString = str_pad($amountAsString, 12, "0", STR_PAD_LEFT);
        // insert decimal separator
        $amountAsString = substr_replace($amountAsString, '.', strlen($amountAsString) - 11, 0);
        if ($isNegativeValue) {
            // prepend minus sign for negative value
            $amountAsString = '-' . $amountAsString;
        }
        return $amountAsString;
    }
}
