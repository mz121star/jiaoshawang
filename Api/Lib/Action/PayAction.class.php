<?php

class PayAction extends Action {
    
    private $appkey = 'sk_test_vfXrX540Oa1GbzjLuDS8G0G0';
    
    private $appid = 'app_u1Kmr9rrTG00mT4O';

    /*
     * call example : http://yourservername/api.php/pay/pay
     * call method : post
     * 付款
     */
    public function pay_post(){
        require_once(dirname(__FILE__) . '/../../../Pingpp/Pingpp.php');
        $input_data = json_decode(file_get_contents("php://input"), true);
        if (empty($input_data['channel']) || empty($input_data['amount'])) {
            $this->response(array('message' => '支付信息不全'), 'json');
        }
        $channel = strtolower($input_data['channel']);
        $amount = $input_data['amount'] * 100;
//        $orderNo = substr(md5(time()), 0, 12);
        $orderNo = $input_data['orderno'];

        //$extra 在渠道为 upmp_wap 和 alipay_wap 时，需要填入相应的参数，具体见技术指南。其他渠道时可以传空值也可以不传。
        $extra = array();
        switch ($channel) {
            case 'alipay_wap':
                $extra = array(
                    'success_url' => 'http://'.$_SERVER["SERVER_NAME"].'/api.php/pay/success',
                    'cancel_url' => 'http://'.$_SERVER["SERVER_NAME"].'/api.php/pay/cancel'
                );
                break;
            case 'upmp_wap':
                $extra = array(
                    'result_url' => 'http://'.$_SERVER["SERVER_NAME"].'/api.php/pay/result?code='
                );
                break;
        }

        Pingpp::setApiKey($this->appkey);
        $ch = Pingpp_Charge::create(
            array(
                "subject"        => "Test Subject",
                "body"             => "Test Body",
                "amount"       => $amount,
                "order_no"    => $orderNo,
                "currency"     => "cny",
                "extra"            => $extra,
                "channel"      => $channel,
                "client_ip"    => $_SERVER["REMOTE_ADDR"],
                "app"               => array("id" => $this->appid)
            )
        );

        echo $ch;exit;
    }
    
    public function success_get() {
        $this->response(array('message' => '支付成功'), 'json');
    }
    public function cancel_get() {
        $this->response(array('message' => '取消支付'), 'json');
    }
    public function result_get() {
        if (isset($_GET['code'])) {
            echo '银联：';
            $code = $_GET['code'];
            if ($code == 0) {
                echo '支付成功';
            } else if($code == 1) {
                echo '支付失败';
            } else if($code == -1) {
                echo '支付取消';
            } else {
                echo '未知错误('.$code.')';
            }
        } else {
            echo '支付宝：支付成功';
        }
    }
    
    /*
     * call example : http://yourservername/api.php/pay/notify
     * call method : post
     * 付款后的通知回调
     */
    public function notify_post() {
        $input_data = json_decode(file_get_contents("php://input"), true);
        if ($input_data['object'] == 'charge') {
            //TODO update database
            echo 'success';
        } else if($input_data['object'] == 'refund') {
            //TODO update database
            echo 'success';
        } else {
            echo 'fail';
        }
    }
    
    /*
     * call example : http://yourservername/api.php/pay/refund
     * call method : post
     * 退款
     */
    public function refund_post() {
        require_once(dirname(__FILE__) . '/../../../Pingpp/Pingpp.php');
        Pingpp::setApiKey($this->appkey);
        $ch = Pingpp_Charge::retrieve("ch_id");
        $ch->refunds->create(
            array(
                "amount" => 10,
                "description" => "apple"
            )
        );
    }
    
    /*
     * call example : http://yourservername/api.php/pay/retrieve
     * call method : post
     * 交易查询
     */
    public function retrieve_post() {
        require_once(dirname(__FILE__) . '/../../../Pingpp/Pingpp.php');
        Pingpp::setApiKey($this->appkey);
        $ch = Pingpp_Charge::retrieve("ch_id");
    }
    
    /*
     * call example : http://yourservername/api.php/pay/over
     * call method : post
     * 交易完成后的回调
     */
    public function over_post() {
        require_once(dirname(__FILE__) ."/../../../Alipay/alipay.config.php");
        require_once(dirname(__FILE__) ."/../../../Alipay/lib/alipay_notify.class.php");

        //计算得出通知验证结果
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/upload/order.txt', 'verify_result : '.$verify_result.'======out_trade_no : '.$out_trade_no.'====trade_no : '.$trade_no.'=====trade_status : '.$trade_status."\n\n");
        if($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代

            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——

            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表

            //商户订单号
            $out_trade_no = $_POST['out_trade_no'];
            //支付宝交易号
            $trade_no = $_POST['trade_no'];
            //交易状态
            $trade_status = $_POST['trade_status'];
            if($_POST['trade_status'] == 'TRADE_FINISHED') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //如果有做过处理，不执行商户的业务程序

                //注意：
                //该种交易状态只在两种情况下出现
                //1、开通了普通即时到账，买家付款成功后。
                //2、开通了高级即时到账，从该笔交易成功时间算起，过了签约时的可退款时限（如：三个月以内可退款、一年以内可退款等）后。

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
            } else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //如果有做过处理，不执行商户的业务程序

                //注意：
                //该种交易状态只在一种情况下出现——开通了高级即时到账，买家付款成功后。
                $order = M('order');
                $orderinfo = $order->where('id = "'.$out_trade_no.'"')->find();
                if ($orderinfo) {
                    file_put_contents($_SERVER['DOCUMENT_ROOT'].'/upload/order.txt', "test\n");
                    $update = array('order_paystatus'=>'2', 'order_trade_no'=>$trade_no);
                    $order->where('id = "'.$out_trade_no.'"')->setField($update);
                }
                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
            }

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
            echo "success";  //请不要修改或删除
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        } else {
            //验证失败
            echo "fail";

            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }
    }
}