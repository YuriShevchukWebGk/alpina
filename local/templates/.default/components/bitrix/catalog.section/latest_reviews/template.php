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

          <div class="bigSlider">
                <ul>
                    <?foreach($arResult["ITEMS"] as $arItem)
                    {
                        $expert = CIBlockElement::GetByID ($arItem["PROPERTIES"]["expert"]["VALUE"]) -> Fetch();
                        $this_elem = CIBlockElement::GetList (array(), array("IBLOCK_ID" => 4, "ID" => $arItem["PROPERTIES"]["BOOK"]["VALUE"][0]), false, false, array("ID", "NAME", "DETAIL_PICTURE", "PROPERTY_AUTHORS", "DETAIL_PAGE_URL"))->Fetch();
                        $this_sect = CIBlockSection::GetList (array(), array("IBLOCK_ID" => 4, "ID" => $this_elem["IBLOCK_SECTION_ID"]), false, array("ID", "CODE")) -> Fetch();                                    
                        $author = CIBlockElement::GetList (array(), array("IBLOCK_ID" => 29, "ID" => $this_elem["PROPERTY_AUTHORS_VALUE"]), false, false, array("ID", "NAME")) -> Fetch();

                        $elem_pict = CFile::ResizeImageGet($this_elem["DETAIL_PICTURE"], array('width'=>84, 'height'=>120), BX_RESIZE_IMAGE_EXACT, true);
                    ?>
                    <li>
                        <a href="/catalog/<?=$this_sect["CODE"]?>/<?=$this_elem["ID"]?>/">
                            <div class="sliderElement">
                               
                                    <p class="autor"><?=$expert["NAME"]?></p>
                                    <?
                                        if(mb_strlen($arItem["PREVIEW_TEXT"], 'utf-8') > (253)){
                                            $sub_str = mb_substr($arItem["PREVIEW_TEXT"], 0, 253, 'utf-8');
                                            $result_str = trim($sub_str) . "...";
                                        }else{
                                            $result_str = $arItem["PREVIEW_TEXT"];
                                        }
                                    ?>
                                    <p class="reviesText"><?=$result_str?></p>
                                
                                
                                
                                <div class="thisBook">
                                    <?
                                        
                                    ?>
                                        
                                        <img src="<?=$elem_pict["src"]?>">
                                        <p class="titleBook">
                                        <?=$this_elem["NAME"]?>
                                        </p>
                                        <p class="autorBook">
                                        <?=$author["NAME"]?>
                                        </p>
                                    
                                </div>
                            </div>
                        </a>
                    </li>
                    <?}?>
                    
                </ul>
            </div>

