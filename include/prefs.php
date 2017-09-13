<div id="prefsWrap" class="no-mobile">
	<div id="prefs">
		<?$prefs = array(
			array("Удобно","Бесплатные электронные версии к&nbsp;бумажным"),
			array("Быстро","Доставка по&nbsp;всему миру, бесплатно от&nbsp;2&nbsp;000 рублей"),
			array("Выгодно","Накопительные скидки от&nbsp;10% и&nbsp;выше"),
			array("Приятно","Бонусы с&nbsp;каждой покупкой"),
			array("Хочется еще","Мы любим своих клиентов и&nbsp;книги, и&nbsp;это очень заметно")
		);
		?>
		<?foreach($prefs as $pref) {?>
			<div class="pref">
				<div class="pic"></div>
				<div class="title"><?=$pref[0]?></div>
				<div class="descr"><?=$pref[1]?></div>
			</div>
		<?}?>
	</div>
</div>