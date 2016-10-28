<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
    return "";

$strReturn = '';
//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()
$css = $APPLICATION->GetCSSArray();
if(!is_array($css) || !in_array("/bitrix/css/main/font-awesome.css", $css)) {
    $strReturn .= '<link href="'.CUtil::GetAdditionalFileURL("/bitrix/css/main/font-awesome.css").'" type="text/css" rel="stylesheet" />'."\n";
}


$strReturn .= '<p class="breadCrump" itemprop="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
$i = 0;
for($index = 0; $index < $itemSize; $index++) {
    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);

    $nextRef = ($index < $itemSize-2 && $arResult[$index+1]["LINK"] <> ""? '' : '');

    $arrow = ($index > 0? '<i class="fa fa-angle-right"></i>' : '');

    // не включать "Каталог" в цепочку навигации
    if ($arResult[$index]["LINK"] <> "/catalog/" && ($index <> 2) && $title != 'Анонсы лекций' && $title != 'Баннеры в мероприятиях') {
		$i++;
        if(($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)) {
            
              $strReturn .= '
                <span id="bx_breadcrumb_' . $index . '" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"'.$child.$nextRef.'>
                    ' . $arrow . '
                    <a href="' . $arResult[$index]["LINK"] . '" title="' . $title . '" itemprop="url">
                        <span itemprop="name">' . $title . '</span>
                    </a>
                    <meta itemprop="position" content="' . $i. '" />
                </span>';  
        } else {
            $strReturn .= '
                <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                ' . $arrow . '
                <span itemprop="name">' . $title . '</span>
                <meta itemprop="position" content="' . $i . '" />
                </span>'; 
        }
    }
}

$strReturn .= '</p>'; 

return $strReturn;
