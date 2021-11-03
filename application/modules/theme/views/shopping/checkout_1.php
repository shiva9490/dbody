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
                    <form action="#" class="checkout woocommerce-checkout" method="post" name="checkout">
                        <div id="customer_details" class="col2-set">
                            <div id="" class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        First Name <span class="required text-danger">*</span>:
                                        <input type="text" class="form-control input-lg input_char" name="vendor_name" id="vendor_name" placeholder="First Name" required="">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        Email Id:
                                        <input type="email" id="vendor_email_id" name="vendor_email_id" class="form-control input-lg" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        Mobile Number <span class="required text-danger">*</span>:
                                        <input type="text" id="vendor_mobile" name="vendor_mobile" class="form-control input-lg input_num" placeholder="Mobile Number" required>
                                    </div>
                                </div>
                            </div>
                            <div id="" class="row">

                                <div class="col-md-4">
                                    <div class="form-group">

                                        State:
                                        <select class="form-control input-lg" name="vendor_state" id="vendor_state">
                                            <option value="">Select State</option>
                                            <?php
                                                            if(count($result) > 0){
                                                                 foreach ($result as $row){
                                                         ?>
                                                <option value="<?php echo $row['state_id'] ?>">
                                                    <?php echo $row['state_name']  ?>
                                                </option>
                                                <?php  } } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        District:
                                        <select name="vendor_district" id="vendor_district" class="form-control input-lg">
                                            <option value="">Select District</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        Mandal:
                                        <select name="vendor_mandal" id="vendor_mandal" class="form-control input-lg">
                                            <option value="">Select Mandal</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="" class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        Gramapanchayat:
                                        <select name="vendor_gramapanchayat" id="vendor_gramapanchayat" class="form-control input-lg">
                                            <option value="">Select Garamapanchayat</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        Postal Code:
                                        <input type="text" id="reg_postal_code" name="vendor_pincode" class="form-control input-lg input_num" placeholder="Postal code">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        Address:
                                        <textarea id="reg_address" name="vendor_address" class="form-control input-lg" placeholder="Address"></textarea>
                                    </div>
                                </div>

                            </div>
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
                                    <li class="wc_payment_method payment_method_bacs">
                                        <input type="radio" data-order_button_text="" checked="checked" value="bacs" name="payment_method" class="input-radio" id="payment_method_bacs">
                                        <label for="payment_method_bacs">Direct Bank Transfer</label>
                                        <div class="payment_box payment_method_bacs">
                                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </li>
                                    <li class="wc_payment_method payment_method_cheque">
                                        <input type="radio" data-order_button_text="" value="cheque" name="payment_method" class="input-radio" id="payment_method_cheque">
                                        <label for="payment_method_cheque">Cheque Payment </label>
                                        <div style="display:none;" class="payment_box payment_method_cheque">
                                            <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                        </div>
                                    </li>
                                    <li class="wc_payment_method payment_method_cod">
                                        <input type="radio" data-order_button_text="" value="cod" name="payment_method" class="input-radio" id="payment_method_cod">
                                        <label for="payment_method_cod">Cash on Delivery</label>
                                        <div style="display:none;" class="payment_box payment_method_cod">
                                            <p>Pay with cash upon delivery.</p>
                                        </div>
                                    </li>
                                    <li class="wc_payment_method payment_method_paypal">
                                        <input type="radio" data-order_button_text="Proceed to PayPal" value="paypal" name="payment_method" class="input-radio" id="payment_method_paypal">
                                        <label for="payment_method_paypal">PayPal <img alt="PayPal Acceptance Mark" src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg"><a title="What is PayPal?" onclick="javascript:window.open('https://www.paypal.com/us/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;" class="about_paypal" href="https://www.paypal.com/us/webapps/mpp/paypal-popup">What is PayPal?</a></label>
                                        <div style="display:none;" class="payment_box payment_method_paypal">
                                            <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="form-row place-order">

                                    <p class="form-row terms wc-terms-and-conditions">
                                        <input type="checkbox" id="terms" name="terms" class="input-checkbox">
                                        <label class="checkbox" for="terms">I’ve read and accept the <a target="_blank" href="terms-and-conditions.html">terms &amp; conditions</a> <span class="required">*</span></label>
                                        <input type="hidden" value="1" name="terms-field">
                                    </p>

                                    <input type="submit" name="submit" value="Place order" class="button alt">
                                </div>
                            </div>
                        </div>
                    </form>
                </article>
            </main>
            <!-- #main -->
        </div>
        <!-- #primary -->
    </div>
    <!-- .container -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        $('#vendor_state').change(function() {
            var state_id = $('#vendor_state').val();
            if (state_id != '') {
                $.ajax({
                    url: "<?php echo base_url(); ?>districts",
                    method: "POST",
                    data: {
                        state_id: state_id
                    },
                    success: function(data) {
                        // alert(data);

                        $('#vendor_district').html(data);
                    }
                });
            } else {
                $('#vendor_district').html('<option value="">Select District</option>');
            }
        });

        $('#vendor_district').change(function() {
            var district_id = $('#vendor_district').val();
            if (district_id != '') {
                $.ajax({
                    url: "<?php echo base_url(); ?>mandals",
                    method: "POST",
                    data: {
                        district_id: district_id
                    },
                    success: function(data) {
                        $('#vendor_mandal').html(data);
                    }
                });
            } else {
                $('#vendor_mandal').html('<option value="">Select Mandal</option>');
            }
        });

        $('#vendor_mandal').change(function() {
            var mandal_id = $('#vendor_mandal').val();
            if (mandal_id != '') {
                $.ajax({
                    url: "<?php echo base_url(); ?>gramapanchayats",
                    method: "POST",
                    data: {
                        mandal_id: mandal_id
                    },
                    success: function(data) {
                        $('#vendor_gramapanchayat').html(data);
                    }
                });
            } else {
                $('#vendor_gramapanchayat').html('<option value="">Select Gramapanchayat</option>');
            }
        });

    });
</script>