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
?>
<?if ($_REQUEST["DIRECTION"] == "DESC")
    {?>
    <style>
        .filterParams .active p:after {
            -moz-transform: scaleX(-1);
            -o-transform: scaleX(-1);
            -webkit-transform: scaleX(-1);
            transform: scaleX(-1);
            position: absolute;
        }
        .wrapperCategor .filterParams li.active {
            width:128px;
        }
    </style>

    <?}?>


<div class="wrapperCategor">
    <div class="categoryWrapper">

        <div class="catalogIcon">
        </div>
        <div class="basketIcon">
        </div>

        <div class="contentWrapp">
            <p class="titleMain"><?=$arResult["NAME"]?></p>



            <?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "section_banners",
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
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "6",
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
        "PAGER_TITLE" => "Новости",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array(
            0 => "SECT_BANNER_LINK",
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
);?>


            <p class="grayTitle">Самые популярные товары в категории</p>

            <?
                /*if (strpos($APPLICATION->GetCurPage(),"/books/") === false)
                {
                global $arrFilter;
                $strQueryText = QueryGetData("api.retailrocket.ru",80,"/api/1.0/Recomendation/CategoryToItems/50b90f71b994b319dc5fd855/".$arResult['ID'],"",$error_number,$error_text);
                if ($strQueryText != '[]' && strpos($strQueryText,"error") === false)
                {
                $pattern_replace = array('/\[/', '/\]/', '/,/');
                $replace = array('', '', ', ');
                $printid = preg_replace($pattern_replace, $replace, $strQueryText);
                $printid2 = array_slice(explode(", ", $printid),0,5);
                foreach ($printid2 as $rec_book)
                {
                $arrFilter['ID'][] = $rec_book;
                }
                }*/
                global $BestsellFilter;
                $BestsellFilter = array(">CATALOG_PRICE_1" => 0);
                if(!$USER->IsAdmin()){
                    $BestsellFilter["!PROPERTY_FOR_ADMIN_VALUE"] = "Y";
                }
                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section",
                    "category.recs",
                    array(
                        "IBLOCK_TYPE" => "catalog",
                        "IBLOCK_ID" => "4",
                        "SECTION_ID" => $arResult["ID"],
                        "SECTION_CODE" => "",
                        "IBLOCK_HEADER_TITLE" => "",
                        "ELEMENT_SORT_FIELD" => "PROPERTY_SALES_CNT",
                        "ELEMENT_SORT_ORDER" => "desc",
                        "FILTER_NAME" => "BestsellFilter",
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
                        "BASKET_URL" => "/personal/cart/step1a.php",
                        "ACTION_VARIABLE" => "action",
                        "PRODUCT_ID_VARIABLE" => "",
                        "SECTION_ID_VARIABLE" => "",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_SHADOW" => "Y",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "CACHE_TYPE" => "A",
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
                        "COMPONENT_TEMPLATE" => "category.recs",
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
                );
                //}?>
            <?  //блок с цитатой
                $arSection = CIBlockSection::GetList(array(),array("IBLOCK_ID"=>$arResult["IBLOCK_ID"],"ID"=>$arResult["ID"]),false,array("UF_QUOTE"))->Fetch();
                if ($arSection["UF_QUOTE"] > 0) {
                    $arQuote = CIBlockElement::GetList(array(),array("ID"=>$arSection["UF_QUOTE"]),false,false,array("NAME","DETAIL_TEXT","DETAIL_PICTURE","PROPERTY_AUTHOR.NAME"))->Fetch();
                }
            ?>
            <?if (is_array($arQuote)) {?>
                <div class="titleDiv">
                <?if ($arQuote["DETAIL_PICTURE"]){?>
                    <div class="photo">
                    <?$quoteImg = CFile::ResizeImageGet($arQuote["DETAIL_PICTURE"],array("width"=>288,"height"=>294), BX_RESIZE_IMAGE_PROPORTIONAL); ?>
                        <img src="<?=$quoteImg["src"]?>">
                    </div>
                    <?}?>
                    <p class="text">"<?=$arQuote["DETAIL_TEXT"]?>"</p>
                    <p class="autor"><?=$arQuote["PROPERTY_AUTHOR_NAME"]?></p>
                </div>
                <?}?>
             <?// блок с цитатой END?>
            <ul class="filterParams">
                <li <?if ($_REQUEST['SORT'] == 'POPULARITY' || !($_REQUEST['SORT'])){?>class="active"<?}?>><p data-id="1">
                        <?if ($_REQUEST['SORT'] == 'POPULARITY' && $_REQUEST["DIRECTION"] == 'ASC')
                            {?>
                            <a href="<?=$APPLICATION->GetCurPage();?>?SORT=POPULARITY&DIRECTION=DESC" onclick="update_sect_page('popularity', 'desc', '<?=$arParams["SECTION_CODE"]?>'); return false;">По популярности</a>
                            <?}
                            else
                            {?>
                            <a href="<?=$APPLICATION->GetCurPage();?>?SORT=POPULARITY&DIRECTION=ASC" onclick="update_sect_page('popularity', 'asc', '<?=$arParams["SECTION_CODE"]?>'); return false;">По популярности</a>
                            <?}?>
                    </p>
                </li>
                <li <?if ($_REQUEST['SORT'] == 'DATE'){?>class="active"<?}?>><p data-id="2">
                        <?if ($_REQUEST['SORT'] == 'DATE' && $_REQUEST["DIRECTION"] == 'ASC')
                            {?>
                            <a href="<?=$APPLICATION->GetCurPage();?>?SORT=DATE&DIRECTION=DESC" onclick="update_sect_page('date', 'desc', '<?=$arParams["SECTION_CODE"]?>'); return false;">По дате выхода</a>
                            <?}
                            else
                            {?>
                            <a href="<?=$APPLICATION->GetCurPage();?>?SORT=DATE&DIRECTION=ASC" onclick="update_sect_page('date', 'asc', '<?=$arParams["SECTION_CODE"]?>'); return false;">По дате выхода</a>
                            <?}?>
                    </p>
                </li>
                <li <?if ($_REQUEST['SORT'] == 'PRICE'){?>class="active"<?}?>><p data-id="3">
                        <?if ($_REQUEST['SORT'] == 'PRICE' && $_REQUEST["DIRECTION"] == 'ASC')
                            {?>
                            <a href="<?=$APPLICATION->GetCurPage();?>?SORT=PRICE&DIRECTION=DESC" onclick="update_sect_page('price', 'desc', '<?=$arParams["SECTION_CODE"]?>'); return false;">По цене</a>
                            <?}
                            else
                            {?>
                            <a href="<?=$APPLICATION->GetCurPage();?>?SORT=PRICE&DIRECTION=ASC" onclick="update_sect_page('price', 'asc', '<?=$arParams["SECTION_CODE"]?>'); return false;">По цене</a>
                            <?}?>
                    </p>
                </li>
            </ul>
            <??>
            <div class="otherBooks" id="block1">
                <ul>

                    <?foreach ($arResult["ITEMS"] as $arItem)
                        {   //if ($arItem["ID"] == "5933")
                            //arshow($arItem["PROPERTIES"]["spec_price"]);
                            $pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>142, 'height'=>210), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                            foreach ($arItem["PRICES"] as $code => $arPrice)
                            {
                            ?>
                            <li>
                                <div class="categoryBooks">
                                    <?//arshow($arItem["DETAIL_PICTURE"]);?>
                                    <div class="sect_badge">
                                        <? if (/*($SavingsDiscount > 0) && */($arItem["PROPERTIES"]["discount_ban"]["VALUE"] != "Y") && $arItem['PROPERTIES']['spec_price']['VALUE'] )
                                            {
                                                switch ($arItem['PROPERTIES']['spec_price']['VALUE'])
                                                {
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
                                    <?
                                        $dbBasketItems = CSaleBasket::GetList(array(), array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL", "PRODUCT_ID" => $arItem["ID"]), false, false, array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "PRODUCT_PROVIDER_CLASS"))->Fetch();

                                        $curr_author = CIBlockElement::GetByID($arItem["PROPERTIES"]["AUTHORS"]["VALUE"][0]) -> Fetch();
                                    ?>
                                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                        <div class="section_item_img">
                                            <?
                                            if ($pict["src"])
                                            {
                                            ?>
                                                <img src=<?=$pict["src"]?>>
                                            <?
                                            }
                                            else
                                            {
                                            ?>
                                                <img src="/images/no_photo.png" width="142" height="142">
                                            <?
                                            }
                                            ?>
                                        </div>
                                        <p class="nameBook" title="<?=$arItem["NAME"]?>"><?=$arItem["NAME"]?></p>
                                        <p class="bookAutor"><?=$curr_author["NAME"]?></p>
                                        <p class="tapeOfPack"><?=$arItem["PROPERTIES"]["COVER_TYPE"]["VALUE"]?></p>
                                        <?
                                        if (intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != 22 && intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != 23)
                                        {

                                            if ($arPrice["DISCOUNT_VALUE_VAT"])
                                            {
                                            ?>
                                                <p class="priceOfBook"><?=ceil($arPrice["DISCOUNT_VALUE_VAT"])?> <span>руб.</span></p>
                                            <?
                                            }
                                            else
                                            {
                                            ?>
                                                <p class="priceOfBook"><?=ceil($arPrice["ORIG_VALUE_VAT"])?> <span>руб.</span></p>
                                            <?
                                            }
                                            ?>
                                        </a>
                                            <?if ($dbBasketItems["QUANTITY"] == 0) {?>
                                                <a class="product<?=$arItem["ID"];?>" href="<?echo $arItem["ADD_URL"]?>" onclick="addtocart(<?= $arResult["ID"]; ?>, '<?= $arResult["NAME"]; ?>', '<?= $arResult["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]?>'); return false;">
                                                    <?if(intval ($arResult["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != getXMLIDByCode (CATALOG_IBLOCK_ID, "STATE", "soon")) {?>
                                                        <p class="basketBook"><?=GetMessage("ADD_IN_BASKET")?></p>
                                                    <?} else {?>
                                                        <p class="basketBook"><?=GetMessage("ADD_TO_PREORDER")?></p>
                                                    <?}?>
                                                </a>
                                            <?} else {?>
                                                <a class="product<?=$arItem["ID"];?>" href="/personal/cart/"><p class="basketBook" style="background-color: #A9A9A9;color: white;">Оформить</p></a>
                                            <?}
                                        }
                                        else if (intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) == 23)
                                        {?>
                                            <p class="priceOfBook"><?=$arItem["PROPERTIES"]["STATE"]["VALUE"]?></p>
                                            </a>
                                        <?}
                                        else
                                        {?>
                                            <p class="priceOfBook"><?=$arItem["PROPERTIES"]["SOON_DATE_TIME"]["VALUE"]?></p>
                                            </a>
                                        <?}
                                    ?>
                                    <?
                                        if ($USER -> IsAuthorized())
                                        {
                                        ?>
                                        <p class="basketLater" id="<?=$arItem["ID"]?>">Куплю позже</p>
                                        <?
                                        }
                                    ?>
                                </div>
                            </li>
                            <?      //}
                            }
                    }?>
                </ul>

            </div>
            <div class="wishlist_info">
                <div class="CloseWishlist"><img src="/img/catalogLeftClose.png"></div>
                <span></span>
            </div>





            <?if (($arResult["NAV_RESULT"]->NavPageCount) > 1)
                {?>
                <p class="showMore">Показать ещё</p>
                <?}?>
        </div>





        <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list",
                "section.left.tree",
                array(
                    "IBLOCK_TYPE" => "catalog",
                    "IBLOCK_ID" => "4",
                    "SECTION_ID" => "",
                    "SECTION_CODE" => "",
                    "COUNT_ELEMENTS" => "N",
                    "TOP_DEPTH" => "2",
                    "IBLOCK_HEADER_TITLE" => "Каталог книг",
                    "IBLOCK_HEADER_LINK" => "",
                    "SECTION_URL" => "#SITE_DIR#/catalog/#SECTION_CODE#/",
                    "CACHE_TYPE" => "A",
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

<?//arshow($arResult, true);?>


<script>
    // скрипт ajax-подгрузки товаров в блоке "Все книги"
    $(document).ready(function() {
        <?$navnum = $arResult["NAV_RESULT"]->NavNum;?>
        <?if (isset($_REQUEST["PAGEN_".$navnum])) {
           ?>
            var page = <?=$_REQUEST["PAGEN_".$navnum]?> + 1;
            <?}else{?>
            var page = 2;
            <?}?>
        var maxpage = <?=($arResult["NAV_RESULT"]->NavPageCount)?>;
        $('.showMore').click(function(){
           // var otherBooks = $(this).siblings(".otherBooks");
            $.fancybox.showLoading();
            <?
            if ($_REQUEST["SORT"])
            {
            ?>
                $.get(window.location.href+'&PAGEN_<?=$navnum?>='+page, function(data) {
                    var next_page = $('.otherBooks ul li', data);
                    //$('.catalogBooks').append('<br /><h3>Страница '+ page +'</h3><br />');
                    $('.otherBooks ul').append(next_page);
                    page++;
                })
            <?
            }
            else
            {?>
                $.get('<?=$arResult["SECTION_PAGE_URL"]?>?PAGEN_<?=$navnum?>='+page, function(data) {
                    var next_page = $('.otherBooks ul li', data);
                    //$('.catalogBooks').append('<br /><h3>Страница '+ page +'</h3><br />');
                    $('.otherBooks ul').append(next_page);
                    page++;
                })
            <?
            }
            ?>
            .done(function()
                {
                    $.fancybox.hideLoading();
                    $(".nameBook").each(function()
                        {
                            if($(this).length > 0)
                            {
                                $(this).html(truncate($(this).html(), 40));
                            }
                    });
                    var otherBooksHeight = 1190 * ($(".otherBooks ul li").length / 15);
                    //var categorHeight = 2750 + 1190 * (($(".otherBooks ul li").length - 15) / 15);
                    var categorHeight = 2350 + Math.ceil(($(".otherBooks ul li").length - 15) / 5) * 400;
                    $(".otherBooks").css("height", otherBooksHeight+"px");
                    $(".wrapperCategor").css("height", categorHeight+"px");
                    $(".contentWrapp").css("height", categorHeight-10+"px");
            });
            if (page == maxpage) {
                $('.showMore').hide();
                //$('.phpages').hide();
            }
            return false;

        });

        <?
            if (!$USER -> IsAuthorized())
            {
            ?>
            $(".categoryWrapper .categoryBooks").hover(function(){
                $(this).css("height", "390px");
            });
            <?
            }
        ?>
    });
</script>