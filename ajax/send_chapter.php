<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale"); CModule::IncludeModule("catalog"); CModule::IncludeModule("iblock");
if ($_POST['email']) {
	$email = $_POST['email'];
	$book = $_POST['book'];
	
	$book = CIBlockElement::GetList (array(), array("IBLOCK_ID" => 4, "ID" => $_POST['book']), false, false, array("ID", "NAME")) -> Fetch();
	$link = CIBlockElement::GetProperty(4, $_POST['book'], array("sort" => "asc"), Array("CODE"=>"glava"))->Fetch();
	$link = CFile::GetPath($link['VALUE']);
	
	$mailFields = array(
		"EMAIL"=> $email,
		"LINK" => $link,
		"BOOK" => $book['NAME']
	);
	CEvent::Send("SEND_CHAPTER", "s1", $mailFields, "N");
	echo 'ok';
	function subscribeTest($id, $mail, $name) {
		$arSelect = Array("ID");
		$arFilter = Array("IBLOCK_ID" => 41,"ACTIVE" => "Y","PROPERTY_SUB_EMAIL" => $mail);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 9999), $arSelect);
		
		if($ob = $res -> GetNextElement()) { //
			
		} else {	
			$el = new CIBlockElement;
			global $USER;
			$PROP = array();
			$PROP[385] = '1';  // --- book id
			$PROP[386] = $mail; // --- subscriber E-mail
			$PROP[387] = 'Глава из книги '.$name;  // --- subscription description
			$PROP[388] = "3"; // --- subscription id		
			
			$arLoadProductArray = Array(
			  "MODIFIED_BY"    => $USER->GetID(), 
			  "IBLOCK_SECTION_ID" => false,         
			  "IBLOCK_ID"      => 41,
			  "PROPERTY_VALUES"=> $PROP,
			  "NAME"           => 'Глава из книги '.$name,
			  "ACTIVE"         => "Y",         
			  ); 
			  
			$el->Add($arLoadProductArray);
		}
	}

	subscribeTest($_POST['book'],$_POST['email'], $book['NAME']);
}
?>