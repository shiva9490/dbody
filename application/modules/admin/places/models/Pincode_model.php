<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Pincode_model extends CI_Model{
    public function query_Pincode($params = array()){
        $dt         =   array(
                            //"pincodeopen"      =>     '1'
                    );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("pincodes_list") 
                    ->where($dt); 
        if(array_key_exists("keywords",$params)){
                $this->db->where("(pincode_district LIKE '%".$params["keywords"]."%')");
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
        if(array_key_exists("group_by", $params)){
            $this->db->group_by($params["group_by"]);
        }
        return  $this->db->get();
    } 
    public function cntviewPincode($params  =    array()){
            $params["cnt"]      =   "1"; 
            $val    =   $this->query_Pincode($params)->row_array();
            if(is_array($val) && count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
    }
    public function viewPincode($params = array()){
//            $this->query_measure($params);echo $this->db->last_query();exit;
            return $this->query_Pincode($params)->result();
    }
    public function get_measure($uri){
        $params["where_condition"]   =   "measure_id LIKE '".$uri."'";
        return $this->query_Pincode($params)->row_array();
    } 
    public function getPincode($params = array()){
        return $this->query_Pincode($params)->row();
    } 
    
    public function update_pincode($uri,$status){
            $dta    =   array( 
                "pincodeopen"         =>    $status,
            );  
            $this->db->update("pincodes_list",$dta,array("pincode_district" => $uri));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
    }
}