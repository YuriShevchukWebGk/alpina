<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сменить пароль");
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
            <p>Главная</p>    
            <h1>Личный кабинет</h1>
        </div>
    </div>
    <div class="historyBodywrap">
        <div class="centerWrapper">
<div class="orderHistorWrap">
<?
$APPLICATION->IncludeComponent("bitrix:main.profile", "auth_popup", Array(
    "SET_TITLE" => "Y",    // Устанавливать заголовок страницы
    ),
    false
);
?>
</div>
<div class="historyMenuWrap">
                <ul>
                    <li>
                        <a href="/personal/">персональные данные</a>
                    </li>
                    <li>
                        <a href="/personal/order">история заказов</a>
                    </li>
                    <li>
                        <a href="/personal/wishlist">список желаемых покупок</a>
                    </li>
                    <li>
                        <a href="/personal/change_pw" class="active">сменить пароль</a>
                    </li>
                </ul>
            </div>
      </div>
</div>
<script>
$(document).ready(function(){
    $("body").addClass("changePassWr");
})
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>