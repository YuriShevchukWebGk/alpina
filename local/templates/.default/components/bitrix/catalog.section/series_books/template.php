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
<?$frame = $this->createFrame()->begin();?>
<div class="seriesBooksWrap">
	<a href="/series/<?=$arResult['ORIGINAL_PARAMETERS']['GLOBAL_FILTER']['PROPERTY_SERIES']?>/" class="sectionTitle">Другие книги серии</a>
	<ul class="seriesBooks">
		<?foreach ($arResult["ITEMS"] as $arItem) {
			$pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>140, 'height'=>230), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			foreach ($arItem["PRICES"] as $arPrice) {?>
				<li class="seriesBook">
					<div>
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
							<div class="section_item_img">
								<img src="<?=$pict["src"]?>" class="bookImg" title="<?=$arItem["NAME"]?>" alt="<?=$arItem["NAME"]?>">
							</div>
							<p class="bookName" title="<?=$arItem["NAME"]?>"><?echo (mb_strlen($arItem["NAME"]) > 30) ? mb_substr($arItem["NAME"],0,30).'...' : $arItem["NAME"];?></p>
							<p class="tapeOfPack"><?=$arItem["PROPERTIES"]["COVER_TYPE"]["VALUE"]?></p>
							<?
							if (intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != 22 && intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) != 23) {
								if ($discount) {?>
									<p class="bookPrice"><?=($arPrice["DISCOUNT_VALUE_VAT"]*(1 - $discount/100))?> &#8381;</p>
								<?} else {?>    
									<p class="bookPrice"><?=($arPrice["DISCOUNT_VALUE_VAT"])?> &#8381;</p>
								<?}?>
							<?} else if (intval($arItem["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]) == 23) {?>
								<p class="bookPrice"><?=$arItem["PROPERTIES"]["STATE"]["VALUE"]?></p>
							<?} else {?>
								<p class="bookPrice"><?=strtolower(FormatDate("j F Y", MakeTimeStamp($arItem['PROPERTIES']['SOON_DATE_TIME']['VALUE'], "DD.MM.YYYY HH:MI:SS")));?></p>
							<?}?>
						</a>
					</div>    
				</li>
		  <?}
		}?>

	</ul>
</div>
<?$frame->end();?>