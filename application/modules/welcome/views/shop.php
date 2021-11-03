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

    <body class="left-sidebar">
        <div id="page" class="hfeed site">
            <a class="skip-link screen-reader-text" href="#site-navigation">Skip to navigation</a>
            <a class="skip-link screen-reader-text" href="#content">Skip to content</a>

            <div class="top-bar">
                <div class="container">
                    <nav>
                        <ul id="menu-top-bar-left" class="nav nav-inline pull-left animate-dropdown flip">
                            <li class="menu-item animate-dropdown"><a title="Welcome to BILDO Store" href="#">Welcome to BILDO Store</a></li>
                        </ul>
                    </nav>

                    <nav>
                        <ul id="menu-top-bar-right" class="nav nav-inline pull-right animate-dropdown flip">
                            <li class="menu-item animate-dropdown"><a title="Store Locator" href="#"><i class="ec ec-map-pointer"></i>Store Locator</a></li>
                            <li class="menu-item animate-dropdown"><a title="Track Your Order" href="track-your-order.html"><i class="ec ec-transport"></i>Track Your Order</a></li>
                            <li class="menu-item animate-dropdown"><a title="Shop" href="<?php echo base_url('shop') ?>"><i class="ec ec-shopping-bag"></i>Shop</a></li>
                            <li class="menu-item animate-dropdown"><a title="My Account" href="my-account.html"><i class="ec ec-user"></i>My Account</a></li>
                        </ul>
                    </nav>
                </div>
            </div><!-- /.top-bar -->

            <header id="masthead" class="site-header header-v2">
                <div class="container">
                    <div class="row">

                        <!-- ============================================================= Header Logo ============================================================= -->
                        <div class="header-logo">
                            <a href="<?php echo base_url('welcome') ?>" class="header-logo-link">
                        	<img src="<?php echo $this->config->item("admin_url");?>images/bildo-logo.png" alt="homepage" style="height:55px; width:200px;" />

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
                                        <li class="menu-item menu-item-has-children animate-dropdown dropdown"><a title="Home" href="<?php echo base_url('welcome') ?>" class="dropdown-toggle" aria-haspopup="true">Home</a>
                                            
                                        </li>
                                        <li class="menu-item animate-dropdown"><a title="About Us" href="about.html">About Us</a></li>

                                        <li class="menu-item menu-item-has-children animate-dropdown dropdown"><a title="Blog" href="blog.html" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Blog</a>
                                           
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
                                    <span class="support-email">Email: info@electro.com</span>
                                </div>
                            </div>
                        </div>

                    </div><!-- /.row -->
                </div>
            </header><!-- #masthead -->

            <nav class="navbar navbar-primary navbar-full">
                <div class="container">
                    <ul class="nav navbar-nav departments-menu animate-dropdown">
                        <li class="nav-item dropdown ">

                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="departments-menu-toggle" >Shop by Department</a>
                            <ul id="menu-vertical-menu" class="dropdown-menu yamm departments-menu-dropdown">
                                <li class="highlight menu-item animate-dropdown active"><a title="Value of the Day" href="product-category.html">Value of the Day</a></li>
                                <li class="highlight menu-item animate-dropdown"><a title="Top 100 Offers" href="home-v3.html">Top 100 Offers</a></li>
                                <li class="highlight menu-item animate-dropdown"><a title="New Arrivals" href="home-v3-full-color-background.html">New Arrivals</a></li>

                                <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown menu-item-2584 dropdown">
                                    <a title="Computers &amp; Accessories" href="product-category.html" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Computers &#038; Accessories</a>
                                    <ul role="menu" class=" dropdown-menu">
                                        <li class="menu-item animate-dropdown menu-item-object-static_block">
                                            <div class="yamm-content">
                                                <div class="vc_row row wpb_row vc_row-fluid bg-yamm-content bg-yamm-content-bottom bg-yamm-content-right">
                                                    <div class="wpb_column vc_column_container vc_col-sm-12 col-sm-12">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_single_image wpb_content_element vc_align_left">
                                                                    <figure class="wpb_wrapper vc_figure">
                                                                        <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="540" height="460" src="<?php echo $this->config->item("val_url");?>images/megamenu-2.png" class="vc_single_image-img attachment-full" alt="megamenu-2"/></div>
                                                                    </figure>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vc_row row wpb_row vc_row-fluid">
                                                    <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_text_column wpb_content_element ">
                                                                    <div class="wpb_wrapper">
                                                                        <ul>
                                                                            <li class="nav-title">Computers &amp; Accessories</li>
                                                                            <li><a href="#">All Computers &amp; Accessories</a></li>
                                                                            <li><a href="#">Laptops, Desktops &amp; Monitors</a></li>
                                                                            <li><a href="#">Pen Drives, Hard Drives &amp; Memory Cards</a></li>
                                                                            <li><a href="#">Printers &amp; Ink</a></li>
                                                                            <li><a href="#">Networking &amp; Internet Devices</a></li>
                                                                            <li><a href="#">Computer Accessories</a></li>
                                                                            <li><a href="#">Software</a></li>
                                                                            <li class="nav-divider"></li>
                                                                            <li><a href="#"><span class="nav-text">All Electronics</span><span class="nav-subtext">Discover more products</span></a></li>
                                                                        </ul>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_text_column wpb_content_element ">
                                                                    <div class="wpb_wrapper">
                                                                        <ul>
                                                                            <li class="nav-title">Office &amp; Stationery</li>
                                                                            <li><a href="#">All Office &amp; Stationery</a></li>
                                                                            <li><a href="#">Pens &amp; Writing</a></li>
                                                                        </ul>
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

                                <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown menu-item-2585 dropdown">
                                    <a title="Cameras, Audio &amp; Video" href="product-category.html" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Cameras, Audio &#038; Video</a>
                                    <ul role="menu" class=" dropdown-menu">
                                        <li class="menu-item animate-dropdown menu-item-object-static_block">
                                            <div class="yamm-content">
                                                <div class="vc_row row wpb_row vc_row-fluid bg-yamm-content bg-yamm-content-bottom bg-yamm-content-right">
                                                    <div class="wpb_column vc_column_container vc_col-sm-12 col-sm-12">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_single_image wpb_content_element vc_align_left">
                                                                    <figure class="wpb_wrapper vc_figure">
                                                                        <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="540" height="460" src="<?php echo $this->config->item("val_url");?>images/megamenu-2.png" class="vc_single_image-img attachment-full" alt="megamenu-2"/></div>
                                                                    </figure>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vc_row row wpb_row vc_row-fluid">
                                                    <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_text_column wpb_content_element ">
                                                                    <div class="wpb_wrapper">
                                                                        <ul>
                                                                            <li class="nav-title">Computers &amp; Accessories</li>
                                                                            <li><a href="#">All Computers &amp; Accessories</a></li>
                                                                            <li><a href="#">Laptops, Desktops &amp; Monitors</a></li>
                                                                            <li><a href="#">Pen Drives, Hard Drives &amp; Memory Cards</a></li>
                                                                            <li><a href="#">Printers &amp; Ink</a></li>
                                                                            <li><a href="#">Networking &amp; Internet Devices</a></li>
                                                                            <li><a href="#">Computer Accessories</a></li>
                                                                            <li><a href="#">Software</a></li>
                                                                            <li class="nav-divider"></li>
                                                                            <li><a href="#"><span class="nav-text">All Electronics</span><span class="nav-subtext">Discover more products</span></a></li>
                                                                        </ul>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_text_column wpb_content_element ">
                                                                    <div class="wpb_wrapper">
                                                                        <ul>
                                                                            <li class="nav-title">Office &amp; Stationery</li>
                                                                            <li><a href="#">All Office &amp; Stationery</a></li>
                                                                            <li><a href="#">Pens &amp; Writing</a></li>
                                                                        </ul>
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

                                <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown menu-item-2586 dropdown">
                                    <a title="Mobiles &amp; Tablets" href="product-category.html" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Mobiles &#038; Tablets</a>
                                    <ul role="menu" class=" dropdown-menu">
                                        <li class="menu-item animate-dropdown menu-item-object-static_block">
                                            <div class="yamm-content">
                                                <div class="vc_row row wpb_row vc_row-fluid bg-yamm-content bg-yamm-content-bottom bg-yamm-content-right">
                                                    <div class="wpb_column vc_column_container vc_col-sm-12 col-sm-12">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_single_image wpb_content_element vc_align_left">
                                                                    <figure class="wpb_wrapper vc_figure">
                                                                        <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="540" height="460" src="<?php echo $this->config->item("val_url");?>images/megamenu-2.png" class="vc_single_image-img attachment-full" alt="megamenu-2"/></div>
                                                                    </figure>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vc_row row wpb_row vc_row-fluid">
                                                    <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_text_column wpb_content_element ">
                                                                    <div class="wpb_wrapper">
                                                                        <ul>
                                                                            <li class="nav-title">Computers &amp; Accessories</li>
                                                                            <li><a href="#">All Computers &amp; Accessories</a></li>
                                                                            <li><a href="#">Laptops, Desktops &amp; Monitors</a></li>
                                                                            <li><a href="#">Pen Drives, Hard Drives &amp; Memory Cards</a></li>
                                                                            <li><a href="#">Printers &amp; Ink</a></li>
                                                                            <li><a href="#">Networking &amp; Internet Devices</a></li>
                                                                            <li><a href="#">Computer Accessories</a></li>
                                                                            <li><a href="#">Software</a></li>
                                                                            <li class="nav-divider"></li>
                                                                            <li><a href="#"><span class="nav-text">All Electronics</span><span class="nav-subtext">Discover more products</span></a></li>
                                                                        </ul>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_text_column wpb_content_element ">
                                                                    <div class="wpb_wrapper">
                                                                        <ul>
                                                                            <li class="nav-title">Office &amp; Stationery</li>
                                                                            <li><a href="#">All Office &amp; Stationery</a></li>
                                                                            <li><a href="#">Pens &amp; Writing</a></li>
                                                                        </ul>
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


                                <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown menu-item-2587 dropdown">
                                    <a title="Movies, Music &amp; Video Games" href="product-category.html" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Movies, Music &#038; Video Games</a>
                                    <ul role="menu" class=" dropdown-menu">
                                        <li class="menu-item animate-dropdown menu-item-object-static_block">
                                            <div class="yamm-content">
                                                <div class="vc_row row wpb_row vc_row-fluid bg-yamm-content bg-yamm-content-bottom bg-yamm-content-right">
                                                    <div class="wpb_column vc_column_container vc_col-sm-12 col-sm-12">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_single_image wpb_content_element vc_align_left">
                                                                    <figure class="wpb_wrapper vc_figure">
                                                                        <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="540" height="460" src="<?php echo $this->config->item("val_url");?>images/megamenu-2.png" class="vc_single_image-img attachment-full" alt="megamenu-2"/></div>
                                                                    </figure>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vc_row row wpb_row vc_row-fluid">
                                                    <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_text_column wpb_content_element ">
                                                                    <div class="wpb_wrapper">
                                                                        <ul>
                                                                            <li class="nav-title">Computers &amp; Accessories</li>
                                                                            <li><a href="#">All Computers &amp; Accessories</a></li>
                                                                            <li><a href="#">Laptops, Desktops &amp; Monitors</a></li>
                                                                            <li><a href="#">Pen Drives, Hard Drives &amp; Memory Cards</a></li>
                                                                            <li><a href="#">Printers &amp; Ink</a></li>
                                                                            <li><a href="#">Networking &amp; Internet Devices</a></li>
                                                                            <li><a href="#">Computer Accessories</a></li>
                                                                            <li><a href="#">Software</a></li>
                                                                            <li class="nav-divider"></li>
                                                                            <li><a href="#"><span class="nav-text">All Electronics</span><span class="nav-subtext">Discover more products</span></a></li>
                                                                        </ul>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_text_column wpb_content_element ">
                                                                    <div class="wpb_wrapper">
                                                                        <ul>
                                                                            <li class="nav-title">Office &amp; Stationery</li>
                                                                            <li><a href="#">All Office &amp; Stationery</a></li>
                                                                            <li><a href="#">Pens &amp; Writing</a></li>
                                                                        </ul>
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


                                <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown menu-item-2588 dropdown">
                                    <a title="TV &amp; Audio" href="product-category.html" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">TV &#038; Audio</a>
                                    <ul role="menu" class=" dropdown-menu">
                                        <li class="menu-item animate-dropdown menu-item-object-static_block">
                                            <div class="yamm-content">
                                                <div class="vc_row row wpb_row vc_row-fluid bg-yamm-content bg-yamm-content-bottom bg-yamm-content-right">
                                                    <div class="wpb_column vc_column_container vc_col-sm-12 col-sm-12">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_single_image wpb_content_element vc_align_left">
                                                                    <figure class="wpb_wrapper vc_figure">
                                                                        <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="540" height="460" src="<?php echo $this->config->item("val_url");?>images/megamenu-2.png" class="vc_single_image-img attachment-full" alt="megamenu-2"/></div>
                                                                    </figure>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vc_row row wpb_row vc_row-fluid">
                                                    <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_text_column wpb_content_element ">
                                                                    <div class="wpb_wrapper">
                                                                        <ul>
                                                                            <li class="nav-title">Computers &amp; Accessories</li>
                                                                            <li><a href="#">All Computers &amp; Accessories</a></li>
                                                                            <li><a href="#">Laptops, Desktops &amp; Monitors</a></li>
                                                                            <li><a href="#">Pen Drives, Hard Drives &amp; Memory Cards</a></li>
                                                                            <li><a href="#">Printers &amp; Ink</a></li>
                                                                            <li><a href="#">Networking &amp; Internet Devices</a></li>
                                                                            <li><a href="#">Computer Accessories</a></li>
                                                                            <li><a href="#">Software</a></li>
                                                                            <li class="nav-divider"></li>
                                                                            <li><a href="#"><span class="nav-text">All Electronics</span><span class="nav-subtext">Discover more products</span></a></li>
                                                                        </ul>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_text_column wpb_content_element ">
                                                                    <div class="wpb_wrapper">
                                                                        <ul>
                                                                            <li class="nav-title">Office &amp; Stationery</li>
                                                                            <li><a href="#">All Office &amp; Stationery</a></li>
                                                                            <li><a href="#">Pens &amp; Writing</a></li>
                                                                        </ul>
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


                                <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown menu-item-2589 dropdown">

                                    <a title="Watches &amp; Eyewear" href="product-category.html" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Watches &#038; Eyewear</a>
                                    <ul role="menu" class=" dropdown-menu">
                                        <li class="menu-item animate-dropdown menu-item-object-static_block">
                                            <div class="yamm-content">
                                                <div class="vc_row row wpb_row vc_row-fluid bg-yamm-content bg-yamm-content-bottom bg-yamm-content-right">
                                                    <div class="wpb_column vc_column_container vc_col-sm-12 col-sm-12">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_single_image wpb_content_element vc_align_left">
                                                                    <figure class="wpb_wrapper vc_figure">
                                                                        <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="540" height="460" src="<?php echo $this->config->item("val_url");?>images/megamenu-2.png" class="vc_single_image-img attachment-full" alt="megamenu-2"/></div>
                                                                    </figure>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vc_row row wpb_row vc_row-fluid">
                                                    <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_text_column wpb_content_element ">
                                                                    <div class="wpb_wrapper">
                                                                        <ul>
                                                                            <li class="nav-title">Computers &amp; Accessories</li>
                                                                            <li><a href="#">All Computers &amp; Accessories</a></li>
                                                                            <li><a href="#">Laptops, Desktops &amp; Monitors</a></li>
                                                                            <li><a href="#">Pen Drives, Hard Drives &amp; Memory Cards</a></li>
                                                                            <li><a href="#">Printers &amp; Ink</a></li>
                                                                            <li><a href="#">Networking &amp; Internet Devices</a></li>
                                                                            <li><a href="#">Computer Accessories</a></li>
                                                                            <li><a href="#">Software</a></li>
                                                                            <li class="nav-divider"></li>
                                                                            <li><a href="#"><span class="nav-text">All Electronics</span><span class="nav-subtext">Discover more products</span></a></li>
                                                                        </ul>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_text_column wpb_content_element ">
                                                                    <div class="wpb_wrapper">
                                                                        <ul>
                                                                            <li class="nav-title">Office &amp; Stationery</li>
                                                                            <li><a href="#">All Office &amp; Stationery</a></li>
                                                                            <li><a href="#">Pens &amp; Writing</a></li>
                                                                        </ul>
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


                                <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown menu-item-2590 dropdown">

                                    <a title="Car, Motorbike &amp; Industrial" href="product-category.html" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Car, Motorbike &#038; Industrial</a>
                                    <ul role="menu" class=" dropdown-menu">
                                        <li class="menu-item animate-dropdown menu-item-object-static_block">
                                            <div class="yamm-content">
                                                <div class="vc_row row wpb_row vc_row-fluid bg-yamm-content bg-yamm-content-bottom bg-yamm-content-right">
                                                    <div class="wpb_column vc_column_container vc_col-sm-12 col-sm-12">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_single_image wpb_content_element vc_align_left">
                                                                    <figure class="wpb_wrapper vc_figure">
                                                                        <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="540" height="460" src="<?php echo $this->config->item("val_url");?>images/megamenu-2.png" class="vc_single_image-img attachment-full" alt="megamenu-2"/></div>
                                                                    </figure>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vc_row row wpb_row vc_row-fluid">
                                                    <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_text_column wpb_content_element ">
                                                                    <div class="wpb_wrapper">
                                                                        <ul>
                                                                            <li class="nav-title">Computers &amp; Accessories</li>
                                                                            <li><a href="#">All Computers &amp; Accessories</a></li>
                                                                            <li><a href="#">Laptops, Desktops &amp; Monitors</a></li>
                                                                            <li><a href="#">Pen Drives, Hard Drives &amp; Memory Cards</a></li>
                                                                            <li><a href="#">Printers &amp; Ink</a></li>
                                                                            <li><a href="#">Networking &amp; Internet Devices</a></li>
                                                                            <li><a href="#">Computer Accessories</a></li>
                                                                            <li><a href="#">Software</a></li>
                                                                            <li class="nav-divider"></li>
                                                                            <li><a href="#"><span class="nav-text">All Electronics</span><span class="nav-subtext">Discover more products</span></a></li>
                                                                        </ul>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                        <div class="vc_column-inner ">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_text_column wpb_content_element ">
                                                                    <div class="wpb_wrapper">
                                                                        <ul>
                                                                            <li class="nav-title">Office &amp; Stationery</li>
                                                                            <li><a href="#">All Office &amp; Stationery</a></li>
                                                                            <li><a href="#">Pens &amp; Writing</a></li>
                                                                        </ul>
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

                                <li class="menu-item animate-dropdown"><a title="Accessories" href="product-category.html">Accessories</a></li>
                                <li class="menu-item animate-dropdown"><a title="Printers &amp; Ink" href="product-category.html">Printers &#038; Ink</a></li>
                                <li class="menu-item animate-dropdown"><a title="Software" href="product-category.html">Software</a></li>
                                <li class="menu-item animate-dropdown"><a title="Office Supplies" href="product-category.html">Office Supplies</a></li>
                                <li class="menu-item animate-dropdown"><a title="Computer Components" href="product-category.html">Computer Components</a></li>
                                <li class="menu-item animate-dropdown"><a title="Car Electronic &amp; GPS" href="product-category.html">Car Electronic &#038; GPS</a></li>
                                <li class="menu-item animate-dropdown"><a title="Accessories" href="product-category.html">Accessories</a></li>
                                <li class="menu-item animate-dropdown"><a title="Printers &amp; Ink" href="product-category.html">Printers &#038; Ink</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-search" method="get" action="/">
                        <label class="sr-only screen-reader-text" for="search">Search for:</label>
                        <div class="input-group">
                            <input type="text" id="search" class="form-control search-field" dir="ltr" value="" name="s" placeholder="Search for products" />
                            <div class="input-group-addon search-categories">
                                <select name='product_cat' id='product_cat' class='postform resizeselect' >
                                    <option value='0' selected='selected'>All Categories</option>
                                    <option class="level-0" value="laptops-laptops-computers">Laptops</option>
                                    <option class="level-0" value="ultrabooks-laptops-computers">Ultrabooks</option>
                                    <option class="level-0" value="mac-computers-laptops">Mac Computers</option>
                                    <option class="level-0" value="all-in-one-laptops-computers">All in One</option>
                                    <option class="level-0" value="servers">Servers</option>
                                    <option class="level-0" value="peripherals">Peripherals</option>
                                    <option class="level-0" value="gaming-laptops-computers">Gaming</option>
                                    <option class="level-0" value="accessories-laptops-computers">Accessories</option>
                                    <option class="level-0" value="audio-speakers">Audio Speakers</option>
                                    <option class="level-0" value="headphones">Headphones</option>
                                    <option class="level-0" value="computer-cases">Computer Cases</option>
                                    <option class="level-0" value="printers">Printers</option>
                                    <option class="level-0" value="cameras">Cameras</option>
                                    <option class="level-0" value="smartphones">Smartphones</option>
                                    <option class="level-0" value="game-consoles">Game Consoles</option>
                                    <option class="level-0" value="power-banks">Power Banks</option>
                                    <option class="level-0" value="smartwatches">Smartwatches</option>
                                    <option class="level-0" value="chargers">Chargers</option>
                                    <option class="level-0" value="cases">Cases</option>
                                    <option class="level-0" value="headphone-accessories">Headphone Accessories</option>
                                    <option class="level-0" value="headphone-cases">Headphone Cases</option>
                                    <option class="level-0" value="tablets">Tablets</option>
                                    <option class="level-0" value="tvs">TVs</option>
                                    <option class="level-0" value="wearables">Wearables</option>
                                    <option class="level-0" value="pendrives">Pendrives</option>
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
                            <a href="cart.html" class="nav-link" data-toggle="dropdown">
                                <i class="ec ec-shopping-bag"></i>
                                <span class="cart-items-count count">4</span>
                                <span class="cart-items-total-price total-price"><span class="amount">&#36;1,215.00</span></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-mini-cart">
                                <li>
                                    <div class="widget_shopping_cart_content">

                                        <ul class="cart_list product_list_widget ">


                                            <li class="mini_cart_item">
                                                <a title="Remove this item" class="remove" href="#">×</a>
                                                <a href="single-product.html">
                                                    <img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="<?php echo $this->config->item("val_url");?>images/products/mini-cart1.jpg" alt="">White lumia 9001&nbsp;
                                                </a>

                                                <span class="quantity">2 × <span class="amount">£150.00</span></span>
                                            </li>


                                            <li class="mini_cart_item">
                                                <a title="Remove this item" class="remove" href="#">×</a>
                                                <a href="single-product.html">
                                                    <img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="<?php echo $this->config->item("val_url");?>images/products/mini-cart2.jpg" alt="">PlayStation 4&nbsp;
                                                </a>

                                                <span class="quantity">1 × <span class="amount">£399.99</span></span>
                                            </li>

                                            <li class="mini_cart_item">
                                                <a data-product_sku="" data-product_id="34" title="Remove this item" class="remove" href="#">×</a>
                                                <a href="single-product.html">
                                                <img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="<?php echo $this->config->item("val_url");?>images/products/mini-cart3.jpg" alt="">POV Action Cam HDR-AS100V&nbsp;

                                                </a>

                                                <span class="quantity">1 × <span class="amount">£269.99</span></span>
                                            </li>


                                        </ul><!-- end product list -->


                                        <p class="total"><strong>Subtotal:</strong> <span class="amount">£969.98</span></p>


                                        <p class="buttons">
                                            <a class="button wc-forward" href="cart.html">View Cart</a>
                                            <a class="button checkout wc-forward" href="checkout.html">Checkout</a>
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
                </div>
            </nav>

            <div id="content" class="site-content" tabindex="-1">
                <div class="container">

                    <nav class="woocommerce-breadcrumb" ><a href="home.html">Home</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>Smart Phones &amp; Tablets</nav>

                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">

                            <section class="section-product-cards-carousel" >
                                <header>
                                    <h2 class="h1">Recommended Products</h2>
                                    <div class="owl-nav">
                                        <a href="#products-carousel-prev" data-target="#recommended-product" class="slider-prev"><i class="fa fa-angle-left"></i></a>
                                        <a href="#products-carousel-next" data-target="#recommended-product" class="slider-next"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </header>

                                <div id="recommended-product">
                                    <div class="woocommerce columns-4">
                                        <div class="products owl-carousel products-carousel columns-4 owl-loaded owl-drag">


                                            <div class="product">
                                                <div class="product-outer">
                                                    <div class="product-inner">
                                                        <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                        <a href="single-product.html">
                                                            <h3>Laptop Yoga 21 80JH0035GE  W8.1 (Copy)</h3>
                                                            <div class="product-thumbnail">
                                                                <img src="<?php echo $this->config->item("val_url");?>images/blank.gif" data-echo="<?php echo $this->config->item("val_url");?>images/product-category/5.jpg" class="img-responsive" alt="">
                                                            </div>
                                                        </a>

                                                        <div class="price-add-to-cart">
                                                            <span class="price">
                                                                <span class="electro-price">
                                                                    <ins><span class="amount"> </span></ins>
                                                                    <span class="amount"> $1,999.00</span>
                                                                </span>
                                                            </span>
                                                            <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                        </div><!-- /.price-add-to-cart -->

                                                        <div class="hover-area">
                                                            <div class="action-buttons">
                                                                <a href="#" rel="nofollow" class="add_to_wishlist"> Wishlist</a>
                                                                <a href="compare.html" class="add-to-compare-link"> Compare</a>
                                                            </div>
                                                        </div>

                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->
                                            </div><!-- /.products -->



                                            <div class="product">
                                                <div class="product-outer">
                                                    <div class="product-inner">
                                                        <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                        <a href="single-product.html">
                                                            <h3>Notebook Purple G952VX-T7008T</h3>
                                                            <div class="product-thumbnail">
                                                                <img src="<?php echo $this->config->item("val_url");?>images/blank.gif" data-echo="<?php echo $this->config->item("val_url");?>images/product-category/4.jpg" class="img-responsive" alt="">
                                                            </div>
                                                        </a>

                                                        <div class="price-add-to-cart">
                                                            <span class="price">
                                                                <span class="electro-price">
                                                                    <ins><span class="amount"> </span></ins>
                                                                    <span class="amount"> $1,999.00</span>
                                                                </span>
                                                            </span>
                                                            <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                        </div><!-- /.price-add-to-cart -->

                                                        <div class="hover-area">
                                                            <div class="action-buttons">
                                                                <a href="#" rel="nofollow" class="add_to_wishlist"> Wishlist</a>
                                                                <a href="compare.html" class="add-to-compare-link"> Compare</a>
                                                            </div>
                                                        </div>

                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->
                                            </div><!-- /.products -->

                                            <div class="product">
                                                <div class="product-outer">
                                                    <div class="product-inner">
                                                        <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                        <a href="single-product.html">
                                                            <h3>Notebook Widescreen Z51-70  40K6013UPB</h3>
                                                            <div class="product-thumbnail">
                                                                <img src="<?php echo $this->config->item("val_url");?>images/blank.gif" data-echo="<?php echo $this->config->item("val_url");?>images/product-category/3.jpg" class="img-responsive" alt="">
                                                            </div>
                                                        </a>

                                                        <div class="price-add-to-cart">
                                                            <span class="price">
                                                                <span class="electro-price">
                                                                    <ins><span class="amount"> $1,999.00</span></ins>
                                                                    <del><span class="amount">$2,299.00</span></del>
                                                                    <span class="amount"> </span>
                                                                </span>
                                                            </span>
                                                            <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                        </div><!-- /.price-add-to-cart -->

                                                        <div class="hover-area">
                                                            <div class="action-buttons">
                                                                <a href="#" rel="nofollow" class="add_to_wishlist"> Wishlist</a>
                                                                <a href="compare.html" class="add-to-compare-link"> Compare</a>
                                                            </div>
                                                        </div>

                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->
                                            </div><!-- /.products -->

                                            <div class="product">
                                                <div class="product-outer">
                                                    <div class="product-inner">
                                                        <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                        <a href="single-product.html">
                                                            <h3>Tablet Thin EliteBook  Revolve 810 G6</h3>
                                                            <div class="product-thumbnail">
                                                                <img src="<?php echo $this->config->item("val_url");?>images/blank.gif" data-echo="<?php echo $this->config->item("val_url");?>images/product-category/2.jpg" class="img-responsive" alt="">
                                                            </div>
                                                        </a>

                                                        <div class="price-add-to-cart">
                                                            <span class="price">
                                                                <span class="electro-price">
                                                                    <ins><span class="amount"> $1,999.00</span></ins>
                                                                    <del><span class="amount">$2,299.00</span></del>
                                                                    <span class="amount"> </span>
                                                                </span>
                                                            </span>
                                                            <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                        </div><!-- /.price-add-to-cart -->

                                                        <div class="hover-area">
                                                            <div class="action-buttons">
                                                                <a href="#" rel="nofollow" class="add_to_wishlist"> Wishlist</a>
                                                                <a href="compare.html" class="add-to-compare-link"> Compare</a>
                                                            </div>
                                                        </div>

                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->
                                            </div><!-- /.products -->

                                            <div class="product">
                                                <div class="product-outer">
                                                    <div class="product-inner">
                                                        <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                        <a href="single-product.html">
                                                            <h3>Notebook Purple G952VX-T7008T</h3>
                                                            <div class="product-thumbnail">
                                                                <img src="<?php echo $this->config->item("val_url");?>images/blank.gif" data-echo="<?php echo $this->config->item("val_url");?>images/product-category/3.jpg" class="img-responsive" alt="">
                                                            </div>
                                                        </a>

                                                        <div class="price-add-to-cart">
                                                            <span class="price">
                                                                <span class="electro-price">
                                                                    <ins><span class="amount"> </span></ins>
                                                                    <span class="amount"> $1,999.00</span>
                                                                </span>
                                                            </span>
                                                            <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                        </div><!-- /.price-add-to-cart -->

                                                        <div class="hover-area">
                                                            <div class="action-buttons">
                                                                <a href="#" rel="nofollow" class="add_to_wishlist"> Wishlist</a>
                                                                <a href="compare.html" class="add-to-compare-link"> Compare</a>
                                                            </div>
                                                        </div>

                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->
                                            </div><!-- /.products -->

                                            <div class="product">
                                                <div class="product-outer">
                                                    <div class="product-inner">
                                                        <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                        <a href="single-product.html">
                                                            <h3>Smartphone 6S 128GB LTE</h3>
                                                            <div class="product-thumbnail">
                                                                <img src="<?php echo $this->config->item("val_url");?>images/blank.gif" data-echo="<?php echo $this->config->item("val_url");?>images/product-category/6.jpg" class="img-responsive" alt="">
                                                            </div>
                                                        </a>

                                                        <div class="price-add-to-cart">
                                                            <span class="price">
                                                                <span class="electro-price">
                                                                    <ins><span class="amount"> </span></ins>
                                                                    <span class="amount"> $200.00</span>
                                                                </span>
                                                            </span>
                                                            <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                        </div><!-- /.price-add-to-cart -->

                                                        <div class="hover-area">
                                                            <div class="action-buttons">
                                                                <a href="#" rel="nofollow" class="add_to_wishlist"> Wishlist</a>
                                                                <a href="compare.html" class="add-to-compare-link"> Compare</a>
                                                            </div>
                                                        </div>

                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->
                                            </div><!-- /.products -->

                                            <div class="product">
                                                <div class="product-outer">
                                                    <div class="product-inner">
                                                        <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                        <a href="single-product.html">
                                                            <h3>Tablet Thin EliteBook  Revolve 810 G6</h3>
                                                            <div class="product-thumbnail">
                                                                <img src="<?php echo $this->config->item("val_url");?>images/blank.gif" data-echo="<?php echo $this->config->item("val_url");?>images/product-category/2.jpg" class="img-responsive" alt="">
                                                            </div>
                                                        </a>

                                                        <div class="price-add-to-cart">
                                                            <span class="price">
                                                                <span class="electro-price">
                                                                    <ins><span class="amount"> </span></ins>
                                                                    <span class="amount"> $1,999.00</span>
                                                                </span>
                                                            </span>
                                                            <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                        </div><!-- /.price-add-to-cart -->

                                                        <div class="hover-area">
                                                            <div class="action-buttons">
                                                                <a href="#" rel="nofollow" class="add_to_wishlist"> Wishlist</a>
                                                                <a href="compare.html" class="add-to-compare-link"> Compare</a>
                                                            </div>
                                                        </div>

                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->
                                            </div><!-- /.products -->

                                            <div class="product">
                                                <div class="product-outer">
                                                    <div class="product-inner">
                                                        <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                        <a href="single-product.html">
                                                            <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                            <div class="product-thumbnail">
                                                                <img src="<?php echo $this->config->item("val_url");?>images/blank.gif" data-echo="<?php echo $this->config->item("val_url");?>images/product-category/1.jpg" class="img-responsive" alt="">
                                                            </div>
                                                        </a>

                                                        <div class="price-add-to-cart">
                                                            <span class="price">
                                                                <span class="electro-price">
                                                                    <ins><span class="amount"> </span></ins>
                                                                    <span class="amount"> $1,999.00</span>
                                                                </span>
                                                            </span>
                                                            <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                        </div><!-- /.price-add-to-cart -->

                                                        <div class="hover-area">
                                                            <div class="action-buttons">
                                                                <a href="#" rel="nofollow" class="add_to_wishlist"> Wishlist</a>
                                                                <a href="compare.html" class="add-to-compare-link"> Compare</a>
                                                            </div>
                                                        </div>

                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->
                                            </div><!-- /.products -->


                                        </div>
                                    </div>
                                </div>
                            </section>

                            <header class="page-header">
                                <h1 class="page-title">Smart Phones &amp; Tablets</h1>
                                <p class="woocommerce-result-count">Showing 1&ndash;15 of 20 results</p>
                            </header>

                            <div class="shop-control-bar">
                                <ul class="shop-view-switcher nav nav-tabs" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" title="Grid View" href="#grid"><i class="fa fa-th"></i></a></li>
                                    <li class="nav-item"><a class="nav-link " data-toggle="tab" title="Grid Extended View" href="#grid-extended"><i class="fa fa-align-justify"></i></a></li>
                                    <li class="nav-item"><a class="nav-link " data-toggle="tab" title="List View" href="#list-view"><i class="fa fa-list"></i></a></li>
                                    <li class="nav-item"><a class="nav-link " data-toggle="tab" title="List View Small" href="#list-view-small"><i class="fa fa-th-list"></i></a></li>
                                </ul>
                                <form class="woocommerce-ordering" method="get">
                                    <select name="orderby" class="orderby">
                                        <option value="menu_order"  selected='selected'>Default sorting</option>
                                        <option value="popularity" >Sort by popularity</option>
                                        <option value="rating" >Sort by average rating</option>
                                        <option value="date" >Sort by newness</option>
                                        <option value="price" >Sort by price: low to high</option>
                                        <option value="price-desc" >Sort by price: high to low</option>
                                    </select>
                                </form>
                                <form class="form-electro-wc-ppp"><select name="ppp" onchange="this.form.submit()" class="electro-wc-wppp-select c-select"><option value="15"  selected='selected'>Show 15</option><option value="-1" >Show All</option></select></form>
                                <nav class="electro-advanced-pagination">
                                    <form method="post" class="form-adv-pagination"><input id="goto-page" size="2" min="1" max="2" step="1" type="number" class="form-control" value="1" /></form> of 2<a class="next page-numbers" href="#">&rarr;</a>			<script>
                                    jQuery(document).ready(function($){
                                        $( '.form-adv-pagination' ).on( 'submit', function() {
                                            var link 		= '#',
                                            goto_page 	= $( '#goto-page' ).val(),
                                            new_link 	= link.replace( '%#%', goto_page );

                                            window.location.href = new_link;
                                            return false;
                                        });
                                    });
                                    </script>
                                </nav>
                            </div>

                            <div class="tab-content">

                                <div role="tabpanel" class="tab-pane active" id="grid" aria-expanded="true">

                                    <ul class="products columns-3">
                                        <li class="product first">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">

                                                            <img data-echo="<?php echo $this->config->item("val_url");?>images/products/1.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">

                                                        </div>
                                                    </a>

                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product ">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">

                                                            <img data-echo="<?php echo $this->config->item("val_url");?>images/products/2.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">

                                                        </div>
                                                    </a>

                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product last">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">

                                                            <img data-echo="<?php echo $this->config->item("val_url");?>images/products/3.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">

                                                        </div>
                                                    </a>

                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product first">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">

                                                            <img data-echo="<?php echo $this->config->item("val_url");?>images/products/4.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">

                                                        </div>
                                                    </a>

                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product ">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">

                                                            <img data-echo="<?php echo $this->config->item("val_url");?>images/products/5.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">

                                                        </div>
                                                    </a>

                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product last">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">

                                                            <img data-echo="<?php echo $this->config->item("val_url");?>images/products/6.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">

                                                        </div>
                                                    </a>

                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product first">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">

                                                            <img data-echo="<?php echo $this->config->item("val_url");?>images/products/4.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">

                                                        </div>
                                                    </a>

                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product ">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">

                                                            <img data-echo="<?php echo $this->config->item("val_url");?>images/products/2.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">

                                                        </div>
                                                    </a>

                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product last">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">

                                                            <img data-echo="<?php echo $this->config->item("val_url");?>images/products/5.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">

                                                        </div>
                                                    </a>

                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product first">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">

                                                            <img data-echo="<?php echo $this->config->item("val_url");?>images/products/1.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">

                                                        </div>
                                                    </a>

                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product ">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">

                                                            <img data-echo="<?php echo $this->config->item("val_url");?>images/products/6.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">

                                                        </div>
                                                    </a>

                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product last">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">

                                                            <img data-echo="<?php echo $this->config->item("val_url");?>images/products/3.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">

                                                        </div>
                                                    </a>

                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product first">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">

                                                            <img data-echo="<?php echo $this->config->item("val_url");?>images/products/5.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">

                                                        </div>
                                                    </a>

                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product ">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">

                                                            <img data-echo="<?php echo $this->config->item("val_url");?>images/products/4.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">

                                                        </div>
                                                    </a>

                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product last">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">

                                                            <img data-echo="<?php echo $this->config->item("val_url");?>images/products/2.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">

                                                        </div>
                                                    </a>

                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>

                                    </ul>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="grid-extended" aria-expanded="true">

                                    <ul class="products columns-3">
                                        <li class="product first">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">
                                                            <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/1.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                        </div>

                                                        <div class="product-rating">
                                                            <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                        </div>

                                                        <div class="product-short-description">
                                                            <ul>
                                                                <li><span class="a-list-item">Intel Core i5 processors (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Intel Iris Graphics 6100 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Flash storage</span></li>
                                                                <li><span class="a-list-item">Up to 10 hours of battery life2 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Force Touch trackpad (13-inch model)</span></li>
                                                            </ul>
                                                        </div>

                                                        <div class="product-sku">SKU: 5487FB8/15</div>
                                                    </a>
                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>

                                                </div><!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product ">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">
                                                            <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/2.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                        </div>

                                                        <div class="product-rating">
                                                            <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                        </div>

                                                        <div class="product-short-description">
                                                            <ul>
                                                                <li><span class="a-list-item">Intel Core i5 processors (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Intel Iris Graphics 6100 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Flash storage</span></li>
                                                                <li><span class="a-list-item">Up to 10 hours of battery life2 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Force Touch trackpad (13-inch model)</span></li>
                                                            </ul>
                                                        </div>

                                                        <div class="product-sku">SKU: 5487FB8/15</div>
                                                    </a>
                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>

                                                </div><!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product last">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">
                                                            <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/3.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                        </div>

                                                        <div class="product-rating">
                                                            <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                        </div>

                                                        <div class="product-short-description">
                                                            <ul>
                                                                <li><span class="a-list-item">Intel Core i5 processors (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Intel Iris Graphics 6100 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Flash storage</span></li>
                                                                <li><span class="a-list-item">Up to 10 hours of battery life2 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Force Touch trackpad (13-inch model)</span></li>
                                                            </ul>
                                                        </div>

                                                        <div class="product-sku">SKU: 5487FB8/15</div>
                                                    </a>
                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>

                                                </div><!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product first">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">
                                                            <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/4.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                        </div>

                                                        <div class="product-rating">
                                                            <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                        </div>

                                                        <div class="product-short-description">
                                                            <ul>
                                                                <li><span class="a-list-item">Intel Core i5 processors (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Intel Iris Graphics 6100 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Flash storage</span></li>
                                                                <li><span class="a-list-item">Up to 10 hours of battery life2 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Force Touch trackpad (13-inch model)</span></li>
                                                            </ul>
                                                        </div>

                                                        <div class="product-sku">SKU: 5487FB8/15</div>
                                                    </a>
                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>

                                                </div><!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product ">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">
                                                            <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/5.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                        </div>

                                                        <div class="product-rating">
                                                            <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                        </div>

                                                        <div class="product-short-description">
                                                            <ul>
                                                                <li><span class="a-list-item">Intel Core i5 processors (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Intel Iris Graphics 6100 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Flash storage</span></li>
                                                                <li><span class="a-list-item">Up to 10 hours of battery life2 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Force Touch trackpad (13-inch model)</span></li>
                                                            </ul>
                                                        </div>

                                                        <div class="product-sku">SKU: 5487FB8/15</div>
                                                    </a>
                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>

                                                </div><!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product last">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">
                                                            <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/6.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                        </div>

                                                        <div class="product-rating">
                                                            <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                        </div>

                                                        <div class="product-short-description">
                                                            <ul>
                                                                <li><span class="a-list-item">Intel Core i5 processors (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Intel Iris Graphics 6100 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Flash storage</span></li>
                                                                <li><span class="a-list-item">Up to 10 hours of battery life2 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Force Touch trackpad (13-inch model)</span></li>
                                                            </ul>
                                                        </div>

                                                        <div class="product-sku">SKU: 5487FB8/15</div>
                                                    </a>
                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>

                                                </div><!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product first">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">
                                                            <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/4.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                        </div>

                                                        <div class="product-rating">
                                                            <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                        </div>

                                                        <div class="product-short-description">
                                                            <ul>
                                                                <li><span class="a-list-item">Intel Core i5 processors (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Intel Iris Graphics 6100 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Flash storage</span></li>
                                                                <li><span class="a-list-item">Up to 10 hours of battery life2 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Force Touch trackpad (13-inch model)</span></li>
                                                            </ul>
                                                        </div>

                                                        <div class="product-sku">SKU: 5487FB8/15</div>
                                                    </a>
                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>

                                                </div><!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product ">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">
                                                            <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/2.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                        </div>

                                                        <div class="product-rating">
                                                            <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                        </div>

                                                        <div class="product-short-description">
                                                            <ul>
                                                                <li><span class="a-list-item">Intel Core i5 processors (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Intel Iris Graphics 6100 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Flash storage</span></li>
                                                                <li><span class="a-list-item">Up to 10 hours of battery life2 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Force Touch trackpad (13-inch model)</span></li>
                                                            </ul>
                                                        </div>

                                                        <div class="product-sku">SKU: 5487FB8/15</div>
                                                    </a>
                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>

                                                </div><!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product last">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">
                                                            <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/5.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                        </div>

                                                        <div class="product-rating">
                                                            <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                        </div>

                                                        <div class="product-short-description">
                                                            <ul>
                                                                <li><span class="a-list-item">Intel Core i5 processors (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Intel Iris Graphics 6100 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Flash storage</span></li>
                                                                <li><span class="a-list-item">Up to 10 hours of battery life2 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Force Touch trackpad (13-inch model)</span></li>
                                                            </ul>
                                                        </div>

                                                        <div class="product-sku">SKU: 5487FB8/15</div>
                                                    </a>
                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>

                                                </div><!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product first">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">
                                                            <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/1.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                        </div>

                                                        <div class="product-rating">
                                                            <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                        </div>

                                                        <div class="product-short-description">
                                                            <ul>
                                                                <li><span class="a-list-item">Intel Core i5 processors (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Intel Iris Graphics 6100 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Flash storage</span></li>
                                                                <li><span class="a-list-item">Up to 10 hours of battery life2 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Force Touch trackpad (13-inch model)</span></li>
                                                            </ul>
                                                        </div>

                                                        <div class="product-sku">SKU: 5487FB8/15</div>
                                                    </a>
                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>

                                                </div><!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product ">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">
                                                            <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/6.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                        </div>

                                                        <div class="product-rating">
                                                            <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                        </div>

                                                        <div class="product-short-description">
                                                            <ul>
                                                                <li><span class="a-list-item">Intel Core i5 processors (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Intel Iris Graphics 6100 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Flash storage</span></li>
                                                                <li><span class="a-list-item">Up to 10 hours of battery life2 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Force Touch trackpad (13-inch model)</span></li>
                                                            </ul>
                                                        </div>

                                                        <div class="product-sku">SKU: 5487FB8/15</div>
                                                    </a>
                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>

                                                </div><!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product last">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">
                                                            <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/3.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                        </div>

                                                        <div class="product-rating">
                                                            <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                        </div>

                                                        <div class="product-short-description">
                                                            <ul>
                                                                <li><span class="a-list-item">Intel Core i5 processors (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Intel Iris Graphics 6100 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Flash storage</span></li>
                                                                <li><span class="a-list-item">Up to 10 hours of battery life2 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Force Touch trackpad (13-inch model)</span></li>
                                                            </ul>
                                                        </div>

                                                        <div class="product-sku">SKU: 5487FB8/15</div>
                                                    </a>
                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>

                                                </div><!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product first">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">
                                                            <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/5.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                        </div>

                                                        <div class="product-rating">
                                                            <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                        </div>

                                                        <div class="product-short-description">
                                                            <ul>
                                                                <li><span class="a-list-item">Intel Core i5 processors (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Intel Iris Graphics 6100 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Flash storage</span></li>
                                                                <li><span class="a-list-item">Up to 10 hours of battery life2 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Force Touch trackpad (13-inch model)</span></li>
                                                            </ul>
                                                        </div>

                                                        <div class="product-sku">SKU: 5487FB8/15</div>
                                                    </a>
                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>

                                                </div><!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product ">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">
                                                            <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/4.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                        </div>

                                                        <div class="product-rating">
                                                            <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                        </div>

                                                        <div class="product-short-description">
                                                            <ul>
                                                                <li><span class="a-list-item">Intel Core i5 processors (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Intel Iris Graphics 6100 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Flash storage</span></li>
                                                                <li><span class="a-list-item">Up to 10 hours of battery life2 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Force Touch trackpad (13-inch model)</span></li>
                                                            </ul>
                                                        </div>

                                                        <div class="product-sku">SKU: 5487FB8/15</div>
                                                    </a>
                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>

                                                </div><!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                        <li class="product last">
                                            <div class="product-outer">
                                                <div class="product-inner">
                                                    <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                    <a href="single-product.html">
                                                        <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                        <div class="product-thumbnail">
                                                            <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/2.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                        </div>

                                                        <div class="product-rating">
                                                            <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                        </div>

                                                        <div class="product-short-description">
                                                            <ul>
                                                                <li><span class="a-list-item">Intel Core i5 processors (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Intel Iris Graphics 6100 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Flash storage</span></li>
                                                                <li><span class="a-list-item">Up to 10 hours of battery life2 (13-inch model)</span></li>
                                                                <li><span class="a-list-item">Force Touch trackpad (13-inch model)</span></li>
                                                            </ul>
                                                        </div>

                                                        <div class="product-sku">SKU: 5487FB8/15</div>
                                                    </a>
                                                    <div class="price-add-to-cart">
                                                        <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                <del><span class="amount">&#036;2,299.00</span></del>
                                                            </span>
                                                        </span>
                                                        <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                    </div><!-- /.price-add-to-cart -->

                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                            <a href="#" class="add-to-compare-link">Compare</a>
                                                        </div>
                                                    </div>

                                                </div><!-- /.product-inner -->
                                            </div><!-- /.product-outer -->
                                        </li>
                                    </ul>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="list-view" aria-expanded="true">
                                    <ul class="products columns-3">
                                        <li class="product list-view">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/1.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="#">Tablets</a></span><a href="single-product.html"><h3>Tablet Air 3 WiFi 64GB  Gold</h3>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">

                                                            <div class="availability in-stock">Availablity: <span>In stock</span></div>

                                                            <span class="price"><span class="electro-price"><span class="amount">$629.00</span></span></span>
                                                            <a class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="5487FB8/35" data-product_id="2706" data-quantity="1" href="single-product.html" rel="nofollow">Add to cart</a>
                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                                        <a class="add_to_wishlist" data-product-type="simple" data-product-id="2706" rel="nofollow" href="#">Wishlist</a>

                                                                        <div style="display:none;" class="yith-wcwl-wishlistaddedbrowse hide">
                                                                            <span class="feedback">Product added!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="display:none" class="yith-wcwl-wishlistexistsbrowse hide">
                                                                            <span class="feedback">The product is already in the wishlist!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="clear:both"></div>
                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                                                    </div>
                                                                    <div class="clear"></div>
                                                                    <a data-product_id="2706" class="add-to-compare-link" href="#">Compare</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/2.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="#">Tablets</a></span><a href="single-product.html"><h3>Tablet Air 3 WiFi 64GB  Gold</h3>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">

                                                            <div class="availability in-stock">Availablity: <span>In stock</span></div>

                                                            <span class="price"><span class="electro-price"><span class="amount">$629.00</span></span></span>
                                                            <a class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="5487FB8/35" data-product_id="2706" data-quantity="1" href="single-product.html" rel="nofollow">Add to cart</a>
                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                                        <a class="add_to_wishlist" data-product-type="simple" data-product-id="2706" rel="nofollow" href="#">Wishlist</a>

                                                                        <div style="display:none;" class="yith-wcwl-wishlistaddedbrowse hide">
                                                                            <span class="feedback">Product added!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="display:none" class="yith-wcwl-wishlistexistsbrowse hide">
                                                                            <span class="feedback">The product is already in the wishlist!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="clear:both"></div>
                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                                                    </div>
                                                                    <div class="clear"></div>
                                                                    <a data-product_id="2706" class="add-to-compare-link" href="#">Compare</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/3.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="#">Tablets</a></span><a href="single-product.html"><h3>Tablet Air 3 WiFi 64GB  Gold</h3>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">

                                                            <div class="availability in-stock">Availablity: <span>In stock</span></div>

                                                            <span class="price"><span class="electro-price"><span class="amount">$629.00</span></span></span>
                                                            <a class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="5487FB8/35" data-product_id="2706" data-quantity="1" href="single-product.html" rel="nofollow">Add to cart</a>
                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                                        <a class="add_to_wishlist" data-product-type="simple" data-product-id="2706" rel="nofollow" href="#">Wishlist</a>

                                                                        <div style="display:none;" class="yith-wcwl-wishlistaddedbrowse hide">
                                                                            <span class="feedback">Product added!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="display:none" class="yith-wcwl-wishlistexistsbrowse hide">
                                                                            <span class="feedback">The product is already in the wishlist!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="clear:both"></div>
                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                                                    </div>
                                                                    <div class="clear"></div>
                                                                    <a data-product_id="2706" class="add-to-compare-link" href="#">Compare</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/4.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="#">Tablets</a></span><a href="single-product.html"><h3>Tablet Air 3 WiFi 64GB  Gold</h3>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">

                                                            <div class="availability in-stock">Availablity: <span>In stock</span></div>

                                                            <span class="price"><span class="electro-price"><span class="amount">$629.00</span></span></span>
                                                            <a class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="5487FB8/35" data-product_id="2706" data-quantity="1" href="single-product.html" rel="nofollow">Add to cart</a>
                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                                        <a class="add_to_wishlist" data-product-type="simple" data-product-id="2706" rel="nofollow" href="#">Wishlist</a>

                                                                        <div style="display:none;" class="yith-wcwl-wishlistaddedbrowse hide">
                                                                            <span class="feedback">Product added!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="display:none" class="yith-wcwl-wishlistexistsbrowse hide">
                                                                            <span class="feedback">The product is already in the wishlist!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="clear:both"></div>
                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                                                    </div>
                                                                    <div class="clear"></div>
                                                                    <a data-product_id="2706" class="add-to-compare-link" href="#">Compare</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/5.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="#">Tablets</a></span><a href="single-product.html"><h3>Tablet Air 3 WiFi 64GB  Gold</h3>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">

                                                            <div class="availability in-stock">Availablity: <span>In stock</span></div>

                                                            <span class="price"><span class="electro-price"><span class="amount">$629.00</span></span></span>
                                                            <a class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="5487FB8/35" data-product_id="2706" data-quantity="1" href="single-product.html" rel="nofollow">Add to cart</a>
                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                                        <a class="add_to_wishlist" data-product-type="simple" data-product-id="2706" rel="nofollow" href="#">Wishlist</a>

                                                                        <div style="display:none;" class="yith-wcwl-wishlistaddedbrowse hide">
                                                                            <span class="feedback">Product added!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="display:none" class="yith-wcwl-wishlistexistsbrowse hide">
                                                                            <span class="feedback">The product is already in the wishlist!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="clear:both"></div>
                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                                                    </div>
                                                                    <div class="clear"></div>
                                                                    <a data-product_id="2706" class="add-to-compare-link" href="#">Compare</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/6.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="#">Tablets</a></span><a href="single-product.html"><h3>Tablet Air 3 WiFi 64GB  Gold</h3>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">

                                                            <div class="availability in-stock">Availablity: <span>In stock</span></div>

                                                            <span class="price"><span class="electro-price"><span class="amount">$629.00</span></span></span>
                                                            <a class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="5487FB8/35" data-product_id="2706" data-quantity="1" href="single-product.html" rel="nofollow">Add to cart</a>
                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                                        <a class="add_to_wishlist" data-product-type="simple" data-product-id="2706" rel="nofollow" href="#">Wishlist</a>

                                                                        <div style="display:none;" class="yith-wcwl-wishlistaddedbrowse hide">
                                                                            <span class="feedback">Product added!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="display:none" class="yith-wcwl-wishlistexistsbrowse hide">
                                                                            <span class="feedback">The product is already in the wishlist!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="clear:both"></div>
                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                                                    </div>
                                                                    <div class="clear"></div>
                                                                    <a data-product_id="2706" class="add-to-compare-link" href="#">Compare</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/4.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="#">Tablets</a></span><a href="single-product.html"><h3>Tablet Air 3 WiFi 64GB  Gold</h3>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">

                                                            <div class="availability in-stock">Availablity: <span>In stock</span></div>

                                                            <span class="price"><span class="electro-price"><span class="amount">$629.00</span></span></span>
                                                            <a class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="5487FB8/35" data-product_id="2706" data-quantity="1" href="single-product.html" rel="nofollow">Add to cart</a>
                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                                        <a class="add_to_wishlist" data-product-type="simple" data-product-id="2706" rel="nofollow" href="#">Wishlist</a>

                                                                        <div style="display:none;" class="yith-wcwl-wishlistaddedbrowse hide">
                                                                            <span class="feedback">Product added!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="display:none" class="yith-wcwl-wishlistexistsbrowse hide">
                                                                            <span class="feedback">The product is already in the wishlist!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="clear:both"></div>
                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                                                    </div>
                                                                    <div class="clear"></div>
                                                                    <a data-product_id="2706" class="add-to-compare-link" href="#">Compare</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/2.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="#">Tablets</a></span><a href="single-product.html"><h3>Tablet Air 3 WiFi 64GB  Gold</h3>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">

                                                            <div class="availability in-stock">Availablity: <span>In stock</span></div>

                                                            <span class="price"><span class="electro-price"><span class="amount">$629.00</span></span></span>
                                                            <a class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="5487FB8/35" data-product_id="2706" data-quantity="1" href="single-product.html" rel="nofollow">Add to cart</a>
                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                                        <a class="add_to_wishlist" data-product-type="simple" data-product-id="2706" rel="nofollow" href="#">Wishlist</a>

                                                                        <div style="display:none;" class="yith-wcwl-wishlistaddedbrowse hide">
                                                                            <span class="feedback">Product added!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="display:none" class="yith-wcwl-wishlistexistsbrowse hide">
                                                                            <span class="feedback">The product is already in the wishlist!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="clear:both"></div>
                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                                                    </div>
                                                                    <div class="clear"></div>
                                                                    <a data-product_id="2706" class="add-to-compare-link" href="#">Compare</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/5.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="#">Tablets</a></span><a href="single-product.html"><h3>Tablet Air 3 WiFi 64GB  Gold</h3>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">

                                                            <div class="availability in-stock">Availablity: <span>In stock</span></div>

                                                            <span class="price"><span class="electro-price"><span class="amount">$629.00</span></span></span>
                                                            <a class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="5487FB8/35" data-product_id="2706" data-quantity="1" href="single-product.html" rel="nofollow">Add to cart</a>
                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                                        <a class="add_to_wishlist" data-product-type="simple" data-product-id="2706" rel="nofollow" href="#">Wishlist</a>

                                                                        <div style="display:none;" class="yith-wcwl-wishlistaddedbrowse hide">
                                                                            <span class="feedback">Product added!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="display:none" class="yith-wcwl-wishlistexistsbrowse hide">
                                                                            <span class="feedback">The product is already in the wishlist!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="clear:both"></div>
                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                                                    </div>
                                                                    <div class="clear"></div>
                                                                    <a data-product_id="2706" class="add-to-compare-link" href="#">Compare</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/1.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="#">Tablets</a></span><a href="single-product.html"><h3>Tablet Air 3 WiFi 64GB  Gold</h3>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">

                                                            <div class="availability in-stock">Availablity: <span>In stock</span></div>

                                                            <span class="price"><span class="electro-price"><span class="amount">$629.00</span></span></span>
                                                            <a class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="5487FB8/35" data-product_id="2706" data-quantity="1" href="single-product.html" rel="nofollow">Add to cart</a>
                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                                        <a class="add_to_wishlist" data-product-type="simple" data-product-id="2706" rel="nofollow" href="#">Wishlist</a>

                                                                        <div style="display:none;" class="yith-wcwl-wishlistaddedbrowse hide">
                                                                            <span class="feedback">Product added!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="display:none" class="yith-wcwl-wishlistexistsbrowse hide">
                                                                            <span class="feedback">The product is already in the wishlist!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="clear:both"></div>
                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                                                    </div>
                                                                    <div class="clear"></div>
                                                                    <a data-product_id="2706" class="add-to-compare-link" href="#">Compare</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/6.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="#">Tablets</a></span><a href="single-product.html"><h3>Tablet Air 3 WiFi 64GB  Gold</h3>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">

                                                            <div class="availability in-stock">Availablity: <span>In stock</span></div>

                                                            <span class="price"><span class="electro-price"><span class="amount">$629.00</span></span></span>
                                                            <a class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="5487FB8/35" data-product_id="2706" data-quantity="1" href="single-product.html" rel="nofollow">Add to cart</a>
                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                                        <a class="add_to_wishlist" data-product-type="simple" data-product-id="2706" rel="nofollow" href="#">Wishlist</a>

                                                                        <div style="display:none;" class="yith-wcwl-wishlistaddedbrowse hide">
                                                                            <span class="feedback">Product added!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="display:none" class="yith-wcwl-wishlistexistsbrowse hide">
                                                                            <span class="feedback">The product is already in the wishlist!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="clear:both"></div>
                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                                                    </div>
                                                                    <div class="clear"></div>
                                                                    <a data-product_id="2706" class="add-to-compare-link" href="#">Compare</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/3.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="#">Tablets</a></span><a href="single-product.html"><h3>Tablet Air 3 WiFi 64GB  Gold</h3>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">

                                                            <div class="availability in-stock">Availablity: <span>In stock</span></div>

                                                            <span class="price"><span class="electro-price"><span class="amount">$629.00</span></span></span>
                                                            <a class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="5487FB8/35" data-product_id="2706" data-quantity="1" href="single-product.html" rel="nofollow">Add to cart</a>
                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                                        <a class="add_to_wishlist" data-product-type="simple" data-product-id="2706" rel="nofollow" href="#">Wishlist</a>

                                                                        <div style="display:none;" class="yith-wcwl-wishlistaddedbrowse hide">
                                                                            <span class="feedback">Product added!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="display:none" class="yith-wcwl-wishlistexistsbrowse hide">
                                                                            <span class="feedback">The product is already in the wishlist!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="clear:both"></div>
                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                                                    </div>
                                                                    <div class="clear"></div>
                                                                    <a data-product_id="2706" class="add-to-compare-link" href="#">Compare</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/5.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="#">Tablets</a></span><a href="single-product.html"><h3>Tablet Air 3 WiFi 64GB  Gold</h3>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">

                                                            <div class="availability in-stock">Availablity: <span>In stock</span></div>

                                                            <span class="price"><span class="electro-price"><span class="amount">$629.00</span></span></span>
                                                            <a class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="5487FB8/35" data-product_id="2706" data-quantity="1" href="single-product.html" rel="nofollow">Add to cart</a>
                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                                        <a class="add_to_wishlist" data-product-type="simple" data-product-id="2706" rel="nofollow" href="#">Wishlist</a>

                                                                        <div style="display:none;" class="yith-wcwl-wishlistaddedbrowse hide">
                                                                            <span class="feedback">Product added!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="display:none" class="yith-wcwl-wishlistexistsbrowse hide">
                                                                            <span class="feedback">The product is already in the wishlist!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="clear:both"></div>
                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                                                    </div>
                                                                    <div class="clear"></div>
                                                                    <a data-product_id="2706" class="add-to-compare-link" href="#">Compare</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/4.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="#">Tablets</a></span><a href="single-product.html"><h3>Tablet Air 3 WiFi 64GB  Gold</h3>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">

                                                            <div class="availability in-stock">Availablity: <span>In stock</span></div>

                                                            <span class="price"><span class="electro-price"><span class="amount">$629.00</span></span></span>
                                                            <a class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="5487FB8/35" data-product_id="2706" data-quantity="1" href="single-product.html" rel="nofollow">Add to cart</a>
                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                                        <a class="add_to_wishlist" data-product-type="simple" data-product-id="2706" rel="nofollow" href="#">Wishlist</a>

                                                                        <div style="display:none;" class="yith-wcwl-wishlistaddedbrowse hide">
                                                                            <span class="feedback">Product added!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="display:none" class="yith-wcwl-wishlistexistsbrowse hide">
                                                                            <span class="feedback">The product is already in the wishlist!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="clear:both"></div>
                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                                                    </div>
                                                                    <div class="clear"></div>
                                                                    <a data-product_id="2706" class="add-to-compare-link" href="#">Compare</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/2.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="#">Tablets</a></span><a href="single-product.html"><h3>Tablet Air 3 WiFi 64GB  Gold</h3>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">

                                                            <div class="availability in-stock">Availablity: <span>In stock</span></div>

                                                            <span class="price"><span class="electro-price"><span class="amount">$629.00</span></span></span>
                                                            <a class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="5487FB8/35" data-product_id="2706" data-quantity="1" href="single-product.html" rel="nofollow">Add to cart</a>
                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                                        <a class="add_to_wishlist" data-product-type="simple" data-product-id="2706" rel="nofollow" href="#">Wishlist</a>

                                                                        <div style="display:none;" class="yith-wcwl-wishlistaddedbrowse hide">
                                                                            <span class="feedback">Product added!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="display:none" class="yith-wcwl-wishlistexistsbrowse hide">
                                                                            <span class="feedback">The product is already in the wishlist!</span>
                                                                            <a rel="nofollow" href="#">Wishlist</a>
                                                                        </div>

                                                                        <div style="clear:both"></div>
                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                                                    </div>
                                                                    <div class="clear"></div>
                                                                    <a data-product_id="2706" class="add-to-compare-link" href="#">Compare</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="list-view-small" aria-expanded="true">

                                    <ul class="products columns-3">
                                        <li class="product list-view list-view-small">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/1.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="product-category.html">Smartphones</a></span><a href="product-category.html"><h3>Ultrabook UX605CA-FC050T</h3>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="price-add-to-cart">
                                                                <span class="price"><span class="electro-price"><span class="amount">$1,218.00</span></span></span>
                                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="compare.html" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view list-view-small">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/2.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="product-category.html">Smartphones</a></span><a href="product-category.html"><h3>Ultrabook UX605CA-FC050T</h3>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="price-add-to-cart">
                                                                <span class="price"><span class="electro-price"><span class="amount">$1,218.00</span></span></span>
                                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="compare.html" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view list-view-small">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/3.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="product-category.html">Smartphones</a></span><a href="product-category.html"><h3>Ultrabook UX605CA-FC050T</h3>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="price-add-to-cart">
                                                                <span class="price"><span class="electro-price"><span class="amount">$1,218.00</span></span></span>
                                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="compare.html" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view list-view-small">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/4.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="product-category.html">Smartphones</a></span><a href="product-category.html"><h3>Ultrabook UX605CA-FC050T</h3>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="price-add-to-cart">
                                                                <span class="price"><span class="electro-price"><span class="amount">$1,218.00</span></span></span>
                                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="compare.html" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view list-view-small">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/5.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="product-category.html">Smartphones</a></span><a href="product-category.html"><h3>Ultrabook UX605CA-FC050T</h3>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="price-add-to-cart">
                                                                <span class="price"><span class="electro-price"><span class="amount">$1,218.00</span></span></span>
                                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="compare.html" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view list-view-small">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/6.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="product-category.html">Smartphones</a></span><a href="product-category.html"><h3>Ultrabook UX605CA-FC050T</h3>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="price-add-to-cart">
                                                                <span class="price"><span class="electro-price"><span class="amount">$1,218.00</span></span></span>
                                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="compare.html" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view list-view-small">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/4.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="product-category.html">Smartphones</a></span><a href="product-category.html"><h3>Ultrabook UX605CA-FC050T</h3>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="price-add-to-cart">
                                                                <span class="price"><span class="electro-price"><span class="amount">$1,218.00</span></span></span>
                                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="compare.html" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view list-view-small">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/2.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="product-category.html">Smartphones</a></span><a href="product-category.html"><h3>Ultrabook UX605CA-FC050T</h3>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="price-add-to-cart">
                                                                <span class="price"><span class="electro-price"><span class="amount">$1,218.00</span></span></span>
                                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="compare.html" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view list-view-small">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/5.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="product-category.html">Smartphones</a></span><a href="product-category.html"><h3>Ultrabook UX605CA-FC050T</h3>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="price-add-to-cart">
                                                                <span class="price"><span class="electro-price"><span class="amount">$1,218.00</span></span></span>
                                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="compare.html" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view list-view-small">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/1.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="product-category.html">Smartphones</a></span><a href="product-category.html"><h3>Ultrabook UX605CA-FC050T</h3>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="price-add-to-cart">
                                                                <span class="price"><span class="electro-price"><span class="amount">$1,218.00</span></span></span>
                                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="compare.html" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view list-view-small">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/6.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="product-category.html">Smartphones</a></span><a href="product-category.html"><h3>Ultrabook UX605CA-FC050T</h3>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="price-add-to-cart">
                                                                <span class="price"><span class="electro-price"><span class="amount">$1,218.00</span></span></span>
                                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="compare.html" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view list-view-small">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/3.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="product-category.html">Smartphones</a></span><a href="product-category.html"><h3>Ultrabook UX605CA-FC050T</h3>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="price-add-to-cart">
                                                                <span class="price"><span class="electro-price"><span class="amount">$1,218.00</span></span></span>
                                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="compare.html" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view list-view-small">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/5.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="product-category.html">Smartphones</a></span><a href="product-category.html"><h3>Ultrabook UX605CA-FC050T</h3>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="price-add-to-cart">
                                                                <span class="price"><span class="electro-price"><span class="amount">$1,218.00</span></span></span>
                                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="compare.html" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view list-view-small">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/4.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="product-category.html">Smartphones</a></span><a href="product-category.html"><h3>Ultrabook UX605CA-FC050T</h3>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="price-add-to-cart">
                                                                <span class="price"><span class="electro-price"><span class="amount">$1,218.00</span></span></span>
                                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="compare.html" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product list-view list-view-small">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single-product.html">
                                                        <img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/products/2.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
                                                    </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <span class="loop-product-categories"><a rel="tag" href="product-category.html">Smartphones</a></span><a href="product-category.html"><h3>Ultrabook UX605CA-FC050T</h3>
                                                                <div class="product-short-description">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>4.5 inch HD Screen</li>
                                                                        <li>Android 4.4 KitKat OS</li>
                                                                        <li>1.4 GHz Quad Core&trade; Processor</li>
                                                                        <li>20 MP front Camera</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-rating">
                                                                    <div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="price-add-to-cart">
                                                                <span class="price"><span class="electro-price"><span class="amount">$1,218.00</span></span></span>
                                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">
                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                                    <a href="compare.html" class="add-to-compare-link">Compare</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="shop-control-bar-bottom">
                                <form class="form-electro-wc-ppp">
                                    <select class="electro-wc-wppp-select c-select" onchange="this.form.submit()" name="ppp"><option selected="selected" value="15">Show 15</option><option value="-1">Show All</option></select>
                                </form>
                                <p class="woocommerce-result-count">Showing 1&ndash;15 of 20 results</p>
                                <nav class="woocommerce-pagination">
                                    <ul class="page-numbers">
                                        <li><span class="page-numbers current">1</span></li>
                                        <li><a href="#" class="page-numbers">2</a></li>
                                        <li><a href="#" class="next page-numbers">→</a></li>
                                    </ul>
                                </nav>
                            </div>

                        </main><!-- #main -->
                    </div><!-- #primary -->

                    <div id="sidebar" class="sidebar" role="complementary">
                        <aside class="widget woocommerce widget_product_categories electro_widget_product_categories">
                            <ul class="product-categories category-single">
                                <li class="product_cat">
                                    <ul class="show-all-cat">
                                        <li class="product_cat"><span class="show-all-cat-dropdown">Show All Categories</span>
                                            <ul>
                                                <li class="cat-item"><a href="product-category.html">GPS &amp; Navi</a> <span class="count">(0)</span></li>
                                                <li class="cat-item"><a href="product-category.html">Home Entertainment</a> <span class="count">(1)</span></li>
                                                <li class="cat-item"><a href="product-category.html">Cameras &amp; Photography</a> <span class="count">(5)</span></li>
                                                <li class="cat-item"><a href="product-category.html">Smart Phones &amp; Tablets</a> <span class="count">(20)</span></li>
                                                <li class="cat-item"><a href="product-category.html">Video Games &amp; Consoles</a> <span class="count">(3)</span></li>
                                                <li class="cat-item"><a href="product-category.html">TV &amp; Audio</a> <span class="count">(1)</span></li>
                                                <li class="cat-item"><a href="product-category.html">Gadgets</a> <span class="count">(3)</span></li>
                                                <li class="cat-item"><a href="product-category.html">Car Electronic &amp; GPS</a> <span class="count">(0)</span></li>
                                                <li class="cat-item"><a href="product-category.html">Accessories</a> <span class="count">(11)</span></li>
                                                <li class="cat-item"><a href="product-category.html">Printers &amp; Ink</a> <span class="count">(1)</span></li>
                                                <li class="cat-item"><a href="product-category.html">Software</a> <span class="count">(0)</span></li>
                                                <li class="cat-item"><a href="product-category.html">Office Supplies</a> <span class="count">(0)</span></li>
                                                <li class="cat-item"><a href="product-category.html">Computer Components</a> <span class="count">(1)</span></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="cat-item current-cat"><a href="product-category.html">Laptops &amp; Computers</a> <span class="count">(13)</span>
                                            <ul class='children'>
                                                <li class="cat-item"><a href="product-category.html">Laptops</a> <span class="count">(6)</span></li>
                                                <li class="cat-item"><a href="product-category.html">Ultrabooks</a> <span class="count">(1)</span></li>
                                                <li class="cat-item"><a href="product-category.html">Computers</a> <span class="count">(0)</span></li>
                                                <li class="cat-item"><a href="product-category.html">Mac Computers</a> <span class="count">(1)</span></li>
                                                <li class="cat-item"><a href="product-category.html">All in One</a> <span class="count">(1)</span></li>
                                                <li class="cat-item"><a href="product-category.html">Servers</a> <span class="count">(1)</span></li>
                                                <li class="cat-item"><a href="product-category.html">Peripherals</a> <span class="count">(1)</span></li>
                                                <li class="cat-item"><a href="product-category.html">Gaming</a> <span class="count">(1)</span></li>
                                                <li class="cat-item"><a href="product-category.html">Accessories</a> <span class="count">(2)</span></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </aside>
                        <aside class="widget widget_electro_products_filter">
                            <h3 class="widget-title">Filters</h3>
                            <aside class="widget woocommerce widget_layered_nav">
                                <h3 class="widget-title">Brands</h3>
                                <ul>
                                    <li style=""><a href="#">Apple</a> <span class="count">(4)</span></li>
                                    <li style=""><a href="#">Gionee</a> <span class="count">(2)</span></li>
                                    <li style=""><a href="#">HTC</a> <span class="count">(2)</span></li>
                                    <li style=""><a href="#">LG</a> <span class="count">(2)</span></li>
                                    <li style=""><a href="#">Micromax</a> <span class="count">(1)</span></li>
                                </ul>
                                <p class="maxlist-more"><a href="#">+ Show more</a></p>
                            </aside>
                            <aside class="widget woocommerce widget_layered_nav">
                                <h3 class="widget-title">Color</h3>
                                <ul>
                                    <li style=""><a href="#">Black</a> <span class="count">(4)</span></li>
                                    <li style=""><a href="#">Black Leather</a> <span class="count">(2)</span></li>
                                    <li style=""><a href="#">Turquoise</a> <span class="count">(2)</span></li>
                                    <li style=""><a href="#">White</a> <span class="count">(4)</span></li>
                                    <li style=""><a href="#">Gold</a> <span class="count">(4)</span></li>
                                </ul>
                                <p class="maxlist-more"><a href="#">+ Show more</a></p>
                            </aside>
                            <aside class="widget woocommerce widget_price_filter">
                                <h3 class="widget-title">Price</h3>
                                <form action="#">
                                    <div class="price_slider_wrapper">
                                        <div style="" class="price_slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                            <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div>
                                            <span tabindex="0" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 0%;"></span>
                                            <span tabindex="0" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 100%;"></span>
                                        </div>
                                        <div class="price_slider_amount">
                                            <a href="#" class="button">Filter</a>
                                            <div style="" class="price_label">Price: <span class="from">$428</span> &mdash; <span class="to">$3485</span></div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </form>
                            </aside>
                        </aside>
                        <aside class="widget widget_text">
                            <div class="textwidget">
                                <a href="#"><img src="<?php echo $this->config->item("val_url");?>images/banner/ad-banner-sidebar.jpg" alt="Banner"></a>
                            </div>
                        </aside>
                        <aside class="widget widget_products">
                            <h3 class="widget-title">Latest Products</h3>
                            <ul class="product_list_widget">
                                <li>
                                    <a href="single-product.html" title="Notebook Black Spire V Nitro  VN7-591G">
                                        <img width="180" height="180" src="<?php echo $this->config->item("val_url");?>images/product-category/1.jpg" class="wp-post-image" alt=""/><span class="product-title">Notebook Black Spire V Nitro  VN7-591G</span>
                                    </a>
                                    <span class="electro-price"><ins><span class="amount">&#36;1,999.00</span></ins> <del><span class="amount">&#36;2,299.00</span></del></span>
                                </li>

                                <li>
                                    <a href="single-product.html" title="Tablet Thin EliteBook  Revolve 810 G6">
                                        <img width="180" height="180" src="<?php echo $this->config->item("val_url");?>images/product-category/2.jpg" class="wp-post-image" alt=""/><span class="product-title">Tablet Thin EliteBook  Revolve 810 G6</span>
                                    </a>
                                    <span class="electro-price"><span class="amount">&#36;1,300.00</span></span>
                                </li>

                                <li>
                                    <a href="single-product.html" title="Notebook Widescreen Z51-70  40K6013UPB">
                                        <img width="180" height="180" src="<?php echo $this->config->item("val_url");?>images/product-category/3.jpg" class="wp-post-image" alt=""/><span class="product-title">Notebook Widescreen Z51-70  40K6013UPB</span>
                                    </a>
                                    <span class="electro-price"><span class="amount">&#36;1,100.00</span></span>
                                </li>

                                <li>
                                    <a href="single-product.html" title="Notebook Purple G952VX-T7008T">
                                        <img width="180" height="180" src="<?php echo $this->config->item("val_url");?>images/product-category/4.jpg" class="wp-post-image" alt=""/><span class="product-title">Notebook Purple G952VX-T7008T</span>
                                    </a>
                                    <span class="electro-price"><span class="amount">&#36;2,780.00</span></span>
                                </li>
                            </ul>
                        </aside>
                    </div>

                </div><!-- .container -->
            </div><!-- #content -->

            <section class="brands-carousel">
            	<h2 class="sr-only">Brands Carousel</h2>
            	<div class="container">
            		<div id="owl-brands" class="owl-brands owl-carousel unicase-owl-carousel owl-outer-nav">

            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>Acer</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						 <img src="<?php echo $this->config->item("val_url");?>images/blank.gif" data-echo="<?php echo $this->config->item("val_url");?>images/brands/1.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>Apple</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						 <img src="<?php echo $this->config->item("val_url");?>images/blank.gif" data-echo="<?php echo $this->config->item("val_url");?>images/brands/2.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>Asus</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						 <img src="<?php echo $this->config->item("val_url");?>images/blank.gif" data-echo="<?php echo $this->config->item("val_url");?>images/brands/3.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>Dell</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						<img src="<?php echo $this->config->item("val_url");?>images/blank.gif" data-echo="<?php echo $this->config->item("val_url");?>images/brands/4.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>Gionee</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						<img src="<?php echo $this->config->item("val_url");?>images/blank.gif" data-echo="<?php echo $this->config->item("val_url");?>images/brands/5.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>HP</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						<img src="<?php echo $this->config->item("val_url");?>images/blank.gif" data-echo="<?php echo $this->config->item("val_url");?>images/brands/6.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>HTC</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						<img src="<?php echo $this->config->item("val_url");?>images/blank.gif" data-echo="<?php echo $this->config->item("val_url");?>images/brands/3.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>IBM</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						<img src="<?php echo $this->config->item("val_url");?>images/blank.gif" data-echo="<?php echo $this->config->item("val_url");?>images/brands/5.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>Lenova</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						<img src="<?php echo $this->config->item("val_url");?>images/blank.gif" data-echo="<?php echo $this->config->item("val_url");?>images/brands/2.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>LG</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						<img src="<?php echo $this->config->item("val_url");?>images/blank.gif" data-echo="<?php echo $this->config->item("val_url");?>images/brands/1.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>Micromax</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						<img src="<?php echo $this->config->item("val_url");?>images/blank.gif" data-echo="<?php echo $this->config->item("val_url");?>images/brands/6.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            			<div class="item">

            				<a href="#">

            					<figure>
            						<figcaption class="text-overlay">
            							<div class="info">
            								<h4>Microsoft</h4>
            							</div><!-- /.info -->
            						</figcaption>

            						<img src="<?php echo $this->config->item("val_url");?>images/blank.gif" data-echo="<?php echo $this->config->item("val_url");?>images/brands/4.png" class="img-responsive" alt="">

            					</figure>
            				</a>
            			</div><!-- /.item -->


            		</div><!-- /.owl-carousel -->

            	</div>
            </section>

            <footer id="colophon" class="site-footer">
            	<div class="footer-widgets">
            		<div class="container">
            			<div class="row">
            				<div class="col-lg-4 col-md-4 col-xs-12">
            					<aside class="widget clearfix">
            						<div class="body">
            							<h4 class="widget-title">Featured Products</h4>
            							<ul class="product_list_widget">
            								<li>
            									<a href="single-product.html" title="Tablet Thin EliteBook  Revolve 810 G6">
            										<img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/footer/1.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
            										<span class="product-title">Tablet Thin EliteBook  Revolve 810 G6</span>
            									</a>
            									<span class="electro-price"><span class="amount">&#36;1,300.00</span></span>
            								</li>

            								<li>
            									<a href="single-product.html" title="Smartphone 6S 128GB LTE">
            										<img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/footer/2.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt=""><span class="product-title">Smartphone 6S 128GB LTE</span>
            									</a>
            									<span class="electro-price"><span class="amount">&#36;780.00</span></span>
            								</li>

            								<li>
            									<a href="single-product.html" title="Smartphone 6S 64GB LTE">
            										<img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/footer/3.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
            										<span class="product-title">Smartphone 6S 64GB LTE</span>
            									</a>
            									<span class="electro-price"><span class="amount">&#36;1,215.00</span></span>
            								</li>
            							</ul>
            						</div>
            					</aside>
            				</div>
            				<div class="col-lg-4 col-md-4 col-xs-12">
            					<aside class="widget clearfix">
            						<div class="body"><h4 class="widget-title">Onsale Products</h4>
            							<ul class="product_list_widget">
            								<li>
            									<a href="single-product.html" title="Notebook Black Spire V Nitro  VN7-591G">
            										<img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/footer/3.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
            										<span class="product-title">Notebook Black Spire V Nitro  VN7-591G</span>
            									</a>
            									<span class="electro-price"><ins><span class="amount">&#36;1,999.00</span></ins> <del><span class="amount">&#36;2,299.00</span></del></span>
            								</li>

            								<li>
            									<a href="single-product.html" title="Tablet Red EliteBook  Revolve 810 G2">
            										<img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/footer/4.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
            										<span class="product-title">Tablet Red EliteBook  Revolve 810 G2</span>
            									</a>
            									<span class="electro-price"><ins><span class="amount">&#36;1,999.00</span></ins> <del><span class="amount">&#36;2,299.00</span></del></span>
            								</li>

            								<li>
            									<a href="single-product.html" title="Widescreen 4K SUHD TV">
            										<img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/footer/5.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
            										<span class="product-title">Widescreen 4K SUHD TV</span>
            									</a>
            									<span class="electro-price"><ins><span class="amount">&#36;2,999.00</span></ins> <del><span class="amount">&#36;3,299.00</span></del></span>
            								</li>
            							</ul>
            						</div>
            					</aside>
            				</div>
            				<div class="col-lg-4 col-md-4 col-xs-12">
            					<aside class="widget clearfix">
            						<div class="body">
            							<h4 class="widget-title">Top Rated Products</h4>
            							<ul class="product_list_widget">
            								<li>
            									<a href="single-product.html" title="Notebook Black Spire V Nitro  VN7-591G">
            										<img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/footer/6.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
            										<span class="product-title">Notebook Black Spire V Nitro  VN7-591G</span>
            									</a>
            									<div class="star-rating" title="Rated 5 out of 5"><span style="width:100%"><strong class="rating">5</strong> out of 5</span></div>		<span class="electro-price"><ins><span class="amount">&#36;1,999.00</span></ins> <del><span class="amount">&#36;2,299.00</span></del></span>
            								</li>

            								<li>
            									<a href="single-product.html" title="Apple MacBook Pro MF841HN/A 13-inch Laptop">
            										<img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/footer/7.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
            										<span class="product-title">Apple MacBook Pro MF841HN/A 13-inch Laptop</span>
            									</a>
            									<div class="star-rating" title="Rated 5 out of 5"><span style="width:100%"><strong class="rating">5</strong> out of 5</span></div>		<span class="electro-price"><span class="amount">&#36;1,800.00</span></span>
            								</li>

            								<li>
            									<a href="single-product.html" title="Tablet White EliteBook Revolve  810 G2">
            										<img class="wp-post-image" data-echo="<?php echo $this->config->item("val_url");?>images/footer/2.jpg" src="<?php echo $this->config->item("val_url");?>images/blank.gif" alt="">
            										<span class="product-title">Tablet White EliteBook Revolve  810 G2</span>
            									</a>
            									<div class="star-rating" title="Rated 5 out of 5"><span style="width:100%"><strong class="rating">5</strong> out of 5</span></div>		<span class="electro-price"><span class="amount">&#36;1,999.00</span></span>
            								</li>
            							</ul>
            						</div>
            					</aside>
            				</div>
            			</div>
            		</div>
            	</div>

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
            			<div class="pull-left flip copyright">&copy; <a href="http://demo2.transvelo.in/html/electro/">Electro</a> - All Rights Reserved</div>
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
            </footer><!-- #colophon -->

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
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/electro.js"></script>

    </body>
</html>
