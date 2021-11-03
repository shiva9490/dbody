<?php
$cr     =   $this->session->userdata("create-occasion");
$ur     =   $this->session->userdata("update-occasion");
$dr     =   $this->session->userdata("delete-occasion");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>
<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
    <div class="table-responsive"> 
        <table class="table table-striped table-hover js-basic-example tablehrcover" id="myTable">
            <thead>
                <tr id="filters">
                    <th>S.No</th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="event_name" urlvalue="<?php echo bildourl('viewEvent/');?>" onclick="getdatafiled($(this))">Occasion Name <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="event_status" urlvalue="<?php echo bildourl('viewEvent/');?>" onclick="getdatafiled($(this))">Status <i class="fa fa-sort pull-right"></i></a> </th>
                    <?php if($ct == '1'){?>
                    <th>Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php  
                if(count($view) > 0){ 
                    foreach($view as $ve){
                        $vad    =   ucwords($ve->event_status);
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
                    <td><?php echo $ve->event_name;?></td>
                    <td>
                        <?php echo $vdata;?>
                    </td>
                    <?php if($ct == '1'){?>
                    <td>
                            <?php if($cr == '1'){?>
                                <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Ajax-Event-Active')" fields="<?php echo $ve->event_id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>"><i class="fa fa-<?php echo $icon;?> m-r-5"></i></a>
                            <?php } ?>
                        <?php if($ur == '1'){?>
                        <a href="<?php echo bildourl("update-Event/".$ve->event_id);?>"   title="Update Event" class="btn btn-sm  btn-success"><i class="fa fa-edit"></i></a>
                        <?php } if($dr == '1'){?>
                        <a href="javascript:void(0)" onclick="confirmationDelete($(this),'Event')" attrvalue="<?php echo bildourl("delete-Event/".$ve->event_id);?>"   title="Delete Event" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        <?php } ?>
                    </td>
                    <?php }  ?>
                </tr>
                    <?php
                    }
                }else {
                    echo '<tr class="text-center"><td colspan="5">Events are  not available</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>                        
    <?php echo $this->ajax_pagination->create_links();?>
</div>