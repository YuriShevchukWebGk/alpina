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
<?$frame = $this->createFrame()->begin();
if (file_get_contents('https://api.retailrocket.ru/api/2.0/recommendation/personal/50b90f71b994b319dc5fd855/?partnerUserSessionId='.$_COOKIE["rcuid"]) != '[]') {?>

	<style>
		.recomendation {display:block!important};
	</style>
	<script>
	$(document).ready(function(){
		$(".recomendation").show();
	});
	</script>
<?} else {?>
	<style>
		.hintWrapp {height:100%!important};
		.recomendation {display:none};
	</style>
	<script>
	$(document).ready(function(){
		$(".recomendation").hide();
	});
	</script>
<?}?>
<div class="saleSlider recsOnMain">
    <ul>

        <?foreach ($arResult["ITEMS"] as $arItem) {
            foreach ($arItem["PRICES"] as $code => $arPrice) {
                if ($arPrice["PRINT_DISCOUNT_VALUE"]) {
                    $pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>200, 'height'=>300), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                ?>
                <li>
                    <div class="bookWrapp">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="Книга «<?=$arItem["NAME"]?>»">
                            <div class="section_item_img">
                                <?if($pict["src"] != ''){?>
                                    <img src="<?=$pict["src"]?>" alt="Обложка книги «<?=$arItem["NAME"]?>»">    
                                    <?} else {?>
                                    <img src="/images/no_photo.png">      
                                    <?}?>
                            </div>
                        </a>
                    </div>    
                </li>    
                <?}
            }
        }?>
    </ul>
    <img src="/img/arrowLeft.png" class="left">
    <img src="/img/arrowRight.png" class="right">
</div>
<?$frame->end();?>