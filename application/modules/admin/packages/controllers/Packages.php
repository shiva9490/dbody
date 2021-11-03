<?php

class Packages extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-packages") != '1'){
                    redirect(sitedata("site_admin")."/dashboard");
                }
        }
        public function index(){ 
                $dta    =   array( 
                                    "title"     =>  "Packages",
                                    "content"   =>  "index",
                                    "packgesmode"   =>  $this->packages_model->package_mode(),
                                    "limit"     =>  "1"
                            );
                
                if($this->input->post("submit")){
                        $this->form_validation->set_rules("package_name","Package Name","required|xss_clean|trim|min_length[3]|max_length[50]");
                        $this->form_validation->set_rules("package_price","Package Price","required|xss_clean|trim");
                        $this->form_validation->set_rules("package_banners","Package Banners","required|xss_clean|trim");
                        $this->form_validation->set_rules("package_expiry","Package Expiry","required|xss_clean|trim");
                        if($this->form_validation->run() == TRUE){
                                $bt     =   $this->packages_model->create_package();
                                if($bt > 0){
                                        $this->session->set_flashdata("suc","Created a Package Successfully.");
                                        redirect(sitedata("site_admin")."/packages");
                                }else{
                                        $this->session->set_flashdata("err","Not Created a Package.Please try again.");
                                        redirect(sitedata("site_admin")."/packages");
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
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"packageid";  
                $totalRec               =   $this->packages_model->cntviewPackage($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                        $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                        $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
                } 
                $config['base_url']     =   bildourl('viewPackage');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['limit']    =   $perpage;
                $dta["view"]            =   $this->packages_model->viewPackage($conditions);
                $this->load->view("admin/inner_template",$dta); 
        }
        public function delete_package(){
                if($this->session->userdata("delete-package") != '1'){
                        redirect(sitedata("site_admin"));
                }
                $uri    =   $this->uri->segment("3");
                $vue    =   $this->packages_model->get_package($uri);
                if(count($vue) > 0){
                        $bt     =   $this->packages_model->delete_package($uri); 
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
        public function update_package(){
                if($this->session->userdata("update-package") != '1'){
                        redirect(sitedata("site_admin"));
                } 
                $uri    =   $this->uri->segment("3"); 
                $vue    =   $this->packages_model->get_package($uri);
                if(count($vue) > 0){
                        $dt     =   array(
                                "title"     =>  "Update Package",
                                "packgesmode"   =>  $this->packages_model->package_mode(),
                                "content"   =>  "update_package",
                                "view"      =>  $vue
                        ); 
                        if($this->input->post("submit")){
                                $this->form_validation->set_rules("package_name","Package Name","required|xss_clean|trim|min_length[3]|max_length[50]");
                                $this->form_validation->set_rules("package_price","Package Price","required|xss_clean|trim");
                                $this->form_validation->set_rules("package_banners","Package Banners","required|xss_clean|trim");
                                $this->form_validation->set_rules("package_expiry","Package Expiry","required|xss_clean|trim");
                                if($this->form_validation->run() == TRUE){
                                        $bt     =   $this->packages_model->update_package($uri);
                                        if($bt > 0){
                                                $this->session->set_flashdata("suc","Updated Package Successfully.");
                                                redirect(sitedata("site_admin")."/packages");
                                        }else{
                                                $this->session->set_flashdata("err","Not Updated Package.Please try again.");
                                                redirect(sitedata("site_admin")."/update-package/".$uri);    
                                        }
                                }
                        }
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Package does not exists."); 
                        redirect(sitedata("site_admin")."/packages");
                }
        }
        public function viewPackage(){ 
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"packageid";  
                $totalRec               =   $this->packages_model->cntviewPackage($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                        $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                        $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
                } 
                $config['base_url']     =   bildourl('viewPackage');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->packages_model->viewPackage($conditions);
                $this->load->view("ajax_package",$dta);
        }
}