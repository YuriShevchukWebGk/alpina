<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?   Cmodule::IncludeModule('basket');

    if(empty($_SESSION['price_delivery_flippost']) || $_SESSION['cyty_flipost'] != $_REQUEST["city"]){

        $queryArray = array(
            'dbAct' => 'getCities',
            'city' => $_REQUEST["city"],
           // 'country' => $_REQUEST["country"]
        );
        $postdata = http_build_query($queryArray);

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
                'content' => $postdata
                )
        );

        // Выведем актуальную корзину для текущего пользователя
        $dbBasketItems = CSaleBasket::GetList(
                array(
                        "NAME" => "ASC",
                        "ID" => "ASC"
                    ),
                array(
                        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                        "LID" => SITE_ID,
                        "ORDER_ID" => "NULL",
                        "DELAY" => "N"
                    ),
                false,
                false,
                array("WEIGHT")
            );
        $weight = 0;
        while ($arItems = $dbBasketItems->Fetch())
        {
            $weight += $arItems["WEIGHT"];
        }

        $weight_all =($weight + $_REQUEST["weight"]) / 1000 ;
        $context  = stream_context_create($opts);
        $result = file_get_contents('http://web.flippost.com/fp/client/api.php', false, $context);
        $data = json_decode($result,true);

        $queryArray_price = array(
            'dbAct' => 'getTarif',
            'org' => 'MOW',
            'dest' => $data["data"][0]["citycode"],
            'weight' => $weight_all
        );
        $postdata_price = http_build_query($queryArray_price);

        $opts_2 = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
                'content' => $postdata_price
                )
        );

        $context_price  = stream_context_create($opts_2);
        $result_2 = file_get_contents('http://web.flippost.com/fp/client/api.php', false, $context_price);
        $ar_price = json_decode($result_2,true);

        if($ar_price["data"][0]["tarif"] > 0){

            $_SESSION['price_delivery_flippost'] = round($ar_price["data"][0]["tarif"]);
            $_SESSION['cyty_flipost'] = $_REQUEST["city"];
        }
        echo round(($ar_price["data"][0]["tarif"] + 485 + 485 * $weight_all) * 1.18);
    }
?>