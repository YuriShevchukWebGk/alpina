<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){
	$sale_books = array(
array('id'=>363856, 'discount'=>30),
array('id'=>8194, 'discount'=>40),
array('id'=>337790, 'discount'=>40),
array('id'=>364461, 'discount'=>20),
array('id'=>6115, 'discount'=>20),
array('id'=>65392, 'discount'=>20),
array('id'=>348247, 'discount'=>30),
array('id'=>8688, 'discount'=>30),
array('id'=>372608, 'discount'=>20),
array('id'=>382646, 'discount'=>40),
array('id'=>8716, 'discount'=>30),
array('id'=>8696, 'discount'=>20),
array('id'=>8206, 'discount'=>50),
array('id'=>8546, 'discount'=>60),
array('id'=>124350, 'discount'=>20),
array('id'=>8722, 'discount'=>20),
array('id'=>358183, 'discount'=>30),
array('id'=>8264, 'discount'=>40),
array('id'=>66427, 'discount'=>50),
array('id'=>8032, 'discount'=>30),
array('id'=>6419, 'discount'=>50),
array('id'=>8528, 'discount'=>40),
array('id'=>8798, 'discount'=>60),
array('id'=>372526, 'discount'=>30),
array('id'=>348278, 'discount'=>10),
array('id'=>341748, 'discount'=>20),
array('id'=>347911, 'discount'=>30),
array('id'=>66476, 'discount'=>30),
array('id'=>66478, 'discount'=>20),
array('id'=>8848, 'discount'=>60),
array('id'=>372602, 'discount'=>20),
array('id'=>60911, 'discount'=>10),
array('id'=>8858, 'discount'=>30),
array('id'=>5587, 'discount'=>10),
array('id'=>358235, 'discount'=>20),
array('id'=>378306, 'discount'=>20),
array('id'=>365142, 'discount'=>10),
array('id'=>75968, 'discount'=>30),
array('id'=>8284, 'discount'=>30),
array('id'=>340928, 'discount'=>30),
array('id'=>347843, 'discount'=>20),
array('id'=>7825, 'discount'=>40),
array('id'=>8606, 'discount'=>10),
array('id'=>125857, 'discount'=>20),
array('id'=>90656, 'discount'=>30),
array('id'=>81365, 'discount'=>20),
array('id'=>7024, 'discount'=>20),
array('id'=>364335, 'discount'=>10),
array('id'=>6607, 'discount'=>30),
array('id'=>8212, 'discount'=>70),
array('id'=>70007, 'discount'=>50),
array('id'=>378296, 'discount'=>20),
array('id'=>365127, 'discount'=>60),
array('id'=>84627, 'discount'=>70),
array('id'=>7962, 'discount'=>40),
array('id'=>8578, 'discount'=>30),
array('id'=>129141, 'discount'=>30),
array('id'=>8502, 'discount'=>70),
array('id'=>186046, 'discount'=>20),
array('id'=>341008, 'discount'=>10),

	);

	$table = 	"<table><tbody><tr>";
	$table .=	"<td>no</td>";
	$table .=	"<td>name</td>";
	$table .=	"<td>discount</td>";
	$table .=	"<td>oldprice</td>";
	$table .=	"<td>newprice</td>";
	$table .=	"<td>discountrub</td>";
	$table .=	"<td>link</td>";
	$table .=	"<td>pic</td>";
	$table .=	"<td>id</td>";
	$table .=	"<td>final</td>";
	$table .=	"</tr>";
	
	foreach ($sale_books as $i => $book) {
		$table .=	"<tr>";
		$res = CIBlockElement::GetList(Array(), array("ID"=>$book['id'], "PROPERTY_STATE"=>array(22,23)), false, false, array("NAME", "DETAIL_PAGE_URL", "PROPERTY_STATE","DETAIL_PICTURE"));
		$price = substr(CPrice::GetBasePrice($book[id])['PRICE'],0,-3);
		if($ar_res = $res->GetNext()) {
			$img = CFile::ResizeImageGet($ar_res[DETAIL_PICTURE], array("width" => 360, "height" => 520), BX_RESIZE_IMAGE_PROPORTIONAL, true)[src];
			$table .=	"<td>".$i."</td>";
			$table .=	"<td>".$ar_res['NAME']."</td>";
			$table .=	"<td>".$book[discount]."</td>";
			$table .=	"<td>".$price."</td>";
			$table .=	"<td>".($price*(100-$book[discount])/100)."</td>";
			$table .=	"<td>".($price*$book[discount]/100)."</td>";
			$table .=	"<td>".$ar_res['DETAIL_PAGE_URL']."</td>";
			$table .=	"<td>".$ar_res["PROPERTY_STATE_VALUE"]."</td>";
			$table .=	"<td>".$book[id]."</td>";
			$table .=	"<td>array('no'=>".$i.", 'img'=>'".$img."', 'name'=>'".$ar_res['NAME']."', 'discount'=>".$book[discount].", 'oldprice'=>'".$price."', 'newprice'=>'".($price*(100-$book[discount])/100)."', 'link'=>'".$ar_res['DETAIL_PAGE_URL']."', 'diff'=>'".($price*$book[discount]/100)."', 'id'=>".$book[id]."),";
		}
		$table .=	"</tr>";
	}
	
	$table .= "</tbody></table>";
	echo $table;
} 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>