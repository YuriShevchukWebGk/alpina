<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Арифметика добра");
global $SectFilter;?><div class="layout">
</div>
<div class="slider_wrap">
    <div class="slideWrapp">
        <ul class="roundSlider">
            <li class="firstSlide">
            <div class="catalogWrapper">
                <p class="titleSlide">
                     <?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/local/templates/.default/include/good_arithmetics_block_title.php"
    )
);?>
                </p>
                <p class="textSlide">
                     <?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/local/templates/.default/include/good_arithmetics_block_text.php"
    )
);?>
                </p>
            </div>
 </li>
        </ul>
    </div>
</div>
 <?
switch ($_REQUEST["SORT"]) {
    case "POPULARITY":
        $sort = "PROPERTY_POPULARITY";
        break;
    
    case "DATE":
        $sort = "PROPERTY_STATEDATE";
        break;
    
    case "PRICE":           
        $sort = "CATALOG_PRICE_" . SUSPENDED_BOOKS_PRICE_ID;
        break;
}
$order = $_REQUEST["direction"];
$SectFilter = array (">CATALOG_PRICE_" . SUSPENDED_BOOKS_PRICE_ID => 0, "PROPERTY_ABLE_TO_SUSPEND_VALUE" => "Y");
$APPLICATION->IncludeComponent(
    "bitrix:catalog.section", 
    "good_arithmetics", 
    array(
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => CATALOG_IBLOCK_ID,
        "ELEMENT_SORT_FIELD" => "PROPERTY_STATE",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_FIELD2" => $sort,
        "ELEMENT_SORT_ORDER2" => $order,
        "PROPERTY_CODE" => array(
            0 => "",
            1 => "AUTHORS",
            2 => "NEWPRODUCT",
            3 => "SALELEADER",
            4 => "SPECIALOFFER",
            5 => "",
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
        "PAGE_ELEMENT_COUNT" => "18",
        "LINE_ELEMENT_COUNT" => "3",
        "PRICE_CODE" => array(
            0 => "GIFT_BOOK_PRICE",
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
            2 => "SIZES_CLOTHES",
        ),
        "OFFERS_FIELD_CODE" => array(
            0 => "NAME",
            1 => "PREVIEW_PICTURE",
            2 => "DETAIL_PICTURE",
            3 => "",
        ),
        "OFFERS_PROPERTY_CODE" => array(
            0 => "ARTNUMBER",
            1 => "COLOR_REF",
            2 => "SIZES_SHOES",
            3 => "SIZES_CLOTHES",
            4 => "MORE_PHOTO",
            5 => "",
        ),
        "OFFERS_SORT_FIELD" => "sort",
        "OFFERS_SORT_ORDER" => "desc",
        "OFFERS_SORT_FIELD2" => "id",
        "OFFERS_SORT_ORDER2" => "desc",
        "OFFERS_LIMIT" => "0",
        "SECTION_ID" => "",
        "SECTION_CODE" => $_REQUEST["sect_code"],
        "SECTION_URL" => "/catalog/#SECTION_CODE#/",
        "DETAIL_URL" => "/catalog/#SECTION_CODE#/#ELEMENT_ID#/",
        "USE_MAIN_ELEMENT_SECTION" => "N",
        "CONVERT_CURRENCY" => "Y",
        "CURRENCY_ID" => "RUB",
        "HIDE_NOT_AVAILABLE" => "N",
        "LABEL_PROP" => "-",
        "ADD_PICT_PROP" => "MORE_PHOTO",
        "PRODUCT_DISPLAY_MODE" => "Y",
        "OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
        "OFFER_TREE_PROPS" => array(
            0 => "COLOR_REF",
            1 => "SIZES_SHOES",
            2 => "SIZES_CLOTHES",
        ),
        "PRODUCT_SUBSCRIPTION" => "N",
        "SHOW_DISCOUNT_PERCENT" => "Y",
        "SHOW_OLD_PRICE" => "Y",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
        "MESS_BTN_SUBSCRIBE" => "",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "TEMPLATE_THEME" => "site",
        "ADD_SECTIONS_CHAIN" => "N",
        "ADD_TO_BASKET_ACTION" => "ADD",
        "SHOW_CLOSE_POPUP" => "N",
        "COMPARE_PATH" => "/catalog/compare/",
        "BACKGROUND_IMAGE" => "-",
        "COMPONENT_TEMPLATE" => "good_arithmetics",
        "SECTION_USER_FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "SHOW_ALL_WO_SECTION" => "Y",
        "MESS_BTN_COMPARE" => "Сравнить",
        "SEF_MODE" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "undefined",
        "SET_BROWSER_TITLE" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_META_DESCRIPTION" => "Y",
        "DISABLE_INIT_JS_IN_COMPONENT" => "N"
    ),
    $component
);?>
 <?$APPLICATION->IncludeComponent(
    "bitrix:news.list", 
    "good_arithmetics_events", 
    array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "N",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "N",
        "COMPONENT_TEMPLATE" => "good_arithmetics_events",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(
            0 => "PREVIEW_PICTURE",
            1 => "DATE_ACTIVE_FROM",
            2 => "ACTIVE_FROM",
            3 => "DATE_ACTIVE_TO",
            4 => "ACTIVE_TO",
            5 => "",
        ),
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "56",
        "IBLOCK_TYPE" => "news",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "INCLUDE_SUBSECTIONS" => "Y",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "3",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "Новости",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "SET_BROWSER_TITLE" => "Y",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "Y",
        "SHOW_404" => "N",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC"
    ),
    false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>