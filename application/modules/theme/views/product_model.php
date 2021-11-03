    <?php echo '<pre>';print_r($view);exit;
        $country    =   $this->session->userdata("currency_code");
        foreach($view as $view){
    ?>
    <div class="row align-items-center">
        <div class="col-lg-6">
            <div class="product-zoom-area">
                <span class="batch">30%</span>
                <div class="cart-btn-toggle d-lg-none">
                    <span class="cart-btn"><i class="fas fa-shopping-cart"></i> Cart</span>
                    <div class="price-btn">
                        <div class="price-increase-decrese-group d-flex">
                            <span class="decrease-btn">
                                <button type="button"
                                    class="btn quantity-left-minus" data-type="minus" data-field="">-
                                </button>
                            </span>
                            <input type="text" name="quantity" class="form-controls input-number" value="1">
                            <span class="increase">
                                <button type="button"
                                    class="btn quantity-right-plus" data-type="plus" data-field="">+
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="product-slick">
                    <?php $i=0;foreach($view_img as $img){
                        $imsg           =   $this->config->item("upload_url")."products/photo-not-available.png";
                        $target_dir     =  $this->config->item("upload_url")."products/".$img->vendorproductimg_name ;
                        if(@getimagesize($target_dir)){
                                $imsg   =   $target_dir;
                        }
                    ?>
                    <div><img src="<?php echo $imsg;?>" alt="" class="img-fluid blur-up lazyload image_zoom_cls-<?php echo $i;?>" alt="<?php echo $view->product_name;?>"></div>
                    <?php $i++;
                    } ?>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="slider-nav">
                            <?php foreach($view_img as $img){
                                $imsg           =   $this->config->item("upload_url")."products/photo-not-available.png";
                                $target_dir     =  $this->config->item("upload_url")."products/".$img->vendorproductimg_name ;
                                if(@getimagesize($target_dir)){
                                        $imsg   =   $target_dir;
                                }
                            ?>
                            <div><img src="<?php echo $imsg;?>" alt="" class="img-fluid blur-up lazyload imgheght" alt="<?php echo $view->product_name;?>"></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="product-details-content">
                <a class="wish-link" href="#">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                </a>
                <a href="#" class="cata">Catagory</a>
                <h2><?php echo $view->product_name;?></h2>
                <p class="quantity"><?php echo $view->vendorproduct_bb_quantity;?></p>
                <h3 class="price">
                    <?php echo $this->customer_model->currency_change($country,$view->vendorproduct_bb_price);?>
                    <del>
                        <?php echo $this->customer_model->currency_change($country,$view->vendorproduct_bb_mrp);?>
                    </del>
                </h3>
                <div class="price-increase-decrese-group d-flex">
                    <span class="decrease-btn">
                        <button type="button"
                            class="btn quantity-left-minus" data-type="minus" data-field="">-
                        </button>
                    </span>
                    <input type="text" name="quantity" class="form-controls input-number" value="1">
                    <span class="increase">
                        <button type="button"
                            class="btn quantity-right-plus" data-type="plus" data-field="">+
                        </button>
                    </span>
                </div>
                <p><?php echo $view->vendorproduct_description;?></p>
                <div class="d-flex justify-content-end">
                    <a href="javascript:void(0);" class="buy-now" name="Add to Cart" prodqu="1" prodid="<?php echo $view->vendorproduct_id;?>" onclick="addtocart(jQuery(this))">Buy Now</a>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>