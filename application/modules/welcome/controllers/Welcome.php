<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() 
            { 
            parent::__construct(); 
            $this->load->helper('url');
            $this->load->database();
            $this->load->library('upload');
             //$this->perPage = 5;
            }
	public function index()
	{
		 $data = array(
                     "content" => "home",
                    );
                 $data["res"]    =   $this->category_model->viewCategory();
                 $data["ban"]   = $this->banner_model->viewBanners();
                 $data["sub"]    = $this->category_model->viewsub_categories();
                 $data["products"]    = $this->vendor_model->viewVendorproducts();
                 
		$this->load->view('home_template',$data);
	}
        public function shop()
	{
		 $data = array(
                   //  "content" => "index",
                    );
                 
		$this->load->view('shop');
	}
        
        public function otp(){ 
            $mobile = $this->input->post("loginmobile");
            $key    = $this->input->post("user_type");
            $inser  = $this->vendor_model->sendotp($mobile,$key);
            if($inser > 0){
                echo 1;
            }else{
                echo 0;
            }
        }
        public function verifyotp(){ 
                $otp_mobile_no  =   $this->input->post("loginmobile");
                $key            =   $this->input->post("user_type");
                $otp            =   $this->input->post("otp_key"); 
                $inse           =   $this->vendor_model->verifyotp($otp,$otp_mobile_no,$key);
                $msg            =   0;
                if($inse){
                    $this->session->set_userdata("otpmobileno",$otp_mobile_no);
                    $this->session->set_userdata("otpkey",$key);
                    if($key == '0'){
                        $ins    =   $this->vendor_model->view_profile($otp_mobile_no);
                        if(count($ins) > 0){
                            $this->session->set_userdata("vendor_id",$ins["vendor_id"]);
                            $this->session->set_userdata("vendor_name",$ins["vendor_name"]);
                            $this->session->set_userdata("vendor_mobile",$otp_mobile_no);
                            $msg    =   2;
                        }else{
                            $msg    =   1;
                        }
                    }else{ 
                        $ins    =   $this->customer_model->viewprofile($otp_mobile_no);
                        if(count($ins) > 0){
                            $this->session->set_userdata("customer_id",$ins["customer_id"]);
                            $this->session->set_userdata("customer_name",$ins["customer_name"]);
                            $this->session->set_userdata("customer_mobile",$otp_mobile_no); 
                            $msg    =   3;
                        }
                        //print_r ($this->session->userdata("customer_mobile",$otp_mobile_no));exit;
                    }
                }
                echo $msg;
                
        }
        
        public function viewVendorproductprices(){
    	    $pas['whereCondition'] = "vendor_ingredientslist LIKE 'INDU4'";
    	    $p = $this->vendor_model->viewVendorproductprices($pas);
    	    if(is_array($p) && count($p) >0){
    	        foreach($p as $p){
    	           // echo '<pre>';print_r($p->vendorproductprince_id);exit;
    	            $this->db->where('vendorproductprince_id',$p->vendorproductprince_id)->update('vendor_product_princes',array('vendor_ingredientslist'=>'INDU1'));
    	        }
    	    }
    	}
}