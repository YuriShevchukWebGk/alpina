<div id="ajaxBlock"></div>

<div id="prefsWrap" class="no-mobile">
	<div id="prefs">
		<?$prefs = array(
			array("Удобно","Бесплатные электронные версии к&nbsp;бумажным","/actions/freedigitalbooks/"),
			array("Быстро","Доставка по&nbsp;миру, по&nbsp;России&nbsp;&mdash; бесплатно от&nbsp;2&nbsp;000&nbsp;₽","/content/delivery/"),
			array("Выгодно","Накопительные скидки от&nbsp;10% и&nbsp;выше","/content/discounts/"),
			array("Приятно","Бонусы с&nbsp;каждой покупкой", "/personal/profile/"),
			array("Хочется еще","Мы любим своих клиентов и&nbsp;книги, и&nbsp;это очень заметно","/content/team/")
		);
		?>
		<?foreach($prefs as $pref) {?>
			<a class="pref" href="<?=$pref[2]?>" target="_blank">
				<span class="pic"></span>
				<span class="title"><?=$pref[0]?></span>
				<span class="descr"><?=$pref[1]?></span>
			</a>
		<?}?>
	</div>
</div>