<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
$SALE_RIGHT = $APPLICATION->GetGroupRight("sale");
if ($SALE_RIGHT=="D") $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

function GetRealPath2Report($rep_name) {
	$rep_name = str_replace("\0", "", $rep_name);
	$rep_name = preg_replace("#[\\\\\\/]+#", "/", $rep_name);
	$rep_name = preg_replace("#\\.+[\\\\\\/]#", "", $rep_name);

	$rep_file_name = $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin/reports/".$rep_name;
	if (!file_exists($rep_file_name)) {
		$rep_file_name = $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/sale/reports/".$rep_name;
		if (!file_exists($rep_file_name)) {
			return "";
		}
	}

	return $rep_file_name;
}

if (!function_exists('GetUniformDestribution')) {
	/*
	 * distribution of discount products
	 *
	 * array $arBasket - user basket
	 * float $discount - discount of order
	 * float $priceTotal - summa of basket price
	 */

	function GetUniformDestribution($arBasket, $discount, $priceTotal) {
		foreach ($arBasket as $key => $val) {
			$val["PRICE_DEFAULT"] = $val["PRICE"];
			$val["DISCOUNT_RATION_PERCENT"] = round(($val["PRICE"] * 100) / $priceTotal, 5);
			$val["DISCOUNT_RATION_VALUE"] = round(($discount * $val["DISCOUNT_RATION_PERCENT"] / 100), 5);
			$val["PRICE"] -= $val["DISCOUNT_RATION_VALUE"];
			$arBasket[$key] = $val;
		}
		return $arBasket;
	}
}

function ASDPrintTemplate($rep_file_name, $arOrder, $ORDER_ID, $arOrderProps, $arBasketIDs, $arQuantities, $arUser, $report, $serCount, $arOptions, $arParams) {
	ob_start();

	include($rep_file_name);

	$content = ob_get_contents();

	ob_end_clean();

	return $content;
}

if (CModule::IncludeModule("sale")) {
	$arOrdersID = explode("|", $ORDER_ID);
	unset($ORDER_ID);

	if(is_array($arOrdersID) && count($arOrdersID) > 0) {

		$allContent = '';

		foreach ($arOrdersID as $key => $ORDER_ID) {
			if ($arOrder = CSaleOrder::GetByID($ORDER_ID)) {
				$rep_file_name = GetRealPath2Report($doc.".php");
				if (strlen($rep_file_name)<=0) {
					ShowError("PRINT TEMPLATE NOT FOUND");
					die();
				}

				$arOrderProps = array();
				$dbOrderPropVals = CSaleOrderPropsValue::GetList(
					array(),
					array("ORDER_ID" => $ORDER_ID),
					false,
					false,
					array("ID", "CODE", "VALUE", "ORDER_PROPS_ID", "PROP_TYPE")
				);
				while ($arOrderPropVals = $dbOrderPropVals->Fetch()) {
					$arCurOrderPropsTmp = CSaleOrderProps::GetRealValue(
						$arOrderPropVals["ORDER_PROPS_ID"],
						$arOrderPropVals["CODE"],
						$arOrderPropVals["PROP_TYPE"],
						$arOrderPropVals["VALUE"],
						LANGUAGE_ID
					);
					foreach ($arCurOrderPropsTmp as $key => $value) {
						$arOrderProps[$key] = $value;
					}
				}

				$arBasketIDs = array();
				$arQuantities = array();

				if (!isset($SHOW_ALL) || $SHOW_ALL == "N") {
					$arBasketIDs_tmp = explode(",", $BASKET_IDS);
					$arQuantities_tmp = explode(",", $QUANTITIES);

					if (count($arBasketIDs_tmp)!=count($arQuantities_tmp)) die("INVALID PARAMS");
					for ($i = 0; $i < count($arBasketIDs_tmp); $i++) {
						if (IntVal($arBasketIDs_tmp[$i])>0 && doubleVal($arQuantities_tmp[$i])>0) {
							$arBasketIDs[] = IntVal($arBasketIDs_tmp[$i]);
							$arQuantities[] = doubleVal($arQuantities_tmp[$i]);
						}
					}
				}
				else {
					$db_basket = CSaleBasket::GetList(array("NAME" => "ASC"), array("ORDER_ID"=>$ORDER_ID), false, false, array("ID", "QUANTITY"));
					while ($arBasket = $db_basket->GetNext()) {
						$arBasketIDs[] = $arBasket["ID"];
						$arQuantities[] = $arBasket["QUANTITY"];
					}
				}

				$dbUser = CUser::GetByID($arOrder["USER_ID"]);
				$arUser = $dbUser->Fetch();

				$report = "";
				$serCount = IntVal(COption::GetOptionInt("sale", "reports_count"));
				if($serCount > 0) {
					for($i=1; $i <= $serCount; $i++) {
						$report .= COption::GetOptionString("sale", "reports".$i);
					}
				}
				else
					$report = COption::GetOptionString("sale", "reports");

				$arOptions = unserialize($report);

				if(!empty($arOptions)) {
					foreach($arOptions as $key => $val) {
						if(strlen($val["VALUE"]) > 0)
						{
							if($val["TYPE"] == "USER")
								$arParams[$key] = $arUser[$val["VALUE"]];
							elseif($val["TYPE"] == "ORDER")
								$arParams[$key] = $arOrder[$val["VALUE"]];
							elseif($val["TYPE"] == "PROPERTY")
								$arParams[$key] = $arOrderProps[$val["VALUE"]];
							else
								$arParams[$key] = $val["VALUE"];
							$arParams["~".$key] = $arParams[$key];
							$arParams[$key] = htmlspecialcharsEx($arParams[$key]);
						}
					}
				}
				$allContent .= ASDPrintTemplate($rep_file_name, $arOrder, $ORDER_ID, $arOrderProps, $arBasketIDs, $arQuantities, $arUser, $report, $serCount, $arOptions, $arParams);
			}
		}

		if(strlen($allContent) > 0) {
			preg_match_all("|<head[^>]*>(.*?)</head>|s", $allContent, $matches, PREG_PATTERN_ORDER);
			$sHead = $matches[1][0];

			preg_match_all("|(<body[^>]*>)|s", $allContent, $matches, PREG_PATTERN_ORDER);
			$sBodyOpen = $matches[0][0];

			preg_match_all("|<body[^>]*>(.*?)</body>|s", $allContent, $matches, PREG_PATTERN_ORDER);
			$arBody = array();
			$arBody_ = array();
			for ($i=0; $i< count($matches[0]); $i++) {
				$arBody[] = $matches[1][$i];
			}

			$sPrintBreak = '<div style="page-break-after: always;clear: both;"></div>';

			$sResult = '';
			$sResult .= '<!DOCTYPE html><html><head>';

			$sResult .= $sHead;

			$sResult .= '</head>';

			$sResult .= $sBodyOpen;

			$bFirstBreak = false;
			foreach($arBody as $value) {
				if($bFirstBreak)
					$sResult .= $sPrintBreak;

				$sResult .= $value;

				$bFirstBreak = true;
			}

			$sResult .= '</body></html>';

			echo $sResult;
		}
	}
}
else
	ShowError("SALE MODULE IS NOT INSTALLED");
