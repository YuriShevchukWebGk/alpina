<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
if ($USER->isAdmin()) {
$url = "http://api5.alpinadigital.ru/api/v1/gift/emag/?emag_id=".$_GET["bookid"];

$post_data = array(  
    "emag_id" => "4128"
);  
  
$ch = curl_init();  
  
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER,
	array(
		"Content-type: application/json",
		//"X-AD-Email: emaguser",
		"X-AD-Offer: 1",
		"X-AD-Token: c87abba6c83e2b0b04a8b67a9eddcc32"
	)
);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
// указываем, что у нас POST запрос  
curl_setopt($ch, CURLOPT_POST, 1);  
// добавляем переменные  
//curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);  
  
$output = curl_exec($ch);  
  
curl_close($ch);  

$output = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
    return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
}, $output);  

//print_r(json_decode($output));
}
$dbBasketItems = CSaleBasket::GetList(array(), array("ORDER_ID" => 69654), false, false, array());
while ($arItems = $dbBasketItems->GetNext()) {
	$url = "http://api5.alpinadigital.ru/api/v1/gift/emag/?emag_id=82384";
	$db_props = CIBlockElement::GetProperty(4, $arItems[PRODUCT_ID], array("sort" => "asc"), Array("CODE"=>"rec_for_ad"))->Fetch();

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
	// указываем, что у нас POST запрос  
	curl_setopt($ch, CURLOPT_POST, 1);  
	// добавляем переменные  
	//curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);  
	  
	$output = curl_exec($ch);  
	  
	curl_close($ch);  
	print_r($output);
	$output = get_object_vars(json_decode(preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
		return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
	}, $output))[0]);
	
	if (isset($output['found']))
		echo $arItems[PRODUCT_ID]." ".$output['url'].'<br />';
	
	if (isset($output["url"])) {
		$booksUrl .= '<a href="'.$output["url"].'" target="_blank">'.$arItems["NAME"].'</a><br />';
	}
}
$output = get_object_vars($output[0]);

$checkbook = CIBlockElement::GetProperty(4, 7831, array("sort" => "asc"), Array("CODE"=>"appstore"))->Fetch();
echo $_SERVER['REMOTE_ADDR'];
echo $checkbook[VALUE];
//print_r($output['url']);
?>
