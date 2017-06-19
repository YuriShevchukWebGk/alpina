<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;

if ($USER->IsAdmin()){
if ($_POST["request"]) {
	$subject = $_POST["subject"];
	$from = $_POST["from"];
	$preview = $_POST["preview"];
	$text = $_POST["text"];
	
	$signature = 'С уважением, Татьяна Разумовская,<br />
	руководитель интернет-магазина «Альпина Паблишер»';
	
	
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
	"PROPERTY_CATEGORIESBOUGHT",
	"PROPERTY_BOOKSBOUGHT"
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
	$arFilter = Array("IBLOCK_ID" => 67,"ACTIVE" => "Y", "NAME" => array("a-marchenkov@yandex.ru"));

	if ($_POST["test_email"])
		$arFilter = Array("IBLOCK_ID" => 67,"ACTIVE" => "Y", "NAME" => array($_POST["test_email"]));
	
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 99999), $arSelect);
	
	while ($ob = $res -> GetNext()) {

		arshow($ob);
		$books = array_slice($ob["PROPERTY_BOOKSBOUGHT"], 0, 3);
		arshow($bought);
		$books = implode(",", $books);

		$stringRecs = file_get_contents('https://api.retailrocket.ru/api/1.0/Recomendation/CrossSellItemToItems/50b90f71b994b319dc5fd855/'.$books);
		$recsArray = json_decode($stringRecs);
		$arrFilter = Array('ID' => (array_slice($recsArray,0,3)));

		if ($arrFilter['ID'][0] > 0) {
			$recs = "";
			$NewItems = CIBlockElement::GetList (array(), array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "ID" => $arrFilter['ID'], "ACTIVE" => "Y", ">DETAIL_PICTURE" => 0, "!PROPERTY_STATE" => 23), false, Array("nPageSize" => 3), array());
			while ($NewItemsList = $NewItems -> Fetch())
			{
				$pict = CFile::ResizeImageGet($NewItemsList["DETAIL_PICTURE"], array("width" => 140, "height" => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				$curr_sect = CIBlockSection::GetByID($NewItemsList["IBLOCK_SECTION_ID"]) -> Fetch();
				$recs .= '
				<table align="left" border="0" cellpadding="8" cellspacing="0" class="tile" width="32%">
				<tbody>
				<tr>
				<td height="200" style="border-collapse: collapse;text-align:center;" valign="top" width="100%">
				<a href="https://www.alpinabook.ru/catalog/'.$curr_sect["CODE"].'/'.$NewItemsList["ID"].'/?utm_source=autotrigger&amp;utm_medium=email&amp;utm_term=newbooks&amp;utm_campaign=newordermail" target="_blank">
				<img alt="'.$NewItemsList["NAME"].'" src="'.$pict["src"].'" style="width: 140px; height: auto;" />
				</a>
				</td>
				</tr>
				<tr>
				<td align="center" height="18" style="color: #336699;font-weight: normal; border-collapse: collapse;font-family: Roboto,Tahoma,sans-serif;font-size: 16px;line-height: 150%;" valign="top" width="126">
				<a href="https://www.alpinabook.ru/catalog/'.$curr_sect["CODE"].'/'.$NewItemsList["ID"].'/?utm_source=autotrigger&amp;utm_medium=email&amp;utm_term=newbooks&amp;utm_campaign=newordermail" target="_blank">Подробнее о книге</a>
				</td>
				</tr>
				</tbody>
				</table>';
			}
		}
		

		$NewItems = CIBlockElement::GetList (array(), array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "PROPERTY_STATE" => NEW_BOOK_STATE_XML_ID, "ACTIVE" => "Y", ">DETAIL_PICTURE" => 0), false, Array("nPageSize" => 3), array());
		$newBooks = "";
		while ($NewItemsList = $NewItems -> Fetch())
		{
			$pict = CFile::ResizeImageGet($NewItemsList["DETAIL_PICTURE"], array("width" => 100, "height" => 180), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			$curr_sect = CIBlockSection::GetByID($NewItemsList["IBLOCK_SECTION_ID"]) -> Fetch();
			$newBooks .= '
			<table align="left" border="0" cellpadding="8" cellspacing="0" class="tile" width="32%">
			<tbody>
			<tr>
			<td height="180" style="border-collapse: collapse;text-align:center;" valign="top" width="100%">
			<a href="https://www.alpinabook.ru/catalog/'.$curr_sect["CODE"].'/'.$NewItemsList["ID"].'/?utm_source=autotrigger&amp;utm_medium=email&amp;utm_term=newbooks&amp;utm_campaign=newordermail" target="_blank">
			<img alt="'.$NewItemsList["NAME"].'" src="'.$pict["src"].'" style="width: 100px; height: auto;" />
			</a>
			</td>
			</tr>
			</tbody>
			</table>';
		}
		
		
		
		$mailFields = array(
			"EMAIL" => "a-marchenkov@yandex.ru",
			"NEWBOOKS" => $newBooks,
			"RECS" => $recs,
			"FROM_EMAIL" => $from,
			"PREVIEW" => $preview,
			"TEXT" => $text,
			"SUBJECT" => $subject,
			"SIGNATURE" => $signature,
			"FNAME"=> $ob["PROPERTY_FNAME_VALUE"]
		);
		//arshow($mailFields);
		
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
	<form method="post" action="/custom-scripts/rfm/send.php">
		<p>
		Отправитель<br />
		<select size="3" name="from">
			<option value='Крючков Сергей <s.kruchkov@alpinabook.ru>' selected>Крючков Сергей</option>
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