<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
/*$couponsArray = array(
'2206060701',
'2214051601',
'2214051602'
);*/
if ($USER->IsAdmin()){
	if (CModule::IncludeModule("catalog"))
	{
		foreach ($couponsArray as $oneCoupon) {
			$COUPON = CatalogGenerateCoupon();
			$COUPON = $oneCoupon;
			
			$arCouponFields = array(
				"DISCOUNT_ID" => "150",
				"ACTIVE" => "Y",
				"ONE_TIME" => "O",
				"COUPON" => $COUPON,
				"DATE_APPLY" => false
			);

			if ($CID = CCatalogDiscountCoupon::Add($arCouponFields)) {
				echo $oneCoupon.' ok<br />';
			}
			$CID = IntVal($CID);
			if ($CID <= 0)
			{
				$ex = $APPLICATION->GetException();
				$errorMessage = $ex->GetString();
				echo $errorMessage."<br />";
			}
		}
	}	
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>