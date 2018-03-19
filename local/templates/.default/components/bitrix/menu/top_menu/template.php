<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
foreach($arResult as $arItem) {
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<li><a class="topMenuLink" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
<?}?>

<?if (date("Y-m-d") == "2018-01-30" || $USER->isAdmin()) {?>
	<li class="timer"><a href="#" style="color:red!important" onclick="getInfo('freedelivery');return false">Акция! Бесплатная доставка</li>
	<script>
	function getInfo(id) {
		$.ajax({
			type: "POST",
			url: "/ajax/info_popup.php",
			data: {info: id}
		}).done(function(strResult) {
			$("#ajaxBlock").append(strResult);
			$("body").css('overflow','hidden');
		});
	}
	</script>
<?} else {?>
	<li><a class="topMenuLink" href="/actions/freedigitalbooks/" target="_blank">Бесплатные электронные книги</a></li>
<?}?>