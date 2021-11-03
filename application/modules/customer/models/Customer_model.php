<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Customer_model extends CI_Model{
        public function cur(){
            $currency = $this->input->post('currency');
            if($currency!=""){
                $par['whereCondition'] = "currnecy_name LIKE '".$currency."'";
                $vue = $this->customer_model->getCurrency($par);
                if(is_array($vue) && count($vue) >0){
                    $this->session->set_userdata("countryname",$vue[0]['currnecy_name']);
                    $this->session->set_userdata("currency_code",$vue[0]['currnecy_name']);
                    $this->session->set_userdata("currency_code_lengths",$vue[0]['currency_decimal_digits']);
                    $this->session->set_userdata("symboles",$vue[0]['currency_symboles_native']);
                    echo$this->session->userdata("currency_code");
                }
            }
        }
        function detect_city(){
            $ip = $this->common_config->get_client_ip();
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://api.ipgeolocationapi.com/geolocate/" . $ip);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            $returnData = curl_exec($curl);
            curl_close($curl);    
            $ipJsonInfo = json_decode($returnData);
            $cccc   =   ($ipJsonInfo->currency_code)??'';
            $par['whereCondition'] = "currnecy_name LIKE '".$cccc."'";
            $vue = $this->customer_model->getCurrency($par);
            if(($this->session->userdata("currency_code")) ==""){
                if(is_array($vue) && count($vue) > 0){
                    $this->session->set_userdata("countryname",$vue[0]['currnecy_name']); 
                    $this->session->set_userdata("mobileno_limit",''); 
                    $this->session->set_userdata("currency_code",$vue[0]['currnecy_name']);
                    $this->session->set_userdata("currency_code_lengths",$vue[0]['currency_decimal_digits']);
                    $this->session->set_userdata("symboles",$vue[0]['currency_symboles_native']);
                }else{
                    $par['whereCondition'] = "currnecy_name LIKE 'INR'";
                    $vue1 = $this->customer_model->getCurrency($par);
                    $this->session->set_userdata("countryname",$vue1[0]['currnecy_name']); 
                    $this->session->set_userdata("mobileno_limit",''); 
                    $this->session->set_userdata("currency_code",$vue1[0]['currnecy_name']);
                    $this->session->set_userdata("currency_code_lengths",$vue1[0]['currency_decimal_digits']);
                    $this->session->set_userdata("symboles",$vue1[0]['currency_symboles_native']);
                }
            }
        }
        
        public function sybmoles(){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.localeplanet.com/api/auto/currencymap.json',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                  'Cookie: JSESSIONID=node0d3ltqiqxj9hj11ljb5mx44r262.node0'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $symbols =  json_decode($response,true);
            //echo '<pre>';print_r($symbols);exit;
            if(is_array($symbols) && count($symbols) >0){
                foreach($symbols as $key=>$value){
                    $currency_symboles          = $value['symbol'];
                    $currency_symboles_native   = $value['symbol_native'];
                    $currency_decimal_digits    = $value['decimal_digits'];
                    $dta = array(
                            'currnecy_name'             => $key,
                            'currency_symboles'         => $currency_symboles,
                            'currency_symboles_native'  => $currency_symboles_native,
                            'currency_decimal_digits'   => $currency_decimal_digits,
                        );
                    $this->customer_model->update_currency($dta);
                }
            }
        }
        public function createregister(){
            $mobile     =   $this->input->post("customer_mobile");
            $char = "bcdfghjkmnpqrstvzBCDFGHJKLMNPQRSTVWXZaeiouyAEIOUY";
            $token = '';
            for($i = 0; $i < 47; $i++)
            $token .= $char[(rand() % strlen($char))];
            
            $coupon = $this->ajax_coupon();
            $dta    =   array(
                "customer_id"           =>  "CUST".$this->common_model->get_max("customerid","customers"), 
                "customer_name"         =>  $this->input->post("fname"),
                "customer_mobile"       =>  $this->input->post("mobile"),
                "customer_email_id"     =>  $this->input->post("email"),
                "customer_password"     =>  $this->input->post("password"),
                "customer_cpassword"    =>  ($this->input->post("cpassword"))??$this->input->post("password"),
                "customer_whtmobile"    =>  ($this->input->post("wht_mobile"))??'',
                "customer_coupon"       =>  $coupon,
                "customer_gender"       =>  ($this->input->post("gender")!="")?$this->input->post("gender"):'',
                "customer_country"      =>  $this->input->post("country"),
                "customer_token"        =>  $token,
                "customer_created_on"   =>  date("Y-m-d H:i:s"),
                "customer_created_by"   =>  $this->session->userdata("login_id")?$this->session->userdata("login_id"):""
            );
            //customer_token
            
            $this->db->insert("customers",$dta);
            if($this->db->insert_id() > 0){
                return TRUE;
            }
            return FALSE;
        }
        public function create_customer(){
            $mobile     =   $this->input->post("customer_mobile");
             $coupon = $this->ajax_coupon();
            $dta    =   array(
                "customer_id"     =>    "CUST".$this->common_model->get_max("customerid","customers"), 
                "customer_verified"    =>   '1', 
                "customer_mobile"      =>    $mobile, 
                "customer_coupon"      =>  $coupon,
                "customer_created_on"  =>    date("Y-m-d H:i:s"),
                "customer_created_by"  =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):""
            ); 
             
            $this->db->insert("customers",$dta);
            if($this->db->insert_id() > 0){
                $isn    =       $this->vendor_model->sendotp($mobile,'1');
                return TRUE;
            }
            return FALSE;
        }
        public function update_customer($customer_id=null){
            $dta    =   array( 
                "customer_name"         =>  ucwords($this->input->post("customer_name")), 
                "customer_email_id"     =>  $this->input->post("customer_email_id"),
                //"customer_mobile"       =>  $this->input->post("customer_mobile"),
                "customer_modified_on"  =>  date("Y-m-d H:i:s"),
                "customer_modified_by"  =>  $this->session->userdata("login_id")?$this->session->userdata("login_id"):$customer_id
            ); 
             if(count($_FILES) > 0){
                $target_dir =   $this->config->item("uploads_path")."customer-uploads/";
                $fname      =   $_FILES["customer_profile"]["name"];
                if($fname != "" && $fname != "noname"){
                    $vsp        =   explode(".",$fname);
                    $fname      =   $this->input->post("customer_mobile").".".$vsp['1'];
                    $uploadfile =   $target_dir . basename($fname);
                    $vsp 	=	move_uploaded_file($_FILES['customer_profile']['tmp_name'], $uploadfile); 
                    if($vsp){
                        $dta['customer_profile'] =   $fname;
                    }
                }
            }
            
            if($this->input->post("customer_mobile") !=""){
                $h  ="customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR  customer_token LIKE '".$this->input->post("customer_mobile")."' OR customer_id LIKE '".$this->input->post("customer_mobile")."'"; 
            }if($customer_id !=""){
                $h = "customer_id LIKE '".$customer_id."'";
            }
            $params["whereCondition"] = $h;
            $vsp        =   $this->queryCustomer($params)->row_array();
            $this->db->update("customers",$dta,array("customer_id"   =>  $vsp['customer_id']));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
        }
        
        public function update_verification(){
                $params["whereCondition"] =   "customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR customer_email_id LIKE '".$this->input->post("customer_mobile")."'";
                $vsp    =   $this->queryCustomer($params)->row_array();
                if(isset($vsp)){
                    if($this->input->post("customer_mobile") ==$vsp['customer_mobile']){
                        $da = array('customer_verified_mobile'=>1,'customer_verified'=>1);
                    }elseif($this->input->post("customer_mobile") ==$vsp['customer_email_id']){
                        $da = array('customer_email_verified'=>1,'customer_verified'=>1);
                    }
                    return $this->db->where('customer_mobile',$vsp['customer_mobile'])->update('customers',$da);
                }
        }
        public function checkuser(){
                $params["whereCondition"] =   "customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR  customer_token LIKE '".$this->input->post("customer_mobile")."'"; 
                $vsp    =   $this->queryCustomer($params)->row_array();
                if(isset($vsp)){
                    if(count($vsp) > 0){
                        if($vsp['customer_verified'] == '1' || $vsp['customer_email_verified'] == '1' || $vsp['customer_verified_mobile'] == '1')
                            return 1;
                        return 2;
                    }
                }
                return 0;
        }
        public function checkmobilestatus(){
            $params["whereCondition"] =   "customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR  customer_token LIKE '".$this->input->post("customer_mobile")."' OR customer_id LIKE '".$this->input->post("customer_mobile")."'"; 
            $vsp        =   $this->queryCustomer($params)->row_array();
            if(isset($vsp)){
                if(count($vsp) > 0)
                if($vsp['customer_coupon']==''){
                    $token = $this->ajax_coupon();
                    $dta    =   array( 
                        "customer_coupon"         => $token
                    );
                    $this->db->update("customers",$dta,array("customer_id" => $vsp['customer_id']));
                }
                    return TRUE;
            }
            return FALSE; 
        }
        public function unique_registeremail(){
                $params["whereCondition"] =   "lower(customer_email_id) LIKE '".strtolower($this->input->post("email"))."'";
                $vsp    =   $this->queryCustomer($params)->row_array(); 
                if(is_array($vsp) && count($vsp) > 0){
                    return "false";
                }
                return "true";
        }
        public function loginemails(){
                $params["whereCondition"] =   "lower(customer_email_id) LIKE '".strtolower($this->input->post("email"))."' OR  lower(customer_mobile) LIKE '".strtolower($this->input->post("email"))."' and customer_password = '".$this->input->post("password")."'";
                $vsp    =   $this->queryCustomer($params)->row_array(); 
                $data   =   $this->vendor_model->jsonencodevalues("2","Invalid username and password");
                if(is_array($vsp) && count($vsp) > 0){
                    $reg_mobile_verified    =   $vsp["customer_email_verified"];
                    $reg_email_verified     =   $vsp["customer_verified_mobile"];
                    $rgcount                =   $vsp["customer_country"];
                    if($rgcount == sitedata("site_country")){
                        if($reg_mobile_verified == 0){
                            $data = $this->vendor_model->jsonencodevalues("3","Mobile No. has been not verified");
                        }
                    }else{
                        if($reg_email_verified == 0){
                            $data =  $this->vendor_model->jsonencodevalues("4","Email Id has been not verified");
                        }
                    }
                    if($reg_mobile_verified == 1 || $reg_email_verified == 1){
                        $vsp = $this->customer_model->loginemailsapi();
                        if($vsp){
                            $this->session->set_userdata("customer_id",$vsp["customer_id"]);
                            $data  =  $this->vendor_model->jsonencodevalues("1",$vsp);
                        }
                    }
            }
            return $data;
        }
        public function loginmobileapi(){
                $params["whereCondition"] =   "lower(customer_email_id) LIKE '".strtolower($this->input->post("email"))."' OR  lower(customer_mobile) LIKE '".strtolower($this->input->post("email"))."'";
                $vsp    =   $this->queryCustomer($params)->row_array(); 
                if(is_array($vsp) && count($vsp) > 0){
                    return $vsp;
                }
                return false;
        }
        public function loginemailsapi(){
                $params["whereCondition"] =   "lower(customer_email_id) LIKE '".strtolower($this->input->post("email"))."' OR  lower(customer_mobile) LIKE '".strtolower($this->input->post("email"))."' and customer_password = '".$this->input->post("password")."'";
                $vsp    =   $this->queryCustomer($params)->row_array(); 
                if(is_array($vsp) && count($vsp) > 0){
                    if($vsp['customer_coupon']==''){
                        $token = $this->ajax_coupon();
                        $dta    =   array( 
                            "customer_coupon"         => $token
                        );
                        $this->db->update("customers",$dta,array("customer_id" => $vsp['customer_id']));
                    }
                    return $vsp;
                }
                return false;
        }
        public function view_profile(){
                $imgpth    =   $this->config->item("upload_url")."customer-uploads/";
                $params["columns"] =   "customer_id,customer_mobile,customer_name,customer_email_id,(CONCAT('$imgpth',customer_profile)) as customer_profile";
                $params["whereCondition"] =   "customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR  customer_token LIKE '".$this->input->post("customer_mobile")."' OR  customer_id LIKE '".$this->input->post("customer_mobile")."'"; 
                $vsp    =   $this->queryCustomer($params)->row_array(); 
                return $vsp;
        }
        public function viewprofile($mobile){
                $imgpth    =   $this->config->item("upload_url")."customer-uploads/";
                $params["columns"] =   "customer_id,customer_mobile,customer_name,customer_email_id,(CONCAT('$imgpth',customer_profile)) as customer_profile";
                $params["whereCondition"] =   "customer_mobile LIKE '".$mobile."' OR customer_email_id LIKE '".$mobile."'";
                $vsp    =   $this->queryCustomer($params)->row_array();
                if(isset($vsp)){
                    return $vsp;
                }
                return array();
        }
       
        public function getCustomer($params = array()){
            return  $this->queryCustomer($params)->row_array();
        }
        public function queryCustomer($params = array()){
            $sel    =   "*";
                if(array_key_exists("columns", $params)){
                        $sel    =   $params["columns"];
                }
                if(array_key_exists("cnt", $params)){
                        $sel    =   "count(*) as cnt";
                }
                $dta    =   array(
                    "vd.customer_open"    =>  "1",
                    "vd.customer_status"  =>  "1"
                );
                $this->db->select("$sel")
                        ->from("customers as vd")  
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(customer_name LIKE '%".$params["keywords"]."%')");
                }
                if(array_key_exists("whereCondition", $params)){
                    $this->db->where("(".$params["whereCondition"].")");
                }
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }
                if(array_key_exists("tipoOrderby",$params) && array_key_exists("order_by",$params)){
                        $this->db->order_by($params['tipoOrderby'],$params['order_by']);
                }
                if(array_key_exists("group_by", $params)){
                    $this->db->group_by($params["group_by"]);
                }
