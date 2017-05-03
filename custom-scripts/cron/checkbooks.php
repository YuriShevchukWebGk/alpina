#!/usr/bin/php
<?php
$_SERVER["DOCUMENT_ROOT"] = '/home/bitrix/www';
define('LOG_FILENAME', $_SERVER["DOCUMENT_ROOT"]."/custom-scripts/log.txt");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
AddMessage2Log('Скрипт выполнен cron', 'checkbooks.php');

CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
CModule::IncludeModule("main");
global $USER;


	$arSelect = Array('ID',"NAME","PROPERTY_PUBLISHER");
	$arFilter = Array(	"IBLOCK_ID"=>4,
						"PROPERTY_PUBLISHER"=>array(24,25,82,26),
						"ACTIVE" => "Y",
						"!PROPERTY_STATE" => 23);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>10000), $arSelect);
	
	$continue = 0;
	$allBook = array();
	$lost = array();
	$okbooks = array();
	
	while ($arItems = $res->Fetch()) {
		$continue++;
		if ($continue < 500) {
			if ($continue == 1) {
				$allBook[0] .= '?emag_id[]='.$arItems[ID];
				//print_r($arItems);
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
	echo '<br />';
	//print_r ($allBook);
	echo '<br />';
	
	foreach ($allBook as $m=>$allString) {
		echo $m.'<br />';
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
		
		echo '<br />';
	}
	echo '<pre>';
	//print_r($lost);
	echo '</pre>';
	
	$arSelect = Array('ID',"NAME","PROPERTY_PUBLISHER");
	$arFilter = Array(	"IBLOCK_ID"=>4,
						"PROPERTY_PUBLISHER"=>array(24,25,82,26),
						"ACTIVE" => "Y",
						"!PROPERTY_STATE" => 23,
						"!ID" => $lost);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>10000), $arSelect);

	while ($arItems = $res->Fetch()) {
		$okbooks[] = $arItems[ID];
		
		$obEl = new CIBlockElement();
		CIBlockElement::SetPropertyValuesEx($arItems[ID], 4, array('appstore' => '231', 'android' => '232'));
		//echo $arItems[ID]."*1**".$arItems[NAME]."<br />";	
	}
	
	echo '<pre>';
	//print_r($okbooks);
	echo '</pre>';	
	
	$books = [5717];
	
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
			
		echo '<pre>';
		
		echo '<br />';
		foreach ($data as $oned) {
			$bookid = get_object_vars($oned)['external_id'];;
			$bookdid = get_object_vars($oned)['id'];
			$bookprice = get_object_vars(get_object_vars($oned)['prices'][0])['reference_price'];
			print_r($oned);
			$obEl = new CIBlockElement();
			CIBlockElement::SetPropertyValuesEx($bookid, 4, array('appstore' => '231', 'android' => '232', 'alpina_digital_ids' => $bookdid, 'alpina_digital_price' => $bookprice));
		}
	}

	/*foreach ($lost as $m => $findrec) {

		//if ($m > 10) continue;
		
		CIBlockElement::SetPropertyValuesEx($findrec, 4, array('rec_for_ad' => $recs[$i], 'appstore' => '', 'android' => ''));
		$name = CIBlockElement::GetByID($findrec)->Fetch();
		
		$recs = json_decode(file_get_contents('http://api.retailrocket.ru/api/1.0/Recomendation/UpSellItemToItems/50b90f71b994b319dc5fd855/'.$findrec));
		
		$ok = false;
		$i = 0;
		
		while ($ok == false) {

			if (in_array($recs[$i], $okbooks)) {
				$ok = true;
				$obEl = new CIBlockElement();
				CIBlockElement::SetPropertyValuesEx($findrec, 4, array('rec_for_ad' => $recs[$i], 'appstore' => '', 'android' => ''));
				$obElement = CIBlockElement::GetByID($recs[$i])->Fetch();
				echo $findrec."*2*".$recs[$i]."*".$name['NAME']."*".$obElement['NAME']."<br />";
			}
			$i++;
			if ($i > 5 && !$ok) {
				$ok = true;
				$obEl = new CIBlockElement();
				CIBlockElement::SetPropertyValuesEx($findrec, 4, array('rec_for_ad' => '', 'appstore' => '', 'android' => ''));
				echo $findrec."*3*norec*".$name['NAME']."<br />";
			}
		}
	}*/
	
	/*$manual = array(
		array('id'=>'7099','rec'=>'6990'),
		array('id'=>'7127','rec'=>'6908'),
		array('id'=>'8056','rec'=>'66516'),
		array('id'=>'8058','rec'=>'7932'),
		array('id'=>'8060','rec'=>'7996'),
		array('id'=>'8062','rec'=>'7992'),
		array('id'=>'8066','rec'=>'7833'),
		array('id'=>'8070','rec'=>'5563'),
		array('id'=>'8129','rec'=>'7611'),
		array('id'=>'8182','rec'=>'7653'),
		array('id'=>'8184','rec'=>'6013'),
		array('id'=>'8200','rec'=>'8272'),
		array('id'=>'8360','rec'=>'8034'),
		array('id'=>'8368','rec'=>'8151'),
		array('id'=>'8370','rec'=>'8242'),
		array('id'=>'8388','rec'=>'7377'),
		array('id'=>'60917','rec'=>'8024'),
		array('id'=>'7954','rec'=>'8228'),
		array('id'=>'7994','rec'=>'8228'),
		array('id'=>'8416','rec'=>'5559'),
		array('id'=>'5509','rec'=>'7978'),
		array('id'=>'66427','rec'=>'6449'),
		array('id'=>'8068','rec'=>'5677'),
		array('id'=>'8694','rec'=>'7722'),
		array('id'=>'7956','rec'=>'6449'),
		array('id'=>'6867','rec'=>'6831'),
		array('id'=>'7105','rec'=>'6449'),
		array('id'=>'8840','rec'=>'8244'),
		array('id'=>'7131','rec'=>'8314'),
		array('id'=>'8304','rec'=>'8192'),
		array('id'=>'7123','rec'=>'8032'),
		array('id'=>'8390','rec'=>'8155'),
		array('id'=>'8362','rec'=>'8030'),
		array('id'=>'7117','rec'=>'7897'),
		array('id'=>'7671','rec'=>'7637'),
		array('id'=>'55606','rec'=>'8208'),
		array('id'=>'55602','rec'=>'8208'),
		array('id'=>'65411','rec'=>'8208'),
		array('id'=>'65631','rec'=>'8208'),
		array('id'=>'65627','rec'=>'8208'),
		array('id'=>'8780','rec'=>'8208'),
		array('id'=>'66407','rec'=>'8208'),
		array('id'=>'8776','rec'=>'8208'),
		array('id'=>'6972','rec'=>'8556'),
		array('id'=>'8574','rec'=>'7633'),
		array('id'=>'55537','rec'=>'8528'),
		array('id'=>'55539','rec'=>'8528'),
		array('id'=>'8240','rec'=>'8013'),
		array('id'=>'8220','rec'=>'8582'),
		array('id'=>'8624','rec'=>'8756'),
		array('id'=>'60919','rec'=>'8756'),
		array('id'=>'8764','rec'=>'8756'),
		array('id'=>'8754','rec'=>'8756'),
		array('id'=>'60927','rec'=>'8756'),
		array('id'=>'75560','rec'=>'8756'),
		array('id'=>'55604','rec'=>'8208'),
		array('id'=>'8638','rec'=>'8208'),
		array('id'=>'8636','rec'=>'8208'),
		array('id'=>'8640','rec'=>'8208'),
		array('id'=>'8644','rec'=>'8208'),
		array('id'=>'8642','rec'=>'8208'),
		array('id'=>'8632','rec'=>'8208'),
		array('id'=>'60897','rec'=>'8208'),
		array('id'=>'8782','rec'=>'8208'),
		array('id'=>'60909','rec'=>'8208'),
		array('id'=>'66411','rec'=>'8208'),
		array('id'=>'76724','rec'=>'69011'),
		array('id'=>'66432','rec'=>'8139'),
		array('id'=>'81012','rec'=>'5595'),
		array('id'=>'8784','rec'=>'8208'),
		array('id'=>'8434','rec'=>'8756'),
		array('id'=>'82267','rec'=>'8208'),
		array('id'=>'82271','rec'=>'8208'),
		array('id'=>'82276','rec'=>'8208'),
		array('id'=>'82280','rec'=>'8208'),
		array('id'=>'82282','rec'=>'8208'),
		array('id'=>'82371','rec'=>'8528'),
		array('id'=>'82375','rec'=>'8426'),
		array('id'=>'82379','rec'=>'6992'),
		array('id'=>'82390','rec'=>'66437'),
		array('id'=>'82482','rec'=>'5671'),
		array('id'=>'82547','rec'=>'8436'),
		array('id'=>'82852','rec'=>'7996'),
		array('id'=>'80012','rec'=>'7712'),
		array('id'=>'83116','rec'=>'8175'),
		array('id'=>'83139','rec'=>'75330'),
		array('id'=>'8720','rec'=>'8314'),
		array('id'=>'76820','rec'=>'8008'),
		array('id'=>'83605','rec'=>'8280'),
		array('id'=>'73704','rec'=>'8151'),
		array('id'=>'83143','rec'=>'8426'),
		array('id'=>'8778','rec'=>'8208'),
		array('id'=>'82257','rec'=>'7744'),
		array('id'=>'82021','rec'=>'5973'),
		array('id'=>'81365','rec'=>'79730'),
		array('id'=>'8522','rec'=>'8093'),
		array('id'=>'80484','rec'=>'8125'),
		array('id'=>'89045','rec'=>'8722'),
		array('id'=>'78987','rec'=>'7911'),

	);
	$manual = array();
	
	foreach ($manual as $addrec) {
		$obEl = new CIBlockElement();
		CIBlockElement::SetPropertyValuesEx($addrec['id'], 4, array('rec_for_ad' => $addrec['rec'], 'appstore' => '', 'android' => ''));
		$name = CIBlockElement::GetByID($addrec['id'])->Fetch();
		$obElement = CIBlockElement::GetByID($addrec['rec'])->Fetch();
		echo $addrec['id']."*4*".$addrec['rec']."*".$name['NAME']."*".$obElement['NAME']."<br />";
	}*/
?>