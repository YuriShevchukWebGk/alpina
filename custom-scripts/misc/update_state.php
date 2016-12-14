<?
$_SERVER["DOCUMENT_ROOT"] = '/home/bitrix/www';
//define("NO_KEEP_STATISTIC", true);
//define("NOT_CHECK_PERMISSIONS", true);
//define('SITE_ID', 's1');
//$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
//set_time_limit(0);
//define("LANG", "ru"); 
define('LOG_FILENAME', $_SERVER["DOCUMENT_ROOT"]."/custom-scripts/log.txt");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

	if (AddMessage2Log('Скрипт выполнен', 'update_state.php'))
	
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("catalog");
    CModule::IncludeModule("main");
	
	/* I Обновляем бестселлеры */
	$stringRecs = file_get_contents('http://api.retailrocket.ru/api/1.0/Recomendation/ItemsToMain/50b90f71b994b319dc5fd855/');
	$recsArray = json_decode($stringRecs);	
	
	$bestsellers = array();

	$arFilter = Array("IBLOCK_ID"=>4, "PROPERTY_best_seller"=>285);
	$res = CIBlockElement::GetList(Array(), $arFilter);
	while ($ob = $res->GetNextElement()){
		$arProps = $ob->GetProperties();
		$arFields = $ob->GetFields();
		$bestseller = array('name' => $arFields[NAME], 'id' => $arFields[ID], 'old' => 1, 'new' => 0);
		$bestsellers[] = $bestseller;
		CIBlockElement::SetPropertyValuesEx($arFields[ID], 4, array('best_seller' => ''));
	}
	echo "<br />";	

	echo "<b>Информация о бестселлерах</b><br />";
	if (!empty($recsArray)) {
		$arFilter = Array("IBLOCK_ID"=>4, "ID"=>$recsArray);
		$res = CIBlockElement::GetList(Array(), $arFilter);
		$key = 0;
		while ($ob = $res->GetNextElement()){
			$arProps = $ob->GetProperties();
			$arFields = $ob->GetFields();
			$return = true;
			foreach ($bestsellers as $key => $best) {
				if (in_array($arFields[ID], $best)) {
					$bestsellers[$key]['new'] = 1;
					$return = false;
				}
			}

			if ($return) {
				$bestsellers[] = array('name' => $arFields[NAME], 'id' => $arFields[ID], 'new' => 1, 'old' => 0);
			}
			CIBlockElement::SetPropertyValuesEx($arFields[ID], 4, array('best_seller' => '285'));
			$key++;
		}
		CIBlockElement::SetPropertyValuesEx(60919, 4, array('best_seller' => '285')); //делаем бестом Города мечты
	} else {
		echo 'Бестселлеры не получены. Проверить retailrocket';
	}
	echo "<br />";	
	
	foreach ($bestsellers as $nom => $book) {
		if ($book['new'] == 1 && $book['old'] == 0) {
			$color = "green";
			$weight = "700";
		} elseif ($book['new'] == 0 && $book['old'] == 1) {
			$color = "red";
			$weight = "700";
		} else {
			$color = "black";
			$weight = "400";
		}
		echo "<span style='font-weight:".$weight."; color:".$color."'>".($nom+1)." - ".$book[name]."</span><br />";
	}
	echo "<br />";
	/* II Удаляем старые книги из новинок */
	
	echo "<b>Информация о новинках</b><br /><br />";
	$arFilter = Array("IBLOCK_ID"=>4, "PROPERTY_STATE"=>'21');
	$res = CIBlockElement::GetList(Array(), $arFilter);
	while ($ob = $res->GetNextElement()){
		$arProps = $ob->GetProperties();
		$arFields = $ob->GetFields();
	
		if ((time() - strtotime($arProps['STATEDATE']['VALUE']))/86400 > 60) {
			$obEl = new CIBlockElement();
			CIBlockElement::SetPropertyValuesEx($arFields[ID], 4, array('STATE' => ''));
			echo '<b><span style="color:red">old - </b>';
		}
		else
			echo '<b><span style="color:green">new - </b>';
		echo $arFields[NAME];
		echo "</span><br />";
	}
	echo "<br />";	
	
	$arEventFields = array(
		"ORDER_USER" => "Александр",
		"REPORT" => 'Скрипт выполнен автоматом'
	);				
	//CEvent::Send("SEND_TRIGGER_REPORT", "s1", $arEventFields,"N");	
	
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>