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
/** @var CBitrixComponent $component */
?>
<div class="search-page">
<form action="" method="get">
<?/*if($arParams["USE_SUGGEST"] === "Y"):
    if(strlen($arResult["REQUEST"]["~QUERY"]) && is_object($arResult["NAV_RESULT"]))
    {
        $arResult["FILTER_MD5"] = $arResult["NAV_RESULT"]->GetFilterMD5();
        $obSearchSuggest = new CSearchSuggest($arResult["FILTER_MD5"], $arResult["REQUEST"]["~QUERY"]);
        $obSearchSuggest->SetResultCount($arResult["NAV_RESULT"]->NavRecordCount);
    }
    ?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:search.suggest.input",
        "",
        array(
            "NAME" => "q",
            "VALUE" => $arResult["REQUEST"]["~QUERY"],
            "INPUT_SIZE" => 40,
            "DROPDOWN_SIZE" => 10,
            "FILTER_MD5" => $arResult["FILTER_MD5"],
        ),
        $component, array("HIDE_ICONS" => "Y")
    );?>
<?else:?>
    <input type="text" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" size="40" />
<?endif;*/?>
<?/*if($arParams["SHOW_WHERE"]):?>
    &nbsp;<select name="where">
    <option value=""><?=GetMessage("SEARCH_ALL")?></option>
    <?foreach($arResult["DROPDOWN"] as $key=>$value):?>
    <option value="<?=$key?>"<?if($arResult["REQUEST"]["WHERE"]==$key) echo " selected"?>><?=$value?></option>
    <?endforeach?>
    </select>
<?endif;?>
    &nbsp;<input type="submit" value="<?=GetMessage("SEARCH_GO")?>" />
    <input type="hidden" name="how" value="<?echo $arResult["REQUEST"]["HOW"]=="d"? "d": "r"?>" />
<?if($arParams["SHOW_WHEN"]):?>
    <script>
    var switch_search_params = function()
    {
        var sp = document.getElementById('search_params');
        var flag;
        var i;

        if(sp.style.display == 'none')
        {
            flag = false;
            sp.style.display = 'block'
        }
        else
        {
            flag = true;
            sp.style.display = 'none';
        }

        var from = document.getElementsByName('from');
        for(i = 0; i < from.length; i++)
            if(from[i].type.toLowerCase() == 'text')
                from[i].disabled = flag;

        var to = document.getElementsByName('to');
        for(i = 0; i < to.length; i++)
            if(to[i].type.toLowerCase() == 'text')
                to[i].disabled = flag;

        return false;
    }
    </script>
    <br /><a class="search-page-params" href="#" onclick="return switch_search_params()"><?echo GetMessage('CT_BSP_ADDITIONAL_PARAMS')?></a>
    <div id="search_params" class="search-page-params" style="display:<?echo $arResult["REQUEST"]["FROM"] || $arResult["REQUEST"]["TO"]? 'block': 'none'?>">
        <?$APPLICATION->IncludeComponent(
            'bitrix:main.calendar',
            '',
            array(
                'SHOW_INPUT' => 'Y',
                'INPUT_NAME' => 'from',
                'INPUT_VALUE' => $arResult["REQUEST"]["~FROM"],
                'INPUT_NAME_FINISH' => 'to',
                'INPUT_VALUE_FINISH' =>$arResult["REQUEST"]["~TO"],
                'INPUT_ADDITIONAL_ATTR' => 'size="10"',
            ),
            null,
            array('HIDE_ICONS' => 'Y')
        );?>
    </div>
<?endif*/?>
</form>

<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):
    ?>
    <div class="search-language-guess">
        <?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
    </div><?
endif;?>

