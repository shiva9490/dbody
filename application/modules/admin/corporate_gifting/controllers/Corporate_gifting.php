<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Corporate_gifting extends CI_Controller {
    	public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-corporate_gifting") != "1"){
                    redirect(sitedata("site_admin")."/dashboard");
                }
        }
        public function add_corporate_gifting()  {
            $dta = array(
                        "title" => "Corporate_gifting",
                        "content" => "add_corporate_gifting",
                        "limit" => 1
            );
            if ($this->input->post("submit")) {
                    $fname      =   $_FILES['corporate_gifting_image']['name'];
                    if (empty($fname)){
                        $this->form_validation->set_rules('corporate_gifting_image', 'Corporate_gifting Image', 'required');
                    }
                    else {
                        $insert_location = $this->corporate_gifting_model->createCorporate_gifting($fname);
                        if ($insert_location) {
                                $this->session->set_flashdata("suc", "Corporate_gifting added successfully");
                        } else {
                                $this->session->set_flashdata("err", "Please try again.");
                        }
                        redirect(sitedata("site_admin")."/corporate_gifting");
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
            $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get ('tipoOrderby')):"corporate_giftingid";  
            $totalRec       =   $this->corporate_gifting_model->cntviewCorporate_gifting($conditions);  
            $config['base_url']    =    bildourl("viewCorporate_gifting");
            $config['total_rows']  =    $totalRec;
            $config['per_page']    =    $perpage;
            $config['link_func']   =    'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['order_by']     = $orderby;
            $conditions['tipoOrderby']  =  $tipoOrderby; 
            $conditions['limit']   =    $this->config->item("pagination"); 
            $dta["view"]           =    $this->corporate_gifting_model->viewCorporate_gifting($conditions);
            $this->load->view("admin/inner_template",$dta); 
        }
        public function viewCorporate_gifting(){
            $conditions =   array();
            $page       =   $this->uri->segment('3');
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords'); 
            if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
            }  
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):$this->config->item("pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"corporate_giftingid";  
            $totalRec               =   $this->corporate_gifting_model->cntviewCorporate_gifting($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            } 
            $config['base_url']     =   bildourl('viewCorporate_gifting');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            $conditions['limit']    =   $perpage;
            $dta["limit"]           =   $offset+1;
            $dta["view"]    = $this->corporate_gifting_model->viewCorporate_gifting($conditions);
            $this->load->view("ajax_corporate_gifting",$dta);
        }
        public function delete_corporate_gifting(){
                if($this->session->userdata("delete-corporate_gifting") != "1"){
                    redirect(sitedata("site_admin")."/dashboard");
                }
                $uri    =   $this->uri->segment("3");
                $vue    =   $this->corporate_gifting_model->getCorporate_gifting($uri);
                if(count($vue) > 0){
                        $bt     =   $this->corporate_gifting_model->deletecorporate_gifting($uri); 
                        if($bt > 0){
                            $this->session->set_flashdata("suc","Deleted  Successfully.");
                            redirect(sitedata("site_admin")."/corporate_gifting");
                        }else{
                            $this->session->set_flashdata("err","Not Deleted .Please try again.");
                            redirect(sitedata("site_admin")."/corporate_gifting");
                        }
                }else{
                        $this->session->set_flashdata("war","Corporate_gifting does not exists."); 
                        redirect(sitedata("site_admin")."/corporate_gifting");
                }
        }
        public function update_corporate_gifting(){
                if($this->session->userdata("update-corporate_gifting") != "1"){
                    redirect(sitedata("site_admin")."/dashboard");
                }
                $uri    =   $this->uri->segment("3"); 
                $vue    =   $this->corporate_gifting_model->getCorporate_gifting($uri);
                if(count($vue) > 0){
                        $dt     =   array(
                                "title"     =>  "Update Corporate_gifting",
                                "content"   =>  "update_corporate_gifting",
                                "view"      =>  $vue
                        ); 
                        if($this->input->post("submit")){ 
                                $bt     =   $this->corporate_gifting_model->updateCorporate_gifting($uri);
                                if($bt > 0){
                                        $this->session->set_flashdata("suc","Corporate_gifting Updated Successfully.");
                                }else{
                                        $this->session->set_flashdata("err","Not Updated.Please try again.");
                                }
                        redirect(sitedata("site_admin")."/corporate_gifting");
                        }
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Corporate_gifting does not exists."); 
                        redirect(sitedata("site_admin")."/corporate_gifting");
                }
        }
        
        
  }
