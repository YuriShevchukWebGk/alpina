<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Авторам: издательство ищет новых авторов в России");
    $APPLICATION->SetPageProperty("keywords", "Информация для авторов");
    $APPLICATION->SetPageProperty("description", "Ищем авторов! Мы предлагаем лучшие финансовые условия, качества и гарантируем продажи ваших книг. Для продвижения заполните форму на сайте нашего издательства.");
    $APPLICATION->SetTitle("Авторам");
?>
<style>
	.authorsContent{color:#222;font-size:18px;font-family:Walshein_light!important}
	td{padding-top:25px}
</style>
<div class="searchWrap">
    <div class="catalogWrapper">
        <?$APPLICATION->IncludeComponent("bitrix:search.title", "search_form", 
                Array(
                    "CATEGORY_0" => "",    // Ограничение области поиска
                    "CATEGORY_0_TITLE" => "",    // Название категории
                    "CHECK_DATES" => "N",    // Искать только в активных по дате документах
                    "COMPONENT_TEMPLATE" => ".default",
                    "CONTAINER_ID" => "title-search",    // ID контейнера, по ширине которого будут выводиться результаты
                    "INPUT_ID" => "title-search-input",    // ID строки ввода поискового запроса
                    "NUM_CATEGORIES" => "1",    // Количество категорий поиска
                    "ORDER" => "date",    // Сортировка результатов
                    "PAGE" => "#SITE_DIR#search/index.php",    // Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
                    "SHOW_INPUT" => "Y",    // Показывать форму ввода поискового запроса
                    "SHOW_OTHERS" => "N",    // Показывать категорию "прочее"
                    "TOP_COUNT" => "5",    // Количество результатов в каждой категории
                    "USE_LANGUAGE_GUESS" => "Y",    // Включить автоопределение раскладки клавиатуры
                ),
                false
            );?>    
    </div>
</div>
<script>
	$(document).ready(function() {
		$(".submit").click(function() {
			$(this).hide();
			$(this).before('<div id="loadingInfo"><div class="spinner"><div class="spinner-icon"></div></div></div>');
		});
	});
</script>
<div class="ContentcatalogIcon">
</div>
<div class="ContentbasketIcon">
</div>

<div class="deliveryPageTitleWrap">
    <div class="centerWrapper">
        <p><a href="/" style="color:#fefefe">Книги Альпина</a></p>
        <h1>Авторам</h1>
    </div>
</div>

<div>
    <div class="centerWrapper">
        <div class="authorsContent">
            <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    ".default",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => "authors.php",
                        "EDIT_TEMPLATE" => ""
                    )
                );?><br>
            <center><a onclick="$('#author_form').slideToggle(); return false;" style="font-size:24px" href="#">Нажмите, чтобы открыть форму</a></center>
            <div id="author_form"<?if (!isset($_POST['web_form_submit']) && $_GET['formresult'] != 'addok'):?> style="display:none"<?endif;?>>
                <?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"publisher", 
	array(
		"WEB_FORM_ID" => "5",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"LIST_URL" => "",
		"EDIT_URL" => "",
		"SUCCESS_URL" => "",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"COMPONENT_TEMPLATE" => "publisher",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?>
            </div>
        </div>
    </div>
</div>

 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>