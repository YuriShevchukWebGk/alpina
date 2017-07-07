<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

//Имитируем скидку в 10% или 20% для предзаказа, при сумме предзаказа от 5000 и 20000 рублей соотвественно   
foreach ($arResult["GRID"]["ROWS"] as $k => $arItem){
    if ($arItem["DELAY"] == "Y" && $arItem["CAN_BUY"] == "Y"){
        if((($arItem["BASE_PRICE"] * $arItem["QUANTITY"] >= 5000) && ($arItem["BASE_PRICE"] * $arItem["QUANTITY"] < 20000)) && ($arItem["DISCOUNT_PRICE_PERCENT"] < 10)) {
            $arResult["GRID"]["ROWS"][$k]["DISCOUNT_PRICE_PERCENT"] = 10;        
            $arResult["GRID"]["ROWS"][$k]["DISCOUNT_PRICE_PERCENT_FORMATED"] = '10.00%'; 
            $realPrice = $arResult["GRID"]["ROWS"][$k]["BASE_PRICE"] * 0.9;
            $arResult["GRID"]["ROWS"][$k]["PRICE_FORMATED"] = round($realPrice, 2).' руб.';     
            $realFullPrice = $realPrice * $arItem["QUANTITY"];
            $arResult["GRID"]["ROWS"][$k]["SUM"] = round($realFullPrice, 2).' руб.';
        } elseif (($arItem["BASE_PRICE"] * $arItem["QUANTITY"] >= 20000) && ($arItem["DISCOUNT_PRICE_PERCENT"] < 20)) {
            $arResult["GRID"]["ROWS"][$k]["DISCOUNT_PRICE_PERCENT"] = 20;        
            $arResult["GRID"]["ROWS"][$k]["DISCOUNT_PRICE_PERCENT_FORMATED"] = '20.00%'; 
            $realPrice = $arResult["GRID"]["ROWS"][$k]["BASE_PRICE"] * 0.8;
            $arResult["GRID"]["ROWS"][$k]["PRICE_FORMATED"] = round($realPrice, 2).' руб.';  
            $realFullPrice = $realPrice * $arItem["QUANTITY"];
            $arResult["GRID"]["ROWS"][$k]["SUM"] = round($realFullPrice, 2).' руб.';               
        }    
    }
}
?>