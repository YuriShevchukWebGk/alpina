<?
define("BX_UTF", true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Результаты поиска — Альпина Паблишер");
$APPLICATION->SetTitle("Поиск");
global $SearchFilter;
$SearchFilter = array();

?>
<?

if(!$USER->IsAdmin()){
    $SearchFilter["!PROPERTY_FOR_ADMIN_VALUE"] = "Y";
}

$APPLICATION->IncludeComponent(
    "bitrix:search.page",
    "search_blog_page",
    array(
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
		"TAGS_URL_SEARCH" => "/blog/search/index.php",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "DEFAULT_SORT" => "rank",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_TOP_PAGER" => "Y",
        "FILTER_NAME" => "SearchFilter",
        "NO_WORD_LOGIC" => "Y",
        "PAGER_SHOW_ALWAYS" => "Y",
        "PAGER_TEMPLATE" => "",
        "PAGER_TITLE" => "Результаты поиска",
        "PAGE_RESULT_COUNT" => "50",
        "PATH_TO_USER_PROFILE" => "",
        "RATING_TYPE" => "",
        "RESTART" => "Y",
        "SHOW_RATING" => "",
        "SHOW_WHEN" => "N",
        "SHOW_WHERE" => "Y",
        "USE_LANGUAGE_GUESS" => "N",
        "USE_SUGGEST" => "N",
        "USE_TITLE_RANK" => "Y",
        "arrFILTER" => array(
            0 => "iblock_catalog",
        ),
        "arrFILTER_iblock_catalog" => array(
            0 => "71",
            1 => "72"
        ),
        "arrFILTER_iblock_sebekon_presents" => array(
            0 => "all",
        ),
        "arrFILTER_socialnetwork" => array(
            0 => "all",
        ),
        "arrWHERE" => array(
        ),
        "COMPONENT_TEMPLATE" => "search_blog_page"
    ),
    false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>