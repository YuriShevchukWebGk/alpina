<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    /** @var array $arParams */
    /** @var array $arResult */
    /** @global CMain $APPLICATION */
    /** @global CUser $USER */
    /** @global CDatabase $DB */
    /** @var CBitrixComponentTemplate $this */
    /** @var string $templateName */
    /** @var string $templateFile */
    /** @var string $templateFolder */
    /** @var string $componentPath */
    /** @var CBitrixComponent $component */
    $this->setFrameMode(true);
	$gdeSlon = '';
?>

<div class="wrapperCategor">
    <div class="categoryWrapper">

        <div class="catalogIcon">
        </div>
        <div class="basketIcon">
        </div>

        <div class="contentWrapp">
            <p class="titleMain"><?= ($arResult["NAME"]) ? $arResult["NAME"] : GetMessage("BEST") ?></p>

            <?if (is_array($arResult["QUOTE"])) {?>
                <div class="titleDiv">
                <?if ($arResult["QUOTE"]["DETAIL_PICTURE"]){?>
                    <div class="photo">
                        <img src="<?= $arResult["QUOTE_IMAGE"]["src"] ?>">
                    </div>
                <?}?>
                    <p class="text">"<?= $arResult["QUOTE"]["DETAIL_TEXT"] ?>"</p>
                    <p class="autor"><?= $arResult["QUOTE"]["PROPERTY_AUTHOR_NAME"] ?></p>
                </div>
            <?}?>
            <?if ($arResult["SERIES"]["ELEMENT"]["DETAIL_TEXT"]) {?>
                <div class="titleText">
                    <p class="text"><?= $arResult["SERIES"]["ELEMENT"]["DETAIL_TEXT"] ?></p>
                </div>
            <?}?>
            <? global $SeriesRoundBanner;
            $SeriesRoundBanner = array("PROPERTY_BIND_TO_SERIE" => $arResult["SERIES"]["ID"]);
			/* УБИРАЕМ БАННЕРЫ ПОКА
            $APPLICATION->IncludeComponent(
                "bitrix:news.list", 
                "series_banners", 
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
                    "CHECK_DATES" => "Y",
                    "COMPONENT_TEMPLATE" => "section_banners",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array(
                        0 => "DETAIL_PICTURE",
                        1 => "",
                    ),
                    "FILTER_NAME" => "SeriesRoundBanner",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => SERIES_BANNERS_IBLOCK_ID,
                    "IBLOCK_TYPE" => "news",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "20",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Баннеры серии",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array(
                        0 => "SERIE_BANNER_LINK",
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
            );*/?>
             <?// блок с цитатой END?>
            <ul class="filterParams">
                <li <?if ($_REQUEST['SORT'] == 'POPULARITY' || !($_REQUEST['SORT'])) {?>class="active <?if ($_REQUEST["DIRECTION"] == "DESC"){?>descArrow<?}?>"<?}?>>
                    <p data-id="1">
                        <?if ($_REQUEST['SORT'] == 'POPULARITY' && $_REQUEST["DIRECTION"] == 'ASC') {?>
                            <a href="<?= $APPLICATION->GetCurPage(); ?>?SORT=POPULARITY&DIRECTION=DESC">По популярности</a>
                        <?} else {?>
                            <a href="<?= $APPLICATION->GetCurPage(); ?>?SORT=POPULARITY&DIRECTION=ASC">По популярности</a>
                        <?}?>
                    </p>
                </li>
                <li <?if ($_REQUEST['SORT'] == 'DATE' || $_REQUEST['SORT'] == 'NEW') {?>class="active <?if ($_REQUEST["DIRECTION"] == "DESC"){?>descArrow<?}?>"<?}?>>
                    <p data-id="2">
                        <?if ($_REQUEST['SORT'] == 'DATE' && $_REQUEST["DIRECTION"] == 'ASC') {?>
                            <a href="<?= $APPLICATION->GetCurPage(); ?>?SORT=DATE&DIRECTION=DESC">По дате выхода</a>
                        <?} else {?>
                            <a href="<?= $APPLICATION->GetCurPage(); ?>?SORT=DATE&DIRECTION=ASC">По дате выхода</a>
                        <?}?>
                    </p>
                </li>
                <?if ($arParams['HIDE_PRICE_SORT'] != 'Y'){?>
                    <li <?if ($_REQUEST['SORT'] == 'PRICE') {?>class="active <?if ($_REQUEST["DIRECTION"] == "DESC"){?>descArrow<?}?>"<?}?>>
                        <p data-id="3">
                            <?if ($_REQUEST['SORT'] == 'PRICE' && $_REQUEST["DIRECTION"] == 'ASC') {?>
                                <a href="<?= $APPLICATION->GetCurPage(); ?>?SORT=PRICE&DIRECTION=DESC">По цене</a>
                            <?} else {?>
                                <a href="<?= $APPLICATION->GetCurPage(); ?>?SORT=PRICE&DIRECTION=ASC">По цене</a>
                            <?}?>
                        </p>
                    </li>
                <?}?>

            </ul>
            <??>
            <div class="otherBooks" id="block1">
                <ul>

                    <?foreach ($arResult["ITEMS"] as $arItem) { 
                        $pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>142, 'height'=>210), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                        ?>
                        <li>
                            <div class="categoryBooks">
                                <div class="sect_badge">
                                    <? if (($arItem["PROPERTIES"]["discount_ban"]["VALUE"] != "Y") && $arItem['PROPERTIES']['spec_price']['VALUE'] ) {
                                        switch ($arItem['PROPERTIES']['spec_price']['VALUE']) {
                                            case 10:
                                                echo '<img class="discount_badge" src="/img/10percent.png">';
                                                break;
                                            case 15:
                                                echo '<img class="discount_badge" src="/img/15percent.png">';
                                                break;
                                            case 20:
                                                echo '<img class="discount_badge" src="/img/20percent.png">';
                                                break;
                                            case 40:
                                                echo '<img class="discount_badge" src="/img/40percent_black.png">';
                                                break;

                                        }
                                    }?>
                                </div>
                                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                                    <div class="section_item_img">
                                        <?if ($pict["src"]) {?>
                                            <img src="<?=$pict["src"]?>" alt="<?=$arItem["NAME"];?>">
                                            <?} else {?>
                                            <img src="/images/no_photo.png" width="142" height="142">
                                            <?}?>
                                    </div>
                                    <p class="nameBook"><?= $arItem["NAME"] ?></p>
                                </a>
                                <p class="bookAutor"><?= $arResult["AUTHORS"][$arItem["PROPERTIES"]["AUTHORS"]["VALUE"][0]]["NAME"] ?></p>
                                <p class="tapeOfPack"><?= $arItem["PROPERTIES"]["COVER_TYPE"]["VALUE"] ?></p>
                                <?
                                    foreach ($arItem["PRICES"] as $code => $arPrice) {
                                        if (intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "soon") 
                                            && intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "net_v_nal")) {
                                        ?>
                                        <p class="priceOfBook"><?= ceil($arPrice["DISCOUNT_VALUE_VAT"]) ?> <span>руб.</span></p>
                                        <?
                                            if ($arResult["ITEM_IN_BASKET"][$arBasketItems["PRODUCT_ID"]]["QUANTITY"] == 0) {?>
                                            <a class="product<?= $arItem["ID"]; ?>" href="<?= $arItem["ADD_URL"] ?>" onclick="addtocart(<?= $arItem["ID"]; ?>, '<?= $arItem["NAME"]; ?>'); addToCartTracking(<?= $arItem["ID"]; ?>, '<?= $arItem["NAME"]; ?>', '<?= $arPrice["VALUE"] ?>', '<?= ($arResult["NAME"]) ? $arResult["NAME"] : GetMessage("BEST") ?>', '1'); return false;">
                                                <p class="basketBook">В корзину</p>
                                            </a>
                                            <?} else {?>
                                            <a class="product<?= $arItem["ID"]; ?>" href="/personal/cart/">
                                                <p class="basketBook" style="background-color: #A9A9A9;color: white;">Оформить</p>
                                            </a>
                                            <?}
                                        } else if (intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) == getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "net_v_nal")) {
                                        ?>
                                        <p class="priceOfBook"><?= $arItem["PROPERTIES"]["STATE"]["VALUE"] ?></p>
                                        <?
                                        } else {
                                        ?>
                                        <p class="priceOfBook"><?= strtolower(FormatDate("j F Y", MakeTimeStamp($arItem['PROPERTIES']['SOON_DATE_TIME']['VALUE'], "DD.MM.YYYY HH:MI:SS"))); ?></p>
                                        <?
                                        }
                                    }
									$gdeSlon .= $arItem['ID'].':'.ceil($arPrice["DISCOUNT_VALUE_VAT"]).',';

                                    if ($USER -> IsAuthorized()) {?>
                                        <p class="basketLater" id="<?= $arItem["ID"] ?>">Куплю позже</p>
                                    <?}?>
                            </div>
                        </li>
                    <?}?>
                </ul>
			<!-- GdeSlon -->
			<script type="text/javascript" src="//www.gdeslon.ru/landing.js?mode=list&amp;codes=<?=substr($gdeSlon,0,-1)?>&amp;mid=79276"></script>
            </div>
            <div class="wishlist_info">
                <div class="CloseWishlist"><img src="/img/catalogLeftClose.png"></div>
                <span></span>
            </div>
            
            <?if (($arResult["NAV_RESULT"]->NavPageCount) > 1) {?>
                <p class="showMore">Показать ещё</p>
            <?}?>
        </div>

        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "catalog_left_menu",
            array(
                "ROOT_MENU_TYPE" => "top_books_left_menu",
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "top",
                "USE_EXT" => "Y",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "Y",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "MENU_CACHE_GET_VARS" => array(
                ),
                "COMPONENT_TEMPLATE" => "catalog_left_menu"
            ),
            false
        );?>
            
        <?$APPLICATION->IncludeComponent(
            "bitrix:catalog.section.list", 
            "section.left.tree", 
            array(
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => CATALOG_IBLOCK_ID,
                "SECTION_ID" => "",
                "SECTION_CODE" => "",
                "COUNT_ELEMENTS" => "N",
                "TOP_DEPTH" => "2",
                "IBLOCK_HEADER_TITLE" => "Каталог книг",
                "IBLOCK_HEADER_LINK" => "",
                "SECTION_URL" => "#SITE_DIR#/catalog/#SECTION_CODE#/",
                "CACHE_TYPE" => "N",
                "CACHE_TIME" => "3600",
                "DISPLAY_PANEL" => "N",
                "ADD_SECTIONS_CHAIN" => "Y",
                "COMPONENT_TEMPLATE" => "section.left.tree",
                "SECTION_FIELDS" => array(
                    0 => "",
                    1 => "",
                ),
                "SECTION_USER_FIELDS" => array(
                    0 => "",
                    1 => "",
                ),
                "CACHE_GROUPS" => "N",
                "VIEW_MODE" => "LIST",
                "SHOW_PARENT_NAME" => "Y"
            ),
            false
        );?>




    </div>
