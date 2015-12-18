(function($){
$(function(){
    var stop_bubble = function(event){
        if (event.stopPropagation) {
            event.stopPropagation();
        } else {
            event.cancelBubble = true;
        }
    }
    //页面实时检查
    var timeout_event_fun_arr = [];
    var timeout_event = function(pretime){
        setTimeout(function(){
            $(timeout_event_fun_arr).each(function(i){
                this();
            })
            timeout_event(pretime);
        },pretime)
    }
    timeout_event(500);
    //输入框聚焦
    $('.input_text input,.input_select select').focus(function(){
        var self = $(this);
        self.parent().addClass('focus');
    });
    $('.input_text input,.input_select select').blur(function(){
        var self = $(this);
        self.parent().removeClass('focus');
    });
    //字数剩余提示
    $('.J_input_left').each(function(){
        var self = $(this);
        var parent = self.parent();
        var batch_at_max_length = parseInt(self.data('max'),10);
        var input = $('[name="'+self.data('input_name')+'"]')[0];
        var cur_len = 0;
        var timeout_event_fun = function(){
            var len = input.value.length;
            //var len = Math.ceil(value.replace(/[^\x00-\xff]/g,"**").length/2);
            if(len === cur_len){
                return;
            }
            var num = batch_at_max_length-len;
            if(len>batch_at_max_length){
                parent.html('已超出<em style="color:red">'+Math.abs(num)+'</em>字');
            } else {
                parent.html('还能输入<em>'+num+'</em>字');
            }
            cur_len = len;
        }
        timeout_event_fun_arr.push(timeout_event_fun);
    });
    //多行文本字符剩余计算
    $('.J_textarea_left').each(function(){
        var self = $(this);
        var parent = self.parent();
        var batch_at_max_length = parseInt(self.data('max'),10);
        var input = $('[name="'+self.data('input_name')+'"]');
        var input_name = self.data('input_name')+'_size';
        var cur_len = 0;
        var timeout_event_fun = function(){
            var text = input.data('text');
            //var text = input.val();
            var len = 0;
            if(text){
                len = text.length;
            }
            //var len = Math.ceil(value.replace(/[^\x00-\xff]/g,"**").length/2);
            if(len === cur_len){
                return;
            }           
            var num = batch_at_max_length-len;
            if(len>batch_at_max_length){
                parent.html('已超出<em style="color:red">'+Math.abs(num)+'</em>字<input type="hidden" name="'+input_name+'" value="'+len+'">');
            } else {
                parent.html('还能输入<em>'+num+'</em>字<input type="hidden" name="'+input_name+'" value="'+len+'">');
            }
            cur_len = len;
        }
        timeout_event_fun_arr.push(timeout_event_fun);
    });
    //日历控件
    $('.input_calendar input').click(function(event){
        var self = this;
        stop_bubble(event);
        var $self = $(self);
        $self.blur();
        if(self.date_select){
            self.date_select.toggle();
        }else{
            var today = [];
            var min_date = $self.data('min_date');
            var max_date = $self.data('max_date');
            $.each($('#today').val().split('-'),function(){
                today[today.length] = parseInt(this,10);
            })
            $self.date_select({
                dom : self,
                cur_date : today,
                min_date : min_date,
                max_date : max_date,
                today : $.merge([],today),
                day_callback : function(){
                    var con = this;
                    var $self = $(con.dom);
                    var select_date = con.cur_date[0]+'-'+con.cur_date[1]+'-'+con.cur_date[2];
                    $self.val(select_date);
                    con.dom.date_select.hide();
                    $self.focus();
                    $self.blur();
                },
                year_month_callback : function(){
                    var con = this;
                },
                init_callback : function(){
                    var con = this;
                    $(document).bind('click',function(){
                        con.dom.date_select.hide();
                    })
                },
                hide_callback:function(){
                    $(this.dom).removeClass('selected');
                },
                show_callback:function(){
                    $(this.dom).addClass('selected');
                },
                clear_callback:function(){
                    var $self = $(this.dom);
                    this.dom.date_select.hide();
                    $self.val('');
                }
            })
        }
    });
    //输入限制
    $('.J_input_limit').each(function(){
        var self = $(this);
        var limit_type = self.data('limit_type')
        var timeout_event_fun = function(){
            var value = self.val();
            var t_value = '';
            if(limit_type === 'digits'){
                t_value = value.replace(/[^0-9]/g,'');//剔除非数字字符
                if(t_value.length>1){
                    t_value = t_value.replace(/^0+/g,'');//剔除首位为0的数字
                }
                if(t_value !== value){
                    self.val(t_value);
                }
            }
            if(limit_type === 'digits_letters'){
                t_value = value.replace(/[^0-9a-z]/gi,'');//剔除非数字和英文字符
                if(t_value !== value){
                    self.val(t_value);
                }
            }
        }
        timeout_event_fun_arr.push(timeout_event_fun);
    })
    //大段文字提示
    var tip_hide_time = null;
    $('.J_more_tip').hover(function(){
        var self = $(this);
        self.parents('.row').addClass('high_div');
        $('#'+self.data('tip_id')).show().off().hover(function(){
            if(tip_hide_time){
                clearTimeout(tip_hide_time)
            }
        },function(){
            if(tip_hide_time){
                clearTimeout(tip_hide_time)
            }
            self.parents('.row').removeClass('high_div');
            $('#'+self.data('tip_id')).hide();
        });
        $(self.data('hide_select')).css({
            visibility:'hidden'
        })
    },function(){
        var self = $(this);
        tip_hide_time = setTimeout(function(){
            self.parents('.row').removeClass('high_div');
            $('#'+self.data('tip_id')).hide();
        },200)
        $(self.data('hide_select')).css({
            visibility:'visible'
        })
    })
    //天数输入
    $('.J_amount i').click(function(event){
        var val = $('.J_amount input').val();
        var maxlength = $('.J_amount input').attr('maxlength');
        if(!maxlength){
            maxlength = 5;
        }
        maxlength = parseInt(maxlength,10);
        var max_num = Math.pow(10,maxlength);
        if(val.length===0){
            $('.J_amount input').val(1)
        }else{
            if(max_num-1>parseInt(val,10)){
                $('.J_amount input').val(parseInt(val,10)+1);
            }
        }
    })
    $('.J_amount b').click(function(event){
        var val = $('.J_amount input').val();
        if(val.length===0||val+''==='1'){
            $('.J_amount input').val(1)
        }else{
            $('.J_amount input').val(parseInt(val,10)-1);
        }
    })
})
})(jQuery)