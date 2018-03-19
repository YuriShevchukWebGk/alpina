<script src="https://cdnjs.cloudflare.com/ajax/libs/instafeed.js/1.4.1/instafeed.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.7/jquery.lazy.min.js"></script>
<style>
#instafeed {height:320px;overflow:hidden;margin:50px auto 20px}#instafeed a {margin:10px 0 0 15px;display:inline-block;position:relative;width:300px;height:0;overflow:hidden;-moz-border-radius:2px;border-radius:2px;padding-top:300px;}#instafeed .instagram-image {display:none;}#instafeed .hover-layer {margin:0;padding:0;background:#000;background:rgba(0,0,0,0.3);overflow:hidden;font-family:Helvetica-Neue, Helvetica, sans-serif;position:absolute;color:#fff;right:0;top:0;left:0;bottom:0;-webkit-border-radius:2px;-moz-border-radius:2px;border-radius:2px;opacity:0;filter:alpha(opacity=0);-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;-webkit-transition:opacity .2s ease;-moz-transition:opacity .2s ease;-o-transition:opacity .2s ease;-ms-transition:opacity .2s ease;transition:opacity .2s ease;text-align:center;display:flex;align-items:center;justify-content:center;}#instafeed .caption, #instafeed .likes {word-wrap:break-word;display:block;font-size:14pt;margin:0;}#instafeed .likes img {width:20px;height:auto;}#instafeed a:hover .hover-layer {opacity:1;filter:alpha(opacity=80);}
</style>

<div id="instafeed"></div>
<script type="text/javascript">
	var lazyfeed = new Instafeed({
		get: 'user',
		userId: 234788880,
		accessToken: '234788880.1677ed0.b4707b411f044b99985f95f1b044d7e7',
		limit:7,
		resolution:'standard_resolution',
		mock: false,
		useHttp: false,
		template:'<a class="lazy" data-src="{{image}}" style="background-position: center center;background-repeat: no-repeat;-ms-background-size: cover;-webkit-background-size: cover;-o-background-size: cover;-moz-background-size: cover;background-size: cover" href="{{link}}" target="_blank"><span class="instagram-{{type}}"></span><div class="hover-layer"><span class="likes"><img src="/include/instagram/likes.svg" /> &nbsp;{{likes}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="width:20px; height:auto" src="/include/instagramcomment.svg" /> &nbsp;{{comments}}</span></div></a>',
		after: function () {'use strict';
			$('.lazy').Lazy({
				scrollDirection: 'vertical',
				effect : "fadeIn",
				effectTime : 500,
				visibleOnly: true,
				threshold:70
			});
		}
	});
	lazyfeed.run();
</script>