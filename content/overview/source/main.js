$(document).ready(function(){
t744_init('38167909');
$(".certificate_popup_close").click(function(){
	$(".certificate_popup").hide();
	$('.layout').hide();
})
});
function place_order(){
	var form_valid = true;
	var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
	// просматриваем все поля на предмет заполненности
	$(".active_certificate_block input").each(function(){
		if (!$(this).val()) {
			form_valid = false;
			$(this).css("border-color", "red");
		} else {
			if ($(this).attr("name") == 'legal_email') {
				if (!(pattern.test($(this).val()))) {
					form_valid = false;
					$(this).css("border-color", "red");
				} else {
					$(this).css("border-color", "#f0f0f0");
				}
			}
			$(this).css("border-color", "#ddd");
		}
	});
	// если все ок, то сабмитим
	if (form_valid) {
		var natural_person_email = $("#natural_email").val();
		var natural_person_name = $("#natural_name").val();
		var natural_person_phone = $("#natural_phone").val();
		var price = parseInt($(".js-product-price").text());
		alert(price);
		$.ajax({
			url: '/ajax/ajax_create_overview_print_order.php',
			type: "POST",
			data: {
				data: $("#certificate_form").serialize(),
				print_price: price,
				print_name: $(".js-product-name").text(),
				print_format: $(".format").text(),
				print_type: $(".print-type option:selected").text(),
				print_size: $(".format-options option:selected").text(),
				buyer_phone: natural_person_phone
			}
		}).done(function(result) {
			var certificate_result = JSON.parse(result);
			if (certificate_result.status == "success") {
				order_id = certificate_result.data;
				$("#certificate_form").remove();
				var success_message = "Заказ успешно оформлен.";
				$(".submit_rfi").attr("data-email", natural_person_email);
				$(".submit_rfi").attr("data-comment", "PRINT_" + order_id);
				$(".submit_rfi").attr("data-orderid", "PRINT_" + order_id);
				$(".submit_rfi").attr("data-cost", price);
				$(".submit_rfi").click();
				$("<span>" + success_message.replace("#NUM#", order_id) + "</span>").insertBefore(".certificate_popup_close");
				$(".certificate_popup_close").click();
				$('html, body').animate({ scrollTop: $("body").offset().top }, 1000);
			} else {
				console.error(certificate_result.data);
			}
		});
	}
}

function buy(id,name,description,place,ratio) {
	$(".js-product-name").text(name);
	$(".js-product-sku").text(place);
	$(".t744__descr").text(description);
	$(".format").text("Формат "+ratio);
	$(".js-product-price").text("");
	$("div[data-slide-index='1'] .t-bgimg").data("original","img/_"+id+".jpg").css("background-image","url(img/_"+id+".jpg)");
	$("div[data-slide-index='2'] .t-bgimg").data("original","img/_"+id+"_1.jpg").css("background-image","url(img/_"+id+"_1.jpg)");
	$("div[data-slide-index='3'] .t-bgimg").data("original","img/_"+id+"_2.jpg").css("background-image","url(img/_"+id+"_2.jpg)");
	$("div[data-slide-index='3'] .t-bgimg").empty();
	
	switch (ratio) {
		case "1:1":
			format = "<option value='30x30см' data-product-variant-price='675 ₽'>30x30см</option><option value='60x60см'  data-product-variant-price='2600 ₽'>60x60см</option><option value='90x90см' data-product-variant-price='4750 ₽'>90x90см</option>";
			break;
		case "1:2":
			format = "<option value='30x60см' data-product-variant-price='1450 ₽'>30x60см</option><option value='45x90см'  data-product-variant-price='3000 ₽'>45x90см</option><option value='60x120см' data-product-variant-price='4500 ₽'>60x120см</option>";
			break;
		case "2:3":
			format = "<option value='30x45см' data-product-variant-price='1125 ₽'>30x45см</option><option value='60x90см'  data-product-variant-price='3500 ₽'>60x90см</option><option value='90x135см' data-product-variant-price='6250 ₽'>90x135см</option>";
			break;
		case "4:5":
			format = "<option value='40x50см' data-product-variant-price='2000 ₽'>40x50см</option><option value='60x75см'  data-product-variant-price='3250 ₽'>60x75см</option><option value='80x100см' data-product-variant-price='4625 ₽'>80x100см</option>";
			break;
		case "3:5":
			format = "<option value='30x50см' data-product-variant-price='1187 ₽'>30x50см</option><option value='60x100см'  data-product-variant-price='4000 ₽'>60x100см</option>";
			break;
		default:
			format = "Saturday";
			break;
	}

	$(".format-options").html("<option value=''>Выберите размер</option>"+format);
	$(".t744").slideDown();
	$('html, body').animate({ scrollTop: $("#rec38167909").offset().top }, 1000);
}

