<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
    /*$url='http://api.boxberry.de/json.php?token='.BOXBERRY_TOKEN.'&method=CourierListCities';
 // $url='http://api.boxberry.de/json.php?token='.BOXBERRY_TOKEN.'&method=DeliveryCosts&weight=500&ordersum=0&paysum=0&targetstart=010&zip=624000';
          http://api.boxberry.de/json.php?token=21585.rvpqfebe&CourierListCities
        $handle = fopen($url, "rb");
        $contents = stream_get_contents($handle);
        fclose($handle);
        $data = json_decode($contents,true);
        arshow($data);
        die();   */


        $url='http://api.boxberry.de/json.php?token='.BOXBERRY_TOKEN.'&method='.$_POST["method"];

        $handle = fopen($url, "rb");
        $contents = stream_get_contents($handle);
        fclose($handle);
        $data = json_decode($contents,true);

        echo json_encode(Boxbery::getData($data));

?>