<?
class Customer {

    private $db;
    private $responseArray = Array(
        'status_code' => "",
        'data' => NULL
    );

    function __construct() {
        $this -> db = dibi::connect(Common::getDBParams());
    }
    
    /**
     * @param int $customer_id
     * @return bool
     * 
     * */
    
    private function isCustomerExist($customer_id){
        $res = dibi::query('SELECT customer_id FROM [customers] WHERE [customer_id] = ?',$customer_id);
        $assoc = $res->fetchSingle();
        if($assoc){
            return true;
        }
    }
    
    public function getByPhone($params){
        
        $tempDataArr = Array();
        
        $errorMessage = "При выполнении запроса произошла ошибка.";
        $errorPatternMessage = "Неизвестный шаблон поиска.";
        $errorPhoneMessage = "Телефон для поиска не задан,либо его длина меньше 4 символов.";
        $errorEmptyResultSet = "По вашему запросу ничего не найдено.";
        $resultQuantityNotice = "Количество результатов превышает лимит в 10 записей. Пожалуйста,уточните запрос.";    
        
        $pattern = null;
            
        switch($params['pattern']){
            case "contains":
                $pattern = "LIKE";
                break;
            case "equal":
                $pattern = "=";
                break;
        }
        
        if($pattern){
            if(!Validator::isBlank($params['phone']) && Validator::comparison($params['phone'],">",3)){
                try {
                    $res = dibi::query("SELECT SQL_CALC_FOUND_ROWS discount_cards.card_code,discount_cards.discount_value,discount_cards.lock_flag,customers.customer_id,customers.name,customers.surname,customers.second_name,customers.birthday,customers.city_id,customers.mobile
                                FROM [customers]
                                LEFT JOIN discount_cards
                                ON customers.customer_id = discount_cards.customer_id 
                                WHERE [customers.mobile] ".$pattern." ? LIMIT 10",$pattern == "LIKE" ? "%".$params['phone']."%" : $params['phone']);
                    
                    $tempDataArr['data'] = Common::objectToArray($res->fetchAll());
                    
                    $res = dibi::query("SELECT FOUND_ROWS() as totalRecords");
                    $assoc = Common::objectToArray($res->fetchAll());
                    $tempDataArr['totalRecords'] = $assoc[0]['totalRecords'];
                    
                    if($tempDataArr['data']){
                        if ($tempDataArr['totalRecords'] > 10){
                            $this->responseArray['status_code'] = "error";
                            $this->responseArray['data'] = $resultQuantityNotice;
                        } else {
                            $this->responseArray['status_code'] = "success";
                            $this->responseArray['data'] = $tempDataArr;
                        }
                    } else {
                        $this->responseArray['status_code'] = "error";
                        $this->responseArray['data'] = $errorEmptyResultSet;
                    }
                } catch (Exception $e) {
                    ErrorLogger::write(get_class($e).': '.$e->getMessage());
                    $this->responseArray['status_code'] = "error";
                    $this->responseArray['data'] = $errorMessage;
                }
            } else {
                $this->responseArray['status_code'] = "error";
                $this->responseArray['data'] = $errorPhoneMessage;
            }
        } else {
            $this->responseArray['status_code'] = "error";
            $this->responseArray['data'] = $errorPatternMessage;
        }
        
        return $this->responseArray;
    }
    
    /**
     * 
     * Create new user
     * 
     * @param array $params
     * @return string $successMessage
     * 
     * */

    public function create($params) {
        
        $successMessage = "Покупатель успешно добавлен";
        $errorMessage = "Произошла ошибка при добавлении покупателя"; 
        
        $customerData = array(
            'surname' => $params['surname'],
            'name'  => $params['name'],
            'second_name' => $params['second_name'],
            'birthday' => $params['birthday'],
            'gender' => $params['gender'],
            'mobile' => $params['mobile'],
            'email' => $params['email'],
            'sms_info' => $params['sms_info'],
            'mail_info' => $params['mail_info'],
            'city_id' => $params['city_id'],
            'last_change_date' => date('Y-m-d'),
        );
        
        try {
            dibi::query('INSERT INTO [customers]', $customerData);
            $this->responseArray['status_code'] = "success";
            $this->responseArray['data'] = Array("msg" => $successMessage,"ID"=>dibi::getInsertId());
        } catch (Exception $e) {
            ErrorLogger::write(get_class($e).': '.$e->getMessage());
            $this->responseArray['status_code'] = "error";
            $this->responseArray['data'] = $errorMessage;
        }
        
        return $this->responseArray;
    }

    

    /**
     * 
     * get customer by customer_id
     * 
     * @param array $params
     * @return array $this->responseArray
     * 
     * */

    public function get($params){
        
        $errorMessage = "Покупателя с таким ID не существует."; 
        
        $res = dibi::query('SELECT * FROM [customers] WHERE [customer_id] = ?',$params['customer_id']);
        $assoc = $res->fetchAll();
        if($assoc){
            $this->responseArray['status_code'] = "success";
            $this->responseArray['data'] = Common::objectToArray($assoc[0]);
        } else{
            $this->responseArray['status_code'] = "error";
            $this->responseArray['data'] = $errorMessage;
        }
        
        return $this->responseArray;
    }
    
     /**
     * 
     * Update customer with customer_id
     * 
     * @param array $params
     * @return array $this->responseArray
     * 
     * */
    
    public function update($params){
        
        $successMessage = "Пользователь успешно обновлен.";
        $errorMessage = "При обновлении пользователя произошла ошибка"; 
        $existanceError = "Данного пользователя не существует.";
        $entranceDataError = "Неверный формат данных для обновления.";
        
        if(Validator::isJSON($params['data'])){
            
            $decodedUpdateData = json_decode($params['data'],TRUE);
            $decodedUpdateData['last_change_date'] = date('Y-m-d');
            
            try {
                dibi::query('UPDATE `customers` SET ', $decodedUpdateData, 'WHERE `customer_id`=%s', $params['customer_id']);
                $this->responseArray['status_code'] = "success";
                $this->responseArray['data'] = $successMessage;
            } catch (Exception $e) {
                ErrorLogger::write(get_class($e).': '.$e->getMessage());
                $this->responseArray['status_code'] = "error";
                $this->responseArray['data'] = $errorMessage;
            }
                        
        } else {
            $this->responseArray['status_code'] = "error";
            $this->responseArray['data'] = $entranceDataError;
        }

        return $this->responseArray;
    }

    /**
     * 
     * Delete customer by id
     * 
     * @param array $params
     * @return string $successMessage
     * 
     * */
    
    public function delete($params){
        
        $successMessage = "Покупатель успешно удален";
        $errorMessage = "Произошла ошибка при удалении покупателя";
        $errorExistanceMessage = "Покупателя с таким ID не существует.";  
        
        if($this->isCustomerExist($params['customer_id'])){
            try {
                dibi::query('DELETE FROM [customers] WHERE customer_id = ?', $params['customer_id']);
                $this->responseArray['status_code'] = "success";
                $this->responseArray['data'] = $successMessage;
            } catch (Exception $e) {
                ErrorLogger::write(get_class($e).': '.$e->getMessage());
                $this->responseArray['status_code'] = "error";
                $this->responseArray['data'] = $errorMessage;
            }
        } else {
            $this->responseArray['status_code'] = "error";
            $this->responseArray['data'] = $errorExistanceMessage;
        }
        
        return $this->responseArray;
    }

}
?>