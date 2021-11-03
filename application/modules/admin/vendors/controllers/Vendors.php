<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Vendors extends CI_Controller{
    public function __construct() {
            parent::__construct();
            if($this->session->userdata("login_id") == ""){
                redirect("/bildo-admin");
           }
    }
    public function vendors_list(){
            $dta    =   array(
                "title"     =>  "Vendors",
                "content"   =>  "vendors",
                "limit"    =>  "1"
            );
            $conditions     =   array();
            if($this->input->get("search") != ""){
                $keywords   =   $this->input->get('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                } 
            }
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):$this->config->item("pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post ('tipoOrderby')):"vendor_id";  
            $totalRec       =   $this->vendor_model->cntviewvendors($conditions);  
            $config['base_url']    =    bildourl("viewVendors");
            $config['total_rows']  =    $totalRec;
            $config['per_page']    =   $perpage;
            $config['link_func']   =    'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['order_by']     = $orderby;
            $conditions['tipoOrderby']  =  $tipoOrderby; 
            $conditions['limit']   =  $this->config->item("pagination");
            $dta["view"]    =   $this->vendor_model->viewVendors($conditions);
            $this->load->view("admin/inner_template",$dta);
        }
        public function viewVendors(){
            $conditions =   array();
            $page       =   $this->uri->segment('3');
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords'); 
            if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
            }  
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):$this->config->item("pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"vendor_id";  
            $totalRec               =   $this->vendor_model->cntviewvendors($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            } 
            $config['base_url']     =   bildourl('viewVendors');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            $conditions['limit']    =   $perpage;
            $dta["limit"]           =   $offset+1;
            $dta["view"]    = $this->vendor_model->viewVendors($conditions);
            $this->load->view("ajax_vendors",$dta);
        }
        public function vendorview(){
            $uri    =   $this->uri->segment("3");
            $params["whereCondition"]    =   "vendor_id LIKE '".$uri."'";
            $dta["view"]    =   $this->vendor_model->queryVendor($params)->row_array();
            $this->load->view("ajaxvendorview",$dta);
        }
}