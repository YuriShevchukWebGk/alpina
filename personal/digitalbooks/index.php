<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Книги в приложении Бизнес-книги");
?>
<?if ($USER->isAdmin()){?>

<div class="deliveryPageTitleWrap">
	<div class="centerWrapper">
		<p></p>
		<h1>Электронные книги в приложении «Бизнес-книги»</h1>
	</div>
</div>
	
<div class="howToBodyWrap">
    <div class="centerWrapper" style="padding:40px 0;line-height:200%">
		<b>Вы можете скачать электронные версии заказанных книг по ссылкам ниже</b><br /><br />
		<?$orderUser = CUser::GetByID($USER->GetID())->Fetch();
		if (!empty($orderUser["UF_TEST"])) {
			$freeBooks = unserialize($orderUser["UF_TEST"]);
			foreach ($freeBooks as $freeBook) {
				if ($freeBook["bookid"] == $freeBook["recid"]) {
					$orderedBook = CIBlockElement::GetByID($freeBook["bookid"])->GetNext();
					echo "<a href='".$freeBook['url']."' target='_blank'>«".$orderedBook['NAME']."»</a><br />";
				} else {
					$orderedBook = CIBlockElement::GetByID($freeBook["bookid"])->GetNext();
					$recBook = CIBlockElement::GetByID($freeBook["recid"])->GetNext();
					echo "<a href='".$freeBook['url']."' target='_blank'>«".$recBook['NAME']."»</a> (рекомендация для заказанной книги «".$orderedBook['NAME']."»)<br />";
				}
			}
		}?>

    </div>
</div>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>