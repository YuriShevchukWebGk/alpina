<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Книги в приложении Бизнес-книги");
?>
<p class="personal_title"><?$APPLICATION->ShowTitle();?></p>

<div>
<?if ($USER->isAdmin()){?>
<?$orderUser = CUser::GetByID($USER->GetID())->Fetch();
if (!empty($orderUser["UF_TEST"])) {
	$freeBooks = unserialize($orderUser["UF_TEST"]);
	foreach ($freeBooks as $freeBook) {
		echo $freeBook["url"]." ".$freeBook["bookid"]."<br />";
	}
}?>




<?}?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>