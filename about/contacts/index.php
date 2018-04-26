<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "контакты, альпина, адрес, телефон, почта");
$APPLICATION->SetPageProperty("description", "Как проехать в интернет-магазин «Альпина Паблишер». Контакты и схема проезда");
$APPLICATION->SetTitle("Контакты интернет-магазина «Альпина Паблишер», схема проезда, обратная связь");
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
 <style>
	.contactsTextWrap{margin-top:50px}
	.contactsFormWrap{margin-right:70px}
	.wayTitle{font-family:Walshein_black}
	.contactsTextWrap .organisTelep{font-size:20px}
	.props *{color:#3f4a4d}
	.contactsTextWrap .organisMail{font-size:18px;font-family:Walshein_regular;text-transform:none}
</style>
<div class="deliveryPageTitleWrap">
	<div class="centerWrapper">
 <a href="/">
		<p>
			 Главная
		</p>
 </a>
		<h1>Контакты интернет-магазина и издательства</h1>
	</div>
</div>
<div class="contactsBodyWrap">
	<div class="centerWrapper">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	".default",
	Array(
		"AREA_FILE_RECURSIVE" => "Y",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"COMPONENT_TEMPLATE" => ".default",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/include/contact_form.php"
	)
);?>
		<div class="contactsTextWrap" itemprop="mainEntity" itemscope="" itemtype="http://schema.org/BookStore">
 <time itemprop="openingHours" datetime="Mo-Fr 08:00-18:00"></time> <a href="tel:+74951200704" class="organisTelep"><span itemprop="telephone">+7 (495) 120-07-04</span></a><br>
 <a href="tel:+78005505322" class="organisTelep">+7 (800) 550-53-22</a>
			<p>
			</p>
 <br>
			<p class="organisMail" itemprop="email">
 <a href="mailto:shop@alpina.ru">shop@alpina.ru</a>
			</p>
			<p class="wayTitle">
				 Адрес
			</p>
			<p>
				 Москва, м.Полежаевская, <span itemprop="streetAddress">4-я Магистральная улица, дом 5, строение 1</span>
			</p>
			<p class="wayTitle">
				 Как пройти в офис интернет-магазина и издательство
			</p>
			<p>
				 Метро «Полежаевская» (последний вагон из&nbsp;центра, выход 7&nbsp;— к&nbsp;Магистральным улицам) или «Хорошёвская», ориентир ТЦ&nbsp;«Хорошо». От&nbsp;ТЦ&nbsp;поворачиваете направо и&nbsp;двигаетесь по&nbsp;4-ой Магистральной улице. Доходите до&nbsp;«БЦ&nbsp;на&nbsp;Магистральной» (д.&nbsp;5&nbsp;стр.&nbsp;1). Вам нужен второй подъезд, второй этаж.
			</p>
			 <?/*<p class="wayTitle">
				Как попасть в редакцию (офис издательства)
			</p>
			<p>
				Адрес тот же, но третий подъезд и третий этаж. (вход временно закрыт)
			</p>*/?>
			<p class="wayTitle">
				 Время работы
			</p>
			<p>
				 С понедельника по пятницу с 8:00 до 18:00. Редакция открывается в 10:00. <br>
				<b>Дорогие читатели! Интернет-магазин не работает в праздники: четыре дня с 29 апреля по 2 мая и один день 9 мая.</b>
			</p>
			<p class="wayTitle">
				 Адрес для корреспонденции
			</p>
			<p>
				 123060, Россия, г. Москва, а/я 28, для ООО «Альпина Паблишер»
			</p>
 <br>
 <a href="#" onclick="$('.props').slideToggle('slow');return false;" style="font-size:18px;border-bottom:1px dashed">Показать реквизиты</a>
			<div style="display:none" class="props">
				<h2>Общество с ограниченной ответственностью «Альпина Паблишер»</h2>
				 ООО «Альпина Паблишер» <br>
 <br>
				 ИНН 7705396957<br>
				 КПП 770501001<br>
 <br>
				 Юридический адрес: 115035, Москва, улица Садовническая, дом 54, строение 1, кабинет 17<br>
				 Фактический адрес: 123007, г. Москва, ул. 4-ая Магистральная, д. 5, стр. 1<br>
				 Почтовый адрес: 123060, г. Москва, а/я 28<br>
 <br>
				 ОКПО 56542641<br>
				 ОКЭВД 22.11<br>
				 ОГРН (Основной государственный регистрационный номер)<br>
				 1027739552136<br>
 <br>
				 Р/с 40702810500000097458<br>
				 Филиал № 7701 Банка ВТБ (публичное акционерное общество) в г. Москве (Филиал № 7701 Банка ВТБ (ПАО))<br>
				 БИК 044525745<br>
				 К/с 30101810345250000745<br>
 <br>
				 Генеральный директор<br>
				 Ильин Алексей Маркович <br>
 <br>
				<h2>Общество с ограниченной ответственностью«Альпина Диджитал»</h2>
				 ООО«Альпина Диджитал»<br>
				 "Alpina Digital" LLC<br>
 <br>
				 ИНН: 7719841661<br>
				 КПП: 771901001<br>
				 ОГРН: 1137746300768<br>
				 ОКПО: 17419816<br>
 <br>
				 р/с: 40702810602570000933<br>
				 в АО«АЛЬФА-БАНК»<br>
				 БИК: 044525593<br>
				 к/с: 30101810200000000593<br>
 <br>
				 Юридический адрес: 107023, г. Москва, пер. Мажоров, д. 14, стр. 21<br>
				 Почтовый адрес: 123007, г. Москва, ул. 4-ая Магистральная, д. 5, стр. 1<br>
 <br>
				 Генеральный директор: Лиманский Александр Андреевич<br>
 <br>
				 tel/fax: +7-495-980-53-54<br>
				 e-mail: <a href="mailto:finance@alpinadigital.ru">finance@alpinadigital.ru</a> <a href="http://ebook.alpinabook.ru/" target="_blank">http://ebook.alpinabook.ru/</a>
			</div>
		</div>
	</div>
</div>
<div class="mapContainerContact">
	<div class="mapConteiner">
		<div id="map" class="map">
			 <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ab1f68e2a01f481ec5678ebbf535eacfc2956fe8c17f1ec835da431a9a7939f2c&amp;width=100%25&amp;height=522&amp;lang=ru_RU&amp;scroll=true"></script>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
    $("body").addClass("deliveryBody");
    
});
</script><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>