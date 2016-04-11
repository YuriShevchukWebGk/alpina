<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Где мой заказ?");
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
        <h1>Где мой заказ?</h1>
    </div>
 </div>
<div class="where-order">
            <div id="where-order-content">
                <div class="order-input">
                    <span class="where-order-title">Введите номер заказа:</span> 
                    <input id="order-id" name="orderID" type="text"/> 
                    <button id="check-order">Узнать</button>
                </div>
                <div class="error_message"></div>
                <div class="info-order" id="info-order">
                    <div class="status">Статус: <span id="status-value"></span></div>
                    <div class="change">Дата изменения статуса: <span id="change-value"></span></div>  <br>
                    <div class="more-info">Узнать подробнее можно по тел 8 (495) 980-80-77</div>
                </div> <br>
            </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>