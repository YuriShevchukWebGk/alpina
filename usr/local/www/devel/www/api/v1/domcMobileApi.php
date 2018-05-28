<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

define(API_V1, "v1");
define(TOKEN_LIFE_TIME, 2*60*60*24);

CModule::IncludeModule("iblock");
CModule::IncludeModule("main");
CModule::IncludeModule("highloadblock");
CModule::IncludeModule("forum");

class DomcMobileApi {

	//-----------------------------------//
	/*Функции необходимые для работы основного API*/
	//-----------------------------------//

	//Преобразуем json запрос в формат массива, так же проверяет валидность переданных параметров
	public function GetArrayFormPost($arParamsList) {
		$request_body = file_get_contents("php://input");
		$arResultList = json_decode($request_body, true);
		foreach($arResultList as $key => $value) {
			if(!in_array($key, $arParamsList)) {
				unset($arResultList);
			}
		}
		return $arResultList;
	}

	//Проверяет принадлежность ЛС пользователю
	public function isUserAccount($user_id, $ls_id = "", $right = "") {
		if(empty($ls_id) || $ls_id <= 0) {
			return true;
		}

		$dbAccounts = CTszhAccount::GetList(array(), array("USER_ID" => $user_id, "ID" => $ls_id), false, false, array("ID", "USER_ID"));
		if($arAccounts = $dbAccounts->fetch()) {
			if($arAccounts["ID"] == $ls_id && $arAccounts["USER_ID"] == $user_id) {
				return "owner";
			}
		}

		$hlblock = HL\HighloadBlockTable::getList(array('select'=> array("*"), 'filter'=>array("NAME" => 'Residents')))->fetch();
		$entity = HL\HighloadBlockTable::compileEntity($hlblock);
		$entity_data_class = $entity->getDataClass();
		//Сначала проверим есть ли текущий аккаунт в списке лицевых счетов жителей
		$rsResidentAccount = $entity_data_class::getList(array(
		   "select" => array("UF_*"),
		   "order"  => array("ID" => "ASC"),
		   "filter" => array("=UF_USER_ID" => $user_id, "=UF_LS_ID" => $ls_id, "=UF_STATUS" => "", "=UF_ACTIVE" => "1")
		));

		if($arResidentAccount = $rsResidentAccount->Fetch()){
			if($arResidentAccount["UF_LS_ID"] == $ls_id && $arResidentAccount["UF_USER_ID"] == $user_id && $arResidentAccount["UF_ACTIVE"] == 1 && $arResidentAccount["UF_STATUS"] == 0) {
				if(isset($arResidentAccount["UF_RIGHTS_".$right])) {
					if($arResidentAccount["UF_RIGHTS_".$right] > 0) {
						return "resident";
					}
				} else {
					return "resident";
				}
			}
		}
		return false;
	}

	//Проверяет валидность токена и возвращает ID пользователя
	public function GetUserIDByToken($token) {
		if(preg_match('/^[a-f0-9]{32}$/', $token)) {
			$hlblock_token = HL\HighloadBlockTable::getList(array('select'=> array("*"), 'filter'=>array("TABLE_NAME" => 'Tokens')))->fetch();

			if (empty($hlblock_token)) {
				echo('HL block "Tokens" not found.');
				die();
			}

			$entity_token = HL\HighloadBlockTable::compileEntity($hlblock_token);
			$token_data_class = $entity_token->getDataClass();

			$rsTokens = $token_data_class::getList(array(
			   "select" => array("*"),
			   "order"  => array("ID" => "ASC"),
			   "filter" => array("UF_TOKEN" => trim($token))
			));

			if($arToken = $rsTokens->fetch()) {
				if($arToken["UF_TOKEN"] === $token) {
					if(time() - (strtotime($arToken["UF_TOKEN_UPDATE"])) < TOKEN_LIFE_TIME) {
						return $arToken["UF_USER_ID"];
					}
				}
			}
		}
		return false;
	}

	//-----------------------------------//
	/*Авторизация*/
	//-----------------------------------//

	//Преобразуем json запрос в формат массива
	public function GetAuthToken($login, $password, $push_token = "") {
		if (!empty($password)) {
			if(!empty($login)) {
				$userData = CUser::GetByLogin($login)->Fetch();
				if ($userData == null) {
					$filter = Array	(
					    "ACTIVE" => "Y",
					    "EMAIL"  => trim($login),
					);
					$userData = CUser::GetList(($by="active"), ($order="desc"), $filter)->Fetch();
				}
				if ($userData == null) {
					$filter = Array	(
					    "ACTIVE"          => "Y",
					    "PERSONAL_MOBILE" => FormatPhone($login),
					);
					$userData = CUser::GetList(($by="active"), ($order="desc"), $filter)->Fetch();
				}
			}
			if(!empty($userData) && $userData["ACTIVE"] == "Y") {
				$salt = substr($userData['PASSWORD'], 0, (strlen($userData['PASSWORD']) - 32));
				$realPassword = substr($userData['PASSWORD'], -32);
				$password = md5($salt.$password);
				if($password === $realPassword) {

					$hlblock_token = HL\HighloadBlockTable::getList(array('select'=> array("*"), 'filter'=>array("NAME" => 'Tokens')))->fetch();
					$token_entity = HL\HighloadBlockTable::compileEntity($hlblock_token);
					$token_data_class = $token_entity->getDataClass();

					$rsTokens = $token_data_class::getList(array(
					   "select" => array("*"),
					   "order"  => array("ID" => "ASC"),
					   "filter" => array("UF_USER_ID" => $userData["ID"])
					));

					$token = trim(md5($login.$password.API_V1.TOKEN_LIFE_TIME.time()));
					$user_id = $userData["ID"];

					//Сохраняем обычный токен
					if($token_data_class::add(array(
						"UF_TOKEN" 			=> $token,
						"UF_USER_ID" 		=> $user_id,
						"UF_TOKEN_UPDATE" 	=> date("d.m.Y H:i:s", time()),
					))) {

						$hlblock_push = HL\HighloadBlockTable::getList(array('select'=> array("*"), 'filter'=>array("NAME" => 'Pushtokens')))->fetch();
						$push_entity = HL\HighloadBlockTable::compileEntity($hlblock_push);
						$push_data_class = $push_entity->getDataClass();

						if(!empty($push_token)) {
							//Сохраняем push токен
							if($push_data_class::add(array(
								"UF_USER_ID" 		=> $user_id,
								"UF_PUSH_TOKEN" 	=> $push_token,
							))) {
								$arResult["result"] = 0;
								$arResult["items"] = array(
									"token"   		  => $token,
									"token_life_time" => IntVal(TOKEN_LIFE_TIME),
									"user_id" 		  => IntVal($userData["ID"])
								);
							} else {
								$arResult["result"] = 4;
							};
						} else {
							$arResult["result"] = 0;
							$arResult["items"] = array(
								"token"   		  => $token,
								"token_life_time" => IntVal(TOKEN_LIFE_TIME),
								"user_id" 		  => IntVal($userData["ID"])
							);
						}
					} else {
						$arResult["result"] = 4;
					};
				} else {
					$arResult["result"] = 1;
				};
			} else {
				$arResult["result"] = 1;
			}
		} else {
			$arResult["result"] = 4;
		}
		return json_encode($arResult);
	}

	//Проверка существования пользователя по запрошенным данным
	public function GetUserForRenewPassword($login = "", $email = "", $phone = "") {
		$userFilter["ACTIVE"] = "Y";
		if(!empty($login)) {
			$userFilter["LOGIN"] = trim($login);
			$authMethod = "login";
		} elseif(!empty($email)) {
			$userFilter["EMAIL"] = trim($email);
			$authMethod = "email";
		} elseif(!empty($phone)) {
			$userFilter["PERSONAL_MOBILE"] = FormatPhone($phone);
			$authMethod = "phone";
		} else {
			return array("api_error" => "4");
		}

		$rsUsers = Bitrix\Main\UserTable::getList(Array(
		   "select" => Array("ID", "UF_CHECKWORD", "DATE_REGISTER", "EMAIL", "PERSONAL_MOBILE"),
		   "filter" => $userFilter
		));

		if($arUser = $rsUsers->fetch()) {
			$arGroupsID = CUser::GetUserGroup($arUser["ID"]);
			//Для администраторов смена пароля недоступна на любом этапе
			if(in_array("1", $arGroupsID)) {
				return array("api_error" => 3);
			}
			$arUser["authMethod"] = $authMethod;
			return $arUser;
		} else {
			return array("api_error" => 5);
		}
	}

