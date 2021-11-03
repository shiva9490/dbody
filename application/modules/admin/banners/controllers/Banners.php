<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banners extends CI_Controller {
    	public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-banners") != "1"){
                    redirect(sitedata("site_admin")."/dashboard");
                }
        }
        public function add_banner()  {
            $dta = array(
                        "title" => "Banners",
                        "content" => "add_banner",
                        "limit" => 1
            );
            if ($this->input->post("submit")) {
                    $fname      =   $_FILES['banner_image']['name'];
                    if (empty($fname)){
                        $this->form_validation->set_rules('banner_image', 'Banner Image', 'required');
                    }
                    else {
                        $insert_location = $this->banner_model->createBanner($fname);
                        if ($insert_location) {
                                $this->session->set_flashdata("suc", "Banner added successfully");
                        } else {
                                $this->session->set_flashdata("err", "Please try again.");
                        }
                        redirect(sitedata("site_admin")."/banners");
                    }
            }
            $conditions     =   array();
            if($this->input->get("search") != ""){
                $keywords   =   $this->input->get('keywords'); 
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                } 
            }
                   
            $perpage        =    $this->input->get("limitvalue")?$this->input->get("limitvalue"):$this->config->item("pagination");    
            $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
            $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get ('tipoOrderby')):"bannerid";  
            $totalRec       =   $this->banner_model->cntviewBanner($conditions);  
            $config['base_url']    =    bildourl("viewBanners");
            $config['total_rows']  =    $totalRec;
            $config['per_page']    =    $perpage;
            $config['link_func']   =    'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['order_by']     = $orderby;
            $conditions['tipoOrderby']  =  $tipoOrderby; 
            $conditions['limit']   =    $this->config->item("pagination"); 
            $dta["view"]           =    $this->banner_model->viewBanners($conditions);
            $this->load->view("admin/inner_template",$dta); 
        }
        public function viewBanners(){
            $conditions =   array();
            $page       =   $this->uri->segment('3');
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords'); 
            if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
            }  
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):$this->config->item("pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"bannerid";  
            $totalRec               =   $this->banner_model->cntviewBanner($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            } 
            $config['base_url']     =   bildourl('viewBanners');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            $conditions['limit']    =   $perpage;
            $dta["limit"]           =   $offset+1;
            $dta["view"]    = $this->banner_model->viewBanners($conditions);
            $this->load->view("ajax_banner",$dta);
        }
        public function delete_banner(){
                if($this->session->userdata("delete-banner") != "1"){
                    redirect(sitedata("site_admin")."/dashboard");
                }
                $uri    =   $this->uri->segment("3");
                $vue    =   $this->banner_model->getBanner($uri);
                if(count($vue) > 0){
                        $bt     =   $this->banner_model->deletebanner($uri); 
                        if($bt > 0){
                            $this->session->set_flashdata("suc","Deleted  Successfully.");
                            redirect(sitedata("site_admin")."/banners");
                        }else{
                            $this->session->set_flashdata("err","Not Deleted .Please try again.");
                            redirect(sitedata("site_admin")."/banners");
                        }
                }else{
                        $this->session->set_flashdata("war","Banner does not exists."); 
                        redirect(sitedata("site_admin")."/banners");
                }
        }
        public function update_banner(){
                if($this->session->userdata("update-banner") != "1"){
                    redirect(sitedata("site_admin")."/dashboard");
                }
                $uri    =   $this->uri->segment("3"); 
                $vue    =   $this->banner_model->getBanner($uri);
                if(count($vue) > 0){
                        $dt     =   array(
                                "title"     =>  "Update Banner",
                                "content"   =>  "update_banner",
                                "view"      =>  $vue
                        ); 
                        if($this->input->post("submit")){ 
                                $bt     =   $this->banner_model->updateBanner($uri);
                                if($bt > 0){
                                        $this->session->set_flashdata("suc","Banner Updated Successfully.");
                                }else{
                                        $this->session->set_flashdata("err","Not Updated.Please try again.");
                                }
                        redirect(sitedata("site_admin")."/banners");
                        }
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Banner does not exists."); 
                        redirect(sitedata("site_admin")."/banners");
                }
        }
        
        
  }
