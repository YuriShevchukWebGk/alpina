<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
/*$postdata = http_build_query(
    array(
        'key'                => $_POST['key'],
        'cost'               => $_POST['cost'],
        'name'               => $_POST['name'],
        'default_email'      => $_POST['default_email'],
        'order_id'           => $_POST['order_id'],
        'comment'            => $_POST['comment'],
        'payment_type'       => $_POST['payment_type'],
        'email'              => $_POST['email'],
        'phone_number'       => $_POST['phone_number'],
        'verbose'            => $_POST['verbose'],
        'background'         => $_POST['background'],
        'recurrent_order_id' => $_POST['recurrent_order_id'],
        'recurrent_type'     => $_POST['recurrent_type'],
        'recurrent_comment'  => $_POST['recurrent_comment'],
        'recurrent_url'      => $_POST['recurrent_url'],
        'check'              => $_POST['check']
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
$result = file_get_contents('https://partner.rficb.ru/a1lite/input', false, $context);*/
if ($_SESSION['rfi_recurrent_type'] == "next") {
	unset($_SESSION['rfi_recurrent_type']);	
	arshow($_POST);
} else {
	echo "none";
}
?>