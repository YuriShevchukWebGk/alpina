#!/usr/bin/php
<?php
$_SERVER["DOCUMENT_ROOT"] = '/home/bitrix/www';
define('LOG_FILENAME', $_SERVER["DOCUMENT_ROOT"]."/custom-scripts/log.txt");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
AddMessage2Log('Скрипт выполнен cron', 'pageviews_ga.php');

CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
CModule::IncludeModule("main");

// Загрузка клиентской библиотеки PHP для Google API.
require_once '/home/bitrix/vendor/autoload.php';

$analytics = initializeAnalytics();
$response1 = getLastTwoDays($analytics, '21409934');
$response2 = getLastMonth($analytics, '21409934');
printResultsTwoDays($response1);
printResultsMonth($response2);

function initializeAnalytics()
{
  // Creates and returns the Analytics Reporting service object.

  // Use the developers console and download your service account
  // credentials in JSON format. Place them in this directory or
  // change the key file location if necessary.
  $KEY_FILE_LOCATION = '/home/bitrix/site_secrets.json';

  // Create and configure a new client object.
  $client = new Google_Client();
  $client->setApplicationName("Hello Analytics Reporting");
  $client->setAuthConfig($KEY_FILE_LOCATION);
  $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
  $analytics = new Google_Service_Analytics($client);

  return $analytics;
}

function getLastTwoDays($analytics, $profileId) {
	// Вызов Core Reporting API и отправка запроса о количестве сессий
	// за последние семь дней.
	return $analytics->data_ga->get(
		'ga:' . $profileId,
		'yesterday',
		'today',
		'ga:pageViews',
		array(
			'dimensions'=>'ga:pagePath',
			'sort'=>'-ga:pageviews',
			'filters'=>'ga:pagePath=~^/catalog/([a-zA-Z0-9]+)/([0-9]+)/index.php$',
			'max-results'=>'20000'
			
		)
	);
}

function getLastMonth($analytics, $profileId) {
	// Вызов Core Reporting API и отправка запроса о количестве сессий
	// за последние семь дней.
	return $analytics->data_ga->get(
		'ga:' . $profileId,
		'15daysAgo',
		'today',
		'ga:pageViews',
		array(
			'dimensions'=>'ga:pagePath',
			'sort'=>'-ga:pageviews',
			'filters'=>'ga:pagePath=~^/catalog/([a-zA-Z0-9]+)/([0-9]+)/index.php$',
			'max-results'=>'20000'
			
		)
	);
}

function printResultsTwoDays($results) {
	$addViews = array(
	1,
	186046,
	124350,
	186001,
	81365,
	);
  // Синтаксический анализ ответа Core Reporting API с выводом
  // имени профиля и общего количества сессий.
  if (count($results->getRows()) > 0) {

    // Получение имени профиля.
    $profileName = $results->getProfileInfo()->getProfileName();

    // Получение значения первой записи в первом ряду.
    $rows = $results->getRows();
    //$result = $rows[0][0];
    // Вывод результатов.
    //print "<p>First view (profile) found: $profileName</p>";
    //print "<p>Total sessions: $result</p>";
	$table = array();
	$already = array();
	$already[] = 'start';
	foreach ($rows as $i=>$row) {
		$subject = $row[0];
		$pattern = '/([0-9]{3,7})/'; 
		preg_match($pattern, $subject, $matches); 
		if (!array_search($matches[0], $already)) {
			$table[$i]['url'] = $row[0];
			$table[$i]['views'] = $row[1];
			$table[$i]['id'] = $matches[0];
			$already[] = $table[$i]['id'];
		}
	}
	
	foreach ($table as $book) {
		$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE"=>"Y", "ID" => $book['id']);

		$props = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, Array("ID"));
		while ($oneb = $props->GetNext()) {
			if(array_search($oneb["ID"], $addViews))
				$views = round($book['views']*2.1 + 100);
			else
				$views = round($book['views']*1.5);
			//echo $book['url'].' '.$book['views'].'<br />';
			CIBlockElement::SetPropertyValuesEx($oneb["ID"], 4, array('page_views_ga' => $views));
		}
	}
  } else {
    print "<p>No results found.</p>";
  }
}

function printResultsMonth($results) {
  // Синтаксический анализ ответа Core Reporting API с выводом
  // имени профиля и общего количества сессий.
  if (count($results->getRows()) > 0) {

    // Получение имени профиля.
    $profileName = $results->getProfileInfo()->getProfileName();

    // Получение значения первой записи в первом ряду.
    $rows = $results->getRows();
    //$result = $rows[0][0];
    // Вывод результатов.
    //print "<p>First view (profile) found: $profileName</p>";
    //print "<p>Total sessions: $result</p>";
	$table = array();
	$already = array();
	$already[] = 'start';
	foreach ($rows as $i=>$row) {
		$subject = $row[0];
		$pattern = '/([0-9]{3,7})/'; 
		preg_match($pattern, $subject, $matches); 
		if (!array_search($matches[0], $already)) {
			$table[$i]['url'] = $row[0];
			$table[$i]['views'] = $row[1];
			$table[$i]['id'] = $matches[0];
			$already[] = $matches[0];
		}
	}
	
	foreach ($table as $book) {
		$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE"=>"Y", "ID" => $book['id']);

		$props = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, Array("ID"));
		while ($oneb = $props->GetNext()) {
			$views = $book['views'];
			echo $book['url'].' '.$book['views'].'<br />';
			CIBlockElement::SetPropertyValuesEx($oneb["ID"], 4, array('shows_a_day' => $views));
		}
	}
  } else {
    print "<p>No results found.</p>";
  }
}
?>