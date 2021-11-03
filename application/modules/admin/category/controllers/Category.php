<?php

class Category extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-category") != '1'){
                    redirect(sitedata("site_admin")."/dashboard");
                }
        }
        public function index(){ 
                $dta    =   array( 
                                    "title"     =>  "Categories",
                                    "content"   =>  "category",
                                    "limit"     =>  "1"
                            );
                
                if($this->input->post("submit")){
                        $this->form_validation->set_rules("category_name","Category Name","required|xss_clean|trim|min_length[3]|max_length[50]|callback_check_category_name");
                        if($this->form_validation->run() == TRUE){
                                $bt     =   $this->category_model->create_category();
                                if($bt > 0){
                                        $this->session->set_flashdata("suc","Created a Category Successfully.");
                                        redirect(sitedata("site_admin")."/category");
                                }else{
                                        $this->session->set_flashdata("err","Not Created a Category.Please try again.");
                                        redirect(sitedata("site_admin")."/category");
                                }
                        }
                }
                $conditions = array();
                $keywords   =   $this->input->get('keywords'); 
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->get("limitvalue")?$this->input->get("limitvalue"):sitedata("site_pagination");
                $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"categoryid";  
                $totalRec               =   $this->category_model->cntviewCategory($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                        $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                        $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
                } 
                $config['base_url']     =   bildourl('viewCategory');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['limit']    =   $perpage;
                $dta["view"]            =   $this->category_model->viewCategory($conditions);
                $this->load->view("admin/inner_template",$dta); 
        }

        public function unique_category_name(){
                echo $this->category_model->unique_category($this->input->post("category_name"));
        }
        public function check_category_name(){ 
                $vsp	=	$this->category_model->checkuniquecategory(); 
                if($vsp){
                        $this->form_validation->set_message("check_category_name","Category Name already exists.");
                        return FALSE;
                }	
                return TRUE; 
        }
        public function delete_category(){
                if($this->session->userdata("delete-category") != '1'){
                        redirect(sitedata("site_admin"));
                }
                $uri    =   $this->uri->segment("3");
                $vue    =   $this->category_model->get_category($uri);
                if(count($vue) > 0){
                        $bt     =   $this->category_model->delete_category($uri); 
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
        public function update_category(){
                if($this->session->userdata("update-category") != '1'){
                        redirect(sitedata("site_admin"));
                } 
                $uri    =   $this->uri->segment("3"); 
                $vue    =   $this->category_model->get_category($uri);
                if(count($vue) > 0){
                        $dt     =   array(
                                "title"     =>  "Update Category",
                                "content"   =>  "update_category",
                                "view"      =>  $vue
                        ); 
                        if($this->input->post("submit")){
                                $this->form_validation->set_rules("categoryname","Category Name","required|xss_clean|trim|max_length[50]");
                                if($this->form_validation->run() == TRUE){
                                        $bt     =   $this->category_model->update_category($uri);
                                        if($bt > 0){
                                                $this->session->set_flashdata("suc","Updated Category Successfully.");
                                                redirect(sitedata("site_admin")."/category");
                                        }else{
                                                $this->session->set_flashdata("err","Not Updated Category.Please try again.");
                                                redirect(sitedata("site_admin")."/update-category/".$uri);    
                                        }
                                }
                        }
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Category does not exists."); 
                        redirect(sitedata("site_admin")."/category");
                }
        }
        public function viewCategory(){ 
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"categoryid";  
                $totalRec               =   $this->category_model->cntviewCategory($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                        $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                        $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
                } 
                $config['base_url']     =   bildourl('viewCategory');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->category_model->viewCategory($conditions);
                $this->load->view("ajax_category",$dta);
        }
}