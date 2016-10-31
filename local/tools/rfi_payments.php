<? if (preg_match('/GR_/', $_POST['order_id'])) {
	file_put_contents(
	    $_SERVER["DOCUMENT_ROOT"] . "/logs/result.txt",
	    var_export($_POST, 1)."\n",
	    FILE_APPEND
	);
    require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
	$postdata = http_build_query(
        array(
           'email' => $_POST['email']
       )
    );

    $opts = array('http' =>
       array(
           'method'  => 'POST',
           'header'  => 'Content-type: application/x-www-form-urlencoded',
           'content' => $postdata
      )
    );
    
    $context  = stream_context_create($opts);
    $result = file_get_contents('http://readright.ru/gr_orders_payments.php', false, $context);
} else {
	require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/tools/rficb.payment/result.php");
} ?>