<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Награды");
?>
<div class="searchWrap">
    <div class="catalogWrapper">
        <!-- форма поиска -->
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

<div class="historyCoverWrap">
    <div class="centerWrapper">
        <p></p>    
        <h1><?=$APPLICATION -> ShowTitle()?></h1>
    </div>
</div>
<div class="historyBodywrap">
    <div class="centerWrapper">
        <div class="orderHistorWrap">
            <?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => "/content/publisher/include/awards.php"
	),
	false
);?>
        </div>
        <div class="historyMenuWrap">
            <ul>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:menu", 
                    "personal_left_menu", 
                    array(
                        "ROOT_MENU_TYPE" => "publisher_left",
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
                        "COMPONENT_TEMPLATE" => "personal_left_menu"
                    ),
                    false
                );?>
            </ul>
        </div>
    </div>
</div>
 
<script>
$(document).ready(function(){
    $(".historyBodywrap > div").addClass("centerWrapper");
    $("body").addClass("historyBodyWr");
});
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>