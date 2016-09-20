<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
    <script type="text/javascript">
        function showHideCal() {
            var el = $('calendar-popup');
            el.hasClass('hide') ? el.removeClass('hide') : el.addClass('hide')
        }
    </script>
    
<div class="news-list review-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<!--<ul class="reviews-top-nav">
    <li><a href="">Статьи</a></li>
    <li><a href="">Обзоры</a></li>
    <li><a href=""><?if ($arResult['SECTION']['PATH'][0]['CODE'] == 'reviews'):?><strong>Рецензии</strong><?else:?>Рецензии<?endif;?></a></li>
</ul>-->
<?

?>
<div align="left" style="font:19px Arial, Helvetica, sans-serif; border-bottom:2px solid #cecece; color:#4c4c4c; padding:0px 10px 6px 26px; margin:0px 10px 0px 10px">
    <div id="review-month-list" class="a-right">
        
        <select name="month" onchange="window.location='?date=' + this.value;">
            <option value="all">Все <?=strtolower($arResult['SECTION']['PATH'][0]['NAME'])?></option>
        <?
            $dbElement = CIBlockElement::GetList(array('PROPERTY_DATE_SORT' => 'DESC'), array('IBLOCK_ID' => 7, 'SECTION_ID' => $arResult['SECTION']['PATH'][0]['ID']), array('PROPERTY_DATE_SORT'), false, array('PROPERTY_DATE_SORT'));
            $arDateList = array();
            while ($arrElement = $dbElement->Fetch()) {
                $arDateList[] = $arrElement['PROPERTY_DATE_SORT_VALUE'];
            }
            $currYear = date('Y');
            $selectedDate = (isset($_GET['date']) ? $_GET['date'] : $arResult["ITEMS"][0]['PROPERTIES']['DATE_SORT']['VALUE']);
            sort($arDateList);
            foreach ($arDateList as $opt_value) {
                if (!in_array($opt_value, $arDateList)) continue;
                echo "<option value=\"$opt_value\" " . ($selectedDate == $opt_value ? 'selected="selected"' : '') . ">" . GetMessage('MONTH_' . intval(substr($opt_value, 4))) . ', ' . substr($opt_value, 0, 4) . '</option>';
            }
        ?>                   
        </select>
    </div>
    <?=$arResult['SECTION']['PATH'][0]['NAME']?>
