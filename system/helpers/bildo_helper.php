<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if ( ! function_exists('sitedata')){ 
        function sitedata($uri){
                $CI =& get_instance();
                $vsp 	=	$CI->common_model->get_config($uri);
                return $vsp->siteval;
        }
}
if ( ! function_exists('bildourl')){ 
        function bildourl($uri){ 
                return base_url(sitedata("site_admin")."/".$uri);
        }
}
if ( ! function_exists('widget_path')){ 
        function widget_path(){
            $CI =& get_instance();
            $vsp1 	=	sitedata("widget_path");   
            return $vsp1; 
        }
}
if ( ! function_exists('include_widget')){ 
        function include_widget($filename){
            $CI =& get_instance();
            $parms['unique_widget']     =   $filename;
            $vsp          =   $CI->widget_model->query_widget($parms)->row_array();
            $tg           =   widget_path().'/'.$filename.'.php';
            if($vsp != "" && count($vsp) > 0){
                if(read_file($tg)){
                    include_once $tg;
                }else{
                    include_once $filename.'.php';
                }
            } 
        }
}
if ( ! function_exists('is_active_menu')){
	function is_active_menu($url){
		if(is_array($url)){
			foreach ($url as $menu) {
				if(strpos(uri_string(),$menu))
					return 'active';
			}					
		}
		else{
			if(uri_string()=='' && $url=='')
				return 'active';

			if(uri_string()=='' || $url=='')
				return '';
			return (strpos(uri_string(),$url))?'active':'';			
		}
	}
}