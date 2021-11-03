<?php
    $country    =   $this->session->userdata("currency_code");
    $vtoal  =   "0";
    $rtotl     =   $this->cart->contents();
    $coupon_oll = $this->session->userdata("coupon_code");
    $coupon_old =   ($coupon_oll['coupon'])??'';
    $mobile     =   $this->session->userdata("customer_mobile");
    $total     =    $this->cart->total();
	$coupon_data='';
	if($coupon_old!=""&&$mobile!=""&&$total!=""){
    $r  =   (array)json_decode($this->coupon_model->Coupon_check($coupon_old,$mobile,$total));
		if($r['status']=="4"){
			$coupon_data = (array)$r['status_messsage'];
		}else{
			$coupon_data='';
		}
	}
    $coupon = ($coupon_data['coupon'])??''; $rirl   =   "0";
    //print_r($r['status']);exit;
    //$coupon_data = $this->session->userdata("coupon_code");
    if(count($rtotl) > 0){        
        $rirl   =   "0";$i=1;
        foreach($rtotl as $fr){
            //echo '<pre?';print_r($fr);exit;
            if($fr['addon_id']==''){
            $vtoal      =  "0";
            $vsso       =  $fr['name'];
            $delivery   =  isset($fr['delamount'])?$fr['delamount']:'0';
           
           // added coupon logic
            if(!empty($coupon_data)){
                if(in_array($fr['prodid'],$coupon_data['products_applicable']) || $coupon_data['coupon_applicable'] == 'All') {
                    if($coupon_data['coupon_type']=='Percentage'){
                        $discount   =  ($fr["price"]/100)*$coupon_data['coupon_discount'];
                    }else if($coupon_data['coupon_type']=='Amount'){
                        $discount   =   $coupon_data['coupon_discount'];
                    }else{
                        $discount   =   0;
                    }
                }else{
                    $discount   =   0;
                }
            }else{
                $discount   =   0;
            }
            $total      =  $fr["qty"]*($fr["price"]-$discount) ;
            $rirl   +=  $fr["qty"]*((float)$fr["price"]-(float)$discount)+(float)$delivery;
            $imsg           =   $this->config->item("upload_url")."products/photo-not-available.png";
            $target_dir     =   $fr["image"];
            if(@getimagesize($target_dir)){
                    $imsg   =   $target_dir;
            }
    ?>
    <div class="cart-item sitebar-cart bg-color-white box-shadow p-3 p-lg-5 border-radius5">
        <div class="cart-product-container">
            <div class="cart-product-item">
                <div class="row align-items-center">
                    <div class="col-4 p-0">
                        <div class="thumb">
                            <a onclick="openModal($(this),'<?php echo base_url().'Product-Popup-Detaiils/'.$fr['id'];?>')"><img src="<?php echo $imsg;?>" alt="products"></a>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="product-content">
                            <a href="<?php echo base_url("Product-View/".$vsso);?>" class="product-title"><?php echo $fr["name"];?></a>
                            <div class="product-cart-info">
                                <?php if($fr['type'] !=''){echo 'Width : '.$fr['size'].'<br>';}?>
                                <?php if($fr['type'] !=''){echo 'Type : '.$fr['type'].'<br>';}?>
                                <?php if($fr['deldate'] !=''){echo 'Delivery : '.$fr['deldate'].'<br>';}?>
                                <?php if($fr['deltime'] !=''){echo 'Time : '.$fr['deltime'].'<br>';}?>
                                <?php echo 'Delivery Amount :'.$this->customer_model->currency_change($country,$fr['delamount']);?><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="price-increase-decrese-group d-flex">
                            <span class="decrease-btn">
                                <button type="button"
                                    class="btn quantity-left-minus dsc<?php echo $fr['rowid'];?>" data-type="minus" data-field="" valprp='0' prodrowid="<?php echo $fr['rowid'];?>" onclick="updatecarts(jQuery(this))" prodid="<?php echo $fr["id"];?>">-
                                </button> 
                            </span>
                            <?php
                            $price  = $this->customer_model->currency_change($country,($fr["price"]-$discount));
                            $price = preg_replace('/[^0-9.]+/', '', $price);
                            ?>
                            <input type="hidden" class="priceval<?php echo $fr["id"];?>" value="<?php echo $price ;?>"/>
                            <input type="text" class="form-controls input-number qty qtyvals<?php echo $fr["id"];?> text" title="Qty" value="<?php echo $fr['qty'];?>" name="cart[<?php echo $fr['rowid'] ?>][qty]"  valprp='2' prodrowid="<?php echo $fr['rowid'];?>" onchange="updatecarts(jQuery(this))" prodid="<?php echo $fr["id"];?>">
                            <span class="increase">
                            <button type="button" class="btn quantity-right-plus" data-type="plus" data-field="" valprp='1' min="1"prodrowid="<?php echo $fr['rowid'];?>" onclick="updatecarts(jQuery(this))" prodid="<?php echo $fr["id"];?>">+</button>
                            </span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="product-price">
                            <span class="ml-4"><span class="amount amounval<?php echo $fr['id'];?>"><?php echo $this->customer_model->currency_change($country,$total); ?></span></span>
                        </div>
                    </div>
                </div>
                <?php foreach($rtotl as $ff){
                        //echo '<pre?';print_r($fr);exit;
                        if($ff['addon_id']==$fr['rowid']){
                        $vtoal      =  "0";
                        $vsso       =  $ff['name'];
                        $delivery   =  isset($ff['delamount'])?$ff['delamount']:'0';
                       
                       // added coupon logic
                        if(!empty($coupon_data)){
                            if(in_array($ff['prodid'],$coupon_data['products_applicable']) || $coupon_data['coupon_applicable'] == 'All') {
                                if($coupon_data['coupon_type']=='Percentage'){
                                    $discount   =  ($ff["price"]/100)*$coupon_data['coupon_discount'];
                                }else if($coupon_data['coupon_type']=='Amount'){
                                    $discount   =   $coupon_data['coupon_discount'];
                                }else{
                                    $discount   =   0;
                                }
                            }else{
                                $discount   =   0;
                            }
                        }else{
                            $discount   =   0;
                        }
                        $total      =  $ff["qty"]*($ff["price"]-$discount) ;
                        $rirl   +=  $ff["qty"]*($ff["price"]-$discount)+$delivery;
                        $imsg           =   $this->config->item("upload_url")."products/photo-not-available.png";
                        $target_dir     =   $ff["image"];
                        if(@getimagesize($target_dir)){
                                $imsg   =   $target_dir;
                        }
                ?>
                    <div class="cart-product-container">
                        <div class="cart-product-item">
                            <div class="row align-items-center">
                                <div class="col-4 p-0">
                                    <div class="thumb">
                                        <a onclick="openModal($(this),'<?php echo base_url().'Product-Popup-Detaiils/'.$ff['id'];?>')"><img src="<?php echo $imsg;?>" alt="products"></a>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="product-content">
                                        <a href="<?php echo base_url("Product-View/".$vsso);?>" class="product-title"><?php echo $ff["name"];?></a>
                                        <div class="product-cart-info">
                                            <?php if($ff['type'] !=''){echo 'Width : '.$ff['size'].'<br>';}?>
                                            <?php if($ff['type'] !=''){echo 'Type : '.$ff['type'].'<br>';}?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="price-increase-decrese-group d-flex">
                                        <span class="decrease-btn">
                                            <button type="button"
                                                class="btn quantity-left-minus dsc<?php echo $ff['rowid'];?>" data-type="minus" data-field="" valprp='0' prodrowid="<?php echo $ff['rowid'];?>" onclick="updatecarts(jQuery(this))" prodid="<?php echo $ff["id"];?>">-
                                            </button> 
                                        </span>
                                        <?php
                                        $price  = $this->customer_model->currency_change($country,($ff["price"]-$discount));
                                        $price = preg_replace('/[^0-9.]+/', '', $price);
                                        ?>
                                        <input type="hidden" class="priceval<?php echo $ff["id"];?>" value="<?php echo $price ;?>"/>
                                        <input type="text" class="form-controls input-number qty qtyvals<?php echo $ff["id"];?> text" title="Qty" value="<?php echo $ff['qty'];?>" name="cart[<?php echo $ff['rowid'] ?>][qty]"  valprp='2' prodrowid="<?php echo $ff['rowid'];?>" onchange="updatecarts(jQuery(this))" prodid="<?php echo $ff["id"];?>">
                                        <span class="increase">
                                        <button type="button" class="btn quantity-right-plus" data-type="plus" data-field="" valprp='1' min="1"prodrowid="<?php echo $ff['rowid'];?>" onclick="updatecarts(jQuery(this))" prodid="<?php echo $ff["id"];?>">+</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="product-price">
                                        <span class="ml-4"><span class="amount amounval<?php echo $ff['id'];?>"><?php echo $this->customer_model->currency_change($country,$total); ?></span></span>
                                    </div>
                                </div>
                            </div>
                            </div>
                   </div>
                   <?php }}?>
                
            </div>
            <?php }  } }?>
        </div>
        <div class="cart-footer">
        <div class="cart-total">
            <span>Have a Coupon ? <a> Click here </a></span> <br>
                <p class="total-price d-flex justify-content-between">
                    <input type="text" class="form-control" id="coupon" name="coupon" value="<?php echo $coupon;?>"/>
                    <button class="btn btn-success" onclick="applyCoupon()" id="coupon_btn">Apply </button>
                    <div id="coupon_error">
                        <?php if(isset($r['status']) && $r['status']=="4"){
                            echo '<span class="text-success"><i class="fa fa-check" aria-hidden="true"></i> Coupon Applied</span>';
                        }else if(!empty($coupon)){
                            echo '<span class="text-danger"><i class="fa fa-times" aria-hidden="true"></i> '.$this->session->userdata("coupon_error").'</span>';
                        }?>
                    </div>
                </p><br>
                
            </div>
            <div class="cart-total">
                <p class="total-price d-flex justify-content-between">
                    <span>Total</span> 
                    <span><span class="amount price2"><?php echo $vtoal = $this->customer_model->currency_change($country,$rirl);?></span></span>
                </p>
            </div>
            <?php 
                $userid = $this->session->userdata('customer_id');
                $par['whereCondition'] = "customer_id = '".$userid."'";
                $user_details = $this->customer_model->getCustomer($par);
                $name   = isset($user_details['customer_name'])?$user_details['customer_name']:'';
                $email  = isset($user_details['customer_email_id'])?$user_details['customer_email_id']:'';
                $phone  = isset($user_details['customer_mobile'])?$user_details['customer_mobile']:'';
            ?>
            <?php 
                if($country == "INR"){
                    $amot = $rirl*100;//$this->customer_model->currency_change_payment($country,number_format($rirl))*100;
                }else{
                   $amot = preg_replace('/[^0-9.]+/', '',$this->customer_model->currency_change_payment($country,$rirl))*100;
                }
            ?>
            <div class="form-item payment-item bg-color-white box-shadow p-3 p-lg-5 border-radius5">
                <h6>Payment</h6>
                    <!--<div class="input-item radio">-->
                    <!--    <input type="radio" name="payment" onclick="paybutton('Ccavenue')" value="Ccavenue">-->
                    <!--    <label>Ccavenue</label>-->
                    <!--</div>-->
                    <div class="input-item radio">
                        <input type="radio" name="payment" onclick="paybutton('Razorpay')" value="Razorpay">
                        <label>Razorpay</label>
                    </div>
            </div>
            <span class=" error msg"></span>
            <!-- <div class="Ccavenue" style="display:none;">
                <form id="paymentfor" name="paymentform" method="POST">
                    <input type="hidden" name="customeraddress_id" class="addressid">
                    <input type="hidden" name="cart_amount" value="<?php echo $this->customer_model->currency_change_payment($country,$rirl);?>">
                    <input type="hidden" name="payment_mode" value="Online">
                    <input type="submit" class="CheckOut" name="CheckOut" style="width: 100%;" value="CheckOut">
                </form>
            </div> -->
            <div class="Razorpay" style="display:none;">
                <form id="paymentform" action="<?php echo base_url('Pay-Razar');?>" name="paymentform" method="POST" >
                     <input type="hidden" name="customeraddress_id" class="addressid" value="<?php echo $userid;?>">
                    <input type="hidden" name="cart_amount" value="<?php echo $this->customer_model->currency_change_payment($country,$rirl);?>">
                    <input type="hidden" name="payment_mode" value="Razar Pay">
                     <input type="hidden" name="customer_mobile" class="" value="<?php echo $this->session->userdata('customer_mobile');?>">
                     <input type="hidden" name="cart_total" class="" value="<?php echo  $this->cart->total();?>">
                     <input type="hidden" name="coupon_code" class="" value="<?php echo  $coupon;?>">
                    <!-- <input type="submit" value="Payment" class="razorpay-payment-button" disabled="disabled">
                    <script
                    	src="https://checkout.razorpay.com/v1/checkout.js"
                    	data-key="rzp_test_falZrNhbHK4ikQ"
                    	data-amount="<?php echo $amot;?>"
                    	data-buttontext="Payment"
                    	data-name="Minikart"
                    	data-currency= "<?php echo $country;?>"
                    	data-description="Purchase Description"
                    	data-image="<?php echo base_url();?>assets/images/logo.png"
                    	data-prefill.name="<?php echo $name;?>"
                    	data-prefill.email="<?php echo $email;?>"
                    	data-prefill.phone="<?php echo $phone;?>"
                    	data-theme.color="#F37254"
                    >
                    </script> -->
                    <input id="rzp-button1" type="submit" value="Payment" class="razorpay-payment-button" disabled="disabled">
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "rzp_live_xxJMBg5GVO7OhZ", //rzp_test_falZrNhbHK4ikQ Enter the Key ID generated from the Dashboard
    "amount": "<?php echo $amot;?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "<?php echo $country;?>",
    "name": "Minikart",
    "description": "Purchase Description",
    "image": "<?php echo base_url();?>assets/images/logo.png",
    //"order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){
            $("<input />").attr("type", "hidden")
                .attr("name", "razorpay_payment_id")
                .attr("value", response.razorpay_payment_id)
                .appendTo("#paymentform");
                $("#paymentform").submit();
    },
    "prefill": {
        "name": "<?php echo $name;?>",
        "email": "<?php echo $email;?>",
        "contact": "<?php echo $phone;?>"
    },
    "theme": {
        "color": "#3399cc"
    }
};
var rzp1 = new Razorpay(options);
rzp1.on('payment.failed', function (response){
        alert(response.error.code);
        alert(response.error.description);
        alert(response.error.source);
        alert(response.error.step);
        alert(response.error.reason);
        alert(response.error.metadata.order_id);
        alert(response.error.metadata.payment_id);
});
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>
 <!-- rzp_live_xxJMBg5GVO7OhZ -->
                </form>
            </div>
        </div>
    </div>
<script>
    
</script>