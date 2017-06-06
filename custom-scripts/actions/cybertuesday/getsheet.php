<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){
	$sale_books = array(
array('id'=>8412, 'discount'=>1),
array('id'=>8143, 'discount'=>1),
array('id'=>7819, 'discount'=>1),
array('id'=>8578, 'discount'=>1),
array('id'=>8206, 'discount'=>1),
array('id'=>7746, 'discount'=>1),
array('id'=>8440, 'discount'=>1),
array('id'=>8752, 'discount'=>1),
array('id'=>60919, 'discount'=>1),
array('id'=>8710, 'discount'=>1),
array('id'=>8448, 'discount'=>1),
array('id'=>8212, 'discount'=>1),
array('id'=>6607, 'discount'=>1),
array('id'=>8352, 'discount'=>1),
array('id'=>8024, 'discount'=>1),
array('id'=>8546, 'discount'=>1),
array('id'=>7032, 'discount'=>1),
array('id'=>7962, 'discount'=>1),
array('id'=>60931, 'discount'=>1),
array('id'=>8858, 'discount'=>1),
array('id'=>8386, 'discount'=>1),
array('id'=>8502, 'discount'=>1),
array('id'=>8426, 'discount'=>1),
array('id'=>7799, 'discount'=>1),
array('id'=>7932, 'discount'=>1),
array('id'=>67413, 'discount'=>1),
array('id'=>7952, 'discount'=>1),
array('id'=>60907, 'discount'=>1),
array('id'=>8356, 'discount'=>1),
array('id'=>75688, 'discount'=>1),
array('id'=>67906, 'discount'=>1),
array('id'=>60925, 'discount'=>1),
array('id'=>8151, 'discount'=>1),
array('id'=>69015, 'discount'=>1),
array('id'=>7893, 'discount'=>1),
array('id'=>67424, 'discount'=>1),
array('id'=>89560, 'discount'=>1),
array('id'=>8848, 'discount'=>1),
array('id'=>7871, 'discount'=>1),
array('id'=>8596, 'discount'=>1),
array('id'=>69970, 'discount'=>1),
array('id'=>7595, 'discount'=>1),
array('id'=>8040, 'discount'=>1),
array('id'=>8165, 'discount'=>1),
array('id'=>8856, 'discount'=>1),
array('id'=>8798, 'discount'=>1),


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
	$table .=	"</tr>";
	
	foreach ($sale_books as $i => $book)
	{
		$table .=	"<tr>";
		$res = CIBlockElement::GetByID($book[id]);
		$price = substr(CPrice::GetBasePrice($book[id])['PRICE'],0,-3);
		if($ar_res = $res->GetNext()) {
			$table .=	"<td>".$i."</td>";
			$table .=	"<td>".$ar_res['NAME']."</td>";
			$table .=	"<td>".$book[discount]."</td>";
			$table .=	"<td>".$price."</td>";
			$table .=	"<td>".($price*(100-$book[discount])/100)."</td>";
			$table .=	"<td>".($price*$book[discount]/100)."</td>";
			$table .=	"<td>".$ar_res['DETAIL_PAGE_URL']."</td>";
			$table .=	"<td>".CFile::ResizeImageGet($ar_res[DETAIL_PICTURE], array("width" => 140, "height" => 270), BX_RESIZE_IMAGE_PROPORTIONAL, true)[src]."</td>";
			$table .=	"<td>".$book[id]."</td>";
		}
		$table .=	"</tr>";
	}
	
	$table .= "</tbody></table>";
	echo $table;
} 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>