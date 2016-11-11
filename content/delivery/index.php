<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetPageProperty("keywords", "книги с доставкой");
    $APPLICATION->SetPageProperty("description", "Как производится доставка книг издательства «Альпина Паблишер». Доставка книг по России и миру");
    $APPLICATION->SetTitle("Способы доставки. Доставка по Москве, России и миру — интернет-магазин «Альпина Паблишер»");
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
        <h1>Доставка</h1>
    </div>
</div>

<div class="deliveryBodyWrap">
    <div class="centerWrapper">
        <div class="delivMenuWrapp">
            <?/*?>
                <div class="delivMenuWrapp">
                <ul>
                <li>курьерская доставка по москве в пределах мкад</li>
                <li>курьерская доставка за мкад и в подмосковье</li>
                <li>доставка почтой россии</li>
                <li>постамат/пункт выдачи заказов</li>
                <li>служба доставки iml</li>
                <li>самовывоз</li>
                <li>экспресс-доставка по россии и за рубеж</li>
                </ul>
                </div>
            <?*/?>
            <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"delivery_list", 
	array(
		"IBLOCK_TYPE_ID" => "catalog",
		"IBLOCK_ID" => "16",
		"BASKET_URL" => "/personal/cart/",
		"COMPONENT_TEMPLATE" => "delivery_list",
		"IBLOCK_TYPE" => "news",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FILTER_NAME" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"PAGE_ELEMENT_COUNT" => "12",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(
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
		"OFFERS_LIMIT" => "5",
		"TEMPLATE_THEME" => "site",
		"PRODUCT_DISPLAY_MODE" => "Y",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-",
		"OFFER_ADD_PICT_PROP" => "-",
		"OFFER_TREE_PROPS" => array(
			0 => "COLOR_REF",
			1 => "SIZES_SHOES",
			2 => "SIZES_CLOTHES",
		),
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_CLOSE_POPUP" => "N",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"OFFERS_CART_PROPERTIES" => array(
			0 => "COLOR_REF",
			1 => "SIZES_SHOES",
			2 => "SIZES_CLOTHES",
		),
		"ADD_TO_BASKET_ACTION" => "ADD",
		"PAGER_TEMPLATE" => "round",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"BACKGROUND_IMAGE" => "-",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N"
	),
	false
);?>
        </div>
        <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"delivery_types_list", 
	array(
		"IBLOCK_TYPE_ID" => "catalog",
		"IBLOCK_ID" => "16",
		"BASKET_URL" => "/personal/cart/",
		"COMPONENT_TEMPLATE" => "delivery_types_list",
		"IBLOCK_TYPE" => "news",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FILTER_NAME" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"PAGE_ELEMENT_COUNT" => "12",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(
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
		"OFFERS_LIMIT" => "5",
		"TEMPLATE_THEME" => "site",
		"PRODUCT_DISPLAY_MODE" => "Y",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-",
		"OFFER_ADD_PICT_PROP" => "-",
		"OFFER_TREE_PROPS" => array(
			0 => "COLOR_REF",
			1 => "SIZES_SHOES",
			2 => "SIZES_CLOTHES",
		),
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_CLOSE_POPUP" => "N",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"OFFERS_CART_PROPERTIES" => array(
			0 => "COLOR_REF",
			1 => "SIZES_SHOES",
			2 => "SIZES_CLOTHES",
		),
		"ADD_TO_BASKET_ACTION" => "ADD",
		"PAGER_TEMPLATE" => "round",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"BACKGROUND_IMAGE" => "-",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N"
	),
	false
);?>
        <?/*?>
            <div class="deliveryTextWrap">

            <div class="deliveryTypeWrap">
            <p class="title">Курьерская доставка по Москве в пределах МКАД</p>
            <img src="/img/deliveryType.png">
            <p>Сроки доставки:</p>
            <ul>
            <li>при оплате наличными - в течение <span>двух рабочих дней</span> после оформления заказа;</li>
            <li>при безналичном способе оплаты - в течение <span>двух дней после поступления средств</span> на наш расчетный счет.</li>
            </ul>
            <p>Стоимость доставки - <span>149 руб.</span></p>
            <p>Бесплатная доставка при заказе на сумму <span>от 2 000 руб.</span></p>
            <p class="deliveryTime">Время доставки - рабочие дни<span> с 11.00 до 19.00.</span></p>
            <p>В день доставки представитель курьерской службы свяжется с вами по телефону для согласования времени доставки. Пожалуйста, будьте на связи в день доставки. Курьер выезжает по заказу только после согласования деталей по телефону. </p>
            </div>


            <div class="deliveryTypeWrap">
            <p class="title">Курьерская доставка за МКАД и в Подмосковье</p>
            <img src="/img/deliveryType.png">
            <p>Сроки доставки:</p>
            <ul>
            <li>при оплате наличными - в течение <span>5 рабочих дней</span> после оформления заказа;</li>
            <li>при безналичном способе оплаты - в течение <span>5 дней после поступления средств</span> на наш расчетный счет.</li>
            </ul>
            <p>Стоимость доставки <a href="#">до 5 км за МКАД</a> - <span>149 руб.</span></p>
            <p>Курьерская доставка не производится в города расположенные дальше 5км от МКАД!</p>
            <p class="deliveryTime">Время доставки - рабочие дни<span> с 11.00 до 19.00.</span></p>
            <p>В день доставки представитель курьерской службы свяжется с вами по телефону для согласования времени доставки. Пожалуйста, будьте на связи в день доставки. Курьер выезжает по заказу только после согласования деталей по телефону. </p>
            </div>


            <div class="deliveryTypeWrap">
            <p class="title">Доставка почтой России</p>
            <img src="/img/rusPostDeliver.png" class="rusPostImg">    
            <p>Сроки доставки:</p>
            <p class="rusPostDeliv">доставка осуществляется в течение <span>7-28 дней</span>  момента оплаты заказа.</p>
            <p>Cтоимость доставки - <span>149 руб.</span></p>
            <p>Бесплатная доставка при заказе на сумму <span>от 2000 руб.</span></p>
            <p class="deliveryHint">Обратите внимание, что за заказанный по почте товар вы должны внести предоплату.</p>
            </div>


            <div class="deliveryTypeWrap">
            <p class="title">Постамат/Пункт выдачи заказов</p>
            <img src="/img/pickPointDel.png" class="pickImageDeliv">    
            <p class="pickDescription">Постаматы PickPoint - альтернативный способ досавки товаров, заказанных в интернет-магазинах, который предоставляет возможность самим выбирать место и время получения заказа.</p>
            <p>Стоимость доставки <a href="#">до 5 км за МКАД</a> - <span>249 руб.</span></p>
            <p>урьерская доставка не производится в города, расположнный дальше 5 км от МКАД!</p>
            <p class="deliveryTime">Время доставки - рабочие дни<span> с 11.00 до 19.00.</span></p>
            <p>В день доставки представитель курьерской службы свяжется с вами по телефону для согласования времени доставки. Пожалуйста, будьте на связи в день доставки. Курьер выезжает по заказу только после согласования деталей по телефону. </p>
            </div>


            <div class="deliveryTypeWrap">
            <p class="title">Служба доставки IML</p>    
            <img src="/img/imlDeliv.png">
            <p class="pickDescription">Постаматы PickPoint - альтернативный способ досавки товаров, заказанных в интернет-магазинах, который предоставляет возможность самим выбирать место и время получения заказа.</p>
            <p>Стоимость доставки <a href="#">до 5 км за МКАД</a> - <span>249 руб.</span></p>
            <p>урьерская доставка не производится в города, расположнный дальше 5 км от МКАД!</p>
            <p class="deliveryTime">Время доставки - рабочие дни<span> с 11.00 до 19.00.</span></p>
            <p>В день доставки представитель курьерской службы свяжется с вами по телефону для согласования времени доставки. Пожалуйста, будьте на связи в день доставки. Курьер выезжает по заказу только после согласования деталей по телефону. </p>
            </div>
            <div class="deliveryTypeWrap">
            <p class="title">Экспресс-доставка по России и за рубежом</p>    
            <img src="/img/delivFirst.png">
            <p>Сроки доставки:</p>
            <ul>
            <li>при оплате наличными - в течение <span>5 рабочих дней</span> после оформления заказа;</li>
            <li>при безналичном способе оплаты - в течение <span>5 дней после поступления средств</span> на наш расчетный счет.</li>
            </ul>
            <p>Стоимость доставки <a href="#">до 5 км за МКАД</a> - <span>149 руб.</span></p>
            <p>Курьерская доставка не производится в города расположенные дальше 5км от МКАД!</p>
            <p class="deliveryTime">Время доставки - рабочие дни<span> с 11.00 до 19.00.</span></p>
            <p>В день доставки представитель курьерской службы свяжется с вами по телефону для согласования времени доставки. Пожалуйста, будьте на связи в день доставки. Курьер выезжает по заказу только после согласования деталей по телефону. </p>
            </div>
            <div class="deliveryTypeWrap">
            <p class="title">Самовывоз</p>
            <img src="/img/secDeliv.png">
            <p>Сроки доставки:</p>
            <ul>
            <li>при оплате наличными - в течение <span>5 рабочих дней</span> после оформления заказа;</li>
            <li>при безналичном способе оплаты - в течение <span>5 дней после поступления средств</span> на наш расчетный счет.</li>
            </ul>
            <p>Стоимость доставки <a href="#">до 5 км за МКАД</a> - <span>149 руб.</span></p>
            <p>Курьерская доставка не производится в города расположенные дальше 5км от МКАД!</p>
            <p class="deliveryTime">Время доставки - рабочие дни<span> с 11.00 до 19.00.</span></p>
            <p>В день доставки представитель курьерской службы свяжется с вами по телефону для согласования времени доставки. Пожалуйста, будьте на связи в день доставки. Курьер выезжает по заказу только после согласования деталей по телефону. </p>        
            </div>
            </div>
        <?*/?>
    </div>
    </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>