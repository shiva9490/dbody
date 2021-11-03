<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Order_model extends CI_Model{
        public function addtocart($dtas=array()){
            $this->db->insert("cart_details",$dtas);
            if($this->db->insert_id() > 0){ 
                return TRUE;
            }
            return FALSE;
        }
        public function updatetocart($custid,$cart_id,$quantity,$price){
            $dta    =   array( 
                "cart_quantity"     =>    $quantity, 
                "cart_price"        =>    $price, 
                "cart_modified_on"  =>    date("Y-m-d H:i:s"),
                "cart_modified_by"  =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):$custid
            ); 
            $this->db->update("cart_details",$dta,array("cart_id" => $cart_id));
            if($this->db->affected_rows() > 0){ 
                return TRUE;
            }
            return FALSE;
        }
        public function deletefromcart($cart_id,$custid){ 
            $dta    =   array( 
                "cart_open"        =>    0, 
                "cart_modified_on"  =>    date("Y-m-d H:i:s"),
                "cart_modified_by"  =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):$custid
            ); 
            $this->db->update("cart_details",$dta,array("cart_id" => $cart_id));
            if($this->db->affected_rows() > 0){ 
                return TRUE;
            }
            return FALSE;
        }
        public function deletefromcartaddon($custid,$prdid,$cart_id){ 
            $coddd =base64_encode($prdid.','.$cart_id);
            $dta    =   array( 
                "cart_open"        =>    0, 
                "cart_modified_on"  =>    date("Y-m-d H:i:s"),
                "cart_modified_by"  =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):$custid
            ); 
            $this->db->update("cart_details",$dta,array("cart_addon" => $coddd,"cart_customer_id" => $custid));
            if($this->db->affected_rows() > 0){ 
                return TRUE;
            }
            return FALSE;
        }
        public function querycartproduct($params = array()){
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
                    "ct.cart_open"      =>  "1",
                    "ct.cart_status"    =>  "1",
                    "pd.product_open"   =>  "1",
                    "pd.product_status" =>  "1",
                    "vd.vendor_open"    =>  "1",
                    "vd.vendor_status"  =>  "1",
                    "vp.vendorproduct_open"     =>  "1",
                    "vp.vendorproduct_status"   =>  "1",
                    //"mhd.measure_status"        =>  "1",
                    //"mhd.measure_open"          =>  "1",
                    "cp.customer_open"  =>  "1",
                    "cp.customer_status" => "1"
                );
                $this->db->select("$sel")
                        ->from("cart_details as ct") 
                        ->join("vendor_products as vp","vp.vendorproduct_id = ct.cart_vendor_productid","INNER") 
                        //->join("measures as  mhd","mhd.measure_id = vp.vendorproduct_measure","INNER") 
                        ->join("products as  pd","pd.product_id = vp.vendorproduct_product","INNER") 
                        ->join("category as sn","sn.category_id = vp.vendorproduct_category","INNER")  
                        ->join("sub_category as sv","sv.subcategory_id = vp.vendorproduct_subcategory","LEFT")  
                        ->join("vendor as  vd","vd.vendor_id = vp.vendorproduct_vendor_id","INNER")
                        ->join("customers as  cp","ct.cart_customer_id = cp.customer_id","INNER")
                        ->join("(SELECT * FROM vendorproduct_images WHERE vendorproductimg_open = '1' AND  vendorproductimg_status = '1' GROUP BY vendorproduct_productid) as vimp","vp.vendorproduct_id = vimp.vendorproduct_productid","INNER")
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(cart_quantity LIKE '%".$params["keywords"]."%')");
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
        public function cntviewcartproducts($params  =    array()){
                $params["cnt"]      =   "1"; 
                $val    =   $this->querycartproduct($params)->row_array();
                if(isset($val)){
                    return  $val['cnt'];
                }
                return "0";
        }
        public function viewcartproducts($params = array()){
//                $this->querycartproduct($params);echo $this->db->last_query();exit;
                return $this->querycartproduct($params)->result();
        }
        public function getcartproduct($params = array()){
                return $this->querycartproduct($params)->row_array();
        }
        public function addorder($customer_id =null){
            //print_r($vsp['customer_id']);exit;
            if($customer_id ==""){
                $customer_id = $vsp['customer_id'];
            }
            //print_r($customer_id);exit;
            $prms["whereCondition"]     =   "ct.cart_acde = '0' AND cp.customer_id LIKE '".$customer_id."' OR cp.customer_mobile LIKE '".$customer_id."' OR cp.customer_token LIKE '".$customer_id."'";
            $prms["columns"]            =   "SUM(cart_quantity*(cart_price+cart_derliverytype)) as cart_price";
            $view       =   $this->order_model->getcartproduct($prms);
            $prince     =   "0";
            $sub_prince =   "0";
            $rtotl      =   $this->cart->contents();
            if(is_array($view) && count($view) > 0){
                $sub_prince = $view['cart_price'];
                $prince = $view['cart_price'];
            }elseif(count($rtotl) > 0){
                $country    =   $this->session->userdata("currency_code");
                $sub_prince = $this->input->post('cart_amount');
                $prince = $this->input->post('cart_amount');
            }
            $msh    =   $this->common_model->get_max("orderid","orders");
            $uniq   =   sitedata('site_order_prefix'). str_pad($msh, 6, "0", STR_PAD_LEFT); 
            $orderid    =   "ORD".$this->common_model->get_max("orderid","orders");
            $customeraddressid     =   $this->input->post("customeraddress_id");
            if($customeraddressid == ""){
                $msgs        =   $this->input->post("customer_address"); 
                $latitude    =   ($this->input->post("latitude")!="")?$this->input->post("latitude"):'';
                $longitude   =   ($this->input->post("longitude")!="")?$this->input->post("latitude"):'';
            }
            if(is_array($view) && count($view) > 0){
                $rirls = $view['cart_price'];
                $rirl = $view['cart_price'];
            }
            
             
            //-----------------------coupon code ----------------------------//
            //$coupon_oll = $this->session->userdata("coupon_code");
            $coupon_old =   ($this->input->post('coupon_code'))??'';
            $mobile     =   ($this->input->post('customer_mobile'))??'';
            $cartt_total    =   $this->customer_model->view_cart_total();
            $total     =    ($this->input->post('cart_total'))??$cartt_total;
            $r  =   (array)json_decode($this->coupon_model->Coupon_check($coupon_old,$mobile,$total));
            if($r['status']=="4"){
                $coupon_data = (array)$r['status_messsage'];
            }else{
                $coupon_data='';
            }
            $coupon = ($coupon_data['coupon'])??'';           
            //-----------------------coupon code ----------------------------//
            
            
            if(count($rtotl) > 0){
                $rtotl  =  $this->cart->contents();
                $rirl   =  "0";
                $rirls  =  "0";
                foreach($rtotl as $fr){
                    
                    //-----------------------coupon code ----------------------------//
                    if(!empty($coupon_data)){
                        if(in_array($fr['prodid'],$coupon_data['products_applicable']) || $coupon_data['coupon_applicable'] == 'All') {
                            if($coupon_data['coupon_type']=='Percentage'){
                                $discount   =  ($fr["price"]/100)*$coupon_data['coupon_discount'];
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
                    
                    
                    $vtoal      =  "0";
                    $vsso       =  $fr['name'];
                    $delivery   =  isset($fr['delamount'])?$fr['delamount']:'0';
                    $rirls       +=  $fr["qty"]*($fr["price"]-$discount);
                    $rirl       +=  $fr["qty"]*($fr["price"]-$discount)+$delivery;
                }
            }
            //if(!empty($rirls) && !empty($rirl)){
                $dta    =   array(
                    "order_id"               => $orderid,
                    "order_unique"           => $uniq,
                    "order_customer_id"      => $customer_id,
                    "order_sub_total"        => $rirls,
                    "order_total"            => $rirl,
                    "order_coupon"           => $coupon,
                    "order_time"             => date("H:i:s"),
                    "order_date"             => date("Y-m-d"),
                    "order_address_id"       => $customeraddressid?$customeraddressid:"",
                    //"order_latitude"         => ($latitude !="")?$latitude:"",
                    //"order_longitude"        => ($longitude!="")?$longitude:"",
                    "order_payment_mode"     => $this->input->post("payment_mode"), 
                    "order_razor_payment_id" => $this->input->post("razorpay_payment_id")?$this->input->post("razorpay_payment_id"):"", 
                    "order_razor_order_id"   => $this->input->post("razor_order_id")?$this->input->post("razor_order_id"):"",  
                    //"order_payment_responce" => ($order_status!="")?$order_status:'',
                    "order_created_on"       => date("Y-m-d H:i:s"),
                    "order_created_by"       => $this->session->userdata("login_id")?$this->session->userdata("login_id"):$customer_id
                );
                $order_status = $this->check_razar_pay($this->input->post("razorpay_payment_id"));
                $orderstatus = json_decode($order_status,true);
                if(!empty($orderstatus['amount']) && $orderstatus['currency']!=""){
                    $resport = $this->check_razar_capture($this->input->post("razorpay_payment_id"),$orderstatus['amount'],$orderstatus['currency']);
                    $s = json_decode($resport,true);
                }
                if(isset($s['status']) && $s['status'] !=""){
                    if($s['status'] =="authorized" || $s['status'] =="created" || $s['status'] =="captured"){
                        $dta['order_payment_status']        = '1';
                        $dta['order_gatepayment_status']    = 'Successful';
                        $dta['order_payment_responce']      = $resport;
                    }elseif($s['status'] =="failed"){
                        $dta['order_payment_status']        = '4';
                        $dta['order_gatepayment_status']    = 'Unsuccessful';
                        $dta['order_payment_responce']      = $resport;
                    }
                }else{
                    $dta['order_payment_status']        = '1';
                    $dta['order_gatepayment_status']    = 'Successful';
                }
                // echo '<pre>';print_r($dta);exit;
                $r =   $this->db->insert("orders",$dta);
                if($r > 0){
                    if($this->cart->contents() > 0){
                        $dview = $this->cart->contents();
                        $rirl=0;
                        foreach($dview as $fr){
                            //echo '<pre>';print_r($fr);exit;
                            if($fr['addon_id']==''){
                                    //-----------------------coupon code ----------------------------//
                                    if(!empty($coupon_data)){
                                        if(in_array($fr['prodid'],$coupon_data['products_applicable']) || $coupon_data['coupon_applicable'] == 'All') {
                                            if($coupon_data['coupon_type']=='Percentage'){
                                                $discount   =  ($fr["price"]/100)*$coupon_data['coupon_discount'];
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
                                $vsso       =  $fr['name'];
                                $delivery   =  isset($fr['delamount'])?$fr['delamount']:'0';
                                $total      =  $fr["qty"]*($fr["price"]-$discount) ;
                                $rirl   +=  $fr["qty"]*($fr["price"]-$discount)+$delivery;
                                $speciations = array(
                                    'cart_size'             => ($fr['size'] !="")?$fr['size']:'',
                                    'cart_indug'            => ($fr['type'] !="")?$fr['type']:'',
                                    'cart_message_on_cake'  => ($fr['message_on_cake'] !="")?$fr['message_on_cake']:'',
                                    'cart_date'             => ($fr['deldate'] !="")?$fr['deldate']:'',
                                    'cart_delivery_id'      => ($fr['deltype'] !="")?$fr['deltype']:'',
                                    'cart_country'          => ($this->session->userdata("currency_code")!="")?$this->session->userdata("currency_code"):'',
                                );
                                if(isset($fr['photo_on_cake']) && $fr['photo_on_cake'] !=""){
                                    $speciations['photo_on_cake'] = ($fr['photo_on_cake'] !="")?$fr['photo_on_cake']:'';
                                }
                                $dta    =   array(
                                    "orderdetail_id"                =>  "ODTL".$this->common_model->get_max("orderdetailid","order_details"), 
                                    "orderdetail_vendor_id"         =>  $fr['vendor_id'], 
                                    "orderdetail_customer_id"       =>  $customer_id, 
                                    "orderdetail_orderid"           =>  $orderid,
                                    "orderdetail_vendorproduct_id"  =>  $fr['prodid'],
                                    "orderdetail_addon_ref"         =>  $fr['rowid'],
                                    "orderdetail_price"             =>  $total,
                                    "orderdetail_delivery_chage"    =>  $delivery,
                                    "orderdetail_speciations"       =>  json_encode($speciations),
                                    "orderdetail_quantity"          =>  $fr["qty"],
                                    "orderdetail_created_on"        =>  date("Y-m-d H:i:s"),
                                    "orderdetail_created_by"        =>  $this->session->userdata("login_id")?$this->session->userdata("login_id"):$customer_id
                                );
                                //echo '<pre>';print_r($dta);exit;
                                $this->db->insert("order_details",$dta);
                                //$this->db->update("cart_details",$dtda,array("cart_id" => $fer->cart_id));
                                if($fr['vendor_id'] !="" && $customer_id!=""){
                                    $this->order_model->remove_wishlist($fr['prodid'],$customer_id);
                                }
                                foreach($dview as $ff){
                                    if($ff['addon_id']==$fr['rowid']){
                                        //-----------------------coupon code ----------------------------//
                                        if(!empty($coupon_data)){
                                            if(in_array($ff['prodid'],$coupon_data['products_applicable']) || $coupon_data['coupon_applicable'] == 'All') {
                                                if($coupon_data['coupon_type']=='Percentage'){
                                                    $discount   =  ($ff["price"]/100)*$coupon_data['coupon_discount'];
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
                                        $vsso       =  $ff['name'];
                                        $delivery   =  isset($ff['delamount'])?$ff['delamount']:'0';
                                        $total      =  $ff["qty"]*($ff["price"]-$discount) ;
                                        $rirl   +=  $ff["qty"]*($ff["price"]-$discount)+$delivery;
                                        $speciations = array(
                                            'cart_size'             => ($ff['size'] !="")?$ff['size']:'',
                                            'cart_indug'            => ($ff['type'] !="")?$ff['type']:'',
                                            'cart_message_on_cake'  => ($ff['message_on_cake'] !="")?$ff['message_on_cake']:'',
                                            'cart_date'             => ($ff['deldate'] !="")?$ff['deldate']:'',
                                            'cart_delivery_id'      => ($ff['deltype'] !="")?$ff['deltype']:'',
                                            'cart_country'          => ($this->session->userdata("currency_code")!="")?$this->session->userdata("currency_code"):'',
                                        );
                                        if(isset($ff['photo_on_cake']) && $ff['photo_on_cake'] !=""){
                                            $speciations['photo_on_cake'] = ($ff['photo_on_cake'] !="")?$ff['photo_on_cake']:'';
                                        }
                                        $dta    =   array(
                                            "orderdetail_id"                =>  "ODTL".$this->common_model->get_max("orderdetailid","order_details"), 
                                            "orderdetail_vendor_id"         =>  $ff['vendor_id'], 
                                            "orderdetail_customer_id"       =>  $customer_id, 
                                            "orderdetail_orderid"           =>  $orderid,
                                            "orderdetail_vendorproduct_id"  =>  $ff['prodid'],
                                            "orderdetail_price"             =>  $total,
                                            "orderdetail_delivery_chage"    =>  $delivery,
                                            "orderdetail_addon"             =>  $ff['addon_id'],
                                            "orderdetail_speciations"       =>  json_encode($speciations),
                                            "orderdetail_quantity"          =>  $ff["qty"],
                                            "orderdetail_created_on"        =>  date("Y-m-d H:i:s"),
                                            "orderdetail_created_by"        =>  $this->session->userdata("login_id")?$this->session->userdata("login_id"):$customer_id
                                        );
                                        //echo '<pre>';print_r($dta);exit;
                                        $this->db->insert("order_details",$dta);
                                        //$this->db->update("cart_details",$dtda,array("cart_id" => $fer->cart_id));
                                        if($ff['vendor_id'] !="" && $customer_id!=""){
                                            $this->order_model->remove_wishlist($ff['prodid'],$customer_id);
                                        }
                                    }
                                }
                            }
                        }
                        $this->cart->destroy();
                    }
                    $sprms["whereCondition"]   =   "cart_acde = '0' AND customer_id LIKE '".$customer_id."'";
                    $dview   =   $this->order_model->viewcartproducts($sprms); 
                    if(count($dview) > 0){
                        foreach($dview as $fer){
                            $speciations = array(
                                'cart_size'             => ($fer->cart_size !="")?$fer->cart_size:'',
                                'cart_indug'            => ($fer->cart_indug !="")?$fer->cart_indug:'',
                                'cart_message_on_cake'  => ($fer->cart_message_on_cake !="")?$fer->cart_message_on_cake:'',
                                'photo_on_cake'         => ($fer->photo_on_cake !="")?$fer->photo_on_cake:'',
                                'cart_date'             => ($fer->cart_date !="")?$fer->cart_date:'',
                                'cart_delivery_id'      => ($fer->cart_delivery_id !="")?$fer->cart_delivery_id:'',
                            );
                            //-----------------------coupon code ----------------------------//
                                if(!empty($coupon_data)){
                                    if(in_array($fer->vendorproduct_id,$coupon_data['products_applicable']) || $coupon_data['coupon_applicable'] == 'All') {
                                        if($coupon_data['coupon_type']=='Percentage'){
                                            $discount   =  ($fer->cart_price/100)*$coupon_data['coupon_discount'];
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
                                if($fer->cart_addon ==''){
                                     $codd =$fer->vendorproduct_id.','.$fer->cart_id;
                                }else{
                                    $codd = '';
                                }
                               
                        
                            $dta    =   array(
                                "orderdetail_id"                =>  "ODTL".$this->common_model->get_max("orderdetailid","order_details"), 
                                "orderdetail_vendor_id"         =>  $fer->vendor_id,
                                "orderdetail_customer_id"       =>  $customer_id,
                                "orderdetail_orderid"           =>  $orderid,
                                "orderdetail_vendorproduct_id"  =>  $fer->vendorproduct_id,
                                "orderdetail_price"             =>  ($fer->cart_price)-$discount,
                                "orderdetail_delivery_chage"    =>  $fer->cart_derliverytype,
                                "orderdetail_quantity"          =>  $fer->cart_quantity,
                                "orderdetail_addon"             =>  $fer->cart_addon,
                                "orderdetail_addon_ref"         =>  base64_encode($codd),
                                "orderdetail_speciations"       =>  json_encode($speciations),
                                "orderdetail_created_on"        =>  date("Y-m-d H:i:s"),
                                "orderdetail_created_by"        =>  $this->session->userdata("login_id")?$this->session->userdata("login_id"):$customer_id
                            );
                            $this->db->insert("order_details",$dta);
                            $dtda    =   array(
                                "cart_acde"         =>    '1', 
                                "cart_open"         =>    '0', 
                                "cart_modified_on"  =>    date("Y-m-d H:i:s"),
                                "cart_modified_by"  =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):$customer_id
                            ); 
                            $this->db->update("cart_details",$dtda,array("cart_id" => $fer->cart_id));
                        }
                    }
                    $a = $this->customer_model->send_order_mail($orderid);
                    return $orderid;
                }else{
                    return 0;
                }
            //}
        }
        
        public function check_razar_capture($id,$amount,$currency){
            $url ="https://api.razorpay.com/v1/payments/".$id."/capture";
            $dta = '{
                        "amount": '.$amount.',
                        "currency": "'.$currency.'"
                    }';
            //print_r($dta);exit;
            $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $dta,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic cnpwX2xpdmVfeHhKTUJnNUdWTzdPaFo6SkpqbFJYQ2N0OXZaRmIyc2Z6cEk1WmxH',
                    'Content-Type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        }
        public function check_razar_pay($id){
            $url = 'https://api.razorpay.com/v1/payments/'.$id;
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic cnpwX2xpdmVfeHhKTUJnNUdWTzdPaFo6SkpqbFJYQ2N0OXZaRmIyc2Z6cEk1WmxH'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        }
        public function checkout($customer_id,$orderid = null){
            $prms["whereCondition"]   =   "ct.cart_acde = '0' AND cp.customer_id LIKE '".$customer_id."'";
            $prms["columns"]   =   "SUM(cart_quantity*cart_price) as cart_price";
            $view    =   $this->order_model->getcartproduct($prms);
            $prince   =   "0";
            $sub_prince= "0";
            $rtotl     =   $this->cart->contents();
            if(is_array($view) && count($view) > 0){
                $sub_prince = $view['cart_price'];
                $prince = $view['cart_price'];
            }elseif(count($rtotl) > 0){
                $country    =   $this->session->userdata("currency_code");
                $sub_prince = $this->input->post('cart_amount');
                $prince = $this->input->post('cart_amount');
            }
            $msh    =   $this->common_model->get_max("orderid","orders");
            $uniq   =   sitedata('site_order_prefix'). str_pad($msh, 6, "0", STR_PAD_LEFT); 
            $orderid    =   "ORD".$this->common_model->get_max("orderid","orders");
            $customeraddressid     =   $this->input->post("customeraddress_id");
            if($customeraddressid == ""){
                $msgs        =   $this->input->post("customer_address"); 
                $latitude    =   ($this->input->post("latitude")!="")?$this->input->post("latitude"):'';
                $longitude   =   ($this->input->post("longitude")!="")?$this->input->post("latitude"):'';
            }
            if(count($rtotl) > 0){
                $rtotl      =   $this->cart->contents();
                $rirl   =   "0";$rirls = "0";
                foreach($rtotl as $fr){
                    $vtoal      =  "0";
                    $vsso       =  $fr['name'];
                    $delivery   =  isset($fr['delamount'])?$fr['delamount']:'0';
                    $rirls       +=  $fr["qty"]*$fr["price"];
                    $rirl       +=  $fr["qty"]*$fr["price"]+$delivery;
                }
            }
            
            if(is_array($view) && count($view) > 0){
                $rirls = $view['cart_price'];
                $rirl = $view['cart_price'];
            }
            if(!empty($rirls) && !empty($rirl)){
                $dta    =   array(
                    "order_id"               => $orderid,
                    "order_unique"           => $uniq,
                    "order_customer_id"      => $customer_id,
                    "order_sub_total"        => $rirls,
                    "order_total"            => $rirl,
                    "order_time"             => date("H:i:s"),
                    "order_date"             => date("Y-m-d"),
                    "order_address_id"       => $customeraddressid?$customeraddressid:"",
                    //"order_latitude"         => ($latitude !="")?$latitude:"",
                    //"order_longitude"        => ($longitude!="")?$longitude:"",
                    "order_payment_mode"     => $this->input->post("payment_mode"), 
                    "order_razor_payment_id" => $this->input->post("encResp")?$this->input->post("encResp"):"", 
                    "order_razor_order_id"   => $this->input->post("razor_order_id")?$this->input->post("razor_order_id"):"",  
                    "order_created_on"       => date("Y-m-d H:i:s"),
                    "order_created_by"       => $this->session->userdata("login_id")?$this->session->userdata("login_id"):$customer_id
                );
               // echo '<pre>';print_r($dta);exit;
                $this->db->insert("orders",$dta);
                $orderdids= $this->db->insert_id();
                if($this->db->insert_id() > 0){
                    $sprms["whereCondition"]   =   "cart_acde = '0' AND customer_id LIKE '".$customer_id."'";
                    $dview   =   $this->order_model->viewcartproducts($sprms); 
                    if(count($dview) > 0){
                        foreach($dview as $fer){
                            $speciations = array(
                                'cart_size'             => ($fer->cart_size ="")?$fer->cart_size:'',
                                'cart_indug'            => ($fer->cart_indug ="")?$fer->cart_indug:'',
                                'cart_message_on_cake'  => ($fer->cart_message_on_cake ="")?$fer->cart_message_on_cake:'',
                                'photo_on_cake'         => ($fer->photo_on_cake ="")?$fer->photo_on_cake:'',
                                'cart_date'             => ($fer->cart_date ="")?$fer->cart_date:'',
                                'cart_delivery_id'      => ($fer->cart_delivery_id ="")?$fer->cart_delivery_id:'',
                            );
                            $dta    =   array(
                                "orderdetail_id"                =>  "ODTL".$this->common_model->get_max("orderdetailid","order_details"), 
                                "orderdetail_vendor_id"         =>  $fer->vendor_id,
                                "orderdetail_customer_id"       =>  $customer_id,
                                "orderdetail_orderid"           =>  $orderid,
                                "orderdetail_vendorproduct_id"  =>  $fer->vendorproduct_id,
                                "orderdetail_price"             =>  $fer->cart_price,
                                "orderdetail_delivery_chage"    =>  $fer->cart_derliverytype,
                                "orderdetail_quantity"          =>  $fer->cart_quantity,
                                "orderdetail_speciations"       =>  json_encode($speciations),
                                "orderdetail_created_on"        =>  date("Y-m-d H:i:s"),
                                "orderdetail_created_by"        =>  $this->session->userdata("login_id")?$this->session->userdata("login_id"):$customer_id
                            );
                            $this->db->insert("order_details",$dta);
                            $dtda    =   array(
                                "cart_acde"         =>    '1', 
                                "cart_open"         =>    '0', 
                                "cart_modified_on"  =>    date("Y-m-d H:i:s"),
                                "cart_modified_by"  =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):$customer_id
                            ); 
                            $this->db->update("cart_details",$dtda,array("cart_id" => $fer->cart_id));
                        }
                    }
                    if($this->cart->contents() > 0){
                        $dview = $this->cart->contents();
                        $rirl=0;
                        foreach($dview as $fr){
                            $vsso       =  $fr['name'];
                            $delivery   =  isset($fr['delamount'])?$fr['delamount']:'0';
                            $total      =  $fr["qty"]*$fr["price"] ;
                            $rirl   +=  $fr["qty"]*$fr["price"]+$delivery;
                            $speciations = array(
                                'cart_size'             => ($fr['size'] ="")?$fr['size']:'',
                                'cart_indug'            => ($fr['type'] ="")?$fr['type']:'',
                                'cart_message_on_cake'  => ($fr['message_on_cake'] ="")?$fr['message_on_cake']:'',
                                'photo_on_cake'         => ($fr['photo_on_cake'] ="")?$fr['photo_on_cake']:'',
                                'cart_date'             => ($fr['deldate'] ="")?$fr['deldate']:'',
                                'cart_delivery_id'      => ($fr['deltype'] ="")?$fr['deltype']:'',
                                'cart_country'          => ($fr['cart_country'] ="")?$fr['cart_country']:'',
                            );
                            $dta    =   array(
                                "orderdetail_id"                =>  "ODTL".$this->common_model->get_max("orderdetailid","order_details"), 
                                "orderdetail_vendor_id"         =>  $fr['vendor_id'], 
                                "orderdetail_customer_id"       =>  $customer_id, 
                                "orderdetail_orderid"           =>  $orderid,
                                "orderdetail_vendorproduct_id"  =>  $fr['prodid'],
                                "orderdetail_price"             =>  $total,
                                "orderdetail_delivery_chage"    =>  $delivery,
                                "orderdetail_speciations"       =>  json_encode($speciations),
                                "orderdetail_quantity"          =>  $fr["qty"],
                                "orderdetail_created_on"        =>  date("Y-m-d H:i:s"),
                                "orderdetail_created_by"        =>  $this->session->userdata("login_id")?$this->session->userdata("login_id"):$customer_id
                            );
                            $this->db->insert("order_details",$dta);
                            $dtda    =   array(
                                "cart_acde"         =>    '1', 
                                "cart_modified_on"  =>    date("Y-m-d H:i:s"),
                                "cart_modified_by"  =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):$customer_id
                            );
                            //$this->db->update("cart_details",$dtda,array("cart_id" => $fer->cart_id));
                        }
                    }
                    return $orderdids;
                }
            }
            return FALSE;
        }
        
        public function checkouts($customer_id,$orderid = null){
            //if($orderid !=""){
                $sprms["whereCondition"]   =   "cart_acde = '0' AND customer_id LIKE '".$customer_id."'";
                $dview   =   $this->order_model->viewcartproducts($sprms);
                //print_r($dview);exit;
                if($this->cart->contents() > 0){
                    $dview = $this->cart->contents();
                    $rirl=0;
                    foreach($dview as $fr){
                        //echo '<pre>';print_r($fr);exit;
                        $vsso       =  $fr['name'];
                        $delivery   =  isset($fr['delamount'])?$fr['delamount']:'0';
                        $total      =  $fr["qty"]*$fr["price"] ;
                        $rirl   +=  $fr["qty"]*$fr["price"]+$delivery;
                        $speciations = array(
                            'cart_size'             => ($fr['size'] !="")?$fr['size']:'',
                            'cart_indug'            => ($fr['type'] !="")?$fr['type']:'',
                            'cart_message_on_cake'  => ($fr['message_on_cake'] !="")?$fr['message_on_cake']:'',
                            'cart_date'             => ($fr['deldate'] !="")?$fr['deldate']:'',
                            'cart_delivery_id'      => ($fr['deltype'] !="")?$fr['deltype']:'',
                            'cart_country'          => ($this->session->userdata("currency_code")!="")?$this->session->userdata("currency_code"):'',
                        );
                        if(isset($fr['photo_on_cake']) && $fr['photo_on_cake'] !=""){
                            $speciations['photo_on_cake'] = ($fr['photo_on_cake'] !="")?$fr['photo_on_cake']:'';
                        }
                        $dta    =   array(
                            "orderdetail_id"                =>  "ODTL".$this->common_model->get_max("orderdetailid","order_details"), 
                            "orderdetail_vendor_id"         =>  $fr['vendor_id'], 
                            "orderdetail_customer_id"       =>  $customer_id, 
                            "orderdetail_orderid"           =>  $orderid,
                            "orderdetail_vendorproduct_id"  =>  $fr['prodid'],
                            "orderdetail_price"             =>  $total,
                            "orderdetail_delivery_chage"    =>  $delivery,
                            "orderdetail_speciations"       =>  json_encode($speciations),
                            "orderdetail_quantity"          =>  $fr["qty"],
                            "orderdetail_created_on"        =>  date("Y-m-d H:i:s"),
                            "orderdetail_created_by"        =>  $this->session->userdata("login_id")?$this->session->userdata("login_id"):$customer_id
                        );
                        //echo '<pre>';print_r($dta);exit;
                        $this->db->insert("order_details",$dta);
                        //$this->db->update("cart_details",$dtda,array("cart_id" => $fer->cart_id));
                        if($fr['vendor_id'] !="" && $customer_id!=""){
                            $this->order_model->remove_wishlist($fr['prodid'],$customer_id);
                        }
                    }
                }
                if(count($dview) > 0){
                    foreach($dview as $fer){
                        $speciations = array(
                            'cart_size'             => ($fer->cart_size ="")?$fer->cart_size:'',
                            'cart_indug'            => ($fer->cart_indug ="")?$fer->cart_indug:'',
                            'cart_message_on_cake'  => ($fer->cart_message_on_cake ="")?$fer->cart_message_on_cake:'',
                            'photo_on_cake'         => ($fer->photo_on_cake ="")?$fer->photo_on_cake:'',
                            'cart_date'             => ($fer->cart_date ="")?$fer->cart_date:'',
                            'cart_delivery_id'      => ($fer->cart_delivery_id ="")?$fer->cart_delivery_id:'',
                            'cart_country'          => ($fer->cart_country ="")?$fer->cart_country:'',
                        );
                        $dta    =   array(
                            "orderdetail_id"                =>  "ODTL".$this->common_model->get_max("orderdetailid","order_details"), 
                            "orderdetail_vendor_id"         =>  $fer->vendor_id,
                            "orderdetail_customer_id"       =>  $customer_id,
                            "orderdetail_orderid"           =>  $orderid,
                            "orderdetail_vendorproduct_id"  =>  $fer->vendorproduct_id,
                            "orderdetail_price"             =>  $fer->cart_price,
                            "orderdetail_delivery_chage"    =>  $fer->cart_derliverytype,
                            "orderdetail_quantity"          =>  $fer->cart_quantity,
                            "orderdetail_speciations"       =>  json_encode($speciations),
                            "orderdetail_created_on"        =>  date("Y-m-d H:i:s"),
                            "orderdetail_created_by"        =>  $this->session->userdata("login_id")?$this->session->userdata("login_id"):$customer_id
                        );
                        $this->db->insert("order_details",$dta);
                        $dtda    =   array(
                            "cart_acde"         =>    '1', 
                            "cart_open"         =>    '0', 
                            "cart_modified_on"  =>    date("Y-m-d H:i:s"),
                            "cart_modified_by"  =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):$customer_id
                        ); 
                        $this->db->update("cart_details",$dtda,array("cart_id" => $fer->cart_id));
                    }
                }
                return $orderid;
            /*}else{
                return false;
            }*/
        }
        public function update_order($customer_id,$orderid,$d=array()){
            $r = $this->db->where('order_id',$orderid)->update('orders',$d);
            if($r){
                if($status == 3){
                    $par['whereCondition'] = "orderdetail_orderid LIKE '".$orderid."'";
                    $order_details = $this->order_model->vieworderdetails($par);
                    if(is_array($order_details) && count($order_details) >0){
                        foreach($order_details as $o){
                            $speciations = json_decode($o->orderdetail_speciations);
                            //echo '<pre>';print_r($speciations);exit;
                            $target_dir =   $this->config->item("upload_url")."products/";
                            $psm["columns"]   =   "vendorproduct_id,vendorproduct_vendor_id,vendorproduct_bb_price,product_name,(CONCAT('$target_dir',vendorproductimg_name)) as vendorproductimg_name,prodind,prod_indug,vendorproductprinceid,vendorproduct_bb_quantity";
                            $hr ="vp.vendorproduct_id LIKE '".$o->orderdetail_vendorproduct_id."'";
                            if(!empty($size)){
                               $hr.="AND vpp.vendorproductprinceid LIKE '".$size."'";
                            }
                            if(!empty($type) && $type != "undefined"){
                                $hr.="AND pi.prodind LIKE '".$type."'";
                            }
                            $psm["whereCondition"]  =   $hr;
                            $product     =   $this->vendor_model->getVendorproduct($psm);
                            $id = $o->orderdetail_vendorproduct_id;
                            if(!empty($product["vendorproductprinceid"])){
                                $id .= $product["vendorproductprinceid"];
                            }
                            if(!empty($product["vendorproductprinceid"])){
                                $id .= $product["prodind"];
                            }
                            
                            if(!empty($speciations->cart_delivery_id)){
                                $dta    =   $this->deliverycharges_model->getdeliverychg($speciations->cart_delivery_id);
                                if(is_array($dta)&& count($dta)  > 0){
                                    $timestamp1 = strtotime($dta['deliverychg_end']);
                                    $end        =  date('H:i', $timestamp1);
                                    $timestamp  = strtotime($dta['deliverychg_start']);
                                    $start      =  date('H:i', $timestamp);
                                    $time       = $start.' - '.$end;
                                    $amount     = $dta['deliverychg_amount'];
                                }
                            }
                            $data = array(
                                'id'                =>  $id.date('YmdHisa'),
                                'price'             =>  $product["vendorproduct_bb_price"],
                                'name'              =>  $this->common_config->removeNonUtf8($product["product_name"]),
                                "image"             =>  $product["vendorproductimg_name"],
                                'qty'               =>  $o->orderdetail_quantity,
                                'size'              =>  ($speciations->cart_size !="")?$speciations->cart_size:'',
                                'type'              =>  ($speciations->cart_indug !="")?$speciations->cart_indug:'',
                                'prodid'            =>  isset($product["vendorproduct_id"])?$product["vendorproduct_id"]:'',
                                'vendor_id'         =>  isset($product["vendorproduct_vendor_id"])?$product["vendorproduct_vendor_id"]:'',
                                'message_on_cake'   =>  ($speciations->cart_message_on_cake !="")?$speciations->cart_message_on_cake:'',
                                'photo_on_cake'     =>  ($speciations->photo_on_cake !="")?$speciations->photo_on_cake:'',
                                'sizeid'            =>  $product["vendorproductprinceid"],
                                'typeid'            =>  $product["prodind"],
                                'deldate'           =>  ($speciations->cart_date !="")?$speciations->cart_date:'',
                                'deltime'           =>  $time,
                                'delamount'         =>  $amount,
                                'deltype'           =>  ($speciations->cart_delivery_id !="")?$speciations->cart_delivery_id:'',
                            );
                            $this->cart->insert($data); 
                        }
                    }
                }
                return true;
            }else{
                return false;
            }
        }
        public function queryorders($params = array()){
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
                    "ct.order_open"      =>  "1", 
                    "ct.order_status"      =>  "1",
                    "cp.customer_open"      =>  "1",
                    "cp.customer_status"      =>  "1",
                );
                $this->db->select("$sel")
                        ->from("orders as ct")
                        ->join("customers as  cp","ct.order_customer_id = cp.customer_id","INNER") 
                        ->join("customer_address as  cad","ct.order_address_id = cad.customeraddress_id","INNER") 
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(order_unique LIKE '%".$params["keywords"]."%' OR order_sub_total LIKE '%".$params["keywords"]."%' OR order_total LIKE '%".$params["keywords"]."%' OR order_payment_mode LIKE '%".$params["keywords"]."%' OR customer_name LIKE '%".$params["keywords"]."%' )");
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
        public function cntvieworders($params  =    array()){
                $params["cnt"]      =   "1"; 
                $val    =   $this->queryorders($params)->row_array();
                if(isset($val)){
                    return  $val['cnt'];
                }
                return "0";
        }
        public function vieworders($params = array()){
//                $this->queryorders($params);echo $this->db->last_query();exit;
                return $this->queryorders($params)->result();
        }
        public function getorders($params = array()){
                return $this->queryorders($params)->row_array();
        }
        public function queryorderdetails($params = array()){
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
                    "dt.orderdetail_open"       =>  "1",
                    "dt.orderdetail_status" =>  "1",
                    "ct.order_open"      =>  "1", 
                    "ct.order_status"      =>  "1", 
                    "vp.vendorproduct_open"     =>  "1",
                    "vp.vendorproduct_status"   =>  "1",
                    "cp.customer_status"    =>  "1",
                    "cp.customer_open"      =>  "1",
                    "vd.vendor_open"    =>  "1",
                    "vd.vendor_status"  =>  "1"
                );
                $this->db->select("$sel")
                        ->from("order_details as dt")
                        ->join("orders as ct","ct.order_id = dt.orderdetail_orderid","INNER") 
                        ->join("customers as  cp","cp.customer_id = ct.order_customer_id","INNER")
                        ->join("customer_address as  ca","ct.order_address_id = ca.customeraddress_id","LEFT")
                        ->join("vendor_products as vp","vp.vendorproduct_id = dt.orderdetail_vendorproduct_id","INNER") 
                        //->join("measures as  mhd","mhd.measure_id = vp.vendorproduct_measure","INNER") 
                        ->join("products as  pd","pd.product_id = vp.vendorproduct_product","INNER") 
                        ->join("category as sn","sn.category_id = vp.vendorproduct_category","INNER")  
                        ->join("sub_category as sv","sv.subcategory_id = vp.vendorproduct_subcategory","LEFT")  
                        ->join("vendor as  vd","vd.vendor_id = vp.vendorproduct_vendor_id","INNER")
                        ->join("(SELECT * FROM vendorproduct_images  WHERE vendorproductimg_open = '1' AND  vendorproductimg_status = '1' GROUP BY vendorproduct_productid) as vimp","vimp.vendorproduct_productid = vp.vendorproduct_id AND vp.vendorproduct_id = dt.orderdetail_vendorproduct_id","INNER")
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(cart_quantity LIKE '%".$params["keywords"]."%')");
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
        public function cntvieworderdetails($params  =    array()){
                $params["cnt"]      =   "1"; 
                $val    =   $this->queryorderdetails($params)->row_array();
                if(isset($val)){
                    return  $val['cnt'];
                }
                return "0";
        }
        public function vieworderdetails($params = array()){
//                $this->queryorderdetails($params);echo $this->db->last_query();exit;
                return $this->queryorderdetails($params)->result();
        }
        public function getorderdetails($params = array()){
                return $this->queryorderdetails($params)->row_array();
        }
        public function add_to_wishlist($custid,$vendorid){
            $dta    =   array(
                "wishlist_id"               => "WLST".$this->common_model->get_max("wishlistid","wishlist"), 
                "wishlist_customer_id"      => $custid, 
                "wishlist_vendor_productid" => $vendorid,
                "wishlist_created_on"       => date("Y-m-d H:i:s"),
                "wishlist_created_by"       => $this->session->userdata("login_id")?$this->session->userdata("login_id"):$custid
            );
            //print_r($dta);exit;
            $this->db->insert("wishlist",$dta);
            if($this->db->insert_id() > 0){ 
                return TRUE;
            }
            return FALSE;
        }
        public function remove_wishlist($vendorproduct_id,$customer_id){
            $par['whereCondition'] = "wishlist_customer_id LIKE '".$customer_id."' AND wishlist_vendor_productid LIKE '".$vendorproduct_id."'";
            $r = $this->order_model->getwishlistproduct($par);
            if(is_array($r) && count($r) > 0){
                $d = array(
                    'wishlist_open'         => 0,
                    'wishlist_modified_by'  => $customer_id,
                    'wishlist_modified_on'  => date('Y-m-d H:i:s'),
                );
                $this->db->where('wishlist_id',$r['wishlist_id'])->update('wishlist',$d);
            }
        }
        public function querywishlistproduct($params = array()){
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
                    "ct.wishlist_open"      =>  "1",
                    "ct.wishlist_status"    =>  "1",
                    "pd.product_open"   =>  "1",
                    "pd.product_status" =>  "1",
                    "vd.vendor_open"    =>  "1",
                    "vd.vendor_status"  =>  "1",
                    "vp.vendorproduct_open"     =>  "1",
                    "vp.vendorproduct_status"   =>  "1",
                    //"mhd.measure_status"        =>  "1",
                    //"mhd.measure_open"          =>  "1",
                    "cp.customer_open"      =>  "1",
                    "cp.customer_status"    => "1"
                );
                $this->db->select("$sel")
                        ->from("wishlist as ct") 
                        ->join("vendor_products as vp","vp.vendorproduct_id = ct.wishlist_vendor_productid","INNER") 
                        //->join("measures as  mhd","mhd.measure_id = vp.vendorproduct_measure","INNER") 
                        ->join("products as  pd","pd.product_id = vp.vendorproduct_product","INNER") 
                        ->join("category as sn","sn.category_id = vp.vendorproduct_category","INNER")  
                        ->join("sub_category as sv","sv.subcategory_id = vp.vendorproduct_subcategory","LEFT")  
                        ->join("vendor as  vd","vd.vendor_id = vp.vendorproduct_vendor_id","INNER")
                        ->join("vendor_product_princes as  vpp","vp.vendorproduct_id = vpp.vendorproductids","INNER")
                        ->join("customers as  cp","ct.wishlist_customer_id = cp.customer_id","INNER")
                        ->join("(SELECT * FROM vendorproduct_images WHERE vendorproductimg_open = '1' AND  vendorproductimg_status = '1' GROUP BY vendorproduct_productid) as vimp","vp.vendorproduct_id = vimp.vendorproduct_productid","INNER")
                        ->where($dta);
                if(array_key_exists("keywords", $params)){
                    $this->db->where("(cart_quantity LIKE '%".$params["keywords"]."%')");
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
        public function cntwishlistproducts($params  =    array()){
                $params["cnt"]      =   "1"; 
                $val    =   $this->querywishlistproduct($params)->row_array();
                if(isset($val)){
                    return  $val['cnt'];
                }
                return "0";
        }
        public function viewwishlistproducts($params = array()){
//                $this->querywishlistproduct($params);echo $this->db->last_query();exit;
                return $this->querywishlistproduct($params)->result();
        }
        public function getwishlistproduct($params = array()){
                return $this->querywishlistproduct($params)->row_array();
        }
        public function deletefromwishlist($cart_id,$custid){ 
            $dta    =   array( 
                "wishlist_open"         =>    0, 
                "wishlist_modified_on"  =>    date("Y-m-d H:i:s"),
                "wishlist_modified_by"  =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):$custid
            ); 
            $this->db->update("wishlist",$dta,array("wishlist_id" => $cart_id));
            if($this->db->affected_rows() > 0){ 
                return TRUE;
            }
            return FALSE;
        }
          
        public function orderstatusupda($orderid,$status){
                $params["whereCondition"]    =   "order_id LIKE '".$orderid."'";
                $vsp            =   $this->order_model->getorders($params);
                $customer_id    =   $vsp["customer_id"]; 
                $uniq   =   $vsp['order_unique'];
                //$ca     =   $this->order_model->delivery_status($orderid,$status,$customer_id);
                $cdp    =   "";
                if(strtolower($status) == "picked up"){
                    $cdp    =   "picked up";
                }
                if($status == "On the Way"){
                    $cdp    =   "on the way";
                }
                if($status == "Order Cancelled"){
                    $cdp    =   "cancelled";
                }
                $message    =   "Your Order has been ".$cdp." Succcessfully.Order no : ".$uniq;
                $vsf        =   $this->notification_model->createnotification($customer_id,$message); 
                if($status != "Order Cancelled"){
                    $latitude   =   ($vsp['order_latitude'] != "")?$vsp['order_latitude']:"19.9323947";
                    $longitude  =   ($vsp['order_longitude'] != "")?$vsp["order_longitude"]:"79.32199709999999";
                    $orderdate  =   $vsp['order_date'];
                    //$sf         =   $this->delivery_boys_model->assign_orders($orderid,$latitude,$longitude,$orderdate); 
                }
                if($status == "Delivered"){
                    $token = $this->coupon_gen($vsp["order_coupon"]);
                }
                $dtaa   =   array(
                    "order_coupon_gen"  => ($token)??'',
                    "order_acde"    =>  $status,
                    "order_modified_on" =>  date("Y-m-d H:i:s"),
                    "order_modified_by" =>  $this->session->userdata("login_id")
                );
                $this->db->update("orders",$dtaa,array("order_id" => $orderid));
                return TRUE;
        }   
        public function order_email($toemail,$data =array()){
            $subject= "Order Information -minikart";
    	    $messge = '<!DOCTYPE html>
                        <html>
                        
                        <head>
                            <title></title>
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                            <meta name="viewport" content="width=device-width, initial-scale=1">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                            <link rel="stylesheet" href="'.base_url().'//assets/css/all.min.css">
                            <link rel="stylesheet" href="'.base_url().'//assets/css/style.css">
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
                                                                    <img src="'.base_url().'assets/images/logo.png" alt="logo" style="max-height:20vh;">
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
                                                                                <p style="font-size: 18px; font-weight: 400; margin: 0; color: #000;"><a href="'.base_url().'" target="_blank" style="color: #000; text-decoration: none;">Shop &nbsp;</a></p>
                                                                            </td>
                                                                            <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 24px;"> <a href="'.base_url().'" target="_blank" style="color: #ffffff; text-decoration: none;"><img src="https://img.icons8.com/color/48/000000/small-business.png" width="27" height="23" style="display: block; border: 0px;" /></a> </td>
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
                                                            <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <img src="'.base_url().'assets/images/check.png" width="125" height="120" style="display: block; border: 0px;" /><br>
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
                                                                        <td align="center" style="border-radius: 5px;" bgcolor="#66b3b7"> <a href="'.base_url().'" target="_blank" style="font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #F44336; padding: 15px 30px; border: 1px solid #F44336; display: block;">Shop Again</a> </td>
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
                                                            <td > <img src="'.base_url().'assets/images/logo.png"  width="30%" style="display: block; border: 0px;" /> </td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td >
                                                            <p> Phone :  +919160708686<br> email : support@minikart.in</br>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;">
                                                            <p class="copyright">Copyright © 2021 <a href="">Minikart</a>. All Rights Reserved.</p>
                                                                <p style="font-size: 14px; font-weight: 400; line-height: 20px; color: #777777;"> If you didn\'t order this, please ignore this email or <a href="'.base_url().'" target="_blank" style="color: #777777;">unsusbscribe</a>. </p>
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
        }
        public function coupon_gen($coupon){
            $params["whereCondition"] = "customer_coupon = '".$coupon."'";
            $vsp        =   $this->customer_model->queryCustomer($params)->row_array();
            if(isset($vsp)){
                $pmrs["whereCondition"]  =   "refer_refer LIKE  'earn' AND refer_abc = 'Active'";
                $vsps	=	$this->refer_model->getRefer($pmrs);
                $token = $this->customer_model->ajax_coupon();
                
                $Date = date("Y-m-d h:i:s");
                $updateDate =  date("Y-m-d h:i:s", strtotime($Date. ' + '.$vsps[0]['refer_validity'].' days'));

                $data = array(
                    'coupon_type'                     =>  $vsps[0]['refer_type'], 
                    'coupon_min_value'                =>  $vsps[0]['refer_min_value'],          
                    'coupon_discount'                 =>  $vsps[0]['refer_discount'],        
                    'coupon_max_discount'             =>  $vsps[0]['refer_max_discount'],          
                    'coupon_coupon'                   =>  $token,        
                    'coupon_per_person'               =>  $vsps[0]['refer_per_person'],             
                    'coupon_nth_value'                =>  $vsps[0]['refer_nth_value'], 
                    'coupon_applicable'               =>  $vsps[0]['refer_applicable'],     
                    'coupon_cust_type'                =>  $vsps[0]['refer_cust_type'],       
                    'coupon_date_from'                =>  $Date,          
                    'coupon_date_to'                  =>  $updateDate,      
                    'coupon_cr_on'                    =>  date("Y-m-d h:i:s"),    
                    'coupon_cr_by'                    =>  $this->session->userdata("login_id"),     
                    'coupon_approve'                   =>  'Pending',
                );
                //echo '<pre>';print_r($data);exit;
                $this->db->insert("coupon",$data);
                $vsp   =    $this->db->insert_id();
                if($vsp > 0){
                    $dat=array(
                        "coupon_id" 			=> $vsp."DIS"
                    );
                    $id=$vsp;	
                    $this->db->update("coupon",$dat,"couponid='".$vsp."'");
                    return $token;
                }
            }
        }
}