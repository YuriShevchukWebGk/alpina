<?
$postdata = http_build_query(
    array(
       'init' => 'get_pvz'
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
$result = file_get_contents('http://api.dostavka.guru/client/get_pvz_codes_2.php', false, $context);
$data = array(
	"result" => $result
);
echo json_encode($data);
?>