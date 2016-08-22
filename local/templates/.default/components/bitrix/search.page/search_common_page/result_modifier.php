<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

foreach($arResult["SEARCH"] as $arItem) {
    if ($arItem["PARAM2"] == AUTHORS_IBLOCK_ID) {
        $authors_array[] = $arItem["ITEM_ID"];
    } else if ($arItem["PARAM2"] == CATALOG_IBLOCK_ID) {
        $books_array[] = $arItem["ITEM_ID"];
    } else if ($arItem["PARAM2"] == SERIES_IBLOCK_ID){
        $series_array[] = $arItem["ITEM_ID"];
    }
}
if (!empty($authors_array)) {
    $authors_list = CIBlockElement::GetList(
        array(), 
        array("ID" => $authors_array), 
        false, 
        false, 
        array(
            "ID", 
            "DETAIL_PICTURE", 
            "PREVIEW_TEXT", 
            "PROPERTY_STATE", 
            "PROPERTY_AUTHOR_DESCRIPTION"
        )
    );
    while ($authors = $authors_list -> Fetch()) {
        $arResult["AUTHOR_INFO"][$authors["ID"]] = $authors; 
        $arResult["AUTHOR_INFO"][$authors["ID"]]["PICTURE"] = CFile::ResizeImageGet(
            $arResult["AUTHOR_INFO"][$authors["ID"]]["DETAIL_PICTURE"], 
            array('width'=>165, "height"=>233), 
            BX_RESIZE_IMAGE_PROPORTIONAL, 
            true
        );   
    }
}

$books_list  = CIBlockElement::GetList(
    array(), 
    array("ID" => $books_array), 
    false, 
    false, 
    array(
        "ID", 
        "NAME", 
        "PROPERTY_AUTHORS", 
        "DETAIL_PICTURE", 
        "PREVIEW_TEXT", 
        "PROPERTY_STATE", 
        "PROPERTY_SOON_DATE_TIME",
        "CATALOG_GROUP_1", 
        "PROPERTY_COVER_TYPE", 
        "IBLOCK_SECTION_ID"
    )
);
if (!empty($books_array)) {
    while ($books = $books_list -> Fetch()) {
        $arResult["BOOK_INFO"][$books["ID"]] = $books;
        $arResult["BOOK_INFO"][$books["ID"]]["PICTURE"] = CFile::ResizeImageGet(
            $books["DETAIL_PICTURE"], 
            array('width'=>165, "height"=>233), 
            BX_RESIZE_IMAGE_PROPORTIONAL, 
            true
        );
        $books_sections_IDs = $arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["IBLOCK_SECTION_ID"];
        if ($books["PROPERTY_AUTHORS_VALUE"]) {
            $authors_of_found_books_arr[] = $books["PROPERTY_AUTHORS_VALUE"];
        }
    }
    $sections_info_list = CIBlockSection::GetList(array(), array("ID" => $books_sections_IDs), false, array(), false);
    while ($sections_info = $sections_info_list -> Fetch()) {
        $arResult["BOOK_INFO"]["SECTIONS"][$sections_info["ID"]]["SECTION_INFO"] = $sections_info;    
    }
    if (!empty($authors_of_found_books_arr)) { 
        $authors_of_books_list = CIBlockElement::GetList(
            array(), 
            array("ID" => $authors_of_found_books_arr), 
            false, 
            false, 
            array()
        );
        while ($authors_of_books = $authors_of_books_list -> Fetch()) {
            $arResult["BOOK_AUTHOR_INFO"][$authors_of_books["ID"]] = $authors_of_books;
        }
    }

    $basket_items_list = CSaleBasket::GetList(
        array(), 
        array(
            "FUSER_ID" => CSaleBasket::GetBasketUserID(), 
            "LID" => SITE_ID, 
            "ORDER_ID" => "NULL", 
            "PRODUCT_ID" => $books_array
        ), 
        false, 
        false, 
        array(
            "ID", 
            "CALLBACK_FUNC", 
            "MODULE", 
            "PRODUCT_ID", 
            "QUANTITY", 
            "PRODUCT_PROVIDER_CLASS"
        )
    );
    while ($basket_items = $basket_items_list -> Fetch()) {
        $arResult["BASKET_ITEMS"][$basket_items["PRODUCT_ID"]] = $basket_items;    
    }
}

if (!empty($series_array)) {
    $series_list = CIBlockElement::GetList(
        array(), 
        array("ID" => $series_array), 
        false, 
        false, 
        array("ID", "PREVIEW_TEXT")
    );

    while ($series = $series_list -> Fetch()) {
        $arResult["SERIE_INFO"][$series["ID"]] = $series;        
    }
}

$rr = CCatalogDiscountSave::GetRangeByDiscount($arOrder = array(), $arFilter = array(), $arGroupBy = false, $arNavStartParams = false, $arSelectFields = array());
    $ar_sale = array();
    while($ar_sale=$rr->Fetch()) {
        $arResult["SALE_NOTE"][] = $ar_sale;
    }
 $arResult["SAVINGS_DISCOUNT"] =  CCatalogDiscountSave::GetDiscount(array('USER_ID' => $USER->GetID()), true);
 $discounts_list = CCatalogDiscount::GetList(array(), array("PRODUCT_ID" => $books_array, "ACTIVE" => "Y"), false, false, array("ID", "VALUE", "PRODUCT_ID"));
 while ($discounts = $discounts_list -> Fetch()) {
     $arResult["BOOK_INFO"][$discounts["PRODUCT_ID"]]["DISCOUNT_INFO"] = $discounts;
 }
?>