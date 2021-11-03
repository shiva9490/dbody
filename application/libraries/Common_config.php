<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
class Common_config{
    
        public function configemail($toemail,$subject,$messge){
            $ci     =   &get_instance();  
                $ci->load->library("email"); 
                $fromemail  =   sitedata("site_email");
                $config     =   array(
                                'protocol'    =>  'smtp', 
                                'smtp_user'   =>  $fromemail,
                                'smtp_host'   =>  sitedata("site_host"),
                                'smtp_pass'   =>  sitedata("site_emailpassword"),
                                'smtp_port'   =>  sitedata("site_port"), 
                                'wordwrap'  =>    TRUE,
                                'mailtype'  =>    'html'
                            );
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                
                // More headers
                $headers    .= 'From: ' .$fromemail. "\r\n";
                //$toemail    =   "swetha@advitsoft.com";
                $mail       =   mail($toemail,$subject,$messge,$headers);
                /*
                $ci->email->initialize($config); 
                $ci->email->to($toemail);
                $ci->email->from($fromemail, "Administrator");
                $ci->email->subject($subject);
                $ci->email->message($messge);
                $mail   =   $ci->email->send(); */
                if($mail){
                    return true;
                }
                return false;
        }
        

        function get_client_ip(){
            $ipaddress = '';
            if (getenv('HTTP_CLIENT_IP'))
                $ipaddress = getenv('HTTP_CLIENT_IP');
            else if(getenv('HTTP_X_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            else if(getenv('HTTP_X_FORWARDED'))
                $ipaddress = getenv('HTTP_X_FORWARDED');
            else if(getenv('HTTP_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_FORWARDED_FOR');
            else if(getenv('HTTP_FORWARDED'))
               $ipaddress = getenv('HTTP_FORWARDED');
            else if(getenv('REMOTE_ADDR'))
                $ipaddress = getenv('REMOTE_ADDR');
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
        }
        
        public function removeNonUtf8($string){
            $ci     =   &get_instance();
            $string = str_replace(array('[\', \']'), '', $string);
            $string = preg_replace('/\[.*\]/U', '', $string);
            $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
            $string = htmlentities($string, ENT_COMPAT, 'utf-8');
            $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
            $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
            return $string;
	    }
	    public function RemoveSpecialChar($str) {
            $res = str_replace( array( '\'', '"',',' , ';', '<', '>' ), '', $str);
            return $res;
        }
	    
	    
	    public function send_pushnotifications($title,$message,$mobileno = 0){
            $ci     =   &get_instance();
            $ci->load->database(); 
            $tokens		=	$ci->db->get_where("tokens",array("token_open" => '1'))->result(); 
            if($mobileno != '0'){
                $tokens		=	$ci->db->get_where("tokens",array("token_open" => '1',"token_mobile" => $mobileno))->result();
            }
            if(count($tokens) > 0){
                $offset =   0; 
                while($offset <= count($tokens)){
                    $dtokens		=	$ci->db->get_where("tokens",array("token_open" => '1'), '1000', $offset)->result();
                    if($mobileno != '0'){
                        $dtokens		=	$ci->db->get_where("tokens",array("token_open" => '1',"token_mobile" => $mobileno))->result();
                    } 
                     //echo "<pre>";print_r($dtokens);exit;
                    $d_name     = array();
                    foreach($dtokens as $tu){
                        $d_name[]	=	$tu->token_name;
                    }
                    $url        =   'https://fcm.googleapis.com/fcm/send';
                    $priority   =   "high";
                    $notification   = array('title' => $title,'body' => $message);
                    $fields = array(
                            'registration_ids'  => $d_name,
                            'notification'      => $notification 
                    );
                    $headers = array(
                        'Authorization:key=AAAARP_RCyk:APA91bG6f-XWioFKdcgMdGCvsrBhXBiICbVqbvHJEdj_uJlkiv45H7_Y6URsUeViVq--iN5p0b5twqW4eRl3ZJqJ_FvlA0uUXTQxKUIyYQeWfuR2C08uVwOL7lQ6k8U1l1VLeSByPXm7',
                        'Content-Type: application/json'
                    ); 
                   $ch = curl_init();
                   curl_setopt($ch, CURLOPT_URL, $url);
                   curl_setopt($ch, CURLOPT_POST, true);
                   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                   curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
                   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                    // echo json_encode($fields);
                   $result = curl_exec($ch);    
                    if ($result === FALSE) {
                       die('Curl failed: ' . curl_error($ch));
                    }
                    $vspr    =   json_decode($result,true);
                    $res = array();
                    $res['notification_name']       = $title;
                    $res['notification_text']       = $message;
                    $res['notification_response']   = $result;
                    $res['notification_token']      = $mobileno;
                    $res['notification_date']       = date('Y-m-d H:i:s a');
                    $ci->db->insert('notification',$res);
                    $vrfg =  array();
                    if(count($vspr) > 0){
                        $vsfr =  $vspr['results'];
                        foreach($vsfr as $key => $byh){
                            if(array_key_exists("error",$byh)){
                                if($byh['error'] == 'NotRegistered'){
                                    array_push($vrfg,$key);
                                }
                            }
                        }
                        foreach($d_name as $keu =>  $dtu){
                            if(in_array($keu,$vrfg)){
                                $ci->db->update("tokens",array("token_open" => '0',"token_update" => date("Y-m-d H:i:s")),array("token_name" => $dtu));
                            }
                        }
                    }
                    curl_close($ch); 
                    $offset =    $offset+1000; 
                } 
                return $result;
            }return $mobileno;
	    }
	    public function orderemail($toemail,$subject,$message){
            $ci     =   &get_instance();  
            $ci->load->library("email"); 
            $fromemail  = 'orders@minikart.in';   //sitedata("site_email");
            $config     =   array(
                    'protocol'    =>  'smtp', 
                    'smtp_user'   =>  $fromemail,
                    'smtp_host'   =>  'mail.minikart.in', //sitedata("site_host"),
                    'smtp_pass'   =>  'Minikart@2020#', //sitedata("site_emailpassword"),
                    'smtp_port'   =>  '465', 
                    'wordwrap'  =>    TRUE,
                    'mailtype'  =>    'html'
                ); 
            /*$ci->email->initialize($config); 
            $ci->email->to($toemail);
            $ci->email->from($fromemail, "Administrator");
            $ci->email->subject($subject);
            $ci->email->message($messge);
            $mail   =   $ci->email->send(); */
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers    .= 'From: ' .$fromemail. "\r\n";
            $toemail    =   $toemail;
            $mail       =   mail($toemail,$subject,$message,$headers);
            // print_r($mail);exit;
            if($mail){
                return true;
            }
            return false;

        }
        public function orderadminemail($toemail,$subject,$message){
            $ci     =   &get_instance();  
            $ci->load->library("email"); 
            $fromemail  = 'minikartorders@gmail.com';   //sitedata("site_email");
            $config     =   array(
                'protocol'    =>  'smtp', 
                'smtp_user'   =>  $fromemail,
                'smtp_host'   =>  'smtp.gmail.com', //sitedata("site_host"),
                'smtp_pass'   =>  'Minikart@2021', //sitedata("site_emailpassword"),
                'smtp_port'   =>  '465', 
                'wordwrap'  =>    TRUE,
                'mailtype'  =>    'html'
            );
            //$this->email->set_mailtype("html");
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers    .= 'From: ' .$fromemail. "\r\n";
            $toemails1 = 'minikartorders@gmail.com';
            $toemails2 = 'info@minikart.in';
            //$mail       =   mail('nareshchary123789@gmail.com',$subject,$message,$headers);
            $mail1       =   mail($toemails1,$subject,$message,$headers);
            $mail23       =   mail($toemails2,$subject,$message,$headers);
            if($mail1 && $mail23){
                return true;
            }
            return false;
        }
}