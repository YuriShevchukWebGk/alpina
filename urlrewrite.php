<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/content/(reviews|articles|surveys)/([0-9]+)/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/content/reviews/index.php",
	),
	array(
		"CONDITION" => "#^/online/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#",
		"RULE" => "alias=\$1",
		"ID" => "bitrix:im.router",
		"PATH" => "/desktop_app/router.php",
	),
	array(
		"CONDITION" => "#^/bitrix/services/ymarket/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/bitrix/services/ymarket/index.php",
	),
	array(
		"CONDITION" => "#^/good-arithmetics-news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/good-arithmetics-news/index.php",
	),
	array(
		"CONDITION" => "#^/testpersonal/order/#",
		"RULE" => "",
		"ID" => "bitrix:sale.personal.order",
		"PATH" => "/testpersonal/order/index.php",
	),
	array(
		"CONDITION" => "#^/online/(/?)([^/]*)#",
		"RULE" => "",
		"ID" => "bitrix:im.router",
		"PATH" => "/desktop_app/router.php",
	),
	array(
		"CONDITION" => "#^/stssync/calendar/#",
		"RULE" => "",
		"ID" => "bitrix:stssync.server",
		"PATH" => "/bitrix/services/stssync/calendar/index.php",
	),
	array(
		"CONDITION" => "#^/testcatalog/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/testcatalog/index.php",
	),
	array(
		"CONDITION" => "#^/teststore/#",
		"RULE" => "",
		"ID" => "bitrix:catalog.store",
		"PATH" => "/teststore/index.php",
	),
	array(
		"CONDITION" => "#^/testnews/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/testnews/index.php",
	),
	array(
		"CONDITION" => "#^/authors/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/authors/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog/index.php",
	),
	array(
		"CONDITION" => "#^/events/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/events/index.php",
	),
	array(
		"CONDITION" => "#^/series/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/series/index.php",
	),
	array(
		"CONDITION" => "#^/store/#",
		"RULE" => "",
		"ID" => "bitrix:catalog.store",
		"PATH" => "/store/index.php",
	),
	array(
		"CONDITION" => "#^/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/news/index.php",
	),
);

?>