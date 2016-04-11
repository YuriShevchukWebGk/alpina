function PickpointHandler(result) {
	pp_id = document.getElementById("pp_id");
	pp_id.value = result["id"];
	pp_address = document.getElementById("pp_address");
	pp_address.value = result["address"];
	pp_name = document.getElementById("pp_name");
	pp_name.value = result["name"];
	pp_zone = document.getElementById("pp_zone");
	pp_zone.value = result["zone"];
	pp_coeff = document.getElementById("pp_coeff");
	pp_coeff.value = result["coeff"];
	Span = document.getElementById("sPPDelivery");
	Span.innerHTML = result['address'] + "<br/>" + result['name'];
	document.getElementById('tPP').style.display = 'block';
	submitForm();
}

function listen(evnt, elem, func) {
	if (elem.addEventListener) { // W3C DOM
		elem.addEventListener(evnt, func, false);
	} else if (elem.attachEvent) { // IE DOM
		return elem.attachEvent("on" + evnt, func);;
	} else {
		return false;
	}
}

function findParentNode(parentName, childObj) {
	var testObj = childObj.parentElement;

	while(testObj) {
		if(testObj.childNodes[1].getAttribute('name') == parentName) {
			return testObj.childNodes[1]
		} else {
			testObj = testObj.parentElement;
		}
	}

	return false;
}

function CheckData() {
	var Form = Table = document.getElementById('tPP');
	if (Form) {
		while (Form = Form.parentNode) {
			if (Form.tagName == "FORM") {
				break;
			}
		}
		if (Form && Form.tagName == "FORM") {
			arInputs = Form.getElementsByTagName("input");
			for (i = 0; i < arInputs.length; i++) {
				switch (arInputs[i].type) {
					case "button":
						if (arInputs[i].getAttribute("onclick")) {
							str = arInputs[i].getAttribute("onclick").toString();
							arMatch = (str.match(/submitForm\('(\S+)'\);/));

							if (arMatch && arMatch[1] == "Y") {
								sLoad = arMatch[0];
								arInputs[i].onclick = function () {
									return PPFormSubmit(sLoad)
								};
							}
						}
						break;
					case "submit":
						if (arInputs[i].name == "contButton") {
							arInputs[i].onclick = function () {
								return PPFormSubmit()
							};
						}
						break;
				}
			}

			arHref = Form.getElementsByTagName("a");
			for (i = 0; i < arHref.length; i++) {
				if (arHref[i].getAttribute("onclick")) {
					str = arHref[i].getAttribute("onclick").toString();
					arMatch = (str.match(/submitForm\('(\S+)'\);/));

					if (arMatch && arMatch[1] == "Y") {
						sLoad = arMatch[0];
						arHref[i].onclick = function () {
							return PPFormSubmit(sLoad)
						};
					}
				}
			}
		}
	}

	window.setTimeout(
		function () {
			return CheckData();
		}, 500
	);
}

function PPFormSubmit(sLoad) {
	if (document.getElementById('tPP') && pickPointDeliveryId !== null && pickPointDeliveryId.length > 0) {
		var allInputs = document.getElementsByTagName("input"),
				isPickpointSelected = false;

		for (var x = 0; x < allInputs.length; x++) {
			if(allInputs[x].name === 'DELIVERY_ID' && allInputs[x].value === pickPointDeliveryId
					&& allInputs[x].checked === true) {
				isPickpointSelected = true;
			}
		}

		if(isPickpointSelected) {
			bSuccess = true;
			sMessage = "";
			iErrNum = 1;
			pp_id = document.getElementById("pp_id");
			if (!pp_id.value) {
				bSuccess = false;
				sMessage += iErrNum + ") Не выбрана точка доставки\n";
				iErrNum++;
			}

			pp_sms_phone = document.getElementById("pp_sms_phone");
			if (!pp_sms_phone.value.match(/\+7[0-9]{10}$/)) {
				bSuccess = false;
				sMessage += iErrNum + ") Номер телефона должен быть заполнен в виде +79160000000";
			}

			if (bSuccess) {
				if (sLoad) {
					eval(sLoad);
				}
			} else {
				alert(sMessage);
			}

			return bSuccess;
		}
	} else {
		return true;
	}

	if (sLoad) {
		eval(sLoad)
	}

	return true;
}

window.onload = function () {
	CheckData();
};