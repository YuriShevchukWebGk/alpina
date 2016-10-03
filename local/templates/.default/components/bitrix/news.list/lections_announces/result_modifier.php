<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach($arResult["ITEMS"] as $arItem){
    if(!empty($arItem["PROPERTIES"]["AUTHOR_LINK"]["VALUE"])){
           $item_autor[] = $arItem;
    }
}
$arResult["ITEMS"] = $item_autor;
?>