<?php
$cr     =   $this->session->userdata("create-measure");
$ur     =   $this->session->userdata("update-measure");
$dr     =   $this->session->userdata("delete-measure");
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
                    <th><a href="javascript:void(0);" data-type="order" data-field="pincode_district" urlvalue="<?php echo bildourl('viewPincode/');?>" onclick="getdatafiled($(this))">District Name <i class="fa fa-sort pull-right"></i></a> </th>
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
                    <td><?php echo $ve->pincode_district;?></td>
                    <?php if($ct == '1'){?>
                    <td>
                        <?php if($ur == '1'){?>
                        <form method="post" action="<?php echo bildourl("Update-Pincode/".$ve->pincode_district);?>" method="POST">
                            <input type="hidden" name="district" value="<?php echo $ve->pincode_district;?>">
                            <input type="hidden" name="status" value="1">
                            <button type="submit" name="submit" value="submit" class="btn btn-sm btn-success tip-left">Add</button>
                        </form>
                        <?php } ?>
                    </td>
                    <?php }  ?>
                </tr>
                    <?php
                    }
                }else {
                    echo '<tr class="text-center"><td colspan="5">Places are  not available</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>                        
    <?php echo $this->ajax_pagination->create_links();?>
</div>