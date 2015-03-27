<?php

class SmsAction extends Action {

    /*
     * call example : http://yourservername/api.php/sms/send
     * call method : get
     */
    public function send_post(){
        $to = htmlspecialchars($_POST['phone']);
        $type = htmlspecialchars($_POST['type']);
        $now = date('YmdHis');
        
        $softVersion = '2014-06-30';
        $appId = '344e70eb358b473493b0edcdcf88a37e';
        $accountSid = '043518e909d6103e10363dcbfb9e40f1';
        $authToken = '9ab4d68c077ef710628959e23491db4b';

        $authorization = base64_encode($accountSid.':'.$now);
        $sig = strtoupper(md5($accountSid.$authToken.$now));
        $requestUrl = 'https://api.ucpaas.com/'.$softVersion.'/Accounts/'.$accountSid.'/Messages/templateSMS?sig='.$sig;

        $code = rand(100000, 999999);
        $param = '';
        $templateId = '';
        if ($type == 'reg') {
            $param = '我的快送,'.$code.',2';
            $templateId = '4124';
        } else if ($type == 'order') {
            $param = $code;
            $templateId = '4596';
        }
//        session(array('name'=>'session_id','expire'=>3600));
//        session('smscode', $code);
        $templateSMS = json_encode(array('templateSMS' => array('appId' => $appId, 'param'=>$param, 'to' => $to, 'templateId' => $templateId)));
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $requestUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $templateSMS);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: api.ucpaas.com', 'Accept:application/json', 'Content-Type:application/json;charset=utf-8', 'Authorization:'.$authorization));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $response = curl_exec($ch);
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == '200') {
            $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            curl_close($ch);
            $responseBody = substr($response, $headerSize);
            
            $result = json_decode($responseBody, true);
            if ($result['resp']['respCode'] == '000000') {
                $this->response(array('statuscode' => 0, 'msg' => $code), 'json');
            } else {
                $this->response(array('statuscode' => 1, 'msg' => '发送短信失败'), 'json');
            }
        } else {
            curl_close($ch);
            $this->response(array('statuscode' => 2, 'msg' => '响应错误'), 'json');
        }
    }
}