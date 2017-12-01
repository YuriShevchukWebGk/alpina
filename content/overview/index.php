<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<!DOCTYPE html>
<html> 
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
<meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>OVERVIEW \ PRINTSHOP</title>
<meta property="og:title" content="OVERVIEW \ PRINTSHOP" />
<meta property="og:description" content="" />
<meta property="og:type" content="website" />
<meta property="og:image" content="img/tild3631-3137-4235-b363-333134626166/05.png" />
<meta property="fb:app_id" content="257953674358265" />
<meta name="format-detection" content="telephone=no" />
<meta http-equiv="x-dns-prefetch-control" content="on">


<link rel="canonical" href="printshop_overview.html">

<!-- Assets -->
<link rel="stylesheet" href="img/css/tilda-grid-3.0.min.css" type="text/css" media="all" />
<link rel="stylesheet" href="source/tilda-blocks-2.12e80b.css?t=1511512933" type="text/css" media="all" />
<link rel="stylesheet" href="img/css/tilda-animation-1.0.min.css" type="text/css" media="all" />
<link rel="stylesheet" href="img/css/tilda-slds-1.4.min.css" type="text/css" media="all" />
<link rel="stylesheet" href="img/css/tilda-zoom-2.0.min.css" type="text/css" media="all" />
<script src="img/js/jquery-1.10.2.min.js">
</script>
<script src="img/js/tilda-scripts-2.8.min.js">
</script>
<script src="source/tilda-blocks-2.7e80b.js?t=1511512933">
</script>
<script src="img/js/tilda-animation-1.0.min.js">
</script>
<script src="img/js/tilda-slds-1.4.min.js">
</script>
<script src="img/js/hammer.min.js">
</script>
<script src="img/js/tilda-zoom-2.0.min.js">
</script>
<script src="img/js/tilda-products-1.0.min.js">
</script>
<script src="img/js/lazyload-1.3.min.js">
</script>
</head>
<body class="t-body" style="margin:0;">

<div class="certificate_popup">
        <form id="certificate_form">
            <div class="popup_form_data">
                <div class="natural_person active_certificate_block">
                    <input type='text' placeholder="Имя" name="natural_name" id="natural_name">
                    <br>
                    <input type='email' placeholder="Email" name="natural_email" id="natural_email">
                    <br>
                    <a href="#" class="certificate_buy_button" onclick="create_certificate_order(); return false;">
<?= GetMessage("PAY") ?>
</a>
                </div>
            </div>
            <input type="hidden" name="certificate_name" value="<?= $arResult['NAME'] ?>"/>
            <input type="hidden" name="certificate_quantity" value="1"/>
            <input type="hidden" name="certificate_price" value="<?=$arResult['PRICES']['BASE']['VALUE']?>"/>
            <input type="hidden" name="basket_rule" value="<?= preg_replace("/[^0-9]/", '', $arResult['XML_ID']);?>"/>
        </form>
        <div class="certificate_popup_close closeIcon">
</div>
        <div class="rfi_block">
        <?
            $APPLICATION->IncludeComponent(
                "webgk:rfi.widget",
                "",
                Array(
                    "ORDER_ID"      => "CERT_",
                    "OTHER_PAYMENT" => "Y",
                    "OTHER_PARAMS"  => array(
                        "PAYSUM"   => $newPrice,
                        "EMAIL"    => "",
                        "PHONE"    => "",
                        "COMMENT"  => str_replace("#SUM#", $newPrice, "Покупка плаката на сайте alpinabook.ru на сумму #SUM# рублей")
                    )
                ),
                false
            );
        ?>
        </div>
    </div>
