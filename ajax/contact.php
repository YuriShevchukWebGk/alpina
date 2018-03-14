<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (!empty($_POST['contact'])) {
	
	$return = "
	<div id=\"ajaxBlock\">
		<style>
		ul{list-style-type:disc;padding:30px 0 30px 30px}
		.stopProp img{max-width:650px;height:auto;display:block;margin:0 auto;padding:20px 0}
		.awayLink:hover{background-color:#cab796!important;color:#fff!important}
		.addLink:hover{background-color:#c7a271!important;color:#fff!important}
		.closeIcon:after{background:url(\"/img/close.png\") left center;width:21px;height:21px;cursor:pointer;display:block;content:\"\";float:right}
		.closeIcon:hover:after{background:url(\"/img/close.png\") right center}
		.hideInfo{font-family:'Walshein_light','Helvetica';position:fixed; width:100%; height:100%; top:0; left:0; z-index:999999999998; background:rgba(206,206,206,.62);overflow-y:auto}
		.infoPopup{max-width:600px; box-shadow:0 0 1px 0px rgba(0,0,0,.7); top:0; left:50%; margin:3% auto;background:#fff; padding:30px 40px; z-index:999999999999;display:block;color:#2F3839}
		.closeIcon{cursor:pointer}
		.popupTitle{font-size:28px;clear:both;text-align:center}
		.options {display:inline-block}
		.options div {padding:6px 13px;text-align:center;float:left;margin:20px 19px 0 0}
		.options span{color:#00abb8;font-size:18px;border-bottom:1px dashed;cursor:pointer}
		.options span:hover{border-bottom:none}
		.options .active{background:#00aab8;border-radius:4px}
		.options .active span{color:#fff;border-bottom:none}
		.textarea {clear:both;margin:30px auto;max-width:400px}
		.textarea textarea {width:90%;background-color:#fafafa;border:1px solid #00aab8;color:#333;font-size:17px;padding:20px;resize:none;height:100px}
		.textarea input[type=\"email\"] {width:80%;background-color:#fafafa;border:1px solid #00aab8;color:#333;font-size:17px;padding:6px 20px;margin-top:30px}
		.textarea p {background-color:#00abb8;border-radius:35px;color:#eee;font-size:19px;padding:14px 19px;width:210px;cursor:pointer;transition: color .3s ease,background-color .3s ease,border-color .3s ease}
		.textarea p:hover{color:fff;background-color:#28bcc7}
		</style>
		
		<script>
			$(document).ready(function(){
				$(\".stopProp\").click(function(e) {
					e.stopPropagation();
				});
				
				$(\".options div\").click(function() {
					$(\".options .active\").removeClass(\"active\");
					$(this).addClass(\"active\");
				});
			});
			
			function contact() {
				var subject = $(\".options .active span\").text();
				var text = $(\".textarea textarea\").val();
				var email = $(\"input[name='emailContact']\").val();
				
				var stop = false;
				
				if (text == \"\") {
					$(\".textarea textarea\").css(\"border\",\"1px solid red\");
					stop = true;
				} else {
					$(\".textarea textarea\").css(\"border\",\"1px solid #00aab8\");
				}
				
				if (email == \"\") {
					$(\"input[name='emailContact']\").css(\"border\",\"1px solid red\");
					stop = true;
				} else {
					$(\"input[name='emailContact']\").css(\"border\",\"1px solid #00aab8\");
				}
				
				if (!stop) {
					$.ajax({
						type: \"POST\",
						url: \"/ajax/contact.php\",
						data: {
							send_contact: \"1\",
							email: email,
							subject: subject,
							text: text}
					}).done(function(strResult) {
						if (strResult == 123) {
							$(\".options\").html(\"<p style='color:#00aab8;font-size:24px;text-align:center;padding-top:50px'>Спасибо! Письмо отправлено в правильные руки</p>\");
							$(\".textarea\").empty();
						}
					});
				}
			}
			</script>
		
		<div onclick=\"closeInfo();\" class=\"hideInfo\">
		
			<div class=\"stopProp infoPopup\">
			
				<div class=\"closeIcon\" onclick=\"closeInfo();\"></div>
				
				<div>
					<div class=\"popupTitle\">Письмо издательству</div>
					<div class=\"options\">
						<div class=\"active\">
							<span>предлагаю книгу</span>
						</div>
						<div>
							<span>сообщаю об опечатке</span>
						</div>
						<div>
							<span>напишу о вашей книге</span>
						</div>
						<div>
							<span>у вас ошибка на сайте</span>
						</div>
						
						<div>
							<span>о другом</span>
						</div>
					</div>
					
					<div class=\"textarea\">
						<textarea placeholder=\"сообщение\"></textarea>
						<br />
						<br />
						<center><input type=\"email\" name=\"emailContact\" placeholder=\"email\" /></center>
						<center><p onclick=\"contact();return false;\">Отправить письмо</p></center>
						<br /><br />
						Нажимая на&nbsp;кнопку &laquo;Отправить письмо&raquo;, вы&nbsp;соглашаетесь на&nbsp;обработку персональных данных в&nbsp;соответствии <a href=\"/content/pii/\" target=\"_blank\">с&nbsp;условиями</a>
					</div>
				</div>
			</div>
		</div>
	</div>";

	echo $return;

} elseif (!empty($_POST['send_contact'])) {
	
	$mailFields = array(
		"EMAIL" => $_POST['email'],
		"SUBJECT" => $_POST['subject'],
		"TEXT" => $_POST['text']
	);
	
	if (CEvent::Send("CONTACT_PUBLISHER", "s1", $mailFields,"N"))
		echo 123;
}
?>