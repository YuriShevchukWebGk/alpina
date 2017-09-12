<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$files = array_slice(scandir(__DIR__),2);
foreach($files as $file) {
	$file = iconv('cp1251','UTF-8',$file);
	if (strpos($file,'php'))
		continue;
	echo '<a href="/docs/'.$file.'" target="_blank">'.$file.'</a><br />';
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>