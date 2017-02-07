<? //error_reporting(E_ALL); 
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>                               
<?/*$APPLICATION->IncludeComponent(
    "bitrix:socserv.auth.split",
    "",
    Array(
        "SHOW_PROFILES" => "Y",
        "ALLOW_DELETE" => "Y"
    ),
false
);*/  
CModule::IncludeModule('sale');
global $USER;
$users = array();
$emails_arr = array();
$users_list = CUser::GetList ($by = "timestamp_x", $order = "desc", array());
$original_users_list = array();
while ($users_fetch = $users_list -> Fetch()) {
    if (strlen($users_fetch["EMAIL"]) > 0) {
        $users[$users_fetch["EMAIL"]][] = array("ID" => $users_fetch["ID"], "LOGIN" => $users_fetch["LOGIN"]);
    }
}
foreach ($users as $email => $val) {
    foreach ($val as $key => $arr) {
        if ($arr["LOGIN"] != $email && strstr($arr["LOGIN"], "newuser") && isset($arr["ID"])) {
            $emails_arr[$email][] = $arr["ID"];    
        } else if ($arr["LOGIN"] == $email){
            $original_users_list[$email] = $arr["ID"];    
        }
    }    
}
$orders_arr = array();
foreach ($emails_arr as $email => $email_arr) {
    
    if (!empty($email_arr)){
        //echo $i . "<br>";
        foreach ($email_arr as $curr_email) {    
            $order_list = CSaleOrder::GetList (array(), array("USER_ID" => $curr_email));
            while ($order_id = $order_list -> Fetch()) {
                $orders_arr[$email][] = $order_id["ID"];                           
            }
        }    
    }
    //logger($orders_arr, $_SERVER["DOCUMENT_ROOT"] . "/test.txt");
}
arshow($orders_arr);
//echo '123';
foreach ($orders_arr as $email => $val) {
    /*$arFields = array("USER_ID" => $original_users_list[$email]);
    foreach ($val as $key => $order_id) {
        CSaleOrder::Update ($order_id, $arFields);    
    }*/
}
?> 
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>