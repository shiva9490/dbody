<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Customers extends CI_Controller{
    public function __construct() {
            parent::__construct();
            if($this->session->userdata("login_id") == ""){
                redirect("/bildo-admin");
           }
    }
    public function index(){
            $dta    =   array(
                "title"     =>  "Customers",
                "content"   =>  "customers",
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
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post ('tipoOrderby')):"customer_id";  
            $totalRec       =   $this->customer_model->cntviewcustomers($conditions);  
            $config['base_url']    =    bildourl("viewCustomers");
            $config['total_rows']  =    $totalRec;
            $config['per_page']    =   $perpage;
            $config['link_func']   =    'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['order_by']     = $orderby;
            $conditions['tipoOrderby']  =  $tipoOrderby; 
            $conditions['limit']   =  $this->config->item("pagination");
            $dta["view"]    =   $this->customer_model->viewCustomers($conditions);
            $this->load->view("admin/inner_template",$dta);
        }
        public function viewCustomers(){
            $conditions =   array();
            $page       =   $this->uri->segment('3');
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords'); 
            if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
            }  
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):$this->config->item("pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"customer_id";  
            $totalRec               =   $this->customer_model->cntviewcustomers($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            } 
            $config['base_url']     =   bildourl('viewCustomers');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            $conditions['limit']    =   $perpage;
            $dta["limit"]           =   $offset+1;
            $dta["view"]    = $this->customer_model->viewCustomers($conditions);
            $this->load->view("ajax_customers",$dta);
        }
        public function viewCusOrders(){
            $conditions =   array();
            $page       =   $this->uri->segment('3');
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords'); 
            $customerid =   ($this->input->post('customerid'))??''; 
            $dta['cus_id']  =   $customerid;
            if($customerid!=''){
               $conditions["whereCondition"]  =   "ct.order_customer_id LIKE '".$customerid."'";
            }
            if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
            }  
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"orderid";  
            $totalRec       =   $this->order_model->cntvieworders($conditions);
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):'15'; 
           
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            } 
            $config['base_url']     =   bildourl('viewCusOrders');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'ajaxcusorderdetails';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            $dta["perpage"] = $conditions['limit']    =   $perpage;
            $dta['urls']            =   bildourl('viewCusOrders');
            $dta["limit"]           =   $offset+1;
            $dta["view"]    = $this->order_model->vieworders($conditions);
            $this->load->view("ajaxorders",$dta);
        }
        public function activedeactive(){
                $vsp    =   "0";
                if($this->session->userdata("active-deactive-customers") != '1'){
                    $vsp    =   "0";
                }else{
                    $status     =   $this->input->post("status");
                    $uri        =   $this->input->post("fields"); 
                    $psm['whereCondition']  =   "customer_id = '".$uri."'";
                    $vue    =   $this->customer_model->getcustomer($psm);
                    if(is_array($vue) && count($vue) > 0){
                            $bt     =   $this->customer_model->activedeactive($uri,$status); 
                            if($bt > 0){
                                $vsp    =   1;
                            }
                    }else{
                        $vsp    =   2;
                    } 
                } 
                echo $vsp;
        }
}