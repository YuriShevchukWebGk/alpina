#!/usr/bin/php
<?
$_SERVER["DOCUMENT_ROOT"] = "/home/bitrix/www";
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
set_time_limit(0);
define("LANG", "ru");  
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");
?> 
<?
if (CModule::IncludeModule('sale')){
    $message = new Message(); 
    $arFilter = Array(  'DELIVERY_ID'=>4,
                        'STATUS_ID'=>"C",
                        "CANCELED" => "N",
                        ">=DATE_STATUS" => date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), mktime(0, 0, 0, date('m'), date('d')-10, date('y'))),
                        "<=DATE_STATUS" => date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), mktime(23, 59, 59, date('m'), date('d')-10, date('y'))),
                        );
    
    $db_sales = CSaleOrder::GetList(array(), $arFilter,false,Array('nTopCount'=>999),Array('ID','DATE_STATUS'));
    while ($ar_sales = $db_sales->Fetch()){
        $result = $message->sendMessage($ar_sales['ID'],"D10");
    }


    $arFilter = Array(  'DELIVERY_ID'=>4,
                        'STATUS_ID'=>"C",
                        "CANCELED" => "N",
                        ">=DATE_STATUS" => date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), mktime(0, 0, 0, date('m'), date('d')-12, date('y'))),
                        "<=DATE_STATUS" => date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), mktime(23, 59, 59, date('m'), date('d')-12, date('y'))),
                        );
    
    $db_sales = CSaleOrder::GetList(array(), $arFilter,false,Array('nTopCount'=>999),Array('ID','DATE_STATUS'));
    while ($ar_sales = $db_sales->Fetch()){
        $result = $message->sendMessage($ar_sales['ID'],"D12");
    }
}?>