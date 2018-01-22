#!/usr/bin/php
<?php
$_SERVER["DOCUMENT_ROOT"] = '/home/bitrix/www';
define('LOG_FILENAME', $_SERVER["DOCUMENT_ROOT"]."/custom-scripts/log.txt");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");


	######
	# Убираем электронные книги для всех "Нет в наличии"
	######
	
	$arFilter = Array(
		"IBLOCK_ID"=> CATALOG_IBLOCK_ID,
		"ACTIVE" => "Y",
		"PROPERTY_STATE" => 23,
		"!PROPERTY_appstore" => false
	);

	
	
	$removeEbook = CIBlockElement::GetList(Array(), $arFilter, false, false, array("ID"));
	

	while ($delEbook = $removeEbook->Fetch()) {
		CIBlockElement::SetPropertyValuesEx($delEbook["ID"], CATALOG_IBLOCK_ID, array('appstore' => '', 'android' => '', 'alpina_digital_price' => ''));
		echo $delEbook["ID"].' ';
	}
	
	
	
	######
	# Устанавливаем товары, на которые не ставим ебук
	######
	
	$noEbook = array(
		391958, //Автобизнес новой реальности
	);

	
	$arFilter = Array(
		"IBLOCK_ID"=>CATALOG_IBLOCK_ID,
		"PROPERTY_PUBLISHER"=>array(24,25,82,26),
		"ACTIVE" => "Y",
		"!PROPERTY_STATE" => 23
	);
	
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, array("ID"));
	
	$continue = 0;
	$allBook = array();
	$lost = array();
	$okbooks = array();
	
	while ($arItems = $res->Fetch()) {
		$continue++;
		if ($continue < 500) {
			if ($continue == 1) {
				$allBook[0] .= '?emag_id[]='.$arItems[ID];
			} else {
				$allBook[0] .= '&emag_id[]='.$arItems[ID];
			}
		} elseif ($continue >= 500 && $continue < 1000) {
			if ($continue == 500) {
				$allBook[1] .= '?emag_id[]='.$arItems[ID];
			} else {
				$allBook[1] .= '&emag_id[]='.$arItems[ID];
			}			
		} elseif ($continue >= 1000 && $continue < 1500) {
			if ($continue == 1000) {
				$allBook[2] .= '?emag_id[]='.$arItems[ID];
			} else {
				$allBook[2] .= '&emag_id[]='.$arItems[ID];
			}
		} else {
			if ($continue == 1500) {
				$allBook[3] .= '?emag_id[]='.$arItems[ID];
			} else {
				$allBook[3] .= '&emag_id[]='.$arItems[ID];
			}
		}
	}

	foreach ($allBook as $m=>$allString) {
		echo $m.' ';
		$url = "http://api5.alpinadigital.ru/api/v1/gift/emag/".$allString;
		  
		$ch = curl_init();  
		  
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
			array(
				"Content-type: application/json",
				//"X-AD-Email: c87abba6c83e2b0b04a8b67a9eddcc32",
				"X-AD-Offer: 1",
				"X-AD-Token: a893c81321e1693e0caad8a6a1a6077c"
			)
		);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
		curl_setopt($ch, CURLOPT_POST, 1);  

		$output = curl_exec($ch);  
		  
		curl_close($ch);  
		print_r($output);
		foreach (get_object_vars(get_object_vars(json_decode($output)[0])['lost']) as $id) {
			$lost[] = $id;
		}
	}

	$lost = array_merge($noEbook, $lost);
	
	$arFilter["!ID"] = $lost;
						
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, array("ID"));

	while ($arItems = $res->Fetch()) {
		$okbooks[] = $arItems[ID];
	}

	$okbooks = array_chunk($okbooks, 10);
	
	foreach ($okbooks as $okbook) {
		$data = [
			"email" => "a.marchenkov@alpinabook.ru",
			"external_id" => $okbook
		];
		ksort($data);

		$string_to_hash = http_build_query($data);
		$sig = md5($string_to_hash . "6c6b6101a814744178362c41d2bbc07c");

		$data['sig'] = $sig;

		$postdata = http_build_query(
			$data
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api5.alpinadigital.ru/api/v2/b2b/books?" . $postdata);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'X-Auth-Token: a893c81321e1693e0caad8a6a1a6077c',
		]);
		$data = curl_exec($ch);
		curl_close($ch);
		$data = json_decode(preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
				return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
			}, $data));

		foreach ($data as $oned) {
			if (get_object_vars($oned)['is_active'] == 1) {
				$bookid = get_object_vars($oned)['external_id'];
				$bookdid = get_object_vars($oned)['id'];
				$bookprice = get_object_vars(get_object_vars($oned)['prices'][0])['reference_price'];
				CIBlockElement::SetPropertyValuesEx($bookid, CATALOG_IBLOCK_ID, array('appstore' => '231', 'android' => '232', 'alpina_digital_ids' => $bookdid, 'alpina_digital_price' => $bookprice));
			} elseif ($bookid != 186046 && $bookid != 372526) {
				CIBlockElement::SetPropertyValuesEx($bookid, CATALOG_IBLOCK_ID, array('appstore' => '', 'android' => '', 'alpina_digital_ids' => '', 'alpina_digital_price' => ''));    
			}
		}
	}

	foreach ($lost as $findrec) {
        if ($findrec != 186046 && $findrec != 372526) {
		    CIBlockElement::SetPropertyValuesEx($findrec, CATALOG_IBLOCK_ID, array('rec_for_ad' => '', 'appstore' => '', 'android' => ''));
        }
	}
	echo 1;
	
	AddMessage2Log('Скрипт выполнен cron', 'checkbooks.php');
?>