//                $this->db->get();echo $this->db->last_query();exit;
                return $this->db->get();
        } 
        public function viewVendorproducts(){
                $target_dir =   $this->config->item("upload_url")."products/"; 
                $parms["columns"]           =   "vendorproduct_id,product_name,vendorproduct_description,vendorproduct_model,vendorproduct_brand,vendorproduct_shipping,vendorproduct_tax_class,vendorproduct_quantity,vendorproduct_bb_price as vendorproduct_price,vendorproduct_bb_mrp as vendorproduct_mrp,vendorproduct_measure,(CONCAT('$target_dir',vendorproductimg_name)) as vendorproductimg_name,vendorproduct_product,(CASE WHEN ws.wishlist_id IS NOT NULL THEN '1' ELSE '0' END) as wishlist_status";
                $parms["tipoOrderby"]       =   "vendorproductid";
                $parms["order_by"]          =   "DESC";  
                if($this->input->post("product") != ""){
                    $parms["whereCondition"]    =   "vp.vendorproduct_product LIKE '".$this->input->post("product")."'";  
                }
                if($this->input->post("category") != ""){
                    $parms["whereCondition"]    =   "vp.vendorproduct_category LIKE '".$this->input->post("category")."'";  
                }
                if($this->input->post("subcategory") != ""){
                    $parms["whereCondition"]    =   "vp.vendorproduct_subcategory LIKE '".$this->input->post("subcategory")."'";  
                }
                return $this->vendor_model->viewVendorproducts($parms);
        }
        public function customer_view_product(){
                $parms["columns"]           =   "vp.vendorproduct_id,sn.category_id,sn.category_name,sv.subcategory_id,sv.subcategory_name,pd.product_id,pd.product_name,vp.vendorproduct_description,vp.vendorproduct_descc,vp.vendorproduct_model,vp.vendorproduct_brand,vp.vendorproduct_shipping,vp.vendorproduct_tax_class,vp.photo_upload,vp.vendorproduct_quantity,vpp.vendorproduct_bb_price as vendorproduct_price,vpp.vendorproduct_bb_mrp as vendorproduct_mrp,vpp.vendorproduct_bb_quantity as quantity,pi.prod_indug as quantity_type,vpp.vendorproduct_bb_measure as vendorproduct_measure,vp.vendorproduct_product,measure_unit,vendorproduct_out_stock";  
                $parms["whereCondition"]    =   "vendorproduct_id LIKE '".$this->input->post("vendorproduct_id")."'";
                $products=  $this->vendor_model->getVendorproduct($parms);
                $dats=array();
                if(is_array($products) && count($products) >0){
                    $country     =   $this->input->post("country");
                    $dats['vendorproduct_id']           = $products['vendorproduct_id'];
                    $dats['category_id']                = $products['category_id'];
                    $dats['category_name']              = $products['category_name'];
                    $dats['subcategory_id']             = $products['subcategory_id'];
                    $dats['subcategory_name']           = $products['subcategory_name'];
                    $dats['product_id']                 = $products['product_id'];
                    $dats['product_name']               = $products['product_name'];
                    $dats['vendorproduct_description']  = $products['vendorproduct_description'];
                    $dats['vendorproduct_descc']        = $products['vendorproduct_descc'];
                    $dats['vendorproduct_model']        = $products['vendorproduct_model'];
                    $dats['vendorproduct_brand']        = $products['vendorproduct_brand'];
                    $dats['vendorproduct_shipping']     = $products['vendorproduct_shipping'];
                    $dats['vendorproduct_tax_class']    = $products['vendorproduct_tax_class'];
                    $dats['quantity']                   = isset($products['quantity'])?$products['quantity']:'';
                    $dats['quantity_type']              = isset($products['quantity_type'])?$products['quantity_type']:'';
                    $dats['vendorproduct_price']        = $this->customer_model->currency_change($country,$products['vendorproduct_price']);
                    $dats['vendorproduct_mrp']          = ($products['vendorproduct_mrp'])?$this->customer_model->currency_change($country,$products['vendorproduct_mrp']):'';
                    $dats['vendorproduct_measure']      = $products['vendorproduct_measure'];
                    $dats['vendorproduct_product']      = $products['vendorproduct_product'];
                    $dats['vendorproduct_out_stock']    = $products['vendorproduct_out_stock'];
                    $dats['measure_unit']               = $products['measure_unit'];
                    $dats['photo_upload']               = $products['photo_upload'];
                }
                return $dats;
        }
        public function customer_view_images(){
                $target_dir =   $this->config->item("upload_url")."products/";
                $parms["columns"]           =   "(CONCAT('$target_dir',vendorproductimg_name)) as vendorproductimg_name";  
                $parms["whereCondition"]    =   "vimp.vendorproduct_productid LIKE '".$this->input->post("vendorproduct_id")."'";  
                $res = $this->vendor_model->viewVendorproductimages($parms);
                return $res;
        }
        public function addaddress($customer_id=null){
            $dta    =   array(
                "customeraddress_id"          => "CADR".$this->common_model->get_max("customeraddressid","customer_address"), 
                "customeraddress_customer"    => ($customer_id !="")?$customer_id:$this->session->userdata("customer_id"),
                "customeraddress_fullname"    => $this->input->post("fullname"),
                "customeraddress_mobile"      => $this->input->post("mobile"),
                "customeraddress_district"    => $this->input->post("district"),
                //"customeraddress_state"     => $this->input->post("state"),
                "customeraddress_address"     => $this->input->post("address"),
                "customeraddress_pincode"     => $this->input->post("pincode"),
                "customeraddress_locality"    => $this->input->post("locality"),
                "customer_id"                 => ($customer_id !="")?$customer_id:$this->session->userdata("customer_id"),
                "customeraddress_created_on"  => date("Y-m-d H:i:s"),
                "customeraddress_created_by"  => ($customer_id !="")?$customer_id:$this->session->userdata("customer_id"),
            ); 
            $msgs    =   $this->input->post("locality").",".$this->input->post("address");
            $vps    =   $this->randomstring->getLatLong($msgs);
            if(count($vps) > 0){
                $dta["customeraddress_latitude"]     =   $vps["latitude"];
                $dta["customeraddress_longitude"]    =   $vps["longitude"];
            }
            $this->db->insert("customer_address",$dta);
            if($this->db->insert_id() > 0){ 
                return TRUE;
            }
            return FALSE;
        }
        public function update_address($customer_id=null){
            $dta    =   array(
                "customeraddress_fullname"    => $this->input->post("fullname"),
                "customeraddress_mobile"      => $this->input->post("mobile"),
                "customeraddress_district"    => $this->input->post("district"),
                //"customeraddress_state"     => $this->input->post("state"),
                "customeraddress_address"     => $this->input->post("address"),
                "customeraddress_pincode"     => $this->input->post("pincode"),
                "customeraddress_locality"    => $this->input->post("locality"),
                "customeraddress_modified_on"  => date("Y-m-d H:i:s"),
                "customeraddress_modified_by"  => ($customer_id !="")?$customer_id:$this->session->userdata("customer_id"),
            ); 
            $msgs    =   $this->input->post("locality").",".$this->input->post("address");
            $vps    =   $this->randomstring->getLatLong($msgs);
            if(count($vps) > 0){
                $dta["customeraddress_latitude"]     =   $vps["latitude"];
                $dta["customeraddress_longitude"]    =   $vps["longitude"];
            }
            $this->db->update("customer_address",$dta,array("customeraddress_id" => $customer_id));
            if($this->db->affected_rows() > 0){ 
                return TRUE;
            }
            return FALSE;
        }
        public function add_address(){
            $view   =   $this->view_profile(); 
            $customer_id     =   $view["customer_id"];
            $vso    =   $this->addaddress($customer_id);
            return $vso;
        }
        public function delete_address($customeraddress_id){
            $view   =   $this->view_profile(); 
            $customer_id     =   $view["customer_id"];
            $dta    =   array( 
                "customeraddress_open"         => "0",
                "customeraddress_modified_on"  => date("Y-m-d H:i:s"),
                "customeraddress_modified_by"  => $this->session->userdata("login_id")?$this->session->userdata("login_id"):$customer_id
            );
            $this->db->update("customer_address",$dta,array("customeraddress_id" => $customeraddress_id));
            if($this->db->affected_rows() > 0){ 
                return TRUE;
            }
            return FALSE;
        }
        public function customeraddress(){ 
                //$params["columns"] =    "customeraddress_id,customeraddress_state,customeraddress_district,customeraddress_address,customeraddress_pincode,customeraddress_locality,customeraddress_latitude,customeraddress_longitude";
                $params["whereCondition"] =   "customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR customer_token LIKE '".$this->input->post("customer_mobile")."'"; 
                $user = $this->view_profile();
                if(is_array($user) && count($user) >0){
                    $par["whereCondition"] = "customeraddress_customer LIKE '".$user['customer_id']."'";
                    return $this->viewCustomeraddress($params);
                }
        }
        public function customeraddressview(){ 
                //$params["columns"] =    "customeraddress_id,customeraddress_state,state_name,customeraddress_address,customeraddress_pincode,customeraddress_locality,customeraddress_latitude,customeraddress_longitude";
                $params["whereCondition"] =   "customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR customer_token LIKE '".$this->input->post("customer_mobile")."'"; 
                return $this->viewCustomeraddress($params);
        }
        public function getCustomeraddress($params = array()){ 
                return  $this->queryCustomeraddress($params)->row_array();
        }
        public function viewCustomeraddress($params = array()){ 
                return $this->queryCustomeraddress($params)->result();
        }
        public function cntviewcustomeraddresss($params  =    array()){
                $params["cnt"]      =   "1"; 
                $val    =   $this->queryCustomeraddress($params)->row_array();
                if(isset($val)){
                    if(count($val) > 0){
                        return  $val['cnt'];
                    }
                }
                return "0";
        }
        public function queryCustomeraddress($params = array()){
            $sel    =   "*";
                if(array_key_exists("columns", $params)){
                        $sel    =   $params["columns"];
                }
                if(array_key_exists("cnt", $params)){
                        $sel    =   "count(*) as cnt";
                }
                $dta    =   array(
                    "vsd.customeraddress_open"    =>  "1",
                    //"vd.customer_open"    =>  "1",
                   // "vd.customer_status"  =>  "1",
                    //"st.state_status"   =>  '1'
                );
                $this->db->select("$sel")
                        ->from("customer_address as vsd")
                        //->join("state as st","vsd.customeraddress_state = st.state_id","INNER") 
                        ->join("customers as vd","vsd.customeraddress_customer = vd.customer_id","INNER")  
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(customeraddress_address LIKE '%".$params["keywords"]."%' OR state_name LIKE '%".$params["keywords"]."%' OR customeraddress_locality LIKE '%".$params["keywords"]."%' OR customeraddress_pincode LIKE '%".$params["keywords"]."%')");
                }
                if(array_key_exists("whereCondition", $params)){
                    $this->db->where("(".$params["whereCondition"].")");
                }
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }
                if(array_key_exists("tipoOrderby",$params) && array_key_exists("order_by",$params)){
                        $this->db->order_by($params['tipoOrderby'],$params['order_by']);
                }
                if(array_key_exists("group_by", $params)){
                    $this->db->group_by($params["group_by"]);
                }
                //$this->db->get();echo $this->db->last_query();exit;
                return $this->db->get();
        } 
        public function addtocart(){
            $vendorid       =   $this->input->post("vendorproduct_id");
            $delivery_id    =   $this->input->post('delivery_id');
            //$quantity     =   $this->input->post("quantity");
            $view           =   $this->view_profile();
            $customer_id    =   $view["customer_id"];
            $prms["whereCondition"]   =   "vendorproduct_id LIKE '".$vendorid."'";
            $dta    =   $this->vendor_model->getVendorproduct($prms);
            $del_amount='';
            if(!empty($delivery_id)){
                $del = $this->deliverycharges_model->getdeliverychg($delivery_id);
                if(is_array($del) && count($del) >0){
                    $del_amount =$del['deliverychg_amount'];
                }
            }
            if(isset($dta)){
                if(count($dta)  > 0){
                    if(count($_FILES) > 0){
                        $target_dir =   $this->config->item("uploads_path")."customer-uploads/";
                        $fname      =   $_FILES["photo_on_cake"]["name"];
                        if($fname != "" && $fname != "noname"){
                            $vsp        =   explode(".",$fname);
                            $fname      =   $this->input->post("customer_mobile").".".$vsp['1'];
                            $uploadfile =   $target_dir . basename($fname);
                            $vsp 	=	move_uploaded_file($_FILES['photo_on_cake']['tmp_name'], $uploadfile); 
                            if($vsp){
                                $dtas['photo_on_cake'] =   $fname;
                            }
                        }
                    }
                    $cart_iii= "CART".$this->common_model->get_max("cartid","cart_details");
                    $dtas    =   array(
                        "cart_id"               =>  $cart_iii, 
                        "cart_customer_id"      =>  $customer_id,
                        "cart_vendor_productid" =>  $dta['vendorproduct_id'],
                        "cart_quantity"         =>  $this->input->post('quantity'),
                        "cart_price"            =>  $dta['vendorproduct_bb_price'],
                        "cart_derliverytype"    =>  $del_amount, 
                        "cart_size"             =>  $this->input->post('size'),
                        "cart_indug"            =>  $this->input->post('indug'),
                        "cart_date"             =>  $this->input->post('date'), 
                        "cart_message_on_cake"  =>  ($this->input->post('message_on_cake') !="")?$this->input->post('message_on_cake'):'', 
                        "cart_delivery_id"      =>  $this->input->post('delivery_id'), 
                        "cart_country"          =>  $this->input->post('country'), 
                        "cart_created_on"       =>  date("Y-m-d H:i:s"),
                        "cart_created_by"       =>  $this->session->userdata("login_id")?$this->session->userdata("login_id"):$customer_id
                    );
                    $ins    =   $this->order_model->addtocart($dtas);
                    if($ins){
                        
                        $addon              =   json_decode($this->input->post('addon'));
                        if(!empty($addon)){
                            foreach($addon as $a){
                                $a = (array) $a;
                                $dtar   =   $this->customer_model->addontocart($a['quantity'],$a['vendorproduct_id'],$cart_iii);
                            }
                        }
                        return 1;
                    }
                }
                return 2;
            }
            return 0;
        } 
        public function addontocart($qty,$id,$cartt){
            $vendorid       =   $this->input->post("vendorproduct_id");
            $id     =   explode('_',$id);
            $view           =   $this->view_profile();
            $customer_id    =   $view["customer_id"];
            $prms["whereCondition"]   =   "vendorproduct_id LIKE '".$id[0]."' AND vendorproductprinceid LIKE '".$id[1]."'";
            $dta    =   $this->vendor_model->getVendorproduct($prms);
            $codd = $vendorid.','.$cartt;
            if(isset($dta)){
                if(count($dta)  > 0){
                    $dtas    =   array(
                        "cart_id"               =>  "CART".$this->common_model->get_max("cartid","cart_details"), 
                        "cart_customer_id"      =>  $customer_id,
                        "cart_vendor_productid" =>  $id[0],
                        "cart_quantity"         =>  $qty,
                        "cart_size"             =>  ($dta['vendorproduct_bb_quantity'])??'',
                        "cart_indug"            =>  ($dta['prod_indug'])??'',
                        "cart_price"            =>  $dta['vendorproduct_bb_price'],
                        "cart_addon"            =>  base64_encode($codd), 
                        "cart_country"          =>  $this->input->post('country'), 
                        "cart_created_on"       =>  date("Y-m-d H:i:s"),
                        "cart_created_by"       =>  $this->session->userdata("login_id")?$this->session->userdata("login_id"):$customer_id
                    );
                    $ins    =   $this->order_model->addtocart($dtas);
                    if($ins){
                        //return 1;
                    }
                }
                return 2;
            }
            return 0;
        } 
        public function update_cart(){ 
            $cart_id        =   $this->input->post("cart_id");
            $quantity       =   $this->input->post("quantity");
            $view           =   $this->view_profile(); 
            $customer_id    =   $view["customer_id"]; 
            $prms["whereCondition"]   =   "cart_acde = '0' AND cart_id LIKE '".$cart_id."'";
            $dta    =   $this->order_model->getcartproduct($prms);
            if(isset($dta)){
                if(count($dta)  > 0){ 
                    $price  =   $dta["vendorproduct_price"];
                    $ins    =   $this->order_model->updatetocart($customer_id,$cart_id,$quantity,$price);
                    if($ins){
                        return 1;
                    }
                }
                return 2;
            }
            return 0;
        } 
        public function view_cart(){
            $prms =array();
            $country = $this->input->post("country");
            $target_dir =   $this->config->item("upload_url")."products/";  
            $this->remove_outstock_cart();
            $prms["columns"]   =   "cart_id,cart_quantity,cart_price,cart_derliverytype,cart_size,cart_indug,cart_delivery_id,cart_date,vendorproduct_id,product_name,category_id,category_name,subcategory_id,subcategory_name,vendorproduct_id,
                                    vendor_name,vendor_storename,vendorproduct_description,vendorproduct_descc,vendorproduct_brand,vendorproduct_shipping,vendorproduct_model,
                                    (CONCAT('$target_dir',vendorproductimg_name)) as vendorproductimg_name";
            $l = "ct.cart_acde = '0'";
            $l.="AND (customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR customer_token LIKE '".$this->input->post("customer_mobile")."') AND ct.cart_addon ='' ";
            $prms["whereCondition"]   = $l;
            $dta    =   $this->order_model->viewcartproducts($prms);
            //print_r($dta);exit;
            $ds = array();
            if(is_array($dta) && count($dta) >0){
                $i=0;foreach($dta as $d){
                    $deli = $this->deliverycharges_model->getdeliverychg($d->cart_delivery_id);
                    $ds[$i]['cart_id']                   = $d->cart_id;    
                    $ds[$i]['cart_quantity']             = $d->cart_quantity;
                    $ds[$i]['cart_price']                = $this->currency_change($country,$d->cart_price);
                    $ds[$i]['deliverychages']            = $this->currency_change($country,$d->cart_derliverytype);
                    $ds[$i]['vendorproduct_id']          = $d->vendorproduct_id;
                    $ds[$i]['product_name']              = $d->product_name;
                    $ds[$i]['category_id']               = $d->category_id;
                    $ds[$i]['category_name']             = $d->category_name;
                    $ds[$i]['subcategory_id']            = ($d->subcategory_id!="")?$d->subcategory_id:'';
                    $ds[$i]['subcategory_name']          = ($d->subcategory_name !="")?$d->subcategory_name:'';
                    $ds[$i]['vendor_name']               = $d->vendor_name;
                    $ds[$i]['vendor_storename']          = $d->vendor_storename;
                    $ds[$i]['vendorproduct_description'] = $d->vendorproduct_description;
                    $ds[$i]['vendorproduct_descc']       = $d->vendorproduct_descc;
                    $ds[$i]['vendorproduct_brand']       = $d->vendorproduct_brand;
                    $ds[$i]['vendorproduct_shipping']    = $d->vendorproduct_shipping;
                    $ds[$i]['vendorproduct_model']       = $d->vendorproduct_model;
                    $ds[$i]['vendorproductimg_name']     = $d->vendorproductimg_name;
                    $ds[$i]['delivery_date']             = date('d-m-Y',strtotime($d->cart_date));
                    $ds[$i]['delivery_type']             = $deli['derliverytype'];
                    $ds[$i]['delivery_type']             = $deli['derliverytype'];
                    $ds[$i]['delivery_indug']            = ($d->cart_indug != "")?$d->cart_indug:'';
                    $ds[$i]['delivery_timings']          = date('H:i',strtotime($deli['deliverychg_start'])).'-'.date('H:i',strtotime($deli['deliverychg_end']));
                    $ds[$i]['addons']                    = $this->view_cart_addon(base64_encode($d->vendorproduct_id.','.$d->cart_id));
                $i++;}
            }
            return $ds;
        }
        public function view_cart_addon($id){
            $prms =array();
            $country = $this->input->post("country");
            $target_dir =   $this->config->item("upload_url")."products/";  
            $prms["columns"]   =   "cart_id,cart_quantity,cart_price,cart_derliverytype,cart_size,cart_indug,cart_delivery_id,cart_date,vendorproduct_id,product_name,category_id,category_name,subcategory_id,subcategory_name,vendorproduct_id,
                                    vendor_name,vendor_storename,vendorproduct_description,vendorproduct_descc,vendorproduct_brand,vendorproduct_shipping,vendorproduct_model,
                                    (CONCAT('$target_dir',vendorproductimg_name)) as vendorproductimg_name";
            $l = "ct.cart_acde = '0'";
            $l.="AND (customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR customer_token LIKE '".$this->input->post("customer_mobile")."') AND ct.cart_addon ='".$id."'";
            $prms["whereCondition"]   = $l;
            $dta    =   $this->order_model->viewcartproducts($prms);
            //print_r($dta);exit;
            $ds = array();
            if(is_array($dta) && count($dta) >0){
                $i=0;foreach($dta as $d){
                    $deli = $this->deliverycharges_model->getdeliverychg($d->cart_delivery_id);
                    $ds[$i]['cart_id']                   = $d->cart_id;    
                    $ds[$i]['cart_quantity']             = $d->cart_quantity;
                    $ds[$i]['cart_price']                = $this->currency_change($country,$d->cart_price);
                    $ds[$i]['vendorproduct_id']          = $d->vendorproduct_id;
                    $ds[$i]['product_name']              = $d->product_name.'-'.$d->cart_indug.'-'.$d->cart_size;
                    $ds[$i]['category_id']               = $d->category_id;
                    $ds[$i]['category_name']             = $d->category_name;
                    $ds[$i]['subcategory_id']            = ($d->subcategory_id!="")?$d->subcategory_id:'';
                    $ds[$i]['subcategory_name']          = ($d->subcategory_name !="")?$d->subcategory_name:'';
                    $ds[$i]['vendor_name']               = $d->vendor_name;
                    $ds[$i]['vendor_storename']          = $d->vendor_storename;
                    $ds[$i]['vendorproduct_description'] = $d->vendorproduct_description;
                    $ds[$i]['vendorproduct_descc']       = $d->vendorproduct_descc;
                    $ds[$i]['vendorproduct_brand']       = $d->vendorproduct_brand;
                    $ds[$i]['vendorproduct_shipping']    = $d->vendorproduct_shipping;
                    $ds[$i]['vendorproduct_model']       = $d->vendorproduct_model;
                    $ds[$i]['vendorproductimg_name']     = $d->vendorproductimg_name;
                    $ds[$i]['delivery_date']             = date('d-m-Y',strtotime($d->cart_date));
                    $ds[$i]['delivery_timings']          = date('H:i',strtotime($deli['deliverychg_start'])).'-'.date('H:i',strtotime($deli['deliverychg_end']));
                $i++;}
            }
            return $ds;
        }
        public function remove_outstock_cart(){
            $l = "ct.cart_acde = '0'";
            $l.="AND (customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR customer_token LIKE '".$this->input->post("customer_mobile")."') AND vp.vendorproduct_out_stock ='1'";
            $prms["whereCondition"]   = $l;
            $dta    =   $this->order_model->viewcartproducts($prms);
            if(is_array($dta) && count($dta) >0){
                foreach($dta as $d){
                    $ins    =   $this->order_model->deletefromcart($d->cart_id,$d->cart_customer_id);
                    $in    =   $this->order_model->deletefromcartaddon($d->cart_customer_id,$d->cart_vendor_productid,$d->cart_id);
                }
            }
            
        }
        public function view_totalcart(){
            $country = $this->input->post("country");
            //$prms["columns"]   =   "count(*) as cart_quantity,(CASE WHEN SUM(cart_price*cart_quantity) IS NOT NULL THEN SUM(cart_price*cart_quantity) ELSE '0' END) as cart_total";
            $prms["whereCondition"]   =   "cart_acde = '0' AND customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR customer_token LIKE '".$this->input->post("customer_mobile")."'";
            $dta    =   $this->order_model->viewcartproducts($prms); 
            $dats['amount'] ="0";
            $ds = array();
            if(is_array($dta) && count($dta) >0){
                foreach($dta as $d){
                    $dats['amount'] += ($d->cart_quantity*$d->cart_price)+$d->cart_derliverytype;
                }
            }
            foreach($dats as $pr){
                $ds[0]['cart_quantity']    = count($dta);
                $ds[0]['cart_total']       = $this->currency_change($country,$dats['amount']);
            }
            return $ds;
        }
        public function view_cart_total(){
            $country = $this->input->post("country");
            //$prms["columns"]   =   "count(*) as cart_quantity,(CASE WHEN SUM(cart_price*cart_quantity) IS NOT NULL THEN SUM(cart_price*cart_quantity) ELSE '0' END) as cart_total";
            $prms["whereCondition"]   =   "cart_acde = '0' AND customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR customer_token LIKE '".$this->input->post("customer_mobile")."'";
            $dta    =   $this->order_model->viewcartproducts($prms); 
            $dats['amount'] ="0";
            $ds = array();
            if(is_array($dta) && count($dta) >0){
                foreach($dta as $d){
                    $dats['amount'] += ($d->cart_quantity*$d->cart_price);
                }
            }
            foreach($dats as $pr){
                $ds[0]['cart_total']       = $dats['amount'];
            }
            return $ds[0]['cart_total'];
        }
        public function view_cart_total_coupon(){
            $country = $this->input->post("country");
            //-----------------------coupon code ----------------------------//
            $coupon_old =   ($this->input->post('coupon_code'))??'';
            $mobile     =   ($this->input->post('customer_mobile'))??'';
            $total     =    ($this->view_cart_total())??'';
            $r  =   (array)json_decode($this->coupon_model->Coupon_check($coupon_old,$mobile,$total));
            if($r['status']=="4"){
                $coupon_data = (array)$r['status_messsage'];
            }else{
                $coupon_data='';
            }
            $coupon = ($coupon_data['coupon'])??'';           
            //-----------------------coupon code ----------------------------//
            //$prms["columns"]   =   "count(*) as cart_quantity,(CASE WHEN SUM(cart_price*cart_quantity) IS NOT NULL THEN SUM(cart_price*cart_quantity) ELSE '0' END) as cart_total";
            $prms["whereCondition"]   =   "cart_acde = '0' AND customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR customer_token LIKE '".$this->input->post("customer_mobile")."'";
            $dta    =   $this->order_model->viewcartproducts($prms); 
            $dats['amount'] ="0";
            $ds = array();
            if(is_array($dta) && count($dta) >0){
                foreach($dta as $d){
                    //-----------------------coupon code ----------------------------//
                    if(!empty($coupon_data)){
                        if(in_array($d->cart_vendor_productid,$coupon_data['products_applicable']) || $coupon_data['coupon_applicable'] == 'All') {
                            if($coupon_data['coupon_type']=='Percentage'){
                                $discount   =  (($d->cart_price)/100)*$coupon_data['coupon_discount'];
                            }else if($coupon_data['coupon_type']=='Amount'){
                                $discount   =   $coupon_data['coupon_discount'];
                            }else{
                                $discount   =   0;
                            }
                        }else{
                            $discount   =   0;
                        }
                    }else{
                        $discount   =   0;
                    }
                    //-----------------------coupon code ----------------------------//
                    
                    $dats['amount'] += ($d->cart_quantity*($d->cart_price-$discount))+($d->cart_derliverytype);
                }
            }
            foreach($dats as $pr){
                $ds[0]['cart_quantity']    = count($dta);
                $ds[0]['cart_total']       = $this->currency_change($country,$dats['amount']);
            }
            return $ds;
        }
        public function deletecart(){
            $cart_id          =   $this->input->post("cart_id"); 
            $prms["whereCondition"]   =   "cart_id LIKE '".$cart_id."'";
            $dta    =   $this->order_model->getcartproduct($prms);
            if(isset($dta)){
                if(count($dta) > 0){
                    $ins    =   $this->order_model->deletefromcart($cart_id,$dta['cart_customer_id']);
                    $in    =   $this->order_model->deletefromcartaddon($dta['cart_customer_id'],$dta['cart_vendor_productid'],$cart_id);
                    if($ins){
                        return 1;
                    }
                }
                return 2;
            }
            return 0;
        }
        public function checkout(){
            $view           =   $this->view_profile(); 
            $customer_id    =   $view["customer_id"];
            $msh    =   $this->order_model->checkout($customer_id);
            return $msh;
        }
        public function orders(){
            $prms["whereCondition"] =   "customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR customer_token LIKE '".$this->input->post("customer_mobile")."'";
            $prms['tipoOrderby']    =   "orderid";
            $prms['order_by']       =   "DESC";
            $dta    =   $this->order_model->vieworders($prms);
            $country = $this->input->post('country');
            $data =array();
            if(is_array($dta) && count($dta) >0){
                $i=0;
                foreach($dta as $d){
                    $data[$i]['order_id']           = $d->order_id;
                    $data[$i]['order_unique']       = $d->order_unique;
                    $data[$i]['order_customer_id']  = $d->order_customer_id;
                    $data[$i]['order_latitude']     = $d->order_latitude;
                    $data[$i]['order_longitude']    = $d->order_longitude;
                    $data[$i]['order_sub_total']    = $this->customer_model->currency_change($country,$d->order_sub_total);
                    $data[$i]['order_total']        = $this->customer_model->currency_change($country,$d->order_total);
                    $data[$i]['order_time']         = $d->order_time;
                    $data[$i]['order_date']         = $d->order_date;
                    $data[$i]['order_acde']         = $d->order_acde;
                    $data[$i]['order_payment_mode'] = $d->order_payment_mode;
                    $i++;
                }
            }
            return $data;
        }
        public function order_details(){
            $params["whereCondition"] = "customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR customer_token LIKE '".$this->input->post("customer_mobile")."'";
            $vsp        =   $this->queryCustomer($params)->row_array();
            $prms["whereCondition"]     =   "ct.order_unique LIKE '".$this->input->post("order_unique")."' 
                                            AND cp.customer_mobile LIKE '".$vsp['customer_mobile']."' AND orderdetail_addon =''";
            $dta    =   $this->order_model->vieworderdetails($prms); 
            $country = $this->input->post('country');
            $ds = array();$ds['order_address']=array();$ds['order_details']=array();
            if(is_array($dta) && count($dta) > 0){
                $i=0;
                foreach($dta as $d){
                    $ds['order_address']["customeraddress_fullname"]    = $d->customeraddress_fullname;
                    $ds['order_address']["customeraddress_mobile"]      = $d->customeraddress_mobile;
                    $ds['order_address']["customeraddress_locality"]    = $d->customeraddress_locality;
                    $ds['order_address']["customeraddress_district"]    = $d->customeraddress_district;
                    $ds['order_address']["customeraddress_address"]     = $d->customeraddress_address;
                    $ds['order_address']["customeraddress_pincode"]     = $d->customeraddress_pincode;
                    
                    $order_del_details  =   (array)json_decode($d->orderdetail_speciations);
                    $delivery   =   $this->deliverycharges_model->getdeliverychg($order_del_details['cart_delivery_id']);
                    
                     /*--------------------rating -------------------*/
                    $pas['whereCondition']    ="prodcu_id = '".$d->vendorproduct_id."' AND order_id = '".$d->order_id."'";
					$pas['columns'] = "rating,message";
					$review =  $this->customer_model->getReview($pas);
                    
                    $ds['order_details'][$i]["order_del_date"]= $order_del_details['cart_date'];
                    $ds['order_details'][$i]["order_del_time"]= 'between '.date("g:i a", strtotime($delivery['deliverychg_start'])).' to '.date("g:i a", strtotime($delivery['deliverychg_end']));
                    $ds['order_details'][$i]["orderdetailid"]= $d->orderdetailid;
                    $ds['order_details'][$i]["orderdetail_id"]= $d->orderdetail_id;
                    $ds['order_details'][$i]["order_unique"]= $d->order_unique;
                    $ds['order_details'][$i]["orderdetail_orderid"]= $d->orderdetail_orderid;
                    $ds['order_details'][$i]["orderdetail_customer_id"]= $d->orderdetail_customer_id;
                    $ds['order_details'][$i]["orderdetail_vendor_id"]= $d->orderdetail_vendor_id;
                    $ds['order_details'][$i]["orderdetail_vendorproduct_id"]= $d->orderdetail_vendorproduct_id;
                    $ds['order_details'][$i]["orderdetail_quantity"]= $d->orderdetail_quantity;
                    $ds['order_details'][$i]["orderdetail_price"]= $this->customer_model->currency_change($country,$d->orderdetail_price);
                    $ds['order_details'][$i]["orderdetail_delivery_chage"]= $this->customer_model->currency_change($country,$d->orderdetail_delivery_chage);
                    $ds['order_details'][$i]["orderdetail_acde"]= $d->orderdetail_acde;
                    $ds['order_details'][$i]["orderdetail_open"]= $d->orderdetail_open;
                    $ds['order_details'][$i]["orderdetail_status"]= $d->orderdetail_status;
                    $ds['order_details'][$i]["orderid"]= $d->orderid;
                    $ds['order_details'][$i]["order_id"]= $d->order_id;
                    $ds['order_details'][$i]["order_unique"]= $d->order_unique;
                    $ds['order_details'][$i]["order_customer_id"]= $d->order_customer_id;
                    $ds['order_details'][$i]["order_latitude"]= $d->order_latitude;
                    $ds['order_details'][$i]["order_longitude"]= $d->order_longitude;
                    $ds['order_details'][$i]["order_address_id"]= $d->order_address_id;
                    $ds['order_details'][$i]["order_sub_total"]= $d->order_sub_total;
                    $ds['order_details'][$i]["order_total"]= $d->order_total;
                    $ds['order_details'][$i]["order_time"]= $d->order_time;
                    $ds['order_details'][$i]["order_date"]= $d->order_date;
                    $ds['order_details'][$i]["order_acde"]= $d->order_acde;
                    $ds['order_details'][$i]["order_payment_mode"]= $d->order_payment_mode;
                    $ds['order_details'][$i]["order_razor_payment_id"]= $d->order_razor_payment_id;
                    $ds['order_details'][$i]["order_razor_order_id"]= $d->order_razor_order_id;
                    $ds['order_details'][$i]["customerid"]= $d->customerid;
                    $ds['order_details'][$i]["customer_id"]= $d->customer_id;
                    $ds['order_details'][$i]["customer_mobile"]= $d->customer_mobile;
                    $ds['order_details'][$i]["customer_name"]= $d->customer_name;
                    $ds['order_details'][$i]["customer_email_id"]= $d->customer_email_id;
                    $ds['order_details'][$i]["customer_gender"]= $d->customer_gender;
                    $ds['order_details'][$i]["customer_profile"]= $d->customer_profile;
                    $ds['order_details'][$i]["customer_whtmobile"]= $d->customer_whtmobile;
                    $ds['order_details'][$i]["customer_token"]= $d->customer_token;
                    $ds['order_details'][$i]["vendorproductid"]= $d->vendorproductid;
                    $ds['order_details'][$i]["vendorproduct_id"]= $d->vendorproduct_id;
                    $ds['order_details'][$i]["vendorproduct_code"]= $d->vendorproduct_code;
                    $ds['order_details'][$i]["vendorproduct_vendor_id"]= $d->vendorproduct_vendor_id;
                    $ds['order_details'][$i]["vendorproduct_product"]= $d->vendorproduct_product;
                    $ds['order_details'][$i]["vendorproduct_description"]= $d->vendorproduct_description;
                    $ds['order_details'][$i]["vendorproduct_descc"]= $d->vendorproduct_descc;
                    $ds['order_details'][$i]["vendorproduct_model"]= $d->vendorproduct_model;
                    $ds['order_details'][$i]["vendorproduct_brand"]= $d->vendorproduct_brand;
                    $ds['order_details'][$i]["vendorproduct_shipping"]= $d->vendorproduct_shipping;
                    $ds['order_details'][$i]["vendorproduct_tax_class"]= $d->vendorproduct_tax_class;
                    $ds['order_details'][$i]["vendorproduct_category"]= $d->vendorproduct_category;
                    $ds['order_details'][$i]["vendorproduct_subcategory"]= $d->vendorproduct_subcategory;
                    $ds['order_details'][$i]["vendorproduct_quantity"]= $d->vendorproduct_quantity;
                    $ds['order_details'][$i]["vendorproduct_price"]= $d->vendorproduct_price;
                    $ds['order_details'][$i]["photo_upload"]= $d->photo_upload;
                    $ds['order_details'][$i]["vendorproduct_mrp"]= $d->vendorproduct_mrp;
                    $ds['order_details'][$i]["vendorproduct_measure"]= $d->vendorproduct_measure;
                    $ds['order_details'][$i]["vendorproduct_bbtype"]= $d->vendorproduct_bbtype;
                    $ds['order_details'][$i]["productid"]= $d->productid;
                    $ds['order_details'][$i]["product_id"]= $d->product_id;
                    $ds['order_details'][$i]["product_name"]= $d->product_name;
                    $ds['order_details'][$i]["product_url"]= $d->product_url;
                    $ds['order_details'][$i]["product_keywords"]= $d->product_keywords;
                    $ds['order_details'][$i]["categoryid"]= $d->categoryid;
                    $ds['order_details'][$i]["category_id"]= $d->category_id;
                    $ds['order_details'][$i]["category_name"]= $d->category_name;
                    $ds['order_details'][$i]["category_keywords"]= $d->category_keywords;
                    $ds['order_details'][$i]["subcategory_id"]= $d->subcategory_id;
                    $ds['order_details'][$i]["subcategory_category"]= $d->subcategory_category;
                    $ds['order_details'][$i]["subcategory_name"]= $d->subcategory_name;
                    $ds['order_details'][$i]["subcategory_keywords"]= $d->subcategory_keywords;
                    $ds['order_details'][$i]["vendorid"]= $d->vendorid;
                    $ds['order_details'][$i]["vendor_id"]= $d->vendor_id;
                    $ds['order_details'][$i]["vendor_name"]= $d->vendor_name;
                    $ds['order_details'][$i]["vendor_mobile"]= $d->vendor_mobile;
                    $ds['order_details'][$i]["vendor_dob"]= $d->vendor_dob;
                    $ds['order_details'][$i]["vendor_gender"]= $d->vendor_gender;
                    $ds['order_details'][$i]["vendor_email_id"]= $d->vendor_email_id;
                    $ds['order_details'][$i]["vendor_country"]= $d->vendor_country;
                    $ds['order_details'][$i]["vendor_state"]= $d->vendor_state;
                    $ds['order_details'][$i]["vendor_district"]= $d->vendor_district;
                    $ds['order_details'][$i]["vendor_mandal"]=$d->vendor_mandal;
                    $ds['order_details'][$i]["vendor_gramapanchayat"]= $d->vendor_gramapanchayat;
                    $ds['order_details'][$i]["vendor_address"]= $d->vendor_address;
                    $ds['order_details'][$i]["vendor_pincode"]= $d->vendor_pincode;
                    $ds['order_details'][$i]["vendor_storename"]= $d->vendor_storename;
                    $ds['order_details'][$i]["vendor_storename_keywords"]= $d->vendor_storename_keywords;
                    $ds['order_details'][$i]["vendor_latitude"]= $d->vendor_latitude;
                    $ds['order_details'][$i]["vendor_longitude"]= $d->vendor_longitude;
                    $ds['order_details'][$i]["vendor_verified"]= $d->vendor_verified;
                    $ds['order_details'][$i]["vendor_license"]= $d->vendor_license;
                    $ds['order_details'][$i]["vendor_license_name"]= $d->vendor_license_no;
                    $ds['order_details'][$i]["vendor_license_no"]= "";
                    $ds['order_details'][$i]["vendor_license_document"]= $d->vendor_license_document;
                    $ds['order_details'][$i]["vendor_date"]= $d->vendor_date;
                    $ds['order_details'][$i]["vendor_profile"]= $d->vendor_profile;
                    $ds['order_details'][$i]["vendorproductimgid"]= $d->vendorproductimgid;
                    $ds['order_details'][$i]["vendorproductimg_id"]= $d->vendorproductimg_id;
                    $ds['order_details'][$i]["vendorproduct_productid"]= $d->vendorproduct_productid;
                    $ds['order_details'][$i]["vendorproductimg_name"]= base_url().'uploads/products/'.$d->vendorproductimg_name;
                    $ds['order_details'][$i]["addons"]= $this->order_details_addon($d->orderdetail_addon_ref,$d->orderdetail_orderid);
                    $ds['order_details'][$i]["review"]= ($review)??'';
                $i++;}
            }
            return $ds;
        }
        public function order_details_addon($addon_ref,$ord_idd){
            $params["whereCondition"] = "customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR customer_token LIKE '".$this->input->post("customer_mobile")."'";
            $vsp        =   $this->queryCustomer($params)->row_array();
            $prms["whereCondition"]     =   "ct.order_unique LIKE '".$this->input->post("order_unique")."' 
                                            AND cp.customer_mobile LIKE '".$vsp['customer_mobile']."'  AND orderdetail_orderid ='".$ord_idd."' AND orderdetail_addon ='$addon_ref'";
            $dta    =   $this->order_model->vieworderdetails($prms); 
            $country = $this->input->post('country');
            $ds = array();
            if(is_array($dta) && count($dta) > 0){
                $i=0;
                foreach($dta as $d){
                    $ds[$i]["orderdetailid"]= $d->orderdetailid;
                    $ds[$i]["orderdetail_id"]= $d->orderdetail_id;
                    $ds[$i]["order_unique"]= $d->order_unique;
                    $ds[$i]["orderdetail_orderid"]= $d->orderdetail_orderid;
                    $ds[$i]["orderdetail_customer_id"]= $d->orderdetail_customer_id;
                    $ds[$i]["orderdetail_vendor_id"]= $d->orderdetail_vendor_id;
                    $ds[$i]["orderdetail_vendorproduct_id"]= $d->orderdetail_vendorproduct_id;
                    $ds[$i]["orderdetail_quantity"]= $d->orderdetail_quantity;
                    $ds[$i]["orderdetail_price"]= $this->customer_model->currency_change($country,$d->orderdetail_price);
                    $ds[$i]["orderdetail_delivery_chage"]= $this->customer_model->currency_change($country,$d->orderdetail_delivery_chage);
                    $ds[$i]["orderdetail_acde"]= $d->orderdetail_acde;
                    $ds[$i]["orderdetail_open"]= $d->orderdetail_open;
                    $ds[$i]["orderdetail_status"]= $d->orderdetail_status;
                    $ds[$i]["orderid"]= $d->orderid;
                    $ds[$i]["order_id"]= $d->order_id;
                    $ds[$i]["order_unique"]= $d->order_unique;
                    $ds[$i]["order_customer_id"]= $d->order_customer_id;
                    $ds[$i]["order_latitude"]= $d->order_latitude;
                    $ds[$i]["order_longitude"]= $d->order_longitude;
                    $ds[$i]["order_address_id"]= $d->order_address_id;
                    $ds[$i]["order_sub_total"]= $d->order_sub_total;
                    $ds[$i]["order_total"]= $d->order_total;
                    $ds[$i]["order_time"]= $d->order_time;
                    $ds[$i]["order_date"]= $d->order_date;
                    $ds[$i]["order_acde"]= $d->order_acde;
                    $ds[$i]["order_payment_mode"]= $d->order_payment_mode;
                    $ds[$i]["order_razor_payment_id"]= $d->order_razor_payment_id;
                    $ds[$i]["order_razor_order_id"]= $d->order_razor_order_id;
                    $ds[$i]["customerid"]= $d->customerid;
                    $ds[$i]["customer_id"]= $d->customer_id;
                    $ds[$i]["customer_mobile"]= $d->customer_mobile;
                    $ds[$i]["customer_name"]= $d->customer_name;
                    $ds[$i]["customer_email_id"]= $d->customer_email_id;
                    $ds[$i]["customer_gender"]= $d->customer_gender;
                    $ds[$i]["customer_profile"]= $d->customer_profile;
                    $ds[$i]["customer_whtmobile"]= $d->customer_whtmobile;
                    $ds[$i]["customer_token"]= $d->customer_token;
                    $ds[$i]["vendorproductid"]= $d->vendorproductid;
                    $ds[$i]["vendorproduct_id"]= $d->vendorproduct_id;
                    $ds[$i]["vendorproduct_code"]= $d->vendorproduct_code;
                    $ds[$i]["vendorproduct_vendor_id"]= $d->vendorproduct_vendor_id;
                    $ds[$i]["vendorproduct_product"]= $d->vendorproduct_product;
                    $ds[$i]["vendorproduct_description"]= $d->vendorproduct_description;
                    $ds[$i]["vendorproduct_descc"]= $d->vendorproduct_descc;
                    $ds[$i]["vendorproduct_model"]= $d->vendorproduct_model;
                    $ds[$i]["vendorproduct_brand"]= $d->vendorproduct_brand;
                    $ds[$i]["vendorproduct_shipping"]= $d->vendorproduct_shipping;
                    $ds[$i]["vendorproduct_tax_class"]= $d->vendorproduct_tax_class;
                    $ds[$i]["vendorproduct_category"]= $d->vendorproduct_category;
                    $ds[$i]["vendorproduct_subcategory"]= $d->vendorproduct_subcategory;
                    $ds[$i]["vendorproduct_quantity"]= $d->vendorproduct_quantity;
                    $ds[$i]["vendorproduct_price"]= $d->vendorproduct_price;
                    $ds[$i]["photo_upload"]= $d->photo_upload;
                    $ds[$i]["vendorproduct_mrp"]= $d->vendorproduct_mrp;
                    $ds[$i]["vendorproduct_measure"]= $d->vendorproduct_measure;
                    $ds[$i]["vendorproduct_bbtype"]= $d->vendorproduct_bbtype;
                    $ds[$i]["productid"]= $d->productid;
                    $ds[$i]["product_id"]= $d->product_id;
                    $ds[$i]["product_name"]= $d->product_name;
                    $ds[$i]["product_url"]= $d->product_url;
                    $ds[$i]["product_keywords"]= $d->product_keywords;
                    $ds[$i]["categoryid"]= $d->categoryid;
                    $ds[$i]["category_id"]= $d->category_id;
                    $ds[$i]["category_name"]= $d->category_name;
                    $ds[$i]["category_keywords"]= $d->category_keywords;
                    $ds[$i]["subcategory_id"]= $d->subcategory_id;
                    $ds[$i]["subcategory_category"]= $d->subcategory_category;
                    $ds[$i]["subcategory_name"]= $d->subcategory_name;
                    $ds[$i]["subcategory_keywords"]= $d->subcategory_keywords;
                    $ds[$i]["vendorid"]= $d->vendorid;
                    $ds[$i]["vendor_id"]= $d->vendor_id;
                    $ds[$i]["vendor_name"]= $d->vendor_name;
                    $ds[$i]["vendor_mobile"]= $d->vendor_mobile;
                    $ds[$i]["vendor_dob"]= $d->vendor_dob;
                    $ds[$i]["vendor_gender"]= $d->vendor_gender;
                    $ds[$i]["vendor_email_id"]= $d->vendor_email_id;
                    $ds[$i]["vendor_country"]= $d->vendor_country;
                    $ds[$i]["vendor_state"]= $d->vendor_state;
                    $ds[$i]["vendor_district"]= $d->vendor_district;
                    $ds[$i]["vendor_mandal"]=$d->vendor_mandal;
                    $ds[$i]["vendor_gramapanchayat"]= $d->vendor_gramapanchayat;
                    $ds[$i]["vendor_address"]= $d->vendor_address;
                    $ds[$i]["vendor_pincode"]= $d->vendor_pincode;
                    $ds[$i]["vendor_storename"]= $d->vendor_storename;
                    $ds[$i]["vendor_storename_keywords"]= $d->vendor_storename_keywords;
                    $ds[$i]["vendor_latitude"]= $d->vendor_latitude;
                    $ds[$i]["vendor_longitude"]= $d->vendor_longitude;
                    $ds[$i]["vendor_verified"]= $d->vendor_verified;
                    $ds[$i]["vendor_license"]= $d->vendor_license;
                    $ds[$i]["vendor_license_name"]= $d->vendor_license_no;
                    $ds[$i]["vendor_license_no"]= "";
                    $ds[$i]["vendor_license_document"]= $d->vendor_license_document;
                    $ds[$i]["vendor_date"]= $d->vendor_date;
                    $ds[$i]["vendor_profile"]= $d->vendor_profile;
                    $ds[$i]["vendorproductimgid"]= $d->vendorproductimgid;
                    $ds[$i]["vendorproductimg_id"]= $d->vendorproductimg_id;
                    $ds[$i]["vendorproduct_productid"]= $d->vendorproduct_productid;
                    $ds[$i]["vendorproductimg_name"]= base_url().'uploads/products/'.$d->vendorproductimg_name;
                $i++;}
            }
            return $ds;
        }
        public function viewsearchproducts(){
                $pkey       =  $this->input->post("search_keyword");
                $country    =  $this->input->post("country");
                $target_dir =  $this->config->item("upload_url")."products/"; 
                $parms["group_by"]          =   'pd.product_name';
                $parms["columns"]           =   "*,vendorproduct_id,product_name,vendorproduct_description,vendorproduct_descc,vendorproduct_model,vendorproduct_brand,vendorproduct_shipping,vendorproduct_tax_class,vendorproduct_quantity,vendorproduct_bb_price as vendorproduct_price,vendorproduct_bb_mrp as vendorproduct_mrp,vendorproduct_measure,(CONCAT('$target_dir',vendorproductimg_name)) as vendorproductimg_name,vendorproduct_product,(CASE WHEN ws.wishlist_id IS NOT NULL THEN '1' ELSE '0' END) as wishlist_status";
                $parms["tipoOrderby"]       =   "product_name";
                $parms["order_by"]          =   "ASC";
                //$parms["join_condition"]  =   " AND customer_mobile LIKE '".$this->input->post("customer_mobile")."'";        
                $parms["whereCondition"]    =   "category_name LIKE '%".$pkey."%' OR subcategory_name LIKE '%".$pkey."%' OR product_name LIKE '%".$pkey."%' OR vendorproduct_brand LIKE '%".$pkey."%' OR vendorproduct_model LIKE '%".$pkey."%'";   
                $products =  $this->vendor_model->viewVendorproducts($parms);
                //print_r($parms);exit;
                $i=0;$dats=array();
                if(count($products) >0){
                foreach($products as $pr){
                    $dats[$i]['vendorproduct_id']           = $pr->vendorproduct_id;
                    $dats[$i]['category_id']                = $pr->category_id;
                    $dats[$i]['category_name']              = $pr->category_name;
                    $dats[$i]['subcategory_id']             = $pr->subcategory_id;
                    $dats[$i]['subcategory_name']           = $pr->subcategory_name;
                    $dats[$i]['product_id']                 = $pr->product_id;
                    $dats[$i]['product_name']               = $pr->product_name;
                    $dats[$i]['vendorproduct_description']  = $pr->vendorproduct_description;
                    $dats[$i]['vendorproduct_descc']        = $pr->vendorproduct_descc;
                    $dats[$i]['vendorproduct_model']        = $pr->vendorproduct_model;
                    $dats[$i]['vendorproduct_brand']        = $pr->vendorproduct_brand;
                    $dats[$i]['vendorproduct_shipping']     = $pr->vendorproduct_shipping;
                    $dats[$i]['vendorproduct_tax_class']    = $pr->vendorproduct_tax_class;
                    $dats[$i]['vendorproduct_tax_class']    = $pr->vendorproduct_tax_class;
                    $dats[$i]['vendorproduct_price']        = $this->customer_model->currency_change($country,$pr->vendorproduct_price);
                    $dats[$i]['vendorproduct_mrp']          = ($pr->vendorproduct_mrp)?$this->customer_model->currency_change($country,$pr->vendorproduct_mrp):'';
                    $dats[$i]['vendor_storename']           = $pr->vendor_storename;
                    $dats[$i]['measure_id']                 = ($pr->measure_id !="")?$pr->measure_id:'';
                    $dats[$i]['vendorproduct_measure']      = $pr->vendorproduct_measure;
                    $dats[$i]['vendorproductimg_name']      = $pr->vendorproductimg_name;
                    $dats[$i]['vendorproduct_product']      = $pr->vendorproduct_product;
                    $dats[$i]['measure_unit']               = ($pr->measure_unit !="")?$pr->measure_unit:'';
                $i++;}
            }
            return $dats;
        }
        public function add_to_wishlist(){ 
            $vendorid       =   $this->input->post("vendorproduct_id"); 
            $view           =   $this->view_profile(); 
            $customer_id    =   $view["customer_id"]; 
            $prms["whereCondition"]   =   "vendorproduct_id LIKE '".$vendorid."'";
            $dta    =   $this->vendor_model->getVendorproduct($prms);
            if(isset($dta)){
                if(count($dta)  > 0){ 
                    $pms["whereCondition"]   =   "wishlist_vendor_productid LIKE '".$vendorid."' AND wishlist_customer_id LIKE '".$customer_id."'";
                    $vsp   =    $this->order_model->getwishlistproduct($pms);
                    if($vsp != "" && count($vsp) > 0){
                        return 3;
                    }else{
                        $ins    =   $this->order_model->add_to_wishlist($customer_id,$vendorid);
                        if($ins){
                            return 1;
                        }
                    }
                    return 2;
                }
            }
            return 0;
        } 
        public function view_wishlist(){ 
            $target_dir =   $this->config->item("upload_url")."products/";  
            $prms["columns"]   =   "wishlist_id,product_name,category_id,vendorproduct_id,category_name,subcategory_id,subcategory_name,vendorproduct_id,vendor_name,vendor_storename,vendorproduct_description,vendorproduct_descc,vendorproduct_brand,vendorproduct_shipping,vendorproduct_model,(CONCAT('$target_dir',vendorproductimg_name)) as vendorproductimg_name";
            $prms["whereCondition"]   =   "customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR customer_token LIKE '".$this->input->post("customer_mobile")."'";
            $dta    =   $this->order_model->viewwishlistproducts($prms); 
            return $dta;
        }
        public function deletewishlist(){
            $cart_id          =   $this->input->post("wishlist_id"); 
            $prms["whereCondition"]   =   "wishlist_id LIKE '".$cart_id."'";
            $dta    =   $this->order_model->getwishlistproduct($prms);
            if(isset($dta)){
                if(count($dta)  > 0){ 
                    $ins    =   $this->order_model->deletefromwishlist($cart_id,$dta['wishlist_customer_id']);
                    if($ins){
                        return 1;
                    }
                }
                return 2;
            }
            return 0;
        }
        public function reorders(){
            $prms["whereCondition"]   =   "order_unique LIKE '".$this->input->post("order_unique")."' AND customer_mobile LIKE '".$this->input->post("customer_mobile")."'";
            $dta    =   $this->order_model->vieworderdetails($prms);
            if(isset($dta)){
                if(count($dta) > 0){
                    foreach ($dta as $gtd){  
                        $vendorid    =   $gtd->vendorproduct_id; 
                        $quantity    =   $gtd->quantity; 
                        $price       =   $gtd->vendorproduct_price; 
                        $custid      =   $gtd->customer_id;  
                        $dta    =   $this->vendor_model->getVendorproduct($prms);  
                        $this->order_model->addtocart($custid,$vendorid,$quantity,$price);
                    }
                    return TRUE;
                }
            }
            return FALSE;
        }
        
        public function cntviewcustomers($params  =    array()){
                $params["cnt"]      =   "1"; 
                $val    =   $this->queryCustomer($params)->row_array();
                if(isset($val)){
                    if(count($val) > 0){
                        return  $val['cnt'];
                    }
                }
                return "0";
        }
        public function viewCustomers($params = array()){
                return $this->queryCustomer($params)->result_array();
        }
        public function update_currency($params = array()){
            $par['whereCondition'] = "currnecy_name LIKE '".$params['currnecy_name']."'";
            $vue = $this->getCurrency($par);
            $params ['currnecy_update'] =date('Y-m-d H:i:s a');
            if(is_array($vue) && count($vue) >0){
                return $this->db->update('currnecy',$params,array('currnecy_name'=>$params['currnecy_name']));
            }else{
                return $this->db->insert('currnecy',$params);
            }
        }
        public function getCurrency($params = array()){
                return $this->queryCurrency($params)->result_array();
        }
        public function viewCurrency($params = array()){
                return $this->queryCurrency($params)->result_array();
        }
        public function queryCurrency($params = array()){
            $sel    =   "*";
                if(array_key_exists("columns", $params)){
                        $sel    =   $params["columns"];
                }
                if(array_key_exists("cnt", $params)){
                        $sel    =   "count(*) as cnt";
                }
                $dta    =   array(
                    "curency_open"    =>  "1",
                    "curency_status"    =>  "1"
                );
                $this->db->select("$sel")
                        ->from("currnecy")
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(currnecy_name LIKE '%".$params["keywords"]."%')");
                }
                if(array_key_exists("whereCondition", $params)){
                    $this->db->where("(".$params["whereCondition"].")");
                }
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }
                if(array_key_exists("tipoOrderby",$params) && array_key_exists("order_by",$params)){
                        $this->db->order_by($params['tipoOrderby'],$params['order_by']);
                }
                if(array_key_exists("group_by", $params)){
                    $this->db->group_by($params["group_by"]);
                }
