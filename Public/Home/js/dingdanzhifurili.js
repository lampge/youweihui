//前台函数之线路
/*线路*/

$(function(){
    //显示线路价格
    $('#start_time').click(function(){
        $("#calendar").show();
        //$("#cal_hide").show();
        line.show_price_type();
    });
    //切换
    $('#js_tag_top a').click(function(){
        line.js_tag_top(this);
    });
    //频道页面切换
    $('.js_line_top a').click(function(){
        line.js_line_top(this);
    });
    //无产品不显示更多链接
    $('.list790').each(function(){
        var self=$(this);
        var notfound=self.find('.not_found');
        if(notfound.length!=0 && notfound!=undefined){
            self.find('.more').hide();
        }
    });
});
line = {
    //选择套餐
    date_type:function(type_id,date,price,price_d,price_child_d,typename,stock){
       $('#select_typename').html(typename); 
       $('#price_type').find("li").removeClass("selected");
       $('#price_type').find("#li_date_type_"+type_id).addClass("selected");
       $("#calendar").find("div").hide();
       //$("#cal_hide").hide();
       //$('#start_time').val(date);
       $('#type_id').val(type_id);
       if (price == 0) {
            $('#price').hide();
       } else {
            $('#price').html("￥"+price);
            $('#price').show();
       }
       $('#price_cncn_child').html(price_child_d);

        var discount =  $('#discount').val();
        var sale_price = price_d - discount;
        var uid = $('#uid').val();
        var sale_member = $('#sale_member').val();
        if((uid > 0 && sale_member == 1) || sale_member==0){
            $('#price_cncn').html(sale_price);
        }else{
            $('#price_cncn').html(price_d);
        }
        $('#sale_price').html(sale_price);
         
       var price_explan = $('#price_type').find("#li_date_type_"+type_id).find('a').eq(0).attr('forhtml');
       $('#price_explan').html(price_explan);
       var adult_num = $('#adult_num').val();
       if(com.isInt(adult_num) == false){
            $('#adult_num').val(1);
       }
       var child_num = $('#child_num').val();
       if(com.isInt(adult_num) == false){
            $('#child_num').val(0);
       }
       $('#total_price_s').html(0);
       $("#stock").html(stock);
    },
     //显示线路价格
    show_price_type:function(){
        var line_id = $('#line_id').val();
        var type_id = $('#price_type').find('.selected').eq(0).attr('htmlfor');
        if (type_id == undefined) {
            /*alert('请您先选择套餐类型');
            $('#calendar').hide();*/
            return false;
        }
        //判断价格是否已经存在
        var is_type = $("#type_"+type_id).html();
        if(is_type == null){
            $.ajax({
                type : "POST",
                url :'/line/show_price_type',
                data:{line_id:line_id,type_id:type_id},
                success:function(data){
                    $("#calendar").append(data);
                },
                error:function(){
                     alert("出错啦！");
                }
            });
        }else{
             $("#type_"+type_id).show();
        }
    },
    /*隐藏日历*/
    close_calendar:function(){
        $("#calendar").hide();
    },
    more_month:function(event,type_id){
        $("#type_"+type_id).find("table").show();
        $("#type_"+type_id).find(".pre_month").remove();
    },
    view_order:function(date,price,type_id,stock,price_child){
        //date 日期，price价格，type_id价格类型
        $("#type_"+type_id).find("td").removeClass("nav_on");
        $("#type_"+type_id).find('#'+date).addClass("nav_on");
        $('#from_date').html(" " + date + "号出发");
        $("#calendar").hide();
        $("#stock").val(stock);
        $("#start_time").val(date);
        
        var uid = $('#uid').val();
        var sale_member = $('#sale_member').val();
        
        var discount =  $("#discount").val();
        if(typeof(discount) == 'undefined'){
            discount = 0;
        }
        if((uid > 0 && sale_member == 1) || sale_member== 0){
            var cur_price = price-discount;
        }else{
           var cur_price = price;
        }
        $("#price_cncn").html(cur_price);
        
        if (com.isInt(price_child)) {
            if (price_child > 0) {
                $("#price_cncn_child").html(price_child);
            }
        }
        
        $('#sale_price').html(price-discount);
        $("#total_price_s").html(cur_price);
        var adult_num = $('#adult_num').val();
        if(com.isInt(adult_num) == false){
            $('#adult_num').val(1);
        }
        var child_num = $('#child_num').val();
        if(com.isInt(adult_num) == false){
            $('#child_num').val(0);
        }
        if(stock!=-1 && parseInt(stock) < parseInt(adult_num)+parseInt(child_num)){
            $("#stock_msg").html('<div class="tip_2"><i>◆</i><s>◆</s><em>库存不足</em></div>');
        }else{
            $("#stock_msg").html('');
        }
        //更改价格类型基本报价
        line.update_type_price();
    },
    update_type_price:function(){
        //当前选择type_id,
        var line_id = $('#line_id').val();
        var date = $("#start_time").val();
        //获取类型指定日期信息
        $.ajax({
            type : "POST",
            url :'/line/show_specify_price',
            dataType: "json",
            data:{line_id:line_id,date:date},
            success:function(data){
                var msg = data.msg;
                for(var i=0;i<msg.length;i++){
                    var href = "javascript:line.date_type('"+msg[i]['type_id']+"','"+msg[i]['date']+"','"+msg[i]['price']+"','"+msg[i]['price_d']+"','"+msg[i]['price_child_d']+"','"+msg[i]['typename_s']+"','"+msg[i]['stock']+"');line.view_order('"+msg[i]['date']+"','"+msg[i]['price_d']+"','"+msg[i]['type_id']+"','"+msg[i]['stock']+"');";
                    $("#li_date_type_"+msg[i]['type_id']).find("a").attr('href',href)
                }
            },
            error:function(){
                com.if_logout();
            }
        });
        
        $("#price_type").find("a").each(function(){
            var href = $(this).attr("href");
             //date_type(type_id,date,price,price_d,price_child_d,typename,stock);
        });
    },
    js_tag_top:function(event){
        $("#js_tag_top").find('a').removeClass("on");
        $(event).addClass("on");
        var id = $(event).attr("id");
        if(id == 'xingcheng'){
            $("#content").children('div').show();
        }else{
            $("#content").children('div').hide();
            $("#content_"+id).show();
        }
		$('body,html').animate({scrollTop:$("#js_tag_top2").offset().top},300);
    },
    js_line_top:function(event){
        var htmlfor = $(event).closest("[class='js_line_top']").attr('for');
        $(event).closest("[class='js_line_top']").find('span').removeClass("on");
        $(event).closest("span").addClass("on");
        var id = $(event).attr("id");
        $("#js_line_top_list_"+htmlfor).children('div').hide();
        $("#js_line_top_"+id).show();
    },
    //下订单
    order:function(){
        var line_id = $('#line_id').val();
        var price_type_id = $('#price_type').find('.selected').eq(0).attr('htmlfor');
        var date = $("#start_time").val();
        var adult_num = $("#adult_num").val();
        var child_num = $("#child_num").val();
        var stock = $("#stock").html();
        $('#type_id').val(price_type_id);
        $('#date').val(date);
        //验证
        var is_validte = 1;
        if (price_type_id == undefined) {
            /*alert('请您先选择套餐类型');*/
            return false;
        }
        if(date == '') {
            alert('请您指定出发日期');
            return false;
        }
        if(!line.isInt(adult_num)){$("#adult_num").next().html("必须为正整数");is_validte=0;}else{$("#adult_num").next().html("");}
        if(!line.isInt(child_num)){$("#child_num").next().html("必须为正整数");is_validte=0;}else{$("#child_num").next().html("");}
        if(adult_num + child_num < 1){$("#child_num").next().html("参团人数不能为0");is_validte=0;}else{$("#child_num").next().html("");}
        //库存是否足够
        if(is_validte == 0){
            return false;
        }

        if(parseInt(stock) != -1 && (parseInt(stock) < parseInt(adult_num)+parseInt(child_num)) ){
            $("#stock_explan").html('<div class="tip_2"><i>◆</i><s>◆</s><em>库存不足，最多可预订'+stock+'人，如需帮助可直接联系客服</em></div>');is_validte=0;
            return false;
        }
        var url = '/line/order/?line_id='+line_id+'&type_id='+price_type_id+'&date='+date+'&adult_num='+adult_num+'&child_num='+child_num;
        $("#line_order").attr("action",url);
        $("#line_order").submit();
    },
    //订单详细页，计算总价
    sum_order:function(){
        var adult_num = $("#adult_num").val();
        var child_num = $("#child_num").val();
        var stock = $("#stock").val();
        var price_cncn = $("#price_cncn").html();
        var price_cncn_child = $("#price_cncn_child").html();
        var discount =  $("#discount").val();
        var dingjin = $("#dingjin").val();
        if(typeof(discount) == 'undefined'){
            discount = 0;
        }
        if(adult_num =='库存不足'){
            adult_num = 0;
        }
        if(child_num ==''){
            child_num = 0;
        }
        var is_validate = 1;
        if(!line.isInt(adult_num)){
            $("#adult_num").next().next().html("必须为正整数");is_validate=0;
        }else{
            $("#adult_num").next().next().html("");is_validate=1;
        }
        if(!line.isInt(child_num)){
            $("#child_num").next().next().html("必须为正整数");is_validate=0;
        }else{
            $("#child_num").next().next().html("");is_validate=1;
        }
        if(adult_num + child_num < 1){
            $("#child_num").next().next().html("参团人数不能为0");is_validte=0;
        }else{
            $("#sum_num").html("");
            $("#child_num").next().next().html("");is_validte=1;
        }
        if(stock!=-1 && parseInt(stock) < parseInt(adult_num)+parseInt(child_num)){
            $("#stock_msg").html('<div class="tip_2"><i>◆</i><s>◆</s><em>库存不足，最多可预订'+stock+'人，如需帮助可直接联系客服</em></div>');is_validte=0;
        }else{
            $("#stock_msg").html('');is_validte=1;
        }
        if(is_validate == 0){
            return ;
        }
        var sum = adult_num * (price_cncn - discount) + child_num*price_cncn_child;
        $("#total_price_s").html(sum);
        var sun_dj = adult_num*dingjin +"元";
        $("#dingjin_s").html(sun_dj);        
    },
    
    /*验证整数,type=1 为正整数*/
    isInt:function(str,type){
        if(type == 1){
            var preg=/^[0-9]*[1-9][0-9]*$/;
        }else{
            var preg=/\d+$/;
        }
        if(preg.test(str)){
            return true;
        }else{
            return false;
        }
    }
}
