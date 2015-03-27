<?php

class SmsAction extends Action {

    /*
     * call example : http://yourservername/api.php/sms/send
     * call method : get
     */
    public function send_post(){
        $to = htmlspecialchars($_POST['phone']);
        $now = date('YmdHis');
        
        $softVersion = '2014-06-30';
        $appId = '344e70eb358b473493b0edcdcf88a37e';
        $accountSid = '043518e909d6103e10363dcbfb9e40f1';
        $authToken = '9ab4d68c077ef710628959e23491db4b';
        $templateId = '4124';

        $authorization = base64_encode($accountSid.':'.$now);
        $sig = md5($accountSid.$authToken.$now);
        $requestUrl = 'https://api.ucpaas.com/'.$softVersion.'/Accounts/'.$accountSid.'/Messages/templateSMS?sig='.$sig;

        $code = rand(100000, 999999);
//        session(array('name'=>'session_id','expire'=>3600));
//        session('smscode', $code);
        $templateSMS = json_encode(array('templateSMS' => array('appId' => $appId, 'param'=>'我的快送,'.$code.',3', 'to' => $to, 'templateId' => $templateId)));
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $requestUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $templateSMS);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: api.ucpaas.com', 'Accept:application/json', 'Content-Type:application/json;charset=utf-8', 'Authorization:'.$authorization));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $output = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($output, true);
        echo '<pre>';
        print_r($result);exit;
        if ($result['resp']['respCode'] == '000000') {
            $this->response(array('sms' => $code), 'json');
        } else {
            $this->response(array('sms' => '发送短信失败'), 'json');
        }
    }
}