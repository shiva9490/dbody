 <!DOCTYPE html>
<html lang="en-US" itemscope="itemscope" itemtype="http://schema.org/WebPage">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BILDO</title>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("val_url");?>css/bootstrap.min.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("val_url");?>css/font-awesome.min.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("val_url");?>css/animate.min.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("val_url");?>css/font-electro.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("val_url");?>css/owl-carousel.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("val_url");?>css/style.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("val_url");?>css/colors/yellow.css" media="all" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,700italic,800,800italic,600italic,400italic,300italic' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="<?php echo $this->config->item("val_url");?>images/fav-icon.png">
    </head>

    <body class="home page-template page-template-template-homepage-v3 full-color-background"> 
        <div id="page" class="hfeed site">
            <a class="skip-link screen-reader-text" href="#site-navigation">Skip to navigation</a>
            <a class="skip-link screen-reader-text" href="#content">Skip to content</a>

            <div class="top-bar">
                <div class="container">
                    <nav>
                        <ul id="menu-top-bar-right" class="nav nav-inline pull-right animate-dropdown flip">
                            <li class="menu-item animate-dropdown"><a title="Store Locator" href="#"><i class="ec ec-map-pointer"></i>Store Locator</a></li>
                            <li class="menu-item animate-dropdown"><a title="Track Your Order" href="track-your-order.html"><i class="ec ec-transport"></i>Track Your Order</a></li>
                            <li class="menu-item animate-dropdown"><a title="Shop" href="<?php echo base_url('shop');?>"><i class="ec ec-shopping-bag"></i>Shop</a></li>
                            <li class="menu-item animate-dropdown"><a title="Vendors" href="" data-toggle="modal" data-target="#modalLRForm"><i class="ec ec-user"></i>Login/Register</a></li>
                        </ul>
                    </nav>
                </div>
            </div><!-- /.top-bar -->
            
            <header id="masthead" class="site-header header-v3">
                <div class="container">
                    <div class="row">

                        <!-- ============================================================= Header Logo ============================================================= -->
                        <div class="header-logo">
                        	<a href="<?php echo base_url('welcome') ?>" class="header-logo-link">
                        	<img src="<?php echo $this->config->item("admin_url");?>images/bildo-logo.png" alt="homepage" style="height:55px; width:200px;" />

                        	</a>
                        </div>
                        <!-- ============================================================= Header Logo : End============================================================= -->

                        <form class="navbar-search" method="get" action="/">
                        	<label class="sr-only screen-reader-text" for="search">Search for:</label>
                        	<div class="input-group">
                        		<input type="text" id="search" class="form-control search-field" dir="ltr" value="" name="s" placeholder="Search for products" />
                        		<div class="input-group-addon search-categories">
                        			<select name='product_cat' id='product_cat' class='postform resizeselect' >
                        				<option value='0' selected='selected'>All Categories</option>
                        				<?php  
                                                if(count($res) > 0){
                                                     foreach ($res as $re){  
                                                        ?>
                                                <option value="<?php echo $re->category_id?>"><?php echo $re->category_name ?></option>
                                             <?php
                                                    }
                                                 }
                                            ?>
                        			</select>
                        		</div>
                        		<div class="input-group-btn">
                        			<input type="hidden" id="search-param" name="post_type" value="product" />
                        			<button type="submit" class="btn btn-secondary"><i class="ec ec-search"></i></button>
                        		</div>
                        	</div>
                        </form>
                        <ul class="navbar-mini-cart navbar-nav animate-dropdown nav pull-right flip">
                        	<li class="nav-item dropdown">
                        		<a href="" class="nav-link" data-toggle="dropdown" onclick="javascript:opencart()">
                        			<i class="ec ec-shopping-bag"></i>
                        			<span class="cart-items-count count"><?php echo count($this->cart->contents());  ?></span>
                        			
                        		</a>
                        		<ul class="dropdown-menu dropdown-menu-mini-cart">
                        			<li>
                        				<div class="widget_shopping_cart_content">

                        					<ul class="cart_list product_list_widget ">


                        						


                        					</ul><!-- end product list -->


                        					<p class="total"><strong>Subtotal:</strong> <span class="amount">£969.98</span></p>


                        					<p class="buttons">
                        						<a class="button wc-forward" href="cart.html">View Cart</a>
                        						<a class="button checkout wc-forward" href="<?php echo base_url('checkout')?>">Checkout</a>
                        					</p>


                        				</div>
                        			</li>
                        		</ul>
                        	</li>
                        </ul>

                        <ul class="navbar-wishlist nav navbar-nav pull-right flip">
                        	<li class="nav-item">
                        		<a href="wishlist.html" class="nav-link"><i class="ec ec-favorites"></i></a>
                        	</li>
                        </ul>
                        <ul class="navbar-compare nav navbar-nav pull-right flip">
                        	<li class="nav-item">
                        		<a href="compare.html" class="nav-link"><i class="ec ec-compare"></i></a>
                        	</li>
                        </ul>
                    </div><!-- /.row -->
                </div>
            </header><!-- #masthead -->

            <nav class="navbar navbar-primary navbar-full yamm">
            	<div class="container">
            		<div class="clearfix">
            			<button class="navbar-toggler hidden-sm-up pull-right flip" type="button" data-toggle="collapse" data-target="#header-v3">
            				&#9776;
            			</button>
            		</div>

            		<div class="collapse navbar-toggleable-xs" id="header-v3">
            			<ul class="nav navbar-nav">
            				<li class="menu-item
            				animate-dropdown"><a title="Scaffoldings" href="">Scaffoldings</a></li>
            				<li class="menu-item"><a title="Metal Building Materials" href="">Metal Building Materials</a></li>
            				<li class="menu-item"><a title="Roof Tiles" href="">Roof Tiles</a></li>
            				<li class="menu-item"><a title="Cement" href="">Cement</a></li>
            				<li class="menu-item"><a title="Plywoods" href="">Plywoods</a></li>
            				<li class="menu-item"><a title="Aluminum Composite Panels" href="">Aluminum Composite Panels</a></li>
            				
            			</ul>
            		</div>
            	</div>
            </nav>


