<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobile_otp {  
    public function sendmobilemessage($phone_number,$message_string) {  
        /*$url 	=   "http://login.rock2connect.com/MOBILE_APPS_API/sms_api.php?type=smsquicksend&user=ADVITS&pass=Advit2019&sender=ADVITS&to_mobileno=".$phone_number."&sms_text=".$message_string;
        $ulr    =   ($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_URL, $ulr);
        $result = curl_exec($ch);
        $error  = curl_error($ch); 
        curl_close($ch);
        $obj 	= json_decode($result);    
        if($obj->status_id == "success_1002"){
            return TRUE; 
        }
        return FALSE;*/
       // $url ="http://login4.spearuc.com/MOBILE_APPS_API/sms_api.php?type=smsquicksend&user=CHFSPT&pass=Advit2019&sender=OTPMsg&to_mobileno=".$phone_number."&sms_text=".$message_string;
        $message = $message_string; //str_replace(" ","%20", $message_string);
        //$url = 'https://www.smsalert.co.in/api/push.json?apikey=5c61c3d73641f&route=transactional&sender=MINIKT&mobileno='.$phone_number.'&text='.$message;
        //http://www.smsalert.co.in/api/push.json?apikey=5c61c3d73641f&route=transactional&sender=MINIKT&mobileno=9700775575&text=Dear%2520Customer%252C%255CnYour%2520OTP%2520verification%2520key%2520%253A%2520%257B%2523var%2523%257D%2520Minikart%2520which%2520expires%2520in%252010%2520mins%255Cn
        //$url = 'http://www.smsalert.co.in/api/push.json?apikey=5c61c3d73641f&route=transactional&sender=MINIKT&mobileno='.$phone_number.'&text='.$message_string;
        $url= "https://www.smsalert.co.in/api/push.json?apikey=5c61c3d73641f&route=transactional&sender=MINIKT&mobileno=".$phone_number."&text=".$message_string."";
       // print_r($url);exit;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
              'Cookie: __cfduid=d43e9afe19a82c3b968648e34e78999271617879961'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}  