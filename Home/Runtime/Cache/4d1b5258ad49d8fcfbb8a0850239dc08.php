<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>叫啥网 </title>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="网上订餐系统多店版,快捷订餐系统多店版"/>
    <meta name="description" content=" 。"/>
    <link rel="stylesheet" type="text/css" href="/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/css/expand.css"/>
    <link rel="stylesheet" type="text/css" href="/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="/css/mall.css"/>
    <link rel="stylesheet" type="text/css" href="/css/css.css"/>
    <script src="/js/conf.js"></script>
    <script src="/js/kj.js"></script>
    <script src="/js/kj.dialog.js"></script>
    <script src="/js/kj.ajax.js"></script>
    <script src="/js/header.js"></script>
    <script src="/js/member.js"></script>
    <script src="/js/kj.rule.js"></script>
    <script src="/js/kj.alert.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/kj2.css"/>
</head>
<body>


<div class="xiala111" id="id_menu_text1" onmouseover="kj.show(this);kj.show('#id_mb_view');" onmouseout="kj.hide(this);"
     style="display:none">
    <li><a href="/?autologin=1">个人用户</a></li>
    <li><a href="/?autologin=2">店铺用户</a></li>
    <li><a href="/?autologin=3">后台用户</a></li>
</div>
<script>
    var kjtest = new function () {
        this.showtest = function (o) {
            var offset = kj.offset(o);
            kj.set('#id_menu_text1', 'style.left', (offset.left) + 'px');
            kj.show('#id_menu_text1');
        }
        this.hidetest = function () {
            kj.hide('#id_menu_text1');
        }
    }
    var mb_view = kj.cookie_get('test_mb_view');
    if (!mb_view) {
        kj.onload(function () {
            kj.show("#id_mb_view");
            kj.cookie_set('test_mb_view', 1, 20000, '');
        });
    }
</script>
<div class="top">
    <ul class="main">
        <li class="x1"><span><img src="/images/position.png"></span><span>&nbsp;A - 大连市&nbsp;<a
                href="#">[切换地址]</a></span></li>
        <li class="x2">
            <span class="xqq"><a href="/common.php?app=api.login&plat=qq"></a></span> <span class="xsina"><a
                href="/common.php?app=api.login&plat=weibo"></a></span>		<span class="x2x">
		<a href="javascript:jsheader.showlogin();">登录</a>&nbsp;&nbsp;<a href="javascript:jsheader.showreg();">注册</a>
				</span>
        </li>
    </ul>
</div>
<div class="main">
    <div class="mainbg" id="id_mainbg">
        <div class="topmenu">
            <li><img src="/images/logo.png"></li>
            <li class="x1">
                <a href="/" class="x2">首页</a>
                <a href="/index.php?app=act.gift">礼品兑换</a>
                <a href="/index.php?app_act=help">帮助中心</a>
                <a href="/index.php?app_act=msg">意见反馈</a>
                <a href="/index.php?app_act=cart">购物车</a>
            </li>
        </div>
    </div>


<div class="mainbg mg_t1">
<script src="/js/header.js"></script>
<script src="/js/member.js"></script>
<script src="/js/kj.rule.js"></script>
<script src="/js/kj.alert.js"></script>
<script>
    kj.onload(function(){
        var w = (kj.w()-980)/2;
        kj.set("#idmenu1" , "style.top" , '120px');
        kj.set("#idmenu1" , "style.left" , (w+390)+'px');
        jsheader.rule_uname = "default";
        jsheader.reg_verify = "1";
        jsheader.tempurl = "/";
        jsheader.is_verify = false;
    });
</script><script>
    thisdata = [];
