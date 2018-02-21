<?if (1 == 1) {?>
<p class="titleMain no-mobile" style="font-size:48px;padding-bottom:20px;text-align:center;color:#3f4a4d;">Instagram</p>
<script src="//foursixty.com/media/scripts/fs.slider.v2.5.js" data-feed-id="alpina-publisher" data-theme="slider_v2_5" data-cell-size="16.66%"></script><style>.fs-has-links::after {  padding: 0px 7.5px; background-color: #fff; color: rgba(0,0,0,0.8); content: "КУПИТЬ";  }.fs-wrapper { height: auto } .fs-entry-container { height: 0 !important; width: 16.66% !important; padding-top: 16.66% !important; }.fs-wrapper div.fs-text-container .fs-entry-title, div.fs-detail-title{font-family:Helvetica, serif;font-style:italic;font-weight:normal;}div.fs-text-container .fs-entry-date, div.fs-detail-container .fs-post-info, div.fs-wrapper div.fs-has-links::after, .fs-text-product, .fs-overlink-text{font-family:Helvetica Neue, Helvetica, Arial, sans-serif;font-style:normal;font-weight:bold;}.fs-wrapper div.fs-text-container * {color:#fff}.fs-wrapper div.fs-text-container {background-color:rgba(0,0,0,0.8); margin: 0px}div.fs-entry-date{display:none}div.fs-entry-title{display:none}.fs-wrapper div.fs-timeline-entry{ margin: 0px }</style>
<?} else {?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/instafeed.js/1.4.1/instafeed.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.7/jquery.lazy.min.js"></script>
<style>
#instafeed {height:630px;overflow:hidden;clear:both}
#instafeed a {margin:0;display:inline-block;position:relative;width:16.66%;height:0;overflow:hidden;padding-top:16.6%}
#instafeed .instagram-image {display:none;}
#instafeed .hover-layer {margin:0;padding:0;background:#000;background:rgba(0,0,0,0.3);overflow:hidden;font-family:Helvetica-Neue, Helvetica, sans-serif;position:absolute;color:#fff;right:0;top:0;left:0;bottom:0;opacity:0;filter:alpha(opacity=0);-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;-webkit-transition:opacity .2s ease;-moz-transition:opacity .2s ease;-o-transition:opacity .2s ease;-ms-transition:opacity .2s ease;transition:opacity .2s ease;text-align:center;display:flex;align-items:center;justify-content:center;}
#instafeed .caption, #instafeed .likes {word-wrap:break-word;display:block;font-size:14pt;margin:0;}
#instafeed .likes img {width:20px;height:auto;}
#instafeed a:hover .hover-layer {opacity:1;filter:alpha(opacity=80);}
.instafeed {max-width:600px;width:100%;margin:0 auto 65px;text-align:center}
.instafeed div {padding:3px 10px;float:left}
.instafeed .active {background:#00abb8;border-radius:4px}
.instafeed .active span {color:#fff;border-bottom:none}
.instafeed span{color:#00abb8;font-size:20px;border-bottom:1px dashed;cursor:pointer}
.instafeed span:hover {border-bottom:none}
</style>
<p class="titleMain no-mobile" style="font-size:48px;padding-bottom:20px;text-align:center;color:#3f4a4d;">Instagram</p>

<div class="instafeed no-mobile">
<div class="active ap" onclick="changeFeed('ap');"><span>Альпина Паблишер</span></div>
<div class="anf" onclick="changeFeed('anf');"><span>Альпина Нон-фикшн</span></div>
<div class="ad" onclick="changeFeed('ad');"><span>Альпина.Дети</span></div>
</div>

<div id="instafeed" class="no-mobile"></div>

<script type="text/javascript">
	function changeFeed(feed) {
		$('#instafeed').empty();
		switch(feed) {
			case 'ap':
			default:
				userId = 234788880;
				accessToken = '234788880.1677ed0.b4707b411f044b99985f95f1b044d7e7';
				break;
			case 'anf':
				userId = 526445861;
				accessToken = '526445861.1677ed0.83228ef97e3f46859b97e833e93b0ba9';
				break;
			case 'ad':
				userId = 3089843803;
				accessToken = '3089843803.1677ed0.d1e6a7c5f4e14da5815fc69b2d31b8c1';
				break;
		}
		
		$(".instafeed div").removeClass('active');
		
		var lazyfeed = new Instafeed({
			get: 'user',
			userId: userId,
			accessToken: accessToken,
			limit:14,
			resolution:'standard_resolution',
			mock: false,
			useHttp: false,
			template:'<a class="lazy" data-src="{{image}}" onclick="popup(\'{{image}}\', \'{{caption}}\');" style="display:block;float:left;background-position: center center;background-repeat: no-repeat;-ms-background-size: cover;-webkit-background-size: cover;-o-background-size: cover;-moz-background-size: cover;background-size: cover" href="{{link}}" target="_blank"><span class="instagram-{{type}}"></span><div class="hover-layer"><span class="likes"><img src="/include/instagram/likes.svg" /> &nbsp;{{likes}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="width:20px; height:auto" src="/include/instagram/comment.svg" /> &nbsp;{{comments}}</span></div></a>',
			after: function () {
				'use strict';
				$('.lazy').Lazy({
					scrollDirection: 'vertical',
					effect : "fadeIn",
					effectTime : 500,
					visibleOnly: true,
					threshold:70
				});
				$('.'+feed).addClass('active');
			}
		});
		lazyfeed.run();
	}
	$(document).ready(function() {
		changeFeed('ap');
	});
</script>
<?}?>