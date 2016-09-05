<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/content/(reviews|articles|surveys)/([0-9]+)/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/content/reviews/index.php",
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
		"CONDITION" => "#^/catalog/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog/index.php",
	),
	array(
		"CONDITION" => "#^/authors/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/authors/index.php",
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
		"CONDITION" => "#^\\??(.*)#",
		"RULE" => "&\$1",
		"ID" => "bitrix:catalog.section",
		"PATH" => "/local/templates/.default/components/bitrix/news/series/bitrix/news.detail/.default/template.php",
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
	)
);

?>