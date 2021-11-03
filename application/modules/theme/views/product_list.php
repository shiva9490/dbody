
<!-- Start of Breadcrumb section
	============================================= -->
	<section id="or-breadcrumbs" class="or-breadcrumbs-section position-relative" data-background="assets/img/bg/bg-page-title.jpg">
		<div class="background_overlay"></div>
		<div class="container">
			<div class="or-breadcrumbs-content text-center">
				<div class="page-title headline"><h1>Shop</h1></div>
				<div class="or-breadcrumbs-items ul-li">
					<ul>
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<?php if(is_array($view) && count($view) >0){;?>
						<li><?php echo ($view["category_name"] != "")?$view["category_name"]:'';?></li>
						<?php }elseif(isset($_GET['search']) && $_GET['search'] !=""){
						'<li>'.$_GET['search'].'</li>';
						} ?>
					</ul>
				</div>
			</div>
		</div>
	</section>
<!-- End of Breadcrumb section
	============================================= -->

<!-- Start of Shop product section
	============================================= -->
	<section id="or-shop-product" class="or-shop-product-section">
		<div class="container">
			<div class="or-section-title headline pera-content text-center middle-align">
				<span class="sub-title">Products</span>
				<h2>All of our products are
				organic & fresh.</h2>
			</div>
			<div class="or-product-shop-content">
				<div class="container">
					<div class="row">
						<input type="hidden" name="category" id="category" value="<?php echo $this->uri->segment("1");?>">
						<input type="hidden" name="subcategory" id="subcategory" value="<?php echo $this->uri->segment("2");?>">
						<input type="hidden" name="urll" id="urll" value="<?php echo $urlvalue.'/';?>">	
						<?php //$this->load->view("theme/loader");?>
						<span class="postList">
							<?php $this->load->view("ajaxvendorproducts");?>
						</span>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End of Shop product section
	============================================= -->			  
           