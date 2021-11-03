<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Product_model extends CI_Model{
    public function cleanstr($string){
        $string = str_replace(' ', '-', $string);
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        return preg_replace('/-+/', '-', $string);
    }
    public function query_product($params = array()){
        $dt         =   array(
                            "product_open"      =>     '1',
                            "product_status"    =>     '1'
                    );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("products") 
                    ->where($dt); 
        if(array_key_exists("keywords",$params)){
                $this->db->where("(product_name LIKE '%".$params["keywords"]."%')");
        }
        if(array_key_exists("where_condition",$params)){
                $this->db->where("(".$params["where_condition"].")");
        }   
        if(array_key_exists("order_by",$params) && array_key_exists("tiporderby",$params)){
                $this->db->order_by($params["tiporderby"],$params['order_by']);
        }   
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
        }
        // $this->db->get();echo $this->db->last_query();exit;
        return  $this->db->get();
    } 
    public function cntviewProduct($params  =    array()){
            $params["cnt"]      =   "1"; 
            $val    =   $this->query_product($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
    }
    public function viewProduct($params = array()){
//            $this->query_product($params);echo $this->db->last_query();exit;
            return $this->query_product($params)->result();
    }
    public function get_product($uri){
        $params["where_condition"]   =   "product_name = '".$uri."' OR productid = '".$uri."'";
        return $this->query_product($params)->row_array();
    } 
    public function getProduct($params = array()){
        return $this->query_product($params)->row();
    } 
    public function create_productss(){ 
            $prname =   trim($this->input->post("product_name"));
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
    public function create_product(){ 
            $prname =   trim($this->input->post("vendorproduct_product"));
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
    public function delete_product($uri){ 
            $dta    =   array(
                "product_open"   =>    0,
                "product_modified_on"  =>    date("Y-m-d H:i:s"),
                "product_modified_by"  =>    $this->session->userdata("login_id")
            ); 
            $this->db->update("products",$dta,array("product_id"     =>   $uri));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function deletePrice($uri){ 
            $dta    =   array(
                "vendorproductprince_open"          =>  0,
                "vendorproductprince_modified_on"   =>  date("Y-m-d H:i:s"),
                "vendorproductprince_modified_by"   =>  $this->session->userdata("login_id")
            );
            $this->db->update("vendor_product_princes",$dta,array("vendorproductprinceid" => $uri));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function create_products_price(){
            $dta    =   array(
                "vendorproductids"                  =>  $this->input->post('vendorproductids'),
                "vendorid"                          =>  $this->input->post('vendorid'),
                "vendor_ingredientslist"            =>  ($this->input->post('vendor_ingredientslist'))??'',
                "vendorproduct_bb_quantity"         =>  $this->input->post('vendorproduct_bb_quantity'),
                "vendorproduct_bb_price"            =>  $this->input->post('vendorproduct_bb_price'),
                "vendorproduct_bb_mrp"              =>  ($this->input->post('vendorproduct_bb_mrp'))??'',
                "vendorproduct_bb_measure"          =>  $this->input->post('vendorproduct_bb_measure'),
                "vendorproductprice_created_on"     =>  date("Y-m-d H:i:s"),
                "vendorproductprice_created_by"     =>  $this->session->userdata("login_id")
            );
            //print_r($dta);exit;
            $this->db->insert("vendor_product_princes",$dta);
            $id = $this->db->insert_id();
            if($id > 0){
                $dats = array('vendorproductprinceid' => 'VENPRICE'.$id);
                return $this->db->where('vendorproductprince_id',$id)->update('vendor_product_princes',$dats);
            }
            return FALSE;
    }
    public function update_product_Price($uri){
            $dta    =   array(
                "vendor_ingredientslist"            =>  ($this->input->post('vendor_ingredientslist'))??'',
                "vendorproduct_bb_quantity"         =>  $this->input->post('vendorproduct_bb_quantity'),
                "vendorproduct_bb_price"            =>  $this->input->post('vendorproduct_bb_price'),
                "vendorproduct_bb_mrp"              =>  ($this->input->post('vendorproduct_bb_mrp'))??'',
                "vendorproduct_bb_measure"          =>  $this->input->post('vendorproduct_bb_measure'),
                "vendorproductprince_modified_on"   =>  date("Y-m-d H:i:s"),
                "vendorproductprince_modified_by"   =>  $this->session->userdata("login_id")
            );
            $r = $this->db->where('vendorproductprinceid',$uri)->update('vendor_product_princes',$dta);
            if($r > 0){
                return TRUE;    
            }
            return FALSE;
    }
    public function update_product($uri){
            $prname =   trim($this->input->post("product_name"));
            $dta    =   array( 
                "product_name"   =>     ucwords($prname),
                "product_keywords"    =>     str_replace(" ","_",strtolower($prname)),
                "product_modified_on"  =>    date("Y-m-d H:i:s"),
                "product_modified_by"  =>    $this->session->userdata("login_id")
            );  
            $this->db->update("products",$dta,array("product_id"     =>   $uri));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
    }
    
    public function getvenodrPrice($uri){
        $params["where_condition"]   =   "vendorproductprinceid LIKE '".$uri."'";
        return $this->queryPrice($params)->row_array();
    }
    public function queryPrice($params = array()){
        $dt         =   array(
                            "vendorproductprince_open"   => '1',
                            "vendorproductprice_status"  => '1'
                    );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("vendor_product_princes") 
                    ->where($dt); 
        if(array_key_exists("keywords",$params)){
                $this->db->where("(product_name LIKE '%".$params["keywords"]."%')");
        }
        if(array_key_exists("where_condition",$params)){
                $this->db->where("(".$params["where_condition"].")");
        }   
        if(array_key_exists("order_by",$params) && array_key_exists("tiporderby",$params)){
                $this->db->order_by($params["tiporderby"],$params['order_by']);
        }   
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
        }
        // $this->db->get();echo $this->db->last_query();exit;
        return  $this->db->get();
    } 
    public function update_prince($vendor_mobile){
        $category       = $this->input->post('category');
        $subcategory    = $this->input->post('sub_category');
        $size           = $this->input->post('size');
        $ingredients    = $this->input->post('Ingredients');
        $price_value    = $this->input->post('price_value');
        $price_type     = $this->input->post('price_type');
        $price_amount   = $this->input->post('price_amount');
        $hr='';
        if($category !="" && $subcategory !=""){
            $hr .= "sn.category_id LIKE '".$category."' and sv.subcategory_id LIKE '".$subcategory."'";
        }
        if($category !="" && $subcategory ==""){
            $hr = "sn.category_id LIKE '".$category."'";
        }
        if($category == "" && $subcategory !=""){
            $hr .= "sv.subcategory_id LIKE '".$subcategory."'";
        }
        if($ingredients != ""){
            $hr .= "AND vpp.vendor_ingredientslist LIKE '".$ingredients."'";
        }
        if($size != ""){
            $hr .= "AND vendorproduct_bb_quantity LIKE '".$size."'";
        }
        //print_r($hr);exit;
        $conditions['whereCondition'] = $hr;
        $products = $this->vendor_model->viewVendorproducts($conditions);
        //echo '<pre>';print_r($products);exit;
        if(is_array($products) && count($products) > 0){
            foreach($products as $pr){
                $prs['whereCondition'] ="vendorproductids LIKE '".$pr->vendorproduct_id."'";
                $price = $this->vendor_model->viewVendorproductprices($prs);
                //echo '<pre>';print_r($price);exit;
                foreach($price as $p){
                    if($this->input->post('price_value') =="Increase"){
                        if($this->input->post('price_type')=="Percentage"){
                            $t = ($p->vendorproduct_bb_price * $price_amount)/100;
                            $tot = $p->vendorproduct_bb_price + $t;
                        }else{
                            $tot = $p->vendorproduct_bb_price + $price_amount;
                        }
                    }else{
                        if($this->input->post('price_type')=="Amount"){
                            $t = ($p->vendorproduct_bb_price * $price_amount)/100;
                            $tot = $p->vendorproduct_bb_price - $t;
                        }else{
                            $tot = $p->vendorproduct_bb_price - $price_amount;
                        }
                    }
                    $dat = array(
                        'vendorproduct_bb_price'            => $tot,
                        'vendorproductprince_modified_by'   => $this->session->userdata("login_id"),
                        'vendorproductprince_modified_on'   => date('Y-m-d H:i:s')
                    ); 
                    $this->db->where('vendorproductprinceid',$p->vendorproductprinceid)->update('vendor_product_princes',$dat);
                }
                return true;
            }   
        }
        else{
            return false;
        }
    }
    
    public function reportvlue(){
        $reportvalue ="Products";
        $target_dir= $this->config->item("upload_url")."products/";
        
        $conditions["columns"]  = "vendorproduct_code as ProdID,product_name as ProductName,category_name as Category,subcategory_name as Sub Category,vendorproduct_description as description,vendorproduct_model as model,vendorproduct_brand as Brand,vendorproduct_shipping as shipping,vendorproduct_tax_class as Tax,vendorproduct_bb_quantity as Quantity,prod_indug_key_wrds as Type,vendorproduct_bb_price as Price,vendorproduct_bb_mrp as MRP,measure_unit as Meaure,(CONCAT('$target_dir',vendorproductimg_name)) as Image,vendorproduct_descc as ProductDESC";
        $conditions['tipoOrderby']    =  'vendorproduct_code';
        $conditions['order_by']      =   'ASC';
        $view       =   $this->vendor_model->queryvendorproducts($conditions); 
       //echo '<pre>';print_r($view->result());exit;
        if(is_array($view->result()) && count($view->result()) > 0){
            $va  	=   $view; 
            $fields     =   $va->field_data();
            //echo '<pre>';print_r($va->result());exit;
            $csv_header =   ""; $csv_row = ""; $ary =	array();
            foreach ($fields as $field){
                    $csv_header .= $field->name.","; 
                    $ary[]	=	$field->name; 
            } 
            $csv_header .= "\n";
            foreach($va->result() as $vp){
                foreach($ary as $ayt){
                    $ddd = $this->common_config->RemoveSpecialChar($vp->$ayt);
                    $csv_row .= '"'. (($ddd)?$ddd:" ").'",'; 
                }
                $csv_row .= "\n";
            } 
            //if(count($cview) > 0){   
            //    foreach($ary as $ayt){
            //        $csv_row .= '"'. (isset($cview[$ayt])?$cview[$ayt]:"").'",'; 
            //    } 
            //    $csv_row .= "\n";
            //}  
            /* Download as CSV File */
            header("Content-Type: text/html");
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename='.$reportvalue.date('Y-m-d').time().'.csv');
            $vsg    =   $csv_header . $csv_row;
            echo $vsg;exit; 
        }
    }   
    
    public function checkstudent($values){
        $lssp   =   $this->session->userdata("login_types")?$this->session->userdata("login_types"):'';
        $err_msg    =   "";
        if(count($values)){
            foreach ($values as $frt){  
                $sno    =   $frt['0']; 
                if($frt['7'] != ''){
                    $classes  =   $this->checkclassname(trim($frt['7']));
                    if(!$classes){
                        $err_msg    .=   $sno." - ".$frt['7']." Class Name is not valid<br/>";
                    } 
                }
                if($frt['8'] != ''){
                    $classes  =   $this->checkclasection(trim($frt['8']));
                    if(!$classes){
                        $err_msg    .=   $sno." - ".$frt['7']." Section Name is not valid<br/>";
                    } 
                }
                if($frt['9'] != ''){
                    $classes  =   $this->checkCourse(trim($frt['9']));
                    if(!$classes){
                        $err_msg    .=   $sno." - ".$frt['9']." Course Name is not valid<br/>";
                    } 
                }
                if($frt['18'] != ''){
                    $evmail  =   $this->checkemail(trim($frt['18']));
                    if(!$evmail){
                        $err_msg    .=   $sno." - ".$frt['18']." Email id is not valid<br/>";
                    } 
                } 
                if($frt['4'] != ''){
                    $vsp    =   $this->checkdate(trim($frt['4']));  
                    if($vsp == '0'){
                        $err_msg    .=   $sno." - ".$frt['4']." Date Format is Wrong<br/>";
                    }
                }
                /*if($frt['15'] != '10'){
                    $err_msg    .=   $sno." - ".$frt['15']." Phone must be 10 digits only<br/>";
                }*/
            }
        }  
        return $err_msg;
    }  
    
    public function checkprodname($prod_name){
        $pat['where_condition'] ="product_name LIKE '".$prod_name."' OR product_keywords LIKE '".$prod_name."'";
        $res  = $this->product_model->getProduct($pat);
        //echo '<pre>';print_r($res['product_id']);exit;
        return $res['product_id'];
        
    }
    public function checkcategory($category_name){
        $pat['where_condition'] ="category_name LIKE '".$category_name."' OR category_keywords LIKE '".$category_name."'";
        $res  = $this->category_model->getCategory($pat);
        //echo '<pre>';print_r($res->category_id);exit;
        return $res->category_id;
        
    }
    public function checksubcategory($subcategory_name){
        $pat['where_condition'] ="subcategory_name LIKE '".$subcategory_name."' OR subcategory_keywords LIKE '".$subcategory_name."'";
        $res  = $this->category_model->get_subcategory($pat);
        return $res['subcategory_id'];
    }
    public function checkingredients($subcategory_name){
        $pat['where_condition'] ="prod_indug LIKE '".$subcategory_name."' OR prod_indug_key_wrds LIKE '".$subcategory_name."'";
        $res  = $this->ingredients_model ->getingredients($pat);
        return $res['prodind'];
    }
    public function insert_products($values){
        $schoolid  =   $this->session->userdata("login_types")?$this->session->userdata("login_types"):'';
        if(is_array($values) && count($values) > 0){
           // echo '<pre>';print_r($values);exit;
            foreach($values as $key=>$vd){
                //$category = $this->checkcategory(trim($vd['2']));
                //$prodname = $this->checkprodname(trim($vd['1'])); //Prod Name
                //$subcategory  = $this->checksubcategory(trim($vd['3']));
                $ingredients    = $this->checkingredients(trim($vd['10']));
                $gr ="";
                /*if($prodname != ""){
                    $gr .= "pd.product_id LIKE '".$prodname."'"; 
                }
                if($category!="" && $prodname ==""){
                    $gr .= "sn.category_id LIKE '".$category."'"; 
                }
                if($category!="" && $prodname !=""){
                    $gr .= "AND sn.category_id LIKE '".$category."'"; 
                }
                if($subcategory !=""){
                    $gr .= "AND sv.subcategory_id LIKE '".$subcategory."'"; 
                }
                if($ingredients !=""){
                    $gr .= "AND pi.prodind LIKE '".$ingredients."'"; 
                }*/
                
                $gr .="vendorproduct_code = '".trim($vd['0'])."'";
                $par['condition']       = "1";
                $par['whereCondition'] = $gr;
                $res = $this->vendor_model->getVendorproduct($par);
                //print_r($res);exit;
                if(empty($res) || count($res) <= 0){
                    $prod_name = $vd['1'];
                    $category = $this->checkcategory(trim($vd['2']));
                    //$prodname = $this->checkprodname(trim($vd['1'])); //Prod Name
                    $subcategory  = $this->checksubcategory(trim($vd['3']));
                    $grs='';
                    $grs .="product_name = '".trim($vd['1'])."' AND vendorproduct_category ='".$category."'";
                    $pars['condition']       = "1";
                    $pars['whereCondition'] = $grs;
                    $rs = $this->vendor_model->getVendorproduct($pars);
                    if(is_array($rs) && count($rs) > 0){
                        $vd['0'] = $rs['vendorproduct_id'];
                        $gre ="vendorproduct_id = '".trim($rs['vendorproduct_id'])."'";
                        $pare['condition']       = "1";
                        $pare['whereCondition'] = $gre;
                        $res = $this->vendor_model->getVendorproduct($pare);
                        //print_r($res);exit;
                    }else{
                        $this->create_product_new($vd);
                    }
                    
                    
                }
                if(is_array($res) && count($res) > 0){
                    $hr = "";
                    if(isset($res['vendorproduct_id']) && $res['vendorproduct_id'] !=""){
                        $hr .=  "vendorproductids LIKE '".$res['vendorproduct_id']."'";
                    }
                    if(isset($ingredients) && $ingredients !=""){
                        $hr .=  "AND vendor_ingredientslist LIKE '".$ingredients."'";
                    }
                    if(trim($vd['9']) !=""){
                        $hr .=  "AND vendorproduct_bb_quantity LIKE '".trim($vd['9'])."'";
                    }
                    $pars['whereCondition']  = $hr;
                    $rss = $this->vendor_model->getVendorproductprices($pars);
                    
                    if(is_array($rss) && count($rss) > 0){ 
                        if(trim($vd['16']) === "Yes"){
                            if(is_array($rss) && count($rss) > 0){
                              /*  if(trim($vd['0'])=="VEPR000024"){
                                    echo '<pre>';print_r($rss);exit;
                                }*/
                                $datas = array(
                                    'vendorproduct_description'  => trim($vd['4']),
                                    'vendorproduct_descc'        => trim($vd['15']),
                                    'vendorproduct_modified_on'  => date('Y-m-d H:i:s'),
                                    'vendorproduct_modified_by'  => $this->session->userdata("login_id")
                                );
                                $this->db->where('vendorproduct_code',trim($vd['0']))->update('vendor_products',$datas);
                                
                                //$this->db->where('vendorproduct_code',trim($vd['0']));
                                // = $this->db("vendor_products")->vendorproduct_product();
                                if(trim($vd['1']) != $res['product_name']){
                                    $this->db->where('product_id',$res['vendorproduct_product'])->update('products',array('product_name'=>trim($vd['1']),'product_keywords'=>str_replace(" ","_",strtolower(trim($vd['1']))),'product_modified_on'=>date('Y-m-d H:i:s'),'product_modified_by'=>$this->session->userdata("login_id")));
                                }
                                $pers['where_condition'] = "measure_unit LIKE '".trim($vd['13'])."'";
                                $mes = (array)$this->measure_model->getMeasure($pers);
                                $dats =array(
                                    'vendorproduct_bb_quantity'         => trim($vd['9']),
                                    'vendorproduct_bb_price'            => trim($vd['11']),
                                    'vendorproduct_bb_mrp'              => trim($vd['12']),
                                    'vendor_ingredientslist'            => $ingredients,
                                    'vendorproduct_bb_measure'            => ($mes)?$mes['measure_id']:"",
                                    'vendorproductprince_modified_on'   => date('Y-m-d H:i:s'),
                                    'vendorproductprince_modified_by'   => $this->session->userdata("login_id")
                                );
                                
                                $this->db->where('vendorproductprince_id',$rss['vendorproductprince_id'])->update('vendor_product_princes',$dats);
                            }else{
                                $datas = array(
                                    'vendorproduct_description'  => trim($vd['4']),
                                    'vendorproduct_descc'        => trim($vd['15']),
                                    'vendorproduct_modified_on'  => date('Y-m-d H:i:s'),
                                    'vendorproduct_modified_by'  => $this->session->userdata("login_id")
                                );
                                $this->db->where('vendorproduct_code',trim($vd['0']))->update('vendor_products',$datas);
                                
                                $this->db->where('vendorproduct_code',trim($vd['0']))->update('vendor_products',$datas);
                                $pers['where_condition'] = "measure_unit LIKE '".trim($vd['13'])."'";
                                $mes = (array)$this->measure_model->getMeasure($pers);
                                
                                $dat =array(
                                    'vendorid'                      => '1VBE',
                                    'vendorproductids'              => $res['vendorproduct_id'],
                                    'vendorproduct_bb_price'        => trim($vd['11']),
                                    'vendorproduct_bb_mrp'          => trim($vd['12']),
                                    'vendorproduct_bb_measure'      => ($mes['measure_id'])?$mes['measure_id']:"",
                                    'vendorproductprice_created_by' => $this->session->userdata("login_id"),
                                    'vendorproductprice_created_on' => date('Y-m-d H:i:s')
                                );
                                $this->db->insert('vendor_product_princes',$dat);
                                $id = $this->db->insert_id();
                                if($id > 0){
                                    $dats = array('vendorproductprinceid' => 'VENPRICE'.$id);
                                    $this->db->where('vendorproductprince_id',$id)->update('vendor_product_princes',$dats);
                                }
                            }
                        }else if(trim($vd['16']) == "No"){
                            $datas = array(
                                    'vendorproduct_description'  => trim($vd['4']),
                                    'vendorproduct_descc'        => trim($vd['15']),
                                    'vendorproduct_modified_on'  => date('Y-m-d H:i:s'),
                                    'vendorproduct_modified_by'  => $this->session->userdata("login_id")
                            );
                            $this->db->where('vendorproduct_code',trim($vd['0']))->update('vendor_products',$datas);
                            $dats =array(
                                'vendorproductprince_open'          => '0',
                                'vendorproductprince_modified_on'   => date('Y-m-d H:i:s'),
                                'vendorproductprince_modified_by'   => $this->session->userdata("login_id")
                            );
                            $this->db->where('vendorproductprince_id',$rss['vendorproductprince_id'])->update('vendor_product_princes',$dats);
                            $d = array(
                                'product_open'       => "0",
                                'product_modified_on' => date('Y-m-d H:i:s'),
                                'product_modified_by' => $this->session->userdata("login_id")
                            );
                            $this->db->where('product_id',$res['product_id'])->update('products',$d);
                        }
                    }else{
                        $datas = array(
                                    'vendorproduct_description'  => trim($vd['4']),
                                    'vendorproduct_descc'        => trim($vd['15']),
                                    'vendorproduct_modified_on'  => date('Y-m-d H:i:s'),
                                    'vendorproduct_modified_by'  => $this->session->userdata("login_id")
                                );
                                $this->db->where('vendorproduct_code',trim($vd['0']))->update('vendor_products',$datas);
                                
                        $pers['where_condition'] = "measure_unit LIKE '".trim($vd['13'])."'";
                        $mes = (array)$this->measure_model->getMeasure($pers);
                        $amk    =    "";
                        if(is_array($mes) && count($mes) > 0){
                            $amk    =   $mes['measure_id'];
                        }
                        $dat =array(
                            'vendorid'                      => '1VBE',
                            "vendor_ingredientslist"        =>  ($ingredients != "")?$ingredients:"",
                            "vendorproduct_bb_quantity"     =>  trim($vd['9']),
                            'vendorproductids'              => $res['vendorproduct_id'],
                            'vendorproduct_bb_price'        => trim($vd['11']),
                            'vendorproduct_bb_mrp'          => trim($vd['12']),
                            'vendorproduct_bb_measure'      => $amk,
                            'vendorproductprice_created_by' => $this->session->userdata("login_id"),
                            'vendorproductprice_created_on' => date('Y-m-d H:i:s')
                        );
                        //echo      "<pre>";print_R($dat);exit;
                        $this->db->insert('vendor_product_princes',$dat);
                        $id = $this->db->insert_id();
                        if($id > 0){
                            $dats = array('vendorproductprinceid' => 'VENPRICE'.$id);
                            $this->db->where('vendorproductprince_id',$id)->update('vendor_product_princes',$dats);
                        }
                    }
                }
            }
            return true;
        }
        return false;
    }
    public function product_id($params){
        $dt         =   array(
                            "vendorproduct_open"   => '1',
                            "vendorproduct_status"  => '1'
                    );
        $sel        =   "*";
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                            ->from("vendor_products") 
                            ->where($dt); 
        if(array_key_exists("whereCondition",$params)){
                        $this->db->where("(".$params["whereCondition"].")");
                } 
        
          //$this->db->get();echo $this->db->last_query();exit;
         return  $this->db->get();
    }
    public function product_photos_upload($str,$count){
        $direct = "uploads/products";
        if (file_exists($direct)){
        }else{mkdir("uploads/products");}
        $picture1= '';
		if(!empty($_FILES['file']['name'][$count])){
			/*$config['upload_path'] = $direct.'/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $_FILES['file']['name'][$count]; 
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload',$config);
			$this->upload->initialize($config);   
			if($this->upload->do_upload('file["'.$count.'"]')){
                $uploadData = $this->upload->data();
                $picture1 = $uploadData['file_name'];
                $data = array('upload_data' => $this->upload->data());
                $img=$data['upload_data']['file_name'];
                $config['image_library'] = 'gd2';
                $config['source_image'] = $direct.'/'.$img;
                $config['new_image'] = 'upload/';
                $config['maintain_ratio'] = TRUE;
                $config['width']    = 350;
                $config['height']   = 350;
                $this->load->library('image_lib', $config); 
		        if (!$this->image_lib->resize()) {
	        	    echo $this->image_lib->display_errors();
		        }
			}*/
			    $target_dir =   $this->config->item("uploads_path")."products/";
			    $tmpFilePath = $_FILES['file']['tmp_name'][$count]; 
                    if ($tmpFilePath != ""){  
                        $fname      =   $_FILES['file']['name'][$count];
                        $vsp        =   explode(".",$fname);
                        if(count($vsp) > 1){
                            $j =    count($vsp)-1;
                            $fname      =   time()."_".$count.".".$vsp[$j];
                        }
                        $uploadfile =   $target_dir . basename($fname);
                        move_uploaded_file($tmpFilePath, $uploadfile);  
                    }
			if($fname!=''){
    			 $dta    =   array(
                    "vendorproduct_productid"               =>  $str,
                    "vendorproductimg_name"                 => $fname,
                    "vendorproductimg_created_on"           =>  date("Y-m-d H:i:s"),
                    "vendorproductimg_created_by"           =>  $this->session->userdata("login_id")
                );
               // print_r($dta);exit;
                $this->db->insert("vendorproduct_images",$dta);
                $id = $this->db->insert_id();
                if($id > 0){
                    $dats = array('vendorproductimg_id' => 'VIMG'.$id);
                     $this->db->where('vendorproductimgid',$id)->update('vendorproduct_images',$dats);
                     return TRUE;
                }
			}
            return false;
		}else{
		    return false;
		}
	}
	public function create_product_new($vd){
	    //echo '<pre>';print_r($this->input->post());exit;
            //$tvi    =   '$this->view_profile($this->input->post("vendor_mobile"))';
            $vendor =   "1VBE";
            $prname =    $this->common_config->RemoveSpecialChar(trim($vd['1']));
            $pri    =   $this->product_model->get_product(ucwords($prname));
            $category = $this->checkcategory(trim($vd['2']));
            $subcategory  = $this->checksubcategory(trim($vd['3']));
            $ingredients    = $this->checkingredients(trim($vd['10']));
            $pers['where_condition'] = "measure_unit LIKE '".trim($vd['13'])."'";
            $mes = (array)$this->measure_model->getMeasure($pers);
            if(empty($pri)){
                $thvp   =   $this->create_productdd($vd);
                $pri    =   $this->product_model->get_product(ucwords($prname)); 
            }//echo $this->db->last_query();print_r($pri);exit;
                    $dta    =  $ddta   =   array(
                            "vendorproduct_vendor_id"   =>  $vendor,
                            "vendorproduct_product"     =>  $pri['product_id'],
                            "vendorproduct_description" =>  trim($vd['4']),
                            "vendorproduct_model"       =>  ucwords(trim($vd['5'])),
                            "vendorproduct_brand"       =>  ucwords(trim($vd['6'])),
                            "vendorproduct_shipping"    =>  trim($vd['7']),
                            "vendorproduct_tax_class"   =>  trim($vd['8']),
                            "vendorproduct_descc"       =>  trim($vd['15']),
                            "vendorproduct_category"    =>  $category,
                            "vendorproduct_subcategory" =>  ($subcategory)??'',
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
                if($this->db->affected_rows() > 0){
                    $dat =array(
                        'vendorid'                      => $vendor,
                        'vendorproductids'              => $venid,
                        'vendorproduct_bb_price'        => trim($vd['11']),
                        'vendorproduct_bb_mrp'          => trim($vd['12']),
                        'vendorproduct_bb_quantity'     => trim($vd['9']),
                        'vendor_ingredientslist'        => ($ingredients)??'',
                        'vendorproduct_bb_measure'      => (count($mes)>0)?$mes['measure_id']:"",
                        'vendorproductprice_created_by' => $vendor,
                        'vendorproductprice_created_on' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('vendor_product_princes',$dat);
                    $id = $this->db->insert_id();
                    if($id > 0){
                        $dats = array('vendorproductprinceid' => 'VENPRICE'.$id);
                        return $this->db->where('vendorproductprince_id',$id)->update('vendor_product_princes',$dats);
                    }
                    return TRUE;
                }
                return FALSE;
	}
	public function create_productdd($vd){
	        $prname =    $this->common_config->RemoveSpecialChar($vd['1']);
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
}