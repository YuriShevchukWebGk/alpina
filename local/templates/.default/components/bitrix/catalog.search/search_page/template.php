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
    $arElements = $APPLICATION->IncludeComponent(
        "bitrix:search.page",
        "",
        Array(
            "RESTART" => $arParams["RESTART"],
            "NO_WORD_LOGIC" => $arParams["NO_WORD_LOGIC"],
            "USE_LANGUAGE_GUESS" => $arParams["USE_LANGUAGE_GUESS"],
            "CHECK_DATES" => $arParams["CHECK_DATES"],
            "arrFILTER" => array("iblock_".$arParams["IBLOCK_TYPE"]),
            "arrFILTER_iblock_".$arParams["IBLOCK_TYPE"] => array($arParams["IBLOCK_ID"]),
            "USE_TITLE_RANK" => "Y",
            "DEFAULT_SORT" => "rank",
            "FILTER_NAME" => "",
            "SHOW_WHERE" => "N",
            "arrWHERE" => array(),
            "SHOW_WHEN" => "N",
            "PAGE_RESULT_COUNT" => 50,
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "PAGER_TITLE" => "",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "N",
        ),
        $component,
        array('HIDE_ICONS' => 'Y')
    );

    if (!empty($arElements) && is_array($arElements))
    {
        global $searchFilter;

        $searchFilter = array(
            "=ID" => $arElements,
            ">CATALOG_PRICE_1" => 0
        );
        if(!$USER->IsAdmin()){
            $searchFilter["!PROPERTY_FOR_ADMIN_VALUE"] = "Y";
        }
       // arshow($searchFilter);
        $APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "found_books",
            array(
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                "PROPERTY_CODE" => $arParams["PROPERTY_CODE"],
                "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                "OFFERS_FIELD_CODE" => $arParams["OFFERS_FIELD_CODE"],
                "OFFERS_PROPERTY_CODE" => $arParams["OFFERS_PROPERTY_CODE"],
                "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                "OFFERS_LIMIT" => $arParams["OFFERS_LIMIT"],
                "SECTION_URL" => $arParams["SECTION_URL"],
                "DETAIL_URL" => $arParams["DETAIL_URL"],
                "BASKET_URL" => $arParams["BASKET_URL"],
                "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "DISPLAY_COMPARE" => $arParams["DISPLAY_COMPARE"],
                "PRICE_CODE" => $arParams["PRICE_CODE"],
                "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
                "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
                "USE_PRODUCT_QUANTITY" => $arParams["USE_PRODUCT_QUANTITY"],
                "CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
                "CURRENCY_ID" => $arParams["CURRENCY_ID"],
                "HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
                "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                "FILTER_NAME" => "searchFilter",
                "SECTION_ID" => "",
                "SECTION_CODE" => "",
                "SECTION_USER_FIELDS" => array(),
                "INCLUDE_SUBSECTIONS" => "Y",
                "SHOW_ALL_WO_SECTION" => "Y",
                "META_KEYWORDS" => "",
                "META_DESCRIPTION" => "",
                "BROWSER_TITLE" => "",
                "ADD_SECTIONS_CHAIN" => "N",
                "SET_TITLE" => "N",
                "SET_STATUS_404" => "N",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "N",
            ),
            $arResult["THEME_COMPONENT"],
            array('HIDE_ICONS' => 'Y')
        );
    }
    elseif ((!is_array($arElements)) || empty($arElements))
    {?>

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
    <?
    }
?>
<script>
    $(document).ready(function() {

        if ($(document).find(".noResultBodyWrap").size() == 0)
        {
            $(".catalogIcon, .basketIcon").css("top", "30px");
        }
        else
        {
            $(".catalogIcon, .basketIcon").css("top", "279px");
        }

        if ($(".interestSlideWrap .sliderElement").size() < 7)
        {
            $('.interestSlideWrap .left').hide();
            $('.interestSlideWrap .rigth').hide();
        }
    });
</script>