$(document).ready(function () {
    //Select to Element
    $('.nav-link').click(function () {
        $('html,body').animate({
            scrollTop:$('#' + $(this).data('scroll')).offset().top
        },1000);
    })
    //Add active class
    $('.nav-item').click(function () {
       $(this).addClass('active').siblings().removeClass('active');
    });
    //Scroll to top
    var scrollTop = $('.scroll-top');
    $(window).scroll(function () {
        //console.log($(this).scrollTop());
        if($(this).scrollTop() >= 500){
            scrollTop.fadeIn(400);
        }else{
            scrollTop.fadeOut(400);
        }
    });
    scrollTop.click(function () {
        $('html,body').animate({scrollTop:0},1000);
    })
    $('.check').click(function () {
        if ($('input[name=check_admin]').is(':checked')){
            $('.check').val("true");
            console.log($('.check').val());
        }else {
            $('.check').val("false");
            console.log($('.check').val());
        }
    })

});