<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Sub_category extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-sub-category") != '1'){
                        redirect(sitedata("site_admin")."/dashboard");
                }
        }
        public function index(){
                $dta   =    array(
                    "title"     =>  "Sub Category",
                    "content"   =>  "subcategory",
                    "limit"     =>  1,
                    "res"   =>  $this->category_model->viewCategory(array("order_by" => "ASC","tiporderby" => "category_name"))
                );
                if($this->input->post("submit")){
                    $this->form_validation->set_rules("category","Category","required");
                    $this->form_validation->set_rules("sub_category","Sub Category Name","required|min_length[2]|xss_clean|max_length[50]|callback_checkuniquesubcategory");
                    if($this->form_validation->run() == TRUE){
                        $ins    =   $this->category_model->create_sub_category();
                        if($ins){
                            $this->session->set_flashdata("suc","Sub Category has been created successfully");
                            redirect(sitedata("site_admin")."/subcategory");
                        }else{
                            $this->session->set_flashdata("err","Sub Category has been not created.Please try again.");
                            redirect(sitedata("site_admin")."/subcategory");
                        }
                    }
                }
                $conditions =   array(); 
                $keywords   =   $this->input->get('keywords'); 
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->get("limit")?$this->input->get("limit"):sitedata("site_pagination");
                $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tiporderby')):"subcategoryid"; 
                $totalRec   =   $this->category_model->cntviewsubCategory($conditions); 
                $config['base_url']    =    bildourl("viewsubCategory");
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $perpage;//sitedata("site_pagination"); 
                $config['link_func']   =    'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['order_by']    =  $orderby;
                $conditions['tiporderby']  =  $tipoOrderby; 
                $conditions['limit']    =   $perpage;//sitedata("site_pagination"); 
                $dta['view']            =   $this->category_model->viewsub_categories($conditions);
                $this->load->view("admin/inner_template",$dta);
        }
        public function viewsubCategory(){
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tiporderby     =    $this->input->post('tiporderby')?str_replace("+"," ",$this->input->post('tiporderby')):"categoryid";  
                $totalRec               =   $this->category_model->cntviewsubCategory($conditions);  
                if(!empty($orderby) && !empty($tiporderby)){ 
                        $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                        $dta['tiporderby']    =   $conditions['tiporderby']   =  $tiporderby; 
                } 
                $config['base_url']     =   bildourl('viewsubCategory');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->category_model->viewsub_categories($conditions);
                $this->load->view("ajax_subcategory",$dta);
        }
        public function update_sub_category(){
                if($this->session->userdata("update-sub-category") != '1'){
                    redirect(sitedata("site_admin")."/dashboard");
                }
                $uri    =   $this->uri->segment("3"); 
                $vue    =   $this->category_model->get_sub_category($uri);
                if(count($vue) > 0){
                        $dt     =   array(
                                "title"     =>  "Update Sub Category",
                                "content"   =>  "update_subcategory",
                                "res"   =>  $this->category_model->viewCategory(array("order_by" => "ASC","tiporderby" => "category_name")),
                                "view"      =>  $vue
                        ); 
                        if($this->input->post("submit")){
                            $this->form_validation->set_rules("category","Category","required");
                            $this->form_validation->set_rules("sub_category","Sub Category Name","required|min_length[2]|xss_clean|max_length[50]");
                            if($this->form_validation->run() == TRUE){
                                $bt     =   $this->category_model->update_sub_category($uri);
                                if($bt > 0){
                                    $this->session->set_flashdata("suc","Updated Sub Category Successfully.");
                                    redirect(sitedata("site_admin")."/subcategory");
                                }else{
                                    $this->session->set_flashdata("err","Not Updated Sub Category.Please try again.");
                                    redirect(sitedata("site_admin")."/update-sub-category/".$uri);    
                                }
                            }
                        }
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Sub Category does not exists."); 
                        redirect(sitedata("site_admin")."/sub-category");
                }
        }
        public function delete_sub_category(){
                if($this->session->userdata("delete-sub-category") != '1'){
                    redirect(sitedata("site_admin")."/dashboard");
                }
                $uri    =   $this->uri->segment("3");
                $vue    =   $this->category_model->get_sub_category($uri);
                if(count($vue) > 0){
                        $bt     =   $this->category_model->delete_sub_category($uri); 
                        if($bt > 0){
                                $vsp    =   1;
                        }else{
                                $vsp    =   2;
                        }
                }else{
                        $vsp    =   0;
                }
                echo $vsp;
        }      
        public function unique_subcategory_name(){
                echo $this->category_model->unique_subcategory_name($this->input->post("category"),$this->input->post("sub_category"));
        }
        public function checkuniquesubcategory($str){ 
                $vsp	=	$this->category_model->checkuniquesubcategory($str,$this->input->post("category")); 
                if($vsp){
                        $this->form_validation->set_message("checkuniquesubcategory","Sub category Name already exists.");
                        return FALSE;
                }	
                return TRUE; 
        }
        public function __destruct(){
                $this->db->close();
        }
}