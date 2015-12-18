(function ($) {
$(function(){
    var ie6_pos_reset = function(dom){
        var _scrollHeight = $(document).scrollTop();
        var _windowHeight = $(window).height();
        var _windowWidth = $(window).width();
        var _h = dom.height();
        var _w = dom.width();
        dom.css({
            left:(_windowWidth - _w)/2,
            top:(_windowHeight - _h )/2 + _scrollHeight,
            position:'absolute'
        });
    }
    var no_ie6_pos_reset = function(dom){
        var _scrollHeight = $(document).scrollTop();
        var _windowHeight = $(window).height();
        var _windowWidth = $(window).width();
        var _h = dom.height();
        var _w = dom.width();
        dom.css({
            left:'50%',
            top:'50%',
            'margin-left':-_h/2,
            'margin-top':-_w/2,
            position:'fixed'
        });
    }
    var alert_fail = function (content){
        $('#fail_alert').remove();
        $('body').append('<div id="fail_alert" style="display:none" ><p>'+content+'</p></div>');
        var dom = $('#fail_alert');
        if ($.browser.msie && $.browser.version=="6.0"){
            ie6_pos_reset(dom);
        }else{
            no_ie6_pos_reset(dom);
        }
        dom.fadeIn();
        setTimeout(function(){dom.fadeOut()},2000);
    }
    window.alert_fail = alert_fail;
    var alert_success = function (content){
        $('#success_alert').remove();
        $('body').append('<div id="success_alert" style="display:none" ><p>'+content+'</p></div>');
        var dom = $('#success_alert');
        if ($.browser.msie && $.browser.version=="6.0"){
            ie6_pos_reset(dom);
        }else{
            no_ie6_pos_reset(dom);
        }
        dom.fadeIn();
        setTimeout(function(){dom.fadeOut()},2000);
    }
    window.alert_success = alert_success;
    var alert_confirm = function (content,callback){
        $('#confirm_alert').remove();
        $('body').append('<div id="confirm_alert" style="display:none" >'+
        '<p>'+content+'</p>'+
        '<a href="javascript:;" class="confirm_btn">确定</a>'+
        '<a href="javascript:;" class="cancel_btn">取消</a></div>');
        var dom = $('#confirm_alert');
        dom.off().on('click','a',function(){
            if($(this).hasClass('confirm_btn')){
                callback();
            }
            dom.fadeOut();
        })
        if ($.browser.msie && $.browser.version=="6.0"){
            ie6_pos_reset(dom);
        }else{
            no_ie6_pos_reset(dom);
        }
        dom.fadeIn();
    }
    window.alert_confirm = alert_confirm;
})
})(jQuery)
