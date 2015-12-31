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
    <div class="ytip_02 fs">
        <a href="#">首页</a> -> <a href="#">全部尾单</a> -> <a href="#">港澳台</a>
    </div>
    <div class="abs yfen">
        <div class="bdsharebuttonbox">
            <a href="#" class="bds_more" data-cmd="more"></a>
            <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
            <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
            <a href="#" class="bds_douban" data-cmd="douban" title="分享到豆瓣网"></a>
            <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
        </div>
    </div>
    <div class="ydiv9 fix">
        <div class="ydivzuo">
            <font>
                <span>
                    <<?php echo (get_can_tuan($line_info[ 'ct_type'])); ?>>
                </span><?php echo ($line_info['title']); ?>
            </font>
            <?php echo ($line_info['sub_title']); ?>
            <div class="tu">
                <div id="demo3" class="slideBox" style="margin-bottom:14px;">
                    <ul class="items">
                        <?php if(is_array($line_info['images'])): $i = 0; $__LIST__ = $line_info['images'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li>
                                <a href="javascript:void(0);" title="<?php echo ($line_info['base_hits']); ?>位游客关注    最近预订数<?php echo ($line_info['base_order']); ?>">
                                    <img src="<?php echo ($val); ?>">
                                </a>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="ydivyou fr">
            <span>门 市 价: </span>
            <del id="price">￥<?php echo ($default_tc['price']); ?></del>
            <br>
            <span>优 惠 价: </span>
            <bdo>￥</bdo><span class="yspp2" id="price_cncn"><?php echo ($default_tc['best_price']); ?></span>起
            <br>
            <span>发团日期: </span> 指定日期，请提前<?php echo ($line_info['earlier_date']); ?>天报名
            <br>
            <span>出发城市: </span> <?php echo ($line_info['starting']); ?>
            <br>
            <span>行程天数: </span> <?php echo ($line_info['daynum']); ?>天
            <br>
            <span>交通方式: </span> <?php echo ($line_info['traffic']); ?>
            <br>
            <div class="key">
                <dl class="h40">
                    <dt>
                        <span>套餐类型</span>:&nbsp;</dt>
                    <dd>
                        <ul id="price_type">
                            <?php if(is_array($line_tc)): $i = 0; $__LIST__ = $line_tc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li <?php if(($val['is_default']) == "1"): ?>class="selected"<?php endif; ?> id="li_date_type_<?php echo ($val['tc_id']); ?>" htmlfor="<?php echo ($val['tc_id']); ?>">
                                    <a href="javascript:line.date_type('<?php echo ($val['tc_id']); ?>','<?php echo date('Y-m-d');?>','<?php echo ($val['price']); ?>','<?php echo ($val['best_price']); ?>','0',' <?php echo ($val['typename']); ?>','-1');" title="<?php echo ($val['update_price_explan']); ?>"><?php echo ($val['typename']); ?></a>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </dd>
                </dl>
                <dl>
                    <dt><span>出发日期</span>:&nbsp;</dt>
                    <dd>
                        <input id="start_time" name="start_time" type="text" class="text text110 riqi" value="" placeholder="请选择出发日期" readonly="readyonly" title="点击选择出发日期">
                    </dd>
                </dl>
                <dl id="calendar" style="display:none"><b onClick="line.close_calendar();" id="cal_hide">隐藏</b></dl>
                <dl>
                    <dt style="display:none">人数:&nbsp;</dt>
                    <dd style="display:none">
                        <form id="line_order" action="<?php echo U('Line/order');?>" method="get">
                            <input id="line_id" name="line_id" type="hidden" value="<?php echo ($line_info['line_id']); ?>">
                            <input id="type_id" name="type_id" type="hidden" value="<?php echo ($default_tc['tc_id']); ?>">
                            <input id="date" name="date" type="hidden" value="<?php echo date('Y-m-d');?>">
                            <input id="discount" type="hidden" value="0">
                            <input name="adult_num" id="adult_num" type="text" value="1" class="text text30"> 成人
                            <span></span>&nbsp;&nbsp;
                            <input name="child_num" id="child_num" type="text" value="0" class="text text30"> 儿童
                            <span></span>
                            <span style="display:none">库存
                                <em id="stock">-1</em>
                            </span>
                        </form>
                    </dd>
                </dl>
                <div class="button">
                    <span id="stock_explan" style="display:none"></span>
                    <span style="width:125px; height:36px;">
                        <input name="imageField" type="submit" class="yspan5" value="立刻预订" onClick="line.order();">
                    </span>

                    <s class="tel">或直接拨打
                        <em>400-876-5261</em>咨询/预订</s>
                    <div id="orange">已选择了“
                        <em id="select_typename"> 特价尾单</em>”
                        <em id="from_date"></em>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wmdcn_nr auto fix">
        <div class="wmdcn_nr_left">
            我们的承诺：
            <span>OUR COMMITMENT</span>
        </div>
        <div class="wmdcn_nr_right2">
            <ul class="fix">
                <li>
                    <div class="yimg fl">
                        <img src="/Public/Home/images/ytip_01.png" alt="" class="ymg1 fl">
                    </div>
                    <div class="yzi fl">
                        <div class="y_zi1">
                            <span>特价不二</span>
                            价格只会更低
                        </div>
                    </div>
                </li>
                <li>
                    <div class="yimg fl">
                        <img src="/Public/Home/images/ytip_02.png" alt="" class="ymg1 fl">
                    </div>
                    <div class="yzi fl">
                        <div class="y_zi1">
                            <span>特价不二</span>
                            价格只会更低
                        </div>
                    </div>
                </li>
                <li>
                    <div class="yimg fl">
                        <img src="/Public/Home/images/ytip_03.png" alt="" class="ymg1 fl">
                    </div>
                    <div class="yzi fl">
                        <div class="y_zi1">
                            <span>特价不二</span>
                            价格只会更低
                        </div>
                    </div>
                </li>
                <li>
                    <div class="yimg fl">
                        <img src="/Public/Home/images/ytip_04.png" alt="" class="ymg1 fl">
                        <img src="/Public/Home/images/ytip_044.png" alt="" class="ymg2 fl">
                    </div>
                    <div class="yzi fl">
                        <div class="y_zi1">
                            <span>特价不二</span>
                            品牌质量保证 支付安全
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="ydiv2">
        <div class="ytitle_02 fix">
            <a href="#ys1" class="xz">线路行程</a>
            <a href="#ys2">费用说明</a>
            <a href="#ys3">预定指南</a>
            <a href="#ys4">游客点评</a>
            <a href="#ys5">我要咨询</a>
        </div>
        <div class="yart_04">
            <a class="ydi" name="ys1"> </a>
            <a class="yspan4">产品特色推荐：</a>
            <div class="yaa editor"><?php echo ($line_info['features']); ?></div>


            <a class="ydi" name="ys2"> </a>
            <a class="yspan4">参考行程：</a>
            <div class="yaa3">
                <?php if(is_array($line_info['xingcheng'])): $xx = 0; $__LIST__ = $line_info['xingcheng'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($xx % 2 );++$xx;?><div class="yyar1">
                        <span>第<?php echo ($xx); ?>天</span>
                        <div class="yaar">
                            <span><?php echo ($val[0]); ?></span>
                            <a href="javascript:void(0);" class="yab1">用餐：<?php echo ($val[2]); ?></a><a href="#" class="yab2">交通：<?php echo ($val[3]); ?></a><a href="#" class="yab3">住宿：<?php echo ($val[4]); ?></a>
                            <font class="editor"><?php echo ($val[1]); ?></font>
                            <?php if(is_array($val[5])): $i = 0; $__LIST__ = $val[5];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><img src="<?php echo get_cover($v, 'path');?>" width="100%" /><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>


            <a class="ydi" name="ys2"> </a>
            <a class="yspan4">费用说明：</a>
            <div class="yaa fix editor">
                <?php echo ($line_info['remark'][1]); ?>
            </div>



            <a class="ydi" name="ys3"> </a>
            <a class="yspan4">预定指南：</a>
            <div class="yaa editor">
                <?php echo ($line_info['remark'][3]); ?>
            </div>

            <a class="ydi" name="ys4"> </a>
            <a class="yspan4">游客评价：</a>
            <div class="yaa">
                <div class="ydid2">
                    昵称：1220****456
                    <br> 内容：由于旅游尾单的特性，价格可能还会随着时间的临近而下降，您购买到心仪的度假产品后，还请冷静面对随后的降价，该出手时就出手，买到总比错过强呀！！
                    <br>
                    <span>2015-10-29</span>
                </div>
                <div class="ydid2">
                    昵称：1220****456
                    <br> 内容：由于旅游尾单的特性，价格可能还会随着时间的临近而下降，您购买到心仪的度假产品后，还请冷静面对随后的降价，该出手时就出手，买到总比错过强呀！！
                    <br>
                    <span>2015-10-29</span>
                </div>
                <div class="ydid2">
                    昵称：1220****456
                    <br> 内容：由于旅游尾单的特性，价格可能还会随着时间的临近而下降，您购买到心仪的度假产品后，还请冷静面对随后的降价，该出手时就出手，买到总比错过强呀！！
                    <br>
                    <span>2015-10-29</span>
                </div>
            </div>

            <a class="ydi" name="ys5"> </a>
            <a class="yspan4">我要咨询：</a>
            <div class="ybiaodan">
                <div class="ydiv3 fix">
                    <span>我要咨询：</span>
                    <textarea class="ytex fl putnone"></textarea>
                </div>
                <div class="ydiv3 fix">
                    <span>联系方式：</span>
                    <select class="yselect fl">
                        <option value=""></option>
                    </select>
                    <input type="text" class="y_put3 fl putnone">
                </div>
                <div class="ydiv3 fix">
                    <span>验 证 码 ：</span>
                    <input type="text" class="y_put4 fl putnone">
                    <img src="/Public/Home/images/yyzm.jpg" alt="">
                </div>
                <div class="ydiv3 fix">
                    <input type="button" value="提交" class="y_put5 fl putnone">
                </div>
            </div>
        </div>
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
		"APP"    : "", //当前项目地址
		"PUBLIC" : "/Public", //项目公共目录地址
		"DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
		"MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
		"VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
	}
})();
</script>

    <script type="text/javascript">
        var _url_show_price_type = '<?php echo U('showTypeDate');?>';
    </script>
    <script src="/Public/Home/js/line.js" type="text/javascript"></script>
    <script src="/Public/Home/js/editor.js"></script>
    <script>
        $('.editor').each(function() {
            var self = $(this);
            var html = self.html();
            self.html(Editor_cncn.prototype.contentDecode(html, true));
        });
        $(".price_tooltip").hover(function() {
            var top = $(this).position().top + 23;
            var left = $(this).position().left - 100;
            $(".tooltip_con").css({
                "top": top,
                "left": left
            });
            $(".tooltip_con").show();
        }, function() {
            $(".tooltip_con").hide();
        });
        $(".tooltip_con").hover(function() {
            $(this).show();
        }, function() {
            $(this).hide();
        });
    </script>
    <script src="/Public/Home/js/jquery.slideBox.min.js" type="text/javascript"></script>
    <script>
        jQuery(function($) {
            $('#demo3').slideBox({
                duration: 0.3, //滚动持续时间，单位：秒
                easing: 'linear', //swing,linear//滚动特效
                delay: 5, //滚动延迟时间，单位：秒
                hideClickBar: false, //不自动隐藏点选按键
                clickBarRadius: 10
            });
        });
    </script>
    <script>
        $(window).scroll(function() {
            if ($(window).scrollTop() > 1030) {
                $('.ytitle_02').css({
                    'position': 'fixed',
                    'top': '0px'
                })
            } else {
                $('.ytitle_02').css({
                    'position': 'relative'
                })
            }
        });
    </script>
 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>

	<!-- /底部 -->
</body>
</html>