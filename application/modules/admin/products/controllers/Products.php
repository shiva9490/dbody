<?php
class Products extends CI_Controller{
    public function __construct() {
                parent::__construct();
                if($this->session->userdata("manage-products") != '1'){
                        redirect(sitedata("site_admin")."/dashboard");
                }
        }
        public function create_produc_name(){
            $dta   =    array(
                "title"     =>  "Create Products",
                "content"   =>  "create_produc_name",
                "limit"     =>  1,
                "res"       =>  $this->category_model->viewCategory(array("order_by" => "ASC","tiporderby" => "category_name")),
                "vendor"    =>  $this->vendor_model->viewVendors(array("order_by" => "ASC","tiporderby" => "vendor_name"))
            );
            if($this->input->post("submit")){
                $this->form_validation->set_rules("product_name","Product Name","required");
                if($this->form_validation->run() == TRUE){
                    $ins    =   $this->product_model->create_productss();
                    if($ins){
                        $this->session->set_flashdata("suc","Product has been created successfully");
                        redirect(sitedata("site_admin")."/Create-Product-Name");
                    }else{
                        $this->session->set_flashdata("err","Product has been not created.Please try again.");
                        redirect(sitedata("site_admin")."/products");
                    }
                }
            }
            $conditions =   array();
            $page       =   $this->uri->segment('3');
            $offset     =   (!$page)?"0":$page;
            $keywords   =   $this->input->post('keywords'); 
            if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
            }  
            $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
            $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tiporderby     =    $this->input->post('tiporderby')?str_replace("+"," ",$this->input->post('tiporderby')):"productid";  
            $totalRec               =   $this->product_model->cntviewProduct($conditions);  
            if(!empty($orderby) && !empty($tiporderby)){ 
                    $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                    $dta['tiporderby']    =   $conditions['tiporderby']   =  $tiporderby; 
            } 
            $config['base_url']     =   bildourl('viewproductsnames');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            $conditions['limit']    =   $perpage;
            $dta["limit"]           =   $offset+1;
            $dta["view"]            =   $this->product_model->viewProduct($conditions);
            $this->load->view("admin/inner_template",$dta);
        }
        public function create_product(){
                $a['where_condition']="event_status = 'Active'";
                $dta   =    array(
                    "title"     =>  "Products",
                    "content"   =>  "product",
                    "limit"     =>  1,
					'result'	=>	'',
                    "res"       =>  $this->category_model->viewCategory(array("order_by" => "ASC","tiporderby" => "category_name")), 
                    "vendor"    =>  $this->vendor_model->viewVendors(array("order_by" => "ASC","tiporderby" => "vendor_name"))
                );
               
                if ($this->input->post("submit")) {
                    //echo '<pre>';print_r($this->input->post());exit;
                    $this->form_validation->set_rules("vendor_mobile","vendor","required");
                    $this->form_validation->set_rules("category","Category","required");
                    //$this->form_validation->set_rules("sub_category","Sub Category","required");
                    $this->form_validation->set_rules("vendorproduct_product","Product Name","required");
                    $this->form_validation->set_rules("vendorproduct_description","Description","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_model","Model","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_brand","Brand","required|trim|xss_clean");
                    //$this->form_validation->set_rules("vendorproduct_bb_quantity[]","Quantity","required|trim|xss_clean");
                    //$this->form_validation->set_rules("vendorproduct_bb_price[]","Price","required|trim|xss_clean");
                    //$this->form_validation->set_rules("vendorproduct_bb_mrp[]","MRP","required|trim|xss_clean");
                    //$this->form_validation->set_rules("vendorproduct_bb_measure[]","Measure","required|trim|xss_clean"); 
                    /*$this->form_validation->set_rules("vendorproduct_bc_quantity","Quantity","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_bc_price","Price","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_bc_mrp","MRP","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_bc_measure","Measure","required|trim|xss_clean"); */
                    $this->form_validation->set_rules("vendorproduct_tax_class","Tax Class","required|trim|xss_clean"); 
                    $this->form_validation->set_rules("vendorproduct_shipping","Shipping","required|trim|xss_clean"); 
                    if(count($_FILES) == 0){
                        $this->form_validation->set_rules("product_upload[]","Images","required"); 
                    }
                    if($this->form_validation->run() == TRUE){
                        $ins = $this->vendor_model->product_create();
                        if($ins){
                            $this->session->set_flashdata("suc","Product has been created successfully");
                            redirect(sitedata("site_admin")."/products","refersh");
                        }else{
                            $this->session->set_flashdata("err","Product has been not created.Please try again.");
                            redirect(sitedata("site_admin")."/products");
                        }
                    }
                }
                $dta["measure"]    =   $this->measure_model->viewMeasure(); 
                $this->load->view("admin/inner_template",$dta);
        }
        public function index(){
                $dta   =    array(
                    "title"     =>  "Products",
                    "content"   =>  "products",
                    "limit"     =>  1
                );
                if($this->input->post('excel')){
                    $this->product_model->reportvlue();
                }
                $conditions =   array(); 
                $keywords   =   $this->input->get('keywords'); 
                if(!empty($keywords)){
                    $conditions['keywords'] = $keywords;
                }
                $perpage        =    $this->input->get("limit")?$this->input->get("limit"):sitedata("site_pagination");
                $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
                $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tiporderby')):"vendorproductid"; 
                $totalRec       =   $this->vendor_model->cntviewVendorproducts_list($conditions); 
                $conditions["group_by"]     =   "vp.vendorproduct_id";
                $config['base_url']    =    bildourl("viewproducts");
                $config['total_rows']  =    $totalRec;
                $config['per_page']    =    $perpage;//sitedata("site_pagination"); 
                $config['link_func']   =    'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['order_by']    =  $orderby;
                $conditions['tiporderby']  =  $tipoOrderby; 
                $conditions['limit']    =   $perpage;//sitedata("site_pagination"); 
                $conditions['columns']  =   'product_name,category_name,subcategory_name,vendorproduct_brand,vendorproduct_bb_price,vendorproduct_id,vendorproduct_out_stock';
                $dta['view']            =   $this->vendor_model->viewVendorproducts_list($conditions);
                //$dta['view']            =   $this->vendor_model->viewVendorproducts($conditions);
                $dta['types']           =   '';
               // echo '<pre>';print_r($dta['view']);exit;
                $this->load->view("admin/inner_template",$dta);
        }
        
        public function viewproductsnames(){
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tiporderby     =    $this->input->post('tiporderby')?str_replace("+"," ",$this->input->post('tiporderby')):"productid";  
                $totalRec               =   $this->product_model->cntviewProduct($conditions);  
                if(!empty($orderby) && !empty($tiporderby)){ 
                        $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                        $dta['tiporderby']    =   $conditions['tiporderby']   =  $tiporderby; 
                } 
                $config['base_url']     =   bildourl('viewproductsnames');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->product_model->viewProduct($conditions);
                $this->load->view("ajax_productnames",$dta);
        }
        
        public function prices_list(){
                $dta   =    array(
                    "title"     =>  "prices list",
                    "content"   =>  "prices_list",
                    "measure"   =>  $this->measure_model->viewMeasure(),
                );
                if($this->input->post('submit')){
                    //$this->form_validation->set_rules("vendor_ingredientslist","Ingredients list","required");
                    //$this->form_validation->set_rules("vendorproduct_bb_quantity","Quantityty list","required");
                    $this->form_validation->set_rules("vendorproduct_bb_price","price ","required");
                    //$this->form_validation->set_rules("vendorproduct_bb_mrp","mrp ","required");
                    $this->form_validation->set_rules("vendorproduct_bb_measure","measure ","required");
                    if($this->form_validation->run() == TRUE){
                        $ins    =   $this->product_model->create_products_price();
                        if($ins){
                            $this->session->set_flashdata("suc","Product Price has been created successfully");
                            redirect(sitedata("site_admin")."/update-Prices/".$this->input->post('vendorproductids'));
                        }else{
                            $this->session->set_flashdata("err","Product Price has been not created.Please try again.");
                            redirect(sitedata("site_admin")."/update-Prices/".$this->input->post('vendorproductids'));
                        }
                    }
                }
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $conditions['whereCondition'] = "vendorproductids LIKE '".$page."'";
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tiporderby     =    $this->input->post('tiporderby')?str_replace("+"," ",$this->input->post('tiporderby')):"vendorproductprince_id";  
                $totalRec               =   $this->vendor_model->cntviewvendorprices($conditions);  
                if(!empty($orderby) && !empty($tiporderby)){ 
                        $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                        $dta['tiporderby']    =   $conditions['tiporderby']   =  $tiporderby; 
                } 
                $config['base_url']     =   bildourl('ajax_product_prices');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                //$dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->vendor_model->viewVendorproductprices($conditions);
                $this->load->view("admin/inner_template",$dta);
        }
        public function update_product_Price(){
            $uri    =   $this->uri->segment("3");
            $ids    =   $this->uri->segment("4");
            $vue    =   $this->product_model->getvenodrPrice($uri);
            if(is_array($vue) && count($vue) > 0){
                $dta   =    array(
                    "title"     =>  "update product Price",
                    "content"   =>  "update_product_Price",
                    "view"      =>  $vue,
                    "measure"   =>  $this->measure_model->viewMeasure(),
                );
                if($this->input->post('submit')){
                    //$this->form_validation->set_rules("vendor_ingredientslist","Ingredients list","required");
                    //$this->form_validation->set_rules("vendorproduct_bb_quantity","Quantityty list","required");
                    $this->form_validation->set_rules("vendorproduct_bb_price","price ","required");
                    //$this->form_validation->set_rules("vendorproduct_bb_mrp","mrp ","required");
                    $this->form_validation->set_rules("vendorproduct_bb_measure","measure ","required");
                    if($this->form_validation->run() == TRUE){
                        $ins    =   $this->product_model->update_product_Price($uri);
                        if($ins){
                            $this->session->set_flashdata("suc","Product Price has been Update successfully");
                            redirect(sitedata("site_admin")."/update-Prices/".$ids);
                        }else{
                            $this->session->set_flashdata("err","Product Price has been not Update.Please try again.");
                            redirect(sitedata("site_admin")."/update-Prices/".$ids);
                        }
                    }
                }
                $this->load->view("admin/inner_template",$dta);
            }else{
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        
        public function update_images(){
                $dta   =    array(
                    "title"     =>  "Update prices images",
                    "content"   =>  "prices_images",
                    "measure"   =>  $this->measure_model->viewMeasure(),
                );
                if($this->input->post('submit')){
                    $venid = $this->input->post('venid');
                    $vendor = (isset($tvi) && count($tvi) > 0)?$tvi['vendor_id']:$this->session->userdata("login_id");
                    if(count($_FILES) != 0){
                        $ins    =   $this->vendor_model->productpload($venid,$vendor);
                        if($ins){
                            $this->session->set_flashdata("suc","Product Image has been created successfully");
                            redirect(sitedata("site_admin")."/update-images/".$venid);
                        }else{
                            $this->session->set_flashdata("err","Product Image has been not created.Please try again.");
                            redirect(sitedata("site_admin")."/update-images/".$venid);
                        }
                    }
                }
                $conditions =   array();
                $uri       =   $this->uri->segment('3');
                $page       =   $this->uri->segment('4');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $conditions['whereCondition'] = "vendorproduct_productid LIKE '".$uri."'";
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tiporderby     =    $this->input->post('tiporderby')?str_replace("+"," ",$this->input->post('tiporderby')):"vendorproductimgid";  
                $totalRec               =   $this->vendor_model->cntviewVendorproductimages($conditions);  
                if(!empty($orderby) && !empty($tiporderby)){ 
                        $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                        $dta['tiporderby']    =   $conditions['tiporderby']   =  $tiporderby; 
                } 
                $config['base_url']     =   bildourl('ajax_product_images');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->vendor_model->viewVendorproductimages($conditions);
                $this->load->view("admin/inner_template",$dta);
        }
        public function viewproductprince(){
                $conditions =   array();
                $prodid     =   $this->uri->segment('3');
                $page       =   $this->uri->segment('4');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                }  
                $conditions['whereCondition'] = "vendorproductids LIKE '".$prodid."'";
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tiporderby     =    $this->input->post('tiporderby')?str_replace("+"," ",$this->input->post('tiporderby')):"vendorproductprince_id";  
                $totalRec               =   $this->vendor_model->cntviewvendorprices($conditions);    
                if(!empty($orderby) && !empty($tiporderby)){ 
                        $dta['orderby']        =   $conditions['order_by']      =   $orderby;
                        $dta['tiporderby']    =   $conditions['tiporderby']   =  $tiporderby; 
                } 
                $config['base_url']     =   bildourl('viewproductprince/'.$prodid.'/');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $dta["limit"]           =   $offset+1;
                $dta["view"]            =   $this->vendor_model->viewVendorproductprices($conditions);
                $this->load->view("ajax_product_prices",$dta);
        }
        
        public function Delete_product_images(){
            if($this->session->userdata("update-product") != '1'){
                redirect(sitedata("site_admin")."/dashboard");
            }else{
                $uri    =   $this->uri->segment("3"); 
                $pms["whereCondition"]    =   "vendorproductimg_id = '".$uri."'";
                $vue    =   $this->vendor_model->getVendorproductimages($pms);
                if(is_array($vue) && count($vue) > 0){
                    $bt     =   $this->vendor_model->delete_product_images($uri); 
                    if($bt > 0){
                               $vsp    =   1;
                        }else{
                               $vsp    =   2;
                        }
                }else{
                   $vsp    =   0;
                }
                echo $vsp;
            }
        }
        
        public function update_product_images(){
            if($this->session->userdata("update-product") != '1'){
                redirect(sitedata("site_admin")."/dashboard");
            }else{
                $uri    =   $this->uri->segment("3"); 
                $pms["whereCondition"]    =   "vendorproductimg_id = '".$uri."'";
                $vue    =   $this->vendor_model->getVendorproductimages($pms);
                if(is_array($vue) && count($vue) > 0){
                    $dt     =   array(
                        "title"     =>  "Update Category",
                        "content"   =>  "update_product_image",
                        "view"      =>  $vue,
                    ); 
                    if($this->input->post()){
                        $bt     =   $this->vendor_model->update_product_images($uri); 
                        if($bt > 0){
                            $this->session->set_flashdata("suc","Update Product image Successfully.");
                            redirect(bildourl('update-images/'.$vue['vendorproduct_productid']));
                        }else{
                            $this->session->set_flashdata("err","Not Update Product image.Please try again.");
                            redirect(bildourl('update-images/'.$vue['vendorproduct_productid']));
                        }
                    }
                    // print_r($vue);exit;
                    $this->load->view("admin/inner_template",$dt);
                }else{
                    $this->session->set_flashdata("war","Product does not exists."); 
                    redirect(sitedata("site_admin")."/Create-Product-Name");
                }
            }
        }
        
        public function update_product_name(){
                if($this->session->userdata("update-product") != '1'){
                    redirect(sitedata("site_admin")."/dashboard");
                }
                $uri    =   $this->uri->segment("3"); 
                $pms["whereCondition"]    =   "product_id = '".$uri."'";
                $vue    =   $this->product_model->getProduct($pms);
                if(is_array($vue) && count($vue) > 0){
                        $vendorproduct_category     =   $vue["category_id"];
                        $psm["where_condition"]     =   "category_id lIKE '".$vue['vendorproduct_category']."'";
                        $dt     =   array(
                                "title"     =>  "Update Category",
                                "content"   =>  "update_produc_name",
                                "res"       =>  $this->category_model->viewCategory(array("order_by" => "ASC","tiporderby" => "category_name")),
                                "cres"      =>  $this->category_model->viewsub_categories(array("order_by" => "ASC","whereCondition" => "subcategory_category = '".$vendorproduct_category."'","tiporderby" => "subcategory_name")),
                                "view"      =>  $vue,
                                "vendor"    =>  $this->vendor_model->viewVendors(array("order_by" => "ASC","tiporderby" => "vendor_name")),
                                "result"    =>  $this->category_model->viewsub_categories($psm),
                        ); 
                        
                        if($this->input->post("submit")){
                            $this->form_validation->set_rules("product_name","Product Name","required");
                            if($this->form_validation->run() == TRUE){
                                $ins    =   $this->product_model->update_product($uri);
                                if($ins){
                                    $this->session->set_flashdata("suc","Product has been Updated successfully");
                                    redirect(sitedata("site_admin")."/Create-Product-Name");
                                }else{
                                    $this->session->set_flashdata("err","Product has been not Updated.Please try again.");
                                }
                            }
                        }
                        
                        $this->load->view("admin/inner_template",$dt);
                }else{
                        $this->session->set_flashdata("war","Product does not exists."); 
                        redirect(sitedata("site_admin")."/Create-Product-Name");
                }
        }
        
        public function update_product(){
                if($this->session->userdata("update-product") != '1'){
                    redirect(sitedata("site_admin")."/dashboard");
                }
                $a['where_condition']="event_status = 'Active'";
                $uri    =   $this->uri->segment("3"); 
                $pms["whereCondition"]    =   "vendorproduct_id = '".$uri."'";
                $vue    =   $this->vendor_model->getvendorproduct($pms);
                if(count($vue) > 0){
                        $vendorproduct_category     =   $vue["category_id"];
                        $psm["where_condition"] =   "category_id lIKE '".$vue['vendorproduct_category']."'";
                        $psms["whereCondition"]    =   "vendorproductids = '".$vue['vendorproduct_id']."'";
                        $dt     =   array(
                                "title"     =>  "Update Product",
                                "content"   =>  "update_product",
                                "res"       =>  $this->category_model->viewCategory(array("order_by" => "ASC","tiporderby" => "category_name")),
                                "cres"      =>  $this->category_model->viewsub_categories(array("order_by" => "ASC","whereCondition" => "subcategory_category = '".$vendorproduct_category."'","tiporderby" => "subcategory_name")),
                                "view"      =>  $vue,
                                "vendor"    =>  $this->vendor_model->viewVendors(array("order_by" => "ASC","tiporderby" => "vendor_name")),
                                "result"    =>  $this->category_model->viewsub_categories($psm),
                                "price"     =>  $this->vendor_model->viewVendorproductPrices($psms),
                                "measure"   =>  $this->measure_model->viewMeasure(),
                        ); 
                       // echo '<pre>';print_r($dt['ingredients']);exit;
                        if($this->input->post("submit")){
                            //echo '<pre>';print_r($this->input->post());exit;
                            $this->form_validation->set_rules("vendor_mobile","vendor","required");
                            $this->form_validation->set_rules("category","Category","required");
                            //$this->form_validation->set_rules("sub_category","Sub Category","required");
                            $this->form_validation->set_rules("vendorproduct_product","Product Name","required");
                            $this->form_validation->set_rules("vendorproduct_description","Description","required|trim|xss_clean"); 
                            $this->form_validation->set_rules("vendorproduct_model","Model","required|trim|xss_clean"); 
                            $this->form_validation->set_rules("vendorproduct_brand","Brand","required|trim|xss_clean"); 
                            /*$this->form_validation->set_rules("vendorproduct_bc_quantity","Quantity","required|trim|xss_clean"); 
                            $this->form_validation->set_rules("vendorproduct_bc_price","Price","required|trim|xss_clean"); 
                            $this->form_validation->set_rules("vendorproduct_bc_mrp","MRP","required|trim|xss_clean"); 
                            $this->form_validation->set_rules("vendorproduct_bc_measure","Measure","required|trim|xss_clean"); */ 
                            $this->form_validation->set_rules("vendorproduct_tax_class","Tax Class","required|trim|xss_clean"); 
                            $this->form_validation->set_rules("vendorproduct_shipping","Shipping","required|trim|xss_clean");  
                            if($this->form_validation->run() == TRUE){
                                $insert_loc = $this->vendor_model->product_update($vue['vendorproduct_id']);
                                if ($insert_loc) {
                                    $this->session->set_flashdata("suc","Updated Product Successfully.");
                                    redirect(sitedata("site_admin")."/products");
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
                        redirect(sitedata("site_admin")."/products");
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
                        $bt     =   $this->vendor_model->product_delete($uri); 
                        if($bt > 0){
                                // $this->session->set_flashdata("suc","Deleted Product Successfully.");
                                // redirect(sitedata("site_admin")."/products");
                                $vsp=1;
                        }else{
                                // $this->session->set_flashdata("err","Not Deleted Product.Please try again.");
                                // redirect(sitedata("site_admin")."/products");
                                $vsp    =   2;
                        }
                }else{
                        // $this->session->set_flashdata("war","Product does not exists."); 
                        // redirect(sitedata("site_admin")."/products");
                        $vsp=0;
                }
                echo $vsp;
        }
        public function viewproducts(){
                $conditions =   array();
                $page       =   $this->uri->segment('3');
                $offset     =   (!$page)?"0":$page;
                $keywords   =   $this->input->post('keywords'); 
                $category   =   $this->input->post('category'); 
                $subcategory=   $this->input->post('subcategory'); 
                $types      =   $this->input->post('types'); 
                if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                } 
                $hr="";
                if($category !=""){
                    $hr = "sn.category_id LIKE '".$category."'";
                }
                if($category !="" && $subcategory !=""){
                    $hr = "sn.category_id LIKE '".$category."' AND sv.subcategory_id LIKE '".$subcategory."'";
                }
                if($category =="" && $subcategory !=""){
                    $hr = "sv.subcategory_id LIKE '".$subcategory."'";
                }
                if($hr !=""){
                    $conditions['whereCondition'] =  $hr;
                }
                $perpage        =    $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_pagination");    
                $orderby        =    $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tiporderby     =    $this->input->post('tiporderby')?str_replace("+"," ",$this->input->post('tiporderby')):"vendorproductid";  
                $totalRec               =  $this->vendor_model->cntviewVendorproducts_list($conditions);  
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
                $dta["types"]           =   $types;
                $dta["view"]            =   $this->vendor_model->viewVendorproducts_list($conditions);
                $this->load->view("ajax_product",$dta);
        }
        public function delete_product_name(){
                if($this->session->userdata("delete-product") != '1'){
                    redirect(sitedata("site_admin")."/dashboard");
                }
                $uri    =   $this->uri->segment("3");
                $pms["whereCondition"]    =   "product_id = '".$uri."'";
                $vue    =   $this->product_model->getProduct($pms);
                if(count($vue) > 0){
                        $bt     =   $this->product_model->delete_product($uri); 
                        if($bt > 0){
                                $this->session->set_flashdata("suc","Deleted Product Name Successfully.");
                                redirect(sitedata("site_admin")."/Create-Product-Name");
                        }else{
                                $this->session->set_flashdata("err","Not Deleted Product.Please try again.");
                                redirect(sitedata("site_admin")."/Create-Product-Name");
                        }
                }else{
                        $this->session->set_flashdata("war","Product does not exists."); 
                        redirect(sitedata("site_admin")."/Create-Product-Name");
                }
        }       
        public function unique_product_name(){
                echo $this->product_model->unique_product_name($this->input->post("sub_category"));
        }
        public function measurelist(){
                $r = $this->measure_model->viewMeasure();
                $option ="<option value=''>Select Measures</option>";
                foreach($r as $r){
                    $option.="<option value=".$r->measure_id.">".$r->measure_unit."</option>";
                }
                print_r($option);
        }
        public function deletePrice(){
            if($this->session->userdata("delete-measure") != '1'){
                        redirect(sitedata("site_admin"));
                }
                $uri    =   $this->uri->segment("3");
                $vue    =   $this->product_model->getvenodrPrice($uri);
                if(count($vue) > 0){
                        $bt     =   $this->product_model->deletePrice($uri);
                        if($bt > 0){
                               $vsp    =   1;
                        }else{
                               $vsp    =   2;
                        }
                }else{
                        $vsp    =   0;
                }
                echo $vsp;
           /* $uri    =   $this->uri->segment("3");
            $ids    =   $this->uri->segment("4");
            $vue    =   $this->product_model->getvenodrPrice($uri);
            if(is_array($vue) && count($vue) > 0){
               $r =  $this->product_model->deletePrice($uri);
               if($r > 0){
                   $this->session->set_flashdata("suc","Deleted Product Name Successfully.");
                   redirect(sitedata("site_admin").'/update-Prices/'.$ids);
               }else{
                   $this->session->set_flashdata("war","Product does not exists."); 
                   redirect(sitedata("site_admin").'/'.$uri);
               }
            }*/
        }
        public function Upload_product(){
            $dta   =    array(
                "title"     =>  "Update Products",
                "content"   =>  "upload_product",
                "vendor"    =>  $this->vendor_model->viewVendors(array("order_by" => "ASC","tiporderby" => "vendor_name")),
            );
        	$madatory_fields    =       array();
            $columnNames = array(); 
            if($this->input->post("submit")){
                $this->load->library("excel");
                $fname  =   $_FILES['excel']['name'];
                $filesize = $_FILES['excel']['size']; 
                $max_file_size  =   "26214400";
                $exts   =   explode(".",$fname);
                if($fname != ''){
                    if($filesize > 0){ 
                        $allowedExtensions = array("xlsx","xls","csv");
                        if (!in_array(end($exts), $allowedExtensions)) {
                            $this->session->set_flashdata('err','Invalid file. Please upload XLSX file. Please save your excel file to XLSX format.'); 
                            redirect(sitedata("site_admin")."/Upload-product");
                        } 
                        else if($filesize >= $max_file_size && $filesize > 0){
                            $this->session->set_flashdata('err','The file Size Exceeds the Prescribed Limit of : 26214400 Bytes (25 MB)! <br/> The Current File Size is : '.$filesize." Bytes."); 
                            redirect(sitedata("site_admin")."/Upload-product"); 
                        }else {
                            $config['upload_path']      = './tmp'; 
                            $config['allowed_types']    = '*'; 
                            $this->load->library('upload', $config); 
                            $this->upload->do_upload("excel");
                            $datap           =  array('upload_data' => $this->upload->data());
                            $datafile        =  $datap["upload_data"]["file_name"];
                            $filename        =  "./tmp/".$datafile;  
                            $xls_to_convert  =  $filename;
                            error_reporting(E_ALL);
                            //$xls_to_convert ="./tmp/minikart prod.xls";
                            ini_set('display_errors', TRUE);
                            ini_set('display_startup_errors', TRUE);
                            define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');  
                            $objPHPExcel    =   PHPExcel_IOFactory::load($xls_to_convert);
                            //print_r($objPHPExcel);exit;
                            // $objWriter      =   PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                            // $objWriter->save(str_replace('.xls', '.xlsx', $xls_to_convert));
                            // $fislename          =       str_replace('.xls', '.xlsx', $xls_to_convert);
                            // $obsjPHPExcel       =       PHPExcel_IOFactory::load($fislename);   
                            $objWorksheet       =       $objPHPExcel->getActiveSheet(); 
                            
                            $rcln               =       $objWorksheet->getHighestDataRow();
                            $dcln               =       $objWorksheet->getHighestDataColumn();  
                            $highestColumnIndex =       PHPExcel_Cell::columnIndexFromString($dcln);
                            $vs =   array();
                            $cmadatory_fields    =   array();
                            $vspval =   0;
                            for($i = 0;$i < $highestColumnIndex;$i++){ 
                                $value  =   ($objWorksheet->getCellByColumnAndRow("$i", 1)->getValue() != null) ? $objWorksheet->getCellByColumnAndRow($i, 1)->getValue() : ""; 
                                if($value != ""){
                                    $vspval++;
                                    if(in_array($i,$cmadatory_fields)){
                                        $columnNames[$i]  =   trim($value,"**"); 
                                        array_push($madatory_fields, ($i));
                                    }
                                }
                            }  
                            $error_columns      =       "";
                            $vt     =   array();
                            for($row = 2; $row <= $rcln; ++$row) { 
                                $values     =       array(); 
                                $count = 0;
                                for ($col = "0"; $col < $vspval;++$col) { 
                                        $value  =   ($objWorksheet->getCellByColumnAndRow($col, $row)->getFormattedValue() != null) ? $objWorksheet->getCellByColumnAndRow($col, $row)->getFormattedValue() : "";
                                        $rf     =   $objWorksheet->getCellByColumnAndRow('0', $row)->getFormattedValue();
                                        if($value == "" && in_array($col,$madatory_fields)){
                                            ++$count;
                                            $error_columns .=  "S.No ".$rf." - ".$columnNames[$col]." is required"."<br/>";
                                        }   
                                        $values[]      =   $value; 
                                }      
                                $vt[]       =       $values;
                            }   
                            unlink("tmp/".$datafile);
                            if($error_columns != ""){
                                $this->session->set_flashdata("war",$error_columns);
                                redirect(sitedata("site_admin")."/Upload-product"); 
                            }
                            else{  
                                /*$vts    =       $this->product_model->checkstudent($vt);
                                if($vts == ""){*/
                                    $vts    =   $this->product_model->insert_products($vt);
                                    if($vts){
                                        $this->session->set_flashdata("suc","Products data has been Uploaded successfully");
                                        redirect(sitedata("site_admin")."/Upload-product"); 
                                    }else{
                                        $this->session->set_flashdata("err","Products data has been not Uploaded successfully");
                                        redirect(sitedata("site_admin")."/Upload-product"); 
                                    }
                                /*}else{
                                    $this->session->set_flashdata("war","<span class='text-danger'>".$vts."</span>");
                                    redirect(sitedata("site_admin")."/Upload-product"); 
                                }*/
                            }
                        }  
                        }
                    }else{ 
                    $this->session->set_flashdata("err","Upload Excel is required");
                    redirect(sitedata("site_admin")."/Upload-product");
                }
            }
            $this->load->view("admin/inner_template",$dta);
        }
        public function Update_Prices(){
            $dta   =    array(
                "title"     =>  "Update Products Prices",
                "content"   =>  "Update_Prices",
                "vendor"    =>  $this->vendor_model->viewVendors(array("order_by" => "ASC","tiporderby" => "vendor_name")),
                "res"       =>  $this->category_model->viewCategory(array("order_by" => "ASC","tiporderby" => "category_name")),
            );

            if($this->input->post('submit')){
                //echo '<pre>';print_r($this->input->post());exit;
                $mobile = $this->input->post('vendor_mobile');
                $this->product_model->update_prince($mobile);
            }
            $this->load->view("admin/inner_template",$dta);
        }
        public function product_photos_upload(){
    	    $dta    =   array(
    	        "type"      =>  "Multiple product photo Upload",
    			"title"     =>  "Multiple product photo Upload",
    			"content"   =>  "product_photos_upload",
    		);
    		$data='';
    		if($this->input->post('submit')){
        	    if(!empty($_FILES)){
        		    $total  =  count($_FILES['file']['name']);
        		    for($count  =  0;$count<$total;$count++){
            		   $filename = (explode(".",$_FILES['file']['name'][$count]));
            		   $filename = (explode("_",$filename[0]));
            		   $par['columns'] = "vendorproduct_id";
            		   $par['whereCondition'] = "vendorproduct_code like '".$filename[0]."'";
            		   $vue    = $this->product_model->product_id($par)->row_array();
            		   //print_r($vue);exit;
            		   if(is_array($vue) && count($vue) > 0){
            		       $r  = $this->product_model->product_photos_upload($vue['vendorproduct_id'],$count);
            		       if($r){
            		           $data .=   $_FILES['file']['name'][$count].' --> Upload Successfully<br>';
            		       }else{
            		           $data .=   $_FILES['file']['name'][$count].' --> Upload Failed<br>';
            		       }
            		   }else{
            		       $data .=   $_FILES['file']['name'][$count].' --> Upload Failed11<br>';
            		   }
        		    }
        		     $this->session->set_flashdata("suc",$data);
        		   
        		}
    		}
    		
    	    $this->load->view("admin/inner_template",$dta);
    	}
    	public function ajax_items(){
                $cat	= explode(',',$this->input->post('cat_id'));
                $dta["prod"] 	= explode(',',$this->input->post('product_id'));
                $i=0; 
                foreach($cat as $c){
                    if($i==0){
                        $par['where_condition'] = "subcategory_category = '".$c."'";
                    }else{
                        $par['where_condition'] .= " OR subcategory_category = '".$c."'";
                    }
                    $i++;
                }
                $par['columns']	="distinct(subcategory_name),subcategory_id ";
                $dta["items"]            =   $this->category_model->viewsub_categories($par);
                $this->load->view("ajax_items",$dta); 
        }
        public function excel_products(){
            $this->product_model->reportvlue();
        }
        
}