<section class="mt-5" style="background-image: url(http://localhost/kart/assets/images/refer.png);
    margin-top: 140px !important;
    background-size: cover;
    padding: 50px;">
    <div class="container">
        <h3> Your Refferal</h3>
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <div>
                    <?php $userid = $this->session->userdata('customer_id');
                        $par['whereCondition'] = "customer_id = '".$userid."'";
                        $user_details = $this->customer_model->getCustomer($par); ?>
                    <h3 class="text-center refercode p-5"><?php echo $user_details['customer_coupon'];?></h3>
                    <a href="#" class="text-center btn btn-warning d-block p-2">Share <i class="fa fa-share-square" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
</section> 

<section class="mt-5">
    <div class="container">
        <h3> Your Coupons</h3>
        <div class="row">
<?php 
    if($user_details['customer_coupon']!=''){
        $conditions["whereCondition"] ="order_coupon = '".$user_details['customer_coupon']."'";
        $details          =   $this->order_model->vieworders($conditions);
        $i=1;
        foreach($details as $d){
            if($d->order_acde == "Order Placed"){
                $sta1 = "active";
                $staa1 = "active-line";
            }
            if($d->order_acde == "On the Way"){
                $sta1 = "active";
                $staa1 = "active-line";
                $sta2 = "active";
                $staa2 = "active-line";
            }
            if($d->order_acde == "Delivered"){
                $sta1 = "active";
                $staa1 = "active-line";
                $sta2 = "active";
                $staa2 = "active-line";
                $sta3 = "active";
                $staa3 = "active-line";
            }
            if($d->order_coupon_gen != ""){
                $sta1 = "active";
                $staa1 = "active-line";
                $sta2 = "active";
                $staa2 = "active-line";
                $sta3 = "active";
                $staa3 = "active-line";
                $sta4 = "active";
                $staa4 = "active-line";
            }
            ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-head" align="center">
                            <h5>#<?php echo $i;?> </h5>
                    </div>
                    <div class="card-body">                 
                            
                        <div class="progress-form">
                            <div class="progress-header">
                                <div class="header_title <?php echo $sta1;?>">
                                    <div class="title">Order Placed</div>
                                    <div class="circle_container">
                                        <div class="left-line-hidden"></div>
                                        <div class="circle"></div>
                                        <div class="right-line <?php echo $staa2;?>"></div>
                                    </div>
                                </div>
                                <div class="header_title <?php echo $sta2;?>">
                                    <div class="title"> Order on the way</div>
                                    <div class="circle_container">
                                        <div class="left-line <?php echo $staa2;?>"></div>
                                        <div class="circle"></div>
                                        <div class="right-line <?php echo $staa3;?>"></div>
                                    </div>
                                </div>
                                <div class="header_title <?php echo $sta3;?>">
                                    <div class="title">Order Delivered</div>
                                    <div class="circle_container">
                                        <div class="left-line <?php echo $staa3;?>"></div>
                                        <div class="circle"></div>
                                        <div class="right-line <?php echo $staa4;?>"></div>
                                    </div>
                                </div>
                                <div class="header_title <?php echo $sta4;?>">
                                    <div class="title">Coupon Generated</div>
                                    <div class="circle_container">
                                        <div class="left-line <?php echo $staa4;?>"></div>
                                        <div class="circle"></div>
                                        <div class="right-line-hidden"></div>
                                    </div>
                                </div>
                            </div>
                        </div><br><br>
                        <div class="row">
                            <div class="col-md-8 mx-auto">
                            <div>
                            <h3 class="text-center refercode p-3"><?php echo $d->order_coupon_gen;?></h3>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 mx-auto">           
                            <div class="mx-auto d-table">
                                    <a href="<?php echo base_url();?>View-Cart" class="text-center btn btn-warning p-3">Go to Cart</a>
                                    <a href="<?php echo base_url();?>" class="text-center btn btn-warning ml-2 p-3">View Products</a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

       <?php $i++;
        }
    }
?>
            
        </div>
    </div>
</section>
<style>
    .refercode{
        border: 2px dashed #000;
    }
    .timeline {
    border-left:3px solid #e56e2d;
    border-bottom-right-radius: 4px;
    border-top-right-radius: 4px;  
    margin: 0 auto;
    letter-spacing: 0.2px;
    position: relative;
    line-height: 1.4em;
    font-size: 1.03em;
    padding: 50px;
    list-style: none;
    text-align: left;
    max-width: 40%;
}

@media (max-width: 767px) {
    .timeline {
        max-width: 98%;
        padding: 25px;
    }
}

.timeline h1 {
    font-weight: 300;
    font-size: 1.4em;
}

.timeline h2,
.timeline h3 {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 10px;
}

.timeline .event {
    border-bottom: 1px dashed #e8ebf1;
    padding-bottom: 25px;
    margin-bottom: 25px;
    position: relative;
}

@media (max-width: 767px) {
    .timeline .event {
        padding-top: 30px;
    }
}

.timeline .event:last-of-type {
    padding-bottom: 0;
    margin-bottom: 0;
    border: none;
}

.timeline .event:before,
.timeline .event:after {
    position: absolute;
    display: block;
    top: 0;
}

.timeline .event:before {
    left: -207px;
    content: attr(data-date);
    text-align: right;
    font-weight: 100;
    font-size: 0.9em;
    min-width: 120px;
}

@media (max-width: 767px) {
    .timeline .event:before {
        left: 0px;
        text-align: left;
    }
}

.timeline .event:after {
    -webkit-box-shadow: 0 0 0 3px #162e41;
    box-shadow: 0 0 0 3px #162e41;
    left: -55.8px;
    background: #fff;
    border-radius: 50%;
    height: 9px;
    width: 9px;
    content: "";
    top: 5px;
}

@media (max-width: 767px) {
    .timeline .event:after {
        left: -31.8px;
    }
}

.rtl .timeline {
    border-left: 0;
    text-align: right;
    border-bottom-right-radius: 0;
    border-top-right-radius: 0;
    border-bottom-left-radius: 4px;
    border-top-left-radius: 4px;
    border-right: 3px solid #727cf5;
}

.rtl .timeline .event::before {
    left: 0;
    right: -170px;
}

.rtl .timeline .event::after {
    left: 0;
    right: -55.8px;
}

.progress-form{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.progress-header{
    display: flex;
    flex-direction: row;    
}
.header_title{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}


.title {
    color: #b0b2b0;
}

.circle_container{
    display: flex;
    justify-content: center;
    align-items: center;
}

.circle{
    width: 20px;
    height: 20px;
    border: 2px solid #b0b2b0;
    border-radius: 50%;
}

.right-line , .left-line , .left-line-hidden , .right-line-hidden{
    width: 50px;
    height: 0px;
    border: 2px solid #b0b2b0;
}
.left-line-hidden , .right-line-hidden{
 
    border: 2px solid transparent;
}

.active .circle_container .circle , .active-line  {
    border: 2px solid #54bdd0 !important;
    background: #54bdd0;
}
.active .title {
    color: #54bdd0 ;
}

.progress-content{
    display: flex;
}

.hide{
    display: none;
/*    visibility: hidden;*/
}

.btn{
  border:none;
  padding: 5px;
  border-radius:6px;
}

.btn-previous{
  color: #fff;
  border:1px solid #dedede;
}

.btn-next{
  background-color: #54bdd0;
  color:#fff;
  border: 1px solid #54bdd0;
}
</style>