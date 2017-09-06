<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
foreach($arResult as $arItem) {
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<li><a class="topMenuLink" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
<?}?>

	<?/*<li><a class="topMenuLink" href="/actions/freedigitalbooks/" target="_blank">Бесплатные электронные книги</a></li>*/?>
	<li class="timer"><a href="/catalog/mibf/" style="color:red!important" target="_blank">ММКВЯ 2017</a></li>
	<?/*<li class="timer"><a href="/actions/september1/" style="color:red!important" target="_blank">Скидки до 40% <span id="days"></span>:<span id="hours"></span>:<span id="minutes"></span>:<span id="seconds"></span></a></li>
	<script type="text/javascript" src="/js/countdown.js?20170903"></script>*/?>
