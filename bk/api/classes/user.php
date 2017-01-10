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
		if (is_array($params) && !empty($params)) {
			// 	дальнейшие манипуляции это требования по работе с пользователями от БК
			ksort($params);
			
			$string_to_hash = http_build_query($params);
			$sig = md5($string_to_hash . BK_API_TOKEN);
			
			$params['sig'] = $sig;
			
			APITools::arshow($params);
			
			// сам запрос к БК
			APITools::performQuery($params, "/b2b/users");
		} else {
			$this->responseArray['status_code'] = "error";
			$this->responseArray['data'] = APITools::getLangPhrase("data_invalid");
		}
		return $this->responseArray;
	}
}
?>