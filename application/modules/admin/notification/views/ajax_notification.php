<?php
$dtct   =   '0';
$cr     =   $this->session->userdata("active-deactive-notification");
$ut =   $this->session->userdata("update-notification");
$dt =   $this->session->userdata("delete-notification");
if($ut == '1' || $dt == '1'){
    $dtct   =   '1';
}
?>
<div class="table-responsive-m"> 
    <table class="table table-striped table-hover js-basic-example tablehrcover" id="myTable">
        <thead>
            <tr id="filters">
                <th>S.No</th>
                 <th><a href="javascript:void(0);" data-type="order" data-field="notification_title" urlvalue="<?php echo bildourl('viewNotifications/');?>" onclick="getdatafiled($(this))">Popup Title <i class="fa fa-sort pull-right"></i></a> </th>
                 <th><a href="javascript:void(0);" data-type="order" data-field="notification_image" urlvalue="<?php echo bildourl('viewNotifications/');?>" onclick="getdatafiled($(this))">Popup Image <i class="fa fa-sort pull-right"></i></a> </th>
                 <?php if($dtct == '1'){?>
                 <th>Status</th>
                <th>Action</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php  
                if(count($view) > 0){
                    $i  = 1;
                    foreach($view as $ve){
                        $imsg   =   base_url()."uploads/notification-uploads/photo-not-available.png";
                        $imagepath  =   $this->config->item("upload_url")."notification-uploads/"; 
                        $target_dir =   $imagepath.$ve->notification_image;
                        if(@getimagesize($target_dir)){
                            $imsg   =   $target_dir;
                        }
                        $vad    =   ucwords($ve->notification_abc);
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
                    <td><?php echo $i++;?></td>
                    <td><?php echo $ve->notification_title;?></td>
                    <td>
                        <a href="<?php echo $imsg;?>" class="image-popup" title="<?php echo $ve->notification_image;?>">
                            <img src="<?php echo $imsg;?>" class="thumb-lg  img img-responsive img-thumbnail" alt="<?php echo $ve->notification_image;?>" >
                        </a>
                    </td>
                    <td>
                        <?php echo $vdata;?>
                    </td>
                    <?php if($dtct == '1'){?>
                    <td>
                        <?php if($cr == '1'){?>
                                <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Ajax-Notification-Active')" fields="<?php echo $ve->notification_id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>"><i class="fa fa-<?php echo $icon;?> m-r-5"></i></a>
                            <?php } ?>
                        <?php if($ut == '1'){?>
                        <a href='<?php echo bildourl("update-notification/".$ve->notification_id);?>' data-toggle='tooltip' title="Update Notification" class="btn btn-sm btn-success tip-left"><i class="fa fa-edit"></i></a>
                        <?php } if($dt == '1'){?>
                        <a href="<?php echo bildourl("delete-notification/".$ve->notification_id);?>" data-toggle='tooltip' title="Delete Notification" class="btn btn-sm  btn-danger tip-left"><i class="fa fa-trash-o"></i></a>
                        <?php } ?>
                    </td>
                    <?php } ?>
                </tr>
                <?php
                }
            }else {
                echo '<tr class="text-center"><td colspan="5">Popup Notifications are  not available</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>                        
<?php echo $this->ajax_pagination->create_links();?>