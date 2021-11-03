<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Vendor_theme extends CI_Controller{
        public function __construct() {
                parent::__construct();
        }
        public function index(){
            $otp_mobile_no     =   $this->session->userdata("otpmobileno"); 
            $ins    =   $this->vendor_model->view_profile($otp_mobile_no);
            $data   =   array(
                                "content"   => "vendor/index",
                                "view"      =>  $ins,
                                "result"    =>  $this->common_model->getstates(),
                                "districts" =>  array(),
                                "mandals" =>  array(),
                                "gramss" =>  array(),
                        );
            if(count($ins) > 0){
                $data["districts"]  =   $this->common_model->getdistricts($ins['vendor_state']);
                $data["mandals"]  =   $this->common_model->getmandals($ins['vendor_district']);
                $data["gramss"]  =   $this->common_model->getgramapanchyat($ins['vendor_mandal']);
            }
            if ($this->input->post("submit")) { 
                $this->form_validation->set_rules("vendor_name", "Name", 'required|xss_clean|trim'); 
                $this->form_validation->set_rules("vendor_gender", "Gender", 'required'); 
                $this->form_validation->set_rules("vendor_mobile", "Mobile Number", 'required|xss_clean|trim|min_length[10]|max_length[10]');
                $this->form_validation->set_rules("vendor_storename", "Store Name", 'required');
                $fname  =   $_FILES['vendor_profile']['name'];
                if(count($ins) == 0){
                    if($fname == ""){
                        $this->form_validation->set_rules("vendor_profile","Vendor Image","required");
                    }
                } 
                if($this->form_validation->run() == TRUE){
                    if(count($ins) == 0){
                        $insert_location = $this->vendor_model->create_vendor(); 
                        if ($insert_location) {
                                $this->session->set_flashdata("suc", "Registration successfully");
                                redirect("/vendor_product");
                        } else {
                                $this->session->set_flashdata("err", "Not registered any vendor details.Please try again.");
                                redirect("/vendor_product");
                        }
                    }else{
                        $insert_location = $this->vendor_model->update_profile($otp_mobile_no);
                          //  print_r($insert_location);exit;
                        if ($insert_location) {
                                $this->session->set_flashdata("suc", "Updated Vendor details successfully");
                                redirect("/vendor");
                        } else {
                                $this->session->set_flashdata("err", "Not Updated any vendor details.Please try again.");
                                redirect("/vendor");
                        }
                    }
                }
            }
            $this->load->view('theme/inner_template',$data);
        }
        public function vendor_product(){ 
            $otp_mobile_no     =   $this->session->userdata("otpmobileno"); 
            $ins    =   $this->vendor_model->view_profile($otp_mobile_no);
            if($ins != "" && count($ins) > 0){
                $this->session->set_userdata("vendor_id",$ins["vendor_id"]);
                $this->session->set_userdata("vendor_name",$ins["vendor_name"]);
                $this->session->set_userdata("vendor_mobile",$otp_mobile_no);
                $data   =   array(
                    "content"   =>  "vendor/vendor_product",
                    "title"     =>  "Products"
                ); 
                $conditions = array(); 
                $keywords   =   $this->input->get('keywords'); 
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->get("limitvalue")?$this->input->get("limitvalue"):sitedata("site_mainpagination");
                $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"vendorproductid";  
                $conditions['where_condition'] = "vendor_mobile LIKE '".$otp_mobile_no."'";
                $totalRec               =   $this->vendor_model->cntviewVendorproducts($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                        $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                        $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
                } 
                $config['base_url']     =   base_url('viewVendorsproduct');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['limit']    =   $perpage;
                $data["view"]            =   $this->vendor_model->viewVendorproducts($conditions);
                $this->load->view('theme/inner_template',$data);
            }else{
                redirect("/vendor");
            }
        }
        public function viewVendorsproduct(){
                $otp_mobile_no     =   $this->session->userdata("otpmobileno");
                $conditions = array(); 
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                }  
                $page  =    $this->uri->segment("2");
                $offset =   ($page != "")?$page:"0";
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_mainpagination");
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"vendorproductid";  
                $conditions['where_condition'] = "vendor_mobile LIKE '".$otp_mobile_no."'";
                $totalRec               =   $this->vendor_model->cntviewVendorproducts($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                        $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                        $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
                } 
                $config["uri_segment"]  =   "2";
                $config['base_url']     =   base_url('viewVendorsproduct');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $dta["limit"]           =   $offset+1;
                $data["view"]            =   $this->vendor_model->viewVendorproducts($conditions);
                $this->load->view('vendor/ajaxvendorproducts',$data);
        }
        public function vendor_add_product(){ 
            $otp_mobile_no     =   $this->session->userdata("otpmobileno"); 
            $ins    =   $this->vendor_model->view_profile($otp_mobile_no); 
            if($ins != "" && count($ins) > 0){
                $data   =   array(
                        "content"   =>  "vendor/vendor_add_product",
                        "title"     =>  "Products"
                );
                $osm['tiporderby']  =   "category_name";
                $osm['order_by']    =   "ASC";
                $data["res"]        =   $this->category_model->viewCategory($osm); 
                $data["measure"]    =   $this->measure_model->viewMeasure(); 
                if ($this->input->post("submit")) {
                    $this->form_validation->set_rules("category","Category","required");
                    $this->form_validation->set_rules("sub_category","Sub Category","required");
                    $this->form_validation->set_rules("vendorproduct_product","Product","required");
                    $this->form_validation->set_rules("vendorproduct_description","Description","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_model","Model","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_brand","Brand","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_bb_quantity","Quantity","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_bb_price","Price","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_bb_mrp","MRP","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_bb_measure","Measure","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_bc_quantity","Quantity","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_bc_price","Price","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_bc_mrp","MRP","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_bc_measure","Measure","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_tax_class","Tax Class","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_shipping","Shipping","required|trim|xss_clean"); 
                    if(count($_FILES) == 0){
                        $this->form_validation->set_rules("product_upload[]","Images","required"); 
                    }  
                    if($this->form_validation->run() == TRUE){
                        $insert_loc = $this->vendor_model->product_create();
                        if ($insert_loc) {
                            $this->session->set_flashdata("suc", "Product added successfully");
                            redirect("/vendor_add_product");
                        } else {
                            $this->session->set_flashdata("err", "Please try again.");
                            redirect("/vendor_add_product");
                        }
                    }
                }
                $this->load->view('theme/inner_template',$data);
            }else{
                redirect("/vendor");
            }
        } 
        public function vendor_update_product(){
            $otp_mobile_no     =   $this->session->userdata("otpmobileno"); 
            $ins    =   $this->vendor_model->view_profile($otp_mobile_no); 
            if($ins != "" && count($ins) > 0){
                $uroi   =   $this->uri->segment("3"); 
                $opsm["whereCondition"] =   "vendorproduct_code LIKE '".$uroi."'";
                $view   =   $this->vendor_model->getVendorproduct($opsm);
                $data   =   array(
                        "content"   =>  "vendor/vendor_update_product",
                        "title"     =>  "Products",
                        "view"      =>  $view
                );
                $psm["where_condition"] =   "category_id lIKE '".$view['vendorproduct_category']."'";
                $osm['tiporderby']  =   "category_name";
                $osm['order_by']    =   "ASC";
                $data["res"]        =   $this->category_model->viewCategory($osm); 
                $data["measure"]    =   $this->measure_model->viewMeasure(); 
                $data["result"]       =   $this->category_model->viewsub_categories($psm);
                if ($this->input->post("submit")) {
                    $this->form_validation->set_rules("category","Category","required");
                    $this->form_validation->set_rules("sub_category","Sub Category","required");
                    $this->form_validation->set_rules("vendorproduct_product","Product","required");
                    $this->form_validation->set_rules("vendorproduct_description","Description","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_model","Model","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_brand","Brand","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_quantity","Quantity","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_price","Price","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_mrp","MRP","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_measure","Measure","required|trim|xss_clean");  
                    $this->form_validation->set_rules("vendorproduct_tax_class","Tax Class","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_shipping","Shipping","required|trim|xss_clean");   
                    if($this->form_validation->run() == TRUE){
                        $insert_loc = $this->vendor_model->product_update($view['vendorproduct_id']);
                        if ($insert_loc) {
                            $this->session->set_flashdata("suc", "Product has been updated successfully");
                            redirect("/vendor_product");
                        } else {
                            $this->session->set_flashdata("err", "Product has been not updated.Please try again.");
                            redirect("/vendor_product");
                        }
                    }
                }
                $this->load->view('theme/inner_template',$data);
            }else{
                redirect("/vendor");
            }
        }
        public function vendor_delete_product(){
            $otp_mobile_no     =   $this->session->userdata("otpmobileno"); 
            $ins    =   $this->vendor_model->view_profile($otp_mobile_no); 
            if($ins != "" && count($ins) > 0){ 
                $uroi   =   $this->uri->segment("3"); 
                $opsm["whereCondition"] =   "vendorproduct_code LIKE '".$uroi."'";
                $view   =   $this->vendor_model->getVendorproduct($opsm); 
                if (count($view) > 0) { 
                    $insert_loc = $this->vendor_model->product_delete($view['vendorproduct_id']);
                    if ($insert_loc) {
                        $this->session->set_flashdata("suc", "Product has been updated successfully");
                        redirect("/vendor_product");
                    } else {
                        $this->session->set_flashdata("err", "Product has been not updated.Please try again.");
                        redirect("/vendor_product");
                    } 
                } 
            } else{
                redirect("/vendor");
            }
        }
        public function ajaxActivestatus(){
            $vendrprod  =   $this->input->post("vendrprod");
            $status     =   $this->input->post("status");
            echo $this->vendor_model->ajaxActivestatus($vendrprod,$status);
        }
}