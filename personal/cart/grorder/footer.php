


</div>


<div class="content_r">
<div class="R_video">
<a class="gallery" href="#testube"><img alt="" src="/bitrix/templates/<? echo SITE_TEMPLATE_ID;?>/img/yout.jpg" /></a>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => "/bitrix/templates/video_block.php",
		"EDIT_TEMPLATE" => ""
	)
);?>
<!-- <div style="display:none" id="testube">
 <iframe width="560" height="315" src="//www.youtube.com/embed/kJr5RlIS9Ik" frameborder="0" allowfullscreen></iframe>
</div>-->

</div>
<!--<br clear="all">-->
<div style="width:173px;text-align:right" class="down_l">
<a  style="width:173px;"  href="/article/o_nas/">Статьи</a>
</div>
<div style="width:173px;text-align:right" class="down_l">
<a <?if ($dir[2]=="reviews"){?>style="width:173px;background:#f38f20"<?}?> style="width:173px;"  href="/about/reviews/o-nas/">Отзывы</a>
</div>
<div style="width:173px;text-align:right" class="down_l">
<a <?if ($dir[2]=="partners"){?>style="width:173px;background:#f38f20"<?}?> style="width:173px;"   href="/about/partners/">Наши партнеры</a>
</div>




<div class="content_r_block">
<p ><a href="/timetable/">Ближайшие тренинги</a></p>
 <?
if (CModule::IncludeModule("iblock")){
//$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
$arFilter = Array("IBLOCK_ID"=>11, ">PROPERTY_DATE"=>date("Y-m-d ")." 00:00:00" , "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("PROPERTY_DATE"=>"ASC"), $arFilter, false, Array("nPageSize"=>5), $arSelect);
while($ob = $res->GetNextElement())
{
  $arFields = $ob->GetFields();
$arProps = $ob->GetProperties(); 
$file = CFile::ResizeImageGet($arFields["PREVIEW_PICTURE"], array('width'=>175, 'height'=>118), BX_RESIZE_IMAGE_PROPORTIONAL, true);

 $arFilter1 = Array('IBLOCK_ID'=>1, "ID"=>$arProps["jes"]["VALUE"], 'GLOBAL_ACTIVE'=>'Y', 'PROPERTY'=>Array('SRC'=>'https://%'));
  $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter1, true);
  $db_list->NavStart(20);
  echo $db_list->NavPrint($arIBTYPE["SECTION_NAME"]);
  while($ar_result1 = $db_list->GetNext())
  {
//print_r($ar_result1["SECTION_PAGE_URL"]);
$replace2 = array("", "", "");
$patterns = array("(базовый курс)", "(интенсив)", "(расширенный курс)");
?> 
<div class="item_bliz_trening"><label class="date_bliz_trening"><?echo russian_date($arProps["date"]["VALUE"])?></label> <a href="<?echo $ar_result1["SECTION_PAGE_URL"]?>/" style="color:black;text-decoration:none;cursor:pointer" ><label class="name_bliz_trening"><?echo (str_replace($patterns, $replace2, $arFields["NAME"]))?></label> 
    <br />
   <?print_r($arProps["lesson"]["VALUE"])?> </a> </div>
 <?
  }
}
}
?> 
  

<!--<div class="item_bliz_trening">
<label class="date_bliz_trening">18 августа 2013г</label>
<label class="name_bliz_trening">Личная деловая эфективность</label> </br>
8 занятий
</div>-->


</div>








</div>

</div>

<script>
function validateEmail(email) { 
  // http://stackoverflow.com/a/46181/11236
  
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}





$('.form_podpis a').click(function (event) {
event.preventDefault();
//$(".form_podpis").css('left','-2000px')     animate({
$(".form_podpis").animate({left:"-2000px"});
});




  $(document).ready(function(){
	  
    $('.subPodpisatsa').click(send);
	
	
	
		
		function send()
		{
var email = $('input[name=email]').val();
if (email=='') {
     alert ("Не заполнены обязательные поля"); return false;
     }
if (!validateEmail(email)) {
    alert("Введите корректный email");return false
}

$.ajax({
        url: "/bitrix/templates/send_news.php",
        type: "POST",
       data: ({name: $('input[name=name]').val(),email: $('input[name=email]').val()}) ,            

        success: function(data){
             
		$('.form_podpis').animate({left:"35%"});
            
        }
        
    });
		
                        
	}
       
  }); 

</script>
<script type="text/javascript">
		$(document).ready(function() {
			$("a.gallery, a.iframe").fancybox();
		
url = $("a.modalbox").attr('href').replace("for_spider","content2");
$("a.modalbox").attr("href", url);	
$("a.modalbox").fancybox(
{								  
			"frameWidth" : 400,	 
			"frameHeight" : 400 
								  
});

		
			
		});
	</script>
</body>
</html>