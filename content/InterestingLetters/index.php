<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Интересные письма от Альпины");
?>
<style>
.giftWrap input[type=button]{top:26px}
</style>
<div class="deliveryPageTitleWrap">
	<div class="centerWrapper">
		<p>Главная</p>
		<h1>Интересные письма от Альпины</h1>
	</div>
</div>
<div class="howToBodyWrap">
    <div class="centerWrapper" style="padding:40px 0;">
		<div class="giftWrapBlock">
			<div class="giftWrap">
				<form action="/" method="post">
					<input type="text" placeholder="Ваш e-mail" name="email" onkeypress="if (event.keyCode == 13) {return SubmitRequest(event);}">
					<input type="button" value="">
				</form>
				<div class="some_info">
					Заявка на подписку принята, ждите информацию на почту
				</div>
				<p class="title">
					Книга в подарок
				</p>
				<p>
					Подпишись на рассылку и получи книгу<br />в формате PDF бесплатно
				</p>
			</div>
		</div>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>