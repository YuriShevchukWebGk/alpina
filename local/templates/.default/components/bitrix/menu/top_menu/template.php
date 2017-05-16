<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
foreach($arResult as $arItem) {
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<li><a class="topMenuLink" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
<?}?>

<?if (date("d", mktime(0, 0, 0, date("m")  , date("d"), date("Y"))) < 10) {?>
	<li><a class="topMenuLink" href="/actions/maysale/" style="color:red!important">Книги по 99 рублей</a></li>
<?} else {?>
	<li><a class="topMenuLink" href="/actions/freedigitalbooks/" target="_blank">Бесплатные электронные книги</a></li>
<?}?>