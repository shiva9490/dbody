<?php

class Measure extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-measures") != '1'){
                    redirect(sitedata("site_admin")."/dashboard");
                }
        }
        public function index(){ 
                $dta    =   array( 
                                    "title"     =>  "Measures",
                                    "content"   =>  "measure",
                                    "limit"     =>  "1"
                            );
                
                if($this->input->post("submit")){
                        $this->form_validation->set_rules("measure_unit","Measure Name","required|xss_clean|trim|min_length[3]|max_length[50]|callback_check_measure_unit");
                        if($this->form_validation->run() == TRUE){
                                $bt     =   $this->measure_model->create_measure();
                                if($bt > 0){
                                        $this->session->set_flashdata("suc","Created a Measure Successfully.");
                                        redirect(sitedata("site_admin")."/measures");
                                }else{
                                        $this->session->set_flashdata("err","Not Created a Measure.Please try again.");
                                        redirect(sitedata("site_admin")."/measures");
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
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"measureid";  
                $totalRec               =   $this->measure_model->cntviewMeasure($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                        $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                        $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
                } 
                $config['base_url']     =   bildourl('viewMeasure');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['limit']    =   $perpage;
                $dta["view"]            =   $this->measure_model->viewMeasure($conditions);
                $this->load->view("admin/inner_template",$dta); 
        }
        public function unique_measure_name(){
                $vsp	=	$this->measure_model->checkuniquemeasure(); 
                $shp    =   "false";
                if(!$vsp){
                    $shp    =   "true";
                }
                echo $shp;
        }
        public function check_measure_unit(){ 
                $vsp	=	$this->measure_model->checkuniquemeasure(); 
                if($vsp){
                        $this->form_validation->set_message("check_measure_unit","Measure Name already exists.");
                        return FALSE;
                }	
                return TRUE; 
        }
        public function delete_measure(){
                if($this->session->userdata("delete-measure") != '1'){
                        redirect(sitedata("site_admin"));
                }
                $uri    =   $this->uri->segment("3");
                $vue    =   $this->measure_model->get_measure($uri);
                if(count($vue) > 0){
                        $bt     =   $this->measure_model->delete_measure($uri); 
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
        public function update_measure(){
                if($this->session->userdata("update-measure") != '1'){
                        redirect(sitedata("site_admin"));
                } 
                $uri    =   $this->uri->segment("3"); 
                $vue    =   $this->measure_model->get_measure($uri);
                if(count($vue) > 0){
                        $dt     =   array(
                                "title"     =>  "Update Measure",
                                "content"   =>  "update_measure",
                                "view"      =>  $vue
                        ); 
                        if($this->input->post("submit")){
                                $this->form_validation->set_rules("measureunit","Measure Name","required|xss_clean|trim|max_length[50]");
                                if($this->form_validation->run() == TRUE){
                                        $bt     =   $this->measure_model->update_measure($uri);
                                        if($bt > 0){
                                                $this->session->set_flashdata("suc","Updated Measure Successfully.");
                                                redirect(sitedata("site_admin")."/measures");
                                        }else{
                                                $this->session->set_flashdata("err","Not Updated Measure.Please try again.");
                                                redirect(sitedata("site_admin")."/update-measure/".$uri);    
                                        }
                                }
                        }
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Measure does not exists."); 
                        redirect(sitedata("site_admin")."/measures");
                }
        }
        public function viewMeasure(){ 
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"measureid";  
                $totalRec               =   $this->measure_model->cntviewMeasure($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                        $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                        $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
                } 
                $config['base_url']     =   bildourl('viewMeasure');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->measure_model->viewMeasure($conditions);
                $this->load->view("ajax_measure",$dta);
        }
}