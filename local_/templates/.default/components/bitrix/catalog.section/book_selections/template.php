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
<?
foreach ($arResult["ITEMS"] as $key =>$arItem)
{
    $count[$key]=0;
    $item_getlist = CIBlockElement::GetList(array(), array("IBLOCK_ID"=>4, "ID"=>$arItem["PROPERTIES"][191]["VALUE"]), false, false, array("ID", "CATALOG_GROUP_1"));
    while ($item_fetch = $item_getlist -> Fetch())
    {
        if ($item_fetch["CATALOG_PRICE_1"] > 0)
        {
            $count[$key]+=1;
        }
    }
}
//arshow($count);?>
<div class="books">
                    <div class="firstSection">
                        <div class="titleBlock">
                            <div class="titleText">
                                <img src="/img/redPhoto.png">
                                <p class="nameOfGroup">Editor's Choice</p>
                                <p class="subNameOfGroup">Сергей турко</p>
                                <p class="description">Главный редактор</p>
                                <p class="description">"альпина паблишер"</p>
                            </div>
                        </div>
                        <div>
                            <?if ($count[2] > 0)
                            {?>
                            <div class="smallContainer">
                                <a href="/catalog/book-selection/?type=<?=$arResult["ITEMS"][2]["ID"]?>">
                                <p><?=$arResult["ITEMS"][2]["NAME"]?></p>
                                </a>
                                <p class="count"><?=$count[2].' '.format_by_count($count[2], 'книга', 'книги', 'книг');?></p>
                                <div class="colorCorrect"></div>
                                <img src="<?=$arResult["ITEMS"][2]["PREVIEW_PICTURE"]["SRC"]?>">
                            </div>
                            <?}?>
                            <?if ($count[3] > 0)
                            {?>
                            <div class="smallContainer">
                                 <a href="/catalog/book-selection/?type=<?=$arResult["ITEMS"][3]["ID"]?>">
                                <p><?=$arResult["ITEMS"][3]["NAME"]?></p>
                                </a>
                                <p class="count"><?=$count[3].' '.format_by_count($count[3], 'книга', 'книги', 'книг');?></p>
                                <div class="colorCorrect"></div>
                                <img src="<?=$arResult["ITEMS"][3]["PREVIEW_PICTURE"]["SRC"]?>">
                            </div>
                            <?}?>
                        </div>
                    </div>
                    <div class="secondSection">
                        <div>
                            <?if ($count[0] > 0)
                            {?>
                            <div class="smallContainer">
                                 <a href="/catalog/book-selection/?type=<?=$arResult["ITEMS"][0]["ID"]?>">
                                <p><?=$arResult["ITEMS"][0]["NAME"]?></p>
                                </a>
                                <p class="count"><?=$count[0].' '.format_by_count($count[0], 'книга', 'книги', 'книг');?></p>
                                <div class="colorCorrect"></div>
                                <img src="<?=$arResult["ITEMS"][0]["PREVIEW_PICTURE"]["SRC"]?>">
                            </div>
                            <?}?>
                            <?if ($count[1] > 0)
                            {?>
                            <div class="smallContainer">
                                 <a href="/catalog/book-selection/?type=<?=$arResult["ITEMS"][1]["ID"]?>">
                                <p><?=$arResult["ITEMS"][1]["NAME"]?></p>
                                </a>
                                <p class="count"><?=$count[1].' '.format_by_count($count[1], 'книга', 'книги', 'книг');?></p>
                                <div class="colorCorrect"></div>
                                <img src="<?=$arResult["ITEMS"][1]["PREVIEW_PICTURE"]["SRC"]?>">
                            </div>
                            <?}?>    
                        </div>
                        <div>
                            <?if ($count[4] > 0)
                            {?>
                            <div class="smallContainer">
                                 <a href="/catalog/book-selection/?type=<?=$arResult["ITEMS"][4]["ID"]?>">
                                <p><?=$arResult["ITEMS"][4]["NAME"]?></p>
                                </a>
                                <p class="count"><?=$count[4].' '.format_by_count($count[4], 'книга', 'книги', 'книг');?></p>
                                <div class="colorCorrect"></div>
                                <img src="<?=$arResult["ITEMS"][4]["PREVIEW_PICTURE"]["SRC"]?>">
                            </div>
                            <?}?>
                            <?if ($count[5] > 0)
                            {?>
                            <div class="smallContainer">
                                 <a href="/catalog/book-selection/?type=<?=$arResult["ITEMS"][5]["ID"]?>">
                                <p><?=$arResult["ITEMS"][5]["NAME"]?></p>
                                </a>
                                <p class="count"><?=$count[5].' '.format_by_count($count[5], 'книга', 'книги', 'книг');?></p>
                                <div class="colorCorrect"></div>
                                <img src="<?=$arResult["ITEMS"][5]["PREVIEW_PICTURE"]["SRC"]?>">
                            </div>
                            <?}?>    
                        </div>
                    </div>
                </div>