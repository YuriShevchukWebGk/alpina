<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){
	
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
	}
	
	arsort($books);
	$table = '<h3>Новые книги</h3><table width="800" border="1"><tbody>';
	foreach($books as $book) {
		$table .= '<tr>';
		$table .= '<td>'.$book['n'].'</td>';
		$table .= '<td>'.$book['q'].'</td>';
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
	}
	arsort($books);
	$table = '<br /><br /><h3>Переиздания</h3><table width="800" border="1"><tbody>';
	foreach($books as $book) {
		$table .= '<tr>';
		$table .= '<td>'.$book['n'].'</td>';
		$table .= '<td>'.$book['q'].'</td>';
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
	}
	arsort($books);
	$table = '<br /><br /><h3>Нет в наличии</h3><table width="800" border="1"><tbody>';
	foreach($books as $book) {
		$table .= '<tr>';
		$table .= '<td>'.$book['n'].'</td>';
		$table .= '<td>'.$book['q'].'</td>';
		$table .= '</tr>';
	}
	$table .= '</tbody></table>';
	echo $table;
	
	
} 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>