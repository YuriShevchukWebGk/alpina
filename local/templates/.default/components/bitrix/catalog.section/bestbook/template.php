<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$arResult = $arResult["ITEMS"][0];
$main_pict = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], array('width'=>360, 'height'=>540), BX_RESIZE_IMAGE_PROPORTIONAL, true);
$main_author = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 29, "ID" => $arResult["PROPERTIES"]["AUTHORS"]["VALUE"][0]), false, false, array("ID", "NAME", "DETAIL_PICTURE", "PREVIEW_TEXT")) -> Fetch();
$author_pict = CFile::ResizeImageGet($main_author["DETAIL_PICTURE"]["ID"], array('width'=>133, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
?>

<style>
	.bestbook{padding:20px 40px 40px;background:#fff;display:inline-block;margin-top:40px;box-shadow: 0 5px 5px 0 rgba(0,0,0,.18), 0 10px 7px 0 rgba(0,0,0,.14)}
	.bestbook .badge{background-color: #e52222;padding:5px 12px 2px;text-transform:uppercase;font-size:20px;color:#fff;text-align:center;border-radius:6px 6px 0 0;width:auto;max-width:240px;font-family: Walshein_light!important;float:right;margin:-56px 70px 0}
	.bestbook .name{font-size:40px;color:#333}
	.bestbook .cover{float:right;margin-left:40px}
	.bestbook img{box-shadow: 0 5px 5px 0 rgba(0,0,0,.18), 0 10px 7px 0 rgba(0,0,0,.14);transition: box-shadow .4s ease, transform .4s ease 0s}
	.bestbook img:hover{box-shadow: 0 19px 23px 0 rgba(0,0,0,.18), 0 17px 23px 0 rgba(0,0,0,.14);transform: scale(1.01)}
	.bestbook .description{color:#444;text-transform:none;font-size:18px;margin-top:20px}
	.bestbook .button{display:block;background-color: #00abb8;border-radius: 35px;color: #fff;font-size: 22px;padding: 14px 30px;transition: color .3s ease,background-color .3s ease,border-color .3s ease;width:300px;margin-top:40px;text-align:center}
	.saleWrapp{clear:both}
</style>

<div class="bestbook">
	<div class="badge">
		Книга недели
	</div>

	<div class="cover">
		<a href="<?=$arResult["DETAIL_PAGE_URL"]?>">
			<img src="<?=$main_pict["src"]?>" title="<?=$main_author["NAME"].' «'.$arResult["NAME"].'»'?>">
		</a>
		<a href="<?=$arResult["DETAIL_PAGE_URL"]?>" class="button">
			<?=typo('Описание, отзывы и рецензии на книгу')?>
		</a>
	</div>

	<div class="name">
		<?=typo($arResult["NAME"])?>
	</div>
	<div class="description">
		<?=typo(strip_tags($arResult["PREVIEW_TEXT"]))?>
	</div>

	<pre>
		<?
		//print_r($arResult);
		//print_r($main_author);
		?>
	</pre>
</div>
