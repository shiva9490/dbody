<?php
class Products extends CI_Controller{
    public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-products") != '1'){
                        redirect(sitedata("site_admin")."/dashboard");
                }
        }
        public function index(){
                $dta   =    array(
                    "title"     =>  "Products",
                    "content"   =>  "product",
                    "limit"     =>  1,
                    "res"   =>  $this->category_model->viewCategory(array("order_by" => "ASC","tiporderby" => "category_name"))
                );
                if($this->input->post("submit")){
                    $this->form_validation->set_rules("category","Category","required");
                    $this->form_validation->set_rules("sub_category","Sub Category","required");
                    $this->form_validation->set_rules("product_name","Product Name","required");
                    if($this->form_validation->run() == TRUE){
                        $ins    =   $this->product_model->create_product();
                        if($ins){
                            $this->session->set_flashdata("suc","Product has been created successfully");
                            redirect(sitedata("site_admin")."/products");
                        }else{
                            $this->session->set_flashdata("err","Product has been not created.Please try again.");
                            redirect(sitedata("site_admin")."/products");
                        }
                    }
                }
                $dta["measure"]    =   $this->measure_model->viewMeasure(); 
                $this->load->view("admin/inner_template",$dta);
        }
        public function view_product(){
                $dta   =    array(
                    "title"     =>  "Products",
                    "content"   =>  "products",
                    "limit"     =>  1
                );
                $conditions =   array(); 
                $keywords   =   $this->input->get('keywords'); 
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->get("limit")?$this->input->get("limit"):sitedata("site_pagination");
                $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tiporderby')):"productid"; 
                $totalRec       =   $this->vendor_model->cntviewVendorproducts($conditions); 
                $config['base_url']    =    bildourl("viewproducts");
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $perpage;//sitedata("site_pagination"); 
                $config['link_func']   =    'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['order_by']    =  $orderby;
                $conditions['tiporderby']  =  $tipoOrderby; 
                $conditions['limit']    =   $perpage;//sitedata("site_pagination"); 
                $dta['view']            =   $this->vendor_model->viewVendorproducts($conditions);
                $this->load->view("admin/inner_template",$dta);
        }
        public function viewproducts(){
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tiporderby     =    $this->input->post('tiporderby')?str_replace("+"," ",$this->input->post('tiporderby')):"categoryid";  
                $totalRec               =   $this->vendor_model->cntviewVendorproducts($conditions);  
                if(!empty($orderby) && !empty($tiporderby)){ 
                        $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                        $dta['tiporderby']    =   $conditions['tiporderby']   =  $tiporderby; 
                } 
                $config['base_url']     =   bildourl('viewproducts');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->vendor_model->viewVendorproducts($conditions);
                $this->load->view("ajax_product",$dta);
        }
        public function update_product(){
                if($this->session->userdata("update-product") != '1'){
                    redirect(sitedata("site_admin")."/dashboard");
                }
                $uri    =   $this->uri->segment("3"); 
                $pms["whereCondition"]    =   "vendorproduct_id = '".$uri."'";
                $vue    =   $this->vendor_model->getvendorproduct($pms);
                if(count($vue) > 0){
                        $vendorproduct_category     =   $vue["category_id"];
                        $dt     =   array(
                                "title"     =>  "Update Sub Category",
                                "content"   =>  "update_product",
                                "res"   =>  $this->category_model->viewCategory(array("order_by" => "ASC","tiporderby" => "category_name")),
                                "cres"   =>  $this->category_model->viewsub_categories(array("order_by" => "ASC","whereCondition" => "subcategory_category = '".$vendorproduct_category."'","tiporderby" => "subcategory_name")),
                                "view"      =>  $vue
                        ); 
                        if($this->input->post("submit")){
                            $this->form_validation->set_rules("category","Category","required");
                            $this->form_validation->set_rules("sub_category","Sub Category","required");
                            $this->form_validation->set_rules("vendorproduct_product","Product Name","required");
                            $this->form_validation->set_rules("vendorproduct_description","Description","required");
                            $this->form_validation->set_rules("vendorproduct_bb_gross","Gross Weight","required");
                            $this->form_validation->set_rules("vendorproduct_bb_net","Net Weight","required");
                            $this->form_validation->set_rules("vendorproduct_bb_price","Price","required");
                            $this->form_validation->set_rules("vendorproduct_bb_mrp","MRP","required");
                            $this->form_validation->set_rules("vendorproduct_bb_quantity","Quantity","required");
                            $this->form_validation->set_rules("vendorproduct_bb_measure","Measure","required");
                            if($this->form_validation->run() == TRUE){
                                $bt     =   $this->vendor_model->productupdate($uri);
                                if($bt > 0){
                                    $this->session->set_flashdata("suc","Updated Product Successfully.");
                                    redirect(sitedata("site_admin")."/view-products");
                                }else{
                                    $this->session->set_flashdata("err","Not Updated Product.Please try again.");
                                    redirect(sitedata("site_admin")."/update-product/".$uri);    
                                }
                            }
                        }
                        $dt["measure"]    =   $this->measure_model->viewMeasure(); 
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Product does not exists."); 
                        redirect(sitedata("site_admin")."/view-products");
                }
        }
        public function delete_product(){
                if($this->session->userdata("delete-product") != '1'){
                    redirect(sitedata("site_admin")."/dashboard");
                }
                $uri    =   $this->uri->segment("3");
                $pms["whereCondition"]    =   "vendorproduct_id = '".$uri."'";
                $vue    =   $this->vendor_model->getvendorproduct($pms);
                if(count($vue) > 0){
                        $bt     =   $this->vendor_model->delete_product($uri); 
                        if($bt > 0){
                                $this->session->set_flashdata("suc","Deleted Product Successfully.");
                                redirect(sitedata("site_admin")."/view-products");
                        }else{
                                $this->session->set_flashdata("err","Not Deleted Product.Please try again.");
                                redirect(sitedata("site_admin")."/view-products");
                        }
                }else{
                        $this->session->set_flashdata("war","Product does not exists."); 
                        redirect(sitedata("site_admin")."/view-products");
                }
        }      
        public function unique_product_name(){
                echo $this->product_model->unique_product_name($this->input->post("sub_category"));
        }
}