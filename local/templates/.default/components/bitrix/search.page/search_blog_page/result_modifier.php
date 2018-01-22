<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

foreach($arResult["SEARCH"] as $key => $arItem) {
    if ($arItem["PARAM2"] == 71) {
        $blog_array[] = $arItem["ITEM_ID"];
    }
	
    $arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_FOR_ADMIN");
    $arFilter = Array("ID"=>$arItem["ITEM_ID"]);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    if($elem = $res->GetNext()) {
         if($elem["PROPERTY_FOR_ADMIN_VALUE"] == "Y" && !$USER->IsAdmin()){
                unset($arResult["SEARCH"][$key]);
         }
    }
}


$blog_list  = CIBlockElement::GetList(
    array(),
    array("ID" => $blog_array),
    false,
    false,
    array(
        "ID",
        "NAME",
        "PROPERTY_AUTHORS",
        "DETAIL_PICTURE",
        "PREVIEW_TEXT",
    )
);
if (!empty($blog_array)) {
    while ($blogs = $blog_list -> Fetch()) {
		if (!is_array($arResult["BLOG_INFO"][$blogs["ID"]])) {
			$arResult["BLOG_INFO"][$blogs["ID"]] = $blogs;
		}
        $arResult["BLOG_INFO"][$blogs["ID"]]["PICTURE"] = CFile::ResizeImageGet(
            $blogs["DETAIL_PICTURE"],
            array('width'=>155, "height"=>155),
            BX_RESIZE_IMAGE_EXACT,
            true
        );
        $books_sections_IDs = $arResult["BLOG_INFO"][$arItem["ITEM_ID"]]["IBLOCK_SECTION_ID"];
        if ($blogs["PROPERTY_AUTHORS_VALUE"]) {
            $authors_of_found_books_arr[] = $blogs["PROPERTY_AUTHORS_VALUE"];
        }
    }
    $sections_info_list = CIBlockSection::GetList(array(), array("ID" => $books_sections_IDs), false, array(), false);
    while ($sections_info = $sections_info_list -> Fetch()) {
        $arResult["BLOG_INFO"]["SECTIONS"][$sections_info["ID"]]["SECTION_INFO"] = $sections_info;
    }
    if (!empty($authors_of_found_books_arr)) {
        $authors_of_books_list = CIBlockElement::GetList(
            array(),
            array("ID" => $authors_of_found_books_arr, "IBLOCK_ID" => AUTHORS_IBLOCK_ID),
            false,
            false,
            array(
				"ID",
                "PROPERTY_LAST_NAME",
                "PROPERTY_FIRST_NAME",
                "PROPERTY_SHOWINAUTHORS",
                "PROPERTY_ORIG_NAME",
				"NAME"
			)
        );
        while ($authors_of_books = $authors_of_books_list -> Fetch()) {
        	if (!$arResult["BOOK_AUTHOR_INFO"][$authors_of_books["ID"]]) {
        		$author_name = "";
	        	if (strlen ($authors_of_books['PROPERTY_FIRST_NAME_VALUE']) > 0) {
	                $author_name .= (strlen ($author_name) > 0 ? ', ' : '') . $authors_of_books['PROPERTY_FIRST_NAME_VALUE'];
	            }
	            if (strlen ($authors_of_books['PROPERTY_LAST_NAME_VALUE']) > 0) {
	                $author_name .= (strlen ($author_name) > 0 ? ' ' : '') . $authors_of_books['PROPERTY_LAST_NAME_VALUE'];
	            }
	            $arResult["BOOK_AUTHOR_INFO"][$authors_of_books["ID"]] = $author_name;
	        }
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

    $basket_items = CSaleBasket::GetList(
        array("ID" => "ASC"),
        array(
            'FUSER_ID' => CSaleBasket::GetBasketUserID(),
            'LID' => SITE_ID,
            'ORDER_ID' => 'NULL'
        ),
        false,
        false,
        array(
            'ID', 'PRODUCT_ID', 'QUANTITY', 'PRICE', 'DISCOUNT_PRICE', 'WEIGHT'
        )
    );

   $allSum = 0;
   $allWeight = 0;
   $arItems = array();

   while ($basket_items_array = $basket_items->Fetch()) {
      $allSum += ($basket_items_array["PRICE"] * $basket_items_array["QUANTITY"]);
      $allWeight += ($basket_items_array["WEIGHT"] * $basket_items_array["QUANTITY"]);
      $arItems[] = $basket_items_array;
   }
   $arOrder = array(
       'SITE_ID' => SITE_ID,
       'USER_ID' => CSaleBasket::GetBasketUserID(),
       'ORDER_PRICE' => $allSum,
       'ORDER_WEIGHT' => $allWeight,
       'BASKET_ITEMS' => $arItems
   );

   $arOptions = array(
      'COUNT_DISCOUNT_4_ALL_QUANTITY' => 'Y',
   );

   $arErrors = array();
   $product_ids = array();
   $product_discount_prices = array();
   
   CSaleDiscount::DoProcessOrder($arOrder, $arOptions, $arErrors);
   foreach ($arOrder["BASKET_ITEMS"] as $arOneItem) {
       /*if ($arOneItem["PRODUCT_ID"] == $arResult["ID"] && $arOneItem["DISCOUNT_PRICE"] < 1) {
           $arItem["ITEM_WITHOUT_DISCOUNT"] = "Y";
       }*/
       $product_ids[] = $arOneItem["PRODUCT_ID"];
       $product_discount_prices[$arOneItem["PRODUCT_ID"]] = $arOneItem["DISCOUNT_PRICE"];
   }
   foreach($arResult["SEARCH"] as $key => $arItem) {
    if ($arItem["PARAM2"] == CATALOG_IBLOCK_ID) { 
        if (in_array($arItem["ITEM_ID"], $product_ids) && $product_discount_prices[$arItem["ITEM_ID"]] < 1) {
            $arResult[$arItem["ITEM_ID"]]["ITEM_WITHOUT_DISCOUNT"] = "Y";
        }
    }
   }   
   
$arResult["SAVINGS_DISCOUNT"] =  CCatalogDiscountSave::GetDiscount(array('USER_ID' => $USER->GetID()), true);
if (!empty($arResult["SAVINGS_DISCOUNT"][0])) {
    $arFilter = array("DISCOUNT_ID" => $arResult["SAVINGS_DISCOUNT"][0]["ID"]);
}
if ($arResult["SAVINGS_DISCOUNT"][1]["VALUE"] >= $arResult["SAVINGS_DISCOUNT"][0]["VALUE"]) {
    $arFilter = array("DISCOUNT_ID" => $arResult["SAVINGS_DISCOUNT"][1]["ID"]);
}
if (!empty($arFilter)) {
    $rr = CCatalogDiscountSave::GetRangeByDiscount($arOrder = array(), $arFilter, $arGroupBy = false, $arNavStartParams = false, $arSelectFields = array());
    $ar_sale = array();
    while($ar_sale=$rr->Fetch()) {
        $arResult["SALE_NOTE"][] = $ar_sale;
    }
}
 //$arResult["SAVINGS_DISCOUNT"] =  CCatalogDiscountSave::GetDiscount(array('USER_ID' => $USER->GetID()), true);
 $discounts_list = CCatalogDiscount::GetList(
    array(), 
    array(
        "PRODUCT_ID" => $books_array, 
        "ACTIVE" => "Y", 
        "!>ACTIVE_FROM" => $DB->FormatDate(
            date("Y-m-d H:i:s"), 
            "YYYY-MM-DD HH:MI:SS",
            CSite::GetDateFormat("FULL")
        ),
        "!<ACTIVE_TO" => $DB->FormatDate(
            date("Y-m-d H:i:s"), 
            "YYYY-MM-DD HH:MI:SS", 
            CSite::GetDateFormat("FULL")
        )
    ), 
    false, 
    false, 
    array("ID", "VALUE", "PRODUCT_ID")
 );
 while ($discounts = $discounts_list -> Fetch()) {
     $arResult["BLOG_INFO"][$discounts["PRODUCT_ID"]]["DISCOUNT_INFO"] = $discounts;
 }

?>