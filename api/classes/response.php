<?
class APIResponse {

    /**
     *
     * Sending data in JSON format
     *
     * @param string $status - can be success or error
     * @param mixed $data
     * @return json
     *
     * */

    public static function send($status, $data) {
        echo json_encode(Array($status => $data)); 
    }

}
?>