(function() {
    // Localize jQuery variable
    var jQuery;

    /******** Load jQuery if not present *********/
    if (window.jQuery === undefined || window.jQuery.fn.jquery !== '1.4.2') {
        var script_tag = document.createElement('script');
        script_tag.setAttribute("type","text/javascript");
        script_tag.setAttribute("src",
            "//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js");
        if (script_tag.readyState) {
          script_tag.onreadystatechange = function () { // For old versions of IE
              if (this.readyState == 'complete' || this.readyState == 'loaded') {
                  scriptLoadHandler();
              }
          };
        } else {
          script_tag.onload = scriptLoadHandler;
        }
        // Try to find the head, otherwise default to the documentElement
        (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
    } else {
        // The jQuery version on the window is the one we want to use
        jQuery = window.jQuery;
        main();
    }

    /******** Called once jQuery has loaded ******/
    function scriptLoadHandler() {
        // Restore $ and window.jQuery to their previous values and store the
        // new jQuery in our local jQuery variable
        jQuery = window.jQuery.noConflict(true);
        // Call our main function
        main(); 
    }
    
    /******** Класс виджета ******/
    function AlpinaWidget(config) {
		this.widget_container = document.querySelector("#" + config.widget_container_id);
		
		/**
		 * Создаем прелоадер
		 * @return void
		 * */
		this.createPreloader = function() {
			var preloader = document.createElement('div'),
				bubble_temp_var = {};
			// создаем обертку для прелоадера
			preloader.setAttribute("class", "bubblingG");
			// далее 3 кружка самого прелоадера
			for (var i = 1; i <= 3; i++) {
				bubble_temp_var = document.createElement("span");
				bubble_temp_var.setAttribute("id", "bubblingG_" + i);
				preloader.appendChild(bubble_temp_var);
			}
			this.widget_container.appendChild(preloader);
		}
		
		/**
		 * Выводим данные
		 * 
		 * @param mixed data
		 * @return void
		 * 
		 * */
		
		this.setData = function(data) {
			this.widget_container.innerHTML = data;
		}
	}

    /******** Our main function ********/
    function main() { 
        jQuery(document).ready(function($) { 
            /******* Load CSS *******/
           	var font_link = $("<link>", { 
                rel: "stylesheet", 
                href: "//fonts.googleapis.com/css?family=Fira+Sans" 
            });
            font_link.appendTo('head');
            var css_link = $("<link>", { 
                rel: "stylesheet", 
                type: "text/css", 
                href: "//www.alpinabook.ru/custom-scripts/widget/style.css" 
            });
            css_link.appendTo('head');          
            
            var alpina_widget = new AlpinaWidget({
            	widget_container_id: "alpina-widget-container"
            });
            // ставим прелоадер на время загрузки
            alpina_widget.createPreloader();
			// запрос на получение основных данных
            $.ajax({
				type: "POST",
				url: "//www.alpinabook.ru/custom-scripts/widget/books.php",
				data: {}
			}).done(function(result) {
				alpina_widget.setData(result);
	        });
            
        });
    }

    })(); // We call our anonymous function immediately