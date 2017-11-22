<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
foreach($arResult as $arItem) {
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<li><a class="topMenuLink" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
<?}?>

	<?/*<li><a class="topMenuLink" href="/actions/freedigitalbooks/" target="_blank">Бесплатные электронные книги</a></li>*/?>
	<?if (!$USER->isAdmin()) {?>
		<li class="timer"><a href="/actions/blackfriday/" style="color:red!important" target="_blank">До Черной Пятницы <span id="days"></span>:<span id="hours"></span>:<span id="minutes"></span>:<span id="seconds"></span></a></li>
	<?} else {?>
		<a href="/actions/blackfriday/" style="color:red!important" target="_blank"><li class="timer" style="width:400px"><div style="float:left">До Черной Пятницы</div>
		<div style="display:inline-block">
			<div style="padding:0 2px;float:left">
				<span>дней</span><br />
				<span id="days"></span>
			</div>:
			<div style="padding:0 2px;float:left">
				<span>часов</span><br />
				<span id="hours"></span>
			</div>:
			<div style="padding:0 2px;float:left">
				<span>минус</span><br />
				<span id="minutes"></span>
			</div>
			<div style="padding:0 2px;float:left">
				<span>секунд</span><br />
				<span id="seconds"></span>
			</div>
		</div>
		</li></a>
	<?}?>
	
	<script type="text/javascript" src="/js/countdown.js?20171123"></script>
