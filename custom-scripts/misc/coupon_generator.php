<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
global $USER;

if ($USER->IsAdmin()){
	/*
	$couponsArray = array(
	'2206060701',
	'2214051601',
	'2214051602'
	);
	foreach ($couponsArray as $oneCoupon) {
		$COUPON = CatalogGenerateCoupon();
		$COUPON = $oneCoupon;
		$oneCoupon = 'e'.randString(7);
		$COUPON = $oneCoupon;
		
		$arCouponFields = array(
			"DISCOUNT_ID" => "199",
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
	}*/

	for ($g = 0; $g < 49; $g++) {
		$oneCoupon = 'e'.randString(7);
		$result = \Bitrix\Sale\Internals\DiscountCouponTable::add(array(
			'DISCOUNT_ID' => 275,
			'COUPON' => $oneCoupon,
			'TYPE' => \Bitrix\Sale\Internals\DiscountCouponTable::TYPE_ONE_ORDER, // одноразовый
		));

		if (!$result->isSuccess()) {
			echo $result->getErrorMessages(); // текст проблемы
		} else {
			echo $oneCoupon.' ok<br />';
		}
	}
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>