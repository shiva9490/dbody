<?php
$cr     =   $this->session->userdata("create-widget");
$ur     =   $this->session->userdata("update-widget");
$dr     =   $this->session->userdata("delete-widget");
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
                    <th><a href="javascript:void(0);" data-type="order" data-field="widget_display_name" urlvalue="<?php echo bildourl('viewWidget/');?>" onclick="getdatafiled($(this))">Widget Name <i class="fa fa-sort pull-right"></i></a> </th>
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
                    <td><?php echo $ve->widget_display_name;?></td>
                    <?php if($ct == '1'){?>
                    <td>
                        <?php if($ur == '1'){?>
                        <a href='<?php echo bildourl("update-widget/".$ve->widget_id);?>' data-toggle='tooltip' title="Update Widget" class="btn btn-sm btn-success tip-left"><i class="fa fa-edit"></i></a>
                        <?php } if($dr == '1'){?>
                        <a href="javascript:void(0)" onclick="confirmationDelete($(this),'Widget')" attrvalue="<?php echo bildourl("delete-widget/".$ve->widget_id);?>"   title="Delete Widget" class="btn btn-sm  btn-danger"><i class="fa fa-trash"></i></a>
                        <?php } ?>
                    </td>
                    <?php }  ?>
                </tr>
                    <?php
                    }
                }else {
                    echo '<tr class="text-center"><td colspan="5">Widgets are  not available</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>                        
    <?php echo $this->ajax_pagination->create_links();?>
</div>