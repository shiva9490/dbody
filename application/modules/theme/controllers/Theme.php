<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Theme extends CI_Controller{
        public function __construct() {
                parent::__construct();
        }
        public function index(){
                $pages  =   $this->pages_model->view_active_home();
                if($pages != "" && count($pages) > 0){
                    $srril  =   unserialize($pages['cpage_seo_settings']);
                    $dta    =   array(
                        "content"   =>  "index",
                        "layout"    =>  $pages,
                        "metakeys"  =>  $srril["meta_keys"],
                        "metadesc"  =>  $srril["meta_desc"],
                    );
                    if(empty(get_cookie('popup'))){
                        $dta['popup']   =   TRUE;
                         //$this->session->set_userdata("popup",'1');
                         set_cookie('popup','1','300'); 
                    }
                    // if( empty($this->session->userdata("popup"))){
                    //     $dta['popup']   =   TRUE;
                    //      $this->session->set_userdata("popup",'1');
                    // }
                    $this->load->view("theme/inner_template",$dta);
                }else{
                    $this->pagenotfound();
                }
        }
        public function ajax_trending(){
                $this->load->view("theme/ajax_trending");
        }
        
        public function logout(){
                $this->session->sess_destroy();
                redirect("/");
        }
        public function pageview(){
                //$this->theme->cur();
                $vsp    =   $this->uri->segment("1");//echo $vsp;exit;
                $uro    =   $vsp;
                $pages  =   $this->pages_model->get_pagehere($uro);

                if(!empty($this->uri->segment("1")) || !empty($this->uri->segment("2"))){
                    if($this->uri->segment("2")){
                        $pri    =   $this->uri->segment("2");
                    }else{
                        $pri    =   $this->uri->segment("1");
                    }
                    $psm['where_condition'] = "subcategory_keywords LIKE '".$pri."'";
                    $psm['tiporderby']  =   "subcategory_name";
                    $psm['order_by']    =   "ASC";
                    $products            =   $this->category_model->get_subcategory($psm);
                }
                if($pages != "" && count($pages) > 0){
                    $srril  =   unserialize($pages['cpage_seo_settings']);
                    $dta    =   array(
                        "content"   =>  "pageview",
                        "layout"    =>  $pages,
                        "pageview"  =>  $pages['cpage_title'],
                        "metakeys"  =>  $srril["meta_keys"],
                        "metadesc"  =>  $srril["meta_desc"],
                    );
                    $this->load->view("theme/inner_template",$dta);
                }elseif($products != "" && count($products) > 0){
                    $uri    =   strtolower(str_replace("_"," ",$pri)); 
                    $data = array(
                        "content"       =>  "product_list",
                        "categonmae"    =>  ucwords($uri)
                    );
                    $data["view"]       =   $this->category_model->getCategory($psm);
                    $conditions = array(); 
                    $keywords   =   $this->input->get('keywords'); 
                    if(!empty($keywords)){
                        $conditions['keywords'] = $keywords;
                    }   
                    $conditions["whereCondition"]   =   "(subcategory_keywords) LIKE '".($pri)."'";
                    $perpage        =    $this->input->get("limitvalue")?$this->input->get("limitvalue"):sitedata("site_mainpagination");
                    $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
                    $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"vendorproductid"; 
                    $totalRec               =   $this->vendor_model->cntviewvendors($conditions);  
                    if(!empty($orderby) && !empty($tipoOrderby)){ 
                            $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                            $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
                    }
                    $config['base_url']     =   base_url('ajaxvendorproducts');
                    $config['total_rows']   =   $totalRec;
                    $config['per_page']     =   $perpage; 
                    $config['link_func']    =   'searchFilter';
                    $this->ajax_pagination->initialize($config);
                    $conditions['limit']    =   $perpage;
                    $data["subp"]            =   $this->vendor_model->viewVendors($conditions);
                    print_r($data["subp"]);exit;
                    $this->load->view('theme/inner_template',$data);
                }else{
                    $this->pagenotfound();
                }
        }
        public function storelocators(){
            $psm["order_by"] = "ASC";
            $psm["tiporderby"] = "category_name";
            $dta = array(
                    "content"  => "storelocators",
                    "vatr"   =>  $this->category_model->viewCategory($psm)
            );
            $this->load->view("theme/inner_template",$dta);
        }
		public function cart(){
			$dta = array(
				"content"  => "cart"
			);
			$this->load->view("theme/inner_template",$dta);			
		}
        public function cart_list(){
            if($this->session->userdata('customer_id') == ""){
                redirect("/");
            }else{
                $dta = array(
                        "content"  => "cart_list"
                );
                $currency = $this->session->userdata("currency_code");
                $datas= array();
        	    $datas['id']= '';
    	        if($this->input->post('CheckOut') && $this->input->post('customeraddress_id') != ""){
    	            /*cart data*/
    	            $vtoal  =   "0";$amot="0";
                    $rtotl     =   $this->cart->contents();
                    if(count($rtotl) > 0){
                        $rirl   =   "0";$i=1;
                        foreach($rtotl as $fr){
                            //echo '<pre?';print_r($fr);exit;
                            $vtoal      =  "0";
                            $vsso       =  $fr['name'];
                            $delivery   =  isset($fr['delamount'])?$fr['delamount']:'0';
                            $total      =  $fr["qty"]*$fr["price"] ;
                            $rirl   +=  $fr["qty"]*$fr["price"]+$delivery;
                        }
                        if($currency == "INR"){
                            $amot = $rirl;
                        }else{
                           $amot = $this->customer_model->currency_change_payment($currency,$rirl);
                        }
                    }
                    /*End cart data*/
                    /*delivery address*/
                    if($this->input->post('customeraddress_id') != ""){
                        $par['whereCondition'] = "customeraddress_id  LIKE  '".$this->input->post('customeraddress_id')."'";
                        $address = $this->customer_model->getCustomeraddress($par);
                    }
                    /*End delivery address*/
                        $orders = $this->order_model->addorder($this->session->userdata('customer_id'));
                        $r = $this->order_model->checkouts($this->session->userdata('customer_id'),$orders);
            		    $data=array(
                			'tid'               =>  strtotime(date('y-m-d H:i:s a')),
                            'merchant_id'       =>  $this->config->item("merchant_id"),
                            'order_id'          =>  ($orders !="")?$orders:'',
                            'amount'            =>  $amot,
                            'currency'          =>  ($currency !="")?$currency:'INR',
                            'redirect_url'      =>  base_url('paySuccess'),
                            'cancel_url'        =>  base_url('paySuccess'),
                            'language'          =>  'EN',
                            'delivery_name'     =>  ($address['customeraddress_fullname'] !="")?$address['customeraddress_fullname']:'',
                            'delivery_address'  =>  ($address['customeraddress_address'] !="")?$address['customeraddress_address']:'',
                            'delivery_city'     =>  ($address['customeraddress_district'] !="")?$address['customeraddress_district']:'',
                            'delivery_state'    =>  ($address['customeraddress_district'] !="")?$address['customeraddress_district']:'',
                            'delivery_zip'      =>  ($address['customeraddress_pincode'] !="")?$address['customeraddress_pincode']:'',
                            'delivery_country'  =>  'India',
                            'delivery_tel'      =>  ($address['customeraddress_mobile'] !="")?$address['customeraddress_mobile']:'',
            		    );
            		    //echo '<pre>';print_r($data);exit;
                    	$merchant_data='';
                    	$working_key = $this->config->item("working_key");//Shared by CCAVENUES
                    	$access_code = $this->config->item("access_code");//Shared by CCAVENUES
                    	foreach ($data as $key => $value){
                    		$merchant_data.=$key.'='.$value.'&';
                    	}
                        //$this->load->library('ccavenue');
                    	$encrypted_data = $this->ccavenue->encrypt($merchant_data,$working_key); 
                    	//$datas = array(
                    	//    'id'    => var_dump($encrypted_data), 
                    	//    'aces'  => var_dump($access_code), 
                    	//);
                        ?>
                        <form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
                        <!--<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction">-->
                        <input type="hidden" name="encRequest" value="<?php echo $encrypted_data;?>">
                        <input type="hidden" name="access_code" value="<?php echo $access_code;?>">
                        </form></center><script language='javascript'>document.redirect.submit();</script>
                        <?php
    	        }
                $this->load->view("theme/inner_template",$dta);
            }
        }
        public function pay_razar(){
            //print_r($this->input->post());exit;
             if($this->session->userdata('customer_id') == ""){
                redirect("/");
            }else{
                if($this->input->post('razorpay_payment_id') != ""){
                    $r = $this->order_model->addorder($this->session->userdata('customer_id'));
                    //print_r($r);exit;
                    if($r != ''){
                        //$this->cart->destroy();
                        redirect('Success/'.base64_encode($r));
                    }else{
                        redirect('/');
                    }
                }
            }
        }
        public function paySuccess(){
            //print_r($_POST);exit;
            //$Orderid = 'ORD291';
            if($_POST != " "){
                error_reporting(0);
                $working_key = $this->config->item("working_key"); //Shared by CCAVENUES
                $access_code = $this->config->item("access_code");
                $merchant_json_data =
                array(
                    'order_no'      => ($_POST['orderNo']!="")?$_POST['orderNo']:$this->input->post('orderNo'),
                	//'reference_no'  =>  $_POST['orderNo']
                );
                $merchant_data = json_encode($merchant_json_data);
                $encrypted_data = $this->ccavenue->encrypt($merchant_data, $working_key);
                $final_data = 'enc_request='.$encrypted_data.'&access_code='.$access_code.'&command=orderStatusTracker&request_type=JSON&response_type=JSON';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://apitest.ccavenue.com/apis/servlet/DoWebTrans");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_VERBOSE, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER,'Content-Type: application/json') ;
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $final_data);
                // Get server response ...
                $result = curl_exec($ch);
                curl_close($ch);
                $status = '';
                $information = explode('&', $result);
                $dataSize = sizeof($information);
                for ($i = 0; $i < $dataSize; $i++){
                    $info_value = explode('=', $information[$i]);
                    if ($info_value[0] == 'enc_response'){
                	    $status = $this->ccavenue->decrypt(trim($info_value[1]), $working_key);
                    }
                }
                /* Responce api*/
                $obj       = json_decode($status);
                $statuss   = $status;
                $sta       = json_decode($status,'true');
                
               // $status ="";
               // $tracking_id ="";
               // $order_status ="";
               // $bank_ref_no ="";
                $tracking_id    =   $sta['Order_Status_Result']['order_bank_ref_no'];
                $order_status   =   $sta['Order_Status_Result']['order_status'];
                $order_no       =   $sta['Order_Status_Result']['order_no'];
                $order_currncy  =   $sta['Order_Status_Result']['order_currncy'];
                
               // print_r($order_status);exit;
               /* $workingKey = $this->config->item("working_key");
            	$encResponse = $_POST["encResp"];
            	$rcvdString = $this->ccavenue->decrypt($encResponse,$workingKey);
            	
            	$decryptValues = explode('&', $rcvdString);
            	$dataSize   = sizeof($decryptValues);
            	
            	$dataSizes=array();
            	for($i = 0; $i < $dataSize; $i++){
            		$information = explode('=',$decryptValues[$i]);
            		for($j = 0; $j < count($information); $j++){
            		    $dataSizes[$i][$j] =$information[$j];
            		}
            		if($i==1){
            		    $tracking_id =$information[1];
            		}
            		if($i==2){
                        $bank_ref_no = $information[1];
            		}
            		if($i==3){
                        $order_status = $information[1];
            		}
            	}
            	*/
            	
            	if($order_status==="Successful"){
            	    $statuss="1";
            	}else if($order_status==="Aborted"){
            	    $statuss="2";
            	}else if($order_status==="Failure"){
            	    $statuss="3";
            	}else if($order_status==="Unsuccessful"){
            	    $statuss="4";
            	}
            	$par['whereCondition'] = "order_id LIKE '".$order_no."'";
                $order = $this->order_model->getorders($par);
                if(is_array($order) && count($order) > 0){
                    $par['whereCondition'] = "customer_id LIKE '".$order["order_customer_id"]."'"; 
                    $vsp = $this->customer_model->getCustomer($par);
                    $this->session->set_userdata("customer_id",$vsp["customer_id"]);
                    $this->session->set_userdata("customer_mobile",$vsp["customer_mobile"]);
                    $this->session->set_userdata("customer_email_id",$vsp["customer_email_id"]);
                    $this->session->set_userdata("currency_code",$order_currncy);
                    $mobile     = $vsp["customer_mobile"];
                }
                $d = array(
                    'order_razor_payment_id'     => ($tracking_id!="")?$tracking_id:'',
                    'order_modified_on'          => date('Y-m-d H:i:s'),
                    'order_modified_by'          => $this->session->userdata('customer_id'),
                    'order_payment_status'       => $statuss,
                    'order_gatepayment_status'   => $order_status,
                    'order_payment_responce'     => json_encode($sta['Order_Status_Result']),
                );
                $r = $this->order_model->update_order($this->session->userdata('customer_id'),$order_no,$d);
                if($r > 0){
                    if($order_status==="Successful"){
                        
                        $par['whereCondition'] = "orderdetail_orderid LIKE '".$order_no."'";
                        $order_details = $this->order_model->getorderdetails($par);
                        $toemail = $order_details['cp.customer_email_id'];
                	    $subject= "Minikart - Payment";
                        $messge     =   "Your Payment successful of order id :".$orderid;
                	    $this->common_config->configemail($toemail,$subject,$messge);
                        $vsp        =   $this->mobile_otp->sendmobilemessage($mobile,$messge);
                        $this->cart->destroy();
                        redirect('Success/'.base64_encode($order_no));
                    }else if($order_status==="Failure" || $order_status==="Unsuccessful" || $order_status == " "){
                        if($order_status != ""){
                            $this->cart->destroy();
                        }
                        redirect('Payment-Failed/'.base64_encode($order_no));
                    }
               }
            }else{
                redirect('/');
            }
        }
        public function payment_failed($id =null){
            if(!empty($id) && $this->session->userdata('customer_id')!=""){
                $this->cart->destroy();
                $country = $this->session->userdata("currency_code");
                $par['whereCondition'] = "order_id LIKE '".base64_decode($id)."' AND order_customer_id='".$this->session->userdata('customer_id')."'";
                $order = $this->order_model->getorders($par);
                $dta = array(
                    "content"   => "payment_failed",
                    'view'      => $order
                );
                $this->load->view("theme/inner_template",$dta);
            }else{
                redirect('/');
            }
        }
        public function pagenotfound(){
            $dta = array(
                    "content"  => "pagenotfound" 
            );
            $this->load->view("theme/inner_template",$dta);
        }
        public function success($id =null){
            if(!empty($id) && $this->session->userdata('customer_id')!=""){
                $country = $this->session->userdata("currency_code");
                $par['whereCondition'] = "order_id LIKE '".base64_decode($id)."' AND order_customer_id='".$this->session->userdata('customer_id')."'";
                
                
                
                
                // -----------added message template ----------//
                
                 $order = $this->order_model->vieworderdetails($par);
                if(count($order) >0){
            //         $i=0;$total1 = 0;
            //         foreach ($order as $ve){
            //             $id =   $ve->order_unique;
            //             $ot     =   $ve->orderdetail_quantity*$ve->orderdetail_price;
            //             $speciations = json_decode($ve->orderdetail_speciations);
            //             $dta    =   $this->deliverycharges_model->getdeliverychg($speciations->cart_delivery_id);
            //             if(is_array($dta)&& count($dta)  > 0){
            //                 $timestamp1 = strtotime($dta['deliverychg_end']);
            //                 $end        =  date('g:i a', $timestamp1);
            //                 $timestamp  = strtotime($dta['deliverychg_start']);
            //                 $start      =  date('g:i a', $timestamp);
            //                 $time       = $start.' - '.$end;
            //             }
            //             $date= $speciations->cart_date;
            //             $time= ($time)??'';
            //             $imsg   =   $this->config->item("upload_url")."products/photo-not-available.png";
            //             $target_dir =  $this->config->item("upload_url")."products/".$ve->vendorproductimg_name ;
            //             if(@getimagesize($target_dir)){
            //                     $imsg   =   $target_dir;
            //             }
            //             $pric   =   $ve->orderdetail_quantity*$ve->orderdetail_price;
            //             $deli=$this->customer_model->currency_change('INR',$ve->orderdetail_delivery_chage);
            //             $data[$i] = array(
            //                 'pname' => $ve->product_name,
            //                 'image' =>$imsg,
            //                 'id' =>$ve->order_unique,
            //                 'qty'  => $ve->orderdetail_quantity,
            //                 'total' => $pric,
            //                 'delivery'  => $deli,
            //                 'placed'    => date_format(date_create($ve->order_created_on),"d/m/Y g:i a"),
            //                 'price' =>  $ve->orderdetail_price,
            //                 'message'   => $speciations->cart_message_on_cake,
            //                 'Ingredients'   => $speciations->cart_indug,
            //                 'size'  => $speciations->cart_size,
            //                 'date'  => date_format(date_create($date),"d/m/Y"),
            //                 'time'  => $time,
            //                 'Name'=> $ve->customer_name,
            //                 'Mobile'    =>  $ve->customer_mobile,
            //                 'Locality'  =>  $ve->customeraddress_locality,
            //                 'Address'   =>  $ve->customeraddress_address,
            //                 'Pincode'   =>  $ve->customeraddress_pincode,
            //             );
            //             $toemail    = $ve->customer_email_id;
            //             $total1  =   $total1+$ve->orderdetail_delivery_chage+$pric;
            //               $i++;  
            //         }
            // 	    $subject= "Order Information -minikart";
            // 	    $messge = '<!DOCTYPE html>
            //                     <html>
                                
            //                     <head>
            //                         <title></title>
            //                         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            //                         <meta name="viewport" content="width=device-width, initial-scale=1">
            //                         <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            //                         <link rel="stylesheet" href="https://www.minikart.in//assets/css/all.min.css">
            //                         <link rel="stylesheet" href="https://www.minikart.in//assets/css/style.css">
            //                         <style type="text/css">
            //                             body,
            //                             table,
            //                             td,
            //                             a {
            //                                 -webkit-text-size-adjust: 100%;
            //                                 -ms-text-size-adjust: 100%;
            //                             }
                                
            //                             table,
            //                             td {
            //                                 mso-table-lspace: 0pt;
            //                                 mso-table-rspace: 0pt;
            //                             }
                                
            //                             img {
            //                                 -ms-interpolation-mode: bicubic;
            //                             }
                                
            //                             img {
            //                                 border: 0;
            //                                 height: auto;
            //                                 line-height: 100%;
            //                                 outline: none;
            //                                 text-decoration: none;
            //                             }
                                
            //                             table {
            //                                 border-collapse: collapse !important;
            //                             }
                                
            //                             body {
            //                                 height: 100% !important;
            //                                 margin: 0 !important;
            //                                 padding: 0 !important;
            //                                 width: 100% !important;
            //                             }
                                
            //                             a[x-apple-data-detectors] {
            //                                 color: inherit !important;
            //                                 text-decoration: none !important;
            //                                 font-size: inherit !important;
            //                                 font-family: inherit !important;
            //                                 font-weight: inherit !important;
            //                                 line-height: inherit !important;
            //                             }
                                
            //                             @media screen and (max-width: 480px) {
            //                                 .mobile-hide {
            //                                     display: none !important;
            //                                 }
                                
            //                                 .mobile-center {
            //                                     text-align: center !important;
            //                                 }
            //                             }
                                
            //                             div[style*="margin: 16px 0;"] {
            //                                 margin: 0 !important;
            //                             }
            //                         </style>
                                
            //                     <body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">
            //                         <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Open Sans, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
            //                             For what reason would it be advisable for me to think about business content? That might be little bit risky to have crew member like them.
            //                         </div>
            //                         <table border="0" cellpadding="0" cellspacing="0" width="100%">
            //                             <tr>
            //                                 <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">
            //                                     <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
            //                                         <tr>
            //                                             <td align="center" valign="top" style="font-size:0; padding: 15px;" bgcolor="#fff">
            //                                                 <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
            //                                                     <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
            //                                                         <tr>
            //                                                             <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;" class="mobile-center">
            //                                                                 <img src="https://www.minikart.in//assets/images/logo.png" alt="logo" style="max-height:20vh;">
            //                                                             </td>
            //                                                         </tr>
            //                                                     </table>
            //                                                 </div>
            //                                                 <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;" class="mobile-hide">
            //                                                     <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
            //                                                         <tr>
            //                                                             <td align="right" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;">
            //                                                                 <table cellspacing="0" cellpadding="0" border="0" align="right">
            //                                                                     <tr>
            //                                                                         <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400;">
            //                                                                             <p style="font-size: 18px; font-weight: 400; margin: 0; color: #000;"><a href="https://www.minikart.in" target="_blank" style="color: #000; text-decoration: none;">Shop &nbsp;</a></p>
            //                                                                         </td>
            //                                                                         <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 24px;"> <a href="https://www.minikart.in" target="_blank" style="color: #ffffff; text-decoration: none;"><img src="https://img.icons8.com/color/48/000000/small-business.png" width="27" height="23" style="display: block; border: 0px;" /></a> </td>
            //                                                                     </tr>
            //                                                                 </table>
            //                                                             </td>
            //                                                         </tr>
            //                                                     </table>
            //                                                 </div>
            //                                             </td>
            //                                         </tr>
            //                                         <tr>
            //                                             <td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
            //                                                 <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
            //                                                     <tr>
            //                                                         <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <img src="https://www.minikart.in//assets/images/check.png" width="125" height="120" style="display: block; border: 0px;" /><br>
            //                                                             <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Hi..! '.$data[0]['Name'].', </h2>
            //                                                         </td>
            //                                                     </tr>
            //                                                     <tr>
            //                                                         <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> 
            //                                                             <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Thank You For Your Order! </h2>
            //                                                         </td>
            //                                                     </tr>
            //                                                     <tr>
            //                                                         <td width="25%" align="right">
            //                                                         <br> Order Placred On : '.$data[0]['placed'].'
            //                                                         </td>
            //                                                     </tr>
                                                               
            //                                                     <tr>
            //                                                         <td align="left" style="padding-top: 20px;">
            //                                                             <table cellspacing="0" cellpadding="0" border="0" width="100%">
            //                                                                  <tr>
            //                                                                     <td width="75%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;" colspan="2"> Order Confirmation # </td>
            //                                                                     <td width="25%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;"> '.$id.' </td>
            //                                                                 </tr>';
            //                                                                 foreach($data as $d){
            //                                                                   $messge .=  '<tr>
            //                                                                                 <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> <img src="'.$d["image"].'" > </td>
            //                                                                                 <td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> '.$d["pname"].' X '.$d["qty"].' </td>
            //                                                                                 <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> '.$this->customer_model->currency_change('INR',$d["total"]).' </td>
            //                                                                             </tr><tr><td colspan="3">';
            //                                                                     if(!empty($d['message'])){
            //                                                                         $messge .='message to display : '.$d['message'];
            //                                                                     }
            //                                                                     if(!empty($d['Ingredients'])){
            //                                                                         $messge .='Ingredients : '.$d['Ingredients'];
            //                                                                     }
            //                                                                     if(!empty($d['size'])){
            //                                                                         $messge .='size : '.$d['size'];
            //                                                                     }
            //                                                                     $messge .= '</td></tr>';
            //                                                                 }
                                                                            
            //                                                             $messge .='</table>
            //                                                         </td>
            //                                                     </tr>
            //                                                     <tr>
            //                                                         <td align="left" style="padding-top: 20px;">
            //                                                             <table cellspacing="0" cellpadding="0" border="0" width="100%">
            //                                                                 <tr>
            //                                                                     <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 13px; font-weight: 400; line-height: 24px; padding: 10px;"> Delivery Charges </td>
            //                                                                     <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 13px; font-weight: 400; line-height: 24px; padding: 10px;"> '.$deli.' </td>
            //                                                                 </tr>
            //                                                                 <tr>
            //                                                                     <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;"> TOTAL </td>
            //                                                                     <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;"> '.$this->customer_model->currency_change('INR',$total1).' </td>
            //                                                                 </tr>
            //                                                             </table>
            //                                                         </td>
            //                                                     </tr>
            //                                                 </table>
            //                                             </td>
            //                                         </tr>
            //                                         <tr>
            //                                             <td align="center" height="100%" valign="top" width="100%" style="padding: 0 35px 35px 35px; background-color: #ffffff;" bgcolor="#ffffff">
            //                                                 <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:660px;">
            //                                                     <tr>
            //                                                         <td align="center" valign="top" style="font-size:0;">
            //                                                             <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">
            //                                                                 <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
            //                                                                     <tr>
            //                                                                         <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
            //                                                                             <p style="font-weight: 800;">Delivery Address</p>
            //                                                                             <p>'.$data[0]["Name"].'<br>'.$data[0]["Mobile"].'<br>'.$data[0]["Locality"].'<br>'.$data[0]["Address"].'<br>'.$data[0]["Pincode"].'<br></p>
            //                                                                         </td>
            //                                                                     </tr>
            //                                                                 </table>
            //                                                             </div>
            //                                                             <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">
            //                                                                 <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
            //                                                                     <tr>
            //                                                                         <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
            //                                                                             <p style="font-weight: 800;">Estimated Delivery</p>
            //                                                                             <p> on '.$data[0]["date"].' , between '.$data[0]["time"].'</p>
            //                                                                         </td>
            //                                                                     </tr>
            //                                                                 </table>
            //                                                             </div>
            //                                                         </td>
            //                                                     </tr>
            //                                                 </table>
            //                                             </td>
            //                                         </tr>
            //                                         <tr>
            //                                             <td align="center" style="  background-color: #ff7361;" bgcolor="#1b9ba3">
            //                                                 <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                                                
            //                                                     <tr>
            //                                                         <td align="center" style="padding: 25px 0 15px 0;">
            //                                                             <table border="0" cellspacing="0" cellpadding="0">
            //                                                                 <tr>
            //                                                                     <td align="center" style="border-radius: 5px;" bgcolor="#66b3b7"> <a href="https://www.minikart.in" target="_blank" style="font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #F44336; padding: 15px 30px; border: 1px solid #F44336; display: block;">Shop Again</a> </td>
            //                                                                 </tr>
            //                                                             </table>
            //                                                         </td>
            //                                                     </tr>
            //                                                 </table>
            //                                             </td>
            //                                         </tr>
            //                                         <tr>
            //                                             <td align="center" style="padding: 35px; background-color: #ffffff;" bgcolor="#ffffff">
            //                                                 <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
            //                                                     <tr>
            //                                                         <td > <img src="https://www.minikart.in//assets/images/logo.png"  width="30%" style="display: block; border: 0px;" /> </td>
            //                                                     </tr>
                                                                
            //                                                     <tr>
            //                                                         <td >
            //                                                         <p> Phone :  +919160708686<br> email : support@minikart.in</br>
            //                                                         </td>
            //                                                     </tr>
            //                                                     <tr>
            //                                                         <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;">
            //                                                         <p class="copyright">Copyright © 2021 <a href="">Minikart</a>. All Rights Reserved.</p>
            //                                                             <p style="font-size: 14px; font-weight: 400; line-height: 20px; color: #777777;"> If you didn\'t order this, please ignore this email or <a href="https://minikart.in" target="_blank" style="color: #777777;">unsusbscribe</a>. </p>
            //                                                         </td>
            //                                                     </tr>
            //                                                 </table>
            //                                             </td>
            //                                         </tr>
            //                                     </table>
            //                                 </td>
            //                             </tr>
            //                         </table>
            //                     </body>
                                
            //                     </html>';
            // 	  $response = $this->common_config->orderadminemail('',$subject,$messge);
            // 	  $response = $this->common_config->orderemail($toemail,$subject,$messge);
            	
                
                
            //     $messgeee= "Order Placed: Your order for ".$data[0]['pname']." with Order ID ".$id." amounting to ".$this->customer_model->currency_change('INR',$total1)." has been received. You can expect delivery by ASAP We will send you an update when your order is packed or shipped. Beware of fraudulent calls and messages. Minikart do not ask bank info for offers or demand money.";
            // 	$this->mobile_otp->sendmobilemessage($data[0]['Mobile'],$messgeee);
               
                /*$order = $this->order_model->getorders($par);
                if(count($order) >0){
                    $messge ="Hello ".$order['customer_name'].", thank you for placing your order #".$order['order_unique']." with Minikart and ".$this->customer_model->currency_change($country,$order['order_total']);
                    //print_r($messge);exit;
                    //$this->mobile_otp->sendmobilemessage($order['customer_mobile'],$messge);
                   // echo '<pre>';print_r($order);exit;
                    $toemail = $order['customer_email_id'];
            	    $subject= "Order Information -minikart";
            	    $messge= "Order Placed: Your order with Order ID ".$orderid." has been received. You can expect delivery by ASAP We will send you an update when your order is packed or shipped. Manage your order With www.minikart.in . Beware of fraudulent calls and messages. We do not ask bank info for offers or demand money.";
            	    $message1= "New Order Received with order Id : ".$orderid;
            	    $message_string = urlencode($message); 
            	    $data   =array(
            	        'email'=>$toemail,
            	        'subject'=>$subject,
            	        'message'=>$messge
            	        );
            	    //print_r($data);
            	   $this->common_config->orderadminemail('',$subject,$message1);
            	   $this->common_config->orderemail($toemail,$subject,$messge);
                   //$this->mobile_otp->sendmobilemessage($order['customer_mobile'],$message_string);
                    */
                    $dta = array(  
                        "content"   => "success",
                        'view'      => $order
                    );
                    //print_r($dta['view']);
                    $this->load->view("theme/inner_template",$dta);
                }else{
                    redirect('/');
                }
            }else{
                redirect('/');
            }
        }
		/*
        public function product_list(){
            $pri    =   $this->uri->segment("1");
            $zri    =   $this->uri->segment("2");//echo $pri.$zri;exit;
            $uri    =   strtolower(str_replace("_"," ",$pri)); 
            $data = array(
                "content"       =>  "product_list",
                "categonmae"    =>  ucwords($uri)
            );
            if($zri == 'corporate_gifting'){
                $this->session->set_flashdata("suc","for customized and own design corporate gifting <a href='".base_url()."Corporate-gifting-Form'><b>Click Here</b> </a>. to submit Your Own design ");
            }
            $conditions = array();$cat_idd='';
            $keywords   =   $this->input->get('keywords'); 
            if($pri!='product-list' && $pri!='Product-List'){
                $catna['columns']   =   "sv.subcategory_id as id";
                $catna['where_condition']   =   "subcategory_keywords LIKE '".($zri)."'";
                $cat_idd    =   $this->category_model->get_subcategory($catna);
            }else{
                $catna['columns']   =   "category_id as id";
                $catna['where_condition']   =   "category_keywords LIKE '".$zri."'";
                $cat_idd    =   (array)$this->category_model->getCategory($catna);
            }
            $cat_idd['id'] .=",";
            if(!empty($keywords)){
                $conditions['keywords'] = $keywords;
            }
            if($pri!='product-list' && $pri!='Product-List' && is_array($cat_idd['id'])){
                $conditions["whereCondition"]   =   "((category_keywords LIKE '".($pri)."' AND (subcategory_keywords) LIKE '".($zri)."' ) OR vendorproduct_catmap_scat_id LIKE '%".$cat_idd['id']."%')";
            }else{
                $conditions["whereCondition"]   =   "((category_keywords LIKE '".($zri)."' OR (subcategory_keywords) LIKE '".($zri)."' ) OR vendorproduct_catmap_cat_id LIKE '%".$cat_idd['id']."%')";
            }
            //$conditions["whereCondition"]   =   "category_keywords LIKE '".($pri)."' AND (subcategory_keywords) LIKE '".($zri)."'";
            $perpage        =    $this->input->get("limitvalue")?$this->input->get("limitvalue"):sitedata("site_mainpagination");
            $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
            $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"vendorproductid"; 
            //$totalRec               =   $this->vendor_model->cntviewVendorproducts($conditions);  
            $conditions['columns']  =   'count(*) as cnt';
            $conditions["group_by"]   =   'pd.product_name';
            if(empty($conditions["whereCondition"])){
                $conditions["whereCondition"] ='';
            }
            $total              =   $this->vendor_model->viewVendorproducts_list($conditions); 
            $conditions['columns']  =   '';
            $totalRec   =   0;
            $totalRec   =count($total);//echo $totalRec;exit;
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            } 
            $conditions["group_by"]         =   "vp.vendorproduct_id";
            $data["urlvalue"] =$config['base_url']     =   base_url('ajaxvendorproducts');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage;
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['limit']    =   $perpage;
            $data["subp"]           =   $this->vendor_model->viewVendorproducts_list($conditions);
            $this->load->view('theme/inner_template',$data);
    	}
		*/
		public function product_list(){
			$pri    =   $this->uri->segment("2");
			$uri    =   strtolower(str_replace("_"," ",$pri)); 
			$data = array(
				"content"       =>  "product_list",
				"categonmae"    =>  ucwords($uri)
			);
			$uri=explode('?',$pri);
			$data["urlvalue"]     =   base_url('ajaxvendorproducts/');
			if($uri[0]=='search'){
				$uri    =   $this->input->get('search');
				$psm['keywords']    = $uri;
				$data["urlvalue"]     =   '';
			}
            $psm['group_by'] 			= 	"vp.vendorproduct_id";
            $psm['where_condition'] 	= 	"category_keywords LIKE '%".$pri."%'";
            $psm['tiporderby']  	 	=   "category_name";
            $psm['order_by']    		=   "DESC";
			$data["subp"]       		=   $this->vendor_model->viewVendorproducts($psm);
            // $psm['where_condition'] = "category_keywords LIKE '".$pri."'";
            // $psm['tiporderby']  =   "category_name";
            // // $psm['order_by']    =   "DESC";
            // $data["subp"]       =   $this->vendor_model->viewVendorproducts();
            // $data["urlvalue"]     =   base_url('ajaxvendorproducts/');
            $this->load->view('theme/inner_template',$data);
    	}
    	public function ajaxvendorproducts(){
            //print_r($this->input->post());exit;
            $conditions  =  array(); 
            $category    =  strtolower($this->input->post('category'));
            $subcategory =  $this->input->post('subcategory');  
            $cat_id =  explode(',',$this->input->post('cat_id'));  
            $page        =  $this->uri->segment("2");
            $offset      =  ($page != "")?$page:"0";
            $perpage     =  $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_mainpagination");
            $orderby     =  $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
            $tipoOrderby =  $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"vendorproductid";
            $g  ='(';
            $cat_idd['id']='';
            if($category!='product-list' && $category!='Product-List'){
                if(count($cat_id)>0){ $i=0;
                    foreach($cat_id as $cc){
                        $catna['columns']   =   "sv.subcategory_id as id";
                        $catna['where_condition']   =   "subcategory_keywords LIKE '".($cc)."'";
                        $cat_idd    =   $this->category_model->get_subcategory($catna);
                        if(!empty($cat_idd['id'])){
                            $cat_idd['id'] .=",";
                        }
                        $cat_iddd[$i]   =  $cat_idd['id']; 
                        $i++;
                    }
                }
            }else{
                $catna['columns']   =   "category_id as id";
                $catna['where_condition']   =   "category_keywords LIKE '".$category."'";
                $cat_idd    =   (array)$this->category_model->getCategory($catna);
                if(count($cat_idd)>0){
                    $cat_idd['id'] .=",";
                }                
            }
            //print_r($cat_iddd);
            if($category!='product-list' && $category!='Product-List'){
                $g  = "((category_keywords LIKE '".($category)."' AND ";
                if(count($cat_id)>0){ $i=0;
                    foreach($cat_id as $cc){
                        if(!empty($cat_iddd[$i])){
                            if($i==0){
                                $g  .=" (subcategory_keywords) LIKE '".($cc)."' OR vendorproduct_catmap_scat_id LIKE '%".$cat_iddd[$i]."%'";
                            }else{
                                $g  .=" OR (subcategory_keywords) LIKE '".($cc)."' OR vendorproduct_catmap_scat_id LIKE '%".$cat_iddd[$i]."%'";
                            }
                        }else{
                            if($i==0){
                                $g  .=" (subcategory_keywords) LIKE '".($cc)."'";
                            }else{
                                $g  .=" OR (subcategory_keywords) LIKE '".($cc)."'";
                            }
                        }
                        
                       
                        $i++;
                    }
                }
            }
            if($category!='product-list' && $category!='Product-List'){
                $g .= ") OR vendorproduct_catmap_cat_id LIKE '%".$cat_idd['id']."%' ";
            }else{
                $g .= "category_keywords LIKE '%".$subcategory."%' ";
            }
            $g  .=")";
            $conditions["whereCondition"]   =   $g;
            $conditions["group_by"]   =   'pd.product_name';
            $conditions['columns']  =   'count(*) as cnt';
            $total              =   $this->vendor_model->viewVendorproducts_list($conditions); 
            $totalRec   =   0;
            foreach($total as $t){
                $totalRec=$totalRec+$t->cnt;
            }
            $totalRec   =count($total);
            
            $conditions['columns']  =   ''; 
			$conditions['groupby']  =   ''; 
            if(!empty($orderby) && !empty($tipoOrderby)){
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            }
            $config["uri_segment"]  =   "2";
            $config['base_url']     =   base_url('ajaxvendorproducts');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage; 
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['start']    =   $offset;
            $conditions['limit']    =   $perpage;
            $data["limit"]           =   $offset+1;
           // print_r($conditions);exit;
            $data["subp"]            =   $this->vendor_model->viewVendorproducts_list($conditions);
            $this->load->view('ajaxvendorproducts',$data);
        }
        /*public function ajaxvendorproducts(){
                //print_r($this->input->post());exit;
                $conditions  =  array(); 
                $search      =  $this->input->post('search'); // Get search Value
                $categorys   =  $this->input->post('categorys'); // Get category Value
                $keywords    =  $this->input->post('keywords');
                $category    =  strtolower($this->input->post('category'));
                $subcategory =  $this->input->post('subcategory');  
                $page        =  $this->uri->segment("2");
                $offset      =  ($page != "")?$page:"0";
                $perpage     =  $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_mainpagination");
                $orderby     =  $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tipoOrderby =  $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"vendorproductid";
                $g  =''; 
                if($category =="product-list" && $subcategory != ""){
                    $g .="category_keywords LIKE '".($subcategory)."' OR (subcategory_keywords) LIKE '".($subcategory)."'";
                }
                if($category != "" && $category !="product-list" && $subcategory != ""){
                    $g .= "category_keywords LIKE '".($category)."' AND (subcategory_keywords) LIKE '".($subcategory)."'";
                }
                if(!empty($search)){
                    $g .= "product_name LIKE '%".$search."%'  OR subcategory_name LIKE '".$search."'";
                }
                if($categorys != "" && !empty($search)){
                    $g .= "and category_keywords LIKE '".$categorys."'";
                }
                if($categorys != "" && empty($search)){
                    $g .= "category_keywords LIKE '".$categorys."'";
                }
                //echo '<pre>';print_r($g);exit;
                $conditions["whereCondition"]   =   $g;
                $conditions["group_by"]   =   'pd.product_name';
                $totalRec               =   $this->vendor_model->cntviewVendorproducts($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){
                        $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                        $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
                } 
                $config["uri_segment"]  =   "2";
                $config['base_url']     =   base_url('ajaxvendorproducts');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $data["limit"]           =   $offset+1;
               // print_r($conditions);exit;
                $data["subp"]            =   $this->vendor_model->viewVendorproducts($conditions);
                $this->load->view('ajaxvendorproducts',$data);
        }*/
        public function ajaxfiltervendorproducts(){
                //print_r($this->input->post());exit;
                $conditions  =  array(); 
                $category_ajax  = $this->input->post('search_ajax');
                $search      =  $this->input->post('search'); // Get search Value
                $categorys   =  $this->input->post('categorys'); // Get category Value
                $keywords    =  $this->input->post('keywords');
                $category    =  strtolower($this->input->post('category'));
                $subcategory =  $this->input->post('subcategory');  
                $page        =  $this->uri->segment("2");
                $offset      =  ($page != "")?$page:"0";
                $perpage     =  $this->input->post("limitvalue")?$this->input->post("limitvalue"):sitedata("site_mainpagination");
                $orderby     =  $this->input->post('orderby')?$this->input->post('orderby'):"DESC";
                $tipoOrderby =  $this->input->post('tipoOrderby')?str_replace("+"," ",$this->input->post('tipoOrderby')):"vendorproductid";
                $g  =''; 
                if($category =="product-list" && $subcategory != ""){
                    $g .="category_keywords LIKE '".($subcategory)."' OR (subcategory_keywords) LIKE '".($subcategory)."'";
                }
                if($category != "" && $category !="product-list" && $subcategory != ""){
                    $g .= "category_keywords LIKE '".($category)."' AND (subcategory_keywords) LIKE '".($subcategory)."'";
                }
                if(!empty($search)){
                    $g .= "product_name LIKE '%".$search."%'  OR subcategory_name LIKE '".$search."'";
                }
                if($categorys != "" && !empty($search)){
                    $g .= "and category_keywords LIKE '".$categorys."'";
                }
                if($categorys != "" && empty($search)){
                    $g .= "category_keywords LIKE '".$categorys."'";
                }
                //echo '<pre>';print_r($g);exit;
                $conditions["whereCondition"]   =   $g;
                $conditions["group_by"]   =   'pd.product_name';
                $totalRec               =   $this->vendor_model->cntviewVendorproducts($conditions);  
                if(!empty($orderby) && !empty($tipoOrderby)){
                        $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                        $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
                } 
                $config["uri_segment"]  =   "2";
                $config['base_url']     =   base_url('ajaxfiltervendorproducts');
                $config['total_rows']   =   $totalRec;
                $config['per_page']     =   $perpage; 
                $config['link_func']    =   'searchFilter';
                $this->ajax_pagination->initialize($config);
                $conditions['start']    =   $offset;
                $conditions['limit']    =   $perpage;
                $data["limit"]           =   $offset+1;
               // print_r($conditions);exit;
                $data["subp"]            =   $this->vendor_model->viewVendorproducts($conditions);
                $this->load->view('ajaxvendorproducts',$data);
        }
    	public function ajax_checkout(){
    	    $this->load->view('ajax_cart_data');
    	}  
    	/*public function product_views(){
            $pri    =   $this->uri->segment("2");
            $uri    =   strtolower(str_replace("_"," ",$pri));
            $mobile   =  $this->session->userdata("otpmobileno"); 
            if($mobile != ""){
                $pasm["join_condition"]   =   " AND cs.customer_mobile LIKE '".$mobile."'";
            }
            $pasm["whereCondition"]   =  "product_keywords LIKE '".$pri."'"; //"CONCAT(vendorproduct_bbtype,'_',product_keywords,'_',vendor_storename_keywords) LIKE '".($pri)."'";
            $view   = $this->vendor_model->getVendorproduct($pasm);
            $p_id   =   $view['product_id'];
            $pas['whereCondition']    ="prodcu_id = '".$p_id."'";
            $review =  $this->customer_model->viewReview($pas);
            //print_r($review);exit;
            if(is_array($view) && count($view) > 0){
                $data = array(
                    "content"      => "productview",
                    "categonmae"   =>  ucwords($uri),
                    "view"         => $view,
                    "review"    =>$review
                ); 
                if($this->input->post('reviewsubmit')){
                    $r = $this->customer_model->review_rating();
                    if($r >0){
                        $this->session->set_flashdata("suc","Thq for review");
                    }else{
                        $this->session->set_flashdata("err","Updated Profile Successfully.");
                    }
                }
                $data["images"]     = $this->vendor_model->viewVendorproductimages($pasm); 
                $pa["whereCondition"] = "vendor_products.vendorproduct_id Like '".$data["view"]['vendorproduct_id']."'";
                $pa['group_by']       ="vendor_product_princes.vendor_ingredientslist";
                $data["ingredients"]     = $this->vendor_model->viewVendorproductIngredients($pa);
                $h ="vendorproductids Like '".$data["view"]['vendorproduct_id']."'";
                if(isset($data["ingredients"][0]->vendor_ingredientslist) && $data["ingredients"][0]->vendor_ingredientslist !=""){
                    $h .="AND vendor_ingredientslist like '".$data["ingredients"][0]->vendor_ingredientslist."'";
                }
                $pas["whereCondition"]  = $h;
                $data["prices"]     = $this->vendor_model->viewVendorproductprices($pas);
                //echo '<pre>';print_r($data);exit;
                $this->load->view('theme/inner_template',$data);
            }else{
                redirect("/");
            }
            
    	}*/
    	public function product_views(){
            $pri    =   $this->uri->segment("2");
            $uri    =   strtolower(str_replace("_"," ",$pri));
            $mobile   =  $this->session->userdata("otpmobileno"); 
            if($mobile != ""){
                $pasm["join_condition"]   =   " AND cs.customer_mobile LIKE '".$mobile."'";
            }
            $pasm["whereCondition"]   =  "product_keywords LIKE '".$pri."'"; //"CONCAT(vendorproduct_bbtype,'_',product_keywords,'_',vendor_storename_keywords) LIKE '".($pri)."'";
            $pasm['columns']    =   "vendor_ingredientslist as prodind,vendorproductids,photo_upload,vendorproductprinceid,sn.category_id,sv.subcategory_id,category_keywords,subcategory_keywords,product_name,category_name,vendorproduct_bb_quantity,vendorproduct_bb_mrp,vendorproduct_bb_price,vendorproduct_model,vendorproduct_brand,vendorproduct_shipping,vendorproduct_tax_class,vendorproduct_description,vendorproduct_product,vendorproduct_code,vendorproduct_id,vendorproduct_descc,product_id,vendorproduct_out_stock";
            $view   = $this->vendor_model->getVendorproduct_list($pasm);
            $pasm['columns']    =   "";
            $p_id   =   $view['vendorproduct_id'];
            $pas['whereCondition']    ="prodcu_id = '".$p_id."'";
            $pas['columns'] = "customer_name,add_date,rating,message";
            $review =  $this->customer_model->viewReview($pas);$pas['columns'] = "";
            //print_r($review);exit;
            if(is_array($view) && count($view) > 0){
                $data = array(
                    "content"      => "productview",
                    "categonmae"   =>  ucwords($uri),
                    "view"         => $view,
                    "review"    =>$review
                ); 
                if($this->input->post('reviewsubmit')){
                    $r = $this->customer_model->review_rating();
                    if($r >0){
                        $this->session->set_flashdata("suc","Thq for review");
                    }else{
                        $this->session->set_flashdata("err","Updated Profile Successfully.");
                    }
                }
                $pasm['columns']="vendorproductimg_name";
                $data["images"]     = $this->vendor_model->viewVendorproductimages($pasm); 
                $pa["whereCondition"] = "vendor_products.vendorproduct_id Like '".$data["view"]['vendorproduct_id']."'";
                $pa['group_by']       ="vendor_product_princes.vendor_ingredientslist";
                $data["ingredients"]     = $this->vendor_model->viewVendorproductIngredients($pa);
                $h ="vendorproductids Like '".$data["view"]['vendorproduct_id']."'";
                if(isset($data["ingredients"][0]->vendor_ingredientslist) && $data["ingredients"][0]->vendor_ingredientslist !=""){
                    $h .="AND vendor_ingredientslist like '".$data["ingredients"][0]->vendor_ingredientslist."'";
                }
                $pas["whereCondition"]  = $h;
                $data["prices"]     = $this->vendor_model->viewVendorproductprices($pas);
                //echo '<pre>';print_r($data);exit;
                $this->load->view('theme/inner_template',$data);
            }else{
                redirect("/");
            }
            
    	}
        public function subcategory_list(){
            $pri    =   $this->uri->segment("2");
            $uri    =   strtolower(str_replace("_"," ",$pri));
            $data = array(
                "content"      => "subcategory_list",
                "categonmae"   =>  ucwords($uri)
            ); 
            $data["sub"] = $this->common_model->get_sub_category($pri);
            if(empty($data["sub"])){
                redirect(base_url("Product-List/".$pri));
            }
            $this->load->view('theme/inner_template',$data);
    	}
    	public function product_deliverytype($id=null){
            $pri    =   $this->uri->segment("2");
            $uri    =   $pri;
            $dta['title']    =   $this->input->post('title');
            $par['group_by'] = "delivery_changes.delivery_type";
            $dta['deliverytype']    =  $this->deliverycharges_model->viewDelivery($par);//$this->deliverycharges_model->viewDeliverytype();
            $this->load->view('theme/popup_deliverytypes',$dta);
    	}
    	public function delivery_chages(){
    	    if($this->input->post('delitype')){
    	        $dta['delitype']        = $this->input->post('delitype');
    	        $dta['date']            = $this->input->post('date');
    	        $par['where_condition'] =   "delivery_type LIKE '".$this->input->post('delitype')."'";
                $dta['deliverychage']   =   $this->deliverycharges_model->viewDelivery($par);
                $this->load->view('theme/popup_delvery_chage',$dta);
    	    }
    	}
    	public function Delivery_Chages_Check(){
    	    $country= $this->session->userdata("currency_code");
            if($this->input->post('value')){
                $par    =   $this->input->post('value');
                $date    =   $this->input->post('date');
                $dta    =   $this->deliverycharges_model->getdeliverychg($par);
                if(is_array($dta) && count($dta) > 0){
                    $timestamp1 = strtotime($dta['deliverychg_end']);
                    $end =  date('h:i A', $timestamp1);
                    $timestamp = strtotime($dta['deliverychg_start']);
                    $start =  date('h:i A', $timestamp);
                    $html ="<input type='hidden' class='delivery_id' name='delivery_id' value='".$dta['deliverychgid']."'>";
                    $html .="<input type='hidden' class='delivery_type' name='delivery_type' value='".$dta['derliverytype']."'>";
                    $html .="<input type='hidden' class='deliverychg_start' name='deliverychg_start' value='".$start."'>";
                    $html .="<input type='hidden' class='deliverychg_end' name='deliverychg_end' value='".$end."'>";
                    $html .="<input type='hidden' class='deliverychg' name='deliverychg' value='".$dta['deliverychg_amount']."'>";
                    $ds = 
                    $dat =  date('d', strtotime(str_replace('/', '-', $date)));
                    $datw =  date('D', strtotime(str_replace('/', '-', $date)));
                    $datm =  date('M', strtotime(str_replace('/', '-', $date)));
                    $html .='<span class="dates">'.$dat.'</span>
                            <span class="datety">'.$datm.'</span>
                            <span class="datewek">'.$datw.'</span><br>
                            <span class="dtypes">'.$dta['derliverytype'].'</span>
                            <span class="chs">'.$this->customer_model->currency_change($country,$dta['deliverychg_amount']).'</span><br>
                            <span class="str">'.$start.'- '.$end.'</span>';
                }
                print_r($html);exit;
            }
    	}
    	public function viewproducts(){
    	    $query  =   $this->input->get("query");
    	    $daf    =   array();
    	    $params["where_condition"]    =   "product_name LIKE '%".$query."%'";
    	    $vsp    =   $this->product_model->viewProduct($params);
	        if(count($vsp) > 0){
	            foreach($vsp as $key =>  $ve){
	                $daf[$key]["name"]  =   $ve->product_name;
	                $daf[$key]["pid"]  =   $ve->product_id;
	            }
	        }
	        echo json_encode($daf);
    	}
    	
    	public function product_popup_details(){
                $uri        =   $this->uri->segment('2'); 
                $par['whereCondition'] = "vp.vendorproduct_id LIKE '".$uri."'";
                $vue = $this->vendor_model->viewVendorproducts($par);
                $pars['whereCondition'] = "vendorproduct_productid LIKE '".$uri."'";
                $images = $this->vendor_model->viewVendorproductimages($pars);
                //print_r($images);exit;
                if(is_array($vue) && count($vue) > 0){
                    $dta['view']       = $vue;
                    $dta['view_img']   = $images;
                    $this->load->view("product_model",$dta);    
                }else{
                    echo "video does not exists.";
                }
        }
        
        function currncy_udpate(){
            $this->customer_model->currency_update();
        }
        public function Update_Currency(){
            if(!empty($this->input->post('currency'))){
                echo $this->customer_model->cur();
            }
        }
        public function product_change_price(){
            $country =  $this->session->userdata("currency_code");
            if($this->input->post('prodid')!='' && $this->input->post('size')!=''){
                $hr ="";
                if($this->input->post('prodid') !=""){
                    $hr .= "vp.vendorproduct_id Like '".$this->input->post('prodid')."'";
                }
                if($this->input->post('size') !=""){
                    $hr .="AND vpp.vendorproductprinceid like '".$this->input->post('size')."'";
                }
                if($this->input->post('type') !=""){
                    $hr .="AND vendor_ingredientslist LIKE '".$this->input->post('type')."'";
                }
                $pa["whereCondition"]   =  $hr;
                $view    =   $this->vendor_model->getVendorproduct($pa);
                //echo '<pre>';print_r($view);exit;
                if(is_array($view) && count($view) > 0){
                    if($view['vendorproduct_bb_price'] != $view['vendorproduct_bb_mrp']){
                        $html = '<h3 class="shop-details-price prices">';
                        $html   .= $this->customer_model->currency_change($country,$view['vendorproduct_bb_price']);
                        if(!empty($view['vendorproduct_bb_mrp'])){
                            $html .='<del style="padding-left: 7px;">'.$this->customer_model->currency_change($country,$view['vendorproduct_bb_mrp']).'</del>';
                        }
                        $html .='</h3>';
                    }else{
                        $html = '<h3 class="shop-details-price prices">';
                        $html   .= $this->customer_model->currency_change($country,$view['vendorproduct_bb_price']);
                        $html .='</h3>';
                    }
                    echo $html;
                }else{
                    print_r($view);
                }
            }
        }
        public function product_change_rates(){
            $country =  $this->session->userdata("currency_code");
            if($this->input->post('type')!='' && $this->input->post('prodid')!='')
            $pas["whereCondition"]  = "vendorproductids Like '".$this->input->post('prodid')."' AND vendor_ingredientslist like '".$this->input->post('type')."'";
            $pas["tipoOrderby"] = "vendorproduct_bb_quantity";
            $pas["order_by"] = "ASC";
            $view    = $this->vendor_model->viewVendorproductprices($pas);
            //echo '<pre>';print_r($view);exit;
            if(is_array($view) && count($view) >0){
                $html = '<div class="col-md-12 qty-rates">';
                $html .='<div class="radio-toolbar">';
                $i=1;foreach($view as $p){
                $check='';
                if($i==1){
                    $check ='checked';
                }
                $html .='<input type="radio" class="size'.$p->vendorproductprinceid.'" id="'.$p->vendorproductprinceid.'" data-value="'.$p->vendorproductprinceid.'" onchange="changerate('."'$p->vendorproductprinceid'".')" name="quantity" value="'.$p->vendorproduct_bb_quantity.'" '.$check.'>';
                $html .='<label for="'.$p->vendorproductprinceid.'">'.$p->vendorproduct_bb_quantity.'</label>';
                $i++;}
                $html.='</div></div>';
            }
            echo $html;
        }
        
        public function mailtest(){
    	    $toemail = 'sivaappalabattula92@gmail.com';
    	    $subject= "Sample Testing mail";
    	    $messge= "Sample Testing Message";
    	   echo $this->common_config->configemail($toemail,$subject,$messge);
    	}
    	public function smstest(){
    	    $otp_key    =   rand(11111,99999);
    	    $str        =   $otp_key;//"Dear Customer,\nYour OTP verification key : ".$otp_key." for Minikart which expires in 10 mins\n";
    	    $phone_number= "9490398046";
    	   echo $this->mobile_otp ->sendmobilemessage($phone_number,$str);
    	}
    	public function search(){
    	    $pri   =   $this->input->get('search'); 
    	    $category   =   $this->input->get('category');
            $data = array(
                "content"       =>  "product_list",
                "categonmae"    =>  ucwords($pri),
                "view"          =>  ''
            );
            $conditions = array();
            if(!empty($keywords)){
                $conditions['keywords'] = $keywords;
            }
            $hr ='';
            if(!empty($pri)){
                $hr .= "product_name LIKE '%".$pri."%'  OR subcategory_name LIKE '".$pri."'";
            }
            if(!empty($category) && !empty($pri)){
                $hr .= "AND category_name LIKE '".$category."'";
            }
            if(!empty($category) && empty($pri)){
                $hr .= "category_name LIKE '".$category."'";
            }
            if($category !="" || $pri !=""){
                $conditions['whereCondition'] = $hr;
            }
            //print_r($conditions);exit;
            $perpage        =    $this->input->get("limitvalue")?$this->input->get("limitvalue"):sitedata("site_mainpagination");
            $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
            $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"vendorproductid"; 
            $totalRec               =   $this->vendor_model->cntviewVendorproducts($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            } 
            $conditions["group_by"]         =   "vp.vendorproduct_id";
            $data['urlvalue']   =  $config['base_url']     =   base_url('ajaxvendorproducts');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage;
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['limit']    =   $perpage;
            $data["subp"]           =   $this->vendor_model->viewVendorproducts($conditions);
            $this->load->view('theme/inner_template',$data);
    	}
    	public function paymenttest(){
    	    $datas= array();
    	    $datas['id']= '';
	        if($this->input->post('CheckOut')){
    		    $data=$this->input->post(array(
        			'tid'=>'tid',
                    'merchant_id'=>'merchant_id',
                    'order_id'=>'order_id',
                    'amount'=>'amount',
                    'currency'=>'currency',
                    'redirect_url'=>'redirect_url',
                    'cancel_url'=>'cancel_url',
                    'language'=>'language',
                    'delivery_name'=>'delivery_name',
                    'delivery_address'=>'delivery_address',
                    'delivery_city'=>'delivery_city',
                    'delivery_state'=>'delivery_state',
                    'delivery_zip'=>'delivery_zip',
                    'delivery_country'=>'delivery_country',
                    'delivery_tel'=>'delivery_tel'
    		    ));
    	
            	$merchant_data='';
            	$working_key='013393FB2CC79CDECF5C96031AFC63C3';//Shared by CCAVENUES
            	$access_code='AVWW81FK94CG49WWGC';//Shared by CCAVENUES
            	
            	foreach ($data as $key => $value){
            		$merchant_data.=$key.'='.$value.'&';
            	}
                //$this->load->library('ccavenue');
            	$encrypted_data = $this->ccavenue->encrypt($merchant_data,$working_key); 
            	$datas = array(
            	    'id' =>var_dump($encrypted_data), 
            	    'aces' =>var_dump($access_code), 
            	);
                ?>
                <!--<form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction">-->
                <form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
                    <input type='hidden' name='encRequest' value='$encrypted_data'>
                    <input type='hidden' name='access_code' value='$access_code'>
                </form></center><script language='javascript'>document.redirect.submit();</script>
                <?php
                		echo "Payment Works";
	        }
    	    $this->load->view('theme/payment_text',$datas);
    	    
    	}
    	public function update_password(){
    	    $uri        =   $this->uri->segment('2');
    	    $par['whereCondition'] = "lower(customer_email_id) LIKE '".strtolower(base64_decode($uri))."' ";
            $vsp    =   $this->customer_model->getCustomer($par);
            if(is_array($vsp) && count($vsp) >0){
                $data = array(
                    "view"          =>  $vsp
                );
                if($this->input->post('submit')){
                    $this->form_validation->set_rules('password', 'Password', 'required');
                    $this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required|matches[password]');
                    if($this->form_validation->run() == TRUE){
                        $insert = $this->vendor_model->update_password($vsp['customer_id']);
                        if($insert) {
                            $this->session->set_flashdata("suc", "Update Customer details successfully");
                            redirect("/");
                        } else {
                            $this->session->set_flashdata("err", "Not Updated customer details.Please try again.");
                        }
                    }
                }
                $this->load->view('theme/update_password',$data);
            }else{
                redirect('/');
            }
    	}
    	public function pay(){
    	    $this->load->view('theme/pay');
    	}
		public function login(){
    	    $this->load->view('theme/login');
    	}
		public function registration(){
    	    $this->load->view('theme/registration');
    	}		
    	public function blog(){
            $data = array(
                "title"         =>  "Blog Title",
                "content"       =>  "blog",
                "view"          =>  ''
            );
            $conditions = array();
            if(!empty($keywords)){
                $conditions['keywords'] = $keywords;
            }
            $perpage        =    $this->input->get("limitvalue")?$this->input->get("limitvalue"):sitedata("site_mainpagination");
            $orderby        =    $this->input->get('orderby')?$this->input->get('orderby'):"DESC";
            $tipoOrderby    =    $this->input->get('tipoOrderby')?str_replace("+"," ",$this->input->get('tipoOrderby')):"blogid"; 
            $totalRec               =   $this->blog_model->cntviewBlog($conditions);  
            if(!empty($orderby) && !empty($tipoOrderby)){ 
                    $dta['orderby']        =   $conditions['order_by']   =   $orderby;
                    $dta['tipoOrderby']    =   $conditions['tipoOrderby']   =  $tipoOrderby; 
            } 
            $conditions["group_by"]         =   "vp.vendorproduct_id";
            $config['base_url']     =   base_url('ajaxvendorproducts');
            $config['total_rows']   =   $totalRec;
            $config['per_page']     =   $perpage;
            $config['link_func']    =   'searchFilter';
            $this->ajax_pagination->initialize($config);
            $conditions['limit']    =   $perpage;
            $data["view"]           =   $this->blog_model->viewBlog($conditions);
            $this->load->view('theme/inner_template',$data);
    	}
    	public function blog_details($str){
            $par['whereCondition'] = "blog_url LIKE '".$str."'";
            $vue = $this->blog_model->getBlog($par);
            if(is_array($vue) && count($vue) > 0){
                $uri    =   $this->uri->segment("1");
                $data   =   array(
                    "title"     =>  ucwords(str_replace("-"," ",$str)),
                    "content"   =>  "blog_details",
                    "view"      =>  $vue,
                    "ctitle"    =>  ucwords(str_replace("-"," ",$uri)),
                    "desc"      =>  substr($vue['blog_desc'],0,200)
                );
                $this->load->view("theme/inner_template",$data);
            }else{
                redirect(base_url("Industries"));
            }
        }
        public function faq(){
            $dta    =   array(
                "content"   =>  "faq"
            );
            $this->load->view("theme/inner_template",$dta);
        }
        public function Contact(){
            $dta    =   array(
                "content"   =>  "Contact"
            );
            $this->load->view("theme/inner_template",$dta);
        }
        public function subscribe(){
            if($this->input->post()){
                $this->form_validation->set_rules('emailid', 'Email', 'required|valid_email|is_unique[subscribe.subscribe_email]');
                if($this->form_validation->run() == TRUE){
                    $r = $this->customer_model->subscribe();
                    if($r >0){
                        echo "thank you for subscribe";
                    }else{
                        echo "Adding subscribe failed.";
                    }
                }else{
    				echo form_error('emailid');
                }
            }
        }
        public function pay_button(){
            $type = $this->input->post('type');
            if($type !=""){
                $dat = array(
                    'type'=> $type,
                );
                $this->load->view('theme/payment_buttons',$dat);
            }
        }
         public function coupon(){
            $coupon = $this->input->post('coupon_code');
            $mobile     =   $this->session->userdata("customer_mobile");
            $total     =    $this->cart->total();
            $r  =   $this->coupon_model->Coupon_check($coupon,$mobile,$total);
            echo $r;
        }
        
        public function corporate_gifting_form()  {
            $dta = array(
                        "title" => "Corporate Gifting Form",
                        "content" => "corporate_gifting_form",
                        "limit" => 1
            );
            if ($this->input->post("submit")) {
                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_rules('email', 'Email ID', 'required');
                $this->form_validation->set_rules('mobile', 'Mobile Number', 'required');
                $this->form_validation->set_rules('company_name', 'Company Name', 'required');
                $this->form_validation->set_rules('company_role', 'Company Role', 'required');
                if($this->form_validation->run() == TRUE){
                    //print_r($this->input->post());exit;
                    $insert = $this->corporate_gifting_model->createCorporate_gifting();
                    if($insert) {
                        $this->session->set_flashdata("suc", "Form submitted Successfull");
                        //redirect("/");
                    } else {
                        $this->session->set_flashdata("err", "Not submitted.Please try again.");
                    }
                }
            }
            $this->load->view("theme/inner_template",$dta); 
        }
        public function refer_earn(){
            $dta = array(
                "title" => "Refer & Earn",
                "content" => "refer_earn",
                "limit" => 1
            );
            $this->load->view("theme/inner_template",$dta); 
        }
        
}