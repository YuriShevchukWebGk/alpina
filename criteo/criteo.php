#!/usr/bin/php
<?  $_SERVER["DOCUMENT_ROOT"] = "/home/bitrix/www";
    $DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
    define("NO_KEEP_STATISTIC", true);
    define("NOT_CHECK_PERMISSIONS", true);
    set_time_limit(0);
    //define("LANG", "ru");         
//define("NO_KEEP_STATISTIC", true);
//define("NOT_CHECK_PERMISSIONS", true);
//define('SITE_ID', 's1');
//$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
//set_time_limit(0);
//define("LANG", "ru"); 
define('LOG_FILENAME', $_SERVER["DOCUMENT_ROOT"]."/custom-scripts/log.txt");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

    if (AddMessage2Log('Скрипт выполнен cron', 'criteo.php'))
?>  
<?
    // -- getting template for our criteo products xml file
    $dirPath = $_SERVER['DOCUMENT_ROOT']."/criteo/";
    $xml = simplexml_load_file($dirPath."criteo_template.xml");
    $arSelect = Array('ID', 'NAME', 'DETAIL_PICTURE', 'DETAIL_PAGE_URL', 'PREVIEW_TEXT', 'IBLOCK_SECTION_ID', 'PROPERTY_PUBLISHER', 'PROPERTY_age_group');
    $arFilter = Array("IBLOCK_ID" => 4, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y",'PROPERTY_STATE'=>Array(false,21));
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 99999), $arSelect);
    
    while ($ob = $res -> GetNextElement()) {
        $arFields = $ob -> GetFields();
        $imagePath = "http://www.alpinabook.ru".CFile::GetPath($arFields['DETAIL_PICTURE']);
        $productURL = 'http://www.alpinabook.ru'.$arFields['DETAIL_PAGE_URL'];
        $itemPriceList = GetCatalogProductPriceList($arFields['ID'], array(), array());
        $itemPrice = $itemPriceList[0]['PRICE'];
        $resSection = CIBlockSection::GetByID($arFields["IBLOCK_SECTION_ID"]);
        if ($ar_res = $resSection -> GetNext()) {
            $itemCategoryName = $ar_res['NAME'];
        }
        
        if ($arFields['PROPERTY_AGE_GROUP_VALUE'] == 0) {
            $arFields['PROPERTY_AGE_GROUP_VALUE'] = 0;
        }
        echo '<pre>';print_r(str_replace($healthy, "", $arFields['NAME']));echo 'раз</pre>';
        // -- add new element to products collection
        $product = $xml->addChild('product');
        $product->addAttribute('id', $arFields['ID']);
        $product->addChild('name', html_entity_decode($arFields['NAME']));
        $product->addChild('bigimage', $imagePath);
        $product->addChild('producturl', $productURL);
        $product->addChild('description', html_entity_decode(strip_tags($arFields['PREVIEW_TEXT'])));
        $product->addChild('price', $itemPrice);
        $product->addChild('categoryid1', $itemCategoryName);
        $product->addChild('extra_brand', $arFields['PROPERTY_PUBLISHER_VALUE']);
        $product->addChild('age', $arFields['PROPERTY_AGE_GROUP_VALUE']);
    }

    $xml->asXML($dirPath.'criteo_new_201601.xml');
?>