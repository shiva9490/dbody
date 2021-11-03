<div class="table-responsive table-responsive-m">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><a href="javascript:void(0);" data-type="order" data-field="order_unique" urlvalue="<?php echo bildourl('viewOrdersReport/');?>" onclick="getdatafiled($(this))">Order Id <i class="fa fa-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="customer_mobile" urlvalue="<?php echo bildourl('viewOrdersReport/');?>" onclick="getdatafiled($(this))">Mobile <i class="fa fa-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="customer_name" urlvalue="<?php echo bildourl('viewOrdersReport/');?>" onclick="getdatafiled($(this))">Customer <i class="fa fa-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="order_total" urlvalue="<?php echo bildourl('viewOrdersReport/');?>" onclick="getdatafiled($(this))">Total <i class="fa fa-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="order_date" urlvalue="<?php echo bildourl('viewOrdersReport/');?>" onclick="getdatafiled($(this))">Date <i class="fa fa-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="order_payment_mode" urlvalue="<?php echo bildourl('viewOrdersReport/');?>" onclick="getdatafiled($(this))">Pay Mode <i class="fa fa-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="order_acde" urlvalue="<?php echo bildourl('viewOrdersReport/');?>" onclick="getdatafiled($(this))">Status <i class="fa fa-sort pull-right"></i></a> </th> 
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
                <td><?php echo $ve->order_payment_mode;?></td>  
                <td class="ordest<?php echo $ve->order_id;?>"><?php echo $ve->order_acde;?></td> 
                    
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