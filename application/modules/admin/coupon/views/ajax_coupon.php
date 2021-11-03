<?php
$sr     =   $this->session->userdata("active-deactive-coupon");
$cr     =   $this->session->userdata("create-coupon");
$ur     =   $this->session->userdata("update-coupon");
$dr     =   $this->session->userdata("delete-coupon");
$ct     =   "0";
if($ur  == 1 || $dr == '1' || $sr == 1){
        $ct     =   1;
}
?>

<div class="col-md-12 mt-5 t_div">
    <table class="table b-g">
        <thead>
            <tr id="filters">
                <th>S.No</th>
                <th><a href="javascript:void(0);" data-type="order" data-field="coupon_coupon" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Description<i class="fa fa-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="coupon_date_from" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">From 
                    <i class="fa fa-sort pull-right"></i></a> 
                </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="coupon_date_to" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">To<i class="fa fa-sort pull-right"></i></a> 
                </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="coupon_status" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Status <i class="fa fa-sort pull-right"></i></a> </th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            if(count($view) > 0){
                foreach($view as $ve){
                    $vad    =   ucwords($ve->coupon_abc);
                    if($vad == "Active"){
                        $icon   =   "times-circle";
                        $vadv   =   "Deactive";
                        $textico    =   "text-warning";
                        $vdata  =   "<label class='badge abelsctive badge-success'>".$vad."</label>";
                    }else{
                        $vdata  =   "<label class='badge abelsctive badge-danger'>".$vad."</label>";
                        $vadv   =   "Active";
                        $textico    =   "text-primary";
                        $icon   =   "check-circle";
                    }
            ?>
            <tr>
                <td><?php echo $limit++;?></td>
                <td class="fonn">
                    <?php 
                        echo $ve->coupon_discount; 
                        if($ve->coupon_type == 'Percentage'){echo '%  off on Orders Above '.$ve->coupon_min_value;}else
                        if($ve->coupon_type == 'Amount'){echo ' <i class="fa fa-inr" aria-hidden="true"></i>  off on Orders Above '.$ve->coupon_min_value;}
                    ?>
                </td>
                <td>
                <?php $date=date_create($ve->coupon_date_from);
                        echo date_format($date,"d/m/Y - g:i A");
                ?>
                </td>
                <td>
                <?php $date=date_create($ve->coupon_date_to);
                        echo date_format($date,"d/m/Y - g:i A");
                ?>
                </td>
                <td><?php echo $vdata;?></td>
                <?php if($ct == '1'){?>
                    <td>
                            <?php if($cr == '1'){?>
                                <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Ajax-Coupon-Active')" fields="<?php echo $ve->coupon_id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>"><i class="fa fa-<?php echo $icon;?> m-r-5"></i></a>
                            <?php } ?>
                        <?php if($ur == '1'){?>
                        <a href="<?php echo bildourl("Update-Coupon/".$ve->coupon_id);?>"   title="Update Coupon" class="btn btn-sm  btn-success"><i class="fa fa-edit"></i></a>
                        <?php } if($dr == '1'){?>
                        <a href="javascript:void(0)" onclick="confirmationDelete($(this),'Coupon')" attrvalue="<?php echo bildourl("Delete-Coupon/".$ve->coupon_id);?>"   title="Delete Coupon" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        <?php } ?>
                    </td>
                <?php }  ?>
				
            </tr>
                <?php
                }
            }else {
                echo '<tr class="text-center text-danger"><td colspan="9"><i class="zmdi zmdi-info-outline"></i> Coupons are  not available</td></tr>';
            }
            ?>
        </tbody>
    </table>
  </div> 
  <?php //echo $this->ajax_pagination->create_links();?>