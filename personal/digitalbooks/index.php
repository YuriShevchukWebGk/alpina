<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Бесплатные электронные книги в приложении «Бизнес-книги»");
?>
<?if ($USER->isAdmin()
	|| $USER->GetID() == 178865
	|| $USER->GetID() == 168754	
	|| $USER->GetID() == 178866
	|| $USER->GetID() == 178885
){?>

<div class="deliveryPageTitleWrap">
	<div class="centerWrapper">
		<p></p>
		<h1>Бесплатные электронные книги</h1>
	</div>
</div>
	
<div class="howToBodyWrap">
    <div class="centerWrapper" style="padding:40px 0;line-height:200%">
Отныне, покупая бумажную книгу «Альпины» на нашем сайте, вы также получаете ее в электронном виде на всех своих устройствах. Бесплатно и моментально!
<br /><br />
Как это работает? Вам нужно сделать всего три шага:<ol>
	<li>Установите на телефоне и планшете наше приложение-читалку “Бизнес-книги” (доступна для Android и iOS) и зарегистрируйтесь в нем (или просто войдите с помощью фейсбука).</li>
	<li>Нажмите на ссылку для скачивания бесплатных электронных книг (она ниже, на всякий случай мы также отправили вам ее на почту).</li>
	<li>Вы попадете на страницу, где нужно будет ввести ваши логин и пароль от приложения “Бизнес-книги” (или, опять же, войти с помощью фейсбука).</li>
	<li>Как только вы это сделаете, бесплатные электронные книги автоматически появятся в вашем приложении на телефоне и планшете. Вы найдете их там во вкладке «Мои книги».</li>
</ol>

Теперь вы можете читать свои любимые книги где вам нравится и как вам нравится!
<br /><br />
Важный момент: в редких случаях у нас может не оказаться электронной книги, которую вы купили в бумаге. Тогда мы подарим вам похожую книгу — бестселлер или лучшую новинку на ту же тему.
<br /><br />
<h2>По этим ссылкам вы можете скачать бесплатные электронные книги — копии тех, которые вы приобрели в бумаге:</h2>
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
					$printbooks .= '<b style="font-size:28px;"><a href="'.$freeBook['products']['url'].'" target="_blank">Заказ '.$freeBook['orderid'].'</a></b><br />';
					$printbooks .= 'С помощью <a href="'.$freeBook['products']['url'].'" target="_blank">ссылки</a> вы сможете скачать бесплатно:';
					$printbooks .= '<ol>';
					foreach ($freeBook['products']['products'] as $i => $product) {
						$pic = CIBlockElement::GetByID($product['id'])->Fetch();
						$pic = CFile::ResizeImageGet($pic['DETAIL_PICTURE'], array("width" => 200, "height" => 285), BX_RESIZE_IMAGE_PROPORTIONAL, true);
						
						if ($product['status'] == 'ok') {
							$ids[] = $product['id'];
							$printbooks .= '<li><table><tbody><tr><td><img src="'.$pic['src'].'" title="'.$product['name'].'" /></td><td style="width:250px;padding:0 20px;">«'.$product['name'].'»</td></tr></tbody></table></li>';
						} else {
							$recpic = CIBlockElement::GetByID($product['rec'])->Fetch();
							$recpic = CFile::ResizeImageGet($recpic['DETAIL_PICTURE'], array("width" => 200, "height" => 285), BX_RESIZE_IMAGE_PROPORTIONAL, true);
							
							$ids[] = $product['rec'];
							$printbooks .= '<li valign="top"><table><tbody><tr><td><img style="width:140px;" src="'.$pic['src'].'" title="'.$product['name'].'" /></td><td style="width:250px; padding: 0 20px;">Вместо «'.$product['name'].'», которой нет в приложении «Бизнес-книги», мы дарим вам&nbsp;-></td><td><img src="'.$recpic['src'].'" title="'.$product['name'].'" /></td></tr></tbody></table></li>';
						}
					}
					$printbooks .= '</ol><br />';
					$printbooks .= '<ol>';
					foreach (array_unique($ids) as $id) {
						$name = CIBlockElement::GetByID($id)->Fetch();
						//$printbooks .= '<li>'.$name[NAME].'</li>';
					}
					$printbooks .= '</ol><br />';
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



    </div>
</div>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>