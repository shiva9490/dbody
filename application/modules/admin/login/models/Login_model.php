<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Login_model extends CI_Model{
        public  function  check_login(){ 
                $parms['where_condition']   =   "(l.login_name='".$this->input->post("username")."' OR login_email ='".$this->input->post("username")."') AND l.login_password = '".base64_encode($this->input->post("password"))."' AND l.login_acde = '1'";
                $vsp    =    $this->query_users($parms)->row();  
                if(count(array($vsp)) > 0){ 
                    $ins   =   $vsp;
                    $this->session->set_userdata("login_id",$ins->login_id);
                    $this->session->set_userdata("login_name",$ins->login_name);
                    $this->session->set_userdata("login_type",$ins->ut_id);
                    $this->session->set_userdata("ut_name",$ins->ut_name);
                    $login_type    =    $this->session->userdata("login_type");
                    $roles         =    $this->permission_model->get_permission($login_type);   
                    if(count($roles) > 0){
                            foreach($roles  as $vp){
                                    $this->session->set_userdata($vp->page_name,$vp->per_status);
                            }
                    }
                    return TRUE;
                }
                return FALSE;
        }
        public function  query_users($params = array()){
                $sel    =   "*";
                if(array_key_exists("cnt",$params)){
                        $sel    =   "count(*) as cnt";
                }
                if(array_key_exists('columns', $params)){
                        $sel    =   $params['columns'];
                }
                $dt     =   array( 
                        "l.login_open"      =>  '1', 
                        "l.login_status"    =>  '1', 
                        "ut.ut_status"  =>  '1', 
                        "ut.ut_open"    =>  '1'
                );
                $this->db->select("$sel")
                        ->from("login as l") 
                        ->join("usertype as ut","ut.ut_id = l.login_type","INNER") 
                        ->where($dt);
                if(array_key_exists('where_condition', $params)){
                        $this->db->where("(".$params['where_condition'].")");
                } 
                if(array_key_exists("keywords",$params)){
                        $this->db->where("(l.login_name LIKE '%".$params["keywords"]."%' OR ut.ut_name LIKE '%".$params["keywords"]."%'");
                }
                if(array_key_exists("uri",$params)){
                        $this->db->where("user_login_id",$params["uri"]);
                } 
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }
//                $this->db->get();echo $this->db->last_query();exit;
                return $this->db->get();
        }
        public function mail_check($uri){
                $parms['where_condition']   =   "l.login_email='".$uri."'";
                $vsp    =   $this->query_users($parms)->row();
                return  $vsp;
        }
        public  function  getUser($params = array()){
                $vsp    =   $this->query_users($params)->row_array();
        }
        public  function  forgot_password(){ 
                $subject    =   "Your Forgot Password";
                $to         =   $this->input->post("emailid");
                $valp       =   $this->mail_check($to); 
                $message    =   "Welcome to ".$this->config->item('site_name')."<br/><br/>".
                        "<b>Username:</b> ".$valp->login_name.
                        "<br/><b>Password:</b> ".base64_decode($valp->login_password)."<br/><br/>"
                        . "<b>Regards,</b><br/>"
                        . $this->config->item('site_name');
                // Always set content-type when sending HTML email
                $headers    =   "MIME-Version: 1.0" . "\r\n";
                $headers    .=  "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                $headers    .=  'From: <admin@vasantha.com>' . "\r\n"; 
                $val    =   mail($to,$subject,$message,$headers);
                return $val;
        }
        public function forgot_email($uir){
                $vsp    =   $this->mail_check($uir);
                if(count($vsp) > 0){
                        return "true";
                }
                return "false";   
        }
}