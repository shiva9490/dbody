
<!-- Start of Breadcrumb section
	============================================= -->
	<section id="or-breadcrumbs" class="or-breadcrumbs-section position-relative" data-background="assets/img/bg/bg-page-title.jpg">
		<div class="background_overlay"></div>
		<div class="container">
			<div class="or-breadcrumbs-content text-center">
				<div class="page-title headline"><h1>Cart</h1></div>
				<div class="or-breadcrumbs-items ul-li">
					<ul>
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li>Cart</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
<!-- End of Breadcrumb section
	============================================= -->
<?php
    $country    =   $this->session->userdata("currency_code");
    $vtoal  =   "0";
    $rtotl     =   $this->cart->contents();
    $coupon_oll = $this->session->userdata("coupon_code");
    $coupon_old =   ($coupon_oll['coupon'])??'';
    $mobile     =   $this->session->userdata("customer_mobile");
    $total     =    $this->cart->total();
	$coupon_data='';
	if($coupon_old!=""&&$mobile!=""&&$total!=""){
    $r  =   (array)json_decode($this->coupon_model->Coupon_check($coupon_old,$mobile,$total));
		if($r['status']=="4"){
			$coupon_data = (array)$r['status_messsage'];
		}else{
			$coupon_data='';
		}
	}
    $coupon = ($coupon_data['coupon'])??''; $rirl   =   "0";
    //print_r($r['status']);exit;
    //$coupon_data = $this->session->userdata("coupon_code");
    if(count($rtotl) > 0){        
        $rirl   =   "0";$i=1;
        foreach($rtotl as $fr){
            //echo '<pre?';print_r($fr);exit;
            if($fr['addon_id']==''){
				$vtoal      =  "0";
				$vsso       =  $fr['name'];
				$delivery   =  isset($fr['delamount'])?$fr['delamount']:'0';
			   
			   // added coupon logic
				if(!empty($coupon_data)){
					if(in_array($fr['prodid'],$coupon_data['products_applicable']) || $coupon_data['coupon_applicable'] == 'All'){
						if($coupon_data['coupon_type']=='Percentage'){
							$discount   =  ($fr["price"]/100)*$coupon_data['coupon_discount'];
						}else if($coupon_data['coupon_type']=='Amount'){
							$discount   =   $coupon_data['coupon_discount'];
						}else{
							$discount   =   0;
						}
					}else{
						$discount   =   0;
					}
				}else{
					$discount   =   0;
				}
				$total      =  $fr["qty"]*($fr["price"]-$discount) ;
				$rirl   +=  $fr["qty"]*((float)$fr["price"]-(float)$discount)+(float)$delivery;
				$imsg           =   $this->config->item("upload_url")."products/photo-not-available.png";
				$target_dir     =   $fr["image"];
				if(@getimagesize($target_dir)){
						$imsg   =   $target_dir;
				}
			}
		}
	}
?>

<!-- Start of Cart  section
	============================================= -->
	<section id="or-main-cart" class="or-main-cart-section">
		<div class="container">
			<div class="or-main-cart-content">
				<div class="row">
					<div class="col-lg-8">
						<div class="or-cart-content-table table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th class="product-remove">&nbsp;</th>
										<th class="product-thumbnail">&nbsp;</th>
										<th class="product-name">Product</th>
										<th class="product-price">Price</th>
										<th class="product-quantity">Quantity</th>
										<th class="product-subtotal">Subtotal</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="product-remove"> <a href="#" class="remove">×</a></td>

										<td class="product-thumbnail"> <a href="#"><img src="assets/img/product/pro1.jpg" class="cart-thumb-img" alt=""></a></td>
										<td class="product-name" data-title="Product"> <a href="#">Organic Cabbage - Orange, 0.5 Kg</a></td>
										<td class="product-price product-subtotal" data-title="Price"> <span class=" amount"><bdi><span class="Price-currencySymbol">$</span>4.00</bdi></span></td>
										<td>
											<div class="quantity-field position-relative  d-inline-block">
												<input type="text" name="select1" value="1" class="quantity-input-arrow quantity-input-2  text-center">
											</div>
										</td>
										<td class="product-subtotal"> <span><bdi><span class="Price-currencySymbol">$</span>4.00</bdi></span></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="or-cart-copun">
							<div class="or-cart-copun-code">
								<form action="#">
									<input type="text" placeholder="Coupon Code">
									<button type="submit">Apply</button>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="or-cart-total-warpper text-center headline pera-content top-sticky">
							<h3>Cart Totals</h3>
							<table>
								<tbody>
									<tr>
										<td>
											<p class="v-title">Subtotal	</p>
										</td>
										<td>
											<p class="v-price">	£245.00</p>
										</td>
									</tr>
									<tr>
										<td>
											<p class="v-title">Total</p>
										</td>
										<td>
											<p class="v-price">	£245.00</p>
										</td>
									</tr>
								</tbody>
							</table>
							<a class="d-flex justify-content-center align-items-center" href="checkout.html">Procced To Checkout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End of Cart section
	============================================= -->	