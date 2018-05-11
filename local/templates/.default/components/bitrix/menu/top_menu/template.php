<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
foreach($arResult as $arItem) {
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<li><a class="topMenuLink<?if($arItem['SELECTED']){?> topMenuLink_selected<?}?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
<?}?>


<?if($USER->IsAdmin() || date('d.m.Y G:i') > '30.04.2018 23:50'){?>
        <li class="timer"><a href="/actions/maysale2018/">Акция. Книги по 99 руб</a></li>
<?} else if (date("d-m-Y") == "29-03-2018") {?>
	<li class="timer"><a href="/catalog/childrensale/" style="color:red!important">Книги для родителей по 199 рублей</a></li>
<?} else {?>
	<li><a class="topMenuLink" href="/actions/freedigitalbooks/" target="_blank">Бесплатные электронные книги</a></li>
<?}?> 