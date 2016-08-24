<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Бесплатные электронные книги в приложении «Бизнес-книги»");
?>


<?/*<div class="deliveryPageTitleWrap">
	<div class="centerWrapper">
		<p></p>
		<h1>Бесплатные электронные книги</h1>
	</div>
</div>*/?>
	
<style>
.heading, .orderno {
	font-size:40px;
	color:#333;
}
.list li {
	font-size:24px;
	font-family: "Walshein_light";
	padding-top:25px;
}
.wraporders {
	background:#fff;
	height:auto;
}
.headingmin {
	font-size:28px;
}
.biglink {
	font-size:24px;
}
.biglink a {
	display:block;
	background:#00abb8;
	color:#fff;
	width:200px;
	font-weight:bold;
	font-size:24px;
	border-radius:45px;
	margin-top:20px;
	padding:25px;
}
td img {
	box-shadow: 0 9px 5px 0 rgba(0, 0, 0, 0.18), 0 10px 7px 0 rgba(0, 0, 0, 0.14);
}
#headerimg {
  background: url(img/header.jpg) no-repeat 50% 0;
  position: relative;
  margin-top: 80px;
  width: 100%;
  height: 427px;
  z-index: 31;
}
</style>
<div id="headerimg"></div>
<div class="howToBodyWrap">
    <div class="centerWrapper" style="padding:40px 0;line-height:200%">
	
	

<span class="heading">Как это работает?</span>
<ol class="list">
	<li>Установите на&nbsp;телефоне или планшете наше приложение-читалку &laquo;Бизнес-книги&raquo;. Зарегистрируйтесь и&nbsp;войдите в&nbsp;него (можно через Facebook)</li>
	<li>Нажмите на&nbsp; ссылку для скачивания (это можно сделать с&nbsp;компьютера, телефона или планшета)</li>
	<li>На&nbsp;странице введите ваши логин и&nbsp;пароль от&nbsp;приложения &laquo;Бизнес-книги&raquo; (или войдите с&nbsp;помощью Facebook).</li>
</ol>
<div style="line-height:180%;text-align:center;padding:10px 15px;font-family: 'Walshein_light';margin:50px 20px 25px;border-bottom:solid 1px #808080;border-top:solid 1px #808080;font-size:24px;">
Как только вы&nbsp;это сделаете, бесплатные электронные книги автоматически появятся в&nbsp;вашем приложении во&nbsp;вкладке &laquo;Мои книги&raquo;. Читайте, где вам удобно!</div>

<span style="color:#99abb1;font-weight:bold;">Дорогой друг!</span> <br />
Мы&nbsp;будем рады, если вы&nbsp;воспользуетесь нашим новым продуктом, и&nbsp;заранее просим прощения, если путь к&nbsp;бесплатным электронным книгам окажется сложным. Перед вами тестовая версия&nbsp;&mdash; мы&nbsp;приглашаем вас стать первопроходцами этой технологии.
<br /><br />
В&nbsp;редких случаях у&nbsp;нас может не&nbsp;оказаться электронной книги, которую вы&nbsp;купили в&nbsp;бумаге. Тогда мы&nbsp;подарим вам похожую книгу&nbsp;&mdash; бестселлер или лучшую новинку на&nbsp;ту&nbsp;же тему. 
<br /><br />
Сейчас услуга &laquo;Знание, а&nbsp;не&nbsp;носитель&raquo; работает на&nbsp;всех платформах iOS, начиная с&nbsp;версии iOS8 и&nbsp;выше (iOS7&nbsp;на стадии доработки). Мы&nbsp;также дорабатываем более удобный механизм и&nbsp;единую платформу для вашего профиля в&nbsp;интернет-магазине и&nbsp;приложении и&nbsp;представим вам его уже этой осенью. 
<br /><br />
Если у&nbsp;вас возникают сложности с&nbsp;получением бесплатных электронных книг, напишите нам на&nbsp;адрес <a href="mailto:shop@alpinabook.ru">shop@alpinabook.ru</a> или позвоните: +7&nbsp;(495)&nbsp;980&nbsp;80&nbsp;77.
    </div>
