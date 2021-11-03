<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Ingredients extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-Ingredients") != '1'){
                        redirect(sitedata("site_admin")."/dashboard");
                }
        }
        public function index(){
                $dta   =    array(
                    "title"     =>  "Ingredients",
                    "content"   =>  "ingredients",
                    "limit"     =>  1,
                     "res"      =>  $this->category_model->viewCategory(array("order_by" => "ASC","tiporderby" => "category_name")),
                     "result"   =>  $this->category_model->viewsub_categories()
                );
                if($this->input->post("submit")){
                    $this->form_validation->set_rules("category_id","Category","required");
                    //$this->form_validation->set_rules("sub_category","Sub Category Name","required");
                    $this->form_validation->set_rules("prod_indug","Ingredients Name","required");
                    if($this->form_validation->run() == TRUE){
                        $ins    =   $this->ingredients_model->create_ingredients();
                        if($ins){
                            $this->session->set_flashdata("suc","ingredients has been created successfully");
                            redirect(sitedata("site_admin")."/Ingredients");
                        }else{
                            $this->session->set_flashdata("err","ingredients has been not created.Please try again.");
                            redirect(sitedata("site_admin")."/Ingredients");
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
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tiporderby')):"prodind"; 
                $totalRec   =   $this->ingredients_model->cntviewIngredients($conditions); 
                $config['base_url']    =    bildourl("viewsubCategory");
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $perpage;//sitedata("site_pagination"); 
                $config['link_func']   =    'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['order_by']    =  $orderby;
                $conditions['tiporderby']  =  $tipoOrderby; 
                $conditions['limit']    =   $perpage;//sitedata("site_pagination"); 
                $dta['view']            =   $this->ingredients_model->viewIngredients($conditions);
                $this->load->view("admin/inner_template",$dta);
        }
        public function viewIngredients(){
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tiporderby     =    $this->input->post('tiporderby')?str_replace("+"," ",$this->input->post('tiporderby')):"prodind";  
                $totalRec               =   $this->ingredients_model->cntviewIngredients($conditions);  
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
                $dta["view"]            =   $this->ingredients_model->viewIngredients($conditions);
                $this->load->view("ajax_subcategory",$dta);
        }
        public function update_ingredients(){
                if($this->session->userdata("update-ingredients") != '1'){
                    redirect(sitedata("site_admin")."/dashboard");
                }
                $uri    =   $this->uri->segment("3"); 
                $params["where_condition"]   =   "prodind LIKE '".$uri."'";
                $vue    =   $this->ingredients_model->getingredients($params);
                if(count($vue) > 0){
                        $dt     =   array(
                                "title"     =>  "Update Ingredients",
                                "content"   =>  "update_ingredients",
                                "res"       =>  $this->category_model->viewCategory(array("order_by" => "ASC","tiporderby" => "category_name")),
                                "view"      =>  $vue
                        ); 
                        if($this->input->post("submit")){
                             $this->form_validation->set_rules("category_id","Category","required");
                            //$this->form_validation->set_rules("sub_category","Sub Category Name","required");
                            $this->form_validation->set_rules("prod_indug","Ingredients Name","required");
                            if($this->form_validation->run() == TRUE){
                                $bt     =   $this->ingredients_model->update_ingredients($uri);
                                if($bt > 0){
                                    $this->session->set_flashdata("suc","Ingredients update Successfully.");
                                    redirect(sitedata("site_admin")."/Ingredients");
                                }else{
                                    $this->session->set_flashdata("err","Not Updated Ingredients.Please try again.");
                                    redirect(sitedata("site_admin")."/update-Ingredients/".$uri);    
                                }
                            }
                        }
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Ingredients does not exists."); 
                        redirect(sitedata("site_admin")."/Ingredients");
                }
        }
        public function delete_ingredients(){
                if($this->session->userdata("delete-ingredients") != '1'){
                    redirect(sitedata("site_admin")."/dashboard");
                }
                $uri    =   $this->uri->segment("3");
                $params["where_condition"]   =   "prodind LIKE '".$uri."'";
                $vue    =   $this->ingredients_model->getingredients($params);
                if(count($vue) > 0){
                        $bt     =   $this->ingredients_model->delete_Ingredients($uri); 
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
        public function ingredients_list(){
                $uri    =   $this->input->post('category_id');
                echo $this->ingredients_model->listinsr($uri);
        }      
        public function ingredients_lists(){
                $uri    =   $this->input->post('category_id');
                echo $this->ingredients_model->listinsrt($uri);
        }      
        public function unique_ingredients(){
                echo $this->ingredients_model->unique_ingredients_name($this->input->post("category"),$this->input->post("sub_category"));
        }
        public function checkuniquesubingredients($str){ 
                $vsp	=	$this->ingredients_model->checkuniquesubingredients($str,$this->input->post("prod_indug")); 
                if($vsp){
                        $this->form_validation->set_message("checkuniquesubingredients","Ingredients Name already exists.");
                        return FALSE;
                }	
                return TRUE; 
        }
        public function __destruct(){
                $this->db->close();
        }
}