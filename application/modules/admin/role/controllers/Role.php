<?php

class Role extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-roles") != '1'){
                        redirect("Kart-Admin/dashboard");
               }
        }
        public function index(){ 
                $dta    =   array( 
                                    "title"     =>  "Roles",
                                    "content"   =>  "role",
                                    "icon"      =>  "random",
                                    "limit"     =>  "1"
                            );
                
                if($this->input->post("submit")){
                        $this->form_validation->set_rules("role_name","Role Name","required|xss_clean|trim|min_length[3]|max_length[50]|callback_check_role_name");
                        if($this->form_validation->run() == TRUE){
                                $bt     =   $this->role_model->create_role();
                                if($bt > 0){
                                        $this->session->set_flashdata("suc","Created a Role Successfully.");
                                        redirect("Kart-Admin/roles");
                                }else{
                                        $this->session->set_flashdata("err","Not Created a Role.Please try again.");
                                        redirect("Kart-Admin/roles");
                                }
                        }
                }
                $dta["view"]           =    $this->role_model->view_role();
                $this->load->view("admin/inner_template",$dta); 
        }

        public function unique_role_name(){
                echo $this->role_model->unique_role($this->input->post("role_name"));
        }
        public function check_role_name($str){ 
                $vsp	=	$this->role_model->check_unique_role($str); 
                if($vsp){
                        $this->form_validation->set_message("check_role_name","Role Name already exists.");
                        return FALSE;
                }	
                return TRUE; 
        }
        public function delete_role(){
               // if($this->session->userdata("delete-role") != '1'){
               //         redirect("/Kart-Admin");
               // }
                $uri    =   $this->uri->segment("3");
                $vue    =   $this->role_model->get_role($uri);
                if(count($vue) > 0){
                        $bt     =   $this->role_model->delete_role($uri); 
                        if($bt > 0){
                                $this->session->set_flashdata("suc","Deleted Role Successfully.");
                                redirect("/Kart-Admin/roles");
                        }else{
                                $this->session->set_flashdata("err","Not Deleted Role.Please try again.");
                                redirect("/Kart-Admin/roles");
                        }
                }else{
                        $this->session->set_flashdata("war","Role does not exists."); 
                        redirect("/Kart-Admin/roles");
                }
        }
        public function update_role(){
//                
                $uri    =   $this->uri->segment("3"); 
                $vue    =   $this->role_model->get_role($uri);
                if(count($vue) > 0){
                        $dt     =   array(
                                "title"     =>  "Update Role",
                                "content"   =>  "up_role",
                                "view"      =>  $vue
                        ); 
                        if($this->input->post("submit")){
                                $this->form_validation->set_rules("role_name","Role Name","required|xss_clean|trim|max_length[50]");
                                if($this->form_validation->run() == TRUE){
                                        $bt     =   $this->role_model->update_role($uri);
                                        if($bt > 0){
                                                $this->session->set_flashdata("suc","Updated Role Successfully.");
                                                redirect("/Kart-Admin/update-role/".$uri);
                                        }else{
                                                $this->session->set_flashdata("err","Not Updated Role.Please try again.");
                                                redirect("/Kart-Admin/update-role/".$uri);    
                                        }
                                }
                        }
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Role does not exists."); 
                        redirect("/Kart-Admin/roles");
                }
        }
        public function viewRole(){ 
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
                $totalRec               =   $this->role_model->cntview_role($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){ 
                        $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                        $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
                } 
                $config['base_url']     =   bildourl('viewRole');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->role_model->view_role($conditions);
                $this->load->view("ajax_role",$dta);
        }
}