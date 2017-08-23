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
    </body>
</html>