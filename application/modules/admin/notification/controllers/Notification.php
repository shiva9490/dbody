<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller {
    	public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-notifications") != "1"){
                    redirect(sitedata("site_admin")."/dashboard");
                }
        }
        public function add_notification()  {
            $dta = array(
                        "title" => "Notifications",
                        "content" => "add_notification",
                        "limit" => 1
            );
            if ($this->input->post("submit")) {
                    $fname      =   $_FILES['notification_image']['name'];
                    if (empty($fname)){
                        $this->form_validation->set_rules('notification_image', 'Notification Image', 'required');
                    }
                    else {
                        $insert_location = $this->notification_model->createNotification($fname);
                        if ($insert_location) {
                                $this->session->set_flashdata("suc", "Popup Notification added successfully");
                        } else {
                                $this->session->set_flashdata("err", "Please try again.");
                        }
                        redirect(sitedata("site_admin")."/notifications");
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
            $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get ('tipoOrderby')):"notificationid";  
            $totalRec       =   $this->notification_model->cntviewNotification($conditions);  
            $config['base_url']    =    bildourl("viewNotifications");
            $config['total_rows']  =    $totalRec;
            $config['per_page']    =    $perpage;
            $config['link_func']   =    'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['order_by']     = $orderby;
            $conditions['tipoOrderby']  =  $tipoOrderby; 
            $conditions['limit']   =    $this->config->item("pagination"); 
            $dta["view"]           =    $this->notification_model->viewNotifications($conditions);
            $this->load->view("admin/inner_template",$dta); 
        }
        public function viewNotifications(){
            $conditions =   array();
            $page       =   $this->uri->segment('3');
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords'); 
            if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
            }  
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):$this->config->item("pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"notificationid";  
            $totalRec               =   $this->notification_model->cntviewNotification($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            } 
            $config['base_url']     =   bildourl('viewNotifications');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            $conditions['limit']    =   $perpage;
            $dta["limit"]           =   $offset+1;
            $dta["view"]    = $this->notification_model->viewNotifications($conditions);
            $this->load->view("ajax_notification",$dta);
        }
        public function delete_notification(){
                if($this->session->userdata("delete-notification") != "1"){
                    redirect(sitedata("site_admin")."/dashboard");
                }
                $uri    =   $this->uri->segment("3");
                $vue    =   $this->notification_model->getNotification($uri);
                if(count($vue) > 0){
                        $bt     =   $this->notification_model->deletenotification($uri); 
                        if($bt > 0){
                            $this->session->set_flashdata("suc","Deleted  Successfully.");
                            redirect(sitedata("site_admin")."/notifications");
                        }else{
                            $this->session->set_flashdata("err","Not Deleted .Please try again.");
                            redirect(sitedata("site_admin")."/notifications");
                        }
                }else{
                        $this->session->set_flashdata("war","Popup Notification does not exists."); 
                        redirect(sitedata("site_admin")."/notifications");
                }
        }
        public function update_notification(){
                if($this->session->userdata("update-notification") != "1"){
                    redirect(sitedata("site_admin")."/dashboard");
                }
                $uri    =   $this->uri->segment("3"); 
                $vue    =   $this->notification_model->getNotification($uri);
                if(count($vue) > 0){
                        $dt     =   array(
                                "title"     =>  "Update Notification",
                                "content"   =>  "update_notification",
                                "view"      =>  $vue
                        ); 
                        if($this->input->post("submit")){ 
                                $bt     =   $this->notification_model->updateNotification($uri);
                                if($bt > 0){
                                        $this->session->set_flashdata("suc","Popup Notification Updated Successfully.");
                                }else{
                                        $this->session->set_flashdata("err","Not Updated.Please try again.");
                                }
                        redirect(sitedata("site_admin")."/notifications");
                        }
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Popup Notification does not exists."); 
                        redirect(sitedata("site_admin")."/notifications");
                }
        }
        public function activedeactive(){
                $vsp    =   "0";
                if($this->session->userdata("active-deactive-notification") != '1'){
                    $vsp    =   "0";
                }else{
                    $status     =   $this->input->post("status");
                    $uri        =   $this->input->post("fields"); 
                    $psm['whereCondition']  =   "notification_id = '".$uri."'";
                    $vue    =   $this->notification_model->getNotification($uri);
                    if(is_array($vue) && count($vue) > 0){
                            $bt     =   $this->notification_model->activedeactive($uri,$status); 
                            if($bt > 0){
                                $vsp    =   1;
                            }
                    }else{
                        $vsp    =   2;
                    } 
                } 
                echo $vsp;
        }
        
        
  }
