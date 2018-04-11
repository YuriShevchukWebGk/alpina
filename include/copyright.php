<span itemprop="author" itemscope itemtype="http://schema.org/Organization">

	<span itemscope itemprop="address" itemtype="http://schema.org/PostalAddress">
		<span itemprop="addressLocality">Москва</span>, <span itemprop="streetAddress">4-я Магистральная улица, д.5, 2 подъезд, 2 этаж</span><br>
		<span itemprop="telephone"><a href="tel:74951200704">+7 (495) 120 07 04</a></span>, <a href="tel:+78005505322">+7 (800) 550 53 22</a> <span itemprop="email"><a href="mailto:shop@alpinabook.ru">shop@alpinabook.ru</a></span>
	</span>	
	<br />
	<link itemprop="url" href="http://<?=$_SERVER['SERVER_NAME']?>"/>
	<meta itemprop="logo" content="http://<?=$_SERVER['SERVER_NAME']?>/img/logo.png"/>
	© 2000-<?=date("Y")?>, <span itemprop="name">ООО «Альпина Паблишер»</span>	
</span>

<a href="#" onclick='$.ajax({
	type: "POST",
	url: "/ajax/contact.php",
	data: {contact: "1"}
}).done(function(strResult) {
	$("#ajaxBlock").append(strResult);
	$("body").css("overflow","hidden");
});return false;' style="background:#2a2a2a;color:#fff;padding:10px 25px;font-size:17px;text-decoration:none;border-radius:30px;border:1px solid #888;display:block;margin:20px auto 0;width:225px;height:25px" class="contactUs">Письмо издательству</a>
