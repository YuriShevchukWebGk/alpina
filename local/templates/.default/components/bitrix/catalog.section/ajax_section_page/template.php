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
<?
$navnum = $arResult["NAV_RESULT"]->NavNum;
if ($_REQUEST["PAGEN_" . $navnum]) {
    //$_SESSION[$APPLICATION -> GetCurDir()] = $_REQUEST["PAGEN_" . $navnum];
}
?>

<div class="wrapperCategor">
    <div class="categoryWrapper">

        <div class="catalogIcon">
        </div>
        <div class="basketIcon">
        </div>

        <div class="contentWrapp">
            <h1><?= $arResult["NAME"]?></h1>



            <? global $SectionRoundBanner;
            $SectionRoundBanner = array("PROPERTY_BIND_TO_SECTION" => $arResult["ID"]);
            $APPLICATION->IncludeComponent(
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
                    "FILTER_NAME" => "SectionRoundBanner",
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

         

			<? /* Получаем от RetailRocket рекомендации для товара */
			$stringRecs = file_get_contents('http://api.retailrocket.ru/api/1.0/Recomendation/CategoryToItems/50b90f71b994b319dc5fd855/' . $arResult["ID"]);
			$recsArray = json_decode($stringRecs);  
			
			if ($recsArray[0] > 0) {
				$printid2 = array_slice($recsArray, 1, 6);
				foreach ($printid2 as $rec_book) {
					$BestsellFilter['ID'][] = $rec_book;
				}
			}
			$printid = implode(", ", $printid2);

			if ($BestsellFilter['ID'][0] > 0) {?>
				<p class="grayTitle"><?= GetMessage("POPULAR_ITEMS_TITLE")?></p>
				<?
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
				)
				//}?>
         <?} else {  //проверка на вывод подборок на главной?>
            <p class="grayTitle"></p>
         <?}?>  
         <?  //блок с цитатой ?>
         <?if (is_array($arResult["QUOTE_ARRAY"])) {?>
             <div class="titleDiv">
                 <?if ($arResult["QUOTE_ARRAY"]["DETAIL_PICTURE"]){?>
                     <div class="photo">
                         <img src="<?= $arResult["QUOTE_IMAGE"]["src"]?>">    
                     </div>
                 <?}?>
                 <p class="text">"<?= $arResult["QUOTE_ARRAY"]["DETAIL_TEXT"]?>"</p>
                 <p class="autor"><?= $arResult["QUOTE_ARRAY"]["PROPERTY_AUTHOR_NAME"]?></p>
             </div>
         <?}?>
         <?// блок с цитатой END ?>   
         <ul class="filterParams">
             <li <?if ($_REQUEST['SORT'] == 'POPULARITY' || !($_REQUEST['SORT'])) { ?> class="active" <?}?>>
                 <p data-id="1">
                     <?if ($_REQUEST['SORT'] == 'POPULARITY' && $_REQUEST["DIRECTION"] == 'ASC') {?>
                         <a href="/catalog/<?= $arParams["SECTION_CODE"]?>/?SORT=POPULARITY&DIRECTION=DESC" onclick="update_sect_page('popularity', 'desc', '<?= $arParams["SECTION_CODE"]?>'); return false;">По популярности</a>
                     <?} else {?>
                         <a href="/catalog/<?= $arParams["SECTION_CODE"]?>/?SORT=POPULARITY&DIRECTION=ASC" onclick="update_sect_page('popularity', 'asc', '<?= $arParams["SECTION_CODE"]?>'); return false;">По популярности</a>
                     <?}?>
                 </p>
             </li>
             <li <?if ($_REQUEST['SORT'] == 'DATE'){?>class="active"<?}?>>
                 <p data-id="2">
                     <?if ($_REQUEST['SORT'] == 'DATE' && $_REQUEST["DIRECTION"] == 'ASC') {?>
                         <a href="/catalog/<?= $arParams["SECTION_CODE"]?>/?SORT=DATE&DIRECTION=DESC" onclick="update_sect_page('date', 'asc', '<?= $arParams["SECTION_CODE"]?>'); return false;">По дате выхода</a>
                     <?} else {?>
                         <a href="/catalog/<?= $arParams["SECTION_CODE"]?>/?SORT=DATE&DIRECTION=ASC" onclick="update_sect_page('date', 'desc', '<?= $arParams["SECTION_CODE"]?>'); return false;">По дате выхода</a>        
                     <?}?>
                 </p>                                                                                     
             </li>
             <li <?if ($_REQUEST['SORT'] == 'PRICE'){?>class="active"<?}?>>
                 <p data-id="3">
                     <?if ($_REQUEST['SORT'] == 'PRICE' && $_REQUEST["DIRECTION"] == 'ASC') {?>
                         <a href="/catalog/<?= $arParams["SECTION_CODE"]?>/?SORT=PRICE&DIRECTION=DESC" onclick="update_sect_page('price', 'desc', '<?= $arParams["SECTION_CODE"]?>'); return false;">По цене</a>
                     <?} else {?>
                         <a href="/catalog/<?= $arParams["SECTION_CODE"]?>/?SORT=PRICE&DIRECTION=ASC" onclick="update_sect_page('price', 'asc', '<?= $arParams["SECTION_CODE"]?>'); return false;">По цене</a>
                     <?}?>
                 </p>
             </li>
         </ul>
         <div class="otherBooks" id="block1">
             <ul>

                 <?$criteoCounter = 0; 
                 $criteoItems = Array(); 
                 $gtmEcommerceImpressions = '';
                     foreach ($arResult["ITEMS"] as $cell => $arItem) {  
                         foreach ($arItem["PRICES"] as $code => $arPrice) { 
                         ?>
                         <li>
                             <div class="categoryBooks">
                                 <div class="sect_badge">
                                     <?if (($arItem["PROPERTIES"]["discount_ban"]["VALUE"] != "Y") 
                                         && $arItem['PROPERTIES']['spec_price']['VALUE'] ) {
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
                                             case 30:
                                                 echo '<img class="discount_badge" src="/img/30percent.png">';
                                                 break;
                                             case 40:
                                                 echo '<img class="discount_badge" src="/img/40percent_black.png">';
                                                 break;

                                         } 
                                     }?>
                                 </div>
                                 
                                 <a href="<?= $arItem["DETAIL_PAGE_URL"]?>" onclick="productClickTracking(<?= $arItem["ID"];?>, '<?= $arItem["NAME"];?>', '<?= ceil($arPrice["DISCOUNT_VALUE_VAT"])?>','<?= $arResult["NAME"]?>', <?= ($cell+1)?>, 'Catalog Section');">
                                     <div class="section_item_img">
                                         <?if ($arResult[$arItem["ID"]]["PICTURE"]["src"]) {?>               
                                             <img src=<?= $arResult[$arItem["ID"]]["PICTURE"]["src"]?>>
                                         <?} else {?>
                                             <img src="/images/no_photo.png" width="142" height="142">    
                                         <?}?>
                                         <?if(!empty($arItem["PROPERTIES"]["number_volumes"]["VALUE"])) {?>
                                             <span class="volumes"><?= $arItem["PROPERTIES"]["number_volumes"]["VALUE"]?></span>
                                         <?}?>
                                     </div> 
                                     <p class="nameBook" title="<?= $arItem["NAME"]?>"><?= $arItem["NAME"]?></p>
                                     <p class="bookAutor"><?= $arResult[$arItem["ID"]]["CURRENT_AUTHOR"]["NAME"]?></p>
                                     <p class="tapeOfPack"><?= $arItem["PROPERTIES"]["COVER_TYPE"]["VALUE"]?></p>
                                     <?
                                     if (intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "soon") 
                                        && intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "net_v_nal")) {

                                            if ($arPrice["DISCOUNT_VALUE_VAT"]) { ?>
                                                <p class="priceOfBook"><?= ceil($arPrice["DISCOUNT_VALUE_VAT"])?> <span>руб.</span></p>
                                            <? } else { ?>
                                                <p class="priceOfBook"><?= ceil($arPrice["ORIG_VALUE_VAT"])?> <span>руб.</span></p>
                                            <? }
                                         ?>
                                 
                                         <?if ($arResult[$arItem["ID"]]["ITEM_IN_BASKET"]["QUANTITY"] == 0) {?>
                                            <a class="product<?= $arItem["ID"];?>" href="<?echo $arItem["ADD_URL"]?>" onclick="addtocart(<?= $arItem["ID"];?>, '<?= $arItem["NAME"];?>'); addToCartTracking(<?= $arItem["ID"];?>, '<?= $arItem["NAME"];?>', '<?= ceil($arPrice["DISCOUNT_VALUE_VAT"])?>','<?= $arResult["NAME"]?>', '1'); return false;">
                                                <p class="basketBook">В корзину</p>
                                            </a>
                                         <?} else {?>
                                            <a class="product<?= $arItem["ID"];?>" href="/personal/cart/">
                                                <p class="basketBook" style="background-color: #A9A9A9; color: white;">Оформить</p>
                                            </a> 
                                         <?}?>
                                 <?} else if (intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) == getXMLIDByCode(CATALOG_IBLOCK_ID, "STATE", "net_v_nal")) {?>
                                    <p class="priceOfBook"><?= $arItem["PROPERTIES"]["STATE"]["VALUE"]?></p>
                                            
                                 <?} else {?>
                                    <p class="priceOfBook"><?= strtolower(FormatDate("j F", MakeTimeStamp($arItem['PROPERTIES']['SOON_DATE_TIME']['VALUE'], "DD.MM.YYYY HH:MI:SS")));?></p>
                                         
                                 <?}?>
                             </a>
                                 <? if ($USER -> IsAuthorized()) { ?>
                                     <p class="basketLater" id="<?= $arItem["ID"]?>">Куплю позже</p>
                                 <? } ?>
                             </div>        
                         </li>
                         <?      //}
                         }
                         if($criteoCounter<3){
                             array_push($criteoItems, $arItem['ID']);  
                         }
                         $criteoCounter++;

                         $gtmEcommerceImpressions .= "{";
                         $gtmEcommerceImpressions .= "'name': '" . $arItem["NAME"] . "',";
                         $gtmEcommerceImpressions .= "'id': '" . $arItem['ID'] . "',";
                         $gtmEcommerceImpressions .= "'price': '" . ceil($arPrice["DISCOUNT_VALUE_VAT"]) . "',";
                         $gtmEcommerceImpressions .= "'category': '" . $arResult["NAME"] . "',";
                         $gtmEcommerceImpressions .= "'list': 'category - " . $arResult["NAME"] . "',";
                         $gtmEcommerceImpressions .= "'position': '" . ($cell+1) . "'";
                         $gtmEcommerceImpressions .= "},";                        
                 }?>

                 <script type="text/javascript">
                     <!-- //dataLayer GTM -->
                     dataLayer.push({
                         'categoryName' : '<?= $arResult["NAME"]?>',
                         'categoryId' : '<?= $arResult['ID'];?>',
                         'ecommerce': {
                             'impressions': [
                                 <?= $gtmEcommerceImpressions?>
                             ]
                         }

                     });
                     <!-- // dataLayer GTM -->
                 </script>


                 <!--Criteo counter-->
                 <script type="text/javascript" src="//static.criteo.net/js/ld/ld.js" async="true"></script>
                 <script type="text/javascript">
                     window.criteo_q = window.criteo_q || [];
                     window.criteo_q.push(
                         { event: "setAccount", account: 18519 },
                         <?if ($USER->IsAuthorized()) {?>  
                             { event: "setEmail", email: "<?= $USER->GetEmail()?>" },
                         <?}?>
                         { event: "setSiteType", type: "d" },
                         { event: "viewList", item: [<?foreach ($criteoItems as $criteoItem) {echo $criteoItem.', ';};?>]}
                     );
                 </script>                    
             </ul>

         </div>
            <div class="wishlist_info">
                <div class="CloseWishlist"><img src="/img/catalogLeftClose.png"></div>
                <span></span>
            </div>   





            <?if (($arResult["NAV_RESULT"]->NavPageCount) > 1) {?>
                <p class="showMore">Показать ещё</p>
            <?}?>
			<?=$arResult["NAV_STRING"]?>			
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




    </div>
