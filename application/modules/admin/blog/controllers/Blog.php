<?php
class Blog extends CI_Controller{
        public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-Blog") != '1'){
                    redirect(sitedata("site_admin")."/Dashboard");
                }
        }
        public function index(){
            $dta    =   array( 
                            "title"     =>  "Blog",
                            "content"   =>  "blog",
                            "vitil"     =>  "",
                            "limit"     =>  "1",
                            "addurl"    =>  "Add-Blog"
                        );
            $conditions =   array();
            $page       =   $this->uri->segment('3');
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords'); 
            if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
            }  
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"blogid";  
            $totalRec               =   $this->blog_model->cntviewBlog($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
            } 
            $config['base_url']     =   bildourl('viewBlog');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            if($perpage != 'all'){
                $conditions['limit']    =   $perpage;
            }
            $dta["limit"]           =   $offset+1;
            $dta["urlvalue"]        =   bildourl("viewBlog/");
            $dta["view"]            =   $this->blog_model->viewBlog($conditions);
            $this->load->view("admin/inner_template",$dta); 
        }
        public function add_blog(){
            $dta    =   array( 
                        "title"     =>  "Add Blog",
                        "content"   =>  "add_blog",
                        "vitil"     =>  "",
                        "limit"     =>  "1",
                    );
                    if($this->input->post('submit')){
                        $this->form_validation->set_rules("blog_title","Blog title","required|callback_check_blog");
                        $this->form_validation->set_rules("blog_desc","Description","required");
                        $this->form_validation->set_rules("blog_publishing_date","publishing date","required");
                        if(empty($_FILES['image']['name'])){
            				$this->form_validation->set_rules("image","image","required");
            			}
            			if(empty($_FILES['image']['name'])){
            				$this->form_validation->set_rules("image","image","required");
            			}
                        if($this->form_validation->run() == TRUE){
                            $ins    =   $this->blog_model->add_blog();
                            if($ins){
                                $this->session->set_flashdata("suc","Blog Add Succfully");
                                redirect(sitedata("site_admin")."/Blog");
                            }else{
                                $this->session->set_flashdata("err","Blog Add failed");
                            }
                        }
                    }
            $this->load->view("admin/inner_template",$dta); 
        }
        public function check_blog($str){ 
            $vsp	=	$this->blog_model->check_unique_name("blog_title",$str);
            if($vsp){
                    $this->form_validation->set_message("check_portfolio","Blog Name already exists.");
                    return FALSE;
            }	
            return TRUE; 
        }
        public function viewBlog(){
            $conditions =   array();
            $page       =   $this->uri->segment('3');
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords'); 
            if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
            }  
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby    =    $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"blogid";  
            $totalRec               =   $this->blog_model->cntviewBlog($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =   $tipoOrderby; 
            } 
            $config['base_url']     =   bildourl('viewBlog');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            if($perpage != 'all'){
                $conditions['limit']    =   $perpage;
            }
            $dta["limit"]           =   $offset+1;
            $dta["urlvalue"]        =   bildourl("viewBlog/");
            $dta["view"]            =   $this->blog_model->viewBlog($conditions); 
            $this->load->view("ajax_blog",$dta);
        }
        public function delete_blog(){
            $vsp    =   "0";
            if($this->session->userdata("delete-blog") != '1'){
                $vsp    =   "0";
            }else {
                $uri    =   $this->uri->segment("3");
                $params["whereCondition"]   =   "blog_id = '".$uri."'";
                $vue    =   $this->blog_model->getBlog($params);
                if(count($vue) > 0){
                    $bt     =   $this->blog_model->delete_blog($uri); 
                    if($bt > 0){
                        $this->session->set_flashdata("suc","Deleted Blog  Successfully.");
                        redirect(sitedata("site_admin").'/Blog');
                    }
                }else{
                    $this->session->set_flashdata("war","Blog does not exists."); 
                    redirect(sitedata("site_admin").'/Blog');
                } 
            } 
            echo $vsp;
        }
        public function update_blog(){
            if($this->session->userdata("update-blog") != '1'){
                redirect(sitedata("site_admin")."/blog");
            }else{
                $uri        =   $this->uri->segment("3");
                $psm['whereCondition']  =   "blog_id = '".$uri."'";
                $vue    =   $this->blog_model->getBlog($psm);
                if(is_array($vue) && count($vue) > 0){
                    $dta    =   array(
                        "title"     =>  "Update Blog",
                        "content"   =>  "update_blog",
                        "vitil"     =>  "",
                        "limit"     =>  "1",
                        "view"      =>  $vue
                    );
                    if($this->input->post('submit')){
                        $this->form_validation->set_rules("blog_title","Blog title","required");
                        $this->form_validation->set_rules("blog_desc","Description","required");
                        $this->form_validation->set_rules("blog_publishing_date","publishing date","required");
                        
                        if($this->form_validation->run() == TRUE){
                            $ins    =   $this->blog_model->update_blog($uri);
                            if($ins){
                                $this->session->set_flashdata("suc","Blog Update Succfully");
                                redirect(sitedata("site_admin")."/Blog");
                            }else{
                                $this->session->set_flashdata("err","Blog Update failed");
                            }
                        }
                    }
                }
            }
            $this->load->view("admin/inner_template",$dta); 
        }
        public function activedeactive(){
                $vsp    =   "0";
                if($this->session->userdata("active-deactive-Industries") != '1'){
                    $vsp    =   "0";
                }else{
                    $status     =   $this->input->post("status");
                    $uri        =   $this->input->post("fields"); 
                    $psm['whereCondition']  =   "blog_id = '".$uri."'";
                    $vue    =   $this->blog_model->getBlog($psm);
                    if(is_array($vue) && count($vue) > 0){
                            $bt     =   $this->blog_model->activedeactive($uri,$status); 
                            if($bt > 0){
                                $vsp    =   1;
                            }
                    }else{
                        $vsp    =   2;
                    } 
                } 
                echo $vsp;
        }
        public function __destruct() {
                $this->db->close();
        }
}