	//Смена пароля, необходимо реализовать отправку данных, и ограничить отправку данных
	public function RenewPassword($login = "", $email = "", $phone = "", $code = "", $md5_code = "", $new_password = "") {
		//1 шаг, запрос пароля, сохраним информацию о методе и времени создания
		if((!empty($login) || !empty($email) || !empty($phone)) && empty($code) && empty($md5_code) && empty($new_password)) {
			$arUser = self::GetUserForRenewPassword($login, $email, $phone);
			if(empty($arUser["api_error"])) {
				$code_rand = rand(10000, 99999);
				$userOb = new CUser;
				$userFields = Array(
					"UF_CHECKWORD" => time().";".$arUser["authMethod"].";".$code_rand,
				);
				if($userOb->Update($arUser["ID"], $userFields)) {
					if(!empty($phone) && empty($login) && empty($email)) {
						$mtsObj = new MTSCommunikator;
						$result = $mtsObj->SendMessage($arUser["PERSONAL_MOBILE"], "Ваш код: ".$code_rand);
						if($result) {
							$arResult["result"] = 0;
						} else {
							$arResult["result"] = 5;
						};
					} elseif(empty($phone) && (!empty($login) || !empty($email))) {
						//Письмо о активации
						$arMailFields = array(
							"СODE"  => $code_rand,
							"EMAIL" => $arUser["EMAIL"]
						);
						if(CEvent::Send("SEND_CODE_MOBILE_API", "s1", $arMailFields, "Y") > 0) {
							$arResult["result"] = 0;
						} else {
							$arResult["result"] = 5;
						};
					} else {
						$arResult["result"] = 5;
					}
				} else {
					$arResult["result"] = 5;
				};
			} else {
				$arResult["result"] = $arUser["api_error"];
			}
		} elseif((!empty($login) || !empty($email) || !empty($phone)) && !empty($code) && empty($md5_code) && empty($new_password)) {
			//2 шаг, верификация кода
			$arUser = self::GetUserForRenewPassword($login, $email, $phone);
			if(empty($arUser["api_error"])) {
				$codeArray = explode(";", $arUser["UF_CHECKWORD"]);
				//Время заменить на контсанту
				if((time() - IntVal($codeArray[0]) < 120) && (time() - IntVal($codeArray[0]) > 0) && ($codeArray[1] == $arUser["authMethod"]) && ($codeArray[2] == $code)) {
					//После первой верификации поменяем код, но при этом сохраним данные о времени создания и типе аутентификации
					$new_code = substr(md5($codeArray[2]), 6);
					$new_pass_code = $codeArray[0].";".$codeArray[1].";".$new_code;
					$arResult["result"] = 0;
					//Очень важно нормально организовать хранение для константы
					$arResult["items"]  = array(
						"md5_code" => md5($codeArray[0].$codeArray[1].$new_code.$arUser["ID"].$arUser["DATE_REGISTER"].SALT_CONST)
					);
					//Поменяем код, для того, чтобы было возможно воспользоваться кодом только единожды
					$userOb = new CUser;
					$userFields = Array(
						"UF_CHECKWORD" => $new_pass_code,
					);
					if(!$userOb->Update($arUser["ID"], $userFields)) {
						unset($arResult);
						$arResult["result"] = 5;
					};
				} else {
					$arResult["result"] = 3;
				}
			} else {
				$arResult["result"] = $arUser["api_error"];
			}
		} elseif((!empty($login) || !empty($email) || !empty($phone)) && empty($code) && !empty($md5_code) && !empty($new_password)) {
			//3 шаг, верификация md5 строки, смена пароля
			$arUser = self::GetUserForRenewPassword($login, $email, $phone);
			if(empty($arUser["api_error"])) {
				$codeArray = explode(";", $arUser["UF_CHECKWORD"]);
				if((time() - IntVal($codeArray[0]) < MOBILE_API_CODE_LIFETIME) && (time() - IntVal($codeArray[0]) > 0) && $md5_code == md5($codeArray[0].$codeArray[1].$codeArray[2].$arUser["ID"].$arUser["DATE_REGISTER"].SALT_CONST)) {
					//Успешная смена пароля, возможно добавить проверку сложности пароля
					$userOb = new CUser;
					$userFields = Array(
						"PASSWORD"          => $new_password,
						"CONFIRM_PASSWORD"  => $new_password,
						"UF_CHECKWORD" 		=> "",
					);
					if(!$userOb->Update($arUser["ID"], $userFields)) {
						unset($arResult);
						$arResult["result"] = 5;
					} else {
						$arResult["result"] = 0;
					};
				} else {
					$arResult["result"] = 3;
				}
			} else {
				$arResult["result"] = $arUser["api_error"];
			}
		}
		return json_encode($arResult);
	}


	//-----------------------------------//
	/*Настройки ЛК*/
	//-----------------------------------//

