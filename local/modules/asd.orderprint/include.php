<?
IncludeModuleLangFile(__FILE__);

class CASDOrderPrint {

	public static $error = '';

	public static function OnAdminListDisplayHandler(&$list) {
		if ($GLOBALS['APPLICATION']->GetCurPage() == '/bitrix/admin/sale_order.php' || $GLOBALS['APPLICATION']->GetCurPage() == '/bitrix/admin/print_list.php') {
			require_once($_SERVER['DOCUMENT_ROOT'].'/local/modules/asd.orderprint/classes/general/orderprint.php');
			$strForm = '<div id="asd_orderprint_form" style="display:none">
						'.bitrix_sessid_post().'
							<select name="asd_print">';
			foreach (CASDOrderPrintUtil::GetPrintReports() as $arReport) {
				$strForm .= '<option value="'.$arReport['FILE'].'">'.$arReport['TITLE'].'</option>';
			}
			$strForm .= 	'</select>
						</div>';
			CASDOrderPrintUtil::AddAction($list, GetMessage('ASD_ADM_PRINT'), $strForm);
		}
	}

	public static function OnPrologHandler () {
		if ($_REQUEST['action']=='asd_orderprint' && strlen($_REQUEST['asd_print']) && ($GLOBALS['APPLICATION']->GetCurPage()=='/bitrix/admin/sale_order.php' || $GLOBALS['APPLICATION']->GetCurPage()=='/bitrix/admin/print_list.php') &&
			check_bitrix_sessid() && !empty($_REQUEST['ID']) && CModule::IncludeModule('sale') && CModule::IncludeModuleEx('asd.orderprint')!==MODULE_DEMO_EXPIRED
			) {
			$arTmp = Array();
			foreach($_REQUEST["ID"] as $value) {
				if(intval($value) > 0) {
					$arTmp[] = intval($value);
				}
			}
			$arID = implode("|", $arTmp);
			?><script type="text/javascript">window.open('/bitrix/admin/asd_print_orders.php?doc=<?=$_REQUEST['asd_print']?>&ORDER_ID=<?=$arID?>&SHOW_ALL=Y&PROPS_ENABLE=Y', '_blank');</script><?
		}
	}
}
?>