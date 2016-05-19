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
    <div class="reviewsBlockDetail">
        <ul>
            <?foreach($arResult["ITEMS"] as $arItem) {   
                $expert_ID = $arItem["PROPERTIES"]["expert"]["VALUE"];?>

                <li>
                    <div class="reviewDatail">
                        <div class="reviewImgContain">
                            <img src="<?=$arResult["EXPERTS"][$expert_ID]["PICTURE"]?>" alt="">
                        </div>
                        <p class="reviewsText"><?=$arItem["PREVIEW_TEXT"]?></p>
                        <p class="autor">
							<br />
                            <em><?=$arResult["EXPERTS"][$expert_ID]["NAME"]?>
                            <br>
                            <?=$arResult["EXPERTS"][$expert_ID]["POSITION"]?></em>
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
<?}?>
