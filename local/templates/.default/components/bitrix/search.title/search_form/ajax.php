<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["CATEGORIES"])){?>
<?
function mySort($a, $b) {
    if ($a['PAGE_VIEWS_GA'] == $b['PAGE_VIEWS_GA']) return 0;

    return $a['PAGE_VIEWS_GA'] < $b['PAGE_VIEWS_GA'] ? 1 : -1;
 }
?>
    <table class="title-search-result">
        <?foreach($arResult["CATEGORIES"] as $category_id => $arCategory){?>
            <?usort($arCategory["ITEMS"], 'mySort')?>
            <tr>
                <th class="title-search-separator">&nbsp;</th>
                <td class="title-search-separator">&nbsp;</td>
            </tr>
            <?foreach($arCategory["ITEMS"] as $i => $arItem){
                $arSelect = Array("NAME", "PROPERTY_FOR_ADMIN", "DETAIL_PAGE_URL");
                $arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, "DETAIL_PAGE_URL"=>$arItem["URL"], "NAME" => $arItem["NAME"]);
                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                if($element = $res->GetNext()) {
                    $arItem["FOR_ADMIN"] = $element["PROPERTY_FOR_ADMIN_VALUE"]; // проверяем массив на наличие неверных ссылок на товар
                }
               // && (count($url) != 4 && !is_int($url[2])) ?>
                <?//$url = explode('/', $arItem["URL"]);  ?>
                <?if(!$arItem["FOR_ADMIN"] ){?>
                <tr>
                    <?if($i == 0 && $category_id !== "all"):?>
                        <th>&nbsp;<?echo 'Результат'?></th>
                    <?else:?>
                        <th>&nbsp;</th>
                    <?endif?>

                    <?if($category_id === "all"):?>

                        <td class="title-search-all"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></td>
                    <?elseif(isset($arItem["URL"])):?>
                        <td class="title-search-item"><a href="<?echo $arItem["URL"]?>"><img src="/local/templates/.default/components/bitrix/search.title/search_form/images/default.png" style="vertical-align:middle;" valign="middle"><?echo $arItem["NAME"]?><br />
                        <?if(!empty($arItem["AUTHOR"])){?>
                            <span class="searchtip"><?echo $arItem["AUTHOR"].', ';?>
                            <?if (!empty($arItem["COVER_TYPE"])) {?>
                                <?echo $arItem["COVER_TYPE"];?>
                            <?}?>
                            </span>
                        <?}?>
                        </td>
                    <?else:?>
                        <td class="title-search-more"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></td>
                    <?endif;?>
                </tr>
                <?}?>
            <?}?>
        <?}?>
        <tr>
            <th class="title-search-separator">&nbsp;</th>
            <td class="title-search-separator">&nbsp;</td>
        </tr>
    </table><div class="title-search-fader"></div>
<?}?>