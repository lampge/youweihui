//验证规则
front_validate = {
    send_sms: function(){
        $("#send_sms").click(function(){
            var than = $(this);
            var value = $("#mobile").val();
            if (value == '') {
                alert('手机号不能为空');
                return false;
            }
            var length = value.length;
            //var mobile = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
            var mobile =  /^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}$|18[0-9]{9}$/;
            if (length != 11 || !mobile.test(value)) {
                alert('手机号码格式错误');
                return false;
            }
            var time = 120;
            $.ajax({
                url: 'sendSms',
                data: {mobile: value},
                type: 'post',
                dataType: 'json',
                beforeSend: function(){
                    than.attr('disabled', true);
                    than.val('发送中...');
                },
                success: function(msg){
                    if (msg.status) {
                        var ds = setInterval(function () {
                            if (time <= 0) {
                                than.attr('disabled', false);
                                than.val('重新发送');
                                clearInterval(ds);
                            } else {
                                than.val(time + '秒后重发');
                                time--;
                            }
                        }, 1000);
                    } else {
                        alert(msg.info);
                        than.attr('disabled', false);
                        than.val('重新发送');
                    }
                },
                error: function(){
                    alert('网络异常...');
                    than.attr('disabled', false);
                    than.val('重新发送');
                    return false;
                }
            })

        })

    },
    register: function() {
        jQuery("#modiform").validate({
            errorClass: "validate_error",
            // success: function(label){
            //     // console.log(label);
            //     // var fix = label.closest(".fix");
            //     // fix.find("label").remove();
            //     // fix.append('<label class="validate_success"></label>');
            // },
            errorPlacement: function(error, element) {
                if (element.is(":radio")) {
                    error.appendTo(element.parent().parent());
                } else {
                    var fix = element.closest(".fix");
                    fix.append(error);
                }
                element.closest(".fix").find(".validate_success").remove();
            },
            rules: {
                mobile: {
                    required: true,
                    mobile: true,
                    remote: {
                        url: "/User/checkMobile",
                        type: "post",
                        dataType: "json",
                        data: {
                            mobile: function() {
                                return $("#mobile").val();
                            }
                        }
                    }
                },
                sms_code: {
                    required: true,
                    minlength: 4,
                    maxlength: 4,
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 20,
                },
                confirm_password: {
                    required: true,
                    minlength: 6,
                    maxlength: 20,
                    equalTo: '#password'
                },
                email: {
                    // email: true
                }
            },
            messages: {
                mobile: {
                    required: "<i></i>请输入手机号",
                    mobile: "<i></i>手机号码格式错误",
                    remote: $.format("<i></i>该手机号已使用!")
                },
                sms_code: {
                    required: "<i></i>请输入验证码",
                    minlength: $.format("<i></i>验证码为4个字符"),
                    maxlength: $.format("<i></i>验证码为4个字符"),
                    remote: $.format("<i></i>验证码错误!")
                },
                password: {
                    required: "<i></i>请输入密码",
                    minlength: $.format("<i></i>密码不能小于{0}个字符"),
                    maxlength: $.format("<i></i>密码不能大于{0}个字符")
                },
                confirm_password: {
                    required: "<i></i>请输入确认密码",
                    minlength: $.format("<i></i>确认密码不能小于{0}个字符"),
                    maxlength: $.format("<i></i>确认密码不能大于{0}个字符"),
                    equalTo: "<i></i>两次输入密码不一致不一致"
                },
                email: {
                    email: "<i></i>邮箱号格式错误"
                },
            }
        });
    }
}