<div class="wraporders">
<div class="centerWrapper" style="padding:40px 0;line-height:200%">

		<?$orderUser = CUser::GetByID($USER->GetID())->Fetch();
		if (!empty($orderUser["UF_TEST"])) {
			$freeBooks = unserialize($orderUser["UF_TEST"]);
			$new = array();
			$exclude = array("");
			for ($i = 0; $i<=count($freeBooks)-1; $i++) {
				if (!in_array(trim($freeBooks[$i]["orderid"]) ,$exclude)) { $new[] = $freeBooks[$i]; $exclude[] = trim($freeBooks[$i]["orderid"]); }
			}

			$freeBooks = $new;
			//print_r($orderUser["UF_TEST"]);
			
			$printbooks = '';
			foreach ($freeBooks as $freeBook) {

				if ($freeBook['orderid']) {
					$ids = array();
					$printbooks .= '<center><span class="orderno">Заказ '.$freeBook['orderid'].'</span></center><br />';
					$printbooks .= '<center><span class="headingmin">Вот, какие книги вы заказали:</span></center>';

					foreach ($freeBook['products']['products'] as $i => $product) {
						$pic = CIBlockElement::GetByID($product['id'])->Fetch();
						$pic = CFile::ResizeImageGet($pic['DETAIL_PICTURE'], array("width" => 140, "height" => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
						
						$printbooks .= '<table align="left" style="text-align:center;width:220px;height:310px;margin-top:20px;"><tbody><tr><td><img src="'.$pic['src'].'" title="'.$product['name'].'" /></td></tr><tr><td valign="top" style="padding: 0;font-size:14px;">'.(strlen($product['name']) < 50 ? $product['name'] : substr($product['name'],0,50).'...').'</td></tr></tbody></table>';
					}
					
					$printbooks .= '<br style="clear:both;"><br /><br /><br />';
					$printbooks .= '<center><span class="headingmin">С помощью ссылки вы можете скачать бесплатно:</span></center>';
					
					foreach ($freeBook['products']['products'] as $m => $product) {
						$pic = CIBlockElement::GetByID($product['id'])->Fetch();
						$pic = CFile::ResizeImageGet($pic['DETAIL_PICTURE'], array("width" => 140, "height" => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
						if ($product['status'] == 'ok') {
							$ids[] = $product['id'];
							$printbooks .= '<table align="left" style="text-align:center;width:220px;height:310px;margin-top:20px;"><tbody><tr><td><img src="'.$pic['src'].'" title="'.$product['name'].'" /></td></tr><tr><td style="padding: 0;font-size:14px;">'.(strlen($product['name']) < 50 ? $product['name'] : substr($product['name'],0,50).'...').'</td></tr></tbody></table>';
						} else {
							$recpic = CIBlockElement::GetByID($product['rec'])->Fetch();
							$recpic = CFile::ResizeImageGet($recpic['DETAIL_PICTURE'], array("width" => 140, "height" => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
							
							$ids[] = $product['rec'];
							$printbooks .= '<table align="left" style="text-align:center;width:220px;height:310px;margin-top:20px;"><tbody><tr><td><img style="width:140px;-webkit-filter: grayscale(0.7);filter: grayscale(0.7);" src="'.$pic['src'].'" title="'.$product['name'].'" /><img style="margin-left:-80px;-webkit-filter: grayscale(0);filter: grayscale(0);" src="'.$recpic['src'].'" title="'.$product['name'].'" /></td></tr><tr><td style="padding: 0;font-size:14px;">Этой книги нет в приложении «Бизнес-книги», взамен мы дарим вам «'.$product['recname'].'»</td><td></td></tr></tbody></table>';
						}
					}
					$printbooks .= '<ol>';
					foreach (array_unique($ids) as $id) {
						$name = CIBlockElement::GetByID($id)->Fetch();
						//$printbooks .= '<li>'.$name[NAME].'</li>';
					}
					$printbooks .= '</ol><br style="clear:both;" /><br />';
					$printbooks .= '<center><span class="biglink">По этой ссылке вы можете скачать<br />бесплатные электронные книги<br /><a href="'.$freeBook['products']['url'].'" target="_blank">Скачать</a></span></center><br /><br /><br />';
				} else {
					//echo 'error<br />';
				}
			}
			
			echo $printbooks;
			
			$links = serialize($freeBooks);

			$fieldsGend = Array(
				"UF_TEST"						=> $links
			);
			$userGend = new CUser;
			$userGend->Update($USER->GetID(), $fieldsGend);
							
		}?>


</div></div>

</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>