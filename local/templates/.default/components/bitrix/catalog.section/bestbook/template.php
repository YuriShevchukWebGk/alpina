<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$arResult = $arResult["ITEMS"][0];
$main_pict = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], array('width'=>260, 'height'=>540), BX_RESIZE_IMAGE_PROPORTIONAL, true);
$main_author = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 29, "ID" => $arResult["PROPERTIES"]["AUTHORS"]["VALUE"][0]), false, false, array("ID", "NAME", "DETAIL_PICTURE", "PROPERTY_AUTHOR_DESCRIPTION")) -> Fetch();
$author_pict = CFile::ResizeImageGet($main_author["DETAIL_PICTURE"], array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_EXACT, true);
$colors = explode(',',$arResult["PROPERTIES"]["colors"]["VALUE"]);
?>

<style>
    .bestbook{background:<?=$colors[1]?>}
    .bestbook .badge{background-color: <?=$colors[1]?>}
    .bestbook .name, .bestbook .name a,.bestbook .description,.bestbook .author{color:<?=$colors[0]?>}
</style>
<script>
    $(document).ready(function() {
        var setheight = $(".bestbook .name").height();
        $(".bestbook .before").css("height",setheight+30+'px');
        $(".bestbook .after").css("margin-top",setheight+10+'px');
    });
</script>

<div class="bestbook">
    <div class="before"></div>
    <div class="after"></div>

    <div class="wrap">
        <div class="cover">
            <a href="<?=$arResult["DETAIL_PAGE_URL"]?>">
                <img src="<?=$main_pict["src"]?>" title="<?=$main_author["NAME"].' «'.$arResult["NAME"].'»'?>">
            </a>
        </div>

        <div class="badge">
            <a href="<?=$arResult["DETAIL_PAGE_URL"]?>">Книга недели</a>
        </div>

        <div class="name">
            <a href="<?=$arResult["DETAIL_PAGE_URL"]?>"><?=typo($arResult["NAME"])?></a>
            <br />
            <span><?=$main_author["NAME"]?></span>
        </div>

        <div class="description">
        <?if($arResult["ID"] == BOOK_COLOR_BLACK){?>
             <p style="color: #000;"><?=typo(strip_tags($arResult["PREVIEW_TEXT"]))?></p>
        <?} else {?>
            <?=typo(strip_tags($arResult["PREVIEW_TEXT"]))?>
        <?}?>     
            <?if (!empty($main_author["PROPERTY_AUTHOR_DESCRIPTION_VALUE"]["TEXT"])) {?>
                <div class="author">
                    <?if ($author_pict["src"]) {?><img src="<?=$author_pict["src"]?>" style="margin-right:30px;border-radius:100px;width:100px;height:100px" align="left" /><?}?>
                     <?if($arResult["ID"] == BOOK_COLOR_BLACK){?>
                        <p style="color: #000;"><?=typo(substr(strip_tags($main_author["PROPERTY_AUTHOR_DESCRIPTION_VALUE"]["TEXT"]),0,150).'...')?></p>
                     <?} else {?>
                        <?=typo(substr(strip_tags($main_author["PROPERTY_AUTHOR_DESCRIPTION_VALUE"]["TEXT"]),0,150).'...')?>
                     <?}?>
                </div>
            <?}?>
            <a href="<?=$arResult["DETAIL_PAGE_URL"]?>" class="button">
                Описание, отзывы
            </a>
        </div>

    </div>
</div>