//               $this->db->get();echo $this->db->last_query();exit;
                return $this->db->get();
        } 
        public function currency_change($country,$prince){
            $par['whereCondition'] = "currnecy_name LIKE 'INR'";
            $inr = $this->customer_model->getCurrency($par);
            if(!empty($country) && !empty($prince)){
                $par['whereCondition']    ="currnecy_name LIKE '".$country."'";
                $vue = $this->getCurrency($par);
                if(is_array($vue) && count($vue) >0){
                    $cur = $vue[0]['currnecy']/$inr[0]['currnecy'];
                    $t= (float)($prince)*(float)($cur);
                    $rate = $vue[0]['currency_symboles_native'].number_format($t,$vue[0]['currency_decimal_digits']);
                    //$rate = $vue[0]['currency_symboles_native'].($t);
                    return $rate;
                }else{
                    return $inr[0]['currency_symboles_native'].$prince;
                }
            }else{
                return $inr[0]['currency_symboles_native'].$prince;
            }
        }
        public function currency_change_payment($country,$prince){
            $par['whereCondition'] = "currnecy_name LIKE 'INR'";
            $inr = $this->customer_model->getCurrency($par);
            if(!empty($country) && !empty($prince)){
                $par['whereCondition']    ="currnecy_name LIKE '".$country."'";
                $vue = $this->getCurrency($par);
                if(is_array($vue) && count($vue) >0){
                    $cur = $vue[0]['currnecy']/$inr[0]['currnecy'];
                    $t= (float)($prince)*(float)($cur);
                    $rate = number_format($t,$vue[0]['currency_decimal_digits']);
                    //$rate = $vue[0]['currency_symboles_native'].($t);
                    return $rate;
                }else{
                    return $inr[0]['currency_symboles_native'].$prince;
                }
            }else{
                return $inr[0]['currency_symboles_native'].$prince;
            }
        }
        public function apiproductlist($country=null){
            $category    =   $this->input->post("category");
            $subcategory=   $this->input->post("subcategory");
            $parms["tipoOrderby"]   =   "vendorproductid";
            $target_dir =   $this->config->item("upload_url")."products/";
            $imgpth    =   $this->config->item("upload_url")."category/";
            if($category != "" || $subcategory != ""){
                $pa = '(';
                if($category != "" && $subcategory == ""){
                    // $pa .="sn.category_id LIKE '".$category."'";
                    $pa .="sn.category_id LIKE '".$category."' OR vendorproduct_catmap_cat_id LIKE '%".$category."%'";
                }
                if($subcategory != "" && $category == ""){
                    // $pa .= "sv.subcategory_id LIKE '".$subcategory."'";
                    $pa .= "sv.subcategory_id LIKE '".$subcategory."'  OR vendorproduct_catmap_scat_id LIKE '%".$subcategory."%'";
                }
                if($subcategory != "" && $category != ""){
                    // $pa .= "sv.subcategory_id LIKE '".$subcategory."' AND sn.category_id LIKE '".$category."'";
                    $pa .= "(sv.subcategory_id LIKE '".$subcategory."' AND sn.category_id LIKE '".$category."'  OR vendorproduct_catmap_scat_id LIKE '%".$subcategory."%')";
                }
                $pa .= ")";
                $parms['whereCondition'] =  $pa;
            }
            $parms["order_by"]   =   "DESC";
            if($this->uri->segment("1")=="customer_dashboard"){
                $parms["limit"]      =   "20";
            }
           // 
            $parms["columns"]    =  "sn.`category_id`,sn.`category_name`,`product_id`,`measure_id`,`measure_unit`,(CONCAT('https://www.minikart.in/uploads/category/',category_upload)) AS category_upload,sv.`subcategory_id`,
                                        sv.`subcategory_name`,(CONCAT('https://www.minikart.in/uploads/category/',subcategory_upload)) AS subcategory_upload,vd.`vendor_storename`,vd.`vendor_name`,vp.`vendorproduct_id`,pd.`product_name`,vp.`vendorproduct_description`,vp.`vendorproduct_descc`,
                                        vp.`vendorproduct_model`,vp.`vendorproduct_brand`,vp.`vendorproduct_shipping`,vp.`vendorproduct_tax_class`,vp.`vendorproduct_quantity`,vpp.`vendorproduct_bb_price as vendorproduct_price`,vpp.vendorproduct_bb_mrp as `vendorproduct_mrp`,
                                        vp.`vendorproduct_measure`,(CONCAT('https://www.minikart.in/uploads/products/',vendorproductimg_name)) AS vendorproductimg_name,`vendorproduct_product`,(CASE WHEN ws.wishlist_id IS NOT NULL THEN '1' ELSE '0'END) AS wishlist_status";
            $parms['group_by']    =  "vp.vendorproduct_id";
            $dats=array();
            $products = $this->vendor_model->viewVendorproducts($parms);
           // echo '<pre>';print_r($products);exit;
            if(count($products) > 0){
                $i=0;
                foreach($products as $pr){
                    $dats[$i]['vendorproduct_id']           = $pr->vendorproduct_id;
                    $dats[$i]['category_id']                = $pr->category_id;
                    $dats[$i]['category_name']              = $pr->category_name;
                    $dats[$i]['subcategory_id']             = ($pr->subcategory_id !="")?$pr->subcategory_id:'';
                    $dats[$i]['subcategory_name']           = ($pr->subcategory_name !="")?$pr->subcategory_name:'';
                    $dats[$i]['product_id']                 = $pr->product_id;
                    $dats[$i]['product_name']               = $pr->product_name;
                    $dats[$i]['vendorproduct_description']  = $pr->vendorproduct_description;
                    $dats[$i]['vendorproduct_descc']        = $pr->vendorproduct_descc;
                    $dats[$i]['vendorproduct_model']        = $pr->vendorproduct_model;
                    $dats[$i]['vendorproduct_brand']        = $pr->vendorproduct_brand;
                    $dats[$i]['vendorproduct_shipping']     = $pr->vendorproduct_shipping;
                    $dats[$i]['vendorproduct_tax_class']    = $pr->vendorproduct_tax_class;
                    $dats[$i]['vendorproduct_tax_class']    = $pr->vendorproduct_tax_class;
                    $dats[$i]['vendorproduct_price']        = $this->customer_model->currency_change($country,$pr->vendorproduct_price);
                    $dats[$i]['vendorproduct_mrp']          = ($pr->vendorproduct_mrp)?$this->customer_model->currency_change($country,$pr->vendorproduct_mrp):'';
                    $dats[$i]['vendor_storename']           = $pr->vendor_storename;
                    $dats[$i]['measure_id']                 = ($pr->measure_id !="")?$pr->measure_id:'';
                    $dats[$i]['vendorproduct_measure']      = $pr->vendorproduct_measure;
                    $dats[$i]['vendorproductimg_name']      = $pr->vendorproductimg_name;
                    $dats[$i]['vendorproduct_product']      = $pr->vendorproduct_product;
                    $dats[$i]['measure_unit']               = ($pr->measure_unit !="")?$pr->measure_unit:'';
                $i++;}
            }
            return $dats;
        }
        public function currency_update(){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://data.fixer.io/api/latest?access_key=0396d9a9232cada94e6ea9b5a73b0a5f&format=1',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'x-rapidapi-host: currency-converter5.p.rapidapi.com',
                    'x-rapidapi-key: DqA7yU2Fs7mshsykMgx9LBqBRrHlp1tTLadjsnaE7oT9maWpqW',
                    'Cookie: __cfduid=dcc89c7046c7bfa27465496f9dd5e61661614226577'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $currn  = json_decode($response,true);
            if($currn['success'] == 1){
                foreach($currn['rates'] as $key => $value){
                    $dta = array(
                       'currnecy_name' => $key,
                       'currnecy'      => $value
                    );
                    $this->customer_model->update_currency($dta);
                }
                $this->customer_model->sybmoles();
            }
        }
        public function reminders(){
            $params["whereCondition"] =   "customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR  customer_token LIKE '".$this->input->post("customer_mobile")."'"; 
            $vsp    =   $this->queryCustomer($params)->row_array();
            $dat = array();
            if(isset($vsp) && count($vsp) > 0){
                $par['whereCondition'] = "customer_id LIKE '".$vsp['customer_id']."'";
                $rem = $this->viewReminder($par);
                if(is_array($rem) && count($rem) >0){
                    $i=0;
                    foreach($rem as $r){
                        $occasion  = $this->common_model->get_Occasion($r['reminder_type']);
                        $dat[$i]['reminder_id']     = $r['reminder_id'];
                        $dat[$i]['reminder_title']  = $r['reminder_title'];
                        $dat[$i]['reminder_date']   = date('Y-m-d',strtotime($r['reminder_date']));
                        $dat[$i]['reminder_desc']   = $r['reminder_desc'];
                        $dat[$i]['reminder_type']   = ($occasion[0]['occasion'] !="")?$occasion[0]['occasion']:'';
                    $i++;
                    }
                }
            }
            return $dat;
        }
        public function addreminders(){
            $params["whereCondition"] =   "customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR  customer_token LIKE '".$this->input->post("customer_mobile")."'"; 
            $vsp    =   $this->queryCustomer($params)->row_array();
            if(isset($vsp) && count($vsp) > 0){
                $data = array(
                    'reminder_id'    => "Remin".$this->common_model->get_max("reminderid","reminder"), 
                    'reminder_title' => $this->input->post("title"),
                    'reminder_date'  => $this->input->post("date"),
                    'reminder_type'  => $this->input->post("type"),
                    'reminder_desc'  => $this->input->post("note"),
                    'customer_id'    => $vsp['customer_id'],
                    'reminder_add_by'=> $vsp['customer_id'],
                    'reminder_add_date'=>date('Y-m-d H:i:s')
                );
                $this->db->insert("reminder",$data);
                if($this->db->insert_id() > 0){
                    return TRUE;
                }
                return FALSE;
            }
        }
        /*-------------------Reminders------------------------*/
        public function queryReminder($params = array()){
            $sel    =   "*";
                if(array_key_exists("columns", $params)){
                        $sel    =   $params["columns"];
                }
                if(array_key_exists("cnt", $params)){
                        $sel    =   "count(*) as cnt";
                }
                $dta    =   array(
                    "reminder_open"     =>  "1",
                    "reminder_status"   =>  "1"
                );
                $this->db->select("$sel")
                        ->from("reminder")
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(reminder_title LIKE '%".$params["keywords"]."%')");
                }
                if(array_key_exists("whereCondition", $params)){
                    $this->db->where("(".$params["whereCondition"].")");
                }
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }
                if(array_key_exists("tipoOrderby",$params) && array_key_exists("order_by",$params)){
                        $this->db->order_by($params['tipoOrderby'],$params['order_by']);
                }
                if(array_key_exists("group_by", $params)){
                    $this->db->group_by($params["group_by"]);
                }
