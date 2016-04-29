var cHandler;
var popUp;

/*---Courirer class code----*/

function CourierHandler() {

	 /*
	 * 
	 * @var object this.eventListener
	 * @var DOM object this.selectedCourier
	 * @var int this.statusCellIndex
	 * 
	 * */
	
	this.eventListener;
	this.selectedCourier;

	this.init = function() {
		var path = window.location.pathname;
		if (path.match(/bitrix\/admin\/sale_order_detail.php/)) {// --- order detail page
			this.eventListener = new OrderDetailCourirerListener();
			this.eventListener.init();
			this.eventListener.renderExistingCouriers();
		} else if (path.match(/bitrix\/admin\/sale_order.php/)) {// --- orders list page
			this.eventListener = new OrdersListCourirerListener();
			this.eventListener.init();
			this.statusCellIndex = parseInt($("td.adm-list-table-cell[title='Сортировка: Статус (просмотр)']").index());
			this.eventListener.renderExistingCouriers();
			BX.addCustomEvent('onAjaxSuccessFinish', function() {
				this.eventListener.renderExistingCouriers();
			}.bind(this));
			BX.addCustomEvent('onAjaxSuccess', function() {
				this.eventListener.renderExistingCouriers();
			}.bind(this));
		}
	}

	this.tooManyOrdersSelected = function() {
		var errorMessage = document.createElement("div");
		errorMessage.innerHTML = "Одновременно можно изменить статус не более,чем у одного заказа !";
		errorMessage.classList.add("popup_error_message");
		document.querySelector("#popupContentContainer").innerHTML = "";
		document.querySelector("#popupContentContainer").appendChild(errorMessage);
	}

	this.getCouriersList = function(changeCourierID) {
		this.selectedCourier = "";
		$.post("/admin_modules/couriers/php/getCouriersList.php", {

		}, function(data) {
			if(document.querySelector(".adm-table-row-active div.addedCourier") || changeCourierID){
				var currentCourierID = changeCourierID || document.querySelector(".adm-table-row-active div.addedCourier").dataset.courierId;
				this.__renderCouriersList(data,currentCourierID);
			} else {
				this.__renderCouriersList(data);
			}
			
		}.bind(this));
	}
	
	 /*
	 * 
	 * Protected
	 * 
	 * Creating ul list with avaliable couriers
	 * 
	 * @var json cList
	 * @var bool edit
	 * @return void
	 * 
	 * */

	this.__renderCouriersList = function(cList,courId) {
		var couriers = JSON.parse(cList);
		var couriersListContainer = document.createElement("ul");
		couriersListContainer.id = "couriers_list";
		for (i in couriers) {
			var courier = document.createElement("li");
			courier.innerHTML = couriers[i].NAME + " : " + couriers[i].PHONE;
			courier.dataset.courId = couriers[i].ID;
			if(courId){
				if(parseInt(courId)==parseInt(couriers[i].ID)){
					courier.classList.add("selected_courier");
					this.selectedCourier = courier;
				}
			}
			courier.addEventListener("dblclick", this.__courierListItemClickHandler.bind(this), false);
			couriersListContainer.appendChild(courier);
		}
		document.querySelector("#popupContentContainer").innerHTML = "";
		document.querySelector("#popupContentContainer").appendChild(couriersListContainer);
	}
	
	/*
	 * Protected
	 * 
	 * Check is selected order already has a related courier,is answer yes return it's id to render function
	 *
	 * @return id|void
	 * 
	 * */
	
	this.__isCourierAlreadySelected = function(){
		if(document.querySelector(".adm-table-row-active div.addedCourier").children[0].innerHTML && document.querySelector(".adm-table-row-active div.addedCourier").dataset.courierId){
			return document.querySelector(".adm-table-row-active div.addedCourier").dataset.courierId;
		}
	}
	
	/*
	 * Protected
	 * 
	 * Handle with click on li container with courier info
	 * 
	 * @var MouseEvent object e
	 * @return void
	 * 
	 * */

	this.__courierListItemClickHandler = function(e) {
		// --- sorry,this is realy shitty
		if (this.eventListener instanceof OrderDetailCourirerListener){
			this.__listOnDetailPage(e);
		} else if(this.eventListener instanceof OrdersListCourirerListener){
			this.__listOnListPage(e);
		}
	}
	
	this.__listOnDetailPage = function(e){
		var courierInfoContainer = document.querySelector(".changeInProgress");
		// --- if this line is already checked
		if (this.selectedCourier == e.target) {
			this.selectedCourier.classList.toggle("selected_courier");
			this.selectedCourier = "";
			//courierInfoContainer.parentElement.parentElement.children[this.statusCellIndex].removeChild(courierInfoContainer);
			document.querySelector("#detailPageCourierInfo").innerHTML = "Курьер не выбран.";
			courierInfoContainer.dataset.courierId = "";
			document.getElementById("cur_popup_close").click();
			return false;
		} else if (this.selectedCourier) {
			// --- if line is already checked and user clicked on new line 
			this.selectedCourier.classList.toggle("selected_courier");
		}
		// --- first click or just change line
		this.selectedCourier = e.target;
		this.selectedCourier.classList.toggle("selected_courier");
		
		// --- is courier data container in admin table exists
		if (!courierInfoContainer) {
			// --- create and paste
			document.querySelector("#detailPageCourierInfo").innerHTML = this.selectedCourier.innerHTML;
			courierInfoContainer.dataset.courierId = this.selectedCourier.dataset.courId;
		} else {
			// --- or just paste
			document.querySelector("#detailPageCourierInfo").innerHTML = this.selectedCourier.innerHTML;
			courierInfoContainer.dataset.courierId = this.selectedCourier.dataset.courId;
		}
		
		document.getElementById("cur_popup_close").click();
	}
	
	this.__listOnListPage = function(e){
		var courierInfoContainer = document.querySelector(".changeInProgress") || document.querySelector(".adm-table-row-active div.addedCourier");
		// --- if this line is already checked
		if (this.selectedCourier == e.target) {
			this.selectedCourier.classList.toggle("selected_courier");
			this.selectedCourier = "";
			//courierInfoContainer.parentElement.parentElement.children[this.statusCellIndex].removeChild(courierInfoContainer);
			courierInfoContainer.children[0].innerHTML = "";
			courierInfoContainer.dataset.courierId = "";
			courierInfoContainer.style.display = "none";
			document.getElementById("cur_popup_close").click();
			return false;
		} else if (this.selectedCourier) {
			// --- if line is already checked and user clicked on new line 
			this.selectedCourier.classList.toggle("selected_courier");
		}
		// --- first click or just change line
		this.selectedCourier = e.target;
		this.selectedCourier.classList.toggle("selected_courier");
		
		// --- is courier data container in admin table exists
		if (!courierInfoContainer) {
			// --- create and paste
			document.querySelector(".adm-table-row-active").children[this.statusCellIndex].innerHTML += "<div data-relation-id='' data-courier-id='"+this.selectedCourier.dataset.courId+"' class='addedCourier'><div class='selectedCourier'>" + this.selectedCourier.innerHTML + "</div><br><div class='changeCourier'>Изменить</div></div>";
		} else {
			// --- or just paste
			courierInfoContainer.children[0].innerHTML = this.selectedCourier.innerHTML;
			courierInfoContainer.dataset.courierId = this.selectedCourier.dataset.courId;
			courierInfoContainer.style.display = "block";
		}
		
		document.getElementById("cur_popup_close").click();
	}
	
	this.CRUDController = function(){
		var courierInfoContainer = document.querySelector(".changeInProgress") || document.querySelector(".adm-table-row-active div.addedCourier");
		if(courierInfoContainer){
			// --- control CRUD actions
			var relationId = courierInfoContainer.dataset.relationId;
			
			try{
				var courierId = this.selectedCourier.dataset.courId;
			} catch(e){
				var courierId = "";
			}
			
			actionObject = {};
			
			// --- ok,let's go
			if (!relationId && courierId){
				oID = $("#tr_order_id").next().children(".adm-detail-content-cell-r").text() || parseInt($(".adm-table-row-active").attr("oncontextmenu").match(/ID=\d+/)[0].replace(/\D+/,''));
				// --- create
				actionObject = {
					action: "create",
					first_param: oID,
					second_param: courierId
				}
				
			} else if(relationId && courierId){
				// --- update
				actionObject = {
					action: "update",
					first_param: courierInfoContainer.dataset.relationId,
					second_param: courierId
				}
			} else if(relationId && !courierId){
				// --- delete
				actionObject = {
					action: "delete",
					first_param: courierInfoContainer.dataset.relationId
				}
				try{
					courierInfoContainer.parentElement.parentElement.children[this.statusCellIndex].removeChild(courierInfoContainer);
				} catch(e){
					console.log("Oops,detail page");
				}
			}
			
			$.post("/admin_modules/couriers/php/matchCourierAndOrder.php", actionObject , function(data) {   
				response = JSON.parse(data);
				if(response.status=="success" && response.relationId){
					document.querySelector(".adm-table-row-active div.addedCourier").dataset.relationId = response.relationId;
					console.info(response.msg);
				} else if(response.status=="success"){
					console.info(response.msg);
				} else if(response.status=="error"){
					console.error(response.msg);
				}
				
				if(!$("span.adm-btn-wrap > input[name='apply']").attr("disabled")){
					$("#form_tbl_sale_order").unbind("submit").submit();
				}
			});
			
			$(".changeInProgress").removeClass("changeInProgress");
			
		} else {
			// --- user opened courier window but did nothing
		}
	}
}


$(document).ready(function() {
	cHandler = new CourierHandler();
	cHandler.init();
	popUp = new popUp();
	
	$("body").on("click",".changeCourier",function(){
		popUp.show();
		$(this).parent().addClass("changeInProgress");
		cHandler.getCouriersList($(this).parent().data("courier-id"));
	})
})
