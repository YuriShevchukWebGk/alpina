<?
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
$users = array();
$emails_arr = array();
$users_list = CUser::GetList ($by = "timestamp_x", $order = "desc", array());
while ($users_fetch = $users_list -> Fetch()) {
    $users[$users_fetch["EMAIL"]][] = array("ID" => $users_fetch["ID"], "LOGIN" => $users_fetch["LOGIN"]);
}
foreach ($users as $email => $val) {
    foreach ($val as $key => $arr) {
        if ($arr["LOGIN"] != $email && strstr($arr["LOGIN"], "newuser")) {
            $emails_arr[$email][] = $arr["ID"];    
        }
    }    
}
$orders = array();
foreach ($emails_arr as $email => $email_arr) {
    $order_list = CSaleOrder::GetList (array(), array("USER_ID" => $email_arr));
    while ($order = $order_list -> Fetch()) {
        $orders[$email] = $order["ID"];
    }
}
arshow($orders);
?> 
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>