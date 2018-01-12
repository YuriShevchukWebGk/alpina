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
$this->setFrameMode(true);?>

<div class="find">
	<form action="<?echo $arResult["FORM_ACTION"]?>">
		<input class="mainSearchField" type="text" name="q" placeholder="Поиск интересных материалов" value="" autocomplete="off" required/>&nbsp;<button name="s" type="submit" value="blog"></button>
	</form>
</div>

