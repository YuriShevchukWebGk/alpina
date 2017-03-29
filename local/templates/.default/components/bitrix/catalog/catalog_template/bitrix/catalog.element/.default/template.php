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
<?
###
#Тест вкладок электронной и бумажной версий
###
if ($arResult["PROPERTIES"]["alpina_digital_ids"]['VALUE'] > 0 && !checkMobile()) {
	$alpExps = unserialize($APPLICATION->get_cookie("alpExps"));
	$alpExps  = (!$alpExps ? array() : $alpExps);

	if ($alpExps['updateExp'] != "130317") {
		$alpExps = array();
		$alpExps['updateExp'] = "130317";
	}

	$alpExps['selectVersion']    = (!$alpExps['selectVersion'] ? rand(1,2) : $alpExps['selectVersion']);
	if ($alpExps['selectVersion'] == 1) {?>
		<script>
			$(document).ready(function() {
				dataLayer.push({'event' : 'ab-test-gtm', 'action' : 'selectVersion', 'label' : 'withDigitalButton'});
				console.log('withDigitalButton');
			});
		</script>
	<?} elseif ($alpExps['selectVersion'] == 2) {?>
		<script>
			$(document).ready(function() {
				dataLayer.push({'event' : 'ab-test-gtm', 'action' : 'selectVersion', 'label' : 'withoutDigitalButton'});
				console.log('withoutDigitalButton');
			});
		</script>
	<?}
	$APPLICATION->set_cookie("alpExps", serialize($alpExps));
}
?>
<?$frame = $this->createFrame()->begin();?>
<script>
$(document).ready(function(){
	<!-- //dataLayer GTM -->
	dataLayer.push({
		'stockInfo' : '<?= $StockInfo ?>',
		'productId' : '<?= $arResult["ID"] ?>',
		'productName' : '<?= $arResult["NAME"] ?>',
		'productPrice' : '<?= round (($arPrice["DISCOUNT_VALUE_VAT"]), 2) ?>',
		'videoPresence' : '<?= $videosCount > 0 ? 'WithVideo' : 'WithoutVideo'; ?>'
	});
	<!-- // dataLayer GTM -->

	$(".elementMainPict .overlay").css("height", $(".element_item_img img").height());
	$(".elementMainPict .overlay p").css("margin-top", ($(".elementMainPict .overlay").height() / 2) - 10);
	if ($(".element_item_img img").height() < 394 && $(".element_item_img img").height() > 100) {
		$(".element_item_img").height($(".element_item_img img").height());
	}
	$("a#inline1, a#inline2, a#inline3").fancybox({
		'hideOnContentClick': true
	});
	if ($(".grouped_elements").length > 0) {

		$("a.grouped_elements").fancybox({
			'transitionIn'    :    'elastic',
			'transitionOut'    :    'elastic',
			'speedIn'        :    600,
			'speedOut'        :    200,
			'overlayShow'    :    false
		});

	}

	if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
	   $('.elementMainPict .fancybox').attr('target', '_blank');
	   $('.elementMainPict .fancybox').removeClass('fancybox');
	}else{
		$('.elementMainPict .fancybox').fancybox({
			'centerOnScroll' : true,
			'scrolling'      : true,
			'showNavArrows'  : true
		});
	}

	$('a.fancybox').fancybox({
		'width'   :   1140,
		'height'   :   800
	});
	$(".leftColumn .signingPopup").fancybox({
		<?if ($arResult["SIGNING_IMAGE_INFO"]["WIDTH"]) {?>
			'width'   :   <?= $arResult["SIGNING_IMAGE_INFO"]["WIDTH"] ?>+20,
			'height'   :   <?= $arResult["SIGNING_IMAGE_INFO"]["HEIGHT"] ?>+20,
			'scrolling'      : false
		<?} else {?>
			'width'   :   1140,
			'height'   :   800,
			'scrolling'      : false
		<?}?>
	});

	if (window.innerWidth <= 1500) {
		$(".catalogIcon").hide();
		$(".basketIcon").hide();
	}

	$(".buyLater").click(function(){
		$.post("/ajax/ajax_add2wishlist.php", {id: <?= $arResult["ID"] ?>}, function(data){
			$(".layout").show();
			$(".wishlist_info").css("top", window.pageYOffset+"px")
			$(".wishlist_info").show();
			$(".wishlist_info span").html(data);

		})
	});
	docReadyComponent();
});
</script>
<?
include_once($_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/include/colors.inc.php');

$image_to_read = $_SERVER["DOCUMENT_ROOT"] . "/" .$arResult["PICTURE"]["src"];

$colors_to_show = 8;

$pal = new GetMostCommonColors();
$pal->image = $image_to_read;
$colors=$pal->Get_Color();
$colors_key=array_keys($colors);
$mincolor = array();

$bgcolors = array();
for ($i = 0; $i < $colors_to_show; $i++) {
	$bgcolors[] = "#".$colors_key[$i];   
	$hexToRgbMess = hexToRgb($bgcolors[$i]); 
	$mincolor[$i]['sum'] = $hexToRgbMess['red'] + $hexToRgbMess['green'] + $hexToRgbMess['blue'];
	$mincolor[$i]['color'] = "#".$colors_key[$i];
}     
$mincolor = min($mincolor);

$m = 0;
$hexToRgbMess = hexToRgb($bgcolors[$m]); 
while ($hexToRgbMess['red'] > 190 && $hexToRgbMess['green'] > 190 && $hexToRgbMess['blue'] > 190 || ($hexToRgbMess['red'] > 200 && $hexToRgbMess['green'] > 200 && $hexToRgbMess['blue'] < 100) || ($hexToRgbMess['red'] > 190 && $hexToRgbMess['green'] < 90 && $hexToRgbMess['blue'] < 90)) {
	$m++;                                    
	$bgcolors[0] = $bgcolors[$m];
	$hexToRgbMess = hexToRgb($bgcolors[$m]);
}
$hexToRgbMess = hexToRgb($bgcolors[$m]);     
$bgsum = $hexToRgbMess['red'] + $hexToRgbMess['green'] + $hexToRgbMess['blue'];

if ($bgsum < 20)
	$bgcolors[0] = "#777777";

if ($mincolor['sum'] > 320 || ($mincolor['sum'] > 280 && $mincolor['color'] == $bgcolors[0]) || $mincolor['color'] == '#') {
	$mincolor['color'] = "#555";
}
?>
<style>
	.productElementWrapp:before {
		background-color: <?=$bgcolors[0]?>;
		opacity: 0.3;
	}
	.centerColumn .productName, .breadCrump span a, .breadCrump, .centerColumn .engBookName, .centerColumn .productAutor, .catalogIcon span, .basketIcon span, .crr, .crr .mc-star span, #diffversions .passive {
		color: <?=$mincolor['color']?>!important;
	}
	#diffversions .passive span {
		border-bottom: 1px dashed <?=$mincolor['color']?>;
	}
	.catalogIcon {
		background: <?=$bgcolors[0]?> url(/img/catalogIco.png) no-repeat center;
		opacity: 0.8;
	}
	.basketIcon {
		background: <?=$bgcolors[0]?> url(/img/basketIcoHovers.png) no-repeat center;
		opacity: 0.8;
	}		
</style>

<?if ($USER->isAdmin()) {
	$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE"=>"Y", "ID"=>$arResult["ID"]);
	$props = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, Array("ID","NAME", "SHOW_COUNTER", "SHOW_COUNTER_START"));
	$props = $props->GetNext();
	{?>
		<script>
			function shown() {
				$('.typesOfProduct').before('<div style="margin-left:25px;width:205px;height:49px;"><div style="width: 205px; height: 49px; background: <?=$bgcolors[0]?>; position: absolute; opacity: 0.3;"></div><span style="color:<?=$mincolor['color']?>;font-family: \'Walshein_regular\';font-size:15px;padding: 3px 0 3px 5px; display: block;"><?echo "За последний день книгу просмотрели ".round(($props[SHOW_COUNTER]/(((time() - strtotime($props[SHOW_COUNTER_START]))/3600/24)))*2)." человека"?></span></div>');
			};
			setTimeout(shown, 1000);
		</script>
	<?}?>
<?}?>

<?$this->setFrameMode(true);
$templateLibrary = array('popup');
$currencyList = '';
if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}
$templateData = array(
    'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
    'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES' => $currencyList,    
    'OG_IMAGE' => $arResult["PICTURE"]["src"]
);
unset($currencyList, $templateLibrary);

