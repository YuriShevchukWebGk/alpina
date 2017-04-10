<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
global $APPLICATION;
// парсим данные формы
parse_str($_POST['data'], $certificate_data);
$return = array(
	"status" => "",
	"data"   => ""
);

if ($certificate_data['certificate_quantity'] > 0) {
	$element_object = new CIBlockElement();
	
	$properties = array(
		"BUYER_TYPE"    => $_POST['person_type'] == "natural_person" ? CERTIFICATE_NATURAL_PERSON_PROPERTY_ID : CERTIFICATE_LEGAL_PERSON_PROPERTY_ID,
		"CERT_QUANTITY" => $certificate_data['certificate_quantity']
	);

	switch ($_POST['person_type']) {
		case "natural_person":
			$properties["NATURAL_NAME"] = $certificate_data['natural_name'];
			$properties["NATURAL_EMAIL"] = $certificate_data['natural_email'];
			break;
			
		case "legal_person":
			$properties["LEGAL_NAME"] = $certificate_data['legal_name'];
			$properties["LEGAL_EMAIL"] = $certificate_data['legal_email'];
			$properties["BIK"] = $certificate_data['bik'];
			$properties["INN"] = $certificate_data['inn'];
			$properties["CORRESPONDED_ACCOUNT"] = $certificate_data['corresponded_account'];
			$properties["KPP"] = $certificate_data['kpp'];
			$properties["BANK_TITLE"] = $certificate_data['bank_title'];
			$properties["SETTLEMENT_ACCOUNT"] = $certificate_data['settlement_account'];
			$properties["LEGAL_ADDRESS"] = $certificate_data['legal_address'];
			break;
	}
	
	// общие поля
	$fields = array(
        "ACTIVE"          => "N",
        "NAME"            => $certificate_data['certificate_name'],
        "IBLOCK_ID"       => CERTIFICATE_IBLOCK_ID,
        "XML_ID"          => $certificate_data['basket_rule'],
		"PROPERTY_VALUES" => $properties
    );
	
	if ($product_id = $element_object->Add($fields)) {
		$return['status'] = "success";
		$return['data'] = $product_id;
	} else {
	  	$return['status'] = "error";
		$return['data'] = $element_object->LAST_ERROR;
	}
	
	echo json_encode($return);
	
	if ($product_id && $_POST['person_type'] == "legal_person") {
		CertificateMail::newLegalPersonOrder($product_id);
	}
}                          
?>                     