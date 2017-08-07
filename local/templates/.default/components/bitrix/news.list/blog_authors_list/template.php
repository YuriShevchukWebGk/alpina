<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$navnum = $arResult["NAV_RESULT"]->NavNum;

$template = $APPLICATION->GetTemplatePath();
$frame = $this->createFrame()->begin();
?>    

<div class="cataloggWrapper">
	<h1>Все авторы блога</h1>
	
	<ul>
		<?foreach ($arResult["ITEMS"] as $arItem) {
			$pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
			<li class="blogPostPreview">
				<center><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img title="<?=$arItem['NAME']?>" alt="Фотография <?=$arItem['NAME']?>" src="<?=$pict["src"]?>"></a></center>
				<div class="previewContent">
					<a class="title" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem['NAME']?></a>
					<div class="previewText"><?=$arItem['PROPERTIES']['WHOIS']['VALUE']?></div>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="fullText">Все посты</a>
				</div>
			</li>
		<?}?>
	</ul>
	<div class="clearer"></div>
	<div class="navigation">
		<?=$arResult["NAV_STRING"]?>
	</div>
</div>
<?$frame->end();?>