$(".print-type").change(function() {
	var printtype = $(".print-type option:selected").text();
	var ratio = $(".format").text().slice(-3);

	switch(printtype) {
		case "Постер":
			switch (ratio) {
				case "1:1":
					format = "<option value='30x30см' data-product-variant-price='675 ₽'>30x30см</option><option value='60x60см'  data-product-variant-price='2600 ₽'>60x60см</option><option value='90x90см' data-product-variant-price='4750 ₽'>90x90см</option>";
					break;
				case "1:2":
					format = "<option value='30x60см' data-product-variant-price='1450 ₽'>30x60см</option><option value='45x90см'  data-product-variant-price='3000 ₽'>45x90см</option><option value='60x120см' data-product-variant-price='4500 ₽'>60x120см</option>";
					break;
				case "2:3":
					format = "<option value='30x45см' data-product-variant-price='1125 ₽'>30x45см</option><option value='60x90см'  data-product-variant-price='3500 ₽'>60x90см</option><option value='90x135см' data-product-variant-price='6250 ₽'>90x135см</option>";
					break;
				case "4:5":
					format = "<option value='40x50см' data-product-variant-price='2000 ₽'>40x50см</option><option value='60x75см'  data-product-variant-price='3250 ₽'>60x75см</option><option value='80x100см' data-product-variant-price='4625 ₽'>80x100см</option>";
					break;
				case "3:5":
					format = "<option value='30x50см' data-product-variant-price='1187 ₽'>30x50см</option><option value='60x100см'  data-product-variant-price='4000 ₽'>60x100см</option>";
					break;
				default:
					format = "Saturday";
					break;
			}
			break;
		case "Холст":
			switch (ratio) {
				case "1:1":
					format = "<option value='30х30см' data-product-variant-price='1252 ₽'>30х30см</option><option value='60х60см'  data-product-variant-price='8375 ₽'>60х60см</option><option value='90х90см' data-product-variant-price='14250 ₽'>90х90см</option>";
					break;
				case "1:2":
					format = "<option value='30х60см' data-product-variant-price='6000 ₽'>30х60см</option><option value='45х90см'  data-product-variant-price='9250 ₽'>45х90см</option><option value='60х120см' data-product-variant-price='16250 ₽'>60х120см</option>";
					break;
				case "2:3":
					format = "<option value='30х45см' data-product-variant-price='3500 ₽'>30х45см</option><option value='60х90см'  data-product-variant-price='11400 ₽'>60х90см</option><option value='90х135см' data-product-variant-price='15500 ₽'>90х135см</option>";
					break;
				case "4:5":
					format = "<option value='40х50см' data-product-variant-price='4750 ₽'>40х50см</option><option value='60х75см'  data-product-variant-price='12250 ₽'>60х75см</option><option value='80х100см' data-product-variant-price='19500 ₽'>80х100см</option>";
					break;
				case "3:5":
					format = "<option value='30х50см' data-product-variant-price='3625 ₽'>30х50см</option><option value='60х100см'  data-product-variant-price='8750 ₽'>60х100см</option>";
					break;
				default:
					format = "Saturday";
					break;
			}
			break;
		case "Пластификация":
			switch (ratio) {
				case "1:1":
					format = "<option value='30х30см' data-product-variant-price='5500 ₽'>30х30см</option><option value='60х60см'  data-product-variant-price='16500 ₽'>60х60см</option><option value='90х90см' data-product-variant-price='38500 ₽'>90х90см</option>";
					break;
				case "1:2":
					format = "<option value='30х60см' data-product-variant-price='10750 ₽'>30х60см</option><option value='45х90см'  data-product-variant-price='17500 ₽'>45х90см</option><option value='60х120см' data-product-variant-price='31250 ₽'>60х120см</option>";
					break;
				case "2:3":
					format = "<option value='30х45см' data-product-variant-price='4500 ₽'>30х45см</option><option value='60х90см'  data-product-variant-price='22800 ₽'>60х90см</option><option value='90х135см' data-product-variant-price='48500 ₽'>90х135см</option>";
					break;
				case "4:5":
					format = "<option value='40х50см' data-product-variant-price='2000 ₽'>40х50см</option><option value='60х75см'  data-product-variant-price='3250 ₽'>60х75см</option><option value='80х100см' data-product-variant-price='4625 ₽'>80х100см</option>";
					break;
				case "3:5":
					format = "<option value='30х50см' data-product-variant-price='9500 ₽'>30х50см</option><option value='60х100см'  data-product-variant-price='26250 ₽'>60х100см</option>";
					break;
				default:
					format = "Saturday";
					break;
			}
			break;
		default:
			format = "Saturday";
			break;
	}
	
	$(".format-options").html("<option value=''>Выберите размер</option>"+format);
});

function order() {
	$(".certificate_popup").fadeIn();
}