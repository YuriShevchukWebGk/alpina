<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale"); CModule::IncludeModule("catalog"); CModule::IncludeModule("iblock");
require '/home/bitrix/vendor/autoload.php';
use Mailgun\Mailgun;
if ($_POST['email']) {
	function subscribeTest($id, $mail) {
		$arSelect = Array("ID");
		$name = '99 рублей акция';
		
		$el = new CIBlockElement;
		global $USER;
		$PROP = array();
		$PROP[385] = '1';  // --- book id
		$PROP[386] = $mail; // --- subscriber E-mail
		$PROP[387] = $name;  // --- subscription description
		$PROP[388] = "3"; // --- subscription id		
		
		$arLoadProductArray = Array(
		  "MODIFIED_BY"    => $USER->GetID(), 
		  "IBLOCK_SECTION_ID" => false,         
		  "IBLOCK_ID"      => 41,
		  "PROPERTY_VALUES"=> $PROP,
		  "NAME"           => $name,
		  "ACTIVE"         => "Y",
		  ); 
		  
		$el->Add($arLoadProductArray);

		echo 'ok';
	}
	subscribeTest($_POST['book'],$_POST['email']);
}
?>