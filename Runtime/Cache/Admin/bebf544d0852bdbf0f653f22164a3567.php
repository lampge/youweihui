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
            

            
	<style media="screen">
		.upload-pre-item{
			position: relative;
			widht:120px;
			height:120px;
			float:left;
			margin-right: 5px;
		}
		.upload-pre-item i{
			position: absolute;
			right: 0;
			top: 0;
			font-size: 20px;
			font-style: normal;
			line-height: 20px;
			padding:5px;

		}
	</style>
	<script type="text/javascript" src="/Public/static/uploadify/jquery.uploadify.min.js"></script>
	<div class="main-title cf">
		<h2><?php echo ($meta_title); ?></h2>
	</div>
	<!-- 标签页导航 -->
<div class="tab-wrap">
	<ul class="tab-nav nav">
		<?php if(is_array($setp)): $i = 0; $__LIST__ = $setp;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li data-tab="tab<?php echo ($key); ?>" <?php if(($val['current']) == "1"): ?>class="current"<?php endif; ?>><a href="<?php echo ($val['url']); ?>"><?php echo ($val['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
	<div class="tab-content">
	<!-- 表单 -->
	<form id="form" action="" method="post" class="form-horizontal">
		<div id="tab3" class="tab-pane tab3 in">
			<div class="form-item cf">
				<div class="controls">
					<label class="item-label">线路特色<span class="check-tips">（必填）</span></label>
			        <textarea name="features" class="textarea textarea470 J_editor"  cols="" rows=""></textarea>
		    	</div>
		    </div>
			<div class="form-item cf">
				<label class="item-label">行程安排<span class="check-tips"></span></label>
			<?php $__FOR_START_27024__=0;$__FOR_END_27024__=7;for($i=$__FOR_START_27024__;$i < $__FOR_END_27024__;$i+=1){ ?><dl class="checkmod">
					<dt class="hd">
						<label class="item-label">第<?php echo $i+1;?>天：<input type="text" class="text input-large"  name="xingcheng[<?php echo ($i); ?>][0]" value="" /></label>
					</dt>
					<dd class="bd">
						<div class="rule_check" style="margin:5px 0 5px 50px;">
							<textarea name="xingcheng[<?php echo ($i); ?>][1]" class="textarea textarea470 J_editor"  cols="" rows=""></textarea>
						</div>
						<div class="rule_check" style="margin:5px 0 5px 50px;">
							<label class="checkbox"><input type="checkbox" name="xingcheng[<?php echo ($i); ?>][2]" value="1">早餐</label>
							<label class="checkbox"><input type="checkbox" name="xingcheng[<?php echo ($i); ?>][2]" value="2">中餐</label>
							<label class="checkbox"><input type="checkbox" name="xingcheng[<?php echo ($i); ?>][2]" value="3">晚餐</label>
						</div>
						<div class="rule_check" style="margin:5px 0 5px 50px;">
							<input type="text" class="text input-large"  name="xingcheng[<?php echo ($i); ?>][3]" value="" placeholder="住宿"/>
						</div>
						<div class="rule_check" style="margin:5px 0 5px 50px;">
							<div class="controls uploads">
								<input type="file" name="xingcheng[<?php echo ($i); ?>][4]">
								<div class="upload-img-box"></div>
							</div>
						</div>
					</dd>
				</dl><?php } ?>


			</div>


			<div class="form-item cf">
				<div class="controls">
					<label class="item-label">预订须知<span class="check-tips">（必填）</span></label>
					<input type="text" class="text input-large" style="margin-bottom:10px;" name="remark[0]" value="" />
					<textarea name="remark[1]" class="textarea textarea470 J_editor"  style="display: none;"></textarea>
		    	</div>
		    </div>
			<div class="form-item cf">
				<div class="controls">
					<label class="item-label">温馨提示<span class="check-tips">（必填）</span></label>
					<input type="text" class="text input-large" style="margin-bottom:10px;" name="remark[2]" value="" />
					<textarea name="remark[3]" class="textarea textarea470 J_editor" style="display: none;"></textarea>
		    	</div>
		    </div>
		</div>
		<div class="form-item cf">
			<button class="btn submit-btn ajax-post hidden" id="submit" type="submit" name="1" target-form="form-horizontal">确定发布</button>
			<button class="btn btn-return ajax-post hidden" id="submit" type="submit" name="0" target-form="form-horizontal">确定保存</button>
			<input type="hidden" name="site_id" value="<?php echo ($site_id); ?>"/>
			<input type="hidden" name="line_id" value="<?php echo ($data['line_id']); ?>"/>
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
<?php if(C('COLOR_STYLE')=='blue_color') echo '<link href="/Public/static/datetimepicker/css/datetimepicker_blue.css" rel="stylesheet" type="text/css">'; ?>
<link href="/Public/static/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
<link href="/Public/Admin/js/editor/form.css" rel="stylesheet" type="text/css">
<link href="/Public/Admin/js/editor/editor.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/Public/static/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/Public/static/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript" src="/Public/Admin/js/editor/jquery-migrate1.2.1.js" charset="utf-8"></script>
<script type="text/javascript" src="/Public/Admin/js/editor/editor.js" charset="utf-8"></script>
<script type="text/javascript">
$('#submit').click(function(){
	$('#form').submit();
});

$(function(){
	//导航高亮
	highlight_subnav('<?php echo U('index');?>');
});
</script>
<script>
//生成编辑器
    var make_editor = function(){
        $($('.J_editor:not(.has_editor)').sort(function(){return 1})).each(function(){
            if($(this).hasClass('has_editor')){
                return;
            }
            $(this).addClass('has_editor');
            var num = (new Date()).getTime()+Math.floor(Math.random()*1000);
            var editor_id = 'J_xingcheng_con_'+num;
            $(this).attr('id',editor_id);
            Editor_cncn({
                textareaID:editor_id,
                toolbarId : "J_EditorToolbar_"+num,
                iframeId : "J_EditorIframe_"+num
            })
        })
    }
    if ($.browser.msie && $.browser.version=="6.0") {

    }else{
        make_editor();
    }
</script>
<script type="text/javascript">
$(".uploads").each(function(i){
	var Obj = $(this),
		Upload = $(this).find('[type=file]'),
		Name = Upload.attr('name') ? Upload.attr('name') : 'img';
	Upload.attr('id', 'id_' + (new Date()).getTime()+Math.floor(Math.random()*1000));
	Upload.uploadify({
		"height"          : 30,
		"swf"             : "/Public/static/uploadify/uploadify.swf",
		"fileObjName"     : "download",
		"buttonText"      : "选择图片",
		"uploader"        : "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
		"width"           : 120,
		'removeTimeout'	  : 1,
		'multi'			  : true,
		'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
		"onUploadSuccess" : function(file, data){
			var data = $.parseJSON(data);
			var src = '';
			if(data.status){
				src = data.url || '' + data.path
				Obj.find('.upload-img-box').append(
					'<div class="upload-pre-item"><i onclick="removeImage(this)">X</i><input type="hidden" name="'+Name+'[]" value="' + data.id + '"/><img src="' + src + '"/></div>'
				);
			}
		},
		'onFallback' : function() {
			alert('未检测到兼容版本的Flash.');
		}
	});
})
function removeImage(dom){
	$(dom).parent().remove();
}
</script>

</body>
</html>