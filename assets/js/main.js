$(document).ready(function () {
    var distance = $('.in-top').offset().top;

    //navbar sync
    $(window).scroll(function() {
        if ( $(this).scrollTop() <= distance ) {
            $('.nav-item').siblings().removeClass('active');
        }
        else if(($(this).scrollTop() >= $('.what-you-need').offset().top) && ($(this).scrollTop() <= $('.our-service').offset().top)) {
            $('.item-about').addClass('active').siblings().removeClass('active');
        }
        else if(($(this).scrollTop() >= $('.our-service').offset().top) && ($(this).scrollTop() <= $('.portfolio').offset().top)) {
            $('.item-services').addClass('active').siblings().removeClass('active');
        }
        else if(($(this).scrollTop() >= $('.portfolio').offset().top) && ($(this).scrollTop() <= $('.download').offset().top)) {
            $('.item-portfolio').addClass('active').siblings().removeClass('active');
        }
        else if($(this).scrollTop() >= $('.download').offset().top) {
            $('.item-contact').addClass('active').siblings().removeClass('active');
        }
    });
    //navbar sync end


    //change navbar color
    $(window).scroll(function() {
        if ( $(this).scrollTop() <= distance ) {
            // console.log('is in top');
        } else {
            // console.log('is not in top');
            $('.navbar').removeClass('bg-transparent');
            $('.navbar').css({'background-color': 'black', 'opacity': '0.7'});
        }
    });
    //change navbar color end


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
});