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


//arshow($arResult["SECTIONS"], true);
foreach ($arResult["SECTIONS"] as $key => $sect)
{   
   // if ($sect["DEPTH_LEVEL"] == 2)
   
    if ($sect["IBLOCK_SECTION_ID"] == 209)
    {    
        $arElem = CIBlockElement::GetList(array(), array('IBLOCK_ID'=>4, 'SECTION_ID'=>$sect['ID']), false, false, array('ID', 'NAME', 'IBLOCK_SECTION_ID', 'PROPERTY_editors_choice', "CATALOG_GROUP_1"));
        while ($rsElem = $arElem -> Fetch())
        {   
            if ($rsElem["CATALOG_PRICE_1"] > 0)
            {
                $editor_choice_list[$sect['ID']][]=$rsElem['ID'];
            }
        }   
    }
}
//arshow($editor_choice_list);
foreach ($editor_choice_list as $key => $val)
{
    $curr_sect_name = CIBlockSection::GetByID($key)->Fetch();
   // arshow($curr_sect_name);
    $sect_names[] = $curr_sect_name["NAME"];
    $count[] = count($editor_choice_list[$key]);
   // $curr_sect = CIBlockSection::GetByID($key) -> Fetch();
    $sect_urls[] = "/catalog/".$curr_sect_name["CODE"]."/";
    $arImagesPath[] = CFile::GetPath($curr_sect_name["PICTURE"]);
}
//arshow($sect_urls);
//arshow($count);
?>
<div class="books">
                    <div class="firstSection">
                        <div class="titleBlock">
                            
                                <div class="titleText">
                                    <a href="/catalog/editors-choice/" title="Выбор редактора">
                                        <img src="/img/redPhoto.png">
                                        <p class="nameOfGroup">Editor's Choice</p>
                                        <p class="subNameOfGroup">Сергей турко</p>
                                        <p class="description">Главный редактор</p>
                                        <p class="description">"альпина паблишер"</p>
                                    </a>
                                </div>
                           
                        </div>
                        <div>
                            <?if ($count[2] > 0)
                            {?>
                            <a class="smallContainer" href="<?=$sect_urls[2]?>">
                                        <p><?=$sect_names[2]?></p>
                                        <p class="count"><?=$count[2].' '.format_by_count($count[2], 'книга', 'книги', 'книг');?></p>
                                        <div class="colorCorrect"></div> 
                                        <img src="<?if($arImagesPath[2]){echo $arImagesPath[2];}else{?>/img/book111.png<?}?>">
                            </a>
                            <?}?>
                            <?if ($count[3] > 0)
                            {?>
                            <a class="smallContainer" href="<?=$sect_urls[3]?>">
                                    <p><?=$sect_names[3]?></p>
                                    <p class="count"><?=$count[3].' '.format_by_count($count[3], 'книга', 'книги', 'книг');?></p>
                                    <div class="colorCorrect"></div>
                                    <img src="<?if($arImagesPath[3]){echo $arImagesPath[3];}else{?>/img/book121.png<?}?>">
                            </a>
                            <?}?>
                        </div>
                    </div>
                    <div class="secondSection">
                        <div>
                            <?if ($count[0] > 0)
                            {?>
                            <a class="smallContainer" href="<?=$sect_urls[0]?>">
                                    <p><?=$sect_names[0]?></p> 
                                    <p class="count"><?=$count[0].' '.format_by_count($count[0], 'книга', 'книги', 'книг');?></p>
                                    <div class="colorCorrect"></div>
                                    <img src="<?if($arImagesPath[0]){echo $arImagesPath[0];}else{?>/img/book131.png<?}?>">
                            </a>
                            <?}?>
                            <?if ($count[1] > 0)
                            {?>
                            <a class="smallContainer" href="<?=$sect_urls[1]?>">
                                    <p><?=$sect_names[1]?></p> 
                                    <p class="count"><?=$count[1].' '.format_by_count($count[1], 'книга', 'книги', 'книг');?></p>
                                    <div class="colorCorrect"></div>
                                    <img src="<?if($arImagesPath[1]){echo $arImagesPath[1];}else{?>/img/book141.png<?}?>">
                            </a>
                            <?}?>    
                        </div>
                        <div>
                            <?if ($count[4] > 0)
                            {?>
                            <a class="smallContainer" href="<?=$sect_urls[4]?>">
                                    <p><?=$sect_names[4]?></p>
                                    <p class="count"><?=$count[4].' '.format_by_count($count[4], 'книга', 'книги', 'книг');?></p>
                                    <div class="colorCorrect"></div>
                                    <img src="<?if($arImagesPath[4]){echo $arImagesPath[4];}else{?>/img/book151.png<?}?>">
                            </a>
                            <?}?>
                            <?if ($count[5] > 0)
                            {?>
                            <a class="smallContainer" href="<?=$sect_urls[5]?>">
                                    <p><?=$sect_names[5]?></p> 
                                    <p class="count"><?=$count[5].' '.format_by_count($count[5], 'книга', 'книги', 'книг');?></p>
                                    <div class="colorCorrect"></div>
                                    <img src="<?if($arImagesPath[5]){echo $arImagesPath[5];}else{?>/img/book161.png<?}?>">
                            </a>
                            <?}?>    
                        </div>
                    </div>
                </div>
<script>
$(document).ready(function(){
    if ($(".books .smallContainer").size() < 3)
    {
        $(".books").css("height", "400px");
        $(".books .secondSection").css("height", "400px");
        $(".hintWrapp").css("height", "1100px");        
    }    
});
</script>