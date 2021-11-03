<?php

class Deliverycharges extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-measures") != '1'){
                    redirect(sitedata("site_admin")."/dashboard");
                }
        }
        public function index(){ 
                $deliverytype = $this->deliverycharges_model->viewDeliverytype();
                $dta    =   array( 
                                    "title"     =>  "Delivery charges",
                                    "content"   =>  "deliverycharges",
                                    "limit"     =>  "1",
                                    "types"     =>  $deliverytype
                            );
                
                if($this->input->post("submit")){
                        $this->form_validation->set_rules("delivery_type","Delivery Type","required");
                        $this->form_validation->set_rules("deliverychg_start","Delivery Start Time","required");
                        $this->form_validation->set_rules("deliverychg_end","Delivery End Time","required");
                        $this->form_validation->set_rules("deliverychg_amount","Delivery Amount","required");
                        if($this->form_validation->run() == TRUE){
                                $bt     =   $this->deliverycharges_model->create_deliverycharges();
                                if($bt > 0){
                                        $this->session->set_flashdata("suc","Created a Delivery charges Successfully.");
                                        redirect(sitedata("site_admin")."/Deliverycharges");
                                }else{
                                        $this->session->set_flashdata("err","Not Created a Delivery charges.Please try again.");
                                        redirect(sitedata("site_admin")."/Deliverycharges");
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
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"deliverychg_id";  
                $totalRec               =   $this->deliverycharges_model->cntviewDeliverychg($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                        $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                        $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
                } 
                $config['base_url']     =   bildourl('viewDelivery');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['limit']    =   $perpage;
                $dta["view"]            =   $this->deliverycharges_model->viewDelivery($conditions);
                $this->load->view("admin/inner_template",$dta); 
        }
        public function unique_measure_name(){
                $vsp	=	$this->deliverycharges_model->checkuniquemeasure(); 
                $shp    =   "false";
                if(!$vsp){
                    $shp    =   "true";
                }
                echo $shp;
        }
        public function check_measure_unit(){ 
                $vsp	=	$this->deliverycharges_model->checkuniquemeasure(); 
                if($vsp){
                        $this->form_validation->set_message("check_measure_unit","Measure Name already exists.");
                        return FALSE;
                }	
                return TRUE; 
        }
        public function delete_deliverychg(){
                if($this->session->userdata("delete-deliverychg") != '1'){
                        redirect(sitedata("site_admin"));
                }
                $uri    =   $this->uri->segment("3");
                $vue    =   $this->deliverycharges_model->getdeliverychg($uri);
                if(count($vue) > 0){
                        $bt     =   $this->deliverycharges_model->delete_deliverychg($uri); 
                        if($bt > 0){
                                // $this->session->set_flashdata("suc","Deleted Delivery charges Successfully.");
                                // redirect(sitedata("site_admin")."/Deliverycharges");
                                $vsp=1;
                        }else{
                                // $this->session->set_flashdata("err","Not Deleted Delivery charges.Please try again.");
                                // redirect(sitedata("site_admin")."/Deliverycharges");
                                $vsp    =   0;
                        }
                }else{
                        // $this->session->set_flashdata("war","Delivery charges does not exists."); 
                        // redirect(sitedata("site_admin")."/Deliverycharges");
                        $vsp    =   2;
                }
                echo $vsp;
        }
        public function update_deliverychg(){
                if($this->session->userdata("update-deliverychg") != '1'){
                        redirect(sitedata("site_admin"));
                } 
                $uri    =   $this->uri->segment("3"); 
                $vue    =   $this->deliverycharges_model->getdeliverychg($uri);
                $deliverytype = $this->deliverycharges_model->viewDeliverytype();
                if(count($vue) > 0){
                        $dt     =   array(
                                "title"     =>  "Update Delivery charges",
                                "content"   =>  "update_deliverychg",
                                "view"      =>  $vue,
                                "types"     =>  $deliverytype
                        ); 
                        if($this->input->post("submit")){
                                $this->form_validation->set_rules("delivery_type","Delivery Type","required");
                                $this->form_validation->set_rules("deliverychg_start","Delivery Start Time","required");
                                $this->form_validation->set_rules("deliverychg_end","Delivery End Time","required");
                                $this->form_validation->set_rules("deliverychg_amount","Delivery Amount","required");
                                if($this->form_validation->run() == TRUE){
                                        $bt     =   $this->deliverycharges_model->update_deliverychg($uri);
                                        if($bt > 0){
                                                $this->session->set_flashdata("suc","Updated Delivery charges Successfully.");
                                                redirect(sitedata("site_admin")."/Deliverycharges");
                                        }else{
                                                $this->session->set_flashdata("err","Not Updated Delivery charges.Please try again.");
                                                redirect(sitedata("site_admin")."/update-measure/".$uri);    
                                        }
                                }
                        }
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Delivery charges does not exists."); 
                        redirect(sitedata("site_admin")."/Deliverycharges");
                }
        }
        public function viewDelivery(){ 
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"deliverychg_id";  
                $totalRec               =   $this->deliverycharges_model->cntviewDeliverychg($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                        $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                        $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
                } 
                $config['base_url']     =   bildourl('viewDelivery');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->deliverycharges_model->viewDelivery($conditions);
                $this->load->view("ajax_deliverychag",$dta);
        }
}