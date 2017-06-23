<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
global $USER;
if ($USER->IsAdmin()){
$chapters = array(
array('id'=>8284, 'chapter'=>'Психологические витамины'),
array('id'=>82375, 'chapter'=>'Простые тактильные игры'),
array('id'=>7750, 'chapter'=>'Укрепите свои связи и авторитет. Как завоевать доверие'),
array('id'=>8246, 'chapter'=>'Маятник фортуны'),
array('id'=>8698, 'chapter'=>'Кейс из телеящика – доктор Хаус, беги!'),
array('id'=>8394, 'chapter'=>'Мои любимые пельмешки'),
array('id'=>344193, 'chapter'=>'Оставь пространство для чуда, или 40/60'),
array('id'=>186020, 'chapter'=>'Принятие решений: Совершенствуем процесс'),
array('id'=>8616, 'chapter'=>'Психология навязчивых состояний'),
array('id'=>7008, 'chapter'=>'Сопротивление и одиночество'),
array('id'=>80697, 'chapter'=>'Ешь правильные бутерброды'),
array('id'=>68989, 'chapter'=>'Геометрия на спичках'),
array('id'=>7331, 'chapter'=>'Деловая коммуникация'),
array('id'=>5833, 'chapter'=>'Магическая сила призыва'),
array('id'=>6339, 'chapter'=>'Глава VI'),
array('id'=>8850, 'chapter'=>'Как работает биржа ставок'),
array('id'=>8514, 'chapter'=>'Предстаньте в лучшем свете'),
array('id'=>8548, 'chapter'=>'Достижение национального конкурентного преимущества в сфере услуг'),
array('id'=>8141, 'chapter'=>'Сладкий аромат успеха:  влияние вкуса и запаха на наш разум и тело'),
array('id'=>7436, 'chapter'=>'Оценка и отражение в отчетности финансового положения компании'),
array('id'=>188808, 'chapter'=>'Самая опасная картина мира'),
array('id'=>6375, 'chapter'=>'Шоппинг ради акций'),
array('id'=>8464, 'chapter'=>'Новое воспитание'),
array('id'=>337784, 'chapter'=>'Покорение Севера'),
array('id'=>8046, 'chapter'=>'Самоисполняющиеся пророчества'),
array('id'=>7726, 'chapter'=>'Раскрутка видео чужими руками'),
array('id'=>7899, 'chapter'=>'Понедельник 29. Визуализируем свой успех'),
array('id'=>7248, 'chapter'=>'Путь наверх'),
array('id'=>6889, 'chapter'=>'Управление эффективностью, или Счастье как цель'),
array('id'=>8832, 'chapter'=>'Построение графиков опционов'),
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