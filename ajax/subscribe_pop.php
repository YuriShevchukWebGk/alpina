<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
if ($_REQUEST["id"]) {
	$return = '<style>.outLink {text-decoration:underline} .outLink:hover {text-decoration:none;}.stopProp img {max-width:650px;height:auto;display:block;margin:0 auto;padding:0 50px 0 0;}.awayLink:hover {background-color: #cab796!important;color: #fff!important;} .addLink:hover {background-color: #c7a271!important;color: #fff!important;} .closeX:after{margin-top:-30px;font-size:48px;position: absolute;content:"\00d7";color:#fff;width: 21px;height: 21px;right: 40px;cursor: pointer;display: block} .closeX:hover:after {content:"\00d7";color:#888}#subpop input[type=button]{background:transparent;color:#fff;margin-left:-50px;font-size:28px;}input:-webkit-autofill, textarea:-webkit-autofill, select:-webkit-autofill {background-color:transparent!important;color:#fff!important}</style>';
	
	$return .= '<script>$(document).ready(function() { $(".stopProp").click(function(e) { e.stopPropagation(); }); });';
	$return .= 'function subscribe() {var emailAddres = $(".subscribeForm input[type=email]").val();var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;if (regex.test(emailAddres)){$.post("/ajax/request_add.php", {email: $(".subscribeForm input[type=email]").val()}, function(data){$(".errorinfo").hide();$("#subpop form").html(data);})}else{$(".errorinfo").show();$(".errorinfo").html("Кажется, вы ошиблись в написании своего адреса");}}</script>';
	
	$return .= '<div style="position: fixed; width: 100%; height: 100%; top: 0; left: 0; z-index: 999999999998; background: rgba(0,0,0,.75);overflow-y:auto;" onclick="closeX();" class="hideInfo no-mobile">';
	$return .= '<div style="max-width: 800px; width:100%;min-width:700px;margin-left: -410px; margin-top: 7%;margin-bottom:7%;top: 0; left: 50%; position: absolute; padding: 30px 40px; z-index: 999999999999;display: block;font-family: \'Walshein_regular\';color:#2F3839" class="stopProp">';
	$return .= '<div class="closeX" style="cursor:pointer;" onclick="closeX();"></div>';
	$return .= '<div style="color:#fff;line-height: 140%;font-size: 18px;" id="subpop">';


	$return .= '<img src="/upload/resize_cache/iblock/2cf/380_567_1/2cf9bb0613bb086c817b8b3f416ed93b.jpg" style="width:100%;max-width:264px" align="left" /><h2 style="font-size:32px;">Дарим книгу за подписку!</h2><br />';

	$return .= 'Подпишитесь на рассылку и получите книгу <b>«Ловушка для внимания: Как вызвать и удержать интерес к идее, проекту или продукту»</b> в формате PDF <b>бесплатно!</b><br />';
	$return .=
		'<form action="/" method="post" style="padding-top:40px;" class="subscribeForm">
			<input type="email" style="height: 60px;background: transparent;padding:0 60px 0 20px;font-size: 18px;font-weight: 400;color: #fff;border: 1px solid #fff;width:275px;" placeholder="Ваш e-mail" name="email">
			<input type="button" onclick="subscribe();return false;" value="→" style="height: 60px;width: 40px;cursor: pointer;border: none;">
		</form><br /><span class="errorinfo"></span>';

	$return .= '<br />';

	$return .= '</div><br />';

	$return .= '</div></div></div>';
	echo $return;
}
?>