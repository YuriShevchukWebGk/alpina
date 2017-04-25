<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
  /*$url='http://api.boxberry.de/json.php?token='.BOXBERRY_TOKEN.'&method=CourierListCities';
 // $url='http://api.boxberry.de/json.php?token='.BOXBERRY_TOKEN.'&method=DeliveryCosts&weight=500&ordersum=0&paysum=0&targetstart=010&zip=624000';

        $handle = fopen($url, "rb");
        $contents = stream_get_contents($handle);
        fclose($handle);
        $data = json_decode($contents,true);
        arshow($data);
        die();  */
class Boxbery{

    private static $actualQueryData = Array();

     /*******
     *
     *  @param string $method
     *  @param string $country optional
     *  @param string $state optional
     *  @param string $city optional
     *  @param float $weight optional , in KG
     *
     *  @return array $queryArray
     *
     ********/

    private static function makeQueryArray($method,$country,$state,$city,$weight){
        switch($method){
            case 'CourierListCities':
               $queryArray = array(
                    'method' => 'CourierListCities'
                );
                break;
            case 'ListPoints':
               $queryArray = array(
                    'method' => 'ListPoints',
                    'state' => $state
                );
                break;
            case 'ListZips':
                $queryArray = array(
                    'method' => 'ListZips',
                    'state' => $state,
                    'City' => $city,
                );
                break;
            case 'DeliveryCosts':
                $queryArray = array(
                    'method' => 'DeliveryPeriod',
                    'City' => $city,
                    'weight' => $weight
                );
                break;
        }

        return $queryArray;
    }

     /*******
     *
     *  @param array $queryArray
     *
     *  @return array $data['data']
     *
     ********/

    private static function performAPIQuery($queryArray){

        $postdata = http_build_query($queryArray);

        $url='http://api.boxberry.de/json.php?token='.BOXBERRY_TOKEN.'&'.$postdata;

        $handle = fopen($url, "rb");
        $contents = stream_get_contents($handle);
        fclose($handle);
        $data = json_decode($contents,true);

        return $data;
    }

    private static function getActualData($rawData,$query){


        switch($query){
            case 'CourierListCities':
                    $firstParam = 'Area';
                    $secondParam = 'Area';
                break;
            case 'ListPoints':
                    $firstParam = 'Region';
                    $secondParam = 'Region';
                break;
            case 'ListZips':
                    $firstParam = 'City';
                    $secondParam = 'City';
                break;
            case 'DeliveryCosts':
                    $firstParam = 'City';
                    $secondParam = 'DeliveryPeriod';
                break;
        }

        foreach($rawData as $k=>$v){
            array_push(self::$actualQueryData,array('first'=>$v[$firstParam],'second'=>$v[$secondParam]));
        }
    }

     /*******
     *
     *  @param string $method
     *  @param string $country optional
     *  @param string $state optional
     *  @param string $city optional
     *  @param float $weight optional , in KG
     *
     *  @return array $queryArray
     *
     ********/

     public static function getData($method,$country,$state,$city,$weight){
         $qa = self::makeQueryArray($method, $country, $state, $city, $weight);
         self::getActualData(self::performAPIQuery($qa),$method);

         if($method=='DeliveryPeriod'){ // --- for foreign countries different algorythm
             $recalculateBoxberyCostForeign = number_format($recalculateBoxberyCostForeign, 2, '.', '');
             self::$actualQueryData[0]['first'] = $recalculateBoxberyCostForeign;
             $_SESSION['DeliveryPeriod'] = $recalculateBoxberyCostForeign;
         } else if($method=='DeliveryPeriod'){
             $_SESSION['DeliveryPeriod'] = self::$actualQueryData[0]['first'];
         }

         return self::$actualQueryData;
     }
}

// --- Making request

echo json_encode(Boxbery::getData($_REQUEST['method'],$_REQUEST['country'],$_REQUEST['state'],$_REQUEST['city'],$_REQUEST['weight']));
?>