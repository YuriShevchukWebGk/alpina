<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$header = "From: \"fast-zakaz@alpinabook.ru\" <fast-zakaz@alpinabook.ru\n";
$strEmail = "a.marchenkov@alpinabook.ru";
$mas = "Имя:".$_POST["name"]."\n"."Телефон:".$_POST["phone"]."\n"."e-mail:".$_POST["email"]."\n"."Комментарий:".$_POST["text"]."\n"."Способ оплаты:".$_POST["oplata"]."\n"."Название тренинга:".$_POST["tren"]."\n"."Дата тренинга:".$_POST["date"];
if ($_POST["name"]) {
mail($strEmail, "Новый заказ на тренинг", $mas,$header);
}
if(CModule::IncludeModule("iblock"))
{   
$arFilter = Array("IBLOCK_ID"=>48, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_RUBRIC" => $arSection["ID"]);
    $res = CIBlockElement::GetList(Array(), $arFilter, Array());
  //  echo $res; 
   
 $num = 'GR_'.$res;
 $name_zak = 'Заказ #'. $num;
     
$el = new CIBlockElement;
$PROP = array();
$PROP["phone"] = 'asdfasdfasd';        // свойству с кодом 3 присваиваем значение 38
$PROP["email"] = 'am@alpinabook.ru';
$PROP["tren"] = 'СУПЕР ШКОЛА';
$arLoadProductArray = Array(
   'MODIFIED_BY' => $USER->GetID(), // элемент изменен текущим пользователем  
   'IBLOCK_SECTION_ID' => false, // элемент лежит в корне раздела  
   'IBLOCK_ID' => 48,
   'PROPERTY_VALUES' => $PROP,  
   'NAME' => $name_zak,  
   'ACTIVE' => 'Y');

if($PRODUCT_ID = $el->Add($arLoadProductArray)) {
   //echo '<h2 align="center">Спасибо. Ваш отзыв принят.</h2>';
} else {
	//echo '<h2 align="center">При отправке отзыва возникли проблемы. Попробуйте позже.</h2>';
}
}
$dir = $APPLICATION->GetCurDir();
$dir = explode("/", $dir);
$arFilter = Array("IBLOCK_ID"=>16,"PROPERTY_razd"=>$ar_result1["ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$resi = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
if($obi = $resi->GetNextElement()) {
	$arFieldsi = $obi->GetFields();
	$arPropi = $obi->GetProperties();
}
if ($arPropi["param"]["VALUE"]!=""){
	$param = $arPropi["param"]["VALUE"];		
}else{
	$param =0;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Выбор способа оплаты</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="index, follow" />
<meta name="keywords" content="Издательство деловой литературы, Альпина Паблишер, книжный интернет магазин, интернет магазин книг, купить книги, деловая литература, бизнес литература, доставка книг, новинки, бестселлеры, накопительные скидки, alpinabook.ru, Альпина Паблишерз, Альпина Паблишерс" />
<meta name="description" content="«Альпина Паблишер» выпускает бизнес-книги более десяти лет. За книгами издательства Альпины прочно закрепилась репутация максимально полезных и интересных. Альпина гордится своими авторами, идеи которых определяют современный мир. В интернет-магазине Альпины можно купить книги по самой выгодной цене с доставкой. доставка по Москве и почтой по России." />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>         
<script type="text/javascript" src="https://partner.rficb.ru/gui/rfi_widget/js/v1.js"></script>     
</head>

<body itemscope itemtype="http://schema.org/WebPage">
<style>
body {max-width:660px;width:100%;background:#fff;border:5px solid #eee;padding:10px;margin:0 auto;}
input[type="radio"], #addresshide, #paycashinfowrap, #paycashtips {
    display:none;            
}

input[type="radio"] + label {
  font: 15px bold;
  color: #444;
  cursor: pointer;
  font-family: 'Open Sans',sans-serif !important;
}

input[type="radio"] + label::before {
    content: "";
    display: inline-block;
    height: 20px;
    width: 22px;
    margin: 13px 5px 0 0;
    background-image: url(img/radio.jpg);
    background-repeat: no-repeat;
}
input[type="radio"] + label::before {
    background-position: 0px 100%;
}
input[type="radio"]:checked + label::before {
    background-position: 0px 0px;
}
h3 {
	font-size:15px!important;
	margin-bottom:15px;
}
h1 {
	font-size:20px!important;
}
td {
	font-size:15px;
	color: #444;
	padding:5px 0;
	width: 259px;
}

#payonlinetips, #paycashtips, #prepaysize {
	width:250px;
	float:left;
	clear:both;
}
#paycashtips {
	margin-top:30px;
}

#paycashinfowrap {
	margin-top:60px;
}
#paycashtips {
	height:187px;
}
#payonlineinfowrap, #paycashinfowrap {
	float: right;
	height: 100px;
	border-left: 1px solid #000000;
	width: 310px;
}
#paycashinfowrap {
	height:157px!important;
}
#payonlineinfo, #paycashinfo {
	border: 1px solid black;
	font-size: 14px;
	margin: 10px;
	padding: 10px;
	height:150px;
	background: #FFFFFF;
}
.propname {
	width:250px;
	font-size:15px;
	float:left;
	clear:both;
	height:30px;
}
.propinfo {
	width: 310px;
	font-size:15px;
	float:right;
	height:30px;
	border-left: 1px solid black;
}
.info {
	padding:0 10px;
	font-size:15px;
}
#paysumm {
	padding:10px;
	height:10px;
	margin-top: 7px;
}
.prepayblock {
	width:155px;
	float:right;
	border-left: 1px solid #000000;
}
#predoplata_win {
	display:none;
	position:static;
	margin:auto;
	border:3px solid #fefefe;
	width:550px;
}
</style>


