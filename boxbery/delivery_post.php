<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
    $url='http://api.boxberry.de/json.php?token='.BOXBERRY_TOKEN.'&method=DeliveryCosts&weight='.$_POST["weight"].'&zip='.$_POST["zip"];

    $handle = fopen($url, "rb");
    $contents = stream_get_contents($handle);
    fclose($handle);

    echo $contents;

?>