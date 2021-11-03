<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Vendor extends CI_Controller{
        public function token(){
            $data   =   $this->vendor_model->jsonencodevalues('0',"Token and Mobile No. are required",'0');
            if($this->input->post("token_value") != "" && $this->input->post("token_mobile") != ""){
                $isn    =   $this->vendor_model->saveToken("Vendor");
                $data   =   $this->vendor_model->jsonencodevalues('2',"Token has been not saved.Please try again.",'0');
                if($isn){
                    $data   =   $this->vendor_model->jsonencodevalues('1',"Token has been saved successfully",'0');
                }
            }
            echo json_encode($data);
        }
        public function splash(){
            $data       =   $this->vendor_model->jsonencodevalues("0","Mobile No. is required",'0');
            if($this->input->post("vendor_mobile") != ""){
                $check      =   $this->vendor_model->checkmobilestatus();
                $data       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0');
                if($check){
                    $cck      =   $this->vendor_model->checkvendorverified();
                    $data     =   $this->vendor_model->jsonencodevalues("3","OTP has been not verified",'0');
                    if($cck){
                        $vck      =   $this->vendor_model->checkvendor_license();
                        $data   =   $this->vendor_model->jsonencodevalues("2","Vendor Mobile No. has been already verified",'0');
                        if(!$vck){
                            $data   =   $this->vendor_model->jsonencodevalues("4","Vendor license documents has been not uploaded",'0');
                        }
                    } 
                } 
            }
            echo json_encode($data);
        }
        public function checkMobile(){ 
            $data       =   $this->vendor_model->jsonencodevalues("0","Mobile No. is required",'0');
            if($this->input->post("vendor_mobile") != ""){
                $check      =   $this->vendor_model->checkmobilestatus();
                $data       =   $this->vendor_model->jsonencodevalues("1","Mobile does not exists",'0');
                if($check){
                    $data   =   array();
                } 
            }
            return $data;
        }
        public function send_otp(){ 
            $json       =   $this->vendor_model->jsonencodevalues("0","Mobile No. is required",'0');
            if($this->input->post("vendor_mobile") != ""){
                $jon        =   $this->vendor_model->sendotp($this->input->post("vendor_mobile"));
                $json       =   $this->vendor_model->jsonencodevalues('1', "OTP has been not sent.Please try again","0");
                if($jon){
                    $json   =   $this->vendor_model->jsonencodevalues('2', "OTP has been sent successfully","0");
                } 
            }
            echo json_encode($json); 
        }
        public function verify_otp(){ 
            $json       =   $this->vendor_model->jsonencodevalues("0","Mobile No. and OTP No are required",'0');
            $mobile     =   $this->input->post("vendor_mobile");
            $otpno      =   $this->input->post("vendor_otp");
            if($mobile != "" && $otpno != ""){
                $jon        =   $this->vendor_model->verifyotp($otpno,$mobile);
                $json       =   $this->vendor_model->jsonencodevalues('1', "OTP has been not verified.Please try again","0");
                if($jon){
                    $json   =   $this->vendor_model->jsonencodevalues('2', "OTP has been verified successfully","0");
                } 
            }
            echo json_encode($json); 
        }  
        public function vendor_create(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("vendor_mobile");
            if($mobile != "" && $this->input->post("vendor_name") != "" && $this->input->post("vendor_state") != "" && $this->input->post("vendor_district") != "" && $this->input->post("vendor_mandal") != "" && $this->input->post("vendor_gramapanchayat") != "" && $this->input->post("vendor_address") != "" && $this->input->post("vendor_pincode") != "" && $this->input->post("vendor_storename") != ""){
                
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile No. already exists",'0'); 
                if(!$check){
                    $ins    =   $this->vendor_model->create_vendor();
                    $json   =   $this->vendor_model->jsonencodevalues("3","Vendor has been not created.Please try again.",'0');
                    if($ins){
                        $json   =   $this->vendor_model->jsonencodevalues("2","Vendor has been created successfully",'0');
                    }
                }
            }
            echo json_encode($json);
        }
        public function vendor_license(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("vendor_mobile");
            if($mobile != "" && $this->input->post("vendor_license_name") != ""){
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile does not exists",'0'); 
                if($check){
                    $ins    =   $this->vendor_model->vendor_license();
                    $json   =   $this->vendor_model->jsonencodevalues("3","Vendor license has been not uploaded.Please try again.",'0');
                    if($ins){
                        $json   =   $this->vendor_model->jsonencodevalues("2","Vendor license has been uploaded successfully",'0');
                    }
                }
            }
            echo json_encode($json);
        }
        public function vendor_category(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("vendor_mobile");
            if($mobile != ""){ 
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile does not exists",'0'); 
                if($check){
                    $ins    =   $this->vendor_model->view_category();
                    $json   =   $this->vendor_model->jsonencodevalues("2","Category data not available",'0');
                    if(count($ins) > 0){
                        $json   =   $this->vendor_model->jsonencodevalues("3",$ins,'0');
                    }
                }
            }
            echo json_encode($json);
        }
        public function view_sub_vendor_category(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("vendor_mobile");
            if($mobile != ""){ 
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile does not exists",'0'); 
                if($check){
                    $ins    =   $this->vendor_model->vendor_subcategory();
                    $json   =   $this->vendor_model->jsonencodevalues("2","Sub Category data not available",'0');
                    if(count($ins) > 0){
                        $json   =   $this->vendor_model->jsonencodevalues("3",$ins,'0');
                    }
                }
            }
            echo json_encode($json);
        }
        public function view_vendor_category(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("vendor_mobile");
            if($mobile != ""){ 
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile does not exists",'0'); 
                if($check){
                    $ins    =   $this->vendor_model->vendor_category();
                     $json   =   $this->vendor_model->jsonencodevalues("2","Category data not available",'0');
                    if(count($ins) > 0){
                        $json   =   $this->vendor_model->jsonencodevalues("3",$ins,'0');
                    } 
                }
            }
            echo json_encode($json);
        }
        public function states(){
            $dta    =   $this->common_model->getstates("95");
            $data   =   $this->vendor_model->jsonencodevalues('1',"No States are available",'0');
            if(count($dta) > 0){
                $data   =   $this->vendor_model->jsonencodevalues('0',$dta,'0');
            }
            echo json_encode($data);
        }
        public function mandals(){
            $json       =   $this->vendor_model->jsonencodevalues("0","District is required",'0');
            $district_id     =   $this->input->post("district_id");
            if($district_id != ""){ 
                $dta    =   $this->common_model->getmandals($district_id);
                $json   =   $this->vendor_model->jsonencodevalues('1',"No Mandals are available",'0');
                if(count($dta) > 0){
                    $json   =   $this->vendor_model->jsonencodevalues('2',$dta,'0');
                }
            }
            echo json_encode($json);
        }
        public function gramapanchyats(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Mandal is required",'0');
            $mandal_id     =   $this->input->post("mandal_id");
            if($mandal_id != ""){ 
                $dta    =   $this->common_model->getgramapanchyat($mandal_id);
                $json   =   $this->vendor_model->jsonencodevalues('1','No Gramapanchyats are available','0');
                if(count($dta) > 0){
                    $json   =   $this->vendor_model->jsonencodevalues('2',$dta,'0');
                }
            }
            echo json_encode($json);
        }
        public function category_create(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            if($this->input->post("vendor_mobile") != ""){ 
                $msh    =   $this->category_model->checkuniquecategory();
                $json   =   $this->vendor_model->jsonencodevalues("3","Category has been already exists",'0');
                if(!$msh){
                    $jssn   =   $this->category_model->create_category();
                    $json   =   $this->vendor_model->jsonencodevalues("1","Category has been not created.Please try again",'0');
                    if($jssn){
                        $json       =   $this->vendor_model->jsonencodevalues("2","Category has been created successfully",'0');
                    }
                }
            }
            echo json_encode($json);
        }
        public function subcategory_create(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            if($this->input->post("vendor_mobile") != "" && $this->input->post("category") != "" && $this->input->post("sub_category") != ""){ 
                $msh    =   $this->category_model->checkuniquesubcategory();
                $json   =   $this->vendor_model->jsonencodevalues("3","Sub Category has been already exists",'0');
                if(!$msh){
                    $jssn   =   $this->category_model->create_sub_category();
                    $json   =   $this->vendor_model->jsonencodevalues("1","Sub Category has been not created.Please try again",'0');
                    if($jssn){
                        $json       =   $this->vendor_model->jsonencodevalues("2","Sub Category has been created successfully",'0');
                    }
                }
            }
            echo json_encode($json);
        }
        public function view_profile(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("vendor_mobile");
            if($mobile != ""){ 
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile does not exists",'0'); 
                if($check){
                    $ins    =   $this->vendor_model->view_profile($mobile);
                    $json   =   $this->vendor_model->jsonencodevalues("2",$ins,'0');
                }
            }
            echo json_encode($json);
        }
        public function update_profile(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("vendor_mobile");
            if($mobile != "" && $this->input->post("vendor_name") != "" && $this->input->post("vendor_state") != "" && $this->input->post("vendor_district") != "" && $this->input->post("vendor_mandal") != "" && $this->input->post("vendor_gramapanchayat") != "" && $this->input->post("vendor_address") != "" && $this->input->post("vendor_pincode") != "" && $this->input->post("vendor_storename") != ""){
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile does not exists",'0'); 
                if($check){
                    $ins    =   $this->vendor_model->update_profile($mobile);
                    $json   =   $this->vendor_model->jsonencodevalues("3","Vendor details has been not updated.Please try again.",'0');
                    if($ins){
                        $json   =   $this->vendor_model->jsonencodevalues("2","Vendor details has been updated succcesfully",'0');
                    }
                }
            }
            echo json_encode($json);
        }
        public function logout(){
                $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
                $mobile     =   $this->input->post("vendor_mobile");
                if($mobile != ""){  
                    $this->session->sess_destroy(); 
                    $json   =   $this->vendor_model->jsonencodevalues("1","Logged out succcesfully",'0'); 
                }
                echo json_encode($json);
        }
        public function measures(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("vendor_mobile");
            if($mobile != ""){ 
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile does not exists",'0'); 
                if($check){
                    $ins    =   $this->vendor_model->view_measures();
                    $json   =   $this->vendor_model->jsonencodevalues("2","No measures are available",'0');
                    if(count($ins) > 0){
                        $json   =   $this->vendor_model->jsonencodevalues("3",$ins,'0');
                    }
                }
            }
            echo json_encode($json);
        }
        public function products(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("vendor_mobile");
            $keywords     =   $this->input->post("keywords");
            if($mobile != "" && $keywords != ""){ 
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile does not exists",'0'); 
                if($check){
                    $ins    =   $this->vendor_model->view_products();
                    $json   =   $this->vendor_model->jsonencodevalues("2","No products are available",'0');
                    if(count($ins) > 0){
                        $json   =   $this->vendor_model->jsonencodevalues("3",$ins,'0');
                    }
                }
            }
            echo json_encode($json);
        }
        public function product_create(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            if($this->input->post("vendor_mobile") != "" && $this->input->post("category") != "" && $this->input->post("sub_category") != "" && $this->input->post("product_name") != ""){ 
                $jssn   =   $this->vendor_model->product_create();
                $json   =   $this->vendor_model->jsonencodevalues("1","Product has been not created.Please try again",'0');
                if($jssn){
                    $json       =   $this->vendor_model->jsonencodevalues("2","Product has been created successfully",'0');
                }
            }
            echo json_encode($json);
        }
        public function product_view(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            if($this->input->post("vendor_mobile") != ""){ 
                $jssn   =   $this->vendor_model->product_view();
                $json   =   $this->vendor_model->jsonencodevalues("1","Product data are not available",'0');
                if(count($jssn) > 0){
                    $json       =   $this->vendor_model->jsonencodevalues("2",$jssn,'0');
                }
            }
            echo json_encode($json);
        }
        public function sub_category(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("vendor_mobile");
            if($mobile != "" && $this->input->post("category") != ""){ 
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile does not exists",'0'); 
                if($check){
                    $ins    =   $this->vendor_model->view_subcategory();
                    $json   =   $this->vendor_model->jsonencodevalues("2","Sub Category data not available",'0');
                    if(count($ins) > 0){
                        $json   =   $this->vendor_model->jsonencodevalues("3",$ins,'0');
                    }
                }
            }
            echo json_encode($json);
        } 
        public function product_update(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $vendorproduct_id     =   $this->input->post("vendorproduct_id");
            $mobile     =   $this->input->post("vendor_mobile");
            if($mobile != "" && $vendorproduct_id != ""){
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile does not exists",'0'); 
                if($check){
                    $pr     =   $this->vendor_model->getVendorproductview($vendorproduct_id);
                    $json   =   $this->vendor_model->jsonencodevalues("4","Vendor product does not exists.",'0');
                    if($pr){
                        $ins    =   $this->vendor_model->product_update($vendorproduct_id);
                        $json   =   $this->vendor_model->jsonencodevalues("3","Vendor details has been not updated.Please try again.",'0');
                        if($ins){
                            $json   =   $this->vendor_model->jsonencodevalues("2","Vendor details has been updated succcesfully",'0');
                        }
                    }
                }
            }
            echo json_encode($json);
        }
        public function product_delete(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $vendorproduct_id     =   $this->input->post("vendorproduct_id");
            $mobile     =   $this->input->post("vendor_mobile");
            if($mobile != "" && $vendorproduct_id != ""){
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile does not exists",'0'); 
                if($check){
                    $pr     =   $this->vendor_model->getVendorproductview($vendorproduct_id);
                    $json   =   $this->vendor_model->jsonencodevalues("4","Vendor product does not exists.",'0');
                    if($pr){
                        $ins    =   $this->vendor_model->product_delete($vendorproduct_id);
                        $json   =   $this->vendor_model->jsonencodevalues("3","Vendor details has been not deleted.Please try again.",'0');
                        if($ins){
                            $json   =   $this->vendor_model->jsonencodevalues("2","Vendor details has been deleted succcesfully",'0');
                        }
                    }
                }
            }
            echo json_encode($json);
        }
        public function orders(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("vendor_mobile"); 
            if($mobile != ""){ 
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile does not exists",'0'); 
                if($check){
                    $ins    =   $this->vendor_model->view_orders();
                    $json   =   $this->vendor_model->jsonencodevalues("2","No orders are available",'0');
                    if(count($ins) > 0){
                        $json   =   $this->vendor_model->jsonencodevalues("3",$ins,'0');
                    }
                }
            }
            echo json_encode($json);
        }
        public function order_details(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $vendorproduct_id     =   $this->input->post("order_unique");
            $mobile     =   $this->input->post("order_unique");
            if($mobile != "" && $vendorproduct_id != ""){
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile does not exists",'0'); 
                if($check){
                    $ins    =   $this->vendor_model->view_order_details();
                    $json   =   $this->vendor_model->jsonencodevalues("2","No orders are available",'0');
                    if(count($ins) > 0){
                        $json   =   $this->vendor_model->jsonencodevalues("3",$ins,'0');
                    }
                }
            }
            echo json_encode($json);
        }
        public function product_info(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $vendorproduct_id     =   $this->input->post("vendorproduct_id");
            $mobile     =   $this->input->post("vendor_mobile");
            if($mobile != "" && $vendorproduct_id != ""){
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile does not exists",'0'); 
                if($check){
                    $pr     =   $this->vendor_model->getVendorproductview($vendorproduct_id);
                    $json   =   $this->vendor_model->jsonencodevalues("3","Vendor product does not exists.",'0');
                    if($pr){  
                        $data    =   array( 
                            "product_details"   =>  $this->customer_model->customer_view_product(),
                            "product_images"    =>  $this->customer_model->customer_view_images()
                        ); 
                        $json   =   $this->vendor_model->jsonencodevalues("2",$data,'0');  
                    }
                }
            }
            echo json_encode($json);
        }
        public function packages(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("vendor_mobile"); 
            if($mobile != ""){ 
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile does not exists",'0'); 
                if($check){
                    $ins    =   $this->vendor_model->view_packages();
                    $json   =   $this->vendor_model->jsonencodevalues("2","No Packages are available",'0');
                    if(count($ins) > 0){
                        $json   =   $this->vendor_model->jsonencodevalues("3",$ins,'0');
                    }
                }
            }
            echo json_encode($json);
        }
        public function my_packages(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("vendor_mobile"); 
            if($mobile != ""){ 
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile does not exists",'0'); 
                if($check){
                    $ins    =   $this->vendor_model->my_packages();
                    $json   =   $this->vendor_model->jsonencodevalues("2","No Packages are available",'0');
                    if(count($ins) > 0){
                        $json   =   $this->vendor_model->jsonencodevalues("3",$ins,'0');
                    }
                }
            }
            echo json_encode($json);
        }
        public function select_package(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("vendor_mobile"); 
            if($mobile != "" && $this->input->post("package_id") != "" && $this->input->post("pay_mode") != ""){ 
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile does not exists",'0'); 
                if($check){
                    $ins    =   $this->vendor_model->select_package();
                    $json   =   $this->vendor_model->jsonencodevalues("2","Not checkout any package",'0');
                    if(($ins)){
                        $json   =   $this->vendor_model->jsonencodevalues("3","Payment has been done for the Package selected",'0');
                    }
                }
            }
            echo json_encode($json);
        }
        public function banner_upload(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("vendor_mobile"); 
            if($mobile != "" && $this->input->post("package_id") != "" && count($_FILES) > 0){ 
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile does not exists",'0'); 
                if($check){
                    $ins    =   $this->vendor_model->banner_upload();
                    $json   =   $this->vendor_model->jsonencodevalues("2","Banner has been not uploaded.Please try again",'0');
                    if(($ins)){
                        $json   =   $this->vendor_model->jsonencodevalues("3","Banner has been uploaded successfully",'0');
                    }
                }
            }
            echo json_encode($json);
        }
        public function update_banner_upload(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("vendor_mobile"); 
            if($mobile != "" && $this->input->post("banner_id") != "" && count($_FILES) > 0){ 
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile does not exists",'0'); 
                if($check){
                    $ins    =   $this->vendor_model->update_banner();
                    $json   =   $this->vendor_model->jsonencodevalues("2","Banner has been not uploaded.Please try again",'0');
                    if(($ins)){
                        $json   =   $this->vendor_model->jsonencodevalues("3","Banner has been uploaded successfully",'0');
                    }
                }
            }
            echo json_encode($json);
        } 
        public function banner_list(){
            $json       =   $this->vendor_model->jsonencodevalues("0","Some fields are required",'0');
            $mobile     =   $this->input->post("vendor_mobile"); 
            if($mobile != ""){
            // if($mobile != "" && $this->input->post("package_id") != "" && count($_FILES) > 0){ 
                $check      =   $this->vendor_model->checkmobilestatus();
                $json       =   $this->vendor_model->jsonencodevalues("1","Vendor Mobile does not exists",'0'); 
                if($check){
                    $ins    =   $this->vendor_model->banner_list();
                    $json   =   $this->vendor_model->jsonencodevalues("2","Banner has been not uploaded.Please try again",'0');
                    if(count($ins) > 0){
                        $json   =   $this->vendor_model->jsonencodevalues("3",$ins,'0');
                    }
                }
            }
            echo json_encode($json);
        }
}