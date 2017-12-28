<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if ($_POST["userid"] != '' && $_POST["basketid"] != '') {

	$arSelect = array(
		"ID",
	);

	$arFilter = array(
		"IBLOCK_ID" => 75,
		//"ACTIVE" => "Y",
		"NAME" => $_POST["userid"]
	);

	$carts = CIBlockElement::GetList(Array("ID" => "DESC"), $arFilter, false, array(), $arSelect);

	if ($cart = $carts->GetNext()) {
		
		$el = new CIBlockElement;
		
		CIBlockElement::SetPropertyValuesEx($cart[ID], 75, array('basket_user_id' => $_POST["basketid"]));
		$el->Update($cart[ID], Array('TIMESTAMP_X' => true));
	} else {

		$el = new CIBlockElement;
		$PROP = array();
		$PROP[850] = $_POST["basketid"];
		
		$arLoadProductArray = Array(
			"MODIFIED_BY"    => 15,
			"IBLOCK_SECTION" => false,
			"IBLOCK_ID"      => 75,
			"PROPERTY_VALUES"=> $PROP,
			"NAME"           => $_POST["userid"],
			"ACTIVE"         => "Y"
		);
		
		$el->Add($arLoadProductArray);
	}
}

?>