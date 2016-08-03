<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Футблоки");
?>
<div class="searchWrap">
        <div class="catalogWrapper">
            <?$APPLICATION->IncludeComponent("bitrix:search.title", "search_form", 
        Array(
            "CATEGORY_0" => "",    // Ограничение области поиска
            "CATEGORY_0_TITLE" => "",    // Название категории
            "CHECK_DATES" => "N",    // Искать только в активных по дате документах
            "COMPONENT_TEMPLATE" => ".default",
            "CONTAINER_ID" => "title-search",    // ID контейнера, по ширине которого будут выводиться результаты
            "INPUT_ID" => "title-search-input",    // ID строки ввода поискового запроса
            "NUM_CATEGORIES" => "1",    // Количество категорий поиска
            "ORDER" => "date",    // Сортировка результатов
            "PAGE" => "#SITE_DIR#search/index.php",    // Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
            "SHOW_INPUT" => "Y",    // Показывать форму ввода поискового запроса
            "SHOW_OTHERS" => "N",    // Показывать категорию "прочее"
            "TOP_COUNT" => "5",    // Количество результатов в каждой категории
            "USE_LANGUAGE_GUESS" => "Y",    // Включить автоопределение раскладки клавиатуры
        ),
        false
        );?>    
        </div>
</div>
<style>
	.tshirt {
		padding:40px;
		clear:both;
		margin: 20px 10px 40px 10px;
		max-width: 350px;
		display:inline-block;
		background:#fff;
	}
	.tshirt .title {
		font-family: "Walshein_regular";
		font-size: 24px;
		clear:both;
		display:block;
		margin-bottom:40px;
	}
	.tshirt .img {
		width:200px;
		display:inline-block;
		height:100px;
		padding-bottom:20px;
	}
	.tshirt .description {
		max-width:700px;
		display:inline-block;
		height:100px;
	}
	.tshirt .description .price {
		font-size:24px;
		color:#00ABB8;
		display:block;
		padding-top:20px;
		text-align:center;
	}
	.tshirt .button {
		background-color: #00abb8;
		border-radius: 35px;
		color: #fff;
		font-family: "Walshein_regular";
		font-size: 19px;
		padding: 14px 58px;
	}
	
	#order {
		padding:40px;
		background:#fff;
	}
	.signinWrapper input[type=textarea], .signinWrapper select, .signinWrapper input[type=email] {
		background-color: #fbfbfb;
		border: 2px solid #f0f0f0;
		color: #8d8d8d;
		font-family: "Walshein_regular";
		font-size: 20px;
		margin: 0 288px 20px;
		width: 518px;
		padding: 0 20px;
	}	
	.signinWrapper input[type=textarea] {
		height: 54px;
	}
</style>
<?
$price = '990';
?>


    <div class="deliveryPageTitleWrap">

        <div class="centerWrapper">   
            <p></p>
            <h1>Футболки</h1>
        </div>
    </div>

