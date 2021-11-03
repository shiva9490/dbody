<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Shoppingcart extends CI_Controller{
        public function __construct() {
                parent::__construct();
        }
        public function addtocart(){
			$time='';$amount='';$deltype='';
            //print_r($this->input->post());exit;
            $id         =  $this->input->post("id");
            $size       =  $this->input->post("size");
            $type       =  $this->input->post("type");
            $date       =  $this->input->post("date");
            $deltype    =  $this->input->post("deltype");
            $addon_id   =  ($this->input->post("addon_id"))??'';
            if($addon_id==''){
                $this->session->unset_userdata("addon_id");
            }
            $target_dir =   $this->config->item("upload_url")."products/";
            $psm["columns"]   =   "vendorproduct_id,vendorproduct_vendor_id,vendorproduct_bb_price,product_name,(CONCAT('$target_dir',vendorproductimg_name)) as vendorproductimg_name,prodind,prod_indug,vendorproductprinceid,vendorproduct_bb_quantity";
            $hr ="vp.vendorproduct_id LIKE '".$id."'";
            if(!empty($size) && $size!="undefined" && $type != "undefined"){
               $hr.="AND vpp.vendorproductprinceid LIKE '".$size."'";
            }
            if(!empty($type) && $type != "undefined"){
                $hr.="AND pi.prodind LIKE '".$type."'";
            }
            $psm["whereCondition"]  =   $hr;
            $product     =   $this->vendor_model->getVendorproduct($psm);
            //print_r($hr);exit;
            $id = $id;
            if(!empty($product["vendorproductprinceid"])){
                $id .= $product["vendorproductprinceid"];
            }
            if(!empty($product["vendorproductprinceid"])){
                $id .= $product["prodind"];
            }
            if(!empty($deltype)){
                $dta    =   $this->deliverycharges_model->getdeliverychg($deltype);
                if(is_array($dta)&& count($dta)  > 0){
                    $timestamp1 = strtotime($dta['deliverychg_end']);
                    $end        = date('H:i', $timestamp1);
                    $timestamp  = strtotime($dta['deliverychg_start']);
                    $start      = date('H:i', $timestamp);
                    $time       = $start.' - '.$end;
                    $amount     = $dta['deliverychg_amount'];
                }
            }
            $dates       = date('Y-m-d', strtotime(str_replace('/', '-', $date)));
            $data = array(
                'id'                =>  $id.date('YmdHisa'),
                'price'             =>  $product["vendorproduct_bb_price"],
                'name'              =>  $this->common_config->removeNonUtf8($product["product_name"]),
                "image"             =>  $product["vendorproductimg_name"],
                'qty'               =>  $this->input->post("quant"),
                'size'              =>  $product["vendorproduct_bb_quantity"],
                'type'              =>  $product["prod_indug"],
                'prodid'            =>  isset($product["vendorproduct_id"])?$product["vendorproduct_id"]:'',
                'vendor_id'         =>  isset($product["vendorproduct_vendor_id"])?$product["vendorproduct_vendor_id"]:'',
                'message_on_cake'   =>  ($this->input->post('message_on_cake')!="")?$this->input->post('message_on_cake'):'',
                'sizeid'            =>  $product["vendorproductprinceid"],
                'typeid'            =>  $product["prodind"],
                'deldate'           =>  $dates,
                'deltime'           =>  ($time!="")?$time:'',
                'delamount'         =>  $amount,
                'deltype'           =>  $deltype,
                'addon_id'          =>  ($this->session->userdata("addon_id"))??'',
            );
            if(count($_FILES) > 0){
                $target_dir =   $this->config->item("uploads_path")."customer-uploads/";
                $fname      =   $_FILES["photo_on_cake"]["name"];
                if($fname != "" && $fname != "noname"){
                    $vsp        =   explode(".",$fname);
                    $fname      =   $this->input->post("customer_mobile").".".$vsp['1'];
                    $uploadfile =   $target_dir . basename($fname);
                    $vsp 	=	move_uploaded_file($_FILES['photo_on_cake']['tmp_name'], $uploadfile); 
                    if($vsp){
                        $data['photo_on_cake'] =   $fname;
                    }
                }
            }
            //print_r($data);exit;
             $daa=array('amount' => $product["vendorproduct_bb_price"],'delivery' => $amount);
            $this->cart->insert($data); 
            //echo '<pre>';print_r($this->cart->contents());exit;
            if($addon_id==''){
                $contents = $this->cart->contents();
                $row = array_keys($contents);
                $last  = count($row)-1;
                if(!empty($row[$last])){
                    $this->session->set_userdata("addon_id",$row[$last]);
                }
                
            }
            $this->load->view("cartdata",$daa);
        }
       
        public function updatetocart(){
            $this->cartupdate_price_out_stock();
            $id     =   $this->input->post("id");
            $data = array(
                'rowid'     =>      $id, 
                'qty'       =>      $this->input->post("quant")
            );
            $this->cart->update($data); 
            $this->load->view("cartdata");
        }
        public function viewquantity(){
                $rtotl  =   "0";
                $vsp =  $this->cart->contents();
                foreach($vsp as $fr){
                    $rtotl  =   $rtotl+1;
                }
                echo $rtotl;
        }
        public function viewcartprice(){
            $this->cartupdate_price_out_stock();
            $coupon_oll = $this->session->userdata("coupon_code");
            $coupon_old =   ($coupon_oll['coupon'])??'';
            $mobile     =   $this->session->userdata("customer_mobile");
            $total     =    $this->cart->total();
			$coupon_data='';
			if($coupon_old!="" && $mobile !=""&& $total!=""){
            $r  =   (array)json_decode($this->coupon_model->Coupon_check($coupon_old,$mobile,$total));
				if($r['status']=="4"){
					$coupon_data = (array)$r['status_messsage'];
				}else{
					$coupon_data='';
				}
			}
			$rtotl  =   "0";
			$country = $this->session->userdata("currency_code");
			$rtotl      =   $this->cart->contents();
			$rirl   =   "0";
			foreach($rtotl as $fr){
				$vtoal      =  "0";
				$vsso       =  $fr['name'];
				$delivery   =  isset($fr['delamount'])?$fr['delamount']:'0';
				if(!empty($coupon_data)){
					if($coupon_data['coupon_applicable'] == 'All' || in_array($fr['prodid'],$coupon_data['products_applicable'])) {
						if($coupon_data['coupon_type']=='Percentage'){
							$discount   =  ($fr["price"]/100)*$coupon_data['coupon_discount'];
						}else if($coupon_data['coupon_type']=='Amount'){
							$discount   =   $coupon_data['coupon_discount'];
						}
						$rirl       +=  $fr["qty"]*($fr["price"]-$discount)+$delivery;
					}
				}else{
					$rirl       +=  $fr["qty"]*(float)$fr["price"]+(float)$delivery;
				}
				//$rirl       +=  $fr["qty"]*$fr["price"]+$delivery;
			}
			$vsp =  $this->customer_model->currency_change($country,$rirl);
			echo $vsp;
        }
        public function cartupdate(){
                $this->cartupdate_price_out_stock();
                $total  =   count($this->cart->contents());
                $item   =   $this->input->post('id[]');
                $qty    =   $this->input->post('qty[]'); 
                for($i=0;$i < $total;$i++) {
                        $data = array(
                            'id' => $item[$i],
                            'qty'   => $qty[$i]
                        );
                        $this->cart->update($data);
                }
        }
        public function cartupdate_price_out_stock(){
            $rtotl  =   $this->cart->contents();
            foreach($rtotl as $fr){
                $prd        =  $fr['prodid'];
                $price_id   =  $fr['sizeid'];
                $param['whereCondition'] = "vendorproduct_id = '".$prd."' AND vendorproductprinceid ='".$price_id."'";
                $dta = $this->vendor_model->getVendorproduct_list($param);
                if(count($dta) > 0){
                    if($dta['vendorproduct_out_stock']==1){
                        $data = array(
                            'rowid'     =>  $fr['rowid'],
                            'qty'       =>  0
                        );
                        $this->cart->update($data);
                        $rtotls      =   $this->cart->contents();
                        foreach($rtotls as $ff){
                            if($ff['addon_id']==$fr['rowid']){
                                $data = array(
                                    'rowid'     =>  $ff['rowid'],
                                    'qty'       =>  0
                                );
                                $this->cart->update($data);   
                            }
                        }
                    }else{
                        $data = array(
                            'rowid'     =>  $fr['rowid'],
                            'price'     =>  $dta['vendorproduct_bb_price'],
                        );
                        $this->cart->update($data);
                    }
                }//echo $dta['vendorproduct_bb_price'];
                
            }
                
        }
        public function removecart(){
                //$uri        =   $this->uri->segment("2");
                $rowid  =   $this->input->post('rowid');
                $data = array(
                    'rowid'     =>  $rowid,
                    'qty'       =>  0
                );
                $this->cart->update($data);   
                //remove addons if any
                $rtotl      =   $this->cart->contents();
                foreach($rtotl as $fr){
                    if($fr['addon_id']==$rowid){
                        $data = array(
                            'rowid'     =>  $fr['rowid'],
                            'qty'       =>  0
                        );
                        $this->cart->update($data);   
                    }
                }
                
                $this->load->view("cartdata");
                $this->load->view("theme/sidebarcart");
        }
        public function opencart()    {
                $dta    =   array(
                            "title"     =>  "Cart",
                            "content"   =>  "cart_model",
                            "view"      =>  $this->cart->contents()
                    );
                $this->load->view("home_template",$dta);
        }
        public function trackorders()    {
            $dta    =   array(
                        "title"     =>  "Cart",
                        "content"   =>  "shopping/trackorder",
                        "view"  =>  array()
                );
            if($this->input->post("track")){
                $this->form_validation->set_rules("orderid","Order No.","required|xss_clean|trim"); 
                if($this->form_validation->run() == TRUE){ 
                    $psm["whereCondition"]  =   "order_unique LIKE '".$this->input->post("orderid")."'";
                    $dta["view"]            =   $this->order_model->getorders($psm);
                }
            }
            $this->load->view("theme/inner_template",$dta);
        }
        public function viewCartpupdate(){
            $this->load->view("theme/sidebarcart");
        }
        public function checkout(){
            $orpmobile  =   $this->session->userdata("customer_mobile");
            if($orpmobile == ""){
                $this->session->set_flashdata("war","Please login to checkout the cart");
                redirect("/View-Cart");
            }
            $data['content']    =  "shopping/checkout";  
            $total  =   count($this->cart->contents());
            if($total == 0){
                redirect("/View-Cart");
            }
            $data["view"]       =   $this->customer_model->viewCustomeraddress();
            $this->load->view('theme/inner_template',$data);
	    }  
}