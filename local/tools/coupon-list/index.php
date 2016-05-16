<?

    use Bitrix\Main;
    use Bitrix\Main\Loader;
    use Bitrix\Main\Localization\Loc;
    use Bitrix\Sale\Internals;
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/tools/coupon-list/lang/coupon-list.php");

    $sTableId = "tbl_coupon_list";
    $oSort = new CAdminSorting($sTableId, "ID", "asc");
    $lAdmin = new CAdminList($sTableId, $oSort);

    //Filter initialization
    $arFilterFields = array("couponId", "discountId", "active", "coupon", "dateApply", "activeTo");
    $lAdmin->InitFilter($arFilterFields);
    $arFilter = array();
    $arFilter = array('ID' => $id, 'DISCOUNT_ID' => $discountId, 'ACTIVE' => $active, "COUPON" => $coupon, ">=DATE_APPLY" => $dateApplyFrom, "<=DATE_APPLY" => $dateApplyTo, 
        ">=ACTIVE_TO" => $activeToFrom, "<=ACTIVE_TO" => $activeToTo, ); 

    //Unset key's with empty value
    foreach($arFilter as $key => $value) {
        if(!$value) {
            unset($arFilter[$key]);
        }
    }    

    //Get all coupons 
    $rsData = Internals\DiscountCouponTable::getList(array('filter' => $arFilter));

    //Page navigation
    $rsData = new CAdminResult($rsData, $sTableId);
    $rsData->NavStart();
    $lAdmin->NavText($rsData->GetNavPrint(GetMessage("PAGES")));

    //Adding headers
    $lAdmin->AddHeaders( array(
        array("id"=>"ID", "content"=>"".GetMessage("ID_COUPON")."", "sort"=>"id", "default"=>true),      
        array("id"=>"DISCOUNT_ID", "content"=>"".GetMessage("ID_SALE")."", "sort"=>"discountId", "default"=>true),         
        array("id"=>"ACTIVE", "content"=>"".GetMessage("ACTIVE")."", "sort"=>"active", "default"=>true),   
        array("id"=>"COUPON", "content"=>"".GetMessage("COUPON_CODE")."", "sort"=>"coupon", "default"=>true),   
        array("id"=>"DATE_APPLY", "content"=>"".GetMessage("DATE_APPLY")."", "sort"=>"dateApply", "default"=>true),   
        array("id"=>"ACTIVE_TO", "content"=>"".GetMessage("DATE_ACTIVE_TO")."", "sort"=>"activeTo", "default"=>true),   
    ));

    //Create table with coupon list
    while($arRes = $rsData->GetNext()) {
        $couponId = $arRes['ID'];
        $row =&$lAdmin->AddRow($couponId, $arRes);
        $row->AddViewField("ID", $couponId);   
        $row->AddViewField("DISCOUNT_ID", $arRes["DISCOUNT_ID"]);   
        $row->AddViewField("ACTIVE", $arRes["ACTIVE"]);   
        $row->AddViewField("COUPON", $arRes["COUPON"]);
        $row->AddViewField("DATE_APPLY", $arRes["DATE_APPLY"]);
        $row->AddViewField("ACTIVE_TO", $arRes["ACTIVE_TO"]);
    }

    $lAdmin->AddFooter(array(
        array("title"=>GetMessage("MAIN_ADMIN_LIST_SELECTED"), "value"=>$rsData->SelectedRowsCount()),
        array("counter"=>true, "title"=>GetMessage("MAIN_ADMIN_LIST_CHECKED"), "value"=>"0"),
    ));
    
    $lAdmin->AddAdminContextMenu(array());
    $lAdmin->CheckListMode();
    $APPLICATION->SetTitle(GetMessage("PAGE_NAME"));
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_popup_admin.php")
?>

<form name="findForm" method="GET" action="<?=$APPLICATION->GetCurPage()?>?">
    <?
        //Add filter table
        $oFilter = new CAdminFilter($sTableId."_filter", array(GetMessage("ID_COUPON"), GetMessage("ID_SALE"), GetMessage("ACTIVE"), GetMessage("COUPON_CODE"), 
            GetMessage("DATE_APPLY"), GetMessage("DATE_ACTIVE_TO")));
        $oFilter->Begin();
    ?>
    <tr>
        <td><?=GetMessage("ID_COUPON")?></td>
        <td><input type="text" name="id" size="47" value="<?=htmlspecialchars($id)?>"></td>   
    </tr>
    <tr>
        <td><?=GetMessage("ID_SALE")?></td>
        <td><input type="text" name="discountId" size="47" value="<?=htmlspecialchars($discountId)?>"></td>   
    </tr>
    <tr>
        <td><?=GetMessage("ACTIVE")?>:</td>
        <td>
            <select name="active">
                <option value=""><?=htmlspecialcharsex(GetMessage('ANY'))?></option>
                <option value="Y"<?if ($active == "Y") { echo " selected";}?>><?=htmlspecialcharsex(GetMessage("YES"))?></option>
                <option value="N"<?if ($active == "N") { echo " selected";}?>><?=htmlspecialcharsex(GetMessage("NO"))?></option>
            </select>
        </td>
    </tr>
    <tr>
        <td><?=GetMessage("COUPON_CODE")?></td>
        <td><input type="text" name="couponCode" size="47" value="<?=htmlspecialchars($couponCode)?>"></td>   
    </tr>
    <tr>
        <td><?=GetMessage("DATE_APPLY")?>:</td>
        <td><?=CalendarPeriod("dateApplyFrom", htmlspecialcharsex($dateApplyFrom), "dateApplyTo", htmlspecialcharsex($dateApplyTo), "find_form")?></td>
    </tr>
    <tr>
        <td><?=GetMessage("DATE_ACTIVE_TO")?>:</td>
        <td><?=CalendarPeriod("activeToFrom", htmlspecialcharsex($activeToFrom), "activeToTo", htmlspecialcharsex($dateApplyTo), "find_form")?></td>
    </tr>
    <input type="hidden" name="formName" value="<?echo htmlspecialchars($formName)?>">
    <?
        $oFilter->Buttons(array("table_id"=>$sTableId, "url"=>$APPLICATION->GetCurPage(), "form"=>"find-form"));
        $oFilter->End();
    ?>
</form>
<?
    $lAdmin->DisplayList();
?>