<?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
<?elseif($arResult["ERROR_CODE"]!=0):/*?>
    <p><?=GetMessage("SEARCH_ERROR")?></p>
    <?ShowError($arResult["ERROR_TEXT"]);?>
    <p><?=GetMessage("SEARCH_CORRECT_AND_CONTINUE")?></p>
    <br /><br />
    <p><?=GetMessage("SEARCH_SINTAX")?><br /><b><?=GetMessage("SEARCH_LOGIC")?></b></p>
    <table border="0" cellpadding="5">
        <tr>
            <td align="center" valign="top"><?=GetMessage("SEARCH_OPERATOR")?></td><td valign="top"><?=GetMessage("SEARCH_SYNONIM")?></td>
            <td><?=GetMessage("SEARCH_DESCRIPTION")?></td>
        </tr>
        <tr>
            <td align="center" valign="top"><?=GetMessage("SEARCH_AND")?></td><td valign="top">and, &amp;, +</td>
            <td><?=GetMessage("SEARCH_AND_ALT")?></td>
        </tr>
        <tr>
            <td align="center" valign="top"><?=GetMessage("SEARCH_OR")?></td><td valign="top">or, |</td>
            <td><?=GetMessage("SEARCH_OR_ALT")?></td>
        </tr>
        <tr>
            <td align="center" valign="top"><?=GetMessage("SEARCH_NOT")?></td><td valign="top">not, ~</td>
            <td><?=GetMessage("SEARCH_NOT_ALT")?></td>
        </tr>
        <tr>
            <td align="center" valign="top">( )</td>
            <td valign="top">&nbsp;</td>
            <td><?=GetMessage("SEARCH_BRACKETS_ALT")?></td>
        </tr>
    </table>
<?*/elseif(count($arResult["SEARCH"])>0):?>
    <?//if($arParams["DISPLAY_TOP_PAGER"] != "N") echo $arResult["NAV_STRING"]
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
        <div class="AuthorsWrapp">
            <p class="title"><?=GetMessage("AUTHORS_TITLE")?></p>
            <div class="searchBooksWrap">
                <div class="searchWidthWrapper">
                    <?foreach($arResult["SEARCH"] as $arItem):
                        if ($arItem["PARAM2"] == 29):?>
                            <?
                            $curr_auth = CIBlockElement::GetList(array(), array("ID" => $arItem["ITEM_ID"]), false, false, array("ID", "DETAIL_PICTURE", "PREVIEW_TEXT", "PROPERTY_STATE")) -> Fetch();
                            $pict = CFile::ResizeImageGet($curr_auth["DETAIL_PICTURE"], array('width'=>165, "height"=>233), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                            ?>
                            <div class="searchBook">
                                <div>
                                    <a href="<?echo $arItem["URL"]?>"><?//echo $arItem["TITLE_FORMATED"]?>
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
                                    <a href="<?=$arItem["URL"]?>">
                                        <p class="bookNames" title="<?=$arItem["TITLE"]?>"><?=$arItem["TITLE"]?></p>
                                       
                                        
                                        <div class="description"><?=$curr_auth["PREVIEW_TEXT"]?></div>
                                    </a>
                                </div>
                            </div>
                                
                                    <?/*if (
                                        $arParams["SHOW_RATING"] == "Y"
                                        && strlen($arItem["RATING_TYPE_ID"]) > 0
                                        && $arItem["RATING_ENTITY_ID"] > 0
                                    ):?>
                                        <div class="search-item-rate"><?
                                            $APPLICATION->IncludeComponent(
                                                "bitrix:rating.vote", $arParams["RATING_TYPE"],
                                                Array(
                                                    "ENTITY_TYPE_ID" => $arItem["RATING_TYPE_ID"],
                                                    "ENTITY_ID" => $arItem["RATING_ENTITY_ID"],
                                                    "OWNER_ID" => $arItem["USER_ID"],
                                                    "USER_VOTE" => $arItem["RATING_USER_VOTE_VALUE"],
                                                    "USER_HAS_VOTED" => $arItem["RATING_USER_VOTE_VALUE"] == 0? 'N': 'Y',
                                                    "TOTAL_VOTES" => $arItem["RATING_TOTAL_VOTES"],
                                                    "TOTAL_POSITIVE_VOTES" => $arItem["RATING_TOTAL_POSITIVE_VOTES"],
                                                    "TOTAL_NEGATIVE_VOTES" => $arItem["RATING_TOTAL_NEGATIVE_VOTES"],
                                                    "TOTAL_VALUE" => $arItem["RATING_TOTAL_VALUE"],
                                                    "PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER_PROFILE"],
                                                ),
                                                $component,
                                                array("HIDE_ICONS" => "Y")
                                            );?>
                                        </div>
                        <?endif;*/?>
                               
                    <?endif;/*?>
                
                <small><?=GetMessage("SEARCH_MODIFIED")?> <?=$arItem["DATE_CHANGE"]?></small><br /><?
                if($arItem["CHAIN_PATH"]):?>
                    <small><?=GetMessage("SEARCH_PATH")?>&nbsp;<?=$arItem["CHAIN_PATH"]?></small><?
                endif;
                    */?>
                <?endforeach;?>
            </div>
        </div>
    </div>
    <div class="BooksWrapp">                
         <p class="title"><?=GetMessage("BOOKS_TITLE")?></p>
            <div class="searchBooksWrap">
                <div class="searchWidthWrapper">
                    <?foreach($arResult["SEARCH"] as $arItem):
                            if ($arItem["PARAM2"] == 4):?>
                                <?
                                $dbBasketItems = CSaleBasket::GetList(array(), array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL", "PRODUCT_ID" => $arItem["ITEM_ID"]), false, false, array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "PRODUCT_PROVIDER_CLASS"))->Fetch();
                                $curr_book = CIBlockElement::GetList(array(), array("ID" => $arItem["ITEM_ID"]), false, false, array("ID", "DETAIL_PICTURE", "PREVIEW_TEXT", "PROPERTY_STATE", "PROPERTY_SOON_DATE_TIME", "PROPERTY_AUTHORS", "CATALOG_GROUP_1")) -> Fetch();
                                $pict = CFile::ResizeImageGet($curr_book["DETAIL_PICTURE"], array('width'=>165, "height"=>233), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                                ?>
                                <div class="searchBook">
                                    <div>
                                         <a href="<?echo $arItem["URL"]?>"><?//echo $arItem["TITLE_FORMATED"]?>
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
                                        <a href="<?=$arItem["URL"]?>">
                                            <p class="bookNames" title="<?=$arItem["TITLE"]?>"><?=$arItem["TITLE"]?></p>
                                            <p class="autorName"><?//=$item["PROPERTY_AUTHORS_VALUE"]?></p>
                                            <p class="wrapperType"><?=$arItem["PROPERTIES"]["COVER_TYPE"]["VALUE"]?></p>
                                            <?if (($curr_book["PROPERTY_STATE_ENUM_ID"] != 22) && ($curr_book["PROPERTY_STATE_ENUM_ID"] != 23))
                                                {
                                                ?>
                                                <p class="price"><?=ceil($curr_book["CATALOG_PRICE_1"])?> руб.</p>
                                                <?
                                                }
                                                else if ($curr_book["PROPERTY_STATE_ENUM_ID"] == 22)
                                                {?>
                                                <p class="price">Ожидаемая дата выхода: <?=strtolower(FormatDate("j F", MakeTimeStamp($curr_book["PROPERTY_SOON_DATE_TIME_VALUE"], "DD.MM.YYYY HH:MI:SS")));?></p>    
                                                <?
                                                }
                                                else
                                                {
                                                ?>
                                                <p class="price"><?=$curr_book["PROPERTY_STATE_VALUE"]?></p>    
                                                <?
                                                }
                                            ?>
                                            <div class="description"><?=$curr_book["PREVIEW_TEXT"]?></div>
                                            <?
                                                if (($curr_book["PROPERTY_STATE_ENUM_ID"] != 22) && ($curr_book["PROPERTY_STATE_ENUM_ID"] != 23))
                                                {
                                                    if ($dbBasketItems["QUANTITY"] == 0)
                                                    {?>
                                                    <a class="product<?=$arItem["ID"];?>" href="<?='/search/index.php?action=ADD2BASKET&id='.$arItem["ITEM_ID"]?>" 
                                                        onclick="addtocart(<?=$arItem["ITEM_ID"];?>, '<?=$arItem["TITLE"];?>');return false;">
                                                        <p class="basket">В корзину</p>
                                                    </a>
                                                    <?}
                                                    else
                                                    {?>
                                                    <a class="product<?=$arItem["ITEM_ID"];?>" href="/personal/cart/">
                                                        <p class="inBasket" style="background-color: #A9A9A9;color: white;">Оформить</p>
                                                    </a>
                                                    <?}
                                                }
                                            ?>
                                        </a>
                                    </div>
                                </div>
                            <?endif;?>
                    <?endforeach;?>
                </div>
            </div>
    </div>
    <?//if($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
    
    <p>
    <?/*if($arResult["REQUEST"]["HOW"]=="d"):?>
        <a href="<?=$arResult["URL"]?>&amp;how=r<?echo $arResult["REQUEST"]["FROM"]? '&amp;from='.$arResult["REQUEST"]["FROM"]: ''?><?echo $arResult["REQUEST"]["TO"]? '&amp;to='.$arResult["REQUEST"]["TO"]: ''?>"><?=GetMessage("SEARCH_SORT_BY_RANK")?></a>&nbsp;|&nbsp;<b><?=GetMessage("SEARCH_SORTED_BY_DATE")?></b>
    <?else:?>
        <b><?=GetMessage("SEARCH_SORTED_BY_RANK")?></b>&nbsp;|&nbsp;<a href="<?=$arResult["URL"]?>&amp;how=d<?echo $arResult["REQUEST"]["FROM"]? '&amp;from='.$arResult["REQUEST"]["FROM"]: ''?><?echo $arResult["REQUEST"]["TO"]? '&amp;to='.$arResult["REQUEST"]["TO"]: ''?>"><?=GetMessage("SEARCH_SORT_BY_DATE")?></a>
    <?endif;*/?>
    </p>
<?else:?>
    <?//ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND"));?>
    <div class="catalogIcon tempclass1">
    </div>
    <div class="basketIcon">
    </div>
    <div class="noResultBodyWrap">
        <div class="centerWrapper noResWrapp">
            <p class="noResultTitle">По вашему запросу ничего не найдено</p>
            <p class="noResText">К сожалению, по запросу "<?=$_REQUEST["q"]?>" ничего не найдено, попробуйте изменить поисковый запрос или следуйте нашим рекомендациям.</p>
        </div>
    </div>

    <div class="categoryWrapperWhite">
        <div class="interestSlideWrap">
            <?
                $arrFilter = array('PROPERTY_recommended_book' => '243');

                $APPLICATION->IncludeComponent("bitrix:catalog.section", "interesting_items", Array(
                    "IBLOCK_TYPE_ID" => "catalog",
                    "IBLOCK_ID" => "4",    // Инфоблок
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
                );?>
        </div>
    </div>
<?endif;?>
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
            
            if ($(".searchWidthWrapper .searchBook").size() < 9)
            {
                $('.showMore').hide();    
            }
            if($('.bookEasySlider').length > 0){
                easySlider('.bookEasySlider', 6);
            }
            if ($(".AuthorsWrapp .searchWidthWrapper .searchBook").size() == 0)
            {
                $(".AuthorsWrapp .title").hide();
            }
            if ($(".BooksWrapp .searchWidthWrapper .searchBook").size() == 0)
            {
                $(".BooksWrapp .title").hide();
            }   
});

</script>