<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){
$chapters = array(
array('id'=>341852, 'chapter'=>'Спроектированная Вселенная?'),
array('id'=>344658, 'chapter'=>'Как хранить продукты'),
array('id'=>7629, 'chapter'=>'Основная линия'),
array('id'=>125899, 'chapter'=>'Равновесие утрачено'),
array('id'=>8706, 'chapter'=>'Создающие ценность'),
array('id'=>347961, 'chapter'=>'Обучение на ошибках'),
array('id'=>337790, 'chapter'=>'Правило Байеса. Предсказываем будущее'),
array('id'=>8504, 'chapter'=>'Утренний туалет новорожденного'),
array('id'=>66336, 'chapter'=>'Что делают лучшие менеджеры'),
array('id'=>6437, 'chapter'=>'Побуждающее происшествие'),
array('id'=>6904, 'chapter'=>'Элисон Гопник'),
array('id'=>337777, 'chapter'=>'Как услышать то, что клиенты не говорят'),
array('id'=>6139, 'chapter'=>'Приемы развития воображения'),
array('id'=>5771, 'chapter'=>'Что делает поток создания ценности бережливым?'),
array('id'=>8272, 'chapter'=>'Красота и вы'),
array('id'=>8254, 'chapter'=>'О том, что все кремы с SPF одинаковы'),
array('id'=>5685, 'chapter'=>'Создание и анализ дерева текущей реальности'),
array('id'=>66487, 'chapter'=>'Влияние раннего опыта'),
array('id'=>348264, 'chapter'=>'Поворот в гражданской войне'),
array('id'=>6625, 'chapter'=>'Работа с сильными сторонами'),
array('id'=>8586, 'chapter'=>'Что нужно узнать? '),
array('id'=>66460, 'chapter'=>'Побуждающее происшествие'),
array('id'=>67889, 'chapter'=>'Продавать нельзя дружить'),
array('id'=>76117, 'chapter'=>'Статус'),
array('id'=>67969, 'chapter'=>'За кем последнее слово?'),
array('id'=>7839, 'chapter'=>'Враг в зеркале '),
array('id'=>76106, 'chapter'=>'Разгадка шифра изменения'),
array('id'=>8770, 'chapter'=>'Наивный байесовский классификатор и неописуемая легкость бытия идиотом'),
array('id'=>75252, 'chapter'=>'Совокупляйтесь'),
array('id'=>5857, 'chapter'=>'Цельность в момент выбора'),

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