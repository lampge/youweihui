<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head lang="en">
	<meta charset="UTF-8">
<title><?php echo C('WEB_SITE_TITLE');?></title>
<!--[if lt IE 9]>
    <script src="/Public/Home/js/html5shiv.min.js"></script>
    <script src="/Public/Home/js/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" href="/Public/Home/css/common.css" />
<link rel="stylesheet" href="/Public/Home/css/style.css" />
<script src="/Public/Home/js/jquery-1.9.1.min.js"></script>
<script src="/Public/Home/js/myjs.js"></script>
<script src="/Public/Home/js/myjss.js"></script>
<script src="/Public/Home/js/bannertab.js"></script>
<script src="/Public/Home/js/pictab.js"></script>
<script src="/Public/Home/js/wufenggundong.js"></script>
<!-- 页面header钩子，一般用于加载插件CSS文件和代码 -->
<?php echo hook('pageHeader');?>

</head>
<body>
	<!-- 头部 -->
	<!-- 导航条================================================== -->
<section class="dingbu">
    <div class="dingbu_nr auto fix">
        <div class="dingbu_nr_left">欢迎来到游尾会，一起旅游，一起嗨！</div>
        <div class="dingbu_nr_center">
            <ul class="ul fix">
                <li><a href="#" title="">全部尾单<img src="/Public/Home/images/bg18.png" width="7" height="4" alt=""></a>
                    <div class="xl fix">
                        <div class="xl_left">
                            <ul>
                                <li class="fix">
                                    <p><img src="/Public/Home/images/bg20.png" width="31" height="24" alt=""> 度假产品</p>
                                    <span class="fix"> <a href="#" title=""><em>全部尾单</em></a> <a href="#" title="">亚洲</a> <a href="#" title="">邮轮</a> <a href="#" title="">海岛</a> <a href="#" title="">欧洲</a> <a href="#" title="">美洲</a> <a href="#" title="">澳洲</a> <a href="#" title="">港澳台</a> <a href="#" title="">中东非</a><br />
                                    <br />
                                    <a href="#" title=""><em>出境特卖</em></a> <a href="#" title="">亚洲</a> <a href="#" title="">邮轮</a> <a href="#" title="">海岛</a> <a href="#" title="">欧洲</a> <a href="#" title="">美洲</a> <a href="#" title="">澳洲</a> <a href="#" title="">港澳台</a> <a href="#" title="">中东非</a><br />
                                    <br />
                                    <a href="#" title=""><em>全部尾单</em></a> <a href="#" title="">华北</a> <a href="#" title="">东北</a> <a href="#" title="">西北</a> <a href="#" title="">华东</a> <a href="#" title="">华南</a> <a href="#" title="">西南</a> </span> </li>
                                <li class="fix">
                                    <p style="color:#ef4603;"><img src="/Public/Home/images/bg21.png" width="31" height="24" alt=""> 其他</p>
                                    <span class="fix"> <a href="#" title=""><em style=" width:434px; display:block;">帮助中心</em></a> <a href="#" title=""><em style=" width:434px; display:block;">关于我们</em></a> <a href="#" title=""><em style=" width:434px; display:block;">友情链接</em></a> </span> </li>
                            </ul>
                        </div>
                        <div class="xl_center">
                            <ul>
                                <li class="fix">
                                    <p><img src="/Public/Home/images/bg22.png" width="31" height="24" alt=""> 签证</p>
                                    <span class="fix"> <a href="#" title=""><em>亚洲</em></a> <a href="#" title=""><em>非洲</em></a> <a href="#" title=""><em>欧洲</em></a> <a href="#" title=""><em>澳洲</em></a> <a href="#" title=""><em>美洲</em></a> </span> </li>
                            </ul>
                        </div>
                        <div class="xl_right">
                            <ul>
                                <li class="fix">
                                    <p><img src="/Public/Home/images/bg23.png" width="31" height="24" alt=""> 旅游资讯</p>
                                    <span class="fix"> <a href="#" title=""><em>旅游资讯</em></a><br />
                                    <a href="#" title=""><em>旅游公告</em></a><br />
                                    <a href="#" title=""><em>旅游攻略</em></a><br />
                                    </span> </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li><a href="#" title="">加入收藏</a></li>
                <li><a href="#" title="">订单查询</a></li>
            </ul>
        </div>
        <div class="dingbu_nr_right">
            <ul class="fix">
                <li>
                    <p><a href="#" title=""><img src="/Public/Home/images/bg15.png" width="22" height="22" class="img1"><img src="/Public/Home/images/bg15_h.png" width="22" height="22" class="img2"></a></p>
                </li>
                <li>
                    <p><a href="#" title=""><img src="/Public/Home/images/bg16.png" width="22" height="22" class="img1"><img src="/Public/Home/images/bg16_h.png" width="22" height="22" class="img2"></a></p>
                    <span><img src="/Public/Home/images/pic5.jpg" width="119" height="119"></span> </li>
            </ul>
        </div>
    </div>
