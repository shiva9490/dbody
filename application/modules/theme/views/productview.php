<?php
    $country =  $this->session->userdata("currency_code");
    $cvso   =   ($view['category_keywords']);
    $csvso  =   ($view['subcategory_keywords']);
?>
<!-- Start of Breadcrumb section
	============================================= -->
	<section id="or-breadcrumbs" class="or-breadcrumbs-section position-relative" data-background="assets/img/bg/bg-page-title.jpg">
		<div class="background_overlay"></div>
		<div class="container">
			<div class="or-breadcrumbs-content text-center">
				<div class="page-title headline"><h1>Shop Details</h1></div>
				<div class="or-breadcrumbs-items ul-li">
					<ul>
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li><?php echo $cvso?></li>
						<li><?php echo $csvso?></li>
					</ul>
				</div>
			</div>
		</div>
	</section>
<!-- End of Breadcrumb section
	============================================= -->
<!-- Start of Shop Details section
	============================================= -->
	<section id="or-shop-details" class="or-shop-details-section">
		<div class="container">
			<div class="or-shop-details-content">
				<div class="row">
					<div class="col-lg-6">
						<div class="shop-details-img-slider-area">
							<div class="shop-details-img-slider">
								<?php 
								if(count($images) > 0){
									$i=0;foreach($images as $key => $ve){
										$imsg   =   $this->config->item("upload_url")."products/photo-not-available.png";
										$target_dir =  $this->config->item("upload_url")."products/".$ve->vendorproductimg_name ;
										if(@getimagesize($target_dir)){
												$imsg   =   $target_dir;
										}
										?>
									<div class="shop-details-img-wrap">
										<img src="<?php echo $imsg;?>" alt="<?php echo $view["product_name"].$i;?>" data-zoomed="<?php echo $imsg;?>" class="img-fluid blur-up lazyload image_zoom_cls-<?php echo $i;?>" style="margin:0 auto;">
									</div>
									<?php 
									$i++;}
								}
								?>
							</div>
							<div class="shop-details-img-thumb">
								<?php 
									if(count($images) > 0){
									$i=0;foreach($images as $key => $ve){
										$imsg   =   $this->config->item("upload_url")."products/photo-not-available.png";
										$target_dir =  $this->config->item("upload_url")."products/".$ve->vendorproductimg_name ;
										if(@getimagesize($target_dir)){
												$imsg   =   $target_dir;
										}
										?>
										<div class="or-thumb-img">
											<img src="<?php echo $imsg;?>" alt="<?php echo $view["product_name"].$i;?>">
										</div>
										<?php 
										$i++;}
									}
									?>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="shop-details-text  headline pera-content">
							<div class="shop-details-title">
								<a href="<?php echo base_url("Category-List/".$cvso);?>" class="cata"><?php echo ($view['category_name']);?></a>
                                <h3><?php echo $view["product_name"];?></h3>
							</div>
							<div class="shop-details-rate-review ul-li d-flex">
								<div class="shop-details-rate">
									<ul>
										<li><i class="fas fa-star"></i></li>
										<li><i class="fas fa-star"></i></li>
										<li><i class="fas fa-star"></i></li>
										<li><i class="fas fa-star"></i></li>
										<li><i class="fas fa-star"></i></li>
									</ul>
								</div>
								<div class="shop-details-review">(4.9 Based on 02 Reviews)</div>
								<div class="shop-details-review"><span>02 Reviews</span> <span>24 orders</span></div>
							</div>
							<div class="shop-details-price prices">
								<?php if($view['vendorproduct_bb_mrp'] != $view['vendorproduct_bb_price']){ ?>
								<del>
									<?php if(!empty($view['vendorproduct_bb_mrp'])){echo $this->customer_model->currency_change($country,$view['vendorproduct_bb_mrp']);}?> 
								</del>
								<?php echo $this->customer_model->currency_change($country,$view['vendorproduct_bb_price']);?> 
								<?php }else{ ?>
								<?php echo $this->customer_model->currency_change($country,$view['vendorproduct_bb_price']);?> 
								<?php }?>
							</div>
							<span class="pricedetails"></span>
							<div class="shop-details-text-decs">
								<?php echo $view['vendorproduct_descc'];?>								
							</div>
							<?php $this->load->view('productview_price')?>
							<div class="shop-details-option color-option ul-li">
								<span class="option-title">Color:</span>
								<ul>
									<li class="color-1 active"></li>
									<li class="color-2"></li>
									<li class="color-3"></li>
									<li class="color-4"></li>
								</ul>
								<div class="row radio-toolbars">
									<?php
										$conditions['whereCondition'] = "vendorproduct_product LIKE '".$view['vendorproduct_product']."'";
										$conditions['group_by']       = "vp.vendorproduct_id";
										$reming_prod = $this->vendor_model->viewVendorproducts($conditions);
										if(is_array($reming_prod) && count($reming_prod) > 0){
											if(count($reming_prod) >1){
												foreach($reming_prod as $r){
													$par['whereCondition'] = "vimp.vendorproduct_productid LIKE '".$r->vendorproduct_id."'";
													$remimg = $this->vendor_model->getVendorproductimages($par);
													$imsg   =   $this->config->item("upload_url")."products/photo-not-available.png";
													$target_dir =  $this->config->item("upload_url")."products/".$remimg['vendorproductimg_name'];
													if(@getimagesize($target_dir)){
															$imsg   =   $target_dir;
													}
												?>
												<div class="col-md-3">
													<input type="radio" class="size<?php echo $r->vendorproductprinceid;?>" id="<?php echo $r->vendorproductprinceid;?>" data-ids="<?php echo $r->vendorproduct_id;?>" data-value="<?php echo $r->vendorproductprinceid;?>" onchange="changeratess('<?php echo $r->vendorproductprinceid;?>')" name="quantity" value="<?php echo $r->vendorproduct_bb_quantity;?>" <?php if($view['vendorproduct_code'] == $r->vendorproduct_code){echo 'checked';}?>>
													<label for="<?php echo $r->vendorproductprinceid;?>">
														<img src="<?php echo $imsg;?>" class=""><br>
														<?php echo $this->customer_model->currency_change($country,$r->vendorproduct_bb_price);?> 
													</label>
												</div>
												<?php
												}
											}
										}
									?>
								</div>
							</div>
							<div class="shop-details-option">
								<span class="option-title">Quantity:</span>
								<div class="shop-quantity-option d-flex">
									<div class="quantity-field position-relative  d-inline-block">
										<input type="text" name="select1" value="1" class="quantity-input-arrow quantity-input-2  text-center">
									</div>
									<div class="stock-avaiable"><?php echo $view['vendorproduct_bb_quantity'];?> pieces available </div>
								</div>
							</div>
							<div class="shop-details-btn ">
								<?php if($view['vendorproduct_out_stock']==0){ ?>
                                    <a href="javascript:void(0);" class="buy-now" name="Add to Cart" prodqu="1" prodid="<?php echo $view['vendorproduct_id'];?>" onclick="addtocart(jQuery(this))">Add to cart</a>
                                     <a href="javascript:void(0);" class="buy-now ml-2 btn-success" name="Add to Cart" prodqu="1" prodid="<?php echo $view['vendorproduct_id'];?>" onclick="buynoww(jQuery(this))">Buy Now</a>
                                <?php }else if($view['vendorproduct_out_stock']==1){ ?>
                                    <a href="javascript:void(0);" class="btn btn-danger" onclick="alert('This Product is out of stock ,try different product to proceed.')">Out Of Stock</a>
                                <?php } ?>
							</div>
							<div class="shop-details-product-code ul-li-block">
								<ul>	
									<li><span>Brand: </span> <?php echo $view["vendorproduct_brand"];?></li>
									<li><span>Category: </span>
										<a href="<?php echo base_url("Category-List/".$cvso);?>" class="cata"><?php echo ($view['category_name']);?></a>
									</li>
								</ul>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End of Shop Details section
	============================================= -->

