<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?/*if (!empty($arResult)):?>
<ul class="left-menu">
<?*/?>
<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<?/*if($arItem["SELECTED"]):?>
		<li><a href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a></li>
	<?else:?>
		<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
	<?endif?>
	
<?endforeach?>

</ul>
<?endif*/?>
<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
<?endforeach;?>

<script>
$(document).ready(function(){
    var CurDir = "<?=$APPLICATION -> GetCurDir()?>";
    $(".historyMenuWrap ul li").each(function(){
            
            if ($(this).find("a").attr("href") == CurDir)
            {
                $(this).find("a").addClass("active");
            }
            
        })
        
    $(".historyBodywrap > div").addClass("centerWrapper");
});
</script>