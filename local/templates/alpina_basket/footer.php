		<div class="layout"></div>
		<?if (!$USER->isAuthorized()){?>
			<div class="authorisationWrapper">
				<?$APPLICATION->IncludeComponent(
						"bitrix:system.auth.authorize",
						"auth_popup",
						Array(
							"REGISTER_URL" => "/",
							"PROFILE_URL" => "",
							"SHOW_ERRORS" => "Y"
						),
						false
					);?>
			</div>
		<?}?>
    <?if($_GET["ORDER_ID"]){ ?>
<?
        $dbItemsInOrder = CSaleBasket::GetList(array("ID" => "ASC"), array("ORDER_ID" => $_GET["ORDER_ID"]));
        while ($arItems = $dbItemsInOrder->Fetch()) {
            $rr_item[] = '{id: '.$arItems["ID"].', qnt: '.$arItems["QUANTITY"].', price: '.round($arItems["PRICE"]).'},';
        }
        ?>
        <script type="text/javascript">
            (window["rrApiOnReady"] = window["rrApiOnReady"] || []).push(function() {
                try {
                    rrApi.order({  
                        transaction: "<?=$_GET["ORDER_ID"]?>",
                        items: [
                            <?foreach($rr_item as $item){
                               echo $item; 
                            }?>
                        ]
                    });
                } catch(e) {}
            })
        </script>
    <?} ?>
    </body>

</html>