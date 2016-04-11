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
<p>Мероприятия автора</p>
<?
foreach ($arResult["ITEMS"] as $arItem)
{
?>
    <div class="event">
        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
            <p class="date"><?=$arItem["ACTIVE_FROM"]?></p>
            <p><?=$arItem["NAME"]?></p>
        </a>
    </div>
<?
}
?>
<a href="/events/"><p class="allEvents">Все мероприятия</p></a>
