<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($meta_title); ?>|OneThink管理平台</title>
    <link href="/Public/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/module.css">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/<?php echo (C("COLOR_STYLE")); ?>.css" media="all">
     <!--[if lt IE 9]>
    <script type="text/javascript" src="/Public/static/jquery-1.10.2.min.js"></script>
    <![endif]--><!--[if gte IE 9]><!-->
    <script type="text/javascript" src="/Public/static/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/jquery.mousewheel.js"></script>
    <!--<![endif]-->
    
</head>
<body>
    <!-- 头部 -->
    <div class="header">
        <!-- Logo -->
        <span class="logo"></span>
        <!-- /Logo -->

        <!-- 主导航 -->
        <ul class="main-nav">
            <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>"><a href="<?php echo (U($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!-- /主导航 -->

        <!-- 用户栏 -->
        <div class="user-bar">
            <a href="javascript:;" class="user-entrance"><i class="icon-user"></i></a>
            <ul class="nav-list user-menu hidden">
                <li class="manager">你好，<em title="<?php echo session('user_auth.username');?>"><?php echo session('user_auth.username');?></em></li>
                <li><a href="<?php echo U('User/updatePassword');?>">修改密码</a></li>
                <li><a href="<?php echo U('User/updateNickname');?>">修改昵称</a></li>
                <li><a href="<?php echo U('Public/logout');?>">退出</a></li>
            </ul>
        </div>
    </div>
    <!-- /头部 -->

    <!-- 边栏 -->
    <div class="sidebar">
        <!-- 子导航 -->
        
            <div id="subnav" class="subnav">
                <?php if(!empty($_extra_menu)): ?>
                    <?php echo extra_menu($_extra_menu,$__MENU__); endif; ?>
                <?php if(is_array($__MENU__["child"])): $i = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><!-- 子导航 -->
                    <?php if(!empty($sub_menu)): if(!empty($key)): ?><h3><i class="icon icon-unfold"></i><?php echo ($key); ?></h3><?php endif; ?>
                        <ul class="side-sub-menu">
                            <?php if(is_array($sub_menu)): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li>
                                    <a class="item" href="<?php echo (U($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul><?php endif; ?>
                    <!-- /子导航 --><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        
        <!-- /子导航 -->
    </div>
    <!-- /边栏 -->

    <!-- 内容区 -->
    <div id="main-content">
        <div id="top-alert" class="fixed alert alert-error" style="display: none;">
            <button class="close fixed" style="margin-top: 4px;">&times;</button>
            <div class="alert-content">这是内容</div>
        </div>
        <div id="main" class="main">
            
            <!-- nav -->
            <?php if(!empty($_show_nav)): ?><div class="breadcrumb">
                <span>您的位置:</span>
                <?php $i = '1'; ?>
                <?php if(is_array($_nav)): foreach($_nav as $k=>$v): if($i == count($_nav)): ?><span><?php echo ($v); ?></span>
                    <?php else: ?>
                    <span><a href="<?php echo ($k); ?>"><?php echo ($v); ?></a>&gt;</span><?php endif; ?>
                    <?php $i = $i+1; endforeach; endif; ?>
            </div><?php endif; ?>
            <!-- nav -->
            

            
	<script type="text/javascript" src="/Public/static/uploadify/jquery.uploadify.min.js"></script>

	<div class="main-title cf">
		<h2><?php echo ($meta_title); ?></h2>
	</div>
	<!-- 标签页导航 -->
<div class="tab-wrap">
	<div class="tab-content">
		<!-- 表单 -->
		<form id="form" action="" method="post" class="form-horizontal">
			<input type="hidden" id="expire_date_m6" value="<?php echo date('Y-m-d',strtotime('+ 6month'));?>">
			<input type="hidden" id="expire_date_m12" value="<?php echo date('Y-m-d',strtotime('+ 1year'));?>">
			<div class="form-item cf">
				<div class="controls">
					<label class="item-label">价格类型名称<span class="check-tips">（必填）</span></label>
					<input type="text" class="text input-large" name="typename" value="<?php echo ($data['typename']); ?>">
				</div>
			</div>
			<div class="form-item cf">
				<div class="controls">
					<label class="item-label">门市价<span class="check-tips">（必填）</span></label>
					<input type="text" class="text input-mid" name="price" value="<?php echo ($data['price']); ?>">元/人
				</div>
			</div>
			<div class="form-item cf">
				<div class="controls">
					<label class="item-label">费用说明<span class="check-tips"><button type="button" name="使用模版" class="btn J_use_template">使用模版</button></span></label>
					<textarea id="J_ForumPostCon" class="textarea textarea470" name="update_price_explan"><?php echo ((isset($data['update_price_explan']) && ($data['update_price_explan'] !== ""))?($data['update_price_explan']):''); ?></textarea>
				</div>
			</div>
			<div class="form-item cf">
				<div class="">
					<label class="item-label">线路报价<span class="check-tips">（必填）</span></label>

					<div class="pro_input date_price">
			            <input type="hidden" value="3" id="earlier_date">
			            <input type="hidden" value="<?php echo date('Y-m-d');?>" id="today">
			            <input type="hidden" value="<?php echo date('Y-m-d',strtotime('+ 6month'));?>" id="expire_day">
			            <input type="hidden" value="<?php echo ($data['date_price_data']); ?>" id="date_price_data" name="date_price_data">
			            <a href="javascript:;" class="small_btn J_clear_all_price fr">清除所有报价</a>
			            <ul class="tab_ul fl">
			                <li id="J_batch" class="on">批量添加价格</li>
			                <li id="J_range">添加指定时间段价格</li>
			            </ul>
			            <div class="date_table" id="J_date_table" style="clear: left;">
			                <div class="operate_area J_operate_area">
			                    <div class="J_batch_area">
			                        <div class="tp">
			                            <label class="input_checkbox"><input type="checkbox" class="J_week_all_select"/>天天发团</label>
			                            <label class="input_checkbox"><input type="checkbox" class="J_week_select" value="1"/>周一</label>
			                            <label class="input_checkbox"><input type="checkbox" class="J_week_select" value="2"/>周二</label>
			                            <label class="input_checkbox"><input type="checkbox" class="J_week_select" value="3"/>周三</label>
			                            <label class="input_checkbox"><input type="checkbox" class="J_week_select" value="4"/>周四</label>
			                            <label class="input_checkbox"><input type="checkbox" class="J_week_select" value="5"/>周五</label>
			                            <label class="input_checkbox"><input type="checkbox" class="J_week_select" value="6"/>周六</label>
			                            <label class="input_checkbox"><input type="checkbox" class="J_week_select" value="0"/>周日</label>
			                        </div>
			                        <div class="bt">
			                            <span>优惠价：<em>*</em></span><label class="input_text w_115"><input type="text" class="J_input_limit" data-limit_type="digits" name="price_cncn" value="" maxlength="6"/></label>
			                            <span>儿童价：</span><label class="input_text w_115"><input type="text" class="J_input_limit" data-limit_type="digits" name="price_cncn_child" value=""  maxlength="6"/>
			                            </label><a href="javascript:;" class="add_btn tag_btn m_l10" id="J_batch_add_by_week">添加</a>
			                        </div>
			                    </div>
			                    <div class="J_date_area" style="display:none;">
			                        <div class="tp">
			                            <span>指定时间段：<em>*</em></span>
			                            <label class="input_text input_calendar"><input type="text" data-min_date="2015-12-16" data-max_date="2016-12-11"/></label>
			                            <span>至</span>
			                            <label class="input_text input_calendar"><input type="text" data-min_date="2015-12-16" data-max_date="2016-12-11"/></label>
			                        </div>
			                        <div class="tp" style="margin-left:90px">
			                            <label class="input_checkbox"><input type="checkbox" class="J_week_select1" value="1" checked />周一</label>
			                            <label class="input_checkbox"><input type="checkbox" class="J_week_select1" value="2" checked />周二</label>
			                            <label class="input_checkbox"><input type="checkbox" class="J_week_select1" value="3" checked />周三</label>
			                            <label class="input_checkbox"><input type="checkbox" class="J_week_select1" value="4" checked />周四</label>
			                            <label class="input_checkbox"><input type="checkbox" class="J_week_select1" value="5" checked />周五</label>
			                            <label class="input_checkbox"><input type="checkbox" class="J_week_select1" value="6" checked />周六</label>
			                            <label class="input_checkbox"><input type="checkbox" class="J_week_select1" value="0" checked />周日</label>
			                        </div>
			                        <div class="bt">
			                            <span>优惠价：<em>*</em></span><label class="input_text w_115"><input type="text" class="J_input_limit" data-limit_type="digits" value=""/></label>
			                            <span class="m_l10">儿童价：</span><label class="input_text w_115"><input type="text" class="J_input_limit" data-limit_type="digits" value=""/>
			                            </label><a href="javascript:;" class="add_btn tag_btn m_l10" id="J_batch_add_by_dateandweek">添加</a>
			                        </div>
			                    </div>
			                </div>
			                <script id="date_price_template" type="text/date_price">
			                    <div class="month_row" style="z-index:$z_index">
			                        <div class="sd">
			                            <p class="year">$year年</p>
			                            <p class="month">$month月</p>
			                        </div>
			                        <div class="hd" $is_display>
			                            <ul>
			                                <li>星期日</li>
			                                <li>星期一</li>
			                                <li>星期二</li>
			                                <li>星期三</li>
			                                <li>星期四</li>
			                                <li>星期五</li>
			                                <li>星期六</li>
			                            </ul>
			                        </div>
			                        <div class="bd">
			                            <ul class="clearfix">$lis</ul>
			                            <div class="add_price_dialog J_add_price_dialog">
			                                <p>date</p>
			                                <input type="text" class="youhui J_quick_edit_input"/>
			                                <input type="text" class="child J_quick_edit_input"/>

			                                <a class="ok_btn" href="javascript:;">确定</a>
			                            </div>
			                        </div>
			                    </div>
			                </script>
			            </div>
	                    <div style="text-align: right;" id="J_date_more"><a href="javascript:void(0);">更多</a></div>
	                </div>
				</div>
			</div>
			<div class="form-item cf">
				<button class="btn" id="J_submit" type="button">保存价格方案</button>
				<input type="hidden" name="tc_id" value="<?php echo ((isset($data['tc_id']) && ($data['tc_id'] !== ""))?($data['tc_id']):0); ?>"/>
				<input type="hidden" name="line_id" value="<?php echo ((isset($data['line_id']) && ($data['line_id'] !== ""))?($data['line_id']):0); ?>"/>
			</div>
	</form>
</div>

        </div>
        <div class="cont-ft">
            <div class="copyright">
                <div class="fl">感谢使用<a href="http://www.onethink.cn" target="_blank">OneThink</a>管理平台</div>
                <div class="fr">V<?php echo (ONETHINK_VERSION); ?></div>
            </div>
        </div>
    </div>
    <!-- /内容区 -->
    <script type="text/javascript">
    (function(){
        var ThinkPHP = window.Think = {
            "ROOT"   : "", //当前网站地址
            "APP"    : "/admin.php", //当前项目地址
            "PUBLIC" : "/Public", //项目公共目录地址
            "DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
            "MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
            "VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
        }
    })();
    </script>
    <script type="text/javascript" src="/Public/static/think.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/common.js"></script>
    <script type="text/javascript">
        +function(){
            var $window = $(window), $subnav = $("#subnav"), url;
            $window.resize(function(){
                $("#main").css("min-height", $window.height() - 130);
            }).resize();

            /* 左边菜单高亮 */
            url = window.location.pathname + window.location.search;
            url = url.replace(/(\/(p)\/\d+)|(&p=\d+)|(\/(id)\/\d+)|(&id=\d+)|(\/(group)\/\d+)|(&group=\d+)/, "");
            $subnav.find("a[href='" + url + "']").parent().addClass("current");

            /* 左边菜单显示收起 */
            $("#subnav").on("click", "h3", function(){
                var $this = $(this);
                $this.find(".icon").toggleClass("icon-fold");
                $this.next().slideToggle("fast").siblings(".side-sub-menu:visible").
                      prev("h3").find("i").addClass("icon-fold").end().end().hide();
            });

            $("#subnav h3 a").click(function(e){e.stopPropagation()});

            /* 头部管理员菜单 */
            $(".user-bar").mouseenter(function(){
                var userMenu = $(this).children(".user-menu ");
                userMenu.removeClass("hidden");
                clearTimeout(userMenu.data("timeout"));
            }).mouseleave(function(){
                var userMenu = $(this).children(".user-menu");
                userMenu.data("timeout") && clearTimeout(userMenu.data("timeout"));
                userMenu.data("timeout", setTimeout(function(){userMenu.addClass("hidden")}, 100));
            });

	        /* 表单获取焦点变色 */
	        $("form").on("focus", "input", function(){
		        $(this).addClass('focus');
	        }).on("blur","input",function(){
				        $(this).removeClass('focus');
			        });
		    $("form").on("focus", "textarea", function(){
			    $(this).closest('label').addClass('focus');
		    }).on("blur","textarea",function(){
			    $(this).closest('label').removeClass('focus');
		    });

            // 导航栏超出窗口高度后的模拟滚动条
            var sHeight = $(".sidebar").height();
            var subHeight  = $(".subnav").height();
            var diff = subHeight - sHeight; //250
            var sub = $(".subnav");
            if(diff > 0){
                $(window).mousewheel(function(event, delta){
                    if(delta>0){
                        if(parseInt(sub.css('marginTop'))>-10){
                            sub.css('marginTop','0px');
                        }else{
                            sub.css('marginTop','+='+10);
                        }
                    }else{
                        if(parseInt(sub.css('marginTop'))<'-'+(diff-10)){
                            sub.css('marginTop','-'+(diff-10));
                        }else{
                            sub.css('marginTop','-='+10);
                        }
                    }
                });
            }
        }();
    </script>
    
<link href="/Public/static/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
<link href="/Public/Admin/js/editor/form.css" rel="stylesheet" type="text/css">
<link href="/Public/Admin/js/editor/editor.css" rel="stylesheet" type="text/css">
<link href="/Public/Admin/js/editor/date_price.css" rel="stylesheet" type="text/css">
<?php if(C('COLOR_STYLE')=='blue_color') echo '<link href="/Public/static/datetimepicker/css/datetimepicker_blue.css" rel="stylesheet" type="text/css">'; ?>
<link href="/Public/static/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/Public/static/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/Public/static/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript" src="/Public/Admin/js/editor/jquery-migrate1.2.1.js" charset="utf-8"></script>
<script type="text/javascript" src="/Public/Admin/js/editor/editor.js" charset="utf-8"></script>
<script type="text/javascript" src="/Public/Admin/js/editor/date_price.js" charset="utf-8"></script>
<script type="text/javascript" src="/Public/Admin/js/editor/jquery_date.js" charset="utf-8"></script>
<script type="text/javascript" src="/Public/Admin/js/editor/form.js" charset="utf-8"></script>
<script type="text/javascript" src="/Public/Admin/js/editor/alert.js" charset="utf-8"></script>
<script type="text/javascript">

Think.setValue("type", <?php echo ((isset($data["type"]) && ($data["type"] !== ""))?($data["type"]):'""'); ?>);
Think.setValue("display", <?php echo ((isset($data["display"]) && ($data["display"] !== ""))?($data["display"]):0); ?>);

$('#submit').click(function(){
	$('#form').submit();
});

$(function(){
	//导航高亮
	highlight_subnav('<?php echo U('index');?>');
});
</script>

<script>
var old_type_name = $('#J_typename').val();
var tel_consult = 0;

(function($){
    $('.what1').mouseover(function(){
        $('#boxx').show();
    })
    $('.what1').mouseout(function(){
        $('#boxx').hide();
    })

    //使用模板
    if ($.browser.msie && $.browser.version=="6.0") {
        $('.J_use_template').click(function(){
            var html = $('#J_ForumPostCon').val();
            if(html.length>5){
                alert_confirm('使用模板将替换掉当前内容，是否替换？',function(){
                    $('#J_ForumPostCon').val('费用包含：\r\n费用不包含：\r\n自费项目说明：');
                })
            }else{
                $('#J_ForumPostCon').val('费用包含：\r\n费用不包含：\r\n自费项目说明：');
            }
        })
        $('#J_ForumPostCon').on('keyup mousedown paste',function(){
            var self = $(this);
            setTimeout(function(){
                self.data('text',self.val());
            },1)
        })
    }else{
        if($('#J_ForumPostCon').length == 0){
            return;
        }
        var editor = Editor_cncn({
            textareaID:'J_ForumPostCon',
            btnLink : {
                visible : false
            }
        });

        $('.J_use_template').click(function(){
            var html = editor.iframeDocument.body.innerHTML;
			console.log(editor);
			if(html.length>10){
				if(!confirm('使用模板将替换掉当前内容，是否替换？')){
					return false;
				} else {
					editor.iframeDocument.body.innerHTML = editor.contentDecode('费用包含：[br]费用不包含：[br]自费项目说明：', true);
				}
            }else{
                editor.iframeDocument.body.innerHTML = editor.contentDecode('费用包含：[br]费用不包含：[br]自费项目说明：', true);
            }
        })
    }
    var check_price = function(youhui_price){
        var price = $('[name=price]').val();
        if(price.length == 0){
            return true;
        }
        price = parseInt(price,10);
        if(price == 0){
            return true;
        }
        if(youhui_price > price){
            return false;
        }
        return true;
    }
    $('#J_submit').click(function(){
		var that = this;
        var tc_id = $('[name=tc_id]').val();
        var type_name = $('#J_typename').val();
        var type_names = $('#J_typename_list').val() + ',';
        if(type_name === ''){
             $('#J_typename').focus();
            alert_fail('价格类型名称不能为空');
            return;
        }
        if(tc_id.length !== 0){
            type_names = type_names.replace(old_type_name+',','');
        }
        if(type_names.indexOf(type_name+',')!==-1){
            $('#J_typename').focus();
            alert_fail('价格类型名称重复');
            return;
        }
        var feiyong = $('#J_ForumPostCon').val();
        if(feiyong.length === 0){
            alert_fail('请填写费用说明');
            return;
        }
        if(feiyong.length < 20){
            alert_fail('费用说明需要超过20个字');
            return;
        }
        if(feiyong.length > 1500){
            alert_fail('费用说明不能超过1500个字');
            return;
        }
        var price_pass = true;
        var data_string = '';
        $('#J_date_table .month_row .bd li:not(.disable)').each(function(){
            var self = $(this);
            if($('#J_quick').hasClass('on')){
                var youhui_price = self.find('.youhui').val();
                var child_price = self.find('.child').val();
                if(youhui_price.length===0){
                    return;
                }
                if(!check_price(parseInt(youhui_price,10))){
                    price_pass = false;
                }
                data_string += self.data('date')+'|'+youhui_price;
                if(child_price.length!==0){
                    data_string +='-'+child_price;
                }else{
                    data_string +='-'+'0';
                }
            }else{
                var youhui_price = self.data('youhui_price');
                var child_price = self.data('child_price');
                var kucun = self.data('kucun');
                if(!kucun){
                    kucun = 'max'
                }
                if(!youhui_price){
                    return;
                }
                if(!check_price(parseInt(youhui_price,10))){
                    price_pass = false;
                }
                data_string += self.data('date')+'|'+youhui_price;
                if(child_price){
                    data_string +='-'+child_price;
                }else{
                    data_string +='-'+'0';
                }
                data_string +='-'+kucun;
            }
            data_string +=',';
        });
        if(!price_pass){
            alert_fail('优惠价不能高过门市价～');
            return;
        }

        if (!tel_consult) {  // 非电询类型的才需要报价
            if(data_string.length>8){
                $('#date_price_data').val(data_string.substr(0, data_string.length-1));
            }else{
                alert_fail('请添加报价！');
                return;
            }
        }
		var form = $('#form');
		var target = form.get(0).action;
		var query = form.serialize();
		$(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);
		$.post(target,query).success(function(data){
			if (data.status==1) {
				if (data.url) {
					updateAlert(data.info + ' 页面即将自动跳转~','alert-success');
				}else{
					updateAlert(data.info ,'alert-success');
				}
				setTimeout(function(){
					$(that).removeClass('disabled').prop('disabled',false);
					if (data.url) {
						location.href=data.url;
					}else if( $(that).hasClass('no-refresh')){
						$('#top-alert').find('button').click();
					}else{
						location.reload();
					}
				},1500);
			}else{
				updateAlert(data.info);
				setTimeout(function(){
					$(that).removeClass('disabled').prop('disabled',false);
					if (data.url) {
						location.href=data.url;
					}else{
						$('#top-alert').find('button').click();
					}
				},1500);
			}
		});
        // $("#price_type_form").submit();
    })
})(jQuery)

</script>

</body>
</html>