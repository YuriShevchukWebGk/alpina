<?
@set_time_limit(0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $USER;

$count = array();
$table = '<table><tbody>';

$unisender = '';

if ($USER->IsAdmin()){
	
	$arSelect = Array("ID", "NAME", "SHOW_COUNTER", "DETAIL_PICTURE", "DETAIL_PAGE_URL", "PREVIEW_TEXT");
	$arFilter = Array("IBLOCK_ID"=>4, "PROPERTY_STATE" => 21);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>100), $arSelect);
	
	while($ob = $res->GetNext()) {
		$count[$ob['ID']]['q'] = 0;
		$count[$ob['ID']]['v'] = $ob['SHOW_COUNTER'];
		$count[$ob['ID']]['n'] = $ob['NAME'];
		$count[$ob['ID']]['u'] = $ob['DETAIL_PAGE_URL'];
		$count[$ob['ID']]['p'] = $ob['PREVIEW_TEXT'];
		
		$rsOrder = CSaleOrder::GetList(array('ID' => 'DESC'), array('BASKET_PRODUCT_ID' => $ob['ID']));
		
		while ($arOrder = $rsOrder->Fetch()) {
			$count[$ob['ID']]['q']++;
		}
		
		$count[$ob['ID']]['f'] = round(($count[$ob['ID']]['q']/$count[$ob['ID']]['v'])*10000);
	}

	function myCmp($a, $b) {
		if ($a['f'] === $b['f']) return 0;
			return $a['f'] < $b['f'] ? 1 : -1;
	}
	
	uasort($count, 'myCmp');
	array_splice($count, 12);
	
	foreach ($count as $i => $book) {
		$table .= '<tr>';
		$table .= '<td><a href="'.$book['u'].'">'.$book['n'].'</a></td><td>'.$book['f'].'</td>';
		$table .= '</tr>';
		
		$unisender .= '<!-- Книга '.($i+1).' --><center><a href="https://www.alpinabook.ru'.$book['u'].'?rr_setemail={{_Email}}" style="text-decoration:none;border-bottom:1px solid #333;"><span style="color:#202020;font-family: Tahoma,Roboto,sans-serif;font-size:24px;font-weight:400;line-height:150%;margin:0px 0px 10px;">'.$book['n'].'</span></a><br />
			<br />
			&nbsp; <a href="https://www.alpinabook.ru'.$book['u'].'?rr_setemail={{_Email}}" target="_blank"><img alt="'.$book['n'].'" src="/ru/user_file?resource=images&amp;user_id=1381370&amp;name=2017.05.25/'.($i+1).'.jpg" style="width:100%;max-width:230px;" /></a></center>
			'.typo(strip_tags($book['p'])).'
			<center><br />
			<a href="https://www.alpinabook.ru'.$book['u'].'?rr_setemail={{_Email}}" style="font-size:18px;font-family:Tahoma,Roboto,sans-serif;line-height:100%;letter-spacing:normal;background-color: #00abb8;border-radius: 35px;color: #fff;margin: 0 28px;padding: 10px 40px;text-decoration:none;" target="_blank">Подробнее о книге</a></center>
			<br />
			<br />';
			
	}
	$table .= '</tbody></table>';
	
	//echo $table;
	echo htmlspecialchars($unisender);
	
} 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>