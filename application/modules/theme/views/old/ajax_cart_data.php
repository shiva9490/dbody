<div class="col-lg-4">
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
                            $price  = $this->customer_model->currency_change($country,$fr['price']);
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
            </div>
            <?php }  }?>
        </div>
        <div class="cart-footer">
            <div class="cart-total">
                <p class="total-price d-flex justify-content-between">
                    <span>Total</span> 
                    <span><span class="amount price2"><?php echo $vtoal = $this->customer_model->currency_change($country,$rirl);?></span></span>
                </p>
            </div>
            <?php 
                $userid = $this->session->userdata('customer_id');
                $par['whereCondition'] = "customer_id LIKE '".$userid."'";
                $user_details = $this->customer_model->getCustomer();
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
            <div class="Ccavenue" style="display:none;">
                <form id="paymentform" name="paymentform" method="POST">
                    <input type="hidden" name="customeraddress_id" class="addressid">
                    <input type="hidden" name="cart_amount" value="<?php echo $this->customer_model->currency_change_payment($country,$rirl);?>">
                    <input type="hidden" name="payment_mode" value="Online">
                    <input type="submit" class="CheckOut" name="CheckOut" style="width: 100%;" value="CheckOut">
                </form>
            </div>
            <div class="Razorpay" style="display:none;">
                <form id="paymentform" action="<?php echo base_url('Pay-Razar');?>" name="paymentform" method="POST">
                    <input type="hidden" name="customeraddress_id" class="addressid">
                    <input type="hidden" name="cart_amount" value="<?php echo $this->customer_model->currency_change_payment($country,$rirl);?>">
                    <input type="hidden" name="payment_mode" value="Razar Pay">
                    <script
                    	src="https://checkout.razorpay.com/v1/checkout.js"
                    	data-key="rzp_live_xxJMBg5GVO7OhZ"
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
                    // rzp_test_falZrNhbHK4ikQ rzp_live_xxJMBg5GVO7OhZ
                    </script>
                </form>
            </div>
        </div>
    </div>
</div>