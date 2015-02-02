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
}