//               $this->db->get();echo $this->db->last_query();exit;
                return $this->db->get();
        } 
        public function getReminder($params = array()){
                return $this->queryReminder($params)->row_array();
        }
        public function viewReminder($params = array()){
                return $this->queryReminder($params)->result_array();
        }
        public function cntReminder($params = array()){
            $params["cnt"]      =   "1"; 
                $val    =   $this->queryReminder($params)->row_array();
                if(isset($val)){
                    if(count($val) > 0){
                        return  $val['cnt'];
                    }
                }
                return "0";
        }
        public function add_reminder(){
            $dta = array(
                'reminder_id'    => "Remin".$this->common_model->get_max("reminderid","reminder"), 
                'reminder_title' => $this->input->post('reminder_title'),
                'customer_id'    => $this->session->userdata("customer_id"),
                'reminder_type'  => $this->input->post('reminder_type'),
                'reminder_date'  => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('reminder_date')))),
                'reminder_desc'  => $this->input->post('reminder_desc'),
                'reminder_add_by'=>$this->session->userdata("customer_id"),
                'reminder_add_date'=>date('Y-m-d H:i:s')
            );
            $this->db->insert("reminder",$dta);
            if($this->db->insert_id() > 0){
                return TRUE;
            }
            return FALSE;
        }
        public function update_reminder($uri){
            $dta = array(
                'reminder_title' => $this->input->post('reminder_title'),
                'customer_id'    => $this->session->userdata("customer_id"),
                'reminder_type'  => $this->input->post('reminder_type'),
                'reminder_date'  => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('reminder_date')))),
                'reminder_desc'  => $this->input->post('reminder_desc'),
                'reminder_update_by'=>$this->session->userdata("customer_id"),
                'reminder_udate_date'  =>date('Y-m-d H:i:s')
            );
            //echo '<pre>';print_r($dta);exit;
            $rws = $this->db->update('reminder',$dta,array('reminder_id'=>$uri));
            if($rws > 0){
                return TRUE;
            }
            return FALSE;
        }
        public function delete_reminders($uri){
            $dta = array(
                'reminder_open'       =>  0,
                'reminder_update_by'  =>  $this->session->userdata("customer_id"),
                'reminder_udate_date' =>  date('Y-m-d H:i:s')
            );
            $rws = $this->db->update('reminder',$dta,array('reminder_id'=>$uri));
            if($rws > 0){
                return TRUE;
            }
            return FALSE;
        }
        public function occasionlist(){
            $Occasion = $this->common_model->viewOccasion();
            $data = array();
            if(is_array($Occasion) && count($Occasion) > 0){
                $i=0;
                foreach($Occasion as $oc){
                    $data[$i]['occasion_id'] = $oc['occasion_id'];
                    $data[$i]['occasion']    = $oc['occasion'];
                    $i++;
                }
            }
            return $data;
        }
        /*-------------------Reminders------------------------*/
        public function review_rating(){
            $d = array(
                'rating'    => $this->input->post('rating'),
                'prodcu_id' => $this->input->post('product_id'),
                'message'   => $this->input->post('message'),
                'order_id'   => $this->input->post('order_id'),
                'add_date'      => date('Y-m-d H:i:s'),
                'added_by'  => ($this->session->userdata("customer_id"))??'',
            );
            $this->db->insert('product_review',$d);
            $id = $this->db->insert_id();
            if($id > 0){
                $this->db->where('reviewid',$id)->update('product_review',array('review_id'=> 'Reviw'.$id));
                return 1;
            }else{
                return 0;
            }
        }
        public function subscribe(){
            $data = array(
                'subscribe_email' => $this->input->post('emailid'),
                'ipaddress'       => $this->common_config->get_client_ip(),
                'add_date'        => date('Y-m-d H:i:s')
            );
            $this->db->insert('subscribe',$data);
            $r = $this->db->insert_id();
            if($r >0){
                return $this->db->where('subscribeid',$r)->update('subscribe',array('subscribe_id'=>'SUB'.$r));
            }else{
                return 0;
            }
        }
        /*-------------------Review------------------------*/
        public function queryReview($params = array()){
            $sel    =   "*";
                if(array_key_exists("columns", $params)){
                        $sel    =   $params["columns"];
                }
                if(array_key_exists("cnt", $params)){
                        $sel    =   "count(*) as cnt";
                }
                $dta    =   array(
                    "review_open"     =>  "1",
                    "review_status"   =>  "Active"
                );
                $this->db->select("$sel")
                        ->from("product_review as p")
                        ->join('customers as c','c.customer_id = p.added_by','left')
                        ->where($dta);
                if(array_key_exists("whereCondition", $params)){
                    $this->db->where("(".$params["whereCondition"].")");
                }
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                }
                if(array_key_exists("tipoOrderby",$params) && array_key_exists("order_by",$params)){
                        $this->db->order_by($params['tipoOrderby'],$params['order_by']);
                }
                if(array_key_exists("group_by", $params)){
                    $this->db->group_by($params["group_by"]);
                }
