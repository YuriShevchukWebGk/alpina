<?
class Transaction {

    private $db;
    private $responseArray = Array(
        'status_code' => "",
        'data' => NULL
    );

    function __construct() {
        $this -> db = dibi::connect(Common::getDBParams());
    }
    
    /**
     * 
     * Create new transaction
     * 
     * @param array $params
     * @return string $successMessage
     * 
     * */
    
    public function create($params) {
        
        $successMessage = "Транзакция успешно добавлена";
        $errorMessage = "Произошла ошибка при добавлении транзакции";
     
        $transactionParams = array(
            'card_id' => $params['card_id'],
            'shop_id'  => $params['shop_id'],
            'check_id' => $params['check_id'],
            'product_exchange_code' => $params['product_exchange_code'],
            'price' => $params['price'],
            'discount_price' => $params['discount_price'],
        );
            
        try {
            dibi::query('INSERT INTO [transactions]', $transactionParams);
            $this->responseArray['status_code'] = "success";
            $this->responseArray['data'] = Array("msg" => $successMessage, "ID"=>dibi::getInsertId());
        } catch (Exception $e) {
            ErrorLogger::write(get_class($e) . ': ' . $e->getMessage());
            $this->responseArray['status_code'] = "error";
            $this->responseArray['data'] = $errorMessage;
        }
        
        return $this->responseArray;
    }
}
?>