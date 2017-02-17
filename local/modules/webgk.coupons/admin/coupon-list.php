<?
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    use Bitrix\Main;
    use Bitrix\Main\Loader;
    use Bitrix\Main\Localization\Loc;
    use Bitrix\Sale\Internals;
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/webgk.coupons/admin/lang/coupon-list.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/webgk.coupons/admin/.config.php");



    $sTableId = "tbl_coupon_list";
    $oSort = new CAdminSorting($sTableId, "ID", "asc");
    $lAdmin = new CAdminList($sTableId, $oSort);

    //Filter initialization
    $arFilterFields = array("couponId", "discountId", "active", "coupon", "dateApply", "activeTo", "orderBuy", "orederApply");
    $lAdmin->InitFilter($arFilterFields);

    $arSalesCoupon = CSaleOrderPropsValue::GetList(array("SORT" => "ASC"), array("ORDER_ID" => $_REQUEST["orederApply"], "CODE" => "CODE_COUPON"));
    $arCouponOrder = $arSalesCoupon->Fetch();

   /* if($_REQUEST["orderBuy"]){
        $arrFilter = array("ORDER_ID" => $_REQUEST["orderBuy"]);
        $dbItemsInOrder = CSaleBasket::GetList(array("ID" => "ASC"), $arrFilter, false, array("nTopCount" => 50))->Fetch();
    }
    $productItem = $dbItemsInOrder;  */
    $CouponSelect = array("ID", "IBLOCK_ID", "NAME", "PROPERTY_ORDER", "PROPERTY_COUPON");
    $blockCoupon = CIBlockElement::GetList(array("ID" => "ASC"),  array("IBLOCK_ID" => $arParams["COUPON_LIST"]["IBLOCK_ID"], "PROPERTY_ORDER" => $_REQUEST["orderBuy"]), false, false, $CouponSelect);
    while ($IblockCoupon = $blockCoupon->Fetch()) {
        $blockCoupons[] = $IblockCoupon["PROPERTY_COUPON_VALUE"];
    }

    $arFilter = array();
     $arFilter = array('ID' => intval($_REQUEST["id"]), 'DISCOUNT_ID' => intval($_REQUEST["discountId"]), 'ACTIVE' => $_REQUEST["active"], "COUPON" => $_REQUEST["couponCode"],
        ">=DATE_APPLY" => $_REQUEST["dateApplyFrom"], "<=DATE_APPLY" => $_REQUEST["dateApplyTo"], ">=ACTIVE_TO" => $_REQUEST["activeToFrom"], "<=ACTIVE_TO" => $_REQUEST["activeToTo"],
        "COUPON" => $arCouponOrder["VALUE"], "ID" => $blockCoupons);

    //Unset key's with empty value
    foreach($arFilter as $key => $value) {
        if(!$value) {
            unset($arFilter[$key]);
        }
    }
    
   

    //Get all coupons
    $rsData = Internals\DiscountCouponTable::getList(array('filter' => $arFilter));

    //Get iblock info about coupon
    $arCouponSelect = array("ID", "IBLOCK_ID", "NAME", "PROPERTY_ORDER", "PROPERTY_COUPON");
    $obIblockCoupon = CIBlockElement::GetList(array("ID" => "ASC"),  array("IBLOCK_ID" => $arParams["COUPON_LIST"]["IBLOCK_ID"]), false, false, $arCouponSelect);
    while ($arIblockCoupon = $obIblockCoupon->Fetch()) {
        $arIblockCoupons[$arIblockCoupon["PROPERTY_COUPON_VALUE"]] = $arIblockCoupon;
    }

    $arFilter = array("!PROPERTY_VAL_BY_CODE_CODE_COUPON" => false);
    $rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
    while ($arSales = $rsSales->Fetch()) {
        $obCouponProp = CSaleOrderPropsValue::GetList(array("SORT" => "ASC"), array("ORDER_ID" => $arSales["ID"], "CODE" => "CODE_COUPON"));
        $arCouponProp = $obCouponProp->Fetch();
        $arCouponOrders[$arCouponProp["VALUE"]] = $arCouponProp;
    }  

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
        array("id"=>"ORDER_BUY", "content"=>"".GetMessage("ORDER_BUY")."", "sort"=>"orderBuy", "default"=>true),
        array("id"=>"ORDER_APPLY", "content"=>"".GetMessage("ORDER_APPLY")."", "sort"=>"orderApply", "default"=>true),
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
        $row->AddViewField("ORDER_BUY", $arIblockCoupons[$arRes['ID']]["PROPERTY_ORDER_VALUE"]);
        $row->AddViewField("ORDER_APPLY", $arCouponOrders[$arRes['COUPON']]["ORDER_ID"]);
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
            GetMessage("DATE_APPLY"), GetMessage("DATE_ACTIVE_TO"), GetMessage("ORDER_BUY"), GetMessage("ORDER_APPLY")));
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
    <tr>
        <td><?=GetMessage("ORDER_BUY")?>:</td>
        <td><input type="text" name="orderBuy" size="47" value="<?=htmlspecialchars($orderBuy)?>"></td>
    </tr>
    <tr>
        <td><?=GetMessage("ORDER_APPLY")?>:</td>
        <td><input type="text" name="orederApply" size="47" value="<?=htmlspecialchars($orederApply)?>"></td>
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