//               $this->db->get();echo $this->db->last_query();exit;
                return $this->db->get();
        } 
        public function getReview($params = array()){
                return $this->queryReview($params)->row_array();
        }
        public function viewReview($params = array()){
                return $this->queryReview($params)->result_array();
        }
        public function cntReview($params = array()){
            $params["cnt"]      =   "1"; 
                $val    =   $this->queryReview($params)->row_array();
                if(isset($val)){
                    if(count($val) > 0){
                        return  $val['cnt'];
                    }
                }
                return "0";
        }
         public function activedeactive($uri,$status){
                $dta    =   array( 
                                "customer_abc"             =>    $status,
                                "customer_modified_on"  =>    date("Y-m-d h:i:s"),
                                "customer_modified_by"    =>    $this->session->userdata("login_id")
                            );
                $this->db->update("customers",$dta,array("customer_id" => $uri)); 
                $vsp    =    $this->db->affected_rows();
                if($vsp > 0){  
                    return TRUE;
                }
                return FALSE;
        }
        public function send_order_mail($orderid){
            $par['whereCondition'] = "order_id LIKE '".$orderid."'";
                $order = $this->order_model->vieworderdetails($par);
                if(count($order) >0){
                    $i=0;$total1 = 0;
                    foreach ($order as $ve){
                        $id =   $ve->order_unique;
                        $ot     =   $ve->orderdetail_quantity*$ve->orderdetail_price;
                        $speciations = json_decode($ve->orderdetail_speciations);
                        $dta    =   $this->deliverycharges_model->getdeliverychg($speciations->cart_delivery_id);
                        if(is_array($dta)&& count($dta)  > 0){
                            $timestamp1 = strtotime($dta['deliverychg_end']);
                            $end        =  date('g:i a', $timestamp1);
                            $timestamp  = strtotime($dta['deliverychg_start']);
                            $start      =  date('g:i a', $timestamp);
                            $time       = $start.' - '.$end;
                        }
                        $date= $speciations->cart_date;
                        $time= ($time)??'';
                        $imsg   =   $this->config->item("upload_url")."products/photo-not-available.png";
                        $target_dir =  $this->config->item("upload_url")."products/".$ve->vendorproductimg_name ;
                        if(@getimagesize($target_dir)){
                                $imsg   =   $target_dir;
                        }
                        $pric   =   $ve->orderdetail_quantity*$ve->orderdetail_price;
                        $deli=$this->customer_model->currency_change('INR',$ve->orderdetail_delivery_chage);
                        $data[$i] = array(
                            'pname' => $ve->product_name,
                            'image' =>$imsg,
                            'id' =>$ve->order_unique,
                            'qty'  => $ve->orderdetail_quantity,
                            'total' => $pric,
                            'delivery'  => $deli,
                            'placed'    => date_format(date_create($ve->order_created_on),"d/m/Y g:i a"),
                            'price' =>  $ve->orderdetail_price,
                            'message'   => $speciations->cart_message_on_cake,
                            'Ingredients'   => $speciations->cart_indug,
                            'size'  => $speciations->cart_size,
                            'date'  => date_format(date_create($date),"d/m/Y"),
                            'time'  => $time,
                            'Name'=> $ve->customer_name,
                            'Mobile'    =>  $ve->customer_mobile,
                            'Locality'  =>  $ve->customeraddress_locality,
                            'Address'   =>  $ve->customeraddress_address,
                            'Pincode'   =>  $ve->customeraddress_pincode,
                        );
                        $toemail    = $ve->customer_email_id;
                        $total1  =   $total1+$ve->orderdetail_delivery_chage+$pric;
                          $i++;  
                    }
            	    $subject= "Order Information -minikart";
            	    $messge = '<!DOCTYPE html>
                                <html>
                                
                                <head>
                                    <title></title>
                                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                    <meta name="viewport" content="width=device-width, initial-scale=1">
                                    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                                    <link rel="stylesheet" href="https://www.minikart.in//assets/css/all.min.css">
                                    <link rel="stylesheet" href="https://www.minikart.in//assets/css/style.css">
                                    <style type="text/css">
                                        body,
                                        table,
                                        td,
                                        a {
                                            -webkit-text-size-adjust: 100%;
                                            -ms-text-size-adjust: 100%;
                                        }
                                
                                        table,
                                        td {
                                            mso-table-lspace: 0pt;
                                            mso-table-rspace: 0pt;
                                        }
                                
                                        img {
                                            -ms-interpolation-mode: bicubic;
                                        }
                                
                                        img {
                                            border: 0;
                                            height: auto;
                                            line-height: 100%;
                                            outline: none;
                                            text-decoration: none;
                                        }
                                
                                        table {
                                            border-collapse: collapse !important;
                                        }
                                
                                        body {
                                            height: 100% !important;
                                            margin: 0 !important;
                                            padding: 0 !important;
                                            width: 100% !important;
                                        }
                                
                                        a[x-apple-data-detectors] {
                                            color: inherit !important;
                                            text-decoration: none !important;
                                            font-size: inherit !important;
                                            font-family: inherit !important;
                                            font-weight: inherit !important;
                                            line-height: inherit !important;
                                        }
                                
                                        @media screen and (max-width: 480px) {
                                            .mobile-hide {
                                                display: none !important;
                                            }
                                
                                            .mobile-center {
                                                text-align: center !important;
                                            }
                                        }
                                
                                        div[style*="margin: 16px 0;"] {
                                            margin: 0 !important;
                                        }
                                    </style>
                                
                                <body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">
                                    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Open Sans, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
                                        For what reason would it be advisable for me to think about business content? That might be little bit risky to have crew member like them.
                                    </div>
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">
                                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                                    <tr>
                                                        <td align="center" valign="top" style="font-size:0; padding: 15px;" bgcolor="#fff">
                                                            <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
                                                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                                                    <tr>
                                                                        <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;" class="mobile-center">
                                                                            <img src="https://www.minikart.in//assets/images/logo.png" alt="logo" style="max-height:20vh;">
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;" class="mobile-hide">
                                                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                                                    <tr>
                                                                        <td align="right" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;">
                                                                            <table cellspacing="0" cellpadding="0" border="0" align="right">
                                                                                <tr>
                                                                                    <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400;">
                                                                                        <p style="font-size: 18px; font-weight: 400; margin: 0; color: #000;"><a href="https://www.minikart.in" target="_blank" style="color: #000; text-decoration: none;">Shop &nbsp;</a></p>
                                                                                    </td>
                                                                                    <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 24px;"> <a href="https://www.minikart.in" target="_blank" style="color: #ffffff; text-decoration: none;"><img src="https://img.icons8.com/color/48/000000/small-business.png" width="27" height="23" style="display: block; border: 0px;" /></a> </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                                                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                                                <tr>
                                                                    <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <img src="https://www.minikart.in//assets/images/check.png" width="125" height="120" style="display: block; border: 0px;" /><br>
                                                                        <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Hi..! '.$data[0]['Name'].', </h2>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> 
                                                                        <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Thank You For Your Order! </h2>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="25%" align="right">
                                                                    <br> Order Placred On : '.$data[0]['placed'].'
                                                                    </td>
                                                                </tr>
                                                               
                                                                <tr>
                                                                    <td align="left" style="padding-top: 20px;">
                                                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                             <tr>
                                                                                <td width="75%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;" colspan="2"> Order Confirmation # </td>
                                                                                <td width="25%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;"> '.$id.' </td>
                                                                            </tr>';
                                                                            foreach($data as $d){
                                                                              $messge .=  '<tr>
                                                                                            <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> <img src="'.$d["image"].'" > </td>
                                                                                            <td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> '.$d["pname"].' X '.$d["qty"].' </td>
                                                                                            <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> '.$this->customer_model->currency_change('INR',$d["total"]).' </td>
                                                                                        </tr><tr><td colspan="3">';
                                                                                if(!empty($d['message'])){
                                                                                    $messge .='message to display : '.$d['message'];
                                                                                }
                                                                                if(!empty($d['Ingredients'])){
                                                                                    $messge .='Ingredients : '.$d['Ingredients'];
                                                                                }
                                                                                if(!empty($d['size'])){
                                                                                    $messge .='size : '.$d['size'];
                                                                                }
                                                                                $messge .= '</td></tr>';
                                                                            }
                                                                            
                                                                        $messge .='</table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" style="padding-top: 20px;">
                                                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                            <tr>
                                                                                <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 13px; font-weight: 400; line-height: 24px; padding: 10px;"> Delivery Charges </td>
                                                                                <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 13px; font-weight: 400; line-height: 24px; padding: 10px;"> '.$deli.' </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;"> TOTAL </td>
                                                                                <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;"> '.$this->customer_model->currency_change('INR',$total1).' </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" height="100%" valign="top" width="100%" style="padding: 0 35px 35px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                                                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:660px;">
                                                                <tr>
                                                                    <td align="center" valign="top" style="font-size:0;">
                                                                        <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">
                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                                                                <tr>
                                                                                    <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                                                                                        <p style="font-weight: 800;">Delivery Address</p>
                                                                                        <p>'.$data[0]["Name"].'<br>'.$data[0]["Mobile"].'<br>'.$data[0]["Locality"].'<br>'.$data[0]["Address"].'<br>'.$data[0]["Pincode"].'<br></p>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                        <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">
                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                                                                <tr>
                                                                                    <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                                                                                        <p style="font-weight: 800;">Estimated Delivery</p>
                                                                                        <p> on '.$data[0]["date"].' , between '.$data[0]["time"].'</p>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="  background-color: #ff7361;" bgcolor="#1b9ba3">
                                                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                                                
                                                                <tr>
                                                                    <td align="center" style="padding: 25px 0 15px 0;">
                                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td align="center" style="border-radius: 5px;" bgcolor="#66b3b7"> <a href="https://www.minikart.in" target="_blank" style="font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #F44336; padding: 15px 30px; border: 1px solid #F44336; display: block;">Shop Again</a> </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="padding: 35px; background-color: #ffffff;" bgcolor="#ffffff">
                                                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                                                <tr>
                                                                    <td > <img src="https://www.minikart.in//assets/images/logo.png"  width="30%" style="display: block; border: 0px;" /> </td>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <td >
                                                                    <p> Phone :  +919160708686<br> email : support@minikart.in</br>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;">
                                                                    <p class="copyright">Copyright © 2021 <a href="">Minikart</a>. All Rights Reserved.</p>
                                                                        <p style="font-size: 14px; font-weight: 400; line-height: 20px; color: #777777;"> If you didn\'t order this, please ignore this email or <a href="https://minikart.in" target="_blank" style="color: #777777;">unsusbscribe</a>. </p>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </body>
                                
                                </html>';
            	   $response = $this->common_config->orderadminemail('',$subject,$messge);
            	   $this->common_config->orderemail($toemail,$subject,$messge);
            	   $messgeee= "Order Placed: Your order for ".$data[0]['pname']." with Order ID ".$id." amounting to ".$this->customer_model->currency_change('INR',$total1)." has been received. You can expect delivery by ASAP We will send you an update when your order is packed or shipped. Beware of fraudulent calls and messages. Minikart do not ask bank info for offers or demand money.";
            	   $this->mobile_otp->sendmobilemessage($data[0]['Mobile'],$messgeee);
            	
                }
        }
        public function update_check_mail(){
            $params["whereCondition"] =   "(customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR  customer_token LIKE '".$this->input->post("customer_mobile")."' OR customer_id LIKE '".$this->input->post("customer_mobile")."') AND (lower(customer_email_id) LIKE '".strtolower($this->input->post("customer_email_id"))."')";
            $vsp        =   $this->queryCustomer($params)->row_array();
            if(isset($vsp)){
                if(count($vsp) > 0)
                    return TRUE;
            }else{
                $params["whereCondition"] =   "lower(customer_email_id) LIKE '".strtolower($this->input->post("customer_email_id"))."'";
                $vsp    =   $this->queryCustomer($params)->row_array(); 
                if(is_array($vsp) && count($vsp) > 0){
                    return FALSE;
                }
                return TRUE;
            }
            return FALSE; 
        }
        public function customer_addon(){
            $parms["columns"]           =   "sn.category_id,sv.subcategory_id";  
                $parms["whereCondition"]    =   "vendorproduct_id LIKE '".$this->input->post("vendorproduct_id")."'";
                $products=  $this->vendor_model->getVendorproduct_list($parms);
                $dats=array();
                if(is_array($products) && count($products) >0){
                    $country     =   $this->input->post("country");
                    $category_id               = $products['category_id'];
                    $subcategory_id            = $products['subcategory_id'];

                    $addo['whereCondition'] = "category_id = '".$category_id."' AND (subcategory_id = '".$subcategory_id."' OR subcategory_id = '".$subcategory_id."')  AND addon_open ='1'";
                    $cate    =   $this->addon_model->viewAddonItems($addo);$i=0;//print_r($cate);exit;
                    $parms['whereCondition'] = "vendorproduct_out_stock = '0' AND (";
                    if(count($cate)>0){
                        foreach($cate as $ct){
                            $addonnn    =   explode('_',$ct->addon_items_item_id);
                            if(empty($addonnn[1])){
                                $addonnn[1]='';
                            }
                            if($i==0){
                                $parms['whereCondition'] .= "(vendorproduct_id = '".$addonnn[0]."' AND vendorproductprinceid ='".$addonnn[1]."')"; 
                            }else{
                                $parms['whereCondition'] .= " OR (vendorproduct_id = '".$addonnn[0]."' AND vendorproductprinceid ='".$addonnn[1]."')"; 
                            }$i++;
                            
                        }
                        $parms['whereCondition'] .= ")";
                        $target_dir =   $this->config->item("upload_url")."products/";
                        $parms['columns']  =   'product_name,vendorproduct_id,vendorproductimg_name,category_name,product_keywords,vendorproduct_acde,vendorproduct_bb_price,vendorproduct_bb_mrp,vendorproductprinceid,prod_indug,vendorproduct_bb_quantity';
                        $parms['group_by']  =   'product_name';
                        $rese =   $this->vendor_model->viewVendorproducts_list($parms);$i=0;
                        foreach($rese as $r){
                            $dats[$i]['product_name']                   = $r->product_name.'-'.$r->prod_indug.'-'.$r->vendorproduct_bb_quantity;
                            $dats[$i]['vendorproduct_id']               = $r->vendorproduct_id.'_'.$r->vendorproductprinceid;
                            $dats[$i]['vendorproductimg_name']          = $target_dir.$r->vendorproductimg_name;
                            $dats[$i]['vendorproduct_bb_price']         = $r->vendorproduct_bb_price;
                            $dats[$i]['vendorproduct_bb_mrp']           = $r->vendorproduct_bb_mrp;
                            $i++;
                        }
                    }
                        
                }
                return $dats;
        }
        public function refer_earn(){
            $params["whereCondition"] =   "customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR  customer_token LIKE '".$this->input->post("customer_mobile")."' OR customer_id LIKE '".$this->input->post("customer_mobile")."'"; 
            $vsp        =   $this->queryCustomer($params)->row_array();//print_r($vsp);exit;
            if(isset($vsp)){
                if(count($vsp) > 0)
                    $conditions["whereCondition"] ="order_coupon = '".$vsp['customer_coupon']."'";
                    $details          =   $this->order_model->vieworders($conditions);
                    $i=1;
                    $dd['referal_coupon']   =   $vsp['customer_coupon'];
                    $ddd = array();
                    foreach($details as $d){
                        $ddd[$i]['order_status']  = $d->order_acde;
                        $ddd[$i]['gen_coupon']    = $d->order_coupon_gen;
                        $i++;
                    }
                    $dd['coupons']  =   $ddd;
                    $pmrs["whereCondition"]  =   "refer_refer LIKE  'refer' AND refer_abc = 'Active'";
                    $vsps	=	$this->refer_model->getRefer($pmrs);
                    $pmrs["whereCondition"]  =   "refer_refer LIKE  'earn' AND refer_abc = 'Active'";
                    $vsps1	=	$this->refer_model->getRefer($pmrs);
                    $dd['referal_coupon_benfit']   =   array("discount" => $vsps[0]['refer_type'],"percen_or_amount" => $vsps[0]['refer_discount']);
                    $dd['earn_coupon_benfit']   =   array("discount" => $vsps1[0]['refer_type'],"percen_or_amount" => $vsps1[0]['refer_discount']);
                    return $dd;
            }
            return FALSE; 
        }
        public function coupon($str){
            $vsp	=	$this->coupon_model->unique_id_coupon($str); 
            if($vsp){
                $this->form_validation->set_message("coupon","Coupon Code already exists.");
                return FALSE;
            }
            return TRUE; 
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
                return $token;
            }
            
        }
        public function getmobileid(){
            $params["whereCondition"] =   "customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR  customer_token LIKE '".$this->input->post("customer_mobile")."' OR customer_id LIKE '".$this->input->post("customer_mobile")."'"; 
            $vsp        =   $this->queryCustomer($params)->row_array();
            if(isset($vsp)){
                if(count($vsp) > 0)
                    return $vsp['customer_id'];
            }
            return FALSE; 
        }
        
}