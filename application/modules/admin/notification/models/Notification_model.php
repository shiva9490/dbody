<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Notification_model extends CI_Model{
        public function queryNotification($params = array()){
                $dta =  array(
                    "notification_open"   =>  "1",
                    "notification_status" =>  "1"
                );
                $sel   =    "*";
                if(array_key_exists("cnt",$params)){
                        $sel    =   "count(*) as cnt";
                }
                if(array_key_exists("columns",$params)){
                        $sel    =   $params["columns"];
                }
                $this->db->select("$sel")
                        ->from("notifications") 
                        ->where($dta);
                if(array_key_exists("where_condition",$params)){
                        $this->db->where("(".$params["where_condition"].")");
                } 
                if(array_key_exists("keywords",$params)){
                        $this->db->where("(notification_title LIKE '%".$params["keywords"]."%')");
                } 
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }
                if(array_key_exists("tipoOrderby",$params) && array_key_exists("order_by",$params)){
                    $this->db->order_by($params['tipoOrderby'],$params['order_by']);
                }
                //$this->db->get();echo $this->db->last_query();exit;
                return  $this->db->get();
        }
        public function cntviewNotification($params = array()){
                $params["cnt"]  =   1;
                $vsp    =   $this->queryNotification($params)->row_array();
                if(count($vsp) > 0){
                        return $vsp['cnt'];
                }
                return 0;
        }
        public function viewNotifications($params = array()){
                return  $this->queryNotification($params)->result();
        }
        public function viewNotificationdata($params = array()){
            $imagepath  =   $this->config->item("upload_url")."notification-uploads/"; 
            $params["tipoOrderby"]  =   "notificationid";
            $params["order_by"]  =   "DESC";
            $params["columns"]   =   "notification_title,CONCAT('".$imagepath."',notification_image) as notification_image";
            return  $this->queryNotification($params)->result();
        }
        public function getNotification($uri){
                $pms["where_condition"]     =   "notification_id LIKE '".$uri."'";
                return $this->queryNotification($pms)->row_array();
        }
        public function createNotification(){
                $vsp    =   date("Y-m-d",strtotime('+ 100 Years')); 
                $dta    =   array(
                        "notification_id"      =>  $this->common_model->get_max("notificationid","notifications")."BNNR", 
                        "notification_title"   =>   ($this->input->post("notification_title"))??'',
                        "notification_cr_on"   =>   date("Y-m-d h:i:s"), 
                        "notification_cr_by"   =>   $this->session->userdata("login_id")
                );
                if(count($_FILES) > 0){
                    $target_dir =   $this->config->item("uploads_path")."notification-uploads/";
                    $fname      =   $_FILES["notification_image"]["name"];
                    if($fname != "noname"){
                        $vsp        =   explode(".",$fname);
                        $fname      =   "BAN_".time().".".$vsp['1'];
                        $uploadfile =   $target_dir . basename($fname);
                        $vsp 	=	move_uploaded_file($_FILES['notification_image']['tmp_name'], $uploadfile); 
                        if($vsp){
                            $dta['notification_image'] =   $fname;
                        }
                    }
                } 
                $this->db->insert("notifications",$dta);
                if($this->db->insert_id() >  0){
                        $this->transaction_log->save_log("Added Notifications","Notifications","Add","",$this->session->userdata("login_id"));
                        return TRUE;
                }
                return FALSE;
        }
        public function updateNotification($uri){
                $dta    =   array( 
                        "notification_title"   =>   $this->input->post("notification_title"), 
                        "notification_md_on"   =>   date("Y-m-d h:i:s"),  
                        "notification_md_by"   =>   $this->session->userdata("login_id")
                ); 
                if(count($_FILES) > 0){
                    $target_dir =   $this->config->item("uploads_path")."notification-uploads/";
                    $fname      =   $_FILES["notification_image"]["name"];
                    if($fname != ""){
                        $vsp        =   explode(".",$fname);
                        $fname      =   "BAN_".time().".".$vsp['1'];
                        $uploadfile =   $target_dir . basename($fname);
                        $vsp 	=	move_uploaded_file($_FILES['notification_image']['tmp_name'], $uploadfile); 
                        if($vsp){
                            $dta['notification_image'] =   $fname;
                        }
                    }
                }   
                $this->db->update("notifications",$dta,array("notification_id" => $uri));
              // echo $this->db->last_query();exit;
               
                if($this->db->affected_rows() >  0){
                        $this->transaction_log->save_log("Update Notifications","Notifications","Update","",$this->session->userdata("login_id"));
                        return TRUE;
                }
                return FALSE;
        }
        public function deletenotification($uri){
                $dta    =   array( 
                        "notification_open"    =>  0,
                        "notification_md_on"   =>   date("Y-m-d h:i:s"), 
                        "notification_md_by"   =>   $this->session->userdata("login_id")
                );
                $this->db->update("notifications",$dta,array("notification_id" => $uri));
                if($this->db->affected_rows() >  0){
                        $this->transaction_log->save_log("Deleted Notifications","Notifications","Delete","",$this->session->userdata("login_id"));
                        return TRUE;
                }
                return FALSE;
        }
        public function activedeactive($uri,$status){
                if($status=='Active'){
                    $dta    =   array( 
                                    "notification_abc"             =>    'Deactive',
                                    "notification_md_on"  =>    date("Y-m-d h:i:s"),
                                    "notification_md_by"    =>    $this->session->userdata("login_id")
                                );
                    $this->db->update("notifications",$dta);
                    
                }
                $dta    =   array( 
                                "notification_abc"             =>    $status,
                                "notification_md_on"  =>    date("Y-m-d h:i:s"),
                                "notification_md_by"    =>    $this->session->userdata("login_id")
                            );
                $this->db->update("notifications",$dta,array("notification_id" => $uri)); 
                $vsp    =    $this->db->affected_rows();
                if($vsp > 0){  
                    return TRUE;
                }
                return FALSE;
        }
}