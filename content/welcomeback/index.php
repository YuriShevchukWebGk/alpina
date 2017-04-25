<?
if (empty($_REQUEST["uniback"])) {
	header("Location: http://www.alpinabook.ru/");
	exit();
}
	
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Спасибо, что решили остаться с нами!");
$APPLICATION->SetPageProperty("description", "Спасибо, что решили остаться с нами!");
$APPLICATION->SetTitle("Спасибо, что решили остаться с нами!");
?>
<div class="deliveryPageTitleWrap">
	<div class="centerWrapper">
		<p>
			
		</p>
		<h1>Спасибо, что решили остаться с нами!</h1>
	</div>
</div>
<style>
ul {
	list-style-type: none;
}
.deliveryBody, .deliveryBodyWrap {
	background-color:#fff;
}

</style>
<div class="deliveryBodyWrap" style="padding: 50px 0;">
	<div class="centerWrapper">
		<div class="deliveryTypeWrap">
			Ваш адрес <i><?=$_REQUEST["uniback"]?></i> снова подписан на рассылку!
			
			<br />
			<br />Мы сделаем все, чтобы каждое письмо радовало вас. Приятного чтения!

<br /><br /><em><img alt="Разумовская Татьяна" src="https://cp.unisender.com/ru/user_file?resource=images&user_id=1381370&name=authors/razum.jpg" style="width: 120px; height: 100px;" /><br />
			Руководитель интернет-магазина,<br />
			Разумовская Татьяна</em>
			
<?	function subscribeTest($mail) {
		$arSelect = Array("ID");
		$arFilter = Array("IBLOCK_ID" => 41,"ACTIVE" => "Y","NAME" => 'Unisender '.$mail);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 9999), $arSelect);
		
		if($ob = $res -> GetNextElement()) { //
			
		} else {	
			$el = new CIBlockElement;
			$PROP = array();
			$PROP[385] = '1';  // --- book id
			$PROP[386] = $mail; // --- subscriber E-mail
			$PROP[387] = 'Welcome back Unisender';  // --- subscription description
			$PROP[388] = "3"; // --- subscription id		
			
			$arLoadProductArray = Array(
			  "MODIFIED_BY"    => 15, 
			  "IBLOCK_SECTION_ID" => false,         
			  "IBLOCK_ID"      => 41,
			  "PROPERTY_VALUES"=> $PROP,
			  "NAME"           => 'Unisender '.$mail,
			  "ACTIVE"         => "Y",
			  ); 
			  
			$el->Add($arLoadProductArray);
		}
	}

	subscribeTest($_REQUEST["uniback"]);?>
			
		</div>
	</div>
</div>

</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>