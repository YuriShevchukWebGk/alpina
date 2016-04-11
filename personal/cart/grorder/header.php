<?
 function russian_date($dat){
$dat = substr($dat, 0, 10);
$date=explode(".",$dat);
switch ($date[1]){
case 1: $m='января'; break;
case 2: $m='февраля'; break;
case 3: $m='марта'; break;
case 4: $m='апреля'; break;
case 5: $m='мая'; break;
case 6: $m='июня'; break;
case 7: $m='июля'; break;
case 8: $m='августа'; break;
case 9: $m='сентября'; break;
case 10: $m='октября'; break;
case 11: $m='ноября'; break;
case 12: $m='декабря'; break;
}
echo $date[0].'&nbsp;'.$m.'&nbsp;'.$date[2];
}
?>

<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?$APPLICATION->ShowHead()?>
<title><?$APPLICATION->ShowTitle()?> | Альпина BrainFit</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,700italic,400italic&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="/bitrix/templates/brainfit.ico" type="image/vnd.microsoft.icon" />
<link rel="stylesheet" type="text/css" href="/bitrix/templates/<? echo SITE_TEMPLATE_ID;?>/fancybox/jquery.fancybox.css" media="screen" />
	<script type="text/javascript" src="/bitrix/templates/<? echo SITE_TEMPLATE_ID;?>/fancybox/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="/bitrix/templates/<? echo SITE_TEMPLATE_ID;?>/fancybox/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="/bitrix/templates/<? echo SITE_TEMPLATE_ID;?>/fancybox/jquery.fancybox-1.2.1.pack.js"></script>




<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-10620222-5']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter16812922 = new Ya.Metrika({id:16812922, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/16812922" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
</head>

<body>
<?$APPLICATION->ShowPanel();?>



<div class="main">

<div class="top">
<div class="logo">
 <a class="" href="/index.php"><img  src="/bitrix/templates/<? echo SITE_TEMPLATE_ID;?>/img/logo_1.png"></a>
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"top_menu",
	Array(
		"ROOT_MENU_TYPE" => "top",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => "",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	)
);?>

<div class="right_top">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	".default",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => "/bitrix/templates/top_contact.php",
		"EDIT_TEMPLATE" => ""
	)
);?>
</div>
</div>

<div class="content">
<div class="content_l">
<div class="down_l">
<a href="/timetable/">Расписание</a>
</div>

<div class="up_l">
<a href="/training/">Наши тренинги</a>


<?
if(CModule::IncludeModule('iblock')) {

  $arFilter = Array('IBLOCK_ID'=>1, 'GLOBAL_ACTIVE'=>'Y');
  $db_list = CIBlockSection::GetList(Array("SORT"=>"­­ASC"), $arFilter, true);
  $db_list->NavStart(20);
  echo $db_list->NavPrint($arIBTYPE["SECTION_NAME"]);
 

 
$dir = $APPLICATION->GetCurDir();
$dir = explode("/", $dir);


  while($ar_result = $db_list->GetNext())
  {

if ($ar_result["ELEMENT_CNT"]==0) {
	$patterns = array("(базовый курс)", "(интенсив)", "(расширенный курс)");
	$replace = array("<br /><span style='font-size:12px;'>(базовый курс)</span>", "<br /><span style='font-size:12px;'>(интенсив)</span>", "<br /><span style='font-size:12px;'>(расширенный курс)</span>");
	echo "<ul  class='left_menu'><a style='background:none;font-weight:400;margin-bottom:0;padding:0' href='".$ar_result['SECTION_PAGE_URL'] ."/'>• ".str_replace($patterns, $replace, $ar_result['NAME'])."</a>" ;
	//print_r($ar_result);
}

else{
 echo "<ul id='t".$ar_result['ID']."' class='left_menu'>".$ar_result['NAME'] ;
?>
<script>
$( document ).ready(function() {
//$("#t<?echo $ar_result['ID']?> li").css("display","none");

$("#t<?echo $ar_result['ID']?>").click(function( event){
$("#t<?echo $ar_result['ID']?> li").css("display","block");
});

});
</script>
<?if ($ar_result["CODE"]!=$dir[2])
{
?>
<style>
#t<?echo $ar_result['ID']?> li{
display:none;
}
</style>
<?
} ?>

<?
}




$arFilter = Array("IBLOCK_ID"=>1,"SECTION_ID" => $ar_result['ID'],"ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y"); 
//$arSelect = Array("ID", "NAME", "ID", "IBLOCK_CODE", "DETAIL_PAGE_URL",);
$res_o = CIBlockElement::GetList(Array("active_from"=>"desc"), $arFilter, false, Array("nPageSize"=>50), $arSelect); 
while($ar_fields_o = $res_o->GetNextElement()) 
{ 
$arItem = $ar_fields_o->GetFields(); 
$arProp= $ar_fields_o->GetProperties(); 
echo  "<li ><a href='".$arItem["DETAIL_PAGE_URL"]."'>". $arItem["NAME"]."</a></li>";
//print_r($arItem["DETAIL_PAGE_URL"]);
//

} 
echo "</ul>";
}
}
?>



<!--
<ul class='left_menu'>Эффективное чтение
<li><a href="index.html">Базовый курс</a></li>
<li><a href="">Интенсив</a></li>
</ul>

<ul class='left_menu'>Личная деловая эффективность</ul>

<ul class='left_menu'>Криативное мышление</ul>
<ul class='left_menu'>Майнд-меп</ul>
<ul class='left_menu'>Управленческий клуб</ul>
<ul class='left_menu'>Эффективность совещания</ul>
<ul class='left_menu'>Манипуляция на переговорах</ul>
<ul class='left_menu'>Вебинары</ul>-->
</div>

<div class="down_l">
<a href="/corporate/">Корпоративным клиентам</a>
</div>

<div class="down_l">
<a href="/trainer/">Наши тренеры</a>
</div>

<div aliign="center" class="social">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	".default",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => "/bitrix/templates/social.php",
		"EDIT_TEMPLATE" => ""
	)
);?>
<!--<a style="margin-right:26px" href=""><img src="/bitrix/templates/<? echo SITE_TEMPLATE_ID;?>/img/utube.png"/></a>
<a style="margin-right:26px" href=""><img src="/bitrix/templates/<? echo SITE_TEMPLATE_ID;?>/img/tw.png"/></a>
<a  href=""><img src="/bitrix/templates/<? echo SITE_TEMPLATE_ID;?>/img/fb.png"/></a>-->
</div>

<div class="down_l">
<a href="/about/reviews">Отзывы</a>
</div>


<div style="margin-top:-2px" class="up_l"><!--отзыв-->
<?
//$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("RAND" => "ASC"), $arFilter, false, Array ("nTopCount" => 1), $arSelect);
while($ob = $res->GetNextElement())
{
  $arFields = $ob->GetFields();
$arProp = $ob->GetProperties();
  //print_r($arProp);?>
<p class="text"><a href="<?echo $arFields["DETAIL_PAGE_URL"]?>" style="font-style:italic;background:none;margin:none;padding:0;color:black;font-weight:400"><?echo substr($arFields["DETAIL_TEXT"],0,120).'...';?></a></p>
<label style="float:right;margin-right:12px;font-size:13px;font-weight:600;width:183px;font-style:italic;"> <?echo $arProp["name"]["VALUE"];?></label>
<?}
?>

<br clear="all">
</ul>

</div>


<br clear="all">
</div>

<div class="content_c">



