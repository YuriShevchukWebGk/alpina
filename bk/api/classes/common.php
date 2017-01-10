<?

class APITools {

    /**
     *
     * Show any data in human readable view
     *
     * @param mixed $data
     * @return void
     *
     * */

    static public function arshow($data) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
    
    /**
     * 
     * Convert Object to Array
     * 
     * @param object $obj
     * @return array $new
     * 
     * */
    
    static public function objectToArray($obj) {
        if(is_object($obj)) $obj = (array) $obj;
        if(is_array($obj)) {
            $new = array();
            foreach($obj as $key => $val) {
                $new[$key] = self::objectToArray($val);
            }
        }
        else $new = $obj;
        return $new;       
    }

	/**
     * 
     * Get lang phrase
     * 
     * @param string $phrase
     * @return string
     * 
     * */
    
    static public function getLangPhrase($phrase) {
    	global $api_messages;
        return $api_messages[$phrase];
    }
	
	
	/**
	 * 
	 * Выполнить запрос
	 * 
	 * @param array $data
	 * @param string $request
	 * @return mixed $result
	 * 
	 * */
	static public function performQuery($data, $request) {
		
		//self::arshow($data);
		//self::arshow($request);
		
		/*$postdata = http_build_query(
			$data
	    );
	
	    $opts = array(
		    'http' => array(
				'method'  => 'POST',
				'header'  => 'Content-Type: application/x-www-form-urlencoded' . PHP_EOL . 'X-AD-Offer: 1' . PHP_EOL,
				'content' => $postdata
			),
			'ssl' => array(
		        'verify_peer' => false
		    )
	    );
	    
	    $context  = stream_context_create($opts);
	    $result = file_get_contents(BK_REQUESTS_URL . $request, false, $context);
		
		return $result;*/
	}
}
?>