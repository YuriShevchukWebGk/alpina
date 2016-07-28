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
		Отныне, покупая бумажную книгу «Альпины» на сайте alpina.ru, вы получаете ее в электронном виде совершенно бесплатно!<br /><br />

По этим ссылкам вы можете скачать бесплатные электронные книги — копии тех, которые вы приобрели в бумаге:
<br />
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
<br /><br />
<b>Как это работает?</b><ol>

<li>Установите на телефоне и планшете наше приложение-читалку “Бизнес-книги” (доступна для Android и iOS) и зарегистрируйтесь в нем.</li>
<li>Нажмите на ссылку для скачивания бесплатных электронных книг. </li>
<li>Вы попадете на страницу, где нужно будет ввести ваши логин и пароль от приложения «Бизнес-книги» </li>
<li>Не перепутайте! Именно от приложения «Бизнес-книги», а не от личного кабинета на сайте alpina.ru. Как только вы это сделаете, бесплатные электронные книги автоматически появятся в вашем приложении на телефоне и планшете. Вы найдете их там во вкладке «Мои книги».</li>
</ol>
Теперь вы можете читать свои любимые книги где вам нравится и как вам нравится!
<br /><br />
Важный момент: в редких случаях у нас может не оказаться электронной книги, которую вы купили в бумаге. Тогда мы подарим вам похожую книгу — бестселлер или лучшую новинку на ту же тему.
<br /><br />
Вот что вы купили на нашем сайте в последний раз: 
Книга 1 Обложка, название
Книга 2 Обложка, название
Книга 3 Обложка, название

С помощью ссылки вы сможете скачать бесплатно:
Книга 1
Книга 2
Вместо Книга 3 (Обложка, название), которой нет в приложении “Бизнес-книги”, мы дарим вам Книга 4 (обложка, название)

    </div>
</div>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>