<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Серии");

/*if ($_REQUEST["DIRECTION"])
{
    $order = $_REQUEST["DIRECTION"];
}
else
{
    $order = "desc";
}
switch ($_REQUEST["SORT"])
{
    case "DATE":
    $sort = "PROPERTY_YEAR";
    break;
    
    case "PRICE":
    $sort = "CATALOG_PRICE_1";
    break;
    
    case "POPULARITY":
    $sort = "PROPERTY_POPULARITY";          //PROPERTY_POPULARITY
    $order = "asc";
    break;
    
    default:
    $sort = "PROPERTY_STATEDATE";
    $order = "desc";
}

global $arrFilter;
$arrFilter["PROPERTY_STATE"] = 21;
?>
<?$APPLICATION->IncludeComponent("bitrix:catalog.section", "bestsellers", Array(
    "ACTION_VARIABLE" => "action",    // Название переменной, в которой передается действие
        "ADD_PICT_PROP" => "-",    // Дополнительная картинка основного товара
        "ADD_PROPERTIES_TO_BASKET" => "Y",    // Добавлять в корзину свойства товаров и предложений
        "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
        "ADD_TO_BASKET_ACTION" => "ADD",    // Показывать кнопку добавления в корзину или покупки
        "AJAX_MODE" => "N",    // Включить режим AJAX
        "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
        "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
        "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
        "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
        "BACKGROUND_IMAGE" => "-",    // Установить фоновую картинку для шаблона из свойства
        "BASKET_URL" => "/personal/basket.php",    // URL, ведущий на страницу с корзиной покупателя
        "BROWSER_TITLE" => "-",    // Установить заголовок окна браузера из свойства
        "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
        "CACHE_GROUPS" => "N",    // Учитывать права доступа
        "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
        "CACHE_TYPE" => "N",    // Тип кеширования
        "COMPONENT_TEMPLATE" => "all_books",
        "CONVERT_CURRENCY" => "N",    // Показывать цены в одной валюте
        "DETAIL_URL" => "",    // URL, ведущий на страницу с содержимым элемента раздела
        "DISABLE_INIT_JS_IN_COMPONENT" => "N",    // Не подключать js-библиотеки в компоненте
        "DISPLAY_BOTTOM_PAGER" => "Y",    // Выводить под списком
        "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
        "ELEMENT_SORT_FIELD" => $sort,    // По какому полю сортируем элементы
        "ELEMENT_SORT_FIELD2" => "name",    // Поле для второй сортировки элементов
        "ELEMENT_SORT_ORDER" => $order,    // Порядок сортировки элементов
        "ELEMENT_SORT_ORDER2" => "asc",    // Порядок второй сортировки элементов
        "FILTER_NAME" => "arrFilter",    // Имя массива со значениями фильтра для фильтрации элементов
        "HIDE_NOT_AVAILABLE" => "N",    // Не отображать товары, которых нет на складах
        "IBLOCK_ID" => "4",    // Инфоблок
        "IBLOCK_TYPE" => "catalog",    // Тип инфоблока
        "INCLUDE_SUBSECTIONS" => "Y",    // Показывать элементы подразделов раздела
        "LABEL_PROP" => "-",    // Свойство меток товара
        "LINE_ELEMENT_COUNT" => "3",    // Количество элементов выводимых в одной строке таблицы
        "MESSAGE_404" => "",    // Сообщение для показа (по умолчанию из компонента)
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",    // Текст кнопки "Добавить в корзину"
        "MESS_BTN_BUY" => "Купить",    // Текст кнопки "Купить"
        "MESS_BTN_DETAIL" => "Подробнее",    // Текст кнопки "Подробнее"
        "MESS_BTN_SUBSCRIBE" => "Подписаться",    // Текст кнопки "Уведомить о поступлении"
        "MESS_NOT_AVAILABLE" => "Нет в наличии",    // Сообщение об отсутствии товара
        "META_DESCRIPTION" => "-",    // Установить описание страницы из свойства
        "META_KEYWORDS" => "-",    // Установить ключевые слова страницы из свойства
        "OFFERS_LIMIT" => "5",    // Максимальное количество предложений для показа (0 - все)
        "PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
        "PAGER_DESC_NUMBERING" => "N",    // Использовать обратную навигацию
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
        "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
        "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
        "PAGER_TEMPLATE" => ".default",    // Шаблон постраничной навигации
        "PAGER_TITLE" => "Товары",    // Название категорий
        "PAGE_ELEMENT_COUNT" => "15",    // Количество элементов на странице
        "PARTIAL_PRODUCT_PROPERTIES" => "N",    // Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
        "PRICE_CODE" => array(    // Тип цены
            0 => "BASE",
        ),
        "PRICE_VAT_INCLUDE" => "Y",    // Включать НДС в цену
        "PRODUCT_ID_VARIABLE" => "id",    // Название переменной, в которой передается код товара для покупки
        "PRODUCT_PROPERTIES" => "",    // Характеристики товара
        "PRODUCT_PROPS_VARIABLE" => "prop",    // Название переменной, в которой передаются характеристики товара
        "PRODUCT_QUANTITY_VARIABLE" => "",    // Название переменной, в которой передается количество товара
        "PRODUCT_SUBSCRIPTION" => "N",    // Разрешить оповещения для отсутствующих товаров
        "PROPERTY_CODE" => array(    // Свойства
            0 => "",
            1 => "",
        ),
        "SECTION_CODE" => "",    // Код раздела
        "SECTION_CODE_PATH" => "",    // Путь из символьных кодов раздела
        "SECTION_ID" => $_REQUEST["SECTION_ID"],    // ID раздела
        "SECTION_ID_VARIABLE" => "SECTION_ID",    // Название переменной, в которой передается код группы
        "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
        "SECTION_USER_FIELDS" => array(    // Свойства раздела
            0 => "",
            1 => "",
        ),
        "SEF_MODE" => "Y",    // Включить поддержку ЧПУ
        "SEF_RULE" => "",    // Правило для обработки
        "SET_BROWSER_TITLE" => "Y",    // Устанавливать заголовок окна браузера
        "SET_LAST_MODIFIED" => "N",    // Устанавливать в заголовках ответа время модификации страницы
        "SET_META_DESCRIPTION" => "Y",    // Устанавливать описание страницы
        "SET_META_KEYWORDS" => "Y",    // Устанавливать ключевые слова страницы
        "SET_STATUS_404" => "N",    // Устанавливать статус 404
        "SET_TITLE" => "Y",    // Устанавливать заголовок страницы
        "SHOW_404" => "N",    // Показ специальной страницы
        "SHOW_ALL_WO_SECTION" => "Y",    // Показывать все элементы, если не указан раздел
        "SHOW_CLOSE_POPUP" => "N",    // Показывать кнопку продолжения покупок во всплывающих окнах
        "SHOW_DISCOUNT_PERCENT" => "N",    // Показывать процент скидки
        "SHOW_OLD_PRICE" => "N",    // Показывать старую цену
        "SHOW_PRICE_COUNT" => "1",    // Выводить цены для количества
        "TEMPLATE_THEME" => "blue",    // Цветовая тема
        "USE_MAIN_ELEMENT_SECTION" => "N",    // Использовать основной раздел для показа элемента
        "USE_PRICE_COUNT" => "N",    // Использовать вывод цен с диапазонами
        "USE_PRODUCT_QUANTITY" => "N",    // Разрешить указание количества товара
    ),
    false
);*/
$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"series", 
	array(
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "series",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(
			0 => "DETAIL_PICTURE",
			1 => "",
		),
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "РЎС‚СЂР°РЅРёС†Р°",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "",
			1 => "LAST_NAME",
			2 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "45",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "PREVIEW_TEXT",
			1 => "DETAIL_PICTURE",
			2 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"MEDIA_PROPERTY" => "",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "9999",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "РќРѕРІРѕСЃС‚Рё",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SLIDER_PROPERTY" => "",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"TEMPLATE_THEME" => "blue",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N",
		"SEF_FOLDER" => "/series/",
		"TAGS_CLOUD_ELEMENTS" => "150",
		"PERIOD_NEW_TAGS" => "",
		"DISPLAY_AS_RATING" => "rating",
		"FONT_MAX" => "50",
		"FONT_MIN" => "10",
		"COLOR_NEW" => "3E74E6",
		"COLOR_OLD" => "C0C0C0",
		"TAGS_CLOUD_WIDTH" => "100%",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_ID#/",
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>