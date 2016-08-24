<?
function getAuthorsPrint($AUTHOR_ID, $reviews_link = false) 
{
    $rsElements = CIBlockElement::GetList(
        array("SORT"=>"ASC"), 
        array('IBLOCK_ID' => array(26, 5), 'ID'=> intval($AUTHOR_ID)), 
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
?>