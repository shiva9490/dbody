<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Packages_model extends CI_Model{
    public function package_mode($params = array()){
        $dt         =   array(
                            "pmode_open"      =>     '1',
                            "pmode_status"    =>     '1'
                    );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("package_mode") 
                    ->where($dt); 
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
        return  $this->db->get()->result();
    } 
    public function query_package($params = array()){
        $dt         =   array(
                            "package_open"      =>     '1',
                            "package_status"    =>     '1'
                    );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("packages") 
                    ->where($dt); 
        if(array_key_exists("keywords",$params)){
                $this->db->where("(package_name LIKE '%".$params["keywords"]."%')");
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
        return  $this->db->get();
    } 
    public function cntviewPackage($params  =    array()){
            $params["cnt"]      =   "1"; 
            $val    =   $this->query_package($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
    }
    public function viewPackage($params = array()){
//            $this->query_package($params);echo $this->db->last_query();exit;
            return $this->query_package($params)->result();
    }
    public function get_package($uri){
        $params["where_condition"]   =   "package_id LIKE '".$uri."'";
        return $this->query_package($params)->row_array();
    } 
    public function getPackage($params = array()){
        return $this->query_package($params)->row();
    } 
    public function create_package(){ 
            $dta    =   array(
                "package_id"     =>    "PRD".$this->common_model->get_max("packageid","packages"),
                "package_name"   =>     ucwords($this->input->post("package_name")),
                "package_price"   =>    $this->input->post("package_price"),
                "package_banners"       =>    $this->input->post("package_banners"),
                "package_expiry"        =>    $this->input->post("package_expiry"),
                "package_expiry_value"  =>    $this->input->post("btnpackageval"),
                "package_created_on"    =>    date("Y-m-d H:i:s"),
                "package_created_by"  =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):""
            ); 
            $this->db->insert("packages",$dta);
            if($this->db->insert_id() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function delete_package($uri){ 
            $dta    =   array(
                "package_open"   =>    0,
                "package_modified_on"  =>    date("Y-m-d H:i:s"),
                "package_modified_by"  =>    $this->session->userdata("login_id")
            ); 
            $this->db->update("packages",$dta,array("package_id"     =>   $uri));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function update_package($uri){
            $dta    =   array( 
                "package_name"   =>     ucwords($this->input->post("package_name")),
                "package_price"   =>    $this->input->post("package_price"),
                "package_banners"  =>    $this->input->post("package_banners"),
                "package_expiry_value"  =>    $this->input->post("btnpackageval"),
                "package_expiry"   =>     $this->input->post("package_expiry"),
                "package_modified_on"  =>    date("Y-m-d H:i:s"),
                "package_modified_by"  =>    $this->session->userdata("login_id")
            );  
            $this->db->update("packages",$dta,array("package_id"     =>   $uri));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
    }
   
}