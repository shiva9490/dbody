<div class="page-header-section">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between justify-content-md-start">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url();?>">Home</a></li>
                    <li><span>/</span></li>
                    <li>Vendor Products</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section id="dashboard-nav" class="dashboard-section">
    <div class="container">
       <?php $this->load->view("vendor_dashboard");?>
    </div>
    <div class="container">
        <div class="dashboard-body">
            <div class="profile">
                <div class="profile-address-book">
                    <h5 class="title mb-5">Vendor Products </h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="postList">
                                <?php $this->load->view("vendor/ajaxvendorproducts");?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>