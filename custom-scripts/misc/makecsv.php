<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

	CModule::IncludeModule("iblock");
	CModule::IncludeModule("sale");

$ids = array(
8190,
6627
);
$arFilter = Array(
	"IBLOCK_ID"=>4, 
	"ACTIVE"=>"Y",
	//"ID"=>5857
);
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, Array("ID"));

$table = '<table border="1"><tbody><tr>';
$table .='<td style="font-weight:700">Имя</td>';
$table .='<td style="font-weight:700">Описание</td>';
$table .='<td style="font-weight:700">Цена</td>';
$table .='<td style="font-weight:700">Характеристики</td>';
$table .='<td style="font-weight:700">Издательство</td>';
$table .='<td style="font-weight:700">Ссылка</td>';
$table .='<td style="font-weight:700">Состояние</td>';
$table .='<td style="font-weight:700">Изображение</td>';
$table .='<td style="font-weight:700">Авторы</td>';
$table .='<td style="font-weight:700">ISBN</td>';
$table .='</tr>';

while ($book = $res->GetNext())	{
	$book = CCatalogProduct::GetByIDEx($book[ID]);
	$author = CIBlockElement::GetByID($book[PROPERTIES][AUTHORS][VALUE])->GetNext();
	$table .='<tr>';
	$table .='<td>'.$book[NAME].'</td>';
	$table .='<td>'.substr(strip_tags($book[PREVIEW_TEXT]),0,800).'</td>';
	$table .='<td>'.$book[PRICES][11][PRICE].'</td>';
	$table .='<td>Обложка: '.$book[PROPERTIES][COVER_TYPE][VALUE_ENUM].', Страниц: '.$book[PROPERTIES][PAGES][VALUE].', Формат: '.$book[PROPERTIES][COVER_FORMAT][VALUE_ENUM].', Год издания: '.$book[PROPERTIES][YEAR][VALUE].'</td>';
	$table .='<td>'.$book[PROPERTIES][PUBLISHER][VALUE_ENUM].'</td>';
	$table .='<td>https://www.alpinabook.ru'.$book[DETAIL_PAGE_URL].'</td>';
	$table .='<td>'.$book[PROPERTIES][STATE][VALUE_ENUM].'</td>';
	$table .='<td>https://www.alpinabook.ru'.CFile::GetPath($book[DETAIL_PICTURE]).'</td>';
	$table .='<td>'.$author[NAME].'</td>';
	$table .='<td>'.$book[PROPERTIES][ISBN][VALUE].'</td>';
	$table .='</tr>';
	echo '<pre>';
	//print_r($book);
	echo '</pre>';
}
$table .= '</tbody></table>';
echo $table;
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>