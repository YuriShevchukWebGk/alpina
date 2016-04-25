<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?> 
<?
$return = Array();
$filter = Array("GROUPS_ID" => Array(9),"ACTIVE" => "Y");
$rsUsers = CUser::GetList(($by=""), ($order=""), $filter,array("FIELDS"=>array("ID","NAME","LAST_NAME","PERSONAL_MOBILE"))); // выбираем пользователей
while($test_cur = $rsUsers->NavNext(true, "f_")){
    if(!preg_match('/[0-9]/',$test_cur['LAST_NAME'])){
        array_push($return,Array("ID"=>$test_cur["ID"],"NAME"=>$test_cur['NAME']." ".$test_cur['LAST_NAME'],"PHONE"=>$test_cur['PERSONAL_MOBILE']));
    } else {
        array_push($return,Array("ID"=>$test_cur["ID"],"NAME"=>$test_cur['NAME'],"PHONE"=>$test_cur['LAST_NAME']));
    }
}
echo json_encode($return);
?>