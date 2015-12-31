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
<!-- <?php echo hook('pageHeader');?> -->

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
	


<section class="main auto fix">
    <div class="ytip_02 main auto fs">
        <a href="#">首页</a> -> <a href="#">全部尾单</a> -> <a href="#">港澳台</a>
    </div>
    <section class="ydiv5 fs">
        <div class="yk_01 fix">
            <span>出发城市：</span>
            <div class="yy1">
                <a href="#" class="ya3">全部</a><a href="#">北京/天津</a><a href="#">东北/沈阳/长春/哈尔滨</a><a href="#">华东/上海/杭州/南京</a><a href="#">西南/成都/重庆/昆明</a>
            </div>
        </div>
        <div class="yk_01 fix">
           <div class="fix yfff">
                <span>目的地：</span>
                <div class="yy1">
                    <a href="#" class="ya3">全部</a><a href="#">塞舌尔</a><a href="#">港澳台</a><a href="#">埃及</a><a href="#">南非</a><a href="#">肯尼亚</a><a href="#">坦桑尼亚</a><a href="#">毛里求斯</a><a href="#">牙买加</a><a href="#">巴厘岛</a><a href="#">塞班岛</a>
                </div>
                <div class="yy2">
                    <a href="#" class="ya4">更多</a>
                    <a href="#" class="ya5">收起</a>
                </div>
            </div>
            <div class="ydiv6 fix">
            	<div class="yydiv">
                	<a href="#">全部</a><a href="#">泰国</a><a href="#">马来西亚</a><a href="#">新加坡</a><a href="#">菲律宾</a><a href="#">印度尼西亚</a><a href="#">柬埔寨</a><a href="#">越南</a><a href="#">北马里亚纳</a><a href="#">马尔代夫</a><a href="#">韩国</a><a href="#">日本</a><a href="#">中国香港</a><a href="#">尼泊尔</a><a href="#">中国澳门 </a><a href="#">文莱</a><a href="#">斐济 </a><a href="#">印度</a>
                </div>
                <div class="yydiv">
                	<a href="#">全部2</a><a href="#">泰国</a><a href="#">马来西亚</a><a href="#">新加坡</a><a href="#">菲律宾</a><a href="#">印度尼西亚</a><a href="#">柬埔寨</a><a href="#">越南</a><a href="#">北马里亚纳</a><a href="#">马尔代夫</a><a href="#">韩国</a><a href="#">日本</a><a href="#">中国香港</a><a href="#">尼泊尔</a><a href="#">中国澳门 </a><a href="#">文莱</a><a href="#">斐济 </a><a href="#">印度</a>
                </div>
                <div class="yydiv">
                	<a href="#">全部3</a><a href="#">泰国</a><a href="#">马来西亚</a><a href="#">新加坡</a><a href="#">菲律宾</a><a href="#">印度尼西亚</a><a href="#">柬埔寨</a><a href="#">越南</a><a href="#">北马里亚纳</a><a href="#">马尔代夫</a><a href="#">韩国</a><a href="#">日本</a><a href="#">中国香港</a><a href="#">尼泊尔</a><a href="#">中国澳门 </a><a href="#">文莱</a><a href="#">斐济 </a><a href="#">印度</a>
                </div>
            </div>
        </div>
        <div class="yk_01 fix">
            <span>参团性质：</span>
            <div class="yy1">
                <a href="#" class="ya3">全部</a><a href="#">跟团游</a><a href="#">自由行</a><a href="#">游轮</a><a href="#">自驾游</a><a href="#">主题游</a>
            </div>
        </div>
        <div class="yk_01 fix">
            <span>旅行时间：</span>
            <div class="yy1">
                <a href="#" class="ya3">全部</a><a href="#">10月</a><a href="#">11月</a><a href="#">12月</a><a href="#">1月</a><a href="#">2月</a><a href="#">3月</a><a href="#">4月</a><a href="#">圣诞</a><a href="#">元旦</a><a href="#">春节</a>
            </div>
        </div>
        <div class="yk_01 fix ybbb">
            <span>价格区间：</span>
            <div class="yy1">
                <a href="#" class="ya3">全部</a><a href="#">1000-2000元</a><a href="#">2000-3000元</a><a href="#">3000-5000元</a><a href="#">5000元以上</a>
            </div>
        </div>
    </section>
    <section class="yydd mian">
        <div class="ydiv7 fl">
            <div class="ytip_03 fs">
                <span>排序条件：</span><a href="#" class="xz">默认</a><a href="#">销量</a><a href="#">价格</a>
            </div>
            <div class="y_div3">
                <?php if(is_array($line_lists)): $i = 0; $__LIST__ = $line_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><div class="y_k02 fix">
                        <img src="<?php if(empty($val['img'])): ?>/Public/Home/images/y_04.jpg<?php else: echo ($val['img']); endif; ?>" alt="<?php echo ($val['title']); ?>" width="262" height="194" class="fl">
                        <div class="y_art02 fl">
                            <a href="<?php echo ($val['url']); ?>" class="y_a3 fs"><?php echo ($val['starting']); ?> - <?php echo ($val['dest']); ?></a>
                            <a href="<?php echo ($val['url']); ?>" class="y_a4"><?php echo ($val['title']); ?></a>
                            <?php echo ($val['sub_title']); ?>
                            <span>出发日期：11月02日 | 11月03日 | 11月04日 | 11月05日</span>
                        </div>
                        <span><del>4999元</del><bdo>￥</bdo><font>4199</font>元起</span>
                        <a href="<?php echo ($val['url']); ?>">立即预定</a>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>

                <div class="y_k02 fix">
                    <img src="/Public/Home/images/y_04.jpg" alt="" class="fl">
                    <div class="y_art02 fl">
                        <a href="#" class="y_a3 fs">昆明 - 泰国 苏梅岛</a>
                        <a href="#" class="y_a4">温柔海岛 | 苏梅岛4晚5天/5晚6天自由行（昆明直飞苏梅岛本岛） </a>
                        昆明直飞往返，海边三星宜必思酒店住宿，直飞苏梅岛本岛免去码头坐船。
                        <span>出发日期：11月02日 | 11月03日 | 11月04日 | 11月05日</span>
                    </div>
                    <span><del>4999元</del><bdo>￥</bdo><font>4199</font>元起</span>
                    <a href="#">立即预定</a>
                </div>
            </div>
            <div class="pages"><a href="#" class="yling2">《 上一页</a> <a href="#">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> <a href="#">5</a> <a href="#">6</a> <a href="#">7</a> <a href="#">8</a> <a href="#">9</a> <a href="#">10</a> <a href="#" class="yling">....</a> <a href="#">29</a> <a href="#">30</a> <a href="#" class="yling2">下一页 》</a></div>
        </div>
        <div class="ydiv8 fr">
            <span>热门商品</span>
            <div class="y_k_03">
                <a href="#">天津直飞芽庄4天3晚/5天4晚自由行，入住四...</a>
                <div class="yddd fix">
                    <img src="/Public/Home/images/y_05.jpg" class="fl">
                    <div class="yar1 fr">
                        上海<br>
                        泰国  曼谷
                        <font>￥<span>3480</span>/人起</font>
                    </div>
                </div>
            </div>
            <div class="y_k_03">
                <a href="#">天津直飞芽庄4天3晚/5天4晚自由行，入住四...</a>
                <div class="yddd fix">
                    <img src="/Public/Home/images/y_05.jpg" class="fl">
                    <div class="yar1 fr">
                        上海<br>
                        泰国  曼谷
                        <font>￥<span>3480</span>/人起</font>
                    </div>
                </div>
            </div>
            <div class="y_k_03">
                <a href="#">天津直飞芽庄4天3晚/5天4晚自由行，入住四...</a>
                <div class="yddd fix">
                    <img src="/Public/Home/images/y_05.jpg" class="fl">
                    <div class="yar1 fr">
                        上海<br>
                        泰国  曼谷
                        <font>￥<span>3480</span>/人起</font>
                    </div>
                </div>
            </div>
            <div class="y_k_03">
                <a href="#">天津直飞芽庄4天3晚/5天4晚自由行，入住四...</a>
                <div class="yddd fix">
                    <img src="/Public/Home/images/y_05.jpg" class="fl">
                    <div class="yar1 fr">
                        上海<br>
                        泰国  曼谷
                        <font>￥<span>3480</span>/人起</font>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
		"APP"    : "", //当前项目地址
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