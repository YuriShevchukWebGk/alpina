$(function() {
    var slider = $('.slider'),
    sliderContent = slider.html(),                      // ���������� ��������
    slideWidth = $('.slider-box').outerWidth(),         // ������ ��������
    slideCount = $('.slider img').length,               // ���������� �������
    prev = $('.slider-box .prev'),                      // ������ "�����"
    next = $('.slider-box .next'),                      // ������ "������"
    slideNum = 1,                                       // ����� �������� ������
    index =0,
    clickBullets=0,
    sliderInterval = 33000,                              // �������� ����� �������
    animateTime = 1000,                                    // ����� ����� �������
    course = 1,                                         // ����������� �������� �������� (1 ��� -1)
    margin = - slideWidth;                              // �������������� �������� �������

    for (var i=0; i<slideCount; i++)                      // ���� ��������� ������� � ���� .bullets
    {
        html=$('.bullets').html() + '<li></li>';          // � �������� ����������� ������������ ���� ������
        $('.bullets').html(html);                         // � ����������� � ���
    }
    var  bullets = $('.slider-box .bullets li')          // ���������� ������ ����� ��������


    $('.slider-box .bullets li:first').addClass('active');
    // $('.slider img:last').clone().prependTo('.slider');   // ����� ���������� ������ ���������� � ������.
    $('.slider img').eq(1).clone().appendTo('.slider');   // ����� ������� ������ ���������� � �����.
    $('.slider img').eq(2).clone().appendTo('.slider');
    //$('.slider').css('margin-left', -slideWidth);         // ��������� .slider ���������� ����� �� ������ ������ ������.

    function nextSlide(){                                 // ����������� ������� animation(), ����������� ����� �������.
        interval = window.setInterval(animate, sliderInterval);
    }

    function animate(){
        if (margin==-slideCount*slideWidth-slideWidth  && course==1){     // ���� ������� ����� �� �����
            slider.css({'marginLeft':-slideWidth});           // �� ���� .slider ������������ � ��������� ���������
            margin=-slideWidth*2;
        }else if(margin==0 && course==-1){                  // ���� ������� ��������� � ������ � ������ ������ "�����"
            slider.css({'marginLeft':-slideWidth*slideCount});// �� ���� .slider ������������ � �������� ���������
            margin=-slideWidth*slideCount+slideWidth;
        }else{                                              // ���� ������� ���� �� ���������,
            margin = margin - slideWidth*(course - 1);            // �������� margin ��������������� ��� ������ ���������� ������
        }
        slider.animate({'marginLeft':margin},animateTime);  // ���� .slider ��������� ����� �� 1 �����.

        if (clickBullets==0){                               // ���� ������� �������� �� ����� ����� �������
            bulletsActive();                                // ����� �������, ���������� �������� ������
        }else{                                              // ���� ������� ������ � ������� �������
            slideNum=index+1;                               // ����� ���������� ������
        }
    }

    function bulletsActive(){
        if (course==1 && slideNum!=slideCount){        // ���� ������ �������� ����� � ������� ����� �� ���������
            slideNum++;                                     // ������������� ����� �������� ������
            $('.bullets .active').removeClass('active').next('li').addClass('active'); // �������� �������� ������
        }else if (course==1 && slideNum==slideCount){       // ���� ������ �������� ����� � ������� ����� ���������
            slideNum=1;                                     // ����� �������� ������
            $('.bullets li').removeClass('active').eq(0).addClass('active'); // �������� ���������� ������ ������
            return false;
        }else if (course==-1  && slideNum!=1){              // ���� ������ �������� ������ � ������� ����� �� ��������
            slideNum--;                                     // ������������� ����� �������� ������
            $('.bullets .active').removeClass('active').prev('li').addClass('active'); // �������� �������� ������
            return false;
        }else if (course==-1  && slideNum==1){              // ���� ������ �������� ������ � ������� ����� ��������
            slideNum=slideCount;                            // ����� �������� ������
            $('.bullets li').removeClass('active').eq(slideCount-1).addClass('active'); // �������� ���������� ��������� ������
        }
    }

    function sliderStop(){                                // ������� ������������������ ������ ��������
        window.clearInterval(interval);
    }

    prev.click(function() {                               // ������ ������ "�����"
        if (slider.is(':animated')) { return false; }       // ���� �� ���������� ��������
        var course2 = course;                               // ��������� ���������� ��� �������� �������� course
        course = -1;                                        // ��������������� ����������� �������� ������ ������
        animate();                                          // ����� ������� animate()
        course = course2 ;                                  // ���������� course ��������� �������������� ��������
    });
    next.click(function() {                               // ������ ������ "�����"
        if (slider.is(':animated')) { return false; }       // ���� �� ���������� ��������
        var course2 = course;                               // ��������� ���������� ��� �������� �������� course
        course = 1;                                         // ��������������� ����������� �������� ������ ������
        animate();                                          // ����� ������� animate()
        course = course2 ;                                  // ���������� course ��������� �������������� ��������
    });
    bullets.click(function() {                            // ����� ���� �� ��������
        if (slider.is(':animated')) { return false; }       // ���� �� ���������� ��������
        sliderStop();                                       // ������ �� ����� ���������� ������ �����������
        index = bullets.index(this);                        // ����� �������� �������
        if (course==1){                                     // ���� ������ �������� �����
            margin=-slideWidth*index;                       // �������� margin ��������������� ��� ������ ���������� ������
        }else if (course==-1){                              // ���� ������ �������� ������
            margin=-slideWidth*index-2*slideWidth;
        }
        $('.bullets li').removeClass('active').eq(index).addClass('active');  // ���������� ������� ����������� ����� .active
        clickBullets=1;                                     // ���� ������������� � ���, ��� ����� ������ ������ ��������
        animate();
        clickBullets=0;
    });

    slider.add(next).add(prev).hover(function() {         // ���� ������ ���� � �������� ��������
        sliderStop();                                       // ���������� ������� sliderStop() ��� ������������ ������ ��������
    }, nextSlide);                                        // ����� ������ ������ �� ��������, �������� ��������������.

    nextSlide();                                          // ����� ������� nextSlide()
});