<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {
	CModule::IncludeModule("iblock");
	$categories = array(
array('audioknigi', '1'),
array('salesservicelogostics', '1'),
array('samorazvitie', '1'),
array('vyhodestantikrizisnyeknigi', '1'),
array('financialmanagmet', '2'),
array('naturalsciences', '2'),
array('experienceofcompanies', '3'),
array('lastseen', '4'),
array('investiciy', '6'),
array('podarochnyesertifikaty', '283'),
array('socialenterpenership', '299'),
array('anticrisismanagment', '306'),
array('thespaceissoclose', '363'),
array('crossbooks', '405'),
array('kino', '461'),
array('coloringbooks', '470'),
array('aynrandbooks', '506'),
array('startap1', '568'),
array('law', '582'),
array('mergersandacquisitions', '582'),
array('yoga', '723'),
array('financebanks', '751'),
array('personalinvestments', '823'),
array('corporategovernance', '835'),
array('prezentatsiiritorika', '840'),
array('beautyandhistoryoffashion', '856'),
array('giftsandsets', '863'),
array('presentationrhetoric', '863'),
array('service', '950'),
array('economicspoliticssociology', '1044'),
array('leanmanufacturingqualitymanagement', '1086'),
array('freedigitalbooks', '1169'),
array('sale', '1169'),
array('psychologyphilosophyhistoryofreligion', '1180'),
array('businessnovels', '1231'),
array('hobbytravelingcars', '1325'),
array('leadership', '1343'),
array('timemanagment', '1351'),
array('startups', '1355'),
array('healthyogabeauty', '1651'),
array('biographiesandmemoirs', '1683'),
array('startupsinnovativeentrepreneurship', '1687'),
array('marketingadvertisingpr', '1738'),
array('selfconfidence', '1852'),
array('artofwriting', '1863'),
array('negotiationsbusinesscommunication', '1971'),
array('financialmanagment', '1986'),
array('successstory', '2201'),
array('financialaccountinglaw', '2221'),
array('publicismdocumentaryprose', '2265'),
array('sales', '2303'),
array('gifts', '2499'),
array('creativityandcreation', '2542'),
array('projectmanagment', '2608'),
array('booksforparentsandchildren', '2690'),
array('economics', '2727'),
array('fiction', '2903'),
array('hr', '3136'),
array('healthandhealthyfood', '3191'),
array('booksforparents', '3682'),
array('business', '3790'),
array('mustread', '3916'),
array('generalmanagment', '3922'),
array('marketing', '4047'),
array('policy', '4344'),
array('knigidlyadetei', '4942'),
array('nonfictionpublishers', '5324'),
array('investmentsstock', '5420'),
array('popularpsychologypersonaleffectiveness', '6862'),
array('popularpsychologyselfdevelopmentpersonaleffectiveness', '7933'),
array('personaleffectivenesspracticalskillmanagerialpsychology', '8763'),
array('popularscience', '9906'),
array('bestsellers', '14204'),
array('new', '18886'),

	);
	
	$parents = array();
	$children = array();
	
	foreach ($categories as $category) {
		$arFilter = Array("IBLOCK_ID"=>4, "CODE" => $category[0]);
		$res = CIBlockSection::GetList(Array(), $arFilter);
		if ($ob = $res->GetNext()) {
			if ($ob['DEPTH_LEVEL'] == 2) {
				$sort = 100000 - $category[1];

				$arFields = Array(
					"SORT" => $sort,
				);
				
				$bs = new CIBlockSection;
				$res = $bs->Update($ob['ID'], $arFields);
				
				$children[$ob['ID']]['ID'] = $ob['ID'];
				$children[$ob['ID']]['NAME'] = $ob['NAME'];
				$children[$ob['ID']]['SORT'] = $category[1];
				
				echo $ob['NAME'].' '.$ob['ID'].' '.$ob['SORT'].'<br />';
			} else {
			   $arFilter = array('ACTIVE' => 'Y', 'IBLOCK_ID' => $ob['IBLOCK_ID'],'>LEFT_MARGIN' => $ob['LEFT_MARGIN'],'<RIGHT_MARGIN' => $ob['RIGHT_MARGIN'],'>DEPTH_LEVEL' => $ob['DEPTH_LEVEL']);
			   $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
			   
			   while ($arSect = $rsSect->GetNext()) {
				   //echo $ob['NAME'].' '.$arSect['NAME'].'<br />';
				   $parents[$ob['ID']]['ID'] = $ob['ID'];
				   $parents[$ob['ID']]['NAME'] = $ob['NAME'];
				   $parents[$ob['ID']]['SORT'] += $arSect['SORT'];
			   }
			}
		} else {
			echo $category[0].'<br />';
		}
	}
	
	foreach ($parents as $parent) {
		$sort = round(100000 - ($parent['SORT']/100));
		$bs = new CIBlockSection;
		$arFields = Array(
			"SORT" => $sort,
		);
		$res = $bs->Update($parent['ID'], $arFields);
		echo $parent['NAME'].' '.$parent['ID'].' '.$sort.'<br />';
	}
	
	echo array_search(108,$children);
	echo array_search(418,$children,true);
	echo array_search(127,$children,true);
	echo array_search(103,$children,true);
	
	echo '<pre>';
	print_r($children);
	echo '</pre>';
} else {
	echo "ошибка";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>