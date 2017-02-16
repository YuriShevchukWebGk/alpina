<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="rfi_wrapper">
	<a  class="rfi_button submit_rfi" 
		data-open="widget"
		data-key="<?= $arResult['KEY'] ?>"
		data-cost="<?= $arResult['PRICE'] ?>"
		data-name="<?= $arResult['COMMENT'] ?>"
		data-email="<?= $arResult['EMAIL'] ?>"
		data-phone="<?= $arResult['PHONE'] ?>"
		href="#">
		<?= GetMessage("PAY") ?>
	</a>
</div>