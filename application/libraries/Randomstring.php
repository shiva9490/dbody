<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Randomstring{
        public function getToken($length = 32) {
                $randstr = "";
                srand((double) microtime(TRUE) * 1000000);
                //our array add all letters and numbers if you wish
                $chars = array(
                    '1', '2', '3', '4', '5','6', '7', '8', '9');

                for ($rand = 0; $rand <= $length; $rand++) {
                    $random = rand(0, count($chars) - 1);
                    $randstr .= $chars[$random];
                }
                return $randstr;
        }  
        public function getString($length = 32) {
                $randstr = "";
                srand((double) microtime(TRUE) * 1000000);
                //our array add all letters and numbers if you wish
                $chars = array(
                    '1', '2', '3', '4', '5','6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K',
                    'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

                for ($rand = 0; $rand <= $length; $rand++) {
                    $random = rand(0, count($chars) - 1);
                    $randstr .= $chars[$random];
                }
                return $randstr;
        }  
        public function alldates($month,$year){ 
                $start_date = "01-".$month."-".$year;
                $start_time = strtotime($start_date);
                $end_time   = strtotime("+1 month", $start_time);
                for($i=$start_time; $i<$end_time; $i+=86400){
                   $list[] = date('Y-m-d', $i);
                } 
                return $list;
        }
        public function strreplace($vlur){
                $vlur   = str_replace("]","", $vlur);
                return str_replace("[","",$vlur);
        }
        public function getLatLong($address){
            if(!empty($address)){ 
                $key    = sitedata('google_auto_locationkey');
                $formattedAddr = str_replace(' ','+',$address); 
                $geocodeFromAddr = file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false&key='.$key); 
                $output = json_decode($geocodeFromAddr); 
                $data['latitude']  = "";
                $data['longitude'] = "";
                if($output->status == "ok"){
                    $data['latitude']  = $output->results[0]->geometry->location->lat; 
                    $data['longitude'] = $output->results[0]->geometry->location->lng; 
                }
                if(!empty($data)){
                    return $data;
                }else{
                    return array();
                }
            }
            return array();
        }
}