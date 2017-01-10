<?  
    include_once __DIR__ . '/prolog.php';
	
	$postdata = http_build_query(
        array(
           'method' => 'tryLogin',
           'token' => '21323rvr54545ttgt',
           'email' => 'test2345@test.ru',
           'password' => '1234534346'
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
    $result = file_get_contents('http://admin:admin@dev-lukashov-alpinabook.webgk.ru/api/user/', false, $context);
	
	arshow($result);
?>