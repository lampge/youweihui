//后台函数之线路
/*线路*/
line = {
    chg_traffic:function(){
        var arr_traffic = ['','飞机','火车','汽车','轮船','动车','高铁'];
        var traffic1 = arr_traffic[jQuery("[name='traffic_1']").val()];	
        var traffic2 = arr_traffic[jQuery("[name='traffic_2']").val()];
        if (traffic1){
            var traffic1_ext = traffic1+'去'
        }
        
        if (traffic2){
            var traffic2_ext = traffic2+'回'
        }
        if (traffic1_ext == undefined){
            traffic1_ext = '';
        }
        if (traffic2_ext == undefined){
            traffic2_ext = '';
        }
        jQuery("[name='traffic']").val(traffic1_ext + traffic2_ext);
    },
    list_bind:function(){
        jQuery(function(){
            jQuery('.selectHover').hover(function(){
                jQuery(this).find('.selectBox').show();
                jQuery(this).addClass('hov');
            },function(){
                jQuery(this).find('.selectBox').hide();
                jQuery(this).removeClass('hov');
            });
            jQuery('.selectBox').click(function(){
                $(this).hide();
            });
            //排序
//            jQuery('#line_table_title').find("th").on(
//                'click',function(){
//                var cur = jQuery(this).attr("_for1");
//                if(cur == 'orderby'){
//                    line.update_orderby(this);
//                }
//            });
            //批量更新排序
            jQuery('#ajax_batch_order').click(function(){
                line.batch("batch_order");
            });
            //显示批量修改价格
            jQuery('#show_batch_price').click(function(){
                line.batch("show_batch_price");
            });
            //批量修改价格
            jQuery('#ajax_batch_price').click(function(){
                line.batch("ajax_batch_price");
            });
            //批量同步
            jQuery('#ajax_batch_syn').click(function(){
                line.batch("ajax_batch_syn");
            });
            //批量导入
            jQuery('#ajax_batch_synall').click(function(){
                line.batch("ajax_batch_synall");
            });
             //点击排序时，自动勾选
            jQuery('#list').find("[type='text']").on(
                'keyup',function(){
                    var cur = jQuery(this).val();
                    if(com.isInt(cur) == true){
                        if(cur > 9999){
                            jQuery(this).closest("tr").find(".checkbox").attr("checked",false);
                            jQuery(this).next("label").remove();
                            jQuery(this).val(cur.substr(0,cur.length-1));
                        }else{
                            jQuery(this).closest("tr").find(".checkbox").attr("checked",true);
                            jQuery(this).next("label").remove();
                        }
                    }else{
                        jQuery(this).closest("tr").find(".checkbox").attr("checked",false);
                        jQuery(this).next("label").remove();
                        jQuery(this).val(cur.substr(0,cur.length-1));
                    }
                }
            );
        });
        /*批量推荐取消，推荐，显示*/
        jQuery("#cha_isrec").change(function(){
            var isrec = jQuery(this).val();
            if( isrec== -10)return false;
            if(com.is_checkbox() == true){
                var param = '';
                jQuery("[name='checkboxs[]']").each(function(i){
                    if(jQuery(this).attr("checked") == 'checked'){
                       param += $(this).val() + '|';
                    }                
                });
                param = param.substr(0,param.length-1);
                jQuery.ajax({
                    type : "POST",
                    url :'/cp/line/ajax/batch_isrec',
                    dataType : 'json',
                    data:{param:param,isrec:isrec,inajax:3},
                    success:function(data){
                        if(data.status == 1){
                            jQuery("[name='checkboxs[]']").each(function(i){
                                if(jQuery(this).attr("checked") == 'checked'){
                                    switch(isrec){
                                        case '-1':
                                            jQuery(this).closest("tr").remove();
                                            break;
                                        case '0':
                                          var cur = jQuery(this).closest("tr").find("td");
                                            var title = cur.eq(1).html();
                                            if(title.indexOf("commend_icon.gif") > 0){
                                                cur.find('img').each(function(){
                                                    if($(this).attr('src').indexOf('commend_icon.gif')>0){
                                                        $(this).remove();
                                                    }
                                                })
                                            }
                                            break;
                                        case '1':
                                            //选中项判断是否已推荐过
                                            var cur = jQuery(this).closest("tr").find("td");
                                            var title = cur.eq(1).html();
                                            if(title.indexOf("commend_icon.gif") < 0){
                                                cur.eq(1).append('<img src="/static/images/cp/commend_icon.gif" title="此线路已设为推荐">');
                                            }
                                            break;
                                        default:
                                            break;
                                    }
                                }
                            });
                        }else{
                            alert(data.msg);
                        }
                    },
                    error:function(){
                        com.alert_msg();
                    }
                });
            }else{
                alert("没有选中任何线路，请选择！");
            }
        });
        /*单条线路删除*/
        jQuery("[name='del']").on(
            'click',function(){
                var event = jQuery(this).closest("tr");
                var param = event.find("[name='checkboxs[]']").attr("value");
                if(confirm("确定要删除吗")){
                    jQuery.ajax({
                        type : "POST",
                        url :'/cp/line/ajax/batch_del',
                        dataType :'json',
                        data:{param:param,inajax:3},
                        success:function(data){
                            if(data.status == 1){
                                event.remove();
                            }else{
                                alert(data.msg);
                            }
                        },
                        error:function(){
                          com.alert_msg();
                        }
                    });
                }
            }
        );
        /*批量删除*/
        jQuery("#batch_del").click(function(){
            line.batch("batch_del");
        });
    },
    //更新排序
//    update_orderby:function(event){
//        var order1 = order2 = order3 = '';
//        order1 =  jQuery(event).closest('th').attr("_for");
//        var asc = jQuery(event).closest('th').find(".arrow").eq(0).html();
//        if(asc == '↓' ){
//            order2 = ' ASC';
//            order3 = '↑';
//        }else{
//            order2 = ' DESC';
//            order3 = '↓';
//        }
//        
//        jQuery("#order_by").val(order1 + order2);
//        com.change_page('line','1','/cp/line/ajax/page');
//        jQuery(event).closest('th').find(".arrow").eq(0).html(order3);
//    },
    search:function(type){
        var sel_typeid = jQuery("[name='sel_typeid']").val();
        var sel_typeid2 = jQuery("[name='sel_typeid2']").val();
        var sel_class = jQuery("[name='sel_class']").val();
        var sel_status = jQuery("[name='sel_status']").val();
        var search_input = jQuery("[name='search_input']").val();
        if(search_input == '请输入相关内容'){
            search_input = '';
        }
        jQuery.ajax({
            type : "POST",
            url :'/cp/line/ajax',
            data:{},
            success:function(data){
                jQuery("#page").html(data);
            },
            error:function(){
                com.alert_msg();
            }
        });
    },
    select:function(type){
        var arr_allow = new Array("isrec","payment","hitless","notorder","sale","syn");
        var is_allow = 0;
        for(var i=0 ;i<arr_allow.length;i++){
            if(type == arr_allow[i]){
               is_allow = 1
            }
        }
        if(is_allow == 0){
            alert("非法操作");
            return false;
        }
        $("input[name='checkboxs[]']").each(function(){			
			if($(this).attr("_for_"+type) == '1'){
                $(this).attr("checked",true);
                $(this).closest('tr').addClass('on');
                $(this).closest('tr').find('span:first').hide();
                $(this).closest('tr').find('input').show();							
            }else{
                $(this).attr("checked",false);
                $(this).closest('tr').removeClass('on');
            }
        }); 
    },
    batch:function(type){
        var arr_allow = new Array("batch_del","batch_order","show_batch_price","ajax_batch_price","ajax_batch_syn","ajax_batch_synall");
        var is_allow = 0;
        for(var i=0 ;i<arr_allow.length;i++){
            if(type == arr_allow[i]){
               is_allow = 1
            }
        }
        if(is_allow == 0){
            alert("非法操作");
            return false;
        }
        
        //批量导入
        if(type=='ajax_batch_synall') {
            jQuery.post('/cp/c_syn/syn_shop_info/', {'type' : 1}, function(x) {
                if (x == -1) {
                    alert("您已经导入过网店线路");
                } else {
                    var info = x.split('|');
                    alert(info[1] + "条导入成功，"+info[0]+"条因标题相同导入失败");
                    window.location.href = window.location.href;
                }
            })

            return;
        }
        var param = com.getParam();
        if(param == ''){
            alert("没有选中任何线路，请选择！");
            return false;
        }
        
        switch(type){
            case 'batch_del':
				jQuery.ajax({
					type : "POST",
					url :'/cp/line/ajax/'+'batch_check_order',
					dataType :'json',
					data:{param:param,inajax:3},
					success:function(data){ 
						if(data.status == 1){ 
							if(confirm(data.msg)){
							jQuery.ajax({
								type : "POST",
								url :'/cp/line/ajax/'+type,
								dataType :'json',
								data:{param:param,inajax:3},
								success:function(data){
									if(data.status == 1){
									   //删除行
									   jQuery("input[name='checkboxs[]']:checked").each(function(){
											jQuery(this).closest("tr").hide() ;
									   });
									}else{
										alert(data.msg);
									}
								},
								error:function(){
								   com.alert_msg();
								}
							});
                }else{
                    com.remove_loading();
                } 			
                        }else{
                                alert(data.msg);
                        }
                    },
                    error:function(){
						com.alert_msg();
                    }
               });
/*
                if(confirm("确定要删除吗")){
                    jQuery.ajax({
                        type : "POST",
                        url :'/cp/line/ajax/'+type,
                        dataType :'json',
                        data:{param:param,inajax:3},
                        success:function(data){
                            if(data.status == 1){
                               //删除行
                               jQuery("input[name='checkboxs[]']:checked").each(function(){
                                    jQuery(this).closest("tr").hide() ;
                               });
                            }else{
                                alert(data.msg);
                            }
                        },
                        error:function(){
                           com.alert_msg();
                        }
                    });
                }else{
                    com.remove_loading();
                }  */       
                break;
            case 'batch_order':
                    var param = ''; 
                    var if_validate = 1;
                    jQuery("[name='checkboxs[]']").each(function(i){
                        if(jQuery(this).attr('checked') == 'checked'){
                            var e = jQuery(this).parents("tr").find('input[type=text]');
                            var orderid = e.val();
                            if(com.isInt(orderid)){
                                if(orderid > 9999){
                                    e.after('<label class="validate_error"><i></i>必须小于9999</label>');
                                    if_validate = 0;
                                }else{
                                    e.next("label").remove().after('<label class="success"></label>');
                                    if_validate =1;
                                }
                            }else{
                                e.next().addClass("validate_error").html("<i></i>必须为整数");
                                if_validate = 0
                            }
                            param += jQuery(this).val() + ',' +  orderid + '|';
                        }
                    });
                    if(param != ''){
                        param = param.substr(0,param.length-1);
                    }
                    if(if_validate == 0){
                        return false;
                    }
                    jQuery.ajax({
                        type : "POST",
                        url :'/cp/line/ajax/'+type,
                        dataType :'json',
                        data:{param:param,inajax:3},
                        success:function(data){
							if(data.status == 3){
								com.logout(data.msg);
                                return;
							}
                            if(data.status == 1){
                                alert(data.msg);
                                window.location.reload();
                            }else{
                                alert(data.msg);
                            }
                        },
                        error:function(){
                            com.alert_err_msg();
                        }
                    });
                break;
            case 'show_batch_price':
                jQuery("#line_ids").val(param);
                jQuery("#modiform").attr("action","/cp/line/show_batch_price");
                jQuery("#modiform").submit();
                break;
            case 'ajax_batch_price':
                var if_validate= 1;
                var typeid_s=price_s=price_d_s=price_child_d_s=stock_s=line_id_s = '';
                
                jQuery("input[name='checkboxs[]']:checked").each(function(i){
                    //type_id
                   typeid_s += jQuery(this).val() + '||';
                    //门市价 
                    var pp0 = jQuery(this).parents('tr').find("td").eq(4).find("input");
                    var price_a = pp0.val();
                    if(com.isInt(price_a,1)){
                        pp0.next().removeClass("validate_error").addClass("validate_success").html("");
                    }else{
                        pp0.next().addClass("validate_error").html("必须为正整数");
                        if_validate = 0;
                    }
                   price_s += price_a + '||';
                    //欣欣优惠价
                    var pp1 = jQuery(this).parents('tr').find("td").eq(5).find("input");
                    var price_d_a = pp1.val();
                    if(com.isInt(price_d_a,1)){
                        if(parseInt(price_d_a) > parseInt(price_a)){
                            pp1.next().addClass("validate_error").html("须小于市价");
                            if_validate = 0;
                        }else{
                            pp1.next().removeClass("validate_error").addClass("validate_success").html("");
                        }
                    }else{
                        pp1.next().addClass("validate_error").html("必须为正整数");
                        if_validate = 0;
                    }
                    price_d_s += price_d_a + '||';
                      //儿童价格
                    var pp2 = jQuery(this).parents('tr').find("td").eq(6).find("input");
                    var price_child_a = pp2.val();//儿童价格
                    if(com.isInt(price_child_a)){
                        pp2.next().removeClass("validate_error").addClass("validate_success").html("");			
                    }else{
                        pp2.next().addClass("validate_error").html("必须为正整数");
                        if_validate = 0;
                    }
                    price_child_d_s += pp2.val() + '||';
                    
					//line_id
					var line_id = jQuery(this).parents('tr').find("input[name='line_id']").val();
					line_id_s +=line_id + '||';

                    //库存
                    //var pp3 = jQuery(this).parent().find("td").eq(7).find("input");
                    //var stock = pp3.val();
                    //if(com.isInt(stock)){
                    //    pp3.next().removeClass("validate_error").addClass("validate_success").html("");			
                    //}else{
                    //    pp3.next().addClass("validate_error").html("必须为整数");
                    //    if_validate = 0;
                    //}
                    //stock_s += jQuery(this).val() + '||';
                }); 

                if(if_validate == 0){
                    return false;
                }
                typeid_s = com.cut_str(typeid_s,2);
                price_s = com.cut_str(price_s,2);
                price_d_s = com.cut_str(price_d_s,2);
                price_child_d_s = com.cut_str(price_child_d_s,2);
                //stock_s = com.cut_str(stock_s,2);
                com.show_loading();
                jQuery.ajax({
                        type: 'POST',
                        url :'/cp/line/ajax/update_price_type',
                        dataType : 'json',
                        data: {typeid:typeid_s,price:price_s,price_d:price_d_s,price_child_d:price_child_d_s,stock:'',line_id_s:line_id_s,inajax:3},
                        success: function(data){
                            if(data.status == 1){ 
                                com.show_message(data.msg,1);
                                com.close_pop();
                                jQuery("#calendar").hide();
                                window.location.href='/cp/line';
                            }else{
                                com.show_message(data.msg,0);
                            }
                            com.remove_loading();
                        },
                        error:function(){
                            com.remove_loading();
                            com.alert_msg();
                        }
                });
                break;
            case "ajax_batch_syn":
                jQuery.ajax({
                    type : "POST",
                    url :'/cp/line/ajax/'+type,
                    dataType :'json',
                    data:{param:param,inajax:3},
                    success:function(data){
						if(data.status == 3){
							alert(data.msg);
							return;	
						}
                        if(data.status == '1'){
                            var syn = data.syn;
                            if(syn == ''){
                               // return false;
                            } 
                            jQuery("input[name='checkboxs[]']:checked").each(function(i){
                                //选中项判断是否已推荐过
                                for(var j=0;j<data.syn.length;j++){
                                    if(jQuery(this).val() == data.syn[j]){
                                        var cur = jQuery(this).closest("tr").find("td");
                                        var title = cur.eq(1).html();
                                        if(title.indexOf("tongbu_icon.gif") < 0){
                                            cur.eq(1).append('<img src="/static/images/cp/tongbu_icon.gif">');
                                        }
                                    }
                                }
                            });
                            alert(data.msg);
                        }else{
                            alert(data.msg);
                        }
                    },
                    error:function(){
                    }
                });
                break;
            default:
                break;
        }
    },
    show_update_price_type:function(event){
        var id = jQuery(event).attr("id");
        var type_id = 0;
        var price = '';
        var price_cncn = '';
        var price_cncn_child = '';
        var stock = '';
        var title='添加';
        if(id == 'editPriceType'){
            type_id = jQuery(event).closest("tr").find("input").eq(0).val();
            title  = '编辑';       
        }
        if(id == 'editPriceType'){
            com.show_loading("加载中");
            var line_id = jQuery("#line_id").val();
            jQuery.ajax({
                type : "POST",
                url :'/cp/line/ajax/get_price_type',
                data:{line_id:line_id,typeid:type_id,inajax:3},
                success:function(data){
                    jQuery("#price_type").show();
                    jQuery("#calendar").hide();
                    jQuery("#price_type").html(data);
                    com.remove_loading(1,100);
                },
                error:function(){
                    com.remove_loading(1,100);
                    com.alert_err_msg();
                }
            });    
        }else{
            window.location.href="/cp/step2_add/"+line_id;
        }
    },
    update_price_type:function(typeid){
        var line_id = jQuery("#line_id").val();
        var group_date = jQuery(":radio[name='group_date'][checked]").val();
        var price_explan = jQuery("[name='update_price_explan']").val();
        com.show_loading();
        jQuery.ajax({
            type : "POST",
            url :'/cp/line/ajax/update_price_type',
            data:{line_id:line_id,group_date:group_date,typeid:typeid,price_explan:price_explan,inajax:3},
            dataType :'json',
            success:function(data){
				if(data.status == 3){
					com.logout(data.msg);
					return;	
				}
                if(data.status == 0){
                    com.show_message(data.msg,0);
                }
                com.remove_loading();
                jQuery("#price_type").hide();
            },
            error:function(){
                com.remove_loading();
                com.alert_err_msg();
            }
        });
    },
    add_price_type:function(typeid){
        var line_id = jQuery("#line_id").val();
        var group_date = jQuery(":radio[name='group_date'][checked]").val();
        var typename =jQuery("[name='update_typename']").val();
        var price =jQuery("[name='update_price']").val();
        var price_d =jQuery("[name='update_price_d']").val();
        var price_child_d =jQuery("[name='update_price_child_d']").val();
        var stock = jQuery("[name='update_stock']").val();
        var price_explan = jQuery("[name='update_price_explan']").val();
        if(!$("#modiform").valid()){
            return;
        }
        com.show_loading();
        jQuery.ajax({
            type : "POST",
            url :'/cp/line/ajax/update_price_type',
            data:{line_id:line_id,group_date:group_date,typeid:typeid,typename:typename,price:price,price_d:price_d,price_child_d:price_child_d,stock:stock,price_explan:price_explan,inajax:3},
            dataType :'json',
            success:function(data){
				if(data.status == 3){
					com.logout(data.msg);
					return;	
				}
                if(data.status == 1){
                    window.location.href="/cp/line/step2/"+line_id+'/1';
                }
                if(data.status == 0){
                    com.show_message(data.msg,0);
                }
                com.remove_loading();
            },
            error:function(){
                com.remove_loading();
                com.alert_err_msg();
            }
        });
    },
    del_price_type:function(event){
        var line_id = jQuery("#line_id").val();
        var type_id = jQuery(event).closest("tr").find(".J_type_ids").val();
        if(com.isInt(line_id,1) == false){
            alert("请指定线路");
            return false;
        }
        if(com.isInt(type_id,1)  == false){
            alert("请指定线路类型");
            return false;
        }
        com.show_loading();
        jQuery.ajax({
            type : "POST",
            url :'/cp/line/ajax/del_price_type',
            data:{line_id:line_id,type_id:type_id,inajax:3},
            dataType :'json',
            success:function(data){
				if(data.status == 3){
					com.logout(data.msg);
					return;
				}
                if(data.status == 1){
                    jQuery(event).closest("tr").remove();
                    jQuery("#tab1").find("[class='del_price_type']").eq(0).hide();
                    jQuery("#calendar").html('');
                }else{
                    com.show_message(data.msg,0);
                }
                com.remove_loading();
            },
            error:function(){
                com.remove_loading();
                com.alert_err_msg();
            }
        });
    },
    show_price_calendar:function(event){
        var line_id = jQuery("#line_id").val();
        var type_id = jQuery(event).closest("tr").find("[name='typeid[]']").val();
        if(com.isInt(line_id,1) == false){
            alert("请指定线路");
            return false;
        }
        if(com.isInt(type_id,1)  == false){
            alert("请指定线路类型");
            return false;
        }
        com.show_loading("加载中");
        jQuery.ajax({
            type : "POST",
            url :'/cp/line/ajax/get_price',
            data:{line_id:line_id,type_id:type_id,inajax:3},
            success:function(data){
                jQuery("#price_type").hide();
                jQuery("#calendar").show();
                jQuery("#calendar").html(data);
                com.remove_loading(1,100);
            },
            error:function(){
                com.remove_loading();
                com.alert_err_msg();
            }
        });
    },
    /*修改指定日期报价对话框*/
    show_price_detail:function(event){
        var offset = $(event).offset();
        var line_id = jQuery("#line_id").val();
        var type_id = jQuery("#type_id").val();
        var date = jQuery(event).closest("td").attr("id");
        var for_adult = jQuery("#"+date).attr('for_adult');
        var for_child = jQuery("#"+date).attr('for_child');
        var for_stock = jQuery("#"+date).attr('for_stock');
        if(!com.isInt(line_id,1)){
            com.show_message("请指定线路ID！",0);
            return false;
        }
        if(!com.isInt(type_id,1)){
            type_id = 0;
            /*com.show_message("请指定线路类型ID！",0);
            return false;*/
        }
        var p = jQuery('#day').remove();
        if(for_stock == -1){
            for_stock ='';
        }
        var html = jQuery('<div id="day" for_date="'+date+'" class="day"><a href="javascript:;" onclick="line.close_price_type_detail(this)" class="close" title="关闭"></a>'
                +'<div class="daybox">'
                +'<strong><em>'+date+'</em>报价</strong>'
                +'<p>'
                +'<span class="mr10">优惠价:<input type="text" class="text text30" id="ajax_price_d" value="'+for_adult+'">元<span></span></span>'
                +'<span class="mr10">儿童价:<input type="text" class="text text30" id="ajax_price_child_d" value="'+for_child+'">元<span></span></span>'
                +'<span>库存:<input type="text" class="text text30" id="ajax_stock" value="'+for_stock+'"><span></span></span>'
                +'</p>'
                +'<input type="button" class="button" id="ajax_update_price" value="确定保存">'
                +'</div>'
                +'</div>');
        html.css({
            left: offset.left+20,
            top : offset.top+10
        });
        jQuery('body').append(html);	
    },
    /*关闭指定日期报价对话框*/
    close_price_type_detail:function(event){
        var day_id = jQuery(event).closest("div").attr("id");
        var for_date = jQuery(event).closest("div").attr("for_date");
        var p = $('.day').remove();
    },
    /*修改指定日期报价*/
    update_price:function(){
        var line_id = jQuery("#line_id").val();
        var type_id = jQuery("#type_id").val();
        var date = jQuery("#day").attr("for_date");
        var day = parseInt(date.substr(8),10);
        var price_d = jQuery("#ajax_price_d").val();
        var price_child_d = jQuery("#ajax_price_child_d").val();
        var stock = jQuery("#ajax_stock").val();
        if(!com.isInt(line_id,1)){
            com.show_message("请指定线路ID！",0);
            return false;
        }
        if(!com.isInt(type_id,1)){
            type_id = 0; 
            /*com.show_message("请指定线路类型ID！",0);
            return false;*/
        }
        
        var if_validate = 1;

        //门市价格
        if(com.isInt(price_d,1)){
            jQuery("#ajax_price_d").next().removeClass("validate_error").addClass("validate_success").html("");
        }else{
            jQuery("#ajax_price_d").next().addClass("validate_error").html("必须为正整数");
            if_validate = 0;
        }
        //儿童价
        if(com.isInt(price_child_d)){
            jQuery("#ajax_price_child_d").next().removeClass("validate_error").addClass("validate_success").html("");			
        }else{
            jQuery("#ajax_price_child_d").next().addClass("validate_error").html("必须为整数");
            if_validate = 0;
        }
        //库存
        if(stock == '' || stock == '不限制'){
            stock = -1;
        }
        if(stock == -1 || com.isInt(stock) == true){
            jQuery("#ajax_stock").next().removeClass("validate_error").addClass("validate_success").html("");			
        }else{
            jQuery("#ajax_stock").next().addClass("validate_error").html("必须为整数");
            if_validate = 0;
        }
        if(if_validate == 0){
            return false;
        }
        
        com.show_loading();
        jQuery.ajax({
            type : "POST",
            url :'/cp/line/ajax/update_price',
            dataType :'json',
            data:{line_id:line_id,type_id:type_id,date:date,price_d:price_d,price_child_d:price_child_d,stock:stock,inajax:3},
            success:function(data){
				if(data.status == 3){
					com.logout(data.msg);
					return;	
				}
                if(data.status == 1){
                    line.close_price_type_detail();
                    //库存
                    var str_stock = stock;
                    if(stock == '' || stock == '不限制' || stock == -1){
                        str_stock = '不限制';
                    }
                    var html = '<i onclick="line.del_price(this)" title="删除此天价格"></i><a onclick="line.show_price_detail(this);">'+day+'<em title="成人价：'
                                +price_d+'元儿童价：'
                                +price_child_d+'元 库存 ： '+str_stock+'">'+price_d
                                +'</em></a>';
                    jQuery("#"+date).html(html);
                    jQuery("#"+date).attr('for_adult',price_d);
                    jQuery("#"+date).attr('for_child',price_child_d);
                    jQuery("#"+date).attr('for_stock',stock);
                    jQuery("#"+date).attr('class','special');
                }
                if(data.status == 0){
                    com.show_message(data.msg,0);
                }
                com.remove_loading();
            },
            error:function(){
                com.remove_loading();
                com.alert_err_msg();
            }
        });
    },
    /*删除指定日期报价*/
    del_price:function(event){
        var line_id = jQuery("#line_id").val();
        var type_id = jQuery("#type_id").val();
        var update_group_date = jQuery("[name='update_group_date']").val();
        var price_d = jQuery("#price_d").val();
        var price_child_d = jQuery("#price_child_d").val();
        var date = jQuery(event).closest("td").attr("id");
        var day = parseInt(date.substr(8),10);
        com.show_loading();
        jQuery.ajax({
            type : "POST",
            url :'/cp/line/ajax/del_price',
            dataType :'json',
            data:{line_id:line_id,type_id:type_id,date:date,inajax:3},
            success:function(data){
				if(data.status == 3){
					com.logout(data.msg);
					return;	
				}
                if(data.status == 1){
                    if(update_group_date == 1){//天天发团
                        var str_rt = '';
                        if(price_child_d > 0){
                            str_rt = ' 儿童价 '+price_child_d;
                        }
                        var html = '<a onclick="line.show_price_detail(this);">'+day+'<em title="'+price_d+ str_rt + '" class="grade_1">'+price_d+'</em></a>';
                    }else{//指定日期
                        var html = '<a onclick="line.show_price_detail(this);">'+day+'</a>';
                    }
                    
                    jQuery("#"+date).html(html);
                    jQuery("#"+date).attr('class','normal');
                }
                if(data.status == 0){
                    com.show_message(data.msg,0);
                }
                com.remove_loading();
            },
            error:function(){
                com.remove_loading();
                com.alert_err_msg();
            }
        });
    },
    /*指定周几添加日期*/
    price_weekend:function(event){
        var line_id = jQuery("#line_id").val();
        var type_id = jQuery("#type_id").val();
        var weekday = '';
        var price_d = jQuery(event).closest("p").find("[name='price_cncn_c']").val();
        var price_child_d = jQuery(event).closest("p").find("[name='price_cncn_child_c']").val();
        var stock = jQuery(event).closest("p").find("[name='stock_c']").val();
        if(com.trim(stock) == ''){
            stock = -1;
        }
        jQuery("[name='weekday']").each(function(i){
            if(jQuery(this).attr("checked") == true){
                weekday += jQuery(this).val() +','
            }
        });
        if(weekday == ''){
            alert("请选择周几发团！");
            return;
        }
        weekday = com.cut_str(weekday,1);
        //验证价格
        var re = line.check_calendar_price(event);
        if(re == 0){
            return false;
        }
        com.show_loading();
        jQuery.ajax({
            type : "POST",
            url :'/cp/line/ajax/batch_update_price',
            dataType :'json',
            data:{op_type:'week',line_id:line_id,type_id:type_id,weekday:weekday,price_d:price_d,price_child_d:price_child_d,stock:stock,inajax:3},
            success:function(data){
				if(data.status == 3){
					com.logout(data.msg);
					return;	
				}
                if(data.status == 1){
                    //在月历上显示样式及价格
                    var str_stock = stock;
                    if(stock == -1){
                        str_stock = '不限制';
                    }
                    var update_date = data.update_date;
                    for(var i=0;i<update_date.length;i++){
                        var date = update_date[i];
                        var day = parseInt(update_date[i].substr(8),10)
                        var html = '<i onclick="line.del_price(this)" title="删除此天价格"></i><a onclick="line.show_price_detail(this);">'+day+'<em title="成人价：'
                                    +price_d+'元儿童价：'
                                    +price_child_d+'元 库存 ： '+str_stock+'">'+price_d
                                    +'</em></a>';
                        jQuery("#"+date).html(html);
                        jQuery("#"+date).attr('for_adult',price_d);
                        jQuery("#"+date).attr('for_child',price_child_d);
                        jQuery("#"+date).attr('for_stock',stock);
                        jQuery("#"+date).attr('class','special');
                    }
                }
                if(data.status == 0){
                    com.show_message(data.msg,0);
                }
                com.remove_loading();
            },
            error:function(){
                com.remove_loading();
                com.alert_err_msg();
            }
        });
    },
    check_calendar_price:function(event){
        var p = jQuery(event).closest("p");
        var price_d = p.find("[name='price_cncn_c']").val();
        var price_child_d = p.find("[name='price_cncn_child_c']").val();
        var stock = p.find("[name='stock_c']").val();
        if(com.trim(stock) == ''){
            stock = -1;
        }
        var if_validate = 1;

        if(com.isInt(price_d,1) == false){
            p.find("[name='price_cncn_c']").next().addClass("validate_error").html("<i></i>必须为正整数");
            if_validate = 0
        }else{
            p.find("[name='price_cncn_c']").next().removeClass("validate_error").html("");
        }
        if(com.isInt(price_child_d) == false){
            p.find("[name='price_cncn_child_c']").next().addClass("validate_error").html("<i></i>必须为整数");
            if_validate = 0
        }else{
            p.find("[name='price_cncn_child_c']").next().removeClass("validate_error").html("");
        }
        if(stock == -1 || com.isInt(stock) == true){
            p.find("[name='stock_c']").next().removeClass("validate_error").html("");
        }else{
            p.find("[name='stock_c']").next().addClass("validate_error").html("<i></i>必须为整数");
            if_validate = 0; 
        } 
        return if_validate;
    },
    price_between:function(event){
        var line_id = jQuery("#line_id").val();
        var type_id = jQuery("#type_id").val();
        var from_date = jQuery("#from_date").val();
        var end_date = jQuery("#end_date").val();
        var price_d = jQuery(event).closest("p").find("[name='price_cncn_c']").val();
        var price_child_d = jQuery(event).closest("p").find("[name='price_cncn_child_c']").val();
        var stock = jQuery(event).closest("p").find("[name='stock_c']").val();
        if(com.trim(stock) == ''){
            stock = -1;
        }
        var re = line.check_calendar_price(event);
        if(re == 0){
            return false;
        }
        com.show_loading();
        jQuery.ajax({
            type : "POST",
            url :'/cp/line/ajax/batch_update_price',
            dataType :'json',
            data:{op_type:'between',line_id:line_id,type_id:type_id,from_date:from_date,end_date:end_date,price_d:price_d,price_child_d:price_child_d,stock:stock,inajax:3},
            success:function(data){
				if(data.status == 3){
					com.logout(data.msg);
					return;	
				}
                if(data.status == 1){
                    //在月历上显示样式及价格
                    var update_date = data.update_date;
                    //库存
                    var str_stock = stock;
                    if(stock == '' || stock == '不限制' || stock == -1){
                        str_stock = '不限制';
                    }
                    for(var i=0;i<update_date.length;i++){
                        var date = update_date[i];
                        var day = parseInt(update_date[i].substr(8),10)
                        var html = '<i onclick="line.del_price(this)" title="删除此天价格"></i><a onclick="line.show_price_detail(this);">'+day+'<em title="成人价：'
                                    +price_d+'元儿童价：'
                                    +price_child_d+'元 库存 ： '+str_stock+'">'+price_d
                                    +'</em></a>';
                        jQuery("#"+date).html(html);
                        jQuery("#"+date).attr('for_adult',price_d);
                        jQuery("#"+date).attr('for_child',price_child_d);
                        jQuery("#"+date).attr('for_stock',stock);
                        jQuery("#"+date).attr('class','special');
                    }
                }
                if(data.status == 0){
                    com.show_message(data.msg,0);
                }
                com.remove_loading();
            },
            error:function(){
                com.remove_loading();
                com.alert_err_msg();
            }
        });
    },
    clear_all_price:function(){
        var line_id = jQuery("#line_id").val();
        var type_id = jQuery("#type_id").val();
        var update_group_date = jQuery("[name='update_group_date']").val();
        var price_d = jQuery("#price_d").val();
        var price_child_d = jQuery("#price_child_d").val();
        com.show_loading();
        jQuery.ajax({
            type : "POST",
            url :'/cp/line/ajax/batch_update_price',
            dataType :'json',
            data:{op_type:'clear_all',line_id:line_id,type_id:type_id,inajax:3},
            success:function(data){
                if(data.status == 1){
                    //在月历上显示样式及价格
                    if(update_group_date == 1){//天天发团
                        jQuery("#date_table").find(".special").find("em").html(price_d);
                    }else{//指定日期
                        jQuery("#date_table").find(".special").find("em").remove();
                    }
                    
                    jQuery("#date_table").find("td[class='special']").attr("class","normal");
                }
                if(data.status == 0){
                    com.show_message(data.msg,0);
                }
                com.remove_loading();
            },
            error:function(){
                com.remove_loading();
                com.alert_err_msg();
            }
        });
    },
    step3_bind:function(){
        //显示景点
        jQuery("#show_jindian").click(function(){
            jd.show_jd('multi',35);
        });
        //可视化编辑模式切换
        jQuery("[name='features_tc']").click(function(){
            line.change_features_tc();
        });
        //编辑模式切换
        jQuery("[name='sch_tc']").click(function(){
            line.change_sch_tc();
        });
        //行程版式模板切换，图片显示切换
        jQuery("[name='sch_sheet']").click(function(){
            line.change_sch_sheet();
        });
        //添加天数
        jQuery("#addAllbtn").click(function(){
            line.addXingcheng();
        });
        //默认行程天数
        line.show_days();
    },
    //可视化编辑模式切换
    change_features_tc:function(){
        var features_tc = jQuery("[name='features_tc']:checked").val();
        if(features_tc ==1){//编辑器
            jQuery("#features").hide();
            jQuery("#features_edit").show();    
        }else{
            jQuery("#features").show();
            jQuery("#features_edit").hide(); 
        }
    },
    //编辑模式切换
    change_sch_tc:function(){
        var sch_tc = jQuery("[name='sch_tc']:checked").val();
        if(sch_tc ==0){//编辑器
            jQuery("#xingcheng_content").children().hide();
            jQuery("#xingcheng_content").find(".row").eq(0).show();
            jQuery("#xingcheng_content").find(".fckeditor").show();
        }else{//天数
            jQuery("#xingcheng_content").children().show();
            jQuery("#xingcheng_content").find(".fckeditor").hide();
            jQuery("#xingcheng").find(".tempRow").show();
            line.change_sch_sheet();
        }
        jQuery("[for='shc_img1']").hide();
    },
    //行程版式模板切换，图片显示切换
    change_sch_sheet:function(){
        var sch_sheet = jQuery("[name='sch_sheet']:checked").val();
        if(sch_sheet == 0){
            jQuery("[for='shc_img']").hide();
            jQuery("[for='xingcheng_img']").hide();
            jQuery("[name='pic_size']").html("最佳宽度600，不限高度,最多3张");
        }else{
            if(sch_sheet == 1){//畅销版
                jQuery("[name='pic_size']").html("最佳宽度600，不限高度,最多3张");
            }
            if(sch_sheet == 2){//流行版
                jQuery("[name='pic_size']").html("图片尺寸220*150px，最大不超过2M,最多1张");
            }
        
            //动态插入iframe
            jQuery("[for='shc_img']").find(".browse").html('<iframe width="62px" scrolling="no" height="24x" frameborder="no" allowtransparency="yes" marginheight="0" marginwidth="0" class="fileimg" src="/cp/upload/swfupload/line_shc_img"></iframe>');
            var days = jQuery("[for='xingcheng_img']").size();
            var index = days-1;
            for(var i=0;i<=index;i++){
                jQuery("#xingcheng").find(".browse").eq(i).html('<iframe width="62px" scrolling="no" height="24x" frameborder="no" allowtransparency="yes" marginheight="0" marginwidth="0" class="fileimg" src="/cp/upload/swfupload/line_xingcheng/'+i+'"></iframe>');
            }
            jQuery("[for='shc_img']").show();
            jQuery("[for='xingcheng_img']").show();
        }
    },
    //添加行程天数
    addXingcheng:function(){
        var day = jQuery("#xingcheng").find("[class='tempRow']").size();
        if(day >= 20){
            alert("最多只能添加20天");
            return false;
        }
        var pic_size = '';
        var sch_sheet = jQuery("[name='sch_sheet']:checked").val();
        if(sch_sheet == 0 || sch_sheet == 1){
            pic_size = '最佳宽度600，不限高度,最多3张';
        }
        if(sch_sheet == 2){
            pic_size = '图片尺寸220*150px，最大不超过2M,最多1张';
        }
        
        var html = ''+
                '<div class="tempRow">'+
                    '<div class="row">'+
                        '<label>第'+(day+1)+'天：</label>'+
                        '<div class="cell-row">'+
                            '<input type="text" class="text text310" maxlength="30" name="xingcheng['+day+'][0]" value=""> '+
                            '<a href="javascript:void(0)" class="btn_c" onclick="line.delXingcheng(this);">删除第'+(day+1)+'天内容</a>'+
                        '</div>'+
                    '</div>'+
                    '<div class="row">'+
                        '<label>行程安排：</label>'+
                        '<div class="cell-row">'+
                            '<div class="add_del_box">'+
                                '<textarea name="xingcheng['+day+'][1]" style="width:520px;" class="J_editor" rows="12"></textarea>'+
                                //'<input type="button" value="+" class="button_add" onclick="line.addRows(this);" title="增加输入框的高度">'+
                                //'<input type="button" value="-" class="button_del" onclick="line.delRows(this);" title="减小输入框的高度">'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="row">'+
                        '<label>用餐：</label>'+
                        '<div class="cell-row">'+
                            '<label><input name="xingcheng['+day+'][2]" class="checkbox" type="checkbox" value="1">早餐</label> '+
                            '<label><input name="xingcheng['+day+'][3]" type="checkbox" class="checkbox" value="2">中餐 </label> '+
                            '<label><input name="xingcheng['+day+'][4]" type="checkbox" class="checkbox" value="3" >晚餐</label> '+
                        '</div>'+
                    '</div>'+
                    '<div class="row">'+
                        '<label>住宿：</label>'+
                        '<div class="cell-row">'+
                            '<input type="text" class="text text160" name="xingcheng['+day+'][5]" value="">'+
                        '</div>'+
                    '</div>'+
                    '<div class="row" for="xingcheng_img">'+
                        '<label>上传图片：</label>'+
                        '<div class="cell-row">'+
                            '<input type="hidden" class="sh_imgs" value="" name="xingcheng['+day+'][6]"><span class="upload_img" id="day_'+day+'"></span>'+
                            '<div class="browse">'+
                            '<iframe width="62px" scrolling="no" height="24x" frameborder="no" allowtransparency="yes" marginheight="0" marginwidth="0" class="fileimg" src="/cp/upload/swfupload/line_xingcheng/'+day+'"></iframe>'+
                            '</div>'+
                            '<a class="upload_click_link btn_c" href="javascript:;" upload_type="img" data-day="'+day+'">从附件中心选择</a>'+
                            '<span class="tip" name="pic_size">'+pic_size+'</span>'+
                        '</div>'+
                    '</div>'+
                '</div>';
        jQuery("#xingcheng").find(".delbtn").hide();    
        jQuery("#xingcheng").append(html);
        line.show_days();
        make_editor();
    },
    /*显示行程天数*/
    show_days:function(){
        var days = jQuery("#xingcheng").find(".tempRow").length +1;
        jQuery("#addAllbtn").html("添加第" + days + "天行程天数");
    },
    /*删除行程*/
    delXingcheng:function(event){
        if(!confirm('确认删除行程？')){
            return;
        }
        jQuery(event).parents(".tempRow").remove(); 
        line.show_days();        
    },
    /*增加行数*/
    addRows:function(event){
        var rows = jQuery(event).prev("textarea").attr('rows');
        jQuery(event).prev().attr('rows',rows+5);
    },
    /*减少行数*/
    delRows:function(event){
        var rows = jQuery(event).prev().prev().attr('rows');
        jQuery(event).prev().prev().attr('rows',rows-5);
    },
    /*价格快速更新*/
    search_fast_price:function(){
        jQuery("#modiform").submit();
    },
    //显示隐藏指定日期报价图标
    tab_baojia_ico:function(_that){
        var radioVal=$(_that).attr('value');
        if(radioVal==1){
            $('.add_ico').hide();
        }
        if(radioVal==2){
            $('.add_ico').show();
        }
       
    }
}