<!-- Start of Shop details description tab section
	============================================= -->
	<section id="or-shop-details-tab" class="or-shop-details-tab-section">
		<div class="container">
			<div class="or-shop-details-review-tab-content">
				<div class="or-shop-review-tab-btn">
					<ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Description</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Additional info</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Review (<?php echo count($review);?>)</button>
						</li>
					</ul>
				</div>
				<div class="or-shop-details-tab-textarea">
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<div class="shop-details-description-text  text-center">
								<?php echo $view['vendorproduct_descc'];?>
							</div>
						</div>
						<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							<div class="product-description-text pera-content">
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
								<p>
									It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ‘Content here, content here’, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ‘lorem ipsum’ will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
								</p>
								<table class="table-responsive">
									<tr>
										<td class="desc-title">Model</td>
										<td class="desc-value">Microsoft Surface Pro 6</td>
									</tr>
									<tr>
										<td class="desc-title">Processor</td>
										<td class="desc-value">Intel Core i3-8145U Processor (4M Cache, up to 3.90 GHz)</td>
									</tr>
									<tr>
										<td class="desc-title">Display</td>
										<td class="desc-value">	14" HD (1366x768) Anti-Glare, Non-Touch, WVA</td>
									</tr>
									<tr>
										<td class="desc-title">Memory</td>
										<td class="desc-value">	4GB DDR4 Non-ECC RAM</td>
									</tr>
									<tr>
										<td class="desc-title">Storage</td>
										<td class="desc-value">1TB 5400rpm HDD</td>
									</tr>
									<tr>
										<td class="desc-title">Graphics</td>
										<td class="desc-value">Intel UHD Graphics 620</td>
									</tr>
									<tr>
										<td class="desc-title">Battery</td>
										<td class="desc-value">3 Cell 42Whr ExpressChargeTM Capable Battery</td>
									</tr>
									<tr>
										<td class="desc-title">Adapter</td>
										<td class="desc-value">1 x 4.5mm adapter</td>
									</tr>
									<tr>
										<td class="desc-title">Audio</td>
										<td class="desc-value">Integrated digital array microphone</td>
									</tr>
									<tr>
										<td class="desc-title">Special Feature</td>
										<td class="desc-value">Finger Print Security</td>
									</tr>
									<tr>
										<td class="desc-title">Keyboard</td>
										<td class="desc-value">Single Pointing Backlit Keyboard</td>
									</tr>
									<tr>
										<td class="desc-title">WebCam</td>
										<td class="desc-value">Yes</td>
									</tr>

									<tr>
										<td class="desc-title">Card Reader</td>
										<td class="desc-value">1x SD 3.0 Memory card reader</td>
									</tr>
									<tr>
										<td class="desc-title">Wi-Fi</td>
										<td class="desc-value">Intel® Dual Band Wireless AC 9560 (802.11ac) 2x2</td>
									</tr>
									<tr>
										<td class="desc-title">Bluetooth</td>
										<td class="desc-value">Bluetooth 5.0</td>
									</tr>
									<tr>
										<td class="desc-title">HDMI</td>
										<td class="desc-value">1 x HDMI 1.4</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
							<div class="review-comment-area">
								<div class="review-buyer-box">
									<?php foreach($review as $r){ ?>
									<div class="buyer-review-inner clearfix">
										<div class="buyer-review-pic float-left">
											<img src="assets/img/blog/blg-c2.jpg" alt="">
										</div>
										<div class="buyer-review-text headline">
											<h4><?php echo $r['customer_name'];?></h4>
											<span><?php echo $r['message'];?></span>
											<div class="buyer-review-rate d-inline-block">
												<?php for($j=1;$j<=5;$j++){ 
													if($j<= $r['rating']+0.5){ ?>
												<a href="#"><i class="fas fa-star"></i></a>
												<a href="#"><i class="fas fa-star"></i></a>
												<a href="#"><i class="fas fa-star"></i></a>
												<a href="#"><i class="fas fa-star"></i></a>
												<a href="#"><i class="fas fa-star"></i></a>
												<?php }else{ ?>
												<a href="#"><i class="fas fa-star"></i></a>
												<?php }} ?>
											</div>
											<div class="buyer-review-date position-relative d-inline-block">
												<?php $date=date_create($r['add_date']);
															echo date_format($date,"F d, Y \@ h:ia ");?>
											</div>
										</div>
									</div>
									<?php } ?>
								</div>
								<div class="buyer-review-comment-box headline">
									<h4 class="float-left">Add Review:</h4>
									<form id="buyer-review" class="review-form" method="post">
										<div class="customer-rate-option ul-li float-left">
											<input type="hidden" name="prodcu_id" value="<?php echo $view['vendorproduct_code'];?>">
											<ul>
												<li>
													<label class="customer-rate-option">
														<input type="checkbox" name="#" class="customer-rate" value="5" checked="">
														<span class="rate-value"></span>
													</label>
												</li>
												<li>
													<label class="customer-rate-option">
														<input type="checkbox" name="#" class="customer-rate" value="4" checked="">
														<span class="rate-value"></span>
													</label>
												</li>
												<li>
													<label class="customer-rate-option">
														<input type="checkbox" name="#" class="customer-rate" value="3" checked="">
														<span class="rate-value"></span>
													</label>
												</li>
												<li>
													<label class="customer-rate-option">
														<input type="checkbox" name="#" class="customer-rate" value="2" checked="">
														<span class="rate-value"></span>
													</label>
												</li>
												<li>
													<label class="customer-rate-option">
														<input type="checkbox" name="#" class="customer-rate" value="1">
														<span class="rate-value"></span>
													</label>
												</li>
											</ul>										
										</div>									
										<input type="hidden" name="product_id" value="<?php echo $view['product_id'];?>">
										<textarea name="message" placeholder="Write Your Review"><?php echo set_value('message')?></textarea>
										<button type="submit" name="reviewsubmit" value="reviewsubmit">Submit</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End Shop details description tab section
	============================================= -->		