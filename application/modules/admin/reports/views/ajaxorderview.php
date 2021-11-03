<div class="order-list-item tblevaluetable-responsive table-responsive-m">
<table width="100%">
        <tr>
            <td> 
                <?php 
                    if(count($view) > 0)  { $i=0;
                        echo '<h2>Address</h2>';
                        foreach ($view as $ve){
                            if($i==0){
                                echo 'Namee : '.$ve->customer_name.'<br>';
                                echo 'Mobile : '.$ve->customer_mobile.'<br>';
                                echo 'Locality : '.$ve->customeraddress_locality.'<br>';
                                echo 'Address : '.$ve->customeraddress_address.'<br>';
                                echo 'Pincode : '.$ve->customeraddress_pincode.'<br>';
                                $i++;
                                $id=$ve->order_unique;
                            }
                        }
                    }
                ?>
            </td>
            <td style="vertical-align:top;"> 
                <?php 
                    if(count($view) > 0)  { $i=0;
                        $total=0;
                        foreach ($view as $ve){
                            $ot     =   $ve->orderdetail_quantity*$ve->orderdetail_price;
                            $total  =   $ot+$total;
                            }
                            echo 'Total Amount : '.$total.'<br>';
                            echo 'Payment Mode : '.$ve->order_payment_mode.'<br>';
                            echo 'Delivery Charges : '.$ve->order_delivery_charges;
                    }
                ?>
            </td>
        </tr>
    </table>
    
    
    <br>
    <h2>Order Details -(<?php echo $id;?>)</h2>
    <table class="table table-bordered table-striped table-condensed">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(count($view) > 0)  {
                foreach ($view as $ve){
                    $ot     =   $ve->orderdetail_quantity*$ve->orderdetail_price;
                    ?>
            <tr>
                <!--<td>-->
                <!--    <a href='javascript:void(0)' class="text-success" onclick="orderdetailsreport($(this))" orderid='<?php echo $ve->order_id;?>'>-->
                <!--        <?php echo $ve->order_unique;?>-->
                <!--    </a>-->
                <!--</td> -->
                <td><?php echo $ve->product_name;?></td>
                <td><?php echo $ve->orderdetail_quantity;?></td>
                <td><?php echo $ve->orderdetail_price;?></td>
                <td><i class='fa fa-inr'></i> <?php echo $ot;?></td>  
                <td><?php echo date("d-m-Y",strtotime($ve->order_date));?></td> 
                <td class="ordest<?php echo $ve->order_id;?>"><?php echo $ve->order_acde;?></td> 
                    
            </tr>
                    <?php
                }
            }else{
                ?>
            <tr>
                <td colspan="8" class='text-center'> <i class='fa fa-info-circle'></i> No orders are available yet </td>
            </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div class="col-sm-12 m-t-10">
    <?php echo $this->ajax_pagination->create_links();?>
</div>