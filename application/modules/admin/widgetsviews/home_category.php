<?php
$cik    =& get_instance();
$params["tiporderby"]   =   "category_order";
$params["order_by"]     =   "asc";
$params["limit"]     =   "10";
$res    =   $cik->category_model->viewcategory($params);
?>
<section class="catagory-section">
	<div class="container p-lg-0">
		<div class="section-heading">
			<h4 class="heading-title"><span class="heading-circle green"></span> Products Categories</h4>
		</div>

		<div class="section-wrapper">
			<!-- Add Arrows -->
			<div class="slider-btn-group">
				<div class="slider-btn-prev catagory-slider-prev">
					<i class="fas fa-angle-left"></i>
				</div>
				<div class="slider-btn-next catagory-slider-next">
					<i class="fas fa-angle-right"></i>
				</div>
			</div>
			<div class="catagory-container">
				<div class="swiper-wrapper">
					<?php
					if(count($res) > 0){
					    foreach($res as $cd){
					        $imsg       =   $cik->config->item("upload_url")."category/photo-not-available.png";
                            $target_dir =   $cik->config->item("upload_url")."category/".$cd->category_upload;
                            if(@getimagesize($target_dir)){
                                $imsg   =   $target_dir;
                            } 
					        ?>
			        <div class="swiper-slide">
						<a href="<?php echo base_url().'Category-List/'.$cd->category_keywords;?>" class="catagory-item">
							<div class="catagory-icon">
								 <img src="<?php echo $imsg;?>" class="category-list" />
							</div>
							<p class="catagory-name"><?php echo $cd->category_name;?></p>
						</a>
					</div>
					        <?php
					    }
					}
					?>
				</div>
			</div>
		</div>
	</div>
</section>