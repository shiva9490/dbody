<?php
$cik    =& get_instance();
$cv     =   $cik->config->item("upload_url");
?>
<section class="info-box-section">
	<div class="container">
		<div class="info-box-container">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<div class="info-box-item d-sm-flex text-center text-sm-left">
						<div class="info-icon">
							<img src="<?php echo $cik->config->item("val_url")?>images/info-item/info.svg" alt="info icon">
						</div>
						<div class="info-content">
							<h6>Place order</h6>
						</div>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="info-box-item d-sm-flex text-center text-sm-left">
						<div class="info-icon">
							<img src="<?php echo $cik->config->item("val_url")?>/images/info-item/credit-card.svg" alt="info icon">
						</div>
						<div class="info-content">
							<h6>Easy Payment</h6>
						</div>
					</div>
				</div>

				<div class="swiper-slide">
					<div class="info-box-item d-sm-flex text-center text-sm-left">
						<div class="info-icon">
							<img src="<?php echo $cik->config->item("val_url")?>images/info-item/info.svg" alt="info icon">
						</div>
						<div class="info-content">
							<h6>First Delivery</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>