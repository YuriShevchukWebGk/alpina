<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "контакты, альпина, адрес, телефон, почта");
$APPLICATION->SetPageProperty("description", "Как проехать в интернет-магазин «Альпина Паблишер». Контакты и схема проезда");
$APPLICATION->SetTitle("Контакты интернет-магазина «Альпина Паблишер», схема проезда, обратная связь");
?><div class="searchWrap">
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
            <h1>Контакты интернет-магазина и издательства</h1>
        </div>
    </div>


    <div class="contactsBodyWrap">
        <div class="centerWrapper">
        <?/*?>
            <div class="contactsFormWrap">
                <p>Обратная связь</p>
                <input type="text" placeholder="Ваше имя">
                <input type="text" placeholder="Ваш e-mail">
                <input type="text" placeholder="Ваш телефон">
                <textarea placeholder="Ваш вопрос" class="questInput"></textarea>
                <input type="submit" value="Отправить">
            </div>
        <?*/?>
            <?/*$APPLICATION->IncludeComponent(
        "bitrix:main.feedback",
        "feedback_form",
        Array(
            "USE_CAPTCHA" => "Y",
            "OK_TEXT" => "Спасибо, ваше сообщение принято.",
            "EMAIL_TO" => "raulschokino@yandex.ru",
            "REQUIRED_FIELDS" => array(),
            "EVENT_MESSAGE_ID" => array()
        ),
    false
    );*/?>
        <?$APPLICATION->IncludeComponent(
	"bitrix:iblock.element.add.form", 
	"feedback_form", 
	array(
		"SEF_MODE" => "Y",
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => "12",
		"PROPERTY_CODES" => array(
			0 => "183",
			1 => "184",
			2 => "185",
			3 => "NAME",
		),
		"PROPERTY_CODES_REQUIRED" => array(
			0 => "183",
			1 => "184",
			2 => "185",
			3 => "NAME",
		),
		"GROUPS" => array(
			0 => "2",
		),
		"STATUS_NEW" => "N",
		"STATUS" => "ANY",
		"LIST_URL" => "",
		"ELEMENT_ASSOC" => "PROPERTY_ID",
		"ELEMENT_ASSOC_PROPERTY" => "",
		"MAX_USER_ENTRIES" => "100000",
		"MAX_LEVELS" => "100000",
		"LEVEL_LAST" => "Y",
		"USE_CAPTCHA" => "N",
		"USER_MESSAGE_EDIT" => "",
		"USER_MESSAGE_ADD" => "Ваше сообщение успешно отправлено. Мы ответим в рабочее время на ваш e-mail",
		"DEFAULT_INPUT_SIZE" => "30",
		"RESIZE_IMAGES" => "Y",
		"MAX_FILE_SIZE" => "0",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "Y",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "Y",
		"CUSTOM_TITLE_NAME" => "Ваше имя",
		"CUSTOM_TITLE_TAGS" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"SEF_FOLDER" => "/",
		"COMPONENT_TEMPLATE" => "feedback_form"
	),
	false
);?>
            <div class="contactsTextWrap" itemprop="mainEntity" itemscope itemtype="http://schema.org/BookStore">
                <meta itemprop="name" content="Интернет-магазин «Альпина Паблишер»"/>
				<meta itemprop="url" content="http://<?=$_SERVER['SERVER_NAME']?>"/>
				<meta itemprop="logo" content="http://<?=$_SERVER['SERVER_NAME']?>/img/logo.png"/>
				<time itemprop="openingHours" datetime="Mo-Fr 08:00-18:00" />
				<!--noindex-->
				<p style="margin:30px 0;padding:20px;max-width:600px;background:#fffcdb">
				<b>График работы офиса интернет-магазина в&nbsp;предпраздничные и&nbsp;праздничные дни:</b> <br /><br />
				&bull; до&nbsp;29&nbsp;декабря в&nbsp;обычном режиме с&nbsp;8&nbsp;до&nbsp;18&nbsp;часов;<br />
				&bull; с&nbsp;30&nbsp;декабря по&nbsp;8&nbsp;января офис интернет-магазина работать не&nbsp;будет.
				<br /><br />

				Заказы оформляются с&nbsp;обычном режиме.
				<br />
				Заказы, оформленные с&nbsp;30&nbsp;декабря по&nbsp;8&nbsp;января, будут доставлены в&nbsp;первые несколько рабочих дней нового года.
				<br />
				Отправка заказов за&nbsp;пределы Москвы состоится в&nbsp;начале следующего года.
				</p>
				<!--/noindex-->
				
				<p>ООО «Альпина Паблишер»</p>
				<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
					<p><span itemprop="postalCode">123007</span>, <meta itemprop="addressCountry" content="RU" />Россия, <span itemprop="addressLocality">Москва</span>, м.Полежаевская</p>    
					<p itemprop="streetAddress">4-я Магистральная улица, дом 5, строение 1,</p>
				</div>					
				<p>подъезд 2, этаж 2</p>
				<p class="organisTelep"><span itemprop="telephone">+7 (495) 120-07-04</span><br />
				+7 (800) 550 53 22</p>
				<p class="organisMail" itemprop="email"><a href="mailto:shop@alpina.ru">shop@alpina.ru</a></p>
				<p class="timeTitle">Время работы</p>
				<p>С понедельника по пятницу с 8:00 до 18:00</p>
				<p class="wayTitle">Как к нам пройти</p>
				<p> Метро «Полежаевская», первый вагон из центра (в связи с реконструкцией станции выход из последнего вагона закрыт), из вестибюля налево. После выхода на улицу огибаете метро справа и двигаетесь вдоль Хорошевского шоссе. Далее проходите мимо ресторана «Макдоналдс», банков «Альфа-Банк» и «Промсвязь Банк». Переходите на противоположную сторону к ТЦ «Хорошо», поворачиваете направо и двигаетесь по 4-ой Магистральной улице. Проходите магазин «Ларес» и доходите до дома 5 строения 1. Вам нужен «БЦ на Магистральной», второй подъезд, второй этаж.</p>
            </div>
            
        </div>
    </div>


    <div class="mapContainerContact">
        <div class="mapConteiner">
            <div id="map" class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d2243.974588861782!2d37.51781221626531!3d55.776313180559676!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e6!4m5!1s0x46b549754dbcd707%3A0x2ae192d3a5ead8ee!2z0J_QvtC70LXQttCw0LXQstGB0LrQsNGP!3m2!1d55.7770248!2d37.517125!4m5!1s0x46b54975afeed949%3A0x4ec3046ee871bc47!2z0JDQu9GM0L_QuNC90LAg0L_QsNCx0LvQuNGI0LXRgCDQmNC90YLQtdGA0L3QtdGCINC80LDQs9Cw0LfQuNC9LCDQnNC-0YHQutCy0LAsINCz0L7RgNC-0LQg0JzQvtGB0LrQstCw!3m2!1d55.77453!2d37.520494899999996!5e0!3m2!1sen!2sru!4v1490355396292" width="100%" height="522" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
<script>
$(document).ready(function(){
    $("body").addClass("deliveryBody");
    
});
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>