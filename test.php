<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
/*$postdata = http_build_query(
    array()
);

$opts = array('http' =>
   array(
       'method'  => 'GET',
       'header'  => 'Content-type: application/x-www-form-urlencoded',
       'content' => $postdata
  )
);

$context  = stream_context_create($opts);
$result = file_get_contents('http://sailplay.ru/api/v1/login/?pin_code=6879&store_department_key=96686988&store_department_id=1503', false, $context);

arshow(json_decode($result,true));*/
$token = "678248530c2f0a24a867df300095187b1d578cab";
$postdata = http_build_query(
    array()
);

$opts = array('http' =>
   array(
       'method'  => 'GET',
       'header'  => 'Content-type: application/x-www-form-urlencoded',
       'content' => $postdata
  )
);

$context  = stream_context_create($opts);
$result = file_get_contents('http://sailplay.ru/api/v2/users/info/?email=st@bgk.ru&token=678248530c2f0a24a867df300095187b1d578cab&store_department_id=1503&extra_fields=auth_hash', false, $context);


arshow(json_decode($result,true));
?>