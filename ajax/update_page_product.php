<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    CModule::IncludeModule("sale"); CModule::IncludeModule("catalog"); CModule::IncludeModule("iblock");
?>
<?
switch ($_REQUEST["sort"])
{
    case "popularity":
    $sort = "PROPERTY_shows_a_day";
    break;
    
    case "date":
    $sort = "PROPERTY_SOON_DATE_TIME";
    break;
    
    case "price":
    $sort = "CATALOG_PRICE_1";
    break;
}
$order = $_REQUEST["direction"];
global $SectFilter;
$SectFilter = array (">CATALOG_PRICE_1" => 0);
$SectFilter["ID"] = $_REQUEST["sect_code"];

$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"ajax_tag", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"COMPONENT_TEMPLATE" => "ajax_tag",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => $sort,
		"ELEMENT_SORT_ORDER" => $order,
		"ELEMENT_SORT_FIELD2" => "PROPERTY_STATE",
		"ELEMENT_SORT_ORDER2" => "desc",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => "SectFilter",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LABEL_PROP_MOBILE" => "",
		"LABEL_PROP_POSITION" => "top-left",
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_COMPARE" => "Сравнить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "round",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "15",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"PROPERTY_CODE" => array(
			0 => "AUTHORS",
			1 => "number_volumes",
			2 => "AUTHORS_string",
			3 => "NEWPRODUCT",
			4 => "SALELEADER",
			5 => "SPECIALOFFER",
			6 => "",
		),
		"PROPERTY_CODE_MOBILE" => "",
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "Y",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	),
	false
);?>

<?
/*
$APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "ajax_tag",
            array(
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => "4",
                "ELEMENT_SORT_FIELD" => $sort,
                "ELEMENT_SORT_ORDER" => $order,
                "ELEMENT_SORT_FIELD2" => "PROPERTY_STATE",
                "ELEMENT_SORT_ORDER2" => "desc",
                "PROPERTY_CODE" => array(
                    0 => "AUTHORS",
                    1 => "NEWPRODUCT",
                    2 => "SALELEADER",
                    3 => "SPECIALOFFER",
                    4 => ""
                ),
                "META_KEYWORDS" => "-",
                "META_DESCRIPTION" => "UF_META_DESCRIPTION",
                "BROWSER_TITLE" => "-",
                "SET_LAST_MODIFIED" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "BASKET_URL" => "/personal/cart/",
                "ACTION_VARIABLE" => "action",
                "PRODUCT_ID_VARIABLE" => "id",
                "SECTION_ID_VARIABLE" => "SECTION_ID",
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "FILTER_NAME" => "SectFilter",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "N",
                "SET_TITLE" => "Y",
                "MESSAGE_404" => "",
                "SET_STATUS_404" => "Y",
                "SHOW_404" => "N",
                "FILE_404" => "",
                "DISPLAY_COMPARE" => "N",
                "PAGE_ELEMENT_COUNT" => "15",
                "LINE_ELEMENT_COUNT" => "3",
                "PRICE_CODE" => array(
                    0 => "BASE"
                ),
                "USE_PRICE_COUNT" => "N",
                "SHOW_PRICE_COUNT" => "1",

                "PRICE_VAT_INCLUDE" => "Y",
                "USE_PRODUCT_QUANTITY" => "Y",
                "ADD_PROPERTIES_TO_BASKET" => "Y",
                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                "PRODUCT_PROPERTIES" => array(
                ),

                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "Товары",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "round",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_BASE_LINK" => "",
                "PAGER_PARAMS_NAME" => "",

                "OFFERS_CART_PROPERTIES" => array(
                    0 => "COLOR_REF",
                    1 => "SIZES_SHOES",
                    2 => "SIZES_CLOTHES"
                ),
                "OFFERS_FIELD_CODE" => array(
                    0 => "NAME",
                    1 => "PREVIEW_PICTURE",
                    2 => "DETAIL_PICTURE",
                    3 => ""
                ),
                "OFFERS_PROPERTY_CODE" => array(
                    0 => "ARTNUMBER",
                    1 => "COLOR_REF",
                    2 => "SIZES_SHOES",
                    3 => "SIZES_CLOTHES",
                    4 => "MORE_PHOTO",
                    5 => ""
                ),
                "OFFERS_SORT_FIELD" => "sort",
                "OFFERS_SORT_ORDER" => "desc",
                "OFFERS_SORT_FIELD2" => "id",
                "OFFERS_SORT_ORDER2" => "desc",
                "OFFERS_LIMIT" => "0",

                "SECTION_ID" => "",
                "SECTION_CODE" => "",
                "SECTION_URL" => "/catalog/#SECTION_CODE#/",
                "DETAIL_URL" => "/catalog/#SECTION_CODE#/#ELEMENT_ID#/",
                "USE_MAIN_ELEMENT_SECTION" => "N",
                'CONVERT_CURRENCY' => "Y",
                'CURRENCY_ID' => "RUB",
                'HIDE_NOT_AVAILABLE' => "N",

                'LABEL_PROP' => "-",
                'ADD_PICT_PROP' => "MORE_PHOTO",
                'PRODUCT_DISPLAY_MODE' => "Y",

                'OFFER_ADD_PICT_PROP' => "MORE_PHOTO",
                'OFFER_TREE_PROPS' => array(
                    0 => "COLOR_REF",
                    1 => "SIZES_SHOES",
                    2 => "SIZES_CLOTHES"
                ),
                'PRODUCT_SUBSCRIPTION' => "",
                'SHOW_DISCOUNT_PERCENT' => "Y",
                'SHOW_OLD_PRICE' => "Y",
                'MESS_BTN_BUY' => "Купить",
                'MESS_BTN_ADD_TO_BASKET' => "В корзину",
                'MESS_BTN_SUBSCRIBE' => "",
                'MESS_BTN_DETAIL' => "Подробнее",
                'MESS_NOT_AVAILABLE' => "Нет в наличии",

                'TEMPLATE_THEME' => "site",
                "ADD_SECTIONS_CHAIN" => "N",
                'ADD_TO_BASKET_ACTION' => "",
                'SHOW_CLOSE_POPUP' => "N",
                'COMPARE_PATH' => "/catalog/compare/",
                'BACKGROUND_IMAGE' => "-"
            ),
            $component
        );*/
		?>
		