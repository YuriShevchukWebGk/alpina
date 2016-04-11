<?php $read_price = base64_encode($_GET['pr']); ?>
<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$header = "From: \"fast-zakaz@alpinabook.ru\" <fast-zakaz@alpinabook.ru\n";
$strEmail = "a.marchenkov@alpinabook.ru";
$mas = "Имя:".$_POST["name"]."\n"."Телефон:".$_POST["phone"]."\n"."e-mail:".$_POST["email"]."\n"."Комментарий:".$_POST["text"]."\n"."Способ оплаты:".$_POST["oplata"]."\n"."Название тренинга:".$_POST["tren"]."\n"."Дата тренинга:".$_POST["date"];
if ($_POST["name"]) {
mail($strEmail, "Новый заказ на тренинг", $mas,$header);
}
CModule::IncludeModule("iblock");

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
<link href="fonts/freesetbold.css" rel="stylesheet">
<link href="fonts/freeset.css" rel="stylesheet">
</head>
<style>
body {max-width:1024px;width:1024px;background:url('img/background.gif') no-repeat 50% 120px transparent;margin:0 auto;}
input[type="radio"], #addresshide, #paycashinfowrap, #paycashtips {
    display:none;            
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

<body itemscope itemtype="http://schema.org/WebPage">
<div id="header" style="width:1024px;height:120px;background: url('img/header.gif')"></div>
<div id="moneyCircle" style="width:76px; height:76px; background: url('img/money_circle.png'); position:absolute; left:49%;top:84px"></div>




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
				$j('#payonlineinfo').html('Оплата банковской картой через систему электронных платежей РФИ после подтверждения заказа');
				$j('#paymenttype').attr('value','online');
				$j('#bank_card_label').css('color', '#79157f');
				$j('#bank_money_label, #bank_qiwi_label','#bank_wm_label','#bank_mc_label').css('color', '#666');
				$j('.img_bank').html('<img src="img/bank_card.png" width="35" style="margin:0 10px;" align="left" />');
				$j('.img_money').html('<img src="img/money_gr.png" width="35" style="margin:0 10px;" align="left" />');
				$j('.img_qiwi').html('<img src="img/qiwi_gr.png" width="35" style="margin:0 10px;" align="left" />');
				$j('.img_wm').html('<img src="img/wm_gr.png" width="35" style="margin:0 10px;" align="left" />');
                $j('.img_mc').html('<img src="img/mobile_gr.png" width="19" style="margin:0 10px;" align="left" />');
				break;
			}case 'nal':{
				$j('#paycashinfowrap, #paycashtips').show();
				$j('#payonlineinfo').html('Оплата наличными в офисе или курьеру');
				$j('#paymenttype').attr('value','cash');
				break;
			}case 'im':{
				$j('#payonlineinfowrap').show();
				$j('#addresshide, #paycashinfowrap, #paycashtips').hide();
				$j('#payonlineinfo').html('Оплата Яндекс.Деньгами через систему электронных платежей РФИ после подтверждения заказа');
				$j('#paymenttype').attr('value','online');
				$j('#bank_money_label').css('color', '#79157f');
				$j('#bank_qiwi_label, #bank_card_label','#bank_wm_label','#bank_mc_label').css('color', '#666');
				$j('.img_bank').html('<img src="img/bank_card_gr.png" width="35" style="margin:0 10px;" align="left" />');
				$j('.img_money').html('<img src="img/money.png" width="35" style="margin:0 10px;" align="left" />');
				$j('.img_qiwi').html('<img src="img/qiwi_gr.png" width="35" style="margin:0 10px;" align="left" />');
				$j('.img_wm').html('<img src="img/wm_gr.png" width="35" style="margin:0 10px;" align="left" />');
                $j('.img_mc').html('<img src="img/mobile_gr.png" width="19" style="margin:0 10px;" align="left" />');
				break;
			}case 'qiwi':{
				$j('#payonlineinfowrap').show();
				$j('#addresshide, #paycashinfowrap, #paycashtips').hide();
				$j('#payonlineinfo').html('Оплата с Вашего кошелька QIWI через систему электронных платежей РФИ после подтверждения заказа');
				$j('#paymenttype').attr('value','online');
				$j('#bank_qiwi_label').css('color', '#79157f');
				$j('#bank_money_label, #bank_card_label','#bank_wm_label','#bank_mc_label').css('color', '#666');
				$j('.img_bank').html('<img src="img/bank_card_gr.png" width="35" style="margin:0 10px;" align="left" />');
				$j('.img_money').html('<img src="img/money_gr.png" width="35" style="margin:0 10px;" align="left" />');
				$j('.img_qiwi').html('<img src="img/qiwi.png" width="35" style="margin:0 10px;" align="left" />');
				$j('.img_wm').html('<img src="img/wm_gr.png" width="35" style="margin:0 10px;" align="left" />');
                $j('.img_mc').html('<img src="img/mobile_gr.png" width="19" style="margin:0 10px;" align="left" />');
				break;
			}case 'wm':{
                $j('#payonlineinfowrap').show();
                $j('#addresshide, #paycashinfowrap, #paycashtips').hide();
                $j('#payonlineinfo').html('Оплата с Вашего кошелька WebMoney через систему электронных платежей РФИ после подтверждения заказа');
                $j('#paymenttype').attr('value','online');
                $j('#bank_wm_label').css('color', '#79157f');
                $j('#bank_money_label, #bank_card_label,#bank_qiwi_label',"#bank_mc_label").css('color', '#666');
                $j('.img_bank').html('<img src="img/bank_card_gr.png" width="35" style="margin:0 10px;" align="left" />');
                $j('.img_money').html('<img src="img/money_gr.png" width="35" style="margin:0 10px;" align="left" />');
                $j('.img_qiwi').html('<img src="img/qiwi_gr.png" width="35" style="margin:0 10px;" align="left" />');
                $j('.img_wm').html('<img src="img/wm.png" width="35" style="margin:0 10px;" align="left" />');
                $j('.img_mc').html('<img src="img/mobile_gr.png" width="19" style="margin:0 10px;" align="left" />');
                break;
            }case 'mc':{
                $j('#payonlineinfowrap').show();
                $j('#addresshide, #paycashinfowrap, #paycashtips').hide();
                $j('#payonlineinfo').html('Оплата с Вашего мобильного через систему электронных платежей РФИ после подтверждения заказа');
                $j('#paymenttype').attr('value','online');
                $j('#bank_mc_label').css('color', '#79157f');
                $j('#bank_money_label, #bank_card_label','#bank_qiwi_label',"#bank_wm_label").css('color', '#666');
                $j('.img_bank').html('<img src="img/bank_card_gr.png" width="35" style="margin:0 10px;" align="left" />');
                $j('.img_money').html('<img src="img/money_gr.png" width="35" style="margin:0 10px;" align="left" />');
                $j('.img_qiwi').html('<img src="img/qiwi_gr.png" width="35" style="margin:0 10px;" align="left" />');
                $j('.img_wm').html('<img src="img/wm_gr.png" width="35" style="margin:0 10px;" align="left" />');
                $j('.img_mc').html('<img src="img/mobile.png" width="19" style="margin:0 10px;" align="left" />');
                break;
            }
			case 'nals':{
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
				$j('#paysum').attr('value','<?php echo base64_encode($_GET['pr']); ?>');
				$j('#shownal').show();
				break;
			}case 'part':{
				$j('#paysum').attr('value','<?php echo base64_encode($_GET['pr']); ?>');
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
<div id="wrapper" style="padding:0 50px;">
<h1 style="color: #FF6418;font-family: 'FreeSetBold';font-size: 41px;font-weight: 700;line-height: 45px;margin-bottom: 0;">ОПЛАТА</h1>
<a href="#" id="about_oplata" style="color: #79157f;font-family: 'FreeSet';font-size: 16px;font-weight: 400;line-height: 45px;margin-bottom: 17px;">ПОДРОБНЕЕ ОБ УСЛОВИЯХ ОПЛАТЫ</a><br /><br />
<div style="padding:10px; font-size:12px;background:#fff;" id="predoplata_win">

<b>Гарантия безопасности платежа</b><br />
При оплате заказа банковской картой (включая ввод номера карты), обработка платежа происходит на сайте системы электронных платежей РФИ, которая прошла международную сертификацию. Это значит, что Ваши конфиденциальные данные (реквизиты карты, регистрационные данные и др.) не поступают в интернет-магазин, их обработка полностью защищена и никто, в том числе ООО «Альпина Паблишер» (сайт www.alpinabook.ru), не может получить персональные и банковские данные клиента.

	<br /><br />
	<img src="img/rfi_logo.png" align="center" />
	<br /><br />
	Для защиты информации от несанкционированного доступа на этапе передачи от клиента на сервер системы РФИ используется протокол SSL 3.0, сертификат сервера (128 bit) выдан компанией Thawte - признанным центром выдачи цифровых сертификатов.
	<br /><br />
	При оплате  заказа банковской картой возврат денежных средств производится на ту карту, с которой был произведен платеж.
	<br /><br />
	<img src="img/visa_mastercard_logo.png" align="center" />
</div>
	<form action="confirm.php" name="confirm_payment" method="post">

<table width="500" style="float:left"><tbody>
	<tr>
		<td height="40">
			<h3 style="color: #FF6418;font-family: 'FreeSetBold';font-size: 23px;font-weight: 700;">СПОСОБЫ ОПЛАТЫ*</h3>
		</td>
	</tr>
	<tr>
		<td height="40">
			<input type="radio" name="paytype" value="spg" id="bk" checked /> 
			<label for="bk" style="color: #79157f;font-family: 'FreeSet';font-size: 21px;font-weight: 400;cursor:pointer;" id="bank_card_label"><span class="img_bank"><img src="img/bank_card.png" width="35" style="margin:0 10px;" align="left" /></span> Банковская карта</label><br />
		</td>
	</tr>
	<tr>
		<td height="40">			
			<input type="radio" name="paytype" value="ym" id="im" />
			<label for="im" style="color: #666;font-family: 'FreeSet';font-size: 19px;font-weight: 400;cursor:pointer;" id="bank_money_label"><span class="img_money"><img src="img/money_gr.png" width="35" style="margin:0 10px;" align="left" /></span> Яндекс деньги</label><br />
		</td height="40">
	</tr>
	<tr>
		<td height="40">			
			<input type="radio" name="paytype" value="qiwi" id="qiwi" />
			<label for="qiwi" style="color: #666;font-family: 'FreeSet';font-size: 19px;font-weight: 400;cursor:pointer;" id="bank_qiwi_label"><span class="img_qiwi"><img src="img/qiwi_gr.png" width="35" style="margin:0 10px;" align="left" /></span> Кошелек QIWI</label><br />
		</td>
	</tr>
	<tr>
        <td height="40">            
            <input type="radio" name="paytype" value="wm" id="wm" />
            <label for="wm" style="color: #666;font-family: 'FreeSet';font-size: 19px;font-weight: 400;cursor:pointer;" id="bank_wm_label"><span class="img_wm"><img src="img/wm_gr.png" width="35" style="margin:0 10px;" align="left" /></span> WebMoney</label><br />
        </td>
    </tr>
    <tr>
        <td height="40">            
            <input type="radio" name="paytype" value="mc" id="mc" />
            <label for="mc" style="color: #666;font-family: 'FreeSet';font-size: 19px;font-weight: 400;cursor:pointer;" id="bank_mc_label"><span class="img_mc"><img src="img/mobile_gr.png" width="19" style="margin:0 10px;" align="left" /></span> Мобильный платеж</label><br />
        </td>
    </tr>
</tbody></table>

<table width="400"><tbody>
	<tr>
		<td colspan="2" height="40">
				<h3 style="color: #FF6418;font-family: 'FreeSetBold';font-size: 23px;font-weight: 700;">ДАННЫЕ ПОЛУЧАТЕЛЯ</h3>
		</td>
	</tr>
	<tr>
		<td width="110" height="40">
			<span style="color: #FF6418;font-family: 'FreeSet';font-size: 19px;font-weight: 400;">Имя</span>
		</td>
		<td>
			<input type="text" size="25" name="name" style="background:transparent;border:2px solid #FF9C6A;height:20px;" required value="<?=$_POST["name"]?>" />
		</td>
	</tr>
	<tr>
		<td width="110" height="40">
			<span style="color: #FF6418;font-family: 'FreeSet';font-size: 19px;font-weight: 400;">e-mail</span>
		</td>
		<td>
			<input type="text" size="25" name="email" style="background:transparent;border:2px solid #FF9C6A;height:20px;" required value="<?=$_GET["email"]?>" required />
		</td>
	</tr>
	<tr>
		<td width="110" height="40">
			<span style="color: #FF6418;font-family: 'FreeSet';font-size: 19px;font-weight: 400;">Телефон</span>
		</td>
		<td>
			<input type="text" size="25" name="telephone" style="background:transparent;border:2px solid #FF9C6A;height:20px;" required value="<?=$_POST["phone"]?>" />
		</td>
	</tr>
				

</tbody></table>
				<input id="paymenttype" type="hidden" size="40" name="paymenttype" value="online" />
				
				<input type="hidden" name="paysum" value="<?php echo base64_encode($_GET['pr']); ?>">
				<input type="hidden" name="ordernumber" value="<?=$num?>" />
				
	
	<div style="margin-left:55px;margin-top:30px;color:#777; font-size:14px;font-family: 'FreeSet';">
		*оплата через систему<br />электронных платежей РФИ после<br />подтверждения заказа
	</div>	
	
	<div style="width:220px;margin:0 auto;">
		<input style="width:220px;height:36px;text-align:center;background:#FF6418;background-size: 105px 32xp;border:1px solid #fafafa;color:white;font-family: 'FreeSet';font-size: 19px;font-weight: 400;padding:5px;margin-top:15px;margin:0 auto;cursor:pointer;margin-top:12px" type="submit" value="Перейти к оплате" />
	</div>
	</form>
	</div>
	
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-10620222-1', 'alpinabook.ru');
	  ga('require', 'linkid', 'linkid.js');
	  ga('send', 'pageview');
	</script>	
	</body>
	</html>