$(document).ready(function(){
    if($('.roundSlideWrapp').length == 0){
        $('.categoryWrapper .titleMain').css({"margin-bottom":"-42px"});
        $(".wrapperCategor").css("height", $(".wrapperCategor").height() - 360 + "px");
        $(".contentWrapp").css("height", $(".contentWrapp").height() - 360 + "px");
    }
})