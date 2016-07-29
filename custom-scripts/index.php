<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {

$ar=glob('/home/bitrix/www/custom-scripts/*.php');
foreach($ar as $file)
{
  $file=preg_replace('/\/home\/bitrix\/www/', '', $file); // что бы спецсимволы нормально отображались
  echo "<a href=\"$file\">$file</a><br />";
}
echo 1;
}?>