<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reports extends CI_Controller{
        public function __construct() {
            parent::__construct();
        } 
           
       
        public function order_reports(){
            if($this->session->userdata("manage-orders") != '1'){
                redirect(sitedata("site_admin")."/dashboard");
            }
            $dta    =   array(
                "title"     =>  "Orders",
                "content"   =>  "orders",
                "limit"    =>  "1"
            );
            $conditions     =   array();
            $total       =   $this->report_model->cntvieworders($conditions);
            $total_amount    = $this->report_model->vieworders($conditions);
            if(count($total_amount) > 0){
                $t_amount=0;
                foreach($total_amount as $t){
                    $t_amount = $t_amount + $t->order_total;
                }
                $dta["total_amount"]    = $t_amount;
            }
            $dta["total_orders"]   = $total;
            $date   =date('Y-m-d');
            $condition['whereCondition'] = "order_date LIKE '".$date."'";
            $totalTdy       =   $this->report_model->cntvieworders($condition);
            $dta["today_orders"]   = $totalTdy;
            $today_amount    = $this->report_model->vieworders($condition);
            $dta["today_amount"]    =   0;
            if(count($today_amount) > 0){
                $td_amount=0;
                foreach($today_amount as $t){
                    $td_amount = $td_amount + $t->order_total;
                }
                $dta["today_amount"]    = $td_amount;
            }
            if($this->input->get() != ""){
                $keywords   =   $this->input->get('keywords'); 
                $fromDate   =   $this->input->get('fromDate');
                $toDate     =   $this->input->get('toDate');
                $dta["status"]      = $status     =   $this->input->get('status');
                $dta["pay_mode"]    = $pay_mode   =   $this->input->get('pay_mode');
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }
                if(!empty($status)){
                    $conditions['whereCondition1'] = "order_acde LIKE '".$status."'";
                } 
                if(!empty($pay_mode)){
                    $conditions['whereCondition2'] = "order_payment_mode LIKE '".$pay_mode."'";
                } 
                $keywords   =   $this->input->get('keywords'); 
                if(!empty($fromDate) && !empty($toDate) ){
                    if($fromDate <= $toDate){
                        $conditions['whereCondition'] = "order_date >= '".$fromDate."' AND order_date <= '".$toDate."'";
                        $this->session->set_flashdata("suc"," Generated Successfully");
                    }
                    else{
                        $this->session->set_flashdata("err"," 'From Date' is lessthen 'To Date' and also not empty.");
                    }
                }
                if($this->input->get('excel') ){
                    $this->session->set_flashdata("suc"," Check Downloads for Excel");
                    $conditions['file_name']   =   'Orders Report ['.date("YmdHis").'].csv';
                    $conditions['columns'] = "order_unique,customer_mobile,customer_name,order_total,order_date,order_payment_mode,order_acde";
                    $this->report_model->download_autogen_excel($conditions);
                }
                if($this->input->get('pdf') ){
                    $this->session->set_flashdata("suc"," Check Downloads for Excel");
                    $conditions['file_name']   =   'Orders Report ['.date("YmdHis").'].pdf';
                    $conditions['columns'] = "order_unique,customer_mobile,customer_name,order_total,order_date,order_payment_mode,order_acde";
                    $this->report_model->download_pdf($conditions);
                }
            }
            $perpage        =    $this->input->get("limitvalue")?$this->input->get("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
            $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"orderid";  
            $totalRec       =   $this->report_model->cntvieworders($conditions);  
            $config['base_url']    =    bildourl("viewOrdersReport");
            $config['total_rows']  =    $totalRec;
            $config['per_page']    =   $perpage;
            $config['link_func']   =    'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['order_by']     = $orderby;
            $conditions['tipoOrderby']  =  $tipoOrderby; 
            $conditions['limit']   =  $perpage;
            $dta["view"]    = $this->report_model->vieworders($conditions);
            //print_r($dta["view"]);die;
            $this->load->view("admin/inner_template",$dta);
        }
        public function viewOrders(){
            $conditions =   array();
            $page       =   $this->uri->segment('3');
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords');
            $fromDate   =   $this->input->post('fromdate');
            $toDate   =   $this->input->post('todate');
            $status     =   $this->input->post('status');
            $pay_mode   =   $this->input->post('pay_mode'); 
            if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
            }
            if(!empty($status)){
                $conditions['whereCondition1'] = "order_acde LIKE '".$status."'";
            } 
            if(!empty($pay_mode)){
                $conditions['whereCondition2'] = "order_payment_mode LIKE '".$pay_mode."'";
            } 
            if(!empty($fromDate) && !empty($toDate)){
                $conditions['whereCondition'] = "order_date >= '".$fromDate."' AND order_date <= '".$toDate."'";
            }
            //$conditions['whereCondition']   =   "";
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"orderid";  
            $totalRec       =   $this->report_model->cntvieworders($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            } 
            $config['base_url']     =   bildourl('viewOrdersReport');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            $conditions['limit']    =   $perpage;
            $dta["limit"]           =   $offset+1;
            $dta["view"]    = $this->report_model->vieworders($conditions);
            $this->load->view("ajaxorders",$dta);
        }
        public function ajaxOrderview(){
            $uri    =   $this->uri->segment("3");
            $psm["whereCondition"]  =   "order_id LIKE '".$uri."'";
            $dta['view']  =    $this->order_model->vieworderdetails($psm);
            $this->load->view("ajaxorderview",$dta);
        }
        public function customer_reports(){
            if($this->session->userdata("manage-orders") != '1'){
                redirect(sitedata("site_admin")."/dashboard");
            }
            $dta    =   array(
                "title"     =>  "Customer",
                "content"   =>  "customer",
                "limit"    =>  "1"
            );
            $conditions     =   array();
            
            if($this->input->get() != ""){
                $keywords   =   $this->input->get('keywords'); 
                $fromDate   =   $this->input->get('fromDate');
                $toDate     =   $this->input->get('toDate');
                $dta["status"]      = $status     =   $this->input->get('status');
                $dta["pay_mode"]    = $pay_mode   =   $this->input->get('pay_mode');
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }
                if(!empty($status)){
                    $conditions['whereCondition1'] = "order_acde LIKE '".$status."'";
                } 
                if(!empty($pay_mode)){
                    $conditions['whereCondition2'] = "order_payment_mode LIKE '".$pay_mode."'";
                } 
                $keywords   =   $this->input->get('keywords'); 
                if(!empty($fromDate) && !empty($toDate) ){
                    if($fromDate <= $toDate){
                        $conditions['whereCondition'] = "order_date >= '".$fromDate."' AND order_date <= '".$toDate."'";
                        $this->session->set_flashdata("suc"," Generated Successfully");
                    }
                    else{
                        $this->session->set_flashdata("err"," 'From Date' is lessthen 'To Date' and also not empty.");
                    }
                }
                if($this->input->get('excel') ){
                    $this->session->set_flashdata("suc"," Check Downloads for Excel");
                    $conditions['file_name']   =   'Customer Report ['.date("YmdHis").'].csv';
                    $conditions['group_by'] = "cp.customer_id";
                    $conditions['columns'] = "cp.customer_id,customer_mobile,customer_name,SUM(order_total) as total,count(order_id) as count";
                    $this->report_model->download_autogen_excel_customer($conditions);
                }
                if($this->input->get('pdf') ){
                    $this->session->set_flashdata("suc"," Check Downloads for Excel");
                    $conditions['file_name']   =   'Customer Report ['.date("YmdHis").'].pdf';
                    $conditions['group_by'] = "cp.customer_id";
                    $conditions['columns'] = "cp.customer_id,customer_mobile,customer_name,SUM(order_total) as total,count(order_id) as count";
                    $this->report_model->download_pdf_customer($conditions);
                }
            }
            
            $conditions['columns'] = "order_id,order_unique,cp.customer_id,customer_mobile,customer_name,order_date,order_payment_mode,order_acde,SUM(order_total) as total,count(order_id) as count";
            $perpage        =    $this->input->get("limitvalue")?$this->input->get("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
            $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"customerid";  
            $totalRec       =   $this->report_model->cntviewCustomer($conditions);  
            $conditions['group_by'] = "ct.order_customer_id";
            //print_r($totalRec);exit();
            $config['base_url']    =    bildourl("viewCustomerReport");
            $config['total_rows']  =    $totalRec;
            $config['per_page']    =   $perpage;
            $config['link_func']   =    'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['order_by']     = $orderby;
            $conditions['tipoOrderby']  =  $tipoOrderby; 
            $conditions['limit']   =  $perpage;
            $dta["view"]    = $this->report_model->viewCustomer($conditions);
            //print_r($dta["view"]);die;
            $this->load->view("admin/inner_template",$dta);
        }
        public function viewcustomer(){
            $conditions =   array();
            $page       =   $this->uri->segment('3');
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords');
            $fromDate   =   $this->input->post('fromdate');
            $toDate   =   $this->input->post('todate');
            $status     =   $this->input->post('status');
            $pay_mode   =   $this->input->post('pay_mode'); 
            if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
            }
            if(!empty($status)){
                $conditions['whereCondition1'] = "order_acde LIKE '".$status."'";
            } 
            if(!empty($pay_mode)){
                $conditions['whereCondition2'] = "order_payment_mode LIKE '".$pay_mode."'";
            } 
            if(!empty($fromDate) && !empty($toDate)){
                $conditions['whereCondition'] = "order_date >= '".$fromDate."' AND order_date <= '".$toDate."'";
            }
            //$conditions['whereCondition']   =   "";
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"customerid";  
            $conditions['columns'] = "order_id,order_unique,cp.customer_id,customer_mobile,customer_name,order_date,order_payment_mode,order_acde,SUM(order_total) as total,count(order_id) as count";
            $totalRec       =   $this->report_model->cntviewCustomer($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            } 
            $conditions['group_by'] = "cp.customer_id";
            $config['base_url']     =   bildourl('viewCustomerReport');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            $conditions['limit']    =   $perpage;
            $dta["limit"]           =   $offset+1;
            $dta["view"]    = $this->report_model->viewCustomer($conditions);
            $this->load->view("ajaxCust",$dta);
        }
        public function ajaxCustomerview(){
            $uri    =   $this->uri->segment("3");
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"orderid";  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $psm['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $psm['tipoOrderby']   =  $tipoOrderby; 
            }
            $psm["whereCondition"]  =   "ct.order_customer_id LIKE '".$uri."'";
            $dta['view']  =    $this->order_model->vieworderdetails($psm);
            $this->load->view("ajaxcustomerview",$dta);
        }
        public function product_reports(){
            if($this->session->userdata("manage-orders") != '1'){
                redirect(sitedata("site_admin")."/dashboard");
            }
            $dta    =   array(
                "title"     =>  "Product",
                "content"   =>  "product",
                "limit"    =>  "1"
            );
            $conditions     =   array();
            
            if($this->input->get() != ""){
                $keywords   =   $this->input->get('keywords'); 
                $fromDate   =   $this->input->get('fromDate');
                $toDate     =   $this->input->get('toDate');
                $dta["status"]      = $status     =   $this->input->get('status');
                $dta["pay_mode"]    = $pay_mode   =   $this->input->get('pay_mode');
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }
                if(!empty($status)){
                    $conditions['whereCondition1'] = "order_acde LIKE '".$status."'";
                } 
                if(!empty($pay_mode)){
                    $conditions['whereCondition2'] = "order_payment_mode LIKE '".$pay_mode."'";
                } 
                $keywords   =   $this->input->get('keywords'); 
                if(!empty($fromDate) && !empty($toDate) ){
                    if($fromDate <= $toDate){
                        $conditions['whereCondition'] = "order_date >= '".$fromDate."' AND order_date <= '".$toDate."'";
                        $this->session->set_flashdata("suc"," Generated Successfully");
                    }
                    else{
                        $this->session->set_flashdata("err"," 'From Date' is lessthen 'To Date' and also not empty.");
                    }
                }
                if($this->input->get('excel') ){
                    $this->session->set_flashdata("suc"," Check Downloads for Excel");
                    $conditions['file_name']   =   'Product Report ['.date("YmdHis").'].csv';
                    $conditions['group_by'] = "product_id";
                    $conditions['columns'] = "product_id,product_name,SUM(order_total) as total,count(order_id) as count";
                    $this->report_model->download_autogen_excel_product($conditions);
                }
                if($this->input->get('pdf') ){
                    $this->session->set_flashdata("suc"," Check Downloads for Excel");
                    $conditions['file_name']   =   'Product Report ['.date("YmdHis").'].pdf';
                    $conditions['group_by'] = "product_id";
                    $conditions['columns'] = "product_id,product_name,SUM(order_total) as total,count(order_id) as count";
                    $this->report_model->download_pdf_product($conditions);
                }
            }
            $conditions['columns'] = "product_id,product_name,SUM(order_total) as total,count(order_id) as count";
            $perpage        =    $this->input->get("limitvalue")?$this->input->get("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
            $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"productid";  
            $totalRec       =   $this->report_model->cntviewproduct($conditions); 
            $conditions['group_by'] = "product_id"; 
            $config['base_url']    =    bildourl("viewproductReport");
            $config['total_rows']  =    $totalRec;
            $config['per_page']    =   $perpage;
            $config['link_func']   =    'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['order_by']     = $orderby;
            $conditions['tipoOrderby']  =  $tipoOrderby; 
            $conditions['limit']   =  $perpage;
            $dta["view"]    = $this->report_model->viewproduct($conditions);
           // print_r($dta["view"]);die;
            $this->load->view("admin/inner_template",$dta);
        }
        public function viewproduct(){
            $conditions =   array();
            $page       =   $this->uri->segment('3');
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords');
            $fromDate   =   $this->input->post('fromdate');
            $toDate   =   $this->input->post('todate');
            $status     =   $this->input->post('status');
            $pay_mode   =   $this->input->post('pay_mode'); 
            if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
            }
            if(!empty($status)){
                $conditions['whereCondition1'] = "order_acde LIKE '".$status."'";
            } 
            if(!empty($pay_mode)){
                $conditions['whereCondition2'] = "order_payment_mode LIKE '".$pay_mode."'";
            } 
            if(!empty($fromDate) && !empty($toDate)){
                $conditions['whereCondition'] = "order_date >= '".$fromDate."' AND order_date <= '".$toDate."'";
            }
            //$conditions['whereCondition']   =   "";
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"productid";
            $conditions['columns'] = "product_id,product_name,SUM(order_total) as total,count(order_id) as count";
            $totalRec       =   $this->report_model->cntviewproduct($conditions);    
            $conditions['group_by'] = "product_id";
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            } 
            $config['base_url']     =   bildourl('viewproductReport');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            $conditions['limit']    =   $perpage;
            $dta["limit"]           =   $offset+1;
            $dta["view"]    = $this->report_model->viewproduct($conditions);
            $this->load->view("ajaxproduct",$dta);
        }
        
}