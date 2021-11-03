<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Deliverycharges_model extends CI_Model{
    public function queryDeliverychg($params = array()){
        $dt         =   array(
                            "deliverychg_open"      =>     '1',
                            "deliverychg_status"    =>     '1'
                    );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("delivery_changes") 
                    ->join("delivery_types","delivery_types.derliverytype_id = delivery_changes.delivery_type","inner")
                    ->where($dt); 
        if(array_key_exists("keywords",$params)){
                $this->db->where("(derliverytype LIKE '%".$params["keywords"]."%')");
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
    public function cntviewDeliverychg($params  =    array()){
            $params["cnt"]      =   "1"; 
            $val    =   $this->queryDeliverychg($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
    }
    public function viewDelivery($params = array()){
//            $this->query_measure($params);echo $this->db->last_query();exit;
            return $this->queryDeliverychg($params)->result();
    }
    public function getdeliverychg($uri){
        $params["where_condition"]   =   "deliverychgid LIKE '".$uri."'";
        return $this->queryDeliverychg($params)->row_array();
    } 
    public function getMeasure($params = array()){
        return $this->queryDeliverychg($params)->row();
    } 
    public function create_deliverycharges(){ 
            $dta    =   array(
                "deliverychgid"         =>    "DELCH".$this->common_model->get_max("deliverychg_id","delivery_changes"),
                "delivery_type"         =>    $this->input->post("delivery_type"),
                "deliverychg_start"     =>    $this->input->post("deliverychg_start"),
                "deliverychg_end"       =>    $this->input->post("deliverychg_end"),
                "deliverychg_amount"    =>    $this->input->post("deliverychg_amount"),
                "deliverychg_add_date"  =>    date("Y-m-d H:i:s"),
                "deliverychg_add_by"    =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):""
            ); 
            $this->db->insert("delivery_changes",$dta);
            if($this->db->insert_id() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function delete_deliverychg($uri){ 
            $dta    =   array(
                "deliverychg_open"          =>    0,
                "deliverychg_update_date"   =>    date("Y-m-d H:i:s"),
                "deliverychg_update_by"     =>    $this->session->userdata("login_id")
            ); 
            $this->db->update("delivery_changes",$dta,array("deliverychgid" => $uri));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function update_deliverychg($uri){
            $dta    =   array( 
                "delivery_type"             => $this->input->post("delivery_type"),
                "deliverychg_start"         => $this->input->post("deliverychg_start"),
                "deliverychg_end"           => $this->input->post("deliverychg_end"),
                "deliverychg_amount"        => $this->input->post("deliverychg_amount"),
                "deliverychg_update_date"   => date("Y-m-d H:i:s"),
                "deliverychg_update_by"     => $this->session->userdata("login_id")
            );  
            $this->db->update("delivery_changes",$dta,array("deliverychgid"     =>   $uri));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function checkuniquemeasure(){ 
        $measure_unit =   $this->input->post("measure_unit");
        $params["where_condition"]      =   "measure_unit = '".$this->input->post("measure_unit")."'"; 
        $vsp    =   $this->query_measure($params)->row_array();
        if(isset($vsp)){
            if(count($vsp) > 0){
                return TRUE;
            }
        }
        return FALSE;
    }
    
    
    public function viewDeliverytype($params = array()){
            return $this->queryDeliverytype($params)->result();
    }
    public function queryDeliverytype($params = array()){
        $dt         =   array(
                            "derliverytype_open"    => '1',
                            "derliverytype_status"  => '1'
                    );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("delivery_types")
                    ->where($dt); 
        if(array_key_exists("keywords",$params)){
                $this->db->where("(derliverytype LIKE '%".$params["keywords"]."%')");
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
}