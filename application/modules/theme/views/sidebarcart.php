	<div class="or-ofcanvas-cart-content">
		<div class="title-area d-flex justify-content-between align-items-center">
			<div class="cart-title">
				<span>Cart</span>
			</div>
			<div class="cart-close">
				<button class="or-canvas-cart-trigger" onclick="closecart();"><i class="fal fa-times"></i></button>
			</div>
		</div>
		<?php 
			$country    =   $this->session->userdata("currency_code");
			$rtotl      =   $this->cart->contents();//print_r($rtotl);
			$coupon_data = $this->session->userdata("coupon_code");
			if(count($rtotl) > 0){
				$rirl   =   "0";$i=1;
				foreach($rtotl as $fr){
					if($fr['addon_id']==''){
						$coupon = ($coupon_data['coupon'])??'';
						if(!empty($coupon_data)){
							if(in_array($fr['prodid'],$coupon_data['products_applicable']) || $coupon_data['coupon_applicable'] == 'All') {
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
						$vtoal      =  "0";
						$vsso       =  $fr['name'];
						$delivery   =  isset($fr['delamount'])?$fr['delamount']:'0';
						$total      =  $fr["qty"]*($fr["price"]-$discount) ;
						$rirl   	+= $fr["qty"]*($fr["price"]-(float)$discount)+(float)$delivery;
			?>
			<div class="or-ofcart-product-wrapper">
				<div class="or-ofcart-product-item d-flex align-items-center position-relative">
					<div class="pro-remove position-absolute" onclick="removecart('<?php echo $fr['id'] ?>','<?php echo $fr['rowid'] ?>')"><i class="fal fa-times"></i></div>
					<div class="or-ofcart-product-img">
						<img src="<?php echo $fr['image'];?>" alt="">
					</div>
					<?php  'Width : '.$fr['size'].'<br>';
						if($fr['type'] !=''){echo 'Type : '.$fr['type'].'<br>';}
						'Delivery Amount :'.$this->customer_model->currency_change($country,$fr['delamount']).'<br>';
						$delpric  = $this->customer_model->currency_change($country,$fr['delamount']);
						$delpric = preg_replace('/[^0-9.]+/', '', $delpric);
					?>
					<div class="or-ofcart-product-text headline">
						<h3><a href="<?php echo base_url("Product-View/".$vsso);?>"><?php echo $fr["name"];?></a></h3>
						<span><?php echo $this->customer_model->currency_change($country,($fr["price"]-$discount)).' X '.$fr["qty"];?></span>
					</div>
				</div>
			</div>
		<?php $i++;} 
		}?>
		<div class="or-ofcart-total text-center">
			<span>Subtotal: <?php echo $this->customer_model->currency_change($country,$rirl);?></span>
			<div class="total-btn">
				<?php if($this->session->userdata('customer_id') == ""){ ?>
					<a onclick="OpenSignUpForm()" href="#" class="procced-checkout">Proceed Checkout</a>
				<?php }else{?>
					<a href="<?php echo base_url("/View-Cart");?>" class="procced-checkout">Proceed Checkout</a>
				<?php } ?>
			</div>
		</div>
		<?php } ?>
	</div>
 



	
