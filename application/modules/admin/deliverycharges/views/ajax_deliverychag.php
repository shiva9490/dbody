<?php
$cr     =   $this->session->userdata("create-deliverychg");
$ur     =   $this->session->userdata("update-deliverychg");
$dr     =   $this->session->userdata("delete-deliverychg");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>
<div class=" col-sm-12 col-md-12 col-lg-12 col-xs-12">
    <div class="table-responsive"> 
        <table class="table table-striped table-hover js-basic-example tablehrcover" id="myTable">
            <thead>
                <tr id="filters">
                    <th>S.No</th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="derliverytype" urlvalue="<?php echo bildourl('viewDelivery/');?>" onclick="getdatafiled($(this))">Type <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="deliverychg_start" urlvalue="<?php echo bildourl('viewDelivery/');?>" onclick="getdatafiled($(this))">Start Time <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="deliverychg_end" urlvalue="<?php echo bildourl('viewDelivery/');?>" onclick="getdatafiled($(this))">End Time <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="deliverychg_amount" urlvalue="<?php echo bildourl('viewDelivery/');?>" onclick="getdatafiled($(this))">Amount <i class="fa fa-sort pull-right"></i></a> </th>
                    <?php if($ct == '1'){?>
                    <th>Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php  
                if(count($view) > 0){ 
                    foreach($view as $ve){
                ?>
                <tr>
                    <td><?php echo $limit++;?></td>
                    <td><?php echo $ve->derliverytype;?></td>
                    <td><?php echo $ve->deliverychg_start;?></td>
                    <td><?php echo $ve->deliverychg_end;?></td>
                    <td><?php echo $ve->deliverychg_amount;?></td>
                    <?php if($ct == '1'){?>
                    <td>
                        <?php if($ur == '1'){?>
                        <a href='<?php echo bildourl("Update-Deliverycharges/".$ve->deliverychgid);?>' data-toggle='tooltip' title="Update Measure" class="btn btn-sm btn-success tip-left"><i class="fa fa-edit"></i></a>
                        <?php } if($dr == '1'){?>
                        <a href="javascript:void(0)" onclick="confirmationDelete($(this),'Deliverychg')" attrvalue="<?php echo bildourl("Delete-Deliverycharges/".$ve->deliverychgid);?>"   title="Delete Delivery charges" class="btn btn-sm  btn-danger"><i class="fa fa-trash"></i></a>
                        <?php } ?>
                    </td>
                    <?php }  ?>
                </tr>
                    <?php
                    }
                }else {
                    echo '<tr class="text-center"><td colspan="5">Measures are  not available</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>                        
    <?php echo $this->ajax_pagination->create_links();?>
</div>