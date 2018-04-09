<?
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->IncludeComponent(
    "bitrix:rss.out", 
    ".default", 
    array(
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "71",
     //   "SECTION_ID" => "496",
        "SECTION_CODE" => "",
        "NUM_NEWS" => "20",
        "NUM_DAYS" => "30",
        "RSS_TTL" => "60",
        "YANDEX" => "Y",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_GROUPS" => "Y",
        "CACHE_FILTER" => "N",
        "COMPONENT_TEMPLATE" => ".default",
        "COMPOSITE_FRAME_MODE" => "A",
        "INCLUDE_SUBSECTIONS" => "Y",
        "COMPOSITE_FRAME_TYPE" => "AUTO"
    ),
    false
);?>