<div class="row">
	<?php   
    $country =  $this->session->userdata("currency_code");
    if(count($subp) > 0){
        foreach($subp as $ve){
            //echo '<pre>';print_r($ve);exit;
        $imsg   =   $this->config->item("upload_url")."products/photo-not-available.png";
        $target_dir =  $this->config->item("upload_url")."products/".$ve->vendorproductimg_name ;
        if(@getimagesize($target_dir)){
            $imsg   =   $target_dir;
        }
        $vso    =   urlencode($ve->category_keywords);
        $vsso   =   ($ve->product_keywords);
        $user='';
        if($this->session->userdata('customer_id')!=""){
            $user =  $this->session->userdata('customer_id');
        }
    ?>
	<div class="col-lg-3 col-md-6">
		<div class="or-product-innerbox-item type-1 text-center position-relative">
			<div class="e-commerce-btn">
				<?php 
                    if($this->session->userdata('customer_id') !=''){
                        $link = 'onclick="wishlist(jQuery(this))" href="#" vendorprdo="'.$ve->vendorproduct_id.'" loginmpobile="'.$user.'" wishlistid=""';
                    }else{
                        $link = 'onclick="OpenSignUpForm()" href="#"';
                    }
                ?>
				<a href="<?php  echo base_url("Product-View/".$vsso);?>"><i class="fal fa-shopping-cart"></i></a>
				<a href="#" <?php echo $link;?> class="wish-link"><i class="fal fa-heart"></i></a>
				<a href="<?php  echo base_url("Product-View/".$vsso);?>"><i class="fal fa-eye"></i></a>
			</div>
			<div class="or-product-inner-img">
				<img src="<?php echo $imsg;?>" alt="">
			</div>
			<div class="or-product-inner-text headline">
				<a href="<?php  echo base_url("Category-List/".$vso);?>" class="cata"><?php echo $ve->category_name;?></a>
				<h3><a href="<?php  echo base_url("Product-View/".$vsso);?>"><?php echo $ve->product_name;?></a></h3>
				<span class="price">
					<?php if($ve->vendorproduct_bb_mrp != $ve->vendorproduct_bb_price){ ?>
					<del>
						<?php if(!empty($ve->vendorproduct_bb_mrp)){ echo $this->customer_model->currency_change($country,$ve->vendorproduct_bb_mrp);}?> 
					</del>
					<?php echo $this->customer_model->currency_change($country,$ve->vendorproduct_bb_price);?> 
					<?php }else{ ?>
					<?php echo $this->customer_model->currency_change($country,$ve->vendorproduct_bb_price);?> 
					<?php }?>
				</span>
				<div class="or-product-rate ul-li">
					<ul>
						<li><i class="fas fa-star"></i></li>
						<li><i class="fas fa-star"></i></li>
						<li><i class="fas fa-star"></i></li>
						<li><i class="fas fa-star"></i></li>
						<li><i class="fas fa-star"></i></li>
					</ul>
				</div>
			</div>
			<div class="or-product-btn text-center">
				<a class="d-flex justify-content-center align-items-center" href="<?php  echo base_url("Product-View/".$vsso);?>">Add To Cart</a>
			</div>
		</div>
	</div>
    <?php } ?>
    <?php }else{ ?>
    <div class="col-12 text-center mt-4 widget">
        <img src="<?php echo base_url();?>assets/images/empty-products.png">
    </div>
    <?php } ?>
	<?php //echo $this->ajax_pagination->create_links();?>
</div>