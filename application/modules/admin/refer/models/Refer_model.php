<?php
class Refer_model extends CI_Model{
public function create(){
    $data = array(
        'refer_type'                     =>  $this->input->post('refer_type'), 
        'refer_min_value'                =>  $this->input->post('min_refer'),          
        'refer_discount'                 =>  $this->input->post('discount'),        
        'refer_max_discount'             =>  $this->input->post('max_discount'),          
        'refer_refer'                   =>  $this->input->post('refer'),        
        'refer_per_person'               =>  $this->input->post('per_person'),             
        'refer_nth_value'                =>  $this->input->post('nth_value'), 
        'refer_applicable'               =>  $this->input->post('for_type'),     
        'refer_cust_type'                =>  $this->input->post('typeofcust'),       
        'refer_date_from'                =>  $this->input->post('from_date'),          
        'refer_date_to'                  =>  $this->input->post('to_date'),      
        'refer_cr_on'                    =>  date("Y-m-d h:i:s"),    
        'resturant_id'                      =>  $this->session->userdata("login_id"),
        'refer_cr_by'                    =>  $this->session->userdata("login_id"),     
        'refer_approve'                   =>  'Pending',
    );
	//echo '<pre>';print_r($data);exit;
    $this->db->insert("refer",$data);
    $vsp   =    $this->db->insert_id();
    if($vsp > 0){
        $dat=array(
			"refer_id" 			=> $vsp."DIS"
		);
		$id=$vsp;	
        $this->db->update("refer",$dat,"referid='".$vsp."'");
        if($this->input->post('for_type')=='Product wise'){
            foreach($this->input->post('Prod') as $prodid)
            { 
                $par['whereCondition'] = "vp.vendorproduct_id = '".$prodid."'";
                $par['columns']	="vendorproduct_category";
                $category           =   $this->vendor_model->getVendorproduct($par);
                $data = array(
                    'refer_items_refer_id'        =>  $vsp."DIS",
                    'refer_items_category_id'        =>  $category['vendorproduct_category'],         
                    'refer_items_item_id'            =>  $prodid,    
                    'refer_items_cr_on'              =>  date("Y-m-d h:i:s"),    
                    'refer_items_cr_by'              =>  $this->session->userdata("login_id"), 
                );
                $this->db->insert("refer_items",$data);
                $vs   =    $this->db->insert_id();
                if($vs > 0){
                    $dat=array(
                        "refer_items_id" 			=> $vs."DISI"
                    );
                    $this->db->update("refer_items",$dat,"refer_itemsid='".$vs."'");
                
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
                        'refer_items_refer_id'        =>  $vsp."DIS",
                        'refer_items_category_id'        =>  $catid,         
                        'refer_items_item_id'            =>  $p->vendorproduct_id,    
                        'refer_items_cr_on'              =>  date("Y-m-d h:i:s"),    
                        'refer_items_cr_by'              =>  $this->session->userdata("login_id"), 
                    );
                    $this->db->insert("refer_items",$data);
                    $vs  =    $this->db->insert_id();
                    if($vs > 0){
                        $dat=array(
                            "refer_items_id" 			=> $vs."DISI"
                        );
                        $this->db->update("refer_items",$dat,"refer_itemsid='".$vs."'");
                    
                    } 
                }
                
            }
        }
		return TRUE;
       
    } return false;
}
public function viewRefer($params = array()){
    return $this->queryRefer($params)->result();
}
public function getRefer($params = array()){
    return $this->queryRefer($params)->result_array();
}
public function queryRefer($params = array()){
    $dt =   array(
        "refer_open"  	=> '1'
    );
    $sel        =   "*";
    if(array_key_exists("cnt",$params)){
        $sel    =   "count(*) as cnt";
    }
    if(array_key_exists("columns",$params)){
        $sel    =    $params["columns"];
    }
    $this->db->select($sel)
                ->from("refer")
                ->where($dt);
    if(array_key_exists("keywords",$params)){
            $this->db->where("(Refer_type LIKE '%".$params["keywords"]."%')");
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

public function cntviewRefer($params = array()){
    $params["cnt"]      =   "1";
    $val    =   $this->queryRefer($params)->row_array();
    if(is_array($val) && count($val) > 0){
        return  $val['cnt'];
    }
    return "0";
}
public function activedeactive($uri,$status){
    $dat=array(
        "refer_abc"           => $status,
        "refer_md_by"     => $this->input->post("restrant_id"),
        "refer_md_on"   => date('Y-m-d H:i:s')
    );
    $this->db->where('refer_id',$uri)->update("refer",$dat);
    $vsp   =    $this->db->affected_rows();
    if($vsp > 0){
        return true;
    }
    return FALSE;
}
public function delete_refer($uro){
    $dta    =   array(
        "refer_open"            =>  0, 
        "refer_md_by"     => $this->input->post("restrant_id"),
        "refer_md_on"   => date('Y-m-d H:i:s')
    );
    $this->db->update("refer",$dta,array("refer_id" => $uro));
    $vsp   =    $this->db->affected_rows();
    if($vsp > 0){
        return true;
    }
    return FALSE;
}
public function update_refer($id){
    // print_r($this->input->post());exit;
    $data  = array(
        'refer_type'                     =>  $this->input->post('refer_type'), 
        'refer_min_value'                =>  $this->input->post('min_refer'),          
        'refer_discount'                 =>  $this->input->post('discount'),          
        'refer_validity'                 =>  $this->input->post('days'),   
        // 'refer_max_discount'             =>  $this->input->post('max_discount'),            
        // 'refer_per_person'               =>  $this->input->post('per_person'),             
        // 'refer_nth_value'                =>  $this->input->post('nth_value'), 
        'refer_applicable'               =>  $this->input->post('for_type'),         
        // 'refer_date_from'                =>  $this->input->post('from_date'),          
        // 'refer_date_to'                  =>  $this->input->post('to_date'),               
        'refer_md_on'                    =>  date("Y-m-d h:i:s"),    
    );
    $this->db->where('refer_id',$id)->update('refer',$data);
    $vsp   =    $this->db->affected_rows();
    if($vsp > 0){
        $dtaaaa    =   array(
            "refer_items_open"    =>  0, 
            "refer_items_md_by"   => $this->session->userdata("login_id"),
            "refer_items_md_on"   => date('Y-m-d H:i:s')
        );
        $this->db->update("refer_items",$dtaaaa,array("refer_items_refer_id" => $id));
        if($this->input->post('for_type')=='Product wise'){
            foreach($this->input->post('Prod') as $prodid)
            { 
                $par['whereCondition'] = "vp.vendorproduct_id = '".$prodid."'";
                $par['columns']	="vendorproduct_category";
                $category           =   $this->vendor_model->getVendorproduct($par);
                $paa['whereCondition']  =   "refer_items_refer_id = '".$id."'AND refer_items_category_id ='".$category['vendorproduct_category']."'  AND refer_items_item_id = '".$prodid."'";
                $vsss   = $this->refer_model->getReferItems($paa);
                if($vsss){
                    $dtaaa    =   array(
                        "refer_items_open"    =>  1, 
                        "refer_items_md_by"   => $this->session->userdata("login_id"),
                        "refer_items_md_on"   => date('Y-m-d H:i:s')
                    );
                    $this->db->update("refer_items",$dtaaa,array("refer_items_id" => $vsss[0]['refer_items_id']));
                }else{
                    $data = array(
                        'refer_items_refer_id'        =>  $id,
                        'refer_items_category_id'        =>  $category['vendorproduct_category'],         
                        'refer_items_item_id'            =>  $prodid,    
                        'refer_items_cr_on'              =>  date("Y-m-d h:i:s"),    
                        'refer_items_cr_by'              =>  $this->session->userdata("login_id"), 
                    );
                    $this->db->insert("refer_items",$data);
                    $vs   =    $this->db->insert_id();
                    if($vs > 0){
                        $dat=array(
                            "refer_items_id" 			=> $vs."DISI"
                        );
                        $this->db->update("refer_items",$dat,"refer_itemsid='".$vs."'");
                    
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
                    $paa['whereCondition']  =   "refer_items_refer_id = '".$id."'AND refer_items_category_id ='".$catid."'  AND refer_items_item_id = '".$p->vendorproduct_id."'";
                    $vsss   = $this->refer_model->getReferItems($paa);
                    if($vsss){
                        $dtaaa    =   array(
                            "refer_items_open"    =>  1, 
                            "refer_items_md_by"   => $this->session->userdata("login_id"),
                            "refer_items_md_on"   => date('Y-m-d H:i:s')
                        );
                        $this->db->update("refer_items",$dtaaa,array("refer_items_id" => $vsss[0]['refer_items_id']));
                    }else{
                        $data = array(
                            'refer_items_refer_id'        =>  $id,
                            'refer_items_category_id'        =>  $catid,         
                            'refer_items_item_id'            =>  $p->vendorproduct_id,    
                            'refer_items_cr_on'              =>  date("Y-m-d h:i:s"),    
                            'refer_items_cr_by'              =>  $this->session->userdata("login_id"), 
                        );
                        $this->db->insert("refer_items",$data);
                        $vs  =    $this->db->insert_id();
                        if($vs > 0){
                            $dat=array(
                                "refer_items_id" 			=> $vs."DISI"
                            );
                            $this->db->update("refer_items",$dat,"refer_itemsid='".$vs."'");
                        
                        } 
                    }
                }
                
            }
        }
    }
    return TRUE;
} 
public function viewReferItems($params = array()){
    return $this->queryReferItems($params)->result();
}
public function getReferItems($params = array()){
    return $this->queryReferItems($params)->result_array();
}
public function queryReferItems($params = array()){
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
                ->from("refer_items as di")
                ->where($dt);
    if(array_key_exists("keywords",$params)){
            $this->db->where("(ReferItems_type LIKE '%".$params["keywords"]."%')");
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

public function cntviewReferItems($params = array()){
    $params["cnt"]      =   "1";
    $val    =   $this->queryReferItems($params)->row_array();
    if(is_array($val) && count($val) > 0){
        return  $val['cnt'];
    }
    return "0";
}
public function delete_refer_items($uro){
    $dta    =   array(
        "refer_items_open"            =>  0, 
        "refer_items_md_by"     => $this->session->userdata("restraint_id"),
        "refer_items_md_on"   => date('Y-m-d H:i:s')
    );
    $this->db->update("refer_items",$dta,array("refer_items_id" => $uro));
    $vsp   =    $this->db->affected_rows();
    if($vsp > 0){
        return true;
    }
    return FALSE;
}
public function add_refer_item($id){
    foreach($this->input->post('items') as $itemid)
    {
        $restid = $this->session->userdata("restraint_id");
	    $par['whereCondition'] = "resturant_id = '".$restid."' AND resturant_items_id = '".$itemid."'";
        $category		=  $this->menu_model->getItems($par);
        $cat    =    $category[0]['resturant_category_id'];
        $pars['whereCondition'] = "di.resturant_id = '".$restid."' AND refer_items_item_id = '".$itemid."'  AND refer_items_category_id = '".$cat."' AND refer_items_refer_id = '".$id."'";
        $vsp		=  $this->refer_model->getReferItems($pars);
        if($vsp){
            $dta    =   array(
                "refer_items_open"            =>  1, 
                "refer_items_md_by"     => $this->session->userdata("restraint_id"),
                "refer_items_md_on"   => date('Y-m-d H:i:s')
            );//echo '<pre>';print_r($dta);echo $vsp[0]['refer_items_id'];exit;
            $this->db->update("refer_items",$dta,array("refer_items_id" => $vsp[0]['refer_items_id'])); 
        }else{
            $data = array(
                'refer_items_refer_id'        =>  $id,
                'refer_items_category_id'        =>  $cat,         
                'refer_items_item_id'            =>  $itemid,  
                'resturant_id'                      =>  $this->session->userdata("restraint_id"),   
                'refer_items_cr_on'              =>  date("Y-m-d h:i:s"),    
                'refer_items_cr_by'              =>  $this->session->userdata("restraint_id"), 
            );
            $this->db->insert("refer_items",$data);
            $vsp   =    $this->db->insert_id();
            if($vsp > 0){
                $dat=array(
                    "refer_items_id" 			=> $vsp."DISI"
                );	
                $this->db->update("refer_items",$dat,"refer_itemsid='".$vsp."'");
            
            } 
        }
        
    }return true;
}
public function add_refer_category($id){
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
            $pars['whereCondition'] = "di.resturant_id = '".$restid."' AND refer_items_item_id = '".$itemid->resturant_items_id."'  AND refer_items_category_id = '".$cat."'";
            $vsp		=  $this->refer_model->getReferItems($pars);
            if($vsp){
                $dta    =   array(
                    "refer_items_open"            =>  1, 
                    "refer_items_md_by"     => $this->input->post("restrant_id"),
                    "refer_items_md_on"   => date('Y-m-d H:i:s')
                );
                $this->db->update("refer_items",$dta,array("refer_items_id" => $vsp[0]['refer_items_id'])); 
            }else{
                $data = array(
                    'refer_items_refer_id'        =>  $id,
                    'refer_items_category_id'        =>  $cat,         
                    'refer_items_item_id'            =>  $itemid->resturant_items_id,  
                    'resturant_id'                      =>  $this->session->userdata("restraint_id"),   
                    'refer_items_cr_on'              =>  date("Y-m-d h:i:s"),    
                    'refer_items_cr_by'              =>  $this->session->userdata("restraint_id"), 
                );
                //echo '<pre>';print_r($data);exit;
                $this->db->insert("refer_items",$data);
                $vsp   =    $this->db->insert_id();
                if($vsp > 0){
                    $dat=array(
                        "refer_items_id" 			=> $vsp."DISI"
                    );	
                    $this->db->update("refer_items",$dat,"refer_itemsid='".$vsp."'");
                
                } 
            }
            
        }return true;
    }
    return false;
}
public function unique_id_refer($str){
    $pms["whereCondition"]  =   "refer_refer = '".$str."'";
    $vsp    =   $this->getRefer($pms);
    if(is_array($vsp) && count($vsp) > 0){
        $pmss["whereCondition"]  =   "customer_refer = '".$str."'";
        $vsps    =   $this->customer_model->getCustomer($pmss);
        if(is_array($vsps) && count($vsps) > 0){
            return true;
        }
    }
    return false;
}
public function Refer_check($refer,$mobile,$total){
    //$refer = $this->input->post('refer_code');
     $pmrs["whereCondition"]  =   "refer_refer LIKE  '".$refer."' AND refer_abc = 'Active'";
     $vsps	=	$this->refer_model->getRefer($pmrs);
     //$mobile     =   $this->session->userdata("customer_mobile");
     if(count($vsps) > 0){
         if($vsps[0]['refer_date_from']<=date("Y-m-d") && $vsps[0]['refer_date_to']>=date("Y-m-d")){
             if($vsps[0]['refer_applicable']=='All'){
                 $cproduct = 'all';
             }else{
                 $pp['whereCondition']     =   "refer_items_refer_id = '".$vsps[0]['refer_id']."'  AND refer_items_open = '1'";
                 $items	=	$this->refer_model->viewReferItems($pp);
                 $cproduct = array();
                 foreach($items as $i){
                     array_push($cproduct,$i->refer_items_item_id);
                 }
             }

             if($vsps[0]['refer_cust_type']=='First Time Customer'){
                 $refer_order_no = 1;
             }else if($vsps[0]['refer_cust_type']=='nth Time Customer'){
                 $refer_order_no = $vsps[0]['refer_nth_value'];
             }else{
                 $refer_order_no ='';
             }

             $par['columns']  = "customer_id";
             $par['whereCondition']  = "vd.customer_mobile LIKE '".$mobile ."'  OR customer_token LIKE '".$mobile."'";           
             $vue = $this->customer_model->getCustomer($par);                       
             $custid = $vue['customer_id'];
             $or['whereCondition']= " order_customer_id = '".$custid."' AND order_acde <> 'Order Cancelled'";
             $ord = $this->order_model->cntvieworders($or);
             if($vsps[0]['refer_cust_type']=='All' || $refer_order_no==($ord+1) ){
                 if($total > $vsps[0]['refer_min_value']){
                     $refer_data = array(
                                 "refer"                => $refer,
                                 "refer_applicable"     => $vsps[0]['refer_applicable'],
                                 "products_applicable"   => ($cproduct)??'',
                                 "refer_type"           => $vsps[0]['refer_type'],
                                 "refer_max_discount"   => $vsps[0]['refer_max_discount'],
                                 "refer_discount"       => $vsps[0]['refer_discount'],

                             );
                             
                     $this->session->set_userdata("refer_code",$refer_data);
                     $this->session->unset_userdata("refer_error");
                     //print_r($this->session->userdata("refer_code"));
                     $json = $this->vendor_model->jsonencodevalues("4",$refer_data,'0'); 
                         
                 }else{  
                     $this->session->unset_userdata("refer_code");
                     $this->session->set_userdata("refer_error",'cart value should be greater then '.$vsps[0]['refer_min_value']);
                     $json = $this->vendor_model->jsonencodevalues("3",'cart value should be greater then '.$vsps[0]['refer_min_value'],'0'); 
                 }
                 
             }else{
                 $ordd = $refer_order_no-$ord;
                 if($refer_order_no==1){ $refer_order_no = '1st';}
                 if($refer_order_no==2){ $refer_order_no = '2nd'; }
                 if($refer_order_no==3){ $refer_order_no = '3rd'; }
                 if($refer_order_no>3){ $refer_order_no = $refer_order_no.'th'; }
                 if($ordd < 2){ $ordd ='' ;}
                 else{ $ordd=$ordd-1; $ordd ='Place '.$ordd.' more orders to applicable to refer'; }
                 $this->session->unset_userdata("refer_code");
                 $this->session->set_userdata("refer_error",'refer is valid only for '.$refer_order_no.' Order. '.$ordd);
                 $json = $this->vendor_model->jsonencodevalues("2",'refer is valid only for '.$refer_order_no.' Order. '.$ordd,'0'); 
             }
         }else{
             $this->session->unset_userdata("refer_code");
             $this->session->set_userdata("refer_error","refer is expaired or not valid for today");
             $json = $this->vendor_model->jsonencodevalues("1","refer is expaired or not valid for today",'0'); 
         }
     }else{
         $this->session->unset_userdata("refer_code");
         $this->session->set_userdata("refer_error","refer is not valid");
         $json = $this->vendor_model->jsonencodevalues("0","refer is not valid",'0'); 
     }
 return json_encode($json);
}
	
	

}
?>