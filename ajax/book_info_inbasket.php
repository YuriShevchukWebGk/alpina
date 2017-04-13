<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale"); CModule::IncludeModule("catalog"); CModule::IncludeModule("iblock");
?>
<?
if ($_REQUEST["id"])
{
	$arSelect = Array(
		"NAME",
		"DETAIL_PAGE_URL",
		"DETAIL_PICTURE",
		"PREVIEW_TEXT",
		"PROPERTY_STATE",
		"PROPERTY_ISBN",
		"PROPERTY_ENG_NAME",
		"PROPERTY_PUBLISHER",
		"PROPERTY_YEAR",
		"PROPERTY_AUTHORS",
		"PROPERTY_PAGES",
		"PROPERTY_COVER_TYPE",
		"PROPERTY_COVER_FORMAT",
		"PROPERTY_best_seller",
		"PROPERTY_editors_choice"
		);
	$arFilter = Array("IBLOCK_ID"=>4,"ID"=>$_REQUEST["id"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
	
	$book = array();
	$return = '<style>.awayLink:hover {background-color: #cab796!important;color: #fff!important;} .addLink:hover {background-color: #c7a271!important;color: #fff!important;} .closeIcon:after {position: absolute;background: url("/img/close.png") left center;width: 21px;height: 21px;right: 2%;top: 5%;margin-left: -15px;margin-top: -8px;cursor: pointer;display: block;content: "";} .closeIcon:hover:after {background: url("/img/close.png") right center;}</style>';
	$return .= '<script>$(document).ready(function() { $(".stopProp").click(function(e) { e.stopPropagation(); }); });</script>';
	$return .= '<div style="position: fixed; width: 100%; height: 100%; top: 0; left: 0; z-index: 999999999998; background: rgba(206,206,206,.62);overflow-y:auto;" onclick="closeInfo();" class="hideInfo">';
	$return .= '<div style="max-width: 1040px; width:100%;min-width:800px;margin-left: -520px; margin-top: -300px;box-shadow: 0 0 1px 0px rgba(0,0,0,.7); top: 50%; left: 50%; position: absolute; background: #fff; padding: 30px; z-index: 999999999999;display: block;font-family: \'Walshein_regular\';" class="stopProp">';
	$return .= '<div class="closeIcon" style="cursor:pointer;" onclick="closeInfo();"></div>';
	$return .= '<div>';

	while($ob = $res->GetNextElement()){
		$arFields = $ob->GetFields();
		$book["NAME"] 					= $arFields['NAME'];
		$book["URL"] 					= $arFields['DETAIL_PAGE_URL'];
		$book["IMG"] 					= CFile::ResizeImageGet($arFields['DETAIL_PICTURE'], array("width" => 280, "height" => 380), BX_RESIZE_IMAGE_PROPORTIONAL, true)["src"];
		$book["IMG_WIDTH"] 				= CFile::ResizeImageGet($arFields['DETAIL_PICTURE'], array("width" => 280, "height" => 380), BX_RESIZE_IMAGE_PROPORTIONAL, true)["width"];
		$book["IMG_HEIGHT"] 			= CFile::ResizeImageGet($arFields['DETAIL_PICTURE'], array("width" => 280, "height" => 380), BX_RESIZE_IMAGE_PROPORTIONAL, true)["height"];
		$book["PREVIEW_TEXT"] 			= $arFields['PREVIEW_TEXT'];
		$book["STATE"] 					= $arFields['PROPERTY_STATE_VALUE'];
		$book["ISBN"] 					= $arFields['PROPERTY_ISBN_VALUE'];
		$book["ENG_NAME"] 				= $arFields['PROPERTY_ENG_NAME_VALUE'];
		$book["PUBLISHER"] 				= $arFields['PROPERTY_PUBLISHER_VALUE'];
		$book["YEAR"] 					= $arFields['PROPERTY_YEAR_VALUE'];
		$book["AUTHOR"] 				= CIBlockElement::GetByID($arFields['PROPERTY_AUTHORS_VALUE'])->Fetch()['NAME'];
		$book["PAGES"] 					= $arFields['PROPERTY_PAGES_VALUE'];
		$book["COVER_TYPE"] 			= $arFields['PROPERTY_COVER_TYPE_VALUE'];
		$book["COVER_FORMAT"] 			= $arFields['PROPERTY_COVER_FORMAT_VALUE'];
		$book["best_seller"] 			= $arFields['PROPERTY_BEST_SELLER_ENUM_ID'];
		$book["editors_choice"] 		= $arFields['PROPERTY_EDITORS_CHOICE_ENUM_ID'];
	}
	
	$return .= '<img src="'.$book["IMG"].'" style="margin: 0 40px 70px; box-shadow: 0 9px 5px 0 rgba(0, 0, 0, 0.18), 0 10px 7px 0 rgba(0, 0, 0, 0.14);width:'.$book["IMG_WIDTH"].'px;height:'.$book["IMG_HEIGHT"].'px;" align="left">';
	$return .= '<h2>'.$book["NAME"].'<br />';
	if (!empty($book["STATE"]))
		$return .= ' <span style="background-color:#00A0AF;border-radius: 3px;color: #fff;font-size: 10px;padding: 4px 9px;text-transform: uppercase;width: auto;">'.$book["STATE"].'</span>';
	if (!empty($book["best_seller"]))
		$return .= ' <span style="background-color:#E59622;border-radius: 3px;color: #fff;font-size: 10px;padding: 4px 9px;text-transform: uppercase;width: auto;">Бестселлер</span>';
	if (!empty($book["editors_choice"]))
		$return .= ' <span style="background-color:#249822;border-radius: 3px;color: #fff;font-size: 10px;padding: 4px 9px;text-transform: uppercase;width: auto;">Editor\'s Choice</span>';
	$return .= '</h2>';
	
	if (!empty($book["ENG_NAME"]))
		$return .= '<h4>'.$book["ENG_NAME"].'</h4>';
	
	$return .= 'Автор: <span style="color:#666;">'.$book["AUTHOR"].'</span><br />';	
	$return .= '<span style="color:#000;">Издательство:</span> <span style="color:#666;">'.$book["PUBLISHER"].', '.$book["YEAR"].' г.</span><br />';
	$return .= 'Страниц: <span style="color:#666;">'.$book["PAGES"].'</span><br />';
	$return .= 'Тип обложки: <span style="color:#666;">'.$book["COVER_TYPE"].'</span><br />';
	$return .= 'Размер: <span style="color:#666;">'.$book["COVER_FORMAT"].'</span><br />';
	$return .= 'ISBN: <span style="color:#666;">'.$book["ISBN"].'</span><br />';
	$return .= '<h4>Краткое описание</h4>'.$book["PREVIEW_TEXT"].'<br /><br />';
	$return .= '<div style="margin-top:30px;width:100%;text-align:center;"><a class="awayLink" href="'.$book["URL"].'" style="background: rgba(0, 0, 0, 0); border: 2px solid #c7a271; border-radius: 30px; color: #c7a271; font-size: 16px; padding: 7px 20px; margin-bottom: 20px;">Перейти на страницу книги</a>';
	
	if ($_REQUEST["rec"] == 1)
		$return .= '<a class="addLink" href="https://www.alpinabook.ru/personal/cart/?action=ADD2BASKET&id='.$_REQUEST["id"].'" style="margin-left:40px;border: 2px solid #c7a271;background-color: #cab796;color: #fff; border-radius: 30px; font-size: 18px; padding: 7px 20px; margin-bottom: 20px;">Добавить к заказу</a>';
	
	$return .= '</div><br />';
	
	$return .= '</div></div></div>';
	echo $return;
}
?>