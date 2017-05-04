<?
/***************
* Получаем телефон из заказа
*************/

function getPhone($id){
	$db_props = CSaleOrderPropsValue::GetOrderProps($id);
	while ($arProps = $db_props->Fetch()){
		if($arProps['CODE']=='PHONE'){
			$clearedPhone = preg_replace('/[^0-9]/','',$arProps['VALUE']);
			return $clearedPhone;
		}
	}
}

/***************
* Получаем имя клиента из заказа
*************/

function getClientName($id){
	$db_props = CSaleOrderPropsValue::GetOrderProps($id);
	while ($arProps = $db_props->Fetch()){
		if($arProps['CODE']=='F_CONTACT_PERSON'){
			return $arProps['VALUE'];
		}
	}
}

/***************
* Получаем email клиента из заказа
*************/

function getClientEmail($id){
	$db_props = CSaleOrderPropsValue::GetOrderProps($id);
	while ($arProps = $db_props->Fetch()){
		if($arProps['CODE']=='EMAIL'){
			return $arProps["VALUE"];
		}
	}
}

function getClientCity($id){
	$db_props = CSaleOrderPropsValue::GetOrderProps($id);
	while ($arProps = $db_props->Fetch()){
		if($arProps['CODE']=='LOCATION' || $arProps['CODE']=='F_LOCATION'){
			$city = CSaleLocation::GetByID($arProps["VALUE"]);
			return $city["CITY_NAME"];
		}
	}
}
?>