<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Category_model extends CI_Model{
    public function query_category($params = array()){
        $dt         =   array(
                            "category_open"      =>     '1',
                            "category_status"    =>     '1'
                    );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("category") 
                    ->where($dt); 
        if(array_key_exists("keywords",$params)){
                $this->db->where("(category_name LIKE '%".$params["keywords"]."%')");
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
    public function cntviewCategory($params  =    array()){
            $params["cnt"]      =   "1"; 
            $val    =   $this->query_category($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
    }
    public function viewCategory($params = array()){
//            $this->query_category($params);echo $this->db->last_query();exit;
            return $this->query_category($params)->result();
    }
    public function get_category($uri){
        $params["where_condition"]   =   "category_id LIKE '".$uri."'";
        return $this->query_category($params)->row_array();
    } 
    public function getCategory($params = array()){
        return $this->query_category($params)->row();
    } 
    public function unique_category($uri){ 
        $params["cnt"]                  =   '1';
        $params["unique_category"]      =   $uri;              
        $vsl        =   $this->query_category($params)->row_array(); 
        if(is_array($vsl)){
            if($vsl['cnt'] > 0){
                return "false";
            }
        }
        return "true";
    }
    public function checkuniquecategory(){ 
        $params["where_condition"]      =   "LOWER(category_name) LIKE '".$this->input->post("category_name")."'"; 
        $vsp    =   $this->query_category($params)->row_array();
        if(isset($vsp)){
            if(count($vsp) > 0){
                return TRUE;
            }
        }
        return FALSE;
    }
    public function create_category(){ 
            $catne  =   trim($this->input->post("category_name"));
            $catkey     = str_replace(" ","_", strtolower($catne));
            $dta    =   array(
                "category_id"       =>    "CAT".$this->common_model->get_max("categoryid","category"),
                "category_keywords" =>    $catkey,
                "category_name"     =>    ucwords($catne),
                "category_created_on"  =>    date("Y-m-d H:i:s"),
                "category_created_by"  =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):""
            );
            if(count($_FILES) > 0){
                if($_FILES["category_upload"]["name"] != "" && $_FILES["category_upload"]["name"] != "noname"){
                    $target_dir =   $this->config->item("uploads_path")."category/";
                    $fname      =   $_FILES["category_upload"]["name"];
                    $vsp        =   explode(".",$fname);
                    if(count($vsp) > 1){
                        $j =    count($vsp)-1;
                        $fname      =   time().".".$vsp[$j];
                    }
                    $uploadfile =   $target_dir . basename($fname);
                    move_uploaded_file($_FILES['category_upload']['tmp_name'], $uploadfile); 
                    $dta["category_upload"]    =   $fname;
                }
            }
            $this->db->insert("category",$dta);
            if($this->db->insert_id() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function delete_category($uri){ 
            $dta    =   array(
                "category_open"   =>    0,
                "category_modified_on"  =>    date("Y-m-d H:i:s"),
                "category_modified_by"  =>    $this->session->userdata("login_id")
            ); 
            $this->db->update("category",$dta,array("category_id"     =>   $uri));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function update_category($uri){
            $catname    =   ucwords(trim($this->input->post("category_name")));
            $catdname   =   ucwords(trim($this->input->post("categoryname")));
            $cattval    =   $this->input->post("category_name")?$catname:$catdname;
            $catkey     = str_replace(" ","_", strtolower($cattval));
            $dta    =   array( 
                "category_keywords" =>    $catkey,
                "category_name"         =>    $cattval,
                "category_modified_on"  =>    date("Y-m-d H:i:s"),
                "category_modified_by"  =>    $this->session->userdata("login_id")
            ); 
            if(count($_FILES) > 0){
                if($_FILES["category_upload"]["name"] != "" && $_FILES["category_upload"]["name"] != "noname"){
                    $target_dir =   $this->config->item("uploads_path")."category/";
                    $fname      =   $_FILES["category_upload"]["name"];
                    $vsp        =   explode(".",$fname);
                    if(count($vsp) > 1){
                        $j          =    count($vsp)-1;
                        $fname      =   time().".".$vsp[$j];
                    }
                    $uploadfile =   $target_dir . basename($fname);
                    move_uploaded_file($_FILES['category_upload']['tmp_name'], $uploadfile); 
                    $dta["category_upload"]    =   $fname;
                }
            }
            $this->db->update("category",$dta,array("category_id"     =>   $uri));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function create_sub_category(){ 
            $catn   =   ucwords(trim($this->input->post("sub_category")));
            $catkey     = str_replace(" ","_", strtolower($catn));
            $dta    =   array(
                "subcategory_id"        =>    "SCS".$this->common_model->get_max("subcategoryid","sub_category"),
                "subcategory_category"  =>    $this->input->post("category"),
                "subcategory_keywords"  =>    $catkey,
                "subcategory_name"      =>    $catn,
                "subcategory_created_on"  =>    date("Y-m-d H:i:s"),
                "subcategory_created_by"  =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):""
            ); 
            if(count($_FILES) > 0){
                if($_FILES["subcategory_upload"]["name"] != "" && $_FILES["subcategory_upload"]["name"] != "noname"){
                    $target_dir =   $this->config->item("uploads_path")."category/";
                    $fname      =   $_FILES["subcategory_upload"]["name"];
                    $vsp        =   explode(".",$fname);
                    if(count($vsp) > 1){
                        $j =    count($vsp)-1;
                        $fname      =   time().".".$vsp[$j];
                    }
                    $uploadfile =   $target_dir . basename($fname);
                    move_uploaded_file($_FILES['subcategory_upload']['tmp_name'], $uploadfile); 
                    $dta["subcategory_upload"]    =   $fname;
                }
            }
            $this->db->insert("sub_category",$dta);
            if($this->db->insert_id() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function delete_sub_category($uri){ 
            $dta    =   array(
                "subcategory_open"   =>    0,
                "subcategory_modified_on"  =>    date("Y-m-d H:i:s"),
                "subcategory_modified_by"  =>    $this->session->userdata("login_id")
            ); 
            $this->db->update("sub_category",$dta,array("subcategory_id"     =>   $uri));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function update_sub_category($uri){
            $catn   =   ucwords(trim($this->input->post("sub_category")));
            $catkey =   str_replace(" ","_", strtolower($catn));
            $dta    =   array( 
                "subcategory_category"  =>    $this->input->post("category"),
                "subcategory_name"      =>    $catn,
                "subcategory_keywords"  =>    $catkey,
                "subcategory_modified_on"  =>    date("Y-m-d H:i:s"),
                "subcategory_modified_by"  =>    $this->session->userdata("login_id")
            );  
            if(count($_FILES) > 0){
                if($_FILES["subcategory_upload"]["name"] != "" && $_FILES["subcategory_upload"]["name"] != "noname"){
                    $target_dir =   $this->config->item("uploads_path")."category/";
                    $fname      =   $_FILES["subcategory_upload"]["name"];
                    $vsp        =   explode(".",$fname);
                    if(count($vsp) > 1){
                        $j =    count($vsp)-1;
                        $fname      =   time().".".$vsp[$j];
                    }
                    $uploadfile =   $target_dir . basename($fname);
                    move_uploaded_file($_FILES['subcategory_upload']['tmp_name'], $uploadfile); 
                    $dta["subcategory_upload"]    =   $fname;
                }
            }
            $this->db->update("sub_category",$dta,array("subcategory_id"     =>   $uri));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function query_sub_category($params = array()){
        $dt         =   array(
                            "sv.subcategory_status"       =>     '1',
                            "sv.subcategory_open"         =>     '1',
                            "sn.category_open"        =>     '1',
                            "sn.category_status"      =>     '1'
                    );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("sub_category as sv") 
                    ->join("category as sn","sn.category_id = sv.subcategory_category","INNER") 
                    ->where($dt); 
        if(array_key_exists("keywords",$params)){
                $this->db->where("(sn.category_name LIKE '%".$params["keywords"]."%' OR sv.subcategory_name LIKE '%".$params["keywords"]."%')");
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
    public function cntviewsubCategory($params  =    array()){
            $params["cnt"]      =   "1"; 
            $val    =   $this->query_sub_category($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
    }
    public function viewsub_categories($params = array()){
//        $this->query_sub_category($params);echo $this->db->last_query();exit;
        return $this->query_sub_category($params)->result();
    } 

    public function checkuniquesubcategory($ssubna,$catego){  
        $params["where_condition"]      =   "subcategory_name = '".$ssubna."' AND subcategory_category = '".$catego."'"; 
        $vsp    =   $this->query_sub_category($params)->row_array();
        if(isset($vsp)){
            if(count($vsp) > 0){
                return TRUE;
            }
        }
        return FALSE;
    }
    public function get_sub_category($uri){
        $params["where_condition"]   =   "subcategory_id LIKE '".$uri."'";
        return $this->query_sub_category($params)->row_array();
    } 
    public function get_subcategory($params = array()){ 
        return $this->query_sub_category($params)->row_array();
    } 
    public function unique_subcategory_name($category,$ssubna){
        $params["cnt"]  =   '1';
        $params["where_condition"]      =   "subcategory_name = '".$ssubna."' AND subcategory_category = '".$category."'"; 
        $vsl    =   $this->query_sub_category($params)->row_array(); 
        if(is_array($vsl)){
            if($vsl['cnt'] > 0){
                return "false";
            }
        }
        return "true";
    }
}