<div class="table-responsive table-responsive-m">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><a href="javascript:void(0);" data-type="order" data-field="productid" urlvalue="<?php echo bildourl('viewproductReport/');?>" onclick="getdatafiled($(this))">Product Id <i class="fa fa-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="product_name" urlvalue="<?php echo bildourl('viewproductReport/');?>" onclick="getdatafiled($(this))">Product Name <i class="fa fa-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="total" urlvalue="<?php echo bildourl('viewproductReport/');?>" onclick="getdatafiled($(this))">Total <i class="fa fa-sort pull-right"></i></a> </th> 
                <th><a href="javascript:void(0);" data-type="order" data-field="count" urlvalue="<?php echo bildourl('viewproductReport/');?>" onclick="getdatafiled($(this))">Orders<i class="fa fa-sort pull-right"></i></a> </th> 
            </tr>
        </thead>
        <tbody>
            <?php
            if(count($view) > 0)  {
                foreach ($view as $ve){
                    ?>
            <tr>
                <td>
                    <a href='javascript:void(0)' class="text-success" onclick="" orderid='<?php echo $ve->product_id;?>'>
                        <?php echo $ve->product_id;?>
                    </a>
                </td> 
                <td><?php echo $ve->product_name;?></td>
                <td><i class='fa fa-inr'></i> <?php echo $ve->total;?></td> 
                <td> <?php echo $ve->count;?></td>    
            </tr>
                    <?php
                }
            }else{
                ?>
            <tr>
                <td colspan="8" class='text-center'> <i class='fa fa-info-circle'></i> No Online Products are available yet </td>
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