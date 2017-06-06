<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
//Данные для генерации этикетки              
echo generateAccordPostLabel($_REQUEST['ACCORDPOST_ID']); 