<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arViewModeList = array('LIST', 'LINE', 'TEXT', 'TILE');

$arDefaultParams = array(
	'VIEW_MODE' => 'LIST',
	'SHOW_PARENT_NAME' => 'Y',
	'HIDE_SECTION_NAME' => 'N'
);

$arParams = array_merge($arDefaultParams, $arParams);

if (!in_array($arParams['VIEW_MODE'], $arViewModeList))
	$arParams['VIEW_MODE'] = 'LIST';
if ('N' != $arParams['SHOW_PARENT_NAME'])
	$arParams['SHOW_PARENT_NAME'] = 'Y';
if ('Y' != $arParams['HIDE_SECTION_NAME'])
	$arParams['HIDE_SECTION_NAME'] = 'N';

$arResult['VIEW_MODE_LIST'] = $arViewModeList;

if (0 < $arResult['SECTIONS_COUNT'])
{
	if ('LIST' != $arParams['VIEW_MODE'])
	{
		$boolClear = false;
		$arNewSections = array();
		foreach ($arResult['SECTIONS'] as &$arOneSection)
		{
			if (1 < $arOneSection['RELATIVE_DEPTH_LEVEL'])
			{
				$boolClear = true;
				continue;
			}
			$arNewSections[] = $arOneSection;
		}
		unset($arOneSection);
		if ($boolClear)
		{
			$arResult['SECTIONS'] = $arNewSections;
			$arResult['SECTIONS_COUNT'] = count($arNewSections);
		}
		unset($arNewSections);
	}
}

if (0 < $arResult['SECTIONS_COUNT'])
{
	$boolPicture = false;
	$boolDescr = false;
	$arSelect = array('ID');
	$arMap = array();
	if ('LINE' == $arParams['VIEW_MODE'] || 'TILE' == $arParams['VIEW_MODE'])
	{
		reset($arResult['SECTIONS']);
		$arCurrent = current($arResult['SECTIONS']);
		if (!isset($arCurrent['PICTURE']))
		{
			$boolPicture = true;
			$arSelect[] = 'PICTURE';
		}
		if ('LINE' == $arParams['VIEW_MODE'] && !array_key_exists('DESCRIPTION', $arCurrent))
		{
			$boolDescr = true;
			$arSelect[] = 'DESCRIPTION';
			$arSelect[] = 'DESCRIPTION_TYPE';
		}
	}
	if ($boolPicture || $boolDescr)
	{
		foreach ($arResult['SECTIONS'] as $key => $arSection)
		{
			$arMap[$arSection['ID']] = $key;
		}
		$rsSections = CIBlockSection::GetList(array(), array('ID' => array_keys($arMap)), false, $arSelect);
		while ($arSection = $rsSections->GetNext())
		{
			if (!isset($arMap[$arSection['ID']]))
				continue;
			$key = $arMap[$arSection['ID']];
			if ($boolPicture)
			{
				$arSection['PICTURE'] = intval($arSection['PICTURE']);
				$arSection['PICTURE'] = (0 < $arSection['PICTURE'] ? CFile::GetFileArray($arSection['PICTURE']) : false);
				$arResult['SECTIONS'][$key]['PICTURE'] = $arSection['PICTURE'];
				$arResult['SECTIONS'][$key]['~PICTURE'] = $arSection['~PICTURE'];
			}
			if ($boolDescr)
			{
				$arResult['SECTIONS'][$key]['DESCRIPTION'] = $arSection['DESCRIPTION'];
				$arResult['SECTIONS'][$key]['~DESCRIPTION'] = $arSection['~DESCRIPTION'];
				$arResult['SECTIONS'][$key]['DESCRIPTION_TYPE'] = $arSection['DESCRIPTION_TYPE'];
				$arResult['SECTIONS'][$key]['~DESCRIPTION_TYPE'] = $arSection['~DESCRIPTION_TYPE'];
			}
		}
	}
} 

shuffle($arResult["SECTIONS"]);
foreach ($arResult["SECTIONS"] as $key => $arSection) {
   if ($arSection["UF_SHOW_ALWAYS"] == SHOW_ALWAYS_PROP_VALUE_ID) {
        array_unshift($arResult["SECTIONS"], $arResult["SECTIONS"][$key]);
        unset($arResult["SECTIONS"][$key]);
   } 
}
$arResult["EDITOR_CHOICE_LIST"] = array();
$arResult["COUNT"] = array();
$arResult["SECT_NAMES"] = array();
$arResult["SECT_URLS"] = array();
$arResult["IMAGES_PATHS_ARRAY"] = array();
foreach ($arResult["SECTIONS"] as $key => $sect)
{   
   
    if ($sect["IBLOCK_SECTION_ID"] == MAIN_PAGE_SELECTIONS_SECTION_ID)
    {    
        $arElem = CIBlockElement::GetList(array(), array('IBLOCK_ID'=>CATALOG_IBLOCK_ID, 'SECTION_ID'=>$sect['ID'], "ACTIVE"=>"Y"), false, false, array('ID', 'NAME', 'IBLOCK_SECTION_ID', 'PROPERTY_editors_choice', "CATALOG_GROUP_1"));
        while ($rsElem = $arElem -> Fetch())
        {   
            if ($rsElem["CATALOG_PRICE_1"] > 0)
            {
                $arResult["EDITOR_CHOICE_LIST"][$sect['ID']][]=$rsElem['ID'];
            }
        }   
    }
}
foreach ($arResult["EDITOR_CHOICE_LIST"] as $key => $val) {
    $arResult["EDITOR_CHOICE_LIST"][$key] = array_unique($arResult["EDITOR_CHOICE_LIST"][$key]);
}
foreach ($arResult["EDITOR_CHOICE_LIST"] as $key => $val)
{
    $curr_sect_name = CIBlockSection::GetByID($key)->Fetch();
    $arResult["SECT_NAMES"][] = $curr_sect_name["NAME"];
    $arResult["COUNT"][] = count($arResult["EDITOR_CHOICE_LIST"][$key]);
    $arResult["SECT_URLS"][] = "/catalog/".$curr_sect_name["CODE"]."/";
    $arResult["IMAGES_PATHS_ARRAY"][] = CFile::GetPath($curr_sect_name["PICTURE"]);
}
?>