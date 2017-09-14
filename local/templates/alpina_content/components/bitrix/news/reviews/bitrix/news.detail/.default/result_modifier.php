<?
if (is_array($arResult['PROPERTIES']['BOOK']) && intval($arResult['PROPERTIES']['BOOK']['VALUE']) > 0) {
    $dbBook = CIBlockElement::GetList(
        array(), 
        array('ID' => $arResult['PROPERTIES']['BOOK']['VALUE']), 
        false,                          
        false, 
        array('ID', 'CODE', 'ACTIVE', 'NAME', 'PROPERTY_SHORT_NAME', 'PROPERTY_AUTHORS', 'DETAIL_PAGE_URL', 'DETAIL_PICTURE')
    );

	if($rsBook = $dbBook->GetNextElement()) {
		$arBook = $rsBook->GetFields();
		$bookImg = CFile::ResizeImageGet($arBook['DETAIL_PICTURE'], array("width" => 250, "height" => 370), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$arResult['PROPERTIES']['BOOK'] =  array(
			'NAME' => $arBook['NAME'],
			'ACTIVE' => ($arBook['ACTIVE'] == 'Y'),
			'SHORT_NAME' => $arBook['PROPERTY_SHORT_NAME_VALUE'],
			'DETAIL_PAGE_URL' => $arBook['DETAIL_PAGE_URL'],
			'DETAIL_PICTURE' => $bookImg['src']
		);
	}
	$title = 'Обзор на книгу "'.$arResult['PROPERTIES']['BOOK']['SHORT_NAME'].'" — Альпина Паблишер';
	$APPLICATION -> SetPageProperty("title", $title);
} else {
    unset($arResult['PROPERTIES']['BOOK']);
}
?>