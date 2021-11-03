<?php
class Refer extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if($this->session->userdata("manage-refer") != "1"){
			redirect(sitedata("site_admin")."/");
		}
	}
	public function create(){
		$restid = $this->session->userdata("restraint_id");
		$par['whereCondition'] = "resturant_id = '".$restid."'";
		$dta    =   array(
			"title"     =>  "Create Refer Form",
			"content"  =>  'create_refer',
			"category"		=>  $this->category_model->viewCategory($par),
			
		);
		if($this->input->post('publish')){
			//echo '<pre>';print_r($this->input->post());exit;
			$this->form_validation->set_rules('refer_type','Refer Type','required');
			$this->form_validation->set_rules('from_date','From Date','required');
			$this->form_validation->set_rules('to_date','To Date','required');
			$this->form_validation->set_rules('min_refer','Minimum Refer Amount','required');
			$this->form_validation->set_rules('discount','Discount','required');
			$this->form_validation->set_rules('refer','Refer','required|callback_refer');
			$this->form_validation->set_rules('per_person','Per Person Applicable','required');
			$this->form_validation->set_rules('typeofcust','Type of customer','required');
			if($this->form_validation->run() == TRUE){
				$res = $this->refer_model->create();
                if($res != ''){
                    $this->session->set_flashdata("suc","Created Refer successfully."); //Update menu and items on bottom of the page
                     redirect(base_url('Kart-Admin/Refer'));
                }else{
					$this->session->set_flashdata("err","failed.");
                }
			}
		}
		$this->load->view('admin/inner_template',$dta);
	}
	public function refer($str){
        $vsp	=	$this->refer_model->unique_id_refer($str); 
        if($vsp){
            $this->form_validation->set_message("refer","Refer Code already exists.");
            return FALSE;
        }
        return TRUE; 
    }
	public function index(){
		$dta    =   array(
			"title"     	=>  "Refer List",
			"content"  		=>  'refer',
			"urlvalue"		=>	base_url('Kart-Admin/viewRefer/'),
		);
		$conditions=array();
		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):'15';    
		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"ASC";
		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"referid";  
		$totalRec               =   $this->refer_model->cntviewRefer($conditions);
		if(!empty($orderby) && !empty($tipoOrderby)){
			$conditions['order_by']      =   $orderby;
			$conditions['tipoOrderby']   =   $tipoOrderby; 
			$conditions['limit']   		 =   $perpage; 
		}
		$dta["view"]            =   $this->refer_model->viewRefer($conditions); 
		$dta["limit"]           =   1;
		$dta['urlvalue']		=   base_url('Kart-Admin/ViewRefer/');
		$this->load->view('admin/inner_template',$dta);
	}
	public function update_refer($str){
		$restid = $this->session->userdata("restraint_id");
		$par['whereCondition'] = "resturant_id = '".$restid."'";
        $pmrs["whereCondition"]  =   "refer_id LIKE  '".$str."'";
        $vsp	=	$this->refer_model->getRefer($pmrs);
		$con['whereCondition'] = "refer_items_refer_id ='".$vsp[0]['refer_id']."' AND refer_items_open = '1'";
        $cate  =   $this->refer_model->viewReferItems($con); 
        $catt=array();$prod=array();
        foreach($cate as $ct){
            if(!in_array($ct->refer_items_category_id, $catt, true)){
                array_push($catt, $ct->refer_items_category_id);
            }
            array_push($prod, $ct->refer_items_item_id);
        } 
        if($vsp){
    	    $dta    =   array(
    			"title"     =>  "update refer",
    			"content"   =>  "update_refer",
    			"view"      =>  $vsp[0],
				"catt"		=> 	$catt,
				"prod"		=> 	$prod,
				"category"		=>  $this->category_model->viewCategory($par),
    		);
    	    if($this->input->post('update')){
				//echo '<pre>';print_r($this->input->post());exit;
				$this->form_validation->set_rules('refer_type','Refer Type','required');
				$this->form_validation->set_rules('min_refer','Minimum Refer Amount','required');
				$this->form_validation->set_rules('discount','Discount','required');
    			if($this->form_validation->run() == TRUE){
                    $res = $this->refer_model->update_refer($str);     
                    if($res){
                        $this->session->set_flashdata("suc","update Refer succfully.");
                        redirect(base_url('Kart-Admin/Refer'));
                    }else{
                        $this->session->set_flashdata("err","update Refer failed.");
                    }
    	        }
    	    }
		    $this->load->view("admin/inner_template",$dta); 
        }
	}
	
	
public function viewRefer(){ 
	$conditions =   array();
	$page       =   $this->uri->segment('3');
	$offset     =   (!$page)?"0":$page;
	$keywords   =   $this->input->post('keywords'); 
	if(!empty($keywords)){
			$conditions['keywords'] = $keywords;
	}
	$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
	$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
	$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"referid";  
	$totalRec               =   $this->refer_model->cntviewRefer($conditions);  
	if(!empty($orderby) && !empty($tipoOrderby)){ 
		$dta['orderby']        =   $conditions['order_by']      =   $orderby;
		$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
	} 
	$config['base_url']     =   base_url('Kart-Admin/ViewRefer/');
	$config['total_rows']   =   $totalRec;
	$config['per_page']     =   $perpage; 
	$config['link_func']    =   'searchFilter';
	$this->ajax_pagination->initialize($config);
	$conditions['start']    =   $offset;
	if($perpage != "all"){
		$conditions['limit']    =   $perpage;
	}
	$dta["urlvalue"]        =   base_url('Kart-Admin/ViewRefer/');
	$dta["limit"]           =   $offset+1;
	$dta["view"]            =   $this->refer_model->viewRefer($conditions); 
	$this->load->view("ajax_refer",$dta);
}
public function ajax_refer_active(){
	$status     =   $this->input->post("status");
	$uri        =   $this->input->post("fields");
	$params["whereCondition"]   =   "refer_id = '".$uri."'";
	$vue    =   $this->refer_model->getRefer($params);
	if(is_array($vue) && count($vue) > 0){
		$bt     =   $this->refer_model->activedeactive($uri,$status); 
		if($bt > 0){
			$vsp    =   1;
		}
	}else{
		$vsp    =   2;
	}
	echo $vsp;
}
public function delete_refer(){
	$uri    =   $this->uri->segment("3");
	$params["whereCondition"]   =   "refer_id = '".$uri."'";
	$vue    =   $this->refer_model->getRefer($params);
	if(count($vue) > 0){
		$bt     =   $this->refer_model->delete_refer($uri); 
		if($bt > 0){
			$this->session->set_flashdata("suc","Delete Refer succfully.");
			redirect(base_url('Kart-Admin/Refer'));
		}
	}else{
		$this->session->set_flashdata("err","update Refer failed.");
		redirect(base_url('Kart-Admin/Refer'));
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
public function ajax_refer(){
	$char = "BCDFGHJKLMNPQRSTVWXZAEIOUY0123456789";
    $token = '';
    for ($i = 0; $i < 6; $i++) {
		$token .= $char[(rand() % strlen($char))];
	}
	//$token = '9U9KY7';
	if($this->refer($token)!=1){
		$this->ajax_refer();
	}else{
		echo $token;
	}
	
}
}
?>