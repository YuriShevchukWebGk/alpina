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
	$url = "http://api5.alpinadigital.ru/api/v1/gift/emag/?emag_id=7190";
	$db_props = CIBlockElement::GetProperty(4, $arItems[PRODUCT_ID], array("sort" => "asc"), Array("CODE"=>"rec_for_ad"))->Fetch();

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
echo '<br />';
echo $checkbook[VALUE];
echo '<br /><br />';

$books = [94620,90651];

$data = [
    "email" => "a.marchenkov@alpinabook.ru",
	"external_id" => $books
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
print_r($data);
echo '<br />';
foreach ($data as $oned) {
	echo(get_object_vars(get_object_vars($oned)['prices'][0])['reference_price']);
	echo '<br />';
	echo explode('/', get_object_vars($oned)['shop_link'])[5];
	echo '<br />';
}
echo '</pre>';
//print_r($output['url']);
?>
