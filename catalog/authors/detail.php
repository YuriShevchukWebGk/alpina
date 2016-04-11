<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Авторы");
$APPLICATION->SetTitle("Авторы книг");
?><?$APPLICATION->IncludeComponent("bitrix:news.detail", "author.detailed", array(
    "IBLOCK_TYPE" => "books",
    "IBLOCK_ID" => "5",
    "ELEMENT_ID" => $_REQUEST["AUTHOR"],
    "ELEMENT_CODE" => "",
    "CHECK_DATES" => "Y",
    "FIELD_CODE" => array(
        0 => "",
        1 => "",
    ),
    "PROPERTY_CODE" => array(
        0 => "BIRTHDATE",
        1 => "FIRST_NAME",
        2 => "ALT_NAME",
        3 => "ORIG_NAME",
        4 => "LAST_NAME",
        5 => "",
    ),
    "IBLOCK_URL" => "index.php",
    "AJAX_MODE" => "N",
    "AJAX_OPTION_SHADOW" => "Y",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "AJAX_OPTION_HISTORY" => "N",
    "CACHE_TYPE" => "N",
    "CACHE_TIME" => "3600",
    "META_KEYWORDS" => "-",
    "META_DESCRIPTION" => "-",
    "DISPLAY_PANEL" => "Y",
    "SET_TITLE" => "Y",
    "SET_STATUS_404" => "Y",
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
    "ADD_SECTIONS_CHAIN" => "Y",
    "ACTIVE_DATE_FORMAT" => "d.m.Y",
    "USE_PERMISSIONS" => "N",
    "DISPLAY_TOP_PAGER" => "N",
    "DISPLAY_BOTTOM_PAGER" => "N",
    "PAGER_TITLE" => "Страница",
    "PAGER_TEMPLATE" => "",
    "DISPLAY_DATE" => "N",
    "DISPLAY_NAME" => "Y",
    "DISPLAY_PICTURE" => "Y",
    "DISPLAY_PREVIEW_TEXT" => "N",
    "AJAX_OPTION_ADDITIONAL" => ""
    ),
    false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>