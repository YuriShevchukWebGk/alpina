Eski.mobi({

	returnText: "#000000",

	returnBg: "rgba(255,255,255,.9)",

	returnTime: 5,

  // Do not touch!
  root: '/eskimobi', mode: "local",
  dir: "mobile/alpinabook-ru/eski",
  optimization: {
    optCss: false,
    optJs: false,
    optImg: true,
    optImgQuality: 75,
    optImgQuery: ''
  },
  // End

  exp: {
    evaluate: /<\?([\s\S]+?)\?>/g,
    interpolate: /<\?=([\s\S]+?)\?>/g,
    escape: /<\?-([\s\S]+?)\?>/g
  },

  return_to_mobile: '<div><style>#eski_mobi,#eski_mobi #eski-right #eski-group #eski-btn a{overflow:hidden;-webkit-box-sizing:border-box;font-weight:700}#eski_mobi{position:fixed;width:100%;z-index:99999999;top:0;left:0;margin:0;padding:0;background:#3fd7cb;color:#0d3d39;font-family:Helvetica,sans-serif;font-size:16px;letter-spacing:-.5px;border-bottom:1px solid #0d3d39;box-shadow:0 2px 20px rgba(0,0,0,.5)}#eski_mobi .inside{margin:.5em 0}#eski_mobi #eski-left{float:left;width:70%}#eski_mobi #eski-right{float:left;width:30%}#eski_mobi .clear{clear:both}#eski_mobi #eski-left p{margin:0 .5em;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;text-align:center;line-height:2em;text-shadow:0 1px 0 #bef1ed}#eski_mobi #eski-right #eski-group{width:100%;padding:0}#eski_mobi #eski-right #eski-group #eski-btn{padding:5px 0;width:45%;margin-right:5%;float:left}#eski_mobi #eski-right #eski-group #eski-btn a{width:100%;min-width:30px;padding:.5em 0;display:block;color:#fff;text-decoration:none;text-align:center;border-radius:.5em;text-shadow:0 -1px 0 #0d3d39;background:#1a7d75;box-shadow:0 1px 0 #041312,0 3px 4px #1e9289;-webkit-transition:all 100ms ease-in-out;-moz-transition:all 100ms ease-in-out;-ms-transition:all 100ms ease-in-out;-o-transition:all 100ms ease-in-out;transition:all 100ms ease-in-out}#eski_mobi #eski-right #eski-group #eski-btn a:hover{color:#166761;background:#fff;text-shadow:none;box-shadow:0 0 20px #fff,0 1px 0 #041312,0 3px 4px #1e9289}</style>           <div id="eski_mobi"> <div id="eski-inside"> <div id="eski-left"> <p>\u041E\u0442\u043A\u0440\u044B\u0442\u044C \u043C\u043E\u0431\u0438\u043B\u044C\u043D\u0443\u044E \u0432\u0435\u0440\u0441\u0438\u044E \u0441\u0430\u0439\u0442\u0430?</p> </div> <div id="eski-right"> <div id="eski-group"> <div id="eski-btn"> <a href="javascript:window.location.hash=\'mobi\';window.location.reload();">\u0414\u0430</a> </div> <div id="eski-btn"> <a href="javascript:document.cookie=\'mobi-no=;path=/;expires=\'+(new Date(+(new Date) + (1000*60*60*72) ).toGMTString());;(el=document.getElementById(\'eski_mobi\')).parentNode.removeChild(el);">\u041D\u0435\u0442</a> </div> <div id="eski-clear"></div> </div> </div> <div id="eski-clear"></div> </div></div></div>',

  header: './tmpl/header.html',

  footer: './tmpl/footer.html',

  data: {
    classes: function (doc) {
      var splits = location.pathname.split('/'),
        out = [],
        spl = function (arr) {
          for (var i = arr.length; i >= 0; i--) {
            if (!arr[i]) arr.splice(i, 1);
          }
          return arr;
        };
      if (spl(splits).length == 0) {
        return 'x-home';
      } else {
        for (var i in splits) {
          if (splits[i]){
            out.push( "x-" + splits[i].replace('.', '_') );
          }
        }
        out.push( "x-" + location.search.split('=')[0].replace(/\?/gi, '') );
        return out.join(" ");
      }
    },
    title: function (doc) {
      // Remove no-mobile blocks
      // var nomobile = doc.querySelectorAll('.no-mobile');
      // for (i in nomobile) {
      // 	var block = nomobile[i];
      // 	if (typeof block == "object")
      // 		block.parentNode.removeChild(block);
      // }
      return doc.querySelector('title').innerText;
    },
    headMeta: function (doc) {
      var out = "";
      var meta = doc.head.querySelectorAll('meta');
      for (i in meta) {
        var text = meta[i].outerHTML;
        if (text)
          out += text;
      }
      return out;
    },
    headScripts: function (doc) {
      var out = "";
      var scripts = doc.head.querySelectorAll('script');
      for (i in scripts) {
        var text = scripts[i].outerHTML;
        if (text && !text.match(/eski\.mobi|jivosite|name\=\"viewport\"|hurra/gi))
          out += text;
      }
      return out;
    },
    cart: function(doc){
      return doc.querySelector('.headBasket').outerHTML;
    },
    user: function(doc){
      var a = doc.querySelectorAll('header .lkWrapp > a');
      var out = '';
      if( a ){
        for( i in a ){
          if( a[i] && a[i].outerHTML ){
            out += a[i].outerHTML;
          }
        }
      }
      return out;
    },
    telephone: function(doc){
      return doc.querySelector('header .lkWrapp .telephone').innerText;
    },
    // catalog: function(doc){
    //   return doc.querySelector('.slidingTopMenu .headCatalog').outerHTML;
    // },
    // menu: function(doc){
    //   return doc.querySelector('header .menu').outerHTML;
    // },
    leftmenu: function(doc){
      var els = doc.querySelectorAll('.hidingCatalogLeft .firstLevel > li');
      var out = '';
      if( els ){
        for( i in els ){
          if( els[i] && els[i].outerHTML ){
            out += els[i].outerHTML;
          } 
        }
      }
      return out;
    },
    leftmenu_2: function(doc){
      return doc.querySelector('.hidingCatalogLeft .menuCopy').outerHTML;
    },
    search: function(doc){
      var el = doc.querySelector('#title-search');
      var out = '';
      if( el ){
        out = el.parentNode.outerHTML;
      }
      return out;
    }
  },
  pages: [
    {
      route: function () {
        return true;
      },
      template: './tmpl/default.html',
      data: {
        content: function (doc) {
          var out = '';
          var el = doc.querySelector('body');
          var rems = ['header', '.slideWrapp .roundSlider', '.searchWrap', '#WPHeader', '.basketHeader', '.slidingTopMenu', '.footerMenu', 'style', 'link', '.no-mobile'];
          for (i in rems) {
            if (rems[i]) {
              var r_e = el.querySelectorAll(rems[i]);
              for (i in r_e) {
                var r = r_e[i];
                if (r && r.outerHTML) {
                  var scrs = r.querySelectorAll('script');
                  for (i in scrs) {
                    if (scrs[i] && scrs[i].outerHTML) {
                      out += scrs[i].outerHTML;
                    }
                  }
                  r.parentNode.removeChild(r);
                }
              }
            }
          }

          var imgs = el.querySelectorAll('img');
          if( imgs ){
            for( i in imgs ){
              if( imgs[i] && imgs[i].outerHTML ){
                var src = imgs[i].getAttribute('x-src');
                imgs[i].setAttribute('data-src', src);
                imgs[i].setAttribute('x-src', 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');
                imgs[i].classList.add('lazy');
              }
            }
          }
          
          var el_out = el.innerHTML;
          el_out = el_out.replace( /bigSlider/gi, 'bigSlider_new js_slider' );
          el_out = el_out.replace( /main\.css/gi, 'main.off.css' );
          el_out = el_out.replace( /(\+\d{1,}\s\(\d{3,}\)\s\d{3,}\-\d{2,}\-\d{2,})(?!"|')/gi, '<a href="tel:$1">$1</a>' );
          el_out = el_out.replace( /руб\./gi, '<span class="rub"></span>' );
          
          return out + '' + el_out;
        }
      }
    }
  ]
});

