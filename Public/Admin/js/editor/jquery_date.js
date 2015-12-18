(function ($) {
$.fn.date_select=function(config){
    var now = new Date();
    now = [now.getFullYear(),now.getMonth()+1,now.getDate()];
    var _con = jQuery.extend({
        cur_date : $.merge([],now),
        today : $.merge([],now),
        min_date : null,//2013-6-6
        max_date : null,//2013-6-6
        day_callback : function(){},
        init_callback : function(){},
        year_month_callback : function(){},
        hide_callback : function(){},
        show_callback : function(){},
        clear_callback : function(){}
    },config||{});
    return this.each( function() {
        var id = setTimeout(function(){},1);
        var date_select_id = 'date_select_'+id;
        var self = this;
        var $self = $(self);
        var date_select_dom = null;
        var con = jQuery.extend({},_con);
        var new_date = function(arr){ 
            var date = new Date(); 
            date.setUTCFullYear(parseInt(arr[0],10), parseInt(arr[1],10) - 1, parseInt(arr[2],10)); 
            date.setUTCHours(0, 0, 0, 0); 
            return date; 
        };
        var stop_bubble = function(event){
            if (event.stopPropagation) {
                event.stopPropagation();
            } else {
                event.cancelBubble = true;
            }
        };
        var day = function(){
            var from = new_date([con.select_year,con.select_month,1]);
            var to = new_date([con.select_year,con.select_month+1,1]);
            var max_date = null;
            if(con.max_date && con.max_date.match(/\d{4}\-\d{1,2}\-\d{1,2}/)){
                max_date = new_date(con.max_date.split('-'));
            }
            var min_date = null;
            if(con.min_date && con.min_date.match(/\d{4}\-\d{1,2}\-\d{1,2}/)){
                min_date = new_date(con.min_date.split('-'));
            }
            var cur_date = new_date(con.cur_date);
            var today = new_date(con.today);
            var html = '<span>一<i></i></span><span>二<i></i></span><span>三<i></i></span><span>四<i></i></span><span>五<i></i></span><span>六<i></i></span><span>日</span>';
            var day_index = from.getDay();
            if(day_index === 0){
                day_index = 7;
            }
            for(var i = 0; i < day_index-1; i++){
                html += '<b></b>';
            }
            for(i = from; i < to; i.setDate(i.getDate() + 1)){
                var class_name = '';
                if(cur_date.toString() === i.toString()){
                    class_name += ' cur';
                }
                if(today.toString() === i.toString()){
                    class_name += ' today';
                }
                if((min_date && i < min_date) || (max_date && i > max_date)){
                    class_name += ' disable';
                }
                var date_text = i.getFullYear()+'-'+(i.getMonth()+1)+'-'+i.getDate();
                html += '<a href="javascript:;" data-date_text="'+date_text+'" class="'+class_name+'">'+i.getDate()+'</a>';
            }
            date_select_dom.find('.date_select_dd').html(html);
            con.date_doms = date_select_dom.find('.date_select_dd a:not(.disable)');
            con.date_doms.unbind().bind('click',function(){
                con.cur_date[0] = con.select_year;
                con.cur_date[1] = con.select_month;
                con.cur_date[2] = parseInt($(this).text(),10);
                day();
                con.day_callback.apply(con);
            });
        };
        var num_to_cn_month = function(num){
            var month_arr = ['','一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'];
            return month_arr[num];
        };
        var year_and_month = function(){
            date_select_dom.find('.date_select_yymm span').html(con.select_year+'年 '+num_to_cn_month(con.select_month));
        };
        var prev_month = function(){
            con.select_month = con.select_month - 1;
            if(con.select_month === 0){
                con.select_year = con.select_year - 1;
                con.select_month = 12;
            }
            year_and_month();
        };
        var prev_year = function(){
            if(con.select_year === 1900){
                return;
            }
            con.select_year = con.select_year - 1;
            year_and_month();
        };
        var next_month = function(){
            con.select_month = con.select_month + 1;
            if(con.select_month > 12){
                con.select_year = con.select_year + 1;
                con.select_month = 1;
            }
            year_and_month();
        };
        var next_year = function(){
            if(con.select_year === 2100){
                return;
            }
            con.select_year = con.select_year + 1;
            year_and_month();
        };
        var hide = function(){
            date_select_dom.hide();
            con.hide_callback();
        };
        var position_dom = $self.parent('label');//判断输入框是否有label标签包裹，如果有则选择label为日期定位节点
        if(position_dom.length===0){
            position_dom = $self;
        }
        var show = function(){
            date_select_dom.css({
                position:'absolute',
                top:position_dom.offset().top + position_dom.height() + 7,
                left:position_dom.offset().left + position_dom.outerWidth() - date_select_dom.outerWidth()
            });
            $('.date_select').hide();
            date_select_dom.show();
            con.show_callback();
        };
        var toggle = function(){
            if(date_select_dom.css('display') !== 'none'){
                hide();
            }else{
                show();
            }
        };
        var init = function(){
            var html = ''+
                '<div class="date_select" id="'+date_select_id+'"">'+
                    '<div class="date_select_yymm">'+
                        '<div class="date_select_yymm_wrap">'+
                            '<b class="prev_year"><i class="first"></i><i class="second"></i></b>'+
                            '<i class="prev"></i>'+
                            '<i class="next"></i>'+
                            '<b class="next_year"><i class="first"></i><i class="second"></i></b>'+
                            '<span></span>'+
                        '</div>'+
                    '</div>'+
                    //+'<a class="date_select_back_today" href="javascript:;">回到今天</a>'
                    '<a class="date_select_clear" href="javascript:;">清空</a>'+
                    '<div class="date_select_dd fn-clear"></div>'+
                '</div>';
            $('body').append(html);
            date_select_dom = $('#'+date_select_id);
            con.select_year = con.cur_date[0];
            con.select_month = con.cur_date[1];
            date_select_dom.find('.date_select_yymm .prev').click(function(){
                prev_month();
                day();
                con.year_month_callback.apply(con);
            });
            date_select_dom.find('.date_select_yymm .prev_year').click(function(){
                prev_year();
                day();
                con.year_month_callback.apply(con);
            });
            date_select_dom.find('.date_select_yymm .next').click(function(){
                next_month();
                day();
                con.year_month_callback.apply(con);
            });
            date_select_dom.find('.date_select_yymm .next_year').click(function(){
                next_year();
                day();
                con.year_month_callback.apply(con);
            });
            date_select_dom.find('.date_select_back_today').click(function(){
                con.select_year = con.today[0];
                con.select_month = con.today[1];
                year_and_month();
                con.cur_date = $.merge([],con.today);
                day();
                con.year_month_callback.apply(con);
                con.day_callback.apply(con);
            });
            date_select_dom.find('.date_select_clear').click(function(){
                con.clear_callback.apply(con);
            });
            year_and_month();
            day();
            date_select_dom.css({
                position:'absolute',
                top:$self.offset().top + $self.height() + 7,
                left:$self.offset().left + $self.outerWidth() - date_select_dom.outerWidth()
            });
            show();
            //截获鼠标点击事件，停止冒泡
            date_select_dom.bind('click',function(event){
                stop_bubble(event);
            });
            con.init_callback.apply(con);
            con[date_select_id] = date_select_id;
            self.date_select = {
                hide:hide,
                show:show,
                toggle:toggle
            };
        };
        init();
    });
};
})(jQuery)