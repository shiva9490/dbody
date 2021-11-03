<?php 
$country =  $this->session->userdata("currency_code");
if(count($view) > 0){
    foreach ($view as $ce){
        //echo '<pre>';print_r($ce);exit;
        $locality   =   $ce->order_unique; 
        ?>
        <div class="order-item">
            <table class="table table-responsive1">
                <thead>
                    <tr>
                        <th class="px-3">My Orders</th>
                        <th class="text-center">Items</th>
                        <th class="text-right pr-5">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-3 py-4">
                            <div>
                                <h6 class="order-number">Order <?php echo $ce->order_unique;?></h6>
                                <p class="date"><?php echo date("d F, Y", strtotime($ce->order_date));?></p>
                                <p class="date"><?php echo date("h:i A", strtotime($ce->order_time));?></p>
                                <p class="price"> <?php echo $this->customer_model->currency_change($country,$ce->order_total);?></p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div>
                                <?php 
                                    $par['whereCondition'] = "orderdetail_orderid LIKE '".$ce->order_id."'";
                                    echo $order_details = $this->order_model->cntvieworderdetails($par);
                                ?>
                                items
                                <?php echo $ce->order_payment_mode;?>
                            </div>
                        </td>
                        <td class="text-right pr-5">
                            <div class="pending">
                                <?php 
                                    if($ce->order_payment_status==1){
                                        echo 'Placed Order';
                                    }else if($ce->order_payment_status ==2){
                                        echo 'Payment Pending';
                                    }else{
                                        echo 'Payment Failed';
                                    }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3">
                            <div>
                                <!--<a href="track-order-single.html">Track Order</a>-->
                            </div>
                        </td>
                        <td class="text-right px-4" colspan="2">
                            <div>
                                <a class="view-details" href="<?php echo base_url("Order-Details/".$locality);?>">View Details</a>
                                <!--<a class="btn btn-success" href="<?php echo base_url("Order-Details/".$locality);?>">Rate Product</a>-->
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php
    }
}else{
    ?>
<div class="col-sm-12 mt-10 mb-5 col-xs-12 col-md-12">
    <h4 class="text-center text-info"><i class="fa fa-info-circle"></i> No orders has been placed yet.</h4>
</div>
    <?php
}
?>
<div class="col-xs-12 col-sm-12 col-md-12 m-t-1">
    <?php echo $this->ajax_pagination->create_links();?>
</div>