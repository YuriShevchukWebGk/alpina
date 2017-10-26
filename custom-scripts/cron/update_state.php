#!/usr/bin/php
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

	if (AddMessage2Log('Скрипт выполнен cron', 'update_state.php'))
	
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("catalog");
    CModule::IncludeModule("main");
	
	/* I Обновляем бестселлеры */
	$stringRecs = file_get_contents('http://api.retailrocket.ru/api/1.0/Recomendation/ItemsToMain/50b90f71b994b319dc5fd855/');
	//$recsArray = json_decode($stringRecs);
	$recsArray = array();
	
	$bestsellers = array();

	$arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, "PROPERTY_best_seller"=>BESTSELLER_BOOK_XML_ID);
	$res = CIBlockElement::GetList(Array(), $arFilter);
	while ($ob = $res->GetNextElement()) {
		$arProps = $ob->GetProperties();
		$arFields = $ob->GetFields();
		$bestseller = array('name' => $arFields[NAME], 'id' => $arFields[ID], 'old' => 1, 'new' => 0);
		$bestsellers[] = $bestseller;
		CIBlockElement::SetPropertyValuesEx($arFields[ID], CATALOG_IBLOCK_ID, array('best_seller' => ''));
	}
	
	$arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, "ACTIVE"=>"Y", "!PROPERTY_STATE"=>23, ">PROPERTY_page_views_ga" => 45);
	$res = CIBlockElement::GetList(Array("PROPERTY_DESIRABILITY" => "DESC"), $arFilter, false, Array("nPageSize"=>50));
	while ($ob = $res->GetNext()){
		$recsArray[] = $ob["ID"];
	}
	$recsArray = array_unique($recsArray);
	echo "<br />";	

	echo "<b>Информация о бестселлерах</b><br />";
	if (!empty($recsArray)) {
		$arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, "ID"=>$recsArray);
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
			CIBlockElement::SetPropertyValuesEx($arFields[ID], CATALOG_IBLOCK_ID, array('best_seller' => BESTSELLER_BOOK_XML_ID));
			$key++;
		}
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
	
	/* II Обновляем новинки */
	echo "<b>Информация о новинках</b><br /><br />";
	$arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, "PROPERTY_STATE"=>NEW_BOOK_STATE_XML_ID);
	$res = CIBlockElement::GetList(Array(), $arFilter);
	while ($ob = $res->GetNext()){
		CIBlockElement::SetPropertyValuesEx($ob[ID], CATALOG_IBLOCK_ID, array('STATE' => ''));

	}
	
	$arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, ">PROPERTY_STATEDATE" => date('Y-m-d', strtotime("-60 days")), "!PROPERTY_reissue" => 218, "PROPERTY_STATE" => false);
	$res = CIBlockElement::GetList(Array(), $arFilter);
	while ($ob = $res->GetNext()){
		CIBlockElement::SetPropertyValuesEx($ob[ID], CATALOG_IBLOCK_ID, array('STATE' => NEW_BOOK_STATE_XML_ID));
	}
	echo "Finished";
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>