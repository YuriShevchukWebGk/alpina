<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;?>
<style>
a{text-decoration:none;color:#000}a:hover{text-decoration:underline}
</style>
<?
$userGroup = CUser::GetUserGroup($USER->GetID());
if ($USER->isAdmin() || in_array(6,$userGroup)) {
	
	/******************************************************/
	/******************************************************/
	/******************************************************/
	$ids = array();
	$arSelect = Array("ID", "NAME");
	$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE"=>"Y", "PROPERTY_STATE"=>22, "!PROPERTY_reissue"=>218);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>9999), $arSelect);
	while($ob = $res->GetNext())
	{
		$ids[] = $ob["ID"];
	}

	/******************************************************/
	
	$books = array();

	$arSelect = Array("ID", "NAME", "PROPERTY_BOOK_ID");
	$arFilter = Array("IBLOCK_ID"=>41, "ACTIVE"=>"Y", "!NAME"=>"Глава%", "PROPERTY_BOOK_ID"=>$ids);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>9999), $arSelect);
	while($ob = $res->GetNext())
	{
		$books[$ob["PROPERTY_BOOK_ID_VALUE"]]['q']++;
		$books[$ob["PROPERTY_BOOK_ID_VALUE"]]['n'] = $ob["NAME"];
		$books[$ob["PROPERTY_BOOK_ID_VALUE"]]['i'] = $ob["PROPERTY_BOOK_ID_VALUE"];
		$books[$ob["PROPERTY_BOOK_ID_VALUE"]]['d'] = $ob["ID"];
	}
	
	arsort($books);
	$table = '<h3>Новые книги</h3><table width="800" border="1"><tbody><tr><td>Название</td><td>Имэйлов</td><td>Предзаказов</td></tr>';
	foreach($books as $book) {
		$rsOrder = CSaleOrder::GetList(array('ID' => 'DESC'), array('STATUS_ID' => 'PR', 'BASKET_PRODUCT_ID' => $book['i']));
		while ($order = $rsOrder->Fetch()) {
			$book['o']++;
		}
		$table .= '<tr>';
		$table .= '<td><a href="/catalog/temporary/'.$book['i'].'/">'.$book['n'].'</a></td>';
		$table .= '<td>'.$book['q'].'</td>';
		$table .= '<td>'.$book['o'].'</td>';
		$table .= '</tr>';
	}
	$table .= '</tbody></table>';
	echo $table;
	
	/******************************************************/
	/******************************************************/
	/******************************************************/
	$books = array();
	$ids = array();
	$arSelect = Array("ID", "NAME");
	$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE"=>"Y", "PROPERTY_STATE"=>22, "PROPERTY_reissue"=>218);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>9999), $arSelect);
	while($ob = $res->GetNext())
	{
		$ids[] = $ob["ID"];
	}

	/******************************************************/
	
	$books = array();

	$arSelect = Array("ID", "NAME", "PROPERTY_BOOK_ID");
	$arFilter = Array("IBLOCK_ID"=>41, "ACTIVE"=>"Y", "!NAME"=>"Глава%", "PROPERTY_BOOK_ID"=>$ids);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>9999), $arSelect);
	while($ob = $res->GetNext())
	{
		$books[$ob["PROPERTY_BOOK_ID_VALUE"]]['q']++;
		$books[$ob["PROPERTY_BOOK_ID_VALUE"]]['n'] = $ob["NAME"];
		$books[$ob["PROPERTY_BOOK_ID_VALUE"]]['i'] = $ob["PROPERTY_BOOK_ID_VALUE"];
		$books[$ob["PROPERTY_BOOK_ID_VALUE"]]['d'] = $ob["ID"];
	}
	arsort($books);
	$table = '<br /><br /><h3>Переиздания</h3><table width="800" border="1"><tbody>';
	foreach($books as $book) {
		$rsOrder = CSaleOrder::GetList(array('ID' => 'DESC'), array('STATUS_ID' => 'PR', 'BASKET_PRODUCT_ID' => $book['i']));
		while ($order = $rsOrder->Fetch()) {
			$book['o']++;
		}
		$table .= '<tr>';
		$table .= '<td><a href="/catalog/temporary/'.$book['i'].'/">'.$book['n'].'</a></td>';
		$table .= '<td>'.$book['q'].'</td>';
		$table .= '<td>'.$book['o'].'</td>';
		$table .= '</tr>';
	}
	$table .= '</tbody></table>';
	echo $table;
	
	/******************************************************/
	/******************************************************/
	/******************************************************/
	$books = array();
	$ids = array();
	$arSelect = Array("ID", "NAME");
	$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE"=>"Y", "PROPERTY_STATE"=>23);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>9999), $arSelect);
	while($ob = $res->GetNext())
	{
		$ids[] = $ob["ID"];
	}

	/******************************************************/
	
	$books = array();

	$arSelect = Array("ID", "NAME", "PROPERTY_BOOK_ID");
	$arFilter = Array("IBLOCK_ID"=>41, "ACTIVE"=>"Y", "!NAME"=>"Глава%", "PROPERTY_BOOK_ID"=>$ids);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>9999), $arSelect);
	while($ob = $res->GetNext())
	{
		$books[$ob["PROPERTY_BOOK_ID_VALUE"]]['q']++;
		$books[$ob["PROPERTY_BOOK_ID_VALUE"]]['n'] = $ob["NAME"];
		$books[$ob["PROPERTY_BOOK_ID_VALUE"]]['i'] = $ob["PROPERTY_BOOK_ID_VALUE"];
		$books[$ob["PROPERTY_BOOK_ID_VALUE"]]['d'] = $ob["ID"];
	}
	arsort($books);
	$table = '<br /><br /><h3>Нет в наличии</h3><table width="800" border="1"><tbody>';
	foreach($books as $book) {
		$table .= '<tr>';
		$table .= '<td><a href="/catalog/temporary/'.$book['i'].'/">'.$book['n'].'</a></td>';
		$table .= '<td>'.$book['q'].'</td>';
		$table .= '</tr>';
	}
	$table .= '</tbody></table>';
	echo $table;
	
	
} 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>