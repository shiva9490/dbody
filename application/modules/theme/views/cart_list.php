    <?php $country    =   $this->session->userdata("currency_code");?>
    <div class="page-header-section">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-start">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo base_url();?>">Home</a></li>
                        <li><span>/</span></li>
                        <li>Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- page-header-section end -->

    <!-- dashboard-section start -->
    <section class="dashboard-section">
        <div class="container">
            <?php 
            $rtotl     =   $this->cart->contents();
            if(count($rtotl) > 0){ ?>
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-item billing-item bg-color-white box-shadow p-3 p-lg-5 border-radius5">
                        <div class="row">  
                            <div class="col-md-6">
                                <h3 id="order_review_heading">Delivery Address</h3> 
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-primary" style="float:right;" href="<?php echo base_url('Add-Address');?>">Add New Address</a>
                            </div>
                        </div>
                        <div class="row">  
                                <?php 
                                    $userid = $this->session->userdata('customer_id');
                                    $par['whereCondition'] = "customeraddress_customer LIKE '".$userid."'";
                                    $address = $this->customer_model->viewCustomeraddress($par);
                                    if(is_array($address) && count($address) >0){
                                        $i=1;
                                        foreach($address as $ce){
                                            $locality   =   $ce->customeraddress_locality;
                                            $adre       =   $ce->customeraddress_address;
                                            $adsre      =   $ce->customeraddress_latitude.",".$ce->customeraddress_longitude;
                                ?>
                                <div class="col-md-6 address-border">
                                     <label class="cont address-list">
                                        <?php echo $ce->customeraddress_fullname.',<br>'.$ce->customeraddress_mobile.'<br>';?>
                                        <?php echo $adre.'<br>'.$ce->customeraddress_locality.'<br>'.$ce->customeraddress_district.'<br>'.$ce->customeraddress_pincode;?>
                                        <input type="radio" class="type" id="addressids" name="address" onclick="checkoutaddress('<?php echo $ce->customeraddress_id;?>')">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <?php   
                                        $i++;}
                                    }
                                ?>
                            
                        </div>
                        <div id="" class="row mtop-15 m-b-10">  
                            <?php $this->load->view("shopping/ajaxaddreess");?> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" id="ajax_cart_ddd">
                    <?php $this->load->view("ajax_cart_data");?>
                </div>
            </div>
            <?php }else{?>
            <div class="row product-list">
                <div class="col-12 text-center mt-4 widget">
                    <img src="<?php echo base_url().'assets/empty-cart.svg'?>" width="200px"><br>
                    <h4>No Products are available in the cart</h4>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
    <!-- dashboard-section end -->
