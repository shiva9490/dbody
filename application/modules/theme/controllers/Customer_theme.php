<?php
class Customer_theme extends CI_Controller{
    
        public function __construct(){
                parent::__construct(); 
                $orpmobile  =   $this->session->userdata("customer_id");
                if($orpmobile == ""){
                    redirect('/');
                }
        }
        public function index(){
            $orpmobile  =   $this->session->userdata("customer_mobile");
            $data =     array(
                            "content" => "customer/index",
                            "view"  =>  $this->customer_model->viewprofile($orpmobile)
                        );
            if ($this->input->post("submit")) {
            //print_r($this->input->post());exit;
                $this->form_validation->set_rules("customer_name", "Name", 'required|xss_clean|trim'); //required|valid_email|trim|xss_clean|callback_checkEmail
                $this->form_validation->set_rules("customer_mobile", "Mobile Number", 'required|xss_clean|trim|min_length[10]|max_length[10]');
                if($this->form_validation->run() == TRUE){
                    $insert_location = $this->customer_model->update_customer(); 
                    if ($insert_location) {
                        $this->session->set_flashdata("suc", "Update Customer details successfully");
                        redirect("/customer");
                    } else {
                        $this->session->set_flashdata("err", "Not Updated customer details.Please try again.");
                        redirect("/");
                    }
                }
            }
            $this->load->view('theme/inner_template',$data);
        }
        
        public function add_adddress(){ 
            $orpmobile  =   $this->session->userdata("customer_id");
            $view       =   $this->customer_model->viewprofile($orpmobile);
            $data =     array(
                            "content" => "customer/add-address",
                            "states"    => $this->common_model->getStates("1")
                        );
            if ($this->input->post("submit")){
                $this->form_validation->set_rules("fullname", "Full Name", 'required');
                $this->form_validation->set_rules("mobile", "Mobile No", 'required');
                //$this->form_validation->set_rules("state", "Address", 'required');
                $this->form_validation->set_rules("pincode", "Pincode", 'required');
                $this->form_validation->set_rules("address", "Address", 'required');
                $this->form_validation->set_rules("district", "District", 'required');
                $this->form_validation->set_rules("area", "Area", 'required');
                $this->form_validation->set_rules("locality", "Locality",'required');
                if($this->form_validation->run() == TRUE){
                    $insert_location = $this->customer_model->addaddress(); 
                    if ($insert_location) {
                        $this->session->set_flashdata("suc", "Added address details successfully");
                        redirect("/Add-Address");
                    } else {
                        $this->session->set_flashdata("err", "Not added any customer details.Please try again.");
                        redirect("/Add-Address");
                    }
                }
            }
            $this->load->view('theme/inner_template',$data);
        }
        public function my_address(){
            $orpmobile          =   $this->session->userdata("customer_id"); 
            $data["content"]    =   "customer/my_address";
            $conditions = array();
            $keywords   =   $this->input->get('keywords'); 
            if(!empty($keywords)){
                $conditions['keywords'] = $keywords;
            }  
            $perpage        =    $this->input->get("limitvalue")?$this->input->get("limitvalue"):sitedata("site_mainpagination");
            $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
            $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"customeraddressid";  
            $conditions['whereCondition'] = "customeraddress_customer LIKE '".$orpmobile."'";
            $totalRec               =   $this->customer_model->cntviewcustomeraddresss($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            } 
            $config['base_url']     =   base_url('viewAddresscustomer');
            $config['total_rows']   =   $totalRec;
            $config['uri_segment']  =   2; 
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['limit']    =   $perpage;
            $data["view"]           =   $this->customer_model->viewCustomeraddress($conditions);
            $this->load->view('theme/inner_template',$data);
        }
        public function update_address(){
            $orpmobile  =   $this->session->userdata("customer_id");
            $uri = $this->uri->segment("2");
            $par['whereCondition']  = "vsd.customeraddress_id = '".$uri."' and vsd.customer_id LIKE '".$orpmobile."'";
            $vue = $this->customer_model->viewCustomeraddress($par);
            if(isset($vue) && count($vue) >0){
                $view       =   $this->customer_model->viewprofile($orpmobile);
                $data =     array(
                    "content"   => "customer/update_address",
                    "address"    => $vue,
                );
                if ($this->input->post("submit")){
                    $this->form_validation->set_rules("fullname", "Full Name", 'required');
                    $this->form_validation->set_rules("mobile", "Mobile No", 'required');
                    //$this->form_validation->set_rules("state", "Address", 'required');
                    $this->form_validation->set_rules("pincode", "Pincode", 'required');
                    $this->form_validation->set_rules("address", "Address", 'required');
                    $this->form_validation->set_rules("district", "District", 'required');
                    $this->form_validation->set_rules("area", "Area", 'required');
                    $this->form_validation->set_rules("locality", "Locality",'required');
                    if($this->form_validation->run() == TRUE){
                        $insert_location = $this->customer_model->update_address($uri); 
                        if ($insert_location) {
                            $this->session->set_flashdata("suc", "Update address details successfully");
                            redirect("/My-Address");
                        } else {
                            $this->session->set_flashdata("err", "Not Update any customer details.Please try again.");
                            redirect("/My-Address");
                        }
                    }
                }
                $this->load->view('theme/inner_template',$data);
            }else{
                redirect("/My-Address");
            }
        }
        public function viewAddresscustomer(){
            $orpmobile      =   $this->session->userdata("customer_token");
            $conditions     =   array(); 
           // $conditions['whereCondition'] = "customer_mobile LIKE '".$orpmobile."'";
            $keywords   =   $this->input->post('keywords'); 
            if(!empty($keywords)){
                $conditions['keywords'] = $keywords;
            }  
            $page   =    $this->uri->segment("2");
            $offset =   ($page != "")?$page:"0";
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_mainpagination");
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"customeraddressid";   
            $totalRec               =   $this->customer_model->cntviewcustomeraddresss($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            } 
            $config["uri_segment"]  =   "2";
            $config['base_url']     =   base_url('viewAddresscustomer');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['limit']    =   $perpage;
            $conditions['start']    =   $offset;
            $conditions['limit']    =   $perpage;
            $dta["limit"]           =   $offset+1;
            $data["view"]            =   $this->customer_model->viewCustomeraddress($conditions);
            $this->load->view('customer/ajaxaddress',$data);
        }
        public function my_orders(){
            $orpmobile          =   $this->session->userdata("customer_mobile"); 
            $data["content"]    =   "customer/my_orders";
            $conditions = array(); 
            $keywords   =   $this->input->get('keywords'); 
            if(!empty($keywords)){
                $conditions['keywords'] = $keywords;
            }  
            $perpage        =    $this->input->get("limitvalue")?$this->input->get("limitvalue"):sitedata("site_mainpagination");
            $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
            $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"orderid";  
            $conditions['whereCondition'] = "customer_mobile LIKE '".$orpmobile."'";
            $totalRec               =   $this->order_model->cntvieworders($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            } 
            $config['base_url']     =   base_url('viewOrdercustomer');
            $config['total_rows']   =   $totalRec;
            $config['uri_segment']     =   2; 
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['limit']    =   $perpage;
            $data["view"]            =   $this->order_model->vieworders($conditions);
            $this->load->view('theme/inner_template',$data);
        }
        
