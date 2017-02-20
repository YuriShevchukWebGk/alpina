<?
class ErrorLogger {
    
    /**
     * 
     * Log throwed exceptions
     * 
     * @param string $string
     * @return void
     * 
     * */
    
    public static function write($string) {
        date_default_timezone_set('Europe/Moscow');
        $date = date('d-m-Y H:i:s');
        $logFilePath = $_SERVER['DOCUMENT_ROOT'] . "/api/log/error.log";
        $current = file_get_contents($logFilePath);
        $current .= $date . " --- " . $string . "\n";
        file_put_contents($logFilePath, $current);
    }
}

class DataLogger {
	/**
     * 
     * Log data to file
     * 
     * @param mixed $data
     * @return void
     * 
     * */
    
    public static function write($data) {
        date_default_timezone_set('Europe/Moscow');
        $date = date('d-m-Y H:i:s');
		$file = $_SERVER['DOCUMENT_ROOT'] . "/api/log/data.log";
		$log_data = array(
			"date" => $date,
			"data" => $data
		);
		file_put_contents(
            $file,
            var_export($log_data, 1)."\n",
            FILE_APPEND
        );
    }
}
?>