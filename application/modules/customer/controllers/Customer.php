<?php
class Customer extends CI_Controller{
        public function register(){
            if(
                $this->input->post("fname") != "" && 
                $this->input->post("email") != "" && 
                $this->input->post("mobile") != "" && 
                $this->input->post("password") != "" && 
                //$this->input->post("cpassword") != "" && 
                //$this->input->post("gender") != "" && 
                $this->input->post("country") != ""
            ){
                $par['whereCondition'] = "customer_email_id like '".$this->input->post("email")."' OR  customer_mobile Like '".$this->input->post("mobile")."'";
                $vsp    =   $this->customer_model->getCustomer($par);
                if(is_array($vsp) && count($vsp) > 0){
                    $reg_email_verified     =   $vsp["customer_email_verified"];
                    $reg_mobile_verified    =   $vsp["customer_verified_mobile"];
                    $rgcount                =   $vsp["customer_country"];
                    if($rgcount == sitedata("site_country") || $rgcount == "95"|| $rgcount === "India"){
                        $data   =   $this->vendor_model->jsonencodevalues("4","Mobile No. already exists");
                    }else{
                        $data   =   $this->vendor_model->jsonencodevalues("3","Email Id. already exists");
                    }
                }else{
                    $data   =   $this->vendor_model->jsonencodevalues("2","Not registered User.");
                    $vsps    =   $this->customer_model->createregister();
                    if($vsps){
                        if($this->input->post("country") == sitedata("site_country")){
                            $data   =   $this->vendor_model->jsonencodevalues("1","Registered profile successfully,OTP Sent to registered mobile no");
                        }else{
                            $data   =   $this->vendor_model->jsonencodevalues("5","Registered profile successfully,OTP Send to registered Email Id");
                        }
                    }
                }
            }else{
                $data   =   $this->vendor_model->jsonencodevalues("0","Some Fileds are required");
            }
            echo ($data);
        }
        public function unique_registeremail(){
            echo $this->customer_model->unique_registeremail();
        }
		
        public function loginemails(){
            echo $this->customer_model->loginemails();
        }
        