</div>

<?
    if (!isset($_SESSION[$APPLICATION -> GetCurDir()])) {
        $_SESSION[$APPLICATION -> GetCurDir()] = 1;
    }
?>
</div>
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
        })
        <?$navnum = $arResult["NAV_RESULT"]->NavNum;
        switch ($arParams["ELEMENT_SORT_FIELD2"]) {
            case "CATALOG_PRICE_1":
            $sort = "PRICE";
            break;
            
            case "PROPERTY_POPULARITY":
            $sort = "POPULARITY";
            break;
            
            case "PROPERTY_YEAR":
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
        var WrappHeight = $(".wrapperCategor").height();
		var RecHeight = $(".grayTitle").height();
        var BooksLiLength = $(".otherBooks ul li").length;
		
		var startHeight = WrappHeight+RecHeight+100 + Math.ceil(($(".otherBooks ul li").length - 15) / 5) * 455;
		$(".wrapperCategor").css("height", startHeight+"px");
		
        $('.showMore').click(function(){
           // var otherBooks = $(this).siblings(".otherBooks");
            $.fancybox.showLoading();
            <?
            if ($_REQUEST["SORT"]) {
            ?>
                $.get(window.location.href + '&PAGEN_<?= $navnum?>=' + page, function(data) {
                    var next_page = $('.otherBooks ul li', data);
                    $('.otherBooks ul').append(next_page);
                    page++;            
                })
            <?
            } else {?>
                $.get('<?= $arResult["SECTION_PAGE_URL"]?>?SORT=<?= $sort?>&DIRECTION=<?= $arParams["ELEMENT_SORT_ORDER2"]?>&PAGEN_<?= $navnum?>='+page, 
                    function(data) {
                    var next_page = $('.otherBooks ul li', data);
                    $('.otherBooks ul').append(next_page);
                    page++;            
                })    
            <?
            }
            ?>
            .done(function() {
                    $.fancybox.hideLoading();
                    $(".nameBook").each(function() {
                        if($(this).length > 0) {
                            $(this).html(truncate($(this).html(), 40));    
                        }    
                    });
                    var otherBooksHeight = 1360 * ($(".otherBooks ul li").length / 15);
                    console.log($(".otherBooks ul li").length);
                   
                    var categorHeight = WrappHeight+RecHeight+200 + Math.ceil(($(".otherBooks ul li").length - 15) / 5) * 455;    
                    
                    $(".otherBooks").css("height", otherBooksHeight+"px");
                    $(".wrapperCategor").css("height", categorHeight+"px");
                    $(".contentWrapp").css("height", categorHeight-10+"px");
            });
            if (page == maxpage) {
                $('.showMore').hide();
            }
            return false;

        });
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
                     $.get('<?= $arResult["SECTION_PAGE_URL"]?>?SORT=<?= $sort?>&DIRECTION=<?= $arParams["ELEMENT_SORT_ORDER2"]?>&PAGEN_<?= $navnum?>='+page, 
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
                        $(".wrapperCategor").css("height", categorHeight+"px");
                        $(".contentWrapp").css("height", categorHeight-10+"px");

                });
                if (upd_page == maxpage) {
                    $('.showMore').hide();
                }    
            }
        <?}?>
        <?if (!$USER -> IsAuthorized()) {?>
            $(".categoryWrapper .categoryBooks").hover(function() {
                $(this).css("height", "390px");
            });
        <?}?>    
    });
</script>