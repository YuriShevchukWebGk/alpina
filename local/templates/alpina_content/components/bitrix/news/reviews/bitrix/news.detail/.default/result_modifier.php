<?
if (is_array($arResult['PROPERTIES']['BOOK']) && intval($arResult['PROPERTIES']['BOOK']['VALUE']) > 0) {
    $dbBook = CIBlockElement::GetList(
        array(), 
        array('ID' => $arResult['PROPERTIES']['BOOK']['VALUE']), 
        false,                          
        false, 
        array('ID', 'CODE', 'ACTIVE', 'NAME', 'PROPERTY_SHORT_NAME', 'PROPERTY_AUTHORS', 'PROPERTY_YEAR', 'PROPERTY_COVER_TYPE', 'DETAIL_PAGE_URL', 'DETAIL_PICTURE')
    );

	if($rsBook = $dbBook->GetNextElement()) {
		$arBook = $rsBook->GetFields();
		$bookImg = CFile::ResizeImageGet($arBook['DETAIL_PICTURE'], array("width" => 250, "height" => 370), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$arResult['PROPERTIES']['BOOK'] =  array(
			'NAME' => $arBook['NAME'],
			'ACTIVE' => ($arBook['ACTIVE'] == 'Y'),
			'SHORT_NAME' => $arBook['PROPERTY_SHORT_NAME_VALUE'],
			'DETAIL_PAGE_URL' => $arBook['DETAIL_PAGE_URL'],
			'YEAR' => $arBook['PROPERTY_YEAR_VALUE'],
			'COVER_TYPE' => $arBook['PROPERTY_COVER_TYPE_VALUE'],
			'DETAIL_PICTURE' => $bookImg['src'],
		);
	}
	$title = 'Обзор на книгу "'.$arResult['PROPERTIES']['BOOK']['SHORT_NAME'].'" — Альпина Паблишер';
	$APPLICATION -> SetPageProperty("title", $title);
} else {
    unset($arResult['PROPERTIES']['BOOK']);
}


$cp = $this->__component; // объект компонента

if (is_object($cp))
{
    // добавим в arResult компонента два поля - MY_TITLE и IS_OBJECT
    $cp->arResult['TITLE'] = $arResult['PROPERTIES']['BOOK']['SHORT_NAME'];
    $cp->arResult['YEAR'] = $arResult['PROPERTIES']['BOOK']['YEAR'];
    $cp->arResult['COVER_TYPE'] = $arResult['PROPERTIES']['BOOK']['COVER_TYPE'];
    $cp->SetResultCacheKeys(array('TITLE', 'YEAR', 'COVER_TYPE'));
    // сохраним их в копии arResult, с которой работает шаблон
    //$arResult['MY_TITLE'] = $cp->arResult['MY_TITLE'];
    //$arResult['IS_OBJECT'] = $cp->arResult['IS_OBJECT'];


}

?>