<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
/** @var CBitrixComponent $component */?>
<div class="search-page" itemprop="mainEntity" itemscope itemtype="http://schema.org/ItemList">
	<link itemprop="url" href="<?=$_SERVER['REQUEST_URI']?>" />
    <?if (isset($arResult["REQUEST"]["ORIGINAL_QUERY"])) {?>
        <div class="search-language-guess">
            <?= GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>')) ?>
            </div>
    <?}?>
    <?if (count($arResult["SEARCH"]) > 0) {?>
		<?$gdeslon = '';?>
        <div class="pageTitleWrap">
            <div class="catalogWrapper">
                <div class="catalogIcon searchCatalogModified">
                </div>
                <div class="basketIcon searchBasketModified">
                </div>
                <p class="title">Результаты поиска
                    <?if(is_object($arResult["NAV_RESULT"])) {?>
                        <span>по запросу "<?= $arResult["REQUEST"]["QUERY"] ?>" (<span itemprop="numberOfItems"><?= $arResult["NAV_RESULT"]->SelectedRowsCount()?> </span> результатов)</span>
                    <?}?>
                </p>
            </div>
        </div>
		<script type="text/javascript">
			$(document).ready(function() {
				dataLayer.push({
					event: 'searchResults',
					action: 'resultsFound',
					label: '<?= $arResult["REQUEST"]["QUERY"] ?>'
				});
			});
		</script>
        <?/* Получаем рекомендации для поиска от RetailRocket */
        global $arrFilter;
        $stringRecs = file_get_contents('https://api.retailrocket.ru/api/1.0/Recomendation/SearchToItems/50b90f71b994b319dc5fd855/?keyword=' . $arResult["REQUEST"]["QUERY"]);
        $recsArray = json_decode($stringRecs);
        $arrFilter = Array('ID' => (array_slice($recsArray, 0, 5)));
        if ($arrFilter['ID'][0] > 0) {?>

            <div class="interestingWrap">
                <div class="catalogWrapper">
                    <p class="title">Те, кто искали «<?= $arResult["REQUEST"]["QUERY"] ?>» купили</p>

                    <div class="bookEasySlider">
                        <?
                        if(!$USER->IsAdmin()){
                            $arrFilter["!PROPERTY_FOR_ADMIN_VALUE"] = "Y";
                        }
                        $APPLICATION->IncludeComponent(
                            "bitrix:catalog.section",
                            "recommended_books",
                            array(
                                "IBLOCK_TYPE_ID" => "catalog",
                                "IBLOCK_ID" => CATALOG_IBLOCK_ID,
                                "BASKET_URL" => "/personal/cart/",
                                "COMPONENT_TEMPLATE" => "recommended_books",
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
                                "FILTER_NAME" => "arrFilter",
                                "INCLUDE_SUBSECTIONS" => "Y",
                                "SHOW_ALL_WO_SECTION" => "Y",
                                "HIDE_NOT_AVAILABLE" => "N",
                                "PAGE_ELEMENT_COUNT" => "12",
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
        <?}?>
        <div class="AuthorsWrapp">
            <p class="title"></p>
            <div class="searchBooksWrap">
                <div class="searchWidthWrapper">
                    <?foreach($arResult["SEARCH"] as $arItem) {
                        /***************
                        *
                        * $arItem["PARAM2"] хранится ID инфоблока, содержащего элемент результатов поиска
                        *
                        ****************/
                        // авторы в результатах поиска
                        if ($arItem["PARAM2"] == AUTHORS_IBLOCK_ID) { ?>

                            <div class="searchBook">
                                <div>
                                    <a href="<?= $arItem["URL"] ?>">
                                        <div class="search_item_img">
                                            <?
                                            $pict["src"] = $arResult["AUTHOR_INFO"][$arItem["ITEM_ID"]]["PICTURE"]["src"]
                                                ? $arResult["AUTHOR_INFO"][$arItem["ITEM_ID"]]["PICTURE"]["src"]
                                                : "/images/no_photo.png";
                                            $pict["width"] = $arResult["AUTHOR_INFO"][$arItem["ITEM_ID"]]["PICTURE"]["src"]
                                                ? ""
                                                : "155";
                                            ?>

                                            <img src="<?=$pict["src"]?>" <?if ($pict["width"] != ""){?>width="<?=$pict["width"]?>"<?}?>>

                                        </div>
                                    </a>
                                </div>
                                <div class="descrWrap">
                                    <a href="<?= $arItem["URL"] ?>">
                                        <p class="bookNames" title="<?= $arItem["TITLE"] ?>">
                                            <?= $arItem["TITLE"] ?>
                                        </p>


                                        <div class="description">
                                            <?=  $arResult["AUTHOR_INFO"][$arItem["ITEM_ID"]]["PROPERTY_AUTHOR_DESCRIPTION_VALUE"]["TEXT"] ?>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        <?}?>
                        <?// книги в результатах поиска
                        if ($arItem["PARAM2"] == CATALOG_IBLOCK_ID) {?>
                            <?if ($USER->IsAuthorized()) {// blackfriday черная пятница
                                if (($arResult["SAVINGS_DISCOUNT"][0]["SUMM"] < $arResult["SALE_NOTE"][0]["RANGE_FROM"])
                                    || ($arResult["SAVINGS_DISCOUNT"][0]["SUMM"] < $arResult["SALE_NOTE"][1]["RANGE_FROM"])) {

                                        $discount = $arResult["SALE_NOTE"][0]["VALUE"]; // процент накопительной скидки
                                } else {
                                    $discount = $arResult["SALE_NOTE"][1]["VALUE"];  // процент накопительной скидки
                                }
                            }
                            $item_discount_value = 0;
                            if ($discount) {
                                $newPrice = round (($arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["CATALOG_PRICE_1"]) * (1 - $discount / 100), 2);
                                if (strlen (stristr($newPrice, ".")) == 2) {
                                    $newPrice .= "0";
                                }
                            } else {
                                $newPrice = $arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["CATALOG_PRICE_1"];
                            }
                            if (!empty($arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["DISCOUNT_INFO"])) {
                                $item_discount_value = ceil($arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["DISCOUNT_INFO"]["VALUE"]);
                            }
                            if ($item_discount_value > 0) {
                               // arshow($arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["DISCOUNT_INFO"]["VALUE"]);
                                //$newPrice = $newPrice * (1 - $item_discount_value / 100);

								/*if ($discount) {
									$newPrice = round ($item_discount_value * (1 - $discount / 100), 2);
									if (strlen (stristr($newPrice, ".")) == 2) {
										$newPrice .= "0";
									}
								} else {
									$newPrice = $item_discount_value;
								}*/
								$newPrice = round ($item_discount_value * (1 - $discount / 100), 2);
								if (strlen (stristr($newPrice, ".")) == 2) {
									$newPrice .= "0";
								}
                            }
                            if($arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["IBLOCK_SECTION_ID"] == CERTIFICATE_SECTION_ID) {
                                $newPrice = $arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["CATALOG_PRICE_1"];
                            }

                            ?>
                            <??>
                            <div class="searchBook" itemprop="itemListElement" itemscope itemtype="http://schema.org/Book">
								<?$gdeslon .= $arItem["ITEM_ID"].':'.ceil( $newPrice).',';?>
                                <div>
                                    <a href="<?= $arItem["URL"]?>">
                                        <div class="search_item_img">
                                            <?if ($arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["PICTURE"]["src"]) {?>
                                                <img src="<?=$arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["PICTURE"]["src"]?>" itemprop="image">
                                            <?} else {?>
                                                <img src="/images/no_photo.png" width="155">
                                            <?}?>
                                        </div>
                                    </a>
                                </div>
                                <div class="descrWrap">
                                    <a href="<?= $arItem["URL"] ?>" itemprop="url">
                                        <p class="bookNames" title="<?= $arItem["TITLE"] ?>" itemprop="name"><?= $arItem["TITLE"] ?></p>
                                        <p class="autorName" itemprop="author"><?= $arResult["BOOK_AUTHOR_INFO"][$arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["PROPERTY_AUTHORS_VALUE"]]?></p>
                                        <p class="wrapperType"><?= $arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["PROPERTY_COVER_TYPE_VALUE"]?></p>
                                        <?if (($arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["PROPERTY_STATE_ENUM_ID"] != getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "soon"))
                                            && ($arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["PROPERTY_STATE_ENUM_ID"] != getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "net_v_nal"))) {
                                        ?>
                                                <p class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
												<link itemprop="availability" href="http://schema.org/InStock"><link itemprop="itemCondition" href="http://schema.org/NewCondition"><span itemprop="price"><?= ceil( $newPrice) ?></span><span class="rubsign"></span></p>
                                        <?} else if ($arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["PROPERTY_STATE_ENUM_ID"] == getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "soon")) {?>
                                                <p class="price">Ожидаемая дата выхода: <?= strtolower(FormatDate(
                                                    "j F",
                                                    MakeTimeStamp(
                                                        $arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["PROPERTY_SOON_DATE_TIME_VALUE"],
                                                        "DD.MM.YYYY"
                                                    )
                                                )); ?>
                                                </p>
                                        <?} else {?>
                                                <p class="price" style="color:red"><?= $arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["PROPERTY_STATE_VALUE"] ?></p>
                                        <?}?>
                                        <div class="description" itemprop="description"><?= $arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["PREVIEW_TEXT"]?></div>
                                        <?
                                        if ($arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["PROPERTY_STATE_ENUM_ID"] != getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "net_v_nal")) {
                                                if (($arResult["BASKET_ITEMS"][$arItem["ITEM_ID"]]["QUANTITY"] == 0) && ($arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["IBLOCK_SECTION_ID"] != CERTIFICATE_SECTION_ID)) {
                                                    $curr_sect_ID = $arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["IBLOCK_SECTION_ID"];?>
                                                    <a class="product<?= $arItem["ITEM_ID"]; ?>"
                                                        href="<?= '/search/index.php?action=ADD2BASKET&id=' . $arItem["ITEM_ID"] ?>"
                                                        onclick="addtocart(<?= $arItem["ITEM_ID"]; ?>, '<?= $arItem["TITLE"];?>', '<?= $arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["PROPERTY_STATE_ENUM_ID"];?>'); addToCartTracking(<?= $arItem["ITEM_ID"]; ?>, '<?= $arItem["TITLE"]; ?>', '<?= ceil( $arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["CATALOG_PRICE_1"]) ?>', '<?echo $arResult["BOOK_INFO"]["SECTIONS"][$curr_sect_ID]["SECTION_INFO"]['NAME'];?>', '1');return false;">
                                                        <?if(intval($arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["PROPERTY_STATE_ENUM_ID"]) != getXMLIDByCode (CATALOG_IBLOCK_ID, "STATE", "soon")) {?>
                                                            <p class="basket"><?=GetMessage("ADD_IN_BASKET")?></p>
                                                        <?} else {?>
                                                            <p class="basket"><?=GetMessage("ADD_TO_PREORDER")?></p>
                                                        <?}?>
                                                    </a>
                                                <?} elseif($arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["IBLOCK_SECTION_ID"] == CERTIFICATE_SECTION_ID) {?>
                                                    <a class="product<?= $arItem["ITEM_ID"]; ?>" href="<?=$arItem['URL'];?>">
                                                        <p class="basket">Купить</p>
                                                    </a>
                                                <?} else {?>
                                                    <a class="product<?= $arItem["ITEM_ID"]; ?>" href="/personal/cart/">
                                                        <p class="inBasket" style="background-color: #A9A9A9;color: white;">Оформить</p>
                                                    </a>
                                                <?}
                                        }
                                        ?>
                                    </a>
                                </div>
                            </div>
                        <?}?>
                        <?// серии в результатах поиска
                        if ($arItem["PARAM2"] == SERIES_IBLOCK_ID) {?>

                            <div class="searchBook">
                                <div>
                                    <a href="<?= $arItem["URL"] ?>">
                                        <div class="search_item_img">

                                        </div>
                                    </a>
                                </div>
                                <div class="descrWrap">
                                    <a href="<?= $arItem["URL"] ?>">
                                        <p class="bookNames" title="<?= $arItem["TITLE"] ?>"><?= $arItem["TITLE"] ?></p>


                                        <div class="description"><?= $arResult["SERIE_INFO"][$arItem["ITEM_ID"]]["PREVIEW_TEXT"] ?></div>
                                    </a>
                                </div>
                            </div>


                        <?}?>

                        <?// серии в результатах поиска
                        if ($arItem["PARAM2"] == EXPERTS_IBLOCK_ID) {?>
                            <?if ($USER->IsAuthorized()) {// blackfriday черная пятница
                                if (($arResult["SAVINGS_DISCOUNT"][0]["SUMM"] < $arResult["SALE_NOTE"][0]["RANGE_FROM"])
                                    || ($arResult["SAVINGS_DISCOUNT"][0]["SUMM"] < $arResult["SALE_NOTE"][1]["RANGE_FROM"])) {

                                        $discount = $arResult["SALE_NOTE"][0]["VALUE"]; // процент накопительной скидки
                                } else {
                                    $discount = $arResult["SALE_NOTE"][1]["VALUE"];  // процент накопительной скидки
                                }
                            }
                            $item_discount_value = 0;
                            ?>
                            <?foreach ($arResult["EXPERT_BOOK_INFO"] as $key => $exp_book_arr) {
                                if ($discount) {
                                    $newPrice = round (($exp_book_arr["CATALOG_PRICE_1"]) * (1 - $discount / 100), 2);
                                    if (strlen (stristr($newPrice, ".")) == 2) {
                                        $newPrice .= "0";
                                    }
                                } else {
                                    $newPrice = $exp_book_arr["CATALOG_PRICE_1"];
                                }
                                if (!empty($exp_book_arr["DISCOUNT_INFO"])) {
                                    $item_discount_value = ceil($exp_book_arr["DISCOUNT_INFO"]["VALUE"]);
                                }
                                if ($item_discount_value > 0) {
                                    // arshow($arResult["BOOK_INFO"][$arItem["ITEM_ID"]]["DISCOUNT_INFO"]["VALUE"]);
                                    $newPrice = $newPrice * (1 - $item_discount_value / 100);
                                }?>
                                <div class="searchBook">
                                    <div>
                                        <a href="/catalog/<?= $arResult["EXPERT_BOOK_INFO_SECTIONS"][$exp_book_arr["IBLOCK_SECTION_ID"]]["SECTION_INFO"]["CODE"] ?>/<?= $key ?>/">
                                            <div class="search_item_img">
                                                <?if ($exp_book_arr["PICTURE"]["src"]) {?>
                                                    <img src="<?=$exp_book_arr["PICTURE"]["src"]?>">
                                                <?} else {?>
                                                    <img src="/images/no_photo.png" width="155">
                                                <?}?>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="descrWrap">
                                        <a href="/catalog/<?= $arResult["EXPERT_BOOK_INFO_SECTIONS"][$exp_book_arr["IBLOCK_SECTION_ID"]]["SECTION_INFO"]["CODE"] ?>/<?= $key ?>/">
                                            <p class="bookNames" title="<?= $exp_book_arr["NAME"] ?>"><?= $exp_book_arr["NAME"] ?></p>
                                            <p class="autorName"><?= $arResult["BOOK_AUTHOR_INFO"][$exp_book_arr["PROPERTY_AUTHORS_VALUE"]]["NAME"] ?></p>
                                            <p class="wrapperType"><?= $exp_book_arr["PROPERTY_COVER_TYPE_VALUE"]?></p>
                                            <?if (($exp_book_arr["PROPERTY_STATE_ENUM_ID"] != getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "soon"))
                                                && ($exp_book_arr["PROPERTY_STATE_ENUM_ID"] != getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "net_v_nal"))) {
                                            ?>
                                                    <p class="price"><?= ceil( $newPrice) ?><span class="rubsign"></span></p>
                                            <?} else if ($exp_book_arr["PROPERTY_STATE_ENUM_ID"] == getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "soon")) {?>
                                                    <p class="price">Ожидаемая дата выхода: <?= strtolower(FormatDate(
                                                        "j F",
                                                        MakeTimeStamp(
                                                            $exp_book_arr["PROPERTY_SOON_DATE_TIME_VALUE"],
                                                            "DD.MM.YYYY HH:MI:SS"
                                                        )
                                                    )); ?>
                                                    </p>
                                            <?} else {?>
                                                    <p class="price" style="color:red"><?= $exp_book_arr["PROPERTY_STATE_VALUE"] ?></p>
                                            <?}?>
                                            <div class="description"><?= $exp_book_arr["PREVIEW_TEXT"]?></div>
                                            <?
                                            if (($exp_book_arr["PROPERTY_STATE_ENUM_ID"] != getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "soon"))
                                                && ($exp_book_arr["PROPERTY_STATE_ENUM_ID"] != getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "net_v_nal"))) {
                                                    if ($arResult["BASKET_ITEMS"][$key]["QUANTITY"] == 0) {
                                                        $curr_sect_ID = $exp_book_arr["IBLOCK_SECTION_ID"];?>
                                                        <a class="product<?= $key; ?>"
                                                            href="<?= '/search/index.php?action=ADD2BASKET&id=' . $key ?>"
                                                            onclick="addtocart(<?= $key; ?>, '<?= $exp_book_arr["NAME"];?>'); addToCartTracking(<?= $key; ?>, '<?= $exp_book_arr["NAME"]; ?>', '<?= ceil( $exp_book_arr["CATALOG_PRICE_1"]) ?>', '<?echo $arResult["EXPERT_BOOK_INFO_SECTIONS"][$curr_sect_ID]["SECTION_INFO"]['NAME'];?>', '1');return false;">
                                                                <p class="basket">В корзину</p>
                                                        </a>
                                                    <?} else {?>
                                                        <a class="product<?= $key; ?>" href="/personal/cart/">
                                                            <p class="inBasket" style="background-color: #A9A9A9;color: white;">Оформить</p>
                                                        </a>
                                                    <?}
                                            }
                                            ?>
                                        </a>
                                    </div>
                                </div>
                            <?}?>



                        <?}?>
                    <?}?>
                </div>
            </div>
        </div>

        <p>
        </p>
		<!-- gdeslon -->
		<script type="text/javascript" src="https://www.gdeslon.ru/landing.js?mode=list&amp;codes=<?=substr($gdeslon,0,-1)?>&amp;mid=79276&amp;cat_id=<?= $arResult['ID'];?>"></script>

    <?} else {?>
        <div class="catalogIcon">
        </div>
        <div class="basketIcon">
        </div>
<?/* Получаем рекомендации для поиска от RetailRocket */
        global $arrFilter;
        $stringRecs = file_get_contents('https://api.retailrocket.ru/api/1.0/Recomendation/SearchToItems/50b90f71b994b319dc5fd855/?keyword=' . $arResult["REQUEST"]["QUERY"]);
        $recsArray = json_decode($stringRecs);
        $arrFilter = Array('ID' => (array_slice($recsArray, 0, 5)));
        if ($arrFilter['ID'][0] > 0) {?>

            <div class="interestingWrap">
                <div class="catalogWrapper">
                    <p class="title">Те, кто искали «<?= $arResult["REQUEST"]["QUERY"] ?>» купили</p>

                    <div class="bookEasySlider">
                        <?
                        if(!$USER->IsAdmin()){
                            $arrFilter["!PROPERTY_FOR_ADMIN_VALUE"] = "Y";
                        }
                        $APPLICATION->IncludeComponent(
                            "bitrix:catalog.section",
                            "recommended_books",
                            array(
                                "IBLOCK_TYPE_ID" => "catalog",
                                "IBLOCK_ID" => CATALOG_IBLOCK_ID,
                                "BASKET_URL" => "/personal/cart/",
                                "COMPONENT_TEMPLATE" => "recommended_books",
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
                                "FILTER_NAME" => "arrFilter",
                                "INCLUDE_SUBSECTIONS" => "Y",
                                "SHOW_ALL_WO_SECTION" => "Y",
                                "HIDE_NOT_AVAILABLE" => "N",
                                "PAGE_ELEMENT_COUNT" => "12",
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
        <?}?>
        <div class="noResultBodyWrap">
            <div class="centerWrapper noResWrapp">
                <p class="noResultTitle">По вашему запросу ничего не найдено</p>
                <p class="noResText">К сожалению, по запросу "<?= $_REQUEST["q"] ?>" ничего не найдено, попробуйте изменить поисковый запрос или следуйте нашим рекомендациям.</p>
            </div>
        </div>
		<script type="text/javascript">
			$(document).ready(function() {
				dataLayer.push({
					event: 'searchResults',
					action: 'nothingFound',
					label: '<?=$_REQUEST["q"]?>'
				});
			});
		</script>
        <div class="categoryWrapperWhite">
            <div class="interestSlideWrap">
                <?
                if (isset($_COOKIE["rrpusid"])){
                    global $arrFilter;
                    $stringRecs = file_get_contents('https://api.retailrocket.ru/api/1.0/Recomendation/PersonalRecommendation/50b90f71b994b319dc5fd855/?rrUserId='.$_COOKIE["rrpusid"]);
                    $recsArray = json_decode($stringRecs);
                    $arrFilter = Array('ID' => (array_slice($recsArray, 0, 6)));
                }
                    if(!$USER->IsAdmin()){
                        $arrFilter["!PROPERTY_FOR_ADMIN_VALUE"] = "Y";
                    }
                if ($arrFilter['ID'][0] > 0) {
                    $APPLICATION->IncludeComponent("bitrix:catalog.section", "interesting_items", Array(
                        "IBLOCK_TYPE_ID" => "catalog",
                        "IBLOCK_ID" => CATALOG_IBLOCK_ID,    // Инфоблок
                        "BASKET_URL" => "/personal/cart/",    // URL, ведущий на страницу с корзиной покупателя
                        "COMPONENT_TEMPLATE" => "template1",
                        "IBLOCK_TYPE" => "catalog",    // Тип инфоблока
                        "SECTION_ID" => "",    // ID раздела
                        "SECTION_CODE" => "",    // Код раздела
                        "SECTION_USER_FIELDS" => array(    // Свойства раздела
                            0 => "",
                            1 => "",
                        ),
                        "ELEMENT_SORT_FIELD" => "id",    // По какому полю сортируем элементы
                        "ELEMENT_SORT_ORDER" => "desc",    // Порядок сортировки элементов
                        "ELEMENT_SORT_FIELD2" => "id",    // Поле для второй сортировки элементов
                        "ELEMENT_SORT_ORDER2" => "desc",    // Порядок второй сортировки элементов
                        "FILTER_NAME" => "arrFilter",    // Имя массива со значениями фильтра для фильтрации элементов
                        "INCLUDE_SUBSECTIONS" => "Y",    // Показывать элементы подразделов раздела
                        "SHOW_ALL_WO_SECTION" => "Y",    // Показывать все элементы, если не указан раздел
                        "HIDE_NOT_AVAILABLE" => "N",    // Не отображать товары, которых нет на складах
                        "PAGE_ELEMENT_COUNT" => "12",    // Количество элементов на странице
                        "LINE_ELEMENT_COUNT" => "3",    // Количество элементов выводимых в одной строке таблицы
                        "PROPERTY_CODE" => array(    // Свойства
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
                        "OFFERS_LIMIT" => "5",    // Максимальное количество предложений для показа (0 - все)
                        "TEMPLATE_THEME" => "site",    // Цветовая тема
                        "PRODUCT_DISPLAY_MODE" => "Y",
                        "ADD_PICT_PROP" => "BIG_PHOTO",    // Дополнительная картинка основного товара
                        "LABEL_PROP" => "-",    // Свойство меток товара
                        "OFFER_ADD_PICT_PROP" => "-",
                        "OFFER_TREE_PROPS" => array(
                            0 => "COLOR_REF",
                            1 => "SIZES_SHOES",
                            2 => "SIZES_CLOTHES",
                        ),
                        "PRODUCT_SUBSCRIPTION" => "N",    // Разрешить оповещения для отсутствующих товаров
                        "SHOW_DISCOUNT_PERCENT" => "N",    // Показывать процент скидки
                        "SHOW_OLD_PRICE" => "Y",    // Показывать старую цену
                        "SHOW_CLOSE_POPUP" => "N",    // Показывать кнопку продолжения покупок во всплывающих окнах
                        "MESS_BTN_BUY" => "Купить",    // Текст кнопки "Купить"
                        "MESS_BTN_ADD_TO_BASKET" => "В корзину",    // Текст кнопки "Добавить в корзину"
                        "MESS_BTN_SUBSCRIBE" => "Подписаться",    // Текст кнопки "Уведомить о поступлении"
                        "MESS_BTN_DETAIL" => "Подробнее",    // Текст кнопки "Подробнее"
                        "MESS_NOT_AVAILABLE" => "Нет в наличии",    // Сообщение об отсутствии товара
                        "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
                        "DETAIL_URL" => "",    // URL, ведущий на страницу с содержимым элемента раздела
                        "SECTION_ID_VARIABLE" => "SECTION_ID",    // Название переменной, в которой передается код группы
                        "SEF_MODE" => "N",    // Включить поддержку ЧПУ
                        "AJAX_MODE" => "N",    // Включить режим AJAX
                        "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
                        "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
                        "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
                        "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
                        "CACHE_TYPE" => "A",    // Тип кеширования
                        "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                        "CACHE_GROUPS" => "Y",    // Учитывать права доступа
                        "SET_TITLE" => "Y",    // Устанавливать заголовок страницы
                        "SET_BROWSER_TITLE" => "Y",    // Устанавливать заголовок окна браузера
                        "BROWSER_TITLE" => "-",    // Установить заголовок окна браузера из свойства
                        "SET_META_KEYWORDS" => "Y",    // Устанавливать ключевые слова страницы
                        "META_KEYWORDS" => "-",    // Установить ключевые слова страницы из свойства
                        "SET_META_DESCRIPTION" => "Y",    // Устанавливать описание страницы
                        "META_DESCRIPTION" => "-",    // Установить описание страницы из свойства
                        "SET_LAST_MODIFIED" => "N",    // Устанавливать в заголовках ответа время модификации страницы
                        "USE_MAIN_ELEMENT_SECTION" => "N",    // Использовать основной раздел для показа элемента
                        "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
                        "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
                        "ACTION_VARIABLE" => "action",    // Название переменной, в которой передается действие
                        "PRODUCT_ID_VARIABLE" => "id",    // Название переменной, в которой передается код товара для покупки
                        "PRICE_CODE" => array(    // Тип цены
                            0 => "BASE",
                        ),
                        "USE_PRICE_COUNT" => "N",    // Использовать вывод цен с диапазонами
                        "SHOW_PRICE_COUNT" => "1",    // Выводить цены для количества
                        "PRICE_VAT_INCLUDE" => "Y",    // Включать НДС в цену
                        "CONVERT_CURRENCY" => "N",    // Показывать цены в одной валюте
                        "USE_PRODUCT_QUANTITY" => "N",    // Разрешить указание количества товара
                        "PRODUCT_QUANTITY_VARIABLE" => "",    // Название переменной, в которой передается количество товара
                        "ADD_PROPERTIES_TO_BASKET" => "Y",    // Добавлять в корзину свойства товаров и предложений
                        "PRODUCT_PROPS_VARIABLE" => "prop",    // Название переменной, в которой передаются характеристики товара
                        "PARTIAL_PRODUCT_PROPERTIES" => "N",    // Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
                        "PRODUCT_PROPERTIES" => "",    // Характеристики товара
                        "OFFERS_CART_PROPERTIES" => array(
                            0 => "COLOR_REF",
                            1 => "SIZES_SHOES",
                            2 => "SIZES_CLOTHES",
                        ),
                        "ADD_TO_BASKET_ACTION" => "ADD",    // Показывать кнопку добавления в корзину или покупки
                        "PAGER_TEMPLATE" => "round",    // Шаблон постраничной навигации
                        "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
                        "DISPLAY_BOTTOM_PAGER" => "Y",    // Выводить под списком
                        "PAGER_TITLE" => "Товары",    // Название категорий
                        "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
                        "PAGER_DESC_NUMBERING" => "N",    // Использовать обратную навигацию
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
                        "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
                        "PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
                        "SET_STATUS_404" => "N",    // Устанавливать статус 404
                        "SHOW_404" => "N",    // Показ специальной страницы
                        "MESSAGE_404" => "",    // Сообщение для показа (по умолчанию из компонента)
                        "BACKGROUND_IMAGE" => "-",    // Установить фоновую картинку для шаблона из свойства
                        ),
                        false
                    );
                }?>
            </div>
        </div>
    <?}?>
</div>

<script>

var x = function(a, i) {
  return a.slice(0, i).join(' ');
};

/**
 * requires element to be width/height limited
 * element must be in the DOM and can't be with display none, put it with visibility hidden instead
 * element shall have no sub elements either O:)
 */
var ellipsisFill = function(e) {
  var d = '...',
      h = e.offsetHeight,
      w = e.innerHTML.split(' '),
      i = 0,
      l = w.length;
  e.innerHTML = '';
  while (h >= e.scrollHeight && i <= l) {
    e.innerHTML = x(w, ++i) + d;
  }
  if (i > l) { e.innerHTML = x(w,   i);     }
  else {       e.innerHTML = x(w, --i) + d; }
};


$(document).ready(function(){

    var elii = document.querySelectorAll('.bookNames');
    Array.prototype.forEach.call(elii, function(el, i){
           ellipsisFill(el);
    })



    updateSearchPage();


    // слайдер "те кто искали ..., купили"
    if($('.bookEasySlider').length > 0) {
        easySlider('.bookEasySlider', 6);
    }
    // скрывать заголовок блоков, если данный блок не содержит элементов
    if ($(".AuthorsWrapp .searchWidthWrapper .searchBook").size() == 0) {
        $(".AuthorsWrapp .title").hide();
    }
    if ($(".BooksWrapp .searchWidthWrapper .searchBook").size() == 0) {
        $(".BooksWrapp .title").hide();
    }
    if ($(".SeriesWrapp .searchWidthWrapper .searchBook").size() == 0) {
        $(".SeriesWrapp .title").hide();
    }
});

</script>