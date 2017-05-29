<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
foreach($arResult as $arItem) {
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<li><a class="topMenuLink" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
<?}?>
	<li><a class="topMenuLink" href="/actions/freedigitalbooks/" target="_blank">Бесплатные электронные книги</a></li>
	<?if ($USER->isAdmin()) {?>
		<li class="timer" style="color:red!important">Книги по 99 рублей <span id="days"></span>:<span id="hours"></span>:<span id="minutes"></span>:<span id="seconds"></span></li>
		<script type="text/javascript" src="/js/countdown.js"></script>
	<?}?>