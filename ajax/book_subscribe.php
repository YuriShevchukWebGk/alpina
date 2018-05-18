<?
require_once ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
//require_once("unisender/sub_function.php");


function subscribeTest($id, $mail) {
    global $USER;
    if ($id != 'глава') {
    // --- get current el status    
    $arSelect = Array("NAME","PROPERTY_STATE");
    $arFilter = Array("IBLOCK_ID" => 4, "ID" => $id, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 1), $arSelect);
    if ($ob = $res -> GetNextElement()) {
        $arFields = $ob -> GetFields();
        $bookName = $arFields['NAME'];
        $currentElStatus = $arFields['PROPERTY_STATE_ENUM_ID'];
    }
    
    // --- choose record template
    
    if($currentElStatus==22){
        $subName = "Подписка на 'Скоро в продаже'";
        $subID = 1;
    } else if($currentElStatus==23){
        $subName = "Подписка на допечатку";
        $subID = 2;
    }
    
    $arSelect = Array("ID");
    $arFilter = Array("IBLOCK_ID" => 41,"ACTIVE" => "Y","PROPERTY_SUB_TYPE_ID" => $subID, "PROPERTY_BOOK_ID" => $id, "PROPERTY_SUB_EMAIL" => $mail);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 9999), $arSelect);
    if($ob = $res -> GetNextElement()) { //
        echo "Sub exist";
    } else {
         // --- add new sub record
        $el = new CIBlockElement;
    
        $PROP = array();
        $PROP[385] = $id;  // --- book id
        $PROP[386] = $mail; // --- subscriber E-mail
        $PROP[387] = $subName;  // --- subscription description
        $PROP[388] = $subID; // --- subscription id
        
        $arLoadProductArray = Array(
          "MODIFIED_BY"    => $USER->GetID(), 
          "IBLOCK_SECTION_ID" => false,         
          "IBLOCK_ID"      => 41,
          "PROPERTY_VALUES"=> $PROP,
          "NAME"           => $bookName,
          "ACTIVE"         => "Y",         
          ); 
          
        $el->Add($arLoadProductArray);
        //addUnisenderSub($mail,$subName);
        echo "Sub success";
    }
    } else {
        $PROP = array();
        $PROP[385] = '1';  // --- book id
        $PROP[386] = $mail; // --- subscriber E-mail
        $PROP[387] = 'Глава из книги';  // --- subscription description
        $PROP[388] = "3"; // --- subscription id        
        
        $arLoadProductArray = Array(
          "MODIFIED_BY"    => $USER->GetID(), 
          "IBLOCK_SECTION_ID" => false,         
          "IBLOCK_ID"      => 41,
          "PROPERTY_VALUES"=> $PROP,
          "NAME"           => 'Глава из книги',
          "ACTIVE"         => "Y",         
          ); 
          
        $el->Add($arLoadProductArray);
    }
}

subscribeTest($_POST['book_id'],$_POST['sub_mail']);
?>

