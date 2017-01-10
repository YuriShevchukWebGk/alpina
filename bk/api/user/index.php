<?
    include_once $_SERVER["DOCUMENT_ROOT"] . '/bk/api/prolog.php';
    include_once $_SERVER["DOCUMENT_ROOT"] . '/bk/api/classes/user.php';

    if (Validator::isTokenValid($_REQUEST['token'])) {
        $user = new UserAPI();
		if (method_exists($user, $_REQUEST['method'])) {
			$res = $user->$_REQUEST['method']($_REQUEST);
        	APIResponse::send($res['status_code'], $res['data']);	
		} else {
			APIResponse::send("error", APITools::getLangPhrase("method_does_not_exist"));
		}
    } else {
        APIResponse::send("error", APITools::getLangPhrase("token_invalid"));
    }
?>