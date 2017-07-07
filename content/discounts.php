<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Скидки");
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
            <h1>Скидки</h1>
        </div>
</div>
<div class="deliveryBodyWrap" style="padding: 50px 0;">
    <div class="centerWrapper">
        <div class="deliveryTypeWrap">      
            <p align="left">В нашем интернет-магазине действует система накопительная система скидок: </p>
             
             <div> </div>
             
             <div> </div>
             
             <h4><b>Накопительная скидка</b></h4>
           
        <div align="left"> </div>
           
        <p align="left">Когда вы оформляете заказ, сумма заказа добавляется на ваш накопительный счет. Как только сумма оплаченных заказов превысит 5 000 руб.(20 000 руб.), Вам автоматически предоставляется скидка в 10% (20% соответственно).</p>
           
        <div align="left"> </div>
           
        <div align="left"> </div>
           
        <h4 align="left"><b>Обратите внимание! </b></h4>
 
        <ul>           
            <li>          
                <div align="left">Сумма заказа с учетом скидки пересчитывается автоматически и указывается при оформлении заказа. Вам предоставляется информация о сумме скидки и стоимости заказа с учетом скидки (стоимость доставки не входит). </div>
            </li>
             
             <li>          
                <div align="left">          
                    <p>С историей заказов вы можете ознакомится в вашем &quot;Персональном разделе&quot;, вкладка &quot;Заказы&quot;. </p>
                </div>
             </li>
             
             <li>          
                <div align="left">          
                    <p><font>Накопительная скидка действует только в том случае, если вы заказываете книги на сайте под одним и тем же логином (e-mail).</font></p>
                </div>
             </li>
        </ul>
      ООО &laquo;Альпина Паблишер&raquo; оставляет за собой право изменить срок действия и правила начисления скидок в любой момент без согласования с пользователями.
            </div>
      </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>