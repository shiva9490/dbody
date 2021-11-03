<?php 
$country =  $this->session->userdata("currency_code");
?>
<section class="overview-block-ptb iq-over-black-30 jarallax iq-breadcrumb3 text-left iq-font-white" style="background-image: url('<?php echo base_url();?>uploads/bg.png'); background-position: center center; background-repeat: no-repeat; background-size: cover;">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6 col-sm-12">
				<div class="iq-mb-0">
					<h2 class="iq-font-white iq-tw-6">Order Details</h2>
				</div>
			</div>
			<div class="col-lg-6 col-sm-12">
				<nav aria-label="breadcrumb" class="text-right">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>"><i class="ion-android-home"></i> Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Order Details</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>

<div class="main-content">
	<section class="overview-block-ptb iq-cartbox">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				    <?php $this->load->view("theme/success_error");?>
					<div class="total-box">
						<div class="row align-items-center">
							<div class="col-md-12 col-sm-12">
								<h6 class="float-left"><b>Order Details</b> (<?php echo count($view);?> Items)</h6>
							</div>
						</div>
					</div>
				    <div class="row align-items-center">
						<h6 class="col-md-12 col-sm-12 iq-mt-20"><b>Order Unique : <?php echo $order["order_unique"];?></b></h6>
                        <div class="col-md-6 col-sm-6 iq-mt-20">
                            Payment Mode : <?php echo $order["order_payment_mode"];?>
                            <br/>Order Date : <?php echo $order["order_date"];?>
                            <br/>Order Date : <?php echo $order["order_time"];?>
                        </div>
                        <div class="col-md-6 col-sm-6 iq-mt-20">
                            <?php
                                $par['whereCondition']   =   "customeraddress_id = '".$order["order_address_id"]."'";
                                $ordedress_id   =   $this->customer_model->getCustomeraddress($par);
                                //echo '<pre>';print_r($ordedress_id);exit;
                            ?>
                            <strong>Address :</strong>
                            <addr>
                                <?php echo $ordedress_id["customeraddress_fullname"].'<br>'.
                                    ($ordedress_id["customeraddress_mobile"] !="")?$ordedress_id["customeraddress_mobile"]:''.',
                                    '.($ordedress_id["customeraddress_pincode"]!="")?$ordedress_id["customeraddress_pincode"]:'';?><br/>
                                <?php echo ($ordedress_id["customeraddress_locality"]!="")?$ordedress_id["customeraddress_locality"]:''.",
                                <br> ".($ordedress_id["customeraddress_address"]!="")?$ordedress_id["customeraddress_address"]:'';?>
                            </addr>
                        </div>
                    </div>
					<?php
                    $mobile     =   $this->session->userdata("otpmobileno");
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
                        					                <a href="<?php echo base_url("Product-View/".$csvso);?>"><?php echo $ve->product_name;?></a><br>
                        					                <?php if($speciations->cart_size!=""){echo 'Size : '.$speciations->cart_size.'<br>';}?>
                        					                <?php if($speciations->cart_indug!=""){echo 'Ingredients : '.$speciations->cart_indug.'<br>';}?>
                        					                <?php if($speciations->cart_message_on_cake!=""){echo 'Messgae on Cake : '.$speciations->cart_message_on_cake.'<br>';}?>
                        					                <?php if($speciations->cart_date!=""){echo 'Delivery Date : '.$speciations->cart_date.'<br>';}?>
                        					                <?php if($speciations->cart_delivery_id != ""){
                        					                            $dta    =   $this->deliverycharges_model->getdeliverychg($speciations->cart_delivery_id);
                                                                        if(is_array($dta)&& count($dta)  > 0){
                                                                            $timestamp1 = strtotime($dta['deliverychg_end']);
                                                                            $end        =  date('H:i', $timestamp1);
                                                                            $timestamp  = strtotime($dta['deliverychg_start']);
                                                                            $start      =  date('H:i', $timestamp);
                                                                            $time       = $start.' - '.$end;
                                                                        }
                        					                            echo 'Delivery Time : '.$start.'-'.$end;
                        					                       }
                        					                       $pas['whereCondition']    ="prodcu_id = '".$ve->vendorproduct_id."' AND order_id = '".$ve->order_id."'";
																	$pas['columns'] = "customer_name,add_date,rating,message";
																	$review =  $this->customer_model->getReview($pas);//print_r($review);
																	if(!empty($review)){
																		echo '<br><br><h4>Your Review : </h4>';
																		echo 'Rating: '.$review['rating'].' star<br>';
																		echo 'Message: '.$review['message'].'<br>';
																	}else{
                        					                ?>
                        					                <button onclick="ratiing('<?php echo $ve->vendorproduct_id;?>','<?php echo $ve->order_id;?>')" class="btn btn-success">Rate Product</button>
														   <?php }?>    
                        					            </td>
                        					            <td>
                        					                <img src="<?php echo $imsg;?>" alt="product image" class="img img-responsive">
                        					            </td>
                        					            <td><?php echo $ve->orderdetail_quantity;?></td>
                        					            <td>
                        					                <div class="shop-price w-100 d-inline-block">
                        					                     <?php echo $this->customer_model->currency_change($country,$ve->orderdetail_price);?>
                        									</div> 
                        					            </td>
                        					            <td>
                        					                <div class="shop-price w-100 d-inline-block">
                        					                     <?php echo $this->customer_model->currency_change($country,$ve->orderdetail_delivery_chage);?>
                        									</div> 
                        					            </td>
                        					            <td>
                        					                <div class="shop-price w-100 d-inline-block">
                        										<?php echo $this->customer_model->currency_change($country,$ve->orderdetail_delivery_chage+$pric);?>
                        									</div> 
                        					            </td>
                        					        </tr>
                        					        <?php
                        					        foreach($view as $v){
                                                    if($v->orderdetail_addon==$ve->orderdetail_addon_ref){
                                                        $speciations = json_decode($v->orderdetail_speciations);
                                                        $imsg   =   $this->config->item("upload_url")."products/photo-not-available.png";
                                                        $target_dir =  $this->config->item("upload_url")."products/".$v->vendorproductimg_name ;
                                                        if(@getimagesize($target_dir)){
                                                                $imsg   =   $target_dir;
                                                        }
                                                        $cvso   =   $v->category_keywords; 
                                                        $csvso   =  $v->product_keywords; 
                                                        $pric   =   $v->orderdetail_quantity*$v->orderdetail_price;
                                                    ?>
                        					        <tr>
                        					            <td>
                        					                Addon
                        					            </td>
                        					            <td>
                        					                <img src="<?php echo $imsg;?>" alt="product image" class="img img-responsive" width="100px">
                        					                 <a href="<?php echo base_url("Product-View/".$csvso);?>"><?php echo $v->product_name;?></a><br>
                        					                <?php if($speciations->cart_size!=""){echo 'Size : '.$speciations->cart_size.'<br>';}?>
                        					                <?php if($speciations->cart_indug!=""){echo 'Ingredients : '.$speciations->cart_indug.'<br>';}?>
                        					                
                        					            </td>
                        					            <td><?php echo $v->orderdetail_quantity;?></td>
                        					            <td>
                        					                <div class="shop-price w-100 d-inline-block">
                        					                     <?php echo $this->customer_model->currency_change($country,$v->orderdetail_price);?>
                        									</div> 
                        					            </td>
                        					            <td>
                        					                <div class="shop-price w-100 d-inline-block">
                        					                     <?php echo $this->customer_model->currency_change($country,$v->orderdetail_delivery_chage);?>
                        									</div> 
                        					            </td>
                        					            <td>
                        					                <div class="shop-price w-100 d-inline-block">
                        										<?php echo $this->customer_model->currency_change($country,$v->orderdetail_delivery_chage+$pric);?>
                        									</div> 
                        					            </td>
                        					        </tr>
                    					    <?php }}
                    					    }} 
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
				</div>
			</div>
		</div>
	</section>
</div>
<script>
    function ratiing(x,y){
		document.getElementById('vendor_p_id').value = x;
		document.getElementById('order_o_id').value = y;
        document.getElementById("Review_rate").classList.add('open-form');
    }
	function clloseForm(){
		alert('hello');
        document.getElementById("Review_rate").classList.remove('open-form');
    }
</script>