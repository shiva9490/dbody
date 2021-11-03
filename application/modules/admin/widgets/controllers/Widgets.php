<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widgets extends CI_Controller {
    	public function __construct() {
            parent::__construct();
            if($this->session->userdata("manage-widgets") != "1"){
                redirect(sitedata("site_admin")."/dashboard");
            }
        }
        public function index()  {
            $dta = array(
                        "title"     => "Widgets",
                        "content"   => "index",
                        "limit"     => 1
            );
            if ($this->input->post("submit")) {
                    $this->form_validation->set_rules("widget_display_name", "Widget Display Name", 'required|xss_clean|trim');
                    if ($this->form_validation->run() == TRUE) {
                        $insert_location = $this->widget_model->create_widget();
                        if ($insert_location) {
                            $this->session->set_flashdata("suc", "Widget has been added successfully");
                            redirect(sitedata("site_admin")."/widgets");
                        } else {
                            $this->session->set_flashdata("err", "Widget has been not added.Please try again.");
                            redirect(sitedata("site_admin")."/widgets");
                        }
                    }
            }
            $conditions     =   array(); 
            $keywords   =   $this->input->get('keywords'); 
            if(!empty($keywords)){
                $conditions['keywords'] = $keywords;
            }  
            $perpage        =    $this->input->get("limitvalue")?$this->input->get("limitvalue"):$this->config->item("pagination");    
            $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
            $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"id";  
            $totalRec       =    $this->widget_model->cntviewWidget($conditions);  
            $config['base_url']    =    bildourl("viewWidget");
            $config['total_rows']  =    $totalRec;
            $config['per_page']    =    $perpage;
            $config['link_func']   =    'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['order_by']     =   $orderby;
            $conditions['tipoOrderby']  =   $tipoOrderby; 
            $conditions['limit']   =    $this->config->item("pagination"); 
            $dta["view"]           =    $this->widget_model->view_widget($conditions);
            $this->load->view("admin/inner_template",$dta); 
        }
        public function viewWidget(){
            $conditions =   array();
            $page       =   $this->uri->segment('3');
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords'); 
            if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
            }  
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):$this->config->item("pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"id";  
            $totalRec               =   $this->widget_model->cntviewWidget($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            } 
            $config['base_url']     =   bildourl('viewWidget');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            $conditions['limit']    =   $perpage;
            $dta["limit"]           =   $offset+1;
            $dta["view"]    = $this->widget_model->view_widget($conditions);
            $this->load->view("ajax_widgets",$dta);
        }
        public function delete_widget(){
                if($this->session->userdata("delete-widget") != "1"){
                    redirect("/bildo-admin");
                }
                $uri    =   $this->uri->segment("3");
                $vue    =   $this->widget_model->get_widget($uri);
                if(count($vue) > 0){
                        $bt     =   $this->widget_model->delete_widget($uri); 
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
        public function update_widget(){
                if($this->session->userdata("update-widget") != "1"){
                    redirect("/bildo-admin");
                }
                $uri    =   $this->uri->segment("3"); 
                $vue    =   $this->widget_model->get_widget($uri);
                if(count($vue) > 0){
                        $dt     =   array(
                                "title"     =>  "Update Widget",
                                "content"   =>  "update_widget",
                                "view"      =>  $vue
                        ); 
                        if($this->input->post("submit")){
                                $bt     =   $this->widget_model->update_widget($uri);
                                if($bt > 0){
                                        $this->session->set_flashdata("suc","Widget has been updated Successfully.");
                                        redirect(sitedata("site_admin")."/update-widget/".$uri);
                                }else{
                                        $this->session->set_flashdata("err","Not Updated any widget.Please try again.");
                                        redirect(sitedata("site_admin")."/update-widget/".$uri);    
                                } 
                        }
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Widget does not exists."); 
                        redirect("bildo-admin/widgets");
                }
        }
        public function unique_widget_name(){
                echo $this->widget_model->unique_widget($this->input->post("widget_unit"));
        }
}