<?php
    $country =  $this->session->userdata("currency_code");
    if($country == ""){
        $this->customer_model->detect_city();
    }
?>
<!-- Start of header section
	============================================= -->
	<header id="organio-header" class="organio-header-section header-style-one">
		<div class="header-top">
			<div class="container">
				<div class="header-top-content d-flex justify-content-between align-items-center">
					<div class="header-slug">
						<span> Welcome to our Organic store Organico!</span>
					</div>
					<div class="or-header-cart-btn or-canvas-cart-trigger opencart"  data-lar="<?php echo base_url().'viewCartpupdate/';?>" onclick="cartopen()">
						<i class="fas fa-shopping-cart"></i> Cart: <span class="count"><?php echo count($this->cart->contents());?></span> -
						<span class="price">
							<?php 
								$rtotl      =   $this->cart->contents();
								$rirl   =   "0";
								foreach($rtotl as $fr){
									$vtoal      =  "0";
									$vsso       =  $fr['name'];
									$delivery   =  isset($fr['delamount'])?$fr['delamount']:'0';
									$rirl       +=  $fr["qty"]*$fr["price"]+(float)$delivery;
								}
								echo $this->customer_model->currency_change($country,$rirl);
							?>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="organic-main-navigation">
			<div class="container">
				<div class="organic-header-content  position-relative">
					<div class="site-logo">
						<a href="#"><img src="assets/img/logo/logo1.png" alt=""></a>
					</div>
					<nav class="main-navigation-area clearfix ul-li">
						<ul class="menu-navigation left-nav">
							<li>
								<a href="<?php echo base_url();?>">Home</a>
							</li>
							<li><a href="<?php echo base_url('About');?>">About</a></li>
							<li>
								<a href="<?php echo base_url('Products');?>">Shop</a>								
							</li>
							<li class="dropdown">
								<a href="%21.html#">Pages</a>
								<ul class="dropdown-menu clearfix">
									<li><a target="_blank" href="service.html">Services</a></li>
									<li><a target="_blank" href="service-single.html">Services Details</a></li>
									<li><a target="_blank" href="contact.html">Contact Page</a></li>
									<li><a target="_blank" href="404.html">404  Page</a></li>
								</ul>
							</li>
						</ul>
						<ul class="menu-navigation right-nav">
							<li class="dropdown">
								<a href="%21.html#">Team</a>
								<ul class="dropdown-menu clearfix">
									<li><a target="_blank" href="team.html">Team Page</a></li>									
									<li><a target="_blank" href="team-single.html">Team Details</a></li>
								</ul>
							</li>
							<li><a href="<?php echo base_url('Blog');?>">News</a></li>
							<li class="dropdown">
								<a href="%21.html#">Project</a>
								<ul class="dropdown-menu clearfix">
									<li><a target="_blank" href="project.html">Project Page </a></li>
									<li><a target="_blank" href="project-single.html">Project Details </a></li>
								</ul>
							</li>			
						</ul>
					</nav>
					<div class="header-search-btn search-btn">
						<button class="search-box-outer"><i class="fas fa-search"></i></button>
					</div>
					<div class="header-search-btn cart-btn">
						<button class="or-canvas-cart-trigger"><i class="fas fa-shopping-cart"></i></button>
					</div>
				</div>
			</div>
		</div>
		<div class="mobile_menu position-relative">
			<div class="mobile_menu_button open_mobile_menu">
				<i class="fal fa-bars"></i>
			</div>
			<div class="mobile_menu_wrap">
				<div class="mobile_menu_overlay open_mobile_menu"></div>
				<div class="mobile_menu_content">
					<div class="mobile_menu_close open_mobile_menu">
						<i class="fal fa-times"></i>
					</div>
					<div class="m-brand-logo">
						<a href="%21.html#"><img src="assets/img/logo/logo1.png" alt=""></a>
					</div>
					<div class="mobile-search-wrapper position-relative">
						<form action="#">
							<input type="text" placeholder="Search Here...">
							<button><i class="fas fa-search"></i></button>
						</form>
					</div>
					<nav class="mobile-main-navigation  clearfix ul-li">
						<ul id="m-main-nav" class="navbar-nav text-capitalize clearfix">
							<li class="dropdown">
								<a href="%21.html#">Home</a>
								<ul class="dropdown-menu clearfix">
									<li><a target="_blank" href="index.html">Home Page 1</a></li>
									<li class="dropdown">
										<a target="_blank" href="index-2.html">Home Page 2</a>
										<ul class="dropdown-menu clearfix">
											<li><a target="_blank" href="#">Example v.1 </a></li>
											<li><a target="_blank" href="#">Example v.2</a></li>
											<li><a target="_blank" href="#">Example v.3</a></li>
										</ul>
									</li>
									<li><a target="_blank" href="index-3.html">Home Page 3</a></li>
									<li><a target="_blank" href="index-4.html">Home Page 4</a></li>
								</ul>
							</li>
							<li><a target="_blank" href="about.html">About</a></li>
							<li class="dropdown">
								<a target="_blank" href="%21.html#">Shop</a>
								<ul class="dropdown-menu clearfix">
									<li><a target="_blank" href="shop.html">Shop Page </a></li>
									<li><a target="_blank" href="shop-single.html">Shop Details</a></li>
									<li><a target="_blank" href="cart.html">Cart Page</a></li>
									<li><a target="_blank" href="checkout.html">Checkout Page</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a target="_blank" href="%21.html#">Pages</a>
								<ul class="dropdown-menu clearfix">
									<li><a target="_blank" href="service.html">Services</a></li>
									<li><a target="_blank" href="team.html">Team Page</a></li>
									<li><a target="_blank" href="team-single.html">Team Details</a></li>
									<li><a target="_blank" href="service-single.html">Service Details</a></li>
									<li><a target="_blank" href="contact.html">Contact Page</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a target="_blank" href="%21.html#">News</a>
								<ul class="dropdown-menu clearfix">
									<li><a target="_blank" href="blog.html">News </a></li>
									<li><a target="_blank" href="blog-single.html">News Details</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a target="_blank" href="%21.html#">Others</a>
								<ul class="dropdown-menu clearfix">
									<li><a target="_blank" href="project.html">Portfolio </a></li>
									<li><a target="_blank" href="404.html">404 Page </a></li>
									<li><a target="_blank" href="project-single.html">Portfolio Details</a></li>
								</ul>
							</li>
						</ul>
					</nav>
				</div>
			</div>
			<!-- /Mobile-Menu -->
		</div>
	</header>
	<div class="search-popup">
		<button class="close-search style-two"><span class="fal fa-times"></span></button>
		<button class="close-search"><span class="fa fa-arrow-up"></span></button>
		<form method="post" action="https://html.themexriver.com/organio/blog.html">
			<div class="form-group">
				<input type="search" name="search-field" value="" placeholder="Search Here" required="">
				<button type="submit"><i class="fa fa-search"></i></button>
			</div>
		</form>
	</div>
	<div class="or-ofcanvas-cart-wrapper cartlog">
		<span class="postList"></span>
	</div>
<!-- End of header section
	============================================= -->	