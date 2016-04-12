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
<?/*
*/ //arshow($arParams);
?>

<div class="pageTitleWrap">
            <div class="catalogWrapper">
                <div class="catalogIcon searchCatalogModified">
                </div>
                <div class="basketIcon searchBasketModified">
                </div>
                <p class="title">Результаты поиска
                <?if(is_object($arResult["NAV_RESULT"])):?>
                    <span><?echo $arResult["NAV_RESULT"]->SelectedRowsCount()." результатов"?></span>
                <?endif;?>
                </p>    
            </div>
</div>
        <?/* Получаем рекомендации для поиска от RetailRocket */
        global $arrFilter;
        $stringRecs = file_get_contents('http://api.retailrocket.ru/api/1.0/Recomendation/SearchToItems/50b90f71b994b319dc5fd855/?keyword='.$_REQUEST["q"]);
        $recsArray = json_decode($stringRecs);
        $arrFilter = Array('ID' => (array_slice($recsArray,0,5)));
        if ($arrFilter['ID'][0] > 0) {?>
        
        <div class="interestingWrap">
            <div class="catalogWrapper">
                <p class="title">Те, кто искали «<?=$_REQUEST["q"]?>» купили</p>

                <div class="bookEasySlider">
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:catalog.section", 
                        "recommended_books", 
                        array(
                            "IBLOCK_TYPE_ID" => "catalog",
                            "IBLOCK_ID" => "4",
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
<div class="searchBooksWrap">
            <div class="searchWidthWrapper">
            <?
                foreach ($arResult["ITEMS"] as $arItem)
                {   
                    $dbBasketItems = CSaleBasket::GetList(array(), array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL", "PRODUCT_ID" => $arItem["ID"]), false, false, array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "PRODUCT_PROVIDER_CLASS"))->Fetch();
                    $pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>165, "height"=>233), BX_RESIZE_IMAGE_PROPORTIONAL, true);

                    //if ($price["PRICE"] > 0)
                    //{
            ?>
                    <div class="searchBook">
                        <div>
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <div class="search_item_img">
                                <?
                                if ($pict["src"])
                                {
                                ?>
                                    <img src="<?=$pict["src"]?>">
                                <?
                                }
                                else
                                {
                                ?>
                                    <img src="/images/no_photo.png" width="155">    
                                <?
                                }
                                ?>
                            </div>
                            </a>
                        </div>
                        <div class="descrWrap">
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <p class="bookNames" title="<?=$arItem["NAME"]?>"><?=$arItem["NAME"]?></p>
                            </a>
                            <p class="autorName"><?//=$item["PROPERTY_AUTHORS_VALUE"]?></p>
                            <p class="wrapperType"><?=$arItem["PROPERTIES"]["COVER_TYPE"]["VALUE"]?></p>
                            <?if (($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"] != 22) && ($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"] != 23))
                            {
                            ?>
                                <p class="price"><?=ceil($arItem["CATALOG_PRICE_1"])?> руб.</p>
                            <?
                            }
                            else if ($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"] == 22)
                            {?>
                                <p class="price">Ожидаемая дата выхода: <?=strtolower(FormatDate("j F", MakeTimeStamp($arItem['PROPERTIES']['SOON_DATE_TIME']['VALUE'], "DD.MM.YYYY HH:MI:SS")));?></p>    
                            <?
                            }
                            else
                            {
                            ?>
                                <p class="price"><?=$arItem["PROPERTIES"]["STATE"]["VALUE"]?></p>    
                            <?
                            }
                            ?>
                            <div class="description"><?=$arItem["PREVIEW_TEXT"]?></div>
                            <?
                            if (($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"] != 22) && ($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"] != 23))
                            {
                                if ($dbBasketItems["QUANTITY"] == 0)
                                {?>
                                    <a class="product<?=$arItem["ID"];?>" href="<?='/search/index.php?action=ADD2BASKET&id='.$arItem['ID']?>" 
                                    onclick="addtocart(<?=$arItem['ID'];?>, '<?=$arItem["NAME"];?>');return false;">
                                    <p class="basket">В корзину</p>
                                    </a>
                                <?}
                                else
                                {?>
                                    <a class="product<?=$arItem["ID"];?>" href="/personal/cart/">
                                    <p class="inBasket" style="background-color: #A9A9A9;color: white;">Оформить</p>
                                    </a>
                                <?}
                            }?>
                            
                        </div>
                    </div>
                <?//}
                }?>  
            </div>
            <a href="#"><p class="showMore">Показать ещё</p></a>
        </div>


        
<?/*?>
<div class="allBooksWrapp">
            <div class="catalogWrapper">
                <p class="titleMain">Все книги</p>
                <div class="catalogBooks">
                    <?foreach($arResult["ITEMS"] as $arItem)
                    {
                        foreach ($arItem["PRICES"] as $code => $arPrice)
                        {
                            if ($arPrice["PRINT_DISCOUNT_VALUE"])
                            {
                        $pict = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>142, 'height'=>210), BX_RESIZE_IMAGE_EXACT, true);
                        ?>
                    <div class="bookWrapp">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                        <img src="<?=$pict["src"]?>">
                        <p class="bookName"><?=$arItem["NAME"]?></p>
                        </a>
                        <p class="bookPrice"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></p>
                    </div>
                    <?      }
                        }
                    }?>
                </div>
                <a href="#" class="allBooks">Показать ещё</a>
            </div>
</div>
<?*/?>
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
    
    <?$navnum = $arResult["NAV_RESULT"]->NavNum;?>
        <?if (isset($_REQUEST["PAGEN_".$navnum])) {?>
            var page = <?=$_REQUEST["PAGEN_".$navnum]?> + 1;
        <?}else{?>
            var page = 2;
        <?}?>
        var maxpage = <?=($arResult["NAV_RESULT"]->NavPageCount)?>;
            $('.showMore').on('click', function(){
                $.fancybox.showLoading();
                $.get(window.location.href+'&PAGEN_<?=$navnum?>='+page, function(data) {
                    var next_page = $('.searchWidthWrapper .searchBook', data);
                    $('.searchWidthWrapper').append(next_page);
                    page++;            
                })
                .done(function() 
                {
                    $.fancybox.hideLoading();
                    $(".descrWrap .bookNames").each(function()
                    {
                        if($(this).length > 0)
                        {
                            $(this).html(truncate($(this).html(), 25));    
                        }    
                    });
                    
                    $(".description").each(function()
                        {
                        if($(this).length > 0)
                        {
                        $(this).html(truncate($(this).html(), 81));    
                        }    
                    });
    
                });
                if (page == maxpage) {
                    $('.showMore').hide();
                    //$('.phpages').hide();
                }
                return false;
            });   
});
</script>