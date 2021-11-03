<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller { 
    public function __construct(){
            parent::__construct();
    }
	public function index(){
            if($this->session->userdata("login_id") != ""){
                redirect(sitedata("site_admin")."/dashboard");
            }
            $dta    =   array(
                "content"   =>  "login",
                "title"     =>  'Login'
            );
            if($this->input->post("submit")){
                $this->form_validation->set_rules("username","Username","required|xss_clean|trim|min_length[5]|max_length[50]");
                $this->form_validation->set_rules("password","Password","required|xss_clean|trim|min_length[5]|max_length[50]");
                if($this->form_validation->run() == TRUE){
                    $isn =  $this->login_model->check_login();
                    if($isn){
                        redirect(sitedata("site_admin")."/dashboard");
                    }else{
                        $this->session->set_flashdata("err","Login Failed");
                        redirect(sitedata("site_admin"));
                    }
                }
            }
            $this->load->view('admin/outer_template',$dta);
	}
    public function logout(){
            $this->session->sess_destroy();
            redirect(sitedata("site_admin"));
    }
    public function __destruct(){
            $this->db->close();
    }
}