function popUp() {

	/*
	 *
	 * Singleton
	 * 
	 * @var DOM object this.selfWrapper --- pointer to popup container
	 *
	 * */

	this.selfWrapper;

	/**
	 *
	 * Protected
	 *
	 * */

	this.__construct = function() {
		var popUpWrapper = document.createElement("div");
		popUpWrapper.id = "cur_popup";
		var closeCross = document.createElement("div");
		closeCross.id = "cur_popup_close";
		closeCross.onclick = function() {
			this.selfWrapper.classList.toggle("cur_popup_visible");
			cHandler.CRUDController();
		}.bind(this);
		popUpWrapper.appendChild(closeCross);
		var contentContainer = document.createElement("div");
		contentContainer.id = "popupContentContainer";
		popUpWrapper.appendChild(contentContainer);
		document.querySelector("body").appendChild(popUpWrapper);
		// --- Save pointer to popup container
		this.selfWrapper = popUpWrapper;
	}
	/**
	 *
	 * Entrance point
	 *
	 * */

	this.show = function() {
		if (!this.selfWrapper) {
			this.__construct();
		}
		this.selfWrapper.style.top = (parseInt(window.scrollY) - 200) + "px";
		this.selfWrapper.classList.toggle("cur_popup_visible");
	}
}
