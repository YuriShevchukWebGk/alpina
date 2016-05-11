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

<?if ($arResult['ELEMENTS']) {
    foreach ($arResult["ITEMS"] as $ar_item) {?>
        <div id="notice_warn">
            <div class="notice_message">
                <?= $ar_item["NAME"] ?>
            </div>
            <div id="close_notice">
                X
            </div>
        </div>
    <?}?>            
<?}?>