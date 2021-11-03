<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Banner_model extends CI_Model{
        public function queryBanner($params = array()){
                $dta =  array(
                    "bt.banner_open"   =>  "1",
                    "bt.banner_status" =>  "1"
                );
                $sel   =    "*";
                if(array_key_exists("cnt",$params)){
                        $sel    =   "count(*) as cnt";
                }
                if(array_key_exists("columns",$params)){
                        $sel    =   $params["columns"];
                }
                $this->db->select("$sel")
                        ->from("banners as bt")
                        ->join("vendor_packages as vt","vt.vendorpackage_id = bt.banner_vendorpackage_id","LEFT")
                        ->join("packages as  pt","pt.package_id = bt.banner_package_id","LEFT") 
                        ->join("vendor as  vd","vd.vendor_id = bt.banner_vendor_id","LEFT") 
                        ->join("countries as  ct","ct.country_id = vd.vendor_country","LEFT") 
                        ->join("state as st","st.state_id = vd.vendor_state","LEFT") 
                        ->join("district as  dt","dt.district_id = vd.vendor_district","LEFT")  
                        ->join("mandal as md","md.mandal_id = vd.vendor_mandal","LEFT")  
                        ->where($dta);
                if(array_key_exists("where_condition",$params)){
                        $this->db->where("(".$params["where_condition"].")");
                } 
                if(array_key_exists("keywords",$params)){
                        $this->db->where("(banner_title LIKE '%".$params["keywords"]."%')");
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
        public function cntviewBanner($params = array()){
                $params["cnt"]  =   1;
                $vsp    =   $this->queryBanner($params)->row_array();
                if(count($vsp) > 0){
                        return $vsp['cnt'];
                }
                return 0;
        }
        public function viewBanners($params = array()){
                return  $this->queryBanner($params)->result();
        }
        public function viewBannerdata($params = array()){
            $imagepath  =   $this->config->item("upload_url")."banner-uploads/"; 
            $params["where_condition"]  =   "banner_vendor_expriy >= '".date("Y-m-d")."'";
            $params["tipoOrderby"]  =   "bannerid";
            $params["order_by"]  =   "DESC";
            $params["columns"]   =   "banner_title,CONCAT('".$imagepath."',banner_image) as banner_image";
            return  $this->queryBanner($params)->result();
        }
        public function getBanner($uri){
                $pms["where_condition"]     =   "banner_id LIKE '".$uri."'";
                return $this->queryBanner($pms)->row_array();
        }
        public function createBanner(){
                $vsp    =   date("Y-m-d",strtotime('+ 100 Years')); 
                $dta    =   array(
                        "banner_id"      =>  $this->common_model->get_max("bannerid","banners")."BNNR", 
                        "banner_title"   =>   $this->input->post("banner_title"), 
                        "banner_vendor_expriy"     =>  $vsp,
                        "banner_cr_on"   =>   date("Y-m-d h:i:s"), 
                        "banner_cr_by"   =>   $this->session->userdata("login_id")
                );
                if(count($_FILES) > 0){
                    $target_dir =   $this->config->item("uploads_path")."banner-uploads/";
                    $fname      =   $_FILES["banner_image"]["name"];
                    if($fname != "noname"){
                        $vsp        =   explode(".",$fname);
                        $fname      =   "BAN_".time().".".$vsp['1'];
                        $uploadfile =   $target_dir . basename($fname);
                        $vsp 	=	move_uploaded_file($_FILES['banner_image']['tmp_name'], $uploadfile); 
                        if($vsp){
                            $dta['banner_image'] =   $fname;
                        }
                    }
                } 
                $this->db->insert("banners",$dta);
                if($this->db->insert_id() >  0){
                        $this->transaction_log->save_log("Added Banners","Banners","Add","",$this->session->userdata("login_id"));
                        return TRUE;
                }
                return FALSE;
        }
        public function updateBanner($uri){
                $dta    =   array( 
                        "banner_title"   =>   $this->input->post("banner_title"), 
                        "banner_md_on"   =>   date("Y-m-d h:i:s"),  
                        "banner_md_by"   =>   $this->session->userdata("login_id")
                ); 
                if(count($_FILES) > 0){
                    $target_dir =   $this->config->item("uploads_path")."banner-uploads/";
                    $fname      =   $_FILES["banner_image"]["name"];
                    if($fname != ""){
                        $vsp        =   explode(".",$fname);
                        $fname      =   "BAN_".time().".".$vsp['1'];
                        $uploadfile =   $target_dir . basename($fname);
                        $vsp 	=	move_uploaded_file($_FILES['banner_image']['tmp_name'], $uploadfile); 
                        if($vsp){
                            $dta['banner_image'] =   $fname;
                        }
                    }
                }   
                $this->db->update("banners",$dta,array("banner_id" => $uri));
              // echo $this->db->last_query();exit;
               
                if($this->db->affected_rows() >  0){
                        $this->transaction_log->save_log("Update Banners","Banners","Update","",$this->session->userdata("login_id"));
                        return TRUE;
                }
                return FALSE;
        }
        public function deletebanner($uri){
                $dta    =   array( 
                        "banner_open"    =>  0,
                        "banner_md_on"   =>   date("Y-m-d h:i:s"), 
                        "banner_md_by"   =>   $this->session->userdata("login_id")
                );
                $this->db->update("banners",$dta,array("banner_id" => $uri));
                if($this->db->affected_rows() >  0){
                        $this->transaction_log->save_log("Deleted Banners","Banners","Delete","",$this->session->userdata("login_id"));
                        return TRUE;
                }
                return FALSE;
        }
}