</div>

<?/* Получаем бестселлеры от RetailRocket */
global $arrFilterPersonal;
if (isset($_COOKIE["rrpusid"])){
    $stringRecs = file_get_contents('https://api.retailrocket.ru/api/1.0/Recomendation/PersonalRecommendation/50b90f71b994b319dc5fd855/?rrUserId=' . $_COOKIE["rrpusid"]);
    $recsArray = json_decode($stringRecs);
    $arrFilterPersonal = Array('ID' => (array_slice($recsArray, 0, 6)));
}
if ($arrFilterPersonal['ID'][0] > 0) { // Если персональные рекомендаций нет, не показываем блок?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "interesting_items",
        array(
            "IBLOCK_TYPE" => "catalog",
            "IBLOCK_ID" => CATALOG_IBLOCK_ID,
            "SECTION_ID" => $arResult["ID"],
            "SECTION_CODE" => "",
            "IBLOCK_HEADER_TITLE" => "",
            "ELEMENT_SORT_FIELD" => "ID",
            "ELEMENT_SORT_ORDER" => "desc",
            "FILTER_NAME" => "arrFilterPersonal",
            "INCLUDE_SUBSECTIONS" => "N",
            "SHOW_ALL_WO_SECTION" => "Y",
            "PAGE_ELEMENT_COUNT" => "10",
            "LINE_ELEMENT_COUNT" => "1",
            "PROPERTY_CODE" => array(
                0 => "SHORT_NAME",
                1 => "BIRTHDATE",
                2 => "FIRST_NAME",
                3 => "LAST_NAME",
                4 => "",
            ),
            "SECTION_URL" => "",
            "DETAIL_URL" => "",
            "BASKET_URL" => "/personal/cart/",
            "ACTION_VARIABLE" => "action",
            "PRODUCT_ID_VARIABLE" => "",
            "SECTION_ID_VARIABLE" => "",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_SHADOW" => "Y",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "CACHE_TYPE" => "N",
            "CACHE_TIME" => "3600",
            "META_KEYWORDS" => "-",
            "META_DESCRIPTION" => "-",
            "DISPLAY_PANEL" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "DISPLAY_COMPARE" => "N",
            "SET_TITLE" => "N",
            "SET_STATUS_404" => "N",
            "CACHE_FILTER" => "Y",
            "PRICE_CODE" => array(
                0 => "BASE",
            ),
            "USE_PRICE_COUNT" => "N",
            "SHOW_PRICE_COUNT" => "1",
            "PRICE_VAT_INCLUDE" => "N",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "PAGER_TITLE" => "Товары",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "Y",
            "AJAX_OPTION_ADDITIONAL" => "",
            "COMPONENT_TEMPLATE" => "interesting_items",
            "SECTION_USER_FIELDS" => array(
                0 => "",
                1 => "",
            ),
            "ELEMENT_SORT_FIELD2" => "id",
            "ELEMENT_SORT_ORDER2" => "desc",
            "HIDE_NOT_AVAILABLE" => "N",
            "OFFERS_LIMIT" => "5",
            "BACKGROUND_IMAGE" => "-",
            "TEMPLATE_THEME" => "blue",
            "ADD_PICT_PROP" => "-",
            "LABEL_PROP" => "-",
            "PRODUCT_SUBSCRIPTION" => "N",
            "SHOW_DISCOUNT_PERCENT" => "N",
            "SHOW_OLD_PRICE" => "N",
            "SHOW_CLOSE_POPUP" => "N",
            "MESS_BTN_BUY" => "Купить",
            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
            "MESS_BTN_SUBSCRIBE" => "Подписаться",
            "MESS_BTN_COMPARE" => "Сравнить",
            "MESS_BTN_DETAIL" => "Подробнее",
            "MESS_NOT_AVAILABLE" => "Нет в наличии",
            "SEF_MODE" => "N",
            "CACHE_GROUPS" => "N",
            "SET_BROWSER_TITLE" => "Y",
            "BROWSER_TITLE" => "-",
            "SET_META_KEYWORDS" => "Y",
            "SET_META_DESCRIPTION" => "Y",
            "SET_LAST_MODIFIED" => "N",
            "USE_MAIN_ELEMENT_SECTION" => "N",
            "CONVERT_CURRENCY" => "N",
            "USE_PRODUCT_QUANTITY" => "N",
            "PRODUCT_QUANTITY_VARIABLE" => "undefined",
            "ADD_PROPERTIES_TO_BASKET" => "Y",
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "PARTIAL_PRODUCT_PROPERTIES" => "N",
            "PRODUCT_PROPERTIES" => array(
            ),
            "ADD_TO_BASKET_ACTION" => "ADD",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "SHOW_404" => "N",
            "MESSAGE_404" => ""
        ),
        false
    );?>
    </div>