</section>
<!--顶部内容 end-->
<header class="header auto fix">
    <div class="logo"><a href="index.html"><img src="/Public/Home/images/logo.png" width="305" height="59" alt=""></a></div>
    <div class="search">
        <div class="search_nr fix">
            <input name="q" class="seach_in1 search-keyword wbk" type="text" id="search" value="请输入目的地、主题或关键词" onfocus="if(this.value=='请输入目的地、主题或关键词'){this.value='';}"  onblur="if(this.value==''){this.value='请输入目的地、主题或关键词';}"/>
            <span class="fix"> <a href="#" title="">樱花季</a> <a href="#" title="">父母游</a> <a href="#" title="">欧洲</a> </span>
            <input type="submit" name="button" id="button" value="" class="btn">
        </div>
    </div>
    <div class="tel fix">
        <ol>
            <img src="/Public/Home/images/bg2.png" width="47" height="47" alt="">
        </ol>
        <ul>
            24小时免费咨询 <span>400-876-5261</span>
        </ul>
    </div>
</header>
<!--header end-->
<nav class="nav">
    <div class="nav_nr auto fix">
        <ul class="ul fix">
            <li><a href="index.html" title="">首页</a></li>
            <li><a href="#" title="">全部尾单<img src="/Public/Home/images/bg3.png" width="8" height="5" alt=""></a>
                <div class="xl"> <a href="#" title="">华北</a><a href="#" title="">东北</a><a href="#" title="">西北</a><a href="#" title="">华东</a><a href="#" title="">华南</a><a href="#" title="">西南</a> </div>
            </li>
            <li><a href="#">出境特卖<img src="/Public/Home/images/bg3.png" width="8" height="5" alt=""></a>
                <div class="xl"> <a href="#" title="">华北</a><a href="#" title="">东北</a><a href="#" title="">西北</a><a href="#" title="">华东</a><a href="#" title="">华南</a><a href="#" title="">西南</a> </div>
            </li>
            <li><a href="#">国内特卖<img src="/Public/Home/images/bg3.png" width="8" height="5" alt=""></a>
                <div class="xl"> <a href="#" title="">华北</a><a href="#" title="">东北</a><a href="#" title="">西北</a><a href="#" title="">华东</a><a href="#" title="">华南</a><a href="#" title="">西南</a> </div>
            </li>
            <li><a href="#">签证<img src="/Public/Home/images/bg3.png" width="8" height="5" alt=""></a>
                <div class="xl"> <a href="#" title="">华北</a><a href="#" title="">东北</a><a href="#" title="">西北</a><a href="#" title="">华东</a><a href="#" title="">华南</a><a href="#" title="">西南</a> </div>
            </li>
            <li><a href="#">旅游资讯</a></li>
            <li><a href="#">旅游指南</a></li>
        </ul>
        <ol class="fix">
            <li><a href="#"><img src="/Public/Home/images/bg5.png" width="20" height="19"> 注册</a></li>
            <li><a href="#"><img src="/Public/Home/images/bg4.png" width="20" height="19"> 登录</a></li>
        </ol>
    </div>
</nav>
<!--nav end-->

	<!-- /头部 -->

	<!-- 主体 -->
	
    <header class="jumbotron subhead" id="overview">
        <div class="container">
            <h2>源自相同起点，演绎不同精彩！</h2>
            <p class="lead"></p>
        </div>
    </header>

<section class="main auto fix">
    
    <div class="span9">
        <!-- Contents
        ================================================== -->
        <section id="contents">
            <?php $__CATE__ = D('Category')->getChildrenId(1);$__LIST__ = D('Document')->page(!empty($_GET["p"])?$_GET["p"]:1,10)->lists($__CATE__, '`level` DESC,`id` DESC', 1,true); if(is_array($__LIST__)): $i = 0; $__LIST__ = $__LIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?><div class="">
                    <h3><a href="<?php echo U('Article/detail?id='.$article['id']);?>"><?php echo ($article["title"]); ?></a></h3>
                </div>
                <div>
                    <p class="lead"><?php echo ($article["description"]); ?></p>
                </div>
                <div>
                    <span><a href="<?php echo U('Article/detail?id='.$article['id']);?>">查看全文</a></span>
                    <span class="pull-right">
                        <span class="author"><?php echo (get_username($article["uid"])); ?></span>
                        <span>于 <?php echo (date('Y-m-d H:i',$article["create_time"])); ?></span> 发表在 <span>
                        <a href="<?php echo U('Article/lists?category='.get_category_name($article['category_id']));?>"><?php echo (get_category_title($article["category_id"])); ?></a></span> ( 阅读：<?php echo ($article["view"]); ?> )
                    </span>
                </div>
                <hr/><?php endforeach; endif; else: echo "" ;endif; ?>

        </section>
    </div>

