<?  $_SERVER["DOCUMENT_ROOT"] = "/var/www/alpinabook.ru/html";
    $DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
    define("NO_KEEP_STATISTIC", true);
    define("NOT_CHECK_PERMISSIONS", true);
    set_time_limit(0);
    //define("LANG", "ru");         
//define("NO_KEEP_STATISTIC", true);
//define("NOT_CHECK_PERMISSIONS", true);
//define('SITE_ID', 's1');
//$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
//set_time_limit(0);
//define("LANG", "ru"); 
define('LOG_FILENAME', $_SERVER["DOCUMENT_ROOT"]."/custom-scripts/log.txt");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>
<?
    // -- getting template for our criteo products xml file
    $dirPath = $_SERVER['DOCUMENT_ROOT']."/criteo/";
    $xml = simplexml_load_file($dirPath."criteo_template_g.xml");

    $arSelect = Array('ID', 'NAME', 'DETAIL_PICTURE', 'DETAIL_PAGE_URL', 'PREVIEW_TEXT', 'IBLOCK_SECTION_ID', 'PROPERTY_PUBLISHER', 'PROPERTY_age_group', 'PROPERTY_ISBN', 'PROPERTY_STATE');
    $arFilter = Array("IBLOCK_ID" => 4, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y",'PROPERTY_STATE'=>Array(false,21));
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 99999), $arSelect);
	
	$company = $xml->addChild('channel');
	$company->addChild('title', 'Интернет-магазин «Альпина Паблишер');
	$company->addChild('link', 'https://www.alpinabook.ru/');
	$company->addChild('description', 'Интернет-магазин издательства «Альпина Паблишер»');
	
    while ($ob = $res -> GetNextElement()) {
        $arFields = $ob -> GetFields();
        $imagePath = "https://www.alpinabook.ru".CFile::GetPath($arFields['DETAIL_PICTURE']);
        $productURL = 'https://www.alpinabook.ru'.$arFields['DETAIL_PAGE_URL'];
        $itemPriceList = GetCatalogProductPriceList($arFields['ID'], array(), array());
        $itemPrice = $itemPriceList[0]['PRICE'];
        $resSection = CIBlockSection::GetByID($arFields["IBLOCK_SECTION_ID"]);
        if ($ar_res = $resSection -> GetNext()) {
            $itemCategoryName = $ar_res['NAME'];
        }
        
        if ($arFields['PROPERTY_AGE_GROUP_VALUE'] == 0) {
            $arFields['PROPERTY_AGE_GROUP_VALUE'] = 0;
        }
		echo '<pre>';print_r(str_replace($healthy, "", $arFields['NAME']));echo 'раз</pre>';
        // -- add new element to products collection
		
		$isbn = preg_replace('/-/', '', $arFields['PROPERTY_ISBN_VALUE']);

        $product = $company->addChild('item');
        $product->addChild('id', $arFields['ID'], 'http://base.google.com/ns/1.0');
        $product->addChild('title', html_entity_decode($arFields['NAME']), 'http://base.google.com/ns/1.0');
        $product->addChild('image_link', $imagePath, 'http://base.google.com/ns/1.0');
        $product->addChild('link', $productURL, 'http://base.google.com/ns/1.0');
        $product->addChild('description', html_entity_decode(strip_tags($arFields['PREVIEW_TEXT'])), 'http://base.google.com/ns/1.0');
        $product->addChild('price', $itemPrice, 'http://base.google.com/ns/1.0');
		$product->addChild('availability', 'in stock', 'http://base.google.com/ns/1.0');
        $product->addChild('google_product_category', '784', 'http://base.google.com/ns/1.0');
        $product->addChild('brand', $arFields['PROPERTY_PUBLISHER_VALUE'], 'http://base.google.com/ns/1.0');
		$product->addChild('product_type', $itemCategoryName, 'http://base.google.com/ns/1.0');
		$product->addChild('condition', 'new', 'http://base.google.com/ns/1.0');

		if ($arFields['PROPERTY_STATE_ENUM_ID'] == 21)
			$product->addChild('state', 'new');
		else
			$product->addChild('state', 'old');
		
		if (!empty($isbn))
			$product->addChild('gtin', $isbn, 'http://base.google.com/ns/1.0');
    }

    $xml->asXML($dirPath.'criteo_g.xml');

?>