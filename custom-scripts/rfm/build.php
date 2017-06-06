<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){
	if ($_POST["request"] == "Y") {
		//print_r($_POST);
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
		"PROPERTY_PRODUCTSBOUGHT"
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
		
		
		//$arFilter = Array("IBLOCK_ID" => 67,"ACTIVE" => "Y", ">=PROPERTY_PAYEDORDERS" => 5);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 99999), $arSelect);
		echo 'Всего клиентов:'.$res->SelectedRowsCount();
		
		
		$table = '<table border="1"><tbody><tr>';
		$table .= '<td>№</td>';
		foreach ($arSelect as $td) {
			$table .= '<td>'.$td.'</td>';
		}
		$table .= '</tr>';
		$n = 1;
		while ($ob = $res -> GetNextElement()) {
			$table .= '<tr>';
			$ob = $ob->getFields();
			$m = 0;
			unset ($ob["PROPERTY_MSK_ENUM_ID"]);
			unset ($ob["~PROPERTY_MSK_ENUM_ID"]);
			$table .= '<td>'.$n.'</td>';
			foreach ($ob as $i => $prop) {
				if ($m == 0 || $m == 2) {
					$table .= '<td>'.$prop.'</td>';
				} elseif ($m % 4 == 0) {
					$table .= '<td>'.$prop.'</td>';
				}
				$m++;
			}
			echo '<pre>';
			//print_r($ob);
			echo '</pre>';
			$table .= '</tr>';
			$n++;
		}
		
		$table .= '</tbody></table>';

		echo $table;
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
		<form method="post" action="/custom-scripts/rfm/build.php">
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
			<?/*
			<p>
			Заказов больше, чем (дополнительно)
			<input type="text" name="PROPERTY_PAYEDORDERS" value="" />
			</p>
			
			<p>
			Оплачено больше, чем (дополнительно)
			<input type="text" name="PROPERTY_PAYEDSUM" value="" />
			</p>*/?>

			<input type="hidden" name="request" value="Y" />
			<p><input type="submit" value="Построить таблицу"></p>
		</form>
		</center>
	<?}
} else {
	echo 'authorize';
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>