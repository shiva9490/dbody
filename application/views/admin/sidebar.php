<style>
    nav.sidebar-nav {
        overflow-y: scroll;
        height: 90vh;
        padding-bottom:10px;
    }
</style>
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="dashboard">
                    <a href="<?php echo bildourl('dashboard');?>" class="waves-effect waves-dark"><i class="ti-home"></i> <span class="hide-menu"> Dashboard </span> </a> 
                </li> 
                <?php 
                if($this->session->userdata("manage-permission") == '1' || $this->session->userdata("manage-roles") == '1'){?>
                <li class="permissions roles update-role">
                    <a href="javascript:void(0)" class="waves-effect has-arrow waves-effect waves-dark" aria-expanded="false"><i class="ti-list"></i> <span class="hide-menu"> Administration </span> </a>
                    <ul class="list-unstyled collapse" aria-expanded="false"> 
                        <?php if($this->session->userdata("manage-permission") == '1'){?>
                        <li><a href="<?php echo bildourl('permissions');?>">Permissions</a></li> 
                        <?php } if($this->session->userdata("manage-roles") == '1'){?>
                        <li class="roles"><a href="<?php echo bildourl('roles');?>">Roles</a></li> 
                        <?php } if($this->session->userdata("manage-users") == '1'){?>
                        <li class="roles"><a href="<?php echo bildourl('users');?>">Users</a></li> 
                        <?php } ?>
                    </ul>
                </li> 
                <?php } if($this->session->userdata("manage-content-pages") == '1'){?>
                <li class="create-content-page view-content-pages update-content-page"> 
                    <a class="has-arrow waves-effect waves-dark category subcategory update-category update-subcategory" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-accordion-merged"></i><span class="hide-menu">Content Pages</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <?php if($this->session->userdata("create-content-page") == '1'){?>
                        <li class="create-content-page"><a href="<?php echo bildourl('create-content-page');?>">Create</a></li>
                        <?php } if($this->session->userdata("view-content-pages") == '1'){?>
                        <li class="view-content-pages update-content-page"><a href="<?php echo bildourl('view-content-pages');?>">View</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } if($this->session->userdata("manage-category") == '1' || $this->session->userdata("manage-sub-category") == '1'){?>
                <li class="category subcategory update-category update-subcategory"> 
                    <a class="has-arrow waves-effect waves-dark category subcategory update-category update-subcategory" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-accordion-merged"></i><span class="hide-menu">Category</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <?php if($this->session->userdata("manage-category") == '1'){?>
                        <li class="category update-category"><a href="<?php echo bildourl('category');?>">Category</a></li>
                        <?php } if($this->session->userdata("manage-sub-category") == '1'){?>
                        <li class="subcategory update-subcategory"><a href="<?php echo bildourl('subcategory');?>">Sub Category</a></li>
                        <?php } if($this->session->userdata("manage-Ingredients") == '1'){?>
                        <li class="subcategory update-Ingredients"><a href="<?php echo bildourl('Ingredients');?>">Ingredients</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } if($this->session->userdata("manage-widgets") == '1'){?>
                <li class="widgets update-widget">
                    <a href="<?php echo bildourl('widgets');?>" class="waves-effect waves-dark"><i class="ti-desktop"></i> <span class="hide-menu"> Widgets </span> </a>
                </li> 
                <?php } if($this->session->userdata("manage-menu") == '1'){?>
                <li>
                    <a href="<?php echo bildourl('menu');?>" class="waves-effect waves-dark"><i class="ti-menu"></i> <span class="hide-menu"> Menu </span> </a>
                </li> 
                <?php } if($this->session->userdata("manage-pincodes") == '1'){?>
                <li>
                    <a href="<?php echo bildourl('Pincode');?>" class="waves-effect waves-dark"><i class="ti-menu"></i> <span class="hide-menu"> Delivery Locations </span> </a>
                </li> 
                <?php } if($this->session->userdata("manage-notifications") == '1'){?>
                <li>
                    <a href="<?php echo bildourl('notifications');?>" class="waves-effect waves-dark"><i class="ti-menu"></i> <span class="hide-menu"> Pop Up </span> </a>
                </li>
                <?php } if($this->session->userdata("manage-products") == '1'){?>
                <li class="products update-product Upload-product create-product Create-Product-Name Update-Prices"> 
                    <a class="has-arrow waves-effect waves-dark products update-product Upload-product create-product Create-Product-Name Update-Prices" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-accordion-merged"></i><span class="hide-menu">Products</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <?php if($this->session->userdata("create-product") == '1'){?>
                        <li class="Create-Product-Name"><a href="<?php echo bildourl('Create-Product-Name');?>">Create ProductName</a></li>
                        <li class="create-product"><a href="<?php echo bildourl('create-product');?>">Create</a></li>
                        <li class="Upload-product"><a href="<?php echo bildourl('Upload-product');?>">Upload Products</a></li>
                        <li class="Update-Prices"><a href="<?php echo bildourl('Update-Prices');?>">Update Prices</a></li>
                        <?php } ?>
                        <li class="products update-product"><a href="<?php echo bildourl('products');?>">View</a></li>
                        <li class="products update-product"><a href="<?php echo bildourl('product-photos-upload');?>">Bulk product Image Upload</a></li>
                    </ul>
                </li>
                
                <?php } if($this->session->userdata("manage-packages") == '1'){?>
                <li class="packages update-package">
                    <a href="<?php echo bildourl('packages');?>" class="waves-effect waves-dark"><i class="ti-menu"></i> <span class="hide-menu"> Packages </span> </a>
                </li> 
                <?php } if($this->session->userdata("manage-banners") == '1'){?>
                <li class="banners update-banner">
                    <a href="<?php echo bildourl('banners');?>" class="waves-effect waves-dark"><i class="ti-file"></i> <span class="hide-menu"> Banners </span> </a>
                </li> 
                <?php } if($this->session->userdata("manage-deliverychg") == '1'){?>
                <li class="measures update-measure">
                    <a href="<?php echo bildourl('Deliverycharges');?>" class="waves-effect waves-dark"><i class="ti-dashboard"></i> <span class="hide-menu"> Delivery Charges </span> </a>
                </li>
                <?php } if($this->session->userdata("manage-measures") == '1'){?>
                <li class="measures update-measure">
                    <a href="<?php echo bildourl('measures');?>" class="waves-effect waves-dark"><i class="ti-dashboard"></i> <span class="hide-menu"> Measures </span> </a>
                </li>
                <?php }  if($this->session->userdata("manage-vendors") == '1'){?>
                <li>
                    <a href="<?php echo bildourl('vendors');?>" class="waves-effect waves-dark"><i class="ti-user"></i> <span class="hide-menu"> Vendors </span> </a>
                </li>
                <?php }  if($this->session->userdata("manage-orders") == '1'){?>
                <li>
                    <a href="<?php echo bildourl('orders');?>" class="waves-effect waves-dark"><i class="ti-user"></i> <span class="hide-menu"> Orders </span> </a>
                </li> 
                <?php }  if($this->session->userdata("manage-Blog") == '1'){?>
                <li>
                    <a href="<?php echo bildourl('Blog');?>" class="waves-effect waves-dark"><i class="ti-user"></i> <span class="hide-menu"> Blog </span> </a>
                </li> 
                <?php }  if($this->session->userdata("manage-reports") == '1'){?>
                <li class="create-delivery-boys update-delivery-boy view-delivery-boys"> 
                    <a class="has-arrow waves-effect waves-dark create-delivery-boys update-delivery-boy view-delivery-boys" href="javascript:void(0)" aria-expanded="false">
                        <i class="ti-layout-accordion-merged"></i><span class="hide-menu">Reports</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li class="create-delivery-boys"><a href="<?php echo bildourl('Order-Reports');?>">Orders Report</a></li>
                        <li class="create-delivery-boys"><a href="<?php echo bildourl('Customer-Reports');?>">Customer Report</a></li>
                        <li class="create-delivery-boys"><a href="<?php echo bildourl('Product-Reports');?>">Product Report</a></li>
                    </ul>
                </li>
                <?php }  if($this->session->userdata("manage-customers") == '1'){ ?>
                <li>
                    <a href="<?php echo bildourl('customers');?>" class="waves-effect waves-dark"><i class="fa fa-users"></i> <span class="hide-menu"> Customers </span> </a>
                </li> 
                <?php }  if($this->session->userdata("manage-coupon") == '1'){ ?>
                <li>
                    <a href="<?php echo bildourl('Coupon');?>" class="waves-effect waves-dark"><i class="ti-menu"></i> <span class="hide-menu"> Coupons </span> </a>
                </li> 
                <?php }  if($this->session->userdata("manage-refer") == '1'){ ?>
                <li>
                    <a href="<?php echo bildourl('Refer');?>" class="waves-effect waves-dark"><i class="ti-menu"></i> <span class="hide-menu"> Refer & Earn </span> </a>
                </li> 
                <?php }  if($this->session->userdata("manage-coupon") == '1'){ ?>
                <li>
                    <a href="<?php echo bildourl('Coupon');?>" class="waves-effect waves-dark"><i class="ti-menu"></i> <span class="hide-menu"> Coupons </span> </a>
                </li> 
                <?php }  if($this->session->userdata("manage-corporate_gifting") == '1'){ ?>
                <li>
                    <a href="<?php echo bildourl('corporate_gifting');?>" class="waves-effect waves-dark"><i class="ti-menu"></i> <span class="hide-menu"> Corporate Gifting </span> </a>
                </li> 
                <?php }  if($this->session->userdata("manage-addon") == '1'){ ?>
                <li>
                    <a href="<?php echo bildourl('Addon');?>" class="waves-effect waves-dark"><i class="ti-menu"></i> <span class="hide-menu"> Addons </span> </a>
                </li> 
                <?php } ?>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>