<div class="order-list-item tblevaluetable-responsive table-responsive-m">
<table width="100%">
        <tr>
            <td> 
                <?php 
                    if(count($view) > 0)  { $i=0;
                        echo '<h2>Address</h2>';
                        foreach ($view as $ve){
                            if($i==0){
                                echo 'Name : '.$ve->customer_name.'<br>';
                                echo 'Mobile : '.$ve->customer_mobile.'<br>';
                                echo 'Locality : '.$ve->customeraddress_locality.'<br>';
                                echo 'Address : '.$ve->customeraddress_address.'<br>';
                                echo 'Pincode : '.$ve->customeraddress_pincode.'<br>';
                                $i++;
                                $id=$ve->order_unique;
                            }
                        }
                    }
                    
                ?>
            </td>
            <td style="vertical-align:top;"> 
                <?php 
                    if(count($view) > 0)  { $i=0;
                        $total=0;
                        foreach ($view as $ve){
                            $ot     =   $ve->orderdetail_quantity*$ve->orderdetail_price;
                            $total  =   $ot+$total;
                            }
                            // echo 'Total Amount : '.$total.'<br>';
                            echo 'Payment Mode : '.$ve->order_payment_mode.'<br>';
                            $response = (array)json_decode($ve->order_payment_responce);
                            if($ve->order_payment_mode=='Online' && count($response)>0){
                                echo 'Order status : '.$response['order_status'].'</br>';
                                echo 'Card Name : '.$response['order_card_name'].'</br>';
                                echo 'Bank ref No: '.$response['order_bank_ref_no'].'</br>';
                                //print_r($response);
                            }else if(count($response)>0){
                                 echo 'Order status : ';
                                 if($ve->order_payment_status ==1){
                                        echo "Successfully <br>";
                                }elseif($ve->order_payment_status ==2){
                                        echo "Pending <br>";
                                }elseif($ve->order_payment_status ==3){
                                        echo "Failed <br>";
                                }
                                echo 'Method : '.$response['method'].'</br>';
                                if($response['method']=='wallet'){
                                    echo 'Wallet : '.$response['wallet'].'</br>';
                                }else if($response['method']=='upi'){
                                    echo 'Upi : '.$response['vpa'].'</br>';
                                }else if($response['method']=='card'){
                                    $card   =(array)$response['card'];
                                    echo 'Card TYpe : '.$card['type'].' '.$card['network'].'</br>';
                                }
                                if($response['email']!=''){
                                    echo 'Email : '.$response['email'].'</br>';
                                }
                                echo 'Error Description : '.$response['error_description'].'</br>';
                                //print_r($response);
                            }
                    }
                ?>
            </td>
        </tr>
    </table>
    
    
    <br>
    <h2>Order Details -(<?php echo $id;?>)</h2>
    
</div>
<div class="col-sm-12 m-t-10">
    <?php echo $this->ajax_pagination->create_links();?>
</div>




