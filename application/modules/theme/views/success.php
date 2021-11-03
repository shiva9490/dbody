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
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                    <img class="text-center" src="<?php echo base_url().'assets/images.png'?>"><br>
                                    <h4>Order Placed Successfully.</h4>
                                    <?php
                                        foreach($view as $view){
                                        $country = $this->session->userdata("currency_code");
                                        echo 
                                        '<b>Order Id :</b>#' . $view->order_unique.'<br>'.
                                        '<b>Tracking Id :</b>' .$view->order_razor_payment_id.'<br>'.
                                        '<b>Order Amount :</b>' . $this->customer_model->currency_change($country,$view->order_total).'<br>'.
                                        '<b>Order Status :</b>' . $view->order_gatepayment_status.'<br>';
                                        }
                                    ?>
                                    <center>
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