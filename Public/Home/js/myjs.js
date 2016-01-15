$(function(){
	// 导航下拉
	$(".ul li").each(function(){
          if($(this).children("a").hasClass("xz"))
          {
              $(this).hover(function(){
                                        $(this).children(".xl").stop(true,true).show()
                                     },function(){
                                         $(this).children(".xl").stop(true,true).hide()
                                     })
              }
             else{
                 $(this).hover(function(){
                                        $(this).children("a").addClass("xz");
                                        $(this).children(".xl").stop(true,true).show()
                                     },function(){
                                        $(this).children("a").removeClass("xz");
                                        $(this).children(".xl").stop(true,true).hide()
                                     })
                 }
          })

	//TAB切换
	$('.title').each(function(){
		 $(this).children('.title1').eq(0).addClass('xz');
	})

	$('.title_nr').each(function(){
		 $(this).children('.title_nr1').eq(0).show();
	})

	$('.title1').mouseover(function(){
		$(this).addClass('xz').siblings().removeClass('xz');
		$(this).parent().siblings('.title_nr').children('.title_nr1').eq($(this).index()).show().siblings().hide();
	})

	//内容居中
	$('.zc_main_nrk').css('margin-top',($('.zc_main').height()-$('.zc_main_nrk').height()-50)/2);
	$('.dl_main_nrk').css('margin-top',($('.dl_main').height()-$('.dl_main_nrk').height()-50)/2);
	$('.zccg_main_nrk').css('margin-top',($('.zccg_main').height()-$('.zccg_main_nrk').height()-150)/2);

	//登录注册文本框点击
	$('.zc_main_nrk_bottom_left ol').click(function(){
		$(this).css('border','1px solid #ff9e02');
		$(this).siblings('ol').css('border','1px solid #cfcfcf');
		$(this).siblings('ul').find('.wbk').css({'border':'1px solid #cfcfcf','border-right':'0px'});
	})

	$('.zc_main_nrk_bottom_left ul .wbk').click(function(){
		$(this).css({'border':'1px solid #ff9e02','border-right':'0px'});
		$(this).parent('ul').siblings('ol').css('border','1px solid #cfcfcf')
	})

	$('.dl_main_nrk_bottom_left ol').click(function(){
		$(this).css('border','1px solid #ff9e02');
		$(this).siblings('ol').css('border','1px solid #cfcfcf');
	})

	$('.zhmm_main1_nrk_bottom1_center ol').click(function(){
		$(this).css('border','1px solid #ff9e02');
		$(this).parents('.zhmm_main1_nrk_bottom1').siblings('.zhmm_main1_nrk_bottom1').find('ol').css('border','1px solid #cfcfcf');
		$(this).parents('.zhmm_main1_nrk_bottom1').siblings('.zhmm_main1_nrk_bottom1').find('ul .wbk').css({'border':'1px solid #cfcfcf','border-right':'0px'});
	})

	$('.zhmm_main1_nrk_bottom1_center ul .wbk').click(function(){
		$(this).css({'border':'1px solid #ff9e02','border-right':'0px'});
		$(this).parents('.zhmm_main1_nrk_bottom1').siblings('.zhmm_main1_nrk_bottom1').find('ol').css('border','1px solid #cfcfcf')
	})

	//弹窗
	$('.zx1').height($(window).height());
		$('.tanchuang1').click(function(){
		$('.zx1').fadeIn();
		$('.tcdiv1').css('margin-top',($(window).height()-$('.tcdiv1').height())/2);
		})
	$('.gb').click(function(){
		$('.zx1').hide();
		})

	$('.zx2').height($(window).height());
		$('.tanchuang2').click(function(){
		$('.zx2').fadeIn();
		$('.tcdiv2').css('margin-top',($(window).height()-$('.tcdiv2').height())/2);
		})
	$('.zx2').click(function(){
		$('.zx2').hide();
		})


  //--------------------------------------W
  //首页切换图标
  $('.wmdcn_nr_right ul li').hover(function(){
        $(this).css('width','694px');
        $(this).find('.ymg1').stop(true,true).fadeOut(600);
        $(this).find('.ymg2').stop(true,true).fadeIn(700);
        $('.y_zi1').hide();
        $(this).find('.y_zi2').show();
        $(this).siblings().css('width','100px');
    },function(){
        $(this).css('width','250px');
        $(this).find('.ymg2').stop(true,true).fadeOut(1000);
        $(this).find('.ymg1').stop(true,true).fadeIn(1500);
        $(this).find('.y_zi2').hide();
        $('.y_zi1').show();
        $(this).siblings().css('width','250px');
  })
  
  //签证页面tip滚动


  //签证详情
  $('.y_gj').hide();
  $('.y_gj').eq(0).show();
  $('.y_div1tou a').mouseover(function(){
        $(this).addClass('xz');
        $(this).siblings().removeClass('xz');
        $('.y_gjn').find('.y_gj').eq($(this).index()).show();
        $('.y_gjn').find('.y_gj').eq($(this).index()).siblings().hide();
  })

  $('.ya4').click(function(){
      $(this).hide();
      $(this).siblings().show();
      $('.ydiv6').show();
      $(this).parents('.yk_01').css({'border':'1px solid #0091ed','margin-top':'-1px'});
      $('.yfff').css('border-bottom','1px dashed #dfdfdf')
  })
  $('.ya5').click(function(){
      $(this).hide();
      $(this).siblings().show();
      $('.ydiv6').hide();
      $(this).parents('.yk_01').css({'border-left':'1px solid #e4e4e4','border-right':'1px solid #e4e4e4','border-top':'none','border-bottom':'1px dashed #dfdfdf'})
      $('.yfff').css('border-bottom','none')
  })



  $('.yy1 a').click(function(){
	  $('.ydiv6').find('.yydiv').eq($(this).index()).show().siblings().hide()
  })




})