<!--allrecords-->
<div id="allrecords" class="t-records">
<div id="rec38620142" class="r t-rec" style=" " data-animationappear="off" data-record-type="18" >
<!-- cover -->
<div class="t-cover" id="recorddiv38620142" bgimgfield="img" style="height:60vh; background-image:url('img/tild3631-3137-4235-b363-333134626166/-/resize/20x/05.png');" >
<div class="t-cover__carrier" id="coverCarry38620142" data-content-cover-id="38620142" data-content-cover-bg="img/tild3631-3137-4235-b363-333134626166/05.png" data-content-cover-height="60vh" data-content-cover-parallax="fixed" style="background-image:url('');height:60vh; background-position:center bottom;">
</div>
<div class="t-cover__filter" style="height:60vh;background-image: -moz-linear-gradient(top, rgba(0,0,0,0.0), rgba(0,0,0,0.0));background-image: -webkit-linear-gradient(top, rgba(0,0,0,0.0), rgba(0,0,0,0.0));background-image: -o-linear-gradient(top, rgba(0,0,0,0.0), rgba(0,0,0,0.0));background-image: -ms-linear-gradient(top, rgba(0,0,0,0.0), rgba(0,0,0,0.0));background-image: linear-gradient(top, rgba(0,0,0,0.0), rgba(0,0,0,0.0));filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#fe000000', endColorstr='#fe000000');">
</div>
<div class="t-container">
<div class="t-col t-col_12 ">
<div class="t-cover__wrapper t-valign_top" style="height:60vh;">
<div class="t001 t-align_center">
<div class="t001__wrapper" data-hook-content="covercontent">
<span class="space">
</span>
</div>
</div>
</div>
</div>
</div>
<!-- arrow -->
<div class="t-cover__arrow">
<div class="t-cover__arrow-wrapper t-cover__arrow-wrapper_animated">
<div class="t-cover__arrow_mobile">
<svg class="t-cover__arrow-svg" style="fill:#ffffff;" x="0px" y="0px" width="38.417px" height="18.592px" viewBox="0 0 38.417 18.592" style="enable-background:new 0 0 38.417 18.592;">
<g>
<path d="M19.208,18.592c-0.241,0-0.483-0.087-0.673-0.261L0.327,1.74c-0.408-0.372-0.438-1.004-0.066-1.413c0.372-0.409,1.004-0.439,1.413-0.066L19.208,16.24L36.743,0.261c0.411-0.372,1.042-0.342,1.413,0.066c0.372,0.408,0.343,1.041-0.065,1.413L19.881,18.332C19.691,18.505,19.449,18.592,19.208,18.592z"/>
</g>
</svg>
</div>
</div>
</div>
<!-- arrow -->
</div>
</div>
<div id="rec38163952" class="r t-rec t-rec_pt_30 t-rec_pb_30" style="padding-top:30px;padding-bottom:30px; " data-record-type="60" >
<!-- T050 -->
<div class="t050">
<div class="t-container t-align_center">
<div class="t-col t-col_10 t-prefix_1">
<div class="t050__title t-title t-title_xxl" field="title" style="">ЗАКАЖИТЕ ПОСТЕР</div>
</div>
</div>
</div>
</div>
<div id="rec38011747" class="r t-rec t-rec_pt_0 t-rec_pb_0" style="padding-top:0px;padding-bottom:0px; " data-animationappear="off" data-record-type="603" >
<!-- t603-->
<div class="t603">
<div class="t603__container t-container" style="padding: 0px 0px 0px 0px;">
<div class="t603__tile t603__tile_25" style="padding:40 20px 0px 20px;" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__0" data-zoom-target="0" data-zoomable="yes" data-img-zoom-url="img/tild3836-3061-4536-b433-313663623531/PM1.png" data-img-zoom-descr=" PERITO MORENO GLACIER " data-original="img/tild3836-3061-4536-b433-313663623531/PM1.png" style="background: url('img/tild3836-3061-4536-b433-313663623531/-/resize/20x/PM1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3836-3061-4536-b433-313663623531/PM1.png">
<meta itemprop="caption" content="осльмюю">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__0" itemprop="description"> PERITO MORENO GLACIER </div>
</div>
</div>
<div class="t603__tile t603__tile_25" style="padding:40 20px 0px 20px;" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__1" data-zoom-target="1" data-zoomable="yes" data-img-zoom-url="img/tild3431-6535-4233-b061-353366303733/CF_1.png" data-img-zoom-descr="CANOLA FLOWERS" data-original="img/tild3431-6535-4233-b061-353366303733/CF_1.png" style="background: url('img/tild3431-6535-4233-b061-353366303733/-/resize/20x/CF_1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3431-6535-4233-b061-353366303733/CF_1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__1" itemprop="description">CANOLA FLOWERS</div>
</div>
</div>
<div class="t603__tile t603__tile_25" style="padding:40 20px 0px 20px;" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__2" data-zoom-target="2" data-zoomable="yes" data-img-zoom-url="img/tild3662-3466-4236-b331-373831613735/Aspen_1.png" data-img-zoom-descr="ASPEN SNOWMASS" data-original="img/tild3662-3466-4236-b331-373831613735/Aspen_1.png" style="background: url('img/tild3662-3466-4236-b331-373831613735/-/resize/20x/Aspen_1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3662-3466-4236-b331-373831613735/Aspen_1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__2" itemprop="description">ASPEN SNOWMASS</div>
</div>
</div>
<div class="t603__tile t603__tile_25" style="padding:40 20px 0px 20px;" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__3" data-zoom-target="3" data-zoomable="yes" data-img-zoom-url="img/tild6139-6234-4737-b932-353566613663/Lebreija_1.png" data-img-zoom-descr="LEBREIJA 1 SOLAR PLANT" data-original="img/tild6139-6234-4737-b932-353566613663/Lebreija_1.png" style="background: url('img/tild6139-6234-4737-b932-353566613663/-/resize/20x/Lebreija_1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6139-6234-4737-b932-353566613663/Lebreija_1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__3" itemprop="description">LEBREIJA 1 SOLAR PLANT</div>
</div>
</div>
<div class="t603__tile t603__tile_25" style="padding:40 20px 0px 20px;" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__4" data-zoom-target="4" data-zoomable="yes" data-img-zoom-url="img/tild3539-3232-4363-a234-626230346332/EQ1.png" data-img-zoom-descr="EMPTY QUARTER" data-original="img/tild3539-3232-4363-a234-626230346332/EQ1.png" style="background: url('img/tild3539-3232-4363-a234-626230346332/-/resize/20x/EQ1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3539-3232-4363-a234-626230346332/EQ1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__4" itemprop="description">EMPTY QUARTER</div>
</div>
</div>
<div class="t603__tile t603__tile_25" style="padding:40 20px 0px 20px;" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__5" data-zoom-target="5" data-zoomable="yes" data-img-zoom-url="img/tild6661-3963-4564-a632-613937326237/BR1.png" data-img-zoom-descr="BOCA RATON" data-original="img/tild6661-3963-4564-a632-613937326237/BR1.png" style="background: url('img/tild6661-3963-4564-a632-613937326237/-/resize/20x/BR1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6661-3963-4564-a632-613937326237/BR1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__5" itemprop="description">BOCA RATON</div>
</div>
</div>
<div class="t603__tile t603__tile_25" style="padding:40 20px 0px 20px;" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__6" data-zoom-target="6" data-zoomable="yes" data-img-zoom-url="img/tild6636-6437-4431-a230-616437353535/Singapore_Tankers.jpg" data-img-zoom-descr="SINGAPORE TANKERS" data-original="img/tild6636-6437-4431-a230-616437353535/Singapore_Tankers.jpg" style="background: url('img/tild6636-6437-4431-a230-616437353535/-/resize/20x/Singapore_Tankers.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6636-6437-4431-a230-616437353535/Singapore_Tankers.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__6" itemprop="description">SINGAPORE TANKERS</div>
</div>
</div>
<div class="t603__tile t603__tile_25" style="padding:40 20px 0px 20px;" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__7" data-zoom-target="7" data-zoomable="yes" data-img-zoom-url="img/tild6538-6532-4133-b463-316136323430/MF1.png" data-img-zoom-descr="MOUNT FUJI" data-original="img/tild6538-6532-4133-b463-316136323430/MF1.png" style="background: url('img/tild6538-6532-4133-b463-316136323430/-/resize/20x/MF1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6538-6532-4133-b463-316136323430/MF1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__7" itemprop="description">MOUNT FUJI</div>
</div>
</div>
</div>
</div>
<style>
@media screen and (max-width: 1200px) {	#rec38011747 .t603__container.t-container{	padding: 0px 0px 0px 0px !important;	}	#rec38011747 .t603__tile {	padding: 20px 10px 0px 10px !important;	}	}
@media screen and (max-width: 960px) {	#rec38011747 .t603__container.t-container, #rec38011747 .t603__container {	padding: 0px 10px 0px 10px !important;	}	#rec38011747 .t603__tile {	padding: 20px 10px 0px 10px !important;	}
}</style>
</div>
<div id="rec38011751" class="r t-rec t-rec_pt_0 t-rec_pb_0" style="padding-top:0px;padding-bottom:0px; " data-animationappear="off" data-record-type="603" >
<!-- t603-->
<div class="t603">
<div class="t603__container t-container" style="padding-bottom: 0px;">
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__0" data-zoom-target="0" data-zoomable="yes" data-img-zoom-url="img/tild3565-3466-4461-b434-386535326138/4.png" data-img-zoom-descr="MOUNT WHALEBACK IRON ORE MINE" data-original="img/tild3565-3466-4461-b434-386535326138/4.png" style="background: url('img/tild3565-3466-4461-b434-386535326138/-/resize/20x/4.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3565-3466-4461-b434-386535326138/4.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__0" itemprop="description">MOUNT WHALEBACK IRON ORE MINE</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__1" data-zoom-target="1" data-zoomable="yes" data-img-zoom-url="img/tild3636-3938-4461-b063-303030303130/SL1.png" data-img-zoom-descr="SHADEGAN LAGOON" data-original="img/tild3636-3938-4461-b063-303030303130/SL1.png" style="background: url('img/tild3636-3938-4461-b063-303030303130/-/resize/20x/SL1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3636-3938-4461-b063-303030303130/SL1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__1" itemprop="description">SHADEGAN LAGOON</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__2" data-zoom-target="2" data-zoomable="yes" data-img-zoom-url="img/tild6462-3964-4236-b464-343438353538/Barcelona_Eixample.jpg" data-img-zoom-descr="EIXAMPLE, BARCELONA MSM" data-original="img/tild6462-3964-4236-b464-343438353538/Barcelona_Eixample.jpg" style="background: url('img/tild6462-3964-4236-b464-343438353538/-/resize/20x/Barcelona_Eixample.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6462-3964-4236-b464-343438353538/Barcelona_Eixample.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__2" itemprop="description">EIXAMPLE, BARCELONA MSM</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__3" data-zoom-target="3" data-zoomable="yes" data-img-zoom-url="img/tild3031-3231-4766-b463-383735636239/MSM1.png" data-img-zoom-descr="MONT ST. MICHEL" data-original="img/tild3031-3231-4766-b463-383735636239/MSM1.png" style="background: url('img/tild3031-3231-4766-b463-383735636239/-/resize/20x/MSM1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3031-3231-4766-b463-383735636239/MSM1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__3" itemprop="description">MONT ST. MICHEL</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__4" data-zoom-target="4" data-zoomable="yes" data-img-zoom-url="img/tild6532-6233-4664-b931-333663343536/Palm1.jpg" data-img-zoom-descr="PALM JUMERIAH" data-original="img/tild6532-6233-4664-b931-333663343536/Palm1.jpg" style="background: url('img/tild6532-6233-4664-b931-333663343536/-/resize/20x/Palm1.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6532-6233-4664-b931-333663343536/Palm1.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__4" itemprop="description">PALM JUMERIAH</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__5" data-zoom-target="5" data-zoomable="yes" data-img-zoom-url="img/tild3765-3361-4631-b763-396334613864/Nice_1.png" data-img-zoom-descr="NICE" data-original="img/tild3765-3361-4631-b763-396334613864/Nice_1.png" style="background: url('img/tild3765-3361-4631-b763-396334613864/-/resize/20x/Nice_1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3765-3361-4631-b763-396334613864/Nice_1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__5" itemprop="description">NICE</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__6" data-zoom-target="6" data-zoomable="yes" data-img-zoom-url="img/tild3432-6332-4630-a464-306538646136/GM1.png" data-img-zoom-descr="ICELANDIC GLACIAL MELT" data-original="img/tild3432-6332-4630-a464-306538646136/GM1.png" style="background: url('img/tild3432-6332-4630-a464-306538646136/-/resize/20x/GM1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3432-6332-4630-a464-306538646136/GM1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__6" itemprop="description">ICELANDIC GLACIAL MELT</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__7" data-zoom-target="7" data-zoomable="yes" data-img-zoom-url="img/tild3636-3136-4638-a235-386263663932/White_Island_2.jpeg" data-img-zoom-descr="WHITE ISLAND" data-original="img/tild3636-3136-4638-a235-386263663932/White_Island_2.jpeg" style="background: url('img/tild3636-3136-4638-a235-386263663932/-/resize/20x/White_Island_2.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3636-3136-4638-a235-386263663932/White_Island_2.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__7" itemprop="description">WHITE ISLAND</div>
</div>
</div>
</div>
</div>
<style>
</style>
</div>
<div id="rec38011754" class="r t-rec t-rec_pt_0 t-rec_pb_0" style="padding-top:0px;padding-bottom:0px; " data-animationappear="off" data-record-type="603" >
<!-- t603-->
<div class="t603">
<div class="t603__container t-container" style="padding-bottom: 0px;">
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__0" data-zoom-target="0" data-zoomable="yes" data-img-zoom-url="img/tild6330-3763-4562-b561-323531383431/Hawaii_1.jpg" data-img-zoom-descr="HAWAII COAST" data-original="img/tild6330-3763-4562-b561-323531383431/Hawaii_1.jpg" style="background: url('img/tild6330-3763-4562-b561-323531383431/-/resize/20x/Hawaii_1.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6330-3763-4562-b561-323531383431/Hawaii_1.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__0" itemprop="description">HAWAII COAST</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__1" data-zoom-target="1" data-zoomable="yes" data-img-zoom-url="img/tild6330-3630-4466-a461-616137353131/Screen_Shot_20151128.png" data-img-zoom-descr="INDONESIAN SHIPS" data-original="img/tild6330-3630-4466-a461-616137353131/Screen_Shot_20151128.png" style="background: url('img/tild6330-3630-4466-a461-616137353131/-/resize/20x/Screen_Shot_20151128.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6330-3630-4466-a461-616137353131/Screen_Shot_20151128.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__1" itemprop="description">INDONESIAN SHIPS</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__2" data-zoom-target="2" data-zoomable="yes" data-img-zoom-url="img/tild3935-3262-4631-b834-643639643539/1.png" data-img-zoom-descr="CRESCENT DUNES SOLAR" data-original="img/tild3935-3262-4631-b834-643639643539/1.png" style="background: url('img/tild3935-3262-4631-b834-643639643539/-/resize/20x/1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3935-3262-4631-b834-643639643539/1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__2" itemprop="description">CRESCENT DUNES SOLAR</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__3" data-zoom-target="3" data-zoomable="yes" data-img-zoom-url="img/tild3764-3965-4230-b666-376634383863/GGB1.png" data-img-zoom-descr="GOLDEN GATE BRIDGE" data-original="img/tild3764-3965-4230-b666-376634383863/GGB1.png" style="background: url('img/tild3764-3965-4230-b666-376634383863/-/resize/20x/GGB1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3764-3965-4230-b666-376634383863/GGB1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__3" itemprop="description">GOLDEN GATE BRIDGE</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__4" data-zoom-target="4" data-zoomable="yes" data-img-zoom-url="img/tild3930-6566-4333-a262-363432616533/Central_Park_Vertica.png" data-img-zoom-descr="CENTRAL PARK" data-original="img/tild3930-6566-4333-a262-363432616533/Central_Park_Vertica.png" style="background: url('img/tild3930-6566-4333-a262-363432616533/-/resize/20x/Central_Park_Vertica.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3930-6566-4333-a262-363432616533/Central_Park_Vertica.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__4" itemprop="description">CENTRAL PARK</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__5" data-zoom-target="5" data-zoomable="yes" data-img-zoom-url="img/tild6466-3633-4331-b538-643565646164/BM_1.png" data-img-zoom-descr="BURNING MAN" data-original="img/tild6466-3633-4331-b538-643565646164/BM_1.png" style="background: url('img/tild6466-3633-4331-b538-643565646164/-/resize/20x/BM_1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6466-3633-4331-b538-643565646164/BM_1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__5" itemprop="description">BURNING MAN</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__6" data-zoom-target="6" data-zoomable="yes" data-img-zoom-url="img/tild3739-3230-4233-b262-366162633464/SP1.png" data-img-zoom-descr="SAN FRANCISCO BAY SALT PONDS" data-original="img/tild3739-3230-4233-b262-366162633464/SP1.png" style="background: url('img/tild3739-3230-4233-b262-366162633464/-/resize/20x/SP1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3739-3230-4233-b262-366162633464/SP1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__6" itemprop="description">SAN FRANCISCO BAY SALT PONDS</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__7" data-zoom-target="7" data-zoomable="yes" data-img-zoom-url="img/tild6261-3730-4461-b165-666336666361/Ipanema_R1C1.jpg" data-img-zoom-descr="IPANEMA BEACH" data-original="img/tild6261-3730-4461-b165-666336666361/Ipanema_R1C1.jpg" style="background: url('img/tild6261-3730-4461-b165-666336666361/-/resize/20x/Ipanema_R1C1.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6261-3730-4461-b165-666336666361/Ipanema_R1C1.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__7" itemprop="description">IPANEMA BEACH</div>
</div>
</div>
</div>
</div>
<style>
</style>
</div>
<div id="rec38011756" class="r t-rec t-rec_pt_0 t-rec_pb_0" style="padding-top:0px;padding-bottom:0px; " data-animationappear="off" data-record-type="603" >
<!-- t603-->
<div class="t603">
<div class="t603__container t-container" style="padding-bottom: 0px;">
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__0" data-zoom-target="0" data-zoomable="yes" data-img-zoom-url="img/tild3262-6363-4363-b365-666638623833/Paris_1.png" data-img-zoom-descr="PARIS" data-original="img/tild3262-6363-4363-b365-666638623833/Paris_1.png" style="background: url('img/tild3262-6363-4363-b365-666638623833/-/resize/20x/Paris_1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3262-6363-4363-b365-666638623833/Paris_1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__0" itemprop="description">PARIS</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__1" data-zoom-target="1" data-zoomable="yes" data-img-zoom-url="img/tild6465-3162-4036-b631-363531346630/DM1.png" data-img-zoom-descr="JWANENG DIAMOND MINE" data-original="img/tild6465-3162-4036-b631-363531346630/DM1.png" style="background: url('img/tild6465-3162-4036-b631-363531346630/-/resize/20x/DM1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6465-3162-4036-b631-363531346630/DM1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__1" itemprop="description">JWANENG DIAMOND MINE</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__2" data-zoom-target="2" data-zoomable="yes" data-img-zoom-url="img/tild3335-3933-4539-b136-353465633630/Lop_Nur.png" data-img-zoom-descr="CHINA POTASH PONDS Val1.png" data-original="img/tild3335-3933-4539-b136-353465633630/Lop_Nur.png" style="background: url('img/tild3335-3933-4539-b136-353465633630/-/resize/20x/Lop_Nur.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3335-3933-4539-b136-353465633630/Lop_Nur.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__2" itemprop="description">CHINA POTASH PONDS Val1.png</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__3" data-zoom-target="3" data-zoomable="yes" data-img-zoom-url="img/tild3836-3065-4731-b734-303632376334/Val1.png" data-img-zoom-descr="VALPARAISO" data-original="img/tild3836-3065-4731-b734-303632376334/Val1.png" style="background: url('img/tild3836-3065-4731-b734-303632376334/-/resize/20x/Val1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3836-3065-4731-b734-303632376334/Val1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__3" itemprop="description">VALPARAISO</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__4" data-zoom-target="4" data-zoomable="yes" data-img-zoom-url="img/tild3231-3362-4838-a162-616436373234/CC1.png" data-img-zoom-descr="CAPE COD" data-original="img/tild3231-3362-4838-a162-616436373234/CC1.png" style="background: url('img/tild3231-3362-4838-a162-616436373234/-/resize/20x/CC1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3231-3362-4838-a162-616436373234/CC1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__4" itemprop="description">CAPE COD</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__5" data-zoom-target="5" data-zoomable="yes" data-img-zoom-url="img/tild3230-3936-4737-a638-623033623363/Austria1.png" data-img-zoom-descr="AUSTRIAN FIELDS" data-original="img/tild3230-3936-4737-a638-623033623363/Austria1.png" style="background: url('img/tild3230-3936-4737-a638-623033623363/-/resize/20x/Austria1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3230-3936-4737-a638-623033623363/Austria1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__5" itemprop="description">AUSTRIAN FIELDS</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__6" data-zoom-target="6" data-zoomable="yes" data-img-zoom-url="img/tild6639-3261-4531-b930-393461366461/Screen_Shot_20150409.png" data-img-zoom-descr="KANSAS PIVOT IRRIGATION" data-original="img/tild6639-3261-4531-b930-393461366461/Screen_Shot_20150409.png" style="background: url('img/tild6639-3261-4531-b930-393461366461/-/resize/20x/Screen_Shot_20150409.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6639-3261-4531-b930-393461366461/Screen_Shot_20150409.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__6" itemprop="description">KANSAS PIVOT IRRIGATION</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__7" data-zoom-target="7" data-zoomable="yes" data-img-zoom-url="img/tild3531-3130-4137-b862-653461346561/Granada_R1C1__Versio.jpg" data-img-zoom-descr="OLIVE TREES" data-original="img/tild3531-3130-4137-b862-653461346561/Granada_R1C1__Versio.jpg" style="background: url('img/tild3531-3130-4137-b862-653461346561/-/resize/20x/Granada_R1C1__Versio.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3531-3130-4137-b862-653461346561/Granada_R1C1__Versio.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__7" itemprop="description">OLIVE TREES</div>
</div>
</div>
</div>
</div>
<style>
</style>
</div>
<div id="rec38011758" class="r t-rec t-rec_pt_0 t-rec_pb_0" style="padding-top:0px;padding-bottom:0px; " data-animationappear="off" data-record-type="603" >
<!-- t603-->
<div class="t603">
<div class="t603__container t-container" style="padding-bottom: 0px;">
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__0" data-zoom-target="0" data-zoomable="yes" data-img-zoom-url="img/tild3461-3131-4234-b237-616434633634/Moab5.jpg" data-img-zoom-descr="MOAB POTASH PONDS Full.png" data-original="img/tild3461-3131-4234-b237-616434633634/Moab5.jpg" style="background: url('img/tild3461-3131-4234-b237-616434633634/-/resize/20x/Moab5.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3461-3131-4234-b237-616434633634/Moab5.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__0" itemprop="description">MOAB POTASH PONDS Full.png</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__1" data-zoom-target="1" data-zoomable="yes" data-img-zoom-url="img/tild3366-3331-4135-a663-323663386332/Full.png" data-img-zoom-descr="SAN FRANCISCO" data-original="img/tild3366-3331-4135-a663-323663386332/Full.png" style="background: url('img/tild3366-3331-4135-a663-323663386332/-/resize/20x/Full.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3366-3331-4135-a663-323663386332/Full.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__1" itemprop="description">SAN FRANCISCO</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__2" data-zoom-target="2" data-zoomable="yes" data-img-zoom-url="img/tild6432-6435-4361-a463-643764663731/Screen_Shot_20151128.png" data-img-zoom-descr="NIGER URANIUM MINE" data-original="img/tild6432-6435-4361-a463-643764663731/Screen_Shot_20151128.png" style="background: url('img/tild6432-6435-4361-a463-643764663731/-/resize/20x/Screen_Shot_20151128.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6432-6435-4361-a463-643764663731/Screen_Shot_20151128.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__2" itemprop="description">NIGER URANIUM MINE</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__3" data-zoom-target="3" data-zoomable="yes" data-img-zoom-url="img/tild6332-3666-4537-b562-636432336539/ADT_Full.jpg" data-img-zoom-descr="ARC DE TRIOMPHE" data-original="img/tild6332-3666-4537-b562-636432336539/ADT_Full.jpg" style="background: url('img/tild6332-3666-4537-b562-636432336539/-/resize/20x/ADT_Full.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6332-3666-4537-b562-636432336539/ADT_Full.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__3" itemprop="description">ARC DE TRIOMPHE</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__4" data-zoom-target="4" data-zoomable="yes" data-img-zoom-url="img/tild3563-3837-4631-b862-316234383530/Screen_Shot_20151128.png" data-img-zoom-descr="CHINESE RICE PADDIES" data-original="img/tild3563-3837-4631-b862-316234383530/Screen_Shot_20151128.png" style="background: url('img/tild3563-3837-4631-b862-316234383530/-/resize/20x/Screen_Shot_20151128.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3563-3837-4631-b862-316234383530/Screen_Shot_20151128.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__4" itemprop="description">CHINESE RICE PADDIES</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__5" data-zoom-target="5" data-zoomable="yes" data-img-zoom-url="img/tild3439-3962-4564-b733-343639346336/Screen_Shot_20151128.png" data-img-zoom-descr="PALMANOVA" data-original="img/tild3439-3962-4564-b733-343639346336/Screen_Shot_20151128.png" style="background: url('img/tild3439-3962-4564-b733-343639346336/-/resize/20x/Screen_Shot_20151128.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3439-3962-4564-b733-343639346336/Screen_Shot_20151128.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__5" itemprop="description">PALMANOVA</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__6" data-zoom-target="6" data-zoomable="yes" data-img-zoom-url="img/tild3236-6635-4436-b034-306562613734/Almeria2_R1C1__Versi.jpg" data-img-zoom-descr="SPAIN GREENHOUSES" data-original="img/tild3236-6635-4436-b034-306562613734/Almeria2_R1C1__Versi.jpg" style="background: url('img/tild3236-6635-4436-b034-306562613734/-/resize/20x/Almeria2_R1C1__Versi.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3236-6635-4436-b034-306562613734/Almeria2_R1C1__Versi.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__6" itemprop="description">SPAIN GREENHOUSES</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__7" data-zoom-target="7" data-zoomable="yes" data-img-zoom-url="img/tild6661-3737-4133-a362-633832376336/Venice_Full.png" data-img-zoom-descr="VENICE" data-original="img/tild6661-3737-4133-a362-633832376336/Venice_Full.png" style="background: url('img/tild6661-3737-4133-a362-633832376336/-/resize/20x/Venice_Full.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6661-3737-4133-a362-633832376336/Venice_Full.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__7" itemprop="description">VENICE</div>
</div>
</div>
</div>
</div>
<style>
</style>
</div>
<div id="rec38011785" class="r t-rec t-rec_pt_0 t-rec_pb_0" style="padding-top:0px;padding-bottom:0px; " data-animationappear="off" data-record-type="603" >
<!-- t603-->
<div class="t603">
<div class="t603__container t-container" style="padding-bottom: 0px;">
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__0" data-zoom-target="0" data-zoomable="yes" data-img-zoom-url="img/tild3262-3566-4661-a431-363431323866/No_39B__DFW_Airport_.jpg" data-img-zoom-descr="DFW AIRPORT Delray Beach.png" data-original="img/tild3262-3566-4661-a431-363431323866/No_39B__DFW_Airport_.jpg" style="background: url('img/tild3262-3566-4661-a431-363431323866/-/resize/20x/No_39B__DFW_Airport_.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3262-3566-4661-a431-363431323866/No_39B__DFW_Airport_.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__0" itemprop="description">DFW AIRPORT Delray Beach.png</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__1" data-zoom-target="1" data-zoomable="yes" data-img-zoom-url="img/tild3333-3765-4930-b535-336630376664/Delray_Beach.png" data-img-zoom-descr="DELRAY BEACH" data-original="img/tild3333-3765-4930-b535-336630376664/Delray_Beach.png" style="background: url('img/tild3333-3765-4930-b535-336630376664/-/resize/20x/Delray_Beach.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3333-3765-4930-b535-336630376664/Delray_Beach.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__1" itemprop="description">DELRAY BEACH</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__2" data-zoom-target="2" data-zoomable="yes" data-img-zoom-url="img/tild3064-3465-4338-b732-646137373864/VA_R1C1__Version_2.jpg" data-img-zoom-descr="AIRCRAFT BONEYARD" data-original="img/tild3064-3465-4338-b732-646137373864/VA_R1C1__Version_2.jpg" style="background: url('img/tild3064-3465-4338-b732-646137373864/-/resize/20x/VA_R1C1__Version_2.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3064-3465-4338-b732-646137373864/VA_R1C1__Version_2.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__2" itemprop="description">AIRCRAFT BONEYARD</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__3" data-zoom-target="3" data-zoomable="yes" data-img-zoom-url="img/tild3534-6262-4331-b034-363634396230/Screen_Shot_20151128.png" data-img-zoom-descr="WASHINGTON D.C." data-original="img/tild3534-6262-4331-b034-363634396230/Screen_Shot_20151128.png" style="background: url('img/tild3534-6262-4331-b034-363634396230/-/resize/20x/Screen_Shot_20151128.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3534-6262-4331-b034-363634396230/Screen_Shot_20151128.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__3" itemprop="description">WASHINGTON D.C.</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__4" data-zoom-target="4" data-zoomable="yes" data-img-zoom-url="img/tild3235-3562-4139-b232-636164636432/No_37__Palms.jpg" data-img-zoom-descr="MALAYSIAN PALMS" data-original="img/tild3235-3562-4139-b232-636164636432/No_37__Palms.jpg" style="background: url('img/tild3235-3562-4139-b232-636164636432/-/resize/20x/No_37__Palms.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3235-3562-4139-b232-636164636432/No_37__Palms.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__4" itemprop="description">MALAYSIAN PALMS</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__5" data-zoom-target="5" data-zoomable="yes" data-img-zoom-url="img/tild3462-6662-4865-b235-613331336231/No_43__Nardo_Ring.jpg" data-img-zoom-descr="NARDÒ RING" data-original="img/tild3462-6662-4865-b235-613331336231/No_43__Nardo_Ring.jpg" style="background: url('img/tild3462-6662-4865-b235-613331336231/-/resize/20x/No_43__Nardo_Ring.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3462-6662-4865-b235-613331336231/No_43__Nardo_Ring.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__5" itemprop="description">NARDÒ RING</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__6" data-zoom-target="6" data-zoomable="yes" data-img-zoom-url="img/tild6466-3136-4034-b139-386538336335/L1.png" data-img-zoom-descr="LONDON" data-original="img/tild6466-3136-4034-b139-386538336335/L1.png" style="background: url('img/tild6466-3136-4034-b139-386538336335/-/resize/20x/L1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6466-3136-4034-b139-386538336335/L1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__6" itemprop="description">LONDON</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__7" data-zoom-target="7" data-zoomable="yes" data-img-zoom-url="img/tild6237-3561-4835-a633-633662393038/THFull.png" data-img-zoom-descr="GERMANY STRIP MINING" data-original="img/tild6237-3561-4835-a633-633662393038/THFull.png" style="background: url('img/tild6237-3561-4835-a633-633662393038/-/resize/20x/THFull.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6237-3561-4835-a633-633662393038/THFull.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__7" itemprop="description">GERMANY STRIP MINING</div>
</div>
</div>
</div>
</div>
<style>
</style>
</div>
<div id="rec38011790" class="r t-rec t-rec_pt_0 t-rec_pb_0" style="padding-top:0px;padding-bottom:0px; " data-animationappear="off" data-record-type="603" >
<!-- t603-->
<div class="t603">
<div class="t603__container t-container" style="padding-bottom: 0px;">
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__0" data-zoom-target="0" data-zoomable="yes" data-img-zoom-url="img/tild3961-3463-4433-b831-633336636430/Rotterdam5_R1C1.jpg" data-img-zoom-descr="PORT OF ROTTERDAM" data-original="img/tild3961-3463-4433-b831-633336636430/Rotterdam5_R1C1.jpg" style="background: url('img/tild3961-3463-4433-b831-633336636430/-/resize/20x/Rotterdam5_R1C1.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3961-3463-4433-b831-633336636430/Rotterdam5_R1C1.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__0" itemprop="description">PORT OF ROTTERDAM</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__1" data-zoom-target="1" data-zoomable="yes" data-img-zoom-url="img/tild6630-6535-4337-a539-613739303933/JVille_R1C1.jpg" data-img-zoom-descr="TURBINE INTERCHANGE" data-original="img/tild6630-6535-4337-a539-613739303933/JVille_R1C1.jpg" style="background: url('img/tild6630-6535-4337-a539-613739303933/-/resize/20x/JVille_R1C1.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6630-6535-4337-a539-613739303933/JVille_R1C1.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__1" itemprop="description">TURBINE INTERCHANGE</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__2" data-zoom-target="2" data-zoomable="yes" data-img-zoom-url="img/tild6538-3966-4530-a433-623938336236/Screen_Shot_20151128.png" data-img-zoom-descr="LAKE MEAD" data-original="img/tild6538-3966-4530-a433-623938336236/Screen_Shot_20151128.png" style="background: url('img/tild6538-3966-4530-a433-623938336236/-/resize/20x/Screen_Shot_20151128.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6538-3966-4530-a433-623938336236/Screen_Shot_20151128.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__2" itemprop="description">LAKE MEAD</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__3" data-zoom-target="3" data-zoomable="yes" data-img-zoom-url="img/tild6231-3662-4031-a337-333438303666/Gemasolar_1.png" data-img-zoom-descr="SEVILLE CONCENTRATOR" data-original="img/tild6231-3662-4031-a337-333438303666/Gemasolar_1.png" style="background: url('img/tild6231-3662-4031-a337-333438303666/-/resize/20x/Gemasolar_1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6231-3662-4031-a337-333438303666/Gemasolar_1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__3" itemprop="description">SEVILLE CONCENTRATOR</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__4" data-zoom-target="4" data-zoomable="yes" data-img-zoom-url="img/tild3530-6439-4630-b430-383262653731/SpiralJetty_R1C1.jpg" data-img-zoom-descr="SPIRAL JETTY" data-original="img/tild3530-6439-4630-b430-383262653731/SpiralJetty_R1C1.jpg" style="background: url('img/tild3530-6439-4630-b430-383262653731/-/resize/20x/SpiralJetty_R1C1.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3530-6439-4630-b430-383262653731/SpiralJetty_R1C1.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__4" itemprop="description">SPIRAL JETTY</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__5" data-zoom-target="5" data-zoomable="yes" data-img-zoom-url="img/tild3434-3534-4334-a534-663631663263/Port_Newark.png" data-img-zoom-descr="PORT NEWARK CONTAINERS" data-original="img/tild3434-3534-4334-a534-663631663263/Port_Newark.png" style="background: url('img/tild3434-3534-4334-a534-663631663263/-/resize/20x/Port_Newark.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3434-3534-4334-a534-663631663263/Port_Newark.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__5" itemprop="description">PORT NEWARK CONTAINERS</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__6" data-zoom-target="6" data-zoomable="yes" data-img-zoom-url="img/tild3038-6439-4639-b336-386537633336/mc2.jpg" data-img-zoom-descr="NEZAHUALCÓYOTL" data-original="img/tild3038-6439-4639-b336-386537633336/mc2.jpg" style="background: url('img/tild3038-6439-4639-b336-386537633336/-/resize/20x/mc2.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3038-6439-4639-b336-386537633336/mc2.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__6" itemprop="description">NEZAHUALCÓYOTL</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__7" data-zoom-target="7" data-zoomable="yes" data-img-zoom-url="img/tild6633-3530-4832-a464-393938353530/No_41__Sunset_Distri.jpg" data-img-zoom-descr="SUNSET DISTRICT, SF" data-original="img/tild6633-3530-4832-a464-393938353530/No_41__Sunset_Distri.jpg" style="background: url('img/tild6633-3530-4832-a464-393938353530/-/resize/20x/No_41__Sunset_Distri.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6633-3530-4832-a464-393938353530/No_41__Sunset_Distri.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__7" itemprop="description">SUNSET DISTRICT, SF</div>
</div>
</div>
</div>
</div>
<style>
</style>
</div>
<div id="rec38011794" class="r t-rec t-rec_pt_0 t-rec_pb_0" style="padding-top:0px;padding-bottom:0px; " data-animationappear="off" data-record-type="603" >
<!-- t603-->
<div class="t603">
<div class="t603__container t-container" style="padding-bottom: 0px;">
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__0" data-zoom-target="0" data-zoomable="yes" data-img-zoom-url="img/tild3462-3462-4033-a666-313665633339/AMSR_R1C1.jpg" data-img-zoom-descr="AMSTERDAM" data-original="img/tild3462-3462-4033-a666-313665633339/AMSR_R1C1.jpg" style="background: url('img/tild3462-3462-4033-a666-313665633339/-/resize/20x/AMSR_R1C1.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3462-3462-4033-a666-313665633339/AMSR_R1C1.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__0" itemprop="description">AMSTERDAM</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__1" data-zoom-target="1" data-zoomable="yes" data-img-zoom-url="img/tild3337-3337-4261-b738-396432656133/Brasilia_4.jpg" data-img-zoom-descr="BRASILIA" data-original="img/tild3337-3337-4261-b738-396432656133/Brasilia_4.jpg" style="background: url('img/tild3337-3337-4261-b738-396432656133/-/resize/20x/Brasilia_4.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3337-3337-4261-b738-396432656133/Brasilia_4.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__1" itemprop="description">BRASILIA</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__2" data-zoom-target="2" data-zoomable="yes" data-img-zoom-url="img/tild6663-3332-4961-a466-383961393461/Tulips.png" data-img-zoom-descr="DUTCH TULIPS" data-original="img/tild6663-3332-4961-a466-383961393461/Tulips.png" style="background: url('img/tild6663-3332-4961-a466-383961393461/-/resize/20x/Tulips.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6663-3332-4961-a466-383961393461/Tulips.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__2" itemprop="description">DUTCH TULIPS</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__3" data-zoom-target="3" data-zoomable="yes" data-img-zoom-url="img/tild3266-6564-4638-a364-373638636334/Stelvio1.jpg" data-img-zoom-descr="STELVIO PASS" data-original="img/tild3266-6564-4638-a364-373638636334/Stelvio1.jpg" style="background: url('img/tild3266-6564-4638-a364-373638636334/-/resize/20x/Stelvio1.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3266-6564-4638-a364-373638636334/Stelvio1.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__3" itemprop="description">STELVIO PASS</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__4" data-zoom-target="4" data-zoomable="yes" data-img-zoom-url="img/tild3739-6665-4536-b037-663130336236/Glastobury_R1C1__Ver.jpg" data-img-zoom-descr="GLASTONBURY FESTIVAL" data-original="img/tild3739-6665-4536-b037-663130336236/Glastobury_R1C1__Ver.jpg" style="background: url('img/tild3739-6665-4536-b037-663130336236/-/resize/20x/Glastobury_R1C1__Ver.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3739-6665-4536-b037-663130336236/Glastobury_R1C1__Ver.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__4" itemprop="description">GLASTONBURY FESTIVAL</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__5" data-zoom-target="5" data-zoomable="yes" data-img-zoom-url="img/tild6565-3734-4833-b539-616537636463/AA2.png" data-img-zoom-descr="ADDIS ABABA AGRICULTURE" data-original="img/tild6565-3734-4833-b539-616537636463/AA2.png" style="background: url('img/tild6565-3734-4833-b539-616537636463/-/resize/20x/AA2.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6565-3734-4833-b539-616537636463/AA2.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__5" itemprop="description">ADDIS ABABA AGRICULTURE</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__6" data-zoom-target="6" data-zoomable="yes" data-img-zoom-url="img/tild6165-3532-4261-b062-396364613664/GribbensTailingBasin.jpg" data-img-zoom-descr="MICHIGAN TAILINGS" data-original="img/tild6165-3532-4261-b062-396364613664/GribbensTailingBasin.jpg" style="background: url('img/tild6165-3532-4261-b062-396364613664/-/resize/20x/GribbensTailingBasin.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6165-3532-4261-b062-396364613664/GribbensTailingBasin.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__6" itemprop="description">MICHIGAN TAILINGS</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__7" data-zoom-target="7" data-zoomable="yes" data-img-zoom-url="img/tild6466-3264-4664-a430-336139653133/DAB.jpg" data-img-zoom-descr="DURRAT AL-BAHRAIN" data-original="img/tild6466-3264-4664-a430-336139653133/DAB.jpg" style="background: url('img/tild6466-3264-4664-a430-336139653133/-/resize/20x/DAB.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6466-3264-4664-a430-336139653133/DAB.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__7" itemprop="description">DURRAT AL-BAHRAIN</div>
</div>
</div>
</div>
</div>
<style>
</style>
</div>
<div id="rec38011863" class="r t-rec t-rec_pt_0 t-rec_pb_0" style="padding-top:0px;padding-bottom:0px; " data-animationappear="off" data-record-type="603" >
<!-- t603-->
<div class="t603">
<div class="t603__container t-container" >
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__0" data-zoom-target="0" data-zoomable="yes" data-img-zoom-url="img/tild3431-3638-4132-b231-353637353066/Gibraltar_R1C1_1.jpg" data-img-zoom-descr="GIBRALTAR AIRPORT" data-original="img/tild3431-3638-4132-b231-353637353066/Gibraltar_R1C1_1.jpg" style="background: url('img/tild3431-3638-4132-b231-353637353066/-/resize/20x/Gibraltar_R1C1_1.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3431-3638-4132-b231-353637353066/Gibraltar_R1C1_1.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__0" itemprop="description">GIBRALTAR AIRPORT</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__1" data-zoom-target="1" data-zoomable="yes" data-img-zoom-url="img/tild6561-3831-4536-a633-396136323864/Screen_Shot_20151129.png" data-img-zoom-descr="BORA BORA RESORT" data-original="img/tild6561-3831-4536-a633-396136323864/Screen_Shot_20151129.png" style="background: url('img/tild6561-3831-4536-a633-396136323864/-/resize/20x/Screen_Shot_20151129.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6561-3831-4536-a633-396136323864/Screen_Shot_20151129.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__1" itemprop="description">BORA BORA RESORT</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__2" data-zoom-target="2" data-zoomable="yes" data-img-zoom-url="img/tild3830-6564-4338-a261-383862326264/Seoul_R1C1__Version_.jpg" data-img-zoom-descr="ANSAN INDUSTRIAL SECTOR" data-original="img/tild3830-6564-4338-a261-383862326264/Seoul_R1C1__Version_.jpg" style="background: url('img/tild3830-6564-4338-a261-383862326264/-/resize/20x/Seoul_R1C1__Version_.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3830-6564-4338-a261-383862326264/Seoul_R1C1__Version_.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__2" itemprop="description">ANSAN INDUSTRIAL SECTOR</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__3" data-zoom-target="3" data-zoomable="yes" data-img-zoom-url="img/tild6365-3434-4635-a534-303761623130/Aluminum_Waste_Full.jpg" data-img-zoom-descr="RED MUD POND" data-original="img/tild6365-3434-4635-a534-303761623130/Aluminum_Waste_Full.jpg" style="background: url('img/tild6365-3434-4635-a534-303761623130/-/resize/20x/Aluminum_Waste_Full.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6365-3434-4635-a534-303761623130/Aluminum_Waste_Full.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__3" itemprop="description">RED MUD POND</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__4" data-zoom-target="4" data-zoomable="yes" data-img-zoom-url="img/tild3530-3664-4239-a531-636130616634/Roseville3_R1C1.jpg" data-img-zoom-descr="ROSEVILLE YARD" data-original="img/tild3530-3664-4239-a531-636130616634/Roseville3_R1C1.jpg" style="background: url('img/tild3530-3664-4239-a531-636130616634/-/resize/20x/Roseville3_R1C1.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3530-3664-4239-a531-636130616634/Roseville3_R1C1.jpg">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__4" itemprop="description">ROSEVILLE YARD</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__5" data-zoom-target="5" data-zoomable="yes" data-img-zoom-url="img/tild6130-6562-4430-b836-383533363433/NBBR1.png" data-img-zoom-descr="RESERVOIR HOUSEBOATS" data-original="img/tild6130-6562-4430-b836-383533363433/NBBR1.png" style="background: url('img/tild6130-6562-4430-b836-383533363433/-/resize/20x/NBBR1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6130-6562-4430-b836-383533363433/NBBR1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__5" itemprop="description">RESERVOIR HOUSEBOATS</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__6" data-zoom-target="6" data-zoomable="yes" data-img-zoom-url="img/tild6434-3565-4966-a433-313535343163/Riyahd_1.png" data-img-zoom-descr="RIYADH AIRPORT" data-original="img/tild6434-3565-4966-a433-313535343163/Riyahd_1.png" style="background: url('img/tild6434-3565-4966-a433-313535343163/-/resize/20x/Riyahd_1.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6434-3565-4966-a433-313535343163/Riyahd_1.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__6" itemprop="description">RIYADH AIRPORT</div>
</div>
</div>
<div class="t603__tile t603__tile_25" itemscope itemtype="http://schema.org/ImageObject">
<div class="t603__blockimg t603__blockimg_1-1 t-bgimg" bgimgfield="gi_img__7" data-zoom-target="7" data-zoomable="yes" data-img-zoom-url="img/tild3638-3162-4161-b739-623332313139/Screen_Shot_20151128.png" data-img-zoom-descr="MECCA" data-original="img/tild3638-3162-4161-b739-623332313139/Screen_Shot_20151128.png" style="background: url('img/tild3638-3162-4161-b739-623332313139/-/resize/20x/Screen_Shot_20151128.png') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3638-3162-4161-b739-623332313139/Screen_Shot_20151128.png">
</div>
<div class="t603__textwrapper t-align_left">
<div class="t603__descr t-text t-text_xs" data-redactor-toolbar="no" field="gi_descr__7" itemprop="description">MECCA</div>
</div>
</div>
</div>
</div>
<style>
</style>
</div>
<div id="rec38167909" class="r t-rec t-rec_pt_150 t-rec_pb_0" style="padding-top:150px;padding-bottom:0px; " data-animationappear="off" data-record-type="744" >
<!-- t744 -->
<div class="t744">
<div class="t-container js-product">
<div class="t744__col t744__col_first t-col t-col_8 ">
<!-- gallery -->
<div class="t-slds" style="visibility: hidden;">
<div class="t-slds__main">
<div class="t-slds__container" >
<div class="t-slds__items-wrapper t-slds_animated-none " data-slider-transition="300" data-slider-with-cycle="true" data-slider-correct-height="true" data-auto-correct-mobile-width="false" >
<div class="t-slds__item t-slds__item_active" data-slide-index="1">
<div class="t-slds__wrapper" itemscope itemtype="http://schema.org/ImageObject">
<meta itemprop="image" content="img/tild6238-6166-4838-a465-396564303237/_10.png">
<div class="t-slds__imgwrapper" bgimgfield="gi_img__0" >
<div class="t-slds__bgimg t-slds__bgimg-contain t-bgimg js-product-img" data-original="img/tild6238-6166-4838-a465-396564303237/_10.png" style="padding-bottom:75%; background-image: url('img/tild6238-6166-4838-a465-396564303237/-/resize/20x/_10.png');">
</div>
</div>
</div>
</div>
<div class="t-slds__item " data-slide-index="2">
<div class="t-slds__wrapper" itemscope itemtype="http://schema.org/ImageObject">
<meta itemprop="image" content="img/tild6639-6335-4063-b831-336537653331/_10_1.png">
<div class="t-slds__imgwrapper" bgimgfield="gi_img__1" >
<div class="t-slds__bgimg t-slds__bgimg-contain t-bgimg " data-original="img/tild6639-6335-4063-b831-336537653331/_10_1.png" style="padding-bottom:75%; background-image: url('img/tild6639-6335-4063-b831-336537653331/-/resize/20x/_10_1.png');">
</div>
</div>
</div>
</div>
<div class="t-slds__item " data-slide-index="3">
<div class="t-slds__wrapper" itemscope itemtype="http://schema.org/ImageObject">
<meta itemprop="image" content="img/tild3462-3936-4337-b965-613963356333/_10_2.png">
<div class="t-slds__imgwrapper" bgimgfield="gi_img__2" >
<div class="t-slds__bgimg t-slds__bgimg-contain t-bgimg " data-original="img/tild3462-3936-4337-b965-613963356333/_10_2.png" style="padding-bottom:75%; background-image: url('img/tild3462-3936-4337-b965-613963356333/-/resize/20x/_10_2.png');">
</div>
</div>
</div>
</div>
</div>
<div class="t-slds__arrow_container ">
<div class="t-slds__arrow_wrapper t-slds__arrow_wrapper-left" data-slide-direction="left">
<div class="t-slds__arrow t-slds__arrow-left t-slds__arrow-withbg" style="width: 30px; height: 30px;background-color: rgba(255,255,255,1);">
<div class="t-slds__arrow_body t-slds__arrow_body-left" style="width: 7px;">
<svg style="display: block" viewBox="0 0 7.3 13" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<desc>Left</desc>
<polyline fill="none" stroke="#222" stroke-linejoin="butt" stroke-linecap="butt" stroke-width="1" points="0.5,0.5 6.5,6.5 0.5,12.5" />
</svg>
</div>
</div>
</div>
<div class="t-slds__arrow_wrapper t-slds__arrow_wrapper-right" data-slide-direction="right">
<div class="t-slds__arrow t-slds__arrow-right t-slds__arrow-withbg" style="width: 30px; height: 30px;background-color: rgba(255,255,255,1);">
<div class="t-slds__arrow_body t-slds__arrow_body-right" style="width: 7px;">
<svg style="display: block" viewBox="0 0 7.3 13" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<desc>Right</desc>
<polyline fill="none" stroke="#222" stroke-linejoin="butt" stroke-linecap="butt" stroke-width="1" points="0.5,0.5 6.5,6.5 0.5,12.5" />
</svg>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<style type="text/css"> #rec38167909 .t-slds__bullet_active .t-slds__bullet_body { background-color: #222 !important; } #rec38167909 .t-slds__bullet:hover .t-slds__bullet_body { background-color: #222 !important; }</style>
<!--/gallery -->
</div>
<div class="t744__col t-col t-col_4 ">
<div class="t744__info">
<div class="t744__textwrapper">
<div class="t744__title-wrapper">
<div class="t744__title t-name t-name_xl js-product-name" field="title" style="">ЛАГУНА ШАДЕГАН</div>
<div class="t744__title_small t-descr t-descr_xxs js-product-sku" field="title2" style="">30·327274°, 48·829255°</div>
</div>
<div class="t744__price-wrapper">
<div class="t744__price t744__price-item t-name t-name_md" style="margin-right:5px;">
<div class="t744__price-value js-product-price" field="price" data-redactor-toolbar="no">150.00 ₽ </div>
<div class="t744__price-currency">₽ </div>
</div>
</div>
<div class="t-product__option js-product-option">
<div class="t-product__option-title t-descr t-descr_xxs js-product-option-name" >Формат 2:3</div>
<div class="t-product__option-variants">
<select class="t-product__option-select t-descr t-descr_xxs js-product-option-variants">
<option value="30×45 cm" data-product-variant-price="150.00 ₽">30×45 cm</option>
<option value="60×90 cm" data-product-variant-price="250.00 ₽">60×90 cm</option>
<option value="90×135 cm" data-product-variant-price="400.00 ₽">90×135 cm</option>
</select>
</div>
</div>
<div class="t-product__option js-product-option">
<div class="t-product__option-title t-descr t-descr_xxs js-product-option-name" >Тип печати</div>
<div class="t-product__option-variants">
<select class="t-product__option-select t-descr t-descr_xxs js-product-option-variants">
<option value="Постер" data-product-variant-price="">Постер</option>
<option value="Холст" data-product-variant-price="">Холст</option>
<option value="Пластификация" data-product-variant-price="">Пластификация</option>
</select>
</div>
</div>
<div class="t-product__option js-product-option">
<div class="t-product__option-title t-descr t-descr_xxs js-product-option-name" >Заказать печать карточки с информацией о фотографии</div>
<div class="t-product__option-variants">
<select class="t-product__option-select t-descr t-descr_xxs js-product-option-variants">
<option value="нет" data-product-variant-price="">нет</option>
<option value="да" data-product-variant-price="">да</option>
</select>
</div>
</div>
<div class="t744__btn-wrapper">
<a href="#order" target="" class="t744__btn t-btn t-btn_sm " style="color:#ffffff;background-color:#000000;border-radius:0px; -moz-border-radius:0px; -webkit-border-radius:0px;">
<table style="width:100%; height:100%;">
<tr>
<td>КУПИТЬ</td>
</tr>
</table>
</a>
</div>
<div class="t744__descr t-descr t-descr_xxs" field="descr" style="">Вокруг лагуны Шадеган в Муса-Бей, в Иране, видны дендритовые дренажные системы. Слово «дендритовый» означает «похожий на ветви дерева». Именно такой рисунок образуется, когда потоки движутся через относительно плоские и однородные скалы или по поверхности, устойчивой к эрозии. <br />
</div>
</div>
</div>
</div>
</div>
</div>
<style type="text/css"> #rec38167909 .t-slds__bullet_active .t-slds__bullet_body { background-color: #222 !important; } #rec38167909 .t-slds__bullet:hover .t-slds__bullet_body { background-color: #222 !important; }</style>
</div>
<div id="rec38570864" class="r t-rec t-rec_pt_30 t-rec_pb_0" style="padding-top:30px;padding-bottom:0px; " data-record-type="219" >
<!-- T191 -->
<div class="t191">
<div class="t-align_center">
<hr class="t191__line t-width t-width_2" style="background-color:#000000;opacity:0.2;">
</div>
</div>
</div>
<div id="rec38570726" class="r t-rec t-rec_pt_30" style="padding-top:30px; " data-record-type="147" >
<!-- t214-->
<div class="t214">
<div class="t-container">
<div class="t-row">
<div class="t-col t-col_4" style="margin-bottom:20px;" itemscope itemtype="http://schema.org/ImageObject">
<div class="t214__blockimg t-bgimg" bgimgfield="gi_img__0" data-zoom-target="0" data-original="img/tild6531-3738-4463-a565-373166616661/1.jpg" style="background: url('img/tild6531-3738-4463-a565-373166616661/-/resize/20x/1.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6531-3738-4463-a565-373166616661/1.jpg">
</div>
<div class="t214__textwrapper t-align_left">
<div class="t214__descr t-text" data-redactor-toolbar="no" field="gi_descr__0" itemprop="description">Бумажный постер</div>
</div>
</div>
<div class="t-col t-col_4" style="margin-bottom:20px;" itemscope itemtype="http://schema.org/ImageObject">
<div class="t214__blockimg t-bgimg" bgimgfield="gi_img__1" data-zoom-target="1" data-original="img/tild3766-3537-4137-b164-653762626363/2.jpg" style="background: url('img/tild3766-3537-4137-b164-653762626363/-/resize/20x/2.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3766-3537-4137-b164-653762626363/2.jpg">
</div>
</div>
<div class="t-col t-col_4" style="margin-bottom:20px;" itemscope itemtype="http://schema.org/ImageObject">
<div class="t214__blockimg t-bgimg" bgimgfield="gi_img__2" data-zoom-target="2" data-original="img/tild3965-6631-4334-a335-373538356237/3.jpg" style="background: url('img/tild3965-6631-4334-a335-373538356237/-/resize/20x/3.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3965-6631-4334-a335-373538356237/3.jpg">
</div>
</div>
</div>
<div class="t-row">
</div>
</div>
</div>
</div>
<div id="rec38570875" class="r t-rec t-rec_pt_0 t-rec_pb_0" style="padding-top:0px;padding-bottom:0px; " data-record-type="219" >
<!-- T191 -->
<div class="t191">
<div class="t-align_center">
<hr class="t191__line t-width t-width_2" style="background-color:#000000;opacity:0.2;">
</div>
</div>
</div>
<div id="rec38570888" class="r t-rec t-rec_pt_30" style="padding-top:30px; " data-record-type="147" >
<!-- t214-->
<div class="t214">
<div class="t-container">
<div class="t-row">
<div class="t-col t-col_4" style="margin-bottom:20px;" itemscope itemtype="http://schema.org/ImageObject">
<div class="t214__blockimg t-bgimg" bgimgfield="gi_img__0" data-zoom-target="0" data-original="img/tild3739-6431-4134-b537-376339333635/1.jpg" style="background: url('img/tild3739-6431-4134-b537-376339333635/-/resize/20x/1.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3739-6431-4134-b537-376339333635/1.jpg">
</div>
<div class="t214__textwrapper t-align_left">
<div class="t214__descr t-text" data-redactor-toolbar="no" field="gi_descr__0" itemprop="description">Постер на холсте</div>
</div>
</div>
<div class="t-col t-col_4" style="margin-bottom:20px;" itemscope itemtype="http://schema.org/ImageObject">
<div class="t214__blockimg t-bgimg" bgimgfield="gi_img__1" data-zoom-target="1" data-original="img/tild3037-3233-4837-a330-383431666535/2.jpg" style="background: url('img/tild3037-3233-4837-a330-383431666535/-/resize/20x/2.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3037-3233-4837-a330-383431666535/2.jpg">
</div>
</div>
<div class="t-col t-col_4" style="margin-bottom:20px;" itemscope itemtype="http://schema.org/ImageObject">
<div class="t214__blockimg t-bgimg" bgimgfield="gi_img__2" data-zoom-target="2" data-original="img/tild6566-3430-4264-b466-383932656662/3.jpg" style="background: url('img/tild6566-3430-4264-b466-383932656662/-/resize/20x/3.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild6566-3430-4264-b466-383932656662/3.jpg">
</div>
</div>
</div>
<div class="t-row">
</div>
</div>
</div>
</div>
<div id="rec38571077" class="r t-rec t-rec_pt_0 t-rec_pb_0" style="padding-top:0px;padding-bottom:0px; " data-record-type="219" >
<!-- T191 -->
<div class="t191">
<div class="t-align_center">
<hr class="t191__line t-width t-width_2" style="background-color:#000000;opacity:0.2;">
</div>
</div>
</div>
<div id="rec38571103" class="r t-rec t-rec_pt_30" style="padding-top:30px; " data-record-type="147" >
<!-- t214-->
<div class="t214">
<div class="t-container">
<div class="t-row">
<div class="t-col t-col_4" style="margin-bottom:20px;" itemscope itemtype="http://schema.org/ImageObject">
<div class="t214__blockimg t-bgimg" bgimgfield="gi_img__0" data-zoom-target="0" data-original="img/tild3539-6265-4264-b162-353461373633/1.jpg" style="background: url('img/tild3539-6265-4264-b162-353461373633/-/resize/20x/1.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3539-6265-4264-b162-353461373633/1.jpg">
</div>
<div class="t214__textwrapper t-align_left">
<div class="t214__descr t-text" data-redactor-toolbar="no" field="gi_descr__0" itemprop="description">Пластификация постера</div>
</div>
</div>
<div class="t-col t-col_4" style="margin-bottom:20px;" itemscope itemtype="http://schema.org/ImageObject">
<div class="t214__blockimg t-bgimg" bgimgfield="gi_img__1" data-zoom-target="1" data-original="img/tild3834-6637-4663-b136-333637383739/2.jpg" style="background: url('img/tild3834-6637-4663-b136-333637383739/-/resize/20x/2.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3834-6637-4663-b136-333637383739/2.jpg">
</div>
</div>
<div class="t-col t-col_4" style="margin-bottom:20px;" itemscope itemtype="http://schema.org/ImageObject">
<div class="t214__blockimg t-bgimg" bgimgfield="gi_img__2" data-zoom-target="2" data-original="img/tild3534-6333-4364-b233-373464323031/3.jpg" style="background: url('img/tild3534-6333-4364-b233-373464323031/-/resize/20x/3.jpg') center center no-repeat; background-size:cover;">
<meta itemprop="image" content="img/tild3534-6333-4364-b233-373464323031/3.jpg">
</div>
</div>
</div>
<div class="t-row">
</div>
</div>
</div>
</div>
<div id="rec38180097" class="r t-rec t-rec_pt_180 t-rec_pb_120" style="padding-top:180px;padding-bottom:120px; " data-record-type="528" >
<!-- t528 -->
<div class="t528">
<div class="t-section__container t-container">
<div class="t-col t-col_12">
<div class="t-section__topwrapper t-align_center">
<div class="t-section__title t-title t-title_xs" field="btitle">
<div style="font-size:82px;" data-customstyle="yes">ОТЗЫВЫ В СМИ</div>
</div>
</div>
</div>
</div>
<div class="t528__container t-container">
<div class="t528__col t-col t-col_4 t-align_center">
<div class="t528__bgimg t-margin_auto t-bgimg" data-original="img/tild3534-6666-4036-a430-613461313232/TheGuardianlogo1_cop.png" bgimgfield="li_img__1478014691630" style=" background-image: url('img/tild3534-6666-4036-a430-613461313232/-/resize/20x/TheGuardianlogo1_cop.png');" >
</div>
<div class="t528__text t-text t-text_xs t-margin_auto" field="li_text__1478014691630" style=" ">Потрясающие, удивительные, <br />интригующие фотографии Земли, <br />сделанные на небесах<br />
</div>
</div>
<div class="t528__col t-col t-col_4 t-align_center">
<div class="t528__bgimg t-margin_auto t-bgimg" data-original="img/tild6637-3332-4261-b461-333536643238/bbc_logo1600.png" bgimgfield="li_img__1478014727987" style=" background-image: url('img/tild6637-3332-4261-b461-333536643238/-/resize/20x/bbc_logo1600.png');" >
</div>
<div class="t528__text t-text t-text_xs t-margin_auto" field="li_text__1478014727987" style=" ">Невероятные образы — <br />такой Землю вы ещё не видели<br />
</div>
</div>
<div class="t528__col t-col t-col_4 t-align_center">
<div class="t528__bgimg t-margin_auto t-bgimg" data-original="img/tild3931-6266-4035-b036-313734326164/The_Atlantic_magazin.png" bgimgfield="li_img__1478014761774" style=" background-image: url('img/tild3931-6266-4035-b036-313734326164/-/resize/20x/The_Atlantic_magazin.png');" >
</div>
<div class="t528__text t-text t-text_xs t-margin_auto" field="li_text__1478014761774" style=" ">Великолепие Земли, вид сверху<br />
</div>
</div>
<div class="t-clear t528__separator" style="">
</div>
<div class="t528__col t-col t-col_4 t-align_center">
<div class="t528__bgimg t-margin_auto t-bgimg" data-original="img/tild3231-3332-4131-b636-326162326339/fast_company.gif" bgimgfield="li_img__1478014798002" style=" background-image: url('img/tild3231-3332-4131-b636-326162326339/-/resize/20x/fast_company.gif');" >
</div>
<div class="t528__text t-text t-text_xs t-margin_auto" field="li_text__1478014798002" style=" ">Эти фотографии изменят <br />ваш взгляд на нашу планету <br />
</div>
</div>
<div class="t528__col t-col t-col_4 t-align_center">
<div class="t528__bgimg t-margin_auto t-bgimg" data-original="img/tild3432-6631-4734-b131-303935643562/__20170926__151809_c.png" bgimgfield="li_img__1511358023811" style=" background-image: url('img/tild3432-6631-4734-b131-303935643562/-/resize/20x/__20170926__151809_c.png');" >
</div>
<div class="t528__text t-text t-text_xs t-margin_auto" field="li_text__1511358023811" style=" ">Мастерство и изобретательность <br />в поиске и представлении изображений <br />
</div>
</div>
<div class="t528__col t-col t-col_4 t-align_center">
<div class="t528__bgimg t-margin_auto t-bgimg" data-original="img/tild3266-3436-4037-a361-316236373166/huffpo_logo_copy.png" bgimgfield="li_img__1511358089810" style=" background-image: url('img/tild3266-3436-4037-a361-316236373166/-/resize/20x/huffpo_logo_copy.png');" >
</div>
<div class="t528__text t-text t-text_xs t-margin_auto" field="li_text__1511358089810" style=" ">Оглушительно</div>
</div>
</div>
</div>
</div>
<div id="rec37917125" class="r t-rec t-rec_pt_0 t-rec_pb_0" style="padding-top:0px;padding-bottom:0px;background-color:#ffffff; " data-record-type="212" data-bg-color="#ffffff">
<!-- T188 -->
<div class="t188">
<div class="t-container_100">
<div class="t188__wrapone">
<div class="t188__wraptwo">
<div class="t188__sociallinkimg">
<a href="https://www.facebook.com/tildapublishing" target="_blank" rel="nofollow">
<svg class="t-sociallinks__svg" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="48px" height="48px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xml:space="preserve">
<desc>Facebook</desc>
<path d="M47.761,24c0,13.121-10.638,23.76-23.758,23.76C10.877,47.76,0.239,37.121,0.239,24c0-13.124,10.638-23.76,23.764-23.76C37.123,0.24,47.761,10.876,47.761,24 M20.033,38.85H26.2V24.01h4.163l0.539-5.242H26.2v-3.083c0-1.156,0.769-1.427,1.308-1.427h3.318V9.168L26.258,9.15c-5.072,0-6.225,3.796-6.225,6.224v3.394H17.1v5.242h2.933V38.85z"/>
</svg>
</a>
</div>
<div class="t188__sociallinkimg">
<a href="https://www.twitter.com/" target="_blank" rel="nofollow">
<svg class="t-sociallinks__svg" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="48px" height="48px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xml:space="preserve">
<desc>Twitter</desc>
<path d="M47.762,24c0,13.121-10.639,23.76-23.761,23.76S0.24,37.121,0.24,24c0-13.124,10.639-23.76,23.761-23.76 S47.762,10.876,47.762,24 M38.031,12.375c-1.177,0.7-2.481,1.208-3.87,1.481c-1.11-1.186-2.694-1.926-4.455-1.926 c-3.364,0-6.093,2.729-6.093,6.095c0,0.478,0.054,0.941,0.156,1.388c-5.063-0.255-9.554-2.68-12.559-6.367 c-0.524,0.898-0.825,1.947-0.825,3.064c0,2.113,1.076,3.978,2.711,5.07c-0.998-0.031-1.939-0.306-2.761-0.762v0.077 c0,2.951,2.1,5.414,4.889,5.975c-0.512,0.14-1.05,0.215-1.606,0.215c-0.393,0-0.775-0.039-1.146-0.109 c0.777,2.42,3.026,4.182,5.692,4.232c-2.086,1.634-4.712,2.607-7.567,2.607c-0.492,0-0.977-0.027-1.453-0.084 c2.696,1.729,5.899,2.736,9.34,2.736c11.209,0,17.337-9.283,17.337-17.337c0-0.263-0.004-0.527-0.017-0.789 c1.19-0.858,2.224-1.932,3.039-3.152c-1.091,0.485-2.266,0.811-3.498,0.958C36.609,14.994,37.576,13.8,38.031,12.375"/>
</svg>
</a>
</div>
<div class="t188__sociallinkimg">
<a href="index.html" target="_blank" rel="nofollow">
<svg class="t-sociallinks__svg" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="48px" height="48px" viewBox="-455 257 48 48" enable-background="new -455 257 48 48" xml:space="preserve">
<desc>Youtube</desc>
<path d="M-431,257.013c13.248,0,23.987,10.74,23.987,23.987s-10.74,23.987-23.987,23.987s-23.987-10.74-23.987-23.987S-444.248,257.013-431,257.013z M-419.185,275.093c-0.25-1.337-1.363-2.335-2.642-2.458c-3.054-0.196-6.119-0.355-9.178-0.357c-3.059-0.002-6.113,0.154-9.167,0.347c-1.284,0.124-2.397,1.117-2.646,2.459c-0.284,1.933-0.426,3.885-0.426,5.836s0.142,3.903,0.426,5.836c0.249,1.342,1.362,2.454,2.646,2.577c3.055,0.193,6.107,0.39,9.167,0.39c3.058,0,6.126-0.172,9.178-0.37c1.279-0.124,2.392-1.269,2.642-2.606c0.286-1.93,0.429-3.879,0.429-5.828C-418.756,278.971-418.899,277.023-419.185,275.093zM-433.776,284.435v-7.115l6.627,3.558L-433.776,284.435z"/>
</svg>
</a>
</div>
<div class="t188__sociallinkimg">
<a href="index.html" target="_blank" rel="nofollow">
<svg class="t-sociallinks__svg" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48px" height="48px" viewBox="0 0 30 30" xml:space="preserve">
<desc>Instagram</desc>
<path d="M15,11.014 C12.801,11.014 11.015,12.797 11.015,15 C11.015,17.202 12.802,18.987 15,18.987 C17.199,18.987 18.987,17.202 18.987,15 C18.987,12.797 17.199,11.014 15,11.014 L15,11.014 Z M15,17.606 C13.556,17.606 12.393,16.439 12.393,15 C12.393,13.561 13.556,12.394 15,12.394 C16.429,12.394 17.607,13.561 17.607,15 C17.607,16.439 16.444,17.606 15,17.606 L15,17.606 Z">
</path>
<path d="M19.385,9.556 C18.872,9.556 18.465,9.964 18.465,10.477 C18.465,10.989 18.872,11.396 19.385,11.396 C19.898,11.396 20.306,10.989 20.306,10.477 C20.306,9.964 19.897,9.556 19.385,9.556 L19.385,9.556 Z">
</path>
<path d="M15.002,0.15 C6.798,0.15 0.149,6.797 0.149,15 C0.149,23.201 6.798,29.85 15.002,29.85 C23.201,29.85 29.852,23.202 29.852,15 C29.852,6.797 23.201,0.15 15.002,0.15 L15.002,0.15 Z M22.666,18.265 C22.666,20.688 20.687,22.666 18.25,22.666 L11.75,22.666 C9.312,22.666 7.333,20.687 7.333,18.28 L7.333,11.734 C7.333,9.312 9.311,7.334 11.75,7.334 L18.25,7.334 C20.688,7.334 22.666,9.312 22.666,11.734 L22.666,18.265 L22.666,18.265 Z">
</path>
</svg>
</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	t744_init('38167909');
	$(".certificate_popup_close").click(function(){
        $(".certificate_popup").hide();
        $('.layout').hide();
    })
});
    function create_certificate_order(){
        var form_valid = true;
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        // просматриваем все поля на предмет заполненности
        $(".active_certificate_block input").each(function(){
            if (!$(this).val()) {
                form_valid = false;
                $(this).css("border-color", "red");
            } else {
                if ($(this).attr("name") == 'natural_email' || $(this).attr("name") == 'legal_email') {
                    if (!(pattern.test($(this).val()))) {
                        form_valid = false;
                        $(this).css("border-color", "red");
                    } else {
                        $(this).css("border-color", "#f0f0f0");
                    }
                }
            }
        });
        // если все ок, то сабмитим
        if (form_valid) {
            var natural_person_email = $("#natural_email").val(),
            selected_tab = $(".certificate_tab_active").data("popup-block");
            $("input[name='certificate_quantity']").val($(".transparent_input").val());
            var certificate_price = parseInt($("input[name='certificate_price']").val());
            var certificate_quantity = parseInt($(".transparent_input").val());
            $.ajax({
                url: '/ajax/ajax_create_overview_print_order.php.php',
                type: "POST",
                data: {
                    data: $("#certificate_form").serialize(),
                    person_type: selected_tab
                }
            }).done(function(result) {
                var certificate_result = JSON.parse(result);
                if (certificate_result.status == "success") {
                    order_id = certificate_result.data;
                    $("#certificate_form").remove();
                    if (selected_tab == "natural_person") {
                        // физ. лицо
                        var success_message = "<?= GetMessage('NATURAL_SUCCESS_MESSAGE') ?>";
                        $(".submit_rfi").attr("data-email", natural_person_email);
                        $(".submit_rfi").attr("data-comment", "CERT_" + order_id);
                        $(".submit_rfi").attr("data-orderid", "CERT_" + order_id);
                        $(".submit_rfi").attr("data-cost", certificate_price * certificate_quantity);
                        $(".submit_rfi").click();
                        $("<span>" + success_message.replace("#NUM#", order_id) + "</span>").insertBefore(".certificate_popup_close");
                    } else {
                        // юр. лицо
                        var success_message = "<?= GetMessage('LEGAL_SUCCESS_MESSAGE') ?>";
                        $("<span>" + success_message.replace("#NUM#", order_id) + "</span>").insertBefore(".certificate_popup_close");
                    }
                } else {
                    console.error(certificate_result.data);
                }
            });
        }
    }
</script>
</body>
</html>