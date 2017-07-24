<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="cataloggWrapper">
	<h1>Записи в разделе «<?=$arResult["SECTION"]["PATH"][0]["NAME"]?>»</h1>
	
	<ul>
		<?foreach ($arResult["ITEMS"] as $arItem) {
			$pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array('width'=>360, 'height'=>360), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
			<li class="blogPostPreview">
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img title="<?=$arItem['NAME']?>" alt="Фотография <?=$arItem['NAME']?>" src="<?=$pict["src"]?>"></a>
				<div class="previewContent">
					<a class="title" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem['NAME']?></a>
					<div class="previewText"><?=substr(strip_tags($arItem['DETAIL_TEXT']),0,250).'...'?></div>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="fullText">Читать</a>
				</div>
			</li>
		<?}?>
	</ul>
	<div class="clearer"></div>
	<div class="navigation">
		<?=$arResult["NAV_STRING"]?>
	</div>
</div>
<script type="text/javascript">
    (window["rrApiOnReady"] = window["rrApiOnReady"] || []).push(function() {
		try { rrApi.categoryView(<?=$arResult["SECTION"]["PATH"][0]["ID"]?>); } catch(e) {}
	})
</script>