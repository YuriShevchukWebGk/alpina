/*
 *
 * Instance of this class used only on OrdersListCourirerListener
 *
 * */

function OrderAdmin() {

	/*
	 *
	 * @var mixed this.returnedAjaxData
	 * @var char this.selectedOrderStatus
	 * @var array this.availDeliveryID
	 *
	 * */

	this.returnedAjaxData
	this.selectedOrderStatus
	this.availDeliveryID = [2, 8, 9, 10, 11];
}

/**
 *
 * Protected
 *
 * @var int id
 * @return void
 *
 **/

OrderAdmin.prototype.__getOrderParams = function(id) {
	$.post("/admin_modules/couriers/php/getOrderParam.php", {
		id : id
	}, function(data) {
		this.returnedAjaxData = JSON.parse(data);

		if (this.__isOrderCompatible()) {
			this.selectedOrderStatus = this.returnedAjaxData.statusID;
		} else {
			this.selectedOrderStatus = "";
		}
		this.returnedAjaxData = '';
	}.bind(this));
}
/**
 *
 * Protected
 *
 * TODO : decribe behavior
 *
 * @return void
 *
 **/

OrderAdmin.prototype.__isOrderCompatible = function() {
	if (this.availDeliveryID.indexOf(parseInt(this.returnedAjaxData.deliveryID)) != -1 && this.returnedAjaxData.statusID != "I") {
		return true;
	}
}
/**
 *
 * Protected
 *
 * @var int id
 * @return function this.__getOrderParams
 *
 **/

OrderAdmin.prototype.getSelectedOrderStatus = function(id) {
	return this.__getOrderParams(id);
}