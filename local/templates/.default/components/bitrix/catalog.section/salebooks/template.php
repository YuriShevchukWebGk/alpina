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
<link rel="stylesheet" href="/css/flipclock.css">
<script src="/js/flipclock.js"></script>

<style>
.clock{width:470px;margin-bottom:60px}
</style>

<div class="wrapperCategor">
    <div class="categoryWrapper">

        <div class="catalogIcon">
        </div>
        <div class="basketIcon">
        </div>

        <div class="contentWrapp">
            <h1 class="titleMain"><?= ($arResult["NAME"]) ? $arResult["NAME"] : GetMessage("BEST") ?></h1>
            
            
            <center>
                <h2>До новых скидок осталось</h2>
                <div class="clock no-mobile"></div>
            </center>

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

            <div class="otherBooks" id="block1">
                <ul>

                    <?foreach ($arResult["ITEMS"] as $arItem) {
                        $pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>142, 'height'=>210), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                        ?>
                        <li>
                            <div class="categoryBooks">
                                 <div class="sect_badge">
                                     <?if (($arItem["PROPERTIES"]["discount_ban"]["VALUE"] != "Y")
                                         && $arItem['PROPERTIES']['spec_price']['VALUE']
                                         && $arItem['PROPERTIES']['show_discount_icon']['VALUE'] == "Y") {
                                                if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/img/" . $arItem['PROPERTIES']['spec_price']['VALUE'] . "percent.png")) {
                                                    echo '<img class="discount_badge" src="/img/' . $arItem['PROPERTIES']['spec_price']['VALUE'] . 'percent.png">';
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
                                        <a class="product<?= $arItem["ID"]; ?>" href="<?= $arItem["ADD_URL"] ?>" onclick="addtocart(<?= $arItem["ID"]; ?>, '<?= $arItem["NAME"]; ?>'); addToCartTracking(<?= $arItem["ID"]; ?>, '<?= $arItem["NAME"]; ?>', '<?= $arPrice["VALUE"] ?>', '<?= ($arResult["NAME"]) ? $arResult["NAME"] : GetMessage("BEST") ?>', '1'); return false;">
                                            <p class="basketBook">Предзаказ</p>
                                        </a>
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

            </div>
            <div class="wishlist_info">
                <div class="CloseWishlist"><img src="/img/catalogLeftClose.png"></div>
                <span></span>
            </div>

            <?if (($arResult["NAV_RESULT"]->NavPageCount) > 1) {?>
                <p class="showMore">Показать ещё</p>
            <?}?>
        </div>
        <!-- GdeSlon -->
        <script type="text/javascript" src="//www.gdeslon.ru/landing.js?mode=list&amp;codes=<?=substr($gdeSlon,0,-1)?>&amp;mid=79276&amp;cat_id=<?= $arResult['ID'];?>"></script>
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


<script>
    // скрипт ajax-подгрузки товаров в блоке "Все книги"
    $(document).ready(function() {
        <?$navnum = $arResult["NAV_RESULT"]->NavNum;?>
        <?if (isset($_REQUEST["PAGEN_" . $navnum])) {?>
            var page = <?= $_REQUEST["PAGEN_" . $navnum] ?> + 1;
        <?} else {?>
            var page = 2;
        <?}?>
        var maxpage = <?= ($arResult["NAV_RESULT"]->NavPageCount) ?>;
        $('.showMore').click(function(){
            var other_books = $(this).siblings(".otherBooks");
            $.get('<?= $arResult["SECTION_PAGE_URL"] ?>?PAGEN_<?= $navnum ?>='+page, function(data) {
                var next_page = $('.otherBooks li', data);
                $('.otherBooks ul').append(next_page);
                page++;
            })
            .done(function() {
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

        var currentDate = new Date();
        var futureDate = new Date('<?=date("m/d/Y")?> 23:59:59');

        var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;

        clock = $('.clock').FlipClock(diff, {
            clockFace: 'HourlyCounter',
            countdown: true
        });

    });
</script>