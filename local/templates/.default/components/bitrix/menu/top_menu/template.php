<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
foreach($arResult as $arItem) {
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<li><a class="topMenuLink" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
<?}?>

<?if (date("w") == 0) {?>
	<li class="timer"><a href="/actions/blackfriday/" style="color:red!important" target="_blank">Черная Пятница <span id="days"></span>:<span id="hours"></span>:<span id="minutes"></span>:<span id="seconds"></span></a></li>
	<script type="text/javascript" src="/js/countdown.js?201711231"></script>
<?} else {?>
	<li><a class="topMenuLink" href="/actions/freedigitalbooks/" target="_blank">Бесплатные электронные книги</a></li>
<?}?>