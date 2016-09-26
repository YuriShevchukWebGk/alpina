<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты интернет-магазина «Альпина Паблишер», схема проезда, обратная связь");
/*?>
<div class="row">
    <div class="col-xs-12">
    <p><b>Телефон:</b> 8 (495) 212 85 06<br>
    <b>Адрес:</b> г. Москва, ул. 2-я Хуторская, д. 38</p>
    <iframe width="640" height="490" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.ru/maps?f=q&amp;source=s_q&amp;hl=ru&amp;geocode=&amp;q=%D0%B3.+%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0,+%D1%83%D0%BB.+2-%D1%8F+%D0%A5%D1%83%D1%82%D0%BE%D1%80%D1%81%D0%BA%D0%B0%D1%8F,+%D0%B4.+38%D0%90&amp;aq=&amp;sll=55,103&amp;sspn=90.84699,270.527344&amp;t=m&amp;ie=UTF8&amp;hq=&amp;hnear=2-%D1%8F+%D0%A5%D1%83%D1%82%D0%BE%D1%80%D1%81%D0%BA%D0%B0%D1%8F+%D1%83%D0%BB.,+38,+%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0,+127287&amp;ll=55.805478,37.569551&amp;spn=0.023154,0.054932&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="https://maps.google.ru/maps?f=q&amp;source=embed&amp;hl=ru&amp;geocode=&amp;q=%D0%B3.+%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0,+%D1%83%D0%BB.+2-%D1%8F+%D0%A5%D1%83%D1%82%D0%BE%D1%80%D1%81%D0%BA%D0%B0%D1%8F,+%D0%B4.+38%D0%90&amp;aq=&amp;sll=55,103&amp;sspn=90.84699,270.527344&amp;t=m&amp;ie=UTF8&amp;hq=&amp;hnear=2-%D1%8F+%D0%A5%D1%83%D1%82%D0%BE%D1%80%D1%81%D0%BA%D0%B0%D1%8F+%D1%83%D0%BB.,+38,+%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0,+127287&amp;ll=55.805478,37.569551&amp;spn=0.023154,0.054932&amp;z=14&amp;iwloc=A" style="color:#0000FF;text-align:left">Просмотреть увеличенную карту</a></small>
    <h2>Задать вопрос</h2>

    <?$APPLICATION->IncludeComponent(
        "bitrix:main.feedback",
        "eshop",
        Array(
            "USE_CAPTCHA" => "Y",
            "OK_TEXT" => "Спасибо, ваше сообщение принято.",
            "EMAIL_TO" => "sale@nyuta.bx",
            "REQUIRED_FIELDS" => array(),
            "EVENT_MESSAGE_ID" => array()
        ),
    false
    );?>
    </div>
</div>
<?*/?>
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
            <h1>Контакты</h1>
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
		"USER_MESSAGE_ADD" => "Ваше сообщение успешно отправлено. Мы ответим в рабочее время на Ваш e-mail",
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
                <h1 itemprop="name">Издательство «Альпина Паблишер»</h1>
				<meta itemprop="url" content="http://<?=$_SERVER['SERVER_NAME']?>"/>
				<meta itemprop="logo" content="http://<?=$_SERVER['SERVER_NAME']?>/img/logo.png"/>
				<time itemprop="openingHours" datetime="Mo-Fr 08:00-18:00">
                <p class="organisName">ООО «Альпина Паблишер»</p>
				<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
					<p><span itemprop="postalCode">123007</span>, <meta itemprop="addressCountry" content="RU" />Россия, <span itemprop="addressLocality">Москва</span>, м.Полежаевская</p>    
					<p itemprop="streetAddress">4-я Магистральная улица, дом 5,</p>
				</div>					
				<p>подъезд 2, этаж 2</p>
				<p class="organisTelep" itemprop="telephone">+7 (495) 980-80-77</p>
				<p class="organisMail" itemprop="email"><a href="mailto:shop@alpina.ru">shop@alpina.ru</a></p>
				<p class="timeTitle">Время работы</p>
				<p>С понедельника по пятницу с 8:00 до 18:00</p>
				<p class="wayTitle">Как к нам пройти</p>
				<p> Метро «Полежаевская», первый вагон из центра (в связи с реконструкцией станции выход из последнего вагона закрыт), из вестибюля налево. После выхода на улицу огибаете метро справа и двигаетесь вдоль Хорошевского шоссе. Далее проходите мимо ресторана «Макдоналдс», банков «Альфа-Банк» и «Промсвязь Банк», поворачиваете направо и выходите на 4-ю Магистральную улицу. Переходите на противоположную сторону и идете до пересечения 4-й Магистральной улицы с Магистральным переулком. Угловой дом - №5. Вам нужен второй подъезд, второй этаж.</p>
            </div>
            
        </div>
    </div>


    <div class="mapContainerContact">
        <div class="mapConteiner">
            <div id="map" class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m22!1m8!1m3!1d3173.495796915099!2d37.52266053802791!3d55.775864931355336!3m2!1i1024!2i768!4f13.1!4m11!3e6!4m3!3m2!1d55.777232399999995!2d37.5173061!4m5!1s0x0%3A0x4ec3046ee871bc47!2z0JDQu9GM0L_QuNC90LAg0L_QsNCx0LvQuNGI0LXRgA!3m2!1d55.774356!2d37.520168!5e0!3m2!1sru!2sru!4v1447669146287" width="100%" height="522" frameborder="0" style="border: 0px;" allowfullscreen></iframe>
            </div>
        </div>
    </div>
<script>
$(document).ready(function(){
    $("body").addClass("deliveryBody");
    
});
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>