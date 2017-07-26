<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$navnum = $arResult["NAV_RESULT"]->NavNum;

$template = $APPLICATION->GetTemplatePath();
$frame = $this->createFrame()->begin();
?>    

<div class="cataloggWrapper">
	<p class="iblogalpina no-mobile">
		БЛОГ ИЗДАТЕЛЬСТВА
	</p>
	<p class="iblog no-mobile">
		я<img src="/img/logoBig.png">блог
	</p>
	
	<div class="headText no-mobile">
	Чтение, которое не тратит, а экономит ваше время.<br />
	Здесь мы коротко пишем о книгах, людях и смыслах
	</div>
	<ul>
		<?foreach ($arResult["ITEMS"] as $arItem) {
			$pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array('width'=>360, 'height'=>360), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
			<li class="blogPostPreview">
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img title="<?=$arItem['NAME']?>" alt="Фотография <?=$arItem['NAME']?>" src="<?=$pict["src"]?>"></a>
				<?if (!empty($arItem["IBLOCK_SECTION_ID"])) {
					$section = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"]);
					$section = $section->GetNext();
					echo '<div class="cat">'.$section["NAME"].'</div>';
				}?>
				<div class="previewContent">
					<a class="title" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem['NAME']?></a>
					<div class="previewText"><?=substr(strip_tags($arItem['DETAIL_TEXT']),0,250).'...'?></div>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="fullText">Читать</a>
				</div>
			</li>
		<?}?>
	</ul>
	<div class="clearer"></div>
	<div class="navigation">
		<?=$arResult["NAV_STRING"]?>
	</div>
	<h2>Самые популярные посты</h2>
	<?$stringRecs = file_get_contents('http://api.retailrocket.ru/api/1.0/Recomendation/ItemsToMain/59703efb5a658825342f445a/');
	$recsArray = json_decode($stringRecs);
	array_splice($recsArray,5);
	global $arFilter;
	$arFilter = array("ID" => $recsArray);
	$APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		"blog_main_recs",
		array(
			"IBLOCK_TYPE_ID" => "catalog",
			"IBLOCK_ID" => "71",
			"BASKET_URL" => "/personal/cart/",
			"COMPONENT_TEMPLATE" => "blog_main_recs",
			"IBLOCK_TYPE" => "catalog",
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
			"FILTER_NAME" => "arFilter",
			"INCLUDE_SUBSECTIONS" => "Y",
			"SHOW_ALL_WO_SECTION" => "Y",
			"HIDE_NOT_AVAILABLE" => "N",
			"PAGE_ELEMENT_COUNT" => "5",
			"LINE_ELEMENT_COUNT" => "3",
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
			"ADD_PICT_PROP" => "BIG_PHOTO",
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
			"SET_BROWSER_TITLE" => "N",
			"BROWSER_TITLE" => "-",
			"SET_META_KEYWORDS" => "N",
			"META_KEYWORDS" => "-",
			"SET_META_DESCRIPTION" => "N",
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
			"PAGER_SHOW_ALWAYS" => "Y",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"SET_STATUS_404" => "N",
			"SHOW_404" => "N",
			"MESSAGE_404" => "",
			"BACKGROUND_IMAGE" => "-"
		),
		false
	);?>
</div>
<?$frame->end();?>