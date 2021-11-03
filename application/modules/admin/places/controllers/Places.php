<?php

class Places extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-measures") != '1'){
                    redirect(sitedata("site_admin")."/dashboard");
                }
        }
        public function index(){
                $pre['where_condition']     = "pincodeopen = 1";
                $pre['group_by']    = "pincode_district";
                $views              =   $this->pincode_model->viewPincode($pre);
                $dta    =   array( 
                                    "title"     =>  "Places",
                                    "content"   =>  "places",
                                    "limit"     =>  "1",
                                    "views"     =>  $views
                            );
                $conditions = array();
                $keywords   =   $this->input->get('keywords'); 
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                }  
                
                $conditions['group_by']         = "pincode_district";
                $perpage        =    $this->input->get("limitvalue")?$this->input->get("limitvalue"):sitedata("site_pagination");
                $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"pincodeid";  
                $totalRec               =   $this->pincode_model->cntviewPincode($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                        $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                        $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
                }
                $config['base_url']     =   bildourl('viewPincode');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['limit']    =   $perpage;
                $dta["view"]            =   $this->pincode_model->viewPincode($conditions);
                $this->load->view("admin/inner_template",$dta); 
        }
        public function Update_Pincode(){
            $uri = $this->input->post('district');
            $status = $this->input->post('status');
            if($this->input->post("submit")){
                $bt     =   $this->pincode_model->update_pincode($uri,$status);
                if($bt > 0){
                        $this->session->set_flashdata("suc"," Place update Successfully.");
                        redirect(sitedata("site_admin")."/Pincode");
                }else{
                        $this->session->set_flashdata("err","Not update  Place.Please try again.");
                       redirect(sitedata("site_admin")."/Pincode");
                }
            }
                        
        }
        public function viewPincode(){ 
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                } 
                $conditions['where_condition'] = "pincodeopen = 0";
                $conditions['group_by'] = "pincode_district";
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"pincodeid";  
                $totalRec               =   $this->pincode_model->cntviewPincode($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                        $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                        $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
                } 
                $config['base_url']     =   bildourl('viewPincode');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->pincode_model->viewPincode($conditions);
                $this->load->view("ajax_pincode",$dta);
        }
}