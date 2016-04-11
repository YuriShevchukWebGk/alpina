<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?> 
<?
// --- соответствие веса стоимости доставки
$weightAndPriceMatch = Array(
    '0,20' => 126.26,
    '21,100' => 172.28,
    '101,250' => 260.78,
    '251,500' => 412.41,
    '501,1000' => 718.62,
    '1001,2000' => 1333.40,
    '2001,3000' => 1930.48,
    '3001,4000' => 2527.56,
    '4001,5001' => 3124.64,
);

$weightValue = round($_POST['weight']);

foreach ($weightAndPriceMatch as $weightRange => $cost) {
    list($min,$max)=explode(",",$weightRange);
    if(in_array($weightValue, range($min,$max))){
        $_SESSION['rfPostTarif'] = $cost+100.00; 
        echo $cost+100.00;
    } 
}
?>