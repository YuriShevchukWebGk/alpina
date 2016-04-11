
//функция получает имя класа слайдера и количество слайдов в карусели на странице
function easySlider(className, PageQuantitySlides){
    
    var slidesQuant = $(className+' li').length;
    var nowSlideNum = 1;
    $(className).css('position', 'relative');
    $(className+">div").addClass('sliderContainer')
    if (PageQuantitySlides == '5'){
        $(className+" li").addClass('sliderElementMin');
        var sliderElClass = '.sliderElementMin';
    }else{
        $(className+" li").addClass('sliderElement');
        var sliderElClass = '.sliderElement';    
    }
    
    $(className+" ul").addClass('sliderUl');
    var widthOfSlide = $(sliderElClass).width();
    var quantityOfElements = $(className +' '+sliderElClass).size();
    var VisibleUlWidth = PageQuantitySlides * widthOfSlide;

    //
    $(className+" .left").click(function(){
        nowSlideNum--;
        if(nowSlideNum == 1){
            $(className+" .left").hide();
            $(className+' .sliderUl').animate({left:'+='+ widthOfSlide},500);    
        } else {
            $(className+' .sliderUl').animate({left:'+='+ widthOfSlide},500);
            $(className+" .rigth").show();   
        }
    });

    $(className+" .rigth").click(function(){
        nowSlideNum++;
        if(nowSlideNum == slidesQuant-(PageQuantitySlides-1)){
            $(className+" .rigth").hide(); 
            $(className+' .sliderUl').animate({left:'-='+ widthOfSlide},500);   
        } else {
            $(className+' .sliderUl').animate({left:'-='+ widthOfSlide},500);
            $(className+" .left").show();   
        }
    });

    if ($(className+' .sliderUl').position().left == 0) {
        $(className+" .left").hide();
    };
}