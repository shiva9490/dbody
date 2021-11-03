<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Common_model extends CI_Model{    
        public function get_config($uri){
                $this->db->select("$uri as siteval");
                return $this->db->get_where("config_settings",array("id" => '1'))->row();
        }
        public function get_max($col,$tbl){
                $this->db->select("max($col) as maxid");
                $valp 	=	$this->db->get($tbl)->row();
                return $valp->maxid+1;
        }
        public function queryStates($params = array()){
            $sel    =   "*";
            if(array_key_exists("columns", $params)){
                $sel    =   $params["columns"];
            }
            $dta    =   array(
                "st.state_status"   =>  "1"
            );
            $this->db->select("$sel")  
                    ->from("state as st")
                    ->where($dta);
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
        public function queryDistricts($params = array()){
            $sel    =   "*";
            if(array_key_exists("columns", $params)){
                $sel    =   $params["columns"];
            }
            $dta    =   array(
                "st.state_status"       =>  "1",    
                "dt.district_status"    =>  "1"
            );
            $this->db->select("$sel")  
                    ->from("district as dt")
                    ->join("state as st","dt.state_id = st.state_id","INNER")
                    ->where($dta);
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
        public function queryMandals($params = array()){
            $sel    =   "*";
            if(array_key_exists("columns", $params)){
                $sel    =   $params["columns"];
            }
            $dta    =   array(
                "st.state_status"       =>  "1",
                "dt.district_status"    =>  "1",
                "md.mandal_open"    =>  "1",
                "md.mandal_status"    =>  "1"
            );
            $this->db->select("$sel")  
                    ->from("mandal as md")
                    ->join("district as dt","md.mandal_district_id = dt.district_id","INNER")
                    ->join("state as st","dt.state_id = st.state_id","INNER")
                    ->where($dta);
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
        public function queryGramapanchayat($params = array()){
            $sel    =   "*";
            if(array_key_exists("columns", $params)){
                $sel    =   $params["columns"];
            }
            $dta    =   array(
                "st.state_status"       =>  "1",
                "dt.district_status"    =>  "1",
                "md.mandal_open"        =>  "1",
                "gm.gram_panchayat_open"        =>  "1",
                "gm.gram_panchayat_status"      =>  "1",
                "md.mandal_status"      =>  "1"
            );
            $this->db->select("$sel")  
                    ->from("gram_panchayat as gm")
                    ->join("mandal as md","md.mandal_id = gm.gram_panchayat_mandal_id","INNER")
                    ->join("district as dt","md.mandal_district_id = dt.district_id","INNER")
                    ->join("state as st","dt.state_id = st.state_id","INNER")
                    ->where($dta);
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
        public function getstates(){
            $params["order_by"]     =   "ASC";
            $params["tipoOrderby"]  =   "state_name";
            $params["columns"]  =   "state_id,state_name";
            $params["whereCondition"]   =   "state_status LIKE '".'1'."'";
            return $this->queryStates($params)->result_array();
        }
        public function getdistricts($uir){
            //$params["order_by"]     =   "ASC";
            //$params["columns"]      =   "district_id,district_name";
            //$params["tipoOrderby"]      =   "district_name";
            //$params["whereCondition"] =   "st.state_id LIKE '".$uir."'";
            //return $this->queryDistricts($params)->result_array();
            $pre['where_condition']     = "pincodeopen = '1' AND pincode_district LIKE '".$uir."'";
            $pre['group_by']    = "pincode_district";
            return  $this->pincode_model->viewPincode($pre);
        }
        public function districtlist($uir,$area=null){
            $resilt= "pincodeopen = '1' AND pincode_district LIKE '".$uir."'";
            if(!empty($area)){
                $resilt .= "AND pincode_village LIKE '".$area."'";
            }
            $pre['where_condition']     =$resilt;
            $pre['group_by']    = "pincode_village";
            return $this->pincode_model->viewPincode($pre);
        }
        public function getmandals($uir){
            $params["order_by"]     =   "ASC";
            $params["columns"]      =   "mandal_id,mandal_name";
            $params["tipoOrderby"]      =   "mandal_name";
            $params["whereCondition"]   =   "mandal_district_id LIKE '".$uir."'"; 
            return $this->queryMandals($params)->result_array();
        }
        public function getgramapanchyat($uir){
            $params["order_by"]     =   "ASC";
            $params["columns"]      =   "gram_panchayat_id,gram_panchayat_name";
            $params["tipoOrderby"]      =   "gram_panchayat_name";
            $params["whereCondition"]   =   "gram_panchayat_mandal_id LIKE '".$uir."'"; 
            return $this->queryGramapanchayat($params)->result_array();
        }
         public function getmandal(){
            $params["order_by"]     =   "ASC";
            $params["tipoOrderby"]  =   "mandal_name";
            $params["columns"]  =   "mandal_id,mandal_name";
            $params["whereCondition"]   =   "mandal_district_id LIKE '".'693'."'"; 
            return $this->queryMandals($params)->result_array();
        }
        
        
       
         function fetch_district($state_id)
            {
             $this->db->where('state_id', $state_id);
             $this->db->order_by('district_name', 'ASC');
             $query = $this->db->get('district');
             $output = '<option value="">Select District</option>';
             foreach($query->result() as $row)
             {
              $output .= '<option value="'.$row->district_id.'">'.$row->district_name.'</option>';
             }
             return $output;
            }

        function fetch_mandal($district_id)
            {
             $this->db->where('mandal_district_id', $district_id);
             $this->db->order_by('mandal_name', 'ASC');
             $query = $this->db->get('mandal');
             $output = '<option value="">Select Mandal</option>';
             foreach($query->result() as $row)
             {
              $output .= '<option value="'.$row->mandal_id.'">'.$row->mandal_name.'</option>';
             }
             return $output;
            }
            function fetch_gramapanchayat($mandal_id)
            {
             $this->db->where('gram_panchayat_mandal_id ', $mandal_id);
             $this->db->order_by('gram_panchayat_name ', 'ASC');
             $query = $this->db->get('gram_panchayat');
             $output = '<option value="">Select Gramapanchayat</option>';
             foreach($query->result() as $row)
             {
              $output .= '<option value="'.$row->gram_panchayat_id .'">'.$row->gram_panchayat_name.'</option>';
             }
             return $output;
            }
             function fetch_subcategory($category_id)
            {
             $this->db->where('subcategory_category', $category_id);
             $this->db->order_by('subcategory_name', 'ASC');
             $query = $this->db->get('sub_category');
             $output = '<option value="">Select Subcategory</option>';
             foreach($query->result() as $row)
             {
              $output .= '<option value="'.$row->subcategory_id.'">'.$row->subcategory_name.'</option>';
             }
             return $output;
            }
            public function checkuniqueproduct(){ 
           $params["where_condition"]      =   "LOWER(product_name) LIKE '".$this->input->post("product_name")."'"; 
           $vsp    =   $this->product_model->query_product($params)->row_array();
          if(isset($vsp)){
             if(count($vsp) > 0){
                return TRUE;
             }
         }
         return FALSE;
     } 
    public function checkvendor(){
            $mobile     =   $this->input->post("mobile_number");
            $vsp        =   $this->vendor_model->user("vd.vendor_mobile",$mobile);
            return $vsp;
    }  
    public function user($columns,$value){
            $params["whereCondition"]    =   "$columns LIKE '".$value."'";
                $vsp    =   $this->queryVendor($params)->row_array();
                return $vsp;
    }
    public function menudata($top_menu){ 
                $menu   =   array(); 
                $pages  =   json_decode($top_menu); 
                if(count($pages) > 0){
                    foreach ($pages as $page) {
                        $age   =     $this->pages_model->get_pagearray($page->id);
                        if($age != "" && count($age) > 0){ 
                            array_push($menu,$page->id); 
                            if($page->parent == "0"){
                                $this->common_model->render_menu($pages,$page->id,"0");
                            }
                        } 
                    } 
                }
                $not_menu_pages = $this->pages_model->get_pages_not_in_menu($menu);
                if(count($not_menu_pages) > 0){
                    foreach ($not_menu_pages as $li) {
                        $this->render_menu($pages,$li->cpage_id,0);
                    }
                }
	}
    public function render_menu($top_menu,$id,$level=0){   
                if(count($this->has_child($top_menu,$id))<=0 && $level==0){ 
                        $page   =     $this->pages_model->get_pagearray($id);
                        echo '<li class="dd-item" data-id="'.$id.'">'
                                . '<div class="dd-handle">'.$page['cpage_title'].'</div>'
                                . '</li>';
                }
                else if(count($this->has_child($top_menu,$id))<=0 && $level>0){
                        $after_content = '';
                        $cpage   =   $this->pages_model->get_pagearray($id);
                        if($cpage != "" && count($cpage) > 0){
                            echo '<li class="dd-item" data-id="'.$id.'">'
                                . '<div class="dd-handle">'.$cpage['cpage_title'].'</div>'
                                . '</li>'.$after_content;
                        }
                }else if(count($this->has_child($top_menu,$id))>0){ 
                        $childs     =   $this->has_child($top_menu,$id); 
                        $flag       =   0;
                        foreach ($childs as $child){
                            $page   =   $this->pages_model->get_pagearray($id);
                            if($flag==0){
                                echo '<li class="dd-item" data-id="'.$id.'">'
                                        . '<div class="dd-handle">'.$page['cpage_title'].'</div>'
                                        . '<ol class="dd-list" style="">';  
                                $flag = 1;  		    		
                                $level++; 
                            }
                            $this->render_menu($top_menu,$child,$level);
                        }
                        $after_content = '';
                        for($i=0;$i<$level;$i++)
                                        $after_content.= '</ol></li>';
                        echo $after_content;
                }  
	} 
    public function has_child($top_menu,$id){ 
            $child = array();
            if(count($top_menu) > 0){
                foreach ($top_menu as $row){
                    if($row->parent ==    $id && $row->parent != "0"){
                            array_push($child,$row->id);
                    } 
                } 
            }
	    return $child;
	}  
    public function top_menu(){ 
                $top_menu     =   sitedata("site_menu"); 
                $menu   =   array(); 
                $pages  =   json_decode($top_menu);  
                if(count($pages) > 0){
                    foreach ($pages as $page) {
                        $age   =     $this->pages_model->get_pagearray($page->id);
                        if($age != "" && count($age) > 0){ 
                            array_push($menu,$page->id); 
                            if($page->parent == "0"){
                                $this->common_model->render_top_menu($pages,$page->id,"0");
                            }
                        } 
                    }   
                }  
    }
    public function render_top_menu($pages,$id,$level=0,$alias=''){
        $page = $this->pages_model->get_page($id);
        if($page->content_from_name == 'URL'){ 
            $url = $page->cpage_content_url;
		if($alias==$page->cpage_alias_name)
			$class = 'active';
		else
                $class = is_active_menu($page->cpage_content_url);
        }else if($page->cpage_home_menu == '1'){
                $url    = base_url('/');
                $class  = is_active_menu('page-key/'.$page->cpage_alias_name);
        }else{
		$url = base_url('page-key/'.$page->cpage_alias_name);
		if($alias==$page->cpage_alias_name)
                $class = 'active';
		else
                $class = is_active_menu('page-key/'.$page->cpage_alias_name);
        }
	    if(count($this->thhas_child($pages,$id))<=0 && $level==0){
                echo '<li class="menu-item '.$class.'" >'
                        . '<a href="'.$url.'" class="'.$page->cpage_alias_name.'">'.$page->cpage_title.'</a>'
                        . '</li>';
	    }
	    else if(count($this->thhas_child($pages,$id))<=0 && $level>0){
                $after_content = '';
	        echo '<li class="menu-item '.$class.'">'
                        . '<a href="'.$url.'"  class="'.$page->cpage_alias_name.'">'.$page->cpage_title.'</a>'
                        . '</li>'.$after_content;
            }
            else if(count($this->thhas_child($pages,$id))>0){
                $childs = $this->thhas_child($pages,$id);
	        $flag = 0;
	        foreach ($childs as $child){ 
                    if($flag==0){
                        if($level == '0'){
                            echo '<li class="menu-item menu-item-has-children animate-dropdown dropdown"> 
                            <a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$page->cpage_title.'<span class="caret"></span></a>'
                                . '<ul role="menu" class="dropdown-menu">';   
                        }else{ 
                                echo '<li class="menu-item dropdown-submenu"> 
                                <a href="#" tabindex="-1">'.$page->cpage_title.$level.$flag.'</a>'
                                    . '<ul role="menu" class="dropdown-menu">';   
                        }
                        $flag=1; 	
                        $level++; 
                    }
                    $this->render_top_menu($pages,$child,$level,$alias);
	        }
                $after_content = '';
	        for($i=0;$i<$level;$i++)
	            $after_content.= '</ul></li>';
	        echo $after_content;
	    }
	}  
    public function thhas_child($top_menu,$id){ 
            $child = array();
	    foreach ($top_menu as $row){
                if($row->parent ==    $id && $row->parent != "0"){
                        array_push($child,$row->id);
                } 
	    } 
	    return $child;
    }
    public function update_menu(){
            $dta    =   array(
                "site_menu"     => $this->input->post("menu")
            );
            $this->db->update("config_settings",$dta,array("id" => "1"));
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
            return FALSE;
    }
    public function get_sub_category($uri){ 
        $params["where_condition"]      =   "category_keywords LIKE '".$uri."'"; 
        return $this->category_model->query_sub_category($params)->result_array();
    }
    /*--------------------occasion------------------------*/
    public function queryoccasion($params = array()){
        $sel    =   "*";
        if(array_key_exists("columns", $params)){
            $sel    =   $params["columns"];
        }
        $this->db->select("$sel")  
                ->from("occasion");
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
    public function viewOccasion($params = array()){
            return $this->queryoccasion($params)->result_array();
    }
    public function get_Occasion($uri){
        $params["whereCondition"]      =   "occasion_id = '".$uri."'";
        return $this->queryoccasion($params)->result_array();
    }
    /*--------------------End occasion------------------------*/
    public function viewCountries($params = array()){
            return $this->queryCountries($params)->result_array();
    }
    public function queryCountries($params = array()){
        $sel    =   "*";
        if(array_key_exists("columns", $params)){
            $sel    =   $params["columns"];
        }
        $dta    =   array(
            "st.state_status"   =>  "1"
        );
        $this->db->select("$sel")  
                ->from("countries");
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
    
    public function reportvlue($reportvalue,$conditions)
    {
        if($reportvalue == "Orders"){
                $conditions["columns"]  =   "order_id as Order Id,cp.customer_name as Name,cp.customer_mobile as Mobile ,cp.customer_email_id as Email,order_razor_payment_id as Payement Id,customer_mobile as 'Mobile',customer_name as 'Name',order_total as 'Total',order_date as 'Date', CONCAT(cad.customeraddress_fullname,', ',cad.customeraddress_mobile, ', ',cad.customeraddress_locality, ', ',cad.customeraddress_address,', ',cad.customeraddress_district,', ',cad.customeraddress_pincode) AS Address,order_acde  as 'Delivery Status'";
                $view       =   $this->order_model->queryorders($conditions);  
            }
           
           // echo "<pre>";print_r($view->result());exit;
            if(count($view->result()) > 0){
                $va  	=   $view; 
                $fields     =   $va->field_data();
                $csv_header =   ""; $csv_row = ""; $ary =	array();
                foreach ($fields as $field){
                        $csv_header .= $field->name.","; 
                        $ary[]	=	$field->name; 
                } 
                $csv_header .= "\n";
                foreach($va->result() as $vp){   
                    foreach($ary as $ayt){
                        $csv_row .= '"'. (($vp->$ayt)?$vp->$ayt:" ").'",'; 
                        //$dddd   =($vp->$ayt)??"";
                        //$csv_row .= '"'.$dddd.'",'; 
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
                header('Content-type: application/csv');
                header('Content-Disposition: attachment; filename='.$reportvalue.date('Y-m-d').time().'.csv');
                $vsg    =   $csv_header . $csv_row;
                echo $vsg;exit; 
            }
    }   
}