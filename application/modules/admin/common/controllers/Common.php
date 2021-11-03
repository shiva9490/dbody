<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Common extends CI_Controller{
        public function __construct() {
            parent::__construct();
        }
        public function menu(){
                if($this->session->userdata("manage-menu") != '1'){
                    redirect(sitedata("site_admin")."/dashboard");
                }
                $data   =   array(
                    "title"     =>  "Menu",
                    "content"   =>  "menu",
                    "menupage"  =>  sitedata("site_menu")
                );
                $this->load->view("admin/inner_template",$data);
        }
        public function ajaxSubcategory(){
            $vendorproduct_category     =   $this->input->post("vendorproduct_category");
            $params["columns"]          =   "subcategory_name,subcategory_id";
            $params["tiporderby"]       =   "subcategory_name";
            $params["order_by"]         =   "desc";
            $params["whereCondition"]   =   "subcategory_category = '".$vendorproduct_category."'"; 
            $csub   =   $this->category_model->viewsub_categories($params);
            $fsp    =   "<option value=''>Select Subcategory</option>";
            foreach($csub as $ee){
                $fsp    .=   '<option value="'.$ee->subcategory_id.'">'.$ee->subcategory_name.'</option>';
            }
            echo $fsp;
        }
        public function update_menu(){
                echo $this->common_model->update_menu();
        }
        
         public function orders(){
            if($this->session->userdata("manage-orders") != '1'){
                redirect(sitedata("site_admin")."/dashboard");
            }
            $dta    =   array(
                "title"     =>  "Orders",
                "content"   =>  "orders",
                "limit"    =>  "1"
            );
            $conditions     =   array();
            if($this->input->get("search") != ""){
                $keywords   =   $this->input->get('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                } 
            }
            
            if($this->input->get("excel") != ""){
                $keywords   =   $this->input->get('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                } 
                $this->common_model->reportvlue("Orders",$conditions);
            }
            $perpage        =    $this->input->get("limitvalue")?$this->input->get("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
            $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"orderid";  
            $totalRec       =   $this->order_model->cntvieworders($conditions);  
            $config['base_url']    =    bildourl("viewOrders");
            $config['total_rows']  =    $totalRec;
            $config['per_page']    =   $perpage;
            $config['link_func']   =    'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['order_by']     = $orderby;
            $conditions['tipoOrderby']  =  $tipoOrderby; 
            $conditions['limit']   =  $perpage;
            $dta["view"]    = $this->order_model->vieworders($conditions);
            //print_r($dta["view"]);die;
            $this->load->view("admin/inner_template",$dta);
        }
        public function viewOrders(){
            $conditions =   array();
            $page       =   $this->uri->segment('3');
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords'); 
            $customerid =   ($this->input->post('customerid'))??''; 
            if($customerid!=''){
               $conditions["whereCondition"]  =   "order_customer_id LIKE '".$customerid."'";
            }
            if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
            }  
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"orderid";  
            $totalRec       =   $this->order_model->cntvieworders($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            } 
            $config['base_url']     =   bildourl('viewOrders');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            $conditions['limit']    =   $perpage;
            $dta["limit"]           =   $offset+1;
            $dta["view"]    = $this->order_model->vieworders($conditions);
            $this->load->view("ajaxorders",$dta);
        }
        public function orderstatusupda(){
                $uri    =   $this->uri->segment("3");
                echo $this->order_model->orderstatusupda($uri,$this->input->post('status'));
        }
        public function ajaxOrderview(){
            $uri    =   $this->uri->segment("3");
            $psm["whereCondition"]  =   "order_id LIKE '".$uri."'";
            $dta['id']  =$uri;
            $dta['view']  =    $this->order_model->vieworderdetails($psm);
            $this->load->view("ajaxorderview",$dta);
        }
}