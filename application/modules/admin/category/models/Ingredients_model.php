<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Ingredients_model extends CI_Model{
    public function queryIngredients($params = array()){
        $dt         =   array(
                            "prod_indu_open"      =>     '1',
                            "prod_indu_status"    =>     '1'
                    );
        $sel        =   "*";
        if(array_key_exists("cnt",$params)){
            $sel    =   "count(*) as cnt";
        }
        if(array_key_exists("columns",$params)){
            $sel    =    $params["columns"];
        }
        $this->db->select($sel)
                    ->from("product_Ingredients") 
                    ->join("category","product_Ingredients.category_id =category.category_id","left")
                    ->join("sub_category","product_Ingredients.subcategory_id =sub_category.subcategory_id","left")
                    ->where($dt); 
        if(array_key_exists("keywords",$params)){
                $this->db->where("(prod_indug LIKE '%".$params["keywords"]."%')");
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
    public function cntviewIngredients($params  =    array()){
            $params["cnt"]      =   "1"; 
            $val    =   $this->queryIngredients($params)->row_array();
            if(count($val) > 0){
                return  $val['cnt'];
            }
            return "0";
    }
    public function viewIngredients($params = array()){
//            $this->query_category($params);echo $this->db->last_query();exit;
            return $this->queryIngredients($params)->result();
    }
    public function get_ingredients($uri){
        $params["where_condition"]   =   "vendorproductprinceid LIKE '".$uri."'";
        return $this->queryIngredients($params)->row_array();
    }
    public function getingredients($params){
        return $this->queryIngredients($params)->row_array();
    } 
    public function getCategory($params = array()){
        return $this->queryIngredients($params)->row();
    } 
    public function unique_category($uri){ 
        $params["cnt"]                  =   '1';
        $params["unique_category"]      =   $uri;              
        $vsl        =   $this->queryIngredients($params)->row_array(); 
        if(is_array($vsl)){
            if($vsl['cnt'] > 0){
                return "true";
            }
        }
        return "false";
    }
    public function unique_ingredients_name(){ 
        $params["where_condition"]      =   "LOWER(category_name) LIKE '".$this->input->post("category_name")."'"; 
        $vsp    =   $this->queryIngredients($params)->row_array();
        if(isset($vsp)){
            if(count($vsp) > 0){
                return TRUE;
            }
        }
        return FALSE;
    }
    public function create_ingredients(){ 
            $catne  =   trim($this->input->post("prod_indug"));
            $catkey     = str_replace(" ","_", strtolower($catne));
            $dta    =   array(
                "prodind"               =>    "INDU".$this->common_model->get_max("prod_ind","product_Ingredients"),
                "prod_indug_key_wrds"   =>    $catkey,
                "prod_indug"            =>    ucwords($catne),
                "category_id"           =>    $this->input->post('category_id'),
                "subcategory_id"        =>    ($this->input->post('subcategory_id')!='')?$this->input->post('subcategory_id'):'',
                "prod_indu_add_date"    =>    date("Y-m-d H:i:s"),
                "prod_indu_add_by"      =>    $this->session->userdata("login_id")?$this->session->userdata("login_id"):""
            );
            $this->db->insert("product_Ingredients",$dta);
            if($this->db->insert_id() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function delete_Ingredients($uri){
            $dta    =   array(
                "prod_indu_open"        => 0,
                "prod_indu_update_date" => date("Y-m-d H:i:s"),
                "prod_indu_update_by"   => $this->session->userdata("login_id")
            ); 
            $this->db->update("product_Ingredients",$dta,array("prodind"=>$uri));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function update_ingredients($uri){
            $catname    =   ucwords(trim($this->input->post("prod_indug")));
            $cattval    =   $this->input->post("prod_indug")?$catname:$catdname;
            $catkey     = str_replace(" ","_", strtolower($cattval));
            $dta    =   array( 
                "prod_indug_key_wrds"   =>   $catkey,
                "prod_indug"            =>   $cattval,
                "category_id"           =>  $this->input->post('category_id'),
                "subcategory_id"        =>  ($this->input->post('subcategory_id')!='')?$this->input->post('subcategory_id'):'',
                "prod_indu_update_date" =>  date("Y-m-d H:i:s"),
                "prod_indu_update_by"   =>  $this->session->userdata("login_id")
            ); 
            $this->db->update("product_Ingredients",$dta,array("prodind"     =>   $uri));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function listinsr($uri=null){
        $par['columns']         = "prodind,prod_indug,prod_indug_key_wrds";
        $par['where_condition'] = "product_Ingredients.category_id LIKE '".$uri."'";
        $vue    =   $this->ingredients_model->viewIngredients($par);
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
        $par['where_condition'] = "product_Ingredients.category_id LIKE '".$uri."'";
        $vue    =   $this->ingredients_model->viewIngredients($par);
        if(count($vue) > 0){
            $option ='<div class="col-md-4"><div class="form-group"><label>Ingredients <span class="required text-danger">*</span></label>';
            $option .='<select class="form-control" name="Ingredients" id="Ingredients" data-value="0" required="">';
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
}