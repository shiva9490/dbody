<?php
class Coupon extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("manage-coupon") != "1"){
			redirect(sitedata("site_admin")."/");
		}
	}
	public function create(){
		$restid = $this->session->userdata("restraint_id");
		$par['whereCondition'] = "resturant_id = '".$restid."'";
		$dta    =   array(
			"title"     =>  "Create Coupon Form",
			"content"  =>  'create_coupon',
			"category"		=>  $this->category_model->viewCategory($par),
			
		);
		if($this->input->post('publish')){
			//echo '<pre>';print_r($this->input->post());exit;
			$this->form_validation->set_rules('coupon_type','Coupon Type','required');
			$this->form_validation->set_rules('from_date','From Date','required');
			$this->form_validation->set_rules('to_date','To Date','required');
			$this->form_validation->set_rules('min_coupon','Minimum Coupon Amount','required');
			$this->form_validation->set_rules('discount','Discount','required');
			$this->form_validation->set_rules('coupon','Coupon','required|callback_coupon');
			$this->form_validation->set_rules('per_person','Per Person Applicable','required');
			$this->form_validation->set_rules('typeofcust','Type of customer','required');
			if($this->form_validation->run() == TRUE){
				$res = $this->coupon_model->create();
                if($res != ''){
                    $this->session->set_flashdata("suc","Created Coupon successfully."); //Update menu and items on bottom of the page
                     redirect(base_url('Kart-Admin/Coupon'));
                }else{
					$this->session->set_flashdata("err","failed.");
                }
			}
		}
		$this->load->view('admin/inner_template',$dta);
	}
	public function coupon($str){
        $vsp	=	$this->coupon_model->unique_id_coupon($str); 
        if($vsp){
            $this->form_validation->set_message("coupon","Coupon Code already exists.");
            return FALSE;
        }
        return TRUE; 
    }
	public function index(){
		$dta    =   array(
			"title"     	=>  "Coupon List",
			"content"  		=>  'coupon',
			"urlvalue"		=>	base_url('Kart-Admin/viewCoupon/'),
		);
		$conditions=array();
		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):'15';    
		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"ASC";
		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"couponid";  
		$totalRec               =   $this->coupon_model->cntviewCoupon($conditions);
		if(!empty($orderby) && !empty($tipoOrderby)){
			$conditions['order_by']      =   $orderby;
			$conditions['tipoOrderby']   =   $tipoOrderby; 
			$conditions['limit']   		 =   $perpage; 
		}
		$dta["view"]            =   $this->coupon_model->viewCoupon($conditions); 
		$dta["limit"]           =   1;
		$dta['urlvalue']		=   base_url('Kart-Admin/ViewCoupon/');
		$this->load->view('admin/inner_template',$dta);
	}
	public function update_coupon($str){
		$restid = $this->session->userdata("restraint_id");
		$par['whereCondition'] = "resturant_id = '".$restid."'";
        $pmrs["whereCondition"]  =   "coupon_id LIKE  '".$str."'";
        $vsp	=	$this->coupon_model->getCoupon($pmrs);
		$con['whereCondition'] = "coupon_items_coupon_id ='".$vsp[0]['coupon_id']."' AND coupon_items_open = '1'";
        $cate  =   $this->coupon_model->viewCouponItems($con); 
        $catt=array();$prod=array();
        foreach($cate as $ct){
            if(!in_array($ct->coupon_items_category_id, $catt, true)){
                array_push($catt, $ct->coupon_items_category_id);
            }
            array_push($prod, $ct->coupon_items_item_id);
        } 
        if($vsp){
    	    $dta    =   array(
    			"title"     =>  "update coupon",
    			"content"   =>  "update_coupon",
    			"view"      =>  $vsp[0],
				"catt"		=> 	$catt,
				"prod"		=> 	$prod,
				"category"		=>  $this->category_model->viewCategory($par),
    		);
    	    if($this->input->post('update')){
				//echo '<pre>';print_r($this->input->post());exit;
				$this->form_validation->set_rules('coupon_type','Coupon Type','required');
				$this->form_validation->set_rules('from_date','From Date','required');
				$this->form_validation->set_rules('to_date','To Date','required');
				$this->form_validation->set_rules('min_coupon','Minimum Coupon Amount','required');
				$this->form_validation->set_rules('discount','Discount','required');
				$this->form_validation->set_rules('per_person','Per Person Applicable','required');
				$this->form_validation->set_rules('typeofcust','Type of customer','required');
    			if($this->form_validation->run() == TRUE){
                    $res = $this->coupon_model->update_coupon($str);     
                    if($res){
                        $this->session->set_flashdata("suc","update Coupon succfully.");
                        redirect(base_url('Kart-Admin/Coupon'));
                    }else{
                        $this->session->set_flashdata("err","update Coupon failed.");
                    }
    	        }
    	    }
		    $this->load->view("admin/inner_template",$dta); 
        }
	}
	
	
