<? if (preg_match('/GR_/', $_POST['order_id'])) {
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
} else if (preg_match('/CERT_/', $_POST['order_id'])) {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
    // проставляем активность элементу инфоблока, таким образом оплачиваем заказ
    $certificate_object = new CIBlockElement();
    $certificate_object->Update(str_replace("CERT_", "", $_POST['order_id']), array('ACTIVE' => 'Y'));
} else {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/tools/rficb.payment/result.php");
} ?>