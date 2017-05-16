<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
use Bitrix\Main\Application,
    Bitrix\Main\Loader,
    Bitrix\Main\Localization\Loc,
    Bitrix\Sale\Internals,
    Bitrix\Main\UserTable,
    Bitrix\Main;
$filter = array(
    '=DISCOUNT_ID' => 246
);
$listID = array();
$couponIterator = Internals\DiscountCouponTable::getList(array(
    'select' => array('ID', "COUPON"),
    'filter' => $filter
));
while ($coupon = $couponIterator->fetch())
{
    $listID[$coupon["ID"]] = $coupon['COUPON'];
}
$fp = fopen($_SERVER["DOCUMENT_ROOT"].'/coupons_list.csv', 'w');
foreach ($listID as $coupon_ID => $coupon_value) {
     fputcsv($fp, explode(';', $coupon_ID . ";" . $coupon_value),";");
}
fclose($fp);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>