<div id="content" class="site-content" tabindex="-1">
    <div class="container">
        <nav class="woocommerce-breadcrumb">
            <a href="<?php echo base_url();?>">Home</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>Checkout
        </nav>
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <article class="page type-page status-publish hentry">
                    <header class="entry-header">
                        <h1 itemprop="name" class="entry-title">Checkout</h1></header> 
                        <form action="" class="checkout formvalid woocommerce-checkout" method="post" novalidate="" name="checkout">
                            <div id="customer_details" class="col2-set"> 
                                <?php $this->load->view("theme/success_error");?>
                                <h3 id="order_review_heading">Delivery Address</h3> 
                                <div class="row">  
                                    <div class="col-md-12">
                                        <a href="<?php echo base_url("Add-Address");?>" class="btn-success btn-sm"><i class="fa fa-plus-square"></i> &nbsp;Add Address</a>
                                    </div>
                                </div>
                                <div id="" class="row mtop-15 m-b-10">  
                                    <?php $this->load->view("ajaxaddreess");?> 
                                </div>
                                <h3 id="order_review_heading">Your order</h3> 
                                <div class="woocommerce-checkout-review-order" id="order_review">
                                    <table class="shop_table woocommerce-checkout-review-order-table">
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $totl   =   0;
                                            $rirl     =   $this->cart->contents();
                                            if(count($rirl) > 0){
                                                foreach($rirl as $ve){
                                                    $tl     =   $ve["price"]*$ve["qty"];
                                                    $totl   =   $totl+$tl;
                                                    ?>
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    <?php echo $ve["name"];?>
                                                    <strong class="product-quantity">× <?php echo $ve["qty"];?></strong>
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount"><i  class="fa fa-inr"></i> <?php echo $tl;?></span>
                                                </td>
                                            </tr>      
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="cart-subtotal">
                                                <th>Subtotal</th>
                                                <td><span class="amount"><i  class="fa fa-inr"></i> <?php echo $totl;?></span></td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Total</th>
                                                <td><strong><span class="amount"><i  class="fa fa-inr"></i> <?php echo $totl;?></span></strong> </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="woocommerce-checkout-payment" id="payment">
                                        <ul class="wc_payment_methods payment_methods methods">  
                                            <li class="wc_payment_method payment_method_cod">
                                                <input type="radio" data-order_button_text="" value="Cash On Delivery" name="payment_mode" class="input-radio" id="payment_method_cod" required="">
                                                <label for="payment_method_cod">Cash on Delivery</label>
                                                <div style="display:none;" class="payment_box payment_method_cod">
                                                    <p>Pay with cash upon delivery.</p>
                                                </div>
                                            </li> 
                                        </ul>
                                        <div class="form-row place-order">  
                                            <div class="md-form form-sm otpdivshide">
                                                <label data-error="wrong" data-success="right" for="OTP"> OTP <span class="text-danger">*</span></label>
                                                <input type="password" id="otp" name="otp_key" required class="form-control form-control-sm otp_key validate"  placeholder="Enter Valid OTP"> 
                                            </div>
                                        </div>
                                        <div class="form-row place-order"> 
                                            <p class="form-row terms wc-terms-and-conditions">
                                                <input type="hidden" id="otp_mobile_no" name="otp_mobile_no" value="<?php echo $this->session->userdata('otpmobileno');?>">
                                                <input type="checkbox" id="terms" name="terms" class="input-checkbox" required="">
                                                <label class="checkbox" for="terms">I’ve read and accept the <a target="_blank" href="<?php echo base_url('Content-View/Terms-Conditions');?>">terms &amp; conditions</a> <span class="required">*</span></label>
                                                <input type="hidden" value="1" name="terms-field" >
                                            </p>  
                                            <input type="button" onclick="checkoutvalue()" class="palced" name="submit" value="Place order" class="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                </article>
            </main>
            <!-- #main -->
        </div> 
    </div> 
</div> 