<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
?>
<div class="search-page">
	<?if($arParams["SHOW_TAGS_CLOUD"] == "Y")
	{
		$arCloudParams = Array(
			"SEARCH" => $arResult["REQUEST"]["~QUERY"],
			"TAGS" => $arResult["REQUEST"]["~TAGS"],
			"CHECK_DATES" => $arParams["CHECK_DATES"],
			"arrFILTER" => $arParams["arrFILTER"],
			"SORT" => $arParams["TAGS_SORT"],
			"PAGE_ELEMENTS" => $arParams["TAGS_PAGE_ELEMENTS"],
			"PERIOD" => $arParams["TAGS_PERIOD"],
			"URL_SEARCH" => $arParams["TAGS_URL_SEARCH"],
			"TAGS_INHERIT" => $arParams["TAGS_INHERIT"],
			"FONT_MAX" => $arParams["FONT_MAX"],
			"FONT_MIN" => $arParams["FONT_MIN"],
			"COLOR_NEW" => $arParams["COLOR_NEW"],
			"COLOR_OLD" => $arParams["COLOR_OLD"],
			"PERIOD_NEW_TAGS" => $arParams["PERIOD_NEW_TAGS"],
			"SHOW_CHAIN" => "N",
			"COLOR_TYPE" => $arParams["COLOR_TYPE"],
			"WIDTH" => $arParams["WIDTH"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"RESTART" => $arParams["RESTART"],
		);

		if(is_array($arCloudParams["arrFILTER"]))
		{
			foreach($arCloudParams["arrFILTER"] as $strFILTER)
			{
				if($strFILTER=="main")
				{
					$arCloudParams["arrFILTER_main"] = $arParams["arrFILTER_main"];
				}
				elseif($strFILTER=="forum" && IsModuleInstalled("forum"))
				{
					$arCloudParams["arrFILTER_forum"] = $arParams["arrFILTER_forum"];
				}
				elseif(strpos($strFILTER,"iblock_")===0)
				{
					foreach($arParams["arrFILTER_".$strFILTER] as $strIBlock)
						$arCloudParams["arrFILTER_".$strFILTER] = $arParams["arrFILTER_".$strFILTER];
				}
				elseif($strFILTER=="blog")
				{
					$arCloudParams["arrFILTER_blog"] = $arParams["arrFILTER_blog"];
				}
				elseif($strFILTER=="socialnetwork")
				{
					$arCloudParams["arrFILTER_socialnetwork"] = $arParams["arrFILTER_socialnetwork"];
				}
			}
		}
		$APPLICATION->IncludeComponent("bitrix:search.tags.cloud", ".default", $arCloudParams, $component, array("HIDE_ICONS" => "Y"));
	}
	/*?>
	<form action="" method="get">
		<input type="hidden" name="tags" value="<?echo $arResult["REQUEST"]["TAGS"]?>" />
		<input type="hidden" name="how" value="<?echo $arResult["REQUEST"]["HOW"]=="d"? "d": "r"?>" />
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tbody><tr>
				<td style="width: 100%;">
					<?if($arParams["USE_SUGGEST"] === "Y"):
						if(strlen($arResult["REQUEST"]["~QUERY"]) && is_object($arResult["NAV_RESULT"]))
						{
							$arResult["FILTER_MD5"] = $arResult["NAV_RESULT"]->GetFilterMD5();
							$obSearchSuggest = new CSearchSuggest($arResult["FILTER_MD5"], $arResult["REQUEST"]["~QUERY"]);
							$obSearchSuggest->SetResultCount($arResult["NAV_RESULT"]->NavRecordCount);
						}
						?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:search.suggest.input",
							"",
							array(
								"NAME" => "q",
								"VALUE" => $arResult["REQUEST"]["~QUERY"],
								"INPUT_SIZE" => -1,
								"DROPDOWN_SIZE" => 10,
								"FILTER_MD5" => $arResult["FILTER_MD5"],
							),
							$component, array("HIDE_ICONS" => "Y")
						);?>
					<?else:?>
						<input class="search-query" type="text" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" />
					<?endif;?>
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					<input class="search-button" type="submit" value="<?echo GetMessage("CT_BSP_GO")?>" />
				</td>
			</tr>
		</tbody></table>

		<noindex>
		<div class="search-advanced">
			<div class="search-advanced-result">
				<?if(is_object($arResult["NAV_RESULT"])):?>
					<div class="search-result"><?echo GetMessage("CT_BSP_FOUND")?>: <?echo $arResult["NAV_RESULT"]->SelectedRowsCount()?></div>
				<?endif;?>
				<?
				$arWhere = array();

				if(!empty($arResult["TAGS_CHAIN"]))
				{
					$tags_chain = '';
					foreach($arResult["TAGS_CHAIN"] as $arTag)
					{
						$tags_chain .= ' '.$arTag["TAG_NAME"].' [<a href="'.$arTag["TAG_WITHOUT"].'" class="search-tags-link" rel="nofollow">x</a>]';
					}

					$arWhere[] = GetMessage("CT_BSP_TAGS").' &mdash; '.$tags_chain;
				}

				if($arParams["SHOW_WHERE"])
				{
					$where = GetMessage("CT_BSP_EVERYWHERE");
					foreach($arResult["DROPDOWN"] as $key=>$value)
						if($arResult["REQUEST"]["WHERE"]==$key)
							$where = $value;

					$arWhere[] = GetMessage("CT_BSP_WHERE").' &mdash; '.$where;
				}

				if($arParams["SHOW_WHEN"])
				{
					if($arResult["REQUEST"]["FROM"] && $arResult["REQUEST"]["TO"])
						$when = GetMessage("CT_BSP_DATES_FROM_TO", array("#FROM#" => $arResult["REQUEST"]["FROM"], "#TO#" => $arResult["REQUEST"]["TO"]));
					elseif($arResult["REQUEST"]["FROM"])
						$when = GetMessage("CT_BSP_DATES_FROM", array("#FROM#" => $arResult["REQUEST"]["FROM"]));
					elseif($arResult["REQUEST"]["TO"])
						$when = GetMessage("CT_BSP_DATES_TO", array("#TO#" => $arResult["REQUEST"]["TO"]));
					else
						$when = GetMessage("CT_BSP_DATES_ALL");

					$arWhere[] = GetMessage("CT_BSP_WHEN").' &mdash; '.$when;
				}

				if(count($arWhere))
					echo GetMessage("CT_BSP_WHERE_LABEL"),': ',implode(", ", $arWhere);
				?>
			</div><?//div class="search-advanced-result"?>
			<?if($arParams["SHOW_WHERE"] || $arParams["SHOW_WHEN"]):?>
				<script>
				function switch_search_params()
				{
					var sp = document.getElementById('search_params');
					if(sp.style.display == 'none')
					{
						disable_search_input(sp, false);
						sp.style.display = 'block'
					}
					else
					{
						disable_search_input(sp, true);
						sp.style.display = 'none';
					}
					return false;
				}

				function disable_search_input(obj, flag)
				{
					var n = obj.childNodes.length;
					for(var j=0; j<n; j++)
					{
						var child = obj.childNodes[j];
						if(child.type)
						{
							switch(child.type.toLowerCase())
							{
								case 'select-one':
								case 'file':
								case 'text':
								case 'textarea':
								case 'hidden':
								case 'radio':
								case 'checkbox':
								case 'select-multiple':
									child.disabled = flag;
									break;
								default:
									break;
							}
						}
						disable_search_input(child, flag);
					}
				}
				</script>
				<div class="search-advanced-filter"><a href="#" onclick="return switch_search_params()"><?echo GetMessage('CT_BSP_ADVANCED_SEARCH')?></a></div>
		</div><?//div class="search-advanced"?>
				<div id="search_params" class="search-filter" style="display:<?echo $arResult["REQUEST"]["FROM"] || $arResult["REQUEST"]["TO"] || $arResult["REQUEST"]["WHERE"]? 'block': 'none'?>">
					<h2><?echo GetMessage('CT_BSP_ADVANCED_SEARCH')?></h2>
					<table class="search-filter" cellspacing="0"><tbody>
						<?if($arParams["SHOW_WHERE"]):?>
						<tr>
							<td class="search-filter-name"><?echo GetMessage("CT_BSP_WHERE")?></td>
							<td class="search-filter-field">
								<select class="select-field" name="where">
									<option value=""><?=GetMessage("CT_BSP_ALL")?></option>
									<?foreach($arResult["DROPDOWN"] as $key=>$value):?>
										<option value="<?=$key?>"<?if($arResult["REQUEST"]["WHERE"]==$key) echo " selected"?>><?=$value?></option>
									<?endforeach?>
								</select>
							</td>
						</tr>
						<?endif;?>
						<?if($arParams["SHOW_WHEN"]):?>
						<tr>
							<td class="search-filter-name"><?echo GetMessage("CT_BSP_WHEN")?></td>
							<td class="search-filter-field">
								<?$APPLICATION->IncludeComponent(
									'bitrix:main.calendar',
									'',
									array(
										'SHOW_INPUT' => 'Y',
										'INPUT_NAME' => 'from',
										'INPUT_VALUE' => $arResult["REQUEST"]["~FROM"],
										'INPUT_NAME_FINISH' => 'to',
										'INPUT_VALUE_FINISH' =>$arResult["REQUEST"]["~TO"],
										'INPUT_ADDITIONAL_ATTR' => 'class="input-field" size="10"',
									),
									null,
									array('HIDE_ICONS' => 'Y')
								);?>
							</td>
						</tr>
						<?endif;?>
						<tr>
							<td class="search-filter-name">&nbsp;</td>
							<td class="search-filter-field"><input class="search-button" value="<?echo GetMessage("CT_BSP_GO")?>" type="submit"></td>
						</tr>
					</tbody></table>
				</div>
			<?else:?>
		</div><?//div class="search-advanced"?>
			<?endif;//if($arParams["SHOW_WHERE"] || $arParams["SHOW_WHEN"])?>
		</noindex>
	</form>

<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):
	?>
	<div class="search-language-guess">
		<?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
	</div><br /><?
endif;?>

	<div class="search-result">
	<?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
	<?elseif($arResult["ERROR_CODE"]!=0):?>
		<p><?=GetMessage("CT_BSP_ERROR")?></p>
		<?ShowError($arResult["ERROR_TEXT"]);?>
		<p><?=GetMessage("CT_BSP_CORRECT_AND_CONTINUE")?></p>
		<br /><br />
		<p><?=GetMessage("CT_BSP_SINTAX")?><br /><b><?=GetMessage("CT_BSP_LOGIC")?></b></p>
		<table border="0" cellpadding="5">
			<tr>
				<td align="center" valign="top"><?=GetMessage("CT_BSP_OPERATOR")?></td><td valign="top"><?=GetMessage("CT_BSP_SYNONIM")?></td>
				<td><?=GetMessage("CT_BSP_DESCRIPTION")?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?=GetMessage("CT_BSP_AND")?></td><td valign="top">and, &amp;, +</td>
				<td><?=GetMessage("CT_BSP_AND_ALT")?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?=GetMessage("CT_BSP_OR")?></td><td valign="top">or, |</td>
				<td><?=GetMessage("CT_BSP_OR_ALT")?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?=GetMessage("CT_BSP_NOT")?></td><td valign="top">not, ~</td>
				<td><?=GetMessage("CT_BSP_NOT_ALT")?></td>
			</tr>
			<tr>
				<td align="center" valign="top">( )</td>
				<td valign="top">&nbsp;</td>
				<td><?=GetMessage("CT_BSP_BRACKETS_ALT")?></td>
			</tr>
		</table>
	<?elseif(count($arResult["SEARCH"])>0):?>
		<?if($arParams["DISPLAY_TOP_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
		<?foreach($arResult["SEARCH"] as $arItem):?>
			<div class="search-item">
				<h4><a href="<?echo $arItem["URL"]?>"><?echo $arItem["TITLE_FORMATED"]?></a></h4>
				<div class="search-preview"><?echo $arItem["BODY_FORMATED"]?></div>
				<?if(
					($arParams["SHOW_ITEM_DATE_CHANGE"] != "N")
					|| ($arParams["SHOW_ITEM_PATH"] == "Y" && $arItem["CHAIN_PATH"])
					|| ($arParams["SHOW_ITEM_TAGS"] != "N" && !empty($arItem["TAGS"]))
				):?>
				<div class="search-item-meta">
					<?if (
						$arParams["SHOW_RATING"] == "Y"
						&& strlen($arItem["RATING_TYPE_ID"]) > 0
						&& $arItem["RATING_ENTITY_ID"] > 0
					):?>
					<div class="search-item-rate">
					<?
					$APPLICATION->IncludeComponent(
						"bitrix:rating.vote", $arParams["RATING_TYPE"],
						Array(
							"ENTITY_TYPE_ID" => $arItem["RATING_TYPE_ID"],
							"ENTITY_ID" => $arItem["RATING_ENTITY_ID"],
							"OWNER_ID" => $arItem["USER_ID"],
							"USER_VOTE" => $arItem["RATING_USER_VOTE_VALUE"],
							"USER_HAS_VOTED" => $arItem["RATING_USER_VOTE_VALUE"] == 0? 'N': 'Y',
							"TOTAL_VOTES" => $arItem["RATING_TOTAL_VOTES"],
							"TOTAL_POSITIVE_VOTES" => $arItem["RATING_TOTAL_POSITIVE_VOTES"],
							"TOTAL_NEGATIVE_VOTES" => $arItem["RATING_TOTAL_NEGATIVE_VOTES"],
							"TOTAL_VALUE" => $arItem["RATING_TOTAL_VALUE"],
							"PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER_PROFILE"],
						),
						$component,
						array("HIDE_ICONS" => "Y")
					);?>
					</div>
					<?endif;?>
					<?if($arParams["SHOW_ITEM_TAGS"] != "N" && !empty($arItem["TAGS"])):?>
						<div class="search-item-tags"><label><?echo GetMessage("CT_BSP_ITEM_TAGS")?>: </label><?
						foreach ($arItem["TAGS"] as $tags):
							?><a href="<?=$tags["URL"]?>"><?=$tags["TAG_NAME"]?></a> <?
						endforeach;
						?></div>
					<?endif;?>

					<?if($arParams["SHOW_ITEM_DATE_CHANGE"] != "N"):?>
						<div class="search-item-date"><label><?echo GetMessage("CT_BSP_DATE_CHANGE")?>: </label><span><?echo $arItem["DATE_CHANGE"]?></span></div>
					<?endif;?>
				</div>
				<?endif?>
			</div>
		<?endforeach;?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
		<?if($arParams["SHOW_ORDER_BY"] != "N"):?>
			<div class="search-sorting"><label><?echo GetMessage("CT_BSP_ORDER")?>:</label>&nbsp;
			<?if($arResult["REQUEST"]["HOW"]=="d"):?>
				<a href="<?=$arResult["URL"]?>&amp;how=r"><?=GetMessage("CT_BSP_ORDER_BY_RANK")?></a>&nbsp;<b><?=GetMessage("CT_BSP_ORDER_BY_DATE")?></b>
			<?else:?>
				<b><?=GetMessage("CT_BSP_ORDER_BY_RANK")?></b>&nbsp;<a href="<?=$arResult["URL"]?>&amp;how=d"><?=GetMessage("CT_BSP_ORDER_BY_DATE")?></a>
			<?endif;?>
			</div>
		<?endif;?>
	<?else:?>
		<?ShowNote(GetMessage("CT_BSP_NOTHING_TO_FOUND"));?>
	<?endif;?>

	</div>
<?*/
?>
<div class="searchWrap">
    <div class="catalogWrapper">
                <?$APPLICATION->IncludeComponent("bitrix:search.title", "search_form", Array(
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

<?if (count($arResult["SEARCH"])>0)
{?>


        <div class="pageTitleWrap">
            <div class="catalogWrapper">
                <p class="title">Результаты поиска
                <?if(is_object($arResult["NAV_RESULT"])):?>
                    <span><?echo $arResult["NAV_RESULT"]->SelectedRowsCount()." результатов"?></span>
                <?endif;?>
                </p>
            </div>
        </div>


        <div class="searchBooksWrap">
            <div class="searchWidthWrapper">
                <?foreach ($arResult["SEARCH"] as $arSearch)
                {
                    
                    $item = CIBlockElement::GetList (array(), array("ID"=>$arSearch["ITEM_ID"]), false, false, array("ID", "PROPERTY_AUTHORS", "DETAIL_PICTURE"))->Fetch();
                    $price = CPrice::GetBasePrice($arSearch["ITEM_ID"]);
                    $pict = CFile::ResizeImageGet($item["DETAIL_PICTURE"], array('width'=>165, 'height'=>233), BX_RESIZE_IMAGE_EXACT, true);

                //if ($price["PRICE"] > 0)
                //{?>
                <div class="searchBook">
                    <div>
                        <a href="<?=$arSearch["URL"]?>">
                        <img src="<?=$pict["src"]?>">
                        </a>
                    </div>
                    <div class="descrWrap">
                        <p class="bookNames"><?=$arSearch["TITLE"]?></p>
                        <p class="autorName"><?//=$item["PROPERTY_AUTHORS_VALUE"]?></p>
                        <?if ($price["PRICE"])
                        {?>
                        <p class="price"><?=$price["PRICE"]?> руб.</p>
                        <?}?>
                        <p class="description"><?=$arSearch["BODY"]?></p>
                        <a href="<?=$arSearch["URL_WO_PARAMS"].'?action=ADD2BASKET&id='.$arSearch['ITEM_ID']?>"
                        onclick="addtocart(<?=$arSearch["ITEM_ID"];?>, '<?=$arSearch["TITLE"];?>');return false;">
                        <p class="basket">В корзину</p>
                        </a>
                    </div>
                </div>
                <?//}
                }?>
            </div>
            <a href="#"><p class="showMore">Показать ещё</p></a>
        </div>


        <div class="interestingWrap">
            <div class="catalogWrapper">
                <p class="title">Те, кто искали "<?=$arResult["REQUEST"]["QUERY"]?>" купили</p>

                <div class="bookEasySlider">
                    <div>
                        <ul>
                            <li>
                                <div class="">
                                    <img src="/img/catalogBook.png" class="bookImg">
                                    <p class="bookName">Развитие памяти по методу котиков</p>
                                    <p class="bookPrice">333 руб.</p>
                                </div>
                            </li>
                            <li>
                                <div class="">
                                    <img src="/img/catalogBook.png" class="bookImg">
                                    <p class="bookName">Развитие памяти по методу котиков</p>
                                    <p class="bookPrice">333 руб.</p>
                                </div>
                            </li>
                            <li>
                                <div class="">
                                    <img src="/img/catalogBook.png" class="bookImg">
                                    <p class="bookName">Развитие памяти по методу котиков</p>
                                    <p class="bookPrice">333 руб.</p>
                                </div>
                            </li>
                            <li>
                                <div class="">
                                    <img src="/img/catalogBook.png" class="bookImg">
                                    <p class="bookName">Развитие памяти по методу котиков</p>
                                    <p class="bookPrice">333 руб.</p>
                                </div>
                            </li>
                            <li>
                                <div class="">
                                    <img src="/img/catalogBook.png" class="bookImg">
                                    <p class="bookName">Развитие памяти по методу котиков</p>
                                    <p class="bookPrice">333 руб.</p>
                                </div>
                            </li>
                            <li>
                                <div class="">
                                    <img src="/img/catalogBook.png" class="bookImg">
                                    <p class="bookName">Развитие памяти по методу котиков</p>
                                    <p class="bookPrice">333 руб.</p>
                                </div>
                            </li>
                            <li>
                                <div class="">
                                    <img src="/img/catalogBook.png" class="bookImg">
                                    <p class="bookName">Развитие памяти по методу котиков</p>
                                    <p class="bookPrice">333 руб.</p>
                                </div>
                            </li>
                            <li>
                                <div class="">
                                    <img src="/img/catalogBook.png" class="bookImg">
                                    <p class="bookName">Развитие памяти по методу котиков</p>
                                    <p class="bookPrice">333 руб.</p>
                                </div>
                            </li>
                            <li>
                                <div class="">
                                    <img src="/img/catalogBook.png" class="bookImg">
                                    <p class="bookName">Развитие памяти по методу котиков</p>
                                    <p class="bookPrice">333 руб.</p>
                                </div>
                            </li>
                            <li>
                                <div class="">
                                    <img src="/img/catalogBook.png" class="bookImg">
                                    <p class="bookName">Развитие памяти по методу котиков</p>
                                    <p class="bookPrice">333 руб.</p>
                                </div>
                            </li>

                        </ul>
                        <img src="/img/arrowLeft.png" class="left">
                        <img src="/img/arrowRight.png" class="rigth">
                    </div>
                </div>





            </div>
        </div>
<?}
else
{?>
<div class="noResultBodyWrap">
            <div class="centerWrapper noResWrapp">
                <p class="noResultTitle">По вашему запросу ничего не найдено</p>
                <p class="noResText">К сожалению, по запросу "<?=$arResult["REQUEST"]["QUERY"]?>" ничего не найдено, попробуйте изменить поисковый запрос или следуйте нашим рекомендациям.</p>
            </div>
</div>

<div class="categoryWrapperWhite">
        <div class="interestSlideWrap">
            <?/*?>
                <div class="interestSlider">
                    <p>Вам также будет интересно</p>
                    <div class="otherEasySlider">
                        <div>
                            <ul>
                                <li>
                                    <div class="">
                                        <img src="/img/catalogBook.png" class="bookImg">
                                        <p class="bookName">Развитие памяти по методу котиков</p>
                                        <p class="bookPrice">333 руб.</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="">
                                        <img src="/img/catalogBook.png" class="bookImg">
                                        <p class="bookName">Развитие памяти по методу котиков</p>
                                        <p class="bookPrice">333 руб.</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="">
                                        <img src="/img/catalogBook.png" class="bookImg">
                                        <p class="bookName">Развитие памяти по методу котиков</p>
                                        <p class="bookPrice">333 руб.</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="">
                                        <img src="/img/catalogBook.png" class="bookImg">
                                        <p class="bookName">Развитие памяти по методу котиков</p>
                                        <p class="bookPrice">333 руб.</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="">
                                        <img src="/img/catalogBook.png" class="bookImg">
                                        <p class="bookName">Развитие памяти по методу котиков</p>
                                        <p class="bookPrice">333 руб.</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="">
                                        <img src="/img/catalogBook.png" class="bookImg">
                                        <p class="bookName">Развитие памяти по методу котиков</p>
                                        <p class="bookPrice">333 руб.</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="">
                                        <img src="/img/catalogBook.png" class="bookImg">
                                        <p class="bookName">Развитие памяти по методу котиков</p>
                                        <p class="bookPrice">333 руб.</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="">
                                        <img src="/img/catalogBook.png" class="bookImg">
                                        <p class="bookName">Развитие памяти по методу котиков</p>
                                        <p class="bookPrice">333 руб.</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="">
                                        <img src="/img/catalogBook.png" class="bookImg">
                                        <p class="bookName">Развитие памяти по методу котиков</p>
                                        <p class="bookPrice">333 руб.</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="">
                                        <img src="/img/catalogBook.png" class="bookImg">
                                        <p class="bookName">Развитие памяти по методу котиков</p>
                                        <p class="bookPrice">333 руб.</p>
                                    </div>
                                </li>

                            </ul>
                            <img src="/img/arrowLeft.png" class="left">
                            <img src="/img/arrowRight.png" class="rigth">
                        </div>
                    </div>
                </div>
                <?*/
                $arrFilter = array('PROPERTY_recommended_book' => '243');
                if(!$USER->IsAdmin()){
                    $arrFilter["!PROPERTY_FOR_ADMIN_VALUE"] = "Y";
                }
                $APPLICATION->IncludeComponent("bitrix:catalog.section", "interesting_items", Array(
        "IBLOCK_TYPE_ID" => "catalog",
        "IBLOCK_ID" => "4",    // Инфоблок
        "BASKET_URL" => "/personal/cart/",    // URL, ведущий на страницу с корзиной покупателя
        "COMPONENT_TEMPLATE" => "template1",
        "IBLOCK_TYPE" => "catalog",    // Тип инфоблока
        "SECTION_ID" => "",    // ID раздела
        "SECTION_CODE" => "",    // Код раздела
        "SECTION_USER_FIELDS" => array(    // Свойства раздела
            0 => "",
            1 => "",
        ),
        "ELEMENT_SORT_FIELD" => "id",    // По какому полю сортируем элементы
        "ELEMENT_SORT_ORDER" => "desc",    // Порядок сортировки элементов
        "ELEMENT_SORT_FIELD2" => "id",    // Поле для второй сортировки элементов
        "ELEMENT_SORT_ORDER2" => "desc",    // Порядок второй сортировки элементов
        "FILTER_NAME" => "arrFilter",    // Имя массива со значениями фильтра для фильтрации элементов
        "INCLUDE_SUBSECTIONS" => "Y",    // Показывать элементы подразделов раздела
        "SHOW_ALL_WO_SECTION" => "Y",    // Показывать все элементы, если не указан раздел
        "HIDE_NOT_AVAILABLE" => "N",    // Не отображать товары, которых нет на складах
        "PAGE_ELEMENT_COUNT" => "12",    // Количество элементов на странице
        "LINE_ELEMENT_COUNT" => "3",    // Количество элементов выводимых в одной строке таблицы
        "PROPERTY_CODE" => array(    // Свойства
            0 => "",
            1 => "",
        ),
        "OFFERS_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "OFFERS_PROPERTY_CODE" => array(
            0 => "COLOR_REF",
            1 => "SIZES_SHOES",
            2 => "SIZES_CLOTHES",
            3 => "",
        ),
        "OFFERS_SORT_FIELD" => "sort",
        "OFFERS_SORT_ORDER" => "desc",
        "OFFERS_SORT_FIELD2" => "id",
        "OFFERS_SORT_ORDER2" => "desc",
        "OFFERS_LIMIT" => "5",    // Максимальное количество предложений для показа (0 - все)
        "TEMPLATE_THEME" => "site",    // Цветовая тема
        "PRODUCT_DISPLAY_MODE" => "Y",
        "ADD_PICT_PROP" => "BIG_PHOTO",    // Дополнительная картинка основного товара
        "LABEL_PROP" => "-",    // Свойство меток товара
        "OFFER_ADD_PICT_PROP" => "-",
        "OFFER_TREE_PROPS" => array(
            0 => "COLOR_REF",
            1 => "SIZES_SHOES",
            2 => "SIZES_CLOTHES",
        ),
        "PRODUCT_SUBSCRIPTION" => "N",    // Разрешить оповещения для отсутствующих товаров
        "SHOW_DISCOUNT_PERCENT" => "N",    // Показывать процент скидки
        "SHOW_OLD_PRICE" => "Y",    // Показывать старую цену
        "SHOW_CLOSE_POPUP" => "N",    // Показывать кнопку продолжения покупок во всплывающих окнах
        "MESS_BTN_BUY" => "Купить",    // Текст кнопки "Купить"
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",    // Текст кнопки "Добавить в корзину"
        "MESS_BTN_SUBSCRIBE" => "Подписаться",    // Текст кнопки "Уведомить о поступлении"
        "MESS_BTN_DETAIL" => "Подробнее",    // Текст кнопки "Подробнее"
        "MESS_NOT_AVAILABLE" => "Нет в наличии",    // Сообщение об отсутствии товара
        "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
        "DETAIL_URL" => "",    // URL, ведущий на страницу с содержимым элемента раздела
        "SECTION_ID_VARIABLE" => "SECTION_ID",    // Название переменной, в которой передается код группы
        "SEF_MODE" => "N",    // Включить поддержку ЧПУ
        "AJAX_MODE" => "N",    // Включить режим AJAX
        "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
        "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
        "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
        "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
        "CACHE_TYPE" => "A",    // Тип кеширования
        "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
        "CACHE_GROUPS" => "Y",    // Учитывать права доступа
        "SET_TITLE" => "Y",    // Устанавливать заголовок страницы
        "SET_BROWSER_TITLE" => "Y",    // Устанавливать заголовок окна браузера
        "BROWSER_TITLE" => "-",    // Установить заголовок окна браузера из свойства
        "SET_META_KEYWORDS" => "Y",    // Устанавливать ключевые слова страницы
        "META_KEYWORDS" => "-",    // Установить ключевые слова страницы из свойства
        "SET_META_DESCRIPTION" => "Y",    // Устанавливать описание страницы
        "META_DESCRIPTION" => "-",    // Установить описание страницы из свойства
        "SET_LAST_MODIFIED" => "N",    // Устанавливать в заголовках ответа время модификации страницы
        "USE_MAIN_ELEMENT_SECTION" => "N",    // Использовать основной раздел для показа элемента
        "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
        "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
        "ACTION_VARIABLE" => "action",    // Название переменной, в которой передается действие
        "PRODUCT_ID_VARIABLE" => "id",    // Название переменной, в которой передается код товара для покупки
        "PRICE_CODE" => array(    // Тип цены
            0 => "BASE",
        ),
        "USE_PRICE_COUNT" => "N",    // Использовать вывод цен с диапазонами
        "SHOW_PRICE_COUNT" => "1",    // Выводить цены для количества
        "PRICE_VAT_INCLUDE" => "Y",    // Включать НДС в цену
        "CONVERT_CURRENCY" => "N",    // Показывать цены в одной валюте
        "USE_PRODUCT_QUANTITY" => "N",    // Разрешить указание количества товара
        "PRODUCT_QUANTITY_VARIABLE" => "",    // Название переменной, в которой передается количество товара
        "ADD_PROPERTIES_TO_BASKET" => "Y",    // Добавлять в корзину свойства товаров и предложений
        "PRODUCT_PROPS_VARIABLE" => "prop",    // Название переменной, в которой передаются характеристики товара
        "PARTIAL_PRODUCT_PROPERTIES" => "N",    // Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
        "PRODUCT_PROPERTIES" => "",    // Характеристики товара
        "OFFERS_CART_PROPERTIES" => array(
            0 => "COLOR_REF",
            1 => "SIZES_SHOES",
            2 => "SIZES_CLOTHES",
        ),
        "ADD_TO_BASKET_ACTION" => "ADD",    // Показывать кнопку добавления в корзину или покупки
        "PAGER_TEMPLATE" => "round",    // Шаблон постраничной навигации
        "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
        "DISPLAY_BOTTOM_PAGER" => "Y",    // Выводить под списком
        "PAGER_TITLE" => "Товары",    // Название категорий
        "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
        "PAGER_DESC_NUMBERING" => "N",    // Использовать обратную навигацию
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
        "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
        "PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
        "SET_STATUS_404" => "N",    // Устанавливать статус 404
        "SHOW_404" => "N",    // Показ специальной страницы
        "MESSAGE_404" => "",    // Сообщение для показа (по умолчанию из компонента)
        "BACKGROUND_IMAGE" => "-",    // Установить фоновую картинку для шаблона из свойства
    ),
    false
);?>
            </div>
    </div>
    <?}?>
</div>
<script>
$(document).ready(function(){
     $(".descrWrap .bookNames").each(function()
        {
            if($(this).length > 0)
            {
                $(this).html(truncate($(this).html(), 25));
            }
        });

    $(".descrWrap .description").each(function()
        {
            if($(this).length > 0)
            {
                $(this).html(truncate($(this).html(), 130));
            }
        });
    <?$navnum = $arResult["NAV_RESULT"]->NavNum;?>
        <?if (isset($_REQUEST["PAGEN_".$navnum])) {?>
            var page = <?=$_REQUEST["PAGEN_".$navnum]?> + 1;
        <?}else{?>
            var page = 2;
        <?}?>
        var maxpage = <?=($arResult["NAV_RESULT"]->NavPageCount)?>;
            $('.showMore').on('click', function(){
                $.fancybox.showLoading();
                $.get(window.location.href+'&PAGEN_<?=$navnum?>='+page, function(data) {
                    var next_page = $('.searchWidthWrapper .searchBook', data);
                    $('.searchWidthWrapper').append(next_page);
                    page++;
                })
                .done(function()
                {
                    $.fancybox.hideLoading();
                    $(".descrWrap .bookNames").each(function()
                    {
                        if($(this).length > 0)
                        {
                            $(this).html(truncate($(this).html(), 25));
                        }
                    });
                    $(".descrWrap .description").each(function()
                    {
                        if($(this).length > 0)
                        {
                            $(this).html(truncate($(this).html(), 130));
                        }
                    });

                });
                if (page == maxpage) {
                    $('.showMore').hide();
                    //$('.phpages').hide();
                }
                return false;
            });<??>
});
</script>