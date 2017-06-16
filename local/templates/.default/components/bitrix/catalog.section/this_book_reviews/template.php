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
<?if (!empty($arResult["ITEMS"])) {?>
	<?/*<style>
		.reviewsBlockDetail .reviewDatail {clear:none;}
	</style>*/?>
    <div class="reviewsBlockDetail">
        <ul>
            <?foreach($arResult["ITEMS"] as $arItem) {   
                $expert_ID = $arItem["PROPERTIES"]["expert"]["VALUE"];?>

                <li>
                    <div class="reviewDatail">
						<?if (!empty($arResult["EXPERTS"][$expert_ID]["PREVIEW_PICTURE"])) {?>
							<div class="reviewImgContain">
								<img src="<?=$arResult["EXPERTS"][$expert_ID]["PREVIEW_PICTURE"]?>" alt="">
							</div>
						<?}?>
                        <p class="reviewsText"><?=$arItem["PREVIEW_TEXT"]?></p>
                        <p class="autor">
							<br />
                            <em><?=$arResult["EXPERTS"][$expert_ID]["NAME"]?>
                            <br>
                            <?=$arResult["EXPERTS"][$expert_ID]["PROPERTY_JOB_TITLE_VALUE"]?></em>
                        </p>
                    </div>
                </li>
            <?}?>
                    
        </ul>
    </div>
    <script>
        $(document).ready(function() {
            <!-- dataLayer GTM -->
            dataLayer.push({
                'expReview' : 'withExpReview'
            });
            <!-- /dataLayer GTM -->
        });
    </script>
<?} else {?>
    <script>
        $(document).ready(function() {
            <!-- dataLayer GTM -->
            dataLayer.push({
                'expReview' : 'withoutExpReview'
            });
            <!-- /dataLayer GTM -->
        });
    </script>
	<style>
		.abShow {display:none!important;}
	</style>
<?}?>
