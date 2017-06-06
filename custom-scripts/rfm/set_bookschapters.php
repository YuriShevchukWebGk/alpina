<?
set_time_limit(0);
ini_set('max_execution_time', 0);
$_SERVER["DOCUMENT_ROOT"] = '/home/bitrix/www';
define('LOG_FILENAME', $_SERVER["DOCUMENT_ROOT"]."/custom-scripts/log.txt");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
include($_SERVER["DOCUMENT_ROOT"]."/custom-scripts/rfm/functions.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");

$chaptersSelect = array(
	"ID",
	"NAME",
	"PROPERTY_BOOK_ID",
	"PROPERTY_SUB_EMAIL",
	"TIMESTAMP_X"
);

$chaptersFilter = array(
	"IBLOCK_ID" => 41,
	">=TIMESTAMP_X" => date('d.m.Y H:i:s', strtotime('-6 hours')),
	"PROPERTY_BOOK_ID" => 1
);


$chapters = CIBlockElement::GetList(Array("ID" => "DESC"), $chaptersFilter, false, array(), $chaptersSelect);

$countMax = CIBlockElement::GetList(['ID' => 'ASC'], $filter, [],    false, ['ID']);
//echo $countMax;

while ($chapter = $chapters -> GetNextElement()) {
	
	$chapter = $chapter->GetFields();
	
	if (substr($chapter["NAME"],0, 5) != 'Глава')
		continue;
	
	$bookName = substr($chapter["NAME"], 15);
	
	$booksSelect = array(
		"ID",
		"NAME"
	);
	
	//echo $bookName;
	$booksFilter = array(
		"IBLOCK_ID" => 4,
		"ACTIVE" => "Y",
		"NAME" => $bookName		
	);


	$books = CIBlockElement::GetList(Array("ID" => "DESC"), $booksFilter, false, array(), $booksSelect);	
	
	if ($book = $books -> GetNextElement()) {
		$book = $book->GetFields();
		//echo $book["NAME"];
	} else {
		//echo 'error';
	}
	
	$rfmSelect = array(
		"ID",
		"NAME",
		"PROPERTY_BOOKSCHAPTERS"
	);

	$rfmFilter = array(
		"IBLOCK_ID" => 67,
		"ACTIVE" => "Y",
		"NAME" => strtolower($chapter["PROPERTY_SUB_EMAIL_VALUE"])
	);

	$rfm = CIBlockElement::GetList(Array("ID" => "DESC"), $rfmFilter, false, array(), $rfmSelect);

	if ($contact = $rfm -> GetNextElement()) {
		$contact = $contact->GetFields();
		$res1 = CIBlockElement::GetByID($contact[ID]);
		
		$obRes1 = $res1->GetNextElement();
		$ar_res1 = $obRes1->GetProperties();
		print_r($contact);
		if (!empty($ar_res1[BOOKSCHAPTERS][VALUE])) {
			echo 1;
			array_push($ar_res1[BOOKSCHAPTERS][VALUE], $book["ID"]);
			CIBlockElement::SetPropertyValuesEx($contact[ID], 67, array('BOOKSCHAPTERS' => array_unique($ar_res1[BOOKSCHAPTERS][VALUE])));
		} else {
			echo 2;
			CIBlockElement::SetPropertyValuesEx($contact[ID], 67, array('BOOKSCHAPTERS' => $book["ID"]));
		}
		
		$el = new CIBlockElement;
		
		if ($el->Update($contact[ID], Array('TIMESTAMP_X' => true)))
			echo 'ok';
	} else {

		$el = new CIBlockElement;
		$PROP = array();
		$PROP[801] = $book["ID"];
		$PROP[800] = 916;
		
		$arLoadProductArray = Array(
			"MODIFIED_BY"    => 15,
			"IBLOCK_SECTION" => false,
			"IBLOCK_ID"      => 67,
			"PROPERTY_VALUES"=> $PROP,
			"NAME"           => strtolower($chapter["PROPERTY_SUB_EMAIL_VALUE"]),
			"ACTIVE"         => "Y"
		);
		
		if ($el->Add($arLoadProductArray))
			echo 1;
		else
			echo 2;
	}
	
	echo '<br />';
}

echo '<br />done!';

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>