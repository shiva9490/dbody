<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Homepages extends CI_Controller{
        public function returns(){
            $data = array(
                        "content" => "homepages/returns"
                    );
            $this->load->view('theme/inner_template',$data);
        }
        public function faqs(){
            $data = array(
                        "content" => "homepages/faqs"
                    );
            $this->load->view('theme/inner_template',$data);
        }
}