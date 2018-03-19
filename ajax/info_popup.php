<?
if ($_REQUEST["info"]) {
	
	$info = '';
	
	switch ($_REQUEST["info"]) {
		case 'courier':
			$info = "<h6>Доставка курьером (в пределах МКАД)</h6><hr /><h6>Сроки доставки</h6><ul><li>при оплате наличными&nbsp;&mdash;1-2 рабочих дня;</li><li>при безналичном способе оплаты&nbsp;&mdash;1-2 рабочих дня после поступления средств на&nbsp;наш расчетный счет.</li></ul><h6>Стоимость доставки</h6><ul><li>сумма заказа от&nbsp;0&nbsp;до&nbsp;2&nbsp;000&nbsp;руб. &mdash;&nbsp;149&nbsp;руб;</li><li>сумма заказа от&nbsp;2&nbsp;000&nbsp;руб. &mdash;&nbsp;БЕСПЛАТНО.</li></ul><h6>Время доставки</h6><ul><li>рабочие дни с&nbsp;11:00 до&nbsp;19:00.</li></ul><h6>Дополнительная информация</h6>В&nbsp;день доставки представитель курьерской службы в&nbsp;период с&nbsp;9:00 до&nbsp;11:00 свяжется с&nbsp;вами по&nbsp;телефону для согласования времени доставки. Пожалуйста,будьте на&nbsp;связи в&nbsp;день доставки. Курьер выезжает по&nbsp;заказу только после согласования деталей по&nbsp;телефону.";
			break;
		case 'boxberry':
			$info = '<h6>Пункты выдачи</h6><hr /><h6>Сроки доставки</h6><ul><li>от&nbsp;2&nbsp;дней.</li></ul><h6>Стоимость доставки</h6><ul><li>сумма заказа от&nbsp;0&nbsp;до&nbsp;2&nbsp;000&nbsp;руб. &mdash;&nbsp;рассчитывается автоматически при оформлении заказа;</li><li>сумма заказа от&nbsp;2&nbsp;000&nbsp;руб. &mdash;&nbsp;БЕСПЛАТНО.</li></ul><h6>Дополнительная информация</h6><ul><li>необходимо внести 100% предоплату;</li><li><a href="http://boxberry.ru/tracking/" target="_blank">отслеживание заказов</a> на&nbsp;сайте Boxberry может начинаться с&nbsp;задержкой в&nbsp;несколько дней. Это связано с&nbsp;особенностями информобмена и&nbsp;комплектации заказов в&nbsp;интернет-магазине.</li></ul><h6>Карта пунктов выдачи</h6>
			<iframe src="https://points.boxberry.de/map?reloadmap=true&amp;chgCity=true&amp;calc=0&amp;select_office=0&amp;kd=0&amp;paysum=0&amp;api_token=53RMhNdCWk0LA4gA9ioU8w%3D%3D&amp;custom_city=%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0&amp;target_start=68&amp;host=www.alpinabook.ru" style="border: 0px; height: 580px; width: 100%;"></iframe>';
			break;
		case 'pickup':
			$info = '<h6>Самовывоз</h6><hr />Товар будет собран в течение двух часов с момента поступления заказа. <br /><br />Книги можно забрать в офисе интернет-магазина в рабочие дни <b>с 8.00 до 18.00</b>. <br />При заказе до 17 часов товар можно получить в тот же день!<br /><br /><b>Адрес</b>:м.Полежаевская,ул.4-ая Магистральная,д. 5,2 подъезд,2 этаж. <br /><br /><img src="/img/ymap.png" />';
			break;
		case 'box':
			$info = '<h6>Доставка почтой России</h6><hr /><h6>Сроки доставки</h6><ul><li>от 7 до 28 дней с момента оплаты заказа.</li></ul><h6>Стоимость доставки</h6><ul><li>сумма заказа от&nbsp;0&nbsp;до&nbsp;2&nbsp;000&nbsp;руб. &mdash;&nbsp;149&nbsp;руб;</li><li>сумма заказа от&nbsp;2&nbsp;000&nbsp;руб. &mdash;&nbsp;БЕСПЛАТНО.</li></ul><h6>Дополнительная информация</h6><ul><li>необходимо внести 100% предоплату;</li><li>после поступления оплаты заказ будет передан в распределительный центр Почты России в течение двух рабочих дней. Затем в течение трех рабочих дней отправлению будет присвоен идентификатор, который будет отправлен на указанный вами адрес электронной почты.</li></ul>';
			break;
		case 'freedelivery':
			$info = '<center><h6 style="color:#00abb8;font-weight:700">Бесплатная доставка ко дню святого Валентина</h6></center><br />
			Сделать приятный подарок ещё проще и приятнее! Как получить доставку бесплатно? Легко:
			<ol><li>Положите в корзину книги на любую сумму;</li><li>Выберите доставку курьером по Москве, пункт выдачи Boxberry или Pickpoint или почту России;</li>
			<li>Оформите заказ до 14 февраля 23:59 по московскому времени.</li></ol>
			Приятных покупок!
			';
			break;
	}
	
	$return = '<style>ul{list-style-type:disc;padding:30px 0 30px 30px}.stopProp img {max-width:650px;height:auto;display:block;margin:0 auto;padding:20px 0;}.awayLink:hover {background-color: #cab796!important;color: #fff!important;} .addLink:hover {background-color: #c7a271!important;color: #fff!important;} .closeIcon:after {position: absolute;background: url("/img/close.png") left center;width: 21px;height: 21px;right: 40px;top: 30px;margin-left: -15px;margin-top: -8px;cursor: pointer;display: block;content: "";} .closeIcon:hover:after {background: url("/img/close.png") right center;}</style>';
	$return .= '<script>$(document).ready(function() { $(".stopProp").click(function(e) { e.stopPropagation(); }); });</script>';
	$return .= '<div style="position: fixed; width: 100%; height: 100%; top: 0; left: 0; z-index: 999999999998; background: rgba(206,206,206,.62);overflow-y:auto;" onclick="closeInfo();" class="hideInfo">';
	$return .= '<div style="max-width: 800px; width:100%;margin-left: -410px; margin-top: 7%;margin-bottom:7%;box-shadow: 0 0 1px 0px rgba(0,0,0,.7); top: 0; left: 50%; position: absolute; background: #fff; padding: 30px 40px; z-index: 999999999999;display: block;font-family: \'Walshein_regular\';color:#2F3839" class="stopProp infoPopup">';
	$return .= '<div class="closeIcon" style="cursor:pointer;" onclick="closeInfo();"></div>';
	$return .= '<div>';


	$return .= $info;
	
	$return .= '</div><br />';
	
	$return .= '</div></div></div>';
	echo $return;
}
?>