</section>

	<!-- /主体 -->

	<!-- 底部 -->
	<!-- 底部================================================== -->
<footer class="footer">
    <div class="footer_top">
        <div class="footer_top_nr auto fix">
        <div class="footer_top_nrk">
            <dl>
                <dt><img src="/Public/Home/images/bg32.png" width="34" height="34" alt="">关于游尾会</dt>
                <dd>
                    <a href="#">公司简介</a>
                    <a href="#">联系我们</a>
                </dd>
            </dl>
            <dl>
                <dt><img src="/Public/Home/images/bg33.png" width="34" height="34" alt="">关于游尾会</dt>
                <dd>
                    <a href="#">特价旅游</a>
                    <a href="#">全部尾单</a>
                    <a href="#">出境特卖</a>
                    <a href="#">国内特卖</a>
                    <a href="#">签证旅游</a>
                </dd>
            </dl>
            <dl>
                <dt><img src="/Public/Home/images/bg34.png" width="34" height="34" alt="">关于游尾会</dt>
                <dd>
                    <a href="#">国外资讯</a>
                    <a href="#">国内资讯</a>
                </dd>
            </dl>
            <dl>
                <dt><img src="/Public/Home/images/bg35.png" width="34" height="34" alt="">关于游尾会</dt>
                <dd>
                    <a href="#">出境指南</a>
                    <a href="#">国内指南</a>
                </dd>
            </dl>
            <dl>
                <dt><img src="/Public/Home/images/bg36.png" width="34" height="34" alt="">关于游尾会</dt>
                <dd>
                    <a href="#">积分规则</a>
                    <a href="#">用户协议</a>
                    <a href="#">使用条款</a>
                </dd>
            </dl>
            <dl>
                <dt><img src="/Public/Home/images/bg37.png" width="34" height="34" alt="">关于游尾会</dt>
                <dd><img src="/Public/Home/images/pic14.jpg" width="86" height="86"></dd>
            </dl>
        </div>
        </div>
    </div>
    <div class="footer_center">
        <div class="footer_center_nr auto">
            <ul class="fix">
                <li><img src="/Public/Home/images/bg39.png" width="33" height="36" alt=""><span>特价不二</span> 价格只会更低</li>
                <li><img src="/Public/Home/images/bg40.png" width="33" height="36" alt=""><span>最优路线</span> 行程精心筛选</li>
                <li><img src="/Public/Home/images/bg41.png" width="33" height="36" alt=""><span>贴心服务</span> 服务全程跟踪</li>
                <li><img src="/Public/Home/images/bg42.png" width="33" height="36" alt=""><span>让您安心</span> 品牌质量保证 支付安全</li>
            </ul>
        </div>
    </div>
    <div class="footer_bottom auto">
        <ol>
            <li><a href="#" title=""><img src="/Public/Home/images/pic15.jpg" width="108" height="48" alt=""></a></li>
            <li><a href="#" title=""><img src="/Public/Home/images/pic15.jpg" width="108" height="48" alt=""></a></li>
            <li><a href="#" title=""><img src="/Public/Home/images/pic15.jpg" width="108" height="48" alt=""></a></li>
            <li><a href="#" title=""><img src="/Public/Home/images/pic15.jpg" width="108" height="48" alt=""></a></li>
            <li><a href="#" title=""><img src="/Public/Home/images/pic15.jpg" width="108" height="48" alt=""></a></li>
        </ol>
        <ul>
            Copyright © 2015 游尾会 京ICP备15028530号<br />
            游尾会（北京）国际旅行社有限公司 电话：010-88016482/3/5/6/7<br />
            地址：北京市西城区西直门外大街甲143号凯旋大厦C座B3-06
        </ul>
    </div>
</footer>

<script type="text/javascript">
(function(){
	var ThinkPHP = window.Think = {
		"ROOT"   : "", //当前网站地址
		"APP"    : "/index.php", //当前项目地址
		"PUBLIC" : "/Public", //项目公共目录地址
		"DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
		"MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
		"VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
	}
})();
</script>
 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>

	<!-- /底部 -->
</body>
</html>