function t396_init(recid){var data='';var res=t396_detectResolution();t396_initTNobj();t396_switchResolution(res);t396_updateTNobj();t396_artboard_build(data,recid);window.tn_window_width=$(window).width();$(window).resize(function(){tn_console('>>>> t396: Window on Resize event >>>>');t396_waitForFinalEvent(function(){if($isMobile){var ww=$(window).width();if(ww!=window.tn_window_width){t396_doResize(recid)}}else{t396_doResize(recid)}},500,'resizeruniqueid'+recid)});$(window).on("orientationchange",function(){tn_console('>>>> t396: Orient change event >>>>');t396_waitForFinalEvent(function(){t396_doResize(recid)},600,'orientationuniqueid'+recid)});$(window).load(function(){var ab=$('#rec'+recid).find('.t396__artboard');t396_allelems__renderView(ab)})}function t396_doResize(recid){var ww=$(window).width();window.tn_window_width=ww;var res=t396_detectResolution();var ab=$('#rec'+recid).find('.t396__artboard');t396_switchResolution(res);t396_updateTNobj();t396_ab__renderView(ab);t396_allelems__renderView(ab)}function t396_detectResolution(){var ww=$(window).width();var res;res=1200;if(ww<1200){res=960}if(ww<960){res=640}if(ww<640){res=480}if(ww<480){res=320}return(res)}function t396_initTNobj(){tn_console('func: initTNobj');window.tn={};window.tn.canvas_min_sizes=["320","480","640","960","1200"];window.tn.canvas_max_sizes=["480","640","960","1200",""];window.tn.ab_fields=["height","width","bgcolor","bgimg","bgattachment","bgposition","filteropacity","filtercolor","filteropacity2","filtercolor2","height_vh","valign"]}function t396_updateTNobj(){tn_console('func: updateTNobj');window.tn.window_width=parseInt($(window).width());window.tn.window_height=parseInt($(window).height());if(window.tn.curResolution==1200){window.tn.canvas_min_width=1200;window.tn.canvas_max_width=window.tn.window_width}if(window.tn.curResolution==960){window.tn.canvas_min_width=960;window.tn.canvas_max_width=1200}if(window.tn.curResolution==640){window.tn.canvas_min_width=640;window.tn.canvas_max_width=960}if(window.tn.curResolution==480){window.tn.canvas_min_width=480;window.tn.canvas_max_width=640}if(window.tn.curResolution==320){window.tn.canvas_min_width=320;window.tn.canvas_max_width=480}window.tn.grid_width=window.tn.canvas_min_width;window.tn.grid_offset_left=parseFloat((window.tn.window_width-window.tn.grid_width)/2)}var t396_waitForFinalEvent=(function(){var timers={};return function(callback,ms,uniqueId){if(!uniqueId){uniqueId="Don't call this twice without a uniqueId"}if(timers[uniqueId]){clearTimeout(timers[uniqueId])}timers[uniqueId]=setTimeout(callback,ms)}})();function t396_switchResolution(res,resmax){tn_console('func: switchResolution');if(typeof resmax=='undefined'){if(res==1200)resmax='';if(res==960)resmax=1200;if(res==640)resmax=960;if(res==480)resmax=640;if(res==320)resmax=480}window.tn.curResolution=res;window.tn.curResolution_max=resmax}function t396_artboard_build(data,recid){tn_console('func: t396_artboard_build. Recid:'+recid);tn_console(data);var ab=$('#rec'+recid).find('.t396__artboard');t396_ab__renderView(ab);ab.find('.tn-elem').each(function(){var item=$(this);if(item.attr('data-elem-type')=='text'){t396_addText(ab,item)}if(item.attr('data-elem-type')=='image'){t396_addImage(ab,item)}if(item.attr('data-elem-type')=='shape'){t396_addShape(ab,item)}if(item.attr('data-elem-type')=='button'){t396_addButton(ab,item)}if(item.attr('data-elem-type')=='video'){t396_addVideo(ab,item)}if(item.attr('data-elem-type')=='html'){t396_addHtml(ab,item)}if(item.attr('data-elem-type')=='tooltip'){t396_addTooltip(ab,item)}});$('#rec'+recid).find('.t396__artboard').removeClass('rendering').addClass('rendered')}function t396_ab__renderView(ab){var fields=window.tn.ab_fields;for(var i=0;i<fields.length;i++){t396_ab__renderViewOneField(ab,fields[i])}var ab_min_height=t396_ab__getFieldValue(ab,'height');var ab_max_height=t396_ab__getHeight(ab);var offset_top=0;if(ab_min_height==ab_max_height){offset_top=0}else{var ab_valign=t396_ab__getFieldValue(ab,'valign');if(ab_valign=='top'){offset_top=0}else if(ab_valign=='center'){offset_top=parseFloat((ab_max_height-ab_min_height)/2).toFixed(1)}else if(ab_valign=='bottom'){offset_top=parseFloat((ab_max_height-ab_min_height)).toFixed(1)}else if(ab_valign=='stretch'){offset_top=0;ab_min_height=ab_max_height}else{offset_top=0}}ab.attr('data-artboard-proxy-min-offset-top',offset_top);ab.attr('data-artboard-proxy-min-height',ab_min_height);ab.attr('data-artboard-proxy-max-height',ab_max_height)}function t396_addText(ab,el){tn_console('func: addText');var fields_str='top,left,width,container,axisx,axisy,widthunits,leftunits,topunits';var fields=fields_str.split(',');el.attr('data-fields',fields_str);t396_elem__renderView(el)}function t396_addImage(ab,el){tn_console('func: addImage');var fields_str='img,width,filewidth,fileheight,top,left,container,axisx,axisy,widthunits,leftunits,topunits';var fields=fields_str.split(',');el.attr('data-fields',fields_str);t396_elem__renderView(el);el.find('img').on("load",function(){t396_elem__renderViewOneField(el,'top');if(typeof $(this).attr('src')!='undefined'&&$(this).attr('src')!=''){setTimeout(function(){t396_elem__renderViewOneField(el,'top')},2000)}}).each(function(){if(this.complete)$(this).load()});el.find('img').on('tuwidget_done',function(e,file){t396_elem__renderViewOneField(el,'top')})}function t396_addShape(ab,el){tn_console('func: addShape');var fields_str='width,height,top,left,';fields_str+='container,axisx,axisy,widthunits,heightunits,leftunits,topunits';var fields=fields_str.split(',');el.attr('data-fields',fields_str);t396_elem__renderView(el)}function t396_addButton(ab,el){tn_console('func: addButton');var fields_str='top,left,width,height,container,axisx,axisy,caption,leftunits,topunits';var fields=fields_str.split(',');el.attr('data-fields',fields_str);t396_elem__renderView(el);return(el)}function t396_addVideo(ab,el){tn_console('func: addVideo');var fields_str='width,height,top,left,';fields_str+='container,axisx,axisy,widthunits,heightunits,leftunits,topunits';var fields=fields_str.split(',');el.attr('data-fields',fields_str);t396_elem__renderView(el);var viel=el.find('.tn-atom__videoiframe');var viatel=el.find('.tn-atom');var vihascover=viatel.attr('data-atom-video-has-cover');if(typeof vihascover=='undefined'){vihascover=''}if(vihascover=='y'){viatel.click(function(){var viifel=viel.find('iframe');if(viifel.length){var foo=viifel.attr('data-original');viifel.attr('src',foo)}viatel.css('background-image','none');viatel.find('.tn-atom__video-play-link').css('display','none')})}var viyid=viel.attr('data-youtubeid');if(typeof viyid!='undefined'&&viyid!=''){if(vihascover=='y'){viel.html('<iframe id="youtubeiframe" width="100%" height="100%" data-original="//www.youtube.com/embed/'+viyid+'?rel=0&fmt=18&html5=1&showinfo=0&autoplay=1" frameborder="0" allowfullscreen data-flag-inst="y"></iframe>')}else{if(window.lazy=='y'){viel.html('<iframe id="youtubeiframe" class="t-iframe" width="100%" height="100%" data-original="//www.youtube.com/embed/'+viyid+'?rel=0&fmt=18&html5=1&showinfo=0" frameborder="0" allowfullscreen data-flag-inst="lazy"></iframe>');el.append('<script>lazyload_iframe = new LazyLoad({elements_selector: ".t-iframe"});</script>')}else{viel.html('<iframe id="youtubeiframe" width="100%" height="100%" src="//www.youtube.com/embed/'+viyid+'?rel=0&fmt=18&html5=1&showinfo=0" frameborder="0" allowfullscreen data-flag-inst="y"></iframe>')}}}var vivid=viel.attr('data-vimeoid');if(typeof vivid!='undefined'&&vivid>0){if(vihascover=='y'){viel.html('<iframe class="t-iframe" data-original="//player.vimeo.com/video/'+vivid+'?title=0&byline=0&portrait=0&badge=0&color=ffffff&autoplay=1" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>')}else{if(window.lazy=='y'){viel.html('<iframe class="t-iframe" data-original="//player.vimeo.com/video/'+vivid+'?title=0&byline=0&portrait=0&badge=0&color=ffffff" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');el.append('<script>lazyload_iframe = new LazyLoad({elements_selector: ".t-iframe"});</script>')}else{viel.html('<iframe src="//player.vimeo.com/video/'+vivid+'?title=0&byline=0&portrait=0&badge=0&color=ffffff" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>')}}}}function t396_addHtml(ab,el){tn_console('func: addHtml');var fields_str='width,height,top,left,';fields_str+='container,axisx,axisy,widthunits,heightunits,leftunits,topunits';var fields=fields_str.split(',');el.attr('data-fields',fields_str);t396_elem__renderView(el)}function t396_addTooltip(ab,el){tn_console('func: addTooltip');var fields_str='width,height,top,left,';fields_str+='container,axisx,axisy,widthunits,heightunits,leftunits,topunits,tipposition';var fields=fields_str.split(',');el.attr('data-fields',fields_str);t396_elem__renderView(el);el.find('.tn-atom__pin').mouseover(function(){t396_elem__renderViewOneField(el,'tipposition')});setTimeout(function(){$('.tn-atom__tip-img').each(function(){var foo=$(this).attr('data-tipimg-original');if(typeof foo!='undefined'&&foo!=''){$(this).attr('src',foo)}})},3000);setInterval(function(){t396_elem__renderViewOneField(el,'tipposition')},3000);el.find('.tn-atom__tip-img').on("load",function(){t396_elem__renderViewOneField(el,'tipposition')}).each(function(){if(this.complete)$(this).load()})}function t396_elem__setFieldValue(el,prop,val,flag_render,flag_updateui,res){if(res=='')res=window.tn.curResolution;if(res<1200&&prop!='zindex'){el.attr('data-field-'+prop+'-res-'+res+'-value',val)}else{el.attr('data-field-'+prop+'-value',val)}if(flag_render=='render')elem__renderViewOneField(el,prop);if(flag_updateui=='updateui')panelSettings__updateUi(el,prop,val)}function t396_elem__getFieldValue(el,prop){var res=window.tn.curResolution;var r;if(res<1200){if(res==960){r=el.attr('data-field-'+prop+'-res-960-value');if(typeof r=='undefined'){r=el.attr('data-field-'+prop+'-value')}}if(res==640){r=el.attr('data-field-'+prop+'-res-640-value');if(typeof r=='undefined'){r=el.attr('data-field-'+prop+'-res-960-value');if(typeof r=='undefined'){r=el.attr('data-field-'+prop+'-value')}}}if(res==480){r=el.attr('data-field-'+prop+'-res-480-value');if(typeof r=='undefined'){r=el.attr('data-field-'+prop+'-res-640-value');if(typeof r=='undefined'){r=el.attr('data-field-'+prop+'-res-960-value');if(typeof r=='undefined'){r=el.attr('data-field-'+prop+'-value')}}}}if(res==320){r=el.attr('data-field-'+prop+'-res-320-value');if(typeof r=='undefined'){r=el.attr('data-field-'+prop+'-res-480-value');if(typeof r=='undefined'){r=el.attr('data-field-'+prop+'-res-640-value');if(typeof r=='undefined'){r=el.attr('data-field-'+prop+'-res-960-value');if(typeof r=='undefined'){r=el.attr('data-field-'+prop+'-value')}}}}}}else{r=el.attr('data-field-'+prop+'-value')}return(r)}function t396_elem__renderView(el){tn_console('func: elem__renderView');var fields=el.attr('data-fields');if(!fields){return!1}fields=fields.split(',');for(var i=0;i<fields.length;i++){t396_elem__renderViewOneField(el,fields[i])}}function t396_elem__renderViewOneField(el,field){var value=t396_elem__getFieldValue(el,field);if(field=='left'){value=t396_elem__convertPosition__Local__toAbsolute(el,field,value);el.css('left',parseFloat(value).toFixed(1)+'px')}if(field=='top'){value=t396_elem__convertPosition__Local__toAbsolute(el,field,value);el.css('top',parseFloat(value).toFixed(1)+'px')}if(field=='width'){value=t396_elem__getWidth(el,value);el.css('width',parseFloat(value).toFixed(1)+'px')}if(field=='height'){value=t396_elem__getHeight(el,value);el.css('height',parseFloat(value).toFixed(1)+'px')}if(field=='container'){t396_elem__renderViewOneField(el,'left');t396_elem__renderViewOneField(el,'top')}if(field=='width'||field=='height'||field=='fontsize'||field=='fontfamily'||field=='letterspacing'||field=='fontweight'||field=='img'){t396_elem__renderViewOneField(el,'left');t396_elem__renderViewOneField(el,'top')}if(field=='tipposition'){if(typeof value=='undefined'||value=='')value='top';var tipw=parseInt(el.find('.tn-atom__tip').outerWidth());var tiph=parseInt(el.find('.tn-atom__tip').outerHeight());var pinw=parseInt(el.find('.tn-atom__pin').width());var padd=15;if(value=='top')el.find('.tn-atom__tip').css('top','-'+(tiph*1+padd)+'px').css('left','-'+(tipw/2-pinw/2)+'px');if(value=='right')el.find('.tn-atom__tip').css('top',(pinw/2-tiph/2)+'px').css('left',(pinw+padd)+'px');if(value=='bottom')el.find('.tn-atom__tip').css('top',(pinw*1+padd)+'px').css('left','-'+(tipw/2-pinw/2)+'px');if(value=='left')el.find('.tn-atom__tip').css('top',(pinw/2-tiph/2)+'px').css('left','-'+(tipw+padd)+'px')}}function t396_elem__convertPosition__Local__toAbsolute(el,field,value){value=parseInt(value);if(field=='left'){var el_container,offset_left,el_container_width,el_width;var container=t396_elem__getFieldValue(el,'container');if(container=='grid'){el_container='grid';offset_left=window.tn.grid_offset_left;el_container_width=window.tn.grid_width}else{el_container='window';offset_left=0;el_container_width=window.tn.window_width}var el_leftunits=t396_elem__getFieldValue(el,'leftunits');if(el_leftunits=='%'){value=t396_roundFloat(el_container_width*value/100)}value=offset_left+value;var el_axisx=t396_elem__getFieldValue(el,'axisx');if(el_axisx=='center'){el_width=t396_elem__getWidth(el);value=el_container_width/2-el_width/2+value}if(el_axisx=='right'){el_width=t396_elem__getWidth(el);value=el_container_width-el_width+value}}if(field=='top'){var ab=el.parent();var el_container,offset_top,el_container_height,el_height;var container=t396_elem__getFieldValue(el,'container');if(container=='grid'){el_container='grid';offset_top=parseFloat(ab.attr('data-artboard-proxy-min-offset-top'));el_container_height=parseFloat(ab.attr('data-artboard-proxy-min-height'))}else{el_container='window';offset_top=0;el_container_height=parseFloat(ab.attr('data-artboard-proxy-max-height'))}var el_topunits=t396_elem__getFieldValue(el,'topunits');if(el_topunits=='%'){value=(el_container_height*(value/100))}value=offset_top+value;var el_axisy=t396_elem__getFieldValue(el,'axisy');if(el_axisy=='center'){el_height=t396_elem__getHeight(el);value=el_container_height/2-el_height/2+value}if(el_axisy=='bottom'){el_height=t396_elem__getHeight(el);value=el_container_height-el_height+value}}return(value)}function t396_ab__setFieldValue(ab,prop,val,res){if(res=='')res=window.tn.curResolution;if(res<1200){ab.attr('data-artboard-'+prop+'-res-'+res,val)}else{ab.attr('data-artboard-'+prop,val)}}function t396_ab__getFieldValue(ab,prop){var res=window.tn.curResolution;var r;if(res<1200){if(res==960){r=ab.attr('data-artboard-'+prop+'-res-960');if(typeof r=='undefined'){r=ab.attr('data-artboard-'+prop+'')}}if(res==640){r=ab.attr('data-artboard-'+prop+'-res-640');if(typeof r=='undefined'){r=ab.attr('data-artboard-'+prop+'-res-960');if(typeof r=='undefined'){r=ab.attr('data-artboard-'+prop+'')}}}if(res==480){r=ab.attr('data-artboard-'+prop+'-res-480');if(typeof r=='undefined'){r=ab.attr('data-artboard-'+prop+'-res-640');if(typeof r=='undefined'){r=ab.attr('data-artboard-'+prop+'-res-960');if(typeof r=='undefined'){r=ab.attr('data-artboard-'+prop+'')}}}}if(res==320){r=ab.attr('data-artboard-'+prop+'-res-320');if(typeof r=='undefined'){r=ab.attr('data-artboard-'+prop+'-res-480');if(typeof r=='undefined'){r=ab.attr('data-artboard-'+prop+'-res-640');if(typeof r=='undefined'){r=ab.attr('data-artboard-'+prop+'-res-960');if(typeof r=='undefined'){r=ab.attr('data-artboard-'+prop+'')}}}}}}else{r=ab.attr('data-artboard-'+prop)}return(r)}function t396_ab__renderViewOneField(ab,field){var value=t396_ab__getFieldValue(ab,field)}function t396_allelems__renderView(ab){tn_console('func: allelems__renderView: abid:'+ab.attr('data-artboard-recid'));ab.find(".tn-elem").each(function(){t396_elem__renderView($(this))})}function t396_ab__filterUpdate(ab){var filter=ab.find('.t396__filter');var c1=filter.attr('data-filtercolor-rgb');var c2=filter.attr('data-filtercolor2-rgb');var o1=filter.attr('data-filteropacity');var o2=filter.attr('data-filteropacity2');if((typeof c2=='undefined'||c2=='')&&(typeof c1!='undefined'&&c1!='')){filter.css("background-color","rgba("+c1+","+o1+")")}else if((typeof c1=='undefined'||c1=='')&&(typeof c2!='undefined'&&c2!='')){filter.css("background-color","rgba("+c2+","+o2+")")}else if(typeof c1!='undefined'&&typeof c2!='undefined'&&c1!=''&&c2!=''){filter.css({background:"-webkit-gradient(linear, left top, left bottom, from(rgba("+c1+","+o1+")), to(rgba("+c2+","+o2+")) )"})}else{filter.css("background-color",'transparent')}}function t396_ab__getHeight(ab,ab_height){if(typeof ab_height=='undefined')ab_height=t396_ab__getFieldValue(ab,'height');ab_height=parseFloat(ab_height);var ab_height_vh=t396_ab__getFieldValue(ab,'height_vh');if(ab_height_vh!=''){ab_height_vh=parseFloat(ab_height_vh);if(isNaN(ab_height_vh)===!1){var ab_height_vh_px=parseFloat(window.tn.window_height*parseFloat(ab_height_vh/100));if(ab_height<ab_height_vh_px){ab_height=ab_height_vh_px}}}return(ab_height)}function t396_hex2rgb(hexStr){var hex=parseInt(hexStr.substring(1),16);var r=(hex&0xff0000)>>16;var g=(hex&0x00ff00)>>8;var b=hex&0x0000ff;return[r,g,b]}String.prototype.t396_replaceAll=function(search,replacement){var target=this;return target.replace(new RegExp(search,'g'),replacement)};function t396_elem__getWidth(el,value){if(typeof value=='undefined')value=parseFloat(t396_elem__getFieldValue(el,'width'));var el_widthunits=t396_elem__getFieldValue(el,'widthunits');if(el_widthunits=='%'){var el_container=t396_elem__getFieldValue(el,'container');if(el_container=='window'){value=parseFloat(window.tn.window_width*parseFloat(parseInt(value)/100))}else{value=parseFloat(window.tn.grid_width*parseFloat(parseInt(value)/100))}}return(value)}function t396_elem__getHeight(el,value){if(typeof value=='undefined')value=t396_elem__getFieldValue(el,'height');value=parseFloat(value);if(el.attr('data-elem-type')=='shape'||el.attr('data-elem-type')=='video'||el.attr('data-elem-type')=='html'){var el_heightunits=t396_elem__getFieldValue(el,'heightunits');if(el_heightunits=='%'){var ab=el.parent();var ab_min_height=parseFloat(ab.attr('data-artboard-proxy-min-height'));var ab_max_height=parseFloat(ab.attr('data-artboard-proxy-max-height'));var el_container=t396_elem__getFieldValue(el,'container');if(el_container=='window'){value=parseFloat(ab_max_height*parseFloat(value/100))}else{value=parseFloat(ab_min_height*parseFloat(value/100))}}}else if(el.attr('data-elem-type')=='button'){value=value}else{value=parseFloat(el.innerHeight())}return(value)}function t396_roundFloat(n){n=Math.round(n*100)/100;return(n)}function tn_console(str){if(window.tn_comments==1)console.log(str)}
function t446_setLogoPadding(recid){if($(window).width()>980){var t446__menu=$('#rec'+recid+' .t446');var t446__logo=t446__menu.find('.t446__logowrapper');var t446__leftpart=t446__menu.find('.t446__leftwrapper');var t446__rightpart=t446__menu.find('.t446__rightwrapper');t446__leftpart.css("padding-right",t446__logo.width()/2+50);t446__rightpart.css("padding-left",t446__logo.width()/2+50)}}
function t446_checkOverflow(recid,menuheight){var t446__menu=$('#rec'+recid+' .t446');var t446__rightwr=t446__menu.find('.t446__rightwrapper');var t446__rightmenuwr=t446__rightwr.find('.t446__rightmenuwrapper');var t446__rightadditionalwr=t446__rightwr.find('.t446__additionalwrapper');var t446__burgeroverflow=t446__rightwr.find('.t446__burgerwrapper_overflow');var t446__burgerwithoutoverflow=t446__rightwr.find('.t446__burgerwrapper_withoutoverflow');if(menuheight>0){var t446__height=menuheight}else{var t446__height=80}
if($(window).width()>980&&(t446__rightmenuwr.width()+t446__rightadditionalwr.width())>t446__rightwr.width()){t446__menu.css("height",t446__height*2);t446__rightadditionalwr.css("float","right");t446__burgeroverflow.css("display","table-cell");t446__burgerwithoutoverflow.css("display","none")}else{if(t446__menu.height()>t446__height){t446__menu.css("height",t446__height)}
if(t446__rightadditionalwr.css("float")=="right"){t446__rightadditionalwr.css("float","none")}
t446__burgeroverflow.css("display","none");t446__burgerwithoutoverflow.css("display","table-cell")}}
function t446_highlight(){var url=window.location.href;var pathname=window.location.pathname;if(url.substr(url.length-1)=="index.html"){url=url.slice(0,-1)}
if(pathname.substr(pathname.length-1)=="index.html"){pathname=pathname.slice(0,-1)}
if(pathname.charAt(0)=="index.html"){pathname=pathname.slice(1)}
if(pathname==""){pathname="/"}
$(".t446__list_item a[href='"+url+"']").addClass("t-active");$(".t446__list_item a[href='"+url+"/']").addClass("t-active");$(".t446__list_item a[href='"+pathname+"']").addClass("t-active");$(".t446__list_item a[href='/"+pathname+"']").addClass("t-active");$(".t446__list_item a[href='"+pathname+"/']").addClass("t-active");$(".t446__list_item a[href='/"+pathname+"/']").addClass("t-active")}
function t446_checkAnchorLinks(recid){if($(window).width()>=960){var t446_navLinks=$("#rec"+recid+" .t446__list_item a:not(.tooltipstered)[href*='#']");if(t446_navLinks.length>0){t446_catchScroll(t446_navLinks)}}}
function t446_catchScroll(t446_navLinks){var t446_clickedSectionId=null,t446_sections=new Array(),t446_sectionIdTonavigationLink=[],t446_interval=100,t446_lastCall,t446_timeoutId;t446_navLinks=$(t446_navLinks.get().reverse());t446_navLinks.each(function(){var t446_cursection=t446_getSectionByHref($(this));if(typeof t446_cursection.attr("id")!="undefined"){t446_sections.push(t446_cursection)}
t446_sectionIdTonavigationLink[t446_cursection.attr("id")]=$(this)});t446_updateSectionsOffsets(t446_sections);t446_sections.sort(function(a,b){return b.attr("data-offset-top")-a.attr("data-offset-top")});$(window).bind('resize',t_throttle(function(){t446_updateSectionsOffsets(t446_sections)},200));$('.t446').bind('displayChanged',function(){t446_updateSectionsOffsets(t446_sections)});setInterval(function(){t446_updateSectionsOffsets(t446_sections)},5000);t446_highlightNavLinks(t446_navLinks,t446_sections,t446_sectionIdTonavigationLink,t446_clickedSectionId);t446_navLinks.click(function(){var t446_clickedSection=t446_getSectionByHref($(this));if(!$(this).hasClass("tooltipstered")&&typeof t446_clickedSection.attr("id")!="undefined"){t446_navLinks.removeClass('t-active');$(this).addClass('t-active');t446_clickedSectionId=t446_getSectionByHref($(this)).attr("id")}});$(window).scroll(function(){var t446_now=new Date().getTime();if(t446_lastCall&&t446_now<(t446_lastCall+t446_interval)){clearTimeout(t446_timeoutId);t446_timeoutId=setTimeout(function(){t446_lastCall=t446_now;t446_clickedSectionId=t446_highlightNavLinks(t446_navLinks,t446_sections,t446_sectionIdTonavigationLink,t446_clickedSectionId)},t446_interval-(t446_now-t446_lastCall))}else{t446_lastCall=t446_now;t446_clickedSectionId=t446_highlightNavLinks(t446_navLinks,t446_sections,t446_sectionIdTonavigationLink,t446_clickedSectionId)}})}
function t446_updateSectionsOffsets(sections){$(sections).each(function(){var t446_curSection=$(this);t446_curSection.attr("data-offset-top",t446_curSection.offset().top)})}
function t446_getSectionByHref(curlink){var t446_curLinkValue=curlink.attr("href").replace(/\s+/g,'');if(t446_curLinkValue[0]=='index.html'){t446_curLinkValue=t446_curLinkValue.substring(1)}
if(curlink.is('[href*="#rec"]')){return $(".r[id='"+t446_curLinkValue.substring(1)+"']")}else{return $(".r[data-record-type='215']").has("a[name='"+t446_curLinkValue.substring(1)+"']")}}
function t446_highlightNavLinks(t446_navLinks,t446_sections,t446_sectionIdTonavigationLink,t446_clickedSectionId){var t446_scrollPosition=$(window).scrollTop(),t446_valueToReturn=t446_clickedSectionId;if(t446_sections.length!=0&&t446_clickedSectionId==null&&t446_sections[t446_sections.length-1].attr("data-offset-top")>(t446_scrollPosition+300)){t446_navLinks.removeClass('t-active');return null}
$(t446_sections).each(function(e){var t446_curSection=$(this),t446_sectionTop=t446_curSection.attr("data-offset-top"),t446_id=t446_curSection.attr('id'),t446_navLink=t446_sectionIdTonavigationLink[t446_id];if(((t446_scrollPosition+300)>=t446_sectionTop)||(t446_sections[0].attr("id")==t446_id&&t446_scrollPosition>=$(document).height()-$(window).height())){if(t446_clickedSectionId==null&&!t446_navLink.hasClass('t-active')){t446_navLinks.removeClass('t-active');t446_navLink.addClass('t-active');t446_valueToReturn=null}else{if(t446_clickedSectionId!=null&&t446_id==t446_clickedSectionId){t446_valueToReturn=null}}
return!1}});return t446_valueToReturn}
function t446_setPath(){}
function t446_setBg(recid){var window_width=$(window).width();if(window_width>980){$(".t446").each(function(){var el=$(this);if(el.attr('data-bgcolor-setbyscript')=="yes"){var bgcolor=el.attr("data-bgcolor-rgba");el.css("background-color",bgcolor)}})}else{$(".t446").each(function(){var el=$(this);var bgcolor=el.attr("data-bgcolor-hex");el.css("background-color",bgcolor);el.attr("data-bgcolor-setbyscript","yes")})}}
function t446_appearMenu(recid){var window_width=$(window).width();if(window_width>980){$(".t446").each(function(){var el=$(this);var appearoffset=el.attr("data-appearoffset");if(appearoffset!=""){if(appearoffset.indexOf('vh')>-1){appearoffset=Math.floor((window.innerHeight*(parseInt(appearoffset)/100)))}
appearoffset=parseInt(appearoffset,10);if($(window).scrollTop()>=appearoffset){if(el.css('visibility')=='hidden'){el.finish();el.css("top","-50px");el.css("visibility","visible");el.animate({"opacity":"1","top":"0px"},200,function(){})}}else{el.stop();el.css("visibility","hidden")}}})}}
function t446_changebgopacitymenu(recid){var window_width=$(window).width();if(window_width>980){$(".t446").each(function(){var el=$(this);var bgcolor=el.attr("data-bgcolor-rgba");var bgcolor_afterscroll=el.attr("data-bgcolor-rgba-afterscroll");var bgopacityone=el.attr("data-bgopacity");var bgopacitytwo=el.attr("data-bgopacity-two");var menushadow=el.attr("data-menushadow");if(menushadow=='100'){var menushadowvalue=menushadow}else{var menushadowvalue='0.'+menushadow}
if($(window).scrollTop()>20){el.css("background-color",bgcolor_afterscroll);if(bgopacitytwo=='0'||menushadow==' '){el.css("box-shadow","none")}else{el.css("box-shadow","0px 1px 3px rgba(0,0,0,"+menushadowvalue+")")}}else{el.css("background-color",bgcolor);if(bgopacityone=='0.0'||menushadow==' '){el.css("box-shadow","none")}else{el.css("box-shadow","0px 1px 3px rgba(0,0,0,"+menushadowvalue+")")}}})}}
function t446_createMobileMenu(recid){var window_width=$(window).width(),el=$("#rec"+recid),menu=el.find(".t446"),burger=el.find(".t446__mobile");burger.click(function(e){menu.fadeToggle(300);$(this).toggleClass("t446_opened")})
$(window).bind('resize',t_throttle(function(){window_width=$(window).width();if(window_width>980){menu.fadeIn(0)}},200))}
function t537_setHeight(recid){var t537__el=$("#rec"+recid),t537__image=t537__el.find(".t537__bgimg:first"),t537__width=t537__image.attr("data-image-width"),t537__height=t537__image.attr("data-image-height"),t537__ratio=t537__height/t537__width,t537__padding=t537__ratio*100;$("#rec"+recid+" .t537__bgimg").css("padding-bottom",t537__padding+"%")}
function t670_init(recid){t670_imageHeight(recid);t670_show(recid);t670_hide(recid)}
function t670_show(recid){var el=$("#rec"+recid),play=el.find('.t670__play');play.click(function(){if($(this).attr('data-slider-video-type')=='youtube'){var url=$(this).attr('data-slider-video-url');$(this).next().html("<iframe class=\"t670__iframe\" width=\"100%\" height=\"100%\" src=\"https://www.youtube.com/embed/"+url+"?autoplay=1\" frameborder=\"0\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>")}
if($(this).attr('data-slider-video-type')=='vimeo'){var url=$(this).attr('data-slider-video-url');$(this).next().html("<iframe class=\"t670__iframe\" width=\"100%\" height=\"100%\" src=\"https://player.vimeo.com/video/"+url+"?autoplay=1\" frameborder=\"0\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>")}
$(this).next().css('z-index','3')})}
function t670_hide(recid){var el=$("#rec"+recid),body=el.find('.t670__frame');el.on('updateSlider',function(){body.html('').css('z-index','')})}
function t670_imageHeight(recid){var el=$("#rec"+recid);var image=el.find(".t670__separator");image.each(function(){var width=$(this).attr("data-slider-image-width");var height=$(this).attr("data-slider-image-height");var ratio=height/width;var padding=ratio*100;$(this).css("padding-bottom",padding+"%")})}
function t678_onSuccess(t678_form){var t678_inputsWrapper=t678_form.find('.t-form__inputsbox');var t678_inputsHeight=t678_inputsWrapper.height();var t678_inputsOffset=t678_inputsWrapper.offset().top;var t678_inputsBottom=t678_inputsHeight+t678_inputsOffset;var t678_targetOffset=t678_form.find('.t-form__successbox').offset().top;if($(window).width()>960){var t678_target=t678_targetOffset-200}else{var t678_target=t678_targetOffset-100}
if(t678_targetOffset>$(window).scrollTop()||($(document).height()-t678_inputsBottom)<($(window).height()-100)){t678_inputsWrapper.addClass('t678__inputsbox_hidden');setTimeout(function(){if($(window).height()>$('.t-body').height()){$('.t-tildalabel').animate({opacity:0},50)}},300)}else{$('html, body').animate({scrollTop:t678_target},400);setTimeout(function(){t678_inputsWrapper.addClass('t678__inputsbox_hidden')},400)}
var successurl=t678_form.data('success-url');if(successurl&&successurl.length>0){setTimeout(function(){window.location.href=successurl},500)}}
function t744_init(recid){t_sldsInit(recid);setTimeout(function(){t_prod__init(recid)},500);$('#rec'+recid).find('.t744').bind('displayChanged',function(){t744_updateSlider(recid)})}
function t744_updateSlider(recid){var el=$('#rec'+recid);t_slds_SliderWidth(recid);sliderWrapper=el.find('.t-slds__items-wrapper');sliderWidth=el.find('.t-slds__container').width();pos=parseFloat(sliderWrapper.attr('data-slider-pos'));sliderWrapper.css({transform:'translate3d(-'+(sliderWidth*pos)+'px, 0, 0)'});t_slds_UpdateSliderHeight(recid);t_slds_UpdateSliderArrowsHeight(recid)}