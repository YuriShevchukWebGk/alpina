<?php
if (!empty($_POST["g-recaptcha-response"])) {
    $secret = "6LfaDjgUAAAAAKMlPPO0ZqOwSCOqA9LAvyzaqVqu";

    $postdata = http_build_query(
               array(
                   'secret' => $secret,
                   'response' => $_POST["g-recaptcha-response"]
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
    $result = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
    $data = json_decode($result,true);
    
    if ($data["success"]) {
        echo json_encode(array("result" => "SUCCESS"));
    } else {
        echo json_encode(array("result" => "ERROR"));
    }
} else {
    echo json_encode(array("result" => "ERROR"));
}
?>