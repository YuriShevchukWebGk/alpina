<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    /** @var array $arResult["ORIGINAL_PARAMETERS"] */
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
<?if ($_REQUEST["DIRECTION"] == "DESC") {?>
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
<style>
.wrapperCategor, .categoryWrapper .contentWrapp {height:auto;}
</style>
<?
$navnum = $arResult["NAV_RESULT"]->NavNum;
if ($_REQUEST["PAGEN_" . $navnum]) {
    //$_SESSION[$APPLICATION -> GetCurDir()] = $_REQUEST["PAGEN_" . $navnum];
}
if($arResult["ID"] == SECTION_ID_FOR_CHILDREN){
    $for_chyldren = "";
}
$for_chyldren = false;
$is_bot_detected = false;
if (isset($_SERVER["HTTP_USER_AGENT"]) && preg_match('/bot|crawl|slurp|spider|mediapartners/i', $_SERVER['HTTP_USER_AGENT'])) {
    $is_bot_detected = true;
}?>

<div class="socServiceWrap">
    <p>Мы в соцсетях</p>
    <ul>
        <li>
            <a href="https://www.instagram.com/alpinadeti/" target="_blank" class="socServiceRound socServiceInstagram"><img src="/img/instagram-icon-good.png"></a>
        </li>
        <li>
            <a href="https://vk.com/alpinadeti"             target="_blank" class="socServiceRound socServiceVK"><img src="/img/vk-white.png"></a>
        </li>
        <li>
            <a href="https://www.facebook.com/alpinadeti/"  target="_blank" class="socServiceRound socServiceFacebook"><img src="/img/facebook-logo-png-white-i6.png"></a>
        </li>
    </ul>
</div>

<div class="wrapperCategor forChildrenWrapper">
    <div class="categoryWrapper">
        <div class="catalogIcon">
        </div>
        <div class="basketIcon">
        </div>
        <div class="contentWrapp">
            <p class="breadCrump no-mobile" itemprop="breadcrumb" itemscope="" itemtype="https://schema.org/BreadcrumbList">
                <span itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                    <a href="/" title="Книги Альпина" itemprop="item">
                        <span itemprop="name">Книги Альпина</span>
                    </a>
                    <meta itemprop="position" content="1">
                </span>
                <?
                $num = 2;
                $navChain = CIBlockSection::GetNavChain(4, $arResult["ID"]);
                $stopNum = $navChain->nSelectedCount + 1;
                while ($arNav = $navChain->GetNext()) {?>
                <span itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                    <span class="gap"></span>
                    <?if ($num != $stopNum) {?>
                        <a href="/catalog<?=$arNav[SECTION_PAGE_URL]?>" title="<?=$arNav[NAME]?>" itemprop="item">
                    <?}?>
                        <span itemprop="name"><?=$arNav[NAME]?></span>
                    <?if ($num != $stopNum) {?>
                        </a>
                    <?}?>
                    <meta itemprop="position" content="<?=$num?>">
                </span>
                <?
                $num++;
                }?>
            </p>
            <div itemprop="mainEntity" itemscope itemtype="http://schema.org/OfferCatalog">
                <link itemprop="url" href="<?=$_SERVER['REQUEST_URI']?>"/>
                <img src="/img/for_children/alpina_children_logo.svg" class="alpinaChildrenLogo">
                <h1 itemprop="name">
                    <?= $arResult["NAME"];?>
                </h1>
                <?
                $arData = array();
                $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL");
                $arFilter = Array("IBLOCK_ID" => 80, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_THIS_SECTION" => $arResult["ID"]);
                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                while($ob = $res->GetNextElement()) {
                    $arData[] = $ob->GetFields();
                }
                if(count($arData) > 0) {?>
                    <div class="doner_tags">
                        <span>Популярные категории</span>
                        <a href="/catalog/new/?SORT=NEW&FILTER=for_kids_and_parents">Новинки</a>
                        <a href="/catalog/bestsellers/?FILTER=for_kids_and_parents">Бестселлеры</a>
                        <?foreach($arData as $data) {?>
                            <a href="<?=$data["DETAIL_PAGE_URL"]?>"><?=$data["NAME"]?></a>
                        <?}?>
                    </div>
                <?}?>
                <?
                $arFilterSection = Array('IBLOCK_ID'=>$arResult['IBLOCK_ID'],'ID'=>$arResult["ID"], 'GLOBAL_ACTIVE'=>'Y');
                $dbSections = CIBlockSection::GetList(Array(), $arFilterSection, false, Array("ID","UF_TEXT_WRAP_1"));
                if($arSection = $dbSections->fetch()) {
                    $sectionText = $arSection["UF_TEXT_WRAP_1"];
                };
                ?>
                <div class="sectionTextWrap">
                    <?if(strlen($sectionText) > 0) {?>
                        <p><?=$sectionText?></p>
                    <?}?>
                    <img src="/img/for_children/bitmap1.png">
                </div>

                <?//Версточка баннеров?>
                <div class="childBannerBlocks">
                    <div class="childBannerBlock">
                        <?$APPLICATION->IncludeComponent(
                        	"bitrix:main.include",
                        	".default",
                        	array(
                        		"AREA_FILE_SHOW" => "file",
                        		"PATH" => "/include/child1.php",
                        		"COMPONENT_TEMPLATE" => ".default",
                        		"COMPOSITE_FRAME_MODE" => "A",
                        		"COMPOSITE_FRAME_TYPE" => "AUTO",
                        		"EDIT_TEMPLATE" => ""
                        	),
                        	false
                        );?>
                    </div><div class="childBannerBlock">
                        <?$APPLICATION->IncludeComponent(
                        	"bitrix:main.include",
                        	".default",
                        	array(
                        		"AREA_FILE_SHOW" => "file",
                        		"PATH" => "/include/child2.php",
                        		"COMPONENT_TEMPLATE" => ".default",
                        		"COMPOSITE_FRAME_MODE" => "A",
                        		"COMPOSITE_FRAME_TYPE" => "AUTO",
                        		"EDIT_TEMPLATE" => ""
                        	),
                        	false
                        );?>
                    </div><div class="childBannerBlock">
                        <?$APPLICATION->IncludeComponent(
                        	"bitrix:main.include",
                        	".default",
                        	array(
                        		"AREA_FILE_SHOW" => "file",
                        		"PATH" => "/include/child3.php",
                        		"COMPONENT_TEMPLATE" => ".default",
                        		"COMPOSITE_FRAME_MODE" => "A",
                        		"COMPOSITE_FRAME_TYPE" => "AUTO",
                        		"EDIT_TEMPLATE" => ""
                        	),
                        	false
                        );?>
                    </div>
                </div>
                <div class="childrenBooks childrenBooks_1">
                    <?
                    $APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"children_block",
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "4",
		"TITLE_BLOCK" => "Лучший друг — Конни",
		"BUTTON_NAME" => "Все книги",
		"BUTTON_HREF" => "http://conni.club/",
		"ELEMENT_SORT_FIELD" => "PROPERTY_BIG_SECTION_IMAGE",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_FIELD2" => "PROPERTY_STATE",
		"ELEMENT_SORT_ORDER2" => "asc",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => $arResult["ORIGINAL_PARAMETERS"]["LIST_PROPERTY_CODE"],
			2 => "",
		),
		"META_KEYWORDS" => $arResult["ORIGINAL_PARAMETERS"]["LIST_META_KEYWORDS"],
		"META_DESCRIPTION" => $arResult["ORIGINAL_PARAMETERS"]["LIST_META_DESCRIPTION"],
		"BROWSER_TITLE" => "-",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_SUBSECTIONS" => "A",
		"BASKET_URL" => $arResult["ORIGINAL_PARAMETERS"]["BASKET_URL"],
		"ACTION_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["SECTION_ID_VARIABLE"],
		"PRODUCT_QUANTITY_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_QUANTITY_VARIABLE"],
		"PRODUCT_PROPS_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_PROPS_VARIABLE"],
		"FILTER_NAME" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_TIME"],
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "N",
		"MESSAGE_404" => $arResult["ORIGINAL_PARAMETERS"]["MESSAGE_404"],
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"FILE_404" => $arResult["ORIGINAL_PARAMETERS"]["FILE_404"],
		"DISPLAY_COMPARE" => "N",
		"PAGE_ELEMENT_COUNT" => "",
		"LINE_ELEMENT_COUNT" => "",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => $arResult["ORIGINAL_PARAMETERS"]["SHOW_PRICE_COUNT"],
		"PRICE_VAT_INCLUDE" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_TEMPLATE"],
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_BASE_LINK" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_BASE_LINK"],
		"PAGER_PARAMS_NAME" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_PARAMS_NAME"],
		"OFFERS_CART_PROPERTIES" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_CART_PROPERTIES"],
		"OFFERS_FIELD_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_PROPERTY_CODE"],
		"OFFERS_SORT_FIELD" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_FIELD"],
		"OFFERS_SORT_ORDER" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_ORDER"],
		"OFFERS_SORT_FIELD2" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_FIELD2"],
		"OFFERS_SORT_ORDER2" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_ORDER2"],
		"OFFERS_LIMIT" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_LIMIT"],
		"SECTION_ID" => "",
		"SECTION_CODE" => "BooksForParentsAndChildren",
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"CONVERT_CURRENCY" => "N",
		"CURRENCY_ID" => $arResult["ORIGINAL_PARAMETERS"]["CURRENCY_ID"],
		"HIDE_NOT_AVAILABLE" => "L",
		"LABEL_PROP" => "-",
		"ADD_PICT_PROP" => "-",
		"PRODUCT_DISPLAY_MODE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_DISPLAY_MODE"],
		"OFFER_ADD_PICT_PROP" => $arResult["ORIGINAL_PARAMETERS"]["OFFER_ADD_PICT_PROP"],
		"OFFER_TREE_PROPS" => $arResult["ORIGINAL_PARAMETERS"]["OFFER_TREE_PROPS"],
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"MESS_BTN_BUY" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_BUY"],
		"MESS_BTN_ADD_TO_BASKET" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_ADD_TO_BASKET"],
		"MESS_BTN_SUBSCRIBE" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_SUBSCRIBE"],
		"MESS_BTN_DETAIL" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_DETAIL"],
		"MESS_NOT_AVAILABLE" => $arResult["ORIGINAL_PARAMETERS"]["MESS_NOT_AVAILABLE"],
		"TEMPLATE_THEME" => (isset($arResult["ORIGINAL_PARAMETERS"]["TEMPLATE_THEME"])?$arResult["ORIGINAL_PARAMETERS"]["TEMPLATE_THEME"]:""),
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"SHOW_CLOSE_POPUP" => "N",
		"COMPARE_PATH" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
		"BACKGROUND_IMAGE" => (isset($arResult["ORIGINAL_PARAMETERS"]["SECTION_BACKGROUND_IMAGE"])?$arResult["ORIGINAL_PARAMETERS"]["SECTION_BACKGROUND_IMAGE"]:""),
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"OR\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Конни на ферме\"}},{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Конни и котёнок\"}},{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Конни идет в детский сад\"}},{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Конни помогает маме\"}}]}",
		"COMPONENT_TEMPLATE" => "children_block",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_ALL_WO_SECTION" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"SERIES_ID" => "",
		"MESS_BTN_COMPARE" => "Сравнить",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"COMPATIBLE_MODE" => "Y",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N"
	),
	false
);
                    ?>
                </div>
                <div class="demarcation">
                    <img class="bookWithBall" src="/img/for_children/bitmap8.png"/>
                    <img class="baloons" src="/img/for_children/bitmap3.png"/>
                </div>
                <div class="childrenBooks childrenBooks_3">
                    <?
                    $APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"children_block",
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "4",
		"TITLE_BLOCK" => "Летние новинки",
		"BUTTON_NAME" => "Все книги",
		"BUTTON_HREF" => "",
		"ELEMENT_SORT_FIELD" => "PROPERTY_BIG_SECTION_IMAGE",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_FIELD2" => "PROPERTY_STATE",
		"ELEMENT_SORT_ORDER2" => "asc",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => $arResult["ORIGINAL_PARAMETERS"]["LIST_PROPERTY_CODE"],
			2 => "",
		),
		"META_KEYWORDS" => $arResult["ORIGINAL_PARAMETERS"]["LIST_META_KEYWORDS"],
		"META_DESCRIPTION" => $arResult["ORIGINAL_PARAMETERS"]["LIST_META_DESCRIPTION"],
		"BROWSER_TITLE" => "-",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_SUBSECTIONS" => "A",
		"BASKET_URL" => $arResult["ORIGINAL_PARAMETERS"]["BASKET_URL"],
		"ACTION_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["SECTION_ID_VARIABLE"],
		"PRODUCT_QUANTITY_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_QUANTITY_VARIABLE"],
		"PRODUCT_PROPS_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_PROPS_VARIABLE"],
		"FILTER_NAME" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_TIME"],
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "N",
		"MESSAGE_404" => $arResult["ORIGINAL_PARAMETERS"]["MESSAGE_404"],
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"FILE_404" => $arResult["ORIGINAL_PARAMETERS"]["FILE_404"],
		"DISPLAY_COMPARE" => "N",
		"PAGE_ELEMENT_COUNT" => "",
		"LINE_ELEMENT_COUNT" => "",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => $arResult["ORIGINAL_PARAMETERS"]["SHOW_PRICE_COUNT"],
		"PRICE_VAT_INCLUDE" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_TEMPLATE"],
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_BASE_LINK" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_BASE_LINK"],
		"PAGER_PARAMS_NAME" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_PARAMS_NAME"],
		"OFFERS_CART_PROPERTIES" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_CART_PROPERTIES"],
		"OFFERS_FIELD_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_PROPERTY_CODE"],
		"OFFERS_SORT_FIELD" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_FIELD"],
		"OFFERS_SORT_ORDER" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_ORDER"],
		"OFFERS_SORT_FIELD2" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_FIELD2"],
		"OFFERS_SORT_ORDER2" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_ORDER2"],
		"OFFERS_LIMIT" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_LIMIT"],
		"SECTION_ID" => "",
		"SECTION_CODE" => "BooksForParentsAndChildren",
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"CONVERT_CURRENCY" => "N",
		"CURRENCY_ID" => $arResult["ORIGINAL_PARAMETERS"]["CURRENCY_ID"],
		"HIDE_NOT_AVAILABLE" => "L",
		"LABEL_PROP" => "-",
		"ADD_PICT_PROP" => "-",
		"PRODUCT_DISPLAY_MODE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_DISPLAY_MODE"],
		"OFFER_ADD_PICT_PROP" => $arResult["ORIGINAL_PARAMETERS"]["OFFER_ADD_PICT_PROP"],
		"OFFER_TREE_PROPS" => $arResult["ORIGINAL_PARAMETERS"]["OFFER_TREE_PROPS"],
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"MESS_BTN_BUY" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_BUY"],
		"MESS_BTN_ADD_TO_BASKET" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_ADD_TO_BASKET"],
		"MESS_BTN_SUBSCRIBE" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_SUBSCRIBE"],
		"MESS_BTN_DETAIL" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_DETAIL"],
		"MESS_NOT_AVAILABLE" => $arResult["ORIGINAL_PARAMETERS"]["MESS_NOT_AVAILABLE"],
		"TEMPLATE_THEME" => (isset($arResult["ORIGINAL_PARAMETERS"]["TEMPLATE_THEME"])?$arResult["ORIGINAL_PARAMETERS"]["TEMPLATE_THEME"]:""),
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"SHOW_CLOSE_POPUP" => "N",
		"COMPARE_PATH" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
		"BACKGROUND_IMAGE" => (isset($arResult["ORIGINAL_PARAMETERS"]["SECTION_BACKGROUND_IMAGE"])?$arResult["ORIGINAL_PARAMETERS"]["SECTION_BACKGROUND_IMAGE"]:""),
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"OR\",\"True\":\"True\"},\"CHILDREN\":{\"1\":{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Приключения в Космосе\"}},\"2\":{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Горсть спелой земляники\"}},\"3\":{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Сказки о царе Колбаске\"}},\"4\":{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Сказки о царе Колбаске\"}}}}",
		"COMPONENT_TEMPLATE" => "children_block",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_ALL_WO_SECTION" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"SERIES_ID" => "",
		"MESS_BTN_COMPARE" => "Сравнить",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"COMPATIBLE_MODE" => "Y",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N"
	),
	false
);
                    ?>
                </div>
                <div class="childrenBooksSubscribe">
                    <div class="giftRound">
                    </div>
                    <div class="giftWrap">
                        <div class="some_info">
                            Заявка на подписку принята, ждите информацию на почту
                        </div>
                        <p class="title">
                            Книжка за подписку
                        </p>
                        <p class="description">
                            Подпишитесь на рассылку и получите книгу<br />в формате PDF бесплатно
                        </p>
                        <form action="/" method="post">
                            <input type="text" placeholder="Ваш e-mail" name="email" onkeypress="if (event.keyCode == 13) {return SubmitRequest(event);}">
                            <input type="button" onclick="subscribeChildren();return false;" value="">
                        </form>
						<div class="pii no-mobile">
                            * подписываясь на рассылку, вы соглашаетесь на обработку персональных данных в соответствии <a href="/content/pii/" target="_blank">с условиями</a>
                        </div>
						<div class="bookCover">
                            <img src="/img/for_children/book_punishment.jpg"/>
                        </div>
                    </div>
                </div>
                <div class="childrenBooks childrenBooks_2">
                    <?
                    $APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"children_block",
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "4",
		"TITLE_BLOCK" => "Занимательная зоология",
		"BUTTON_NAME" => "Все книги",
		"BUTTON_HREF" => "/series/66042/?sphrase_id=485712",
		"ELEMENT_SORT_FIELD" => "PROPERTY_BIG_SECTION_IMAGE",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_FIELD2" => "PROPERTY_STATE",
		"ELEMENT_SORT_ORDER2" => "asc",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => $arResult["ORIGINAL_PARAMETERS"]["LIST_PROPERTY_CODE"],
			2 => "",
		),
		"META_KEYWORDS" => $arResult["ORIGINAL_PARAMETERS"]["LIST_META_KEYWORDS"],
		"META_DESCRIPTION" => $arResult["ORIGINAL_PARAMETERS"]["LIST_META_DESCRIPTION"],
		"BROWSER_TITLE" => "-",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_SUBSECTIONS" => "A",
		"BASKET_URL" => $arResult["ORIGINAL_PARAMETERS"]["BASKET_URL"],
		"ACTION_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["SECTION_ID_VARIABLE"],
		"PRODUCT_QUANTITY_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_QUANTITY_VARIABLE"],
		"PRODUCT_PROPS_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_PROPS_VARIABLE"],
		"FILTER_NAME" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_TIME"],
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "N",
		"MESSAGE_404" => $arResult["ORIGINAL_PARAMETERS"]["MESSAGE_404"],
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"FILE_404" => $arResult["ORIGINAL_PARAMETERS"]["FILE_404"],
		"DISPLAY_COMPARE" => "N",
		"PAGE_ELEMENT_COUNT" => "",
		"LINE_ELEMENT_COUNT" => "",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => $arResult["ORIGINAL_PARAMETERS"]["SHOW_PRICE_COUNT"],
		"PRICE_VAT_INCLUDE" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_TEMPLATE"],
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_BASE_LINK" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_BASE_LINK"],
		"PAGER_PARAMS_NAME" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_PARAMS_NAME"],
		"OFFERS_CART_PROPERTIES" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_CART_PROPERTIES"],
		"OFFERS_FIELD_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_PROPERTY_CODE"],
		"OFFERS_SORT_FIELD" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_FIELD"],
		"OFFERS_SORT_ORDER" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_ORDER"],
		"OFFERS_SORT_FIELD2" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_FIELD2"],
		"OFFERS_SORT_ORDER2" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_ORDER2"],
		"OFFERS_LIMIT" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_LIMIT"],
		"SECTION_ID" => "",
		"SECTION_CODE" => "BooksForParentsAndChildren",
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"CONVERT_CURRENCY" => "N",
		"CURRENCY_ID" => $arResult["ORIGINAL_PARAMETERS"]["CURRENCY_ID"],
		"HIDE_NOT_AVAILABLE" => "L",
		"LABEL_PROP" => "-",
		"ADD_PICT_PROP" => "-",
		"PRODUCT_DISPLAY_MODE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_DISPLAY_MODE"],
		"OFFER_ADD_PICT_PROP" => $arResult["ORIGINAL_PARAMETERS"]["OFFER_ADD_PICT_PROP"],
		"OFFER_TREE_PROPS" => $arResult["ORIGINAL_PARAMETERS"]["OFFER_TREE_PROPS"],
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"MESS_BTN_BUY" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_BUY"],
		"MESS_BTN_ADD_TO_BASKET" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_ADD_TO_BASKET"],
		"MESS_BTN_SUBSCRIBE" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_SUBSCRIBE"],
		"MESS_BTN_DETAIL" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_DETAIL"],
		"MESS_NOT_AVAILABLE" => $arResult["ORIGINAL_PARAMETERS"]["MESS_NOT_AVAILABLE"],
		"TEMPLATE_THEME" => (isset($arResult["ORIGINAL_PARAMETERS"]["TEMPLATE_THEME"])?$arResult["ORIGINAL_PARAMETERS"]["TEMPLATE_THEME"]:""),
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"SHOW_CLOSE_POPUP" => "N",
		"COMPARE_PATH" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
		"BACKGROUND_IMAGE" => (isset($arResult["ORIGINAL_PARAMETERS"]["SECTION_BACKGROUND_IMAGE"])?$arResult["ORIGINAL_PARAMETERS"]["SECTION_BACKGROUND_IMAGE"]:""),
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"OR\",\"True\":\"True\"},\"CHILDREN\":{\"1\":{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Я енот\"}},\"2\":{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Я еж\"}},\"3\":{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Я лисица\"}},\"4\":{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Я дельфин\"}},\"5\":{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Я белый медведь\"}}}}",
		"COMPONENT_TEMPLATE" => "children_block",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_ALL_WO_SECTION" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"SERIES_ID" => "",
		"MESS_BTN_COMPARE" => "Сравнить",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"COMPATIBLE_MODE" => "Y",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N"
	),
	false
);
                    ?>
                </div>
                <div class="demarcation">
                    <img class="bookWithBall" src="/img/for_children/bitmap8.png"/>
                    <img class="baloons" src="/img/for_children/bitmap3.png"/>
                </div>
                <div class="childrenBooks childrenBooks_3">
                    <?
                    $APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"children_block",
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "4",
		"TITLE_BLOCK" => "Книги для родителей",
		"BUTTON_NAME" => "Все книги",
		"BUTTON_HREF" => "/catalog/BooksForParents/",
		"ELEMENT_SORT_FIELD" => "PROPERTY_BIG_SECTION_IMAGE",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_FIELD2" => "PROPERTY_STATE",
		"ELEMENT_SORT_ORDER2" => "asc",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => $arResult["ORIGINAL_PARAMETERS"]["LIST_PROPERTY_CODE"],
			2 => "",
		),
		"META_KEYWORDS" => $arResult["ORIGINAL_PARAMETERS"]["LIST_META_KEYWORDS"],
		"META_DESCRIPTION" => $arResult["ORIGINAL_PARAMETERS"]["LIST_META_DESCRIPTION"],
		"BROWSER_TITLE" => "-",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_SUBSECTIONS" => "A",
		"BASKET_URL" => $arResult["ORIGINAL_PARAMETERS"]["BASKET_URL"],
		"ACTION_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["SECTION_ID_VARIABLE"],
		"PRODUCT_QUANTITY_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_QUANTITY_VARIABLE"],
		"PRODUCT_PROPS_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_PROPS_VARIABLE"],
		"FILTER_NAME" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_TIME"],
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "N",
		"MESSAGE_404" => $arResult["ORIGINAL_PARAMETERS"]["MESSAGE_404"],
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"FILE_404" => $arResult["ORIGINAL_PARAMETERS"]["FILE_404"],
		"DISPLAY_COMPARE" => "N",
		"PAGE_ELEMENT_COUNT" => "",
		"LINE_ELEMENT_COUNT" => "",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => $arResult["ORIGINAL_PARAMETERS"]["SHOW_PRICE_COUNT"],
		"PRICE_VAT_INCLUDE" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_TEMPLATE"],
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_BASE_LINK" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_BASE_LINK"],
		"PAGER_PARAMS_NAME" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_PARAMS_NAME"],
		"OFFERS_CART_PROPERTIES" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_CART_PROPERTIES"],
		"OFFERS_FIELD_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_PROPERTY_CODE"],
		"OFFERS_SORT_FIELD" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_FIELD"],
		"OFFERS_SORT_ORDER" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_ORDER"],
		"OFFERS_SORT_FIELD2" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_FIELD2"],
		"OFFERS_SORT_ORDER2" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_ORDER2"],
		"OFFERS_LIMIT" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_LIMIT"],
		"SECTION_ID" => "",
		"SECTION_CODE" => "BooksForParentsAndChildren",
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"CONVERT_CURRENCY" => "N",
		"CURRENCY_ID" => $arResult["ORIGINAL_PARAMETERS"]["CURRENCY_ID"],
		"HIDE_NOT_AVAILABLE" => "L",
		"LABEL_PROP" => "-",
		"ADD_PICT_PROP" => "-",
		"PRODUCT_DISPLAY_MODE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_DISPLAY_MODE"],
		"OFFER_ADD_PICT_PROP" => $arResult["ORIGINAL_PARAMETERS"]["OFFER_ADD_PICT_PROP"],
		"OFFER_TREE_PROPS" => $arResult["ORIGINAL_PARAMETERS"]["OFFER_TREE_PROPS"],
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"MESS_BTN_BUY" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_BUY"],
		"MESS_BTN_ADD_TO_BASKET" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_ADD_TO_BASKET"],
		"MESS_BTN_SUBSCRIBE" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_SUBSCRIBE"],
		"MESS_BTN_DETAIL" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_DETAIL"],
		"MESS_NOT_AVAILABLE" => $arResult["ORIGINAL_PARAMETERS"]["MESS_NOT_AVAILABLE"],
		"TEMPLATE_THEME" => (isset($arResult["ORIGINAL_PARAMETERS"]["TEMPLATE_THEME"])?$arResult["ORIGINAL_PARAMETERS"]["TEMPLATE_THEME"]:""),
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"SHOW_CLOSE_POPUP" => "N",
		"COMPARE_PATH" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
		"BACKGROUND_IMAGE" => (isset($arResult["ORIGINAL_PARAMETERS"]["SECTION_BACKGROUND_IMAGE"])?$arResult["ORIGINAL_PARAMETERS"]["SECTION_BACKGROUND_IMAGE"]:""),
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"OR\",\"True\":\"True\"},\"CHILDREN\":{\"1\":{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Любовь и брокколи\"}},\"2\":{\"CLASS_ID\":\"CondIBProp:4:47\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"978-5-91671-789-1\"}},\"3\":{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Финская система обучения\"}},\"4\":{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"160 развивающих игр для детей от рождения до трех лет\"}},\"5\":{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Рожденные с характером\"}}}}",
		"COMPONENT_TEMPLATE" => "children_block",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_ALL_WO_SECTION" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"SERIES_ID" => "",
		"MESS_BTN_COMPARE" => "Сравнить",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"COMPATIBLE_MODE" => "Y",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N"
	),
	false
);
                    ?>
                </div>
                <div class="childrenCooperation">
                    <div class="textBlock">
                        <div class="title">
                            Хотите с нами сотрудничать?
                        </div>
                        <div class="text">
                            Хотите предложить нам книгу к изданию, взять новинку на рецензию, пригласить нас на мероприятие или продавать наши книги? Рассмотрим все ваши идеи!<br>Пишите Наталье Тенцер <a href="mailto:n.tentser@alpina.ru">n.tentser@alpina.ru</a>
                        </div>
                    </div>
                    <div class="childrenCooperationImg">
                        <img src="/img/for_children/group-16.png"/>
                    </div>
                    <div class="childrenCooperationPillow">
                        <img src="/img/for_children/bitmap4.png"/>
                    </div>
                </div>
                <div class="childrenBooks childrenBooks_1">
                    <?
                    $APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"children_block",
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "4",
		"TITLE_BLOCK" => "Книги для детей от 3 до 6 лет",
		"BUTTON_NAME" => "",
		"BUTTON_HREF" => "",
		"ELEMENT_SORT_FIELD" => "PROPERTY_BIG_SECTION_IMAGE",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_FIELD2" => "PROPERTY_STATE",
		"ELEMENT_SORT_ORDER2" => "asc",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => $arResult["ORIGINAL_PARAMETERS"]["LIST_PROPERTY_CODE"],
			2 => "",
		),
		"META_KEYWORDS" => $arResult["ORIGINAL_PARAMETERS"]["LIST_META_KEYWORDS"],
		"META_DESCRIPTION" => $arResult["ORIGINAL_PARAMETERS"]["LIST_META_DESCRIPTION"],
		"BROWSER_TITLE" => "-",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_SUBSECTIONS" => "A",
		"BASKET_URL" => $arResult["ORIGINAL_PARAMETERS"]["BASKET_URL"],
		"ACTION_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["SECTION_ID_VARIABLE"],
		"PRODUCT_QUANTITY_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_QUANTITY_VARIABLE"],
		"PRODUCT_PROPS_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_PROPS_VARIABLE"],
		"FILTER_NAME" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_TIME"],
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "N",
		"MESSAGE_404" => $arResult["ORIGINAL_PARAMETERS"]["MESSAGE_404"],
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"FILE_404" => $arResult["ORIGINAL_PARAMETERS"]["FILE_404"],
		"DISPLAY_COMPARE" => "N",
		"PAGE_ELEMENT_COUNT" => "",
		"LINE_ELEMENT_COUNT" => "",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => $arResult["ORIGINAL_PARAMETERS"]["SHOW_PRICE_COUNT"],
		"PRICE_VAT_INCLUDE" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_TEMPLATE"],
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_BASE_LINK" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_BASE_LINK"],
		"PAGER_PARAMS_NAME" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_PARAMS_NAME"],
		"OFFERS_CART_PROPERTIES" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_CART_PROPERTIES"],
		"OFFERS_FIELD_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_PROPERTY_CODE"],
		"OFFERS_SORT_FIELD" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_FIELD"],
		"OFFERS_SORT_ORDER" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_ORDER"],
		"OFFERS_SORT_FIELD2" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_FIELD2"],
		"OFFERS_SORT_ORDER2" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_ORDER2"],
		"OFFERS_LIMIT" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_LIMIT"],
		"SECTION_ID" => "",
		"SECTION_CODE" => "BooksForParentsAndChildren",
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"CONVERT_CURRENCY" => "N",
		"CURRENCY_ID" => $arResult["ORIGINAL_PARAMETERS"]["CURRENCY_ID"],
		"HIDE_NOT_AVAILABLE" => "L",
		"LABEL_PROP" => "-",
		"ADD_PICT_PROP" => "-",
		"PRODUCT_DISPLAY_MODE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_DISPLAY_MODE"],
		"OFFER_ADD_PICT_PROP" => $arResult["ORIGINAL_PARAMETERS"]["OFFER_ADD_PICT_PROP"],
		"OFFER_TREE_PROPS" => $arResult["ORIGINAL_PARAMETERS"]["OFFER_TREE_PROPS"],
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"MESS_BTN_BUY" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_BUY"],
		"MESS_BTN_ADD_TO_BASKET" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_ADD_TO_BASKET"],
		"MESS_BTN_SUBSCRIBE" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_SUBSCRIBE"],
		"MESS_BTN_DETAIL" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_DETAIL"],
		"MESS_NOT_AVAILABLE" => $arResult["ORIGINAL_PARAMETERS"]["MESS_NOT_AVAILABLE"],
		"TEMPLATE_THEME" => (isset($arResult["ORIGINAL_PARAMETERS"]["TEMPLATE_THEME"])?$arResult["ORIGINAL_PARAMETERS"]["TEMPLATE_THEME"]:""),
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"SHOW_CLOSE_POPUP" => "N",
		"COMPARE_PATH" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
		"BACKGROUND_IMAGE" => (isset($arResult["ORIGINAL_PARAMETERS"]["SECTION_BACKGROUND_IMAGE"])?$arResult["ORIGINAL_PARAMETERS"]["SECTION_BACKGROUND_IMAGE"]:""),
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"OR\",\"True\":\"True\"},\"CHILDREN\":{\"1\":{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Десять маленьких принцесс\"}},\"2\":{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Десять маленьких пиратов\"}},\"3\":{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"десять маленьких динозавров\"}},\"4\":{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Десять маленьких монстров\"}}}}",
		"COMPONENT_TEMPLATE" => "children_block",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_ALL_WO_SECTION" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"SERIES_ID" => "",
		"MESS_BTN_COMPARE" => "Сравнить",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"COMPATIBLE_MODE" => "Y",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N"
	),
	false
);
                    ?>
                </div>
                <div class="demarcation">
                    <img class="bookWithBall" src="/img/for_children/bitmap8.png"/>
                    <img class="baloons" src="/img/for_children/bitmap3.png"/>
                </div>
                <div class="childrenBooks childrenBooks_3">
                    <?
                    $APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"children_block",
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "4",
		"TITLE_BLOCK" => "Книги для детей от 7 до 12 лет",
		"BUTTON_NAME" => "",
		"BUTTON_HREF" => "",
		"ELEMENT_SORT_FIELD" => "PROPERTY_BIG_SECTION_IMAGE",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_FIELD2" => "PROPERTY_STATE",
		"ELEMENT_SORT_ORDER2" => "asc",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => $arResult["ORIGINAL_PARAMETERS"]["LIST_PROPERTY_CODE"],
			2 => "",
		),
		"META_KEYWORDS" => $arResult["ORIGINAL_PARAMETERS"]["LIST_META_KEYWORDS"],
		"META_DESCRIPTION" => $arResult["ORIGINAL_PARAMETERS"]["LIST_META_DESCRIPTION"],
		"BROWSER_TITLE" => "-",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_SUBSECTIONS" => "A",
		"BASKET_URL" => $arResult["ORIGINAL_PARAMETERS"]["BASKET_URL"],
		"ACTION_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["SECTION_ID_VARIABLE"],
		"PRODUCT_QUANTITY_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_QUANTITY_VARIABLE"],
		"PRODUCT_PROPS_VARIABLE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_PROPS_VARIABLE"],
		"FILTER_NAME" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => $arResult["ORIGINAL_PARAMETERS"]["CACHE_TIME"],
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "N",
		"MESSAGE_404" => $arResult["ORIGINAL_PARAMETERS"]["MESSAGE_404"],
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"FILE_404" => $arResult["ORIGINAL_PARAMETERS"]["FILE_404"],
		"DISPLAY_COMPARE" => "N",
		"PAGE_ELEMENT_COUNT" => "",
		"LINE_ELEMENT_COUNT" => "",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => $arResult["ORIGINAL_PARAMETERS"]["SHOW_PRICE_COUNT"],
		"PRICE_VAT_INCLUDE" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_TEMPLATE"],
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_BASE_LINK" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_BASE_LINK"],
		"PAGER_PARAMS_NAME" => $arResult["ORIGINAL_PARAMETERS"]["PAGER_PARAMS_NAME"],
		"OFFERS_CART_PROPERTIES" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_CART_PROPERTIES"],
		"OFFERS_FIELD_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_PROPERTY_CODE"],
		"OFFERS_SORT_FIELD" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_FIELD"],
		"OFFERS_SORT_ORDER" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_ORDER"],
		"OFFERS_SORT_FIELD2" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_FIELD2"],
		"OFFERS_SORT_ORDER2" => $arResult["ORIGINAL_PARAMETERS"]["OFFERS_SORT_ORDER2"],
		"OFFERS_LIMIT" => $arResult["ORIGINAL_PARAMETERS"]["LIST_OFFERS_LIMIT"],
		"SECTION_ID" => "",
		"SECTION_CODE" => "BooksForParentsAndChildren",
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"CONVERT_CURRENCY" => "N",
		"CURRENCY_ID" => $arResult["ORIGINAL_PARAMETERS"]["CURRENCY_ID"],
		"HIDE_NOT_AVAILABLE" => "L",
		"LABEL_PROP" => "-",
		"ADD_PICT_PROP" => "-",
		"PRODUCT_DISPLAY_MODE" => $arResult["ORIGINAL_PARAMETERS"]["PRODUCT_DISPLAY_MODE"],
		"OFFER_ADD_PICT_PROP" => $arResult["ORIGINAL_PARAMETERS"]["OFFER_ADD_PICT_PROP"],
		"OFFER_TREE_PROPS" => $arResult["ORIGINAL_PARAMETERS"]["OFFER_TREE_PROPS"],
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"MESS_BTN_BUY" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_BUY"],
		"MESS_BTN_ADD_TO_BASKET" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_ADD_TO_BASKET"],
		"MESS_BTN_SUBSCRIBE" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_SUBSCRIBE"],
		"MESS_BTN_DETAIL" => $arResult["ORIGINAL_PARAMETERS"]["MESS_BTN_DETAIL"],
		"MESS_NOT_AVAILABLE" => $arResult["ORIGINAL_PARAMETERS"]["MESS_NOT_AVAILABLE"],
		"TEMPLATE_THEME" => (isset($arResult["ORIGINAL_PARAMETERS"]["TEMPLATE_THEME"])?$arResult["ORIGINAL_PARAMETERS"]["TEMPLATE_THEME"]:""),
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"SHOW_CLOSE_POPUP" => "N",
		"COMPARE_PATH" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
		"BACKGROUND_IMAGE" => (isset($arResult["ORIGINAL_PARAMETERS"]["SECTION_BACKGROUND_IMAGE"])?$arResult["ORIGINAL_PARAMETERS"]["SECTION_BACKGROUND_IMAGE"]:""),
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"OR\",\"True\":\"True\"},\"CHILDREN\":{\"1\":{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Большая книга темноты\"}},\"2\":{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Большая книга подземного мира\"}},\"3\":{\"CLASS_ID\":\"CondIBProp:4:46\",\"DATA\":{\"logic\":\"Equal\",\"value\":\"Большая книга снега и льда\"}}}}",
		"COMPONENT_TEMPLATE" => "children_block",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_ALL_WO_SECTION" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"SERIES_ID" => "",
		"MESS_BTN_COMPARE" => "Сравнить",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"COMPATIBLE_MODE" => "Y",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N"
	),
	false
);
                    ?>
                </div>
                <div class="childrenGiftEdition">
                    <div class="textBlock">
                        <div class="title">
                            Выпустим детскую подарочную книгу
                        </div>
                        <div class="text">
                            Книга станет желанным подарком для детей сотрудников, клиентов и партнеров.
                            <ul>
                                <li>Выпустим подарочную детскую книгу о вашей компании</li>
                                <li>Напечатаем специальный тираж с вашим логотипом или даже уникальным текстом</li>
                                <li>Сделаем скидку при заказе от 50 экземпляров</li>
                            </ul>
                        </div>
                        <div class="phone">
                            +7 964 645 89 79
                        </div>
                        <div class="manager">
                            <div class="avatar">
                            </div>
                            <div class="name">
                                Лана Богомаз<br>
                                Руководитель направления “Альпина.Дети”
                            </div>
                            <div class="position">
                                <a href="mailto:l.bogomaz@alpina.ru">l.bogomaz@alpina.ru</a>
                            </div>
                        </div>
                    </div>
                    <div class="childrenGiftEditionDog">
                        <img src="/img/for_children/bitmap5.png"/>
                    </div>
                    <div class="childrenGiftEditionImg">
                        <img src="/img/for_children/bitmap6.png"/>
                    </div>
                    <div class="childrenGiftEditionGift">
                        <img src="/img/for_children/bitmap7.png"/>
                    </div>
                </div>
            </div>
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
                "IBLOCK_ID" => "4",
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
        <div class="childrenClew">
            <img src="/img/for_children/bitmap9.png"/>
        </div>
        <div class="wishlist_info">
            <div class="CloseWishlist"><img src="/img/catalogLeftClose.png"></div>
            <span></span>
        </div>
    </div>
