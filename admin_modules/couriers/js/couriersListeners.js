/*----Different listeners classes----*/	

function OrdersListCourirerListener(){
	
	this.selectedOrderStatus; // --- wat ?
	this.selectedOrdersCount;
	// --- maybe this object and it's functionality will be depricated in next versions
	this.orderObj = new OrderAdmin();
	
	this.init = function(){
		
		// --- listener for 'save' button which will appear if one or more orders checked. 
		
		$('body').on('click',"input[name='apply']",function(e){
			e.preventDefault();
			if($("#form_tbl_sale_order option[value='status_I']").is(":selected")){
				this.orderObj.selectedOrderStatus
				if(this.orderObj.selectedOrderStatus){
					popUp.show();
					cHandler.getCouriersList();
				} else {
					$("#form_tbl_sale_order").unbind("submit").submit();
				}
			} else {
				$("#form_tbl_sale_order").unbind("submit").submit();
			}
		}.bind(this));
		
		 /**
		 * 
		 * Listener for bitrix native counter,when it's change check selected order status.
		 * Only one element can change status to 'I' at the same time.
		 * Listener of this type (DOMSubtreeModified) is needed because bitrix blocks every click or change events on checkpox/inputs.
		 * 
		 * */
		
		$('body').on('DOMSubtreeModified',"#tbl_sale_order_selected_count",function(e){
			this.selectedOrdersCount = parseInt($("#tbl_sale_order_selected_count span").text());
				 /**
				 *
				 * Sorry, but it's only one reliable way to get selected order ID.
				 * After match(/ID=\d+/) we will get object with 0 children string el like 'ID=11111'
				 * After that replace(/\D+/,'') & parseInt will remove all non-digits and force it to int type
				 * 
				 **/
				
				var selectedOrderID = parseInt($(".adm-table-row-active").attr("oncontextmenu").match(/ID=\d+/)[0].replace(/\D+/,''));
				this.orderObj.getSelectedOrderStatus(selectedOrderID);
		}.bind(this))
	}
	
	this.renderExistingCouriers = function(){
		var ordersOnPage = JSON.parse(localStorage.getItem("colorIdMatch"));
		var ordersID = [];
		for(id in ordersOnPage){
			ordersID.push(id);
		}
		ordersID = JSON.stringify(ordersID);
		$.post("/admin_modules/couriers/php/matchCourierAndOrder.php", {
			action: "read",
			first_param:ordersID
		}, function(data) {
			statusCellIndex = parseInt($("td.adm-list-table-cell[title='Сортировка: Статус (просмотр)']").index());
			retData = JSON.parse(data);
			if(retData.status == "success"){
				console.info(retData.msg);
				for(num in retData.existingCouriers){
					if(!$("tr [oncontextmenu*='"+retData.existingCouriers[num].orderID+"']").find(".addedCourier").length){
						document.querySelector("tr [oncontextmenu*='"+retData.existingCouriers[num].orderID+"']").children[statusCellIndex].innerHTML += "<div data-relation-id='"+retData.existingCouriers[num].relationID+"' data-courier-id='"+retData.existingCouriers[num].courierID+"' class='addedCourier'><div class='selectedCourier'>" + retData.existingCouriers[num].courierInfo + "</div><br><div class='changeCourier'>Изменить</div></div>";	
					}
				}	
			} else if(retData.status == "error"){
				console.error(retData.msg);
			}
		});
	}
}

function OrderDetailCourirerListener(){
	
	this.onloadOrderStatus;
	
	this.init = function(){
		$('body').on('click',"#editStatusDIV .adm-btn",function(e){
			e.preventDefault();
			if(document.querySelector("#allow_delivery_name").innerText.match(/Курьер/) && $("#STATUS_ID option:selected").val() == 'I'){
				$(".changeCourier").addClass("changeInProgress");
				popUp.show();
				cHandler.getCouriersList();
			}
		}.bind(this))
	}
	
	this.renderExistingCouriers = function(){
		var orderID = $("#tr_order_id").next().children(".adm-detail-content-cell-r").text();
		var ordersID = [];
		ordersID.push(orderID);
		ordersID = JSON.stringify(ordersID);
		$.post("/admin_modules/couriers/php/matchCourierAndOrder.php", {
			action: "read",
			first_param:ordersID
		}, function(data) {
			retData = JSON.parse(data);
			var resultString = "";
			resultString += '<tr class="heading" id="tr_order_courier"><td colspan="2">Курьер</td></tr>';
			var courierDataTemplate = '<tr><td class="adm-detail-content-cell-l" valign="top">Данные курьера:</td><td id="detailPageCourierInfo" valign="middle"><%=current_courier%></td></tr>';
			var courierButtonTemplate = '<tr id="order_detail_courier" style="display:table-row"><td>&nbsp;</td><td valign="middle" data-relation-id="<%=rel_id%>" data-courier-id="<%=cour_id%>" class="btn_order"><a title="<%=button_text%>" onClick="" class="changeCourier adm-btn adm-btn-green" href="javascript:void(0);"><%=button_text%></a></td></tr>'
			if(retData.status == "success"){
				console.info(retData.msg);
				resultString += courierDataTemplate.replace("<%=current_courier%>",retData.existingCouriers[0].courierInfo);
				resultString += courierButtonTemplate.replace(/<%=button_text%>/g,"Изменить").replace(/<%=cour_id%>/g,retData.existingCouriers[0].courierID).replace(/<%=rel_id%>/g,retData.existingCouriers[0].relationID);
			} else if(retData.status == "error"){
				console.error(retData.msg);
				resultString += courierDataTemplate.replace("<%=current_courier%>","Нет прикрепленного курьера.");
				resultString += courierButtonTemplate.replace(/<%=button_text%>/g,"Добавить").replace(/<%=cour_id%>/g,"").replace(/<%=rel_id%>/g,"");;
			}
			$(resultString).insertBefore("#tr_order_payment");
		});
	}
}