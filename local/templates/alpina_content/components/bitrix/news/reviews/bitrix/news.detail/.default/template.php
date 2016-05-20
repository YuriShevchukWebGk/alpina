<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
<?endif;?>
<div class="searchWrap">
        <div class="catalogWrapper">
            <?$APPLICATION->IncludeComponent("bitrix:search.title", "search_form", 
        Array(
            "CATEGORY_0" => "",    // Ограничение области поиска
            "CATEGORY_0_TITLE" => "",    // Название категории
            "CHECK_DATES" => "N",    // Искать только в активных по дате документах
            "COMPONENT_TEMPLATE" => ".default",
            "CONTAINER_ID" => "title-search",    // ID контейнера, по ширине которого будут выводиться результаты
            "INPUT_ID" => "title-search-input",    // ID строки ввода поискового запроса
            "NUM_CATEGORIES" => "1",    // Количество категорий поиска
            "ORDER" => "date",    // Сортировка результатов
            "PAGE" => "#SITE_DIR#search/index.php",    // Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
            "SHOW_INPUT" => "Y",    // Показывать форму ввода поискового запроса
            "SHOW_OTHERS" => "N",    // Показывать категорию "прочее"
            "TOP_COUNT" => "5",    // Количество результатов в каждой категории
            "USE_LANGUAGE_GUESS" => "Y",    // Включить автоопределение раскладки клавиатуры
        ),
        false
        );?>    
        </div>
</div>

<div class="deliveryPageTitleWrap">
	<div class="centerWrapper">
		<h1>
			<?echo $arResult[NAME];?>
		</h1>
		<div class="left"><?=$arResult['PROPERTIES']['BOOK']['AUTHORS']['PRINT'];?></div>
	</div>
</div>


<div class="howToBodyWrap">
    <div class="centerWrapper" style="padding:40px 0;">
<table width="92%" cellspacing="0" cellpadding="0" class="articles-detail">
    <!-- Новость -->
    <tr valign="top">
        <td class="txt3" align="left">
            <?if (is_array($arResult["PREVIEW_PICTURE"])): ?>
            <img class="a-left detail_picture" border="0" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" width="70" alt="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["NAME"]?>" />
            <?endif;?>
            <div class="right props">
                <?
                    $arMonthLng = GetMessage('MONTHES');
                    $arActiveFrom = ParseDateTime($arResult['ACTIVE_FROM'], CSite::GetDateFormat());    //IS_MONTH
                    $arResult['DISPLAY_ACTIVE_FROM'] = ($arResult['PROPERTIES']['IS_MONTH']['VALUE_XML_ID'] != 'Y' ? 
                                                                $arActiveFrom['DD'] . ' ' . $arMonthLng[$arActiveFrom['MM']] : 
                                                                GetMessage('MONTH_' . intval($arActiveFrom['MM']))) . 
                                                       " {$arActiveFrom['YYYY']}";
                    $arResult['DISPLAY_ACTIVE_FROM'] = strtolower($arResult['DISPLAY_ACTIVE_FROM']);
                    
                    //print_ar($arActiveFrom);
                ?>                      
                <strong>Дата публикации:</strong> <?=$arResult['DISPLAY_ACTIVE_FROM'];?><br />
                <?if (is_array($arResult['DISPLAY_PROPERTIES']['AUTHOR'])):?>
                    <strong>Автор:</strong> <?=getAuthorsPrint($arResult['PROPERTIES']['AUTHOR']['VALUE'], false);?><br />
                <?endif;?>
                <?if (is_array($arResult['DISPLAY_PROPERTIES']['SOURCE'])):?>  
                    <?if(!empty($arResult['PROPERTIES']['SOURCE_LINK']['VALUE'])):
                        $arResult['PROPERTIES']['SOURCE_LINK']['VALUE'] = (substr($arResult['PROPERTIES']['SOURCE_LINK']['VALUE'], 0, 4) == 'http' ? $arResult['PROPERTIES']['SOURCE_LINK']['VALUE'] : 'http://' . $arResult['PROPERTIES']['SOURCE_LINK']['VALUE']);
                    ?>
                        <!-- noindex --><a href="<?=$arResult['PROPERTIES']['SOURCE_LINK']['VALUE']?>" target="_blank" rel="nofollow">Источник</a><!-- /noindex -->
                    <?else:?>
                        <?=strip_tags($arResult['DISPLAY_PROPERTIES']['SOURCE']['DISPLAY_VALUE']);?>
                    <?endif?>
                    <br />
                <?endif;?>
            </div>


			<div id="detailReview">
				<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
					<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
				<?endif;?>
				<?if($arResult["NAV_RESULT"]):?>
					<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
					<?echo $arResult["NAV_TEXT"];?>
					<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
				 <?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
					<?echo $arResult["DETAIL_TEXT"];?>
				 <?else:?>
					<?echo $arResult["PREVIEW_TEXT"];?>
				<?endif?>
			</div>
                <?if (is_array($arResult['PROPERTIES']['BOOK']) && $arResult['PROPERTIES']['BOOK']['ACTIVE']):?>
                <div class="right view-book">
                    <a href="<?=$arResult['PROPERTIES']['BOOK']['DETAIL_PAGE_URL']?>" title="<?=$arResult['PROPERTIES']['BOOK']['NAME']?>"><strong>Купить книгу «<?=$arResult['PROPERTIES']['BOOK']["SHORT_NAME"]?>»</strong></a><br />
                </div>
                <?endif;?>
            <br />
        </td>
    <!-- /Новость -->
    </tr>
</table>
    </div>
</div>

