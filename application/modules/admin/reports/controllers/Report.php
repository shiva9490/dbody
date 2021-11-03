<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reports extends CI_Controller{
        public function __construct() {
                parent::__construct();
        }
        public function download_excel($i = '0'){ 
            $view           =   $cview  =   array();
            $reportvalue    =   $this->input->get('reportvalue');  
            $kycverified    =   $this->input->get('kycverified');    
            if($kycverified != ""){
                    $coions['kycverified'] =    $conditions['kycverified'] = $kycverified;
            }    
            $datepickerval  =   $this->input->get('datepickerval'); 
            if($datepickerval != ""){
                    $coions['datepickerval']   =   $conditions['datepickerval'] = str_replace("/","-",$datepickerval);
            }     
            if($reportvalue == "user_settlement"){
                $conditions["columns"]  =   "member_full_name as 'Name',accountsettle_total_amount as 'Total Amount',accountsettle_admin_charges as 'Admin Charges',accountsettle_tds_deduction as 'TDS Deduction',accountsettle_royality_deduction as 'Royality Deduction',accountsettle_amount as 'Amount Settlement',member_bank_account_name as 'Account Name',member_bank_name as 'Bank Name',member_bank_account_no as 'Account No',member_branch_name as 'Branch Name',member_ifsc_code as 'IFSC Code',member_micr_code as 'MICR Code'";
                $view       =   $this->member_model->queryWalletSettle($conditions);  
                
                $coions["columns"]  =   "SUM(accountsettle_total_amount) as 'Total Amount',SUM(accountsettle_admin_charges) as 'Admin Charges',SUM(accountsettle_tds_deduction) as 'TDS Deduction',SUM(accountsettle_royality_deduction) as 'Royality Deduction',SUM(accountsettle_amount) as 'Amount Settlement'";
                $cview       =   $this->member_model->queryWalletSettle($coions)->row_array();  
            }
           
//            echo "<pre>";print_r($view);exit;
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
                        $csv_row .= '"'. (($vp->$ayt)?$vp->$ayt:"N/A").'",'; 
                    }
                    $csv_row .= "\n";
                } 
                if(count($cview) > 0){   
                    foreach($ary as $ayt){
                        $csv_row .= '"'. (isset($cview[$ayt])?$cview[$ayt]:"").'",'; 
                    } 
                    $csv_row .= "\n";
                }  
                /* Download as CSV File */
                header('Content-type: application/csv');
                header('Content-Disposition: attachment; filename='.$reportvalue.date('Y-m-d').time().'.csv');
                $vsg    =   $csv_header . $csv_row;
                echo $vsg;exit; 
            }
        } 
}