</script>
<div class="cartlist mg1 bgcolor2">
    <form name="frm_main" method="post" action="/index.php?app=ajax&app_act=saveorder" onsubmit="return thisjs.save();">
        <input type="hidden" name="cart_ids" value="">
        <input type="hidden" name="addprice" value="">
        <div class="xtitle"><a href="/index.php?app_act=shop&id=4">天天粥铺</a></div>
        <div style="float:left;width:100%" id="id_shop_4">
            <div id="id_list_4">
                <table class="mlist"><tr class="tit"><td class="sort">序号</td><td>菜品</td><td class="num">数量</td><td class="count">金额小计</td><td class="act">操作</td></tr>
                    <tr class="x_list1"><td class="sort">1</td><td>
                        客家咸鸡+粉蒸肉				<input type="hidden" name="menuprice[]" value="18">
                    </td><td>
                        <input type="button" name="btn_jian" value="" class="btn_jian" onclick="jscartlist.change_num('#id_num_306',-1);"> <input type="text" name="menunum[]" value="1" id="id_num_306" class="x_num" onkeyup="jscartlist.change_num('#id_num_306')"> <input type="button" name="btn_jian" value="" class="btn_jia" onclick="jscartlist.change_num('#id_num_306',1);">
                    </td><td>￥<span class="menu_price">18</span></td><td><img src="/images/pic_del.png" onclick="jscartlist.cart_remove(this , 4,306)" style="cursor:pointer"></td></tr>
                    <script>
                        thisdata[thisdata.length] = "306";
                    </script>
                    <tr class="x_list1"><td class="sort">2</td><td>
                        铁板鱼类 + 红烧猪手				<input type="hidden" name="menuprice[]" value="18">
                    </td><td>
                        <input type="button" name="btn_jian" value="" class="btn_jian" onclick="jscartlist.change_num('#id_num_302',-1);"> <input type="text" name="menunum[]" value="1" id="id_num_302" class="x_num" onkeyup="jscartlist.change_num('#id_num_302')"> <input type="button" name="btn_jian" value="" class="btn_jia" onclick="jscartlist.change_num('#id_num_302',1);">
                    </td><td>￥<span class="menu_price">18</span></td><td><img src="/images/pic_del.png" onclick="jscartlist.cart_remove(this , 4,302)" style="cursor:pointer"></td></tr>
                    <script>
                        thisdata[thisdata.length] = "302";
                    </script>
                    <tr class="x_list1"><td class="sort">3</td><td>
                        酸菜小笋肉沫饭				<input type="hidden" name="menuprice[]" value="10">
                    </td><td>
                        <input type="button" name="btn_jian" value="" class="btn_jian" onclick="jscartlist.change_num('#id_num_247',-1);"> <input type="text" name="menunum[]" value="1" id="id_num_247" class="x_num" onkeyup="jscartlist.change_num('#id_num_247')"> <input type="button" name="btn_jian" value="" class="btn_jia" onclick="jscartlist.change_num('#id_num_247',1);">
                    </td><td>￥<span class="menu_price">10</span></td><td><img src="/images/pic_del.png" onclick="jscartlist.cart_remove(this , 4,247)" style="cursor:pointer"></td></tr>
                    <script>
                        thisdata[thisdata.length] = "247";
                    </script>
                </table>
            </div>
            <table class="tabact" id="id_score_4">
                <tr><td class="col1">预付款支付抵扣</td><td><input type='text' name='repayment' value="" class="txtbox1 pTxtL100 w_full" onblur="jscartlist.repayment_input(4);" onkeyup="jscartlist.repayment_input(4);" id="id_repayment_input">&nbsp;您还有 <b class="x_sel3 red" id="id_my_repayment">0.00</b> 元</td></tr>
            </table>
            <table class="tabact" id="id_score_4"style='display:none'>
                <tr><td class="col1">积分抵扣<br>100积分可抵1元</td><td><input type='text' name='score' value="" class="txtbox1 pTxtL100" onblur="jscartlist.score_input(4);" onkeyup="jscartlist.score_input(4);" id="id_score_input"> × 100&nbsp;&nbsp;您还有 <span class="x_sel3" id="id_my_score">70</span> 积分，可抵扣 <span class="x_sel3">0</span> 元</td></tr>
            </table>
            <table class="tabact" style='display:none'>
                <tr><td class="col1">优惠活动</td><td id="id_act_4"></td></tr>
            </table>
            <div class="total" id="id_total_4">
                合计金额：<span class="x_sel1">￥</span><span id="id_shop_total_4" class="x_sel1">46</span> (菜品金额)<span> +<font class="x_sel1"  id="id_shop_addprice_4">￥0</font>(配送费)</span><span> - <font class="x_sel1"  id="id_shop_repayment_4">￥0</font>(预付款)</span><span style='display:none'> - <font class="x_sel1">￥</font><font id="id_shop_score_4" class="x_sel1">0</font> (积分抵扣)</span><span> - <font class="x_sel1">￥</font><font id="id_shop_act_4" class="x_sel1">0</font> (优惠金额)</span> = <span class="x_sel2">￥</span><span class="x_sel2 id_shop_price_4">46</span>&nbsp;&nbsp;&nbsp;
            </div>
            <div class="scoretotal" style="color:#ff0000;padding-right:10px;display:none">
                本次订单可获得：<span id="id_scoreintro_4"></span> 积分<br><span style="color:#888">(将在订单成交以后送出)</span>
            </div>
        </div>
        <table class="tabact">
            <tr><td class="col1" valign="top">配送信息：(<font style="color:#ff0000">*</font>)</td>
                <td id="id_address_info">
                    <table class="x_sel1" id="id_info_191">
                        <tr><td style="color:#0099FF" width="150px" valign="top"><label><input name="area_select" type="radio" id="id_info_radior191" value="191"  checked onclick="jscartlist.infosel(this ,191);">&nbsp;<span  id="id_info_name191">asda（先生）</span></label></td>
                            <td valign="top" id="id_info_base191">
                                福田区 车公庙 安华工业区4栋 东座&nbsp; — &nbsp;asds<br>
                                固话：  / 手机：<span class="Tmobile">13800138000</span>
                                <br><span class="x_sel2" id="id_dispatch_191">起送价：10.00</span>
                                &nbsp;&nbsp;&nbsp;&nbsp;<span class="x_sel2" id="id_addprice_191">配送费：0</span>
                            </td>
                            <td width="200px" valign="top"><input type="button" name="btnedit[]" value="编辑" class="button4" onclick="jscartlist.info_edit(191);">&nbsp;<input type="button" name="btndel[]" value="删除" class="button4y" onclick="jscartlist.info_del(191);"></td></tr>
                    </table>

                    <table  >
                        <tr><td style="color:#0099FF" width="150px" valign="top"><label><input type="radio" name="area_select" value="0" id="id_new_info_radior" onclick="jscartlist.infosel(this,'0');" >使用新地址</label></td>
                            <td valign="top" id="id_new_infocol">
                                <table  style="display:none" id="id_new_infosel">
                                    <tr><td>所在区域：<span style="color:#ff0000">*</span></td><td>
                                        <input type="hidden" name="area_id" id="id_area_id" value="">
                                        <input type="hidden" name="area_allid" id="id_area_allid" value="">
                                        <input type="hidden" name="area" id="id_area" value="">
                                        <select name="info_area_id[]" onchange="jscartlist.changearea(this.value,0);" id="id_area_0">
                                            <option value=""></option>
                                            <option value="2299">宝安区</option>
                                            <option value="2300">龙岗区</option>
                                            <option value="2301">盐田区</option>
                                            <option value="2296">罗湖区</option>
                                            <option value="2297">福田区</option>
                                            <option value="2298">南山区</option>
                                        </select>
                                        <select name="info_area_id[]" onchange="jscartlist.changearea(this.value,1);" id="id_area_1">
                                        </select>
                                        <select name="info_area_id[]" onchange="jscartlist.changearea(this.value,2);" id="id_area_2">
                                        </select>
                                        <select name="info_area_id[]" onchange="jscartlist.changearea(this.value,3);" id="id_area_3">
                                        </select>

                                        <br><span class="x_sel2">起送价：</span><span class="x_sel2" id="id_dispatch_0">10.00</span>
                                        &nbsp;&nbsp;<span class="x_sel2">配送费：</span><span class="x_sel2" id="id_addprice_0">0</span>
                                    </td></tr>
                                    <tr><td>具体位置：<span style="color:#ff0000">*</span></td><td>
                                        <input name="louhao1" type="text" maxlength="50" value="" style="width:200px">&nbsp;
                                        <input name="louhao2" type="hidden" value="">
                                    </td></tr>
                                    <tr><td>收 件 人：<span style="color:#ff0000">*</span></td><td>
                                        <input name="name" type="text" maxlength="5">
                                        <label><input name="sex" type="radio" value="先生" checked>先生</label>
                                        <label><input type="radio" name="sex" value="小姐">小姐</label><span class="txt_gary"> (如果有同事与您同姓，建议您填全名!)</span>

                                    </td></tr>
                                    <tr><td>手机号码：</td><td>
                                        <input name="mobile" type="text" maxlength="11">

                                    </td></tr>
                                    <tr><td>固定电话：</td><td>
                                        <input name="tel" type="text" maxlength="8" value="" placeholder="八位数字不带区号">
                                        <input name="telext" type="text" maxlength="4" style="width:60px" value="" placeholder="分机选填">
                                    </td></tr>
                                    <tr><td>公司部门：</td><td>
                                        <input name="company" type="text" maxlength="12" value="" placeholder="公司名称-选填">
                                        <input name="depart" type="text" maxlength="5" value="" placeholder="部门-选填">
                                    </td></tr>
                                </table>
                            </td></tr>
                    </table>
                    <table class="x_sel1" id="id_edit_infodiv" style="display:none">
                        <tr><td style="color:#0099FF" width="150px" valign="top"><input type="radio" name="area_select" id="id_new_edit_radior">编辑信息</td>
                            <td valign="top" id="id_info_editcol">
                            </td></tr>
                        <tr><td style="color:#0099FF" width="150px" valign="top"></td>
                            <td valign="top"><input type="button" name="btn_saveinfo" value="保 存" class="button4" onclick="jscartlist.info_save();">&nbsp;&nbsp;<input type="button" name="btn_saveinfo" value="取 消" class="button4x" onclick="jscartlist.info_cancel(true);"></td></tr>
                    </table>
                </td>
            </tr></table>
        <table class="tabact" id="id_arrive_4">
            <tr><td class="col1" valign="top">送餐时间(<font style="color:#ff0000">*</font>)</td>
                <td><select name="arrive">
                    <option value="尽快送到">尽快送到</option>
                    <option value="1630">16:30</option>
                    <option value="1700">17:00</option>
                    <option value="1730">17:30</option>
                    <option value="1800">18:00</option>
                    <option value="1830">18:30</option>
                    <option value="1900">19:00</option>
                    <option value="1930">19:30</option>
                    <option value="2000">20:00</option>
                </select></td></tr>
        </table>
        <table class="tabact" id="id_paymethod_4">
            <tr><td class="col1" valign="top">支付方式(<font style="color:#ff0000">*</font>)</td>
                <td>
                    <li style="display:none"><label><input type="radio" name="paymethod" value="paymented">已抵扣，无需要付款</label></li>
                    <li><label><input type="radio" name="paymethod" value="afterpayment" checked>货到付款</label></li>		<li><label><input type="radio" name="paymethod" value="onlinepayment">在线支付</label></li>		</td></tr>
        </table>
        <table class="tabact" id="id_ticket_4">
            <tr><td class="col1" valign="top">索取发票</td>
                <td>
                    <select name="ticket" id="id_ticket" style="margin-right:3px; width:252px" onchange="jscartlist.score_refresh(1)">
                        <option value="0">暂不提供</option>
                    </select></td></tr>
        </table>
        <table class="tabact" id="id_beta_4">
            <tr><td class="col1" valign="top">备注</td>
                <td><textarea name="beta" cols='50' rows='2' id="id_beta" onkeyup="jscartlist.beta_keyup()"></textarea>&nbsp;还能输入<span style="color:#ff0000" id="id_beta_num">30</span>个字<br>
                    <a href="javascript:jscartlist.insert_beta('快点送来');" title="点击插入备注">快点送来</a>&nbsp;&nbsp;
                    <a href="javascript:jscartlist.insert_beta('别放辣');" title="点击插入备注">别放辣</a>&nbsp;&nbsp;
                    <a href="javascript:jscartlist.insert_beta('饭多点');" title="点击插入备注">饭多点</a>&nbsp;&nbsp;
                    <a href="javascript:jscartlist.insert_beta('加辣');" title="点击插入备注">加辣</a>&nbsp;&nbsp;
                    <a href="javascript:jscartlist.insert_beta('超时就不要了');" title="点击插入备注">超时就不要了</a>&nbsp;&nbsp;
                </td></tr>
        </table>
        <div class="confirm">
            <input type="button" name="btn_ok" value="提交订单" class="button3" onclick="jscartlist.submit();">
        </div>
    </form>
