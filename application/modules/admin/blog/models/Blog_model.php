<?php
class Blog_model extends CI_Model{
        public function queryBlog($params = array()){
            $sel    =   "*";
            if(array_key_exists("columns",$params)){
                $sel    =   $params["columns"];
            }
            if(array_key_exists("cnt",$params)){
                $sel    =   "count(*) as cnt";
            }
            $dta        =   array(
                "blog_open"    =>  '1',
                "blog_status"  =>  '1'
            );
            $this->db->select($sel)
                ->from("blog")
                ->where($dta);
            if(array_key_exists("keywords",$params)){
                $this->db->where("(blog_title LIKE '%".$params["keywords"]."%')");
			}
            if(array_key_exists('whereCondition', $params)){
                $this->db->where("(".$params['whereCondition'].")");
            }
            if(array_key_exists("ad_id",$params)){
                    $this->db->where("id > ",$params["ad_id"]);
            }
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("tipoOrderby",$params) && array_key_exists("order_by",$params)){
                    $this->db->order_by($params['tipoOrderby'],$params['order_by']);
            } 
//            $this->db->get();echo $this->db->last_query();exit;
            return $this->db->get();
        }
        public function unique_values($fields,$uri){
                $params["cnt"]              =   '1';
                $params["whereCondition"]   =   "$fields LIKE '$uri'"; 
                $vsl        =   $this->queryBlog($params)->row_array(); 
                if($vsl['cnt'] >  0){
                    return "false";
                }
                return "true";
        }
        public function check_unique_name($fields,$uri){
                $params["cnt"]              =   '1';
                $params["whereCondition"]      =   "$fields LIKE '$uri'"; 
                $vsl        =   $this->queryBlog($params)->row_array(); 
                if($vsl['cnt'] ==  0){
                        return FALSE;
                }
                return TRUE;
        }
        public function cntviewBlog($params  =    array()){
                $params["cnt"]      =   "1"; 
                $val    =   $this->queryBlog($params)->row_array();
                if(is_array($val) && count($val) > 0){
                    return  $val['cnt'];
                }
                return "0";
        }
        public function viewBlog($params  =    array()){ 
                return  $this->queryBlog($params)->result();
        }
        public function getSBlog($params  =    array()){ 
                return  $this->queryBlog($params)->row_array();
        }
        
        public function add_blog(){
                $picture1 =''; 
        	    if(!empty($_FILES['image']['name'])){
        		    $config['upload_path'] = 'assets/images/blog/';
        		    $config['allowed_types'] = 'jpg|jpeg|png|gif';
        		    $config['file_name'] = $_FILES['image']['name']; 
        		    $config['encrypt_name'] = TRUE;
        		    $this->load->library('upload',$config);
        		    $this->upload->initialize($config);   
        		    if($this->upload->do_upload('image')){
        		     $uploadData = $this->upload->data();
        		     $picture1 = $uploadData['file_name'];
        		    }
        		}
        		$url = $this->common_config->removeNonUtf8($this->input->post('blog_title'));
                $dta    =   array( 
                                "blog_title"            =>  $this->input->post('blog_title'),
                                "blog_url"              =>  $url,
                                "blog_desc"             =>  $this->input->post('blog_desc'),
                                "blog_publishing_date"  =>  $this->input->post('blog_publishing_date'),
                                "blog_add_date"         =>  date("Y-m-d"),
                                "blog_add_by"           =>  $this->session->userdata("login_id")
                            );
                if(!empty($_FILES['image']['name'])){
                    $dta['blog_image'] = $picture1;
                }
                $this->db->insert("blog",$dta);
                $vps    =   $this->db->insert_id();
                if($vps >  0){
                    $this->db->update("blog",array("blog_id" => $vps."BLOG"),array("blogid" => $vps));
                    return TRUE;
                }
        }
        public function update_blog($loginid){
                $picture1 =''; 
        	    if(!empty($_FILES['image']['name'])){
        		    $config['upload_path'] = 'assets/images/blog/';
        		    $config['allowed_types'] = 'jpg|jpeg|png|gif';
        		    $config['file_name'] = $_FILES['image']['name']; 
        		    $config['encrypt_name'] = TRUE;
        		    $this->load->library('upload',$config);
        		    $this->upload->initialize($config);   
        		    if($this->upload->do_upload('image')){
        		     $uploadData = $this->upload->data();
        		     $picture1 = $uploadData['file_name'];
        		    }
        		}
        		$url = $this->common_config->removeNonUtf8($this->input->post('blog_title'));
                $dta    =   array( 
                                "blog_title"            =>  $this->input->post('blog_title'),
                                "blog_url"              =>  $url,
                                "blog_desc"             =>  $this->input->post('blog_desc'),
                                "blog_publishing_date"  =>  $this->input->post('blog_publishing_date'),
                                "blog_update_date"  =>  date("Y-m-d h:i:s"),
                                "blog_modified_by"    =>  $this->session->userdata("login_id")
                            );
                if(!empty($_FILES['image']['name'])){
                    $dta['blog_image'] = $picture1;
                }
                $this->db->update("blog",$dta,array("blog_id" => $loginid)); 
                $vsp    =    $this->db->affected_rows();
                if($vsp > 0){  
                    return TRUE;
                }
                return FALSE;
        }
        public function delete_blog($loginid){
                $dta    =   array( 
                                "blog_open"         =>    0,
                                "blog_update_date"  =>    date("Y-m-d h:i:s"),
                                "blog_modified_by"    =>    $this->session->userdata("login_id")
                            );
                $this->db->update("blog",$dta,array("blog_id" => $loginid)); 
                $vsp    =    $this->db->affected_rows();
                if($vsp > 0){  
                    return TRUE;
                }
                return FALSE;
        }
        public function activedeactive($uri,$status){
                $dta    =   array( 
                                "blog_abc"             =>    $status,
                                "blog_update_date"  =>    date("Y-m-d h:i:s"),
                                "blog_modified_by"    =>    $this->session->userdata("login_id")
                            );
                $this->db->update("blog",$dta,array("blog_id" => $uri)); 
                $vsp    =    $this->db->affected_rows();
                if($vsp > 0){  
                    return TRUE;
                }
                return FALSE;
        }
        public function getBlog($params  =    array()){ 
                return  $this->queryBlog($params)->row_array();
        }
        
}