<?php
    if(count($view) > 0){
        ?>
        <div class="row align-items-center">
            <div class="col-md-12 col-sm-12 iq-mt-20">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center iq-font-green">
                                <th>Product</th>
                                <th>Image</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Delivery Chages</th>
                                <th>Total</th>
                                <th>Delivery Date</th>
                                <th>Delivery Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(count($view) > 0){
                                foreach($view as $ve){ 
                                    if($ve->orderdetail_addon==''){
                                        $speciations = json_decode($ve->orderdetail_speciations);
                                        $imsg   =   $this->config->item("upload_url")."products/photo-not-available.png";
                                        $target_dir =  $this->config->item("upload_url")."products/".$ve->vendorproductimg_name ;
                                        if(@getimagesize($target_dir)){
                                                $imsg   =   $target_dir;
                                        }
                                        $cvso   =   $ve->category_keywords; 
                                        $csvso   =  $ve->product_keywords; 
                                        $pric   =   $ve->orderdetail_quantity*$ve->orderdetail_price;
                                    ?>
        					        <tr>
        					            <td>
        					                <?php echo $ve->product_name;?><br>
        					                <?php //if($speciations->cart_size!=""){echo 'Size : '.$speciations->cart_size.'<br>';}?>
        					                <?php //if($speciations->cart_indug!=""){echo 'Ingredients : '.$speciations->cart_indug.'<br>';}?>
        					                <?php //if($speciations->cart_message_on_cake!=""){echo 'Messgae to Display : '.$speciations->cart_message_on_cake.'<br>';}?>
        					                <?php  //if($speciations->cart_date!=""){echo 'Delivery Date : '.$speciations->cart_date.'<br>';}?>
        					                <?php if($speciations->cart_delivery_id != ""){
        					                            $dta    =   $this->deliverycharges_model->getdeliverychg($speciations->cart_delivery_id);
                                                        if(is_array($dta)&& count($dta)  > 0){
                                                            $timestamp1 = strtotime($dta['deliverychg_end']);
                                                            $end        =  date('H:i', $timestamp1);
                                                            $timestamp  = strtotime($dta['deliverychg_start']);
                                                            $start      =  date('H:i', $timestamp);
                                                            $time       = $start.' - '.$end;
                                                        }
        					                            $time= $start.'-'.$end;
        					                       }
        					                ?>
        					            </td>
        					            <td>
        					                <img src="<?php echo $imsg;?>" alt="product image" class="img img-responsive">
        					            </td>
        					            <td><?php echo $ve->orderdetail_quantity;?></td>
        					            <td>
        					                <div class="shop-price w-100 d-inline-block">
        					                     <?php echo $this->customer_model->currency_change('INR',$ve->orderdetail_price);?>
        									</div> 
        					            </td>
        					            <td>
        					                <div class="shop-price w-100 d-inline-block">
        					                     <?php echo $this->customer_model->currency_change('INR',$ve->orderdetail_delivery_chage);?>
        									</div> 
        					            </td>
        					            <td>
        					                <div class="shop-price w-100 d-inline-block">
        										<?php echo $this->customer_model->currency_change('INR',$ve->orderdetail_delivery_chage+$pric);?>
        									</div> 
        					            </td>
        					            <td>
        					                <div class="shop-price w-100 d-inline-block">
        										<?php echo date("d-m-Y",strtotime($speciations->cart_date));?>
        									</div> 
        					            </td>
        					            <td>
        					                <div class="shop-price w-100 d-inline-block">
        										<?php echo ($time)??'';?>
        									</div> 
        					            </td>
        					        </tr>
        					        
        					        <tr>
        					            <td colspan="8">
        					                
        					                <?php if($speciations->cart_size!=""){echo '<b>Size : </b>'.$speciations->cart_size.'<br>';}?>
        					                <?php if($speciations->cart_indug!=""){echo '<b>Ingredients : </b>'.$speciations->cart_indug.'<br>';}?>
        					                <?php if($speciations->cart_message_on_cake!=""){echo '<b>Messgae to Display : </b>'.$speciations->cart_message_on_cake.'<br>';}?>
        					              
        					                <?php   $pas['whereCondition']    ="prodcu_id = '".$ve->vendorproduct_id."' AND order_id = '".$ve->order_id."'";
													$pas['columns'] = "customer_name,add_date,rating,message";
													$review =  $this->customer_model->getReview($pas);//print_r($review);
													if(!empty($review)){
														echo '<br><br><h4>Review : </h4>';
														echo 'Rating: '.$review['rating'].' star<br>';
														echo 'Message: '.$review['message'].'<br>';
													} 
											?>
											
        					               <?php foreach($view as $v){ 
                                                if($v->orderdetail_addon==$ve->orderdetail_addon_ref){
                                                    $speciations = json_decode($v->orderdetail_speciations);
                                                    $imsg   =   $this->config->item("upload_url")."products/photo-not-available.png";
                                                    $target_dir =  $this->config->item("upload_url")."products/".$v->vendorproductimg_name ;
                                                    if(@getimagesize($target_dir)){
                                                            $imsg   =   $target_dir;
                                                    }
                                                    $cvso   =   $v->category_keywords; 
                                                    $csvso   =  $v->product_keywords; 
                                                    $pric1   =   $v->orderdetail_quantity*$v->orderdetail_price;
                                                ?>
                                                <tr>
                                                    <td colspan="4">
                                                        <h4><b>Addons : </b></h4>
                                                        <img src="<?php echo $imsg;?>" alt="product image" class="img img-responsive" width="100px">
                                                    </td>
                                                    <td colspan="4">
                                                        <?php echo $v->product_name;?><br>
                    					                <?php if($speciations->cart_size!=""){echo 'Size : '.$speciations->cart_size.'<br>';}?>
                    					                <?php if($speciations->cart_indug!=""){echo 'Ingredients : '.$speciations->cart_indug.'<br>';}?>
                    					                <?php if($v->orderdetail_quantity!=""){echo 'Quantity : '.$v->orderdetail_quantity.'<br>';}?>
                    					                <?php if($v->orderdetail_price!=""){echo 'Price : '.$this->customer_model->currency_change('INR',$v->orderdetail_price).'<br>';}?>
                    					                <?php if($pric1!=""){echo 'Total : '.$this->customer_model->currency_change('INR',$pric1).'<br>';}?>
                                                    </td>
                                                </tr>
                                                
                					    <?php } }?>
        			<?php } }
    					    }else{
    					        ?>
    					        <tr>
    					            <td colspan='6'>
    					                <h4 class="iq-font-green"><i class="fa fa-info-circle"></i> No order details are available</h4>
    					            </td>
    					        </tr>
    					        <?php
    					    }
    					    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        <?php
    }else{
        ?>
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-02d871 text-center"><i class="fa fa-info-circle"></i> No wishlist are available</h4>
            </div>
        </div>
        <?php
    }
    ?> 
<div class="col-sm-12 m-t-10">
    <?php echo $this->ajax_pagination->create_links();?>
</div>