$strMainID = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = array(
    'ID' => $strMainID,
    'PICT' => $strMainID.'_pict',
    'DISCOUNT_PICT_ID' => $strMainID.'_dsc_pict',
    'STICKER_ID' => $strMainID.'_sticker',
    'BIG_SLIDER_ID' => $strMainID.'_big_slider',
    'BIG_IMG_CONT_ID' => $strMainID.'_bigimg_cont',
    'SLIDER_CONT_ID' => $strMainID.'_slider_cont',
    'SLIDER_LIST' => $strMainID.'_slider_list',
    'SLIDER_LEFT' => $strMainID.'_slider_left',
    'SLIDER_RIGHT' => $strMainID.'_slider_right',
    'OLD_PRICE' => $strMainID.'_old_price',
    'PRICE' => $strMainID.'_price',
    'DISCOUNT_PRICE' => $strMainID.'_price_discount',
    'SLIDER_CONT_OF_ID' => $strMainID.'_slider_cont_',
    'SLIDER_LIST_OF_ID' => $strMainID.'_slider_list_',
    'SLIDER_LEFT_OF_ID' => $strMainID.'_slider_left_',
    'SLIDER_RIGHT_OF_ID' => $strMainID.'_slider_right_',
    'QUANTITY' => $strMainID.'_quantity',
    'QUANTITY_DOWN' => $strMainID.'_quant_down',
    'QUANTITY_UP' => $strMainID.'_quant_up',
    'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
    'QUANTITY_LIMIT' => $strMainID.'_quant_limit',
    'BASIS_PRICE' => $strMainID.'_basis_price',
    'BUY_LINK' => $strMainID.'_buy_link',
    'ADD_BASKET_LINK' => $strMainID.'_add_basket_link',
    'BASKET_ACTIONS' => $strMainID.'_basket_actions',
    'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
    'COMPARE_LINK' => $strMainID.'_compare_link',
    'PROP' => $strMainID.'_prop_',
    'PROP_DIV' => $strMainID.'_skudiv',
    'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
    'OFFER_GROUP' => $strMainID.'_set_group_',
    'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
);
?>
            <div class="elementDescriptWrap" itemprop="mainEntity" itemscope itemtype="https://schema.org/Book">
                <meta itemprop="inLanguage" content="ru-RU"/>
                <div class="leftColumn">
                    <div class="elementMainPict">
                        <div class="badge">
                            <?if (($arResult["PROPERTIES"]["discount_ban"]["VALUE"] != "Y")
                                && $arResult['PROPERTIES']['spec_price']['VALUE']
                                && $arResult['PROPERTIES']['show_discount_icon']['VALUE'] == "Y") {
                                if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/img/" . $arResult['PROPERTIES']['spec_price']['VALUE'] . "percent.png")) {
                                    echo '<img class="discount_badge" src="/img/' . $arResult['PROPERTIES']['spec_price']['VALUE'] . 'percent.png">';
                                }
                            }?>
                        </div>
                        <?
                            if (isset($arResult["additional_image"]["DETAIL_PICTURE"]["src"])) {
                                echo '<div class="additional-image" ><img src="' . $arResult["additional_image"]["DETAIL_PICTURE"]["src"] . '"></div>';
                            }
                        ?>

                        <div class="bookPages">
                            <?
                                if ($arResult["MAIN_PICTURE"]) {?>
                                <a class="grouped_elements" rel="group1" href="<?= $arResult["MAIN_PICTURE"] ?>"><img src="<?= $arResult["MAIN_PICTURE"] ?>"></a>
                                <?}
                            ?>
                        </div>
                        <div class="element_item_img">
                            <?if (($arResult["PHOTO_COUNT"] > 0) && ($arResult["MAIN_PICTURE"] != '')) {?>
                                <a href="<?= $arResult["MAIN_PICTURE"] ?>" class="fancybox fancybox.iframe bookPreviewLink">

                                    <p class="bookPreviewButton bookPreviewLink"><?= GetMessage("BROWSE_THE_BOOK") ?></p>
                                    <?}?>
                                <?if ($arResult["PICTURE"]["src"]) {?>
                                    <img src="<?= $arResult["PICTURE"]["src"] ?>" itemprop="image" class="bookPreviewLink" alt="<?= $arResult["NAME"] ?>" title="<?= $arResult["NAME"] ?>" />
                                    <?} else {?>
                                    <img src="/images/no_photo.png">
                                    <?}?>
                                <?if(!empty($arResult["PROPERTIES"]["number_volumes"]["VALUE"])) {?>
                                    <span class="volumes"><?= $arResult["PROPERTIES"]["number_volumes"]["VALUE"] ?></span>
                                    <?}?>
                                <?if (($arResult["PHOTO_COUNT"] > 0) && ($arResult["MAIN_PICTURE"] != '')) {?>
                                </a>
                                <?}?>
                        </div>
                    </div>
                    <div class="marks">
                        <?if ($arResult["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"] == NEW_BOOK_STATE_XML_ID) {?>
                            <div class="newBookMark">
                                <p><?= GetMessage("NEW_BOOK") ?></p>
                                <span class="ttip">
                                    <?= GetMessage("NEW_BOOK_TIP") ?>
                                </span>
                            </div>
                        <?}?>
                        <?if ($arResult["PROPERTIES"]["best_seller"]["VALUE_ENUM_ID"] == BESTSELLER_BOOK_XML_ID) {?>
                            <div class="bestBookMark">
                                <p><?= GetMessage("BESTSELLER_BOOK") ?></p>
                                <span class="ttip">
                                    <?= GetMessage("BESTSELLER_TIP") ?>
                                </span>
                            </div>
                        <?}?>
                        <?if ($arResult["PROPERTIES"]["editors_choice"]["VALUE_ENUM_ID"] == 235) {?>
                            <div class="editorsBookMark">
                                <p><?= GetMessage("EDITORS_CHOICE") ?></p>
                                <span class="ttip">
                                    <?= GetMessage("EDITORS_CHOICE_TIP") ?>
                                </span>
                            </div>
                        <?}?>

                        <?if ((!empty($arResult["PROPERTIES"]["appstore"]['VALUE']) || !empty($arResult["PROPERTIES"]["rec_for_ad"]['VALUE'])) && $arResult['PROPERTIES']['STATE']['VALUE_XML_ID'] != 'soon' && $arResult["ID"] != 81365 && $arResult['PROPERTIES']['STATE']['VALUE_XML_ID'] != 'net_v_nal') {?>

                            <?if (!empty($arResult["PROPERTIES"]["appstore"]['VALUE'])) {?>
                                <div class="digitalBookMark">
                                    <p><span class="test"><?=GetMessage("FREE_DIGITAL_BOOK") ?></span></p>
                                    <span class="ttip"><?=GetMessage("YOU_WILL_GET_FREE_DIGITAL_BOOK");?></span>
                                </div>
                            <?}/* elseif (!empty($arResult["PROPERTIES"]["rec_for_ad"]['VALUE'])) {
                                $recBook = CIBlockElement::GetByID($arResult["PROPERTIES"]["rec_for_ad"]['VALUE']);
                                if($recBookName = $recBook->GetNext()) {?>
                                    <div class="digitalBookMark">
                                        <p><span class="test">Бесплатная электронная версия книги «<?=substr($recBookName['NAME'],0,30)?><?echo strlen($recBookName['NAME']) > 30 ? '...' : '';?>» в комплекте</span></p>
                                        <span class="ttip"><?echo GetMessage("YOU_WILL_GET_A_DIGITAL_BOOK") . $recBookName['NAME'] . GetMessage("BOOK_FOR_GIFT");?></span>
                                    </div>
                                <?}
                            }*/?>
                        <?}?>
                    </div>

                    <?if ($arResult["PROPERTIES"]["AUTHOR_SIGNING"]["VALUE"]) {?>
                        <a href="<?= $arResult["SIGN_PICTURE"] ?>" class="fancybox fancybox.iframe signingPopup">
                            <div class="authorSigning">
                            </div>

                            <div class="authorSigningText">
                                <?= GetMessage("SIGNED_BOOK") ?>
                            </div>
                        </a>
                        <?}?>
                    <?if ($USER -> IsAuthorized()) {
                        if ($arResult["WISHLIST_ITEM"]) {?>
                        <a href="/personal/cart/?liked=yes" title="<?= GetMessage("WISHLIST_IN_BASKET") ?>">
                            <p class="AlreadyInWishlist"><?= GetMessage("ALREADY_IN_WISHLIST") ?></p>
                        </a>
                        <?} else {?>
                        <a href="javascript:void(0); return true;" onclick="dataLayer.push({event: 'addToWishList'});yaCounter1611177.reachGoal('addToWishlist');">
                            <p class="buyLater"><?= GetMessage("TO_BUY_LATER") ?></p>
                        </a>
                        <?}
                    }?>
                    <div class="wishlist_info">
                        <div class="CloseWishlist"><img src="/img/catalogLeftClose.png"></div>
                        <span></span>
                    </div>
                    <?if (!empty($arResult["PROPERTIES"]["glavatitle"]["VALUE"])) {?>
						<style>
						.productElementWrapp {min-height:1300px;}
						.authorBooksWrapp, .weRecomWrap {clear:both;}
						</style>
						<div class="takePartWrap" style="display:block;margin-bottom:5px;height:auto; border-bottom: 1px solid #dddddd; margin-top:0px;">
							<p class="title"><?= GetMessage("TO_GET_A_CHAPTER") ?></p>
							<p class="text">Глава «<?=$arResult["PROPERTIES"]["glavatitle"]["VALUE"]?>» будет отправлена вам на почту</p>
							<input type="text" placeholder="<?= GetMessage("YOUR_EMAIL") ?>" value="<?= $arResult["MAIL"]; ?>" id="chapter-email" /><button onclick="sendchapter(<?=$arResult[ID];?>);" style="position: relative;left: 217px;top: -36px;border: none;width: 41px;height: 36px;cursor: pointer;background: transparent;">
						</div>
					<?}?>
					<?if ($arResult["PROPERTIES"]["ol_opis"]["VALUE_ENUM_ID"] != 233) {?>
						<?if ($arResult["PROPERTIES"]["PUBLISHER"]["VALUE"]) {?>
							<div class="characteris">
								<p class="title"><?= GetMessage("PUBLISHER") ?></p>
								<p class="text">
									<span itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
										<span itemprop="name">
											<?= $arResult["PROPERTIES"]["PUBLISHER"]["VALUE"] ?>
										</span>
										<?if (strstr($arResult["PROPERTIES"]["PUBLISHER"]["VALUE"], "Альпина") !== false) {?>
											<meta itemprop="telephone" content="+7 (495) 980-80-77" />
											<meta itemprop="address" content="г.Москва, ул.4-ая Магистральная, д.5, подъезд 2, этаж 2" />
										<?}?>
									</span>
								</p>
							</div>
						<?}?>
						<?if($arResult["PROPERTIES"]["YEAR"]["VALUE"] != "" && $arResult["PROPERTIES"]["ol_opis"]["VALUE_ENUM_ID"] != 233) {?>
							<div class="characteris">
								<p class="title"><?= $arResult["PROPERTIES"]["YEAR"]["NAME"] ?></p>
								<p class="text">
									<span itemprop="datePublished">
										<?= $arResult["PROPERTIES"]["YEAR"]["VALUE"] ?>
									</span>
									г.
									<?= !empty($arResult["PROPERTIES"]["edition_n"]["VALUE"]) ? '<br /><span itemprop="bookEdition">' . $arResult["PROPERTIES"]["edition_n"]["VALUE"] .'</span>' : ""?>
								</p>
							</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["SERIES"]["VALUE"]) {?>
							<div class="characteris">
								<p class="title"><?= GetMessage("SERIES") ?></p>
								<a href="/series/<?= $arResult["CURR_SERIES"]["ID"] ?>/">
									<span class="text"><?= $arResult["CURR_SERIES"]["NAME"] ?></span>
								</a>
							</div>
						<?}?>
						<?if($arResult["PROPERTIES"]["COVER_TYPE"]["VALUE"] != "") {?>
							<div class="characteris epubHide">
								<p class="title"><?= GetMessage("COVER_TYPE") ?></p>
								<p class="text"><?= $arResult["PROPERTIES"]["COVER_TYPE"]["VALUE"] ?></p>
								<?if ($arResult["PROPERTIES"]['COVER_TYPE']['VALUE_ENUM_ID'] == COVER_TYPE_SOFTCOVER_XML_ID) {?>
									<link itemprop="bookFormat" href="https://schema.org/Paperback">
								<?} else if ($arResult["PROPERTIES"]['COVER_TYPE']['VALUE_ENUM_ID'] == COVER_TYPE_HARDCOVER_XML_ID) {?>
									<link itemprop="bookFormat" href="https://schema.org/Hardcover">
								<?}?>
							</div>
						<?}?>
						<div class="characteris epub" style="display:none;">
							<p class="title">Форматы</p>
							<p class="text">epub</p>
						</div>
						<?if ($arResult['CAN_BUY'] && $arResult['PROPERTIES']['STATE']['VALUE_XML_ID'] != 'soon' && $arResult["PROPERTIES"]["COVER_TYPE"]["VALUE"] != 'Аудиодиск' && $arResult["PROPERTIES"]["ol_opis"]["VALUE_ENUM_ID"] != 233) {?>
							<div class="characteris epubHide">
								<a href="http://www.alpinab2b.ru/spetsialnyy-tirazh/" target="_blank" onclick="dataLayer.push({event: 'otherEvents', action: 'specialEditionLink', label: '<?= $arResult['NAME'] ?>'});"><span class="text noborderlink">Хотите тираж со своим логотипом?</span></a>
							</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["PAGES"]["VALUE"]) {?>
							<div class="characteris">
								<p class="title"><?= GetMessage("PAGES_COUNT") ?></p>
								<p class="text"><span itemprop="numberOfPages"><?= $arResult["PROPERTIES"]["PAGES"]["VALUE"] ?></span><?= GetMessage("PAGES") ?></p>
							</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["ISBN"]["VALUE"]) {?>
							<div class="characteris">
								<p class="title"><?= GetMessage("ISBN") ?></p>
								<p class="text" itemprop="isbn"><?= $arResult["PROPERTIES"]["ISBN"]["VALUE"] ?></p>
							</div>
						<?}?>
						<?if ($arResult['CAN_BUY'] && $arResult['PROPERTIES']['STATE']['VALUE_XML_ID'] != 'soon' && $arResult["PROPERTIES"]["COVER_TYPE"]["VALUE"] != 'Аудиодиск' && $arResult["PROPERTIES"]["ol_opis"]["VALUE_ENUM_ID"] != 233) {?>
							<div class="characteris epubHide">
								<a href="http://readright.ru/?=alpinabook" target="_blank">
									<span class="text noborderlink"><?= GetMessage("HOW_TO_READ_A_BOOK_IN_A_HOUR") ?></span>
								</a>
							</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["COVER_FORMAT"]["VALUE"]) {?>
							<div class="characteris epubHide">
								<p class="title"><?= GetMessage("SIZES") ?></p>
								<p class="text"><?= $arResult["PROPERTIES"]["COVER_FORMAT"]["VALUE"] ?></p>
							</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["DURATION"]["VALUE"]) {?>
							<div class="characteris">
								<p class="title"><?= GetMessage("DURATION") ?></p>
								<p class="text"><?= $arResult["PROPERTIES"]["DURATION"]["VALUE"] ?></p>
							</div>
						<?}?>
					<?}?>
                       
                    <?if ($arResult["CATALOG_WEIGHT"]) {
                            $weight = $arResult["CATALOG_WEIGHT"];
                        } else if ($arResult["PROPERTIES"]["LATEST_WEIGHT"]["VALUE"]) {
                            $weight = $arResult["PROPERTIES"]["LATEST_WEIGHT"]["VALUE"];
                        }
                        if ($weight) {?>
                        <div class="characteris epubHide">
                            <p class="title"><?= GetMessage("WEIGHT") ?></p>
                            <p class="text"><?= $weight ?><?= GetMessage("GRAMS") ?></p>
                        </div>
                        <?}?>
                    <div class="socialServises">
                        <? require('include/socialbuttons.php'); ?>
                    </div>
                    <?#Спонсоры книги?>
                    <!-- noindex -->
                    <div class="sponsors">

                        <?foreach ($arResult["PROPERTIES"]["SPONSORS"]["VALUE"] as $val) {?>
                            <span style="color:#627478"><?= $arResult["SPONSOR_PREVIEW_TEXT"] ?> </span><br />
                            <?if (!empty($arResult["SPONSOR_PICT"])) {?>
                                <a href="<?= $arResult["SPONSOR_WEBSITE_VALUE"] ?>" class="sponsor_website" target="_blank"><img src="<?= $arResult["SPONSOR_PICT"] ?>"> </a>
                            <?} else {?>
                                <?= $authorFetchedList["NAME"] ?>
                            <?}?>

                            <? $authors .= $author_fetched_list["NAME"] . ", ";?>
                        <?}?>
                    </div>
                    <!-- /noindex -->      
                    <?##Спонсоры книги?>
                </div>
                <div class="rightColumn">
					<?if ($alpExps['selectVersion'] == 1 && !checkMobile()) {?>
						<div id="diffversions">
							<a href="#" onclick="selectversion($(this).attr('class'), $(this).attr('id'));return false;" id="paperversion" class="active"><span><?=GetMessage("PAPER_V")?></span></a>
							<a href="#" onclick="selectversion($(this).attr('class'), $(this).attr('id'));return false;" id="digitalversion" class="passive"><span><?=GetMessage("DIGITAL_V")?></span></a>
						</div>
						<script>
							<?if ($_SERVER['HTTP_REFERER'] == 'https://relap.io/' || strpos($_SERVER['HTTP_REFERER'],"theoryandpractice.ru") !== false) {?>
								$(document).ready(function() {
									selectversion('passive','digitalversion');
									var digitalLink = $(".digitalLink").attr("href");
									$(".digitalLink").attr("href", digitalLink+"&utm_content=tnp");
									<?if ($USER->isAdmin()) {?>
									console.log($(".digitalLink").attr("href"));
									<?}?>
								});
							<?}?>
						</script>
					<?}?>
                    <div class="priceBasketWrap paperVersionWrap" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                        <meta itemprop="priceCurrency" content="RUB" />
                        <link itemprop="itemCondition" href="http://schema.org/NewCondition">
                        <meta itemprop="sku" content="<?=$arResult["ID"]?>" />
                        <?if ($USER->IsAuthorized()) {// blackfriday черная пятница
                                if ($arResult["ITEM_WITHOUT_DISCOUNT"] == "Y") {
                                    $discount = 0;
                                } elseif ($arResult["SAVINGS_DISCOUNT"][0]["SUMM"] < $arResult["SALE_NOTE"][0]["RANGE_FROM"]) {
                                    $printDiscountText = "<span class='sale_price'>" . GetMessage("NOT_ENOUGH") . ($arResult["SALE_NOTE"][0]["RANGE_FROM"] - $arResult["SAVINGS_DISCOUNT"][0]["SUMM"]) . GetMessage("AMOUNT_UNTIL_DISCOUNT") . $arResult["SALE_NOTE"][0]["VALUE"] . "%</span><br />";
                                } elseif ($arResult["SAVINGS_DISCOUNT"][0]["SUMM"] < $arResult["SALE_NOTE"][1]["RANGE_FROM"]) {
                                    $printDiscountText = "<span class='sale_price'>" . GetMessage("NOT_ENOUGH")  . ($arResult["SALE_NOTE"][1]["RANGE_FROM"] - $arResult["SAVINGS_DISCOUNT"][0]["SUMM"]) . GetMessage("AMOUNT_UNTIL_DISCOUNT") . $arResult["SALE_NOTE"][1]["VALUE"] . "%</span><br />";
                                    $discount = $arResult["SALE_NOTE"][0]["VALUE"]; // процент накопительной скидки
                                } else {
                                    $discount = $arResult["SALE_NOTE"][1]["VALUE"];  // процент накопительной скидки
                                }
                            } else {
                                if ($arResult["ITEM_WITHOUT_DISCOUNT"] == "Y") {
                                    $discount = 0;
                                } elseif ($arResult["CART_SUM"] < $arResult["SALE_NOTE"][0]["RANGE_FROM"]) {
                                    $printDiscountText = "<span class='sale_price'>" . GetMessage("NOT_ENOUGH")  . ($arResult["SALE_NOTE"][0]["RANGE_FROM"] - $arResult["CART_SUM"]) . GetMessage("AMOUNT_UNTIL_DISCOUNT") . $arResult["SALE_NOTE"][0]["VALUE"] . "%</span><br />";
                                } elseif ($arResult["CART_SUM"] < $arResult["SALE_NOTE"][1]["RANGE_FROM"]) {
                                    $printDiscountText = "<span class='sale_price'>" . GetMessage("NOT_ENOUGH")  . ($arResult["SALE_NOTE"][1]["RANGE_FROM"] - $arResult["CART_SUM"]) . GetMessage("AMOUNT_UNTIL_DISCOUNT") . $arResult["SALE_NOTE"][1]["VALUE"] . "%</span><br />";
                                    $discount = $arResult["SALE_NOTE"][0]["VALUE"];  // процент накопительной скидки
                                } else {
                                    $discount = $arResult["SALE_NOTE"][1]["VALUE"];  // процент накопительной скидки
                                }
                        }?>
                        <div class="wrap_prise_top">
                            <?$StockInfo = "";
                                if (!empty($arResult["PRICES"])) { ?>
                                    <?// если свойство товара в состоянии "Новинка" либо не задан - то выводить стандартный блок с ценой,
                                    // иначе выводить дату выхода книги либо поле для ввода e-mail для запроса уведомления о поступлении
                                    if ((intval ($arResult["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != getXMLIDByCode (CATALOG_IBLOCK_ID, "STATE", "soon") )
                                        && (intval ($arResult["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "net_v_nal") )) {
                                        foreach ($arResult["PRICES"] as $code => $arPrice) {?>
                                        <meta itemprop="price" content="<?=$arPrice["VALUE_VAT"]?>" />
                                        <link itemprop="availability" href="https://schema.org/InStock">

                                        <?$StockInfo = "InStock";
                                            if (round(($arPrice["VALUE"]) * (1 - $discount / 100), 2) . " " . GetMessage("ROUBLES") == $arPrice["PRINT_VALUE"]) {
                                                $discount = false;
                                            };
                                            if ($arPrice["DISCOUNT_DIFF_PERCENT"] > 0) {?>
                                            <div class="oldPrice"><span class="cross"><?= $arPrice["PRINT_VALUE"] ?></span> <span class="diff"><?if ($USER->isAdmin()) echo '-'.$arPrice["VALUE_VAT"]+$newPrice.' руб.';?></span></div>
                                            <?// расчитываем накопительную скидку от стоимости
                                                if ($discount) {
                                                    $newPrice = round (($arPrice["DISCOUNT_VALUE"]) * (1 - $discount / 100), 2);
                                                    if (strlen (stristr($newPrice, ".")) == 2) {
                                                        $newPrice .= "0";
                                                    }
                                                } else {
                                                    $newPrice = round (($arPrice["DISCOUNT_VALUE"]), 2);
                                                    if (strlen (stristr($newPrice, ".")) == 2) {
                                                        $newPrice .= "0";
                                                    }
                                                }?>
                                            <p class="newPrice"><?= $newPrice ?> <span><?= GetMessage("ROUBLES") ?></span></p>
                                            <?} else if ($discount) {
                                                $newPrice = round (($arPrice["VALUE"]) * (1 - $discount / 100), 2);
                                                if (strlen (stristr($newPrice, ".")) == 2) {
                                                    $newPrice .= "0";
                                            }?>
                                            <div class="oldPrice"><span class="cross"><?= $arPrice["PRINT_VALUE"] ?></span> <span class="diff"><?if ($USER->isAdmin()) echo '-'.$arPrice["VALUE_VAT"]+$newPrice.' руб.';?></span></div>
                                            <?// расчитываем накопительную скидку от стоимости?>
                                            <p class="newPrice"><?= $newPrice ?> <span><?= GetMessage("ROUBLES") ?></span></p>
                                            <?} else {
                                                $newPrice = round($arPrice["VALUE_VAT"], 2);
                                                if (strlen(stristr($newPrice, ".")) == 2) {
                                                    $newPrice .= "0";
                                            }?>
                                            <p class="newPrice"><?= $newPrice ?> <span><?= GetMessage("ROUBLES") ?></span></p>
                                            <?}?>

                                        <?if ($printDiscountText != '' && $arResult["PROPERTIES"]["ol_opis"]["VALUE_ENUM_ID"] != 233) {
                                            echo $printDiscountText; // цена до скидки
                                        }?>
                                        <button style="width:10px; height:10px; background:rgba(0, 255, 0, 0.57); border-radius:10px;padding: 0;border: 0;margin-left:-20px;vertical-align: middle;"></button><span>&nbsp;<?= GetMessage("IN_STOCK") ?></span>
                                        <?}
                                    } else if ($arResult["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"] == getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "soon")) { ?>
                                    <meta itemprop="price" content="<?=$arPrice["VALUE_VAT"]?>" />
                                    <link itemprop="availability" href="https://schema.org/PreOrder">
                                    <meta itemprop="availabilityStarts" content="<?=date('Y-m-d', MakeTimeStamp($arResult['PROPERTIES']['SOON_DATE_TIME']['VALUE'], "DD.MM.YYYY HH:MI:SS"))?>" />
                                    <? $StockInfo = "SoonStock"; ?>
                                    <p class="newPrice" style="font-size:20px;"><?= GetMessage("EXPECTED_DATE") ?><?= strtolower(FormatDate("j F", MakeTimeStamp($arResult['PROPERTIES']['SOON_DATE_TIME']['VALUE'], "DD.MM.YYYY HH:MI:SS"))); ?></p>

                                    <?} else {?>
                                    <meta itemprop="price" content="<?=$arPrice["VALUE_VAT"]?>" />
                                    <link itemprop="availability" href="https://schema.org/OutOfStock">
                                    <?$StockInfo = "OutOfStock";?>
                                    <?foreach ($arResult["PRICES"] as $code => $arPrice) {
                                            if ($arPrice["DISCOUNT_DIFF"]) {?>
                                            <div class="oldPrice"><span class="cross"><?= $arPrice["PRINT_VALUE"] ?></span> <span class="diff"><?if ($USER->isAdmin()) echo '-'.$arPrice["VALUE_VAT"]+$newPrice.' руб.';?></span></div>
                                            <?}?>
                                        <?if ($arPrice["DISCOUNT_VALUE_VAT"]) {
                                                $newPrice = round(($arPrice["DISCOUNT_VALUE_VAT"]), 2);
                                                if (strlen(stristr($newPrice, ".")) == 2) {
                                                    $newPrice .= "0";
                                            }?>
                                            <p class="newPrice"><?= $newPrice ?> <span><?= GetMessage("ROUBLES") ?></span></p>
                                            <?} else {
                                                $newPrice = round(($arPrice["ORIG_VALUE_VAT"]), 2);
                                                if (strlen(stristr($newPrice, ".")) == 2) {
                                                    $newPrice .= "0";
                                            }?>
                                            <p class="newPrice"><span><?= $newPrice ?></span> <span><?= GetMessage("ROUBLES") ?></span></p>
                                            <?}?>
                                        <?}?>
                                    <p class="newPrice notAvailable" style="font-size:28px;"><?= GetMessage("NOT_IN_STOCK") ?></p>
                                    <?}?>
                                <?if ((intval($arResult["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) == getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "soon"))
                                        || (intval($arResult["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) == getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "net_v_nal"))) {?>
                                    <form>
                                        <div>
                                            <p>
                                                <span class="subscribeDesc"><?= GetMessage("SUBSCRIBING_DESCRIPTION") ?></span>
                                            </p>
                                            <input data-book_id="<?= $arResult['ID'] ?>" type="text" value="<?= $arResult["MAIL"]; ?>" name="email" class="subscribeEmail"/>
                                            <input type="button" onclick="newSubFunction(this);" class="getSubscribe" id="outOfStockClick" value="<?= GetMessage("TO_SUBSCRIBE") ?>"/>

                                        </div>
                                    </form>
                                    <?}?>
                                <?} else {?>
                                <p class="newPrice" style="font-size:28px;"><?= GetMessage("NOT_IN_STOCK") ?></p>
                                <form>
                                    <div>
                                        <p>
                                            <span class="subscribeDesc"><?= GetMessage("SUBSCRIBING_DESCRIPTION") ?></span>
                                        </p>
                                        <input data-book_id="<?= $arResult['ID'] ?>" type="text" value="<?= $arResult["MAIL"]; ?>" name="email" class="subscribeEmail"/>
                                        <input type="button" onclick="newSubFunction(this);" class="getSubscribe" id="outOfStockClick" value="<?= GetMessage("TO_SUBSCRIBE") ?>"/>
                                    </div>
                                </form>
                                <?}?>
                        </div>

                        <?if (!empty ($arResult["PRICES"]) ) {?>
                            <?if ((intval($arResult["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "soon"))
                                    && (intval($arResult["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "net_v_nal"))) {?>
                                <div class="wrap_prise_bottom">
                                    <span class="item_buttons_counter_block">

                                        <a href="javascript:void(0)" class="minus" id="<?= $arResult['QUANTITY_DOWN']; ?>">&minus;</a>
                                        <input id="<?= $arResult['QUANTITY']; ?>" type="text" class="tac transparent_input" value="<?= (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])
                                                ? 1
                                                : $arResult['CATALOG_MEASURE_RATIO']
                                            ); ?>">
                                        <a href="javascript:void(0)" class="plus" id="<?= $arResult['QUANTITY_UP']; ?>">+</a>
                                    </span>
                                    <?if ($arResult["ITEM_IN_BASKET"]["QUANTITY"] == 0) {?>
                                        <a href="#" onclick="addtocart(<?= $arResult["ID"]; ?>, '<?= $arResult["NAME"]; ?>'); addToCartTracking(<?= $arResult["ID"]; ?>, '<?= $arResult["NAME"]; ?>', '<?= $arResult["PRICES"]["BASE"]["VALUE"] ?>', '<?= $arResult['SECTION']['NAME']; ?>', '1'); return false;">
                                            <p class="inBasket"><?= GetMessage("ADD_IN_BASKET") ?></p>
                                        </a>
										<div id="loadingInfo" style="display:none;"><div class="spinner"><div class="spinner-icon"></div></div></div>
                                        <?} else {?>
                                        <a href="/personal/cart/"><p class="inBasket" style="background-color: #A9A9A9;"><?= GetMessage("ALREADY_IN_BASKET") ?></p></a>
                                        <?}?>
                                    <a href="javascript:void(0);"><p class="buyOneClick"><?= GetMessage("TO_BUY_IN_1_CLICK") ?></p></a>
                                </div>
                            <?}?>
                        <?}?>

                    <?
                    $rsUser = CUser::GetByID($USER->GetID())->Fetch();
                    if (!empty($rsUser[UF_BOOKSBOUGHT])) {
                        $bought = unserialize($rsUser[UF_BOOKSBOUGHT]);
                        if ($arResult[ID] == $bought[$arResult[ID]][ID]) {
                            echo '<center><span style="color: #424c4f;display: inline-block;font-family: \'Walshein_regular\';font-size: 14px;margin-bottom: 5px;line-height: 24px;padding: 4px 22px;background: #fcfcfc none repeat scroll 0 0;width: 220px;"><img src="/images/info.png" align="left" style="margin-left:-10px;margin-top:12px;" />Вы уже купили эту книгу '.$bought[$arResult[ID]]["DATE"].'</span></center>';
                        }
                    }?>                            
                    </div>

					<?if ($alpExps['selectVersion'] == 1 && !checkMobile()) {?>
					<!--noindex-->
					<div class="priceBasketWrap digitalVersionWrap" style="display:none;">
						<div class="wrap_prise_top">
							<?= GetMessage("EPUB") ?>
							<p class="newPrice"><?=$arResult["PROPERTIES"]["alpina_digital_price"]['VALUE']?> <span><?= GetMessage("ROUBLES") ?></span></p>
						</div>
						
						<div class="wrap_prise_bottom">
							<a href="https://ebook.alpinabook.ru/book/<?=$arResult["PROPERTIES"]["alpina_digital_ids"]['VALUE']?>?utm_source=alpinabook.ru&utm_medium=referral&utm_campaign=alpinamainsite" class="digitalLink" target="_blank" rel="nofollow" onclick="dataLayer.push({'event' : 'selectVersion', 'action' : 'leaveSite', 'label': '<?= $arResult["NAME"]; ?>'});">
								<p class="inBasket"><?= GetMessage("BUY_EPUB") ?></p>
							</a>
						</div>
					</div>
					<!--/noindex-->
					<?}
					###
					#Конец a/b-теста
					###?>
                        					
                    <div class="quickOrderDiv" style="display:none;">
                        <form method="post" id="quickOrderForm">
                            <input type="hidden" name="frmQuickOrderSent" value="Y">
                            <input type="hidden" name="qoProduct" id="id" value="<?= $arResult["ID"] ?>">
                            <div class="notify"></div>
                            <ul>
                                <li><?= GetMessage("NAME_FIELD_TITLE") ?></li>
                                <li>
                                    <input type="text" name="name" value="" class="quickorder-name">
                                </li>
                                <li><?= GetMessage("PHONE_FIELD_TITLE") ?></li>
                                <li>
                                    <input type="text" name="phone" value="" class="quickorder-phone">
                                </li>
                                <li><?= GetMessage("EMAIL_FIELD_TITLE") ?></li>
                                <li>
                                    <input type="text" name="email" value="" class="quickorder-email">
                                </li>
                                <li class="last">
                                    <input type="button" value="Оформить заказ" id="qoSend" class="input2">
                                </li>
                            </ul>
                            <a title="" href="#" onClick="$('.quickOrderDiv').hide(); $('.layout').hide(); return false;" class="closePopupContainer close1"></a>
                        </form>
                        <div class="CloseQuickOffer"><img src="/img/catalogLeftClose.png"></div>
                    </div>
                    
                    <?if ($arResult['PROPERTIES']['STATE']['VALUE_XML_ID'] != 'net_v_nal' && $arResult['PROPERTIES']['STATE']['VALUE_XML_ID'] != 'soon'  && $arResult["PROPERTIES"]["ol_opis"]["VALUE_ENUM_ID"] != 233) {?>
                    <ul class="shippings">
                        <?
                            $today = date("w");
                            $timenow = date("G");

                            if ($timenow > 25) { //НОВОГОДНИЕ ПРАЗДНИКИ
                                if ($today == 1) {
                                    $delivery_day = GetMessage("TOMORROW");
                                } elseif ($today == 2) {
                                    $delivery_day = GetMessage("TOMORROW");
                                } elseif ($today == 3) {
                                    $delivery_day = GetMessage("TOMORROW");
                                } elseif ($today == 4) {
                                    $delivery_day = GetMessage("TOMORROW");
                                } elseif ($today == 5) {
                                    $delivery_day = GetMessage("ON_MONDAY_WITH_SPACE_ENTITY");
                                } elseif ($today == 6) {
                                    $delivery_day = GetMessage("ON_MONDAY_WITH_SPACE_ENTITY");
                                } elseif ($today == 0) {
                                    $delivery_day = GetMessage("TOMORROW");
                                }

                                if ($today == 5) {
                                    if ($timenow < 17) {
                                        $samovivoz_day = GetMessage("TODAY");
                                    } else {
                                        $samovivoz_day = GetMessage("ON_MONDAY"); //на праздники тут меняем день, потом обратно
                                    }
                                } elseif ($timenow < 17 && $today != 6) {
                                    $samovivoz_day = GetMessage("TODAY");
                                } else {
                                    $samovivoz_day = GetMessage("TOMORROW");
                                }
                            } else { //МЕНЯЕТ ДЕНЬ ДОСТАВКИ ТУТ
                                if ($today == 1) {
                                    $delivery_day = GetMessage("TOMORROW");
									//$delivery_day = 'в среду';
                                } elseif ($today == 2) {
									if ($timenow < 9)
										$delivery_day = 'сегодня';
									else
										$delivery_day = GetMessage("TOMORROW");
                                } elseif ($today == 3) {
									$delivery_day = GetMessage("TOMORROW");
                                } elseif ($today == 4) {
									$delivery_day = GetMessage("TOMORROW");
                                } elseif ($today == 5) {
									if ($timenow < 9)
										$delivery_day = 'сегодня';
									else
										$delivery_day = GetMessage("ON_MONDAY_WITH_SPACE_ENTITY");
                                } elseif ($today == 6) {
                                    $delivery_day = GetMessage("ON_MONDAY_WITH_SPACE_ENTITY");
                                    //$delivery_day = 'во вторник';
                                } elseif ($today == 0) {
                                    $delivery_day = GetMessage("TOMORROW");
                                    //$delivery_day = 'в среду';
                                }

                                if ($today == 5) {
                                    if ($timenow < 17) {
                                        $samovivoz_day = GetMessage("TODAY");
                                    } else {
                                        $samovivoz_day = GetMessage("ON_MONDAY"); //на праздники тут меняем день, потом обратно
                                    }
                                } elseif ($timenow < 17 && $today != 6) {
                                    $samovivoz_day = GetMessage("TODAY");
                                } else {
                                    $samovivoz_day = GetMessage("TOMORROW");
                                }
                            }?>
                        <li><?= GetMessage("MSK_DELIVERY") ?><br /><a id='inline1' href='#data1'><?=$delivery_day?></a></li>
                        <li><?= GetMessage("PICKUP_MSK_DELIVERY") ?><br /><a id='inline2' href='#data2'><?=$samovivoz_day?></a></li>
                        <li><?= GetMessage("MAIL_DELIVERY") ?><br /><a id='inline3' href='#data3'><?=GetMessage("COUNTRY_DELIVERY")?></a></li>
                        <li><?= GetMessage("INTERNATIONAL_DELIVERY") ?></li>
                        <?/*<li class="lastli"><a href="http://www.alpinab2b.ru/spetsialnyy-tirazh/" target="_blank" class="noborderlink" onclick="dataLayer.push({event: 'otherEvents', action: 'specialEditionLink', label: '<?= $arResult['NAME'] ?>'});">Хотите тираж со своим логотипом?</a></li>*/?>

                    </ul>
                    <?}?>

                    <div class="typesOfProduct">
                        <?if (!empty ($arResult["PROPERTIES"]["appstore"]['VALUE']) ) {?>
                            <!--noindex--><div class="productType" onclick="dataLayer.push({event: 'otherEvents', action: 'clickAppStore', label: '<?= $arResult['NAME'] ?>'});">
                                <p class="title"><a target="_blank"
                                    href="https://ad.apps.fm/I7nsUqHgFpiU6SjjFxr_lfE7og6fuV2oOMeOQdRqrE2fuH1E_AVE04uUy-835_z8AOyXPgYuNMr8J2cvDXlBe3JGR4QWfzRXdHADIOS0bhIlj-vcR89M4g_uNUXQBYtJhxsaY6DBokwX4FZL6ZW1oPCYagKnjd3JTKLywLOw94o"
                                    rel="nofollow"><?= GetMessage("BUY_IN_APPSTORE") ?></a></p>
                            </div><!--/noindex-->
                            <?}?>
                        <?if (!empty ($arResult["PROPERTIES"]["android"]['VALUE']) ) {?>
                            <!--noindex--><div class="productType" onclick="dataLayer.push({event: 'otherEvents', action: 'clickAndroid', label: '<?= $arResult['NAME'] ?>'});">
                                <p class="title"><a target="_blank"
                                    href="https://ad.apps.fm/JbkeS8Wu40Y4o7v66y0V515KLoEjTszcQMJsV6-2VnHFDLXitVHB6BlL95nuoNYfsPXjJaQ96brr8ncAvMfc6wZkKsYjZn26ZgfIprQwFxiMb6nGA0JPaw88nuXsLm5fGy9o7Q8KyEtAHAeX1UXtzRyIF-zfsrprYF9zs6rj2ac8dDeKR2QfG21w5iR5J8PU"
                                    rel="nofollow"><?= GetMessage("BUY_IN_GOOGLEPLAY") ?></a></p>
                            </div><!--/noindex-->
                            <?}?>
                    </div>

                    <div class="courierBlock">
                        <div id="data1">
                            <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => "/include/courierBlock.php",
                                "EDIT_TEMPLATE" => ""
                                ),
                                false
                            );?>
                        </div>
                    </div>
                    <div class="pickupBlock">
                        <div id="data2">
                            <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => "/include/pickupBlock.php",
                                "EDIT_TEMPLATE" => ""
                                ),
                                false
                            );?>
                        </div>
                    </div>
					<div class="countryBlock">
                        <div id="data3">
                            <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => "/include/countryBlock.php",
                                "EDIT_TEMPLATE" => ""
                                ),
                                false
                            );?>
                        </div>
                    </div>
                    <?if ($arResult["PROPERTIES"]["author_book"]["VALUE"] == "Y") {?>
                        <div class="productAction">
                            <img src="/img/actionPicture.png">
                            <p class="title">Книга с автором</p>
                            <p class="text">Участвуй в акции и получи книгу с автографом автора</p>
                            <a href="#"><p class="takePart">Принять участие</p></a>
                        </div>
                        <?}?>
                        <?if(!empty($arResult['PROPERTIES']['AUTHORS']['VALUE'][0])){?>
                            <? global $author_filter;
                            $author_filter = array("PROPERTY_AUTHOR_LINK" => $arResult['PROPERTIES']['AUTHORS']['VALUE'][0]);
                            $APPLICATION->IncludeComponent(
                                "bitrix:news.list",
                                "lections_announces",
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
                                    "CACHE_TIME" => "36000",
                                    "CACHE_TYPE" => "Y",
                                    "CHECK_DATES" => "Y",
                                    "DETAIL_URL" => "",
                                    "DISPLAY_BOTTOM_PAGER" => "N",
                                    "DISPLAY_DATE" => "Y",
                                    "DISPLAY_NAME" => "Y",
                                    "DISPLAY_PICTURE" => "Y",
                                    "DISPLAY_PREVIEW_TEXT" => "Y",
                                    "DISPLAY_TOP_PAGER" => "N",
                                    "FIELD_CODE" => array(
                                        0 => "NAME",
                                        1 => "",
                                    ),
                                    "FILTER_NAME" => "author_filter",
                                    "HIDE_LINK_WHEN_NO_DETAIL" => "Y",

                                    "IBLOCK_ID" => LECTIONS_ANNOUNCES_IBLOCK_ID,
                                    "IBLOCK_TYPE" => "service",
                                    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                                    "INCLUDE_SUBSECTIONS" => "Y",
                                    "MESSAGE_404" => "",
                                    "NEWS_COUNT" => "1",
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
                                        0 => "LECTION_DATE",
                                        1 => "EVENT_LINK",
                                        2 => "EVENT_TYPE",
                                        3 => "AUTHOR_LINK",
                                        4 => "",
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
                                    "SORT_ORDER2" => "ASC",
                                    "COMPONENT_TEMPLATE" => "lections_announces"
                                ),
                                false
                            );?>
                        <?}?>
                </div>
                <div class="subscr_result"></div>
                <div class="centerColumn">
                    <h1 class="productName" itemprop="name"><?=$arResult["NAME"] ?></h1>
                    <h2 class="engBookName" itemprop="alternateName"><?= $arResult["PROPERTIES"]["ENG_NAME"]["VALUE"] ?></h2>
                    <div class="authorReviewWrap">
                        <p class="reviews">

                            <style>
                            .crr {
    font-family: "Walshein_regular"!important;
    font-size:15px!important;
}
.crr .mc-star span {
    font-size: 18px!important;
}
.mc-c .mc-star {
    vertical-align: bottom !important;
    color:#f0c15b !important;
}
</style>
                            <span class="crr-cnt" data-crr-url="<?=$arResult["ID"]?>" data-crr-chan="<?=$arResult["ID"]?>"></span>

                            <span class="star"><img src="/img/activeStar.png"></span>
                            <span class="star"><img src="/img/activeStar.png"></span>
                            <span class="star"><img src="/img/activeStar.png"></span>
                            <span class="star"><img src="/img/activeStar.png"></span>
                            <span class="star"><img src="/img/unactiveStar.png"></span>
                            <span class="countOfRev"><?//=$reviews_count." ".format_by_count($reviews_count, 'отзыв', 'отзыва', 'отзывов');?></span>
                        </p>


                        <p class="productAutor">
                            <?= $arResult["AUTHOR_NAME"]; ?>
                        </p>

                    </div>

                    <?/* Пока закрыли другие варианты книги. Думаем, как сделать блок понятным для посетителей
                        <div class="typesOfProduct">
                        <div class="productType" onclick="dataLayer.push({event: 'otherFormatsBlock', action: 'clickCurrentVersion', label: '<?=$arResult['NAME']?>'})">
                        <p class="title"><?=$arResult["PROPERTIES"]['COVER_TYPE']['VALUE']?></p>
                        <?
                        foreach ($arResult["PRICES"] as $code => $arPrice)
                        {
                        if ($arPrice["DISCOUNT_VALUE_VAT"])
                        {
                        ?>
                        <p class="cost"><?=ceil($arPrice["DISCOUNT_VALUE_VAT"])?> руб.</p>
                        <?
                        }
                        else
                        {
                        ?>
                        <p class="cost"><?=ceil($arPrice["ORIG_VALUE_VAT"])?> руб.</p>
                        <?  }
                        }
                        ?>
                        </div>
                        <?if (!empty($arResult["PROPERTIES"]["pereplet_v"]['VALUE'])) {
                        $pPrice = CPrice::GetList(array(),array("PRODUCT_ID"=>$arResult["PROPERTIES"]["pereplet_v"]['VALUE'],"CATALOG_GROUP_ID"=>$arResult["PRICES"][$arParams["PRICE_CODE"][0]]["PRICE_ID"]))->Fetch();
                        ?>
                        <?$pereplet_v = CCatalogProduct::GetByIDEx($arResult["PROPERTIES"]["pereplet_v"]['VALUE']);?>
                        <?if ($pPrice["PRICE"]) {?>
                        <div class="productType" onclick="dataLayer.push({event: 'otherFormatsBlock', action: 'clickHardCover', label: '<?=$arResult['NAME']?>'});">
                        <a href="<?=$pereplet_v["DETAIL_PAGE_URL"]?>"><p class="title">Твердый переплет</p>
                        <p class="cost"><?echo round($pPrice["PRICE"],0);?> руб.</p></a>
                        <?$arFile = CFile::GetFileArray($pereplet_v["DETAIL_PICTURE"]);    ?>
                        </div>
                        <?}?>
                        <?}?>

                        <?if (!empty($arResult["PROPERTIES"]["oblozhka_v"]['VALUE'])) {?>
                        <?$oblozhka_v = CCatalogProduct::GetByIDEx($arResult["PROPERTIES"]["oblozhka_v"]['VALUE']);?>
                        <div class="productType" onclick="dataLayer.push({event: 'otherFormatsBlock', action: 'clickSoftCover', label: '<?=$arResult['NAME']?>'});">
                        <a href="<?=$oblozhka_v["DETAIL_PAGE_URL"]?>"><p class="title">Мягкая обложка</p>
                        <p class="cost"><?echo $oblozhka_v["PRICES"][11]['PRICE'];?> руб.</p></a>
                        <?$arFile = CFile::GetFileArray($oblozhka_v["DETAIL_PICTURE"]);    ?>
                        </div>
                        <?}?>
                        <?if (!empty($arResult["PROPERTIES"]["superobl_v"]['VALUE'])) {?>
                        <?$superobl_v = CCatalogProduct::GetByIDEx($arResult["PROPERTIES"]["superobl_v"]['VALUE']);?>
                        <div class="productType" onclick="dataLayer.push({event: 'otherFormatsBlock', action: 'clickSuperCover', label: '<?=$arResult['NAME']?>'});">
                        <a href="<?=$superobl_v["DETAIL_PAGE_URL"]?>"><p class="title">Суперобложка</p>
                        <p class="cost"><?echo $superobl_v["PRICES"][11]['PRICE'];?> руб.</p></a>
                        <?$arFile = CFile::GetFileArray($superobl_v["DETAIL_PICTURE"]);    ?>
                        </div>
                        <?}?>
                        <?if (!empty($arResult["PROPERTIES"]["audio_v"]['VALUE'])) {?>
                        <?$superobl_v = CCatalogProduct::GetByIDEx($arResult["PROPERTIES"]["audio_v"]['VALUE']);?>
                        <div class="productType" onclick="dataLayer.push({event: 'otherFormatsBlock', action: 'clickAudio', label: '<?=$arResult['NAME']?>'});">
                        <a href="<?=$superobl_v["DETAIL_PAGE_URL"]?>"><p class="title">Аудиокнига</p>
                        <p class="cost"><?echo $superobl_v["PRICES"][11]['PRICE'];?> руб.</p></a>
                        <?$arFile = CFile::GetFileArray($superobl_v["DETAIL_PICTURE"]);    ?>
                        </div>
                        <?}?>
                        <?if (!empty($arResult["PROPERTIES"]["appstore"]['VALUE'])) {?>
                        <!--noindex--><div class="productType" onclick="dataLayer.push({event: 'otherFormatsBlock', action: 'clickAppStore', label: '<?=$arResult['NAME']?>'});">
                        <p class="title"><a target="_blank"
                        href="http://ad.apps.fm/I7nsUqHgFpiU6SjjFxr_lfE7og6fuV2oOMeOQdRqrE2fuH1E_AVE04uUy-835_z8AOyXPgYuNMr8J2cvDXlBe3JGR4QWfzRXdHADIOS0bhIlj-vcR89M4g_uNUXQBYtJhxsaY6DBokwX4FZL6ZW1oPCYagKnjd3JTKLywLOw94o"
                        rel="nofollow">Купить электронную книгу в
                        <span>iPhone/iPad</span></a></p>
                        <?//<div class="imgCover" style="margin-top:-144px;"><img src="/bitrix/templates/books/images/appStoreBK_1.png" height="70" style="height:70px;" /></div>?>
                        </div><!--/noindex-->
                        <?}?>
                        <?if (!empty($arResult["PROPERTIES"]["android"]['VALUE'])) {?>
                        <!--noindex--><div class="productType" onclick="dataLayer.push({event: 'otherFormatsBlock', action: 'clickAndroid', label: '<?=$arResult['NAME']?>'});">
                        <p class="title"><a target="_blank"
                        href="http://ad.apps.fm/JbkeS8Wu40Y4o7v66y0V515KLoEjTszcQMJsV6-2VnHFDLXitVHB6BlL95nuoNYfsPXjJaQ96brr8ncAvMfc6wZkKsYjZn26ZgfIprQwFxiMb6nGA0JPaw88nuXsLm5fGy9o7Q8KyEtAHAeX1UXtzRyIF-zfsrprYF9zs6rj2ac8dDeKR2QfG21w5iR5J8PU"
                        rel="nofollow">Купить электронную книгу в
                        <span>Android</span></a></p>
                        <?//<div class="imgCover" style="margin-top:-144px;"><img src="/bitrix/templates/books/images/appStoreBK_1.png" height="70" style="height:70px;" /></div>?>
                        </div><!--/noindex-->
                        <?}?>
                    </div>*/?>
                    <ul class="productsMenu">
                        <li class="active tabsInElement" data-id="1"><?= GetMessage("ANNOTATION_TITLE") ?></li>
                        <?if (!empty($arResult["AUTHORS"])) {?><li data-id="4" class="tabsInElement"><?echo count($arResult["AUTHOR"]) == 1 ? GetMessage("ABOUT_AUTHOR_TITLE") : GetMessage("ABOUT_AUTHORS_TITLE");?></li><?}?>
                        <?if ($arResult["REVIEWS_COUNT"] > 0) {?>
                            <li data-id="2" class="tabsInElement"><?= GetMessage("REVIEWS_TITLE") ?></li>
                       <?}?>
                        <li data-id="3" class="tabsInElement"><?= GetMessage("COMMENTS_TITLE") ?></li>
                    </ul>

                    <div class="annotation" id="prodBlock1">
                        <div class="showAllWrapp">

                            <?global $reviewsFilter;
                                $reviewsFilter = array ("PROPERTY_BOOK" => $arResult["ID"]);

                                $APPLICATION->IncludeComponent(
                                    "bitrix:catalog.section",
                                    "this_book_reviews",
                                    array(
                                        "IBLOCK_TYPE_ID" => "catalog",
                                        "IBLOCK_ID" => "31",
                                        "BASKET_URL" => "/personal/cart/",
                                        "COMPONENT_TEMPLATE" => "this_book_reviews",
                                        "IBLOCK_TYPE" => "news",
                                        "SECTION_ID" => "",
                                        "SECTION_CODE" => "",
                                        "SECTION_USER_FIELDS" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "ELEMENT_SORT_FIELD" => "id",
                                        "ELEMENT_SORT_ORDER" => "desc",
                                        "ELEMENT_SORT_FIELD2" => "id",
                                        "ELEMENT_SORT_ORDER2" => "asc",
                                        "FILTER_NAME" => "reviewsFilter",
                                        "INCLUDE_SUBSECTIONS" => "Y",
                                        "SHOW_ALL_WO_SECTION" => "Y",
                                        "HIDE_NOT_AVAILABLE" => "N",
                                        "PAGE_ELEMENT_COUNT" => "8",
                                        "LINE_ELEMENT_COUNT" => "3",
                                        "PROPERTY_CODE" => array(
                                            0 => "name",
                                            1 => "comment",
                                            2 => "stars",
                                            3 => "",
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
                                        "CACHE_TYPE" => "Y",
                                        "CACHE_TIME" => "3600",
                                        "CACHE_GROUPS" => "Y",
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

                            <?= typo($arResult["DETAIL_TEXT"]) ?>
                        </div>

                        <?$videosCount  = 0;
                            foreach ($arResult['PROPERTIES']['video_about']['~VALUE'] as $videoYoutube) {
                                $videosCount++;
                            }
                            if ($arResult['PROPERTIES']['video_about']['~VALUE'] != "") {?>
                            <p class="productSelectTitle"><?= GetMessage("VIDEO_PRESENTATIONS") ?> <? if($videosCount > 1) { ?><span><a href="#"><?= GetMessage("SHOW_ALL") ?></a></span><span class="count">(<?= $videosCount ?>)</span><? } ?></p>
                            <?}?>

                        <div class="videoWrapp">
                            <?foreach ($arResult['PROPERTIES']['video_about']['~VALUE'] as $videoYoutube) {
                                echo ($videoYoutube);
                            }?>
                        </div>


                        <?if (!empty ($arResult['TAGS']) ) {
                            echo "<p class='productSelectTitle'>" . GetMessage("KEYWORDS") . "</p>";
                            echo "<ul class='keyWords' itemprop='keywords'>";
                            $el = array('TAGS' => $arResult['TAGS']);
                            $el['TAGS'] = explode(',', $el['TAGS']);
                            for ($i = 0; $i < ($size = sizeof ($el['TAGS']) ); $i++) {
                                if (trim ($el['TAGS'][$i]) == '') continue;
                                print "<li><a href=\"/search/index.php?q={$el['TAGS'][$i]}\" class=\"nowrap\">{$el['TAGS'][$i]}</a></li>";

                            }
                            echo "</ul>";
                        }?>
                    </div>

                    <?if ($arResult["REVIEWS_COUNT"] > 0) {?>
                        <div class="recenzion" id="prodBlock2">
                            <?foreach ($arResult["REVIEWS"] as $reviewList) {?>
                                <?if (!empty($reviewList["PREVIEW_TEXT"])) {?>
                                    <a href="/content/reviews/<?=$reviewList['ID']?>/" target="_blank">
                                        <?}?>
                                    <span class="recenz_author_name"><?= $reviewList["NAME"] ?></span>
                                    <?if (!empty($reviewList["PREVIEW_TEXT"])) {?>
                                    </a>
                                    <?}?>
                                <div class="recenz_text">
                                    <?= $reviewList["PREVIEW_TEXT"] ?>
                                    <? if ($reviewList["PREVIEW_TEXT"] == "") {
                                        echo $reviewList["DETAIL_TEXT"];
                                    }?>
                                    <?if (!empty($reviewList["PROPERTY_SOURCE_LINK_VALUE"])) {?><!-- noindex -->
                                        <a href="<?= $reviewList["PROPERTY_SOURCE_LINK_VALUE"] ?>" rel="nofollow" target="_blank"><?= $reviewList["PROPERTY_SOURCE_LINK_VALUE"] ?></a><!-- /noindex -->
                                        <?}?>
                                </div>

                                <?}?>
                        </div>
                        <?}?>
                    <div class="review" id="prodBlock3">
                        <div class="ReviewsFormWrap">
                            <?$APPLICATION-> IncludeComponent("cackle.reviews", ".default", array( "CHANNEL_ID" => $arResult["ID"] ), false);?>
                        </div>
                    </div>
                    <div class="aboutAutor" id="prodBlock4">
                        <?if (!empty($arResult["AUTHORS"])) {?>
                            <?foreach ($arResult["AUTHOR"] as $author) {
                                    $currAuth = CIBlockElement::GetList(array(), array("ID" => $author["ID"]), false, false, array("PROPERTY_AUTHOR_DESCRIPTION")) -> Fetch();
                                    $currAuthFull = CIBlockElement::GetByID($author["ID"])->GetNext();
                                    if (!empty ($author["PROPERTY_ORIG_NAME_VALUE"])) {
                                        $authorFullName = $author["NAME"] . " / " . $author["PROPERTY_ORIG_NAME_VALUE"];
                                    } else {
                                        $authorFullName = $author["NAME"];
                                }?>

                                <div class="author_info">
                                    <span class="author_name"><a href="<?=$currAuthFull[DETAIL_PAGE_URL]?>"><?=$authorFullName?></a></span>

                                    <?= !empty($author["IMAGE_FILE"]["SRC"]) ? "<img src='".$author["IMAGE_FILE"]["SRC"]."' align='left' style='padding-right:30px;' />" : ""?><?=$currAuth["PROPERTY_AUTHOR_DESCRIPTION_VALUE"]["TEXT"]?>

                                </div>
                                <br>

                                <?}?>
                            <?}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<? global $authBooksFilter;
if (!empty ($arResult["PROPERTIES"]["AUTHORS"]["VALUE"][0]) ) {
    $authBooksFilter = array('PROPERTY_AUTHORS' => $arResult["PROPERTIES"]["AUTHORS"]["VALUE"][0], "!ID" => $arResult["ID"]);

    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "this_author_books",
        array(
            "IBLOCK_TYPE_ID" => "catalog",
            "IBLOCK_ID" => "4",
            "BASKET_URL" => "/personal/cart/",
            "COMPONENT_TEMPLATE" => "this_author_books",
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
            "FILTER_NAME" => "authBooksFilter",
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
            "CACHE_TYPE" => "Y",
            "CACHE_TIME" => "3600",
            "CACHE_GROUPS" => "N",
            "SET_TITLE" => "Y",
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
}?>

<? /* Получаем от RetailRocket рекомендации для товара */
global $recommFilter;
$recsArray = $arResult["STRING_RECS"];

if ($recsArray[0] > 0) {
    foreach ($recsArray as $recBook) {
        $recommFilter['ID'][] = $recBook;
    }
}
$printid = implode(", ", $recsArray);?>
<script>
    function rrAsyncInit() {
        try {rrApi.view(<?= $arResult['ID']; ?>);} catch(e) {}
    }
</script>

<script type="text/javascript" src="//static.criteo.net/js/ld/ld.js" async="true"></script>
<script type="text/javascript">
    window.criteo_q = window.criteo_q || [];
    window.criteo_q.push(
        { event: "setAccount", account: 18519 },
        <?if ($USER -> IsAuthorized()) {?>
            { event: "setEmail", email: "<?= $USER -> GetEmail() ?>" },
            <?}?>
        { event: "setSiteType", type: "d" },
        { event: "viewItem", item: "<?= $arResult['ID'] ?>" }
    );
</script>

<?if ($recommFilter['ID'][0] > 0) { // Если рекомендации есть, ничего не меняем и отправляем статистику в RR?>
    <script>
    function rrAsyncInit() {
        try {rrApi.recomTrack('UpSellItemToItems', <?= $arResult["ID"] ?>, [<?= $printid ?>]);} catch(e) {}
    }
    </script>
    <div class="weRecomWrap">
        <div class="centerWrapper">
            <p class="tile"><?= GetMessage("ALSO_RECOMMENDED_BOOKS") ?></p>
            <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "all_recommended_books",
                array(
                    "IBLOCK_TYPE_ID" => "catalog",
                    "IBLOCK_ID" => "4",
                    "BASKET_URL" => "/personal/cart/",
                    "COMPONENT_TEMPLATE" => "all_recommended_books",
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
                    "FILTER_NAME" => "recommFilter",
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
            );

            unset($RecommFilter);?>
        </div>
    </div>
<?}?>
<?$frame->end();?>
<div class="reviewsSliderWrapp">
    <div class="centerWrapper">
        <div class="giftWrap">
            <img src="/img/twi.png">
            <form action="/" method="post">
                <input type="text" placeholder="Ваш e-mail" name="email" onkeypress="if (event.keyCode == 13) {return SubmitRequest(event);}">
                <input type="button" value="">
            </form>
            <div class="some_info">
                <?= GetMessage("SUBSCRIPTION_REQUEST_ACCEPTED" )?>
            </div>
            <p class="title">
                <?= GetMessage("GIFT_BOOK_TITLE") ?>
            </p>
            <p>
                <?= GetMessage("GIFT_BOOK_DESCRIPTION") ?>
            </p>
        </div>

        <p class="sliderName youViewedTitle"><?= GetMessage("VIEWED_BOOKS_TITLE") ?></p>

        <? global $arFilter;
		// LATEST SEEN ###############
		$latestSeen = unserialize($APPLICATION->get_cookie("LASTEST_SEEN"));   
		$latestSeen  = (!$latestSeen ? array() : $latestSeen);
		// Remove 
		//unset($latestSeen[$arResult['ID']]);
		$key = array_search($arResult['ID'], $latestSeen, true);
		if (empty($key)) {
			$latestSeen[time()] = $arResult['ID'];
		}
		if (count($latestSeen) > 6) {
			 array_splice($latestSeen,0,-6);
		}


        if ($latestSeen) {
            $arFilter = array('ID' => array());
            //$latestSeen = array_slice (array_reverse (array_keys ($latestSeen) ), 0, 6);
            foreach ($latestSeen as $bookID) {
                $arFilter['ID'][] = intval($bookID);
            }

            $APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "viewed_books",
    array(
        "IBLOCK_TYPE_ID" => "catalog",
        "IBLOCK_ID" => "4",
        "BASKET_URL" => "/personal/cart/",
        "COMPONENT_TEMPLATE" => "viewed_books",
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
        "CACHE_TYPE" => "Y",
        "CACHE_TIME" => "3600",
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
		$APPLICATION->set_cookie("LASTEST_SEEN", serialize($latestSeen));
		if (isset($_COOKIE['BITRIX_SM_LASTEST_SEEN_NEW'])) {
			unset($_COOKIE['BITRIX_SM_LASTEST_SEEN_NEW']);
			setcookie('BITRIX_SM_LASTEST_SEEN_NEW', null, -1, '/');
			return true;
		}
        }?>
    </div>
</div>

<!-- GdeSon -->
<script type="text/javascript" src="//www.gdeslon.ru/landing.js?mode=card&amp;codes=<?= $arResult["ID"] ?>:<?= round (($arPrice["DISCOUNT_VALUE_VAT"]), 2) ?>&amp;mid=79276"></script>

<script type="text/javascript">
cackle_widget = window.cackle_widget || [];
cackle_widget.push({widget: 'ReviewRating', id: 36574, html: '{{?(it.numr + it.numv) > 0}}{{=it.stars}} оценок: {{=it.numr+it.numv}}{{?}}'});
(function() {
    var mc = document.createElement('script');
    mc.type = 'text/javascript';
    mc.async = true;
    mc.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cackle.me/widget.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(mc, s.nextSibling);
})();
</script>