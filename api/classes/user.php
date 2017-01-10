<?
class UserAPI {

    private $response_array = Array(
        'status_code' => "",
        'data'        => NULL
    );
	
	/**
	 * 
	 * Существует ли пользователь с таким email
	 * 
	 * @param string $email
	 * @return int $id
	 * 
	 * */
	private function isUserExist($email) {
		$filter = Array (
		    "=EMAIL" => $email,
		);
		$params = array(
			"NAV_PARAMS" => array("nPageSize" => 1),
			"FIELDS"     => array("ID")
		);
		$users = CUser::GetList(
			($by = "id"),
			($order = "asc"),
			$filter,
			$params
		);
		if ($user = $users->Fetch()) {
		    return $user['ID'];
		}
	}
	
	/**
	 * 
	 * Обновляем пароль пользователя
	 * В случае, если такой пользователь не найден, то создает его с присланным email/password
	 * Используется как коллбек в БК
	 * 
	 * Ожидаемые поля: 
	 * - email
	 * - password
	 * 
	 * @param array $params
	 * @return array
	 * 
	 * */
	public function updateUserPassword($params) {
		// формируем массив необходимых параметров
		$data = array(
			"email"    => $params['email'],
			"password" => $params['password']
		);
		$data = array_filter($data);
		// валидация и выполнение необходимых действий
		if ((is_array($data) && !empty($data))) {
			// проверяем email
			if (Validator::isKeyValuePairExists($data, "email")) {
				// проверяем пароль
				if (Validator::isKeyValuePairExists($data, "password")) {
					if ($user_id = $this->isUserExist($data['email'])) {
						// update
						$user = new CUser;
						$fields = Array(
							"PASSWORD"          => $data['password'],
							"CONFIRM_PASSWORD"  => $data['password']
						);
						if ($user->Update($user_id, $fields)) {
							$this->responseArray['status_code'] = "success";
							$this->responseArray['data'] = APITools::getLangPhrase("password_updated");
						} else {
							$this->responseArray['status_code'] = "error";
							$this->responseArray['data'] = $user->LAST_ERROR;
						}
					} else {
						$this->addNew($data);
					}
				} else {
					$this->responseArray['status_code'] = "error";
					$this->responseArray['data'] = sprintf(APITools::getLangPhrase("parameter_missed"), "password");
				}
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

	/**
	 * 
	 * Пытаемся авторизовать пользователя
	 * Вызывается из БК
	 * 
	 * Ожидаемые поля: 
	 * - email
	 * - password
	 * 
	 * @param array $params
	 * @return array
	 * 
	 * */
	public function tryLogin($params) {
		// формируем массив необходимых параметров
		$data = array(
			"email"    => $params['email'],
			"password" => $params['password']
		);
		$data = array_filter($data);
		// валидация и выполнение необходимых действий
		if ((is_array($data) && !empty($data))) {
			// проверяем email
			if (Validator::isKeyValuePairExists($data, "email")) {
				// проверяем пароль
				if (Validator::isKeyValuePairExists($data, "password")) {
					global $USER;
					if (!is_object($USER)) $USER = new CUser;
					$auth_result = $USER->Login($data['email'], $data['password']);
					// если вернулся массив, значит там ошибка
					if (is_array($auth_result)) {
						$this->responseArray['status_code'] = "error";
						$this->responseArray['data'] = $auth_result['MESSAGE'];
					} else {
						$this->responseArray['status_code'] = "success";
						$this->responseArray['data'] = APITools::getLangPhrase("user_authorized");
					}
				} else {
					$this->responseArray['status_code'] = "error";
					$this->responseArray['data'] = sprintf(APITools::getLangPhrase("parameter_missed"), "password");
				}
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
	 * @return array
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
	
	/**
	 * 
	 * Создаем нового пользователя
	 * 
	 * Ожидаемые поля: 
	 * - email
	 * - password
	 * 
	 * @param array $params
	 * @return array
	 * 
	 * */
	public function addNew($params) {
		// формируем массив необходимых параметров
		$data = array(
			"email"    => $params['email'],
			"password" => $params['password']
		);
		$data = array_filter($data);
		// валидация и выполнение необходимых действий
		if ((is_array($data) && !empty($data))) {
			// проверяем email
			if (Validator::isKeyValuePairExists($data, "email")) {
				// проверяем пароль
				if (Validator::isKeyValuePairExists($data, "password")) {
					$user = new CUser;
					$user_fields = Array(
						"EMAIL"             => $data['email'],
						"LOGIN"             => $data['email'],
						"ACTIVE"            => "Y",
						"GROUP_ID"          => array(3, 4, 5),
						"PASSWORD"          => $data['password'],
						"CONFIRM_PASSWORD"  => $data['password'],
					);
					
					$ID = $user->Add($user_fields);
					if (intval($ID) > 0) {
						$this->responseArray['status_code'] = "success";
						$this->responseArray['data'] = APITools::getLangPhrase("user_added");
					} else {
						$this->responseArray['status_code'] = "error";
						$this->responseArray['data'] = $user->LAST_ERROR;
					}
				} else {
					$this->responseArray['status_code'] = "error";
					$this->responseArray['data'] = sprintf(APITools::getLangPhrase("parameter_missed"), "password");
				}
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