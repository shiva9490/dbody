<?php
$cr     =   $this->session->userdata("create-ingredients");
$ur     =   $this->session->userdata("update-ingredients");
$dr     =   $this->session->userdata("delete-ingredients");
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
                    <th><a href="javascript:void(0);" data-type="order" data-field="category_name" urlvalue="<?php echo bildourl('viewAddon/');?>" onclick="getdatafiled($(this))">Category Name <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="subcategory_name" urlvalue="<?php echo bildourl('viewAddon/');?>" onclick="getdatafiled($(this))">Sub Category Name <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="addon_name" urlvalue="<?php echo bildourl('viewAddon/');?>" onclick="getdatafiled($(this))">Addon Name <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="addon_status" urlvalue="<?php echo bildourl('viewAddon/');?>" onclick="getdatafiled($(this))">Status <i class="fa fa-sort pull-right"></i></a> </th>
                    <?php if($ct == '1'){?>
                    <th>Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php  
                if(count($view) > 0){ 
                    foreach($view as $ve){
                        $vad    =   ucwords($ve->addon_status);
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
                    <td><?php echo $ve->category_name;?></td>
                    <td><?php echo $ve->subcategory_name;?></td>
                    <td><?php echo $ve->addon_name;?></td>
                    <td>
                        <?php echo $vdata;?>
                    </td>
                    <?php if($ct == '1'){?>
                    <td>
                            <?php if($cr == '1'){?>
                                <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Ajax-Addon-Active')" fields="<?php echo $ve->addon_id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>"><i class="fa fa-<?php echo $icon;?> m-r-5"></i></a>
                            <?php } ?>
                        <?php if($ur == '1'){?>
                        <a href="<?php echo bildourl("update-Addon/".$ve->addon_id);?>"   title="Update Addon" class="btn btn-sm  btn-success"><i class="fa fa-edit"></i></a>
                        <?php } if($dr == '1'){?>
                        <a href="javascript:void(0)" onclick="confirmationDelete($(this),'Addon')" attrvalue="<?php echo bildourl("delete-Addon/".$ve->addon_id);?>"   title="Delete Addon" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        <?php } ?>
                    </td>
                    <?php }  ?>
                </tr>
                    <?php
                    }
                }else {
                    echo '<tr class="text-center"><td colspan="5">Addons are  not available</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>                        
    <?php echo $this->ajax_pagination->create_links();?>
</div>