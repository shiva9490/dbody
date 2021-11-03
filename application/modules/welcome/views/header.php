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

    <body class="page home page-template-default">
        <div id="page" class="hfeed site">
            <a class="skip-link screen-reader-text" href="#site-navigation">Skip to navigation</a>
            <a class="skip-link screen-reader-text" href="#content">Skip to content</a>

            <div class="top-bar">
                <div class="container">
                    
                    
                    <nav>
                        <ul id="menu-top-bar-right" class="nav nav-inline pull-right animate-dropdown flip">
                            <li class="menu-item animate-dropdown"><a title="Vendors" href="" data-toggle="modal" data-target="#modalLRForm"><i class="ec ec-user"></i><?php echo $this->session->userdata("vendor_name");?></a></li>
                        </ul>
                    </nav>
                </div>
            </div><!-- /.top-bar --> 

<header id="masthead" class="site-header header-v2" style="background-color: #fed700">
                <div class="container">
                    <div class="row">

                        <!-- ============================================================= Header Logo ============================================================= -->
                        <div class="header-logo">
                            <a href="home.html" class="header-logo-link">
                             <img src="<?php echo $this->config->item("admin_url");?>images/bildo_logo2.png" alt="homepage" style="height:55px; width:200px;" />

                            </a>
                        </div>
                        <!-- ============================================================= Header Logo : End============================================================= -->

                        <div class="primary-nav animate-dropdown">
                            <div class="clearfix">
                                 <button class="navbar-toggler hidden-sm-up pull-right flip" type="button" data-toggle="collapse" data-target="#default-header">
                                        &#9776;
                                 </button>
                             </div>

                            <div class="collapse navbar-toggleable-xs" id="default-header">
                                <nav>
                                    <ul id="menu-main-menu" class="nav nav-inline yamm">
                                        <li class="menu-item menu-item-has-children animate-dropdown dropdown"><a title="Home" href="shop.html" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Home</a>
                                            <ul role="menu" class=" dropdown-menu">
                                                <li class="menu-item animate-dropdown  "><a title="Home v1" href="home.html">Home v1</a></li>
                                                <li class="menu-item current-menu-item current_page_item animate-dropdown active"><a title="Home v2" href="home-v2.html">Home v2</a></li>
                                                <li class="menu-item animate-dropdown  "><a title="Home v3" href="home-v3.html">Home v3</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item animate-dropdown"><a title="About Us" href="about.html">About Us</a></li>

                                        <li class="menu-item menu-item-has-children animate-dropdown dropdown"><a title="Blog" href="blog.html" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Blog</a>
                                            <ul role="menu" class=" dropdown-menu">
                                                <li class="menu-item animate-dropdown"><a title="Blog v1" href="blog-v1.html">Blog v1</a></li>
                                                <li class="menu-item animate-dropdown"><a title="Blog v2" href="blog-v2.html">Blog v2</a></li>
                                                <li class="menu-item animate-dropdown"><a title="Blog v3" href="blog-v3.html">Blog v3</a></li>
                                            </ul>
                                        </li>
                                        <li class="yamm-fw menu-item menu-item-has-children animate-dropdown dropdown">
                                            <a title="Pages" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Pages</a>
                                            <ul role="menu" class=" dropdown-menu">
                                                <li class="menu-item animate-dropdown">
                                                    <div class="yamm-content" style="display:inline-block; width: 100%;">
                                                        <div class="row">
                                                            <div class="wpb_column vc_column_container col-sm-4">
                                                                <div class="vc_column-inner ">
                                                                    <div class="wpb_wrapper">
                                                                        <div class="vc_wp_custommenu wpb_content_element">
                                                                            <div class="widget widget_nav_menu">
                                                                                <div class="menu-pages-menu-1-container">
                                                                                    <ul id="menu-pages-menu-1" class="menu">
                                                                                        <li class="nav-title menu-item"><a href="#">Home &#038; Static Pages</a></li>
                                                                                        <li class="menu-item"><a href="home.html">Home v1</a></li>
                                                                                        <li class="menu-item current-menu-item current_page_item"><a href="home-v2.html">Home v2</a></li>
                                                                                        <li class="menu-item"><a href="home-v3.html">Home v3</a></li>
                                                                                        <li class="menu-item"><a href="about.html">About</a></li>
                                                                                        <li class="menu-item"><a href="contact-v2.html">Contact v2</a></li>
                                                                                        <li class="menu-item"><a href="contact-v1.html">Contact v1</a></li>
                                                                                        <li class="menu-item"><a href="faq.html">FAQ</a></li>
                                                                                        <li class="menu-item"><a href="store-directory.html">Store Directory</a></li>
                                                                                        <li class="menu-item"><a href="terms-and-conditions.html">Terms and Conditions</a></li>
                                                                                        <li class="menu-item"><a href="404.html">404</a></li>
                                                                                        <li class="nav-title menu-item"><a href="#">Product Categories</a></li>
                                                                                        <li class="menu-item"><a href="cat-3-col.html">3 Column Sidebar</a></li>
                                                                                        <li class="menu-item"><a href="cat-4-col.html">4 Column Sidebar</a></li>
                                                                                        <li class="menu-item"><a href="cat-4-fw.html">4 Column Full width</a></li>
                                                                                        <li class="menu-item"><a href="product-category-6-column.html">6 Columns Full width</a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="wpb_column vc_column_container col-sm-4">
                                                                <div class="vc_column-inner ">
                                                                    <div class="wpb_wrapper">
                                                                        <div class="vc_wp_custommenu wpb_content_element">
                                                                            <div class="widget widget_nav_menu">
                                                                                <div class="menu-pages-menu-2-container">
                                                                                    <ul id="menu-pages-menu-2" class="menu">
                                                                                        <li class="nav-title menu-item"><a href="#">Shop Pages</a></li>
                                                                                        <li class="menu-item"><a href="shop.html#grid">Shop Grid</a></li>
                                                                                        <li class="menu-item"><a href="shop.html#grid-extended">Shop Grid Extended</a></li>
                                                                                        <li class="menu-item"><a href="shop.html#list-view">Shop List View</a></li>
                                                                                        <li class="menu-item"><a href="shop.html#list-view-small">Shop List View Small</a></li>
                                                                                        <li class="menu-item"><a href="shop.html">Shop Left Sidebar</a></li>
                                                                                        <li class="menu-item"><a href="shop-fw.html">Shop Full width</a></li>
                                                                                        <li class="menu-item"><a href="shop-right-side-bar.html">Shop Right Sidebar</a></li>
                                                                                        <li class="nav-title menu-item"><a href="#">Blog Pages</a></li>
                                                                                        <li class="menu-item"><a href="blog-v1.html">Blog v1</a></li>
                                                                                        <li class="menu-item"><a href="blog-v3.html">Blog v3</a></li>
                                                                                        <li class="menu-item"><a href="blog-v2.html">Blog v2</a></li>
                                                                                        <li class="menu-item"><a href="blog-fw.html">Blog Full Width</a></li>
                                                                                        <li class="menu-item"><a href="blog-single.html">Single Blog Post</a></li>

                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="wpb_column vc_column_container col-sm-4">
                                                                <div class="vc_column-inner ">
                                                                    <div class="wpb_wrapper">
                                                                        <div class="vc_wp_custommenu wpb_content_element">
                                                                            <div class="widget widget_nav_menu">
                                                                                <div class="menu-pages-menu-3-container">
                                                                                    <ul id="menu-pages-menu-3" class="menu">
                                                                                        <li class="nav-title menu-item"><a href="single-product.html">Single Product Pages</a></li>
                                                                                        <li class="menu-item"><a href="single-product-extended.html">Single Product Extended</a></li>
                                                                                        <li class="menu-item"><a href="single-product.html">Single Product Fullwidth</a></li>
                                                                                        <li class="menu-item"><a href="single-product-sidebar.html">Single Product Sidebar</a></li>
                                                                                        <li class="menu-item"><a href="single-product-sidebar-accessories.html">Single Product Sidebar Accessories </a></li>
                                                                                        <li class="menu-item"><a href="single-product-sidebar-specification.html">Single Product Sidebar Specification </a></li>
                                                                                        <li class="menu-item"><a href="single-product-sidebar-reviews.html">Single Product Sidebar Reviews </a></li>
                                                                                        <li class="nav-title menu-item"><a href="#">Ecommerce Pages</a></li>
                                                                                        <li class="menu-item"><a href="shop.html">Shop</a></li>
                                                                                        <li class="menu-item"><a href="cart.html">Cart</a></li>
                                                                                        <li class="menu-item"><a href="checkout.html">Checkout</a></li>
                                                                                        <li class="menu-item"><a href="my-account.html">My Account</a></li>
                                                                                        <li class="menu-item"><a href="compare.html">Compare</a></li>
                                                                                        <li class="menu-item"><a href="wishlist.html">Wishlist</a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-item"><a title="Features" href="#">Features</a></li>
                                        <li class="menu-item"><a title="Contact Us" href="#">Contact Us</a></li>
                                    </ul>
                                </nav>   
                            </div>
                        </div>

                        <div class="header-support-info">
                            <div class="media">
                                <span class="media-left support-icon media-middle"><i class="ec ec-support"></i></span>
                                <div class="media-body">
                                    <span class="support-number"><strong>Support</strong> (+800) 856 800 604</span><br/>
                                    <span class="support-email">Email: info@bildo.com</span>
                                </div>
                            </div>
                        </div>

                    </div><!-- /.row -->
                </div>
            </header><!-- #masthead -->