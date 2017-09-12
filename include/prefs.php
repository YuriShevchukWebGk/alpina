<div id="prefsWrap" class="no-mobile">
	<div id="prefs">
		<?$prefs = array(
			array("Удобство","Бесплатные электронные версии к&nbsp;бумажным"),
			array("Доставка","По&nbsp;всему миру, бесплатно от&nbsp;2&nbsp;000 рублей"),
			array("Скидки","Накопительные от&nbsp;10% и&nbsp;выше"),
			array("Бонусы","С&nbsp;каждой покупкой"),
			array("Сотрудники","Мы любим своих клиентов и&nbsp;книги, и&nbsp;это очень заметно")
		);
		?>
		<?foreach($prefs as $pref) {?>
			<div class="pref">
				<div class="pic"></div>
				<div class="title"><?=$pref[1]?></div>
				<div class="descr"><?=$pref[2]?></div>
			</div>
		<?}?>
	</div>
</div>