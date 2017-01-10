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
        $logFilePath = $_SERVER['DOCUMENT_ROOT'] . "/bk/api/log/error.log";
        $current = file_get_contents($logFilePath);
        $current .= $date . " --- " . $string . "\n";
        file_put_contents($logFilePath, $current);
    }
}
?>