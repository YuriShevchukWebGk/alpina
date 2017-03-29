<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){
	$sale_books = array(
		array('id'=>8019, 'discount' =>30),
		array('id'=>7365, 'discount' =>30),
		array('id'=>7589, 'discount' =>30),
		array('id'=>7823, 'discount' =>30),
		array('id'=>7887, 'discount' =>40),
		array('id'=>8668, 'discount' =>30),
		array('id'=>7889, 'discount' =>40),
		array('id'=>8222, 'discount' =>40),
		array('id'=>8274, 'discount' =>40),
		array('id'=>7579, 'discount' =>40),
		array('id'=>7817, 'discount' =>40),
		array('id'=>8578, 'discount' =>40),
		array('id'=>66543, 'discount' =>30),
		array('id'=>8860, 'discount' =>40),
		array('id'=>80508, 'discount' =>40),
		array('id'=>8624, 'discount' =>40),
		array('id'=>8000, 'discount' =>40),
		array('id'=>115583, 'discount' =>30),
		array('id'=>68998, 'discount' =>30),
		array('id'=>80512, 'discount' =>40),
		array('id'=>5769, 'discount' =>40),
		array('id'=>93327, 'discount' =>40),
		array('id'=>7942, 'discount' =>40),
		array('id'=>82276, 'discount' =>30),
		array('id'=>7835, 'discount' =>30),
		array('id'=>60919, 'discount' =>40),
		array('id'=>124359, 'discount' =>30),
		array('id'=>81365, 'discount' =>30),
		array('id'=>84627, 'discount' =>30),
		array('id'=>95670, 'discount' =>30),
		array('id'=>67409, 'discount' =>30),
		array('id'=>115679, 'discount' =>30),
		array('id'=>82845, 'discount' =>30),
		array('id'=>89055, 'discount' =>30),
		array('id'=>7377, 'discount' =>30),
		
		array('id'=>80496, 'discount' =>30),
		array('id'=>6115, 'discount' =>30),
		array('id'=>89051, 'discount' =>30),
		array('id'=>85679, 'discount' =>30),
		array('id'=>90639, 'discount' =>30),
		array('id'=>78987, 'discount' =>30),
		array('id'=>75968, 'discount' =>30),
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