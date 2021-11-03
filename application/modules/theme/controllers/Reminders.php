<?php
class Reminders extends CI_Controller{
        public function reminder_weekly_alert(){
            $week = date("Y-m-d", strtotime("+1 week"));
            $par['whereCondition'] = "reminder_date = '".$week."'";
            $week_list  = $this->customer_model->viewReminder($par);
            foreach($week_list as $wel){
                $userid = $wel['customer_id'];
                $par['whereCondition'] = "customer_id LIKE '".$userid."'";
                $vues = $this->customer_model->getCustomer($par);
                $occasion  = $this->common_model->get_Occasion($wel['reminder_type']);
                $subject="MiniKart Reminder";
                $message_string = "Hi ".$vues['customer_name'].", This is reminder from Minikart for ".$wel['reminder_title']." ".$occasion[0]['occasion']." on ".date('d M Y', strtotime($wel['reminder_date']))." and your reminder message is ".$wel['reminder_desc'];
                $message_strin = "Hi ".$vues['customer_name'].", This is reminder for ".$wel['reminder_title']." ".$occasion[0]['occasion']." on ".date('d M Y', strtotime($wel['reminder_date']))." and your reminder message is ".$wel['reminder_desc'];
                //print_r($message_string);exit;
               if($vues['customer_mobile'] !=""){
                    $this->mobile_otp->sendmobilemessage($vues['customer_mobile'],$message_string);
                }
                if($vues['customer_email_id'] !=""){
                    
                    $a=$this->common_config->configemail($vues['customer_email_id'],$subject,$message_string);
                }
                if($vues['customer_token'] !=""){
                    $this->common_config->send_pushnotifications($subject,$message_strin,$vues['customer_token']);
                }
            }
        }
        public function reminder_day_alert(){
            $week = date("Y-m-d", strtotime("+1 day"));
            $par['whereCondition'] = "reminder_date = '".$week."'";
            $week_list  = $this->customer_model->viewReminder($par);
            foreach($week_list as $wel){
                $userid = $wel['customer_id'];
                $par['whereCondition'] = "customer_id LIKE '".$userid."'";
                $vues = $this->customer_model->getCustomer($par);
                $occasion  = $this->common_model->get_Occasion($wel['reminder_type']);
                $subject="MiniKart Reminder";
                $message_string = "Hi ".$vues['customer_name'].", This is reminder from Minikart for ".$wel['reminder_title']." ".$occasion[0]['occasion']." on ".date('d M Y', strtotime($wel['reminder_date']))." and your reminder message is ".$wel['reminder_desc'];
                $message_strin = "Hi ".$vues['customer_name'].", This is reminder for ".$wel['reminder_title']." ".$occasion[0]['occasion']." on ".date('d M Y', strtotime($wel['reminder_date']))." and your reminder message is ".$wel['reminder_desc'];
                print_r($vues);
               if($vues['customer_mobile'] !=""){
                   echo $vues['customer_mobile'];
                    $this->mobile_otp->sendmobilemessage($vues['customer_mobile'],$message_string);
                }
                if($vues['customer_email_id'] !=""){
                    
                    $a=$this->common_config->configemail($vues['customer_email_id'],$subject,$message_string);
                }
                if($vues['customer_token'] !=""){
                    $v=$this->common_config->send_pushnotifications($subject,$message_strin,$vues['customer_token']);
                   // print_r($v);
                }
            }
        }
        public function testt(){
            // $par['whereCondition'] = "order_id LIKE 'ORD470' AND order_customer_id='CUST28'";
            //     $order = $this->order_model->vieworderdetails($par);
            //     if(count($order) >0){
            //         $i=0;$total1 = 0;
            //         foreach ($order as $ve){
            //             $id =   $ve->order_unique;
            //             $ot     =   $ve->orderdetail_quantity*$ve->orderdetail_price;
            //             $speciations = json_decode($ve->orderdetail_speciations);
            //             $dta    =   $this->deliverycharges_model->getdeliverychg($speciations->cart_delivery_id);
            //             if(is_array($dta)&& count($dta)  > 0){
            //                 $timestamp1 = strtotime($dta['deliverychg_end']);
            //                 $end        =  date('g:i a', $timestamp1);
            //                 $timestamp  = strtotime($dta['deliverychg_start']);
            //                 $start      =  date('g:i a', $timestamp);
            //                 $time       = $start.' - '.$end;
            //             }
            //             $date= $speciations->cart_date;
            //             $time= ($time)??'';
            //             $imsg   =   $this->config->item("upload_url")."products/photo-not-available.png";
            //             $target_dir =  $this->config->item("upload_url")."products/".$ve->vendorproductimg_name ;
            //             if(@getimagesize($target_dir)){
            //                     $imsg   =   $target_dir;
            //             }
                        
            //             $pric   =   $ve->orderdetail_quantity*$ve->orderdetail_price;
            //             $deli=$this->customer_model->currency_change('INR',$ve->orderdetail_delivery_chage);
            //             $data[$i] = array(
            //                 'pname' => $ve->product_name,
            //                 'image' =>$imsg,
            //                 'id' =>$ve->order_unique,
            //                 'qty'  => $ve->orderdetail_quantity,
            //                 'total' => $pric,
            //                 'delivery'  => $deli,
            //                 'placed'    => date_format(date_create($ve->order_created_on),"d/m/Y g:i a"),
            //                 'price' =>  $ve->orderdetail_price,
            //                 'message'   => $speciations->cart_message_on_cake,
            //                 'Ingredients'   => $speciations->cart_indug,
            //                 'size'  => $speciations->cart_size,
            //                 'date'  => date_format(date_create($date),"d/m/Y"),
            //                 'time'  => $time,
            //                 'Name'=> $ve->customer_name,
            //                 'Mobile'    =>  $ve->customer_mobile,
            //                 'Locality'  =>  $ve->customeraddress_locality,
            //                 'Address'   =>  $ve->customeraddress_address,
            //                 'Pincode'   =>  $ve->customeraddress_pincode,
            //             );
            //             $toemail    = $ve->customer_email_id;
            //             $total1  =   $total1+$ve->orderdetail_delivery_chage+$pric;
            //               $i++;  
            //         }
            //     }
            // 	    $subject= "Order Information -minikart";
            // 	    $messge = '<!DOCTYPE html>
            //                     <html>
                                
            //                     <head>
            //                         <title></title>
            //                         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            //                         <meta name="viewport" content="width=device-width, initial-scale=1">
            //                         <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            //                         <link rel="stylesheet" href="https://www.minikart.in//assets/css/all.min.css">
            //                         <link rel="stylesheet" href="https://www.minikart.in//assets/css/style.css">
            //                         <style type="text/css">
            //                             body,
            //                             table,
            //                             td,
            //                             a {
            //                                 -webkit-text-size-adjust: 100%;
            //                                 -ms-text-size-adjust: 100%;
            //                             }
                                
            //                             table,
            //                             td {
            //                                 mso-table-lspace: 0pt;
            //                                 mso-table-rspace: 0pt;
            //                             }
                                
            //                             img {
            //                                 -ms-interpolation-mode: bicubic;
            //                             }
                                
            //                             img {
            //                                 border: 0;
            //                                 height: auto;
            //                                 line-height: 100%;
            //                                 outline: none;
            //                                 text-decoration: none;
            //                             }
                                
            //                             table {
            //                                 border-collapse: collapse !important;
            //                             }
                                
            //                             body {
            //                                 height: 100% !important;
            //                                 margin: 0 !important;
            //                                 padding: 0 !important;
            //                                 width: 100% !important;
            //                             }
                                
            //                             a[x-apple-data-detectors] {
            //                                 color: inherit !important;
            //                                 text-decoration: none !important;
            //                                 font-size: inherit !important;
            //                                 font-family: inherit !important;
            //                                 font-weight: inherit !important;
            //                                 line-height: inherit !important;
            //                             }
                                
            //                             @media screen and (max-width: 480px) {
            //                                 .mobile-hide {
            //                                     display: none !important;
            //                                 }
                                
            //                                 .mobile-center {
            //                                     text-align: center !important;
            //                                 }
            //                             }
                                
            //                             div[style*="margin: 16px 0;"] {
            //                                 margin: 0 !important;
            //                             }
            //                         </style>
                                
            //                     <body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">
            //                         <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Open Sans, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
            //                             For what reason would it be advisable for me to think about business content? That might be little bit risky to have crew member like them.
            //                         </div>
            //                         <table border="0" cellpadding="0" cellspacing="0" width="100%">
            //                             <tr>
            //                                 <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">
            //                                     <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
            //                                         <tr>
            //                                             <td align="center" valign="top" style="font-size:0; padding: 15px;" bgcolor="#fff">
            //                                                 <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
            //                                                     <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
            //                                                         <tr>
            //                                                             <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;" class="mobile-center">
            //                                                                 <img src="https://www.minikart.in//assets/images/logo.png" alt="logo" style="max-height:20vh;">
            //                                                             </td>
            //                                                         </tr>
            //                                                     </table>
            //                                                 </div>
            //                                                 <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;" class="mobile-hide">
            //                                                     <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
            //                                                         <tr>
            //                                                             <td align="right" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;">
            //                                                                 <table cellspacing="0" cellpadding="0" border="0" align="right">
            //                                                                     <tr>
            //                                                                         <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400;">
            //                                                                             <p style="font-size: 18px; font-weight: 400; margin: 0; color: #000;"><a href="https://www.minikart.in" target="_blank" style="color: #000; text-decoration: none;">Shop &nbsp;</a></p>
            //                                                                         </td>
            //                                                                         <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 24px;"> <a href="https://www.minikart.in" target="_blank" style="color: #ffffff; text-decoration: none;"><img src="https://img.icons8.com/color/48/000000/small-business.png" width="27" height="23" style="display: block; border: 0px;" /></a> </td>
            //                                                                     </tr>
            //                                                                 </table>
            //                                                             </td>
            //                                                         </tr>
            //                                                     </table>
            //                                                 </div>
            //                                             </td>
            //                                         </tr>
            //                                         <tr>
            //                                             <td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
            //                                                 <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
            //                                                     <tr>
            //                                                         <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <img src="https://www.minikart.in//assets/images/check.png" width="125" height="120" style="display: block; border: 0px;" /><br>
            //                                                             <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Hi..! '.$data[0]['Name'].', </h2>
            //                                                         </td>
            //                                                     </tr>
            //                                                     <tr>
            //                                                         <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> 
            //                                                             <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Thank You For Your Order! </h2>
            //                                                         </td>
            //                                                     </tr>
            //                                                   <tr>
            //                                                         <td width="25%" align="right">
            //                                                         <br> Order Placred On : '.$data[0]['placed'].'
            //                                                         </td>
            //                                                     </tr>
            //                                                     <tr>
            //                                                         <td align="left" style="padding-top: 20px;">
            //                                                             <table cellspacing="0" cellpadding="0" border="0" width="100%">
            //                                                                 <tr>
            //                                                                     <td width="75%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;" colspan="2"> Order Confirmation # </td>
            //                                                                     <td width="25%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;"> '.$id.' </td>
            //                                                                 </tr>';
            //                                                                 foreach($data as $d){
            //                                                                   $messge .=  '<tr>
            //                                                                                 <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> <img src="'.$d["image"].'" > </td>
            //                                                                                 <td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> '.$d["pname"].' X '.$d["qty"].' </td>
            //                                                                                 <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> '.$this->customer_model->currency_change('INR',$d["total"]).' </td>
            //                                                                             </tr><tr><td colspan="3">';
            //                                                                     if(!empty($d['message'])){
            //                                                                         $messge .='message to display : '.$d['message'].'<br>';
            //                                                                     }
            //                                                                     if(!empty($d['Ingredients'])){
            //                                                                         $messge .='Ingredients : '.$d['Ingredients'].'<br>';
            //                                                                     }
            //                                                                     if(!empty($d['size'])){
            //                                                                         $messge .='size : '.$d['size'].'<br>';
            //                                                                     }
            //                                                                     $messge .= '</td></tr>';
                                                                                
            //                                                                 }
                                                                            
                                                                            
            //                                                             $messge .='</table>
            //                                                         </td>
            //                                                     </tr>
                                                                
            //                                                     <tr>
            //                                                         <td align="left" style="padding-top: 20px;">
            //                                                             <table cellspacing="0" cellpadding="0" border="0" width="100%">
            //                                                                 <tr>
            //                                                                     <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 13px; font-weight: 400; line-height: 24px; padding: 10px;"> Delivery Charges </td>
            //                                                                     <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 13px; font-weight: 400; line-height: 24px; padding: 10px;"> '.$deli.' </td>
            //                                                                 </tr>
            //                                                                 <tr>
            //                                                                     <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;"> TOTAL </td>
            //                                                                     <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;"> '.$this->customer_model->currency_change('INR',$total1).' </td>
            //                                                                 </tr>
            //                                                             </table>
            //                                                         </td>
            //                                                     </tr>
            //                                                 </table>
            //                                             </td>
            //                                         </tr>
            //                                         <tr>
            //                                             <td align="center" height="100%" valign="top" width="100%" style="padding: 0 35px 35px 35px; background-color: #ffffff;" bgcolor="#ffffff">
            //                                                 <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:660px;">
            //                                                     <tr>
            //                                                         <td align="center" valign="top" style="font-size:0;">
            //                                                             <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">
            //                                                                 <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
            //                                                                     <tr>
            //                                                                         <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
            //                                                                             <p style="font-weight: 800;">Delivery Address</p>
            //                                                                             <p>'.$data[0]["Name"].'<br>'.$data[0]["Mobile"].'<br>'.$data[0]["Locality"].'<br>'.$data[0]["Address"].'<br>'.$data[0]["Pincode"].'<br></p>
            //                                                                         </td>
            //                                                                     </tr>
            //                                                                 </table>
            //                                                             </div>
            //                                                             <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">
            //                                                                 <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
            //                                                                     <tr>
            //                                                                         <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
            //                                                                             <p style="font-weight: 800;">Estimated Delivery</p>
            //                                                                             <p> on '.$data[0]["date"].' , between '.$data[0]["time"].'</p>
            //                                                                         </td>
            //                                                                     </tr>
            //                                                                 </table>
            //                                                             </div>
            //                                                         </td>
            //                                                     </tr>
            //                                                 </table>
            //                                             </td>
            //                                         </tr>
            //                                         <tr>
            //                                             <td align="center" style="  background-color: #ff7361;" bgcolor="#1b9ba3">
            //                                                 <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                                                
            //                                                     <tr>
            //                                                         <td align="center" style="padding: 25px 0 15px 0;">
            //                                                             <table border="0" cellspacing="0" cellpadding="0">
            //                                                                 <tr>
            //                                                                     <td align="center" style="border-radius: 5px;" bgcolor="#66b3b7"> <a href="https://www.minikart.in" target="_blank" style="font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #F44336; padding: 15px 30px; border: 1px solid #F44336; display: block;">Shop Again</a> </td>
            //                                                                 </tr>
            //                                                             </table>
            //                                                         </td>
            //                                                     </tr>
            //                                                 </table>
            //                                             </td>
            //                                         </tr>
            //                                         <tr>
            //                                             <td align="center" style="padding: 35px; background-color: #ffffff;" bgcolor="#ffffff">
            //                                                 <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
            //                                                     <tr>
            //                                                         <td > <img src="https://www.minikart.in//assets/images/logo.png"  width="30%" style="display: block; border: 0px;" /> </td>
            //                                                     </tr>
                                                                
            //                                                     <tr>
            //                                                         <td >
            //                                                         <p> Phone :  +919160708686<br> email : support@minikart.in</br>
            //                                                         </td>
            //                                                     </tr>
            //                                                     <tr>
            //                                                         <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;">
            //                                                         <p class="copyright">Copyright © 2021 <a href="">Minikart</a>. All Rights Reserved.</p>
            //                                                             <p style="font-size: 14px; font-weight: 400; line-height: 20px; color: #777777;"> If you didn\'t order this, please ignore this email or <a href="https://minikart.in" target="_blank" style="color: #777777;">unsusbscribe</a>. </p>
            //                                                         </td>
            //                                                     </tr>
            //                                                 </table>
            //                                             </td>
            //                                         </tr>
            //                                     </table>
            //                                 </td>
            //                             </tr>
            //                         </table>
            //                     </body>
                                
            //                     </html>';print_r($messge);exit;
           $mobile = "8247223093";
           $messge = "Order Placed: Your order for naresh with Order ID KART000477 amounting to ₹6,099.00 has been received. You can expect delivery by ASAP We will send you an update when your order is packed or shipped. Beware of fraudulent calls and messages. Minikart do not ask bank info for offers or demand money.";
            	   $response = $this->mobile_otp->sendmobilemessage($mobile,$messge);
            	   print_r($response);
        }
        
}