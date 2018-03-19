<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$navnum = $arResult["NAV_RESULT"]->NavNum;

$template = $APPLICATION->GetTemplatePath();
$frame = $this->createFrame()->begin();

$blocks = array();

foreach ($arResult["ITEMS"] as $i => $arItem) {
	if (($i + 1) % 3 == 1)
		$blocks[0][] = $arItem;
	elseif (($i + 1) % 3 == 2)
		$blocks[1][] = $arItem;
	else
		$blocks[2][] = $arItem;
}
?>

<div class="cataloggWrapper">
	<?foreach ($blocks as $block) {?>
		<ul class="block">
			<?foreach($block as $arItem) {
			$pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array('width'=>360, 'height'=>360), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
				<li class="blogPostPreview">
					<div class="date"><?=strtoupper(FormatDate("d M", MakeTimeStamp($arItem["ACTIVE_FROM"])))?></div>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"style="position:relative;width:100%;display:block"><div class="layer"></div><img title="<?=$arItem['NAME']?>" alt="Фотография <?=$arItem['NAME']?>" src="<?=$pict["src"]?>"></a>
					<?if (!empty($arItem["IBLOCK_SECTION_ID"])) {
						$section = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"]);
						$section = $section->GetNext();?>
						<div class="cat"><?=$section["NAME"]?></div>
					<?}?>
					<div class="previewContent">
						<a class="title" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem['NAME']?></a>
						<div class="previewText"><?=substr(strip_tags($arItem['DETAIL_TEXT']),0,250).'...'?></div>
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="fullText">Читать</a>
					</div>
				</li>
			<?}?>
		</ul>
	<?}?>
	
	<div class="clearer"></div>
	<div class="navigation">
		<?=$arResult["NAV_STRING"]?>
	</div> 
</div>
<?$frame->end();?>