<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){
	$sale_books = array(
array('id'=>8032, 'discount'=>40),
array('id'=>7932, 'discount'=>40),
array('id'=>8502, 'discount'=>40),
array('id'=>7799, 'discount'=>40),
array('id'=>8584, 'discount'=>40),
array('id'=>8540, 'discount'=>40),
array('id'=>7962, 'discount'=>40),
array('id'=>8478, 'discount'=>40),
array('id'=>8552, 'discount'=>40),
array('id'=>8460, 'discount'=>40),
array('id'=>8464, 'discount'=>40),
array('id'=>7825, 'discount'=>40),
array('id'=>8452, 'discount'=>40),
array('id'=>8342, 'discount'=>40),
array('id'=>7555, 'discount'=>40),
array('id'=>186046, 'discount'=>10),
array('id'=>81365, 'discount'=>10),
array('id'=>6115, 'discount'=>20),
array('id'=>8528, 'discount'=>20),
array('id'=>8194, 'discount'=>20),
array('id'=>5893, 'discount'=>20),
array('id'=>8698, 'discount'=>20),
array('id'=>89045, 'discount'=>30),
array('id'=>8456, 'discount'=>30),
array('id'=>7377, 'discount'=>30),
array('id'=>8818, 'discount'=>30),
array('id'=>70007, 'discount'=>30),
array('id'=>80496, 'discount'=>30),
array('id'=>75968, 'discount'=>30),
array('id'=>68979, 'discount'=>30),
array('id'=>6545, 'discount'=>30),
array('id'=>6001, 'discount'=>30),
array('id'=>85696, 'discount'=>30),
array('id'=>125870, 'discount'=>20),
array('id'=>82852, 'discount'=>20),
array('id'=>92954, 'discount'=>40),
array('id'=>60919, 'discount'=>40),

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
			$table .=	"<td>".CFile::ResizeImageGet($ar_res[DETAIL_PICTURE], array("width" => 360, "height" => 520), BX_RESIZE_IMAGE_PROPORTIONAL, true)[src]."</td>";
			$table .=	"<td>".$book[id]."</td>";
		}
		$table .=	"</tr>";
	}
	
	$table .= "</tbody></table>";
	echo $table;
} 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>