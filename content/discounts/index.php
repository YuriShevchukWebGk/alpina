<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Скидки");
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
		<h1>Скидки</h1>
	</div>
</div>
<div class="deliveryBodyWrap" style="padding: 50px 0;">
	<div class="centerWrapper">
		<div class="deliveryTypeWrap">
			<div>
	<div>Покупать книги в нашем интернет-магазине теперь еще приятнее. У нас работает, пожалуй, самая гуманная система накопительных скидок:</div>
<div>&nbsp;</div>
<div>Если вы потратите на нашем сайте всего 3000 рублей, то последующие заказы вы будете делать уже с постоянной скидкой 10%. Для этого не обязательно делать один заказ на 3000 рублей, можно накопить эту сумму за несколько покупок&nbsp;</div>
<div>&nbsp;</div>
<div><b>Когда сумма ваших заказов достигнет 10 000 рублей, скидка на последующие покупки поднимется до 20%</b></div>
<div>&nbsp;</div>
<div>Особенно приятно, что такие скидки для постоянных клиентов суммируются со многими скидками промо-кодов и распродаж</div>
<div>&nbsp;</div>
<div>Еще это <b>удобно</b>: сумма заказа автоматически пересчитывается с учетом вашей скидки и указывается при оформлении покупки. Всю историю заказов вы можете увидеть в персональном разделе, во вкладке &quot;Заказы&quot;</div>
<div>&nbsp;</div>
<div>Важный момент: накопительная скидка действует только в том случае, если вы заказываете книги на сайте под одним и тем же логином (e-mail) и не распространяется на стоимость доставки</div>
<br />
<div>Скидки не распространяются на подарочный сертификаты, а также книги: "Правила жизни том 1", "Правила жизни том 2", "Атлант расправил плечи (в коже)", "Добыча (в коже)", "МСФО: Точка зрения КМПГ"</div>
<div>&nbsp;</div>

</div>
<p> </p>

</div>

		</div>
	</div>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>