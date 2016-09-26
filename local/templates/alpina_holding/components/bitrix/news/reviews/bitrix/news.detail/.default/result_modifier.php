<?
function getAuthorsPrint($AUTHOR_ID, $reviews_link = false) 
{
    $rsElements = CIBlockElement::GetList(
        array("SORT"=>"ASC"), 
        array('IBLOCK_ID' => array(26, 5), 'ID'=> $AUTHOR_ID), 
        false, 
        false,                
        array('PREVIEW_PICTURE', 'PREVIEW_TEXT', 'PROPERTY_FIRST_NAME', 'PROPERTY_LAST_NAME', 'DETAIL_PAGE_URL')
    );
    $rsElements->SetUrlTemplates();
    
    $print_value = '';
    while($rsAuthor = $rsElements->GetNextElement()) {
        $arAuthor = $rsAuthor->GetFields();
        $author_title = str_replace('"','\'', CFile::ShowImage($arAuthor['PREVIEW_PICTURE'], 70, 70, "border=0 align=left", "", false) . (!empty($arAuthor['PREVIEW_TEXT']) ? $arAuthor['PREVIEW_TEXT'] : substr(trim(strip_tags($arAuthor['PREVIEW_TEXT'])), 0, 170)));
        $print_value .= '&nbsp;<span class="author_link' . 
            (!empty($author_title) ? ' author_tooltip_detail" title="' . $author_title . '"' : ''). 
            '"><a href="' . ($reviews_link ?  '/books/reviews_list.php?author=' . $arAuthor['ID'] : $arAuthor['DETAIL_PAGE_URL']) . '">' . $arAuthor['PROPERTY_FIRST_NAME_VALUE'] . ' ' . 
            $arAuthor['PROPERTY_LAST_NAME_VALUE'] . '</a></span>, ';        
    }
    return substr($print_value, 0, -2);
}                                           


if (is_array($arResult['PROPERTIES']['BOOK']) && intval($arResult['PROPERTIES']['BOOK']['VALUE']) > 0) {
    $dbBook = CIBlockElement::GetList(
        array(), 
        array('ID' => $arResult['PROPERTIES']['BOOK']['VALUE']), 
        false,                          
        false, 
        array('ID', 'CODE', 'ACTIVE', 'NAME', 'PROPERTY_SHORT_NAME', 'PROPERTY_AUTHORS', 'DETAIL_PAGE_URL')
    );
    if ($dbBook->SelectedRowsCount() > 0) {
        $arBookAuthors = array();
        $dbBook->SetUrlTemplates();
        while($rsBook = $dbBook->GetNextElement()) {
            $arBook = $rsBook->GetFields();
            $arBookAuthors[] = $arBook['PROPERTY_AUTHORS_VALUE'];
        }
        
        
        $arResult['PROPERTIES']['BOOK'] =  array(
            'NAME' => $arBook['NAME'],
            'ACTIVE' => ($arBook['ACTIVE'] == 'Y'),
            'SHORT_NAME' => $arBook['PROPERTY_SHORT_NAME_VALUE'],
            'DETAIL_PAGE_URL' => $arBook['DETAIL_PAGE_URL'],
            'AUTHORS' => array('PRINT' => getAuthorsPrint($arBookAuthors), 'VALUE' => $arBookAuthors)
        );       
        unset($arBookAuthors);
    }
}
else {
    unset($arResult['PROPERTIES']['BOOK']);
}
?>