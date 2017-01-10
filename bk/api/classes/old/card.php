<?
class Card {

    private $db;
    private $responseArray = Array(
        'status_code' => "",
        'data' => NULL
    );

    function __construct() {
        $this -> db = dibi::connect(Common::getDBParams());
    }
    
    /**
     * @param int $card_id
     * @return bool
     * 
     * */
    
    private function isCardExist($card_code){
        $res = dibi::query('SELECT card_id FROM [discount_cards] WHERE [card_code] = ?',$card_code);
        $assoc = $res->fetchSingle();
        if($assoc){
            return true;
        }
    }

    /**
     * 
     * Return customer's data by card code
     * 
     * @param array $params
     * @return array $data
     * 
     * */
     
    public function getCustomerByCardCode($params) {
        
        $errorMessage = "По вашему запросу ничего не найдено";
        
        $res = dibi::query('SELECT discount_cards.discount_value,discount_cards.lock_flag,customers.customer_id,customers.name,customers.surname,customers.second_name
                            FROM discount_cards 
                            LEFT JOIN customers 
                            ON discount_cards.customer_id = customers.customer_id 
                            WHERE discount_cards.card_code = ?', $params['card_code']);
                            
        $assoc = $res -> fetchAll();
        
        if($assoc){
            $this->responseArray['status_code'] = "success";
            $this->responseArray['data'] = (array)$assoc[0];
        } else {
            $this->responseArray['status_code'] = "error";
            $this->responseArray['data'] = $errorMessage;
        }
        
        return $this->responseArray;
    }
    
    /**
     * 
     * Create new card
     * 
     * @param array $params
     * @return string $successMessage
     * 
     * */
    
    public function create($params){
        
        $successMessage = "Карта успешно добавлена";
        $errorMessage = "Произошла ошибка при добавлении карты";
        $lengthErrorMessage = "Поле EAN13 не может быть пустым и должно состоять из 13 символов.";
        
        if(!Validator::isBlank($params['card_code']) && Validator::comparison($params['card_code'],"=",13)){
     
            $cardParams = array(
                'card_code' => $params['card_code'],
                'discount_value'  => $params['discount_value'],
                'lock_flag' => $params['lock_flag'] ? $params['lock_flag'] : NULL,
                'shop_id' => $params['shop_id'],
                'customer_id' => $params['customer_id'],
                'issue_date' => $params['issue_date'],
                'change_date' => date('Y-m-d'),
            );
            
            try {
                dibi::query('INSERT INTO [discount_cards]', $cardParams);
                $this->responseArray['status_code'] = "success";
                $this->responseArray['data'] = Array("msg" => $successMessage,"ID"=>dibi::getInsertId());
            } catch (Exception $e) {
                ErrorLogger::write(get_class($e).': '.$e->getMessage());
                $this->responseArray['status_code'] = "error";
                $this->responseArray['data'] = $errorMessage;
            }
            
        } else {
            $this->responseArray['status_code'] = "error";
            $this->responseArray['data'] = $lengthErrorMessage;
        }
        
        return $this->responseArray;
    }

    /**
     * 
     * get card by EAN13 (card_code)
     * 
     * @param string $card_code
     * @return array $cardData
     * 
     * */

    public function get($params){
        
        $errorMessage = "Карты с таким кодом не существует.";
        
        $res = dibi::query('SELECT discount_cards.*, SUM(transactions.discount_price) AS total_sum
                            FROM [discount_cards]
                            LEFT JOIN transactions 
                                ON discount_cards.card_id = transactions.card_id 
                            WHERE [card_code] = ?', $params['card_code']);
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
     * Update card with EAN13
     * 
     * @param array $params
     * 
     * 
     * */
    
    public function update($params){
        
        $successMessage = "Карта успешно обновлена.";
        $errorMessage = "При обновлении карты произошла ошибка"; 
        $existanceError = "Данной карты не существует.";
        $entranceDataError = "Неверный формат данных для обновления.";
        
        if(Validator::isJSON($params['data'])){ 
            if($this->isCardExist($params['card_code'])){
                $decodedUpdateData = json_decode($params['data'],TRUE);
                $decodedUpdateData['change_date'] = date('Y-m-d');
                
                try {
                    dibi::query('UPDATE `discount_cards` SET ', $decodedUpdateData, 'WHERE `card_code`=%s', $params['card_code']);
                    $this->responseArray['status_code'] = "success";
                    $this->responseArray['data'] = $successMessage;
                } catch (Exception $e) {
                    ErrorLogger::write(get_class($e).': '.$e->getMessage());
                    $this->responseArray['status_code'] = "error";
                    $this->responseArray['data'] = $errorMessage;
                }
            } else {
                $this->responseArray['status_code'] = "error";
                $this->responseArray['data'] = $existanceError;
            }            
        } else {
            $this->responseArray['status_code'] = "error";
            $this->responseArray['data'] = $entranceDataError;
        }

        return $this->responseArray;
    }

    /**
     * 
     * Delete card by id
     * 
     * @param array $params
     * @return string $successMessage
     * 
     * */
    
    public function delete($params){
        
        $successMessage = "Карта успешно удалена";
        $errorMessage = "Произошла ошибка при удалении карты"; 
        $existanceError = "Данной карты не существует";
        
        if($this->isCardExist($params['card_code'])){
            try {
                dibi::query('DELETE FROM [discount_cards] WHERE card_code = ?', $params['card_code']);
                $this->responseArray['status_code'] = "success";
                $this->responseArray['data'] = $successMessage;
            } catch (Exception $e) {
                ErrorLogger::write(get_class($e).': '.$e->getMessage());
                $this->responseArray['status_code'] = "error";
                $this->responseArray['data'] = $errorMessage;
            }
        } else {
            $this->responseArray['status_code'] = "error";
            $this->responseArray['data'] = $existanceError;
        }
        return $this->responseArray;
    }

}
?>