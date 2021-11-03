<?php
date_default_timezone_set('America/Los_Angeles');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Faq extends CI_Controller{
	public function __construct() {
		parent::__construct();
		$this->load->model('faq_model');
		$this->load->library('pagination');
		$this->load->library('upload');
		if($this->session->userdata("login_id") == ""){
			redirect(sitedata("site_admin")."/");
		}
	}
	public function index(){
		$dat    =   array(
			"title"     =>  "Faq List",
			"content"   =>  "faq"
		);
		$this->load->view("admin/inner_template",$dat);
	}
	
	public function add_faq(){
		$dat    =   array(
			"title"     =>  "Products Category",
			"content"   =>  "add_faq"
		);
		if($this->input->post("submit")){
			$this->form_validation->set_rules("faq_name","Faq name","required|is_unique[faq.faq_name]");
			$this->form_validation->set_rules("faq_arabic_name","Faq arabic name","required|is_unique[faq.faq_name]");
			$this->form_validation->set_rules("faq_desc","Faq description","required");
			$this->form_validation->set_rules("faq_arabic_desc","Faq arabic description","required");
			if($this->form_validation->run() == TRUE){
				$faq_name = $this->input->post('faq_name');
				$faq_desc = $this->input->post('faq_desc');
				$faq_arabic_name = $this->input->post('faq_arabic_name');
				$faq_arabic_desc = $this->input->post('faq_arabic_desc');
				$data = array(
					'faq_name' => $faq_name,
					'faq_desc' => $faq_desc,
					'faq_arabic_name' => $faq_arabic_name,
					'faq_arabic_desc' => $faq_arabic_desc,
					'faq_add_date' => date('Y-m-d H:i:s a'),
				);
				$ins = $this->faq_model->add_faq($data);
				if($ins){
					$this->session->set_flashdata("suc","Faq Adding successfully");
					$this->load->view("admin/inner_template",$dat);
				}else{
					$this->session->set_flashdata("suc","Faq Adding Failed.Please try again");
					$this->load->view("admin/inner_template",$dat);	
				}
			}
		}
		$this->load->view("admin/inner_template",$dat);
	}
	public function edit_faq($id){
		$dat    =   array(
			"title"     =>  "Products Category",
			"content"   =>  "edit_faq"
		);
		if($this->input->post("submit")){
			$this->form_validation->set_rules("faq_name","Faq name","required");
			$this->form_validation->set_rules("faq_arabic_name","Faq arabic name","required");
			$this->form_validation->set_rules("faq_desc","Faq description","required");
			$this->form_validation->set_rules("faq_arabic_desc","Faq arabic description","required");
			
			if($this->form_validation->run() == TRUE){
				$faq_name = $this->input->post('faq_name');
				$faq_desc = $this->input->post('faq_desc');
				$faq_arabic_name = $this->input->post('faq_arabic_name');
				$faq_arabic_desc = $this->input->post('faq_arabic_desc');
				$data = array(
					'faq_name' => $faq_name,
					'faq_desc' => $faq_desc,
					'faq_arabic_name' => $faq_arabic_name,
					'faq_arabic_desc' => $faq_arabic_desc,
					'faq_add_date' => date('Y-m-d H:i:s a'),
				);
				$ins = $this->faq_model->update_faq($id,$data);
				if($ins){
					$this->session->set_flashdata("suc","Faq Update successfully");
					redirect(sitedata("site_admin")."/faq");
				}else{
					$this->session->set_flashdata("suc","Faq udpate Failed.Please try again");
					$this->load->view("admin/inner_template",$dat);	
				}
			}
		}
		$dat['edit_faq'] = $this->faq_model->edit_faq($id);
		$this->load->view("admin/inner_template",$dat);
	}
	
	public function removeNonUtf8($data){
      return preg_replace('/[^A-Za-z0-9 @#%~\'\"\®\©_\-\,\+\&.\}\=\!\<\>\|\:\-\\\\\+\*\?\[\^\]\$\(\)\{Â]/','', $data);
      $data = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $data);
      return str_replace(' ', '-', $data);
    }
	
	public function viewfaq(){
		$conditions =   array();
		$page       =   $this->uri->segment('3');
		$offset     =   (!$page)?"0":$page;
		$keywords   =   $this->input->post('keywords'); 
		//print_r($keywords);exit;
		if(!empty($keywords)){
				$conditions['keywords'] = $keywords;
		}  
		$perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
		$orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
		$tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"id";
		$totalRec               =   $this->faq_model->cntview_faq($conditions);  
		if(!empty($orderby) && !empty($tipoOrderby)){
			$dta['orderby']        =   $conditions['order_by']      =   $orderby;
			$dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
		} 
		$config['base_url']     =   adminurl('viewfaq');
		$config['total_rows']   =   $totalRec;
		$config['per_page']     =   $perpage; 
		$config['link_func']    =   'searchFilter';
		$this->ajax_pagination->initialize($config);
		$conditions['start']    =   $offset;
		$conditions['limit']    =   $perpage;
		$dta["limit"]           =   $offset+1;
		//print_r($conditions);exit;
		$dta["view"]            =   $this->faq_model->view_faq($conditions); 
		//print_r($dta);exit;
		$this->load->view("ajax_faq",$dta);
	}
	
	
	public function delete_faq(){
		$vsp    =   "0";
		if($this->session->userdata("delete-role") != '1'){
			$vsp    =   "0";
		}else {
			$uri    =   $this->uri->segment("3");
			//print_r($uri);exit;
			$vue    =   $this->faq_model->get_faq($uri);
			if(count($vue) > 0){
				$bt     =   $this->faq_model->delete_faq($uri); 
				if($bt > 0){
					$vsp    =   1;
				}
			}else{
				$vsp    =   2;
			} 
		} 
		echo $vsp;
	}
	public function ajax_faq_status(){
		
	}
}

