<?php
class Faq_model extends CI_Model{
	public function add_service_category($data){
		return $this->db->insert('services_category',$data);
	}
	
	public function add_faq($data){
		return $this->db->insert('faq',$data);
	}
	public function update_faq($id,$data){
		return $this->db->where('id',$id)->update('faq',$data);
	}
	public function edit_faq($id){
		return $this->db->from('faq')->where('id',$id)->get()->result();
	}
	public function cntview_faq($params  =    array()){
		$params["cnt"]      =   "1";
		$val    =   $this->query_faq($params)->row_array();
		//print_r($val);die;
		if(count($val) > 0){
			return  $val['cnt'];
		}
		return "0";
	}
	public function view_faq($params  =    array()){
		//print_r($params);exit;
		return  $this->query_faq($params)->result();
	}
	public function query_faq($params = array()){
		//print_r($params);exit;
		$dt =   array(
					"faq_status!=" => '3'
				);
		$sel =   "*";
		if(array_key_exists("cnt",$params)){
			$sel    =   "count(*) as cnt";
		}
		if(array_key_exists("columns",$params)){
			$sel    =    $params["columns"];
		}
		$this->db->select($sel)
					->from("faq")
					->where($dt);
		if(array_key_exists("keywords",$params)){
				$this->db->where("(faq_name LIKE '%".$params["keywords"]."%')");
		}
		if(array_key_exists("uri",$params)){
				$this->db->where("id",$params["uri"]);
		}
		if(array_key_exists("all_uid",$params)){
				$this->db->where("(".$params["all_uid"].")");
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
	public function get_faq($uri){
		$params["uri"]    =   $uri;
		return  $this->query_faq($params)->row_array();
	 }
	public function delete_faq($uri){	
		$dta    =   array( 
			"faq_status"            =>      '3',
			"faq_modification_date"     =>      date("Y-m-d h:i:s")
		);
		$this->db->update("faq",$dta,array("id" => $uri));
		if($this->db->affected_rows() >  0){
				return TRUE;
		}
		return FALSE;
    }
}
?>