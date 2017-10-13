<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Конфиденциальность персональной информации");
$APPLICATION->SetPageProperty("description", "Конфиденциальность персональной информации в интернет-магазине «Альпина Паблишер»");
$APPLICATION->SetTitle("Конфиденциальность персональной информации");
?><div class="searchWrap">
    <div class="catalogWrapper">
         <?$APPLICATION->IncludeComponent(
    "bitrix:search.title",
    "search_form",
    Array(
        "CATEGORY_0" => "",
        "CATEGORY_0_TITLE" => "",
        "CHECK_DATES" => "N",
        "COMPONENT_TEMPLATE" => ".default",
        "CONTAINER_ID" => "title-search",
        "INPUT_ID" => "title-search-input",
        "NUM_CATEGORIES" => "1",
        "ORDER" => "date",
        "PAGE" => "#SITE_DIR#search/index.php",
        "SHOW_INPUT" => "Y",
        "SHOW_OTHERS" => "N",
        "TOP_COUNT" => "5",
        "USE_LANGUAGE_GUESS" => "Y"
    )
);?>
    </div>
</div>
<div class="ContentcatalogIcon">
</div>
<div class="ContentbasketIcon">
</div>
<div class="deliveryPageTitleWrap">
    <div class="centerWrapper">
        <p>
            Главная
        </p>
        <h1>Данные о результатах проведения СОУТ в ООО «Альпина Паблишер»</h1>
    </div>
</div>
<style>
ul {
    list-style-type: none
}
h1 {
    font-size:32px!important
}
</style>
<div class="deliveryBodyWrap" style="padding: 50px 0;">
    <div class="centerWrapper">
        <div class="deliveryTypeWrap">
Проведена специальная оценка условий труда (далее – СОУТ) в ООО «Альпина Паблишер» на 63 рабочих местах. Работников, занятых на рабочих местах, - 64 чел., из них женщин 34.
<br /><br />
Классы условий труда на рабочих местах (р.м.) признаны допустимыми (2класс) на 61 р.м., признаны вредными (3.1 класс) на 2 р.м.
<br /><br />
По результатам СОУТ разработан перечень рекомендуемых мероприятий по улучшению труда для 2 рабочих мест.
<br /><br />
Перечень рекомендуемых мероприятий по улучшению условий труда:<ul>
<li>Организовать рациональные режимы труда и отдыха.</li>
</ul>
Отчет о проведении СОУТ в ООО «Альпина Паблишер» утвержден 04.09.2017 года.
<br /><br />
Срок действия СОУТ – 5 лет.

        </div>
    </div>
</div>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>