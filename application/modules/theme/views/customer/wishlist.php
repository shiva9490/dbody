<div class="page-header-section">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between justify-content-md-start">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url();?>">Home</a></li>
                    <li><span>/</span></li>
                    <li>Wishlist</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section id="dashboard-nav" class="dashboard-section">
    <div class="container">
       <?php $this->load->view("customer_dashboard");?>
    </div>
    <div class="container">
        <div class="dashboard-body wishlist">
            <div class="wishlist-header">
                <h6>Shopping Wishlist</h6>
            </div>
            <div class="wish-list-container">
                <?php 
                $country =  $this->session->userdata("currency_code");
                $mobile     =   $this->session->userdata("otpmobileno");
                if(count($view) > 0){
                    foreach($view as $ve){
                        $wishi  =   $ve->wishlist_id;
                        $imsg   =   $this->config->item("upload_url")."products/photo-not-available.png";
                        $target_dir =  $this->config->item("upload_url")."products/".$ve->vendorproductimg_name ;
                        if(@getimagesize($target_dir)){
                                $imsg   =   $target_dir;
                        }
//                      $csvso   =  $ve->subcategory_keywords; 
                        $cvso   =   $ve->category_keywords;
                        $csvso   =  $ve->product_keywords; 
                        ?>
                <div class="wishlist-item product-item d-flex align-items-center removwish<?php echo $wishi;?>">
                    <span class="close-item" onclick="removewishlist('<?php echo $wishi;?>','<?php echo $mobile;?>','<?php echo $ve->vendorproduct_id;?>')"><i class="fas fa-times"></i></span>
                    <div class="thumb">
                        <a onclick="openModal()"><img src="<?php echo $imsg;?>" alt="products"></a>
                    </div>
                    <div class="product-content">
                        <a href="<?php echo base_url("Product-View/".$csvso);?>" class="product-title"><?php echo $ve->product_name;?></a>
                        <div class="product-price">
                            <?php if($ve->vendorproduct_bb_mrp != $ve->vendorproduct_bb_price){ ?>
                            <del>
                                <?php echo $this->customer_model->currency_change($country,$ve->vendorproduct_bb_mrp);?> 
                            </del>
                            <?php echo $this->customer_model->currency_change($country,$ve->vendorproduct_bb_price);?> 
                            <?php }else{ ?>
                            <?php echo $this->customer_model->currency_change($country,$ve->vendorproduct_bb_price);?> 
                            <?php }?>
                        </div>
                        <a class="cart-btn-toggle" href="<?php echo base_url("Product-View/".$csvso);?>">
                            <span class="cart-btn"><i class="fas fa-shopping-cart"></i> Cart</span>
                        </a>
                    </div>
                </div>
                <?php
                    }
                }else{
                    ?>
                    <div class="row">
                        <div class="col-md-12 mt-10 mb-5 text-center">
                            <h4>No Items in the Wishlist</h4>
                        </div>
                    </div>
                    <?php
                }
                ?>
        </div>
    </div>
</section>