</div>
<script src="/js/cartlist.js"></script>
<script>
    kj.onload(function(){
        jscartlist.action_score = {"base":0.5,"add":0};
        jscartlist.addprice = kj.toint('0');
        jscartlist.minaddprice = kj.toint('0');
        jscartlist.user_repayment = kj.toint('0.00');
        jscartlist.shopid = 4;
        jscartlist.ordernum = 3;
        jscartlist.shop_minleast = kj.toint("10.00");
        jscartlist.shop_oneminleast = kj.toint("10.00");
        jscartlist.minleast = jscartlist.shop_minleast;

        jscartlist.score = 70;//当前积分
        jscartlist.act_list = [];//时间条件优惠金额
        jscartlist.arealist = {"id_0":["2299","2300","2301","2296","2297","2298"],"id_2296":["3911","3912","3913"],"id_2297":["3647","3881","3882","3883","3884","3885","3886","3887","3888","3889","3890","3891","3892","3893","3894","3895","3896","3897","3898","3899","3900","3901","3902","3903","3904","3905","3906","3907","3908","3909","3910"],"id_3647":["3648","3651","3653","3655","3658","3662","3665","3668","3670","3672","3675","3677","3679","3681","3684","3686","3690","3695","3697","3700","3703","3714","3716","3722","3734","3737","3739","3742","3744","3748","3750","3752","3754","3756","3758","3760","3762","3764","3767","3770","3773","3776","3779","3782","3785","3788","3791","3794","3797","3800","3803","3806","3809","3811","3813","3815","3818","3821","3824","3827","3830","3834","3836","3838","3841","3844","3846","3848"],"id_3648":["3649","3650"],"id_3651":["3652"],"id_3653":["3654"],"id_3655":["3656","3657"],"id_3658":["3659","3660","3661"],"id_3662":["3663","3664"],"id_3665":["3666","3667"],"id_3668":["3669"],"id_3670":["3671"],"id_3672":["3673","3674"],"id_3675":["3676"],"id_3677":["3678"],"id_3679":["3680"],"id_3681":["3682","3683"],"id_3684":["3685"],"id_3686":["3687","3688","3689"],"id_3690":["3691","3692","3693","3694"],"id_3695":["3696"],"id_3697":["3698","3699"],"id_3700":["3701","3702"],"id_3703":["3704","3705","3706","3707","3708","3709","3710","3711","3712","3713"],"id_3714":["3715"],"id_3716":["3717","3718","3719","3720","3721"],"id_3722":["3723","3724","3725","3726","3727","3728","3729","3730","3731","3732","3733"],"id_3734":["3735","3736"],"id_3737":["3738"],"id_3739":["3740","3741"],"id_3742":["3743"],"id_3744":["3745","3746","3747"],"id_3748":["3749"],"id_3750":["3751"],"id_3752":["3753"],"id_3754":["3755"],"id_3756":["3757"],"id_3758":["3759"],"id_3760":["3761"],"id_3762":["3763"],"id_3764":["3765","3766"],"id_3767":["3768","3769"],"id_3770":["3771","3772"],"id_3773":["3774","3775"],"id_3776":["3777","3778"],"id_3779":["3780","3781"],"id_3782":["3783","3784"],"id_3785":["3786","3787"],"id_3788":["3789","3790"],"id_3791":["3792","3793"],"id_3794":["3795","3796"],"id_3797":["3798","3799"],"id_3800":["3801","3802"],"id_3803":["3804","3805"],"id_3806":["3807","3808"],"id_3809":["3810"],"id_3811":["3812"],"id_3813":["3814"],"id_3815":["3816","3817"],"id_3818":["3819","3820"],"id_3821":["3822","3823"],"id_3824":["3825","3826"],"id_3827":["3828","3829"],"id_3830":["3831","3832","3833"],"id_3834":["3835"],"id_3836":["3837"],"id_3838":["3839","3840"],"id_3841":["3842","3843"],"id_3844":["3845"],"id_3846":["3847"],"id_3848":["3849","3850"],"id_3882":["3914"],"id_3881":["3915"],"id_2298":["3916"]};//json格式，指定id包函的子地区
        jscartlist.areainfo = {"id_2299":{"id":2299,"name":"宝安区","pid":0,"a_id":2299,"depth":1,"pids":2299,"price":0.00,"addprice":0.00,"time":0},"id_2300":{"id":2300,"name":"龙岗区","pid":0,"a_id":2300,"depth":1,"pids":2300,"price":0.00,"addprice":0.00,"time":0},"id_2301":{"id":2301,"name":"盐田区","pid":0,"a_id":2301,"depth":1,"pids":2301,"price":0.00,"addprice":0.00,"time":0},"id_2296":{"id":2296,"name":"罗湖区","pid":0,"a_id":2296,"depth":1,"pids":2296,"price":0.00,"addprice":0.00,"time":0},"id_3911":{"id":3911,"name":"宝安南路","pid":2296,"a_id":2296,"depth":2,"pids":"2296,3911","price":0.00,"addprice":0.00,"time":0},"id_3912":{"id":3912,"name":"布心、东晓、吓屋村","pid":2296,"a_id":2296,"depth":2,"pids":"2296,3912","price":0.00,"addprice":0.00,"time":0},"id_3913":{"id":3913,"name":"蔡屋围、万象城","pid":2296,"a_id":2296,"depth":2,"pids":"2296,3913","price":0.00,"addprice":0.00,"time":0},"id_2297":{"id":2297,"name":"福田区","pid":0,"a_id":2297,"depth":1,"pids":2297,"price":0.00,"addprice":0.00,"time":0},"id_3647":{"id":3647,"name":"车公庙","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3647","price":0.00,"addprice":0.00,"time":0},"id_3648":{"id":3648,"name":"A - 安华工业区9栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3648","val":"安华工业区9栋","price":0.00,"addprice":0.00,"time":0},"id_3649":{"id":3649,"name":"公司区","pid":3648,"a_id":2297,"depth":4,"pids":"2297,3647,3648,3649","price":0.00,"addprice":0.00,"time":0},"id_3650":{"id":3650,"name":"宿舍区","pid":3648,"a_id":2297,"depth":4,"pids":"2297,3647,3648,3650","price":0.00,"addprice":0.00,"time":0},"id_3651":{"id":3651,"name":"A - 安华工业区6栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3651","val":"安华工业区6栋","price":0.00,"addprice":0.00,"time":0},"id_3652":{"id":3652,"name":"本栋","pid":3651,"a_id":2297,"depth":4,"pids":"2297,3647,3651,3652","price":0.00,"addprice":0.00,"time":0},"id_3653":{"id":3653,"name":"A - 安华工业区5栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3653","val":"安华工业区5栋","price":0.00,"addprice":0.00,"time":0},"id_3654":{"id":3654,"name":"本栋","pid":3653,"a_id":2297,"depth":4,"pids":"2297,3647,3653,3654","price":0.00,"addprice":0.00,"time":0},"id_3655":{"id":3655,"name":"A - 安华工业区4栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3655","val":"安华工业区4栋","price":0.00,"addprice":0.00,"time":0},"id_3656":{"id":3656,"name":"东座","pid":3655,"a_id":2297,"depth":4,"pids":"2297,3647,3655,3656","price":0.00,"addprice":0.00,"time":0},"id_3657":{"id":3657,"name":"西座","pid":3655,"a_id":2297,"depth":4,"pids":"2297,3647,3655,3657","price":0.00,"addprice":0.00,"time":0},"id_3658":{"id":3658,"name":"A - 安华工业区7栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3658","val":"安华工业区7栋","price":0.00,"addprice":0.00,"time":0},"id_3659":{"id":3659,"name":"A区","pid":3658,"a_id":2297,"depth":4,"pids":"2297,3647,3658,3659","price":0.00,"addprice":0.00,"time":0},"id_3660":{"id":3660,"name":"B区","pid":3658,"a_id":2297,"depth":4,"pids":"2297,3647,3658,3660","price":0.00,"addprice":0.00,"time":0},"id_3661":{"id":3661,"name":"C区","pid":3658,"a_id":2297,"depth":4,"pids":"2297,3647,3658,3661","price":0.00,"addprice":0.00,"time":0},"id_3662":{"id":3662,"name":"C - 苍松大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3662","val":"苍松大厦","price":0.00,"addprice":0.00,"time":0},"id_3663":{"id":3663,"name":"南座","pid":3662,"a_id":2297,"depth":4,"pids":"2297,3647,3662,3663","price":0.00,"addprice":0.00,"time":0},"id_3664":{"id":3664,"name":"北座","pid":3662,"a_id":2297,"depth":4,"pids":"2297,3647,3662,3664","price":0.00,"addprice":0.00,"time":0},"id_3665":{"id":3665,"name":"T - 泰然213栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3665","val":"泰然213栋","price":0.00,"addprice":0.00,"time":0},"id_3666":{"id":3666,"name":"东座","pid":3665,"a_id":2297,"depth":4,"pids":"2297,3647,3665,3666","price":0.00,"addprice":0.00,"time":0},"id_3667":{"id":3667,"name":"西座","pid":3665,"a_id":2297,"depth":4,"pids":"2297,3647,3665,3667","price":0.00,"addprice":0.00,"time":0},"id_3668":{"id":3668,"name":"T - 泰然212栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3668","val":"泰然212栋","price":0.00,"addprice":0.00,"time":0},"id_3669":{"id":3669,"name":"本栋","pid":3668,"a_id":2297,"depth":4,"pids":"2297,3647,3668,3669","price":0.00,"addprice":0.00,"time":0},"id_3670":{"id":3670,"name":"T - 泰然211栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3670","val":"泰然211栋","price":0.00,"addprice":0.00,"time":0},"id_3671":{"id":3671,"name":"本栋","pid":3670,"a_id":2297,"depth":4,"pids":"2297,3647,3670,3671","price":0.00,"addprice":0.00,"time":0},"id_3672":{"id":3672,"name":"T - 泰然210栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3672","val":"泰然210栋","price":0.00,"addprice":0.00,"time":0},"id_3673":{"id":3673,"name":"西座","pid":3672,"a_id":2297,"depth":4,"pids":"2297,3647,3672,3673","price":0.00,"addprice":0.00,"time":0},"id_3674":{"id":3674,"name":"东座","pid":3672,"a_id":2297,"depth":4,"pids":"2297,3647,3672,3674","price":0.00,"addprice":0.00,"time":0},"id_3675":{"id":3675,"name":"G - 广华大厦503栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3675","val":"广华大厦503栋","price":0.00,"addprice":0.00,"time":0},"id_3676":{"id":3676,"name":"本栋","pid":3675,"a_id":2297,"depth":4,"pids":"2297,3647,3675,3676","price":0.00,"addprice":0.00,"time":0},"id_3677":{"id":3677,"name":"T - 泰然502栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3677","val":"泰然502栋","price":0.00,"addprice":0.00,"time":0},"id_3678":{"id":3678,"name":"本栋","pid":3677,"a_id":2297,"depth":4,"pids":"2297,3647,3677,3678","price":0.00,"addprice":0.00,"time":0},"id_3679":{"id":3679,"name":"D - 电子结算中心501栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3679","val":"电子结算中心501","price":0.00,"addprice":0.00,"time":0},"id_3680":{"id":3680,"name":"本栋","pid":3679,"a_id":2297,"depth":4,"pids":"2297,3647,3679,3680","price":0.00,"addprice":0.00,"time":0},"id_3681":{"id":3681,"name":"S - 盛唐大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3681","val":"盛唐大厦","price":0.00,"addprice":0.00,"time":0},"id_3682":{"id":3682,"name":"东座","pid":3681,"a_id":2297,"depth":4,"pids":"2297,3647,3681,3682","price":0.00,"addprice":0.00,"time":0},"id_3683":{"id":3683,"name":"西座","pid":3681,"a_id":2297,"depth":4,"pids":"2297,3647,3681,3683","price":0.00,"addprice":0.00,"time":0},"id_3684":{"id":3684,"name":"S - 水松大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3684","val":"水松大厦","price":0.00,"addprice":0.00,"time":0},"id_3685":{"id":3685,"name":"本栋","pid":3684,"a_id":2297,"depth":4,"pids":"2297,3647,3684,3685","price":0.00,"addprice":0.00,"time":0},"id_3686":{"id":3686,"name":"Y - 云松大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3686","val":"云松大厦","price":0.00,"addprice":0.00,"time":0},"id_3687":{"id":3687,"name":"本栋","pid":3686,"a_id":2297,"depth":4,"pids":"2297,3647,3686,3687","price":0.00,"addprice":0.00,"time":0},"id_3688":{"id":3688,"name":"百安居","pid":3686,"a_id":2297,"depth":4,"pids":"2297,3647,3686,3688","price":0.00,"addprice":0.00,"time":0},"id_3689":{"id":3689,"name":"百安居2层","pid":3686,"a_id":2297,"depth":4,"pids":"2297,3647,3686,3689","price":0.00,"addprice":0.00,"time":0},"id_3690":{"id":3690,"name":"H - 海松大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3690","val":"海松大厦","price":0.00,"addprice":0.00,"time":0},"id_3691":{"id":3691,"name":"B座","pid":3690,"a_id":2297,"depth":4,"pids":"2297,3647,3690,3691","price":0.00,"addprice":0.00,"time":0},"id_3692":{"id":3692,"name":"A座","pid":3690,"a_id":2297,"depth":4,"pids":"2297,3647,3690,3692","price":0.00,"addprice":0.00,"time":0},"id_3693":{"id":3693,"name":"B座裙楼","pid":3690,"a_id":2297,"depth":4,"pids":"2297,3647,3690,3693","price":0.00,"addprice":0.00,"time":0},"id_3694":{"id":3694,"name":"A座裙楼","pid":3690,"a_id":2297,"depth":4,"pids":"2297,3647,3690,3694","price":0.00,"addprice":0.00,"time":0},"id_3695":{"id":3695,"name":"J - 金谷六号(在建)","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3695","val":"金谷六号(在建)","price":0.00,"addprice":0.00,"time":0},"id_3696":{"id":3696,"name":"本栋","pid":3695,"a_id":2297,"depth":4,"pids":"2297,3647,3695,3696","price":0.00,"addprice":0.00,"time":0},"id_3697":{"id":3697,"name":"H - 红松大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3697","val":"红松大厦","price":0.00,"addprice":0.00,"time":0},"id_3698":{"id":3698,"name":"B座","pid":3697,"a_id":2297,"depth":4,"pids":"2297,3647,3697,3698","price":0.00,"addprice":0.00,"time":0},"id_3699":{"id":3699,"name":"A座","pid":3697,"a_id":2297,"depth":4,"pids":"2297,3647,3697,3699","price":0.00,"addprice":0.00,"time":0},"id_3700":{"id":3700,"name":"X - 雪松大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3700","val":"雪松大厦","price":0.00,"addprice":0.00,"time":0},"id_3701":{"id":3701,"name":"B座","pid":3700,"a_id":2297,"depth":4,"pids":"2297,3647,3700,3701","price":0.00,"addprice":0.00,"time":0},"id_3702":{"id":3702,"name":"A座","pid":3700,"a_id":2297,"depth":4,"pids":"2297,3647,3700,3702","price":0.00,"addprice":0.00,"time":0},"id_3703":{"id":3703,"name":"H - 皇冠科技园1栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3703","val":"皇冠科技园1栋","price":0.00,"addprice":0.00,"time":0},"id_3704":{"id":3704,"name":"A区","pid":3703,"a_id":2297,"depth":4,"pids":"2297,3647,3703,3704","price":0.00,"addprice":0.00,"time":0},"id_3705":{"id":3705,"name":"B区","pid":3703,"a_id":2297,"depth":4,"pids":"2297,3647,3703,3705","price":0.00,"addprice":0.00,"time":0},"id_3706":{"id":3706,"name":"C区","pid":3703,"a_id":2297,"depth":4,"pids":"2297,3647,3703,3706","price":0.00,"addprice":0.00,"time":0},"id_3707":{"id":3707,"name":"D区","pid":3703,"a_id":2297,"depth":4,"pids":"2297,3647,3703,3707","price":0.00,"addprice":0.00,"time":0},"id_3708":{"id":3708,"name":"E区","pid":3703,"a_id":2297,"depth":4,"pids":"2297,3647,3703,3708","price":0.00,"addprice":0.00,"time":0},"id_3709":{"id":3709,"name":"F区","pid":3703,"a_id":2297,"depth":4,"pids":"2297,3647,3703,3709","price":0.00,"addprice":0.00,"time":0},"id_3710":{"id":3710,"name":"G区","pid":3703,"a_id":2297,"depth":4,"pids":"2297,3647,3703,3710","price":0.00,"addprice":0.00,"time":0},"id_3711":{"id":3711,"name":"H区","pid":3703,"a_id":2297,"depth":4,"pids":"2297,3647,3703,3711","price":0.00,"addprice":0.00,"time":0},"id_3712":{"id":3712,"name":"I区","pid":3703,"a_id":2297,"depth":4,"pids":"2297,3647,3703,3712","price":0.00,"addprice":0.00,"time":0},"id_3713":{"id":3713,"name":"J区","pid":3703,"a_id":2297,"depth":4,"pids":"2297,3647,3703,3713","price":0.00,"addprice":0.00,"time":0},"id_3714":{"id":3714,"name":"H - 皇冠科技园8栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3714","val":"皇冠科技园8栋","price":0.00,"addprice":0.00,"time":0},"id_3715":{"id":3715,"name":"本栋","pid":3714,"a_id":2297,"depth":4,"pids":"2297,3647,3714,3715","price":0.00,"addprice":0.00,"time":0},"id_3716":{"id":3716,"name":"H - 皇冠科技园2栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3716","val":"皇冠科技园2栋","price":0.00,"addprice":0.00,"time":0},"id_3717":{"id":3717,"name":"中间电梯","pid":3716,"a_id":2297,"depth":4,"pids":"2297,3647,3716,3717","price":0.00,"addprice":0.00,"time":0},"id_3718":{"id":3718,"name":"东区北座","pid":3716,"a_id":2297,"depth":4,"pids":"2297,3647,3716,3718","price":0.00,"addprice":0.00,"time":0},"id_3719":{"id":3719,"name":"东区南座","pid":3716,"a_id":2297,"depth":4,"pids":"2297,3647,3716,3719","price":0.00,"addprice":0.00,"time":0},"id_3720":{"id":3720,"name":"西区北座","pid":3716,"a_id":2297,"depth":4,"pids":"2297,3647,3716,3720","price":0.00,"addprice":0.00,"time":0},"id_3721":{"id":3721,"name":"西区南座","pid":3716,"a_id":2297,"depth":4,"pids":"2297,3647,3716,3721","price":0.00,"addprice":0.00,"time":0},"id_3722":{"id":3722,"name":"H - 皇冠科技园3栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3722","val":"皇冠科技园3栋","price":0.00,"addprice":0.00,"time":0},"id_3723":{"id":3723,"name":"A区","pid":3722,"a_id":2297,"depth":4,"pids":"2297,3647,3722,3723","price":0.00,"addprice":0.00,"time":0},"id_3724":{"id":3724,"name":"B区","pid":3722,"a_id":2297,"depth":4,"pids":"2297,3647,3722,3724","price":0.00,"addprice":0.00,"time":0},"id_3725":{"id":3725,"name":"C区","pid":3722,"a_id":2297,"depth":4,"pids":"2297,3647,3722,3725","price":0.00,"addprice":0.00,"time":0},"id_3726":{"id":3726,"name":"D区","pid":3722,"a_id":2297,"depth":4,"pids":"2297,3647,3722,3726","price":0.00,"addprice":0.00,"time":0},"id_3727":{"id":3727,"name":"E区","pid":3722,"a_id":2297,"depth":4,"pids":"2297,3647,3722,3727","price":0.00,"addprice":0.00,"time":0},"id_3728":{"id":3728,"name":"F区","pid":3722,"a_id":2297,"depth":4,"pids":"2297,3647,3722,3728","price":0.00,"addprice":0.00,"time":0},"id_3729":{"id":3729,"name":"G区","pid":3722,"a_id":2297,"depth":4,"pids":"2297,3647,3722,3729","price":0.00,"addprice":0.00,"time":0},"id_3730":{"id":3730,"name":"H区","pid":3722,"a_id":2297,"depth":4,"pids":"2297,3647,3722,3730","price":0.00,"addprice":0.00,"time":0},"id_3731":{"id":3731,"name":"I区","pid":3722,"a_id":2297,"depth":4,"pids":"2297,3647,3722,3731","price":0.00,"addprice":0.00,"time":0},"id_3732":{"id":3732,"name":"J区","pid":3722,"a_id":2297,"depth":4,"pids":"2297,3647,3722,3732","price":0.00,"addprice":0.00,"time":0},"id_3733":{"id":3733,"name":"K区","pid":3722,"a_id":2297,"depth":4,"pids":"2297,3647,3722,3733","price":0.00,"addprice":0.00,"time":0},"id_3734":{"id":3734,"name":"T - 泰安轩","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3734","val":"泰安轩","price":0.00,"addprice":0.00,"time":0},"id_3735":{"id":3735,"name":"B座","pid":3734,"a_id":2297,"depth":4,"pids":"2297,3647,3734,3735","price":0.00,"addprice":0.00,"time":0},"id_3736":{"id":3736,"name":"A座","pid":3734,"a_id":2297,"depth":4,"pids":"2297,3647,3734,3736","price":0.00,"addprice":0.00,"time":0},"id_3737":{"id":3737,"name":"T - 泰康轩","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3737","val":"泰康轩","price":0.00,"addprice":0.00,"time":0},"id_3738":{"id":3738,"name":"本栋","pid":3737,"a_id":2297,"depth":4,"pids":"2297,3647,3737,3738","price":0.00,"addprice":0.00,"time":0},"id_3739":{"id":3739,"name":"X - 喜年大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3739","val":"喜年大厦","price":0.00,"addprice":0.00,"time":0},"id_3740":{"id":3740,"name":"A座","pid":3739,"a_id":2297,"depth":4,"pids":"2297,3647,3739,3740","price":0.00,"addprice":0.00,"time":0},"id_3741":{"id":3741,"name":"B座","pid":3739,"a_id":2297,"depth":4,"pids":"2297,3647,3739,3741","price":0.00,"addprice":0.00,"time":0},"id_3742":{"id":3742,"name":"J - 金润大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3742","val":"金润大厦","price":0.00,"addprice":0.00,"time":0},"id_3743":{"id":3743,"name":"本栋","pid":3742,"a_id":2297,"depth":4,"pids":"2297,3647,3742,3743","price":0.00,"addprice":0.00,"time":0},"id_3744":{"id":3744,"name":"D - 都市阳光名苑","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3744","val":"都市阳光名苑","price":0.00,"addprice":0.00,"time":0},"id_3745":{"id":3745,"name":"1座","pid":3744,"a_id":2297,"depth":4,"pids":"2297,3647,3744,3745","price":0.00,"addprice":0.00,"time":0},"id_3746":{"id":3746,"name":"2座","pid":3744,"a_id":2297,"depth":4,"pids":"2297,3647,3744,3746","price":0.00,"addprice":0.00,"time":0},"id_3747":{"id":3747,"name":"3座","pid":3744,"a_id":2297,"depth":4,"pids":"2297,3647,3744,3747","price":0.00,"addprice":0.00,"time":0},"id_3748":{"id":3748,"name":"Y - 有色金属大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3748","val":"有色金属大厦","price":0.00,"addprice":0.00,"time":0},"id_3749":{"id":3749,"name":"本栋","pid":3748,"a_id":2297,"depth":4,"pids":"2297,3647,3748,3749","price":0.00,"addprice":0.00,"time":0},"id_3750":{"id":3750,"name":"C - 创建大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3750","val":"创建大厦","price":0.00,"addprice":0.00,"time":0},"id_3751":{"id":3751,"name":"本栋","pid":3750,"a_id":2297,"depth":4,"pids":"2297,3647,3750,3751","price":0.00,"addprice":0.00,"time":0},"id_3752":{"id":3752,"name":"Y - 英龙大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3752","val":"英龙大厦","price":0.00,"addprice":0.00,"time":0},"id_3753":{"id":3753,"name":"本栋","pid":3752,"a_id":2297,"depth":4,"pids":"2297,3647,3752,3753","price":0.00,"addprice":0.00,"time":0},"id_3754":{"id":3754,"name":"D - 大庆大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3754","val":"大庆大厦","price":0.00,"addprice":0.00,"time":0},"id_3755":{"id":3755,"name":"本栋","pid":3754,"a_id":2297,"depth":4,"pids":"2297,3647,3754,3755","price":0.00,"addprice":0.00,"time":0},"id_3756":{"id":3756,"name":"S - 世纪豪庭","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3756","val":"世纪豪庭","price":0.00,"addprice":0.00,"time":0},"id_3757":{"id":3757,"name":"本栋","pid":3756,"a_id":2297,"depth":4,"pids":"2297,3647,3756,3757","price":0.00,"addprice":0.00,"time":0},"id_3758":{"id":3758,"name":"H - 杭钢商务大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3758","val":"杭钢商务大厦","price":0.00,"addprice":0.00,"time":0},"id_3759":{"id":3759,"name":"本栋","pid":3758,"a_id":2297,"depth":4,"pids":"2297,3647,3758,3759","price":0.00,"addprice":0.00,"time":0},"id_3760":{"id":3760,"name":"J - 金运世纪","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3760","val":"金运世纪","price":0.00,"addprice":0.00,"time":0},"id_3761":{"id":3761,"name":"本栋","pid":3760,"a_id":2297,"depth":4,"pids":"2297,3647,3760,3761","price":0.00,"addprice":0.00,"time":0},"id_3762":{"id":3762,"name":"T - 泰然207栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3762","val":"泰然207栋","price":0.00,"addprice":0.00,"time":0},"id_3763":{"id":3763,"name":"本栋","pid":3762,"a_id":2297,"depth":4,"pids":"2297,3647,3762,3763","price":0.00,"addprice":0.00,"time":0},"id_3764":{"id":3764,"name":"T - 泰然206栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3764","val":"泰然206栋","price":0.00,"addprice":0.00,"time":0},"id_3765":{"id":3765,"name":"西座","pid":3764,"a_id":2297,"depth":4,"pids":"2297,3647,3764,3765","price":0.00,"addprice":0.00,"time":0},"id_3766":{"id":3766,"name":"东座","pid":3764,"a_id":2297,"depth":4,"pids":"2297,3647,3764,3766","price":0.00,"addprice":0.00,"time":0},"id_3767":{"id":3767,"name":"T - 泰然205栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3767","val":"泰然205栋","price":0.00,"addprice":0.00,"time":0},"id_3768":{"id":3768,"name":"西座","pid":3767,"a_id":2297,"depth":4,"pids":"2297,3647,3767,3768","price":0.00,"addprice":0.00,"time":0},"id_3769":{"id":3769,"name":"东座","pid":3767,"a_id":2297,"depth":4,"pids":"2297,3647,3767,3769","price":0.00,"addprice":0.00,"time":0},"id_3770":{"id":3770,"name":"T - 泰然204栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3770","val":"泰然204栋","price":0.00,"addprice":0.00,"time":0},"id_3771":{"id":3771,"name":"西座","pid":3770,"a_id":2297,"depth":4,"pids":"2297,3647,3770,3771","price":0.00,"addprice":0.00,"time":0},"id_3772":{"id":3772,"name":"东座","pid":3770,"a_id":2297,"depth":4,"pids":"2297,3647,3770,3772","price":0.00,"addprice":0.00,"time":0},"id_3773":{"id":3773,"name":"T - 泰然203栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3773","val":"泰然203栋","price":0.00,"addprice":0.00,"time":0},"id_3774":{"id":3774,"name":"西座","pid":3773,"a_id":2297,"depth":4,"pids":"2297,3647,3773,3774","price":0.00,"addprice":0.00,"time":0},"id_3775":{"id":3775,"name":"东座","pid":3773,"a_id":2297,"depth":4,"pids":"2297,3647,3773,3775","price":0.00,"addprice":0.00,"time":0},"id_3776":{"id":3776,"name":"T - 泰然202栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3776","val":"泰然202栋","price":0.00,"addprice":0.00,"time":0},"id_3777":{"id":3777,"name":"西座","pid":3776,"a_id":2297,"depth":4,"pids":"2297,3647,3776,3777","price":0.00,"addprice":0.00,"time":0},"id_3778":{"id":3778,"name":"东座","pid":3776,"a_id":2297,"depth":4,"pids":"2297,3647,3776,3778","price":0.00,"addprice":0.00,"time":0},"id_3779":{"id":3779,"name":"T - 泰然201栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3779","val":"泰然201栋","price":0.00,"addprice":0.00,"time":0},"id_3780":{"id":3780,"name":"西座","pid":3779,"a_id":2297,"depth":4,"pids":"2297,3647,3779,3780","price":0.00,"addprice":0.00,"time":0},"id_3781":{"id":3781,"name":"东座","pid":3779,"a_id":2297,"depth":4,"pids":"2297,3647,3779,3781","price":0.00,"addprice":0.00,"time":0},"id_3782":{"id":3782,"name":"C - 创新科技广场2期","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3782","val":"创新科技广场2期","price":0.00,"addprice":0.00,"time":0},"id_3783":{"id":3783,"name":"西座","pid":3782,"a_id":2297,"depth":4,"pids":"2297,3647,3782,3783","price":0.00,"addprice":0.00,"time":0},"id_3784":{"id":3784,"name":"东座","pid":3782,"a_id":2297,"depth":4,"pids":"2297,3647,3782,3784","price":0.00,"addprice":0.00,"time":0},"id_3785":{"id":3785,"name":"T - 天发大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3785","val":"天发大厦","price":0.00,"addprice":0.00,"time":0},"id_3786":{"id":3786,"name":"AB座","pid":3785,"a_id":2297,"depth":4,"pids":"2297,3647,3785,3786","price":0.00,"addprice":0.00,"time":0},"id_3787":{"id":3787,"name":"CD座","pid":3785,"a_id":2297,"depth":4,"pids":"2297,3647,3785,3787","price":0.00,"addprice":0.00,"time":0},"id_3788":{"id":3788,"name":"T - 天展大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3788","val":"天展大厦","price":0.00,"addprice":0.00,"time":0},"id_3789":{"id":3789,"name":"AB座","pid":3788,"a_id":2297,"depth":4,"pids":"2297,3647,3788,3789","price":0.00,"addprice":0.00,"time":0},"id_3790":{"id":3790,"name":"CD座","pid":3788,"a_id":2297,"depth":4,"pids":"2297,3647,3788,3790","price":0.00,"addprice":0.00,"time":0},"id_3791":{"id":3791,"name":"T - 天经大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3791","val":"天经大厦","price":0.00,"addprice":0.00,"time":0},"id_3792":{"id":3792,"name":"AB座","pid":3791,"a_id":2297,"depth":4,"pids":"2297,3647,3791,3792","price":0.00,"addprice":0.00,"time":0},"id_3793":{"id":3793,"name":"CD座","pid":3791,"a_id":2297,"depth":4,"pids":"2297,3647,3791,3793","price":0.00,"addprice":0.00,"time":0},"id_3794":{"id":3794,"name":"T - 天济大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3794","val":"天济大厦","price":0.00,"addprice":0.00,"time":0},"id_3795":{"id":3795,"name":"AB座","pid":3794,"a_id":2297,"depth":4,"pids":"2297,3647,3794,3795","price":0.00,"addprice":0.00,"time":0},"id_3796":{"id":3796,"name":"CD座","pid":3794,"a_id":2297,"depth":4,"pids":"2297,3647,3794,3796","price":0.00,"addprice":0.00,"time":0},"id_3797":{"id":3797,"name":"T - 天吉大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3797","val":"天吉大厦","price":0.00,"addprice":0.00,"time":0},"id_3798":{"id":3798,"name":"AB座","pid":3797,"a_id":2297,"depth":4,"pids":"2297,3647,3797,3798","price":0.00,"addprice":0.00,"time":0},"id_3799":{"id":3799,"name":"CD座","pid":3797,"a_id":2297,"depth":4,"pids":"2297,3647,3797,3799","price":0.00,"addprice":0.00,"time":0},"id_3800":{"id":3800,"name":"T - 天祥大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3800","val":"天祥大厦","price":0.00,"addprice":0.00,"time":0},"id_3801":{"id":3801,"name":"AB座","pid":3800,"a_id":2297,"depth":4,"pids":"2297,3647,3800,3801","price":0.00,"addprice":0.00,"time":0},"id_3802":{"id":3802,"name":"CD座","pid":3800,"a_id":2297,"depth":4,"pids":"2297,3647,3800,3802","price":0.00,"addprice":0.00,"time":0},"id_3803":{"id":3803,"name":"C - 创新科技广场1期","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3803","val":"创新科技广场1期","price":0.00,"addprice":0.00,"time":0},"id_3804":{"id":3804,"name":"A座","pid":3803,"a_id":2297,"depth":4,"pids":"2297,3647,3803,3804","price":0.00,"addprice":0.00,"time":0},"id_3805":{"id":3805,"name":"B座","pid":3803,"a_id":2297,"depth":4,"pids":"2297,3647,3803,3805","price":0.00,"addprice":0.00,"time":0},"id_3806":{"id":3806,"name":"C - 创业科技园","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3806","val":"创业科技园","price":0.00,"addprice":0.00,"time":0},"id_3807":{"id":3807,"name":"A座","pid":3806,"a_id":2297,"depth":4,"pids":"2297,3647,3806,3807","price":0.00,"addprice":0.00,"time":0},"id_3808":{"id":3808,"name":"B座","pid":3806,"a_id":2297,"depth":4,"pids":"2297,3647,3806,3808","price":0.00,"addprice":0.00,"time":0},"id_3809":{"id":3809,"name":"J - 劲松大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3809","val":"劲松大厦","price":0.00,"addprice":0.00,"time":0},"id_3810":{"id":3810,"name":"本栋","pid":3809,"a_id":2297,"depth":4,"pids":"2297,3647,3809,3810","price":0.00,"addprice":0.00,"time":0},"id_3811":{"id":3811,"name":"Z - 中联大厦306栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3811","val":"中联大厦306栋","price":0.00,"addprice":0.00,"time":0},"id_3812":{"id":3812,"name":"本栋","pid":3811,"a_id":2297,"depth":4,"pids":"2297,3647,3811,3812","price":0.00,"addprice":0.00,"time":0},"id_3813":{"id":3813,"name":"T - 泰然305栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3813","val":"泰然305栋","price":0.00,"addprice":0.00,"time":0},"id_3814":{"id":3814,"name":"本栋","pid":3813,"a_id":2297,"depth":4,"pids":"2297,3647,3813,3814","price":0.00,"addprice":0.00,"time":0},"id_3815":{"id":3815,"name":"T - 泰然304栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3815","val":"泰然304栋","price":0.00,"addprice":0.00,"time":0},"id_3816":{"id":3816,"name":"西座","pid":3815,"a_id":2297,"depth":4,"pids":"2297,3647,3815,3816","price":0.00,"addprice":0.00,"time":0},"id_3817":{"id":3817,"name":"东座","pid":3815,"a_id":2297,"depth":4,"pids":"2297,3647,3815,3817","price":0.00,"addprice":0.00,"time":0},"id_3818":{"id":3818,"name":"T - 泰然303栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3818","val":"泰然303栋","price":0.00,"addprice":0.00,"time":0},"id_3819":{"id":3819,"name":"西座","pid":3818,"a_id":2297,"depth":4,"pids":"2297,3647,3818,3819","price":0.00,"addprice":0.00,"time":0},"id_3820":{"id":3820,"name":"东座","pid":3818,"a_id":2297,"depth":4,"pids":"2297,3647,3818,3820","price":0.00,"addprice":0.00,"time":0},"id_3821":{"id":3821,"name":"T - 泰然302栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3821","val":"泰然302栋","price":0.00,"addprice":0.00,"time":0},"id_3822":{"id":3822,"name":"西座","pid":3821,"a_id":2297,"depth":4,"pids":"2297,3647,3821,3822","price":0.00,"addprice":0.00,"time":0},"id_3823":{"id":3823,"name":"东座","pid":3821,"a_id":2297,"depth":4,"pids":"2297,3647,3821,3823","price":0.00,"addprice":0.00,"time":0},"id_3824":{"id":3824,"name":"T - 泰然301栋","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3824","val":"泰然301栋","price":0.00,"addprice":0.00,"time":0},"id_3825":{"id":3825,"name":"西座","pid":3824,"a_id":2297,"depth":4,"pids":"2297,3647,3824,3825","price":0.00,"addprice":0.00,"time":0},"id_3826":{"id":3826,"name":"东座","pid":3824,"a_id":2297,"depth":4,"pids":"2297,3647,3824,3826","price":0.00,"addprice":0.00,"time":0},"id_3827":{"id":3827,"name":"T - 天安数码时代广场","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3827","val":"天安数码时代广场","price":0.00,"addprice":0.00,"time":0},"id_3828":{"id":3828,"name":"A座","pid":3827,"a_id":2297,"depth":4,"pids":"2297,3647,3827,3828","price":0.00,"addprice":0.00,"time":0},"id_3829":{"id":3829,"name":"B座","pid":3827,"a_id":2297,"depth":4,"pids":"2297,3647,3827,3829","price":0.00,"addprice":0.00,"time":0},"id_3830":{"id":3830,"name":"N - NEO","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3830","val":"NEO","price":0.00,"addprice":0.00,"time":0},"id_3831":{"id":3831,"name":"A座","pid":3830,"a_id":2297,"depth":4,"pids":"2297,3647,3830,3831","price":0.00,"addprice":0.00,"time":0},"id_3832":{"id":3832,"name":"B座","pid":3830,"a_id":2297,"depth":4,"pids":"2297,3647,3830,3832","price":0.00,"addprice":0.00,"time":0},"id_3833":{"id":3833,"name":"C座","pid":3830,"a_id":2297,"depth":4,"pids":"2297,3647,3830,3833","price":0.00,"addprice":0.00,"time":0},"id_3834":{"id":3834,"name":"A - 安徽大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3834","val":"安徽大厦","price":0.00,"addprice":0.00,"time":0},"id_3835":{"id":3835,"name":"本栋","pid":3834,"a_id":2297,"depth":4,"pids":"2297,3647,3834,3835","price":0.00,"addprice":0.00,"time":0},"id_3836":{"id":3836,"name":"Z - 招商银行总部","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3836","val":"招商银行总部","price":0.00,"addprice":0.00,"time":0},"id_3837":{"id":3837,"name":"本栋","pid":3836,"a_id":2297,"depth":4,"pids":"2297,3647,3836,3837","price":0.00,"addprice":0.00,"time":0},"id_3838":{"id":3838,"name":"D - 东海国际大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3838","val":"东海国际大厦","price":0.00,"addprice":0.00,"time":0},"id_3839":{"id":3839,"name":"A座","pid":3838,"a_id":2297,"depth":4,"pids":"2297,3647,3838,3839","price":0.00,"addprice":0.00,"time":0},"id_3840":{"id":3840,"name":"B座","pid":3838,"a_id":2297,"depth":4,"pids":"2297,3647,3838,3840","price":0.00,"addprice":0.00,"time":0},"id_3841":{"id":3841,"name":"S - 时代科技大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3841","val":"时代科技大厦","price":0.00,"addprice":0.00,"time":0},"id_3842":{"id":3842,"name":"西座","pid":3841,"a_id":2297,"depth":4,"pids":"2297,3647,3841,3842","price":0.00,"addprice":0.00,"time":0},"id_3843":{"id":3843,"name":"东座","pid":3841,"a_id":2297,"depth":4,"pids":"2297,3647,3841,3843","price":0.00,"addprice":0.00,"time":0},"id_3844":{"id":3844,"name":"Y - 阳光高尔夫大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3844","val":"阳光高尔夫大厦","price":0.00,"addprice":0.00,"time":0},"id_3845":{"id":3845,"name":"本栋","pid":3844,"a_id":2297,"depth":4,"pids":"2297,3647,3844,3845","price":0.00,"addprice":0.00,"time":0},"id_3846":{"id":3846,"name":"F - 富春东方大厦","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3846","val":"富春东方大厦","price":0.00,"addprice":0.00,"time":0},"id_3847":{"id":3847,"name":"本栋","pid":3846,"a_id":2297,"depth":4,"pids":"2297,3647,3846,3847","price":0.00,"addprice":0.00,"time":0},"id_3848":{"id":3848,"name":"C - 财富广场","pid":3647,"a_id":2297,"depth":3,"pids":"2297,3647,3848","val":"财富广场","price":0.00,"addprice":0.00,"time":0},"id_3849":{"id":3849,"name":"A座","pid":3848,"a_id":2297,"depth":4,"pids":"2297,3647,3848,3849","price":0.00,"addprice":0.00,"time":0},"id_3850":{"id":3850,"name":"B座","pid":3848,"a_id":2297,"depth":4,"pids":"2297,3647,3848,3850","price":0.00,"addprice":0.00,"time":0},"id_3881":{"id":3881,"name":"八卦岭","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3881","price":0.00,"addprice":0.00,"time":0},"id_3882":{"id":3882,"name":"福民新村","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3882","price":0.00,"addprice":0.00,"time":0},"id_3883":{"id":3883,"name":"彩田村、公交大厦","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3883","price":0.00,"addprice":0.00,"time":0},"id_3884":{"id":3884,"name":"福滨南、赤尾、南华","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3884","price":0.00,"addprice":0.00,"time":0},"id_3885":{"id":3885,"name":"福田保税区","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3885","price":0.00,"addprice":0.00,"time":0},"id_3886":{"id":3886,"name":"福田党校、车管所","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3886","price":0.00,"addprice":0.00,"time":0},"id_3887":{"id":3887,"name":"福田口岸、渔农村","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3887","price":0.00,"addprice":0.00,"time":0},"id_3888":{"id":3888,"name":"岗厦","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3888","price":0.00,"addprice":0.00,"time":0},"id_3889":{"id":3889,"name":"岗厦北","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3889","price":0.00,"addprice":0.00,"time":0},"id_3890":{"id":3890,"name":"海滨广场","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3890","price":0.00,"addprice":0.00,"time":0},"id_3891":{"id":3891,"name":"华强北-百花路","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3891","price":0.00,"addprice":0.00,"time":0},"id_3892":{"id":3892,"name":"华强北-女人世界","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3892","price":0.00,"addprice":0.00,"time":0},"id_3893":{"id":3893,"name":"华强北-群星广场","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3893","price":0.00,"addprice":0.00,"time":0},"id_3894":{"id":3894,"name":"华强北-赛格广场","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3894","price":0.00,"addprice":0.00,"time":0},"id_3895":{"id":3895,"name":"华强北-远望数码城","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3895","price":0.00,"addprice":0.00,"time":0},"id_3896":{"id":3896,"name":"华强北-钟表市场","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3896","price":0.00,"addprice":0.00,"time":0},"id_3897":{"id":3897,"name":"华强南","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3897","price":0.00,"addprice":0.00,"time":0},"id_3898":{"id":3898,"name":"皇岗、水围","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3898","price":0.00,"addprice":0.00,"time":0},"id_3899":{"id":3899,"name":"皇岗口岸","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3899","price":0.00,"addprice":0.00,"time":0},"id_3900":{"id":3900,"name":"警校片区","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3900","price":0.00,"addprice":0.00,"time":0},"id_3901":{"id":3901,"name":"莲花北","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3901","price":0.00,"addprice":0.00,"time":0},"id_3902":{"id":3902,"name":"沙河工业区","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3902","price":0.00,"addprice":0.00,"time":0},"id_3903":{"id":3903,"name":"上梅林","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3903","price":0.00,"addprice":0.00,"time":0},"id_3904":{"id":3904,"name":"石厦","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3904","price":0.00,"addprice":0.00,"time":0},"id_3905":{"id":3905,"name":"田面","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3905","price":0.00,"addprice":0.00,"time":0},"id_3906":{"id":3906,"name":"香蜜湖","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3906","price":0.00,"addprice":0.00,"time":0},"id_3907":{"id":3907,"name":"新洲","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3907","price":0.00,"addprice":0.00,"time":0},"id_3908":{"id":3908,"name":"园博园","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3908","price":0.00,"addprice":0.00,"time":0},"id_3909":{"id":3909,"name":"园岭","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3909","price":0.00,"addprice":0.00,"time":0},"id_3910":{"id":3910,"name":"竹子林","pid":2297,"a_id":2297,"depth":2,"pids":"2297,3910","price":0.00,"addprice":0.00,"time":0},"id_3914":{"id":3914,"name":"cccc","pid":3882,"a_id":2297,"depth":3,"pids":"2297,3882,3914","price":0.00,"addprice":0.00,"time":0},"id_3915":{"id":3915,"name":"dsdd","pid":3881,"a_id":2297,"depth":3,"pids":"2297,3881,3915","price":0.00,"addprice":0.00,"time":0},"id_2298":{"id":2298,"name":"南山区","pid":0,"a_id":2298,"depth":1,"pids":2298,"price":0.00,"addprice":0.00,"time":0},"id_3916":{"id":3916,"name":"白石州","pid":2298,"a_id":2298,"depth":2,"pids":"2298,3916","price":0.00,"addprice":0.00,"time":0}};//对应id地区详细信息
        jscartlist.depth = 4;//当前地区深度
        jscartlist.init(thisdata);
        jscartlist.order_verify = kj.toint("0");
        jscartlist.info_seldefault('2297,3647,3655');
        if('191' != '') {
            jscartlist.infosel(kj.obj("#id_info_radior191") ,"191");
        } else {
            jscartlist.refresh_price();
        }
    });
</script>
</div>
</div>
<div class="footer">
    <a href="./index.php?app_act=help">关于我们</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./index.php?app_act=reg.shop">诚邀加盟</a>&nbsp;&nbsp;&nbsp;&nbsp;<a
        href="./index.php?app_act=msg">意见反馈</a><br>
    CopyRight &copy 2014 <a href="/" target="_blank">叫啥网</a> 版权所有
</div>
<div class="qrcode" id="id_qrcode"><img src="/images/kjcms.jpg"></div>

<script>
    var jsfooter = new function() {
        this.align_height = function() {
            var objright = kj.obj("#id_right");
            var objleft = kj.obj("#id_left");
            if(!objright || !objleft) return;
            kj.set("#id_left","style.height" , "auto");
            kj.set("#id_right","style.height" , "auto");
            var h_left = kj.h("#id_left");
            var h_right = kj.h("#id_right");
            (h_left>h_right) ? kj.set("#id_right",'style.height' , h_left+"px") : kj.set("#id_left",'style.height' , h_right+"px");
        }
    }
    jsfooter.align_height();
    var w = (kj.w()-980)/2;
    w = w+980+50;
    kj.set("#id_qrcode" , 'style.left', w+'px');
</script></body>
</html>