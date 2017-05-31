<?
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS",true);
define('BX_NO_ACCELERATOR_RESET', true);
//echo 111;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//echo 'aaa='.$USER->Authorize(1);
$USER1 = new CUser;
$ID = $USER1->Add($_POST);
if (intval($ID) > 0)
    echo json_encode(array("status" => 1));
else
    echo json_encode(array("status" => 0, "msg" => $USER1->LAST_ERROR));
?>