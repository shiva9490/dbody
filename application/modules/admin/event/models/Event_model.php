<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Event_model extends CI_Model{
    public function queryEvent($params = array()){
        $dt         =   array(
                            "event_open"      =>     '1',
                    );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("event") 
                    ->where($dt); 
        if(array_key_exists("keywords",$params)){
                $this->db->where("(event_id LIKE '%".$params["keywords"]."%')");
        }
        if(array_key_exists("where_condition",$params)){
                $this->db->where("(".$params["where_condition"].")");
        }   
        if(array_key_exists("order_by",$params) && array_key_exists("tiporderby",$params)){
                $this->db->order_by($params["tiporderby"],$params['order_by']);
        }   
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
        }
       //$this->db->get();echo $this->db->last_query();exit;
        return  $this->db->get();
    } 
    public function cntviewEvent($params  =    array()){
            $params["cnt"]      =   "1"; 
            $val    =   $this->queryEvent($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
    }
    public function viewEvent($params = array()){
//            $this->query_category($params);echo $this->db->last_query();exit;
            return $this->queryEvent($params)->result();
    }
    public function getevent($params){
        return $this->queryEvent($params)->row_array();
    } 
    public function getEvents($params = array()){
        return $this->queryEvent($params)->row();
    } 
    public function get_event($uri){ 
        $params["where_condition"]      =   "event_keywords LIKE '".$uri."'"; 
        return $this->queryEvent($params)->result_array();
    }
    public function unique_category($uri){ 
        $params["cnt"]                  =   '1';
        $params["unique_category"]      =   $uri;              
        $vsl        =   $this->queryEvent($params)->row_array(); 
        if(is_array($vsl)){
            if($vsl['cnt'] > 0){
                return "true";
            }
        }
        return "false";
    }
    public function unique_event(){ 
        $params["where_condition"]      =   "event_name LIKE '".$this->input->post("name")."'"; 
        $vsp    =   $this->queryEvent($params)->row_array();
        if(isset($vsp)){
            if(count($vsp) > 0){
                return TRUE;
            }
        }
        return FALSE;
    }
    public function create_event(){ 
        $catne  =   trim($this->input->post("name"));
        $id     =   "EVEN".$this->common_model->get_max("eventid","event");
        $catkey     = str_replace(" ","_", strtolower($catne));
        $fname  =   '';
        if(count($_FILES) > 0){
            if($_FILES["image"]["name"] != "" && $_FILES["image"]["name"] != "noname"){
                $target_dir =   $this->config->item("uploads_path")."category/";
                $fname      =   $_FILES["image"]["name"];
                $vsp        =   explode(".",$fname);
                if(count($vsp) > 1){
                    $j =    count($vsp)-1;
                    $fname      =   time().".".$vsp[$j];
                }
                $uploadfile =   $target_dir . basename($fname);
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile); 
            }
        }

        $dta    =   array(
            "event_id"          =>    $id,
            "event_name"        =>     trim($this->input->post("name")),
            "event_keywords"    =>  $catkey,
            "event_image"       =>  $fname,
            "event_cr_on"       =>    date("Y-m-d H:i:s"),
            "event_cr_by"       =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):""
        );
        $this->db->insert("event",$dta);
        if($this->db->insert_id() > 0){
            return TRUE;
        }
        return FALSE;
    }
    public function delete_Event($uri){
            $dta    =   array(
                "event_open"        => 0,
                "event_md_on" => date("Y-m-d H:i:s"),
                "event_md_by"   => $this->session->userdata("login_id")
            ); 
            $this->db->update("event",$dta,array("event_id"=>$uri));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function update_event($uri){
        $catkey     = str_replace(" ","_", strtolower(trim($this->input->post("name"))));
        if(count($_FILES) > 0){
            if($_FILES["image"]["name"] != "" && $_FILES["image"]["name"] != "noname"){
                $target_dir =   $this->config->item("uploads_path")."category/";
                $fname      =   $_FILES["image"]["name"];
                $vsp        =   explode(".",$fname);
                if(count($vsp) > 1){
                    $j =    count($vsp)-1;
                    $fname      =   time().".".$vsp[$j];
                }
                $uploadfile =   $target_dir . basename($fname);
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile); 
            }
        }
        if($fname!=''){
            $dta    =   array( 
                "event_name"        =>     trim($this->input->post("name")),
                "event_keywords"    =>  $catkey,
                "event_image"       =>  $fname,
                "event_md_on"       =>    date("Y-m-d H:i:s"),
                "event_md_by"       =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):""
            ); 
        }else{
            $dta    =   array( 
                "event_name"        =>     trim($this->input->post("name")),
                "event_keywords"    =>  $catkey,
                "event_md_on"       =>    date("Y-m-d H:i:s"),
                "event_md_by"       =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):""
            ); 
        }
        
        $this->db->update("event",$dta,array("event_id" =>   $uri));
        if($this->db->affected_rows() > 0){
            return TRUE;
        }
        return FALSE;
    }
    public function viewEventItems($params = array()){
        return $this->queryEventItems($params)->result();
    }
    public function getEventItems($params = array()){
        return $this->queryEventItems($params)->result_array();
    }
    public function queryEventItems($params = array()){
        $dt =   array(
        );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("event_cat as di")
                    ->where($dt);
        if(array_key_exists("whereCondition",$params)){
                $this->db->where("(".$params["whereCondition"].")");
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
    public function activedeactive($uri,$status){
        $dta    =   array( 
                        "event_status"             =>    $status,
                        "event_md_on"  =>    date("Y-m-d h:i:s"),
                        "event_md_by"    =>    $this->session->userdata("login_id")
                    );
        $this->db->update("event",$dta,array("event_id" => $uri)); 
        $vsp    =    $this->db->affected_rows();
        if($vsp > 0){  
            return TRUE;
        }
        return FALSE;
    }
}