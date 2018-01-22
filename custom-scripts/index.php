<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {?>
	<a target="_blank" href="/custom-scripts/misc/book_subs.php">Подписка на выход книг и предзаказы</a><br /><br />
	<a target="_blank" href="/custom-scripts/catalog/bestsellers.php">Посмотреть бестселлеры за определенные даты</a><br /><br />
	<a target="_blank" href="/custom-scripts/misc/pickups.php">Список самовывозов на сбор</a><br /><br />
	<a target="_blank" href="/custom-scripts/alpinadigital/singleorder.php">Отправить бесплатные электронные книги</a><br /><br />
	<a target="_blank" href="/custom-scripts/misc/addtocartmultiple.php">Добавить в корзину сразу несколько позиций</a><br /><br />
	<a target="_blank" href="/custom-scripts/misc/change_status.php">Поменять статус заказа на "Отправлен на почту РФ"</a><br /><br />
	<a target="_blank" href="/custom-scripts/misc/compose_pricelist.php">Получить свежий прайс-лист</a><br /><br />
	<a target="_blank" href="/custom-scripts/misc/count_delivery.php">Количество заказов на доставку по Москве</a><br /><br />
	<a target="_blank" href="/custom-scripts/misc/ruspost.php">Таблица для отправки в РусПост</a><br /><br />
	<a target="_blank" href="/custom-scripts/checkdelivery/waiting_delivery.php">Изменить дату доставки заказа и отправить письмо клиенту</a><br /><br />
	<a target="_blank" href="/custom-scripts/checkdelivery/couroutes.php">Маршрутные листы для курьеров</a><br /><br />
	<a target="_blank" href="/custom-scripts/checkdelivery/dimax.php">Таблица для Dimax</a><br /><br />
	<a target="_blank" href="/custom-scripts/orders/check_book_status.php">Статус книг в заказе</a><br /><br />
	
<?} else {
	echo 'error';
}?>