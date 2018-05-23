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
if (!empty($arResult["ITEMS"])) {?>
    <div class="announces_block" style="margin-top: 15px">
        <?if($arParams["DISPLAY_TOP_PAGER"]):?>
	        <?=$arResult["NAV_STRING"]?><br />
        <?endif;?>
        <?foreach($arResult["ITEMS"] as $arItem):?>
	        <?
	        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	        ?>
	        <p class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <?if (!empty($arItem["PROPERTIES"]["EVENT_TYPE"])) {?>
                    <div class="event_type">
                        <?= $arItem["PROPERTIES"]["EVENT_TYPE"]["VALUE"] ?>
                    </div>
                <?}?>
		        <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			        <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				        <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
			        <?else:?>
				        <div class="lection_name"><?echo $arItem["NAME"]?></div>
			        <?endif;?>
		        <?endif;?>
                <?if (!empty($arItem["PROPERTIES"]["LECTION_DATE"])) {
                    ?>
                    <div class="lection_date">
                        <?= GetMessage("DATE") . strtolower(FormatDate("j F", MakeTimeStamp($arItem['PROPERTIES']['LECTION_DATE']['VALUE'], "DD.MM.YYYY HH:MI:SS"))); ?>
                    </div>
                <?}?>
		        <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			        <?echo $arItem["PREVIEW_TEXT"];?>
		        <?endif;?>
                <a href="<?= $arItem["PROPERTIES"]["EVENT_LINK"]["VALUE"] ?>" target="_blank"><?= GetMessage("MORE_INFO") ?></a>
	        </p>
        <?endforeach;?>
        <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	        <br /><?=$arResult["NAV_STRING"]?>
        <?endif;?>
    </div>
<?}?>
<script>
$(document).ready(function(){
    if ($(".lection_name").height() > 40) {
        $(".lection_name").css("padding-bottom", "10px");
    }
})
</script>
