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
		<?php if(empty($line_id)): if(is_array($setp)): $i = 0; $__LIST__ = $setp;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li <?php if(($val['current']) == "1"): ?>class="current"<?php endif; ?>><a href="javascript:void(0);"><?php echo ($val['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
		<?php else: ?>
			<?php if(is_array($setp)): $i = 0; $__LIST__ = $setp;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li data-tab="tab<?php echo ($key); ?>" <?php if(($val['current']) == "1"): ?>class="current"<?php endif; ?>><a href="<?php echo ($val['url']); ?>"><?php echo ($val['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
	</ul>
	<div class="tab-content">
	<!-- 表单 -->
	<form id="form" action="" method="post" class="form-horizontal">
        <div id="tab1" class="tab-pane tab1 in">
			<div class="form-item cf">
				<div class="controls">
					<label class="item-label">所属站点<span class="check-tips">（必填）</span></label>
					<?php if(is_array($nodes)): $i = 0; $__LIST__ = $nodes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><label class="radio">
							<input readonly type="radio" value="<?php echo ($key); ?>"  name="site_id" <?php if(($data['site_id']) == $key): ?>checked="checked"<?php endif; ?>><?php echo ($val['title']); ?>
						</label><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
			<div class="form-item cf">
				<div class="controls">
					<label class="item-label">线路类型<span class="check-tips">（必填）</span></label>
					<?php $_result=C('LINE_TYPE');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><label class="radio">
							<input type="radio" value="<?php echo ($key); ?>" name="l_type" <?php if(($data['l_type']) == $key): ?>checked="checked"<?php endif; ?>><?php echo ($val); ?>
						</label><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
			<div class="form-item cf">
				<div class="controls">
					<label class="item-label">参团性质<span class="check-tips">（必填）</span></label>
					<?php $_result=C('CAN_TUAN');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><label class="radio">
							<input type="radio" value="<?php echo ($key); ?>" name="ct_type" <?php if(($data['l_type']) == $key): ?>checked="checked"<?php endif; ?>><?php echo ($val); ?>
						</label><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
			<div class="form-item cf">
				<div class="controls">
					<label class="item-label">线路主标题<span class="check-tips">（必填）</span></label>
					<input type="text" class="text input-large" name="title" value="<?php echo ($data['title']); ?>">
				</div>
			</div>
			<div class="form-item cf">
				<div class="controls">
					<label class="item-label">线路副标题<span class="check-tips">（必填）</span></label>
					<input type="text" class="text input-large" name="sub_title" value="<?php echo ($data['sub_title']); ?>">
				</div>
			</div>
			<div class="form-item cf">
				<label class="item-label">产品分类<span class="check-tips">（必填）</span></label>
				<?php if(is_array($categorys)): $i = 0; $__LIST__ = $categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$node): $mod = ($i % 2 );++$i;?><dl class="checkmod">
							<dt class="hd">
								<label class="checkbox"><input class="auth_rules rules_all" type="checkbox" name="categorys[]" value="<?php echo ($node['id']); ?>"><?php echo ($node["title"]); ?>管理</label>
							</dt>
							<dd class="bd" style="margin-left:20px;">
								<?php if(isset($node['_'])): if(is_array($node['_'])): $i = 0; $__LIST__ = $node['_'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><div class="rule_check">
                                        <div>
                                            <label class="checkbox">
                                           <input class="auth_rules rules_row" type="checkbox" name="categorys[]" value="<?php echo ($child['id']); ?>"/><?php echo ($child["title"]); ?>
                                            </label>
                                        </div>
                                       <?php if(!empty($child['_'])): ?><span class="divsion">&nbsp;</span>
                                           <span class="child_row">
                                               <?php if(is_array($child['_'])): $i = 0; $__LIST__ = $child['_'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$op): $mod = ($i % 2 );++$i;?><label class="checkbox">
                                                       <input class="auth_rules rules_child" type="checkbox" name="categorys[]"
                                                       value="<?php echo ($op['id']); ?>"/><?php echo ($op["title"]); ?>
                                                   </label><?php endforeach; endif; else: echo "" ;endif; ?>
                                           </span><?php endif; ?>
				                    </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
							</dd>
						</dl><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<div class="form-item cf">
				<div class="controls">
					<label class="item-label">游客需提前几天报名<span class="check-tips">（必填）</span></label>
					<input type="text" class="text input-mid" name="earlier_date" value="<?php echo ((isset($data['earlier_date']) && ($data['earlier_date'] !== ""))?($data['earlier_date']):3); ?>">
				</div>
			</div>
			<div class="form-item cf">
				<div class="controls">
					<label class="item-label">行程天数<span class="check-tips">（必填）</span></label>
					<input type="text" class="text input-mid" name="daynum" value="<?php echo ((isset($data['daynum']) && ($data['daynum'] !== ""))?($data['daynum']):3); ?>">
				</div>
			</div>
			<div class="form-item cf">
				<div class="controls">
					<label class="item-label">交通方式<span class="check-tips">（必填）</span></label>
					<input type="text" class="text input-mid" name="traffic" value="<?php echo ((isset($data['traffic']) && ($data['traffic'] !== ""))?($data['traffic']):'飞机去飞机回'); ?>">
				</div>
			</div>
			<div class="form-item cf">
				<div class="controls">
					<label class="item-label">出发地<span class="check-tips">（必填）</span></label>
					<input type="text" class="text input-mid" name="starting" value="<?php echo ((isset($data['starting']) && ($data['starting'] !== ""))?($data['starting']):'出发地'); ?>">
				</div>
			</div>
			<div class="form-item cf">
				<div class="controls">
					<label class="item-label">目的地<span class="check-tips">（必填）</span></label>
					<input type="text" class="text input-mid" name="dest" value="<?php echo ((isset($data['dest']) && ($data['dest'] !== ""))?($data['dest']):'目的地'); ?>">
				</div>
			</div>

			<div class="form-item cf">
				<div class="controls">
					<div class="item-label">线路图片描述<span class="check-tips">（必填）</span></div>
					<div class="controls uploads">
						<input type="file" name="images">
						<div class="upload-img-box">
						<?php if(is_array($data['images'])): $i = 0; $__LIST__ = $data['images'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><div class="upload-pre-item">
								<i onclick="removeImage(this)">X</i>
								<input type="hidden" name="images[]" value="<?php echo ($val); ?>">
								<img src="<?php echo get_cover($val, 'path');?>"/>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="form-item cf">
				<div class="controls">
					<label class="item-label">详情页显示数据<span class="check-tips"></span></label>
					游客关注：<input type="text" class="text input-mid" name="base_hits" value="<?php echo ((isset($data['base_hits']) && ($data['base_hits'] !== ""))?($data['base_hits']):0); ?>">
					最近订单：<input type="text" class="text input-mid" name="base_order" value="<?php echo ((isset($data['base_order']) && ($data['base_order'] !== ""))?($data['base_order']):0); ?>">
				</div>
			</div>
			<div class="form-item cf">
				<div class="controls">
					<label class="item-label">排序<span class="check-tips"></span></label>
					<input type="text" class="text input-mid" name="sort" value="<?php echo ((isset($data['sort']) && ($data['sort'] !== ""))?($data['sort']):0); ?>">
				</div>
			</div>
			<div class="form-item cf">
				<div class="controls">
					<label class="item-label">线路状态<span class="check-tips"></span></label>
					<label class="radio">
						<input type="radio" value="1" name="status" <?php if(($data['status']) == "1"): ?>checked="checked"<?php endif; ?>>显示
					</label>
					<label class="radio">
						<input type="radio" value="0" name="status" <?php if(($data['status']) == "0"): ?>checked="checked"<?php endif; ?>>隐藏
					</label>
				</div>
			</div>
			<div class="form-item cf">
				<div class="controls">
					<label class="item-label">是否推荐<span class="check-tips"></span></label>
					<label class="radio">
						<input type="radio" value="1" name="is_position" <?php if(($data['is_position']) == "1"): ?>checked="checked"<?php endif; ?>>推荐
					</label>
					<label class="radio">
						<input type="radio" value="0" name="is_position" <?php if(($data['is_position']) == "0"): ?>checked="checked"<?php endif; ?>>不推荐
					</label>
				</div>
			</div>
		</div>
		<div class="form-item cf">
			<button class="btn btn-return ajax-post hidden" id="submit" type="submit" name="0" target-form="form-horizontal">确定保存</button>
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
<script type="text/javascript" src="/Public/static/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/Public/static/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript">

Think.setValue("type", <?php echo ((isset($data["type"]) && ($data["type"] !== ""))?($data["type"]):'""'); ?>);
Think.setValue("display", <?php echo ((isset($data["display"]) && ($data["display"] !== ""))?($data["display"]):0); ?>);

$('#submit').click(function(){
	$('#form').submit();
});

$(function(){
	//导航高亮
	highlight_subnav('<?php echo U('index');?>');

	var rules = [<?php echo ($data['line_type']); ?>];
	$('.auth_rules').each(function(){
		if( $.inArray( parseInt(this.value,10),rules )>-1 ){
			$(this).prop('checked',true);
		}
		if(this.value==''){
			$(this).closest('span').remove();
		}
	});

	//全选节点
	$('.rules_all').on('change',function(){
		$(this).closest('dl').find('dd').find('input').prop('checked',this.checked);
	});
	$('.rules_row').on('change',function(){
		$(this).closest('.checkmod').find('.rules_all').prop('checked', true);
		$(this).closest('.rule_check').find('.child_row').find('input').prop('checked',this.checked);
	});
	$('.rules_child').on('change', function(){
		$(this).closest('.checkmod').find('.rules_all').prop('checked', true);
		$(this).closest('.rule_check').find('.rules_row').prop('checked', true);
	});

    $('.date').datetimepicker({
        format: 'yyyy-mm-dd',
        language:"zh-CN",
        minView:2,
        autoclose:true
    });
    $('.time').datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        language:"zh-CN",
        minView:2,
        autoclose:true
    });
    showTab();
});
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