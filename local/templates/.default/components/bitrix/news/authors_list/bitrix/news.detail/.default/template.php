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
global $authorName;
$authorName = $arResult["PROPERTIES"]["ALT_NAME"]["VALUE"];
?>
<!-- GdeSlon -->
<script type="text/javascript" src="//www.gdeslon.ru/landing.js?mode=other&amp;mid=79276"></script>
<?
$sects_list = CIBlockSection::GetList (array(), array("IBLOCK_ID" => 29, 'NAME' => substr($arResult["PROPERTIES"]["LAST_NAME"]["VALUE"], 0, 1)), false, array("ID", "NAME"), $filter);
$sects = $sects_list -> Fetch();
?>
<script>
$(document).ready(function() {
	$('#detailReview a:not([href*="alpinabook.ru"])').attr('target','_blank').attr('rel','nofollow'); //Если ссылка в рецензии не содержит alpinabook, то открывает в новой вкладке и закрываем через nofollow
	
	//скрываем описание автора, если очень длинное
	if ($(".textWrap").height() > 383) {
		$(".textWrap").css("height", "383px");
		$(".textWrap").css("overflow", "hidden");
		$(".readMore").show();
	}
	$(".readMore").click(function() {
		$(".textWrap").css("height", "auto");
		$(".textWrap").css("min-height", "400px");
		$(this).hide();
	});
});
</script>
<div class="authorWrap">
    <div class="titleWrap">
        <div class="catalogWrapper">
            <p class="breadCrump" itemprop="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
				<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="url" href="/"><span itemprop="name">Главная</span></a>
					<meta itemprop="position" content="1" />
				</span> / 
				<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="url" href="/authors"><span itemprop="name">Алфавитный указатель авторов</span></a>
					<meta itemprop="position" content="2" />
				</span> / 
				<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="url" href="/authors/?list=<?=$sects["ID"]?>"><span itemprop="name"><?=$sects["NAME"]?></span></a>
					<meta itemprop="position" content="3" />
				</span> / 
				<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<span itemprop="name"><?=$arResult["NAME"]?></span>
					<meta itemprop="position" content="4" />
				</span>
			</p>
            <h1 style="margin-top:0;" class="mainTitle"><?=$arResult["NAME"]?><?echo !empty($arResult["PROPERTIES"]["ORIG_NAME"]["VALUE"]) ? " / ".$arResult["PROPERTIES"]["ORIG_NAME"]["VALUE"] : ""?></h1>
        </div>
    </div>
    <div class="content" itemscope itemtype="http://schema.org/Person">
		<meta itemprop="name" content="<?=$arResult["NAME"]?>" />
        <div class="catalogWrapper">
            <div class="autorInfo">
                <div class="autorPhoto">
                    <?if ($arResult["DETAIL_PICTURE"]["SRC"]) {?>
                        <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" itemprop="image" alt="Автор <?=$arResult["NAME"]?>" />
                    <?} else {?>
                        <img src="/images/no_photo.png" width="200">
                    <?}?>
                </div>
            </div>
            <div class="textWrap">
                <?=html_entity_decode($arResult["PROPERTIES"]["AUTHOR_DETAIL_INFO"]["VALUE"]["TEXT"]);?>
            </div>
			<p class="readMore" style="display:none;"><span>Читать далее...</span></p>
        </div>    
    </div>
</div>

<script>
$(document).ready(function() {

       
});
</script>
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