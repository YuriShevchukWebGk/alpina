<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<style>
input[type="radio"], #addresshide, #paycashinfowrap {
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

#payonlinetips, #paycashtips {
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
				$j('#addresshide, #paycashinfowrap').hide();
				$j('#payonlineinfo').html('Оплата банковской картой через систему электронных платежей Assist после подтверждения заказа');
				$j('#paymenttype').attr('value','online');
				break;
			}case 'im':{
				$j('#payonlineinfowrap').show();
				$j('#addresshide, #paycashinfowrap').hide();
				$j('#payonlineinfo').html('Оплата Яндекс.Деньгами или Webmoney через систему электронных платежей Assist после подтверждения заказа');
				$j('#paymenttype').attr('value','online');
				break;
			}case 'qiwi':{
				$j('#payonlineinfowrap').show();
				$j('#addresshide, #paycashinfowrap').hide();
				$j('#payonlineinfo').html('Оплата с Вашего кошелька QIWI через систему электронных платежей Assist после подтверждения заказа');
				$j('#paymenttype').attr('value','online');
				break;
			}case 'nals':{
				$j('#addresshide, #paycashinfowrap').show();
				$j('#payonlineinfowrap').hide();
				$j('#paycashinfo').html('Вы можете забрать абонемент на тренинг в офисе Альпины Паблишер. Адрес: Москва, 4-я Магистральная улица, д.5, 2 подъезд, 2 этаж.<br />Время работы: пн-пт 8:00-19:00<br />+7 (495) 21-21-421');
				$j('#paymenttype').attr('value','cash');
				break;
			}case 'nalk':{
				$j('#addresshide, #paycashinfowrap').show();
				$j('#payonlineinfowrap').hide();
				$j('#paycashinfo').html('Курьер доставит абонемент на участие в тренинге по указанному вами адресу:<br />Время доставки: 2-3 рабочих дня<br />Стоимость доставки:<br />- При оплате базового курса – 200 руб.<br />- При оплате Интенсива – Бесплатно');
				$j('#paymenttype').attr('value','cash');
				break;			
			}
		}
	});
});
</script>

<h1 style="font-size:15px;">Способ оплаты</h1>

<br /><br />
	<form action="confirm.php" name="confirm_payment" method="post">
		<h3 style="font-size:13px;color: #EE7203;">Безналичная оплата</h3>
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
		<h3 style="font-size:13px;color: #EE7203;">Оплата наличными</h3>

		<input type="radio" name="paytype" value="nals" id="nals" hidden />
		<label for="nals">Самовывоз (Москва)</label><br />
		
		<input type="radio" name="paytype" value="nalk" id="nalk" hidden />
		<label for="nalk">Курьер (в пределах МКАД)</label><br />
	</div>
	
	<div id="paycashinfowrap">
		<div id="paycashinfo">
			Оплата банковской картой через систему электронных платежей Assist после подтверждения заказа
		</div>
	</div>	
		<br style="clear:both"/><br /><br />
	<div id="clientinfo">
		<h3 style="font-size:13px;color: #EE7203;">Данные получателя</h3>

				<div class="propname">Получатель: </div>
				<div class="propinfo"><div class="info"><?=htmlspecialcharsbx($_POST["name"])?></div></div></div>

				<div class="propname">Адрес электронной почты: </div>
				<div class="propinfo"><div class="info"><?=htmlspecialcharsbx($_POST["email"])?></div></div>

				<div class="propname">Контактный телефон: </div>
				<div class="propinfo"><div class="info"><?=htmlspecialcharsbx($_POST["phone"])?></div></div>
				
				<div id="addresshide">
					<div class="propname">Адрес доставки: </div>
					<div class="propinfo"><div class="info"><input id="address" placeholder="Введите адрес доставки" type="text" size="40" name="address" /></div></div>
					<div class="propname">Комментарий: </div>
					<div class="propinfo"><div class="info"><textarea cols="40" placeholder="Комментарий к заказу" rows="3" name="comments"></textarea></div></div>
				</div>

		<input type="hidden" size="40" name="name" value="<?=htmlspecialcharsbx($_POST["name"])?>" />
		<input id="paymenttype" type="hidden" size="40" name="paymenttype" value="online" />
		<input type="hidden" size="40" name="email" value="<?=htmlspecialcharsbx($_POST["email"])?>" />
		<input type="hidden" size="40" name="telephone" value="<?=htmlspecialcharsbx($_POST["phone"])?>" />
		
		<input type="hidden" name="paysum" value="<?=htmlspecialcharsbx($_POST['paysum'])?>" />
		<input type="hidden" name="ordernumber" value="<?=$num?>" />	
		<input style="width:205px;height:36px;font-size:15px;text-align:center;background:#EE7203;background: -moz-linear-gradient(top, #EE7203, #F6921E) transparent;background: -webkit-linear-gradient(top, #EE7203, #F6921E) transparent;background: -o-linear-gradient(top, #EE7203, #F6921E) transparent;background: -ms-linear-gradient(top, #EE7203, #F6921E) transparent;background: linear-gradient(top, #EE7203, #F6921E) transparent;background-size: 105px 32xp;border:1px solid #908f8a;color:white;font-weight:600;padding:5px;margin-top:15px;margin:0 auto;cursor:pointer;margin-top:12px" type="submit" value="Перейти к оплате" />
	</div>
	</form>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>