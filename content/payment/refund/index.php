<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "оплата, книги, наличные, банковская карта");
$APPLICATION->SetPageProperty("description", "Условия возврата и обмена товара");
$APPLICATION->SetTitle("Условия возврата и обмена товара в интернет-магазине «Альпина Паблишер»");
?>
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
    
    <div class="ContentcatalogIcon">
    </div>
    <div class="ContentbasketIcon">
    </div>
    
    <div class="deliveryPageTitleWrap">
        <div class="centerWrapper">
            <p>Главная</p>
            <h1>Условия возврата и обмена товара</h1>
        </div>
    </div>

    <div class="deliveryBodyWrap">
        <div class="centerWrapper">
            <div class="delivMenuWrapp">
авыаываыв

        </div>
    </div>
	</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>