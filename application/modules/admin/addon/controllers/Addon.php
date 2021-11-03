<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Addon extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-addon") != '1'){
                        redirect(sitedata("site_admin")."/dashboard");
                }
        }
        public function index(){
                $dta   =    array(
                    "title"     =>  "Addon",
                    "content"   =>  "addon",
                    "limit"     =>  1,
                     "res"      =>  $this->category_model->viewCategory(array("order_by" => "ASC","tiporderby" => "category_name")),
                     "result"   =>  $this->category_model->viewsub_categories()
                );
                if($this->input->post("submit")){
                    $this->form_validation->set_rules("category_id","Category","required");
                    if($this->form_validation->run() == TRUE){
                        $ins    =   $this->addon_model->create_addon();
                        if($ins){
                            $this->session->set_flashdata("suc","addon has been created successfully");
                            redirect(sitedata("site_admin")."/Addon");
                        }else{
                            $this->session->set_flashdata("err","addon has been not created.Please try again.");
                            redirect(sitedata("site_admin")."/Addon");
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
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tiporderby')):"addonid"; 
                $totalRec   =   $this->addon_model->cntviewAddon($conditions); 
                $config['base_url']    =    bildourl("viewAddon");
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $perpage;//sitedata("site_pagination"); 
                $config['link_func']   =    'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['order_by']    =  $orderby;
                $conditions['tiporderby']  =  $tipoOrderby; 
                $conditions['limit']    =   $perpage;//sitedata("site_pagination"); 
                $dta['view']            =   $this->addon_model->viewAddon($conditions);
                $this->load->view("admin/inner_template",$dta);
        }
        public function viewAddon(){
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tiporderby     =    $this->input->post('tiporderby')?str_replace("+"," ",$this->input->post('tiporderby')):"addonid";  
                $totalRec               =   $this->addon_model->cntviewAddon($conditions);  
                if(!empty($orderby) && !empty($tiporderby)){ 
                        $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                        $dta['tiporderby']    =   $conditions['tiporderby']   =  $tiporderby; 
                } 
                $config['base_url']     =   bildourl('viewAddon');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->addon_model->viewAddon($conditions);
                $this->load->view("ajax_addon",$dta);
        }
        public function create_addon(){
                $dta   =    array(
                    "title"     =>  "Create Addon",
                    "content"   =>  "create_addon",
                    "limit"     =>  1,
                     "res"      =>  $this->category_model->viewCategory(array("order_by" => "ASC","tiporderby" => "category_name")),
                     "result"   =>  $this->category_model->viewsub_categories()
                );
                if($this->input->post("submit")){
                    $this->form_validation->set_rules("category_id","Category","required");
                    if($this->form_validation->run() == TRUE){
                        $ins    =   $this->addon_model->create_addon();
                        if($ins){
                            $this->session->set_flashdata("suc","addon has been created successfully");
                            redirect(sitedata("site_admin")."/Addon");
                        }else{
                            $this->session->set_flashdata("err","addon has been not created.Please try again.");
                            redirect(sitedata("site_admin")."/Addon");
                        }
                    }
                }
                $this->load->view("admin/inner_template",$dta);   
        }
        public function update_addon(){
                if($this->session->userdata("update-addon") != '1'){
                    redirect(sitedata("site_admin")."/dashboard");
                }
                $uri    =   $this->uri->segment("3"); 
                $params["where_condition"]   =   "addon_id LIKE '".$uri."'";
                $vue    =   $this->addon_model->getaddon($params);
                $addo['whereCondition'] = "addon_items_addon_id = '".$uri."' AND addon_items_open ='1'";
                $cate    =   $this->addon_model->viewAddonItems($addo);
                $catt=array();$prod=array();
                foreach($cate as $ct){
                    if(!in_array($ct->addon_items_category_id, $catt, true)){
                        array_push($catt, $ct->addon_items_category_id);
                    }
                    array_push($prod, $ct->addon_items_item_id);
                }
                if(count($vue) > 0){
                        $dt     =   array(
                                "title"     =>  "Update Addon",
                                "content"   =>  "update_addon",
                                "res"       =>  $this->category_model->viewCategory(array("order_by" => "ASC","tiporderby" => "category_name")),
                                "view"      =>  $vue,
                                "catt"	    => 	$catt,
                                "result"   =>  $this->category_model->viewsub_categories(),
				"prod"	    => 	$prod,
                        ); 
                        if($this->input->post("submit")){
                             $this->form_validation->set_rules("category_id","Category","required");
                            if($this->form_validation->run() == TRUE){
                                $bt     =   $this->addon_model->update_addon($uri);
                                if($bt > 0){
                                    $this->session->set_flashdata("suc","Addon update Successfully.");
                                    redirect(sitedata("site_admin")."/Addon");
                                }else{
                                    $this->session->set_flashdata("err","Not Updated Addon.Please try again.");
                                    redirect(sitedata("site_admin")."/update-Addon/".$uri);    
                                }
                            }
                        }
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Addon does not exists."); 
                        redirect(sitedata("site_admin")."/Addon");
                }
        }
        public function delete_addon(){
                if($this->session->userdata("delete-addon") != '1'){
                    redirect(sitedata("site_admin")."/dashboard");
                }
                $uri    =   $this->uri->segment("3");
                $params["where_condition"]   =   "addon_id LIKE '".$uri."'";
                $vue    =   $this->addon_model->getaddon($params);
                if(count($vue) > 0){
                        $bt     =   $this->addon_model->delete_Addon($uri); 
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
                if($this->session->userdata("active-deactive-addon") != '1'){
                    $vsp    =   "0";
                }else{
                    $status     =   $this->input->post("status");
                    $uri        =   $this->input->post("fields"); 
                    $psm['whereCondition']  =   "addon_id = '".$uri."'";
                    $vue    =   $this->addon_model->getaddon($psm);
                    if(is_array($vue) && count($vue) > 0){
                            $bt     =   $this->addon_model->activedeactive($uri,$status); 
                            if($bt > 0){
                                $vsp    =   1;
                            }
                    }else{
                        $vsp    =   2;
                    } 
                } 
                echo $vsp;
        }  
        public function addon_list(){
                $uri    =   $this->input->post('category_id');
                echo $this->addon_model->listinsr($uri);
        }      
        public function addon_lists(){
                $uri    =   $this->input->post('category_id');
                echo $this->addon_model->listinsrt($uri);
        }      
        public function unique_addon(){
                echo $this->addon_model->unique_addon_name($this->input->post("category"),$this->input->post("sub_category"));
        }
        public function checkuniquesubaddon($str){ 
                $vsp	=	$this->addon_model->checkuniquesubaddon($str,$this->input->post("prod_indug")); 
                if($vsp){
                        $this->form_validation->set_message("checkuniquesubaddon","Addon Name already exists.");
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
                        $par['whereCondition'] = "vp.vendorproduct_category = '".$c."'";
                    }else{
                        $par['whereCondition'] .= " OR vp.vendorproduct_category = '".$c."'";
                    }
                    $i++;
                }
                $par['columns']	="product_name,vendorproduct_id,vendorproductprinceid,vendorproduct_bb_quantity,prod_indug";
                $dta["items"]            =   $this->vendor_model->viewVendorproducts_list($par);
                $this->load->view("ajax_items",$dta); 
        }
        public function __destruct(){
                $this->db->close();
        }
}