<?php
class Dashboard extends CI_Controller{
    public function __construct() {
            parent::__construct();
            if($this->session->userdata("login_id") == ""){
                redirect(sitedata("site_admin"));
           }
    }
    public function index(){
        $dta    =   array(
            "title"     =>  "Dashboard",
            "content"   =>  "dashboard"
        );
        $this->load->view("admin/inner_template",$dta);
    }
    public function change_pwd(){
        $dt       = array(
            "title"     => "Change Password",
            "content"   => "change_password"
        ); 
        if ($this->input->post("submit")) {
            $this->form_validation->set_rules("new_password", "New Password", 'required|trim|xss_clean|min_length[5]|max_length[50]');
            $this->form_validation->set_rules('cpwd', 'Confirm Password', 'required|trim|xss_clean|matches[new_password]|min_length[5]|max_length[50]');
            if ($this->form_validation->run() == TRUE) {
                $loginid         = $this->session->userdata("login_id");
                $insert_location = $this->login_model->changepwd($loginid);
                if ($insert_location) {
                    $this->session->set_flashdata("suc", "Password has been Changed Successfully");
                } else {
                    $this->session->set_flashdata("err", "Password is not changed.Please try again");
                }
                redirect(sitedata("site_admin")."/change-password");
            }
        }
        $this->load->view('admin/inner_template', $dt);
    }
    public function __destruct(){
        $this->db->close();    
    }
}