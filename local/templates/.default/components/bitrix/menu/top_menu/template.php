<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//test_dump($arResult);


foreach($arResult as $arItem) {
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<li><a class="topMenuLink<?if($arItem['SELECTED']){?> topMenuLink_selected<?}?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
<?}?>

<?if (date("d-m-Y") == "29-03-2018") {?>
	<li class="timer"><a href="/catalog/childrensale/" style="color:red!important">Книги для родителей по 199 рублей</li>
<?} else {?>
	<li><a class="topMenuLink" href="/actions/freedigitalbooks/" target="_blank">Бесплатные электронные книги</a></li>
<?}?>