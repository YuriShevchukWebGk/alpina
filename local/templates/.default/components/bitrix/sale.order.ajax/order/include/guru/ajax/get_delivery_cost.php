<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$postdata = http_build_query(
    array(
       'method'   => 'ПВЗ',
       'weight'   => $_POST['weight'],
       'ocen_sum' => $_POST['sum'],
       'nal_plat' => '0',
       'client'   => GURU_CLIENT_ID,
       'key'      => GURU_CLIENT_KEY,
       'point'    => $_POST['point_id']
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
$result = file_get_contents('http://api.dostavka.guru/client/calc_guru_main_2_0.php', false, $context);

list($delivery_price, $delivery_time) = split('::', $result);
echo $result;
/*if ($delivery_price != "ERROR") {
	sprintf("%s::%s", $delivery_price, $delivery_time);
} else {
	// подхват здесь на случай ошибки
}*/
?>