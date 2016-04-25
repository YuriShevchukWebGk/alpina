<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?/*if (!empty($arResult)):?>
<ul class="left-menu">
<?*/?>
<div class="leftMenu">
    <ul class="firstLevel">
        <?
        foreach($arResult as $arItem) {
	        if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) {
		        continue;
            }
        ?>
	        <?if($arItem["SELECTED"]) {?>
		        <li><a href="<?=$arItem["LINK"]?>" class="selected"><p><?=$arItem["TEXT"]?></p></a></li>
	        <?} else {?>
		        <li><a href="<?=$arItem["LINK"]?>"><p><?=$arItem["TEXT"]?></p></a></li>
	        <?}?>
	        
        <?}?>

    </ul>
</div>