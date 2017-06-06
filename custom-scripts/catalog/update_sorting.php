<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($USER->isAdmin()) {
	CModule::IncludeModule("iblock");
	$categories = array(
		'new',
		'bestsellers',
		'popularscience',
		'personaleffectivenesspracticalskillmanagerialpsychology',
		'popularpsychologyselfdevelopmentpersonaleffectiveness',
		'popularpsychologypersonaleffectiveness',
		'investmentsstock',
		'nonfictionpublishers',
		'knigidlyadetei',
		'policy',
		'marketing',
		'generalmanagment',
		'mustread',
		'business',
		'booksforparents',
		'healthandhealthyfood',
		'hr',
		'fiction',
		'economics',
		'booksforparentsandchildren',
		'projectmanagment',
		'creativityandcreation',
		'gifts',
		'sales',
		'publicismdocumentaryprose',
		'financialaccountinglaw',
		'successstory',
		'financialmanagment',
		'negotiationsbusinesscommunication',
		'artofwriting',
		'selfconfidence',
		'marketingadvertisingpr',
		'startupsinnovativeentrepreneurship',
		'biographiesandmemoirs',
		'healthyogabeauty',
		'startups',
		'timemanagment',
		'leadership',
		'hobbytravelingcars',
		'businessnovels',
		'psychologyphilosophyhistoryofreligion',
		'freedigitalbooks',
		'sale',
		'leanmanufacturingqualitymanagement',
		'economicspoliticssociology',
		'service',
		'giftsandsets',
		'presentationrhetoric',
		'beautyandhistoryoffashion',
		'prezentatsiiritorika',
		'corporategovernance',
		'personalinvestments',
		'financebanks',
		'yoga',
		'law',
		'mergersandacquisitions',
		'startap1',
		'aynrandbooks',
		'coloringbooks',
		'kino',
		'crossbooks',
		'thespaceissoclose',
		'anticrisismanagment',
		'socialenterpenership',
		'podarochnyesertifikaty',
		'investiciy',
		'lastseen',
		'experienceofcompanies',
		'financialmanagmet',
		'naturalsciences',
		'audioknigi',
		'salesservicelogostics',
		'samorazvitie',
		'vyhodestantikrizisnyeknigi',
	);

	foreach ($categories as $key => $category) {
		$arFilter = Array("NAME" => "Трейдинг, финансы");
		$res = CIBlockSection::GetList(Array(), $arFilter);
		if ($ob = $res->GetNext()){
			
			//$arProps = $ob->GetProperties();
			//$arFields = $ob->GetFields();
			echo '<pre>';
			print_r($ob);
			echo '</pre>';
			/*$rsParentSection = CIBlockSection::GetByID($arFields[IBLOCK_SECTION_ID]);
			if ($arParentSection = $rsParentSection->GetNext()) {
				echo $arParentSection[NAME];
			}*/
		}
	}

} else {
	echo "ошибка";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>