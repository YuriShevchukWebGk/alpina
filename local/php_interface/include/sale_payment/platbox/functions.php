<?php
use \Bitrix\Main\Application;

if (!function_exists("getSignature")) {
    /**
     * Generate signature
     *
     * @param string $dataStr Data for calc sign
     *
     * @return string
     */
    function getSignature($dataStr)
    {
        $sign = hash_hmac('sha256', $dataStr, CSalePaySystemAction::GetParamValue("SKEY"));

        return $sign;
    }
}

if (!function_exists("checkSignature")) {
    /**
     * Check request sign and calc sign
     *
     * @param string $dataStr   Request data
     * @param string $signature request sign
     *
     * @return bool
     */
    function checkSignature($dataStr, $signature)
    {
        $currentSign = getSignature($dataStr);

        $check = strtolower($currentSign) == strtolower($signature);

        return $check;
    }
}

if (!function_exists("getCorrectCurrency")) {
    /**
     * Check and return correct currency
     *
     * @param string $currency Currency to check
     *
     * @return string
     */
    function getCorrectCurrency($currency)
    {
        if ($currency == "RUR") {
            $currency = "RUB";
        }

        return $currency;
    }
}