public function viewCoupon(){ 
	$conditions =   array();
	$page       =   $this->uri->segment('3');
	$offset     =   (!$page)?"0":$page;
	$keywords   =   $this->input->post('keywords'); 
	if(!empty($keywords)){
			$conditions['keywords'] = $keywords;
	}
	$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
	$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
	$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"couponid";  
	$totalRec               =   $this->coupon_model->cntviewCoupon($conditions);  
	if(!empty($orderby) && !empty($tipoOrderby)){ 
		$dta['orderby']        =   $conditions['order_by']      =   $orderby;
		$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
	} 
	$config['base_url']     =   base_url('Kart-Admin/ViewCoupon/');
	$config['total_rows']   =   $totalRec;
	$config['per_page']     =   $perpage; 
	$config['link_func']    =   'searchFilter';
	$this->ajax_pagination->initialize($config);
	$conditions['start']    =   $offset;
	if($perpage != "all"){
		$conditions['limit']    =   $perpage;
	}
	$dta["urlvalue"]        =   base_url('Kart-Admin/ViewCoupon/');
	$dta["limit"]           =   $offset+1;
	$dta["view"]            =   $this->coupon_model->viewCoupon($conditions); 
	$this->load->view("ajax_coupon",$dta);
}
public function ajax_coupon_active(){
	$status     =   $this->input->post("status");
	$uri        =   $this->input->post("fields");
	$params["whereCondition"]   =   "coupon_id = '".$uri."'";
	$vue    =   $this->coupon_model->getCoupon($params);
	if(is_array($vue) && count($vue) > 0){
		$bt     =   $this->coupon_model->activedeactive($uri,$status); 
		if($bt > 0){
			$vsp    =   1;
		}
	}else{
		$vsp    =   2;
	}
	echo $vsp;
}
public function delete_coupon(){
	$uri    =   $this->uri->segment("3");
	$params["whereCondition"]   =   "coupon_id = '".$uri."'";
	$vue    =   $this->coupon_model->getCoupon($params);
	if(count($vue) > 0){
		$bt     =   $this->coupon_model->delete_coupon($uri); 
		if($bt > 0){
			$this->session->set_flashdata("suc","Delete Coupon succfully.");
			redirect(base_url('Kart-Admin/Coupon'));
		}
	}else{
		$this->session->set_flashdata("err","update Coupon failed.");
		redirect(base_url('Kart-Admin/Coupon'));
	} 
	echo $vsp;
}

public function ajax_items(){
	$cat	= explode(',',$this->input->post('cat_id'));
	$dta["prod"] 	= explode(',',$this->input->post('product_id'));
	$i=0; 
	foreach($cat as $c){
		if($i==0){
			$par['whereCondition'] = "vp.vendorproduct_category = '".$c."'";
		}else{
			$par['whereCondition'] .= " OR vp.vendorproduct_category = '".$c."'";
		}
		$i++;
	}
	$par['columns']	="distinct(product_name),vendorproduct_id ";
	$dta["items"]            =   $this->vendor_model->viewVendorproducts($par);
	$this->load->view("ajax_items",$dta); 
}
public function ajax_coupon(){
	$char = "BCDFGHJKLMNPQRSTVWXZAEIOUY0123456789";
    $token = '';
    for ($i = 0; $i < 6; $i++) {
		$token .= $char[(rand() % strlen($char))];
	}
	//$token = '9U9KY7';
	if($this->coupon($token)!=1){
		$this->ajax_coupon();
	}else{
		echo $token;
	}
	
}
}
?>