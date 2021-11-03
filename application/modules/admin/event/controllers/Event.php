<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Event extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-occasion") != '1'){
                        redirect(sitedata("site_admin")."/dashboard");
                }
        }
        public function index(){
                $dta   =    array(
                    "title"     =>  "Occasion",
                    "content"   =>  "event",
                    "limit"     =>  1,
                     "res"      =>  $this->category_model->viewCategory(array("order_by" => "ASC","tiporderby" => "category_name")),
                     "result"   =>  $this->category_model->viewsub_categories()
                );
                if($this->input->post("submit")){
                    $this->form_validation->set_rules("name","Occasion Name","required|callback_unique_event");
                    if($this->form_validation->run() == TRUE){
                        $ins    =   $this->event_model->create_event();
                        if($ins){
                            $this->session->set_flashdata("suc","Occasion has been created successfully");
                            redirect(sitedata("site_admin")."/Event");
                        }else{
                            $this->session->set_flashdata("err","Occasion has been not created.Please try again.");
                            redirect(sitedata("site_admin")."/Event");
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
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tiporderby')):"eventid"; 
                $totalRec   =   $this->event_model->cntviewEvent($conditions); 
                $config['base_url']    =    bildourl("viewEvent");
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $perpage;//sitedata("site_pagination"); 
                $config['link_func']   =    'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['order_by']    =  $orderby;
                $conditions['tiporderby']  =  $tipoOrderby; 
                $conditions['limit']    =   $perpage;//sitedata("site_pagination"); 
                $dta['view']            =   $this->event_model->viewEvent($conditions);
                $this->load->view("admin/inner_template",$dta);
        }
        public function viewEvent(){
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tiporderby     =    $this->input->post('tiporderby')?str_replace("+"," ",$this->input->post('tiporderby')):"eventid";  
                $totalRec               =   $this->event_model->cntviewEvent($conditions);  
                if(!empty($orderby) && !empty($tiporderby)){ 
                        $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                        $dta['tiporderby']    =   $conditions['tiporderby']   =  $tiporderby; 
                } 
                $config['base_url']     =   bildourl('viewEvent');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->event_model->viewEvent($conditions);
                $this->load->view("ajax_event",$dta);
        }
        public function create_event(){
                $dta   =    array(
                    "title"     =>  "Create Occasion",
                    "content"   =>  "create_event",
                    "limit"     =>  1,
                );
                if($this->input->post("submit")){
                    $this->form_validation->set_rules("name","Occasion Name","required|callback_unique_event");
                    //$this->form_validation->set_rules("image","Image","required");
                    if($this->form_validation->run() == TRUE){
                        $ins    =   $this->event_model->create_event();
                        if($ins){
                            $this->session->set_flashdata("suc","Occasion has been created successfully");
                            redirect(sitedata("site_admin")."/Event");
                        }else{
                            $this->session->set_flashdata("err","Occasion has been not created.Please try again.");
                            redirect(sitedata("site_admin")."/Event");
                        }
                    }
                }
                $this->load->view("admin/inner_template",$dta);   
        }
        public function update_event(){
                if($this->session->userdata("update-occasion") != '1'){
                    redirect(sitedata("site_admin")."/dashboard");
                }
                $uri    =   $this->uri->segment("3"); 
                $params["where_condition"]   =   "event_id LIKE '".$uri."'";
                $vue    =   $this->event_model->getevent($params);
                if(count($vue) > 0){
                        $dt     =   array(
                                "title"     =>  "Update Occasion",
                                "content"   =>  "update_event",
                                "view"      =>  $vue,
                        ); 
                        if($this->input->post("submit")){
                             $this->form_validation->set_rules("name","Occasion Name","required");
                            if($this->form_validation->run() == TRUE){
                                $bt     =   $this->event_model->update_event($uri);
                                if($bt > 0){
                                    $this->session->set_flashdata("suc","Occasion update Successfully.");
                                    redirect(sitedata("site_admin")."/Event");
                                }else{
                                    $this->session->set_flashdata("err","Not Updated Occasion.Please try again.");
                                    redirect(sitedata("site_admin")."/update-Event/".$uri);    
                                }
                            }
                        }
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Occasion does not exists."); 
                        redirect(sitedata("site_admin")."/Event");
                }
        }
        public function delete_event(){
                if($this->session->userdata("delete-occasion") != '1'){
                    redirect(sitedata("site_admin")."/dashboard");
                }
                $uri    =   $this->uri->segment("3");
                $params["where_condition"]   =   "event_id LIKE '".$uri."'";
                $vue    =   $this->event_model->getevent($params);
                if(count($vue) > 0){
                        $bt     =   $this->event_model->delete_Event($uri); 
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
        public function activedeactive(){
                $vsp    =   "0";
                if($this->session->userdata("active-deactive-occasion") != '1'){
                    $vsp    =   "0";
                }else{
                    $status     =   $this->input->post("status");
                    $uri        =   $this->input->post("fields"); 
                    $psm['whereCondition']  =   "event_id = '".$uri."'";
                    $vue    =   $this->event_model->getevent($psm);
                    if(is_array($vue) && count($vue) > 0){
                            $bt     =   $this->event_model->activedeactive($uri,$status); 
                            if($bt > 0){
                                $vsp    =   1;
                            }
                    }else{
                        $vsp    =   2;
                    } 
                } 
                echo $vsp;
        } 
        public function unique_event($str){ 
                $vsp	=	$this->event_model->unique_event($str); 
                if($vsp){
                        $this->form_validation->set_message("name","Occasion Name already exists.");
                        return FALSE;
                }	
                return TRUE; 
        }
        public function ajax_items(){
                $cat	= explode(',',$this->input->post('cat_id'));
                $dta["prod"] 	= explode(',',$this->input->post('product_id'));
                $i=0; 
                foreach($cat as $c){
                    if($i==0){
                        $par['where_condition'] = "subcategory_category = '".$c."'";
                    }else{
                        $par['where_condition'] .= " OR subcategory_category = '".$c."'";
                    }
                    $i++;
                }
                $par['columns']	="distinct(subcategory_name),subcategory_id ";
                $dta["items"]            =   $this->category_model->viewsub_categories($par);
                $this->load->view("ajax_items",$dta); 
        }
        public function __destruct(){
                $this->db->close();
        }
}