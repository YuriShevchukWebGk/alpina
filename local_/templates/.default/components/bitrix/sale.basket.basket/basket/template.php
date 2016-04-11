<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
    /** @var CBitrixBasketComponent $component */
    $curPage = $APPLICATION->GetCurPage().'?'.$arParams["ACTION_VARIABLE"].'=';
    $arUrls = array(
        //"delete" => $curPage."delete&id=#ID#",
        "delete" => "/personal/cart/?".$arParams["ACTION_VARIABLE"]."=delete&id=#ID#",
        "delay" => $curPage."delay&id=#ID#",
        "add" => $curPage."add&id=#ID#",
    );
    unset($curPage);

    $arBasketJSParams = array(
        'SALE_DELETE' => GetMessage("SALE_DELETE"),
        'SALE_DELAY' => GetMessage("SALE_DELAY"),
        'SALE_TYPE' => GetMessage("SALE_TYPE"),
        'TEMPLATE_FOLDER' => $templateFolder,
        'DELETE_URL' => $arUrls["delete"],
        'DELAY_URL' => $arUrls["delay"],
        'ADD_URL' => $arUrls["add"]
    );
?>

<div class="breadCrumpWrap">
    <div class="centerWrapper">
        <p><a href="/personal/cart/" class="afterImg active">Корзина</a><a href="javascript:void(0)" onclick="checkOut();" class="afterImg">Оформление</a><a href="#">Завершение</a></p>
    </div>
</div>



