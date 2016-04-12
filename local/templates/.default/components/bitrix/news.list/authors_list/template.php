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

<div class="authorsMenuWrap">
    <div class="catalogWrapper">
        <p class="title">Алфавитный указатель авторов</p>    
        <p class="alphabet">
            <?
                $i = 1;
                $sects_list = CIBlockSection::GetList (array(), array("IBLOCK_ID" => 29), false, array("ID", "NAME"), false);
                while ($sects = $sects_list -> Fetch())
                {
                    echo "<span data-id='".$i."'><a href='/authors/?list=".$sects["ID"]."'>".$sects["NAME"]."</a></span>";
                    $i++;
                }
            ?>
        </p>
    </div>
</div>

<div class="authorsWrap">
<div class="cataloggWrapper">
<?
    //arshow($arResult["ITEMS"][0]);
    if ($_REQUEST["list"])
    {
        $sects_list = CIBlockSection::GetList (array("NAME" => "ASC"), array("IBLOCK_ID" => 29, "ID" => $_REQUEST["list"]), false, array("ID", "NAME"), false);
        while ($sects = $sects_list -> Fetch())
        {
        ?>
        <div class="authorLetter" id="letterBlock1">
            <div>
                <p class="bigLetter"><?=$sects["NAME"]?></p>
                <p class="autCount"><span class="authors_number_1"></span> авторов</p>
            </div>
            <?
                $el_list = CIBlockElement::GetList (array("NAME" => "ASC"), array("IBLOCK_ID"=>29, "SECTION_ID" => $_REQUEST["list"]), false, false, array("ID", "NAME", "DETAIL_PICTURE"));
                while ($el_fetch = $el_list -> Fetch())
                {
                    $pict = CFile::ResizeImageGet($el_fetch["DETAIL_PICTURE"], array('width'=>165, 'height'=>165), BX_RESIZE_IMAGE_EXACT, true);
                ?>
                <div class="authorWrap">
                    <a href="/authors/<?=$el_fetch["ID"]?>/"><img src="<?=$pict["src"]?>"></a> 
                    <a href="/authors/<?=$el_fetch["ID"]?>/"><div class="authorBack"></div></a>     
                    <a href="/authors/<?=$el_fetch["ID"]?>/"><p><?=$el_fetch['NAME']?></p></a>    
                </div>
                <?            
                }
                echo "</div>";
            }        
        }
        else
        {
            $counter = 0;
            $sects_list = CIBlockSection::GetList (array(), array("IBLOCK_ID" => 29), false, array("ID", "NAME"), false);
            while ($sects = $sects_list -> Fetch())
            {
            ?>
            <div class="authorLetter" id="letterBlock<?=$counter+1?>">
                <div>
                    <p class="bigLetter"><?=$sects["NAME"]?></p>
                    <p class="autCount"><span class="authors_number_<?=$counter+1?>"></span> авторов</p>
                </div>
                <?
                    foreach ($arResult["ITEMS"] as $arItem)
                    { 
                        if ($arItem["IBLOCK_SECTION_ID"] == $sects["ID"])
                        {
                            //arshow(substr($arItem["PROPERTIES"]['LAST_NAME']["VALUE"], 0, 1));
                            //arshow(strnatcasecmp($arItem["PROPERTIES"]['LAST_NAME']["VALUE"]{0}, $RusAlphabet[0]));
                            $pict = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array('width'=>165, 'height'=>165), BX_RESIZE_IMAGE_EXACT, true);
                        ?>
                        <div class="authorWrap">
                            <? 
                            if ($pict["src"])
                            {
                            ?>
                                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$pict["src"]?>"></a>
                            <?
                            }
                            else
                            {
                            ?>
                                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="/images/no_photo.png" width="165"></a>
                            <?
                            }
                            ?>     
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><div class="authorBack"></div></a>  
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><p><?=$arItem['NAME']?></p></a>    
                        </div>
                        <?
                        }

                    }
                    echo "</div>";
                    $counter++;
                }
                echo "<p class='showMore'>Показать ещё</p>";
        }?>

    </div>
</div>
<script>
    $(document).ready(function(){

        for (var i = 1; i < 33; i++)
        {
            $(".authors_number_"+i).html($("#letterBlock"+i+" .authorWrap").size());
        }

        $(".showMore").click(function(){
            var blocks_count = 0;
            $(".authorLetter").each(function(){
                if ($(this).css("display") == "block")
                {
                    blocks_count++;
                }
            })
            $(".cataloggWrapper .authorLetter:nth-child("+(blocks_count+1)+"), .cataloggWrapper .authorLetter:nth-child("+(blocks_count+2)+")").css("display", "block");    
        })
        $(".authorLetter").each(function(){
            $(this).css("height", ((Math.ceil(($(this).find(".authorWrap").size()-5) / 6) + 1) * 250) + "px");
        })
    })
</script>
