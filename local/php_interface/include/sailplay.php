<?
/**
 * Класс вспомогательных функций для Sailplay
 * */
class SailplayHelper {
    /**
     * Перед вызовом любой API функции необходимо получить token
     * http://docs.sailplay.net/ru/page/api-back-login/
     * @return string $decoded_result['token']
     * */
    public static function getAuth() {
        GLOBAL $arParams;
        $query = 'http://sailplay.ru/api/v1/login/?pin_code=' . $arParams['SAILPLAY']['PIN_CODE'] . '&store_department_key=' . $arParams['SAILPLAY']['STORE_KEY'] . '&store_department_id=' . $arParams['SAILPLAY']['STORE_ID'];
        
        $decoded_result = self::performQuery($query);
        if ($decoded_result['status'] == "ok") {
            return $decoded_result['token'];
        }
    }
    
    /**
     * Получить auth_hash для отображения персонализированного ЛК для пользователя
     * http://docs.sailplay.ru/ru/page/api-back-users/
     * @param string $token
     * @param string $email
     * @return string $decoded_result['auth_hash'];
     * */
    public static function getUserAuthHash($token, $email) {
        GLOBAL $arParams;
        
        $query = 'http://sailplay.ru/api/v2/users/info/?email=' . $email . '&token=' . $token . '&store_department_id=' . $arParams['SAILPLAY']['STORE_ID'] . '&extra_fields=auth_hash';
        
        $decoded_result = self::performQuery($query);
        if ($decoded_result['status'] == "ok") {
            return $decoded_result['auth_hash'];
        }
    }
    
    /**
     * Передача данных о клиенте в sailplay
     * http://docs.sailplay.ru/ru/page/api-back-users/
     * @param string $token
     * @param string $email
     * @param string $first_name
     * @param string $last_name
     * @return void
     * */
    public static function addNewUser($token, $email, $first_name, $last_name) {
        GLOBAL $arParams;
        
        $query = 'http://sailplay.ru/api/v2/users/add/?email=' . $email . '&token=' . $token . '&store_department_id=' . $arParams['SAILPLAY']['STORE_ID'] . '&first_name=' . $first_name . '&last_name=' . $last_name;
        
        $decoded_result = self::performQuery($query);
    }
    
    /**
     * Существует ли пользователь в системе sailplay
     * Вернуть просто true или false нельзя, т.к. тогда будет не понятно, что значит false, фейл с запросом или
     * пользователя нет, поэтому отправляем массивы со статусами, по умолчанию статус пуст
     * http://docs.sailplay.ru/ru/page/api-back-users/
     * @param string $token
     * @param string $email
     * @return array $result
     * */
    public static function isUserExist($token, $email) {
        GLOBAL $arParams;
        $result = array("status" => "");
        $query = 'http://sailplay.ru/api/v2/users/info/?email=' . $email . '&token=' . $token . '&store_department_id=' . $arParams['SAILPLAY']['STORE_ID'] . '&extra_fields=auth_hash';
        
        $decoded_result = self::performQuery($query);
        if ($decoded_result['status'] == "ok") {
            $result['status'] = "success";
        } else if ($decoded_result['status'] == "error" && $decoded_result['status_code'] == -4000) {
            $result['status'] = "fail";
        }
        return $result;
    }
    
    /**
     * Вспомогательная функция для выполнения запросов
     * @param string $query_string
     * @return array $decoded_result;
     * */
    private static function performQuery($query_string) {
        $postdata = http_build_query(
            array()
        );
        
        $opts = array('http' =>
           array(
               'method'  => 'GET',
               'header'  => 'Content-type: application/x-www-form-urlencoded',
               'content' => $postdata
          )
        );
        
        $context  = stream_context_create($opts);
        $result = file_get_contents($query_string, false, $context);
        
        $decoded_result = json_decode($result, true);
        return $decoded_result;
    }
}
?>