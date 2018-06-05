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
<!--noindex-->
<div class="leftMenu">
    <ul class="firstLevel">
    <?foreach ($arResult["SECTIONS"] as $arSection)
    {?>
        <?if ($arSection["ID"] == "209") {
            $collections = $arSection;
            continue;
        }
        if ($arSection["DEPTH_LEVEL"]=="1") {?>
            <li><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><p><?=$arSection["NAME"]?></p></a>
        <?}?>
        <?if ($arSection["ID"] == "141") { //Если подарочные издания?>
            <ul class="secondLevel">
                <li><a href="/content/overview/"><p>Постеры для дома и офиса</p></a></li>
            </ul>
        <?}?>
        <?foreach ($arResult["SECTIONS"] as $arChildSection) {?>
            <?if ($arChildSection["IBLOCK_SECTION_ID"]==$arSection["ID"]) {?>
                <ul class="secondLevel">
                        <li><a href="<?=$arChildSection["SECTION_PAGE_URL"]?>"><p><?=$arChildSection["NAME"]?></p></a></li>
                </ul>
            <?}?>
       <?}?>
       </li>
    <?}?>


        <li><a href="<?=$collections["SECTION_PAGE_URL"]?>"><p>Тематические подборки</p></a>
        <?foreach ($arResult["SECTIONS"] as $arChildSection) {?>
            <?if ($arChildSection["IBLOCK_SECTION_ID"]==$collections["ID"]) {?>
                <ul class="secondLevel">
                    <li><a href="<?=$arChildSection["SECTION_PAGE_URL"]?>"><p><?=$arChildSection["NAME"]?></p></a></li>
                </ul>
            <?}?>
        <?}?>
        </li>

    </ul>
</div>
<!--/noindex-->
<?/*
$mark = 0;
                foreach($arResult["SECTIONS"] as $arSection)
                {
                    if ($arSection["DEPTH_LEVEL"] == 1)
                        $mark = $arSection["ID"];
                    if (strpos($APPLICATION->GetCurPage(), $arSection["SECTION_PAGE_URL"]) > -1)
                        if (!in_array($mark, $check))
                            $check[] = $mark;
                }
$menuHTML = '';
                $bSubOpen = false;
                $CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
                $strTitle = "";
                $liClass = 'main2';
                $rand = "";
                $index = 0;
                foreach($arResult["SECTIONS"] as $arSection):
                echo $CURRENT_DEPTH;
                    if($CURRENT_DEPTH<$arSection["DEPTH_LEVEL"])
                        $liClass = 'sub2';
                    elseif($CURRENT_DEPTH>$arSection["DEPTH_LEVEL"]) {
                        $liClass = 'main2';
                        $index = $arSection['ID'];
                    }
                    $CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];

                    $count = $arParams["COUNT_ELEMENTS"] && $arSection["ELEMENT_CNT"] ? "&nbsp;(".$arSection["ELEMENT_CNT"].")" : "";
                    $class = '';
                    $class_active = '';
                    if (in_array($arSection["ID"], $check) || in_array($arSection["ID"],$ar_new_groups)){
                        $class = ' class="show-bottom"';
                        $class_active = ' class="active"';
                    }
                    if ($_REQUEST['SECTION_ID']==$arSection['ID'])
                    {
                        $link = '<b>'.$arSection["NAME"].$count.'</b>';
                        $strTitle = $arSection["NAME"];
                    }
                    else {
                        if(strpos($arSection["NAME"],"Всемирный") !== false) {
                            $link = '<a'.$class_active.' href="'.$arSection["SECTION_PAGE_URL"].'"><li'.$class.'><b>'.$arSection["NAME"].$count.'</b>';
                            //$link = '<li><a'.$class.' href="'.$arSection["SECTION_PAGE_URL"].'" id="item_' . $index . $rand . '">'.$arSection["NAME"].$count.'</a>';
                        } else {
                            $link = '<a'.$class_active.' href="'.$arSection["SECTION_PAGE_URL"].'"><li'.$class.'>'.$arSection["NAME"].$count;
                            //$link = '<li><a'.$class.' href="'.$arSection["SECTION_PAGE_URL"].'" id="item_' . $index . $rand . '">'.$arSection["NAME"].$count.'</a>';
                        }
                    }
                    if ($liClass != 'main2'):

                        if (!$bSubOpen):
                            $menuHTML .= "<ul class=\"SecondLevel\">";
                            $bSubOpen = true;
                        else:
                        endif;
                    else:
                        if ($bSubOpen) {
                            $menuHTML .= "</ul></li></a>";
                            $bSubOpen = false;
                        } else {
                            $menuHTML .= '</li></a>';
                        }
                    endif;
                    if ($liClass == 'main2'):
                     $menuHTML .= $link;
                    else:
                     $menuHTML .= $link.'</li></a>';
                    endif;
                endforeach?>
                <?=$menuHTML;*/?>
<script>
/*$(".firstLevel > li").mouseover(function()
{
        $(this).find(".secondLevel").show();
});
$(".firstLevel > li").mouseout(function()
{
        $(this).find(".secondLevel").hide();
});*/
$(".firstLevel li a").click(function(e){
    e.preventDefault();
    if ((!$(this).next("ul.secondLevel").find("li a").attr("href")) || ($(this).next("ul.secondLevel").css("display") != "none"))
    {
        document.location.href = $(this).attr("href");
    }
});
</script>