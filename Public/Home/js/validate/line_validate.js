//验证规则
front_validate = {
    order_line:function(){
        jQuery("#modiform").validate({
            errorClass:"validate_error",
            success: function(label){
                var span = label.closest("span");
                span.find("label").remove();
                span.append('<label class="validate_success"></label>');
            },
            errorPlacement: function(error, element) {
                if ( element.is(":radio")){
                    error.appendTo ( element.parent().parent());
                }else{
                    var span = element.closest("span");
                    span.append(error);
                }
                element.closest("span").find(".validate_success").remove();
            },
            rules: {
                truename:{
                    required: true,
                    username: true,
                    minlength: 2,
                    maxlength: 10
                },
                mobile:{
                    required: true,
                    mobile: true
                },
				user_email:{
                    email: true
                },
                tel:{
                    phone:true
                },
                qq:{
                    qq:true
                },
                intro:{
                    maxlength: 100
                },
                verify:{
                    required: true,
                    minlength: 4,
                    maxlength: 4,
                    remote: {
                        url: "/Line/checkCode",
                        type: "post",
                        dataType: "json",
                        data: {
                            verify: function() {return $("#verify").val();},
                            type: 'line'
                        }
                    }

                }
            },
            messages: {
                truename:{
                    required: "<i></i>请填写联系人",
                    username: "<i></i>联系人姓名只能为汉字或字母",
                    minlength: "<i></i>最少为2个字",
                    maxlength: "<i></i>最多为10个字"
                },
                mobile: {
                    required: "<i></i>请输入手机号",
                    mobile: "<i></i>手机号码格式错误",
                    remote : $.format("<i></i>该手机号已使用!")
                },
				user_email: {
                    email: "<i></i>邮件地址格式错误"
                },
                tel:{
                    phone:"<i></i>电话号码格式错误"
                },
                qq:{
                    qq:"<i></i>qq格式错误"
                },
                intro:{
                    maxlength: "<i></i>最多为100个字"
                },
                verify:{
                    required: "<i></i>请输入验证码",
                    minlength: "<i></i>验证码为4个字符",
                    maxlength: "<i></i>验证码为4个字符",
                    remote : $.format("<i></i>验证码错误!")
                }
            }
        });
    }
}
