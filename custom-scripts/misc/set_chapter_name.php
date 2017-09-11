<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){
$chapters = array(
array('id'=>117259, 'chapter'=>'Случайный секс'),
array('id'=>362924, 'chapter'=>'Океаны и атмосфера '),
array('id'=>358214, 'chapter'=>'Когда команды не могут принять решение'),
array('id'=>8666, 'chapter'=>'О том, как Федя с Васей порядок наводили '),
array('id'=>7704, 'chapter'=>'IQ черным по белому'),
array('id'=>117261, 'chapter'=>'Утолите свой голод'),
array('id'=>368052, 'chapter'=>'Военные трофеи'),
array('id'=>358183, 'chapter'=>'Поверхность и текстура'),
array('id'=>364461, 'chapter'=>'Настрой (будьте готовы побеждать в 10 раундах)'),
array('id'=>6305, 'chapter'=>'Будущее космических путешествий к звездам'),
array('id'=>348341, 'chapter'=>'Массовые задачи и алгоритмы'),
array('id'=>7071, 'chapter'=>'Телепатия'),
array('id'=>6930, 'chapter'=>'Основные модели перелома'),
array('id'=>5985, 'chapter'=>'Новый климат'),
array('id'=>67827, 'chapter'=>'Рациональные числа'),
array('id'=>60925, 'chapter'=>'Скрытая травля'),
array('id'=>7454, 'chapter'=>'Развитие компетентности'),
array('id'=>8356, 'chapter'=>'Три совета, как не стать объектом полицейской проверки'),
array('id'=>112327, 'chapter'=>'Этой штукой кто-нибудь управляет?'),
array('id'=>79328, 'chapter'=>'Коммерческая и банковская революции. Как финансировались войны'),
array('id'=>125857, 'chapter'=>'Уничтожение армян'),
array('id'=>82021, 'chapter'=>'Международные облигации'),
array('id'=>7424, 'chapter'=>'Усвоение иностранных слов'),
array('id'=>358203, 'chapter'=>'Наказания учат. Но не тому, что полезно детям'),
array('id'=>8622, 'chapter'=>'Многозадачность и переключение между задачами: человек отвлекающийся'),
array('id'=>5925, 'chapter'=>'Параметрическое оптимальное f при нормальном распределении'),
array('id'=>6009, 'chapter'=>'Стремиться к смыслу'),
array('id'=>7452, 'chapter'=>'Если это поразило ваше воображение, поразит и чужое'),

);

foreach ($chapters as $i => $ch) {
	$arFile = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/custom-scripts/".($i+1).".compressed.pdf");
	$arFile["MODULE_ID"] = "iblock";
	$fid = CFile::SaveFile($arFile, "iblock");
	if (intval($fid) > 0) {
	   $pdf = CFile::MakeFileArray($fid);
	   print_r($pdf);
	}
	
	CIBlockElement::SetPropertyValuesEx($ch['id'], 4, array('glavatitle' => $ch['chapter'], 'glava' => $pdf));
}

}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>