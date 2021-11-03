
<form action="" method="get">
    <div class="row form-group">
        <div class="col-md-2">
            <select class="form-control limitvalu" onchange="ajaxcusorderdetails(0,'<?php echo $urls;?>')">
                <?php $climit    =   $this->config->item("limit_values");
                foreach($climit as $ce){
                    if($perpage==$ce){
                    ?>
                        <option value="<?php echo $ce;?>" selected><?php echo $ce;?></option>
                    <?php 
                    }else{
                    ?>
                    <option value="<?php echo $ce;?>"><?php echo $ce;?></option>
                    <?php
                    }
                }
                ?>
            </select>
        </div> 
        <div class="col-sm-10">
            <div class="row">
               <div class="col-md-9">
                    <input type="text" id="FilterTextBox1" name="keywords" class="form-control" placeholder="Search" value="<?php echo $this->input->get('keywords');?>"/>
                    <input type="hidden" id="orderby1" name="orderby" value="">
                    <input type="hidden" id="tipoOrderby1" name="tipoOrderby" value="">
                    <input type="hidden" id="cus_id" name="" value="<?php echo $cus_id;?>">
               </div>
               <div class="col-sm-3">
                    <input type="submit" name="search" id="submit" value="submit"  onclick="event.preventDefault();ajaxcusorderdetails(0,'<?php echo $urls;?>');" class="btn btn-primary"/>
               </div>
            </div>
        </div>
    </div>
</form> 
<div class="table-responsive table-responsive-m">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><a href="javascript:void(0);" data-type="order" data-field="order_unique" urlvalue="<?php echo bildourl('viewOrders/');?>" onclick="getdatafiled($(this))">Order Id <i class="fa fa-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="customer_mobile" urlvalue="<?php echo bildourl('viewOrders/');?>" onclick="getdatafiled($(this))">Mobile <i class="fa fa-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="customer_name" urlvalue="<?php echo bildourl('viewOrders/');?>" onclick="getdatafiled($(this))">Customer <i class="fa fa-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="order_total" urlvalue="<?php echo bildourl('viewOrders/');?>" onclick="getdatafiled($(this))">Total <i class="fa fa-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="order_date" urlvalue="<?php echo bildourl('viewOrders/');?>" onclick="getdatafiled($(this))">Date <i class="fa fa-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="order_payment_mode" urlvalue="<?php echo bildourl('viewOrders/');?>" onclick="getdatafiled($(this))">Pay Mode <i class="fa fa-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="order_acde" urlvalue="<?php echo bildourl('viewOrders/');?>" onclick="getdatafiled($(this))">Status <i class="fa fa-sort pull-right"></i></a> </th> 
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(count($view) > 0)  {
                foreach ($view as $ve){
            ?>
            <tr>
                <td>
                    <a href='javascript:void(0)' class="text-success" onclick="orderdetails($(this))" orderid='<?php echo $ve->order_id;?>'>
                        <?php echo $ve->order_unique;?>
                    </a>
                </td> 
                <td><?php echo $ve->customer_mobile;?></td>
                <td><?php echo $ve->customer_name;?></td>
                <td><i class='fa fa-inr'></i> <?php echo $ve->order_total;?></td>  
                <td><?php echo date("d-m-Y",strtotime($ve->order_date));?></td>
                <td>
                    <?php if($ve->order_payment_status ==1){
                            echo "Successfully";
                    }elseif($ve->order_payment_status ==2){
                            echo "Pending";
                    }elseif($ve->order_payment_status ==3){
                            echo "Failed";
                    }?>
                </td>  
                <td class="ordest<?php echo $ve->order_id;?>"><?php echo $ve->order_acde;?></td> 
                <td>
                    <?php 
                        $responce = json_decode($ve->order_payment_responce);
                        if(is_array($responce) && count($responce) >0){
                       // echo '<pre>';print_r($responce);exit;
                        echo 'Tracking id : '.$responce[1][1].'<br>
                        Bank Ref id : '.$responce[2][1].'<br>
                        payment mode : '.$responce[5][1];
                        }
                    ?>
                </td>
            </tr>
                    <?php
                }
            }else{
                ?>
            <tr>
                <td colspan="8" class='text-center'> <i class='fa fa-info-circle'></i> No Online orders are available yet </td>
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

<h6> <br><br><hr>Other Details </h6>
    <?php 
    $par['whereCondition'] = "customer_id = '".$this->input->post('customerid')."'";
    $user_details = $this->customer_model->getCustomer($par); 
    echo ' Coupon : '.$user_details['customer_coupon'].'<br><hr>';
    if($user_details['customer_coupon']!=''){
        $conditions["whereCondition"] ="order_coupon = '".$user_details['customer_coupon']."'";
        $details          =   $this->order_model->vieworders($conditions);
        $i=1;
        foreach($details as $d){
            echo ' Order ID : '.$d->order_id.'<br>';
            echo ' Status    : '.$d->order_coupon_gen.'<br>';
            echo ' Generated Coupon : '.$d->order_coupon_gen.'<br><hr>';
        }
    }
    ?>