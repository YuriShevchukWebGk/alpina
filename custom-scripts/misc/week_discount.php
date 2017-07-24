<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){

$arSelect = Array("ID", "NAME", "PROPERTY_discount_on", "PROPERTY_spec_price");
//$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE"=>"Y", "PROPERTY_discount_on" => 276);
$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE"=>"Y", "!PROPERTY_spec_price" => false);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>9999), $arSelect);

while($ob = $res->GetNext()) {
	echo '<pre>';
	//print_r($ob);
	echo '</pre>';
	CIBlockElement::SetPropertyValuesEx($ob['ID'], 4, array('spec_price' => '', 'discount_on' => ''));
}


$arSelect = Array("ID", "NAME", "PROPERTY_discount_on", "PROPERTY_spec_price", "SHOW_COUNTER", "PROPERTY_shows_a_day");
$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE"=>"Y", "<CATALOG_PRICE_1" => 900, "PROPERTY_STATE" => false, "><PROPERTY_shows_a_day" => array(70,110), "PROPERTY_PUBLISHER" => 24, "!ID" => array(111244,8706));
$res = CIBlockElement::GetList(Array("PROPERTY_shows_a_day"=>"rand"), $arFilter, false, Array("nPageSize"=>15), $arSelect);

$discounted = array();

while($ob = $res->GetNext()) {
	echo '<pre>';
	echo $ob["NAME"];
	echo '</pre>';

	$discounted[] = array (
			'CLASS_ID' => 'CondIBElement',
			'DATA' =>
		array (
			'logic' => 'Equal',
			'value' => $ob["ID"],
		),
	);

	CIBlockElement::SetPropertyValuesEx($ob['ID'], 4, array('spec_price' => 221, 'discount_on' => 276));
}

//Скидка добавлена к этим книгам
$manualSale = array(
	80496,
);
foreach ($manualSale as $manual) {
	CIBlockElement::SetPropertyValuesEx($manual, 4, array('spec_price' => 221, 'discount_on' => 276));

	$discounted[] = array (
		'CLASS_ID' => 'CondIBElement',
		'DATA' =>
	array (
		'logic' => 'Equal',
		'value' => $manual,
	),
	);
}


$arFields = array(
	"ACTIVE" => "Y",
	"CONDITIONS" =>  array (
		'CLASS_ID' => 'CondGroup',
		'DATA' =>
		array (
			'All' => 'OR',
			'True' => 'True',
		),
		'CHILDREN' => $discounted,
	)
);

$res = CCatalogDiscount::Update(129, $arFields);  

if (!$res) { 
    $ex = $APPLICATION->GetException();  
    $ex->GetString(); 
}

}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>