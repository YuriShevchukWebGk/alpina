<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
    //require_once("unisender/sub_function.php");

    $block_id=CIBlock::GetList(array(), array("CODE"=>"GK_E_LANDING_APPLICAT"));
    $block = $block_id->Fetch();

    
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $id = $_POST["id"]; 
    $res = CIBlockElement::GetByID($id);
    $ar_res = $res->Fetch();
    $name_book = $ar_res['NAME'];
    $data_time = date("Y-m-d H:i:s"); 
    $arFields=array("NAME"=>$name,"PHONE"=>$phone,"EMAIL"=>$email,"NAME_BOOK"=>$name_book, "DATA"=>$data_time);
    
    CEvent::Send(
     "BASKET_ONE_CLICK",
     "s1",
     $arFields,
     "N",
     71
    );  
    /*CEvent::Send(
     "BASKET_ONE_CLICK",
     "s1",
     $arFields,
     "N",
     148
    );*/  
    If ($_POST["name"] && $_POST["phone"] &&  $_POST["email"] && $_POST["id"]) {
        $data=array("PHONE"=>$phone, "EMAIL"=>$email, "NAME"=>$name, "ID"=>$id);
        $el = new CIBlockElement;
        $arLoadProductArray = Array(
            "MODIFIED_BY"    => $USER->GetID(), 
            "IBLOCK_SECTION_ID" => false,          
            "IBLOCK_ID"      => 18,
            "PROPERTY_VALUES" => $data,
            "NAME"           => $name,            

        ); 
        if ($el->Add($arLoadProductArray))
            echo "Заказ в 1 клик успешно оформлен.";
        else
            echo "Невозможно оформить заказ в 1 клик." ;
       /* if($PRODUCT_ID = $el->Add($arLoadProductArray))
          echo "New ID: ".$PRODUCT_ID;
        else
          echo "Error: ".$el->LAST_ERROR;  */
        //addUnisenderSub($email,"Заказ в 1 клик",$name);    
    }
    else
    {
        echo "Невозможно оформить заказ в 1 клик. <br> Заполните все поля." ; 
    }

?>