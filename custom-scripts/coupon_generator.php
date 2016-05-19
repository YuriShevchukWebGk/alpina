<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){
	if (CModule::IncludeModule("catalog"))
	{
		$COUPON = CatalogGenerateCoupon();
		$COUPON = 'march_test';
		
		$arCouponFields = array(
			"DISCOUNT_ID" => "18",
			"ACTIVE" => "Y",
			"ONE_TIME" => "O",
			"COUPON" => $COUPON,
			"DATE_APPLY" => false
		);

		if ($CID = CCatalogDiscountCoupon::Add($arCouponFields)) {
			echo '123';
		}
		$CID = IntVal($CID);
		if ($CID <= 0)
		{
			$ex = $APPLICATION->GetException();
			$errorMessage = $ex->GetString();
			echo $errorMessage;
		}
	}	
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>