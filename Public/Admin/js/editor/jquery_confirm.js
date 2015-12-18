/* 
 * 最新更新：2013-3-27
 */
(function(){
    var confirm = function(config){
        var con = {
            title:'确认框',
            html:'',
            init_fun:function(){},
            ok_fun:function(){},
            cancel_fun:function(){},
            ok_btn_name:'确定',
            cancel_btn_name:'取消',
            confirm_btn_name:'确定',//接口修改成ok_btn_name,但保留原接口
            width:518
        }
        con = $.extend(con,config||{});
        if(con.ok_btn_name !== '确定'){
            con.confirm_btn_name = con.ok_btn_name;
        }
        var html = ''+
                '<div class="cncw_dialog" style="width:'+con.width+'px">'+
                    '<div class="hd">'+
                        con.title+
                        '<a class="close"></a>'+
                    '</div>'+
                    '<div class="bd">'+
                        con.html+
                    '</div>'+
                    '<div class="btns">'+
                        '<a href="javascript:;" class="btn_b fr confirm">'+con.confirm_btn_name+'</a>'+
                        (con.cancel_btn_name === '取消'?'':('<a href="javascript:;" class="btn_d fr cancel mr10">'+con.cancel_btn_name+'</a>'))+
                    '</div>'+
                '</div>';
        $('body').append(html);
        con.init_fun();
        var confirm_dialog = $('.cncw_dialog').dialog();
        confirm_dialog.find('.confirm').click(function(){
            if(con.ok_fun(confirm_dialog)+'' !== 'false'){
                confirm_dialog.dialog_close();
            }
        })
        confirm_dialog.find('.cancel').click(function(){
            if(con.cancel_fun(confirm_dialog)+'' !== 'false'){
                confirm_dialog.dialog_close();
            }
        })
        confirm_dialog.find('.close').click(function(){
            confirm_dialog.dialog_close();
        })
    }
    $.confirm = confirm;
 })();