	//Возвращает список лицевых счетов по токену, или один лс, если передан идентификатор счета
	public function GetLsList($token, $ls_id = "") {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id)) {
				return json_encode(array("result" => 3));
			}
			//Для оптимизации подумать как не получать все сразу при указанном лс
			$arAccounts = CDomcAccount::GetAllByUserID($userID, true);
			foreach ($arAccounts as $arAccount) {
				$ls = array();
				$building_id = IntVal(CDomcAccount::GetObjectIDFromAccount($arAccount["ID"]));

				$ls = array(
					"ls_id" 		=> IntVal($arAccount["ID"]),
					"ls_number" 	=> $arAccount["XML_ID"],
					"is_owner" 		=> $arAccount["RESIDENT"] == "Y" ? 0 : 1,
					"address" 		=> CDomcAccount::GetAccountFullAddress($arAccount["ID"]),
					"building_id" 	=> IntVal($building_id),
					"residental_id" => IntVal($arAccount["HOUSE_ID"]),
					"balance"		=> FloatVal(0 - floatval(CDomcAccount::GetAccountBalance($arAccount["ID"], true)))
				);

				$uk_phone = CDomcMain::GetObjectPhone($building_id);
				if(!empty($uk_phone)) {
					$ls["uk_phone"] = $uk_phone;
				}

				$tszh_id = $arAccount["TSZH_ID"];
				if($tszh_id > 0){
					$dbTszh = CTszh::GetList(array(), array("ID" => $tszh_id), false, false, array("METER_VALUES_START_DATE", "METER_VALUES_END_DATE"));
					if($arTszh = $dbTszh -> fetch()){
						$ls["day_counters_input"] = $arTszh["METER_VALUES_START_DATE"];
						$ls["day_counters_stop"]  = $arTszh["METER_VALUES_END_DATE"];
					}

					$ls["need_new_values"] = false;
					if(CTszh::IsMeterValuesInputEnabled($tszh_id)) {
						$ls["need_new_values"] = true;
					}
				}

				if($arAccount["RESIDENT"] == "Y") {
					$ls["rights"] = array (
						"ls_id" 	 => IntVal($arAccount["ID"]),
						"epd_view"	 =>	$arAccount["RIGHTS"]["EPD_VIEW"]   ? true : false,
						"epd_pay"	 =>	$arAccount["RIGHTS"]["EPD_PAY"]    ? true : false,
						"ls_pay"	 =>	$arAccount["RIGHTS"]["LS_PAY"]     ? true : false,
						"bid_create" =>	$arAccount["RIGHTS"]["BID_CREATE"] ? true : false,
						"bid_pay"	 =>	$arAccount["RIGHTS"]["BID_PAY"]    ? true : false,
						"app_create" =>	$arAccount["RIGHTS"]["APP_CREATE"] ? true : false,
						"poll_view"  =>	$arAccount["RIGHTS"]["POLL_VIEW"]  ? true : false,
						"cam_view"	 =>	$arAccount["RIGHTS"]["CAM_VIEW"]   ? true : false,
						"pstats"  	 =>	$arAccount["RIGHTS"]["PSTATS"]     ? true : false,
						"meters"	 =>	$arAccount["RIGHTS"]["METERS"]     ? true : false
					);
				}
				if($ls_id > 0) {
					if($arAccount["ID"] == $ls_id) {
						$result_ls = $ls;
					}
				} else {
					$lses[] = $ls;
				}
			}
			if(!empty($result_ls)) {
				$arResult["result"] = 0;
				$arResult["items"][] = $result_ls;
			} elseif(!empty($lses)) {
				$arResult["result"] = 0;
				$arResult["items"] = $lses;
			} else {
				$arResult["result"] = 0;
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//Возвращает информацию о жителях по указанному ЛС, или один лс, если передан идентификатор жителя
	public function GetTenantList($token, $ls_id, $tenant_id = "") {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id)) {
				return json_encode(array("result" => 3));
			}
			$arAccounts = CDomcAccount::GetResidentsByAccountID($ls_id, $tenant_id, true);
			foreach($arAccounts as $arAccount) {
				$tenant = array(
					"user_id"	  => IntVal($arAccount["USER_ID"]),
					"last_name"   => $arAccount["LAST_NAME"],
					"first_name"  => $arAccount["NAME"],
					"second_name" => $arAccount["SECOND_NAME"],
					"email" 	  => $arAccount["EMAIL"],
					"phone"       => $arAccount["PERSONAL_MOBILE"],
					"rights"	  => array(
						"epd_view"	 =>	$arAccount["RIGHTS"]["EPD_VIEW"]   ? true : false,
						"epd_pay"	 =>	$arAccount["RIGHTS"]["EPD_PAY"]    ? true : false,
						"ls_pay"	 =>	$arAccount["RIGHTS"]["LS_PAY"]     ? true : false,
						"bid_create" =>	$arAccount["RIGHTS"]["BID_CREATE"] ? true : false,
						"bid_pay"	 =>	$arAccount["RIGHTS"]["BID_PAY"]    ? true : false,
						"app_create" =>	$arAccount["RIGHTS"]["APP_CREATE"] ? true : false,
						"poll_view"  =>	$arAccount["RIGHTS"]["POLL_VIEW"]  ? true : false,
						"cam_view"	 =>	$arAccount["RIGHTS"]["CAM_VIEW"]   ? true : false,
						"pstats"  	 =>	$arAccount["RIGHTS"]["PSTATS"]  ? true : false,
						"meters"	 =>	$arAccount["RIGHTS"]["METERS"]   ? true : false
					)
				);
				$tenant = array_filter($tenant, function($value) { return $value !== NULL && $value !== '';});
				$tenants[] = $tenant;
			}
			$arResult["result"] = 0;
			$arResult["items"] = $tenants;
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//Возвращает информацию о пользователе
	public function GetUserInfo($token) {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			$arUser = CUser::GetByID($userID)->fetch();
			//Форум
			if(!empty($arUser)) {
				$arForumUser = CForumUser::GetByUSER_ID($arUser["ID"]);
				$arResult["result"] = 0;
				$items = array(
					"last_name"   => $arUser["LAST_NAME"],
					"first_name"  => $arUser["NAME"],
					"second_name" => $arUser["SECOND_NAME"],
					"email" 	  => $arUser["EMAIL"],
					"phone"       => $arUser["PERSONAL_MOBILE"],
					"nickname"    => $arForumUser["SIGNATURE"]
				);
				$items = array_filter($items, function($value) { return $value !== NULL && $value !== '';});
				if(!empty($items)) {
					$arResult["items"] = $items;
				}
			} else {
				$arResult["result"] = 5;
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//Смена пользовательской информации
	public function SetUserInfo($token, $type = "", $value = "", $code = "", $password = "") {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!empty($code) && empty($type) && empty($value) && empty($password)) {
				$userFilter["ID"] = $userID;
				$rsUsers = Bitrix\Main\UserTable::getList(Array(
				   "select" => Array("ID", "UF_CHECKWORD"),
				   "filter" => $userFilter
				));

				if($arUser = $rsUsers->fetch()) {
					$arNewValues = explode(":", $arUser["UF_CHECKWORD"]);
					if($code == $arNewValues[2]) {

						$userOb = new CUser;
						if($arNewValues[0] == "email") {
							$userFields = Array(
								"EMAIL" => $arNewValues[1],
							);
						}
						if($arNewValues[0] == "phone") {
							$userFields = Array(
								"PERSONAL_MOBILE" => FormatPhone($arNewValues[1]),
							);
						}
						$userFields["UF_CHECKWORD"] = "";

						if($userOb->Update($userID, $userFields)) {
							$arResult["result"] = 0;
						}
						//Очистить поле с кодом
					}
				}
			} elseif(empty($code) && (!empty($password) && ($type == "email" && filter_var($value, FILTER_VALIDATE_EMAIL)) || ($type == "phone" && FormatPhone($value) != false)) && !empty($value)) {

				$userFilter["ID"] = $userID;
				$userFilter["ACTIVE"] = "Y";
				$rsUsers = Bitrix\Main\UserTable::getList(Array(
				   "select" => Array("ID", "ACTIVE", "UF_CHECKWORD", "PERSONAL_MOBILE", "EMAIL", "PASSWORD"),
				   "filter" => $userFilter
				));



				$arUser = $rsUsers->fetch();

				if(!empty($arUser) && $arUser["ACTIVE"] == "Y") {
					$salt = substr($arUser['PASSWORD'], 0, (strlen($arUser['PASSWORD']) - 32));
					$realPassword = substr($arUser['PASSWORD'], -32);
					$password = md5($salt.$password);
					if($password === $realPassword) {
						$userOb = new CUser;
						$code = rand(10000, 99999);

						$userFields = Array(
							"UF_CHECKWORD" => $type.":".$value.":".$code
						);

						if(!$userOb->Update($userID, $userFields)) {
							unset($arResult);
							$arResult["result"] = 5;
						} else {
							if($type == "phone") {
								$mtsObj = new MTSCommunikator;
								$result = $mtsObj->SendMessage(FormatPhone($value), "Ваш код: ".$code);
								if($result) {
									$arResult["result"] = 0;
								} else {
									$arResult["result"] = 5;
								};
							} elseif($type == "email") {
								//Письмо о активации
								$arMailFields = array(
									"СODE"  => $code,
									"EMAIL" => trim($value)
								);
								if(CEvent::Send("SEND_CODE_MOBILE_API", "s1", $arMailFields, "Y") > 0) {
									$arResult["result"] = 0;
								} else {
									$arResult["result"] = 5;
								};
							} else {
								$arResult["result"] = 5;
							}
						};
					} else {
						$arResult["result"] = 3;
					}
				}
			} elseif(empty($code) && ($type == "nickname") && !empty($value)) {
				if(CModule::IncludeModule("forum")) {
					$arForumUser = CForumUser::GetByUSER_ID($userID);
					if(CForumUser::Update($arForumUser["ID"], array("SIGNATURE" => $value))) {
						$arResult["result"] = 0;
					};
				}
			}

			if(!isset($arResult["result"])) {
				$arResult["result"] = 5;
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//Метод получения уведомлений
	public function GetIncomingMessages($token, $ls_id, $date_from = "", $date_to = "", $count = ""){
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id)) {
				return json_encode(array("result" => 3));
			}

			$object_id = CDomcAccount::GetObjectIDFromAccount($ls_id);

			$NTF_TYPE_VALUE = get_ib_prop_val_by_xml_id(IB_UT_NOTIFICATIONS_LK, 'NTF_TYPE', 'XML_NFTTO_ALL');

			$arSelect = Array("ID", "NAME", "DATE_CREATE", "PREVIEW_TEXT", "PROPERTY_TYPE", "PROPERTY_PAYMENT");
			$arFilter = Array("IBLOCK_ID"=>IntVal(IB_UT_NOTIFICATIONS_LK), "ACTIVE"=>"Y",
				array(
					'LOGIC' => 'OR',
					array(
						'PROPERTY_USER_ID' => $userID,
						'PROPERTY_ACCOUNT_ID' => $ls_id,
						'!PROPERTY_USER_ID' => false,
						'!PROPERTY_ACCOUNT_ID' => false
					),
					array(
						'=PROPERTY_ZKH_ID' => $object_id,
						'!PROPERTY_ZKH_ID' => false
					),
					array(
						'PROPERTY_NTF_TYPE_VALUE' =>  $NTF_TYPE_VALUE,
						'!PROPERTY_NTF_TYPE_VALUE' => false
					)
			));

			if(!empty($date_from)) {
				$date_from = new DateTime($date_from);
				$arFilter[">=DATE_CREATE"] = $date_from->format('d.m.Y H:i:s');
			}
			if(!empty($date_to)) {
				$date_to = new DateTime($date_to);
				$arFilter["<=DATE_CREATE"] = $date_to->format('d.m.Y H:i:s');
			}

			if($count > 0){
				$navParams = Array("nPageSize" => $count);
			} else {
				$navParams = Array();
			}

			$dbFields = CIBlockElement::GetList(Array("created" => "desc"), $arFilter, false, $navParams, $arSelect);
			while($arFields = $dbFields->fetch()) {
				$input_date = "";
				if(!empty($arFields["DATE_CREATE"])) {
					$input_date = new DateTime($arFields["DATE_CREATE"]);
					$input_date = $input_date->format('c');
				}
				$incoming[] = array(
					"id"      => $arFields["ID"],
					"date"    => $input_date,
					"payment" => $arFields["PROPERTY_PAYMENT_VALUE"] ? true : false,
					"name"    => $arFields["NAME"],
					"text"    => $arFields["PREVIEW_TEXT"]

				);
			}
			if(!empty($incoming)) {
				$arResult["items"] = $incoming;
			}
			$arResult["result"] = 0;
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//Метод получения уведомлений
	public function GetNotificationsSettings($token, $ls_id){
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id)) {
				return json_encode(array("result" => 3));
			}
			$arNotificationsMatching = array(
				"UT_CHANGE_USER_PROFILE_BY_ADMIN" => "profile_changed",
				"UT_USER_BIRTHDAY"				  => "bday",
				"UT_NOTIFY_CREATE"				  => "appeal_created",
				"UT_NOTIFY_CHANGE_STATUS"		  => "appeal_updated",
				"UT_LS_CREATE"					  => "ls_opened",
				"UT_LS_CLOSE"					  => "ls_closed",
				"UT_LS_CHARGES_PAYMENT"	 		  => "epd_received",
				"UT_CHANGE_PASSWORD"			  => "password_changed",
				"UT_PERIOD_METER_READ"			  => "meters",
				"UT_PAYMENT_OK"					  => "payment_received",
				"UT_EMERGENCE_DEBT"	 		      => "emergency_debt",
				"UT_NEW_VOTE_LIST"			  	  => "new_vote",
				"UT_NEW_POLL"			  		  => "new_poll"
			);
	        $arUserNotifys = get_user_notifications_settings($user_id, $ls_id);
			foreach ($arUserNotifys as $id => $arNotification) {
				if(!empty($arNotificationsMatching[$arNotification["NOTIFY_CODE"]])) {
					$arResult["result"] = 0;
					if($arNotification["NOTIFY_CODE"] == "UT_EMERGENCE_DEBT") {
						$arResult["items"][$arNotificationsMatching[$arNotification["NOTIFY_CODE"]]] = array(
							"email" => 2,
							"push"  => 2,
							"sms"   => 2
						);
					} else {
						$arResult["items"][$arNotificationsMatching[$arNotification["NOTIFY_CODE"]]] = array(
							"email" => $arNotification["ENABLE_CHANNELS"]["EMAIL"] == "Y" ? ($arNotification["USER_CHANNELS"]["EMAIL"] == "Y" ? 1 : 0) : 3,
							"push"  => $arNotification["ENABLE_CHANNELS"]["PUSH"] == "Y" ? ($arNotification["USER_CHANNELS"]["PUSH"] == "Y" ? 1 : 0) : 3,
							"sms"   => $arNotification["ENABLE_CHANNELS"]["SMS"] == "Y" ? ($arNotification["USER_CHANNELS"]["SMS"] == "Y" ? 1 : 0) : 3,
						);
					}
				};
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//Метод установки новых значений для уведомлений
	public function SetNotificationsSettings($token, $ls_id, $notifications) {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id)) {
				return json_encode(array("result" => 3));
			}

			$arNotificationsMatching = array(
				"UT_CHANGE_USER_PROFILE_BY_ADMIN" => "profile_changed",
				"UT_USER_BIRTHDAY"				  => "bday",
				"UT_NOTIFY_CREATE"				  => "appeal_created",
				"UT_NOTIFY_CHANGE_STATUS"		  => "appeal_updated",
				"UT_LS_CREATE"					  => "ls_opened",
				"UT_LS_CLOSE"					  => "ls_closed",
				"UT_LS_CHARGES_PAYMENT"	 		  => "epd_received",
				"UT_CHANGE_PASSWORD"			  => "password_changed",
				"UT_PERIOD_METER_READ"			  => "meters",
				"UT_PAYMENT_OK"					  => "payment_received",
				"UT_EMERGENCE_DEBT"	 		      => "emergency_debt",
				"UT_NEW_VOTE_LIST"			  	  => "new_vote",
				"UT_NEW_POLL"			  		  => "new_poll"
			);
			$arSettingMatching = array(
				"email" => "EMAIL",
				"push"	=> "PUSH",
				"sms"	=> "SMS"
			);
			$arUserNotifys = get_user_notifications_settings($user_id, $ls_id, true);
			//получить значения свойства для сохранения по их id
		    $property_enums = CIBlockPropertyEnum::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>IB_UT_NOTIFICATIONS_CONFIG, "CODE"=>"CHANNELS"));
		    $arPropsIDs = array();
		    while ($enum_fields = $property_enums->GetNext()) {
		        $arPropsIDs[$enum_fields['VALUE']] = $enum_fields['ID'];
		    }

			foreach ($arUserNotifys as $notify_id => $arNotification) {
		        $arChanelsVIDs = false;
				$notify_api_code = $arNotificationsMatching[$arNotification["NOTIFY_CODE"]];
		        if(isset($notifications[$notify_api_code])) {
		            $arChanelsVIDs = array();
		            foreach ($notifications[$notify_api_code] as $notify_type => $value) {
		                if (isset($arPropsIDs[$arSettingMatching[$notify_type]]) && ($arNotification["ENABLE_CHANNELS"][$arSettingMatching[$notify_type]] == "Y") && $value == 1) {
		                    $arChanelsVIDs[] = $arPropsIDs[$arSettingMatching[$notify_type]];
						}
		            }
			        if ($arNotification['ID']) {
			            //В api уведомлений скорее всего ошибка
						if(empty($arChanelsVIDs)) {
							$arChanelsVIDs = false;
						}
			            CIBlockElement::SetPropertyValuesEx($arNotification['ID'], IB_UT_NOTIFICATIONS_CONFIG, array('CHANNELS' => $arChanelsVIDs));
						$arResult["result"] = 0;
			        } else {
						$elm = new CIBLockElement;
			            //создание новой записи для юзера
			            $PROP = array(
			                'CHANNELS' => $arChanelsVIDs,
			                'NOTIFY_ID' => $notify_id,
			                'USER_ID' => $userID,
			                'ACCOUNT_ID' => $ls_id
			            );
			            $arLoadProductArray = Array(
			                "IBLOCK_ID" => IB_UT_NOTIFICATIONS_CONFIG,
			                "NAME" => "u".$userID."_a".$ls_id."_n".$notify_id,
			                "PROPERTY_VALUES" => $PROP,
			            );
			            $res = $elm->Add($arLoadProductArray);
			            if (!$res) {
							$arResult["result"] = 5;
						} else {
							$arResult["result"] = 0;
						}
			        }
				}
		    }
			if(!isset($arResult["result"])) {
				$arResult["result"] = 5;
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//Добавление/изменение жителя
	public function ChangeTenant($token, $ls_id, $operation, $params = "", $tenant_id = "") {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id)) {
				return json_encode(array("result" => 3));
			}
			if($operation == 1 || $operation == 2) {
				$access = array(
					"EPD_VIEW" => $params["access"]["epd_view"] ? '1' : '0',
					"EPD_PAY" => $params["access"]["epd_pay"] ? '1' : '0',
					"LS_PAY" => $params["access"]["ls_pay"] ? '1' : '0',
					"BID_CREATE" => $params["access"]["bid_create"] ? '1' : '0',
					"BID_PAY" => $params["access"]["bid_pay"] ? '1' : '0',
					"APP_CREATE" => $params["access"]["app_create"] ? '1' : '0',
					"POLL_VIEW" => $params["access"]["poll_view"] ? '1' : '0',
					"CAM_VIEW" => $params["access"]["cam_view"] ? '1' : '0',
					"PSTATS" => $params["access"]["pstats"] ? '1' : '0',
					"METERS" => $params["access"]["meters"] ? '1' : '0'
				);
			}
			switch ($operation) {
				//Создание нового жителя
			    case 1:
					$result = CDomcAccount::AddNewResident($userID,
														   $ls_id,
														   $params["name"],
														   $params["last_name"],
														   $params["second_name"],
														   $params["email"],
														   $params["personal_mobile"],
														   $access);
		        break;
				//Обновление существующего жителя
			    case 2:
					if(!empty($tenant_id) && $tenant_id > 0) {
						$result = CDomcAccount::UpdateResident($ls_id, $tenant_id, $access);
					} else {
						$arResult["result"] = 4;
					}
		        break;
			    case 3:
					$result = CDomcAccount::SwitchResident($ls_id, $tenant_id, 0);
		        break;
			    case 4:
					$result = CDomcAccount::SwitchResident($ls_id, $tenant_id, 1);
		        break;
			}

			if($result && !isset($arResult["result"])) {
				$arResult["result"] = 0;
			} else {
				$arResult["result"] = 5;
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//-----------------------------------//
	/*ЕПД и начисления*/
	//-----------------------------------//

	public function GetEpdList($token, $ls_id, $period_id) {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id, "EPD_VIEW")) {
				return json_encode(array("result" => 3));
			}
			$arBalance = CDomcAccount::GetAccountBalance($ls_id, false, $period_id);
			if(!empty($arBalance)) {
				$arResult["result"] = 0;
				foreach ($arBalance as $epd) {
					$item = array(
						"period_id"		=> IntVal($epd["ID"]),
						"period_name"   => $epd["DISPLAY_NAME"],
						"period_date"   => $epd["DATE"],
						"balance_start" => FloatVal(0 - $epd["TOTAL_DEBT_BEG"]),
						"balance_end"   => FloatVal(0 - $epd["TOTAL_DEBT_END"]),
						"total_accrued" => FloatVal($epd["TOTAL_CHARGES"]),
						"total_payed"   => FloatVal($epd["TOTAL_PAYED"]),
					);

					if(!empty($epd["DATE"])) {
						$input_date = new DateTime($epd["DATE"]);
						$input_date = $input_date->format('c');
					}
					$item["period_date"] = $input_date;

					if($period_id > 0) {
						foreach ($epd["BARCODES"] as $barcode) {
							$item["barcodes"][] = array(
								"type"  => $barcode["TYPE"],
								"value" => $barcode["VALUE"]
							);
						}
					}
					$item = array_filter($item, function($value) { return $value !== NULL && $value !== '';});
					if(!empty($item)) {
						$arResult["items"][] = $item;
					}
				}
			} else {
				$arResult["result"] = 5;
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//Список платежей по ЛС
	public function GetPaymentList($token, $ls_id, $date_from, $date_to) {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id, "PSTATS")) {
				return json_encode(array("result" => 3));
			}
			//Обезопасить функцию
			//Вшить получение XML_ID внутри функции, нужно поправить send-request-ws.php
			$dbAccounts = CTszhAccount::GetList(array(), array("USER_ID" => $userID, "ID" => $ls_id), false, false, array("XML_ID"));
			if(empty($date_from) && empty($date_to)) {
				$date_from = date("01.m.Y", strtotime("-3 month", time()));
				$date_to = date("t.m.Y");
			}

			if($arAccount = $dbAccounts->fetch()) {
				$arPayments = CDomcOrder::GetPaymentList($arAccount["XML_ID"], date("Y-m-d\T00:00:00.000\Z", strtotime($date_from)), date("Y-m-d\T00:00:00.000\Z", strtotime($date_to)));
			}
			foreach($arPayments as $arPayment) {
				if(empty($arPayment["payments_date"]) || $arPayment["payments_date"] == "0001-01-01T00:00:00") {
					unset($arPayment["payments_date"]);
				} else {
					$input_date = new DateTime($arPayment["payments_date"]);
					$input_date = $input_date->format('c');
				}
				$item = array(
					"receipt_date"   => $input_date,
					"payment_source" => (string)$arPayment["payment_from"],
					"payment_reason" => (string)$arPayment["payment_reason"],
					"payment_sum"    => FloatVal($arPayment["amount"])
				);
				$item = array_filter($item, function($value) { return $value !== NULL && $value !== '';});
				$items[] = $item;
			}
			$arResult["result"] = 0;
			if(!empty($items)) {
				$arResult["items"]  = $items;
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//-----------------------------------//
	/*Получение и ввод показаний счетчиков*/
	//-----------------------------------//

	//Установка новых показаний для счетчиков
	public function SetCounterValue($token, $ls_id, $meter_id, $new_name, $meter_values) {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id, "METERS")) {
				$arResult["result"] = 3;
				return json_encode($arResult);
			}

			$allow_edit_by_period = CTszh::IsMeterValuesInputEnabled(CDomcAccount::GetTszhID($ls_id));
			// разрешено ли пользователю вносить/корректировать текущие показания счетчиков
			$allow_edit = CTszhMeter::CanPostMeterValues() && $allow_edit_by_period;
			if(!$allow_edit) {
				$arResult["result"] = 5;
				return json_encode($arResult);
			}
			//Получим счетчик
			$dbResult = CTszhMeter::GetList(Array('SORT' => 'ASC', 'NAME' => 'ASC'),
				Array(
					"ID"  		  => $meter_id,
					"ACCOUNT_ID"  => $ls_id,
					"ACTIVE"      => "Y",
					"HOUSE_METER" => "N"
				));

			if(!($arMeter = $dbResult->GetNext(true, false))) {
				$arResult["result"] = 5;
				return json_encode($arResult);
			}

			$meterFields = array();
			if(!empty($new_name)) {
				$meterFields = array(
					"NAME" => $new_name
				);
			}

			$timeMonth = $timeNextMonth = time();

			//Получим значения счетчика, актуальные и за предыдущий период
			$rsMeterValue = CTszhMeterValue::GetList(
				Array('TIMESTAMP_X' => 'DESC', "ID" => "DESC"),
				Array(
					'METER_ID' => $arMeter['ID'],
				), false, Array('nTopCount' => 1)
			);

			$rsMeterValueBefore = CTszhMeterValue::GetList(
				Array('TIMESTAMP_X' => 'DESC', "ID" => "DESC"),
				Array(
					'METER_ID'          => $arMeter['ID'],
					'<TIMESTAMP_X'      => ConvertTimeStamp($timeMonth, "FULL"),
					'MODIFIED_BY_OWNER' => "N",
				), false, Array('nTopCount' => 1)
			);

			$arMeter['VALUE'] = $rsMeterValue->GetNext(true, false);
			$arMeter['PREV_VALUE'] = $rsMeterValueBefore->GetNext(true,false);

			$arUpdateValue = Array(
				'METER_ID' => $meter_id,
			);

			if(count($meter_values) > 0) {
				for($tariff_id = 1; $tariff_id <= $arMeter["VALUES_COUNT"]; $tariff_id++) {
					//Проверка по значениям счетчика
					if(isset($arMeter['PREV_VALUE']['VALUE'.StrVal($tariff_id)])) {
						if(isset($meter_values[$tariff_id - 1])) {
							if(FloatVal($arMeter['PREV_VALUE']['VALUE'.StrVal($tariff_id)]) > FloatVal($meter_values[$tariff_id - 1])) {
								$arResult["result"] = 5;
								return json_encode($arResult);
							} else {
								$arUpdateValue['VALUE'.StrVal($tariff_id)] = $meter_values[$tariff_id - 1];
							}
						} else {
							if(FloatVal($arMeter['PREV_VALUE']['VALUE'.StrVal($tariff_id)]) < FloatVal($arMeter['VALUE']['VALUE'.StrVal($tariff_id)])) {
								$arUpdateValue['VALUE'.StrVal($tariff_id)] = FloatVal($arMeter['PREV_VALUE']['VALUE'.StrVal($tariff_id)]);
							} else {
								$arUpdateValue['VALUE'.StrVal($tariff_id)] = FloatVal($arMeter['VALUE']['VALUE'.StrVal($tariff_id)]);
							}
						}
					}
				}

				if(CTszhMeterValue::Add($arUpdateValue) && CTszhMeter::Update($meter_id, $meterFields)) {
					$arResult["result"] = 0;
				} else {
					$arResult["result"] = 5;
				};
			} else {
				$arResult["result"] = 5;
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//Получение списка счетчиков
	public function GetCountersList($token, $ls_id) {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id, "METERS")) {
				return json_encode(array("result" => 3));
			}
			$arMeters = CDomcAccount::GetAccountMeters($ls_id);
			//Фильтр по дате убираем, добавляем количество значений, ввод показаний выше
			foreach($arMeters["ITEMS"] as $arMeter) {
				$new_values = array();
				$values = array();
				$n = 1;
				if(IntVal($arMeter["VALUES_COUNT"]) > 0) {
					while($n <= IntVal($arMeter["VALUES_COUNT"])) {
						$new_values[] = FloatVal($arMeter["VALUE"]["VALUE".$n]);
						$values[]	  = FloatVal($arMeter["PREV_VALUE"]["VALUE".$n]);
						$n++;
					}
				}
				$counters[] = array(
					"counter_id"		=> IntVal($arMeter["ID"]),
					"counter_num"   	=> $arMeter["NUM"],
					"counter_name" 		=> $arMeter["NAME"],
					"service_name" 		=> $arMeter["SERVICE_NAME"],
					"values_count" 		=> IntVal($arMeter["VALUES_COUNT"]),
					"digits_int"   		=> IntVal($arMeter["CAPACITY"]),
					"digits_dec" 		=> IntVal($arMeter["DEC_PLACES"]),
					"new_values"   		=> $new_values,
					"values" 			=> $values,
					"need_new_values"	=> $arMeters["allow_edit"] ? true : false,
				);
			}

			$arResult["result"] = 0;
			$arResult["items"] = $counters;
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//История внесения показаний
	public function GetCounterHistory($token, $ls_id, $counter_id) {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id, "METERS")) {
				return json_encode(array("result" => 3));
			}

			$dbResult = CTszhMeter::GetList(Array('SORT' => 'ASC', 'NAME' => 'ASC'),
				Array(
					"ACCOUNT_ID"   => $ls_id,
					"ID"		   => $counter_id,
					"ACTIVE"       => "Y",
					"HOUSE_METER"  => "N"
				),
				false,
				array(),
				array("ID")
			);

			if($arMeter = $dbResult->GetNext(true, false)) {

				$time = strtotime("-1 year", time());
			    $timestamp_x = date("d.m.Y", $time);

				$dbValues = CTszhMeterValue::GetList(array('ID' => 'DESC'), array("METER_ID" => $arMeter["ID"], ">TIMESTAMP_X" => $timestamp_x), false, array(), array());
				while($arValue = $dbValues->Fetch()){
					$arValues[] = $arValue;
				}
				$arValue = array();
				if(!empty($arValues)) {
					foreach($arValues as $arValue){
						$values = array();
						$n = 1;
						if(IntVal($arValue["VALUES_COUNT"]) > 0) {
							while($n <= IntVal($arValue["VALUES_COUNT"])) {
								$values[] = FloatVal($arValue["VALUE".$n]);
								$n++;
							}
						}

						if(!empty($arValue["TIMESTAMP_X"])) {
							$input_date = new DateTime($arValue["TIMESTAMP_X"]);
							$input_date = $input_date->format('c');
						}

						$items[] = array(
							"input_date" => $input_date,
							"owner_input" => $arValue["MODIFIED_BY_OWNER"] == "Y" ? true : false,
							"values_count" => IntVal($arValue["VALUES_COUNT"]),
							"values" => $values
						);
					}
				}
				$arResult["result"] = 0;
				$arResult["items"] = $items;
			} else {
				$arResult["result"] = 5;
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//-----------------------------------//
	/*Новости*/
	//-----------------------------------//

	//Возвращает список новостей
	public function GetNewsList($token, $ls_id, $date_from = "", $date_to = "", $news_id = "", $count = "") {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id)) {
				return json_encode(array("result" => 3));
			}
			$object_id = CDomcAccount::GetObjectIDFromAccount($ls_id);
			if(!empty($object_id)) {
				$news_iblock_id = get_iblock_id("domc", "news");
				$arSelectNews = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_TEXT", "PREVIEW_PICTURE");
				if(!empty($news_id) && $news_id > 0) {
					array_push($arSelectNews, "DETAIL_TEXT", "DETAIL_PICTURE");
				}
				$arFilterNews = Array("IBLOCK_ID"=>IntVal($news_iblock_id), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", array(
					"LOGIC" => "OR",
					array("PROPERTY_OBJECT" => $object_id),
					array("PROPERTY_OBJECT" => false),
				));
				if(!empty($news_id) && $news_id > 0) {
					$arFilterNews["ID"] = $news_id;
				}
				//Разобраться с форматом даты
				if(!empty($date_from)) {
					$date_from = new DateTime($date_from);
					$arFilterNews[">=DATE_ACTIVE_FROM"] = $date_from->format('d.m.Y H:i:s');
				}
				if(!empty($date_to)) {
					$date_to = new DateTime($date_to);
					$arFilterNews["<=DATE_ACTIVE_FROM"] = $date_to->format('d.m.Y H:i:s');
				}

				if($count > 0){
					$navParams = Array("nPageSize" => $count);
				} else {
					$navParams = Array();
				}

				$dbNews = CIBlockElement::GetList(Array("active_from" => "desc"), $arFilterNews, false, $navParams, $arSelectNews);
				while($arNews = $dbNews->Fetch()) {
					$news = array();
					if(!empty($arNews["PREVIEW_PICTURE"])) {
						$preview_url = CFile::GetPath($arNews["PREVIEW_PICTURE"]);
					}
					if(!empty($arNews["PREVIEW_PICTURE"])) {
						$detail_url = CFile::GetPath($arNews["DETAIL_PICTURE"]);
					}


					$news = array(
						"news_id"			 => IntVal($arNews["ID"]),
						"news_name"			 => $arNews["NAME"],
						"news_preview_text"	 => $arNews["PREVIEW_TEXT"],
						"news_preview_image" => $preview_url,
					);

					if(!empty($arNews["DATE_ACTIVE_FROM"])) {
						$date_active_from = new DateTime($arNews["DATE_ACTIVE_FROM"]);
						$date_active_from = $date_active_from->format('c');
						$news["news_date"] = $date_active_from;
					}

					if(!empty($arNews["DETAIL_TEXT"]) || $detail_url) {
						$news["news_full_text"]  = $arNews["DETAIL_TEXT"];
						$news["news_full_image"] = $detail_url;
					}

					$arNewsResult[] = $news;
				}

				$arResult["result"] = 0;
				$arResult["items"] = $arNewsResult;
			} else {
				$arResult["result"] = 5;
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//-----------------------------------//
	/*Работа с заявками*/
	//-----------------------------------//

	//Получить список заказов
	public function GetOrderList($token, $ls_id, $bid_id = "", $date_from = "", $date_to = "", $status = array(), $text = "", $result_type = 0, $work_id = array(), $count) {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			$isUserAccount = self::isUserAccount($userID, $ls_id);
			if($isUserAccount == "owner") {
				$owner = true;
			} elseif($isUserAccount == "resident") {
				$owner = false;
			} else {
				return json_encode(array("result" => 3));
			}

			$dbAccounts = CTszhAccount::GetList(array(), array("ID" => $ls_id), false, false, array("XML_ID"));
			if($arAccount = $dbAccounts->fetch()) {
				$xml_id = $arAccount["XML_ID"];
			}

			$orderIblockID = get_iblock_id("domc", "bids");
			$arSelectOrders = Array("ID",
									"PROPERTY_EZS_NUMBER",
									"PROPERTY_WORK_ID",
									"PROPERTY_STATUS_1C",
									"PROPERTY_EMERGENCY",
									"PROPERTY_PREFER_DATE_EXEC",
									"PROPERTY_DATE_EXEC",
									"PROPERTY_DATE_FACT",
									"PROPERTY_MARK",
									"PROPERTY_PAYED",
									"PROPERTY_BILL_ELEMENT"
								);
			$arFilterOrders = Array("IBLOCK_ID"=>IntVal($orderIblockID), "ACTIVE"=>"Y", "PROPERTY_ACCOUNT_NUMBER" => $xml_id);

			if(!$owner) {
				$arFilterOrders["PROPERTY_USER_ID"] = $userID;
			}

			if(!empty($bid_id)) {
				$arFilterOrders["ID"] = $bid_id;
			}

			if(!empty($work_id)) {
				$arFilterOrders["PROPERTY_WORK_ID"] = $work_id;
			}

			if(!empty($date_from)) {
				$date_from = new DateTime($date_from);
				$arFilterOrders[">=DATE_CREATE"] = $date_from->format('d.m.Y H:i:s');
			}

			if(!empty($date_to)) {
				$date_to = new DateTime($date_to);
				$arFilterOrders["<=DATE_CREATE"] = $date_to->format('d.m.Y H:i:s');
			}

			if(isset($status)) {
				foreach ($status as $status_xml) {
					if($status_xml === 0) {
						$status_xml = 'zero';
					}
					$arFilterOrders["PROPERTY_STATUS_1C"][] = get_prop_YY_by_XX($orderIblockID, "STATUS_1C", $status_xml, "XML_ID", "ID");
				}
			}
			if(!empty($text)) {
				$arFilterOrders[] =  array(
					"LOGIC" => "OR",
					array("?PREVIEW_TEXT" => $text),
					array("?NAME" => $text),
					array("?PROPERTY_COMMENT" => $text),
				);
			}

			$arSelectOrders[] = "PREVIEW_TEXT";
			if($result_type > 0 && $result_type == 1) {
				$arSelectOrders[] = "PROPERTY_FILES";
				$arSelectOrders[] = "PROPERTY_COMMENT";
			}
			$arSelectOrders[] = "DATE_CREATE";

			if($count > 0){
				$navParams = Array("nPageSize" => $count);
			} else {
				$navParams = Array();
			}

			$resOrders = CIBlockElement::GetList(Array("ID" => "desc"), $arFilterOrders, false, $navParams, $arSelectOrders);
			while($arOrder = $resOrders->fetch()) {
				if(!empty($arOrder["PROPERTY_STATUS_1C_VALUE"])) {
					$property_enums = CIBlockPropertyEnum::GetList(Array(), Array("IBLOCK_ID" => $orderIblockID,
																				  "CODE" => "STATUS_1C",
																				  "ID" => $arOrder["PROPERTY_STATUS_1C_ENUM_ID"]));
					if($enum_fields = $property_enums->fetch()) {
						if($enum_fields["XML_ID"] == "zero") {
							$status = 0;
						} else {
							$status = IntVal($enum_fields["XML_ID"]);
						}
						$status_name = $enum_fields["VALUE"];
					}
				}

				if(!empty($arOrder["PROPERTY_WORK_ID_VALUE"])) {
					$resWorks = CIBlockElement::GetList(Array("ID" => "desc"), array("ID" => $arOrder["PROPERTY_WORK_ID_VALUE"]), false, Array(), array("NAME"));
					if($arWork = $resWorks->fetch()) {
						$work_name = $arWork["NAME"];
					} else {
						$work_name = "";
					}
				}

				$bid = array(
					"bid_id" 		=> IntVal($arOrder["ID"]),
					"ezs_number"    => $arOrder["PROPERTY_EZS_NUMBER_VALUE"],
					"work_id"       => IntVal($arOrder["PROPERTY_WORK_ID_VALUE"]),
					"work_name"     => $work_name,
					"status" 		=> $status,
					"status_name" 	=> $status_name,
					"emergency" 	=> !empty($arOrder["PROPERTY_EMERGENCY_VALUE"]) ? true : false,
					"user_comment"  => $arOrder["PREVIEW_TEXT"],
					"domc_comment"  => $arOrder["PROPERTY_COMMENT_VALUE"],
					"mark" 			=> $arOrder["PROPERTY_MARK_VALUE"] > 0 ? IntVal($arOrder["PROPERTY_MARK_VALUE"]) : NULL,
					"payed" 		=> !empty($arOrder["PROPERTY_PAYED_VALUE"]) ? true : false
				);

				if(!empty($arOrder["PROPERTY_PREFER_DATE_EXEC_VALUE"])) {
					$date_prefer   = new DateTime($arOrder["PROPERTY_PREFER_DATE_EXEC_VALUE"]);
					$bid["date_prefer"] = $date_prefer->format('c');
				}

				if(!empty($arOrder["PROPERTY_DATE_EXEC_VALUE"])) {
					$date_approved = new DateTime($arOrder["PROPERTY_DATE_EXEC_VALUE"]);
					$bid["date_approved"] = $date_approved->format('c');
				}

				if(!empty($arOrder["PROPERTY_DATE_FACT_VALUE"])) {
					$date_real     = new DateTime($arOrder["PROPERTY_DATE_FACT_VALUE"]);
					$bid["date_real"] = $date_real->format('c');
				}

				if(!empty($arOrder["PROPERTY_BILL_ELEMENT_VALUE"])) {
					$billIblockID = get_iblock_id("domc", "bills");

					$arSelectBid = Array("PROPERTY_BILL", "PROPERTY_PRICE");
					$arFilterBid = Array("IBLOCK_ID" => IntVal($billIblockID), "ID" => $arOrder["PROPERTY_BILL_ELEMENT_VALUE"], "ACTIVE" => "Y");
					$resBid = CIBlockElement::GetList(Array(), $arFilterBid, false, Array(), $arSelectBid);
					if($arBid = $resBid->fetch()) {
						$bid["payment_summ"] = $arBid["PROPERTY_PRICE_VALUE"];
						$bid["payment_bill"] = CFile::GetPath($arBid["PROPERTY_BILL_VALUE"]);
					}
				}
				foreach ($arOrder["PROPERTY_FILES_VALUE"] as $image_id) {
					$bid["files"][] = CFile::GetPath($image_id);
				}
				$bids[] = array_filter($bid, function($filter_var) { return $filter_var !== NULL; });
			}

			$arResult["result"] = 0;
			if(!empty($bids)) {
				$arResult["items"] = $bids;
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//Добавление новой заявки
	public function AddOrder($token, $ls_id, $work_id, $date, $time_slot, $emergency = "", $comment = "", $files = "") {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id, "BID_CREATE")) {
				return json_encode(array("result" => 3));
			}

			$work_iblock_id = get_iblock_id("domc", "works");
			$arSelectWorks = Array("ID", "NAME", "PROPERTY_PRODUCT", "PROPERTY_EMERGENCY");
			$arFilterWorks = Array("IBLOCK_ID"=>IntVal($work_iblock_id), "ID"=>$work_id, "ACTIVE"=>"Y");
			$resWorks = CIBlockElement::GetList(Array(), $arFilterWorks, false, Array(), $arSelectWorks);
			if($arWork = $resWorks->fetch()) {
				$order_name = $arWork["NAME"];
				if(!empty($arWork["PROPERTY_PRODUCT_VALUE"])) {
					$product_id = $arWork["PROPERTY_PRODUCT_VALUE"];
				}
				if(empty($arWork["PROPERTY_EMERGENCY_VALUE"])) {
					$emergency = "";
				}
			}

			if(empty($product_id)) {
				return json_encode(array("result" => 5));
			}

			$object_id  = CDomcAccount::GetObjectIDFromAccount($ls_id);
			if(!empty($object_id) && !empty($product_id)) {
				$ar_time_slots = CDomcOrder::GetAvailableSlot($product_id, $date, $object_id);
				foreach($ar_time_slots as $hour => $employeeList) {
					$time_slots[] = $hour;
				}
			}

			if(in_array($time_slot, $time_slots)) {
				$iblock_bids_id = get_iblock_id('domc', 'bids');
				$arAccount = CTszhAccount::GetByID($ls_id);
				$status_id = get_prop_YY_by_XX($iblock_bids_id, 'STATUS_1C', BIDS_XML_STATUS_ZERO, 'XML_ID', 'ID');
				$emergency_id = get_prop_YY_by_XX($iblock_bids_id, 'EMERGENCY', 'Y', 'XML_ID', 'ID');

				$format_hours = $time_slot < 10 ? "0".$time_slot.":00:00" : $time_slot.":00:00";

				$elm = new CIBLockElement;

				$date = new DateTime($date);
				$date = $date->format("d.m.Y");

				$PROP = array(
					'WORK_ID' => $work_id,
					'USER_ID' => $userID,
					'ACCOUNT_NUMBER' => (string)$arAccount["XML_ID"],
					'STATUS_1C' => $status_id,
					'PREFER_DATE_EXEC' => $date." ".$format_hours,
					'EMERGENCY' => ($emergency ? $emergency_id : false)
				);

				if(!empty($files)) {
					foreach ($files as $file) {
						$new_file = array(
							"name" => $file["name"],
							"type" => pathinfo($file["name"], PATHINFO_EXTENSION),
							"MODULE_ID" => "iblock",
							"content" => base64_decode($file["array_base64"])
						);
						$filesIDS[] = CFile::SaveFile($new_file, "iblock");
					}
				}

				if(!empty($filesIDS)) {
					$PROP["FILES"] = $filesIDS;
				}

				$arLoadProductArray = Array(
					"IBLOCK_ID" => $iblock_bids_id,
					"NAME" => $order_name,
					"MODIFIED_BY" => $userID,
					"PROPERTY_VALUES" => $PROP,
					"PREVIEW_TEXT" => $comment,
					"PREVIEW_TEXT_TYPE" => "text",
					"DATE_ACTIVE_FROM" => ConvertTimeStamp(time(), "FULL")
				);
				$bid_id = $elm->Add($arLoadProductArray);
				if (!$bid_id) {
					$arResult["result"] = 5;
				} else {
					$object_id = CDomcAccount::GetObjectIDFromAccount($ls_id);
					$slotID = CDomcOrder::AddNewTimeSlot($bid_id, $work_id, $date, $time_slot, false, $object_id);
					if($slotID > 0) {
						$arResult["result"] = 0;
						$arResult["items"]["bid_id"] = IntVal($bid_id);
					} else {
						$elm->Delete($bid_id);
						$arResult["result"] = 5;
					}
				}
			} else {
				$arResult["result"] = 5;
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//Обновление заявки
	public function UpdateOrder($token, $ls_id, $bid_id, $mark = "", $comment = "", $cancel = false) {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id, "BID_CREATE")) {
				return json_encode(array("result" => 3));
			}
			$bid_iblock_id = get_iblock_id("domc", "bids");
			$arSelectBids = Array("ID", "PROPERTY_MARK", "PROPERTY_USER_ID");
			$arFilterBids = Array("IBLOCK_ID"=>IntVal($bid_iblock_id), "=ID"=>$bid_id);
			$resBids = CIBlockElement::GetList(Array(), $arFilterBids, false, Array(), $arSelectBids);
			if($arBid = $resBids->fetch()) {
				if($arBid["PROPERTY_USER_ID_VALUE"] != $userID) {
					return json_encode(array("result" => 3));
				}
				if(isset($mark) && empty($arBid["PROPERTY_MARK_VALUE"])) {
					if($mark === 0) {
						$mark = 'zero';
					}
					$mark_id = get_prop_YY_by_XX($bid_iblock_id, "MARK", $mark, "XML_ID", "ID");
					if($mark_id > 0) {
						CIBlockElement::SetPropertyValuesEx($arBid["ID"], false, array("MARK" => $mark_id));
						$arResult["result"] = 0;
					}
				} else {
					$arResult["result"] = 5;
				}

				if(!empty($comment)) {
					CIBlockElement::SetPropertyValuesEx($arBid["ID"], false, array("COMMENT" => $comment));
					$arResult["result"] = 0;
				}

				if($cancel) {
					//Убрать или в контсанты или в функцию
					$cancel_status_id = get_prop_YY_by_XX($bid_iblock_id, "STATUS_1C", BIDS_XML_STATUS_CANCEL, "XML_ID", "ID");
					CIBlockElement::SetPropertyValuesEx($arBid["ID"], false, array("STATUS_1C" => $cancel_status_id));
					$arResult["result"] = 0;
				}
			}

			if(!isset($arResult["result"])) {
				$arResult["result"] = 5;
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//Список платежей по ЛС
	//Тут доделать
	public function AddTransaction($token, $ls_id, $bid_id = "", $summ = "") {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id)) {
				$arResult["result"] = 3;
				return json_encode($arResult);
			}

			if (!CModule::IncludeModule("citrus.tszhpayment"))	{
				$arResult["result"] = 5;
				return json_encode($arResult);
			}
			//Доработать под сумму в счете

			if(empty($summ) && empty($bid_id)) {
				$summ = floatval(CDomcAccount::GetAccountBalance($ls_id, true));
			}

			if($summ <= 0  && empty($bid_id)) {
				$arResult["result"] = 5;
				return json_encode($arResult);
			}

			if(isset($bid_id) && $bid_id > 0) {
				$arBidSelect = Array("ID", "PROPERTY_BILL_ELEMENT");
				$arBidFilter = Array("IBLOCK_ID"=>get_iblock_id('domc', 'bids'), "=ID"=>$bid_id);
				$resBid = CIBlockElement::GetList(Array(), $arBidFilter, false, Array("nTopCount" => 1), $arBidSelect);
				if($arBid = $resBid->fetch()) {
					if($arBid["PROPERTY_BILL_ELEMENT_VALUE"]) {
						$bill_id = $arBid["PROPERTY_BILL_ELEMENT_VALUE"];
					}
				}

				if($bill_id) {
					$arBillSelect = Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_PRICE_NUMBER", "PROPERTY_PRICE");
					$arBillFilter = Array("IBLOCK_ID"=>get_iblock_id('domc', 'bills'), "=ID"=>$bill_id);
					$resBill = CIBlockElement::GetList(Array(), $arBillFilter, false, Array("nTopCount"=>1), $arBillSelect);
					if($arBill = $resBill->fetch()) {
						$bill_number = $arBill['PROPERTY_PRICE_NUMBER_VALUE'];
						$summ  = $arBill['PROPERTY_PRICE_VALUE'];
					}
				}

				if(empty($bill_number)) {
					$arResult["result"] = 5;
					return json_encode($arResult);
				}
			}

			//Создаём новую транзакцию
			$arAccount = CDomcAccount::GetByUserID($userID);
			$arFields = array(
				"LID" => "s1",
				"SUMM" => $summ,
				"CURRENCY" => "RUB",
				"PAY_SYSTEM_ID" => MKB_PAYSYSTEM_ID,
				"USER_ID" => $userID,
				"ACCOUNT_ID" => $arAccount['ID'],
				"TSZH_ID" => $arAccount["TSZH_ID"]
			);

			$xml_id = $arAccount['XML_ID'];
			$paymentID = CTszhPayment::Add($arFields);
			$dbPayment = CTszhPaySystem::GetList(array(), array("ID" => MKB_PAYSYSTEM_ID), false, false, array("*"));
			if($arPayment = $dbPayment -> fetch()) {
				$arParams = unserialize($arPayment["PARAMS"]);
			}

			if($paymentID) {
				$dbPayments = CTszhPayment::GetList(array(), array("ID" => $paymentID));
				if(!($arPayment = $dbPayments->fetch())) {
					$arResult["result"] = 5;
					return json_encode($arResult);
				}
				$xml_id = $arAccount['XML_ID'];

				if(isset($bid_id) && $bid_id > 0) {
					$str_orderID = 'SCH-'.mb_strtoupper(Cutil::translit(trim($bill_number), "ru", array("safe_chars" => "-"))).';'.date('d.m.Y;H:i:s', strtotime($arPayment['DATE_INSERT'])).';';
				} else {
					$xml_id = mb_strtoupper(Cutil::translit($xml_id, "ru", array("safe_chars" => "-")));
					$str_orderID = 'LS-'.$xml_id.';'.date('d.m.Y;H:i:s', strtotime($arPayment['DATE_INSERT'])).';';
				}
				//Нужна проверка принадлежит ли заявка пользователю
				if(!empty($str_orderID)) {
					$MKB_WORK_MODE = $arParams["MODE"]["VALUE"] ? "1" : "0";
					$currentMKBUrl = $MKB_WORK_MODE ? 'https://mpi.mkb.ru/MPI_payment/' : 'https://mpi.mkb.ru:9443/MPI_payment/';
					$MKB_MERCHANT_ID = $MKB_WORK_MODE ? $arParams["MERCHANT_ID"]["VALUE"] : MKB_MERCHANT_ID;
					$MKB_PASSWORD = $MKB_WORK_MODE ? $arParams["PASSWORD"]["VALUE"] : MKB_PASSWORD;
					$MKB_AID = MKB_AID;
					$MKB_OID = $str_orderID;
					$MKB_CURRENCY = 643;
					$amount = $summ * 100;
					$MKB_AMOUNT = str_pad($amount, 12, "0", STR_PAD_LEFT);
					$MKB_AMOUNT_VIEW = number_format($summ, 2, ".", "");
					$MKB_SIGNATURE = base64_encode(hex2bin(sha1($MKB_PASSWORD . $MKB_MERCHANT_ID . $MKB_AID . $MKB_OID . $MKB_AMOUNT . $MKB_CURRENCY)));

					$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';
					$currentUrl = $protocol . $_SERVER['HTTP_HOST'];

					$arResult["result"] = 0;
					$arResult["items"]  = array(
						"transaction_id" => IntVal($paymentID),
						"pay_url" 		 => $currentMKBUrl,
						"params" 		 => array(
							"mid" 			=> $MKB_MERCHANT_ID,
							"aid" 			=> $MKB_AID,
							"amount" 		=> $MKB_AMOUNT,
							"oid" 			=> $MKB_OID,
							"signature" 	=> $MKB_SIGNATURE,
							"directposturl" => $currentUrl.$arParams["REDIRECT_URL"]["VALUE"],
							"redirect_url"  => "https://payment_complete"
						)
					);
				}
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	public function GetTransactionList($token, $ls_id, $transaction_id = "") {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id)) {
				$arResult["result"] = 3;
				return json_encode($arResult);
			}

			if (!CModule::IncludeModule("citrus.tszhpayment"))	{
				$arResult["result"] = 5;
				return json_encode($arResult);
			}

			if(!empty($transaction_id) && $transaction_id > 0) {
				$arFilter["ID"] = $transaction_id;
			} else {
				$arFilter = array("USER_ID" => $userID, "ACCOUNT_ID" => $ls_id);
			}

			$dbPayments = CTszhPayment::GetList(array(), $arFilter, false, false, array("ID", "PAYED", "SUMM", "DATE_INSERT", "USER_ID", "ACCOUNT_ID"));
			while($arPayment = $dbPayments->fetch()) {
				if($arPayment["USER_ID"] != $userID || $arPayment["ACCOUNT_ID"] != $ls_id) {
					if(!empty($arPayment["DATE_INSERT"])) {
						$date_created = new DateTime($arPayment["DATE_INSERT"]);
						$date_created = $date_created -> format("c");
					}

					$items[] = array(
						"transaction_id"	 => IntVal($arPayment["ID"]),
						"transaction_status" => $arPayment["PAYED"] == "Y" ? true : false,
						"summ"				 => FloatVal($arPayment["SUMM"]),
						"date_created"	     => $date_created
					);
				} else {
					$arResult["result"] = 5;
					return json_encode($arResult);
				}
			}
			$arResult["result"] = 0;
			if(!empty($items)) {
				$arResult["items"]  = $items;
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//Дерево услуг/проудктов/работ
	public function GetCategoryList($token, $ls_id = "", $search_text = "") {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id)) {
				return json_encode(array("result" => 3));
			}

			$arServices = CDomcOrder::GetCategoryList($ls_id, $search_text);

			if(!empty($arServices)) {
				foreach($arServices as $serviceID => $arService) {
					$products = array();
					foreach($arService["PRODUCTS"] as  $productID => $arProduct) {
						$works = array();
						foreach($arProduct["WORKS"] as $workID => $arWork){
							$work = array(
								"ID" 		=> IntVal($arWork["ID"]),
								"name" 	    => $arWork["NAME"],
								"emergency" => $arWork["EMERGENCY"],
								"popular"   => $arWork["POPULAR"],
								"icon" 		=> $arWork["ICON"]
							);
							if(!empty($ls_id) && $ls_id > 0) {
								$work["price"] = FloatVal($arWork["PRICE"]);
							}
							$works[] = $work;
						}
						$product = array(
							"ID"    => IntVal($arProduct["ID"]),
							"name"  => $arProduct["NAME"]
						);
						if(!empty($works)) {
							$product["works"] = $works;
							$products[] = $product;
						}
					}
					$categorie = array(
						"ID" 	   => IntVal($arService["ID"]),
						"name" 	   => $arService["NAME"]
					);
					if(!empty($products)) {
						$categorie["products"] = $products;
						$categories[] = $categorie;
					}
				}
			}

			$categories = array_filter($categories, function($value) { return $value !== NULL && $value !== '';});
			$arResult["result"] = 0;
			if(!empty($categories)) {
				$arResult["items"] = $categories;
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//Возвращает доступные слоты времени
	public function GetTimeSlots($token, $ls_id, $product_id, $date) {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id, "BID_CREATE")) {
				return json_encode(array("result" => 3));
			}
			$time_slots = array();
			$object_id  = CDomcAccount::GetObjectIDFromAccount($ls_id);
			if(!empty($object_id)) {
				$date = new DateTime($date);
				$date = $date->format("d.m.Y");
				$ar_time_slots = CDomcOrder::GetAvailableSlot($product_id, $date, $object_id);
				foreach($ar_time_slots as $hour => $employeeList) {
					$time_slots[] = $hour;
				}
			}
			$arResult["result"] = 0;
			$arResult["items"] = $time_slots;
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//-----------------------------------//
	/*Работа с обращениями*/
	//-----------------------------------//

	//Получить список обращений
	public function GetAppealList($token, $ls_id, $appeal_id = "", $date_from = "", $date_to = "", $status = "", $type = "", $text = "", $result_type = 0) {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id, "APP_CREATE")) {
				return json_encode(array("result" => 3));
			}

			$appealsIblockID = get_iblock_id("domc", "appeals");

			$dbAccounts = CTszhAccount::GetList(array(), array("ID" => $ls_id), false, false, array("XML_ID"));
			if($arAccount = $dbAccounts->fetch()) {
				$xml_id = $arAccount["XML_ID"];
			}

			$arSelectAppeals = Array("ID",
									"PROPERTY_NUMBER",
									"PROPERTY_DATE_FINISHED",
									"PROPERTY_STATUS",
									"PROPERTY_TYPE",
								);

			$arFilterAppeals = Array("IBLOCK_ID"=>IntVal($appealsIblockID), "ACTIVE"=>"Y", "PROPERTY_LS" => $xml_id);
			if(!empty($appeal_id)) {
				$arFilterAppeals["ID"] = $appeal_id;
			}

			if(!empty($date_from)) {
				$date_from = new DateTime($date_from);
				$arFilterAppeals[">=DATE_CREATE"] = $date_from->format('d.m.Y H:i:s');
			}
			if(!empty($date_to)) {
				$date_to = new DateTime($date_to);
				$arFilterAppeals["<=DATE_CREATE"] = $date_to->format('d.m.Y H:i:s');
			}

			if(!empty($text)) {
				$arFilterAppeals[] =  array(
					"LOGIC" => "OR",
					array("?DETAIL_TEXT" => $text),
					array("?NAME" => $text),
					array("?PROPERTY_COMMENT" => $text),
				);
			}

			if(isset($status)) {
				foreach ($status as $status_xml) {
					if($status_xml === 0) {
						$status_xml = 'zero';
					}
					$arFilterAppeals["PROPERTY_STATUS"][] = get_prop_YY_by_XX($appealsIblockID, "STATUS", $status_xml, "XML_ID", "ID");
				}
			}

			if(isset($type)) {
				foreach ($type as $type_xml) {
					if($type_xml === 0) {
						$type_xml = 'zero';
					}
					$arFilterAppeals["PROPERTY_TYPE"][] = get_prop_YY_by_XX($appealsIblockID, "TYPE", $type_xml, "XML_ID", "ID");
				}
			}

			$arSelectAppeals[] = "DETAIL_TEXT";
			if($result_type > 0 && $result_type == 1) {
				$arSelectAppeals[] = "PROPERTY_ATTACHMENTS";
				$arSelectAppeals[] = "PROPERTY_COMMENT";
				$arSelectAppeals[] = "PROPERTY_ATTACHMENTS_UK";
			}

			$resAppeals = CIBlockElement::GetList(Array("ID"=>"desc"), $arFilterAppeals, false, Array(), $arSelectAppeals);
			while($arAppeal = $resAppeals->fetch()) {

				if(!empty($arAppeal["PROPERTY_STATUS_ENUM_ID"])) {
					$property_enums_status = CIBlockPropertyEnum::GetList(Array(), Array("IBLOCK_ID" => $appealIblockID,
																				  "CODE" => "STATUS",
																				  "ID" => $arAppeal["PROPERTY_STATUS_ENUM_ID"]));
					if($enum_fields_status = $property_enums_status->fetch()) {
						if($enum_fields_status["XML_ID"] == "zero") {
							$status = 0;
						} else {
							$status = IntVal($enum_fields_status["XML_ID"]);
						}
					}
				} else {
					$status = null;
				}

				if(!empty($arAppeal["PROPERTY_TYPE_ENUM_ID"]) && !empty($arAppeal["PROPERTY_NUMBER_VALUE"])) {
					$property_enums_type = CIBlockPropertyEnum::GetList(Array(), Array("IBLOCK_ID" => $appealIblockID,
																				  "CODE" => "TYPE",
																				  "ID" => $arAppeal["PROPERTY_TYPE_ENUM_ID"]));
					if($enum_fields_type = $property_enums_type->fetch()) {
						if($enum_fields_type["XML_ID"] == "zero") {
							$type = IntVal(0);
						} else {
							$type = IntVal($enum_fields_type["XML_ID"]);
						}
					}
				} else {
					$type = null;
				}

				$appeal = array(
					"appeal_id" 	=> IntVal($arAppeal["ID"]),
					"crm_number"    => $arAppeal["PROPERTY_NUMBER_VALUE"],
					"user_comment"	=> $arAppeal["DETAIL_TEXT"],
					"domc_comment"	=> $arAppeal["PROPERTY_COMMENT_VALUE"]["TEXT"],
					"status" 		=> IntVal($status),
					"type" 			=> $type
				);

				if(!empty($arAppeal["PROPERTY_DATE_FINISHED_VALUE"])) {
					$due_date = new DateTime($arAppeal["PROPERTY_DATE_FINISHED_VALUE"]);
					$appeal["due_date"] = $due_date->format("c");
				}

				foreach ($arAppeal["PROPERTY_ATTACHMENTS_VALUE"] as $image_id) {
					$appeal["files"][] = CFile::GetPath($image_id);
				}

				foreach ($arAppeal["PROPERTY_ATTACHMENTS_UK_VALUE"] as $image_id) {
					$appeal["domc_files"][] = CFile::GetPath($image_id);
					break;
				}

				$appeals[] = array_filter($appeal, function($filter_var) { return $filter_var !== NULL; });
			}

			$arResult["result"] = 0;
			if(!empty($appeals)) {
				$arResult["items"] = $appeals;
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//Желательно объеденить с добавлением обращения из публички при рефакторинге
	public function AddAppeal($token, $ls_id, $user_comment, $type = "", $files = "") {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id, "APP_CREATE")) {
				$arResult["result"] = 3;
				return json_encode($arResult);
			}

			//Доработать получение внешнего кода ЛС, проверка по User ID нужна?
			$dbAccounts = CTszhAccount::GetList(array(), array("ID" => $ls_id), false, false, array("XML_ID"));
			if($arAccount = $dbAccounts->fetch()) {
				$xml_id = $arAccount["XML_ID"];
			}

			$appeal_iblock_id = get_iblock_id("domc", "appeals");
			$property_enums = CIBlockPropertyEnum::GetList(Array("DEF" => "DESC", "SORT" => "ASC"), Array("IBLOCK_ID" => $appeal_iblock_id, "CODE" => "STATUS", "XML_ID" => "zero"));
            $id_zero_val = 0;
            if ($enum_fields = $property_enums->GetNext()) {
                $id_zero_val = $enum_fields['ID'];
            }

			//По правкам 14.05.2018 убираем тип обращения
            $type = APPEAL_PROP_VAL_ID_PRETENSION;

			if(!empty($files)) {
				foreach ($files as $file) {
					$new_file = array(
					    "name" => $file["name"],
					    "type" => pathinfo($file["name"], PATHINFO_EXTENSION),
					    "MODULE_ID" => "iblock",
					    "content" => base64_decode($file["array_base64"])
					);
					$filesIDS[] = CFile::SaveFile($new_file, "iblock");
				}
			}

			$PROP = array(
                'TYPE'        => $type,
                'USER' 		  => $userID,
                'LS' 		  => $xml_id,
                'STATUS' 	  => $id_zero_val,
                'ATTACHMENTS' => $filesIDS
            );

			$arLoadProductArray = Array(
				"IBLOCK_ID"        => $appeal_iblock_id,
				"NAME" 			   => "Обращение от " . date('d.m.Y H:i:s'),
				"MODIFIED_BY" 	   => $userID,
				"PROPERTY_VALUES"  => $PROP,
				"DETAIL_TEXT"      => $user_comment,
				"DETAIL_TEXT_TYPE" => "text",
				"DATE_ACTIVE_FROM" => ConvertTimeStamp(time() + CTimeZone::GetOffset(), "FULL")
			);

			$elm = new CIBlockElement;
			$bid_id = $elm->Add($arLoadProductArray);
			if($bid_id) {
				$arResult["result"] = 0;
				$arResult["items"]  = array(
					"appeal_id" => IntVal($bid_id),
				);
			} else {
				$arResult["result"] = 5;
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}

	//-----------------------------------//
	/*Прочее*/
	//-----------------------------------//

	public function GetVideoCamsList($token, $ls_id, $camera_id = "", $is_favourite = "") {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id, "CAM_VIEW")) {
				$arResult["result"] = 3;
				return json_encode($arResult);
			}

			$cams_iblock_id = get_iblock_id("domc", "cams");
			$tszh_id = CDomcAccount::GetObjectIDFromAccount($ls_id);


			//Доработать получение внешнего кода ЛС
			$dbAccounts = CTszhAccount::GetList(array(), array("ID" => $ls_id), false, false, array("XML_ID"));
			if($arAccount = $dbAccounts->fetch()) {
				$xml_id = $arAccount["XML_ID"];
			}

			$arSelectCam = Array("ID", "NAME", "PREVIEW_TEXT", "DATE_ACTIVE_FROM",  "PROPERTY_URL", "PROPERTY_COST");
			$arFilterCam = Array("IBLOCK_ID"=>IntVal($cams_iblock_id),
								 "ACTIVE"=>"Y",
								 array("LOGIC"=>"OR",
							 		   array("PROPERTY_OBJECT" => false),
									   array("PROPERTY_OBJECT" => $tszh_id)
								 ),
								 array("LOGIC"=>"OR",
							 		   array("PROPERTY_LS" => false),
									   array("PROPERTY_LS" => $xml_id)
								 )
							);

			$hlblock_fav = HL\HighloadBlockTable::getList(array('select'=> array("*"), 'filter'=>array("NAME" => 'FavoriteCam')))->fetch();
			$fav_entity = HL\HighloadBlockTable::compileEntity($hlblock_fav);
			$fav_data_class = $fav_entity->getDataClass();

			$rsFavs = $fav_data_class::getList(array(
			   "select" => array("UF_CAM_ID"),
			   "order"  => array("ID" => "ASC"),
			   "filter" => array("UF_USER_ID" => $userID, "UF_LS_ID" => $ls_id)
			));

			while($arFav = $rsFavs->fetch()) {
				$favsCamIDs[] = $arFav["UF_CAM_ID"];
			}

			if($is_favourite) {
				$arFilterCam["ID"] = $favsCamIDs;
			}

			if($camera_id) {
				if(!empty($arFilterCam["ID"])) {
					if(in_array($camera_id, $arFilterCam["ID"])) {
						$arFilterCam["ID"] = $camera_id;
					}
				} else {
					$arFilterCam["ID"] = $camera_id;
				}
			}


			$resCams = CIBlockElement::GetList(Array(), $arFilterCam, false, Array(), $arSelectCam);
			while($arCam = $resCams->fetch()) {
				$item = array(
					"camera_id"    => IntVal($arCam["ID"]),
					"camera_name"  => $arCam["NAME"],
					"is_favourite" => in_array($arCam["ID"], $favsCamIDs) ? true : false,
					"video_code"   => $arCam["PROPERTY_URL_VALUE"] ? $arCam["PROPERTY_URL_VALUE"] : $arCam["PREVIEW_TEXT"],
					"price"        => $arCam["PROPERTY_COST_VALUE"] ? StrVal($arCam["PROPERTY_COST_VALUE"]) : "0"
				);
				$item = array_filter($item, function($value) { return $value !== NULL && $value !== '';});
				$items[] = $item;
			}

			if($camera_id > 0 && empty($items)) {
				$arResult["result"] = 5;
			} else {
				$arResult["result"] = 0;
				if(!empty($items)) {
					$arResult["items"] = $items;
				}
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}


	public function AddCamToFavourites($token, $ls_id, $camera_id) {
		$userID = self::GetUserIDByToken($token);
		if($userID !== false && $userID > 0) {
			if(!self::isUserAccount($userID, $ls_id, "CAM_VIEW")) {
				$arResult["result"] = 3;
				return json_encode($arResult);
			}

			$cams_iblock_id = get_iblock_id("domc", "cams");
			$tszh_id = CDomcAccount::GetObjectIDFromAccount($ls_id);


			//Доработать получение внешнего кода ЛС
			$dbAccounts = CTszhAccount::GetList(array(), array("ID" => $ls_id), false, false, array("XML_ID"));
			if($arAccount = $dbAccounts->fetch()) {
				$xml_id = $arAccount["XML_ID"];
			}

			$arSelectCam = Array("ID", "NAME", "DATE_ACTIVE_FROM",  "PROPERTY_URL", "PROPERTY_COST");
			$arFilterCam = Array("IBLOCK_ID"=>IntVal($cams_iblock_id),
								 "ID"=>IntVal($camera_id),
								 "ACTIVE"=>"Y",
								 array("LOGIC"=>"OR",
							 		   array("PROPERTY_OBJECT" => false),
									   array("PROPERTY_OBJECT" => $tszh_id)
								 ),
								 array("LOGIC"=>"OR",
							 		   array("PROPERTY_LS" => false),
									   array("PROPERTY_LS" => $xml_id)
								 )
							);

			$resCams = CIBlockElement::GetList(Array(), $arFilterCam, false, Array(), $arSelectCam);
			if($arCam = $resCams->fetch()) {
				$hlblock_fav = HL\HighloadBlockTable::getList(array('select'=> array("*"), 'filter'=>array("NAME" => 'FavoriteCam')))->fetch();
				$fav_entity = HL\HighloadBlockTable::compileEntity($hlblock_fav);
				$fav_data_class = $fav_entity->getDataClass();

				$rsFavs = $fav_data_class::getList(array(
				   "select" => array("UF_CAM_ID"),
				   "order"  => array("ID" => "ASC"),
				   "filter" => array("UF_USER_ID" => $userID, "UF_LS_ID" => $ls_id, "UF_CAM_ID" => $camera_id)
				));

				if(!($arFav = $rsFavs->fetch())) {
					if($fav_data_class::add(array(
						"UF_USER_ID" => $userID,
						"UF_LS_ID"   => $ls_id,
						"UF_CAM_ID"  => $camera_id,
					))) {
						$arResult["result"] = 0;
					} else {
						$arResult["result"] = 5;
					};
				} else {
					$arResult["result"] = 5;
				}
			} else {
				$arResult["result"] = 5;
			}
		} else {
			$arResult["result"] = 2;
		};
		return json_encode($arResult);
	}
}
?>