<?php $this->load->view("$content");?>



 <footer id="colophon" class="site-footer">
                

                <div class="footer-newsletter">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-7">
                                <h5 class="newsletter-title">Sign up to Newsletter</h5>
                                <span class="newsletter-marketing-text">...and receive <strong>$20 coupon for first shopping</strong></span>
                            </div>
                            <div class="col-xs-12 col-sm-5">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Enter your email address">
                                        <span class="input-group-btn">
                                            <button class="btn btn-secondary" type="button">Sign Up</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom-widgets">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-7 col-md-push-5">
                                <div class="columns">
                                    <aside id="nav_menu-2" class="widget clearfix widget_nav_menu">
                                        <div class="body">
                                            <h4 class="widget-title">Find It Fast</h4>
                                            <div class="menu-footer-menu-1-container">
                                                <ul id="menu-footer-menu-1" class="menu">
                                                    <li class="menu-item"><a href="single-product.html">Laptops &#038; Computers</a></li>
                                                    <li class="menu-item"><a href="single-product.html">Cameras &#038; Photography</a></li>
                                                    <li class="menu-item"><a href="single-product.html">Smart Phones &#038; Tablets</a></li>
                                                    <li class="menu-item"><a href="single-product.html">Video Games &#038; Consoles</a></li>
                                                    <li class="menu-item"><a href="single-product.html">TV &#038; Audio</a></li>
                                                    <li class="menu-item"><a href="single-product.html">Gadgets</a></li>
                                                    <li class="menu-item "><a href="single-product.html">Car Electronic &#038; GPS</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </aside>
                                </div><!-- /.columns -->

                                <div class="columns">
                                    <aside id="nav_menu-3" class="widget clearfix widget_nav_menu">
                                        <div class="body">
                                            <h4 class="widget-title">&nbsp;</h4>
                                            <div class="menu-footer-menu-2-container">
                                                <ul id="menu-footer-menu-2" class="menu">
                                                    <li class="menu-item"><a href="single-product.html">Printers &#038; Ink</a></li>
                                                    <li class="menu-item "><a href="single-product.html">Software</a></li>
                                                    <li  class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2742"><a href="single-product.html">Office Supplies</a></li>
                                                    <li  class="menu-item "><a href="single-product.html">Computer Components</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </aside>
                                </div><!-- /.columns -->

                                <div class="columns">
                                    <aside id="nav_menu-4" class="widget clearfix widget_nav_menu">
                                        <div class="body">
                                            <h4 class="widget-title">Customer Care</h4>
                                            <div class="menu-footer-menu-3-container">
                                                <ul id="menu-footer-menu-3" class="menu">
                                                    <li class="menu-item"><a href="single-product.html">My Account</a></li>
                                                    <li class="menu-item"><a href="single-product.html">Track your Order</a></li>
                                                    <li class="menu-item"><a href="single-product.html">Wishlist</a></li>
                                                    <li class="menu-item"><a href="single-product.html">Customer Service</a></li>
                                                    <li class="menu-item"><a href="single-product.html">Returns/Exchange</a></li>
                                                    <li class="menu-item"><a href="single-product.html">FAQs</a></li>
                                                    <li class="menu-item"><a href="hsingle-product.html">Product Support</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </aside>
                                </div><!-- /.columns -->

                            </div><!-- /.col -->

                            <div class="footer-contact col-xs-12 col-sm-12 col-md-5 col-md-pull-7">
                                <div class="footer-logo">
                                 <img src="<?php echo $this->config->item("admin_url");?>images/bildo-logo.png" alt="homepage" style="height:55px; width:200px;" />
                                </div><!-- /.footer-contact -->

                                <div class="footer-call-us">
                                    <div class="media">
                                        <span class="media-left call-us-icon media-middle"><i class="ec ec-support"></i></span>
                                        <div class="media-body">
                                            <span class="call-us-text">Got Questions ? Call us 24/7!</span>
                                            <span class="call-us-number">(800) 8001-8588, (0600) 874 548</span>
                                        </div>
                                    </div>
                                </div><!-- /.footer-call-us -->


                                <div class="footer-address">
                                    <strong class="footer-address-title">Contact Info</strong>
                                    <address>17 Princess Road, London, Greater London NW1 8JR, UK</address>
                                </div><!-- /.footer-address -->

                                <div class="footer-social-icons">
                                    <ul class="social-icons list-unstyled">
                                        <li><a class="fa fa-facebook" href="http://themeforest.net/user/shaikrilwan/portfolio"></a></li>
                                        <li><a class="fa fa-twitter" href="http://themeforest.net/user/shaikrilwan/portfolio"></a></li>
                                        <li><a class="fa fa-pinterest" href="http://themeforest.net/user/shaikrilwan/portfolio"></a></li>
                                        <li><a class="fa fa-linkedin" href="http://themeforest.net/user/shaikrilwan/portfolio"></a></li>
                                        <li><a class="fa fa-google-plus" href="http://themeforest.net/user/shaikrilwan/portfolio"></a></li>
                                        <li><a class="fa fa-tumblr" href="http://themeforest.net/user/shaikrilwan/portfolio"></a></li>
                                        <li><a class="fa fa-instagram" href="http://themeforest.net/user/shaikrilwan/portfolio"></a></li>
                                        <li><a class="fa fa-youtube" href="http://themeforest.net/user/shaikrilwan/portfolio"></a></li>
                                        <li><a class="fa fa-rss" href="#"></a></li>
                                        </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="copyright-bar">
                    <div class="container">
                        <div class="pull-left flip copyright">&copy; <a href="">BILDO</a> - All Rights Reserved</div>
                        <div class="pull-right flip payment">
                            <div class="footer-payment-logo">
                                <ul class="cash-card card-inline">
                                    <li class="card-item"><img src="<?php echo $this->config->item("val_url");?>images/footer/payment-icon/1.png" alt="" width="52"></li>
                                    <li class="card-item"><img src="<?php echo $this->config->item("val_url");?>images/footer/payment-icon/2.png" alt="" width="52"></li>
                                    <li class="card-item"><img src="<?php echo $this->config->item("val_url");?>images/footer/payment-icon/3.png" alt="" width="52"></li>
                                    <li class="card-item"><img src="<?php echo $this->config->item("val_url");?>images/footer/payment-icon/4.png" alt="" width="52"></li>
                                    <li class="card-item"><img src="<?php echo $this->config->item("val_url");?>images/footer/payment-icon/5.png" alt="" width="52"></li>
                                </ul>
                            </div><!-- /.payment-methods -->
                        </div>
                    </div><!-- /.container -->
                </div><!-- /.copyright-bar -->
            </footer><!-- #colophon --><!-- #colophon -->

        </div><!-- #page -->
      
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/tether.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/owl.carousel.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/echo.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/wow.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/jquery.easing.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/jquery.waypoints.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/jquery.validate.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/electro.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/bildo_main.js"></script>

        
       
        <script>
            jQuery(function(){
                jQuery(".formvalid").validate({
                        errorElement:"div",
                        errorClass:"text-danger",
                        errorPlacement: function (error, element) { 
                            if (element.attr("type") == "radio") {
                                error.insertAfter(jQuery(element).parent());
                            }else{
                                error.insertAfter(jQuery(element)); 
                            }
                        },
                        otp_mobile_no:{
                           required:true,
                           minlength: 10,
                           maxlength:10
                        },
                        messages:{ 
                            user_type:"User Type is required",
                            otp_mobile_no:{
                                required:"Mobile No is required"
                            }
                        },
                        highlight: function (element, errorClass) {
                            jQuery(element).closest('.form-group').addClass('has-error');
                        },
                        unhighlight: function (element, errorClass) {
                            jQuery(element).closest('.form-group').removeClass('has-error');
                        }
                });
            });
        </script>
    <script>
        jQuery(".otpdivshide").hide();
        function submitform(){ 
                var vsldi = jQuery(".formvalid").valid();
                if(vsldi){
                    var user_type     =   jQuery(".user_type:checked").val();
                    var loginmobile   =   jQuery("#otp_mobile_no").val();
                    jQuery.post("/otp",{loginmobile:loginmobile,user_type:user_type},function(data){
                        if(data){
                            jQuery(".hideotp").hide();  
                            jQuery(".otpdivshide").show();  
                        }
                    });
                }
        }
        function verifyotp(){ 
                var vsldi = jQuery(".formvalid").valid();
                if(vsldi){
                    var otp_key     =   jQuery(".otp_key").val();
                    var user_type     =   jQuery(".user_type:checked").val();
                    var loginmobile   =   jQuery("#otp_mobile_no").val();
                    jQuery.post("/verifyotp",{loginmobile:loginmobile,otp_key:otp_key,user_type:user_type},function(data){
                        if(data == '0'){
                            jQuery(".hideotp").hide();  
                            jQuery(".otpdivshide").show();  
                        }
                        if(data == '1'){
                            window.location.href='<?php echo base_url('vendor');?>';
                        }
                        if(data == '2'){
                            window.location.href='<?php echo base_url('vendor_product');?>';
                        }
                        if(data == '3'){
                            window.location.href='<?php echo base_url('customer');?>';
                        }
                    });
                }
        }
    </script>  
    </body>
</html>
