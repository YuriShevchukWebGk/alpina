<?
class Validator {

    /**
     *
     * Validate is string contains something except whitespaces
     *
     * @param string $testee
     * @return bool
     *
     * */

    public static function isBlank($testee) {
        $pattern = '/(\s)/';
        # --- any whitespace char
        if (!preg_replace($pattern, "", $testee)) {
            return true;
        }
    }
    
    /**
     * 
     * Compare two statements
     * 
     * @param int $testee
     * @param char $operation
     * @param int $reference
     * @return bool
     * 
     * */

    public static function comparison($testee, $operation, $reference) {
        switch ($operation) {
            case "=" :
                if (strlen($testee) == intval($reference)) {
                    return true;
                }
                break;
            case ">" :
                if (strlen($testee) > intval($reference)) {
                    return true;
                }
                break;
            case "<" :
                if (strlen($testee) < intval($reference)) {
                    return true;
                }
                break;
        }
    }
    
    /**
     * 
     * Is it a JSON string 
     * 
     * @param json $string
     * @return bool
     * 
     * */
    
    public static function isJSON($string) {
        return is_string($string) && is_array(json_decode($string, TRUE)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }
    
    /**
     *  
     * @param string $token
     * @return array $assoc
	 * @deprecated
     * 
     * */
    
    private static function isTokenExists($token){}
    
    /**
     *  
     * 
     * @param string $token
     * @return bool
     * 
     * */
    
    public static function isTokenValid($token) {
        if(!self::isBlank($token) && $token == BK_TOKEN) {
            return true;
        }
    }
}
?>