</div>
<?
if (!isset($_SESSION[$APPLICATION -> GetCurDir()])) {
    $_SESSION[$APPLICATION -> GetCurDir()] = 1;
}
?>
<script>
    // скрипт ajax-подгрузки товаров в блоке "Все книги"
    $(document).ready(function() {
        $(".leftMenu ul li").each(function(){
            if ($(this).children("a").attr("href") == "<?= $APPLICATION -> GetCurDir()?>") {
                $(this).children("a").find("p").css("font-weight", "bold");
                if ($(this).closest("ul").hasClass("secondLevel")) {
                    $(this).closest("ul").parent("li").find("a p").addClass("activeListName");
                    $(this).closest("ul").parent("li").find(".secondLevel").show();
                } else {
                    $(this).find("ul.secondLevel a p").addClass("activeListName");
                    $(this).find("ul.secondLevel").show();
                }
            }
        });
        <?$navnum = $arResult["NAV_RESULT"]->NavNum;
        if ($navnum == 1) {
            $navnum = 2;
        }
        switch ($arResult["ORIGINAL_PARAMETERS"]["ELEMENT_SORT_FIELD"]) {
            case "CATALOG_PRICE_1":
            $sort = "PRICE";
            break;

            case "PROPERTY_shows_a_day":
            $sort = "POPULARITY";
            break;

            case "PROPERTY_SOON_DATE_TIME":
            $sort = "DATE";
            break;
        }?>
        <?if (isset($_REQUEST["PAGEN_".$navnum])) {
           ?>
            var page = <?= $_REQUEST["PAGEN_".$navnum]?> + 1;
        <?} else {?>
            var page = 2;
        <?}?>
        var maxpage = <?= ($arResult["NAV_RESULT"]->NavPageCount)?>;
        if ($(".bx-pagination").size() > 0) {
            var WrappHeight = $(".wrapperCategor").height();
            var DescriptionHeight = $(".catalogDescription").height();
            var RecHeight = $(".grayTitle").height();
            if (RecHeight == 0) {
                RecHeight = 550;
            }
            var BooksLiLength = $(".otherBooks ul li").length;

            var startHeight = WrappHeight+RecHeight+100 + DescriptionHeight + Math.ceil((BooksLiLength - 15) / 5) * 455;
            //$(".wrapperCategor").css("height", startHeight+"px");
        }
        <?if (isset($_SESSION[$APPLICATION -> GetCurDir()])) {?>
            var upd_page = <?= $_SESSION[$APPLICATION -> GetCurDir()]?>;
            for (i = 2; i <= upd_page; i++) {
                 <?if ($_REQUEST["SORT"]) {?>
                    $.get(window.location.href + '&PAGEN_<?= $navnum?>=' + page, function(data) {
                        var next_page = $('.otherBooks ul li', data);
                        $('.otherBooks ul').append(next_page);
                        page++;
                    })
                 <?} else {?>
                     $.get('<?= $arResult["SECTION_PAGE_URL"]?>?SORT=<?= $sort?>&DIRECTION=<?= $arResult["ORIGINAL_PARAMETERS"]["ELEMENT_SORT_ORDER2"]?>&PAGEN_<?= $navnum?>='+page,
                        function(data) {
                            var next_page = $('.otherBooks ul li', data);
                            $('.otherBooks ul').append(next_page);
                            page++;
                        }
                     )
                 <?}?>
                .done(function() {
                    $(".nameBook").each(function() {
                            if($(this).length > 0) {
                                $(this).html(truncate($(this).html(), 40));
                            }
                    });
                    var otherBooksHeight = 1350 * ($(".otherBooks ul li").length / 15);

                    var categorHeight = WrappHeight+RecHeight+200+ Math.ceil(($(".otherBooks ul li").length - BooksLiLength) / 5) * 455;

                    $(".otherBooks").css("height", otherBooksHeight+"px");
                });
                if (upd_page == maxpage) {
                    $('.showMore').hide();
                }
            }
        <?}?>

        cackle_widget = window.cackle_widget || [];
        cackle_widget.push({widget: 'ReviewRating', id: 36574, html: '{{=it.stars}}{{?it.numr > 0}} {{=it.numr+it.numv}} {{=it.reviews}}{{?}}'});
        (function() {
            var mc = document.createElement('script');
            mc.type = 'text/javascript';
            mc.async = true;
            mc.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cackle.me/widget.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(mc, s.nextSibling);
        })();
    });
</script>