        public function ipfinder(){
			$curl = curl_init();
			curl_setopt_array($curl, array(
				  CURLOPT_URL => "http://ip-api.com/json",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET",
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: a54b03e4-ca79-4340-e04e-23e03475431a"
				  ),
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			  return json_decode($response,true);
			}
		}
        public function loginemailsapi(){
            $data   =   $this->vendor_model->jsonencodevalues("0","Some Fileds are required");
            if($this->input->post("email") != "" && $this->input->post("password") != "" ){
                $data   =   $this->vendor_model->jsonencodevalues("2","Invalid username and password");
				$ip  = $this->ipfinder();
				if(is_array($ip) && count($ip) >0){
					$country = $ip['country'];
				}
                $par['whereCondition'] = "(lower(customer_email_id) LIKE '".strtolower($this->input->post("email"))."' OR lower(customer_mobile) LIKE '".strtolower($this->input->post("email"))."') and customer_password = '".$this->input->post("password")."'";
                $vsp    =   $this->customer_model->getCustomer($par);
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
                            $this->session->set_userdata("customer_mobile",$vsp["customer_mobile"]);
                            $this->session->set_userdata("customer_email_id",$vsp["customer_email_id"]);
                            $data  =  $this->vendor_model->jsonencodevalues("1",$vsp);
                        }
                    }
                }
            }
            echo ($data);
        }
        public function forgotpassword(){
            $this->vendor_model->forgotpassword('CUST9');
        }
        public function customer_forgotpassword(){
            $data   =   $this->vendor_model->jsonencodevalues("0","Some Fileds are required");
            if($this->input->post("email") != ""){
                $data   =   $this->vendor_model->jsonencodevalues("2","Invalid Emailid /Mobile NO");
                $par['whereCondition'] = "lower(customer_email_id) LIKE '".strtolower($this->input->post("email"))."' OR lower(customer_mobile) LIKE '".strtolower($this->input->post("email"))."'";
                $vsp    =   $this->customer_model->getCustomer($par);
                //echo '<pre>';print_r($vsp);exit;
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
                        $data = $this->vendor_model->jsonencodevalues("5","password reset link has been sent to your email");
                        $this->vendor_model->forgotpassword($vsp['customer_id']);
                    }
                }
            }
            echo ($data);
        }
        public function loginmobileapi(){
            $data   =   $this->vendor_model->jsonencodevalues("0","Some Fileds are required");
            if($this->input->post("mobile") != "" ){
               /*$par['whereCondition'] = "customer_mobile Like '".$this->input->post("mobile")."'";
                $vsp    =   $this->customer_model->getCustomer($par);
                if(is_array($vsp) && count($vsp) >0){
                    if($vsp['customer_verified_mobile'] == "0"){
                        $data       =   $this->vendor_model->jsonencodevalues("5","Email Id has been not verified");
                    }
                }else{*/
                    $data   =   $this->vendor_model->jsonencodevalues("2","Invalid mobile No");
                    $vsp =  $this->customer_model->loginmobileapi();
                    if($vsp){
                        $data   =   $this->vendor_model->jsonencodevalues("1",$vsp);
                    }
                //}
            }
            echo ($data);
        }
        public function token(){
            $data   =   $this->vendor_model->jsonencodevalues('0',"Token and Mobile No. are required",'0');
            if($this->input->post("token_value") != "" && $this->input->post("token_mobile") != ""){
                $isn    =   $this->vendor_model->saveToken("Customer");
                $data   =   $this->vendor_model->jsonencodevalues('2',"Token has been not saved.Please try again.",'0');
                if($isn){
                    $data   =   $this->vendor_model->jsonencodevalues('1',"Token has been saved successfully",'0');
                }
            }
            echo json_encode($data);
        } 
        public function splash(){
            $data   =   $this->vendor_model->jsonencodevalues('0',"Mobile No. is required",'0');
            if($this->input->post("customer_mobile") != ""){
                $ins    =   $this->customer_model->checkuser();
                if($ins == '0'){
                    $data   =   $this->vendor_model->jsonencodevalues('1',"Mobile does not exists",'0');
                }else if($ins == '1'){
                    $ikns    =   $this->customer_model->view_profile();
                    $data   =   $this->vendor_model->jsonencodevalues('2',$ikns,'0');
                }else{
                    $data   =   $this->vendor_model->jsonencodevalues('3',"Mobile has been not verified",'0');
                }
            }
            echo json_encode($data); 
        }
        public function send_otp(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Mobile No. is required",'0');
            if($this->input->post("customer_mobile") != ""){
                $json       =   $this->vendor_model->jsonencodevalues('3', "Mobile number does not existing","0");
                $check      =   $this->customer_model->checkmobilestatus();
                if($check){
                    $jon        =   $this->vendor_model->sendotp($this->input->post("customer_mobile"));
                    $json       =   $this->vendor_model->jsonencodevalues('1', "OTP has been not sent.Please try again","0");
                    if($jon){
                        $json   =   $this->vendor_model->jsonencodevalues('2', "OTP has been sent successfully","0");
                    }
                }
            }
            echo json_encode($json); 
        }
        public function verify_otp(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Mobile No. and OTP No are required",'0');
            $mobile     =   $this->input->post("customer_mobile");
            $otpno      =   $this->input->post("customer_otp");
            if($mobile != "" && $otpno != ""){
                $jon        =   $this->vendor_model->verifyotp($otpno,$mobile,"1");
                $json       =   $this->vendor_model->jsonencodevalues('1', "OTP has been not verified.Please try again","0");
                if($jon){
                    //$vsp    = $this->customer_model->loginmobileapi();
                    //print_r($vsp);exit;
                    $json   =   array(
                                    "status"            =>  '2',
                                    "status_messsage"   =>  "OTP has been verified successfully",
                                    "User_data"         =>  $jon
                                );
                    //$this->vendor_model->jsonencodevalues('2', $vsp,"OTP has been verified successfully");
                } 
            }
            echo json_encode($json); 
        }
        public function update_profile(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");
            if($mobile != "" && $this->input->post("customer_name") != "" && $this->input->post("customer_email_id") != "" ){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $ch =   $this->customer_model->update_check_mail();
                    $json   =   $this->vendor_model->jsonencodevalues("1","Customer email already exist.Please try again.",'0');
                    if($ch){
                        $ins    =   $this->customer_model->update_customer();
                        $json   =   $this->vendor_model->jsonencodevalues("3","Customer details has been not updated.Please try again.",'0');
                        if($ins){
                            $json   =   $this->vendor_model->jsonencodevalues("2","Customer details has been updated succcesfully",'0');
                        }
                    }
                    
                }
            }
            echo json_encode($json);
        }
        
        public function currency(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");
            if($mobile != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $Curr = array();
                    $Currency = $this->customer_model->viewCurrency();
                    if(is_array($Currency) && count($Currency) >0){
                        $updatedate = $Currency[0]['currnecy_update'];
                        $d = date("d-m-Y", strtotime($updatedate));
                        $todaydate = date('Y-m-d');
                        if($d != $todaydate){
                            $this->customer_model->currency_update();
                        }
                        $Curr = array();$i = 0;
                        foreach($Currency as $c){
                            $Curr[$i]['currnecy_name']              = $c['currnecy_name'];
                            $Curr[$i]['currnecy']                   = $c['currnecy'];
                            $Curr[$i]['currency_symboles']          = $c['currency_symboles'];
                            $Curr[$i]['currency_symboles_native']   = $c['currency_symboles_native'];
                            $Curr[$i]['currency_decimal_digits']    = $c['currency_decimal_digits'];
                        $i++;}
                    }
                    $data    =   array(
                        "status"         =>  "2",
                        "update_date"    =>  $Currency[0]['currnecy_update'],
                        "currency"       =>  $Curr,
                    ); 
                    $json   =   $data;//$this->vendor_model->jsonencodevalues("2",$data,'0'); 
                }
            }
            echo json_encode($json);
        }
        
        public function dashboard(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");
            $country     =   $this->input->post("country");
            if($mobile != "" || $mobile ==""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                $cusid      =   $this->customer_model->getmobileid();
                if($check){
                    $week = date("Y-m-d", strtotime("+1 day"));
                    $par['whereCondition'] = "reminder_date = '".$week."' AND customer_id = '".$cusid."'";
                    $remainder  = $this->customer_model->viewReminder($par);
                    $data    =   array(
                        "banners"       =>  $this->banner_model->viewBannerdata(),
                        "categories"    =>  $this->vendor_model->view_category(),
                        "remainder"    =>  $remainder,
                        "products"      =>  $this->customer_model->apiproductlist($country),
                        "over_total"    =>  $this->customer_model->view_totalcart()
                    ); 
                    $json   =   $this->vendor_model->jsonencodevalues("2",$data,'0'); 
                }
            }
            echo json_encode($json);
        }
        public function products(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");
            $country     =   $this->input->post("country");
            if($mobile != "" || $mobile ==""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $data    =   array( 
                        "banners"       =>  $this->banner_model->viewBannerdata(),
                        "sub_categories"    =>  $this->vendor_model->view_subcategory(),
                        "products"          =>  $this->customer_model->apiproductlist($country), 
                        "over_total"        =>  $this->customer_model->view_totalcart()
                    ); 
                    $json   =   $this->vendor_model->jsonencodevalues("2",$data,'0'); 
                }
            }
            echo json_encode($json);
        }
        public function logout(){
                $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
                $mobile     =   $this->input->post("customer_mobile");
                if($mobile != "" || $mobile ==""){  
                    $this->session->sess_destroy(); 
                    $json   =   $this->vendor_model->jsonencodevalues("1","Logged out succcesfully",'0'); 
                }
                echo json_encode($json);
        }
        public function view_product(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");
            $product    =   $this->input->post("vendorproduct_id");
            $country     =   $this->input->post("country");
            
            if($mobile != "" || $mobile =="" && $product != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0');
                $pa["columns"] ="prodind,prod_indug,vendorproduct_bb_quantity,vendorproduct_bb_price,vendorproduct_bb_mrp";
                $pa["whereCondition"] = "vendorproductids Like '".$product."'";
                //$pa['group_by']       ="vendor_product_princes.vendorproduct_bb_quantity";
                $typess = $this->vendor_model->viewVendorproductIngredients($pa);
                //print_r($types);exit;
                $ty =array();$tys =array();$typename=array();$type_list =array();$types_ios=array();
                if(is_array($typess) && count($typess) > 0){
                    /*-------------------IOS types and indur--------------------*/
                    foreach($typess as $key =>$t){
                        if(!in_array($t->prod_indug, $typename, true)){
                            array_push($typename, $t->prod_indug);
                            $type_list[$t->prod_indug]=array();
                        }
                    }
                    /*-------------------IOS types and indur--------------------*/
                    foreach($typess as $key =>$t){
                        $ty[$key]['indugid']    =  ($t->prodind)??'';
                        $ty[$key]['indug']      =  ($t->prod_indug)??'';
                        $ty[$key]['quantity']   =  $t->vendorproduct_bb_quantity;
                        $ty[$key]['price']      =  $this->customer_model->currency_change($country,$t->vendorproduct_bb_price);
                        $ty[$key]['mrp']        =  $this->customer_model->currency_change($country,$t->vendorproduct_bb_mrp);
                        
                        /*-------------------IOS types and indur--------------------*/
                        $tys['indugid']    =  ($t->prodind)??'';
                        $tys['indug']      =  ($t->prod_indug)??'';
                        $tys['quantity']   =  $t->vendorproduct_bb_quantity;
                        $tys['price']      =  $this->customer_model->currency_change($country,$t->vendorproduct_bb_price);
                        $tys['mrp']        =  $this->customer_model->currency_change($country,$t->vendorproduct_bb_mrp);
                        array_push($type_list[$tys['indug']],$tys);
                        /*-------------------IOS types and indur--------------------*/
                        
                    }
                    $types = $ty;
                    /*-------------------IOS types and indur--------------------*/
                    $ii = 0;
                        foreach($typename as $tt){
                            $tye[$ii]['typeName'] = $tt;
                            $tye[$ii]['typeList'] = $type_list[$tt];
                            //array_push($types_ios,$tye);
                            $ii++;
                        }
                    /*-------------------IOS types and indur--------------------*/
                }else{
                    $types = $ty;
                    $types_ios = $tys;
                }
                if($check){
                    $data    =   array(
                        "product_details"   =>  $this->customer_model->customer_view_product(),
                        "product_images"    =>  $this->customer_model->customer_view_images(),
                        "types"             =>  $types,
                        "types_ios"         =>  $tye,
                        "addon"             =>  $this->customer_model->customer_addon(),
                        "over_total"        =>  $this->customer_model->view_totalcart(),
                    );
                    $json   =   $this->vendor_model->jsonencodevalues("2",$data,'0'); 
                }
            }
            echo json_encode($json);
        }
        public function view_states(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");
            $product    =   $this->input->post("vendorproduct_id");
            if($mobile != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->common_model->getstates("95");
                    $json   =   $this->vendor_model->jsonencodevalues('2',"No States are available",'0');
                    if(count($dta) > 0){
                        $json   =   $this->vendor_model->jsonencodevalues('3',$dta,'0');
                    } 
                }
            }
            echo json_encode($json);
        }
        public function delivery_type(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");
            if($mobile != "" || $mobile ==""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->deliverycharges_model->viewDeliverytype();
                    //print_r($dta);exit;
                    $da=array();
                    if(is_array($dta) && count($dta) >0){
                        $i=0;
                        foreach($dta as $d){
                            $da[$i]['derliverytype_id'] = $d->derliverytype_id;
                            $da[$i]['derliverytype'] = $d->derliverytype;
                        $i++;
                        }
                    }
                    $json   =   $this->vendor_model->jsonencodevalues('2',"No States are available",'0');
                    if(count($da) > 0){
                        $json   =   $this->vendor_model->jsonencodevalues('3',$da,'0');
                    } 
                }
            }
            echo json_encode($json);
        }
        public function delivery_timmings(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");
            $type     =   $this->input->post("derliverytype");
            $country     =   $this->input->post("country");
            if($mobile != "" || $mobile =="" && $type != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $par['where_condition'] = "delivery_changes.delivery_type = '".$type."'";
                    $dta    =   $this->deliverycharges_model->viewDelivery($par);
                    $da=array();$dats = array();
                    if(count($dta) > 0){
                        $dats['derliverytype']    =   $dta[0]->derliverytype;
                        $dats['derliveryamount']  =   $this->customer_model->currency_change($country,$dta[0]->deliverychg_amount);
                        if(is_array($dta) && count($dta) > 0){
                            $i=0;
                            foreach($dta as $d){
                                $da[$i]['deliverychgid'] = $d->deliverychgid;
                                $da[$i]['derliverytime'] = date('H:i', strtotime($d->deliverychg_start)).'-'.date('H:i', strtotime($d->deliverychg_end));
                                $i++;
                            }
                        }
                    }
                    $json   =   $this->vendor_model->jsonencodevalues('2',"No Delivery Types are available",'0');
                    if(count($da) > 0){
                        $json   =  array('status'=>3,'deliverydata'=>$dats,'status_messsage'=>$da);
                    }
                }
            }
            echo json_encode($json);
        }
        public function add_address(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile"); 
            if($mobile != ""  &&  $this->input->post("address") != "" &&  $this->input->post("locality") != "" &&  $this->input->post("pincode") != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->customer_model->add_address();
                    $json   =   $this->vendor_model->jsonencodevalues('2',"Not added any address.Please try again.",'0');
                    if($dta){
                        $json   =   $this->vendor_model->jsonencodevalues('3',"Added address successfully",'0');
                    }
                }
            }
            echo json_encode($json);
        }
        public function view_address(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile"); 
            if($mobile != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->customer_model->customeraddress();
                    $json   =   $this->vendor_model->jsonencodevalues('2',"No address are available",'0');
                    if(count($dta) > 0){
                        $json   =   $this->vendor_model->jsonencodevalues('3',$dta,'0');
                    } 
                }
            }
            echo json_encode($json);
        } 
        public function delete_address(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile"); 
            $customeraddress_id     =   $this->input->post("customeraddress_id");
            if($mobile != "" && $customeraddress_id != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->customer_model->delete_address($customeraddress_id);
                    $json   =   $this->vendor_model->jsonencodevalues('2',"Not deleted any address.Please try again",'0');
                    if($dta > 0){
                        $json   =   $this->vendor_model->jsonencodevalues('3',"Deleted Address successfully",'0');
                    } 
                }
            }
            echo json_encode($json);
        } 
        public function add_to_cart(){
            $json               =  $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile             =  $this->input->post("customer_mobile"); 
            $vendorproduct_id   =  $this->input->post("vendorproduct_id");
            $quantity           =  $this->input->post("quantity");
            $country            =  $this->input->post("country");
            $date               =  $this->input->post("date");
            $delivery_id        =  $this->input->post("delivery_id");
            if($mobile != "" && $vendorproduct_id != "" && $quantity != "" && $country != "" && $date !="" && $delivery_id != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->customer_model->addtocart();
                    $json   =   $this->vendor_model->jsonencodevalues('2',"Not added any product to cart",'0');
                    if($dta == 0){
                        $json   =   $this->vendor_model->jsonencodevalues('3',"Product does not exists",'0');
                    } 
                    if($dta == 1){
                        $json   =   $this->vendor_model->jsonencodevalues('4',"Added product to cart successfully",'0');
                    } 
                }
            }
            echo json_encode($json);
        }
        public function delete_cart(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile"); 
            $cart_id     =   $this->input->post("cart_id"); 
            if($mobile != "" && $cart_id != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->customer_model->deletecart();
                    $json   =   $this->vendor_model->jsonencodevalues('2',"Not deleted any product from cart",'0');
                    if($dta == 0){
                        $json   =   $this->vendor_model->jsonencodevalues('3',"Product does not exists",'0');
                    } 
                    if($dta == 1){
                        $json   =   $this->vendor_model->jsonencodevalues('4',"Deleted product successfully from cart",'0');
                    } 
                }
            }
            echo json_encode($json);
        } 
        public function view_cart(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");  
            $country     =   $this->input->post("country");  
            if($mobile != "" && $country != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->customer_model->view_cart();
                    $json   =   $this->vendor_model->jsonencodevalues('2',"No products are available in cart",'0');
                    if(count($dta) > 0){
                        $dtsa    =   array(
                            "cart"      =>  $dta,
                            "over_total"  =>  $this->customer_model->view_totalcart()
                        );
                        $json   =   $this->vendor_model->jsonencodevalues('3',$dtsa,'0');
                    } 
                }
            }
            echo json_encode($json);
        } 
        public function update_cart(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");   
            $quantity   =   $this->input->post("quantity");
            $cart_id    =   $this->input->post("cart_id"); 
            if($mobile != "" && $cart_id != "" && $quantity != ""){ 
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->customer_model->update_cart();
                    $json   =   $this->vendor_model->jsonencodevalues('2',"Not updated any product in cart",'0');
                    if($dta == 0){
                        $json   =   $this->vendor_model->jsonencodevalues('3',"Product does not exists",'0');
                    } 
                    if($dta == 1){
                        $json   =   $this->vendor_model->jsonencodevalues('4',"Updated product successfully in cart",'0');
                    }  
                }
            }
            echo json_encode($json);
        } 
        public function checkout(){
            $json                   =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile                 =   $this->input->post("customer_mobile");   
            $paymode                =   $this->input->post("payment_mode");
            $country                =   $this->input->post("country");
            $razorpay_payment_id    =   $this->input->post("razorpay_payment_id");
            $razor_order_id         =   $this->input->post("razor_order_id");
            $customeraddress_id     =   $this->input->post("customeraddress_id");
            if($mobile != "" && $country != "" && $customeraddress_id !=""){
                /*$check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $orderid = $this->order_model->addorder($mobile);
                    if($orderid){
                        $json       =   $this->vendor_model->jsonencodevalues("3","Order has been placed",'0');
                    }else{
                        $json       =   $this->vendor_model->jsonencodevalues("2","Order has been not placed.Please try again.",'0'); 
                    }
                }*/
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $json       =    $this->vendor_model->jsonencodevalues("5","Order has been not placed.Please try again.",'0'); 
                    $vie    =   FALSE;
                    if($paymode == "Cash On Delivery" && $otp_value == '0'){
                        $jon        =   $this->vendor_model->sendotp($this->input->post("customer_mobile"),'1');
                        $json       =   $this->vendor_model->jsonencodevalues("3","OTP has been not sent",'0'); 
                        if($jon){                          
                            $json   =   $this->vendor_model->jsonencodevalues("2","OTP has been sent successfully",'0'); 
                        }
                    }else if($paymode == "Cash On Delivery" && $otpno != ''){
                        if($mobile != "" && $otpno != ""){
                            $jon     =   $this->vendor_model->verifyotp($otpno,$mobile,"1");
                            $json    =   $this->vendor_model->jsonencodevalues('4', "OTP has been not verified.Please try again","0");
                            if($jon){
                                $params["whereCondition"] =   "customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR  customer_token LIKE '".$this->input->post("customer_mobile")."' OR customer_id LIKE '".$this->input->post("customer_mobile")."'"; 
                                $vsp        =   $this->customer_model->queryCustomer($params)->row_array();
                                $vie    =   $this->order_model->addorder($vsp['customer_id']);
                                $this->order_model->checkouts($vsp['customer_id'],$vie);
                            } 
                        }
                    }else if($paymode != "Cash On Delivery"){
                        $params["whereCondition"]   =   "customer_mobile LIKE '".$this->input->post("customer_mobile")."' OR  customer_token LIKE '".$this->input->post("customer_mobile")."' OR customer_id LIKE '".$this->input->post("customer_mobile")."'"; 
                        $vsp                        =   $this->customer_model->queryCustomer($params)->row_array();
                        $vie                        =   $this->order_model->addorder($vsp['customer_id']);
                        $r = $this->order_model->checkouts($vsp['customer_id'],$vie);
                    }
                    if($vie){
                        $json   =   $this->vendor_model->jsonencodevalues("6","Order has been placed successfully",'0'); 
                    }
                }
            }
            echo json_encode($json);
        }
        /*
            
        */
        /*
        public function checkout(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");   
            $paymode    =   $this->input->post("payment_mode");
            $country    =   $this->input->post("country");
            $customeraddress_id    =   $this->input->post("customeraddress_id");
            //$otp_value  =   $this->input->post("otp_status"); 
            //$otpno      =   $this->input->post("customer_otp");
            if($mobile != "" && $country != "" && $customeraddress_id !=""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $json       =   $this->vendor_model->jsonencodevalues("5","Order has been not placed.Please try again.",'0'); 
                    $vie        =   FALSE;
                    /*if($paymode == "Cash On Delivery" && $otp_value == '0'){
                        $jon        =   $this->vendor_model->sendotp($this->input->post("customer_mobile"),'1');
                        $json       =   $this->vendor_model->jsonencodevalues("3","OTP has been not sent",'0'); 
                        if($jon){                          
                            $json   =   $this->vendor_model->jsonencodevalues("2","OTP has been sent successfully",'0'); 
                        }
                    }
                    else if($paymode == "Cash On Delivery" && $otpno != ''){
                        if($mobile != "" && $otpno != ""){
                            $jon     =   $this->vendor_model->verifyotp($otpno,$mobile,"1");
                            $json    =   $this->vendor_model->jsonencodevalues('4', "OTP has been not verified.Please try again","0");
                            if($jon){
                                $vie    =   $this->customer_model->checkout();
                                $this->input->post("customeraddress_id");
                            } 
                        }
                    }
                    else if($paymode != "Cash On Delivery")
                        $vie      =   $this->customer_model->checkout();
                        $orders     =   $this->order_model->addorder($mobile);
                        if($orders){
                            $prms["whereCondition"]     =   "ct.cart_acde = '0' AND cp.customer_id LIKE '".$mobile."' OR cp.customer_mobile LIKE '".$mobile."' OR cp.customer_token LIKE '".$mobile."'";
                            $prms["columns"]            =   "SUM(cart_quantity*cart_price) as cart_price";
                            $view    =   $this->order_model->getcartproduct($prms);
                            if(is_array($view) && count($view) > 0){
                                $sub_prince = $view['cart_price'];
                                $prince = $view['cart_price'];
                            }
                            //$json       =    $this->vendor_model->jsonencodevalues("7",$orders,'0'); 
                            if($this->input->post('customeraddress_id') != ""){
                                $par['whereCondition'] = "customeraddress_id  LIKE  '".$this->input->post('customeraddress_id')."'";
                                $address = $this->customer_model->getCustomeraddress($par);
                            }
                            $data=array(
                    			'tid'               =>   strtotime(date('y-m-d H:i:s a')),
                                'merchant_id'       =>   $this->config->item("merchant_id"),
                                'order_id'          =>   ($orders !="")?$orders:'',
                                'amount'            =>   $prince,
                                'currency'          =>   ($currency !="")?$currency:'INR',
                                'redirect_url'      =>   base_url()."custmoer_paySuccess?customer_mobile=".$mobile."&transactionid=".$orders."&staus=1",
                                'cancel_url'        =>   base_url()."custmoer_paySuccess?customer_mobile=".$mobile."&transactionid=".$orders."&staus=0",
                                'language'          =>  'EN',
                                'delivery_name'     =>  ($address['customeraddress_fullname'] !="")?$address['customeraddress_fullname']:'',
                                'delivery_address'  =>  ($address['customeraddress_address'] !="")?$address['customeraddress_address']:'',
                                'delivery_city'     =>  ($address['customeraddress_district'] !="")?$address['customeraddress_district']:'',
                                'delivery_state'    =>  ($address['customeraddress_district'] !="")?$address['customeraddress_district']:'',
                                'delivery_zip'      =>  ($address['customeraddress_pincode'] !="")?$address['customeraddress_pincode']:'',
                                'delivery_country'  =>  'India',
                                'delivery_tel'      =>  ($address['customeraddress_mobile'] !="")?$address['customeraddress_mobile']:'',
                		    );
                        	$merchant_data='';
                        	$working_key = $this->config->item("working_key");//Shared by CCAVENUES
                        	$access_code = $this->config->item("access_code");//Shared by CCAVENUES
                        	
                        	foreach($data as $key => $value){
                        		$merchant_data.=$key.'='.$value.'&';
                        	}
                        	$encrypted_data = $this->ccavenue->encrypt($merchant_data,$working_key); 
                        //	$datas = array(
                        //	    'id'    => var_dump($encrypted_data), 
                        //	    'aces'  => var_dump($access_code), 
                        //	);
                            $rsa = 
                                '<form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
                                <input type="hidden" name="encRequest" value="'.$encrypted_data.'">
                                <input type="hidden" name="access_code" value="'.$access_code.'">
                                </form></center><script language="javascript">document.redirect.submit();</script>';
                        	//$url="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction";
                        	$vie = array(
                                //'url'           =>  "https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction",
                                //'encRequest'  =>  $encrypted_data,
                                'access_code'   =>  $access_code,
                                'merchant_id'   =>  $this->config->item("merchant_id"),
                                'orders'        =>  $orders,
                                'amount'        =>  $prince,
                                'redirect_url'  =>  base_url()."custmoer_paySuccess?customer_mobile=".$mobile."&transactionid=".$orders."&staus=1",
                                'cancel_url'    =>  base_url()."custmoer_paySuccess?customer_mobile=".$mobile."&transactionid=".$orders."&staus=3",
                                'rsa'           =>  $rsa,//$this->ccavenue->encrypt($merchant_data,$working_key),
                            );
                            $json   =   $this->vendor_model->jsonencodevalues("6",$vie,'0');
                        }
                   // }
                }
            }
            echo json_encode($json);
        }*/
        public function paySuccess(){
            $json        =  $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile      =  $_GET["customer_mobile"];
            $orderid     =  $_GET["transactionid"];
            $status      =  $_GET["staus"];//$this->input->post("status"); // 1= success ,2= failed 3=cancle 4=
            $paymentkeys =  $this->input->post("paymentkeys");
            //if($mobile !="" && $orderid !="" && $status !=""){
                $json   =   $this->vendor_model->jsonencodevalues('1',"Payment details update failed",'0');
                $dta = $this->order_model->update_order($mobile,$orderid,$status);
                if(count($dta) > 0){
                // added code 
                $par['whereCondition'] = "order_id LIKE '".$orderid."'";
                $order = $this->order_model->vieworderdetails($par);
                if(is_array($order) && count($order) > 0){
                    $i=0;$total1 = 0;
                    foreach ($order as $ve){
                        $custemail = ($ve->customer_email_id!="")?$ve->customer_email_id:'';
                        $id =   $ve->order_unique;
                        $ot     =   $ve->orderdetail_quantity*$ve->orderdetail_price;
                        $speciations = json_decode($ve->orderdetail_speciations);
                        $dta    =   $this->deliverycharges_model->getdeliverychg($speciations->cart_delivery_id);
                        if(is_array($dta)&& count($dta) > 0){
                            $timestamp1 = strtotime($dta['deliverychg_end']);
                            $end        =  date('g:i a', $timestamp1);
                            $timestamp  = strtotime($dta['deliverychg_start']);
                            $start      =  date('g:i a', $timestamp);
                            $time       = $start.' - '.$end;
                        }
                        $date       =   $speciations->cart_date;
                        $time       =   ($time)??'';
                        $imsg       =   $this->config->item("upload_url")."products/photo-not-available.png";
                        $target_dir =  $this->config->item("upload_url")."products/".$ve->vendorproductimg_name ;
                        if(@getimagesize($target_dir)){
                                $imsg   =   $target_dir;
                        }
                        $pric   =   $ve->orderdetail_quantity*$ve->orderdetail_price;
                        $deli=$this->customer_model->currency_change('INR',$ve->orderdetail_delivery_chage);
                        $data[$i] = array(
                            'pname'         =>  $ve->product_name,
                            'image'         =>  $imsg,
                            'id'            =>  $ve->order_unique,
                            'qty'           =>  $ve->orderdetail_quantity,
                            'total'         =>  $pric,
                            'delivery'      =>  $deli,
                            'placed'        =>  date_format(date_create($ve->order_created_on),"d/m/Y g:i a"),
                            'price'         =>  $ve->orderdetail_price,
                            'message'       =>  $speciations->cart_message_on_cake,
                            'Ingredients'   =>  $speciations->cart_indug,
                            'size'          =>  $speciations->cart_size,
                            'date'          =>  date_format(date_create($date),"d/m/Y"),
                            'time'          =>  $time,
                            'Name'          =>  $ve->customer_name,
                            'Mobile'        =>  $ve->customer_mobile,
                            'Locality'      =>  $ve->customeraddress_locality,
                            'Address'       =>  $ve->customeraddress_address,
                            'Pincode'       =>  $ve->customeraddress_pincode,
                        );
                        $toemail    = $ve->customer_email_id;
                        $total1  =   $total1+$ve->orderdetail_delivery_chage+$pric;
                        $i++;  
                    }
                    if($custemail != ""){
            	        $this->order_model->order_email($custemail,$data);
                    }
                }
                //// ended code for email
                    
                    
                    //$a['columns']  =   "customer_email_id";
                    //$a['whereCondition']  =   "order_id = '".$orderid."'";
                    // $details = $this->order_model->getorders($a);
                   // $toemail = $details['customer_email_id'];
            	   // $subject= "Order Information -minikart";
            	   // $messge= "Order Placed: Your order with Order ID ".$orderid." has been received. You can expect delivery by ASAP We will send you an update when your order is packed or shipped. Manage your order With www.minikart.in . Beware of fraudulent calls and messages. We do not ask bank info for offers or demand money.";
            	    //$messge= "Order Placed: Your order for ".$data[0]['Name']." with Order ID ".$orderid." amounting to ".$this->customer_model->currency_change('INR',$total1)." has been received. You can expect delivery by ASAP We will send you an update when your order is packed or shipped. Beware of fraudulent calls and messages. Minikart do not ask bank info for offers or demand money.";
            	   // $message_string = urlencode($message); 
            	   // $this->common_config->configemail($toemail,$subject,$messge);
                    //$this->mobile_otp->sendmobilemessage($mobile,$message_string);
                    if(isset($data[0]['Mobile'])){
                        $messgeee = "Order Placed: Your order for ".$data[0]['pname']." with Order ID ".$id." amounting to ".$this->customer_model->currency_change('INR',$total1)." has been received. You can expect delivery by ASAP We will send you an update when your order is packed or shipped. Beware of fraudulent calls and messages. Minikart do not ask bank info for offers or demand money.";
                    	$this->mobile_otp->sendmobilemessage($data[0]['Mobile'],$messgeee);
                    }
                    $html ='<body onload="showAndroidToast()">';
                    $html .='</body>';
                    $html .='<script type="text/javascript">
                            function showAndroidToast(){
                                var toast = "'.$_GET["staus"].'";
                                Android.showToast(toast);
                            }
                        </script>';
                    $json   =   $this->vendor_model->jsonencodevalues('2',$html,'0');
                    //echo $html;
                    //print_r($_GET["customer_mobile"].'<br>'.$_GET["transactionid"].'<br>'.$_GET["staus"]);exit;
                }
            //}
            echo json_encode($json);
        }
        public function payfailed(){
            $json        =  $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile      =  $_GET["customer_mobile"];
            $orderid     =  $_GET["transactionid"];
            $status      =  $_GET["staus"];
            $paymentkeys =  $this->input->post("paymentkeys");
            //if($mobile !="" && $orderid !="" && $status !=""){
                $json   =   $this->vendor_model->jsonencodevalues('1',"Payment details update failed",'0');
                $dta = $this->order_model->update_order($mobile,$orderid,$status);
                if(count($dta) > 0){
                    $html='<body onload="showAndroidToast()">';
                    $html .='</body>';
                    $html .='<script type="text/javascript">
                            function showAndroidToast() {
                                var toast = "2";
                                Android.showToast(toast);
                            }
                        </script>';
                    $json   =   $this->vendor_model->jsonencodevalues('2',$html,'0');
                }
            //}
            echo json_encode($json);
        }
        public function view_total(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");  
            if($mobile != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->customer_model->view_totalcart();
                    $json   =   $this->vendor_model->jsonencodevalues('2',"No products are available in cart",'0');
                    if(count($dta) > 0){
                        $json   =   $this->vendor_model->jsonencodevalues('3',$dta,'0');
                    } 
                }
            }
            echo json_encode($json);
        } 
        public function orders(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");  
            $country     =   $this->input->post("country");  
            if($mobile != "" && $country != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->customer_model->orders();
                    $json   =   $this->vendor_model->jsonencodevalues('2',"No orders are available yet",'0');
                    if(count($dta) > 0){
                        $json   =   $this->vendor_model->jsonencodevalues('3',$dta,'0');
                    } 
                }
            }
            echo json_encode($json);
        }
        public function order_details(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");  
            $orderid     =   $this->input->post("order_unique");
            $country     =   $this->input->post("country");  
            if($mobile != "" && $orderid != "" && $country != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->customer_model->order_details();
                    $json   =   $this->vendor_model->jsonencodevalues('2',"No orders are available yet",'0');
                    if(count($dta) > 0){
                        $json   =   $this->vendor_model->jsonencodevalues('3',$dta,'0');
                    } 
                }
            }
            echo json_encode($json);
        }
        public function search_products(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");
            $search_keyword     =   $this->input->post("search_keyword");
            if($mobile != "" || $mobile =="" && $search_keyword != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $data    =   array(  
                        "products"  =>  $this->customer_model->viewsearchproducts(),
                        "over_total"    =>  $this->customer_model->view_totalcart()
                    );
                    $json   =   $this->vendor_model->jsonencodevalues("2",$data,'0'); 
                }
            }
            echo json_encode($json);
        }
        public function add_to_wishlist(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile"); 
            $vendorproduct_id     =   $this->input->post("vendorproduct_id"); 
            if($mobile != "" && $vendorproduct_id != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->customer_model->add_to_wishlist();
                    $json   =   $this->vendor_model->jsonencodevalues('2',"Not added any product to wishlist",'0');
                    if($dta == 0){
                        $json   =   $this->vendor_model->jsonencodevalues('3',"Product does not exists",'0');
                    } 
                    if($dta == 1){
                        $json   =   $this->vendor_model->jsonencodevalues('4',"Added product to wishlist successfully",'0');
                    } 
                    if($dta == 3){
                        $json   =   $this->vendor_model->jsonencodevalues('5',"Already in wishlist",'0');
                    } 
                }
            }
            echo json_encode($json);
        } 
        public function view_wishlist(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");  
            if($mobile != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->customer_model->view_wishlist();
                    $json   =   $this->vendor_model->jsonencodevalues('2',"No products yet in your wishlist",'0');
                    if(count($dta) > 0){
                        $json   =   $this->vendor_model->jsonencodevalues('3',$dta,'0');
                    }
                }
            }
            echo json_encode($json);
        } 
        public function delete_wishlist(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile"); 
            $cart_id     =   $this->input->post("wishlist_id"); 
            if($mobile != "" && $cart_id != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->customer_model->deletewishlist();
                    $json   =   $this->vendor_model->jsonencodevalues('2',"Not deleted any product from wishlist",'0');
                    if($dta == 0){
                        $json   =   $this->vendor_model->jsonencodevalues('3',"Product does not exists",'0');
                    } 
                    if($dta == 1){
                        $json   =   $this->vendor_model->jsonencodevalues('4',"Deleted product successfully from wishlist",'0');
                    } 
                }
            }
            echo json_encode($json);
        } 
        public function reorders(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");  
            $orderid     =   $this->input->post("order_unique");
            if($mobile != "" && $orderid != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->customer_model->reorders();
                    $json   =   $this->vendor_model->jsonencodevalues('2',"No reorder has been placed.Please try again",'0');
                    if($dta){
                        $json   =   $this->vendor_model->jsonencodevalues('3',"Reorder successfully",'0');
                    } 
                }
            }
            echo json_encode($json);
        }
        public function countries_list(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Server Error");
            $vsp = $this->vendor_model->viewCountries();
            if(is_array($vsp) && count($vsp) >0){
                $data =array();$i=0;
                foreach($vsp as $c){
                    $data[$i]['country_id']     =  $c->country_id;
                    $data[$i]['country_name']   =  $c->country_name;
                    $i++;
                }
                $json   =   $data;//$this->vendor_model->jsonencodevalues('1',"Reorder successfully",'0');
                
            }
            echo json_encode($json);
        }
    	public function mailtest(){
    	    $toemail = 'sivaappalabattula92@gmail.com';
    	    $subject= "Sample Testing mail";
    	    $messge= "Sample Testing Message";
    	   echo $this->common_config->configemail($toemail,$subject,$messge);
    	}
    	
    	public function api_districtlist(){
            $pre['where_condition']     = "pincodeopen = 1";
            $pre['group_by']    = "pincode_district";
            $states = $this->pincode_model->viewPincode($pre);
            $json =  $this->vendor_model->jsonencodevalues("0","Server Error");
            if(is_array($states) && count($states) >0){
                $i=0;$jsons = array();
                foreach ($states as $frt){
                    $jsons[$i]['district']  = $frt->pincode_district;
                    $jsons[$i]['area']      = $frt->pincode_village;
                    $jsons[$i]['pincode']   = $frt->pincode;
                $i++;
                }
                $json = json_encode(array('status'=>'1','status_messsage'=>$jsons));//this->vendor_model->jsonencodevalues('1',$jsons,'0');
            }
            echo $json;
        }
        public function pincodecheck(){
            $district = $this->input->post('district');
            $pincode = $this->input->post('pincode');
            $json =  $this->vendor_model->jsonencodevalues("0","Some fields are required");
            if($district != "" || $pincode != ""){
                $pre['where_condition']     = "pincodeopen = 1 AND pincode_district LIKE '".$district."' OR pincode LIKE '".$pincode."'";
                $pre['group_by']    = "pincode_district";
                $states = $this->pincode_model->viewPincode($pre);
                //print_r(count($states));exit;
                $json =  $this->vendor_model->jsonencodevalues("1","delivery not available");
                if(count($states) > 0){
                    $json = $this->vendor_model->jsonencodevalues("2","delivery available");
                }
            }
            echo $json;
        }
        public function districtlist(){
            $district_id = $this->input->post('district_id');
            $select = $this->input->post('select');
            $res = $this->common_model->districtlist($district_id);
            $html = '<option value="">Select Area</option>';
            if(is_array($res) && count($res) >0){
                foreach ($res as $frt){
                    $slect='';
                    if($select !=""){
                        if($frt->pincode_village == $select){
                            $slect = "selected";
                        }
                    }
                    $html .= "<option value=".$frt->pincode_village." ".$slect.">".$frt->pincode_village."</option>";
                }
            }
            echo $html;
        }
        public function api_customer_area(){
            $district_id = $this->input->post('district_name');
            $res = $this->common_model->districtlist($district_id);
            $json =  $this->vendor_model->jsonencodevalues("0","Server Error");
            if(is_array($res) && count($res) > 0){
                $i=0;$jsons = array();
                foreach ($res as $frt){
                    $jsons[$i]['district']  = $frt->pincode_district;
                    $jsons[$i]['area']      = $frt->pincode_village;
                    $jsons[$i]['pincode']   = $frt->pincode;
                    $i++;
                }
                $json = json_encode(array('status'=>'1','status_messsage'=>$jsons));//$this->vendor_model->jsonencodevalues('1',$jsons,'0');
            }
            echo $json;
        }
        public function reminders(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");
            if($mobile != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->customer_model->reminders();
                    $json   =   $this->vendor_model->jsonencodevalues('2',"No reminder has been placed.Please try again",'0');
                    if($dta){
                        $json   =   $this->vendor_model->jsonencodevalues('3',$dta,'0');
                    } 
                }
            }
            echo json_encode($json);
        }
        public function addreminders(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");
            $title      =   $this->input->post("title");
            $date       =   $this->input->post("date");
            $type       =   $this->input->post("type");
            $note       =   $this->input->post("note");
            if($mobile != "" && $title != "" && $date !="" && $type !=""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->customer_model->addreminders();
                    $json   =   $this->vendor_model->jsonencodevalues('2',"Add reminder failed",'0');
                    if($dta){
                        $json   =   $this->vendor_model->jsonencodevalues('3','Add reminder succfully','0');
                    } 
                }
            }
            echo json_encode($json);
        }
        public function updatereminders(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");
            $reminder_id=   $this->input->post("reminder_id");
            $title      =   $this->input->post("title");
            $date       =   $this->input->post("date");
            $type       =   $this->input->post("type");
            $note       =   $this->input->post("note");
            if($mobile != "" && $title != "" && $date !="" && $type !="" && $reminder_id !=""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->customer_model->update_reminder($reminder_id);
                    $json   =   $this->vendor_model->jsonencodevalues('2',"No reminder has been placed.Please try again",'0');
                    if($dta){
                        $json   =   $this->vendor_model->jsonencodevalues('3','Update reminder succfully.','0');
                    } 
                }
            }
            echo json_encode($json);
        }
        public function deletereminders(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");
            $reminder_id=   $this->input->post("reminder_id");
            if($mobile != "" && $reminder_id !=""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->customer_model->delete_reminders($reminder_id);
                    $json   =   $this->vendor_model->jsonencodevalues('2',"No reminder has been placed.Please try again",'0');
                    if($dta){
                        $json   =   $this->vendor_model->jsonencodevalues('3',"Delete reminder succfully",'0');
                    } 
                }
            }
            echo json_encode($json);
        }
        public function occasionlist(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");
            if($mobile != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $dta    =   $this->customer_model->occasionlist();
                    $json   =   $this->vendor_model->jsonencodevalues('2',"No occasion list has been placed.Please try again",'0');
                    if($dta){
                        $json   =   $this->vendor_model->jsonencodevalues('3',$dta,'0');
                    } 
                }
            }
            echo json_encode($json);
        }
        public function AreaList(){
            $district_id = $this->input->post('district_id');
            $area_id = $this->input->post('area_id');
            $pincode = $this->input->post('pincode');
            $res = $this->common_model->districtlist($district_id,$area_id);
            $html = '<option value="">Select Pincode</option>';
            if(is_array($res) && count($res) >0){
                foreach ($res as $frt){
                    $select='';
                    if($pincode !=""){
                        if($frt->pincode == $pincode){
                            $select = 'selected';
                        }
                    }
                    $html .= "<option value=".$frt->pincode." ".$select.">".$frt->pincode."</option>";
                }
            }
            echo $html;
        }
        public function api_popup(){
            $psm['where_condition']  =   "notification_abc = 'Active'";
            $vue    =   $this->notification_model->viewNotifications($psm);
            //print_r($vue);
            foreach($vue as $vv){
                $vv   = (array) $vv;
                $image    =  $this->config->item("upload_url")."notification-uploads/".$vv['notification_image'];
                $title  = $vv['notification_title'];
            } 
            $json   =   $this->vendor_model->jsonencodevalues('0','No popups are in active','0');
            if(!empty($image) || !empty($title)){
                $datas  =   array(
                    'title' => $title,
                    'image' => $image
                    );
                $json   =   $this->vendor_model->jsonencodevalues('1',$datas,'0');
                
            }
            echo json_encode($json);
        }
        public function coupon(){
            $country = $this->input->post("country");
            $coupon = ($this->input->post('coupon_code'))??'';
            $mobile     =   $this->input->post("customer_mobile");
            $total     =    $this->input->post('cart_total');
            $r   =   json_encode($this->vendor_model->jsonencodevalues('0','Some feilds are missing','0'));
            if(!empty($mobile) && !empty($total)){
            $r   =   json_encode($this->vendor_model->jsonencodevalues('5','Coupon Removed','0'));
                if(!empty($coupon)){
                    $r  =   $this->coupon_model->Coupon_check($coupon,$mobile,$total);
                    $d  =(array)json_decode($r);
                    if($d['status']=="4"){
                        $coupon_data = (array)$d['status_messsage'];
                        $coupon_cart    =   $this->customer_model->view_cart_total_coupon();
                        $total_cart     =   $this->customer_model->view_totalcart();
                        $coupon_cart = preg_replace('/[^0-9.]+/', '', $coupon_cart[0]['cart_total']);
                        $total_cart = preg_replace('/[^0-9.]+/', '', $total_cart[0]['cart_total']);
                        $coupon_data['cart_total_coupon']   =  $this->customer_model->currency_change($country,$coupon_cart);
                        $coupon_data['overall_total']       =  $this->customer_model->currency_change($country,$total_cart);
                        $coupon_data['discount']            =  $this->customer_model->currency_change($country,(float)$total_cart-(float)$coupon_cart);
                        
                      //  $coupon_data['discount']            =  $coupon_data['overall_total']-$coupon_data['cart_total_coupon'];
                        $r   =   json_encode($this->vendor_model->jsonencodevalues('4',$coupon_data,'0'));
                        
                    }
                    
                }
            }
            
            
            echo $r;
        }
        public function customer_refer_earn(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("customer_mobile");
            if($mobile != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $ch =   $this->customer_model->refer_earn();
                    $json   =   $this->vendor_model->jsonencodevalues("2","getting details failed",'0'); 
                    if(count($ch)>0){
                        $json   =   $this->vendor_model->jsonencodevalues("3",$ch,'0');
                    }
                }
            }
            echo json_encode($json);
        }
        public function customer_review(){
            $json           =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile         =   $this->input->post("customer_mobile");
            $rating         =   $this->input->post("rating");
            $product_id     =   $this->input->post("product_id");
            $order_id       =   $this->input->post("order_id");
            if($mobile != "" && $rating != "" && $product_id != "" && $order_id != ""){
                $check      =   $this->customer_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0'); 
                if($check){
                    $ch =   $this->customer_model->review_rating();
                    $json   =   $this->vendor_model->jsonencodevalues("2","Rating Submission failed",'0'); 
                    if(count($ch)>0){
                        $json   =   $this->vendor_model->jsonencodevalues("3","Rating Submitted Successfully",'0');
                    }
                }
            }
            echo json_encode($json);
        }
}