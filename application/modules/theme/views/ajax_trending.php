<?php
$country =  $this->session->userdata("currency_code");
//$this    =& get_instance();
$param["tiporderby"]  =   "category_name";
$param["order_by"]    =   "asc";
$param["limit"]       =   "5";
$param["group_by"]    =   "vp.vendorproduct_id";
$param['columns']  =   'vendorproductimg_name,category_name,product_name,product_keywords,vendorproduct_acde,vendorproduct_bb_price,vendorproduct_bb_mrp';
$rese    =   $this->vendor_model->viewVendorproducts_list($param);
?>
<section class="trending-product-section">
	<div class="container">
		<div class="section-heading">
			<h4 class="heading-title"><span class="heading-circle"></span> Trending Products</h4>
		</div>

		<div class="section-wrapper">
			<!-- Add Arrows -->
			<div class="slider-btn-group">
				<div class="slider-btn-prev trending-slider-prev">
					<i class="fa fa-angle-left"></i>
				</div>
				<div class="slider-btn-next trending-slider-next">
					<i class="fa fa-angle-right"></i>
				</div>
			</div>
			<div class="mlr-20">
				<div class="trending-product-container">
					<div class="swiper-wrapper">
					    <?php 
					    if(count($rese) > 0){
					        foreach($rese as $ve) {
					            $imsg           =   $this->config->item("upload_url")."products/photo-not-available.png";
                                $target_dir     =  $this->config->item("upload_url")."products/".$ve->vendorproductimg_name ;
                                if(@getimagesize($target_dir)){
                                        $imsg   =   $target_dir;
                                }
                                $vso        =   urlencode($ve->category_name);
                                $vsso       =   urlencode($ve->product_name); 
                                $vssdo      =   $ve->product_keywords;
                                $vacde      =   $ve->vendorproduct_acde;
					            ?>
						<div class="swiper-slide">
							<div class="product-item">
								<div class="product-thumb">
									<a href="<?php echo base_url("Product-View/".$vssdo);?>">
										<img src="<?php echo $imsg;?>" alt="product">
									</a>
									<span class="batch sale">Sale</span>
									<a class="wish-link" href="#">
										<i class="fas fa-heart"></i>
									</a>
								</div>
								<div class="product-content">
									<a href="<?php  echo base_url("Category-List/".$vso);?>" class="cata"><?php echo $ve->category_name;?></a>
									<h6><a href="<?php echo base_url("Product-View/".$vssdo);?>" class="product-title"><?php echo $ve->product_name;?></a></h6>
									<div class="d-flex justify-content-between align-items-center">
										<div class="price">
											<?php if($ve->vendorproduct_bb_price != $ve->vendorproduct_bb_mrp){ ?>
											    <?php echo $this->customer_model->currency_change($country,$ve->vendorproduct_bb_price);?>
											<del>
											<?php	if(!empty($ve->vendorproduct_bb_mrp)){ echo $this->customer_model->currency_change($country,$ve->vendorproduct_bb_mrp);}?>
											</del>
											<?php }else{ ?>
											 <?php echo $this->customer_model->currency_change($country,$ve->vendorproduct_bb_price);?>
											<?php } ?>
										</div>
										<div class="cart-btn-toggle" >
											<a class="cart-btn" href="<?php echo base_url("Product-View/".$vssdo);?>"><i class="fas fa-shopping-cart"></i> Cart</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					            <?php
					        }
					    }
					    ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>