<div class="cartWrapper">
    <div class="centerWrapper">         

        <script type="text/javascript">
            var basketJSParams = <?=CUtil::PhpToJSObject($arBasketJSParams);?>
        </script>
        <?
            $APPLICATION->AddHeadScript($templateFolder."/script.js");
            
            if($arParams['USE_GIFTS'] == 'Y')
            {   
                $APPLICATION->IncludeComponent(
                    "bitrix:sale.gift.basket",
                    "basket_gifts",
                    array(
                        "SHOW_PRICE_COUNT" => 1,
                        "PRODUCT_SUBSCRIPTION" => 'N',
                        'PRODUCT_ID_VARIABLE' => 'id',
                        "PARTIAL_PRODUCT_PROPERTIES" => 'N',
                        "USE_PRODUCT_QUANTITY" => 'N',
                        "ACTION_VARIABLE" => "actionGift",
                        "ADD_PROPERTIES_TO_BASKET" => "Y",

                        "BASKET_URL" => $APPLICATION->GetCurPage(),
                        "APPLIED_DISCOUNT_LIST" => $arResult["APPLIED_DISCOUNT_LIST"],
                        "FULL_DISCOUNT_LIST" => $arResult["FULL_DISCOUNT_LIST"],

                        "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_SHOW_VALUE"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],

                        'BLOCK_TITLE' => $arParams['GIFTS_BLOCK_TITLE'],
                        'HIDE_BLOCK_TITLE' => $arParams['GIFTS_HIDE_BLOCK_TITLE'],
                        'TEXT_LABEL_GIFT' => $arParams['GIFTS_TEXT_LABEL_GIFT'],
                        'PRODUCT_QUANTITY_VARIABLE' => $arParams['GIFTS_PRODUCT_QUANTITY_VARIABLE'],
                        'PRODUCT_PROPS_VARIABLE' => $arParams['GIFTS_PRODUCT_PROPS_VARIABLE'],
                        'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
                        'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
                        'SHOW_NAME' => $arParams['GIFTS_SHOW_NAME'],
                        'SHOW_IMAGE' => $arParams['GIFTS_SHOW_IMAGE'],
                        'MESS_BTN_BUY' => $arParams['GIFTS_MESS_BTN_BUY'],
                        'MESS_BTN_DETAIL' => $arParams['GIFTS_MESS_BTN_DETAIL'],
                        'PAGE_ELEMENT_COUNT' => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],
                        'CONVERT_CURRENCY' => $arParams['GIFTS_CONVERT_CURRENCY'],
                        'HIDE_NOT_AVAILABLE' => $arParams['GIFTS_HIDE_NOT_AVAILABLE'],

                        "LINE_ELEMENT_COUNT" => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],
                    ),
                    false
                );
            }

        ?>

        <div class="cartMenuWrap">
            <div class="basketItems active" data-id="1"><p>Готовые к заказу <span>(<?=count($arResult["ITEMS"]["AnDelCanBuy"])?>)</span></p></div>
            <div class="basketItems" data-id="2"><p>Список желаний <span>(0)</span></p></div>
        </div>

        <?
            if (strlen($arResult["ERROR_MESSAGE"]) <= 0)
            {
            ?>


            <div id="warning_message">
                <?
                    if (!empty($arResult["WARNING_MESSAGE"]) && is_array($arResult["WARNING_MESSAGE"]))
                    {
                        foreach ($arResult["WARNING_MESSAGE"] as $v)
                            ShowError($v);
                    }
                ?>
            </div>

            <?

                $normalCount = count($arResult["ITEMS"]["AnDelCanBuy"]);
                $normalHidden = ($normalCount == 0) ? 'style="display:none;"' : '';

                $delayCount = count($arResult["ITEMS"]["DelDelCanBuy"]);
                $delayHidden = ($delayCount == 0) ? 'style="display:none;"' : '';

                $subscribeCount = count($arResult["ITEMS"]["ProdSubscribe"]);
                $subscribeHidden = ($subscribeCount == 0) ? 'style="display:none;"' : '';

                $naCount = count($arResult["ITEMS"]["nAnCanBuy"]);
                $naHidden = ($naCount == 0) ? 'style="display:none;"' : '';

            ?>
            <form method="post" action="<?=POST_FORM_ACTION_URI?>" name="basket_form" id="basket_form">     

                <div id="basket_form_container">
                    <div class="bx_ordercart">     

                        <?
                            include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items.php");
                        ?>     

                        <div class="yourBooks" id="cardBlock2">
                            <?//здесь wishlist?>
                            <?
                                /*$WishFilter = array ("ID" => array());
                                if ($_REQUEST["list"])
                                {
                                $el_list = CIBlockElement::GetList (array(), array("IBLOCK_ID" => 17, "NAME" => $_REQUEST["list"]), false, false, array("ID"));
                                while ($el_fetch = $el_list -> Fetch())
                                {
                                $WishFilter["ID"][] = $el_fetch["ID"];
                                }
                                }
                                else
                                { 
                                $el_list = CIBlockElement::GetList (array(), array("IBLOCK_ID" => 17, "NAME" => $USER -> GetID()), false, false, array("ID"));
                                while ($el_fetch = $el_list -> Fetch())
                                {
                                $WishFilter["ID"][] = $el_fetch["ID"];
                                }
                                }
                                arshow($WishFilter);*/
                                $uID = $USER -> GetID();
                                
                                if ($_REQUEST["list"]) {
                                    $list_user = CUser::GetByID($_REQUEST["list"]) -> Fetch();
                                    $list_user_name = $list_user["NAME"]." ".$list_user["LAST_NAME"];
                                }
                                else {
                                    $list_user = CUser::GetByID($uID) -> Fetch();
                                    $list_user_name = $list_user["NAME"]." ".$list_user["LAST_NAME"];   
                                }
                                
                                global $WishFilter;
                                $WishFilter["NAME"] = $list_user_name;
                                $APPLICATION->IncludeComponent(
                                    "bitrix:catalog.section", 
                                    "wish_list", 
                                    array(
                                        "IBLOCK_TYPE_ID" => "catalog",
                                        "IBLOCK_ID" => "17",
                                        "BASKET_URL" => "/personal/cart/",
                                        "COMPONENT_TEMPLATE" => "wish_list",
                                        "IBLOCK_TYPE" => "wishlist",
                                        "SECTION_ID" => $_REQUEST["SECTION_ID"],
                                        "SECTION_CODE" => "",
                                        "SECTION_USER_FIELDS" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "ELEMENT_SORT_FIELD" => "id",
                                        "ELEMENT_SORT_ORDER" => "desc",
                                        "ELEMENT_SORT_FIELD2" => "id",
                                        "ELEMENT_SORT_ORDER2" => "desc",
                                        "FILTER_NAME" => "WishFilter",
                                        "INCLUDE_SUBSECTIONS" => "Y",
                                        "SHOW_ALL_WO_SECTION" => "N",
                                        "HIDE_NOT_AVAILABLE" => "N",
                                        "PAGE_ELEMENT_COUNT" => "18",
                                        "LINE_ELEMENT_COUNT" => "6",
                                        "PROPERTY_CODE" => array(
                                            0 => "PRODUCTS",
                                            1 => "",
                                        ),
                                        "OFFERS_FIELD_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "OFFERS_PROPERTY_CODE" => array(
                                            0 => "COLOR_REF",
                                            1 => "SIZES_SHOES",
                                            2 => "SIZES_CLOTHES",
                                            3 => "",
                                        ),
                                        "OFFERS_SORT_FIELD" => "sort",
                                        "OFFERS_SORT_ORDER" => "desc",
                                        "OFFERS_SORT_FIELD2" => "id",
                                        "OFFERS_SORT_ORDER2" => "desc",
                                        "OFFERS_LIMIT" => "5",
                                        "TEMPLATE_THEME" => "site",
                                        "PRODUCT_DISPLAY_MODE" => "Y",
                                        "ADD_PICT_PROP" => "-",
                                        "LABEL_PROP" => "-",
                                        "OFFER_ADD_PICT_PROP" => "-",
                                        "OFFER_TREE_PROPS" => array(
                                            0 => "COLOR_REF",
                                            1 => "SIZES_SHOES",
                                            2 => "SIZES_CLOTHES",
                                        ),
                                        "PRODUCT_SUBSCRIPTION" => "N",
                                        "SHOW_DISCOUNT_PERCENT" => "N",
                                        "SHOW_OLD_PRICE" => "Y",
                                        "SHOW_CLOSE_POPUP" => "N",
                                        "MESS_BTN_BUY" => "Купить",
                                        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                                        "MESS_BTN_SUBSCRIBE" => "Подписаться",
                                        "MESS_BTN_DETAIL" => "Подробнее",
                                        "MESS_NOT_AVAILABLE" => "Нет в наличии",
                                        "SECTION_URL" => "",
                                        "DETAIL_URL" => "",
                                        "SECTION_ID_VARIABLE" => "SECTION_ID",
                                        "SEF_MODE" => "N",
                                        "AJAX_MODE" => "N",
                                        "AJAX_OPTION_JUMP" => "N",
                                        "AJAX_OPTION_STYLE" => "Y",
                                        "AJAX_OPTION_HISTORY" => "N",
                                        "AJAX_OPTION_ADDITIONAL" => "",
                                        "CACHE_TYPE" => "A",
                                        "CACHE_TIME" => "36000000",
                                        "CACHE_GROUPS" => "N",
                                        "SET_TITLE" => "Y",
                                        "SET_BROWSER_TITLE" => "Y",
                                        "BROWSER_TITLE" => "-",
                                        "SET_META_KEYWORDS" => "Y",
                                        "META_KEYWORDS" => "-",
                                        "SET_META_DESCRIPTION" => "Y",
                                        "META_DESCRIPTION" => "-",
                                        "SET_LAST_MODIFIED" => "N",
                                        "USE_MAIN_ELEMENT_SECTION" => "N",
                                        "ADD_SECTIONS_CHAIN" => "N",
                                        "CACHE_FILTER" => "N",
                                        "ACTION_VARIABLE" => "action",
                                        "PRODUCT_ID_VARIABLE" => "id",
                                        "PRICE_CODE" => array(
                                            0 => "BASE",
                                        ),
                                        "USE_PRICE_COUNT" => "N",
                                        "SHOW_PRICE_COUNT" => "1",
                                        "PRICE_VAT_INCLUDE" => "Y",
                                        "CONVERT_CURRENCY" => "N",
                                        "USE_PRODUCT_QUANTITY" => "N",
                                        "PRODUCT_QUANTITY_VARIABLE" => "",
                                        "ADD_PROPERTIES_TO_BASKET" => "Y",
                                        "PRODUCT_PROPS_VARIABLE" => "prop",
                                        "PARTIAL_PRODUCT_PROPERTIES" => "N",
                                        "PRODUCT_PROPERTIES" => array(
                                        ),
                                        "OFFERS_CART_PROPERTIES" => array(
                                            0 => "COLOR_REF",
                                            1 => "SIZES_SHOES",
                                            2 => "SIZES_CLOTHES",
                                        ),
                                        "ADD_TO_BASKET_ACTION" => "ADD",
                                        "PAGER_TEMPLATE" => "round",
                                        "DISPLAY_TOP_PAGER" => "N",
                                        "DISPLAY_BOTTOM_PAGER" => "Y",
                                        "PAGER_TITLE" => "Товары",
                                        "PAGER_SHOW_ALWAYS" => "N",
                                        "PAGER_DESC_NUMBERING" => "N",
                                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                        "PAGER_SHOW_ALL" => "N",
                                        "PAGER_BASE_LINK_ENABLE" => "N",
                                        "SET_STATUS_404" => "N",
                                        "SHOW_404" => "N",
                                        "MESSAGE_404" => "",
                                        "BACKGROUND_IMAGE" => "-",
                                        "DISABLE_INIT_JS_IN_COMPONENT" => "N"
                                    ),
                                    false
                                );?>
                        </div>
                        <p class="nextPageWrap"><a href="javascript:void(0)" onclick="checkOut();" class="nextPage"><?=GetMessage("SALE_ORDER")?></a></p> 

                    </div>
                </div>                       

                <input type="hidden" name="BasketOrder" value="BasketOrder" />
                <!-- <input type="hidden" name="ajax_post" id="ajax_post" value="Y"> -->
            </form>
            
            <script type="text/javascript">
                dataLayer.push({
                    'ecommerce': {
                        'checkout': {
                            'actionField': {'step':1},
                            'products': [
                                <?foreach($_SESSION['gtmEnchECommerceCheckout'] as $googleItem){?>
                                    {
                                        <?=$googleItem?>
                                    },
                                <?}?>
                            ]
                        }
                    }
                });

            </script>            

            <?
            }
            else
            {
            ?>
            <form method="post" action="<?=POST_FORM_ACTION_URI?>" name="basket_form" id="basket_form">     

                <div id="basket_form_container">
                <div class="bx_ordercart">
                    <div id="basket_items_list">              
                        <div class="yourBooks" id="cardBlock1">
                            <?
                                ShowError($arResult["ERROR_MESSAGE"]);
                            ?>
                        </div>

                        <div class="yourBooks" id="cardBlock2">
                            <?//здесь wishlist?>
                            <?
                                /*$WishFilter = array ("ID" => array());
                                if ($_REQUEST["list"])
                                {
                                $el_list = CIBlockElement::GetList (array(), array("IBLOCK_ID" => 17, "NAME" => $_REQUEST["list"]), false, false, array("ID"));
                                while ($el_fetch = $el_list -> Fetch())
                                {
                                $WishFilter["ID"][] = $el_fetch["ID"];
                                }
                                }
                                else
                                { 
                                $el_list = CIBlockElement::GetList (array(), array("IBLOCK_ID" => 17, "NAME" => $USER -> GetID()), false, false, array("ID"));
                                while ($el_fetch = $el_list -> Fetch())
                                {
                                $WishFilter["ID"][] = $el_fetch["ID"];
                                }
                                }
                                arshow($WishFilter);*/
                                $uID = $USER -> GetID();
                                
                                if ($_REQUEST["list"]) {
                                    $list_user = CUser::GetByID($_REQUEST["list"]) -> Fetch();
                                    $list_user_name = $list_user["NAME"]." ".$list_user["LAST_NAME"];
                                }
                                else {
                                    $list_user = CUser::GetByID($uID) -> Fetch();
                                    $list_user_name = $list_user["NAME"]." ".$list_user["LAST_NAME"];   
                                }
                                
                                global $WishFilter;
                                $WishFilter["NAME"] = $list_user_name;
                                
                                $APPLICATION->IncludeComponent(
                                    "bitrix:catalog.section", 
                                    "wish_list", 
                                    array(
                                        "IBLOCK_TYPE_ID" => "catalog",
                                        "IBLOCK_ID" => "17",
                                        "BASKET_URL" => "/personal/cart/",
                                        "COMPONENT_TEMPLATE" => "wish_list",
                                        "IBLOCK_TYPE" => "wishlist",
                                        "SECTION_ID" => $_REQUEST["SECTION_ID"],
                                        "SECTION_CODE" => "",
                                        "SECTION_USER_FIELDS" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "ELEMENT_SORT_FIELD" => "id",
                                        "ELEMENT_SORT_ORDER" => "desc",
                                        "ELEMENT_SORT_FIELD2" => "id",
                                        "ELEMENT_SORT_ORDER2" => "desc",
                                        "FILTER_NAME" => "WishFilter",
                                        "INCLUDE_SUBSECTIONS" => "Y",
                                        "SHOW_ALL_WO_SECTION" => "N",
                                        "HIDE_NOT_AVAILABLE" => "N",
                                        "PAGE_ELEMENT_COUNT" => "18",
                                        "LINE_ELEMENT_COUNT" => "6",
                                        "PROPERTY_CODE" => array(
                                            0 => "PRODUCTS",
                                            1 => "",
                                        ),
                                        "OFFERS_FIELD_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "OFFERS_PROPERTY_CODE" => array(
                                            0 => "COLOR_REF",
                                            1 => "SIZES_SHOES",
                                            2 => "SIZES_CLOTHES",
                                            3 => "",
                                        ),
                                        "OFFERS_SORT_FIELD" => "sort",
                                        "OFFERS_SORT_ORDER" => "desc",
                                        "OFFERS_SORT_FIELD2" => "id",
                                        "OFFERS_SORT_ORDER2" => "desc",
                                        "OFFERS_LIMIT" => "5",
                                        "TEMPLATE_THEME" => "site",
                                        "PRODUCT_DISPLAY_MODE" => "Y",
                                        "ADD_PICT_PROP" => "-",
                                        "LABEL_PROP" => "-",
                                        "OFFER_ADD_PICT_PROP" => "-",
                                        "OFFER_TREE_PROPS" => array(
                                            0 => "COLOR_REF",
                                            1 => "SIZES_SHOES",
                                            2 => "SIZES_CLOTHES",
                                        ),
                                        "PRODUCT_SUBSCRIPTION" => "N",
                                        "SHOW_DISCOUNT_PERCENT" => "N",
                                        "SHOW_OLD_PRICE" => "Y",
                                        "SHOW_CLOSE_POPUP" => "N",
                                        "MESS_BTN_BUY" => "Купить",
                                        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                                        "MESS_BTN_SUBSCRIBE" => "Подписаться",
                                        "MESS_BTN_DETAIL" => "Подробнее",
                                        "MESS_NOT_AVAILABLE" => "Нет в наличии",
                                        "SECTION_URL" => "",
                                        "DETAIL_URL" => "",
                                        "SECTION_ID_VARIABLE" => "SECTION_ID",
                                        "SEF_MODE" => "N",
                                        "AJAX_MODE" => "N",
                                        "AJAX_OPTION_JUMP" => "N",
                                        "AJAX_OPTION_STYLE" => "Y",
                                        "AJAX_OPTION_HISTORY" => "N",
                                        "AJAX_OPTION_ADDITIONAL" => "",
                                        "CACHE_TYPE" => "A",
                                        "CACHE_TIME" => "36000000",
                                        "CACHE_GROUPS" => "N",
                                        "SET_TITLE" => "Y",
                                        "SET_BROWSER_TITLE" => "Y",
                                        "BROWSER_TITLE" => "-",
                                        "SET_META_KEYWORDS" => "Y",
                                        "META_KEYWORDS" => "-",
                                        "SET_META_DESCRIPTION" => "Y",
                                        "META_DESCRIPTION" => "-",
                                        "SET_LAST_MODIFIED" => "N",
                                        "USE_MAIN_ELEMENT_SECTION" => "N",
                                        "ADD_SECTIONS_CHAIN" => "N",
                                        "CACHE_FILTER" => "N",
                                        "ACTION_VARIABLE" => "action",
                                        "PRODUCT_ID_VARIABLE" => "id",
                                        "PRICE_CODE" => array(
                                            0 => "BASE",
                                        ),
                                        "USE_PRICE_COUNT" => "N",
                                        "SHOW_PRICE_COUNT" => "1",
                                        "PRICE_VAT_INCLUDE" => "Y",
                                        "CONVERT_CURRENCY" => "N",
                                        "USE_PRODUCT_QUANTITY" => "N",
                                        "PRODUCT_QUANTITY_VARIABLE" => "",
                                        "ADD_PROPERTIES_TO_BASKET" => "Y",
                                        "PRODUCT_PROPS_VARIABLE" => "prop",
                                        "PARTIAL_PRODUCT_PROPERTIES" => "N",
                                        "PRODUCT_PROPERTIES" => array(
                                        ),
                                        "OFFERS_CART_PROPERTIES" => array(
                                            0 => "COLOR_REF",
                                            1 => "SIZES_SHOES",
                                            2 => "SIZES_CLOTHES",
                                        ),
                                        "ADD_TO_BASKET_ACTION" => "ADD",
                                        "PAGER_TEMPLATE" => "round",
                                        "DISPLAY_TOP_PAGER" => "N",
                                        "DISPLAY_BOTTOM_PAGER" => "Y",
                                        "PAGER_TITLE" => "Товары",
                                        "PAGER_SHOW_ALWAYS" => "N",
                                        "PAGER_DESC_NUMBERING" => "N",
                                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                        "PAGER_SHOW_ALL" => "N",
                                        "PAGER_BASE_LINK_ENABLE" => "N",
                                        "SET_STATUS_404" => "N",
                                        "SHOW_404" => "N",
                                        "MESSAGE_404" => "",
                                        "BACKGROUND_IMAGE" => "-",
                                        "DISABLE_INIT_JS_IN_COMPONENT" => "N"
                                    ),
                                    false
                                );?>
                        </div>
                    </div>
                </div>
            </form>
            <?
            }
        ?>


    </div>
</div>
<script>
$(document).ready(function(){
    
    <?
    if ($_REQUEST["action"])
    {
    ?>  
        $(".cartMenuWrap .basketItems:first-child").removeClass("active");
        $('.cartMenuWrap .basketItems:nth-child(2)').addClass("active");
        $("#cardBlock2").show();
    <?
    }
    else if (!$_REQUEST["liked"])
    {
    ?> 
        $('.cartMenuWrap .basketItems:nth-child(2)').removeClass("active");
        $('.cartMenuWrap .basketItems:first-child').addClass("active");
        $("#cardBlock1").show();
    <?
    }
    ?>   
})
</script>