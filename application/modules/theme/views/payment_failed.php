  <?php $country    =   $this->session->userdata("currency_code");?>
    <div class="page-header-section">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-start">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo base_url();?>">Home</a></li>
                        <li><span>/</span></li>
                        <li>Success</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- page-header-section end -->

    <!-- dashboard-section start -->
    <section class="dashboard-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-item billing-item bg-color-white box-shadow p-3 p-lg-5 border-radius5">
                        <div class="row">  
                            <div class="col-lg-12">
                                <center>
                                    <img class="text-center" src="<?php echo base_url().'assets/error.png'?>"><br>
                                    <h4>Transaction failed.</h4>
                                    <a href="<?php echo base_url();?>" class="btn btn-primary">Home</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- dashboard-section end -->