<?php
class Coupon_model extends CI_Model{
public function create(){
    $data = array(
        'coupon_type'                     =>  $this->input->post('coupon_type'), 
        'coupon_min_value'                =>  $this->input->post('min_coupon'),          
        'coupon_discount'                 =>  $this->input->post('discount'),        
        'coupon_max_discount'             =>  $this->input->post('max_discount'),          
        'coupon_coupon'                   =>  $this->input->post('coupon'),        
        'coupon_per_person'               =>  $this->input->post('per_person'),             
        'coupon_nth_value'                =>  $this->input->post('nth_value'), 
        'coupon_applicable'               =>  $this->input->post('for_type'),     
        'coupon_cust_type'                =>  $this->input->post('typeofcust'),       
        'coupon_date_from'                =>  $this->input->post('from_date'),          
        'coupon_date_to'                  =>  $this->input->post('to_date'),      
        'coupon_cr_on'                    =>  date("Y-m-d h:i:s"),    
        'resturant_id'                      =>  $this->session->userdata("login_id"),
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
        if($this->input->post('for_type')=='Product wise'){
            foreach($this->input->post('Prod') as $prodid)
            { 
                $par['whereCondition'] = "vp.vendorproduct_id = '".$prodid."'";
                $par['columns']	="vendorproduct_category";
                $category           =   $this->vendor_model->getVendorproduct($par);
                $data = array(
                    'coupon_items_coupon_id'        =>  $vsp."DIS",
                    'coupon_items_category_id'        =>  $category['vendorproduct_category'],         
                    'coupon_items_item_id'            =>  $prodid,    
                    'coupon_items_cr_on'              =>  date("Y-m-d h:i:s"),    
                    'coupon_items_cr_by'              =>  $this->session->userdata("login_id"), 
                );
                $this->db->insert("coupon_items",$data);
                $vs   =    $this->db->insert_id();
                if($vs > 0){
                    $dat=array(
                        "coupon_items_id" 			=> $vs."DISI"
                    );
                    $this->db->update("coupon_items",$dat,"coupon_itemsid='".$vs."'");
                
                } 
            }
        }
        if($this->input->post('for_type')=='Category wise'){
            foreach($this->input->post('cat') as $catid)
            { 
                $par['whereCondition'] = "vp.vendorproduct_category = '".$catid."'";
                $par['columns']	="distinct(product_name),vendorproduct_id ";
                $product           =   $this->vendor_model->viewVendorproducts($par);
                foreach($product as $p){
                    $data = array(
                        'coupon_items_coupon_id'        =>  $vsp."DIS",
                        'coupon_items_category_id'        =>  $catid,         
                        'coupon_items_item_id'            =>  $p->vendorproduct_id,    
                        'coupon_items_cr_on'              =>  date("Y-m-d h:i:s"),    
                        'coupon_items_cr_by'              =>  $this->session->userdata("login_id"), 
                    );
                    $this->db->insert("coupon_items",$data);
                    $vs  =    $this->db->insert_id();
                    if($vs > 0){
                        $dat=array(
                            "coupon_items_id" 			=> $vs."DISI"
                        );
                        $this->db->update("coupon_items",$dat,"coupon_itemsid='".$vs."'");
                    
                    } 
                }
                
            }
        }
		return TRUE;
       
    } return false;
}
public function viewCoupon($params = array()){
    return $this->queryCoupon($params)->result();
}
public function getCoupon($params = array()){
    return $this->queryCoupon($params)->result_array();
}
public function queryCoupon($params = array()){
    $dt =   array(
        "coupon_open"  	=> '1'
    );
    $sel        =   "*";
    if(array_key_exists("cnt",$params)){
        $sel    =   "count(*) as cnt";
    }
    if(array_key_exists("columns",$params)){
        $sel    =    $params["columns"];
    }
    $this->db->select($sel)
                ->from("coupon")
                ->where($dt);
    if(array_key_exists("keywords",$params)){
            $this->db->where("(Coupon_type LIKE '%".$params["keywords"]."%')");
    }
    if(array_key_exists("whereCondition",$params)){
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
  //$this->db->get();echo $this->db->last_query();exit;
    return  $this->db->get();
}

public function cntviewCoupon($params = array()){
    $params["cnt"]      =   "1";
    $val    =   $this->queryCoupon($params)->row_array();
    if(is_array($val) && count($val) > 0){
        return  $val['cnt'];
    }
    return "0";
}
public function activedeactive($uri,$status){
    $dat=array(
        "coupon_abc"           => $status,
        "coupon_md_by"     => $this->input->post("restrant_id"),
        "coupon_md_on"   => date('Y-m-d H:i:s')
    );
    $this->db->where('coupon_id',$uri)->update("coupon",$dat);
    $vsp   =    $this->db->affected_rows();
    if($vsp > 0){
        return true;
    }
    return FALSE;
}
public function delete_coupon($uro){
    $dta    =   array(
        "coupon_open"            =>  0, 
        "coupon_md_by"     => $this->input->post("restrant_id"),
        "coupon_md_on"   => date('Y-m-d H:i:s')
    );
    $this->db->update("coupon",$dta,array("coupon_id" => $uro));
    $vsp   =    $this->db->affected_rows();
    if($vsp > 0){
        return true;
    }
    return FALSE;
}
public function update_coupon($id){
    $data  = array(
        'coupon_type'                     =>  $this->input->post('coupon_type'), 
        'coupon_min_value'                =>  $this->input->post('min_coupon'),          
        'coupon_discount'                 =>  $this->input->post('discount'),   
        'coupon_max_discount'             =>  $this->input->post('max_discount'),            
        'coupon_per_person'               =>  $this->input->post('per_person'),             
        'coupon_nth_value'                =>  $this->input->post('nth_value'),           
        'coupon_coupon'                   =>  $this->input->post('coupon'), 
        'coupon_applicable'               =>  $this->input->post('for_type'),     
        'coupon_cust_type'                =>  $this->input->post('typeofcust'),       
        'coupon_date_from'                =>  $this->input->post('from_date'),          
        'coupon_date_to'                  =>  $this->input->post('to_date'),               
        'coupon_md_on'                    =>  date("Y-m-d h:i:s"),    
    );
    $this->db->where('coupon_id',$id)->update('coupon',$data);
    $vsp   =    $this->db->affected_rows();
    if($vsp > 0){
        $dtaaaa    =   array(
            "coupon_items_open"    =>  0, 
            "coupon_items_md_by"   => $this->session->userdata("login_id"),
            "coupon_items_md_on"   => date('Y-m-d H:i:s')
        );
        $this->db->update("coupon_items",$dtaaaa,array("coupon_items_coupon_id" => $id));
        if($this->input->post('for_type')=='Product wise'){
            foreach($this->input->post('Prod') as $prodid)
            { 
                $par['whereCondition'] = "vp.vendorproduct_id = '".$prodid."'";
                $par['columns']	="vendorproduct_category";
                $category           =   $this->vendor_model->getVendorproduct($par);
                $paa['whereCondition']  =   "coupon_items_coupon_id = '".$id."'AND coupon_items_category_id ='".$category['vendorproduct_category']."'  AND coupon_items_item_id = '".$prodid."'";
                $vsss   = $this->coupon_model->getCouponItems($paa);
                if($vsss){
                    $dtaaa    =   array(
                        "coupon_items_open"    =>  1, 
                        "coupon_items_md_by"   => $this->session->userdata("login_id"),
                        "coupon_items_md_on"   => date('Y-m-d H:i:s')
                    );
                    $this->db->update("coupon_items",$dtaaa,array("coupon_items_id" => $vsss[0]['coupon_items_id']));
                }else{
                    $data = array(
                        'coupon_items_coupon_id'        =>  $id,
                        'coupon_items_category_id'        =>  $category['vendorproduct_category'],         
                        'coupon_items_item_id'            =>  $prodid,    
                        'coupon_items_cr_on'              =>  date("Y-m-d h:i:s"),    
                        'coupon_items_cr_by'              =>  $this->session->userdata("login_id"), 
                    );
                    $this->db->insert("coupon_items",$data);
                    $vs   =    $this->db->insert_id();
                    if($vs > 0){
                        $dat=array(
                            "coupon_items_id" 			=> $vs."DISI"
                        );
                        $this->db->update("coupon_items",$dat,"coupon_itemsid='".$vs."'");
                    
                    } 
                }
                
            }
        }
        if($this->input->post('for_type')=='Category wise'){
            foreach($this->input->post('cat') as $catid)
            { 
                $par['whereCondition'] = "vp.vendorproduct_category = '".$catid."'";
                $par['columns']	="distinct(product_name),vendorproduct_id ";
                $product           =   $this->vendor_model->viewVendorproducts($par);
                foreach($product as $p){
                    $paa['whereCondition']  =   "coupon_items_coupon_id = '".$id."'AND coupon_items_category_id ='".$catid."'  AND coupon_items_item_id = '".$p->vendorproduct_id."'";
                    $vsss   = $this->coupon_model->getCouponItems($paa);
                    if($vsss){
                        $dtaaa    =   array(
                            "coupon_items_open"    =>  1, 
                            "coupon_items_md_by"   => $this->session->userdata("login_id"),
                            "coupon_items_md_on"   => date('Y-m-d H:i:s')
                        );
                        $this->db->update("coupon_items",$dtaaa,array("coupon_items_id" => $vsss[0]['coupon_items_id']));
                    }else{
                        $data = array(
                            'coupon_items_coupon_id'        =>  $id,
                            'coupon_items_category_id'        =>  $catid,         
                            'coupon_items_item_id'            =>  $p->vendorproduct_id,    
                            'coupon_items_cr_on'              =>  date("Y-m-d h:i:s"),    
                            'coupon_items_cr_by'              =>  $this->session->userdata("login_id"), 
                        );
                        $this->db->insert("coupon_items",$data);
                        $vs  =    $this->db->insert_id();
                        if($vs > 0){
                            $dat=array(
                                "coupon_items_id" 			=> $vs."DISI"
                            );
                            $this->db->update("coupon_items",$dat,"coupon_itemsid='".$vs."'");
                        
                        } 
                    }
                }
                
            }
        }
    }
    return TRUE;
} 
public function viewCouponItems($params = array()){
    return $this->queryCouponItems($params)->result();
}
public function getCouponItems($params = array()){
    return $this->queryCouponItems($params)->result_array();
}
public function queryCouponItems($params = array()){
    $dt =   array(
    );
    $sel        =   "*";
    if(array_key_exists("cnt",$params)){
        $sel    =   "count(*) as cnt";
    }
    if(array_key_exists("columns",$params)){
        $sel    =    $params["columns"];
    }
    $this->db->select($sel)
                ->from("coupon_items as di")
                ->where($dt);
    if(array_key_exists("keywords",$params)){
            $this->db->where("(CouponItems_type LIKE '%".$params["keywords"]."%')");
    }
    if(array_key_exists("whereCondition",$params)){
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
  //$this->db->get();echo $this->db->last_query();exit;
    return  $this->db->get();
}

public function cntviewCouponItems($params = array()){
    $params["cnt"]      =   "1";
    $val    =   $this->queryCouponItems($params)->row_array();
    if(is_array($val) && count($val) > 0){
        return  $val['cnt'];
    }
    return "0";
}
public function delete_coupon_items($uro){
    $dta    =   array(
        "coupon_items_open"            =>  0, 
        "coupon_items_md_by"     => $this->session->userdata("restraint_id"),
        "coupon_items_md_on"   => date('Y-m-d H:i:s')
    );
    $this->db->update("coupon_items",$dta,array("coupon_items_id" => $uro));
    $vsp   =    $this->db->affected_rows();
    if($vsp > 0){
        return true;
    }
    return FALSE;
}
public function add_coupon_item($id){
    foreach($this->input->post('items') as $itemid)
    {
        $restid = $this->session->userdata("restraint_id");
	    $par['whereCondition'] = "resturant_id = '".$restid."' AND resturant_items_id = '".$itemid."'";
        $category		=  $this->menu_model->getItems($par);
        $cat    =    $category[0]['resturant_category_id'];
        $pars['whereCondition'] = "di.resturant_id = '".$restid."' AND coupon_items_item_id = '".$itemid."'  AND coupon_items_category_id = '".$cat."' AND coupon_items_coupon_id = '".$id."'";
        $vsp		=  $this->coupon_model->getCouponItems($pars);
        if($vsp){
            $dta    =   array(
                "coupon_items_open"            =>  1, 
                "coupon_items_md_by"     => $this->session->userdata("restraint_id"),
                "coupon_items_md_on"   => date('Y-m-d H:i:s')
            );//echo '<pre>';print_r($dta);echo $vsp[0]['coupon_items_id'];exit;
            $this->db->update("coupon_items",$dta,array("coupon_items_id" => $vsp[0]['coupon_items_id'])); 
        }else{
            $data = array(
                'coupon_items_coupon_id'        =>  $id,
                'coupon_items_category_id'        =>  $cat,         
                'coupon_items_item_id'            =>  $itemid,  
                'resturant_id'                      =>  $this->session->userdata("restraint_id"),   
                'coupon_items_cr_on'              =>  date("Y-m-d h:i:s"),    
                'coupon_items_cr_by'              =>  $this->session->userdata("restraint_id"), 
            );
            $this->db->insert("coupon_items",$data);
            $vsp   =    $this->db->insert_id();
            if($vsp > 0){
                $dat=array(
                    "coupon_items_id" 			=> $vsp."DISI"
                );	
                $this->db->update("coupon_items",$dat,"coupon_itemsid='".$vsp."'");
            
            } 
        }
        
    }return true;
}
public function add_coupon_category($id){
    $str	= $this->input->post('category');
	$restid = $this->session->userdata("restraint_id");
	$par['whereCondition'] = "resturant_id = '".$restid."' AND resturant_category_id = '".$str."'";
	$items = $this->menu_model->viewItems($par);
    if(count($items)>0){
        foreach($items as $itemid)
        { 
            $restid = $this->session->userdata("restraint_id");
            $par['whereCondition'] = "resturant_id = '".$restid."' AND resturant_items_id = '".$itemid->resturant_items_id."'";
            $category		=  $this->menu_model->getItems($par);
            $cat    =    $category[0]['resturant_category_id'];
            $pars['whereCondition'] = "di.resturant_id = '".$restid."' AND coupon_items_item_id = '".$itemid->resturant_items_id."'  AND coupon_items_category_id = '".$cat."'";
            $vsp		=  $this->coupon_model->getCouponItems($pars);
            if($vsp){
                $dta    =   array(
                    "coupon_items_open"            =>  1, 
                    "coupon_items_md_by"     => $this->input->post("restrant_id"),
                    "coupon_items_md_on"   => date('Y-m-d H:i:s')
                );
                $this->db->update("coupon_items",$dta,array("coupon_items_id" => $vsp[0]['coupon_items_id'])); 
            }else{
                $data = array(
                    'coupon_items_coupon_id'        =>  $id,
                    'coupon_items_category_id'        =>  $cat,         
                    'coupon_items_item_id'            =>  $itemid->resturant_items_id,  
                    'resturant_id'                      =>  $this->session->userdata("restraint_id"),   
                    'coupon_items_cr_on'              =>  date("Y-m-d h:i:s"),    
                    'coupon_items_cr_by'              =>  $this->session->userdata("restraint_id"), 
                );
                //echo '<pre>';print_r($data);exit;
                $this->db->insert("coupon_items",$data);
                $vsp   =    $this->db->insert_id();
                if($vsp > 0){
                    $dat=array(
                        "coupon_items_id" 			=> $vsp."DISI"
                    );	
                    $this->db->update("coupon_items",$dat,"coupon_itemsid='".$vsp."'");
                
                } 
            }
            
        }return true;
    }
    return false;
}

/*-------------------old
public function unique_id_coupon($str){
    $pms["whereCondition"]  =   "coupon_coupon = '".$str."'";
    $vsp    =   $this->getCoupon($pms);
    if(is_array($vsp) && count($vsp) > 0){
        return true;
    }
    return false;
}
public function Coupon_check($coupon,$mobile,$total){
    //$coupon = $this->input->post('coupon_code');
     $pmrs["whereCondition"]  =   "coupon_coupon LIKE  '".$coupon."' AND coupon_abc = 'Active'";
     $vsps	=	$this->coupon_model->getCoupon($pmrs);
     //$mobile     =   $this->session->userdata("customer_mobile");
     if(count($vsps) > 0){
         if($vsps[0]['coupon_date_from']<=date("Y-m-d") && $vsps[0]['coupon_date_to']>=date("Y-m-d")){
             if($vsps[0]['coupon_applicable']=='All'){
                 $cproduct = 'all';
             }else{
                 $pp['whereCondition']     =   "coupon_items_coupon_id = '".$vsps[0]['coupon_id']."'  AND coupon_items_open = '1'";
                 $items	=	$this->coupon_model->viewCouponItems($pp);
                 $cproduct = array();
                 foreach($items as $i){
                     array_push($cproduct,$i->coupon_items_item_id);
                 }
             }

             if($vsps[0]['coupon_cust_type']=='First Time Customer'){
                 $coupon_order_no = 1;
             }else if($vsps[0]['coupon_cust_type']=='nth Time Customer'){
                 $coupon_order_no = $vsps[0]['coupon_nth_value'];
             }else{
                 $coupon_order_no ='';
             }

             $par['columns']  = "customer_id";
             $par['whereCondition']  = "vd.customer_mobile LIKE '".$mobile ."'  OR customer_token LIKE '".$mobile."'";           
             $vue = $this->customer_model->getCustomer($par);                       
             $custid = $vue['customer_id'];
             $or['whereCondition']= " order_customer_id = '".$custid."' AND order_acde <> 'Order Cancelled'";
             $ord = $this->order_model->cntvieworders($or);
             if($vsps[0]['coupon_cust_type']=='All' || $coupon_order_no==($ord+1) ){
                 if($total > $vsps[0]['coupon_min_value']){
                     $coupon_data = array(
                                 "coupon"                => $coupon,
                                 "coupon_applicable"     => $vsps[0]['coupon_applicable'],
                                 "products_applicable"   => ($cproduct)??'',
                                 "coupon_type"           => $vsps[0]['coupon_type'],
                                 "coupon_max_discount"   => $vsps[0]['coupon_max_discount'],
                                 "coupon_discount"       => $vsps[0]['coupon_discount'],

                             );
                             
                     $this->session->set_userdata("coupon_code",$coupon_data);
                     $this->session->unset_userdata("coupon_error");
                     //print_r($this->session->userdata("coupon_code"));
                     $json = $this->vendor_model->jsonencodevalues("4",$coupon_data,'0'); 
                         
                 }else{  
                     $this->session->unset_userdata("coupon_code");
                     $this->session->set_userdata("coupon_error",'cart value should be greater then '.$vsps[0]['coupon_min_value']);
                     $json = $this->vendor_model->jsonencodevalues("3",'cart value should be greater then '.$vsps[0]['coupon_min_value'],'0'); 
                 }
                 
             }else{
                 $ordd = $coupon_order_no-$ord;
                 if($coupon_order_no==1){ $coupon_order_no = '1st';}
                 if($coupon_order_no==2){ $coupon_order_no = '2nd'; }
                 if($coupon_order_no==3){ $coupon_order_no = '3rd'; }
                 if($coupon_order_no>3){ $coupon_order_no = $coupon_order_no.'th'; }
                 if($ordd < 2){ $ordd ='' ;}
                 else{ $ordd=$ordd-1; $ordd ='Place '.$ordd.' more orders to applicable to coupon'; }
                 $this->session->unset_userdata("coupon_code");
                 $this->session->set_userdata("coupon_error",'coupon is valid only for '.$coupon_order_no.' Order. '.$ordd);
                 $json = $this->vendor_model->jsonencodevalues("2",'coupon is valid only for '.$coupon_order_no.' Order. '.$ordd,'0'); 
             }
         }else{
             $this->session->unset_userdata("coupon_code");
             $this->session->set_userdata("coupon_error","coupon is expaired or not valid for today");
             $json = $this->vendor_model->jsonencodevalues("1","coupon is expaired or not valid for today",'0'); 
         }
     }else{
         $this->session->unset_userdata("coupon_code");
         $this->session->set_userdata("coupon_error","coupon is not valid");
         $json = $this->vendor_model->jsonencodevalues("0","coupon is not valid",'0'); 
     }
 return json_encode($json);
}-----*/

public function unique_id_coupon($str){
    $pms["whereCondition"]  =   "coupon_coupon = '".$str."'";
    $vsp    =   $this->getCoupon($pms);
    if(is_array($vsp) && count($vsp) > 0){
        return true;
    }else {
        $pmss["whereCondition"]  =   "customer_coupon = '".$str."'";
        $vsps    =   $this->customer_model->getCustomer($pmss);
        if(is_array($vsps) && count($vsps) > 0){
            return true;
        }
    }
    
    return false;
}
public function Coupon_check($coupon,$mobile,$total){
    //$coupon = $this->input->post('coupon_code');
    $par['columns']  = "customer_id";
    $par['whereCondition']  = "vd.customer_mobile LIKE '".$mobile ."'  OR customer_token LIKE '".$mobile."'";           
    $vue = $this->customer_model->getCustomer($par);                       
    $custid = $vue['customer_id'];
    $or['whereCondition']= " order_customer_id = '".$custid."' AND order_acde <> 'Order Cancelled'";
    $ord = $this->order_model->cntvieworders($or);
    if($ord == 0 && $coupon!=''){
        $params["whereCondition"] = "customer_coupon = '".$coupon."'";
        $vsp        =   $this->customer_model->queryCustomer($params)->row_array();
        if(isset($vsp)){
                $pmrs["whereCondition"]  =   "refer_refer LIKE  'refer' AND refer_abc = 'Active'";
                $vsps	=	$this->refer_model->getRefer($pmrs);
                //$mobile     =   $this->session->userdata("customer_mobile"); 
                // print_r($vsps);exit;
                if(count($vsps) > 0){
                    if($vsps[0]['refer_applicable']=='All'){
                        $cproduct = array();
                    }else{
                        $pp['whereCondition']     =   "refer_items_refer_id = '".$vsps[0]['refer_id']."'  AND refer_items_open = '1'";
                        $items	=	$this->refer_model->viewReferItems($pp);
                        $cproduct = array();
                        foreach($items as $i){
                            array_push($cproduct,$i->refer_items_item_id);
                        }
                    }
                        if($total > $vsps[0]['refer_min_value']){
                            $refer_data = array(
                                        "coupon"                => $coupon,
                                        "coupon_applicable"     => $vsps[0]['refer_applicable'],
                                        "products_applicable"   => ($cproduct)??'',
                                        "coupon_type"           => $vsps[0]['refer_type'],
                                        "coupon_max_discount"   => $vsps[0]['refer_max_discount'],
                                        "coupon_discount"       => $vsps[0]['refer_discount'],

                                    );
                                    
                            $this->session->set_userdata("coupon_code",$refer_data);
                            $this->session->unset_userdata("coupon_error");
                            //print_r($this->session->userdata("coupon_code"));
                            $json = $this->vendor_model->jsonencodevalues("4",$refer_data,'0'); 
                                
                        }else{  
                            $this->session->unset_userdata("coupon_code");
                            $this->session->set_userdata("coupon_error",'cart value should be greater then '.$vsps[0]['refer_min_value']);
                            $json = $this->vendor_model->jsonencodevalues("3",'cart value should be greater then '.$vsps[0]['refer_min_value'],'0'); 
                        }
                    
                }
            return json_encode($json);
        }

    }

     $pmrs["whereCondition"]  =   "coupon_coupon LIKE  '".$coupon."' AND coupon_abc = 'Active'";
     $vsps	=	$this->coupon_model->getCoupon($pmrs);
     //$mobile     =   $this->session->userdata("customer_mobile");
     if(count($vsps) > 0){
         if($vsps[0]['coupon_date_from']<=date("Y-m-d") && $vsps[0]['coupon_date_to']>=date("Y-m-d")){
             if($vsps[0]['coupon_applicable']=='All'){
                 $cproduct = array();
             }else{
                 $pp['whereCondition']     =   "coupon_items_coupon_id = '".$vsps[0]['coupon_id']."'  AND coupon_items_open = '1'";
                 $items	=	$this->coupon_model->viewCouponItems($pp);
                 $cproduct = array();
                 foreach($items as $i){
                     array_push($cproduct,$i->coupon_items_item_id);
                 }
             }

             if($vsps[0]['coupon_cust_type']=='First Time Customer'){
                 $coupon_order_no = 1;
             }else if($vsps[0]['coupon_cust_type']=='nth Time Customer'){
                 $coupon_order_no = $vsps[0]['coupon_nth_value'];
             }else{
                 $coupon_order_no ='';
             }
             if($vsps[0]['coupon_cust_type']=='All' || $coupon_order_no==($ord+1) ){
                 if($total > $vsps[0]['coupon_min_value']){
                     $coupon_data = array(
                                 "coupon"                => $coupon,
                                 "coupon_applicable"     => $vsps[0]['coupon_applicable'],
                                 "products_applicable"   => ($cproduct)??'',
                                 "coupon_type"           => $vsps[0]['coupon_type'],
                                 "coupon_max_discount"   => $vsps[0]['coupon_max_discount'],
                                 "coupon_discount"       => $vsps[0]['coupon_discount'],

                             );
                             
                     $this->session->set_userdata("coupon_code",$coupon_data);
                     $this->session->unset_userdata("coupon_error");
                     //print_r($this->session->userdata("coupon_code"));
                     $json = $this->vendor_model->jsonencodevalues("4",$coupon_data,'0'); 
                         
                 }else{  
                     $this->session->unset_userdata("coupon_code");
                     $this->session->set_userdata("coupon_error",'cart value should be greater then '.$vsps[0]['coupon_min_value']);
                     $json = $this->vendor_model->jsonencodevalues("3",'cart value should be greater then '.$vsps[0]['coupon_min_value'],'0'); 
                 }
                 
             }else{
                 $ordd = $coupon_order_no-$ord;
                 if($coupon_order_no==1){ $coupon_order_no = '1st';}
                 if($coupon_order_no==2){ $coupon_order_no = '2nd'; }
                 if($coupon_order_no==3){ $coupon_order_no = '3rd'; }
                 if($coupon_order_no>3){ $coupon_order_no = $coupon_order_no.'th'; }
                 if($ordd < 2){ $ordd ='' ;}
                 else{ $ordd=$ordd-1; $ordd ='Place '.$ordd.' more orders to applicable to coupon'; }
                 $this->session->unset_userdata("coupon_code");
                 $this->session->set_userdata("coupon_error",'coupon is valid only for '.$coupon_order_no.' Order. '.$ordd);
                 $json = $this->vendor_model->jsonencodevalues("2",'coupon is valid only for '.$coupon_order_no.' Order. '.$ordd,'0'); 
             }
         }else{
             $this->session->unset_userdata("coupon_code");
             $this->session->set_userdata("coupon_error","coupon is expaired or not valid for today");
             $json = $this->vendor_model->jsonencodevalues("1","coupon is expaired or not valid for today",'0'); 
         }
     }else{
         $this->session->unset_userdata("coupon_code");
         $this->session->set_userdata("coupon_error","coupon is not valid");
         $json = $this->vendor_model->jsonencodevalues("0","coupon is not valid",'0'); 
     }
 return json_encode($json);
}
	
	

}
?>