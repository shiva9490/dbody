<div class="table-responsive table-responsive-m">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><a href="javascript:void(0);" data-type="order" data-field="customerid" urlvalue="<?php echo bildourl('viewCustomerReport/');?>" onclick="getdatafiled($(this))">Order Id <i class="fa fa-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="customer_mobile" urlvalue="<?php echo bildourl('viewCustomerReport/');?>" onclick="getdatafiled($(this))">Mobile <i class="fa fa-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="customer_name" urlvalue="<?php echo bildourl('viewCustomerReport/');?>" onclick="getdatafiled($(this))">Customer <i class="fa fa-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="total" urlvalue="<?php echo bildourl('viewCustomerReport/');?>" onclick="getdatafiled($(this))">Total <i class="fa fa-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="count" urlvalue="<?php echo bildourl('viewCustomerReport/');?>" onclick="getdatafiled($(this))">Orders<i class="fa fa-sort pull-right"></i></a> </th> 
            </tr>
        </thead>
        <tbody>
            <?php
            if(count($view) > 0)  {
                foreach ($view as $ve){
                    ?>
            <tr>
                <td>
                    <a href='javascript:void(0)' class="text-success" onclick="customerdetailsreport($(this))" orderid='<?php echo $ve->customer_id;?>'>
                        <?php echo $ve->customer_id;?>
                    </a>
                </td> 
                <td><?php echo $ve->customer_mobile;?></td>
                <td><?php echo $ve->customer_name;?></td>
                <td><i class='fa fa-inr'></i> <?php echo $ve->total;?></td> 
                <td> <?php echo $ve->count;?></td>    
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