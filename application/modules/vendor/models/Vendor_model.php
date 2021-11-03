<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Vendor_model extends CI_Model{
        public function jsonencodevalues($status,$status_message,$check = '1'){ 
            $json   =   array(
                "status"            =>  $status,
                "status_messsage"   =>  $status_message,
            );
            if($check == '0'){
                return $json;
            }
            return json_encode($json);
        }  
        public function saveToken($tokentype){
            $token_value        =   $this->input->post("token_value");
            $token_mobile       =   $this->input->post("token_mobile");
            $this->db->where("(token_mobile LIKE '".$token_mobile."' OR token_name LIKE '".$token_value."') AND token_type LIKE '$tokentype'");
            $vsp    =   $this->db->get("tokens")->row_array();
            $dta   =    array(
                            "token_mobile"  =>  $token_mobile,
                            'token_name'    =>  $token_value,
                            'token_type'    =>  $tokentype
                        );
            if(isset($vsp)){
                if(count($vsp) > 0){
                    $dta["token_update"] = date("Y-m-d H:i:s");
                    $this->db->update("tokens",$dta,array("token_id" => $vsp['token_id']));
                    if($this->db->affected_rows() > 0){
                        return TRUE;
                    }
                }
            }else{ 
                $dta["token_date"]  =  date("Y-m-d H:i:s");
                $this->db->insert("tokens",$dta);
                if($this->db->insert_id() > 0){
                    return TRUE;
                }
            }
            return FALSE;
        }
        public function sendotp($mobile,$key = 0){
            if($this->input->post("customer_mobile") !=""){
                $customer_mobile = $this->input->post("customer_mobile");
            }else{
                $customer_mobile = $mobile;
            }
            $params["whereCondition"] =   "customer_mobile LIKE '".$customer_mobile."' OR customer_email_id LIKE '".$customer_mobile."'";
            $vsp    =   $this->customer_model->queryCustomer($params)->row_array();
            if(is_array($vsp) && count($vsp) > 0){
                $rgcount    =   $vsp["customer_country"];
                $otp_key    =   rand(11111,99999);
                if($rgcount == sitedata("site_country")){
                    $str        =  "Dear Customer, Your OTP verification key : ".$otp_key." Minikart which expires in 10 mins";//"Dear Customer,\nYour OTP verification key : ".$otp_key." for Minikart which expires in 10 mins\n";
                    //if($key == "0"){
                    //    $str        =  $otp_key;// "Dear Vendor,\nYour OTP verification key : ".$otp_key." which expires in 10 mins\n";
                    //}
                    $messge     =   $str;//urlencode($str);
                    $vsp        =   $this->mobile_otp->sendmobilemessage($mobile,$messge);
                    //print_r($vsp);exit;
                  
                }else{
                    $subject= "Profile Verficartion OTP";
                    $toemail= $vsp['customer_email_id'];
                    $messge= "<p>Dear ".$vsp['customer_name'].",</p>
                            <p>Greetings from minikart</p>
                            <p>OTP : ".$otp_key."</p>
                            <p>Please feel free to write to us at support@minikart.in for any further assistance and clarification.</p>
                            <p>Best Regards,</p>
                            <p>Minikart Team</p>
                            '".sitedata("site_name")."'";
                        $vsp= $this->common_config->configemail($toemail,$subject,$messge);
                }
                if($vsp){
                    $dta    =   array(
                        "otp_key"           =>  $otp_key,
                        "otp_status"        =>  1,
                        "otp_mobile_no"     =>  $mobile,
                        "otp_sent_time"     =>  date("Y-m-d H:i:s")
                    );
                    $this->db->insert("otp_log",$dta);
                    return TRUE;
                }
                return FALSE;
            }else{
                return false;
            }
        }
        public function verifyotp($otpno,$mobile,$verify = 0){
            $this->db->select('*')
                    ->from('otp_log')
                    ->where('otp_key',$otpno)
                    ->where('otp_mobile_no',$mobile)
                    ->where("TIMEDIFF(TIME(otp_sent_time), CURTIME()) <= '20'")
                    ->where('otp_status','1');
            $response 	= 	$this->db->get();  
            $result 	= 	$response->row_array();
            //print_r($result);exit;
            if(isset($result)){
                if(count($result) > 0){
                    $this->db->where('otp_id', $result['otp_id']);
                    $this->db->update('otp_log',array('otp_status'=>'0')); 
                    if($this->db->affected_rows() > 0){
                        $params["whereCondition"]   =   "customer_mobile LIKE '".$mobile."' OR  customer_token LIKE '".$mobile."' OR customer_id LIKE '".$mobile."'"; 
                        $vsp                        =   $this->customer_model->queryCustomer($params)->row_array();
                        $param["whereCondition"]   =   "customer_email_id LIKE '".$mobile."' OR  customer_token LIKE '".$mobile."' OR customer_id LIKE '".$mobile."'"; 
                        $vsps                       =   $this->customer_model->queryCustomer($param)->row_array();
                        $check                      =   $this->customer_model->checkmobilestatus();
                        
                        if(is_array($vsp) && count($vsp) > 0){ 
                            $datas = array(
                                        'customer_verified'         =>  1,
                                        'customer_verified_mobile'  =>  1,
                                        'customer_modified_on'      =>  date('Y-m-d H:i:sa'),
                                        'customer_modified_by'      =>  $vsp['customer_id']
                                    );
                                    //print_r($datas);exit;
                            $this->db->where('customer_id',$vsp['customer_id'])->update('customers',$datas);
                            if($this->db->affected_rows() > 0){
                                return $vsp;
                            }
                            return false;
                        }else if(is_array($vsps) && count($vsps) > 0){ 
                            $datas = array(
                                        'customer_verified'         =>  1,
                                        'customer_email_verified'   =>  1,
                                        'customer_modified_on'      =>  date('Y-m-d H:i:sa'),
                                        'customer_modified_by'      =>  $vsps['customer_id']
                                    );
                                    //print_r($datas);exit;
                            $this->db->where('customer_id',$vsps['customer_id'])->update('customers',$datas);
                            if($this->db->affected_rows() > 0){
                                return $vsps;
                            }else{
                                return $vsps;
                            }
                        }
                        if(!$check){
                            //$ins    =   $this->customer_model->create_customer(); 
                            return false;
                        }
                    }
                }
            }
            return FALSE;
        }  
        public function queryVendor($params = array()){
                $sel    =   "*";
                if(array_key_exists("columns", $params)){
                        $sel    =   $params["columns"];
                }
                if(array_key_exists("cnt", $params)){
                        $sel    =   "count(*) as cnt";
                }
                $dta    =   array(
                    "vd.vendor_open"    =>  "1",
                    "vd.vendor_status"  =>  "1",
                    "ct.country_status" =>  "1",
                    "st.state_status"   =>  "1",
                    "dt.district_status"        =>  "1",
                    "md.mandal_open"            =>  "1",
                    "md.mandal_status"          =>  "1",
                    "gm.gram_panchayat_open"    =>  "1",
                    "gm.gram_panchayat_status"  =>  "1" 
                );
                $this->db->select("$sel")
                        ->from("vendor as vd")
                        ->join("countries as  ct","ct.country_id = vd.vendor_country","INNER") 
                        ->join("state as st","st.state_id = vd.vendor_state","INNER") 
                        ->join("district as  dt","dt.district_id = vd.vendor_district","INNER")  
                        ->join("mandal as md","md.mandal_id = vd.vendor_mandal","INNER")  
                        ->join("gram_panchayat as gm","gm.gram_panchayat_id = vd.vendor_gramapanchayat","INNER")  
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(vendor_mobile LIKE '%".$params["keywords"]."%')");
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
        public function view_profile($mobile){ 
                $target_dir =   $this->config->item("upload_url")."vendor-uploads/";
                $imgt_dir =   $this->config->item("upload_url")."products/";
                $params["columns"]           =   "vendor_id,vendor_name,vendor_mobile,vendor_dob,vendor_gender,vendor_email_id,vendor_state,state_name,vendor_district,district_name,vendor_mandal,mandal_name,vendor_gramapanchayat,gram_panchayat_name,vendor_address,vendor_pincode,vendor_storename,vendor_license_name,(CASE WHEN vendor_license='0' THEN 'Not Uploaded' ELSE 'Uploaded' END) as vendor_license,vendor_license_no,CONCAT('$imgt_dir',vendor_profile) as vendor_profile,CONCAT('$target_dir',vendor_license_document) as vendor_license_document";
                $params["whereCondition"]    =   "vendor_mobile LIKE '".$mobile."'";
                //$this->queryVendor($params);echo $this->db->last_query();exit;
                $vsp    =   $this->queryVendor($params)->row_array();
                if(isset($vsp)){
                    return $vsp;
                }
                return array();
        }
        public function checkUser($columns,$value){
                $params["whereCondition"]    =   "$columns LIKE '".$value."'";
                $vsp    =   $this->queryVendor($params)->row_array();
                if(isset($vsp)){
                    if(count($vsp) > 0){
                        return TRUE;
                    }
                }
                return FALSE;
        }
        public function checkvendorverified(){
            $vsp        =   $this->vendor_model->checkUser("vd.vendor_verified","1");
            if($vsp){  
                return TRUE;
            }
            return FALSE; 
        } 
        public function cntviewvendors($params  =    array()){
                $params["cnt"]      =   "1"; 
                $val    =   $this->queryvendor($params)->row_array();
                if(isset($val)){
                    if(count($val) > 0){
                        return  $val['cnt'];
                    }
                }
                return "0";
        }
        public function viewVendors($params = array()){
    //            $this->queryvendorcategory($params);echo $this->db->last_query();exit;
                return $this->queryvendor($params)->result_array();
        }
        public function checkvendor_license(){ 
            $vsp        =   $this->vendor_model->checkUser("vd.vendor_license","1");
            if($vsp){  
                return TRUE;
            }
            return FALSE; 
        }  
        public function checkmobilestatus(){
            $mobile     =   $this->input->post("vendor_mobile");
            $vsp        =   $this->vendor_model->checkUser("vd.vendor_mobile",$mobile);
            if($vsp){  
                return TRUE;
            }
            return FALSE; 
        }  
        public function create_vendor(){
            $address    =   $this->input->post("vendor_address");
            $mobile     =   $this->input->post("vendor_mobile");
            $dta    =   array( 
                            "vendor_id"         =>  "VEND".$this->common_model->get_max("vendorid","vendor"),
                            "vendor_mobile"     =>  $mobile,
                            "vendor_name"       =>  $this->input->post("vendor_name"),
                            "vendor_state"      =>  $this->input->post("vendor_state"),
                            "vendor_district"   =>  $this->input->post("vendor_district"),
                            "vendor_gender"     =>  $this->input->post("vendor_gender"),
                            "vendor_email_id"   =>  $this->input->post("vendor_email_id"),
                            "vendor_dob"        =>  date("Y-m-d",strtotime($this->input->post("vendor_dob"))),
                            "vendor_mandal"     =>  $this->input->post("vendor_mandal"),
                            "vendor_gramapanchayat"   =>  $this->input->post("vendor_gramapanchayat"),
                            "vendor_pincode"     =>  $this->input->post("vendor_pincode"),
                            "vendor_storename"   => ucwords($this->input->post("vendor_storename")),
                            "vendor_date"        =>  date("Y-m-d"), 
                            "vendor_address"     =>  $address,
                        );
                $vsp    =   $this->randomstring->getLatLong($address);
                if(count($vsp) > 0){
                    $dta["vendor_latitude"]     =   $vsp['latitude'];
                    $dta["vendor_longitude"]    =   $vsp['longitude'];
                }
                if(count($_FILES) > 0){
                    if($_FILES["vendor_profile"]["name"] != "" && $_FILES["vendor_profile"]["name"] != "noname"){ 
                        $target_dir =   $this->config->item("uploads_path")."products/";   
                        $tmpFilePath    =   $_FILES['vendor_profile']['tmp_name'];
                        $fname          =   $_FILES['vendor_profile']['name'];
                        $vsp        =   explode(".",$fname);
                        if(count($vsp) > 1){
                            $j  =   count($vsp)-1;
                            $fname      =   $mobile.".".$vsp[$j];
                        }
                        $uploadfile =   $target_dir . basename($fname);
                        move_uploaded_file($tmpFilePath, $uploadfile);   
                        $dta['vendor_profile']  =   $fname; 
                    }  
                }
                $this->db->insert("vendor",$dta); 
                if($this->db->insert_id() > 0){
                    return TRUE;
                }
                return FALSE;
        }        
        public function vendor_license(){ 
            $dta        =   array( 
                            "vendor_license"        =>  "1",
                            "vendor_license_no"     =>  $this->input->post("vendor_license_no"),
                            "vendor_license_name"   =>  $this->input->post("vendor_license_name"),
                            "vendor_modified_on"    =>  date("Y-m-d H:i:s")
                        ); 
            if(count($_FILES) > 0){
                $target_dir =   $this->config->item("uploads_path")."vendor-uploads/";
                $fname      =   $_FILES["vendor_license_document"]["name"];
                if($fname != "noname"){
                    $vsp        =   explode(".",$fname);
                    $fname      =   "LICE_".$this->input->post("vendor_mobile").".".$vsp['1'];
                    $uploadfile =   $target_dir . basename($fname);
                    $vsp 	=	move_uploaded_file($_FILES['vendor_license_document']['tmp_name'], $uploadfile); 
                    if($vsp){
                        $dta['vendor_license_document'] =   $fname;
                    }
                }
            }
            $this->db->update("vendor",$dta,array("vendor_mobile" => $this->input->post("vendor_mobile")));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
        }
        public function vendor_category(){
                $imgpth    =   $this->config->item("upload_url")."category/";
                $params["group_by"]         =   "vendorproduct_category";
                $params["columns"]          =   "sn.category_name,sn.category_id,(CONCAT('$imgpth',category_upload)) as category_upload";
                $params["whereCondition"]   =   'vd.vendor_mobile LIKE "'.$this->input->post("vendor_mobile").'"';
                $vsp    =   $this->queryvendorproducts($params)->result();
                return $vsp;
        }
        public function vendor_subcategory(){ 
                $imgpth    =   $this->config->item("upload_url")."category/";
                $params["group_by"]         =   "vendorproduct_subcategory";
                $params["columns"]          =   "sv.subcategory_name,sv.subcategory_id,(CONCAT('$imgpth',subcategory_upload)) as subcategory_upload";
                $params["whereCondition"]   =   'vd.vendor_mobile LIKE "'.$this->input->post("vendor_mobile").'" AND vendorproduct_category LIKE "'.$this->input->post("category").'"';
                $vsp    =   $this->queryvendorproducts($params)->result();
                return $vsp;
        }
        public function queryvendorimages($params = array()){
                $sel    =   "*";
                if(array_key_exists("columns", $params)){
                        $sel    =   $params["columns"];
                }
                if(array_key_exists("cnt", $params)){
                        $sel    =   "count(*) as cnt";
                } 
                $dta    =   array(
                    "pd.product_open"   =>  "1",
                    "pd.product_status" =>  "1",
                    "vd.vendor_open"    =>  "1",
                    "vd.vendor_status"  =>  "1",
                    "vp.vendorproduct_open"  =>  "1",
                    "vp.vendorproduct_status"  =>  "1",
                    //"mhd.measure_status"  =>  "1",
                    //"mhd.measure_open"  =>  "1"
                    "vimp.vendorproductimg_open" =>1
                );
                $this->db->select("$sel")
                        ->from("vendorproduct_images as vimp")
                        ->join("vendor_products as vp","vp.vendorproduct_id = vimp.vendorproduct_productid","INNER") 
                        //->join("measures as  mhd","mhd.measure_id = vp.vendorproduct_measure","INNER") 
                        ->join("products as  pd","pd.product_id = vp.vendorproduct_product","INNER") 
                        //->join("category as sn","sn.category_id = vp.vendorproduct_category","INNER")  
                        //->join("sub_category as sv","sv.subcategory_id = vp.vendorproduct_subcategory","INNER")  
                        ->join("vendor as  vd","vd.vendor_id = vp.vendorproduct_vendor_id","INNER") 
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(vendor_mobile LIKE '%".$params["keywords"]."%')");
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
        public function view_category(){
                $imgpth    =   $this->config->item("upload_url")."category/";
                $params["columns"]          =   "category_id,category_name,(CONCAT('$imgpth',category_upload)) as category_upload"; 
                $vsp    =   $this->category_model->viewCategory($params);
                return $vsp;
        }
        public function view_subcategory(){ 
                if($this->input->post("category") != ""){
                    $params["where_condition"]          =   "category_id LIKE '".$this->input->post("category")."'"; 
                }
                if($this->input->post("subcategory") != ""){
                    $params["where_condition"]          =   "subcategory_id LIKE '".$this->input->post("subcategory")."'"; 
                }
                $imgpth    =   $this->config->item("upload_url")."category/";
                $params["tiporderby"]   =   "subcategory_name";
                $params["order_by"]     =   "ASC";
                $params["columns"]      =   "subcategory_id,subcategory_name,(CONCAT('$imgpth',subcategory_upload)) as subcategory_upload"; 
                $vsp    =   $this->category_model->viewsub_categories($params);
                //print_r($vsp);exit;
                return $vsp;
        }
        public function queryvendorcategory($params = array()){
                $sel    =   "*";
                if(array_key_exists("columns", $params)){
                        $sel    =   $params["columns"];
                }
                if(array_key_exists("cnt", $params)){
                        $sel    =   "count(*) as cnt";
                }
                if(array_key_exists("join_condition", $params)){
                        $join    =   $params["join_condition"];
                }
                $dta    =   array( 
                    "cdt.category_open"  =>  "1",
                    "cdt.category_status"  =>  "1"
                );
                $this->db->select("$sel")
                        ->from("category as cdt")
                        ->join("vendor_category as vt","vt.vendorcategory_categoryid = cdt.category_id","LEFT")
                        ->join("vendor as  vd","vd.vendor_id = vt.vendorcategory_vendor_id $join","LEFT") 
                        ->join("countries as  ct","ct.country_id = vd.vendor_country","LEFT") 
                        ->join("state as st","st.state_id = vd.vendor_state","LEFT") 
                        ->join("district as  dt","dt.district_id = vd.vendor_district","LEFT")  
                        ->join("mandal as md","md.mandal_id = vd.vendor_mandal","LEFT")  
                        ->join("gram_panchayat as gm","gm.gram_panchayat_id = vd.vendor_gramapanchayat","LEFT")  
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(vendor_mobile LIKE '%".$params["keywords"]."%')");
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
        public function update_profile($mobile){
            $address    =   $this->input->post("vendor_address");
            $dta    =   array( 
                            "vendor_name"       =>  $this->input->post("vendor_name"),
                            "vendor_state"      =>  $this->input->post("vendor_state"),
                            "vendor_district"   =>  $this->input->post("vendor_district"),
                            "vendor_gender"     =>  $this->input->post("vendor_gender"),
                            "vendor_email_id"   =>  $this->input->post("vendor_email_id"),
                            "vendor_dob"        =>  date("Y-m-d",strtotime($this->input->post("vendor_dob"))),
                            "vendor_mandal"     =>  $this->input->post("vendor_mandal"),
                            "vendor_gramapanchayat"   =>  $this->input->post("vendor_gramapanchayat"),
                            "vendor_pincode"     =>  $this->input->post("vendor_pincode"),
                            "vendor_storename"   => ucwords($this->input->post("vendor_storename")),
                            "vendor_date"        =>  date("Y-m-d"), 
                            "vendor_address"     =>  $address,
                            "vendor_modified_on"    =>  date("Y-m-d H:i:s")
                        );
            $vsp    =   $this->randomstring->getLatLong($address);
            if(count($vsp) > 0){
                $dta["vendor_latitude"]     =   $vsp['latitude'];
                $dta["vendor_longitude"]    =   $vsp['longitude'];
            }
            if(count($_FILES) > 0){
                if($_FILES["vendor_profile"]["name"] != "" && $_FILES["vendor_profile"]["name"] != "noname"){ 
                    $target_dir =   $this->config->item("uploads_path")."products/";   
                    $tmpFilePath    =   $_FILES['vendor_profile']['tmp_name'];
                    $fname          =   $_FILES['vendor_profile']['name'];
                    $vsp        =   explode(".",$fname);
                    if(count($vsp) > 1){
                        $j  =   count($vsp)-1;
                        $fname      =   $mobile.".".$vsp[$j];
                    }
                    $uploadfile =   $target_dir . basename($fname);
                    move_uploaded_file($tmpFilePath, $uploadfile);   
                    $dta['vendor_profile']  =   $fname; 
                }  
            }
            $this->db->update("vendor",$dta,array("vendor_mobile" =>  $mobile));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
        }
        public function view_measures(){ 
                $params["columns"]          =   "measure_id,measure_unit"; 
                $vsp    =   $this->measure_model->viewMeasure($params);
                return $vsp;
        }
        public function view_products(){ 
                if($this->input->post("keywords") != ""){
                    $params["keywords"]         =   $this->input->post("keywords"); 
                }
                $params["columns"]          =   "product_id,product_name"; 
                $vsp    =   $this->product_model->viewProduct($params);
                return $vsp;
        }
        public function queryvendorproducts($params = array()){
                $sel    =   "*";
                $join   =   "";
                if(array_key_exists("columns", $params)){
                        $sel    =   $params["columns"];
                }
                if(array_key_exists("cnt", $params)){
                        $sel    =   "count(*) as cnt";
                }
                if(array_key_exists("join_condition", $params)){
                        $join    =   $params["join_condition"];
                }
                if(isset($params["condition"])){
                    $dta= array();
                }else{
                    $dta    =   array(
                        "pd.product_open"   =>  "1",
                        "pd.product_status" =>  "1",
                        "vd.vendor_open"    =>  "1",
                        "vd.vendor_status"  =>  "1",
                        "vp.vendorproduct_open"  =>  "1",
                        "vp.vendorproduct_status"  =>  "1",
                        /*"mhd.measure_status"  =>  "1",
                        "mhd.measure_open"  =>  "1"*/
                    );
                }
                $this->db->select("$sel")
                        ->from("vendor_products as vp") 
                        ->join("vendor_product_princes as vpp","vp.vendorproduct_id = vpp.vendorproductids","LEFT")
                        ->join("measures as mhd","mhd.measure_id = vpp.vendorproduct_bb_measure","LEFT")
                        ->join("product_Ingredients as pi","vpp.vendor_ingredientslist = pi.prodind","LEFT")
                        ->join("products as  pd","pd.product_id = vp.vendorproduct_product","LEFT")
                        ->join("category as sn","sn.category_id = vp.vendorproduct_category","LEFT")
                        ->join("sub_category as sv","sv.subcategory_id = vp.vendorproduct_subcategory","LEFT")  
                        ->join("vendor as  vd","vd.vendor_id = vp.vendorproduct_vendor_id","LEFT")
                        ->join("(SELECT * FROM vendorproduct_images  WHERE vendorproductimg_open = '1' AND  vendorproductimg_status = '1' GROUP BY vendorproduct_productid) as vimp","vp.vendorproduct_id = vimp.vendorproduct_productid","LEFT")
                        //->join("countries as  ct","ct.country_id = vd.vendor_country","LEFT") 
                        //->join("state as st","st.state_id = vd.vendor_state","LEFT") 
                        //->join("district as  dt","dt.district_id = vd.vendor_district","LEFT")  
                        //->join("mandal as md","md.mandal_id = vd.vendor_mandal","LEFT")  
                        //->join("gram_panchayat as gm","gm.gram_panchayat_id = vd.vendor_gramapanchayat","LEFT")  
                        ->join("wishlist as ws","ws.wishlist_vendor_productid = vp.vendorproduct_id AND ws.wishlist_open = '1' AND ws.wishlist_status = '1'","LEFT")
                        ->join("customers as cs","cs.customer_id = ws.wishlist_customer_id AND cs.customer_open = '1' AND cs.customer_status = '1' $join","LEFT")
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(vendor_mobile LIKE '%".$params["keywords"]."%' OR product_name LIKE '%".$params["keywords"]."%' OR category_name LIKE '%".$params["keywords"]."%' OR subcategory_name LIKE '%".$params["keywords"]."%')");
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
               // $this->db->get();echo $this->db->last_query();exit;
                return $this->db->get();
        }
        public function cntviewVendorproducts($params  =    array()){
                $params["cnt"]      =   "1"; 
                $val    =   $this->queryvendorproducts($params)->row_array();
                if(isset($val)){
                    return  $val['cnt'];
                }
                return "0";
        }
        public function viewVendorproduct($params = array()){
                $params["tipoOrderby"]   =   "vp.vendorproductid";
                $params["order_by"]     =   "DESC";
                $params["limit"]        =   "5";
                $params["group_by"]     =   "vp.vendorproduct_id";
                return $this->queryvendorproducts($params)->result();
        } 
        public function viewVendorproducts($params = array()){
                return $this->queryvendorproducts($params)->result();
        } 
         
        public function get_Vendorproducts($uri){ 
            $params["whereCondition"]   =   "(subcategory_keywords) LIKE '".($uri)."'";
            return $this->queryvendorproducts($params)->result_array();
//            $this->queryvendorproducts($params);echo $this->db->last_query();exit;
        } 
        public function getVendorproduct($params = array()){
            return $this->queryvendorproducts($params)->row_array();
        }  
        public function cntviewVendorproductimages($params  =    array()){
                $params["cnt"]      =   "1"; 
                $val    =   $this->queryvendorimages($params)->row_array();
                if(isset($val)){
                    return  $val['cnt'];
                }
                return "0";
        }
        public function viewVendorproductimages($params = array()){
                return $this->queryvendorimages($params)->result();
        }
        public function viewVendorproductprices($params = array()){
                return $this->queryvendorprices($params)->result();
        }
        public function getVendorproductprices($params = array()){
                return $this->queryvendorprices($params)->row_array();
        } 
        public function cntviewvendorprices($params  =    array()){
                $params["cnt"]      =   "1"; 
                $val    =   $this->queryvendorprices($params)->row_array();
                if(isset($val)){
                    return  $val['cnt'];
                }
                return "0";
        }
        public function getVendorproductimages($params = array()){
            return $this->queryvendorimages($params)->row_array();
        }  
        public function product_create(){
            //echo '<pre>';print_r($this->input->post());exit;
            $tvi    =   $this->view_profile($this->input->post("vendor_mobile"));
            $vendor =   (isset($tvi) && count($tvi) > 0)?$tvi['vendor_id']:$this->session->userdata("login_id");
            // $prname =   trim($this->input->post("vendorproduct_product"));
            $prname =    $this->common_config->RemoveSpecialChar($this->input->post("vendorproduct_product"));
            $pri    =   $this->product_model->get_product(ucwords($prname));
            if(empty($pri)){
                $thvp   =   $this->create_product();
                $pri    =   $this->product_model->get_product(ucwords($prname)); 
            }
            // $pri    =   $this->product_model->get_product($this->input->post("product_name"));
            // if(empty($pri)){
            //     $thvp   =   $this->create_product();
            //     $pri    =   $this->product_model->get_product($this->input->post("vendorproduct_product")); 
            // }
            $caat =($this->input->post('cat'))?implode(',',$this->input->post('cat')):'';
            $scaat  =($this->input->post('Prod'))?implode(',',$this->input->post('Prod')):'';
                    $dta    =  $ddta   =   array(
                            "vendorproduct_vendor_id"   =>  $vendor,
                            "vendorproduct_product"     =>  $pri['product_id'],
                            "vendorproduct_description" =>  $this->input->post("vendorproduct_description"),
                            "vendorproduct_model"       =>  ucwords(trim($this->input->post("vendorproduct_model"))),
                            "vendorproduct_brand"       =>  ucwords(trim($this->input->post("vendorproduct_brand"))),
                            "vendorproduct_shipping"    =>  $this->input->post("vendorproduct_shipping"),
                            "vendorproduct_tax_class"   =>  $this->input->post("vendorproduct_tax_class"),
                            "vendorproduct_descc"       =>  ($this->input->post('vendorproduct_descc'))??'',
                            "vendorproduct_category"    =>  $this->input->post("category"),
                            "vendorproduct_event_id"    =>  ($this->input->post("event"))?implode(',',$this->input->post("event")):'',
                            "vendorproduct_catmap_cat_id"   =>  $caat.",",
                            "vendorproduct_catmap_scat_id"  =>  $scaat.",",
                            "vendorproduct_subcategory" =>  ($this->input->post("sub_category")!="")?$this->input->post("sub_category"):'',
                            "photo_upload"              =>  ($this->input->post("photo_upload")!="")?$this->input->post("photo_upload"):'0',
                            "vendorproduct_out_stock"   =>  ($this->input->post("out_stock")!="")?$this->input->post("out_stock"):'0',
                            "vendorproduct_created_on"  =>  date("Y-m-d H:i:s"), 
                            "vendorproduct_created_by"  =>  $vendor,
                        );
                        //print_r($dta);exit;
                        $this->db->insert("vendor_products",$dta);
                        $vsp    =   $this->db->insert_id(); 
                        $uniq   =   "VEPR". str_pad($vsp, 6, "0", STR_PAD_LEFT); 
                        $venid  =   "VPRD".$vsp;
                        $dtav   =   array(
                            "vendorproduct_id"      =>  $venid,
                            "vendorproduct_code"    =>  $uniq
                        );
                        $this->db->update("vendor_products",$dtav,array("vendorproductid" => $vsp));
                        if(count($_FILES) > 0){
                            $vsp    =   $this->productpload($venid,$vendor);
                        }
                        if(!empty($this->input->post('vendorproduct_bb_quantity'))){
                            $vsp    =   $this->vendorpricesadding($venid,$vendor);
                        }
                        /*$quantity   = $this->input->post('vendorproduct_bb_quantity');
                        $ingrediant =   $this->input->post('vendor_ingredientslist');
                        $price      =   $this->input->post('vendorproduct_bb_price');
                        $mrp        =   $this->input->post('vendorproduct_bb_mrp');
                        $measure        =   $this->input->post('vendorproduct_bb_measure');
                        if(!empty($quantity)){$i=0;
                            foreach($quantity as $q){
                                $dta    =   array(
                                    "vendorid"                      =>    $vendor,
                                    "vendorproductids"              =>    $venid,
                                    "vendor_ingredientslist"        =>    ($ingrediant[$i])??'',
                                    "vendorproduct_bb_quantity"     =>    $q,
                                    "vendorproduct_bb_price"        =>    ($price[$i])??'', 
                                    "vendorproduct_bb_mrp"          =>    ($mrp[$i])??'',
                                    "vendorproduct_bb_measure"      =>    ($measure[$i])??'',
                                    "vendorproductprice_created_by" =>    $vendor,
                                    "vendorproductprice_created_on" =>   date("Y-m-d H:i:s")
                                );
                                $this->db->insert("vendor_product_princes",$dta);
                                $vsp   =    $this->db->insert_id();
                                
                                if($vsp > 0){
                        	    	$dat=array("vendorproductprinceid" 	=> "VENPRICE".$vsp );		
                                    $this->db->update("vendor_product_princes",$dat,"vendorproductprince_id='".$vsp."'");	
                                }
                                $i++;
                            }
                        }*/
                /*if($this->input->post("vendorproduct_bb_quantity") != ""){
                    $dta["vendorproduct_quantity"]  =   $this->input->post("vendorproduct_bb_quantity"); 
                    $dta["vendorproduct_price"]     =   $this->input->post("vendorproduct_bb_price");
                    $dta["vendorproduct_mrp"]       =   $this->input->post("vendorproduct_bb_mrp");
                    $dta["vendorproduct_bbtype"]    =   "BB";
                    $dta["vendorproduct_measure"]   =   $this->input->post("vendorproduct_bb_measure");
                    $this->db->insert("vendor_products",$dta);
                    $vsp    =   $this->db->insert_id(); 
                    $uniq   =   "VEPR". str_pad($vsp, 6, "0", STR_PAD_LEFT); 
                    $venid  =   "VPRD".$vsp;
                    $dtav   =   array(
                        "vendorproduct_id"      =>  $venid,
                        "vendorproduct_code"    =>  $uniq
                    );
                    $this->db->update("vendor_products",$dtav,array("vendorproductid" => $vsp));
                    if(count($_FILES) > 0){
                        $vsp    =   $this->productpload($venid,$vendor);
                    }
                }
                if($this->input->post("vendorproduct_bc_quantity") != ""){
                    $vensid  =   "VPRD".$this->common_model->get_max("vendorproductid","vendor_products");
                    $ddta["vendorproduct_id"]        =   $venid;
                    $ddta["vendorproduct_quantity"]  =   $this->input->post("vendorproduct_bc_quantity"); 
                    $ddta["vendorproduct_price"]     =   $this->input->post("vendorproduct_bc_price");
                    $ddta["vendorproduct_mrp"]       =   $this->input->post("vendorproduct_bc_mrp");
                    $ddta["vendorproduct_bbtype"]    =   "BC";
                    $ddta["vendorproduct_measure"]   =   $this->input->post("vendorproduct_bc_measure");
                    $this->db->insert("vendor_products",$ddta);
                    $vssp    =   $this->db->insert_id();   
                    $suniq   =   "VEPR". str_pad($vssp, 6, "0", STR_PAD_LEFT); 
                    $vensid  =   "VPRD".$vssp;
                    $dtav   =   array(
                        "vendorproduct_id"      =>  $vensid,
                        "vendorproduct_code"    =>  $suniq
                    );
                    $this->db->update("vendor_products",$dtav,array("vendorproductid" => $vssp));
                    if(count($_FILES) > 0){
                        $vsp    =   $this->productpload($vensid,$vendor);
                    }
                }*/
                if($this->db->affected_rows() > 0){
                    return TRUE;
                }
                return FALSE; 
        }
        public function vendorpricesadding($venid,$vendor){
            if($this->input->post('vendorproduct_bb_prices') !=""){
                $dat =array(
                    'vendorid'                      => $vendor,
                    'vendorproductids'              => $venid,
                    'vendorproduct_bb_price'        => $this->input->post('vendorproduct_bb_prices'),
                    'vendorproduct_bb_mrp'          => $this->input->post('vendorproduct_bb_mrps'),
                    'vendorproductprice_created_by' => $vendor,
                    'vendorproductprice_created_on' => date('Y-m-d H:i:s')
                );
                $this->db->insert('vendor_product_princes',$dat);
                $id = $this->db->insert_id();
                if($id > 0){
                    $dats = array('vendorproductprinceid' => 'VENPRICE'.$id);
                    return $this->db->where('vendorproductprince_id',$id)->update('vendor_product_princes',$dats);
                }
            }else if($this->input->post('vendorproduct_bb_price') !=""){
                $quantity           = ($this->input->post('vendorproduct_bb_quantity') !="")?$this->input->post('vendorproduct_bb_quantity'):'';
                if(is_array($quantity) && count($quantity) > 0){
                    $quant = $quantity;
                }else{
                    $quant='';
                }
                $ingredientslist    = ($this->input->post('vendor_ingredientslist') !="")?$this->input->post('vendor_ingredientslist'):'';
                if(is_array($ingredientslist) && count($ingredientslist) > 0){
                    $insd = $ingredientslist;
                }else{
                    $insd='';
                }
                $price              = $this->input->post('vendorproduct_bb_price');
                $mrp                = $this->input->post('vendorproduct_bb_mrp');
                $measure            = ($this->input->post('vendorproduct_bb_measure') !="")?$this->input->post('vendorproduct_bb_measure'):'';
                
                if(count($price) > 0){
                    $i=0;
                    foreach($price as $prince){
                        $dat =array(
                            'vendorid'                      => $vendor,
                            'vendorproductids'              => $venid,
                            'vendorproduct_bb_quantity'     => $quant[$i],
                            'vendor_ingredientslist'        => $insd[$i],
                            'vendorproduct_bb_price'        => $price[$i],
                            'vendorproduct_bb_mrp'          => $mrp[$i],
                            'vendorproduct_bb_measure'      => isset($measure[$i])?$measure[$i]:'',
                            'vendorproductprice_created_by' => $vendor,
                            'vendorproductprice_created_on' => date('Y-m-d H:i:s')
                        );
                        //echo '<pre>';print_r($dat);exit;
                        $this->db->insert('vendor_product_princes',$dat);
                        $id = $this->db->insert_id();
                        if($id > 0){
                            $dats = array('vendorproductprinceid' => 'VENPRICE'.$id);
                            $this->db->where('vendorproductprince_id',$id)->update('vendor_product_princes',$dats);
                        }
                        $i++;
                    }
                }
            }
        }
        public function create_product(){
            $prname =    $this->common_config->RemoveSpecialChar($this->input->post("vendorproduct_product"));
            $dta    =   array(
                "product_id"     =>    "PRD".$this->common_model->get_max("productid","products"),
                "product_name"   =>     ucwords($prname),
                "product_keywords"    =>     str_replace(" ","_",strtolower($prname)),
                "product_created_on"  =>    date("Y-m-d H:i:s"),
                "product_created_by"  =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):""
            );
            $this->db->insert("products",$dta);
            if($this->db->insert_id() > 0){
                return TRUE;
            }
            return FALSE;
        }
        public function productpload($venid,$vendor){
            if($_FILES["product_upload"]["name"] != "" && $_FILES["product_upload"]["name"] != "noname"){
                $total = count($_FILES['product_upload']['name']);
                $target_dir =   $this->config->item("uploads_path")."products/"; 
                for( $i=0 ; $i < $total ; $i++ ) { 
                    $tmpFilePath = ($total > 0)?$_FILES['product_upload']['tmp_name'][$i]:$_FILES['product_upload']['tmp_name']; 
                    if ($tmpFilePath != ""){  
                        $fname      =   ($total > 0)?$_FILES['product_upload']['name'][$i]:$_FILES['product_upload']['name'];
                        $vsp        =   explode(".",$fname);
                        if(count($vsp) > 1){
                            $j =    count($vsp)-1;
                            $fname      =   time()."_".$i.".".$vsp[$j];
                        }
                        $uploadfile =   $target_dir . basename($fname);
                        move_uploaded_file($tmpFilePath, $uploadfile);  
                        $vednid  =   "VIMG".$this->common_model->get_max("vendorproductimgid","vendorproduct_images");
                        $dta    =   array(  
                            "vendorproductimg_id"           =>  $vednid,
                            "vendorproduct_productid"       =>  $venid,
                            "vendorproductimg_name"         =>  $fname,
                            "vendorproductimg_created_on"   =>  date("Y-m-d H:i:s"), 
                            "vendorproductimg_created_by"   =>  $vendor,
                        );
                        $this->db->insert("vendorproduct_images",$dta);  
                    }
                }
                return TRUE;
            }
            return FALSE;
        } 
        public function product_view(){ 
            $target_dir =   $this->config->item("upload_url")."products/"; 
            $params["columns"]          =   "vp.*,product_name,(CONCAT('$target_dir',vendorproductimg_name)) as vendorproductimg_name";
            $msg    =   "";
            if($this->input->post("product") != ""){
                $msg   =   "vp.vendorproduct_product LIKE '".$this->input->post("product")."' AND ";  
            }
            if($this->input->post("category") != ""){
                $msg   =   "vp.vendorproduct_category LIKE '".$this->input->post("category")."' AND ";  
            }
            if($this->input->post("subcategory") != ""){
                $msg   =   "vp.vendorproduct_subcategory LIKE '".$this->input->post("subcategory")."' AND ";  
            }
            $params["whereCondition"]          =   "$msg vendor_mobile LIKE '".$this->input->post("vendor_mobile")."'";
             //   $this->viewVendorproducts($params);echo $this->db->last_query();exit;
            return $this->viewVendorproducts($params);
        }
        public function getVendorproductview($vendorproduct_id){ 
            $params["whereCondition"]          =   "vendorproduct_id LIKE '".$vendorproduct_id."'";
            $vps    =   $this->getVendorproduct($params);
            if(isset($vps)){
                if(count($vps) > 0){
                    return TRUE;
                }
            }
            return FALSE;
        }
        public function product_update($vendorproduct_id) {
            //echo '<pre>';print_r($this->input->post());exit;
            $tvi    =   $this->view_profile($this->input->post("vendor_mobile"));
            $vendor =   isset($tvi)?$tvi['vendor_id']:""; 
            $pri    =   $this->product_model->get_product($this->common_config->RemoveSpecialChar($this->input->post("vendorproduct_product")));  
            if(empty($pri)){
                $thvp   =   $this->product_model->create_product();
                $pri    =   $this->product_model->get_product($this->input->post("vendorproduct_product")); 
            }
            $caat =($this->input->post('cat'))?implode(',',$this->input->post('cat')):'';
            $scaat  =($this->input->post('Prod'))?implode(',',$this->input->post('Prod')):'';
            $dta    =  array(
                        "vendorproduct_product"     => $pri['product_id'],
                        "vendorproduct_description" => $this->input->post("vendorproduct_description"),
                        "vendorproduct_model"       => ucwords(trim($this->input->post("vendorproduct_model"))),
                        "vendorproduct_brand"       => ucwords(trim($this->input->post("vendorproduct_brand"))), 
                        "vendorproduct_shipping"    => $this->input->post("vendorproduct_shipping"),
                        "vendorproduct_tax_class"   => $this->input->post("vendorproduct_tax_class"),
                        "vendorproduct_category"    => $this->input->post("category"),
                        "vendorproduct_subcategory" => $this->input->post("sub_category"),
                        // "vendorproduct_event_id"    =>  ($this->input->post("event"))?implode(',',$this->input->post("event")):'',
                        "vendorproduct_catmap_cat_id"   =>  $caat.",",
                        "vendorproduct_catmap_scat_id"  =>  $scaat.",",
                        "vendorproduct_modified_on" => date("Y-m-d H:i:s"), 
                        "vendorproduct_descc"       => $this->input->post('vendorproduct_descc'), 
                        "vendorproduct_modified_by" => $vendor, 
                        "vendorproduct_quantity"    => $this->input->post("vendorproduct_quantity"),
                        "vendorproduct_price"       => $this->input->post("vendorproduct_price"),
                        "vendorproduct_mrp"         => $this->input->post("vendorproduct_mrp"),
                        "vendorproduct_measure"     => $this->input->post("vendorproduct_measure"),
                        "photo_upload"              =>  ($this->input->post("photo_upload")!="")?$this->input->post("photo_upload"):'0',
                        "vendorproduct_out_stock"   =>  ($this->input->post("out_stock")!="")?$this->input->post("out_stock"):'0',
                        "vendorproduct_modified_on" => date("Y-m-d H:i:s"), 
                        "vendorproduct_modified_by" => $vendor,
                    ); 
            $this->db->update("vendor_products",$dta,array("vendorproduct_id" => $vendorproduct_id));   
            if($this->db->affected_rows() > 0){
                if(count($_FILES) > 0){
                    $vsp    =   $this->productpload($vendorproduct_id,$vendor);
                }
                if($this->input->post('vendorproduct_bb_price') !=""){
                    $i=0;
                    foreach($this->input->post('vendorproduct_bb_price') as $p){
                        if($this->input->post('vendorproductprinceid')[$i] !=""){
                            $psms["whereCondition"]    =   "vendorproductprinceid = '".$this->input->post('vendorproductprinceid')[$i]."'";
                            $vue = $this->getVendorproductprices($psms);
                            //echo '<pre>';print_r($vue);exit;
                            if(is_array($vue) && count($vue) >0){
                                $dat =array(
                                    'vendorproduct_bb_price'          => $this->input->post('vendorproduct_bb_price')[$i],
                                    'vendorproduct_bb_mrp'            => $this->input->post('vendorproduct_bb_mrp')[$i],
                                    'vendor_ingredientslist'          => ($this->input->post('vendor_ingredientslist')[$i] != "")?$this->input->post('vendor_ingredientslist')[$i]:'',
                                    'vendorproduct_bb_quantity'       => ($this->input->post('vendorproduct_bb_quantity')[$i] !="")?$this->input->post('vendorproduct_bb_quantity')[$i]:'',
                                    'vendorproduct_bb_measure'        => ($this->input->post('vendorproduct_bb_measure')[$i]!="")?$this->input->post('vendorproduct_bb_measure')[$i]:'',
                                    'vendorproductprince_modified_by' => $vendor,
                                    'vendorproductprince_modified_on' => date('Y-m-d H:i:s')
                                );
                                //print_r($dat);exit;
                                $this->db->update('vendor_product_princes',$dat,array("vendorproductprinceid" => $this->input->post('vendorproductprinceid')[$i])); 
                                $i++;
                            }
                        }else{
                             $dat =array(
                                'vendorid'                        => $vendor,
                                'vendorproductids'                => $vendorproduct_id,
                                'vendorproduct_bb_price'          => $this->input->post('vendorproduct_bb_price')[$i],
                                'vendorproduct_bb_mrp'            => $this->input->post('vendorproduct_bb_mrp')[$i],
                                'vendor_ingredientslist'          => ($this->input->post('vendor_ingredientslist')[$i] != "")?$this->input->post('vendor_ingredientslist')[$i]:'',
                                'vendorproduct_bb_quantity'       => ($this->input->post('vendorproduct_bb_quantity')[$i] !="")?$this->input->post('vendorproduct_bb_quantity')[$i]:'',
                                'vendorproduct_bb_measure'        => ($this->input->post('vendorproduct_bb_measure')[$i]!="")?$this->input->post('vendorproduct_bb_measure')[$i]:'',
                                'vendorproductprice_created_by'   => $vendor,
                                'vendorproductprice_created_on'   => date('Y-m-d H:i:s')
                            );
                            //print_r($dat);exit;
                            $this->db->insert('vendor_product_princes',$dat);
                            $id = $this->db->insert_id();
                            if($id > 0){
                                $dats = array('vendorproductprinceid' => 'VENPRICE'.$id);
                                $this->db->where('vendorproductprince_id',$id)->update('vendor_product_princes',$dats);
                            }
                        }
                    }
                }
                return TRUE;
            }
            return FALSE; 
        }
        public function product_delete($vendorproduct_id){
            if($this->input->post("vendor_mobile") != ""){
                $tvi    =   $this->view_profile($this->input->post("vendor_mobile"));
            }else{
                $tvi    =   $this->view_profile($this->session->userdata("otpmobileno"));
            }
            $vendor =   ($tvi['vendor_id'])??'';
            $dta    =  array(   
                        "vendorproduct_open"           =>  "0",
                        "vendorproduct_modified_on"    =>  date("Y-m-d H:i:s"), 
                        "vendorproduct_modified_by"    =>  $vendor
                    ); 
            $this->db->update("vendor_products",$dta,array("vendorproduct_id" => $vendorproduct_id));  
            $sdta    =  array(   
                        "vendorproductimg_open"           =>  "0",
                        "vendorproductimg_modified_on"    =>  date("Y-m-d H:i:s"), 
                        "vendorproductimg_modified_by"    =>  $vendor
                    ); 
            $this->db->update("vendorproduct_images",$sdta,array("vendorproduct_productid" => $vendorproduct_id)); 
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE; 
        }
        public function ajaxActivestatus($vendorproduct_id,$status){
            if($this->input->post("vendor_mobile") != ""){
                $tvi    =   $this->view_profile($this->input->post("vendor_mobile"));
            }else{
                $tvi    =   $this->view_profile($this->session->userdata("otpmobileno"));
            }
            $vendor =   isset($tvi)?$tvi['vendor_id']:"";
            $dta    =  array(   
                        "vendorproduct_acde"           =>  $status,
                        "vendorproduct_modified_on"    =>  date("Y-m-d H:i:s"), 
                        "vendorproduct_modified_by"    =>  $vendor
                    ); 
            $this->db->update("vendor_products",$dta,array("vendorproduct_id" => $vendorproduct_id));   
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE; 
        }
        public function view_orders($params = array()){ 
//            $params["group_by"]   =   "vendor_id,customer_id";
            $params["group_by"]         =   "orderdetail_orderid";
            $params["whereCondition"]   =   "vendor_mobile LIKE '".$this->input->post("vendor_mobile")."'";
            $dta    =   $this->order_model->vieworderdetails($params); 
            return $dta; 
        } 
        public function view_order_details($params = array()){ 
//            $params["group_by"]   =   "vendor_id,customer_id"; 
            $params["whereCondition"]   =   "vendor_mobile LIKE '".$this->input->post("vendor_mobile")."' AND order_unique LIKE '".$this->input->post("order_unique")."'";
            $dta    =   $this->order_model->vieworderdetails($params); 
            return $dta; 
        }
        public  function  check_vendor(){ 
                $parms['where_condition']   =   "(vendor_name='".$this->input->post("vendor_name")."' ) AND vendor_verified = '1' AND vendor_open = '1'";
                $vsp    =    $this->queryVendor($parms)->row();  
                if(count($vsp) > 0){ 
                    $ins   =   $vsp;
                    $this->session->set_userdata("vendor_id",$ins->vendor_id);
                    $this->session->set_userdata("vendor_name",$ins->vendor_name);
                    return TRUE;
                }
                return FALSE;
        }
        public function view_packages($params = array()){ 
            $params["where_condition"]  =   "package_acde = '1'";
            $params["columns"]          =   "package_id,package_name,(CONCAT(package_expiry,' ',package_expiry_value)) as package_expiry,package_banners"; 
            $dta    =   $this->packages_model->viewPackage($params); 
            return $dta; 
        }
        public function my_packages($params = array()){ 
            $params["where_condition"]  =   "package_acde = '1' AND vendor_mobile LIKE '".$this->input->post("vendor_mobile")."'";
            $params["columns"]          =   "vendorpackage_id,package_id,package_name,(CONCAT(package_expiry,' ',package_expiry_value)) as package_expiry,package_banners,vendorpackage_pay_mode,vendorpackage_date"; 
            $dta    =   $this->viewvendorpackages($params); 
            return $dta; 
        }
        public function viewvendorpackages($params = array()){
            return $this->queryvendorpacakges($params)->result();
        }
        public function getvendorpackages($params = array()){
            return $this->queryvendorpacakges($params)->row();
        }
        public function queryvendorpacakges($params = array()){
                $sel    =   "*";
                if(array_key_exists("columns", $params)){
                        $sel    =   $params["columns"];
                }
                if(array_key_exists("cnt", $params)){
                        $sel    =   "count(*) as cnt";
                }
                if(array_key_exists("join_condition", $params)){
                        $join    =   $params["join_condition"];
                }
                $dta    =   array( 
                    "vt.vendorpackage_open"  =>  "1",
                    "vt.vendorpackage_status"  =>  "1",
                    "pt.package_status"  =>  "1",
                    "pt.package_open"  =>  "1",
                    "vd.vendor_open"  =>  "1",
                    "vd.vendor_status"  =>  "1"
                );
                $this->db->select("$sel")
                        ->from("vendor_packages as vt")
                        ->join("packages as  pt","pt.package_id = vt.vendorpackage_package_id","INNER") 
                        ->join("vendor as  vd","vd.vendor_id = vt.vendorpackage_vendor_id","INNER") 
                        ->join("countries as  ct","ct.country_id = vd.vendor_country","LEFT") 
                        ->join("state as st","st.state_id = vd.vendor_state","LEFT") 
                        ->join("district as  dt","dt.district_id = vd.vendor_district","LEFT")  
                        ->join("mandal as md","md.mandal_id = vd.vendor_mandal","LEFT")  
                        ->join("gram_panchayat as gm","gm.gram_panchayat_id = vd.vendor_gramapanchayat","LEFT")  
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(vendor_mobile LIKE '%".$params["keywords"]."%')");
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
        public function select_package(){
            $tvi    =   $this->view_profile($this->input->post("vendor_mobile"));
            $vendor =   isset($tvi)?$tvi['vendor_id']:"";
            
            
            $psm =  $this->input->post("package_id");
            $vsi    =   $this->packages_model->get_package($psm);
            
            $dta    =   array( 
                            "vendorpackage_id"         =>  "VEPK".$this->common_model->get_max("vendorpackageid","vendor_packages"),
                            "vendorpackage_vendor_id"  =>  $vendor,
                            "vendorpackage_package_id" =>  $this->input->post("package_id"),
                            "vendorpackage_banners"    =>  $vsi['package_banners'],
                            "vendorpackage_pay_mode"   =>  $this->input->post("pay_mode"),
                            "vendorpackage_date"          =>  date("Y-m-d"),
                            "vendorpackage_created_on"    =>  date("Y-m-d H:i:s"), 
                            "vendorpackage_created_by"    =>  $vendor
                        ); 
            $this->db->insert("vendor_packages",$dta); 
            if($this->db->insert_id() > 0){
                return TRUE;
            }
            return FALSE;
        }  
        public function banner_upload(){
            $tvi    =   $this->view_profile($this->input->post("vendor_mobile"));
            $psm["columns"]         =   "vendorpackage_id,package_id,(CONCAT(package_expiry,' ',package_expiry_value)) as package_expiry,package_expiry_value,vendorpackage_banners"; 
            $psm["whereCondition"]  =   "package_id LIKE '". $this->input->post("package_id")."' AND vendorpackage_banners > '0'";
            $vsi    =   $this->getvendorpackages($psm);
            if($vsi != "" && count($vsi) > 0){
                $vendor =   isset($tvi)?$tvi['vendor_id']:""; 
                $date   =   date("Y-m-d");
                $vsp    =   date("Y-m-d",strtotime('+ '.$vsi->package_expiry));
                if($vsi->package_expiry_value == "Unlimited"){
                    $vsp    =   date("Y-m-d",strtotime('+ 100 Years')); 
                }
                $dta    =   array( 
                                "banner_id"         =>  "BNR".$this->common_model->get_max("bannerid","banners"),
                                "banner_vendor_id"  =>  $vendor,
                                "banner_title"      =>   $this->input->post("banner_title")?$this->input->post("banner_title"):"", 
                                "banner_package_id" =>  $this->input->post("package_id"),
                                "banner_vendorpackage_id"  =>  $vsi->vendorpackage_id,
                                "banner_vendor_date"       =>  date("Y-m-d"),
                                "banner_vendor_expriy"     =>  $vsp,
                                "banner_cr_on"    =>  date("Y-m-d H:i:s"), 
                                "banner_cr_by"    =>  $vendor
                            ); 
                if(count($_FILES) > 0){
                    if($_FILES["banner_upload"]["name"] != "" && $_FILES["banner_upload"]["name"] != "noname"){ 
                        $target_dir  =   $this->config->item("uploads_path")."banner-uploads/";    
                        $tmpFilePath    =   $_FILES['banner_upload']['tmp_name'];
                        $fname          =   $_FILES['banner_upload']['name'];
                        $vsp        =   explode(".",$fname);
                        if(count($vsp) > 1){
                            $j  =   count($vsp)-1;
                            $fname      =   time().".".$vsp[$j];
                        }
                        $uploadfile =   $target_dir . basename($fname);
                        move_uploaded_file($tmpFilePath, $uploadfile);   
                        $dta['banner_image']  =   $fname; 
                    }  
                }
                $this->db->insert("banners",$dta); 
                if($this->db->insert_id() > 0){
                    $ddta    =   array( 
                                    "vendorpackage_banners"    =>  ($vsi->vendorpackage_banners)-1,
                                    "vendorpackage_modified_on"    =>  date("Y-m-d H:i:s"), 
                                    "vendorpackage_modified_by"    =>  $vendor
                                ); 
                    $this->db->update("vendor_packages",$ddta,array("vendorpackage_id" => $vsi->vendorpackage_id)); 
                    return TRUE;
                }
            }
            return FALSE;
        }
        public function banner_list(){
            $imagepath  =   $this->config->item("upload_url")."banner-uploads/"; 
            $params["tipoOrderby"]  =   "bannerid";
            $params["order_by"]  =   "DESC";
            $params["where_condition"]  =   "vendor_mobile LIKE '".$this->input->post("vendor_mobile")."'";
            $params["columns"]  =   "banner_id,banner_title,CONCAT('".$imagepath."',banner_image) as banner_image,banner_vendor_expriy,package_name,(CONCAT(package_expiry,' ',package_expiry_value)) as package_expiry";
            return $this->banner_model->viewBanners($params);
        }
        public function updateBanner(){
                $uri    =   $this->input->post("banner_id");
                $tvi    =   $this->view_profile($this->input->post("vendor_mobile"));
                $vendor =   isset($tvi)?$tvi['vendor_id']:""; 
                $dta    =   array( 
                        "banner_title"   =>   $this->input->post("banner_title")?$this->input->post("banner_title"):"", 
                        "banner_md_on"   =>   date("Y-m-d h:i:s"),  
                        "banner_md_by"   =>   $vendor
                ); 
                if(count($_FILES) > 0){
                    if($_FILES["banner_upload"]["name"] != "" && $_FILES["banner_upload"]["name"] != "noname"){ 
                        $target_dir  =   $this->config->item("uploads_path")."banner-uploads/";    
                        $tmpFilePath    =   $_FILES['banner_upload']['tmp_name'];
                        $fname          =   $_FILES['banner_upload']['name'];
                        $vsp        =   explode(".",$fname);
                        if(count($vsp) > 1){
                            $j  =   count($vsp)-1;
                            $fname      =   time().".".$vsp[$j];
                        }
                        $uploadfile =   $target_dir . basename($fname);
                        move_uploaded_file($tmpFilePath, $uploadfile);   
                        $dta['banner_image']  =   $fname; 
                    }  
                }  
                $this->db->update("banners",$dta,array("banner_id" => $uri)); 
                if($this->db->affected_rows() >  0){ 
                        return TRUE;
                }
                return FALSE;
        }
        public function queryCountries($params = array()){
                $sel    =   "*";
                $join   =   "";
                if(array_key_exists("columns", $params)){
                        $sel    =   $params["columns"];
                }
                if(array_key_exists("cnt", $params)){
                        $sel    =   "count(*) as cnt";
                }
                if(array_key_exists("join_condition", $params)){
                        $join    =   $params["join_condition"];
                }
                $dta    =   array( 
                    "country_order"   =>  "1",
                    "country_status"  =>  "1"
                );
                $this->db->select("$sel")
                        ->from("countries") 
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(country_name LIKE '%".$params["keywords"]."%')");
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
               // $this->db->get();echo $this->db->last_query();exit;
                return $this->db->get();
        }
        public function queryvendorprices($params = array()){
                $sel    =   "*";
                $join   =   "";
                if(array_key_exists("columns", $params)){
                        $sel    =   $params["columns"];
                }
                if(array_key_exists("cnt", $params)){
                        $sel    =   "count(*) as cnt";
                }
                if(array_key_exists("join_condition", $params)){
                        $join    =   $params["join_condition"];
                }
                $dta    =   array( 
                    "vendorproductprince_open"   =>  "1",
                    "vendorproductprice_status"  =>  "1"
                );
                $this->db->select("$sel")
                        ->from("vendor_product_princes")
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(vendor_product_princes LIKE '%".$params["keywords"]."%')");
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
        public function viewCountries($params = array()){
            return $this->queryCountries($params)->result();
        }
        public function viewVendorproductIngredients($params = array()){
            return $this->queryproductIngredients($params)->result();
        }
        public function indr(){
            $p['whereCondition'] = "vendorproductids = '".$product."' AND vendor_ingredientslist = '".$ts->vendor_ingredientslist."'";
            $p["columns"] ="prodind,prod_indug,vendorproduct_bb_quantity,vendorproduct_bb_price,vendorproduct_bb_mrp";
            $indslist = $this->vendor_model->queryproductIngredients($p)->result();
            $tys=array();
            if(is_array($indslist) && count($indslist) > 0){
               foreach($indslist as $tss){
                   $tys[$keys]['quantity']   =  ($tss->vendorproduct_bb_quantity!="")?$tss->vendorproduct_bb_quantity:'';
                   $tys[$keys]['price']      =  $this->customer_model->currency_change($country,$tss->vendorproduct_bb_price);
                   $tys[$keys]['mrp']        =  $this->customer_model->currency_change($country,$tss->vendorproduct_bb_mrp);
                }
            }
            return $tys;
        }
        public function queryproductIngredients($params = array()){
            $sel    =   "*";
                $join   =   "";
                if(array_key_exists("columns", $params)){
                        $sel    =   $params["columns"];
                }
                if(array_key_exists("cnt", $params)){
                        $sel    =   "count(*) as cnt";
                }
                if(array_key_exists("join_condition", $params)){
                        $join    =   $params["join_condition"];
                }$dta ="((`prod_indu_open` = '1' AND `prod_indu_status` = '1') OR `vendor_product_princes`.`vendor_ingredientslist` = '') AND vendorproductprince_open = 1";
                // $dta    =   array( 
                //     "prod_indu_open"   =>  "1",
                //     "prod_indu_status"  =>  "1",
                //     "vendorproductprince_open"=>"1",
                // );
                $this->db->select("$sel")
                        ->from("vendor_products")
                        ->join("vendor_product_princes","vendor_products.vendorproduct_id = vendor_product_princes.vendorproductids","Inner")
                        ->join("product_Ingredients","vendor_product_princes.vendor_ingredientslist = product_Ingredients.prodind","LEFT")
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(country_name LIKE '%".$params["keywords"]."%')");
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
        
        public function delete_product_images($uri){
            $sdta    =  array(   
                        "vendorproductimg_open"           =>  "0",
                        "vendorproductimg_modified_on"    =>  date("Y-m-d H:i:s"), 
                        "vendorproductimg_modified_by"    =>  $this->session->userdata("login_id"),
                    ); 
            $this->db->update("vendorproduct_images",$sdta,array("vendorproductimg_id" => $uri)); 
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE; 
        }/*
        public function delete_product_images($uri){
            if($_FILES["product_upload"]["name"] != "" && $_FILES["product_upload"]["name"] != "noname"){
                $total = count($_FILES['product_upload']['name']);
                $target_dir =   $this->config->item("uploads_path")."products/"; 
                for( $i=0 ; $i < $total ; $i++ ) { 
                    $tmpFilePath = ($total > 0)?$_FILES['product_upload']['tmp_name'][$i]:$_FILES['product_upload']['tmp_name']; 
                    if ($tmpFilePath != ""){
                        $fname      =   ($total > 0)?$_FILES['product_upload']['name'][$i]:$_FILES['product_upload']['name'];
                        $vsp        =   explode(".",$fname);
                        if(count($vsp) > 1){
                            $j =    count($vsp)-1;
                            $fname      =   time()."_".$i.".".$vsp[$j];
                        }
                        $uploadfile =   $target_dir . basename($fname);
                        move_uploaded_file($tmpFilePath, $uploadfile);  
                        $vednid  =   "VIMG".$this->common_model->get_max("vendorproductimgid","vendorproduct_images");
                        $dta    =   array(  
                            "vendorproductimg_id"           =>  $vednid,
                            "vendorproduct_productid"       =>  $venid,
                            "vendorproductimg_name"         =>  $fname,
                            "vendorproductimg_created_on"   =>  date("Y-m-d H:i:s"), 
                            "vendorproductimg_created_by"   =>  $vendor,
                        );
                        $this->db->insert("vendorproduct_images",$dta);  
                    }
                }
                return TRUE;
            }
            return FALSE;
        }*/
        public function forgotpassword($customer_id){
            $par['whereCondition'] = "lower(customer_email_id) LIKE '".strtolower($this->input->post("email"))."' OR lower(customer_mobile) LIKE '".strtolower($this->input->post("email"))."'";
            $vsp    =   $this->customer_model->getCustomer($par);
            if(is_array($vsp) && count($vsp) > 0){
                $reg_mobile_verified    =   $vsp["customer_email_verified"];
                $reg_email_verified     =   $vsp["customer_verified_mobile"];
                $rgcount                =   $vsp["customer_country"];
                $toemail                 =   $vsp["customer_email_id"];
                $customer_name                 =   $vsp["customer_name"];
                $subject = "MiniKart Reset Password link";
                $messge  = '<head>
                              <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                              <meta name="viewport" content="width=device-width, initial-scale=1">
                              <style>
                                @media screen and (max-width: 720px) {
                                  body .c-v84rpm {
                                    width: 100% !important;
                                    max-width: 720px !important;
                                  }
                                  body .c-v84rpm .c-7bgiy1 .c-1c86scm {
                                    display: none !important;
                                  }
                                  body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-pekv9n .c-1qv5bbj,
                                  body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-1c9o9ex .c-1qv5bbj,
                                  body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-90qmnj .c-1qv5bbj {
                                    border-width: 1px 0 0 !important;
                                  }
                                  body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-183lp8j .c-1qv5bbj {
                                    border-width: 1px 0 !important;
                                  }
                                  body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-pekv9n .c-1qv5bbj {
                                    padding-left: 12px !important;
                                    padding-right: 12px !important;
                                  }
                                  body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-1c9o9ex .c-1qv5bbj,
                                  body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-90qmnj .c-1qv5bbj {
                                    padding-left: 8px !important;
                                    padding-right: 8px !important;
                                  }
                                  body .c-v84rpm .c-ry4gth .c-1dhsbqv {
                                    display: none !important;
                                  }
                                }
                                @media screen and (max-width: 720px) {
                                  body .c-v84rpm .c-ry4gth .c-1vld4cz {
                                    padding-bottom: 10px !important;
                                  }
                                }
                              </style>
                              <title>Recover your Crisp password</title>
                            </head>
                            
                            <body style="margin: 0; padding: 0; font-family: &quot; HelveticaNeueLight&quot;,&quot;HelveticaNeue-Light&quot;,&quot;HelveticaNeueLight&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,Helvetica,Arial,&quot;LucidaGrande&quot;,sans-serif;font-weight: 300; font-stretch: normal; font-size: 14px; letter-spacing: .35px; background: #EFF3F6; color: #333333;">
                              <table border="1" cellpadding="0" cellspacing="0" align="center" class="c-v84rpm" style="border: 0 none; border-collapse: separate; width: 720px;" width="720">
                                <tbody>
                                  <tr class="c-1syf3pb" style="border: 0 none; border-collapse: separate; height: 114px;">
                                    <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
                                      <table align="center" border="1" cellpadding="0" cellspacing="0" class="c-f1bud4" style="border: 0 none; border-collapse: separate;">
                                        <tbody>
                                          <tr align="center" class="c-1p7a68j" style="border: 0 none; border-collapse: separate; padding: 16px 0 15px;">
                                            <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle"><img alt="" src="'.base_url().'assets/images/logo.png" class="c-1shuxio" style="border: 0 none; line-height: 100%; outline: none; text-decoration: none; height: 33px; width: 120px;" width="120" height="33"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                  <tr class="c-7bgiy1" style="border: 0 none; border-collapse: separate; -webkit-box-shadow: 0 3px 5px rgba(0,0,0,0.04); -moz-box-shadow: 0 3px 5px rgba(0,0,0,0.04); box-shadow: 0 3px 5px rgba(0,0,0,0.04);">
                                    <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
                                      <table align="center" border="1" cellpadding="0" cellspacing="0" class="c-f1bud4" style="border: 0 none; border-collapse: separate; width: 100%;" width="100%">
                                        <tbody>
                                          <tr class="c-pekv9n" style="border: 0 none; border-collapse: separate; text-align: center;" align="center">
                                            <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
                                              <table border="1" cellpadding="0" cellspacing="0" width="100%" class="c-1qv5bbj" style="border: 0 none; border-collapse: separate; border-color: #E3E3E3; border-style: solid; width: 100%; border-width: 1px 1px 0; background: #FBFCFC; padding: 40px 54px 42px;">
                                                <tbody>
                                                  <tr style="border: 0 none; border-collapse: separate;">
                                                    <td class="c-1m9emfx c-zjwfhk" style="border: 0 none; border-collapse: separate; vertical-align: middle; font-family: &quot; HelveticaNeueLight&quot;,&quot;HelveticaNeue-Light&quot;,&quot;HelveticaNeueLight&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,Helvetica,Arial,&quot;LucidaGrande&quot;,sans-serif;font-weight: 300; color: #1D2531; font-size: 25.45455px;"
                                                      valign="middle">'.$customer_name.', recover your password.</td>
                                                  </tr>
                                                  <tr style="border: 0 none; border-collapse: separate;">
                                                    <td class="c-46vhq4 c-4w6eli" style="border: 0 none; border-collapse: separate; vertical-align: middle; font-family: &quot; HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeueRoman&quot;,&quot;HelveticaNeue-Roman&quot;,&quot;HelveticaNeueRoman&quot;,&quot;HelveticaNeue-Regular&quot;,&quot;HelveticaNeueRegular&quot;,Helvetica,Arial,&quot;LucidaGrande&quot;,sans-serif;font-weight: 400; color: #7F8FA4; font-size: 15.45455px; padding-top: 20px;"
                                                      valign="middle">Looks like you lost your password?</td>
                                                  </tr>
                                                  <tr style="border: 0 none; border-collapse: separate;">
                                                    <td class="c-eitm3s c-16v5f34" style="border: 0 none; border-collapse: separate; vertical-align: middle; font-family: &quot; HelveticaNeueMedium&quot;,&quot;HelveticaNeue-Medium&quot;,&quot;HelveticaNeueMedium&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,sans-serif;font-weight: 500; font-size: 13.63636px; padding-top: 12px;"
                                                      valign="middle">We’re here to help. Click on the button below to change your password.</td>
                                                  </tr>
                                                  <tr style="border: 0 none; border-collapse: separate;">
                                                    <td class="c-rdekwa" style="border: 0 none; border-collapse: separate; vertical-align: middle; padding-top: 38px;" valign="middle">
                                                        <a href="'.base_url().'Update-password/'.base64_encode($toemail).'" target="_blank" class="c-1eb43lc c-1sypu9p c-16v5f34" style="color: #000000; -webkit-border-radius: 4px; font-family: &quot; HelveticaNeueMedium&quot;,&quot;HelveticaNeue-Medium&quot;,&quot;HelveticaNeueMedium&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,sans-serif;font-weight: 500; font-size: 13.63636px; line-height: 15px; display: inline-block; letter-spacing: .7px; text-decoration: none; -moz-border-radius: 4px; -ms-border-radius: 4px; -o-border-radius: 4px; border-radius: 4px; background-color: #288BD5; background-image: url(&quot;https://mail.crisp.chat/images/linear-gradient(-1deg,#137ECE2%,#288BD598%)&quot; );color: #ffffff; padding: 12px 24px;">Recover my password</a>
                                                    </td>
                                                  </tr>
                                                  <tr style="border: 0 none; border-collapse: separate;">
                                                    <td class="c-ryskht c-zjwfhk" style="border: 0 none; border-collapse: separate; vertical-align: middle; font-family: &quot; HelveticaNeueLight&quot;,&quot;HelveticaNeue-Light&quot;,&quot;HelveticaNeueLight&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,Helvetica,Arial,&quot;LucidaGrande&quot;,sans-serif;font-weight: 300; font-size: 12.72727px; font-style: italic; padding-top: 52px;"
                                                      valign="middle">If you didn’t ask to recover your password, please ignore this email.</td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                          
                                    <tr class="c-183lp8j" style="border: 0 none; border-collapse: separate;">
                                      <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
                                        <table border="1" cellpadding="0" cellspacing="0" width="100%" class="c-1qv5bbj" style="border: 0 none; border-collapse: separate; border-color: #E3E3E3; border-style: solid; width: 100%; background: #FFFFFF; border-width: 1px; font-size: 11.81818px; text-align: center; padding: 18px 40px 20px;"
                                          align="center">
                                          <tbody>
                                            <tr style="border: 0 none; border-collapse: separate;">
                                              <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle"><span class="c-1w4lcwx">You receive this email because you or someone initiated a password recovery operation on your Crisp account.</span></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                    </tbody>
                                    </table>
                                    </td>
                                  </tr>
                                  <tr class="c-ry4gth" style="border: 0 none; border-collapse: separate;">
                                    <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
                                      <table border="1" cellpadding="0" cellspacing="0" width="100%" class="c-1vld4cz" style="border: 0 none; border-collapse: separate; padding-bottom: 26px;">
                                        <tbody>
                                          <tr style="border: 0 none; border-collapse: separate;">
                                            <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
                                              
                                              <table border="1" cellpadding="0" cellspacing="0" width="100%" class="c-15u37ze" style="border: 0 none; border-collapse: separate; font-size: 10.90909px; text-align: center; color: #7F8FA4; padding-top: 15px;" align="center">
                                                <tbody>
                                                  <tr style="border: 0 none; border-collapse: separate;">
                                                    <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">© 2021 Minikart</td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                            
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </body>';
                            //print_r($messge);exit;
                return $this->common_config->configemail($toemail,$subject,$messge);
                
            }
        }
        
        public function update_password($id){
            $data = array(
                'customer_password'     => $this->input->post('password'),
                'customer_cpassword'    => $this->input->post('cpassword'),
                'customer_cpassword'    => $id,
                'customer_modified_on'  => date('Y-m-d H:i:s a'),
            );
            $r = $this->db->where('customer_id',$id)->update('customers',$data);
            if($r >0){
                return true;
            }else{
                return false;
            }
        }
        
        public function update_product_images($uri){
            if($_FILES["product_image"]["name"] != "" && $_FILES["product_image"]["name"] != "noname"){
                $target_dir =   $this->config->item("uploads_path")."products/"; 
                    $tmpFilePath = $_FILES['product_image']['tmp_name']; 
                    if ($tmpFilePath != ""){  
                        $fname      =   $_FILES['product_image']['name'];
                        $vsp        =   explode(".",$fname);
                        if(count($vsp) > 1){
                            $j =    count($vsp)-1;
                            $fname      =   time()."_".$i.".".$vsp[$j];
                        }
                        $uploadfile =   $target_dir . basename($fname);
                        move_uploaded_file($tmpFilePath, $uploadfile);  
                        $dta    =   array(  
                            "vendorproductimg_name"         =>  $fname,
                            "vendorproductimg_modified_on"   =>  date("Y-m-d H:i:s"), 
                            "vendorproductimg_modified_by"   =>  $vendor,
                        );
                        unlink($target_dir.$this->input->post('old_image'));
                        $this->db->update("vendorproduct_images",$dta,array("vendorproductimg_id" => $uri));
                        if($this->db->affected_rows() > 0){
                            return TRUE;
                        }
                    }
                return TRUE;
            }

        }
        public function queryvendorproducts_list($params = array()){
            $sel    =   "*";
            $join   =   "";
            if(array_key_exists("columns", $params)){
                    $sel    =   $params["columns"];
            }
            if(array_key_exists("cnt", $params)){
                    $sel    =   "count(*) as cnt";
            }
            if(array_key_exists("join_condition", $params)){
                    $join    =   $params["join_condition"];
            }
            if(isset($params["condition"])){
                $dta= array();
            }else{
                $dta    =   array(
                    "pd.product_open"   =>  "1",
                    "pd.product_status" =>  "1",
                    //"vd.vendor_open"    =>  "1",
                    //"vd.vendor_status"  =>  "1",
                    "vp.vendorproduct_open"  =>  "1",
                    "vp.vendorproduct_status"  =>  "1",
                    /*"mhd.measure_status"  =>  "1",
                    "mhd.measure_open"  =>  "1"*/
                );
            }
            $this->db->select("$sel")
                    ->from("vendor_products as vp") 
                    ->join("vendor_product_princes as vpp","vp.vendorproduct_id = vpp.vendorproductids","LEFT")
                    ->join("product_Ingredients as pi","vpp.vendor_ingredientslist = pi.prodind","LEFT")
                    ->join("products as  pd","pd.product_id = vp.vendorproduct_product","LEFT")
                    ->join("category as sn","sn.category_id = vp.vendorproduct_category","LEFT")
                    ->join("sub_category as sv","sv.subcategory_id = vp.vendorproduct_subcategory","LEFT")  
                    ->join("(SELECT * FROM vendorproduct_images  WHERE vendorproductimg_open = '1' AND  vendorproductimg_status = '1' GROUP BY vendorproduct_productid) as vimp","vp.vendorproduct_id = vimp.vendorproduct_productid","LEFT")
                    ->where($dta);
            if(array_key_exists("keywords", $params)){
                $this->db->where("(product_name LIKE '%".$params["keywords"]."%' OR category_name LIKE '%".$params["keywords"]."%' OR subcategory_name LIKE '%".$params["keywords"]."%')");
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
    public function cntviewVendorproducts_list($params  =    array()){
            $params["cnt"]      =   "1"; 
            $val    =   $this->queryvendorproducts_list($params)->row_array();
            if(isset($val)){
                return  $val['cnt'];
            }
            return "0";
    }
    public function viewVendorproduct_list($params = array()){
            $params["tipoOrderby"]   =   "vp.vendorproductid"; 
            $params["order_by"]     =   "DESC";
            $params["limit"]        =   "5";
            $params["group_by"]     =   "vp.vendorproduct_id";
            return $this->queryvendorproducts_list($params)->result();
    } 
    public function viewVendorproducts_list($params = array()){
            return $this->queryvendorproducts_list($params)->result();
    } 
    public function getVendorproduct_list($params = array()){
        return $this->queryvendorproducts_list($params)->row_array();
    }
}