<script>
var $j = jQuery.noConflict();
$j(document).ready(function() {
	var $ja = $j('input');
	$ja.click(function(){
		$jinput = $j(this);
		idinput = $jinput.attr('id');
		switch(idinput){
			case 'bk':{
				$j('#payonlineinfowrap').show();
				$j('#addresshide, #paycashinfowrap, #paycashtips').hide();
				$j('#payonlineinfo').html('Оплата банковской картой через систему электронных платежей Assist после подтверждения заказа');
				$j('#paymenttype').attr('value','online');
				break;
			}case 'nal':{
				$j('#paycashinfowrap, #paycashtips').show();
				$j('#payonlineinfo').html('Оплата наличными в офисе или курьеру');
				$j('#paymenttype').attr('value','cash');
				break;
			}case 'im':{
				$j('#payonlineinfowrap').show();
				$j('#addresshide, #paycashinfowrap, #paycashtips').hide();
				$j('#payonlineinfo').html('Оплата Яндекс.Деньгами или Webmoney через систему электронных платежей Assist после подтверждения заказа');
				$j('#paymenttype').attr('value','online');
				break;
			}case 'qiwi':{
				$j('#payonlineinfowrap').show();
				$j('#addresshide, #paycashinfowrap, #paycashtips').hide();
				$j('#payonlineinfo').html('Оплата с Вашего кошелька QIWI через систему электронных платежей Assist после подтверждения заказа');
				$j('#paymenttype').attr('value','online');
				break;
			}case 'nals':{
				$j('#addresshide').hide();
				$j('#paycashinfo').html('Вы можете забрать абонемент на тренинг в офисе Альпины Паблишер. Адрес: Москва, 4-я Магистральная улица, д.5, 2 подъезд, 2 этаж.<br />Время работы: пн-пт 8:00-19:00<br />+7 (495) 21-21-421');
				$j('#paymenttype').attr('value','cash');
				break;
			}case 'nalk':{
				$j('#addresshide').show();
				$j('#paycashinfo').html('Курьер доставит абонемент на участие в тренинге по указанному вами адресу:<br />Время доставки: 2-3 рабочих дня<br />Стоимость доставки:<br />- При оплате базового курса – 200 руб.<br />- При оплате Интенсива – Бесплатно');
				$j('#paymenttype').attr('value','cash');
				break;			
			}case 'full':{
				$j('#paysum').attr('value','3000');
				$j('#shownal').show();
				break;
			}case 'part':{
				$j('#paysum').attr('value','3000');
				$j('#shownal, #paycashtips, #paycashinfowrap, #addresshide').hide();
				break;
			}
		}
	});
	$j("#about_oplata").toggle(
		function() {
		$j("#predoplata_win").fadeIn();
		return false;
		},
		function() {
		$j("#predoplata_win").fadeOut();
		return false;
		
	});
});
</script>

<h1 style="font-size:15px;">Оплата</h1>
<a href="#" id="about_oplata">Подробнее об условиях оплаты</a>.<br /><br />
<div style="padding:10px; font-size:12px;background:#fff;" id="predoplata_win">

