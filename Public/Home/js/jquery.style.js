$(function(){
    //nav
    $('nav ul li').hover(function(){
        $(this).children('.nav-cont').show();
        $(this).children('a').eq(0).addClass('current');
    }, function () {
        $(this).children('.nav-cont').hide();
        $(this).children('a').eq(0).removeClass('current');
    })

    //
    $('.picList li').hover(function(){
        $(this).children('.s-2').show();
        $(this).children('.s-1').hide();
    },function(){
        $(this).children('.s-2').hide();
        $(this).children('.s-1').show();
    })

    //gotop

    $(".gotop").click(function() {
        $('body,html').animate({
                scrollTop: 0
            },
            1000);
        return false;
    });
})