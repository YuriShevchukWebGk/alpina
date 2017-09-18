<?                                                                                         
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    $APPLICATION->SetTitle("Авторизуйтесь для доступа к странице оплаты");
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    global $USER;
	
    if (!$USER->GetID()) {?>
		<style>
			.orderHistorWrap{width:auto;padding-bottom:0}
		</style>
		<div class="signinWrapper">
			<div class="centredWrapper">
				<div class="signinBlock" style="display:block;">
					<? $APPLICATION->IncludeComponent("bitrix:system.auth.authorize", "flat", Array(
							"REGISTER_URL" => "/auth/",
							"PROFILE_URL"  => "/personal/profile/",
							"SHOW_ERRORS"  => "Y"
							),
							false
						); ?>
				</div>
			</div>
		</div>
	<?} else {?>
	<style type="text/css">
		*{
			font-family: Tahoma;
		}

		.rfi_result_table{
			font-size: 14px;
			border:1px solid #f57720;
			margin:0 auto;
		}

		.rfi_result_table td{
			vertical-align: top;
			padding:10px 0px;
			text-align:center;
		}
		.receiver_block {
			border: 1px solid black; 
			border-collapse: collapse;
		}
		.receiver_block td {
			border: 1px solid black;
		}
		.receiver_block tr:nth-child(3) td:nth-child(5), 
		.receiver_block tr:nth-child(3) td:nth-child(6), 
		.receiver_block tr:nth-child(4) td {
			vertical-align: top;
		}
		.receiver_block tr:first-child td:first-child {
			width: 50%;
		}
		.receiver_block tr:first-child td:first-child, .receiver_block tr:last-child td {
			height: 30px; 
			border-bottom: 1px solid grey;
		}
		.receiver_block tr:first-child td:first-child span, .receiver_block tr:last-child td span {
			font-size: 10px;
		}
		.order_doc_title {
			font-size: 18px; 
			font-weight: bold; 
			border-bottom: 3px solid black; 
			padding-bottom: 10px;
		}
		.order_company_info, .basket_summary {
			width: 100%;
		}
		.order_company_info tr td:first-child {
			width: 30%;
		}
		.order_company_info tr td:last-child {
			font-weight: bold;
		}
		.basket_list {
			border: 3px solid black;
			border-collapse: collapse;
			width: 100%;
		}
		.basket_list tr td {
			font-size: 11px;
			border: 1px solid black;
		}
		.basket_list tr th {
			border: 1px solid black;
		}
		.basket_list tr td:first-child {
			width: 5%;
			text-align: center;
		}
		.basket_list tr td:nth-child(2) {
			width: 50%;
		}
		.basket_list tr td:nth-child(4) {
			width: 5%;
		}
		.basket_list tr td:nth-child(4) {
			text-align: left;
		}
		.basket_summary {
			font-weight: bold;
		}
		.basket_list tr td:nth-child(3),
		.basket_list tr td:nth-child(5),
		.basket_list tr td:nth-child(6),
		.basket_list tr td:nth-child(7),
		.basket_list tr td:nth-child(8),
		.basket_summary tr td {
			text-align: right;
		}
		.basket_summary tr:first-child td:first-child {
			width: 50%;
			text-align: left;
		}
		.additional_info {
			font-size: 11px;
		}
		.price_string {
			font-weight: bold;
		}
		.quotes_block table {
			width: 100%;
		}
		.quotes_block table tr td:not(:first-child) {
			text-align: center;
		}
		.quotes_block table tr td:first-child,
		.quotes_block table tr td:nth-child(2),
		.quotes_block table tr td:last-child {
			font-weight: bold;
		}
		.quotes_block table tr td:nth-child(3),
		.quotes_block table tr td:last-child {
			width: 25%;
		}
		.quotes_block table tr td:first-child {
			vertical-align: middle;
		}
		.quotes_block table tr td:not(:first-child) div {
			border-top: 1px solid black;
			font-size: 11px;
			width: 100%;
			font-weight: normal;    
		}
		.expense_offer_block {
			width: 800px;
			font-size: 13px !important;
		}
		table td, .basket_list th {
			font-size: 13px;
		}
	</style>

	<?$arOrder = CSaleOrder::GetByID($_GET['ORDER_ID']);?>       
	<? if ($arOrder['PAYED'] == "Y") { echo "Ваш заказ уже оплачен";}elseif ($arOrder['STATUS_ID'] == PREORDER_STATUS_ID) {
		echo "Вы сможете воспользоваться ссылкой на оплату после того, как книга появится появится в продаже.";
	} else { ?>
		<?  /*
			// новый виджет РФИ 
			if ($arOrder['PAY_SYSTEM_ID'] == RFI_PAYSYSTEM_ID ) {
			$APPLICATION->ShowHead();
			?>
			<? $APPLICATION->IncludeComponent(
			"webgk:rfi.widget",
			"",
			Array(
			"ORDER_ID" => $_REQUEST["ORDER_ID"]
			),
			false
			); ?>
			<?
			die();
		}*/ ?>	

		<?if($arOrder['PAY_SYSTEM_ID']== RFI_PAYSYSTEM_ID){?>
			<?= $APPLICATION->ShowHead();?>
			<br>
			<br>
			<div style="width:100%;text-align: center">
				Заказ №<?=$arOrder['ID']?>
				от <?=$arOrder['DATE_STATUS']?><br>
				Сумма к оплате по счету: <?=$arOrder['PRICE']?>
				руб.
				<? $APPLICATION->IncludeComponent(
						"webgk:rfi.widget",
						"",
						Array(
							"ORDER_ID" => $_REQUEST["ORDER_ID"]
						),
						false
					); ?>
				<?die(); }?>
		</div>
		<br>

		<?if ($arOrder["PAY_SYSTEM_ID"] == CASHLESS_PAYSYSTEM_ID && $arOrder["PERSON_TYPE_ID"] == LEGAL_ENTITY_PERSON_TYPE_ID) {?>
			<?
				$order_props = CSaleOrderPropsValue::GetOrderProps($arOrder["ID"]);
				while ($props = $order_props -> Fetch()) {
					if ($props["CODE"] == "F_COMPANY_NAME") {
						$company_name = $props["VALUE"];
					}
					if ($props["CODE"] == "F_INN") {
						$company_inn = $props["VALUE"];
					}
					if ($props["CODE"] == "F_KPP") {
						$company_kpp = $props["VALUE"];
					}
					if ($props["CODE"] == "F_ADDRESS_FULL") {
						$address = $props["VALUE"];
				   }
			}?>
			<div class="expense_offer_block">

				<table class="receiver_block">
					<tr>
						<td rowspan="2" colspan="4"><div>ВТБ 24 (ПАО) Г. МОСКВА</div><span>Банк получателя</span></td>
						<td>БИК</td>
						<td><?= BIK_FOR_EXPENSE_OFFER ?></td>
					</tr>
					<tr>
						<td>Сч. №</td>
						<td>30101810100000000716</td>
					</tr>
					<tr>
						<td>ИНН</td>
						<td>7705396957</td>
						<td>КПП</td>
						<td>770501001</td>
						<td rowspan="2">Сч. №</td>
						<td rowspan="2">40702810500000097458</td>
					</tr>
					<tr>
						<td colspan="4">
							<div>Общество с ограниченной ответственностью "Альпина Паблишер"</div>
							<span>Получатель</span>
						</td>
					</tr>
				</table>
				<br>
				<div class="order_doc_title">Счет-оферта на оплату № <?= $arOrder["ID"] ?> от <?= FormatDate("j F", MakeTimeStamp(date("d.m.Y", strtotime($arOrder["DATE_INSERT"])), "DD.MM.YYYY HH:MI:SS")) . " " . date("Y", strtotime($arOrder["DATE_INSERT"])) ?> год</div>
				<br>
				<table class="order_company_info">
					<tr>
						<td>Поставщик:</td>
						<td>Общество с ограниченной ответственностью "Альпина Паблишер", ИНН 7705396957, КПП 770501001, 115035, Москва, улица Садовническая, дом 54, строение 1, кабинет 17, тел.: (495) 980-53-54</td>
					</tr>
				</table>
				<br>
				<table class="order_company_info">
					<tr>
						<td>Грузоотправитель:</td>
						<td>Общество с ограниченной ответственностью "Альпина Паблишер", ИНН 7705396957, КПП 770501001, 115035, Москва, улица Садовническая, дом 54, строение 1, кабинет 17, тел.: (495) 980-53-54</td>
					</tr>
				</table>
				<br> 
				<table class="order_company_info">
					<tr>
						<td>Покупатель:</td>
						<td><?= $company_name ?>, ИНН <?= $company_inn ?>, КПП <?= $company_kpp ?>, <?= $address ?></td>
					</tr>
				</table>
				<br> 
				<table class="order_company_info">
					<tr>
						<td>Грузополучатель:</td>
						<td><?= $company_name ?>, ИНН <?= $company_inn ?>, КПП <?= $company_kpp ?>, <?= $address ?></td>
					</tr>
				</table>
				<br>
				<table class="basket_list">
					<tr>
						<th>№</th>
						<th>Товары (работы, услуги)</th>
						<th>Кол-во</th>
						<th>Ед.</th>
						<th>Цена</th>
						<th>Ставка НДС</th>
						<th>Сумма НДС</th>
						<th>Сумма</th>
					</tr>
					<? $count = 1;
						$vat_rate_10_summ = 0;
						$vat_rate_18_summ = 0;
						$basket_list = CSaleBasket::GetList (array(), array("ORDER_ID" => $arOrder["ID"]), false, false, array());
						while ($basket = $basket_list -> Fetch()) {
							if ($basket["VAT_RATE"] * 10 <= 1) {
								$multiplier = 10 / 110;
								$vat_rate_10_summ += round($basket["PRICE"] * $basket["QUANTITY"] * $multiplier, 2);
						   }else {
								$multiplier = 18 / 118;
								$vat_rate_18_summ += round($basket["PRICE"] * $basket["QUANTITY"] * $multiplier, 2);
						}?>
						<tr>
							<td><?= $count ?></td>
							<td><?= $basket["NAME"] ?></td>
							<td><?= $basket["QUANTITY"] ?></td>
							<td>шт.</td>
							<td><?= round($basket["PRICE"], 2) ?></td>
							<td><?= round($basket["VAT_RATE"] * 100) . "%" ?></td>
							<td><?= round($basket["PRICE"] * $basket["QUANTITY"] * $multiplier, 2) ?></td>
							<td><?= round($basket["PRICE"] * $basket["QUANTITY"], 2) ?></td>
						</tr>
						<? $count++;
						}
					?>
				</table>
				<br>
				<table class="basket_summary">
					<tr>
						<td>Обратите внимание на процентную ставку НДС!</td>
						<td>Итого:</td>
						<td><?= CurrencyFormat(round($arOrder["PRICE"] - $arOrder["PRICE_DELIVERY"], 2), $arOrder["CURRENCY"], true); ?></td>
					</tr>
					<? if ($vat_rate_10_summ > 0) {?>
						<tr>
							<td></td>
							<td>В том числе НДС 10%:</td>
							<td><?= CurrencyFormat(round($vat_rate_10_summ, 2), $arOrder["CURRENCY"], true); ?></td>
						</tr>
						<?}?>
					<? if ($vat_rate_18_summ > 0) {?>
						<tr>
							<td></td>
							<td>В том числе НДС 18%:</td>
							<td><?= CurrencyFormat(round($vat_rate_18_summ, 2), $arOrder["CURRENCY"], true); ?></td>
						</tr>
						<?}?>
					<tr>
						<td></td>
						<td>Доставка:</td>
						<td><?= CurrencyFormat(round($arOrder["PRICE_DELIVERY"], 2), $arOrder["CURRENCY"], true); ?></td>
					</tr>
					<tr>
						<td></td>
						<td>В том числе НДС 18%:</td>
						<td><?= CurrencyFormat(round($arOrder["PRICE_DELIVERY"] * (18 / 118), 2), $arOrder["CURRENCY"], true); ?></td>
					</tr>
					<tr>
						<td></td>
						<td>Всего к оплате:</td>
						<td><?=  CurrencyFormat($arOrder['PRICE'], $arOrder["CURRENCY"], true); ?></td>
					</tr>
				</table>
				<div class="additional_info">
					1. Заказчик оплачивает поставляемую продукцию (товары) на условиях 100% предоплаты.<br>
					2. Срок поставки – 3-4 рабочих дней со дня оплаты счета, при условии наличия товара на складе Поставщика.<br>
					3. Стороны освобождаются от ответственности за частичное или полное неисполнение обязательств по данному счет-договору, если это неисполнение явилось следствием обстоятельств непреодолимой силы, возникших после заключения договора в результате событий чрезвычайного характера, наступление которых сторона,    не исполнившая обязательство полностью или частично, не могла ни предвидеть, ни предотвратить разумными методами (форс-мажор).<br>
					4. При наступлении указанных в п.3 обстоятельств сторона по настоящему договору, для которой создалась невозможность исполнения ее обязательств по настоящему договору,должна в кратчайший срок известить о них в письменном виде другую сторону с приложением соответствующих свидетельств.<br>
				</div><br>
				<span>Всего наименований <?= $count ?>, на сумму <?= CurrencyFormat($arOrder["PRICE"], $arOrder["CURRENCY"], true) ?></span><br>
				<span class="price_string"><?= num2str(round($arOrder["PRICE"], 2)) ?></span>
				<div class="quotes_block">
					<table>
						<tr>
							<td>Руководитель</td>
							<td>Генеральный директор<br><div>должность</div></td>
							<td><br><div>подпись</div></td>
							<td>Ильин А. М.<br><div>расшифровка подписи</div></td>
						</tr>
						<tr>
							<td>Бухгалтер</td>
							<td></td>
							<td><br><div>подпись</div></td>
							<td>Пархоменко Анна<br><div>расшифровка подписи</div></td>
						</tr>
					</table>
				</div>
			</div> 
			<?} else {?>
			<div style="text-align: center">
				<?$APPLICATION->IncludeComponent(
						"user:sale.order.payment",
						"",
						Array(
						)
					);?>
			</div>
			<?}?>

		<?}?>
    <?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");	
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>