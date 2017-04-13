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
		"PROPERTY_pdf_newlist"
		);
	$arFilter = Array("IBLOCK_ID"=>4,"ID"=>$_REQUEST["id"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
	
	$book = array();
	
	while($ob = $res->GetNextElement()){
		$arFields = $ob->GetFields();
		$book["NAME"] 					= $arFields['NAME'];
		$book["URL"] 					= $arFields['DETAIL_PAGE_URL'];
		$book["IMG"] 					= CFile::ResizeImageGet($arFields['DETAIL_PICTURE'], array("width" => 264, "height" => 394), BX_RESIZE_IMAGE_PROPORTIONAL, true)["src"];
		$book["PREVIEW_TEXT"] 			= $arFields['PREVIEW_TEXT'];
		$book["PDF"] 					= CFile::GetPath($arFields['PROPERTY_PDF_NEWLIST_VALUE']);
	}
	
	$return = '<style>.stopProp a:hover {background-color: #00b9c8!important;color: #f2f2f2!important;}.stopProp h2 {margin:0} .awayLink:hover {background-color: #cab796!important;color: #fff!important;} .addLink:hover {background-color: #c7a271!important;color: #fff!important;} .closeIcon:after {background: url("/img/close.png") left center;width: 21px;height: 21px;right:5%;cursor: pointer;display: block;position:absolute;content: "";} .closeIcon:hover:after {background: url("/img/close.png") right center;}</style>';
	$return .= '<script>$(document).ready(function() { $(".stopProp").click(function(e) { e.stopPropagation(); }); });</script>';
	$return .= '<div style="position: fixed; width: 100%; height: 100%; top: 0; left: 0; z-index: 999999999998; background: rgba(206,206,206,.62);overflow-y:auto;" onclick="closeInfo();" class="hideInfo">';
	$return .= '<div style="width:90%;min-width:1024px;height:85%;box-shadow: 0 0 1px 0px rgba(0,0,0,.7); margin: 2% auto 0; background: #fff; padding: 30px; z-index: 999999999999;display: block;font-family: \'Walshein_regular\';" class="stopProp">';
	$return .= '<div class="closeIcon" style="cursor:pointer;" onclick="closeInfo();"></div>';
	
	$return .= '<div style="width:15%;max-width:300px;float:left;height:100%;margin-top:1%;">';
	$return .= '<img src="'.$book["IMG"].'" style="box-shadow: 0 9px 5px 0 rgba(0, 0, 0, 0.18), 0 10px 7px 0 rgba(0, 0, 0, 0.14);width:100%;max-width:280px;"><br /><br />';
	$return .= $book["NAME"];
	
	if ($_REQUEST["stock"] != 0)
		$return .= '<center><br /><a href="?action=ADD2BASKET&id='.$_REQUEST["id"].'" style="background-color: #00abb8;border-radius: 35px;color: #fff;font-size: 19px;padding: 9px 25px;transition: color .3s ease,background-color .3s ease,border-color .3s ease;">В корзину</a></center>';
	
	$return .= '</div>';
	
	$return .= '<div style="width:79%;height:100%;margin: 1% 0 0 30px;float:left;min-width:700px;">';
	$return .= '<iframe src="'.$book["PDF"].'" style="width:100%;height:95%;"></iframe>';
	$return .= '</div><br />';
	
	$return .= '</div></div></div>';
	echo $return;
}
?>