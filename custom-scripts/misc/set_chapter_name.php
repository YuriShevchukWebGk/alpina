<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){
$chapters = array(
array('id'=>7409, 'chapter'=>'Самое противное дело'),
array('id'=>7641, 'chapter'=>'Приключения сэра Ланселота Озерного'),
array('id'=>5563, 'chapter'=>'Психологические индикаторы'),
array('id'=>7685, 'chapter'=>'Ставка дисконтирования'),
array('id'=>60899, 'chapter'=>'Введение в CBOK'),
array('id'=>75436, 'chapter'=>'Магия последовательности Фибоначчи'),
array('id'=>7377, 'chapter'=>'Лидерство как дутая ценность'),
array('id'=>5919, 'chapter'=>'Налоговая стратегия'),
array('id'=>8131, 'chapter'=>'Практика избавления от иллюзий'),
array('id'=>8650, 'chapter'=>'Крупы и овощи'),
array('id'=>7351, 'chapter'=>'Думайте в духе "Выиграл/Выиграл"'),
array('id'=>8440, 'chapter'=>'Тьма просвещает'),
array('id'=>8542, 'chapter'=>'Благотворительность'),
array('id'=>8484, 'chapter'=>'Модели продолжения тенденции'),
array('id'=>8822, 'chapter'=>'Страстные люди. Как их найти?'),
array('id'=>7561, 'chapter'=>'Большой прыжок'),
array('id'=>8008, 'chapter'=>'Практика'),
array('id'=>8083, 'chapter'=>'Конец эпохи зодчего'),
array('id'=>66448, 'chapter'=>'Работать вместе'),
array('id'=>66516, 'chapter'=>'Жизнь на пределе. 1978–1980 '),
array('id'=>6037, 'chapter'=>'Глава 9'),
array('id'=>8322, 'chapter'=>'Привлечение необходимых ресурсов'),
array('id'=>66511, 'chapter'=>'Второй ключ: ставьте правильные цели'),
array('id'=>5641, 'chapter'=>'Мотивация и проекция'),
array('id'=>66506, 'chapter'=>'Стили менеджмента'),
array('id'=>5677, 'chapter'=>'Качество и потребитель'),
array('id'=>5591, 'chapter'=>'Менеджмент кайдзен'),
array('id'=>8280, 'chapter'=>'Коммуникации'),
array('id'=>8852, 'chapter'=>'Квантовая красота I: музыка сфер'),
array('id'=>6027, 'chapter'=>'Правила контроля над риском'),

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