        public function orderdetails(){
            $uri        =   $this->uri->segment("2");
            $orpmobile  =   $this->session->userdata("customer_id");  
            //print_r($orpmobile);exit;
            $params['whereCondition'] = "cp.customer_id LIKE '".$orpmobile."' and order_unique = '".$uri."'";
            $vsp    =   $this->order_model->getorders($params);
            //print_r($vsp);exit;
            if($this->input->post('reviewsubmit')){
                // echo '<pre>';print_r($this->input->post());exit;
                $r = $this->customer_model->review_rating();
                if($r >0){
                    $this->session->set_flashdata("suc","Thq for review");
                }else{
                    $this->session->set_flashdata("err","Updated Profile Successfully.");
                }
            }
            if(is_array($vsp) && count($vsp) > 0){
                $data["content"]  =  "customer/order_details";
                $data["view"]     =  $this->order_model->vieworderdetails($params);
                $data["order"]    =  $vsp;
                $this->load->view('theme/inner_template',$data);
            }else{ 
                $this->session->set_flashdata("err","No order has been exists");
                redirect("/My-Orders");
            }
        }
        public function viewOrdercustomer(){
            $orpmobile      =   $this->session->userdata("otpmobileno");
            $conditions     =   array(); 
            $conditions['whereCondition'] = "customer_mobile LIKE '".$orpmobile."'";
            $keywords   =   $this->input->post('keywords'); 
            if(!empty($keywords)){
                $conditions['keywords'] = $keywords;
            }  
            $page   =    $this->uri->segment("2");
            $offset =   ($page != "")?$page:"0";
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_mainpagination");
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"orderid";   
            $totalRec               =   $this->order_model->cntvieworders($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            } 
            $config["uri_segment"]  =   "2";
            $config['base_url']     =   base_url('viewOrdercustomer');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['limit']    =   $perpage;
            $conditions['start']    =   $offset;
            $conditions['limit']    =   $perpage;
            $dta["limit"]           =   $offset+1;
            $data["view"]            =   $this->order_model->vieworders($conditions);
            $this->load->view('customer/ajaxorders',$data);
        } 
        public function wishlist(){
            $orpmobile  =   $this->session->userdata("customer_id");  
            $data["content"]    =   "customer/wishlist";
            $conditions = array(); 
            $keywords   =   $this->input->get('keywords'); 
            if(!empty($keywords)){
                $conditions['keywords'] = $keywords;
            }  
            $perpage        =    $this->input->get("limitvalue")?$this->input->get("limitvalue"):sitedata("site_mainpagination");
            $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
            $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"wishlistid";  
            $conditions['whereCondition'] = "customer_mobile LIKE '".$orpmobile."' OR customer_id LIKE '".$orpmobile."'";
            $totalRec               =   $this->order_model->cntwishlistproducts($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            }
            $config['base_url']     =   base_url('viewOrdercustomer');
            $config['total_rows']   =   $totalRec;
            $config['uri_segment']     =   2; 
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['limit']    =   $perpage;
            $data["view"]            =   $this->order_model->viewwishlistproducts($conditions);
            $this->load->view('theme/inner_template',$data);
        }
        public function reminder(){
            if($this->input->post('submit')){
                $this->form_validation->set_rules("reminder_title", "Title", 'required');
                $this->form_validation->set_rules("reminder_type", "Occasion",'required');
                $this->form_validation->set_rules("reminder_date", "Date",'required');
                $this->form_validation->set_rules("reminder_desc", "Desc",'required');
                if($this->form_validation->run() == TRUE){
                    $this->customer_model->add_reminder();
                }
            }
            $orpmobile  =   $this->session->userdata("customer_id");  
            $data["content"]    =   "customer/reminder";
            $conditions = array(); 
            $keywords   =   $this->input->get('keywords'); 
            if(!empty($keywords)){
                $conditions['keywords'] = $keywords;
            }
            $perpage        =    $this->input->get("limitvalue")?$this->input->get("limitvalue"):sitedata("site_mainpagination");
            $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
            $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"reminderid";  
            $conditions['whereCondition'] = "customer_id LIKE '".$orpmobile."'";
            $totalRec               =   $this->customer_model->cntReminder($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            }
            $config['base_url']     =   base_url('viewRemindercustomer');
            $config['total_rows']   =   $totalRec;
            $config['uri_segment']     =   2;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['limit']    =   $perpage;
            $data["view"]            =   $this->customer_model->viewReminder($conditions);
            $this->load->view('theme/inner_template',$data);
        }
        public function delete_reminder(){
            $uri    =   $this->uri->segment("2");
            $par['where_condition'] = "reminder_id LIKE '".$uri."' AND customer_id LIKE '".$this->session->userdata("customer_id")."'";
            $vues    =   $this->customer_model->getReminder($par);
            if(is_array($vues) && count($vues) >0){
                $bt     =   $this->customer_model->delete_reminders($uri);
                if($bt > 0){
                    $this->session->set_flashdata("suc","Delete Reminder Successfully.");
                    redirect("Reminders");
                }else{
                    $this->session->set_flashdata("err","Not Delete Reminder.Please try again.");
                    redirect("Reminders");  
                }
            }
        }
        public function update_reminder(){
            $uri    =   $this->uri->segment("2"); 
            //$vue    =   $this->common_model->get_Occasion();
            $par['where_condition'] = "reminder_id LIKE '".$uri."' AND customer_id LIKE '".$this->session->userdata("customer_id")."'";
            $vues    =   $this->customer_model->getReminder($par);
            if(count($vues) > 0){
                    $dt     =   array(
                            "title"     =>  "Update Reminder",
                            "content"   =>  "customer/update_reminder",
                            "view"      =>  $vues
                    ); 
                    if($this->input->post("submit")){
                            $this->form_validation->set_rules("reminder_title", "Title", 'required');
                            $this->form_validation->set_rules("reminder_type", "Occasion",'required');
                            $this->form_validation->set_rules("reminder_date", "Date",'required');
                            $this->form_validation->set_rules("reminder_desc", "Desc",'required');
                            if($this->form_validation->run() == TRUE){
                                    $bt     =   $this->customer_model->update_reminder($uri);
                                    if($bt > 0){
                                            $this->session->set_flashdata("suc","Updated Category Successfully.");
                                            redirect("Reminders");
                                    }else{
                                            $this->session->set_flashdata("err","Not Updated Category.Please try again.");
                                            redirect("Update-Reminder/".$uri);    
                                    }
                            }
                    }
                    $this->load->view("theme/inner_template",$dt);
            }
        }
        public function update_profile(){
            if($this->session->userdata("customer_id") !=""){
                $par['whereCondition'] = "customer_id LIKE '".$this->session->userdata("customer_id")."'";
                $vues = $this->customer_model->getCustomer($par);
                $dt = array(
                    "title"     =>  "Update Profile",
                    "content"   =>  "customer/update_profile",
                    "view"      =>  $vues
                );
                if($this->input->post('submit')){
                    $this->form_validation->set_rules("customer_name", "Name", 'required');
                    $this->form_validation->set_rules("customer_email_id", "Email Id",'required');
                    $this->form_validation->set_rules("customer_mobile", "Mobile No",'required');
                    if($this->form_validation->run() == TRUE){
                        $bt = $this->customer_model->update_customer($this->session->userdata("customer_id"));
                        if($bt > 0){
                                $this->session->set_flashdata("suc","Updated Profile Successfully.");
                                redirect("customer");
                        }else{
                                $this->session->set_flashdata("err","Not Updated Profile.Please try again.");  
                        }
                    }
                }
                $this->load->view("theme/inner_template",$dt);
            }else{
                redirect('/');
            }
        }
        public function reminder_weekly_alert(){
            $week = date("Y-m-d", strtotime("+1 week"));
            $par['whereCondition'] = "reminder_date = '".$week."'";
            $week_list  = $this->customer_model->viewReminder($par);
            foreach($week_list as $wel){
                $userid = $wel['customer_id'];
                $par['whereCondition'] = "customer_id LIKE '".$userid."'";
                $vues = $this->customer_model->getCustomer($par);
                $occasion  = $this->common_model->get_Occasion($wel['reminder_type']);
                $subject="MiniKart Reminder";
                $message_string = "Hi ".$vues['customer_name'].",this is reminder for ".$occasion[0]['occasion']." on ".date('d M Y', strtotime($wel['reminder_date']))."<br>MiniKart";
                //print_r($message_string);exit;
               if($vues['customer_mobile'] !=""){
                    $this->mobile_otp->sendmobilemessage($vues['customer_mobile'],$message_string);
                }
                if($vues['customer_email_id'] !=""){
                    
                    $this->common_config->configemail($vues['customer_email_id'],$subject,$message_string);
                }
                if($vues['customer_token'] !=""){
                    $this->common_config->send_pushnotifications($subject,$message_string,$vues['customer_token']);
                }
            }
        }
        public function reminder_day_alert(){
            $week = date("Y-m-d", strtotime("+1 day"));
            $par['whereCondition'] = "reminder_date = '".$week."'";
            $week_list  = $this->customer_model->viewReminder($par);
            foreach($week_list as $wel){
                $userid = $wel['customer_id'];
                $par['whereCondition'] = "customer_id LIKE '".$userid."'";
                $vues = $this->customer_model->getCustomer($par);
                $occasion  = $this->common_model->get_Occasion($wel['reminder_type']);
                $subject="MiniKart Reminder";
                $message_string = "Hi ".$vues['customer_name'].",this is reminder for ".$occasion[0]['occasion']." on ".date('d M Y', strtotime($wel['reminder_date']))."<br>MiniKart";
                //print_r($vues['customer_email_id']);exit;
               if($vues['customer_mobile'] !=""){
                    //$this->mobile_otp->sendmobilemessage($vues['customer_mobile'],$message_string);
                }
                if($vues['customer_email_id'] !=""){
                    
                    $a=$this->common_config->configemail($vues['customer_email_id'],$subject,$message_string);
                   //print_r($a);
                }
                if($vues['customer_token'] !=""){
                    $v=$this->common_config->send_pushnotifications($subject,$message_string,$vues['customer_token']);
                    print_r($v);
                }
            }
        }
        public function rating(){
            if($this->input->post() !=""){
                echo $this->customer_model->review_rating();
            }
        }
}