<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$arResult = $arResult["ITEMS"][0];
$main_pict = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], array('width'=>300, 'height'=>540), BX_RESIZE_IMAGE_PROPORTIONAL, true);
$main_author = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 29, "ID" => $arResult["PROPERTIES"]["AUTHORS"]["VALUE"][0]), false, false, array("ID", "NAME", "DETAIL_PICTURE", "PROPERTY_AUTHOR_DESCRIPTION")) -> Fetch();
$author_pict = CFile::ResizeImageGet($main_author["DETAIL_PICTURE"], array('width'=>200, 'height'=>200), BX_RESIZE_IMAGE_EXACT, true);
$colors = explode(',',$arResult["PROPERTIES"]["colors"]["VALUE"]);
?>

<style>
	.bestbook{padding:20px 40px 25px;background:<?=$colors[0]?>;display:inline-block;margin-top:40px}
	.bestbook .before{background:#fff;opacity:0.7;height: 200px;width: 100%;margin-top: -20px;content: '';position: absolute;left: 0;}
	.bestbook .after{background:#fff;opacity:0.1;height: 600px;width: 100%;margin-top: 100px;content: '';position: absolute;left: 0;}
	.bestbook .badge{background-color: <?=$colors[0]?>;padding:5px 12px 2px;text-transform:uppercase;font-size:20px;color:#fff;text-align:center;border-radius:6px 6px 0 0;width:auto;max-width:240px;font-family: Walshein_light!important;float:left;margin: -55px -11px 0;position:relative}
	.bestbook .name{font-size:32px;color:<?=$colors[0]?>}
	.bestbook .name span{font-size:24px;font-family: Walshein_light}
	.bestbook .cover{float:right;margin-left:40px}
	.bestbook .cover img{box-shadow: 0 5px 5px 0 rgba(0,0,0,.18), 0 10px 7px 0 rgba(0,0,0,.14);transition: box-shadow .4s ease, transform .4s ease 0s;margin-top:-50px}
	.bestbook .cover img:hover{box-shadow: 0 19px 23px 0 rgba(0,0,0,.18), 0 17px 23px 0 rgba(0,0,0,.14);transform: scale(1.01)}
	.bestbook .description{color:#eee;text-transform:none;font-size:18px;margin-top:20px;font-family: Walshein_light}
	.bestbook .button{display:block;background-color: #00abb8;border-radius: 35px;color: #fff;font-size: 22px;padding: 14px 30px;transition: color .3s ease,background-color .3s ease,border-color .3s ease;width:300px;margin-top:40px;text-align:center}
	.saleWrapp{clear:both}
	.bestbook .wrap{position:relative}
	.bestbook .author{border-top:1px solid #fff;padding:20px 50px;color:#eee;margin-top:30px;font-family: Walshein_light;font-style:italic}
</style>
<script>
	$(document).ready(function() {
		var setheight = $(".bestbook .name").height();
		$(".bestbook .before").css("height",setheight+30+'px');
		$(".bestbook .after").css("margin-top",setheight+10+'px');
	});
</script>

<div class="bestbook">
	<div class="before"></div>
	<div class="after"></div>
	<div class="wrap">

	<div class="cover">
		<a href="<?=$arResult["DETAIL_PAGE_URL"]?>">
			<img src="<?=$main_pict["src"]?>" title="<?=$main_author["NAME"].' «'.$arResult["NAME"].'»'?>">
		</a>
		<?/*<a href="<?=$arResult["DETAIL_PAGE_URL"]?>" class="button">
			<?=typo('Описание, отзывы и рецензии на книгу')?>
		</a>*/?>
	</div>
	<div class="badge">
		Книга недели
	</div>
	<div class="name">
		<?=typo($arResult["NAME"])?>
		<br />
		<span><?=$main_author["NAME"]?></span>
	</div>
	<div class="description">
		<?=typo(strip_tags($arResult["PREVIEW_TEXT"]))?>
	</div>
	<?if (!empty($main_author["PROPERTY_AUTHOR_DESCRIPTION_VALUE"]["TEXT"])) {?>
	<div class="author">
		<img src="<?=$author_pict["src"]?>" style="margin-right:30px;border-radius:100px;width:100px;height:100px" align="left" />
		<?=typo(substr(strip_tags($main_author["PROPERTY_AUTHOR_DESCRIPTION_VALUE"]["TEXT"]),0,150))?>
	</div>
	<?}?>

	<pre>
		<?
		//print_r($arResult);
		//print_r($main_author);
		?>
	</pre>
</div>
</div>
