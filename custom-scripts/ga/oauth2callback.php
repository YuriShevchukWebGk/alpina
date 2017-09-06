<?php
require($_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/main/include/prolog_before.php');
// Load the Google API PHP Client Library.
require_once '/home/bitrix/vendor/autoload.php';

// Start a session to persist credentials.
session_start();

// Create the client object and set the authorization configuration
// from the client_secrets.json you downloaded from the Developers Console.
$client = new Google_Client();
$client->setAuthConfig('/home/bitrix/client_secrets.json');
$client->setRedirectUri('https://www.alpinabook.ru/custom-scripts/ga/oauth2callback.php');
$client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);

// Handle authorization flow from the server.
if (! isset($_GET['code'])) {
  $auth_url = $client->createAuthUrl();
  header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
      if (isset($_SESSION['access_token']['access_token'])) {
        $params = array(
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri'  => $redirect_uri,
            'grant_type'    => 'authorization_code',
            'code'          => $_GET['code']
        );
        $params['access_token'] = $_SESSION['access_token']['access_token'];

        $userInfo = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['id'])) {
            $userInfo = $userInfo;
            $result = true;
        }

    }

  if($userInfo["id"]){
        $redirect_uri = 'https://' . $_SERVER['SERVER_NAME'] . '/';
        global $USER;
        $filter = Array("EMAIL"=> $userInfo["email"]);
        $rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter); // выбираем пользователей
        if($user = $rsUsers->GetNext()){
            $user_name = $user;
        };
        if($user_name){
            print_r($user_name);
            $USER->Authorize($user_name["ID"]); // авторизуем
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        } else {
            $arResult = $USER->Register($userInfo["email"], $userInfo["given_name"], $userInfo["family_name"], $userInfo["id"], $userInfo["id"], $userInfo["email"]);
            ShowMessage($arResult); // выводим результат в виде сообщения
            echo $USER->GetID(); // ID нового пользователя
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }


        //<script type="text/javascript">window.close();</script>
  }
}

