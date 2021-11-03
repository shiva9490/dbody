<?php
require_once APPPATH .'../vendor/autoload.php';
class Mpdf { 
    public function indexval(){ 
        $mpdf = new \Mpdf\Mpdf(); 
        return $mpdf;
    } 
}