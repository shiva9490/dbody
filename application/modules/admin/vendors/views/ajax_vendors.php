<div class="table-responsive-m"> 
    <table class="table table-striped table-hover js-basic-example tablehrcover" id="myTable">
        <thead>
            <tr id="filters">
                <th>S.No</th>
                <th><a href="javascript:void(0);" data-type="order" data-field="vendor_name" urlvalue="<?php echo bildourl("viewVendors/");?>" onclick="getdatafiled($(this))">Name <i class="fa fa-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="vendor_gender" urlvalue="<?php echo bildourl("viewVendors/");?>" onclick="getdatafiled($(this))">Gender <i class="fa fa-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="vendor_mobile" urlvalue="<?php echo bildourl("viewVendors/");?>" onclick="getdatafiled($(this))">Mobile No. <i class="fa fa-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="vendor_email_id" urlvalue="<?php echo bildourl("viewVendors/");?>" onclick="getdatafiled($(this))">Email <i class="fa fa-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="vendor_storename" urlvalue="<?php echo bildourl("viewVendors/");?>" onclick="getdatafiled($(this))">Store Name <i class="fa fa-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="vendor_pincode" urlvalue="<?php echo bildourl("viewVendors/");?>"onclick="getdatafiled($(this))">Pincode<i class="fa fa-sort pull-right"></i></a> </th>
            </tr>
        </thead>
        <tbody>
            <?php  
                if(count($view) > 0){
                    $i  = 1;
                    foreach($view as $ve){
                    ?>
                    <tr>
                        <td><?php echo $i++;?></td>
                        <td>
                            <a href="javascript:void(0)" onclick="vendorview($(this))" vendorid="<?php echo $ve["vendor_id"];?>">
                                <?php echo $ve['vendor_name'];?>
                            </a>
                        </td>
                        <td><b><i class="fa fa-<?php echo strtolower($ve['vendor_gender']);?> fa-2x"></i></b></td>
                        <td><?php echo $ve['vendor_mobile'];?></td>
                        <td><?php echo $ve['vendor_email_id'];?></td>
                        <td><?php echo $ve['vendor_storename'];?></td> 
                        <td><?php echo $ve['vendor_pincode'];?></td>
                    </tr>
                    <?php
                    }
                }else {
                    echo '<tr class="text-center"><td colspan="10">Vendors are  not available</td></tr>';
                }
            ?>
        </tbody>
    </table>
</div> 
<div class="col-sm-12 col-lg-12 col-md-12 m-t-15">
    <?php echo $this->ajax_pagination->create_links();?>
</div>