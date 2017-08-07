<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

if ($_REQUEST["postid"]) {
	$stringRecs = file_get_contents('https://api.retailrocket.ru/api/1.0/Recomendation/UpSellItemToItems/59703efb5a658825342f445a/'.$_REQUEST["postid"]);
	$recsArray = json_decode($stringRecs);
	array_splice($recsArray,1);
	
	$arSelect = Array(
		"NAME",
		"DETAIL_PAGE_URL",
		"DETAIL_PICTURE",
		"DETAIL_TEXT"
		);
	$arFilter = Array("IBLOCK_ID"=>71,"ID"=>$recsArray, "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
	
	$post = array();
	
	while($ob = $res->GetNextElement()){
		$arFields = $ob->GetFields();
		$post["NAME"] 					= $arFields['NAME'];
		$post["URL"] 					= $arFields['DETAIL_PAGE_URL'];
		$post["IMG"] 					= CFile::ResizeImageGet($arFields['DETAIL_PICTURE'], array("width" => 205, "height" => 130), BX_RESIZE_IMAGE_PROPORTIONAL, true)["src"];
		$post["PREVIEW_TEXT"] 			= substr(strip_tags($arFields['DETAIL_TEXT']),0,150).'...';
	}
	
	$return = '<style>.stopProp a{color: #00abb8;font-size:17px}.stopProp a:hover {text-decoration:underline}.stopProp h2 {margin:0}.closeIcon:after {background: url("/img/close.png") left center;width: 21px;height: 21px;right:5%;cursor: pointer;display: block;position:absolute;content: "";} .closeIcon:hover:after {background: url("/img/close.png") right center;}</style>';
	$return .= '<script>$(document).ready(function() { $(".stopProp").click(function(e) { e.stopPropagation(); }); });</script>';
	$return .= '<div style="position: fixed; width: 30%; max-height:240px;bottom: 30px; right: 30px; z-index: 999999999998" id="blogRec" onclick="closeInfo();">';
	$return .= '<div style="width:90%;height:85%;box-shadow: 0 0 1px 0px rgba(0,0,0,.7); margin: 2% auto 0; background: #fff; padding: 20px; z-index: 999999999999;display: block;font-family: \'Walshein_light\';" class="stopProp">';
	$return .= '<div class="closeIcon" style="cursor:pointer;" onclick="closeInfo();"></div>';
	
	$return .= '<div style="height:100%">';
	$return .= '<a href="'.$post["URL"].'">';
	$return .= '<img src="'.$post["IMG"].'" style="box-shadow: 0 9px 5px 0 rgba(0, 0, 0, 0.18), 0 10px 7px 0 rgba(0, 0, 0, 0.14);width:auto;max-width:205px;margin:0 20px 10px 0;float:left;">';
	$return .= $post["NAME"];
	$return .= '</a><br />';
	$return .= $post["PREVIEW_TEXT"];
	$return .= '</div>';
	
	$return .= '</div></div></div>';
	echo $return;
}
?>