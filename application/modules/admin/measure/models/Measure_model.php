<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Measure_model extends CI_Model{
    public function query_measure($params = array()){
        $dt         =   array(
                            "measure_open"      =>     '1',
                            "measure_status"    =>     '1'
                    );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("measures") 
                    ->where($dt); 
        if(array_key_exists("keywords",$params)){
                $this->db->where("(measure_unit LIKE '%".$params["keywords"]."%')");
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
    public function cntviewMeasure($params  =    array()){
            $params["cnt"]      =   "1"; 
            $val    =   $this->query_measure($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
    }
    public function viewMeasure($params = array()){
//            $this->query_measure($params);echo $this->db->last_query();exit;
            return $this->query_measure($params)->result();
    }
    public function get_measure($uri){
        $params["where_condition"]   =   "measure_id LIKE '".$uri."'";
        return $this->query_measure($params)->row_array();
    } 
    public function getMeasure($params = array()){
        return $this->query_measure($params)->row();
    } 
    public function create_measure(){ 
            $dta    =   array(
                "measure_id"     =>    "MSU".$this->common_model->get_max("measureid","measures"),
                "measure_unit"   =>    $this->input->post("measure_unit"),
                "measure_created_on"  =>    date("Y-m-d H:i:s"),
                "measure_created_by"  =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):""
            ); 
            $this->db->insert("measures",$dta);
            if($this->db->insert_id() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function delete_measure($uri){ 
            $dta    =   array(
                "measure_open"   =>    0,
                "measure_modified_on"  =>    date("Y-m-d H:i:s"),
                "measure_modified_by"  =>    $this->session->userdata("login_id")
            ); 
            $this->db->update("measures",$dta,array("measure_id"     =>   $uri));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function update_measure($uri){
            $dta    =   array( 
                "measure_unit"         =>    $this->input->post("measureunit"),
                "measure_modified_on"  =>    date("Y-m-d H:i:s"),
                "measure_modified_by"  =>    $this->session->userdata("login_id")
            );  
            $this->db->update("measures",$dta,array("measure_id"     =>   $uri));
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
}