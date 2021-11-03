<?php
$country    =   $this->session->userdata("currency_code");
$vtoal  =   "0";
$rtotl     =   $this->cart->contents();
if(count($rtotl) > 0){
    $rirl   =   "0";$i=1;
    foreach($rtotl as $fr){
        //echo '<pre?';print_r($fr);exit;
        $vtoal      =  "0";
        $vsso       =  $fr['name'];
        $delivery   =  isset($fr['delamount'])?$fr['delamount']:'0';
        $total      =  $fr["qty"]*$fr["price"] ;
        $rirl   +=  $fr["qty"]*$fr["price"]+$delivery;
    }
}
if($country == "INR"){
    $amot = $rirl*100;//$this->customer_model->currency_change_payment($country,number_format($rirl))*100;
}else{
   $amot = $this->customer_model->currency_change_payment($country,$rirl)*100;
}

$userid = $this->session->userdata('customer_id');
$par['whereCondition'] = "customer_id LIKE '".$userid."'";
$user_details = $this->customer_model->getCustomer();
$name   = isset($user_details['customer_name'])?$user_details['customer_name']:'';
$email  = isset($user_details['customer_email_id'])?$user_details['customer_email_id']:'';
$phone  = isset($user_details['customer_mobile'])?$user_details['customer_mobile']:'';

if($type =="Ccavenue"){
?>
<form id="paymentform" class="Ccavenue" name="paymentform" method="POST">
    <input type="hidden" name="customeraddress_id" class="addressid">
    <input type="hidden" name="cart_amount" value="<?php echo $this->customer_model->currency_change_payment($country,$rirl);?>">
    <input type="hidden" name="payment_mode" value="Online">
    <script
    	src="https://checkout.razorpay.com/v1/checkout.js"
    	data-key="rzp_test_KQf1CMWfn2oyPU"
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
    </script>
    <input type="submit" class="CheckOut" name="CheckOut" style="width: 100%;" value="CheckOut">
</form>

<?php } elseif($type =="Razorpay"){ ?>

<form id="paymentform" class="Razorpay" name="paymentform" method="POST">
    <input type="hidden" name="customeraddress_id" class="addressid">
    <input type="hidden" name="cart_amount" value="<?php echo $this->customer_model->currency_change_payment($country,$rirl);?>">
    <input type="hidden" name="payment_mode" value="Online">
    <script
    	src="https://checkout.razorpay.com/v1/checkout.js"
    	data-key="rzp_test_KQf1CMWfn2oyPU"
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
    </script>
</form>

<?php } ?>