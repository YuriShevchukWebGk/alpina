window.onload = function() {
	RFI.successFunction = function () {
		// если все прошло успешно, то заменим кнопку на надпись об успешной оплате
		$("#rfi_wrapper").html("<p>Заказ успешно оплачен</p>");
	};
	RFI.errorFunction = function (reason) {
		console.log("error");
	};
	RFI.closeFunction = function () {
		console.log("widget_closed");
	};
	RFI.openFunction = function () {
		console.log("widget_opened");
	};
};