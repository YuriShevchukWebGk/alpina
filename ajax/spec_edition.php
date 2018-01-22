<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($_REQUEST["ask"]) {	
	$return = '<style>.stopProp img {max-width:450px;height:auto;display:block;margin:0 auto;padding:20px 0;}.awayLink:hover {background-color: #cab796!important;color: #fff!important;} .addLink:hover {background-color: #c7a271!important;color: #fff!important;} .closeIcon:after {background: url("/img/close.png") left center;width: 21px;height: 21px;float:right;cursor: pointer;display: block;content: "";} .closeIcon:hover:after {background: url("/img/close.png") right center;} .input_row{
	height: 48px;
    font-size: 20px;
    width: 100%;
	max-width:250px;
    text-align: left;
	padding:0 20px;
    color: #00b9c8;
    border: 1px solid #00b9c8;
    font-family: "Walshein_regular";
	margin:12px 0}
	.specTitle {
		font-size:32px;
		    font-family: Walshein_bold;
		color:#444;
	}
	.specSumb {
		background-color: #00b9c8;
		color: #f2f2f2;
		border-radius: 35px;
		font-size: 19px;
		padding: 14px 58px;
		margin:20px 0
	}
	</style>';
	$return .= '
		<script>
			$(document).ready(function(){
				$(".stopProp").click(function(e){
					e.stopPropagation();
				});
			});
			function specSend() {
				var data_name = $("input[name=data_name]").val();
				var data_email = $("input[name=data_email]").val();
				var data_phone = $("input[name=data_phone]").val();

				if (data_name != "" && data_email != "" && data_phone != "") {
					$.ajax({
						type: "POST",
						url: "/ajax/spec_edition.php",
						data: {sendForm: "y", name:data_name, email:data_email, phone:data_phone, book:"'.$_REQUEST["ask"].'"}
					}).done(function(strResult) {
						$(".infoPopup").empty();
						$(".infoPopup").html("Ваша заявка принята! Для уточнения деталей специалист свяжется в ближайшее время");
					});
				} else {
					$(".warn").html("Заполните все поля");
				}
			}
		</script>'
			
	;
	$return .= '<div style="position: fixed; width: 100%; height: 100%; top: 0; left: 0; z-index: 999999999998; background: rgba(206,206,206,.62);overflow-y:auto;" onclick="closeInfo();" class="hideInfo">';
	$return .= '<div style="max-width: 450px; width:100%;box-shadow: 0 0 1px 0px rgba(0,0,0,.7); margin:8% auto 0; background: #fff; padding: 30px 40px; z-index: 999999999999;display: block;font-family: \'Walshein_regular\';text-align:center" class="stopProp infoPopup">';
	$return .= '<div class="closeIcon" style="cursor:pointer;" onclick="closeInfo();"></div>';
	$return .= '<div>';


	$return .= '
		<div class="specTitle">Издание спецтиража</div>
		«'.$_REQUEST["ask"].'»
		<br /><br />
		<div class="warn"></div>
		<input class="input_row" type="text" placeholder="Имя" name="data_name" required><br />
		<input class="input_row" type="text" placeholder="Телефон" name="data_phone" required><br />
		<input class="input_row"type="text" placeholder="Электронная почта" name="data_email" required><br /><br />
		<a href="#" onclick="specSend();return false;" class="specSumb">ОСТАВИТЬ ЗАЯВКУ</a>
		<br /><br /><br />
		<div class="check" style="text-align:left;color:#777">Hажимая кнопку «Оставить заявку», вы принимаете условия <a href="/content/pii/" target="_blank">Пользовательского соглашения</a></div>
	
	';
	
	$return .= '</div><br />';
	
	$return .= '</div></div></div>';
	echo $return;
} elseif ($_REQUEST["sendForm"]) {
	$el = new CIBlockElement;
	$PROP = array();
	$PROP[925] = $_POST["name"];
	$PROP[926] = $_POST["book"];
	$PROP[927] = $_POST["phone"];
	
	$arLoadProductArray = Array(
		"MODIFIED_BY"    => 15,
		"IBLOCK_SECTION" => false,
		"IBLOCK_ID"      => 78,
		"PROPERTY_VALUES"=> $PROP,
		"NAME"           => $_POST["email"],
		"ACTIVE"         => "Y"
	);
	
	$el->Add($arLoadProductArray);
}
?>