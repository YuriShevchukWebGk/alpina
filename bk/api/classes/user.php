<?
class UserAPI {

    private $response_array = Array(
        'status_code' => "",
        'data'        => NULL
    );
	
	/**
	 * 
	 * Отправляем пользователя в БК
	 * 
	 * Ожидаемые поля: 
	 * - email
	 * - password
	 * - name
	 * 
	 * @param array $params
	 * @return string $code
	 * 
	 * */
	public function sendUserToBK($params) {
		// формируем массив необходимых параметров
		$data = array(
			"email"    => $params['email'],
			"name"     => $params['name'],
			"password" => $params['password']
		);
		$data = array_filter($data);
		// валидация и выполнение необходимых действий
		if ((is_array($data) && !empty($data))) {
			if (Validator::isKeyValuePairExists($data, "email")) {
				// дальнейшие манипуляции это требования по работе с пользователями от БК
				ksort($data);
				
				$string_to_hash = http_build_query($data);
				$sig = md5($string_to_hash . BK_API_TOKEN);
				
				$data['sig'] = $sig;
				
				// сам запрос к БК
				APITools::performQuery($data, "/b2b/users");
			} else {
				$this->responseArray['status_code'] = "error";
				$this->responseArray['data'] = sprintf(APITools::getLangPhrase("parameter_missed"), "email");
			}
		} else {
			$this->responseArray['status_code'] = "error";
			$this->responseArray['data'] = APITools::getLangPhrase("data_invalid");
		}
		return $this->responseArray;
	}
}
?>