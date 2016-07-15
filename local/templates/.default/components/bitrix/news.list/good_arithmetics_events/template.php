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
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
$this->addExternalCss("/bitrix/css/main/font-awesome.css");
$this->addExternalCss($this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css');
?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?= $arResult["NAV_STRING"] ?><br />
<?endif;?>

<div class="newsBodyWrap" id="events_wrap">
    <div class="centerWrapper">
        <p class="titleMain"><?= GetMessage("REPORTS") ?></p>
        <div class="bx-newslist events_wrap_top">
            <div class="row">
                <?foreach($arResult["ITEMS"] as $arItem):?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="bx-newslist-container" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                            <?if($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])):?>
                                <div class="bx-newslist-img">
                                    <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):
                                    $image_src = CFile::ResizeImageGet ($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>330, 'height'=>180), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
                                        <img
                                                class="preview_picture"
                                                border="0"
                                                src="<?= $image_src["src"] ?>"
                                                width="330"
                                                height="180"
                                                alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                                title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                                                style="float:left"
                                                />
                                    <?else:?>
                                        <img
                                            class="preview_picture"
                                            border="0"
                                            src="<?= $image_src["src"] ?>"
                                            width="330"
                                            height="220"
                                            alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                            title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                                            style="float:left"
                                            />
                                    <?endif;?>
                                </div>
                            <?endif?>
                            <div class="bx-newslist-block">

                                <?if($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]) {?>
                                    <h3 class="bx-newslist-title">
                                        <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])) {?>
                                            <span ><?= $arItem["NAME"] ?></span>
                                        <?} else {?>
                                            <?= $arItem["NAME"] ?>
                                        <?}?>
                                    </h3>
                                <?}?>
                                <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]) {?>
                                    <div class="bx-newslist-content">
                                        <?= $arItem["PREVIEW_TEXT"]; ?>
                                    </div>
                                <?}?>

                                <?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty) {?>
                                    <?
                                    if(is_array($arProperty["DISPLAY_VALUE"])) {
                                        $value = implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
                                    } else {
                                        $value = $arProperty["DISPLAY_VALUE"];
                                    }
                                    ?>
                                    <?if($arProperty["CODE"] == "FORUM_MESSAGE_CNT") {?>
                                        <div class="bx-newslist-comments"><i class="fa fa-comments"></i> <?= $arProperty["NAME"] ?>:
                                            <?= $value; ?>
                                        </div>
                                    <?} else if ($value != "") {?>
                                        <div class="bx-newslist-other"><?/*?><i class="fa"></i><?*/?> <?= $arProperty["NAME"] ?>:
                                            <?=$value;?>
                                        </div>
                                    <?}?>
                                <?}?>
                                <div class="row" id="date_wrap">
                                    <?if($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]) {?>
                                        <div class="col-xs-5">
                                            <? 
                                            if ($arItem["DATE_ACTIVE_FROM"] == $arItem["DATE_ACTIVE_TO"]) {
                                                ?>
                                                <div class="bx-newslist-date"><i class="fa fa-calendar-o"></i> <?= FormatDate("j F", MakeTimeStamp($arItem["DATE_ACTIVE_FROM"])); ?></div>
                                            <?
                                            } else {
                                            ?>
                                                <div class="bx-newslist-date"><i class="fa fa-calendar-o"></i> <?= FormatDate("j F", MakeTimeStamp($arItem["DATE_ACTIVE_FROM"])).' - '.FormatDate("j F", MakeTimeStamp($arItem["DATE_ACTIVE_TO"])); ?></div>
                                            <?
                                            }
                                            ?>
                                        </div>

                                    <?}?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?endforeach;?>
            </div>
        </div>
    </div>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
