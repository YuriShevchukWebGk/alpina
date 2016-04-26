<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/bitrix/services/ymarket/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/bitrix/services/ymarket/index.php",
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
		"CONDITION" => "#^/series/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/series/index.php",
	),
	array(
<<<<<<< HEAD
		"CONDITION" => "#^/events/#",
=======
		"CONDITION" => "#^\\??(.*)#",
		"RULE" => "&\$1",
		"ID" => "bitrix:catalog.section",
		"PATH" => "/catalog/editors-choice/index.php",
	),
	array(
		"CONDITION" => "#^/store/#",
>>>>>>> upstream/master
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/events/index.php",
	),
	array(
		"CONDITION" => "#^\\??(.*)#",
		"RULE" => "&\$1",
		"ID" => "bitrix:catalog.section",
<<<<<<< HEAD
		"PATH" => "/catalog/new/index.php",
=======
		"PATH" => "/bitrix/templates/.default/components/bitrix/news/series/bitrix/news.detail/.default/template.php",
>>>>>>> upstream/master
	),
	array(
		"CONDITION" => "#^\\??(.*)#",
		"RULE" => "&\$1",
		"ID" => "bitrix:catalog.section",
		"PATH" => "/catalog/coming-soon/index.php",
	),
	array(
		"CONDITION" => "#^\\??(.*)#",
		"RULE" => "&\$1",
		"ID" => "bitrix:catalog.section",
<<<<<<< HEAD
		"PATH" => "/local/templates/.default/components/bitrix/news/series/bitrix/news.detail/.default/template.php",
=======
		"PATH" => "/catalog/coming-soon/index.php",
>>>>>>> upstream/master
	),
	array(
		"CONDITION" => "#^\\??(.*)#",
		"RULE" => "&\$1",
		"ID" => "bitrix:catalog.section",
		"PATH" => "/catalog/mustread/index.php",
	),
	array(
<<<<<<< HEAD
		"CONDITION" => "#^\\??(.*)#",
		"RULE" => "&\$1",
		"ID" => "bitrix:catalog.section",
		"PATH" => "/bitrix/templates/.default/components/bitrix/news/series/bitrix/news.detail/.default/template.php",
	),
	array(
		"CONDITION" => "#^\\??(.*)#",
		"RULE" => "&\$1",
		"ID" => "bitrix:catalog.section",
		"PATH" => "/catalog/editors-choice/index.php",
	),
	array(
		"CONDITION" => "#^/store/#",
		"RULE" => "",
		"ID" => "bitrix:catalog.store",
		"PATH" => "/store/index.php",
	),
	array(
=======
>>>>>>> upstream/master
		"CONDITION" => "#^/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/news/index.php",
	),
	array(
		"CONDITION" => "#^/#",
		"RULE" => "",
		"ID" => "bitrix:iblock.element.add.form",
		"PATH" => "/about/contacts/index.php",
	),
	array(
		"CONDITION" => "#^/#",
		"RULE" => "",
		"ID" => "bitrix:form.result.new",
		"PATH" => "/content/partnersProgram/index.php",
	),
);

?>