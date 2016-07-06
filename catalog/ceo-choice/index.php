<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Выбор генерального директора");
?> 
<script>
function showFull() {
	$('.hideFull').slideToggle(1000);
};
</script>
<div style="color: #627478;font-family: 'Walshein_regular';font-size: 17px;line-height: 24px;max-width:1140px;margin: 100px auto 0;">
<img src="/img/ai.jpg" style="margin-right:40px;" align="left" />
В последнее время друзья и знакомые все чаще задают мне вопрос «Что из деловой литературы стоит почитать?». Многие из них с утра до вечера пашут на работе, а времени и сил разбираться с морем выходящих в России книг совершенно нет.  В то же время хочется почитать что-то действительно интересное и полезное, особенно в период отпуска. Я не просто читаю деловые книги, но как руководитель внедряю концепции, которые в них изложены. Ниже список из 10 книг, каждая из которых серьезно повлияла на меня и на то, как наша компания ведет бизнес. Готов дать гарантию, что время потраченное на их прочтение, будет отличной инвестицией.
<ol>
<li>Айн Рэнд «Атлант расправил плечи». Это всемирно известный философский роман, который повлиял на мировоззрение миллионов людей во всем мире. Философия объективизма, изложенная в романе, является на сегодняшний день идеологической основой капитализма и предпринимательства.</li>

<li>Айн Рэнд «Источник». Важная книга, посвященная соотношению личного и общественного, способности противостоять серости и мнению большинства. На мой взгляд, знакомство с творчеством Айн Рэнд лучше начинать именно с этой книги.</li>

<li>Стивен  Кови «Семь навыков высокоэффективных людей». Самая лучшая книга посвященная саморазвитию и самая популярная книга издательства.  Оптимально прочитать ее, когда вам 20 лет, а потом перечитывать раз в 2-3 года.</li>

<li>Михай Чиксентмихайи «Поток». Получение радости от процесса работы - не "вишенка на торте", а основа успеха в профессиональной деятельности и в жизни в целом. Автор дает представление о психологических механизмах, которые делаю для нас ту или иную работу привлекательной.</li>

<li>Эрик Рис «Бизнес с нуля». Благодаря концепции Lean Startup,  создание нового бизнеса (или нового направления в рамках существующего) перестало быть игрой в орлянку, когда успех определяется стечением случайных обстоятельств или везением. Это системный подход, которые ориентирован на считывание потребностей клиентов. Мы используем этот подход во всех внутренних стартапах.</li>

<li>Александер Остервальдер «Построение бизнес-моделей». Удобный алгоритм систематизации, визуализации и улучшения бизнес-модели. Формат представления бизнес-модели "по Остервальтеру" уже стал стандартом при привлечении венчурных инвестиций во всем мире.</li>

<li>Питер Тиль «От нуля к единице». Умная книга для предпринимателей полная нестандартных и практичных идей. Очень интересна концепция создания монополии в рамках определенной ниши. </li>

<li>Нирадж Давар «Идеальный маркетинг». Главный актив любого бизнеса - не станки и даже не ноу-хау, а клиенты. Книга про то, как на практике построить клиентоориентированный бизнес. Эта книга очень существенно повлияла на формирование стратегии нашей компании.</li>

<li>Гевин Кеннеди «Договориться можно обо всем». Просто лучшая книга по переговорам.</li>

<li>Оливия Фокс Кабейн «Харизма: Как влиять, убеждать и вдохновлять». Харизма – это не врожденное качество. Это навык, который можно освоить. Подходы, которые реально работают.</li>
</ol>


</span>
</div>
<?  
    global $arrFilter_choice;
    //$arrFilter_choice = array('PROPERTY_editors_choice' => 235);
	$arrFilter_choice = array('ID' => array(6115,66476,8194,68994,76106,66535,8232,7024,8564,8830,8498,60923));?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"editor_choice", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"COMPONENT_TEMPLATE" => "editor_choice",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "NAME",
		"ELEMENT_SORT_FIELD2" => "ID",
		"ELEMENT_SORT_ORDER" => "ASC",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FILTER_NAME" => "arrFilter_choice",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "3",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "18",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SECTION_CODE" => "",
		"SECTION_CODE_PATH" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "Y",
		"SEF_RULE" => "",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>