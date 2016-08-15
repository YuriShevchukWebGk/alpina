<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
CModule::IncludeModule("main");
global $USER;

if ($USER->isAdmin()) {
	$arSelect = Array('ID',"NAME","PROPERTY_PUBLISHER");
	$arFilter = Array(	"IBLOCK_ID"=>4,
						"PROPERTY_PUBLISHER"=>array(24,25,82,26),
						"ACTIVE" => "Y",
						"!PROPERTY_STATE" => 23);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>10000), $arSelect);
	
	$continue = 0;
	$allBook = array();
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
	print_r ($allBook);
	echo '<br />';
	
	$lost = array();
	foreach ($allBook as $allString) {
		$url = "http://api5.alpinadigital.ru/api/v1/gift/emag/".$allString;
		  
		$ch = curl_init();  
		  
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
			array(
				"Content-type: application/json",
				//"X-AD-Email: c87abba6c83e2b0b04a8b67a9eddcc32",
				"X-AD-Offer: 1",
				"X-AD-Token: c87abba6c83e2b0b04a8b67a9eddcc32"
			)
		);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
		curl_setopt($ch, CURLOPT_POST, 1);  

		$output = curl_exec($ch);  
		  
		curl_close($ch);  
		
		foreach (get_object_vars(get_object_vars(json_decode($output)[0])['lost']) as $id) {
			$lost[] = $id;
		}
		
		echo '<br />';
	}
	echo '<pre>';
	print_r($lost);
	echo '</pre>';
	
	foreach ($lost as $m => $findrec) {

		if ($m > 0)
			continue;
		
		$recs = json_decode(file_get_contents('http://api.retailrocket.ru/api/1.0/Recomendation/UpSellItemToItems/50b90f71b994b319dc5fd855/'.$findrec));
		
		$ok = false;
		$i = 0;
		
		while ($ok == false) {
			$url = "http://api5.alpinadigital.ru/api/v1/gift/emag/?emag_id=".$recs[$i];
			
			$ch = curl_init();  
			  
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER,
				array(
					"Content-type: application/json",
					//"X-AD-Email: c87abba6c83e2b0b04a8b67a9eddcc32",
					"X-AD-Offer: 1",
					"X-AD-Token: c87abba6c83e2b0b04a8b67a9eddcc32"
				)
			);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
			curl_setopt($ch, CURLOPT_POST, 1);  
	  
			$output = curl_exec($ch);  
			  
			curl_close($ch);  

			$output = get_object_vars(json_decode(preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
				return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
			}, $output))[0]);
			
			if (isset($output["url"])) {
				$ok = true;
				$obEl = new CIBlockElement();
				CIBlockElement::SetPropertyValuesEx($findrec, 4, array('rec_for_ad' => $recs[$i], 'appstore' => '', 'android' => ''));
				echo $findrec."*rec*".$recs[$i]."<br />";
			}
			$i++;
			if ($i > 5) {
				$ok = true;
				$obEl = new CIBlockElement();
				CIBlockElement::SetPropertyValuesEx($findrec, 4, array('rec_for_ad' => '', 'appstore' => '', 'android' => ''));
				echo $findrec."*error*norec<br />";
			}
		}
	}
		/*$output = get_object_vars(json_decode(preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
			return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
		}, $output))[0]);
		
		if (isset($output["url"])) {
			$obEl = new CIBlockElement();
			CIBlockElement::SetPropertyValuesEx($arItems[ID], 4, array('appstore' => '231', 'android' => '232'));
			echo $arItems[ID]."*OK*".$arItems[NAME]."<br />";
		} else {

			$recs = json_decode(file_get_contents('http://api.retailrocket.ru/api/1.0/Recomendation/UpSellItemToItems/50b90f71b994b319dc5fd855/'.$arItems[ID]));
			
			$ok = false;
			$i = 0;
			
			while ($ok == false) {
				$url = "http://api5.alpinadigital.ru/api/v1/gift/emag/?emag_id=".$recs[$i];
				  
				$ch = curl_init();  
				  
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HTTPHEADER,
					array(
						"Content-type: application/json",
						"X-AD-Email: emaguser",
						"X-AD-Offer: 1",
						"X-AD-Token: cde70efb6367aa336325c95e083b458b"
					)
				);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
				curl_setopt($ch, CURLOPT_POST, 1);  
		  
				$output = curl_exec($ch);  
				  
				curl_close($ch);  

				$output = get_object_vars(json_decode(preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
					return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
				}, $output))[0]);
				
				if (isset($output["url"])) {
					$ok = true;
					$obEl = new CIBlockElement();
					CIBlockElement::SetPropertyValuesEx($arItems[ID], 4, array('rec_for_ad' => $recs[$i], 'appstore' => '', 'android' => ''));
					echo $arItems[ID]."*REC*".$arItems[NAME]."<br />";
				}
				$i++;
				if ($i > 5) {
					$ok = true;
					$obEl = new CIBlockElement();
					CIBlockElement::SetPropertyValuesEx($arItems[ID], 4, array('rec_for_ad' => '', 'appstore' => '', 'android' => ''));
					echo $arItems[ID]."*error*".$arItems[NAME]."<br />";
				}
			}
		}*/

} else {
	echo "authorize";
}
?>