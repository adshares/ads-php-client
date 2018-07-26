<?php


namespace Adshares\Ads\Util;

/**
 * AdsValidator is utility class responsible for validation of ADS ids.
 *
 * @package Adshares\Ads\Util
 */
class AdsValidator
{
    /**
     * Checks, if account address is in proper format.
     *
     * @param string $address account address
     * @return bool true if address is valid, false otherwise
     */
    public static function isAccountAddressValid(string $address): bool
    {
        return 1 == preg_match('/^[0-9a-fA-F]{4}-[0-9a-fA-F]{8}-([0-9a-fA-F]{4}|XXXX)$/', $address);
    }

    /**
     * Checks, if message id is valid.
     *
     * @param string $messageId message id
     * @return bool true if id is valid, false otherwise
     */
    public static function isMessageIdValid(string $messageId): bool
    {
        return 1 == preg_match('/^[0-9a-fA-F]{4}:[0-9a-fA-F]{8}$/', $messageId);
    }

    /**
     * Checks, if transaction id is valid.
     *
     * @param string $txid transaction id
     * @return bool true if id is valid, false otherwise
     */
    public static function isTransactionIdValid(string $txid): bool
    {
        return 1 == preg_match('/^[0-9a-fA-F]{4}:[0-9a-fA-F]{8}:[0-9a-fA-F]{4}$/', $txid);
    }
}
