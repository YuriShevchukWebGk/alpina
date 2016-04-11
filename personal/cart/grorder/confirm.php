<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Подтверждение оплаты</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="index, follow" />
<meta name="keywords" content="Издательство деловой литературы, Альпина Паблишер, книжный интернет магазин, интернет магазин книг, купить книги, деловая литература, бизнес литература, доставка книг, новинки, бестселлеры, накопительные скидки, alpinabook.ru, Альпина Паблишерз, Альпина Паблишерс" />
<meta name="description" content="«Альпина Паблишер» выпускает бизнес-книги более десяти лет. За книгами издательства Альпины прочно закрепилась репутация максимально полезных и интересных. Альпина гордится своими авторами, идеи которых определяют современный мир. В интернет-магазине Альпины можно купить книги по самой выгодной цене с доставкой. доставка по Москве и почтой по России." />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
</head>

<body itemscope itemtype="http://schema.org/WebPage">
<style>
body {max-width:660px;width:100%;}
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

<?
    /*global $USER;
    if($USER->IsAdmin()){
        arshow($_POST);
    }*/
?>

<?if(CModule::IncludeModule("iblock"))
{
$arFilter = Array("IBLOCK_ID"=>48, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_RUBRIC" => $arSection["ID"]);
    $res = CIBlockElement::GetList(Array(), $arFilter, Array());
  //  echo $res; 
   
 $num = 'GR_'.$res;
 $name_zak = 'Заказ #'. $num;
     
$el = new CIBlockElement;
$PROP = array();
$PROP["phone"] = $_POST["telephone"];        // свойству с кодом 3 присваиваем значение 38
$PROP["email"] = $_POST["email"];
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
}?>
<h2>Спасибо! Ваш заказ принят №<?=$num?></h2>

Общая стоимость <?=$_POST["paysum"]?> руб.
<br />

    <form method="POST" class="application" accept-charset="UTF-8" action="https://partner.rficb.ru/a1lite/input" target="_blank">
    <input type="hidden" name="key" value="4c4T8DHjwzrI647Eh38hfKt3gu4iPOFUqVlhuazYq/g=">
    <input type="hidden" name="cost" value="<?=$_POST["paysum"]?>">
    <input type="hidden" name="name" value="Оплата заказа №<?=$num?> от <?=date("Y-m-d H:i:s")?>">
    <input type="hidden" name="default_email" value="<?=$_POST["email"]?>">
    <input type="hidden" name="order_id" value="<?=$num?>">
    <input type="hidden" name="comment" value="<?=$num?>">
    <input type="hidden" name="payment_type" value="<?echo $_POST['paytype']?>" />
    <input type="hidden" name="phone_number" value="<?echo $_POST['telephone']?>" />
    <input type="hidden" name="email" value="<?echo $_POST['email']?>" />
    <input type="hidden" name="verbose" value="0" />
        <INPUT style="width:205px;height:36px;font-size:15px;text-align:center;background:#EE7203;background: -moz-linear-gradient(top, #EE7203, #F6921E) transparent;background: -webkit-linear-gradient(top, #EE7203, #F6921E) transparent;background: -o-linear-gradient(top, #EE7203, #F6921E) transparent;background: -ms-linear-gradient(top, #EE7203, #F6921E) transparent;background: linear-gradient(top, #EE7203, #F6921E) transparent;background-size: 105px 32xp;border:1px solid #908f8a;color:white;font-weight:600;padding:5px;margin-top:15px;margin:0 auto;cursor:pointer;margin-top:12px" TYPE="SUBMIT" class="inputbutton" NAME="Submit" VALUE="Оплатить"/>
    </form>

		 <br/><br/><br/>
	<b>Обратите внимание:</b><br /><br />

	Бывают случаю, когда может потребоваться подтверждение оплаты менеджером вручную, что займет некоторое время. И учитывая, что наши сотрудники иногда отдыхают и спят, мы просим дать нам таймаут до ближайшего «рабочего времени» ☺<br /><br />
	Рабочее время наших операторов – по рабочим дням с 10:00 до 18:00 Мск.<br />
	<br><br>В связи с усилением борьбы с мошенничеством международными платежными системами транзакции по картам Visa и Eurocard/Mastercard без заполнения поля, предназначенного для указания CVV2/CVC2 (CVV2 или CVC2 - уникальное контрольное число, нанесенное на обратной стороне карты после ее номера), данными платежными системами приниматься к обработке не будут.<br><br>В системе <a href="http://www.rficb.ru/">РФИ</a> безопасность платежей обеспечивается использованием SSL протокола для передачи конфиденциальной информации от клиента на сервер <a href="http://www.rficb.ru/">системы РФИ</a> для дальнейшей обработки.<br><br>Дальнейшая передача информации осуществляется по закрытым банковским сетям, взлом которых практически невозможен.<br><br></p>
	<p align="justify"><h3>Безопасность передаваемой информации</h3>
	<p align="justify">Для защиты информации от несанкционированного доступа на этапе передачи от клиента на сервер системы используется протокол SSL 3.0, сертификат сервера (128 bit) выдан компанией <a href="https://www.thawte.com">Thawte</a> - признанным центром выдачи цифровых сертификатов.<br><br></p>
	
</body>
</html>