<?}?>

<script>
    // скрипт ajax-подгрузки товаров в блоке "Все книги"
    $(document).ready(function() {
		var categor_height;

		<?if (strstr($APPLICATION -> GetCurDir(), "/series/")) {?>
			categor_height = 1850 + Math.ceil((books_block_length - 15) / 5) * 455;
		<?} else {?>
			categor_height = 1600 + Math.ceil((books_block_length - 15) / 5) * 455;
		<?}?>		
		//$(".wrapperCategor").css("height", categor_height + "px");
        <?$navnum = $arResult["NAV_RESULT"]->NavNum;?>
        <?if (isset($_REQUEST["PAGEN_" . $navnum])) {?>
            var page = <?= $_REQUEST["PAGEN_" . $navnum] ?> + 1;
        <?} else {?>
            var page = 2;
        <?}?>
        var maxpage = <?= ($arResult["NAV_RESULT"]->NavPageCount) ?>;
        $('.showMore').click(function(){
            var other_books = $(this).siblings(".otherBooks");
            $.fancybox.showLoading();
            <?if (isset($_REQUEST["SORT"])) {?>
                var section_url = '<?= $arResult["SECTION_PAGE_URL"] . "?" . $_SERVER["QUERY_STRING"] . "&PAGEN_" . $navnum . "=" ?>';    
            <?} else {?>
                var section_url = '<?= $arResult["SECTION_PAGE_URL"] . "?PAGEN_" . $navnum . "=" ?>';    
            <?}?>
            $.get(section_url + page, function(data) {
                var next_page = $('.otherBooks li', data);
                $('.otherBooks ul').append(next_page);
                page++;
            })
            .done(function() {
                $.fancybox.hideLoading();
                // обрезка длинных названий, изменение высоты блоков, 
                // содержащих карточки товаров, в зависимости от количества карточек
                $(".nameBook").each(function() {
                    if($(this).length > 0) {
                        $(this).html(truncate($(this).html(), 40));
                    }
                });
                var other_books_height, categor_height, books_block_length;
                books_block_length = $(".otherBooks li").length;
                other_books_height = 1350 * Math.ceil((books_block_length / 15));
                <?if (strstr($APPLICATION -> GetCurDir(), "/series/")) {?>
                    categor_height = 2050 + Math.ceil((books_block_length - 15) / 5) * 455;
                <?} else {?>
                    categor_height = 1600 + Math.ceil((books_block_length - 15) / 5) * 455;
                <?}?>
                other_books.css("height", other_books_height + "px");
                $(".wrapperCategor").css("height", categor_height + "px");
                $(".contentWrapp").css("height", categor_height - 10 + "px");
				$(".wrapperCategor").css("height", $(".contentWrapp").height()+"px");
            });
            if (page == maxpage) {
                $('.showMore').hide();
            }
            return false;

        });

        <?if (!$USER -> IsAuthorized()) {?>
            $(".categoryWrapper .categoryBooks").hover(function(){
                $(this).css("height", "390px");
            });
        <?}?>
    });
</script>