<div class="howToBodyWrap">
	<div class="centerWrapper">	
		<?if ($_POST["USER_NAME"]) {

		$name = $_POST["USER_NAME"];
		$email = $_POST["USER_EMAIL"];
		//$address = $_POST["USER_ADDRESS"];

		$size = $_POST["size"];
		$phone = $_POST["USER_PHONE"];
		$sex = $_POST["sex"];
		$tshirt = $_POST["tshirt"];
		$comments = $_POST["COMMENTS"];

		$subject = "Заказ на футболку";
		$header = "From: \"$email\" <$name>\n";
		$header .= "Content-type: text/plain; charset=\"utf-8\"";
		$to = 'a.marchenkov@alpinabook.ru';
		$message = '';
		$message .= $tshirt."\n";
		$message .= $size."\n";
		$message .= $sex."\n";
		$message .= $phone."\n";
		$message .= $comments."\n";

		mail($to,$subject,$message,$header);?>
		<br />
		Ваш заказ успешно принят!
		<br />
		<?} else {?>


		<div class="tshirt">
			<span class="title">В защиту эгоизма (белая)</span>
			<div class="img"><a href="img/1_ego_ok.jpg" class="fancybox"><img src="img/1_ego_ok_s.jpg" width="350"/></a></div>
			<div class="description">Чистосердечная манифестация здорового эгоизма. Пропаганда в умеренных дозах. Если кто-то будет спрашивать - смело ссылайтесь на Питера Шварца<br />
				<span class="price">
					<?=$price?> руб.
					<br /><br />
					<a href="#form"><span class="button">Заказать</span></a>
				</span>
			</div>
		</div>
		
		<div class="tshirt">
			<span class="title">В защиту эгоизма (серая)</span>
			<div class="img"><a href="img/1_ego_gr.jpg" class="fancybox"><img src="img/1_ego_gr_s.jpg" width="350"/></a></div>
			<div class="description">Чистосердечная манифестация здорового эгоизма. Пропаганда в умеренных дозах. Если кто-то будет спрашивать - смело ссылайтесь на Питера Шварца<br />
				<span class="price">
					<?=$price?> руб.
					<br /><br />
					<a href="#form"><span class="button">Заказать</span></a>
				</span>
			</div>
		</div>
		
		<div class="tshirt">
			<span class="title">Осторожно, спорт (серая)</span>
			<div class="img"><a href="img/3_spo_ok.jpg" class="fancybox"><img src="img/3_spo_ok_s.jpg" width="350"/></a></div>
			<div class="description">В этой футболке можно бегать, прыгать, кататься на велосипеде, заниматься йогой, но только, пожалуйста, будьте осторожнее. Редакция не гарантирует безопасность упражнений, которые вы будете делать, не ознакомившись перед этим с книгой<br />
				<span class="price">
					<?=$price?> руб.
					<br /><br />
					<a href="#form"><span class="button">Заказать</span></a>
				</span>
			</div>
		</div>		
		
		<div class="tshirt">
			<span class="title">Осторожно, спорт (серая)</span>
			<div class="img"><a href="img/3_spo_gr.jpg" class="fancybox"><img src="img/3_spo_gr_s.jpg" width="350"/></a></div>
			<div class="description">В этой футболке можно бегать, прыгать, кататься на велосипеде, заниматься йогой, но только, пожалуйста, будьте осторожнее. Редакция не гарантирует безопасность упражнений, которые вы будете делать, не ознакомившись перед этим с книгой<br />
				<span class="price">
					<?=$price?> руб.
					<br /><br />
					<a href="#form"><span class="button">Заказать</span></a>
				</span>
			</div>
		</div>

		<div class="tshirt">
			<span class="title">Ловушка для внимания (серая)</span>
			<div class="img"><a href="img/2_lov_ok.jpg" class="fancybox"><img src="img/2_lov_ok_s.jpg" width="350"/></a></div>
			<div class="description">Ага, попались! Эта сова никого не оставляет равнодушным. Будьте готовы к повышенному вниманию со стороны окружающих! Если вам интересны его истоки - <a href="/catalog/Marketing/8594/">в книге</a> вы найдёте ответы на все волнующие вопросы. <br />
				<span class="price">
					<?=$price?> руб.
					<br /><br />
					<a href="#form"><span class="button">Заказать</span></a>
				</span>
			</div>
		</div>

		<div class="tshirt">
			<span class="title">Ловушка для внимания (серая)</span>
			<div class="img"><a href="img/2_lov_gr.jpg" class="fancybox"><img src="img/2_lov_gr_s.jpg" width="350"/></a></div>
			<div class="description">Ага, попались! Эта сова никого не оставляет равнодушным. Будьте готовы к повышенному вниманию со стороны окружающих! Если вам интересны его истоки - <a href="/catalog/Marketing/8594/">в книге</a> вы найдёте ответы на все волнующие вопросы. <br />
				<span class="price">
					<?=$price?> руб.
					<br /><br />
					<a href="#form"><span class="button">Заказать</span></a>
				</span>
			</div>
		</div>

		<div class="tshirt">
			<span class="title">Не в знании сила (серая)</span>
			<div class="img"><a href="img/4_zna_ok.jpg" class="fancybox"><img src="img/4_zna_ok_s.jpg" width="350"/></a></div>
			<div class="description">Любите Магритта? Сила не в знании, но вы точно знаете, кому понравится эта футболка! Мы сомневаемся, следовательно, существуем. Ещё немного пищи для сомнений вы найдёте в книге<br />
				<span class="price">
					<?=$price?> руб.
					<br /><br />
					<a href="#form"><span class="button">Заказать</span></a>
				</span>
			</div>
		</div>
		
		<div class="tshirt">
			<span class="title">Не в знании сила (серая)</span>
			<div class="img"><a href="img/4_zna_gr.jpg" class="fancybox"><img src="img/4_zna_gr_s.jpg" width="350"/></a></div>
			<div class="description">Любите Магритта? Сила не в знании, но вы точно знаете, кому понравится эта футболка! Мы сомневаемся, следовательно, существуем. Ещё немного пищи для сомнений вы найдёте в книге<br />
				<span class="price">
					<?=$price?> руб.
					<br /><br />
					<a href="#form"><span class="button">Заказать</span></a>
				</span>
			</div>
		</div>

		<div class="tshirt">
			<span class="title">Человек уставший (белая)</span>
			<div class="img"><a href="img/5_che_ok.jpg" class="fancybox"><img src="img/5_che_ok_s.jpg" width="350"/></a></div>
			<div class="description">Камень с души. Футболка, заряженная на жизненную энергию, моральные силы и здоровый цвет лица. Думаете, мы шутим? Ничуть. С нами доктор Сохер Рокед<br />
				<span class="price">
					<?=$price?> руб.
					<br /><br />
					<a href="#form"><span class="button">Заказать</span></a>
				</span>
			</div>
		</div>		
		
		<div class="signinWrapper">
		<a name="form"></a>
			<div class="registrationBlock">
			<form method="post" action="/content/tshirts/" name="bform">
				<table>
					<tbody>
						<tr>
							<td><input type="text" name="USER_NAME" maxlength="50" value="" class="bx-auth-input" placeholder="Имя *"></td>
						</tr>
						<?/*<tr>
							<td><input type="text" name="USER_ADDRESS" maxlength="50" value="" class="bx-auth-input" placeholder="Адрес *"></td>
						</tr>*/?>
						<tr>
							<td><input type="email" name="USER_EMAIL" maxlength="255" value="" class="bx-auth-input" placeholder="Ваш e-mail *"></td>
						</tr>
						<tr>
							<td><input type="text" name="USER_PHONE" maxlength="255" value="" class="bx-auth-input" placeholder="Номер телефона *"></td>
						</tr>
						<tr>
							<td><input type="textarea" name="COMMENTS" maxlength="255" value="" class="bx-auth-input" placeholder="Комментарии"></td>
						</tr>						
						<tr>
							<td>
								<select size="9" name="tshirt">
									<option value='В защиту эгоизма (белая)' selected>В защиту эгоизма (белая)</option>
									<option value='В защиту эгоизма (серая)'>В защиту эгоизма (серая)</option>
									<option value='Осторожно, спорт (серая)'>Осторожно, спорт (серая)</option>
									<option value='Осторожно, спорт (серая)'>Осторожно, спорт (серая)</option>
									<option value='Ловушка для внимания (серая)'>Ловушка для внимания (серая)</option>
									<option value='Ловушка для внимания (серая)'>Ловушка для внимания (серая)</option>
									<option value='Не в знании сила (серая)'>Не в знании сила (серая)</option>
									<option value='Не в знании сила (серая)'>Не в знании сила (серая)</option>
									<option value='Человек уставший (белая)'>Человек уставший (белая)</option>

								</select>
							</td>
						</tr>
						<tr>
							<td>
								<select size="6" name="size">
									<option value='XS'>XS</option>
									<option value='S'>S</option>
									<option value='M' selected>M</option>
									<option value='L'>L</option>
									<option value='XL'>XL</option>
									<option value='XXL'>XXL</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<select size="2" name="sex">
									<option value='male' selected>Мужская</option>
									<option value='female'>Женская</option>
								</select>
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td><input type="submit" name="Register" value="Оформить заказ" onclick="return checkRegisterFields();"></td>
						</tr>
					</tfoot>
				</table>
			</form>
			<script type="text/javascript">
				function checkRegisterFields(){
					flag = true;
					if($('input[name=USER_NAME]').val() == ''){
						flag = false;
						$('input[name=USER_NAME]').css('border-color','#FF0000');
					} else {
						$('input[name=USER_NAME]').css('border-color','#f0f0f0');
					}
					/*if($('input[name=USER_ADDRESS]').val() == ''){
						flag = false;
						$('input[name=USER_ADDRESS]').css('border-color','#FF0000');
					} else {
						$('input[name=USER_ADDRESS]').css('border-color','#f0f0f0');
					}*/
					if($('input[name=USER_EMAIL]').val() == ''){
						flag = false;
						$('input[name=USER_EMAIL]').css('border-color','#FF0000');
					} else {
						$('input[name=USER_EMAIL]').css('border-color','#f0f0f0');
					}
					if($('input[name=USER_PHONE]').val() == ''){
						flag = false;
						$('input[name=USER_PHONE]').css('border-color','#FF0000');
					} else {
						$('input[name=USER_PHONE]').css('border-color','#f0f0f0');
					}
					return flag;        
				}
			</script>
				Наличие размера, цвета и картинки на футболках уточняйте по тел +7 (495) 980 80 77
				<br />
				* данное предложение не является публичной офертой						
			</div>
		</div>
	<?}?>
	</div>
</div>


<script>
$(document).ready(function() {
	$('.fancybox').fancybox({
		'centerOnScroll' : true,
		'scrolling'      : true,
		'showNavArrows'  : true
	});
	
	$('a.fancybox').fancybox({
		'width'   :   1140,
		'height'   :   800
	});
})


</script>	


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>