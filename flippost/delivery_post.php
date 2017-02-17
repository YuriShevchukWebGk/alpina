<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?> 
<?

class Flippost{
    
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
            case 'getCountries':
               $queryArray = array(
                    'dbAct' => 'getCountries'
                );
                break;
            case 'getStates':
               $queryArray = array(
                    'dbAct' => 'getStates',
                    'country' => $country
                );
                break;
            case 'getCities':
                $queryArray = array(
                    'dbAct' => 'getCities',
                    'country' => $country,
                    'state' => $state
                );
                break;
            case 'getTarif':
                $queryArray = array(
                    'dbAct' => 'getTarif',
                    'org' => 'MOW',
                    'dest' => $city,
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

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
                'content' => $postdata
                )
        );

        $context  = stream_context_create($opts);
        $result = file_get_contents('http://web.flippost.com/fp/client/api.php', false, $context);
        $data = json_decode($result,true);
        
        return $data['data'];
    }
    
    /*******
     * 
     *  @param array $rawData
     *  @param string $query
     * 
     *  @return void
     *   
     ********/
    
    private static function getActualData($rawData,$query){
        switch($query){
            case 'getCountries':
                    $firstParam = 'code';
                    $secondParam = 'country';
                break;
            case 'getStates':
                    $firstParam = 'state';
                    $secondParam = 'state';
                break;
            case 'getCities':
                    $firstParam = 'citycode';
                    $secondParam = 'city';
                break;
            case 'getTarif':
                    $firstParam = 'tarif';
                    $secondParam = 'delivery';
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
         
         if($method=='getTarif' && $country!='RUS'){ // --- for foreign countries different algorythm
             $recalculateFlippostCostForeign = (self::$actualQueryData[0]['first'] + 485 + 485*$weight)*1.18;
             $recalculateFlippostCostForeign = number_format($recalculateFlippostCostForeign, 2, '.', '');
             self::$actualQueryData[0]['first'] = $recalculateFlippostCostForeign;
             $_SESSION['flippostTarif'] = $recalculateFlippostCostForeign; 
         } else if($method=='getTarif'){
             $_SESSION['flippostTarif'] = self::$actualQueryData[0]['first']; 
         }
         
         return self::$actualQueryData;
     }
}

// --- Making request

echo json_encode(Flippost::getData($_REQUEST['method'],$_REQUEST['country'],$_REQUEST['state'],$_REQUEST['city'],$_REQUEST['weight']));
?>