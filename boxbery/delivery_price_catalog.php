<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?

    if(empty($_SESSION['price_delivery']) || $_SESSION['cyty'] != $_REQUEST["city"]){
		/*
        $url='http://api.boxberry.de/json.php?token='.BOXBERRY_TOKEN.'&method=ListZips';

        $handle = fopen($url, "rb");
        $contents = stream_get_contents($handle);
        fclose($handle);
        $array = json_decode($contents, true);


        foreach($array as $city){
            if($city["City"] == $_REQUEST["city"]){
                $ar_param_city = $city;
            }
        }

        $url_zip='http://api.boxberry.de/json.php?token='.BOXBERRY_TOKEN.'&method=DeliveryCosts&weight=1&zip='.$ar_param_city["Zip"];

        $handle_zip = fopen($url_zip, "rb");
        $content = stream_get_contents($handle_zip);
        fclose($handle_zip);

        $array_pvz = json_decode($content, true);

        if($array_pvz["price"] > 0){
            session_start();
            $_SESSION['price_delivery'] = round($array_pvz["price"]);
            $_SESSION['cyty'] = $_REQUEST["city"];
        }
        echo round($array_pvz["price"]);
		*/
		echo 235;
    }
?>