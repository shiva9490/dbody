<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Addon_model extends CI_Model{
    public function queryAddon($params = array()){
        $dt         =   array(
                            "addon_open"      =>     '1',
                            //"prod_indu_status"    =>     '1'
                    );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("addon") 
                   ->join("category","addon.category_id =category.category_id","left")
                   ->join("sub_category","addon.subcategory_id =sub_category.subcategory_id","left")
                    ->where($dt); 
        if(array_key_exists("keywords",$params)){
                $this->db->where("(addon_id LIKE '%".$params["keywords"]."%')");
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
       //$this->db->get();echo $this->db->last_query();exit;
        return  $this->db->get();
    } 
    public function cntviewAddon($params  =    array()){
            $params["cnt"]      =   "1"; 
            $val    =   $this->queryAddon($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
    }
    public function viewAddon($params = array()){
//            $this->query_category($params);echo $this->db->last_query();exit;
            return $this->queryAddon($params)->result();
    }
    public function get_addon($uri){
        $params["where_condition"]   =   "vendorproductprinceid LIKE '".$uri."'";
        return $this->queryAddon($params)->row_array();
    }
    public function getaddon($params){
        return $this->queryAddon($params)->row_array();
    } 
    public function getCategory($params = array()){
        return $this->queryAddon($params)->row();
    } 
    public function unique_category($uri){ 
        $params["cnt"]                  =   '1';
        $params["unique_category"]      =   $uri;              
        $vsl        =   $this->queryAddon($params)->row_array(); 
        if(is_array($vsl)){
            if($vsl['cnt'] > 0){
                return "true";
            }
        }
        return "false";
    }
    public function unique_addon_name(){ 
        $params["where_condition"]      =   "LOWER(category_name) LIKE '".$this->input->post("category_name")."'"; 
        $vsp    =   $this->queryAddon($params)->row_array();
        if(isset($vsp)){
            if(count($vsp) > 0){
                return TRUE;
            }
        }
        return FALSE;
    }
    public function create_addon(){ 
            $catne  =   trim($this->input->post("name"));
            $id     =   "ADDO".$this->common_model->get_max("addonid","addon");
            $dta    =   array(
                "addon_id"          =>    $id,
                "addon_name"        =>     trim($this->input->post("name")),
                "category_id"       =>    $this->input->post('category_id'),
                "subcategory_id"    =>    ($this->input->post('subcategory_id')!='')?$this->input->post('subcategory_id'):'',
                "addon_cr_on"       =>    date("Y-m-d H:i:s"),
                "addon_cr_by"       =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):""
            );
            $this->db->insert("addon",$dta);
            if($this->db->insert_id() > 0){
                if($this->input->post('cat[]')!=''){
                    foreach($this->input->post('Prod') as $prodid)
                    { 
                        $par['whereCondition'] = "vp.vendorproduct_id = '".$prodid."'";
                        $par['columns']	="vendorproduct_category";
                        $category           =   $this->vendor_model->getVendorproduct($par);
                        $data = array(
                            'addon_items_addon_id'           =>  $id,
                            'addon_items_category_id'        =>  $category['vendorproduct_category'],         
                            'addon_items_item_id'            =>  $prodid,    
                            'addon_items_cr_on'              =>  date("Y-m-d h:i:s"),    
                            'addon_items_cr_by'              =>  $this->session->userdata("login_id"), 
                        );//print_r($data);exit;
                        $this->db->insert("addon_items",$data);
                        $vs   =    $this->db->insert_id();
                        if($vs > 0){
                            $dat=array(
                                "addon_items_id" 			=> $vs."ADDI"
                            );
                            $this->db->update("addon_items",$dat,"addon_itemsid='".$vs."'");
                        
                        } 
                    }
                }
                /*-------Addon End------*/
                
                return TRUE;
            }
            return FALSE;
    }
    public function delete_Addon($uri){
            $dta    =   array(
                "addon_open"        => 0,
                "addon_md_on" => date("Y-m-d H:i:s"),
                "addon_md_by"   => $this->session->userdata("login_id")
            ); 
            $this->db->update("addon",$dta,array("addon_id"=>$uri));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function update_addon($uri){
            $dta    =   array( 
                "addon_name"        =>     trim($this->input->post("name")),
                "category_id"       =>    $this->input->post('category_id'),
                "subcategory_id"    =>    ($this->input->post('subcategory_id')!='')?$this->input->post('subcategory_id'):'',
                "addon_md_on"       =>    date("Y-m-d H:i:s"),
                "addon_md_by"       =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):""
            ); 
            $this->db->update("addon",$dta,array("addon_id" =>   $uri));
            if($this->db->affected_rows() > 0){
                if($this->input->post('cat[]')!=''){
                    $dtaaaa    =   array(
                        "addon_items_open"    =>  0, 
                        "addon_items_md_by"   => $this->session->userdata("login_id"),
                        "addon_items_md_on"   => date('Y-m-d H:i:s')
                    );
                    $this->db->update("addon_items",$dtaaaa,array("addon_items_addon_id" => $uri));
                    foreach($this->input->post('Prod') as $prodid)
                    {   $a_prodid = explode('_',$prodid);
                        $par['whereCondition']  = "vp.vendorproduct_id = '".$a_prodid[0]."'";
                        $par['columns']	        =  "vendorproduct_category";
                        $category               =   $this->vendor_model->getVendorproduct($par);
                        $paa['whereCondition']  =   "addon_items_addon_id = '".$uri."'AND addon_items_category_id ='".$category['vendorproduct_category']."'  AND addon_items_item_id = '".$prodid."'";
                        $vsss   = $this->addon_model->getAddonItems($paa);
                        if($vsss){
                            $dtaaa    =   array(
                                "addon_items_open"    =>  1, 
                                "addon_items_md_by"   => $this->session->userdata("login_id"),
                                "addon_items_md_on"   => date('Y-m-d H:i:s')
                            );
                            $this->db->update("addon_items",$dtaaa,array("addon_items_id" => $vsss[0]['addon_items_id']));
                        }else{
                            $data = array(
                                'addon_items_addon_id'           =>  $uri,
                                'addon_items_category_id'        =>  ($category['vendorproduct_category'])??'',         
                                'addon_items_item_id'            =>  $prodid,    
                                'addon_items_cr_on'              =>  date("Y-m-d h:i:s"),    
                                'addon_items_cr_by'              =>  $this->session->userdata("login_id"), 
                            );
                            $this->db->insert("addon_items",$data);
                            $vs   =    $this->db->insert_id();
                            if($vs > 0){
                                $dat=array(
                                    "addon_items_id" 			=> $vs."ADDI"
                                );
                                $this->db->update("addon_items",$dat,"addon_itemsid='".$vs."'");
                            
                            } 
                        }
                        
                    }
                }
                return TRUE;
            }
            return FALSE;
    }
    public function listinsr($uri=null){
        $par['columns']         = "prodind,prod_indug,prod_indug_key_wrds";
        $par['where_condition'] = "product_Addon.category_id LIKE '".$uri."'";
        $vue    =   $this->addon_model->viewAddon($par);
        if(count($vue) > 0){
            $option ="<option value=''>Select Type</option>";
            foreach($vue as $r){
                $option.="<option value=".$r->prodind.">".$r->prod_indug."</option>";
            }
            print_r($option);
        }
    }
    public function listinsrt($uri=null){
        $par['columns']         = "prodind,prod_indug,prod_indug_key_wrds";
        $par['where_condition'] = "product_Addon.category_id LIKE '".$uri."'";
        $vue    =   $this->addon_model->viewAddon($par);
        if(count($vue) > 0){
            $option ='<div class="col-md-4"><div class="form-group"><label>Addon <span class="required text-danger">*</span></label>';
            $option .='<select class="form-control" name="Addon" id="Addon" data-value="0" required="">';
            $option .="<option value=''>Select Type</option>";
            $option .="<option value='all'>Select All</option>";
            foreach($vue as $r){
                $option.="<option value=".$r->prodind.">".$r->prod_indug."</option>";
            }
            $parm['whereCondition'] ="vendorproduct_bb_quantity !=''";
            $parm['group_by'] ="vendorproduct_bb_quantity";
            $sizes = $this->vendor_model->viewVendorproductprices($parm);
            //echo '<pre>';print_r($sizes);exit;
            if(is_array($sizes) && count($sizes)>0){
                $option .='</select></div></div>';
                $option .='<div class="col-md-4"><div class="form-group"><label>Sizes <span class="required text-danger">*</span></label>';
                $option .='<select class="form-control" name="size" id="size" data-value="0" required="">';
                $option .="<option value=''>Select Size</option>";
                foreach($sizes as $sz){
                    $option.="<option value=".$sz->vendorproduct_bb_quantity.">".$sz->vendorproduct_bb_quantity."</option>";
                }
                $option .='</select></div></div>';
            }
            print_r($option);
        }
    }
    public function viewAddonItems($params = array()){
        return $this->queryAddonItems($params)->result();
    }
    public function getAddonItems($params = array()){
        return $this->queryAddonItems($params)->result_array();
    }
    public function queryAddonItems($params = array()){
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
                    ->from("addon_items as ai")
                    ->join("addon as a","a.addon_id=ai.addon_items_addon_id","LEFT")
                    ->where($dt);
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
    public function activedeactive($uri,$status){
        $dta    =   array( 
                        "addon_status"             =>    $status,
                        "addon_md_on"  =>    date("Y-m-d h:i:s"),
                        "addon_md_by"    =>    $this->session->userdata("login_id")
                    );
        $this->db->update("addon",$dta,array("addon_id" => $uri)); 
        $vsp    =    $this->db->affected_rows();
        if($vsp > 0){  
            return TRUE;
        }
        return FALSE;
    }
}