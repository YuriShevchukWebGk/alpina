<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){

$arSelect = Array("ID", "NAME", "PROPERTY_discount_on", "PROPERTY_spec_price");
$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE"=>"Y", "PROPERTY_discount_on" => 276);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>9999), $arSelect);

while($ob = $res->GetNext()) {
	echo '<pre>';
	//print_r($ob);
	echo '</pre>';
	CIBlockElement::SetPropertyValuesEx($ob['ID'], 4, array('spec_price' => '', 'discount_on' => ''));
}


$arSelect = Array("ID", "NAME", "PROPERTY_discount_on", "PROPERTY_spec_price", "SHOW_COUNTER", "PROPERTY_shows_a_day");
$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE"=>"Y", "<CATALOG_PRICE_1" => 900, "!PROPERTY_STATE" => array(21,22,23), "><PROPERTY_shows_a_day" => array(5,70));
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>15), $arSelect);

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

	CIBlockElement::SetPropertyValuesEx($ob['ID'], 4, array('spec_price' => 272, 'discount_on' => 276));
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