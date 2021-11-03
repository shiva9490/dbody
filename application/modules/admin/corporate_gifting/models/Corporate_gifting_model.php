<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Corporate_gifting_model extends CI_Model{
        public function queryCorporate_gifting($params = array()){
                $dta =  array(
                    "corporate_gifting_open"   =>  "1"
                );
                $sel   =    "*";
                if(array_key_exists("cnt",$params)){
                        $sel    =   "count(*) as cnt";
                }
                if(array_key_exists("columns",$params)){
                        $sel    =   $params["columns"];
                }
                $this->db->select("$sel")
                        ->from("corporate_gifting")
                        ->where($dta);
                if(array_key_exists("where_condition",$params)){
                        $this->db->where("(".$params["where_condition"].")");
                } 
                if(array_key_exists("keywords",$params)){
                        $this->db->where("(corporate_gifting_title LIKE '%".$params["keywords"]."%')");
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
        public function cntviewCorporate_gifting($params = array()){
                $params["cnt"]  =   1;
                $vsp    =   $this->queryCorporate_gifting($params)->row_array();
                if(count($vsp) > 0){
                        return $vsp['cnt'];
                }
                return 0;
        }
        public function viewCorporate_gifting($params = array()){
                return  $this->queryCorporate_gifting($params)->result();
        }
        public function viewCorporate_giftingdata($params = array()){
            $imagepath  =   $this->config->item("upload_url")."corporate_gifting-uploads/"; 
            $params["where_condition"]  =   "corporate_gifting_vendor_expriy >= '".date("Y-m-d")."'";
            $params["tipoOrderby"]  =   "corporate_giftingid";
            $params["order_by"]  =   "DESC";
            $params["columns"]   =   "corporate_gifting_title,CONCAT('".$imagepath."',corporate_gifting_image) as corporate_gifting_image";
            return  $this->queryCorporate_gifting($params)->result();
        }
        public function getCorporate_gifting($uri){
                $pms["where_condition"]     =   "corporate_gifting_id LIKE '".$uri."'";
                return $this->queryCorporate_gifting($pms)->row_array();
        }
        public function createCorporate_gifting(){
                $images = array();
                if(count($_FILES) > 0){
                    $target_dir =   $this->config->item("uploads_path")."corporate_gifting-uploads/";
                    $i=0;
                    foreach($_FILES["file"]["name"] as $image){
                        $fname      =   $image;
                        if($fname != "noname"){
                            $vsp        =   explode(".",$fname);
                            $fname      =   "COR_".time().$i.".".$vsp['1'];
                            $uploadfile =   $target_dir . basename($fname);
                            $vsp 	=	move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadfile); 
                            if($vsp){
                                $images[$i] =   $fname;
                            }
                        }
                        $i++;
                    }
                    
                }
                $dta    =   array(
                        "corporate_gifting_id"              =>  $this->common_model->get_max("corporate_giftingid","corporate_gifting")."COGT", 
                        "corporate_gifting_name"            =>   $this->input->post("name"),  
                        "corporate_gifting_email"           =>   $this->input->post("email"),  
                        "corporate_gifting_mobile"          =>   $this->input->post("mobile"),  
                        "corporate_gifting_company"         =>   $this->input->post("company_name"),  
                        "corporate_gifting_role"            =>   $this->input->post("company_role"), 
                        "corporate_gifting_desc"            =>   $this->input->post("description"), 
                        "corporate_gifting_image"           =>   implode(',',$images),
                        "corporate_gifting_created_on"      =>   date("Y-m-d h:i:s"), 
                        "corporate_gifting_created_by"      =>   $this->session->userdata("login_id")??''
                );
                $this->db->insert("corporate_gifting",$dta);
                if($this->db->insert_id() >  0){
                    $this->gifting_mail();
                        return TRUE;
                }
                return FALSE;
        }
        public function gifting_mail(){
            $toemail        = $this->input->post("email");
            $subject        = 'Minikart - Corporate gifting request response';
            $messge     = 'Thank you for submitting corporate gifting request<br>we received this details <br><br><br>
            <b> Name  :  </b> '.$this->input->post("name").'<br>
            <b> Email  :  </b> '.$this->input->post("email").'<br>
            <b> Mobile  :  </b> '.$this->input->post("mobile").'<br>
            <b> Company Name  :  </b> '.$this->input->post("company_name").'<br>
            <b> Role  :  </b> '.$this->input->post("company_role").'<br>
            <b> Description  :  </b> '.$this->input->post("description").'<br>';
            $response = $this->common_config->orderadminemail('',$subject,$messge);
            $this->common_config->orderemail($toemail,$subject,$messge);
        }
        public function updateCorporate_gifting($uri){
                $dta    =   array( 
                        "corporate_gifting_title"   =>   $this->input->post("corporate_gifting_title"), 
                        "corporate_gifting_modified_on"   =>   date("Y-m-d h:i:s"),  
                        "corporate_gifting_modified_by"   =>   $this->session->userdata("login_id")
                ); 
                if(count($_FILES) > 0){
                    $target_dir =   $this->config->item("uploads_path")."corporate_gifting-uploads/";
                    $fname      =   $_FILES["corporate_gifting_image"]["name"];
                    if($fname != ""){
                        $vsp        =   explode(".",$fname);
                        $fname      =   "BAN_".time().".".$vsp['1'];
                        $uploadfile =   $target_dir . basename($fname);
                        $vsp 	=	move_uploaded_file($_FILES['corporate_gifting_image']['tmp_name'], $uploadfile); 
                        if($vsp){
                            $dta['corporate_gifting_image'] =   $fname;
                        }
                    }
                }   
                $this->db->update("corporate_gifting",$dta,array("corporate_gifting_id" => $uri));
              // echo $this->db->last_query();exit;
               
                if($this->db->affected_rows() >  0){
                        $this->transaction_log->save_log("Update Corporate_gifting","Corporate_gifting","Update","",$this->session->userdata("login_id"));
                        return TRUE;
                }
                return FALSE;
        }
        public function deletecorporate_gifting($uri){
                $dta    =   array( 
                        "corporate_gifting_open"    =>  0,
                        "corporate_gifting_modified_on"   =>   date("Y-m-d h:i:s"), 
                        "corporate_gifting_modified_by"   =>   $this->session->userdata("login_id")
                );
                $this->db->update("corporate_gifting",$dta,array("corporate_gifting_id" => $uri));
                if($this->db->affected_rows() >  0){
                        $this->transaction_log->save_log("Deleted Corporate_gifting","Corporate_gifting","Delete","",$this->session->userdata("login_id"));
                        return TRUE;
                }
                return FALSE;
        }
}