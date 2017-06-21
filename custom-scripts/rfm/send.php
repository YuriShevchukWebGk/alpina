<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;

if ($USER->IsAdmin()){
if ($_POST["request"]) {
	/*$subject = $_POST["subject"];
	$from = $_POST["from"];
	$preview = $_POST["preview"];
	$text = $_POST["text"];*/
	
	$subject = "Очарование древней Японии. Арт-раскраска для взрослых";
	$from = 'Крючков Сергей <s.kruchkov@alpinabook.ru>';
	$preview = 'Знаем, что вы заказывали одну из раскрасок. Сообщаем хорошую новость: не так давно в наличии появилась арт-раскраска для взрослых. Скоро отпуск, и у нас есть надежда, что у вас будет чуть больше времени для любимых творческих занятий.';
	
	
	$signature = 'С уважением, Крючков Сергей,<br />
	менеджер по работе с клиентами';
	
	
	$arSelect = Array("ID", "NAME", 
	"PROPERTY_RECENCY",
	"PROPERTY_FREQUENCY",
	"PROPERTY_MONETARY",
	"PROPERTY_PHONE",
	"PROPERTY_FNAME",
	"PROPERTY_DELIVERY",
	"PROPERTY_PAYSYSTEM",
	"PROPERTY_MSK",
	"PROPERTY_ALLORDERS",
	"PROPERTY_PAYEDORDERS",
	"PROPERTY_LASTORDER",
	"PROPERTY_PAYEDSUM",
	"PROPERTY_CATEGORIESBOUGHT"
	);

	$arFilter = array();
	$arFilter["IBLOCK_ID"] = 67;
	$arFilter["ACTIVE"] = "Y";
	
	if ($_POST["PROPERTY_RECENCY"])
		$arFilter["PROPERTY_RECENCY"] = $_POST["PROPERTY_RECENCY"];
	
	if ($_POST["PROPERTY_FREQUENCY"])
		$arFilter["PROPERTY_FREQUENCY"] = $_POST["PROPERTY_FREQUENCY"];
	
	if ($_POST["PROPERTY_MONETARY"])
		$arFilter["PROPERTY_MONETARY"] = $_POST["PROPERTY_MONETARY"];
	
	if ($_POST["PROPERTY_MSK"] == "Y")
		$arFilter["PROPERTY_MSK_VALUE"] = "Y";
	elseif ($_POST["PROPERTY_MSK"] == "N")
		$arFilter["!PROPERTY_MSK_VALUE"] = "Y";
	else
		$arFilter["!PROPERTY_MSK_VALUE"] = "";
	
	if ($_POST["PROPERTY_PAYEDORDERS"])
		$arFilter[">=PROPERTY_PAYEDORDERS"] = "1";
	
	if (!empty($_POST["PROPERTY_PAYEDORDERS"]))
		$arFilter[">=PROPERTY_PAYEDORDERS"] = $_POST["PROPERTY_PAYEDORDERS"];
	
	if (!empty($_POST["PROPERTY_PAYEDSUM"]))
		$arFilter[">=PROPERTY_PAYEDSUM"] = $_POST["PROPERTY_PAYEDSUM"];
	
	$updateBought = true;
	//$arFilter = Array("IBLOCK_ID" => 67,"ACTIVE" => "Y", "NAME" => array("a.marchenkov@alpinabook.ru"));
	$arFilter = Array("IBLOCK_ID" => 67,"ACTIVE" => "Y", "PROPERTY_BOOKSBOUGHT" => array(8598,8764,8768,8624,60927,8754));
	
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 99999), $arSelect);
	
	while ($ob = $res -> GetNext()) {
		$name = !empty($ob["PROPERTY_FNAME_VALUE"]) ? 'Здравствуйте, '.$ob["PROPERTY_FNAME_VALUE"].'! ' : '';
		$text = '
			<div style="padding-top:0px; padding-bottom:0;color: #393939;font-family:Segoe UI, Roboto, Tahoma,sans-serif;font-size: 18px;line-height: 160%;text-align: left;" valign="top"><br />
			'.$name.'Знаем, что вы заказывали в интернет-магазине «Альпина Паблишер» одну из раскрасок. Скоро отпуск, и у нас есть надежда, что у вас будет чуть больше времени для любимых творческих занятий. Сообщаем хорошую новость: не так давно в наличии появилась арт-раскраска для взрослых <a href="https://www.alpinabook.ru/catalog/CreativityAndCreation/92954/?utm_source=autotrigger&amp;utm_medium=email&amp;utm_term=rfm&amp;utm_campaign=japanpaint" target="_blank">«Очарование древней Японии. Рисунки эпохи Хейан»</a>
		<br />
			&nbsp;
			<center><a href="https://www.alpinabook.ru/catalog/CreativityAndCreation/92954/?utm_source=autotrigger&amp;utm_medium=email&amp;utm_term=rfm&amp;utm_campaign=japanpaint" target="_blank"><img alt="Как убедить, что ты прав" src="https://www.alpinabook.ru/upload/resize_cache/iblock/67f/380_567_1/67fdc3853870eac689740cb371ff3f22.jpg" style="width:100%;max-width:379px;" /></a></center>
			<br /><br />
			
		Это не одна их тех многочисленных раскрасок, что за полдня создаются при помощи компьютерной графики. Эта арт-раскраска — плод вдохновения профессиональной талантливой Юнко Судзуки. Современная японская художница нарисовала самые яркие моменты сюжетов всемирно известных литературных шедевров древней эпохи Хэйан (794–1185), которую справедливо называют «золотым» периодом японской культуры.
		<br /><br /> Почитать подробнее о раскраске вы можете <a href="https://blog.alpinabook.ru/samurai-sakura-kimono-i-kioto-chto-eshhe-podarila-miru-epoha-heyan/?utm_source=autotrigger&amp;utm_medium=email&amp;utm_term=rfm&amp;utm_campaign=japanpaint" target="_blank">в нашем блоге</a>, а заказать — <a href="https://www.alpinabook.ru/catalog/CreativityAndCreation/92954/?utm_source=autotrigger&amp;utm_medium=email&amp;utm_term=rfm&amp;utm_campaign=japanpaint" target="_blank">уже сейчас</a>.
			</div>';
		/*
		$rsProps = CIBlockElement::GetProperty(
			67,
			$ob["ID"], "sort", "asc",
			array("CODE" => "BOOKSBOUGHT")
		);
		$booksbought = array();
		while($obs = $rsProps->GetNext()) {
			$booksbought[] = $obs['VALUE'];
		}
	
		$booksbought = array_slice($booksbought, -5, 5);
		$booksbought = implode(",", $booksbought);

		$stringRecs = file_get_contents('https://api.retailrocket.ru/api/1.0/Recomendation/CrossSellItemToItems/50b90f71b994b319dc5fd855/'.$booksbought);
		$recsArray = json_decode($stringRecs);
		arshow($recsArray);
		$arrFilter = Array('ID' => (array_slice($recsArray,0,3)));

		if ($arrFilter['ID'][0] > 0) {
			$recs = '<div style="font-family:Segoe UI, Roboto, Tahoma,sans-serif;font-size: 24px;font-style: normal;font-weight: 400;line-height: 100%;letter-spacing: normal;text-align: center;padding-bottom:10px;color:#666">Рекомендуем лично вам</div>';
			$NewItems = CIBlockElement::GetList (array(), array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "ID" => $arrFilter['ID'], "ACTIVE" => "Y", ">DETAIL_PICTURE" => 0), false, false, array());
			while ($NewItemsList = $NewItems -> Fetch())
			{
				$pict = CFile::ResizeImageGet($NewItemsList["DETAIL_PICTURE"], array("width" => 140, "height" => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				$curr_sect = CIBlockSection::GetByID($NewItemsList["IBLOCK_SECTION_ID"]) -> Fetch();
				$recs .= '
				<table align="left" border="0" cellpadding="8" cellspacing="0" class="tile" width="32%">
				<tbody>
				<tr>
				<td height="200" style="border-collapse: collapse;text-align:center;" valign="top" width="100%">
				<a href="https://www.alpinabook.ru/catalog/'.$curr_sect["CODE"].'/'.$NewItemsList["ID"].'/?utm_source=autotrigger&amp;utm_medium=email&amp;utm_term=rfm&amp;utm_campaign=japanpaint" target="_blank">
				<img alt="'.$NewItemsList["NAME"].'" src="'.$pict["src"].'" style="width: 140px; height: auto;" />
				</a>
				</td>
				</tr>
				<tr>
				<td align="center" height="18" style="color: #336699;font-weight: normal; border-collapse: collapse;font-family: Roboto,Tahoma,sans-serif;font-size: 16px;line-height: 150%;" valign="top" width="126">
				<a href="https://www.alpinabook.ru/catalog/'.$curr_sect["CODE"].'/'.$NewItemsList["ID"].'/?utm_source=autotrigger&amp;utm_medium=email&amp;utm_term=rfm&amp;utm_campaign=japanpaint" target="_blank">Подробнее о книге</a>
				</td>
				</tr>
				</tbody>
				</table>';
			}
		}*/
		

		$NewItems = CIBlockElement::GetList (array("rand" => "ASC"), array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "PROPERTY_STATE" => NEW_BOOK_STATE_XML_ID, "ACTIVE" => "Y", ">DETAIL_PICTURE" => 0), false, Array("nPageSize" => 3), array());
		$newBooks = '<div style="font-family:Segoe UI, Roboto, Tahoma,sans-serif;font-size: 24px;font-style: normal;font-weight: 400;line-height: 100%;letter-spacing: normal;text-align: center;padding-bottom:10px;color:#666;padding-top:30px">Обратите внимание на новинки</div>';
		while ($NewItemsList = $NewItems -> Fetch()) {
			$pict = CFile::ResizeImageGet($NewItemsList["DETAIL_PICTURE"], array("width" => 140, "height" => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			$curr_sect = CIBlockSection::GetByID($NewItemsList["IBLOCK_SECTION_ID"]) -> Fetch();
			$newBooks .= '
			<table align="left" border="0" cellpadding="8" cellspacing="0" class="tile" width="32%">
			<tbody>
			<tr>
			<td height="200" style="border-collapse: collapse;text-align:center;" valign="top" width="100%">
			<a href="https://www.alpinabook.ru/catalog/'.$curr_sect["CODE"].'/'.$NewItemsList["ID"].'/?utm_source=autotrigger&amp;utm_medium=email&amp;utm_term=rfm&amp;utm_campaign=japanpaint" target="_blank">
			<img alt="'.$NewItemsList["NAME"].'" src="'.$pict["src"].'" style="width: 140px; height: auto;" />
			</a>
			</td>
			</tr>
			</tbody>
			</table>';
		}
		
		
		
		$mailFields = array(
			"EMAIL" => $ob["NAME"],
			"NEWBOOKS" => $newBooks,
			//"RECS" => $recs,
			"FROM_EMAIL" => $from,
			"PREVIEW" => $preview,
			"TEXT" => $text,
			"SUBJECT" => $subject,
			"SIGNATURE" => $signature,
			"FNAME"=> $ob["PROPERTY_FNAME_VALUE"]
		);
		arshow($mailFields);
		
		//CEvent::Send("RFM_SEND_EMAIL", "s1", $mailFields, "N");
	}

	echo 'done!';
} else {?>
	<style>
		textarea {
			resize: none;
			overflow: hidden;
			font-size: 16px;
		} 
	</style>

	<center>
	<form method="post" action="/custom-scripts/rfm/test.php">
		<p>
		Отправитель<br />
		<select size="3" name="from">
			<option value='Сергей (Alpina.ru) <s.kruchkov@alpinabook.ru>' selected>Крючков Сергей</option>
			<option value='Татьяна Разумовская <t.razumovskaya@alpinabook.ru'>Татьяна Разумовская</option>
			<option value='Интернет-магазин «Альпина Паблишер» <shop@alpinabook.ru>'>Интернет-магазин «Альпина Паблишер»</option>
		</select>
		</p>


		<p>
		Тема письма<br />
		<input type="text" name="subject" value="" placeholder="До 55 символов" maxlength="55" />
		</p>

		
		<p>
		Текст перед письмом<br />
		<input type="text" name="preview" value="" placeholder="До 160 символов" maxlength="160" />
		</p>


		<p>
		Текст письма (HTML)<br />
		<textarea rows="20" style="width:100%; max-width:1000px" name="text"></textarea>
		</p>

		<p>
		Recency (дней)<br />
		<select size="6" name="PROPERTY_RECENCY[]" multiple>
			<option value='' selected>(все)</option>
			<option value='1'>0-30</option>
			<option value='2'>31-90</option>
			<option value='3'>91-250</option>
			<option value='4'>251-500</option>
			<option value='5'>501+</option>
		</select>
		</p>

		<p>
		Frequency (заказов)<br />
		<select size="6" name="PROPERTY_FREQUENCY[]" multiple>
			<option value='' selected>(все)</option>
			<option value='1'>6+</option>
			<option value='2'>4-5</option>
			<option value='3'>3</option>
			<option value='4'>2</option>
			<option value='5'>1</option>
		</select>
		</p>

		<p>
		Monetary (рублей)<br />
		<select size="6" name="PROPERTY_MONETARY[]" multiple>
			<option value='' selected>(все)</option>
			<option value='1'>10 001+</option>
			<option value='2'>5 001 - 10 000</option>
			<option value='3'>2 501 - 5 000</option>
			<option value='4'>1 001 - 2 500</option>
			<option value='5'>0 - 1 000</option>
		</select>
		</p>
		
		<p>
		Из Москвы <br />
		<input type="radio" name="PROPERTY_MSK" value="" checked /> (все)<br />
		<input type="radio" name="PROPERTY_MSK" value="Y" /> Да<br />
		<input type="radio" name="PROPERTY_MSK" value="N" /> Нет
		</p>
		
		<p>
		Только с оплатами
		<input type="checkbox" name="PROPERTY_PAYEDORDERS" value="1" />
		</p>
		
		<p>
		Тестовое письмо
		<input type="text" name="test_email" value="" placeholder="Только один адрес!" />
		</p>		
			
		<input type="hidden" name="request" value="Y" />
		<p><input type="submit" value="Отправить письма"></p>
	</form>
	</center>
<?
}
} else {
	echo 'authorize';
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>