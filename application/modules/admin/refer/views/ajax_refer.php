<?php
$sr     =   $this->session->userdata("active-deactive-refer");
$cr     =   $this->session->userdata("create-refer");
$ur     =   $this->session->userdata("update-refer");
$dr     =   $this->session->userdata("delete-refer");
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
                <th><a href="javascript:void(0);" data-type="order" data-field="refer_refer" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Description<i class="fa fa-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="refer_refer" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Type<i class="fa fa-sort pull-right"></i></a> 
                </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="refer_status" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Status <i class="fa fa-sort pull-right"></i></a> </th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            if(count($view) > 0){
                foreach($view as $ve){
                    $vad    =   ucwords($ve->refer_abc);
                    $vsta  =   "<label class='badge abelsctive badge-success'>".ucwords($ve->refer_refer)."</label>";
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
                        echo $ve->refer_discount; 
                        if($ve->refer_type == 'Percentage'){echo '%  off on Orders Above '.$ve->refer_min_value;}else
                        if($ve->refer_type == 'Amount'){echo ' <i class="fa fa-inr" aria-hidden="true"></i>  off on Orders Above '.$ve->refer_min_value;}
                    ?>
                </td>
                <td>
                <?php echo $vsta;?>
                </td>
                
                <td><?php echo $vdata;?></td>
                <?php if($ct == '1'){?>
                    <td>
                            <?php if($cr == '1'){?>
                                <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Ajax-Refer-Active')" fields="<?php echo $ve->refer_id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>"><i class="fa fa-<?php echo $icon;?> m-r-5"></i></a>
                            <?php } ?>
                        <?php if($ur == '1'){?>
                        <a href="<?php echo bildourl("Update-Refer/".$ve->refer_id);?>"   title="Update Refer" class="btn btn-sm  btn-success"><i class="fa fa-edit"></i></a>
                        <?php } if($dr == '1'){?>
                        <!--<a href="javascript:void(0)" onclick="confirmationDelete($(this),'Refer')" attrvalue="<?php echo bildourl("Delete-Refer/".$ve->refer_id);?>"   title="Delete Refer" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>-->
                        <?php } ?>
                    </td>
                <?php }  ?>
				
            </tr>
                <?php
                }
            }else {
                echo '<tr class="text-center text-danger"><td colspan="9"><i class="zmdi zmdi-info-outline"></i> Refers are  not available</td></tr>';
            }
            ?>
        </tbody>
    </table>
  </div> 
  <?php //echo $this->ajax_pagination->create_links();?>