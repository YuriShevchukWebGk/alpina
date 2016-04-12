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

<div class="authorWrap">
    <div class="titleWrap">
        <div class="catalogWrapper">
            <p class="breadCrump"><a href="/"><span>Главная /</span></a><a href="/authors"><span> Алфавитный указатель авторов /</span></a><span> <?=substr($arResult["PROPERTIES"]["LAST_NAME"]["VALUE"], 0, 1);?></span></p>
            <p class="mainTitle"><?=$arResult["NAME"]?></p>
        </div>
    </div>
    <div class="content">
        <div class="catalogWrapper">
            <div class="autorInfo">
                <div class="autorPhoto">
                    <?
                    if ($arResult["DETAIL_PICTURE"]["SRC"])
                    {
                    ?>
                        <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">
                    <?
                    }
                    else
                    {
                    ?>
                        <img src="/images/no_photo.png" width="200">
                    <?
                    }
                    ?>
                </div>    
                <div class='events'>
                    <?/*?>
                        <p>Мероприятия автора</p>
                        <?
                        $events_list = CIBlockElement::GetList (array("DATE_INSERT" => "DESC"), array("IBLOCK_ID" => 40), false, false, array("ID", "NAME", "DATE_INSERT"));
                        while ($events = $events_list -> Fetch())
                        {
                        ?>
                        <div class="event">
                        <p class="date"><?=$events["DATE_INSERT"]?></p>
                        <p><?=$events["NAME"]?></p>
                        </div>
                        <?
                        }
                        ?>
                        <p class="allEvents">Все мероприятия</p>
                    <?*/?>
                    <?$APPLICATION->IncludeComponent(
                            "bitrix:news.list", 
                            "events_small_block", 
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
                                "COMPONENT_TEMPLATE" => "events_small_block",
                                "DETAIL_URL" => "/events/#ID#/",
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
                                "IBLOCK_ID" => "40",
                                "IBLOCK_TYPE" => "events",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                                "INCLUDE_SUBSECTIONS" => "Y",
                                "MESSAGE_404" => "",
                                "NEWS_COUNT" => "4",
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
                                "SET_TITLE" => "N",
                                "SHOW_404" => "N",
                                "SORT_BY1" => "ACTIVE_FROM",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER1" => "DESC",
                                "SORT_ORDER2" => "ASC"
                            ),
                            false
                        );?>
                </div>
            </div>
            <div class="textWrap">
                <?/*?>
                    <p class="citation">"Когда я покинул Стоу в 1967 году в возрасте неполных семнадцати лет, напутствующими словани директора были: "Поздравляю, Брэнсон. Я предсказываю, что ты или отправишься в тюрьму, или станешь миллионером"</p>
                    <p class="autorName">ричард брэнсон</p>    
                    <p class="title">Ранние годы</p>
                    <p class="text">Брэнсон начал свой первый бизнес, связанный с звукозаписями, после путешествия по Ла- Маншу и приобретения на распродаже коробок с записями, помеченными как бракованные. Он продал эти записи, развозя их на собственной машине по розничным точкам Лондона. В 1970 году он продолжил продавать бракованные записи по почтовой рассылке. Торгуя под именем Virgin, он продал записей немногим меньше, чем магазины на центральной улице. Имя Virgin было отправной точкой, потому что записи продавались по новым условиям 
                    (в отличие от других магазинов, где записи были недоступны для прослушивания в будке). </p>
                    <p class="title">Бизнес-начинания</p>
                    <p class="text">Брэнсон создал Virgin Atlantic Airways в 1984 году, запустил Virgin Mobile в 1999 году, Virgin 
                    Blue в Австралии — в 2000 году, а затем потерпел неудачу в 2000 году в предложении о 
                    покупке National Lottery.</p>
                    <p class="text">В 1997 году Брэнсон взялся за то, что большинству казалось одним из его рискованных бизнес- начинаний, войдя в железнодорожный бизнес. Компания Virgin Trains выиграла франшизы 
                    на создание секторов железной дороги в пересеченной сельской местности Intercity и West Coast в системе железной дороги компании British Rail. Вскоре у Virgin Trains начались проблемы с подвижными составами и инфраструктурой, унаследованной от British Rail.</p>
                    <p class="text">Virgin приобрела в 1996 году европейскую авиакомпанию-перевозчика на короткие расстояния Euro Belgian Airlines и переименовала её в Virgin Express. В 2006 году авиалиния была объединена с SN Brussels Airlines, бывшей Sabena. Объединённая компания получила название Brussels Airlines. Она также основала национальную авиалинию, находящуюся в Нигерии, названную Virgin Nigeria. Ещё одна компания, Virgin America, начала вылеты из аэропорта San Francisco International Airport в августе 2007 года. Брэнсон также разработал бренд Virgin Cola и даже Virgin Vodka, которые не были особенно успешными начинаниями. </p>
                <?*/?>
                <?=$arResult["DETAIL_TEXT"]?>
            </div>
        </div>    
    </div>
</div>


<?
    global $ThisAuthorFilter;
    $ThisAuthorFilter = array("PROPERTY_AUTHORS" => $arResult["ID"]);
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section", 
        "author_page_books", 
        array(
            "IBLOCK_TYPE_ID" => "catalog",
            "IBLOCK_ID" => "4",
            "BASKET_URL" => "/personal/cart/",
            "COMPONENT_TEMPLATE" => "author_page_books",
            "IBLOCK_TYPE" => "catalog",
            "SECTION_ID" => "",
            "SECTION_CODE" => "",
            "SECTION_USER_FIELDS" => array(
                0 => "",
                1 => "",
            ),
            "ELEMENT_SORT_FIELD" => "id",
            "ELEMENT_SORT_ORDER" => "desc",
            "ELEMENT_SORT_FIELD2" => "id",
            "ELEMENT_SORT_ORDER2" => "desc",
            "FILTER_NAME" => "ThisAuthorFilter",
            "INCLUDE_SUBSECTIONS" => "Y",
            "SHOW_ALL_WO_SECTION" => "Y",
            "HIDE_NOT_AVAILABLE" => "N",
            "PAGE_ELEMENT_COUNT" => "18",
            "LINE_ELEMENT_COUNT" => "6",
            "PROPERTY_CODE" => array(
                0 => "",
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
            "SET_TITLE" => "N",
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
    );
?>