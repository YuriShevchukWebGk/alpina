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

<div class="teamMembers">
	<?foreach ($arResult["ITEMS"] as $arItem) {?>
		<div class="teamMember">
			<h3><span class="main"><?=$arItem["NAME"]?></span>, <span class="position"><?=$arItem["PROPERTIES"]["job"]["VALUE"]?>, <a href="mailto:<?=$arItem["PROPERTIES"]["email"]["VALUE"]?>"><?=$arItem["PROPERTIES"]["email"]["VALUE"]?></a></span></h3>
			<?if ($arItem["PREVIEW_PICTURE"]["ID"]) {
				$arItem["PREVIEW_PICTURE"] = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']["ID"], array("width" => 300, "height" => 500), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
				<img src="<?=$arItem["PREVIEW_PICTURE"]["src"]?>" align="left">
			<?}?>
			<div class="description">
				<?=$arItem["PREVIEW_TEXT"]?>
			</div>


		</div>
	<?}?>
</div>