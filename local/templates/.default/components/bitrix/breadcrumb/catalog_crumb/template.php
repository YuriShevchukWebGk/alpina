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


$strReturn .= '<p class="breadCrump" itemscope itemtype="http://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++) {
    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);

    $nextRef = ($index < $itemSize-2 && $arResult[$index+1]["LINK"] <> ""? '' : '');

    $arrow = ($index > 0? '<i class="fa fa-angle-right"></i>' : '');

    // не включать "Каталог" в цепочку навигации
    
    if ($arResult[$index]["LINK"] <> "/catalog/" && ($index <> 2)) {
        if(($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)) {
            
              $strReturn .= '
                <span id="bx_breadcrumb_' . $index . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"'.$child.$nextRef.'>
                    ' . $arrow . '
                    <a href="' . $arResult[$index]["LINK"] . '" title="' . $title . '" itemprop="item">
                        <span itemprop="name">' . $title . '</span>
                    </a>
					<meta itemprop="position" content="' . ($index == 0 ? 1 : $index) . '" />
                </span>';  
        } else {
            $strReturn .= '
                <span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                ' . $arrow . '
                <span itemprop="item"><span itemprop="name">' . $title . '</span></span>
                <meta itemprop="position" content="' . ($index == 0 ? 1 : $index) . '" />
                </span>'; 
        }
    }
}

$strReturn .= '</p>'; 

return $strReturn;
