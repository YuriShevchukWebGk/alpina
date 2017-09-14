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

			



<div class="howToBodyWrap">
    <div class="centerWrapper" style="padding:40px 0;">
		<h1>Обзор на книгу «<?=$arResult['PROPERTIES']['BOOK']['SHORT_NAME']?>»</h1>
		<h2><?=$arResult[NAME]?></h2>
		<div class="right props">
			<?echo !empty($arResult['ACTIVE_FROM']) ? '<center><b>Дата публикации:</b> '.substr($arResult['ACTIVE_FROM'],0,10).'</center><br />' : '';?>
			<?if (is_array($arResult['DISPLAY_PROPERTIES']['SOURCE'])) {?>  
				<?if(!empty($arResult['PROPERTIES']['SOURCE_LINK']['VALUE'])) {
					$arResult['PROPERTIES']['SOURCE_LINK']['VALUE'] = (substr($arResult['PROPERTIES']['SOURCE_LINK']['VALUE'], 0, 4) == 'http' ? $arResult['PROPERTIES']['SOURCE_LINK']['VALUE'] : 'http://' . $arResult['PROPERTIES']['SOURCE_LINK']['VALUE']);
				?>
					<!-- noindex --><a href="<?=$arResult['PROPERTIES']['SOURCE_LINK']['VALUE']?>" target="_blank" rel="nofollow">Источник</a><!-- /noindex -->
				<?} else {
					echo strip_tags($arResult['DISPLAY_PROPERTIES']['SOURCE']['DISPLAY_VALUE']);
				}?>
				<br />
			<?}?>
		</div>


		<div id="detailReview">
			<a href="<?=$arResult['PROPERTIES']['BOOK']['DETAIL_PAGE_URL']?>" title="Купить книгу «<?=$arResult['PROPERTIES']['BOOK']['NAME']?>»"><img src="<?=$arResult['PROPERTIES']['BOOK']['DETAIL_PICTURE']?>" align="left" /></a>
			<?if($arResult["DETAIL_TEXT"] > 0)
				echo $arResult["DETAIL_TEXT"];
			 else
				echo $arResult["PREVIEW_TEXT"];
			?>
			<?if (is_array($arResult['PROPERTIES']['BOOK']) && $arResult['PROPERTIES']['BOOK']['ACTIVE']) {?>
				<center>
					<div class="right view-book">
						<a href="<?=$arResult['PROPERTIES']['BOOK']['DETAIL_PAGE_URL']?>" title="Купить книгу «<?=$arResult['PROPERTIES']['BOOK']['NAME']?>»">Купить книгу «<?=$arResult['PROPERTIES']['BOOK']["SHORT_NAME"]?>»</a><br />
					</div>
				</center>
			<?}?>
		</div>
		<br />
    </div>
</div>
<script>
$(document).ready(function() {
	$('#detailReview a:not([href*="alpinabook.ru"])').attr('target','_blank').attr('rel','nofollow'); //Если ссылка в рецензии не содержит alpinabook, то открывает в новой вкладке и закрываем через nofollow
});
</script>
