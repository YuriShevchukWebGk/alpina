<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale"); CModule::IncludeModule("catalog"); CModule::IncludeModule("iblock");
?>
<?
if ($_REQUEST["id"])
{
	$arSelect = Array(
		"NAME",
		"DETAIL_PAGE_URL",
		"PREVIEW_TEXT",
		"PROPERTY_SOURCE_LINK"
		);
	$arFilter = Array("IBLOCK_ID"=>24,"ID"=>$_REQUEST["id"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
 	
	$review = array();
	
	$return = '<style>.outLink {text-decoration:underline} .outLink:hover {text-decoration:none;}.stopProp img {max-width:650px;height:auto;display:block;margin:0 auto;padding:20px 0;}.awayLink:hover {background-color: #cab796!important;color: #fff!important;} .addLink:hover {background-color: #c7a271!important;color: #fff!important;} .closeIcon:after {position: absolute;background: url("/img/close.png") left center;width: 21px;height: 21px;right: 40px;top: 60px;margin-left: -15px;margin-top: -8px;cursor: pointer;display: block;content: "";} .closeIcon:hover:after {background: url("/img/close.png") right center;}</style>';
	$return .= '<script>$(document).ready(function() { $(".stopProp").click(function(e) { e.stopPropagation(); }); });</script>';
	$return .= '<div style="position: fixed; width: 100%; height: 100%; top: 0; left: 0; z-index: 999999999998; background: rgba(206,206,206,.62);overflow-y:auto;" onclick="closeInfo();" class="hideInfo">';
	$return .= '<div style="max-width: 800px; width:100%;min-width:700px;margin-left: -410px; margin-top: 7%;margin-bottom:7%;box-shadow: 0 0 1px 0px rgba(0,0,0,.7); top: 0; left: 50%; position: absolute; background: #fff; padding: 30px 40px; z-index: 999999999999;display: block;font-family: \'Walshein_regular\';color:#2F3839" class="stopProp">';
	$return .= '<div class="closeIcon" style="cursor:pointer;" onclick="closeInfo();"></div>';
	$return .= '<div>';

	while($ob = $res->GetNextElement()){
		$arFields = $ob->GetFields();
		$review["NAME"] 				= $arFields['NAME'];
		$review["URL"] 					= $arFields['DETAIL_PAGE_URL'];
		$review["TEXT"]					= strip_tags($arFields['PREVIEW_TEXT'], '<br>, <p>, <img>, <ul>, <li>, <ol>');
		$review["SOURCE_LINK"] 			= $arFields['PROPERTY_SOURCE_LINK_VALUE'];
	}

	$return .= '<h2>'.$review["NAME"].'</h2><br />';

	$return .= $review["TEXT"].'<br />';
	
	if ($review["SOURCE_LINK"] != '')
		$return .= '<br /><a href="'.$review["SOURCE_LINK"].'" rel="nofollow" target="_blank" style="color: #00ABB8;" class="outLink">Источник</a>';
	
	$return .= '</div><br />';
	
	$return .= '</div></div></div>';
	echo $return;
}
?>