</div>
<?if (count($arResult["ITEMS"]) == 0) return;?>
<?if ($_GET['date'] != 'all'): ?>
<h2 class="left event-caption"><?=CIBlockFormatProperties::DateFormat('F Y', MakeTimeStamp($arResult["ITEMS"][0]["ACTIVE_FROM"]));?></h2>
<?endif;?>
<table width="92%" cellspacing="0" cellpadding="0">
    
    <?foreach($arResult["ITEMS"] as $rowIndex => $arItem):?>
     <?
     if (isset($arItem['PROPERTIES']['BOOK']['VALUE']) && intval($arItem['PROPERTIES']['BOOK']['VALUE'])) {
            $dbBook = CIBlockElement::GetList(
                array(), 
                array('ID' => $arItem['PROPERTIES']['BOOK']['VALUE']), 
                false,                          
                false, 
                array('ID', 'CODE', 'ACTIVE', 'NAME', 'PROPERTY_SHORT_NAME', 'PROPERTY_AUTHORS', 'DETAIL_PAGE_URL')
            );
            if ($dbBook->SelectedRowsCount() > 0) {
                $arBookAuthors = array();
                $dbBook->SetUrlTemplates();
                while($rsBook = $dbBook->GetNextElement()) {
                    $arBook = $rsBook->GetFields();
                    $arBookAuthors[] = $arBook['PROPERTY_AUTHORS_VALUE'];
                }
                
                
                $arItem['PROPERTIES']['BOOK'] =  array(
                    'NAME' => $arBook['NAME'],
                    'ACTIVE' => ($arBook['ACTIVE'] == 'Y'),
                    'SHORT_NAME' => $arBook['PROPERTY_SHORT_NAME_VALUE'],
                    'DETAIL_PAGE_URL' => $arBook['DETAIL_PAGE_URL'],
                    'AUTHORS' => array('PRINT' => getAuthorsPrint($arBookAuthors), 'VALUE' => $arBookAuthors)
                );       
                unset($arBookAuthors);
            }
            else {
                $arItem['PROPERTIES']['BOOK'] = false;
            }
     }
     else {
        $arItem['PROPERTIES']['BOOK'] = false;
     }
     ?>
    <!-- Новость -->
    <tr valign="top">
        <td class="txt2">
        <?if($arParams["DISPLAY_NAME"]!="N" && trim($arItem["NAME"])):?>
            <a href="<?=$arItem['DETAIL_PAGE_URL'];?>"><p><?echo $arItem["NAME"]?></p></a>
        <?elseif ($arItem['PROPERTIES']['BOOK']):?>
                <a href="<?=$arItem['DETAIL_PAGE_URL'];?>"><p><?=$arItem['PROPERTIES']['BOOK']["NAME"]?></p></a>
        <?endif;?>
        <?if (trim($arItem["NAME"]) && $arItem['PROPERTIES']['BOOK']):?>
            <div style="margin:4px 0 8px;">
                <a href="<?=$arItem['DETAIL_PAGE_URL'];?>"><strong><?=$arItem['PROPERTIES']['BOOK']["NAME"]?></strong></a>
            </div>
        <?endif;?>
        <?if ($arItem['PROPERTIES']['BOOK'] && $arItem['PROPERTIES']['BOOK']['AUTHORS']['PRINT']):?>
            <?$bShowTooltip = true;?>
            <p><?=$arItem['PROPERTIES']['BOOK']['AUTHORS']['PRINT']?></p>
        <?endif;?>
        <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
            <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="a-left"><img class="preview_picture" title="<?=$arItem["NAME"]?>" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="70" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["NAME"]?>" /></a>
            <?else:?>
                <img class="a-left preview_picture" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="70" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["NAME"]?>" />
            <?endif;?>
        <?endif?>
        <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N"):?>
            <?echo TruncateText(strip_tags(!empty($arItem["PREVIEW_TEXT"]) ? $arItem["PREVIEW_TEXT"] : $arItem["DETAIL_TEXT"]), 620) ;?>
        <?endif;?>
        <div class="clearer"><!-- --></div>
            <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] && ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                <div class="read-more"><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b>Подробнее </b><img src="<?=SITE_TEMPLATE_PATH?>/images/nov/blue_arr.gif" alt="" align="absmiddle" style="margin:3px 0px 0px 3px"></a></div>
            <?else:?>
        <?endif;?>
        <?if (is_array($arItem['DISPLAY_PROPERTIES']['SOURCE'])):?><div class="author">
            <strong>Источник:</strong>
            <?if(!empty($arItem['PROPERTIES']['SOURCE_LINK']['VALUE'])):
                $arItem['PROPERTIES']['SOURCE_LINK']['VALUE'] = (substr($arItem['PROPERTIES']['SOURCE_LINK']['VALUE'], 0, 4) == 'http' ? $arItem['PROPERTIES']['SOURCE_LINK']['VALUE'] : 'http://' . $arItem['PROPERTIES']['SOURCE_LINK']['VALUE']);
            ?>
                <a href="<?=$arItem['PROPERTIES']['SOURCE_LINK']['VALUE']?>" target="_blank"><?=strip_tags($arItem['DISPLAY_PROPERTIES']['SOURCE']['DISPLAY_VALUE']);?></a>
            <?else:?>
                <?=strip_tags($arItem['DISPLAY_PROPERTIES']['SOURCE']['DISPLAY_VALUE']);?>
            <?endif?>
        </div><?endif;?>
        <?/*if (is_array($arItem['DISPLAY_PROPERTIES']['SOURCE'])): $bShowTooltip = true;?><div class="author"><strong>Автор:</strong> <?=getAuthorsPrint($arItem['DISPLAY_PROPERTIES']['AUTHOR']['VALUE'], true);?></div><?endif;*/?>
        </td>
    <!-- /Новость -->
    </tr>
<?endforeach;?>
</table>
<?if ($bShowTooltip) :?>
<script type="text/javascript">
    window.addEvent("domready", function() {
        var tips = new Tips($$('.author_tooltip_detail, .book_element_tooltip'), {
            className: 'tool'
        });
    });
</script>
<?endif?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

