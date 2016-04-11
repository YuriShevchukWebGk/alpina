<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?> 
<?
    AddEventHandler("sale", "OnOrderAdd", "GenerateGiftCoupon");
    use Bitrix\Main;
    use Bitrix\Main\Loader;
    use Bitrix\Main\Localization\Loc;
    use Bitrix\Sale\Internals;
?>
<?                      
    CCatalogDiscountCoupon::ClearCoupon();
    if(!empty($_POST["coupon"]) && !empty($_POST["price"]) && $_POST["action"] == "check"){

        $price=intval($_POST["price"]);
        $IBLOCK_ID = 20;

        $filter=array('=COUPON' => $_POST["coupon"]);
        $discountIterator = Internals\DiscountCouponTable::getList(array(
            'filter' => $filter
        ));
        $arCoupon = $discountIterator->fetch();
        

        if (!empty($arCoupon) && $arCoupon["ACTIVE"]=="Y") {
            $filterCoup=array('=ID' => $arCoupon["DISCOUNT_ID"]);
            $discountIteratorCoup = Internals\DiscountTable::getList(array(
                'filter' => $filterCoup
            ));
            $arDiscount = $discountIteratorCoup->fetch(); 
            $discountVal=(int)$arDiscount["ACTIONS_LIST"]["CHILDREN"][0]["DATA"]["Value"];
            if ($discountVal>$price) {
                CCatalogDiscountCoupon::ClearCoupon();
                $result["DEFAULT_COUPON"]='N';
                $_SESSION["CUSTOM_COUPON"]["DEFAULT_COUPON"]='N';
                $_SESSION["CUSTOM_COUPON"]["COUPON_VALUE"]=$discountVal;
                $_SESSION["CUSTOM_COUPON"]["COUPON_CODE"]=$_POST["coupon"];
                $_SESSION["CUSTOM_COUPON"]["COUPON_ID"]=$arCoupon["ID"];
            } else {
                CCatalogDiscountCoupon::SetCoupon($arCoupon["COUPON"]);
                $result["DEFAULT_COUPON"]='Y';
                $_SESSION["CUSTOM_COUPON"]["DEFAULT_COUPON"]='Y';
                $_SESSION["CUSTOM_COUPON"]["COUPON_ID"]=$arCoupon["ID"];

            }      
        } else {
            CCatalogDiscountCoupon::SetCoupon($arCoupon["COUPON"]);
            $result["DEFAULT_COUPON"]='Y';
            $_SESSION["CUSTOM_COUPON"]["DEFAULT_COUPON"]='Y';
            $_SESSION["CUSTOM_COUPON"]["COUPON_ID"]=$arCoupon["ID"];


        }
        echo json_encode($result);
    }


    /*if (!empty($arCoupon)){
    $filterCoup=array('=COUPON' => $_POST["coupon"]);
    $discountIteratorCoup = Internals\DiscountCouponTable::getList(array(
    'select' => array('ID', 'COUPON', 'DISCOUNT_ID'),
    'filter' => $filter
    ));
    $arDiscount = $discountIteratorCoup->fetch(); 
    arshow($arDiscount);
    }       

    */


?>