<b>Гарантия безопасности платежа</b><br />
При оплате заказа банковской картой (включая ввод номера карты), обработка платежа происходит на сайте системы электронных платежей ASSIST, которая прошла международную сертификацию. Это значит, что Ваши конфиденциальные данные (реквизиты карты, регистрационные данные и др.) не поступают в интернет-магазин, их обработка полностью защищена и никто, в том числе ООО «Интеллектуальная литература» (сайт www.brainfit.pro), не может получить персональные и банковские данные клиента.

	<br /><br />
	<img src="/images/assisty.png" align="center" />
	<br /><br />
	Для защиты информации от несанкционированного доступа на этапе передачи от клиента на сервер системы ASSIST используется протокол SSL 3.0, сертификат сервера (128 bit) выдан компанией Thawte - признанным центром выдачи цифровых сертификатов. Вы можете <a href="http://www.assist.ru/about/security.htm">проверить подлинность сертификата</a> сервера.»
	<br /><br />
	При оплате  заказа банковской картой возврат денежных средств производится на ту карту, с которой был произведен платеж.
	<br /><br />
	<img src="/images/logos.png" align="center" /><img src="/images/MasterCard.png" align="center" /><img src="/images/VISA.png" align="center" />
</div>
	<form action="confirm.php" name="confirm_payment" method="post">

	<h3 style="font-size:13px;color: #EE7203;">Способ оплаты</h3>
	<div id="payonlinetips">
		<input type="radio" name="paytype" value="bk" id="bk" checked /> 
		<label for="bk">Банковская карта</label><br />
		
		<input type="radio" name="paytype" value="im" id="im" />
		<label for="im">Электронные деньги</label><br />
		
		<input type="radio" name="paytype" value="qiwi" id="qiwi" />
		<label for="qiwi">Кошелек QIWI</label><br />
			
	</div>
	
	<div id="payonlineinfowrap">
		<div id="payonlineinfo">
			Оплата банковской картой через систему электронных платежей Assist после подтверждения заказа
		</div>
	</div>
	
	<div id="paycashtips">
		<h3 style="font-size:13px;color: #EE7203;">Способ доставки</h3>

		<input type="radio" name="naltype" value="nals" id="nals" checked />
		<label for="nals">Самовывоз (Москва)</label><br />
		
		<input type="radio" name="naltype" value="nalk" id="nalk" />
		<label for="nalk">Курьер (в пределах МКАД)</label><br />
	</div>
	
	<div id="paycashinfowrap">
		<div id="paycashinfo">
			Вы можете забрать абонемент на тренинг в офисе Альпины Паблишер. Адрес: Москва, 4-я Магистральная улица, д.5, 2 подъезд, 2 этаж.<br />Время работы: пн-пт 8:00-19:00<br />+7 (495) 21-21-421
		</div>
	</div>	
		<br style="clear:both"/><br /><br />
	<div id="clientinfo">
		<h3 style="font-size:13px;color: #EE7203;">Данные получателя</h3>

				<div class="propname">Имя: </div>
				<div class="propinfo"><div class="info"><input type="text" size="40" name="name" value="<?=htmlspecialcharsbx($_POST["name"])?>" /></div></div>

				<div class="propname">Адрес электронной почты: </div>
				<div class="propinfo"><div class="info"><input type="text" size="40" name="email" value="<?=htmlspecialcharsbx($_POST["email"])?>" /></div></div>

				<div class="propname">Контактный телефон: </div>
				<div class="propinfo"><div class="info"><input type="text" size="40" name="telephone" value="<?=htmlspecialcharsbx($_POST["phone"])?>" /></div></div>

		
		<input id="paymenttype" type="hidden" size="40" name="paymenttype" value="online" />
		
		<input type="hidden" name="paysum" value="3000" />
		<input type="hidden" name="ordernumber" value="<?=$num?>" />
		<input style="width:205px;height:36px;font-size:15px;text-align:center;background:#EE7203;background: -moz-linear-gradient(top, #EE7203, #F6921E) transparent;background: -webkit-linear-gradient(top, #EE7203, #F6921E) transparent;background: -o-linear-gradient(top, #EE7203, #F6921E) transparent;background: -ms-linear-gradient(top, #EE7203, #F6921E) transparent;background: linear-gradient(top, #EE7203, #F6921E) transparent;background-size: 105px 32xp;border:1px solid #908f8a;color:white;font-weight:600;padding:5px;margin-top:15px;margin:0 auto;cursor:pointer;margin-top:12px" type="submit" value="Перейти к оплате" />
	</div>
	</form>
	</body>
	</html>