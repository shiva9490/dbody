<?php
$dtct   =   '0';
$ut =   $this->session->userdata("update-banner");
$dt =   $this->session->userdata("delete-banner");
if($ut == '1' || $dt == '1'){
    $dtct   =   '1';
}
?>
<div class="table-responsive-m"> 
    <table class="table table-striped table-hover js-basic-example tablehrcover" id="myTable">
        <thead>
            <tr id="filters">
                <th>S.No</th>
                 <th><a href="javascript:void(0);" data-type="order" data-field="banner_title" urlvalue="<?php echo bildourl('viewBanners/');?>" onclick="getdatafiled($(this))">Title <i class="fa fa-sort pull-right"></i></a> </th>
                 <th><a href="javascript:void(0);" data-type="order" data-field="banner_image" urlvalue="<?php echo bildourl('viewBanners/');?>" onclick="getdatafiled($(this))">Banner <i class="fa fa-sort pull-right"></i></a> </th>
                 <?php if($dtct == '1'){?>
                <th>Action</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php  
                if(count($view) > 0){
                    $i  = 1;
                    foreach($view as $ve){
                        $imsg   =   base_url()."uploads/banner-uploads/photo-not-available.png";
                        $imagepath  =   $this->config->item("upload_url")."banner-uploads/"; 
                        $target_dir =   $imagepath.$ve->banner_image;
                        if(@getimagesize($target_dir)){
                            $imsg   =   $target_dir;
                        }
                ?>
                <tr>
                    <td><?php echo $i++;?></td>
                    <td><?php echo $ve->banner_title;?></td>
                    <td>
                        <a href="<?php echo $imsg;?>" class="image-popup" title="<?php echo $ve->banner_image;?>">
                            <img src="<?php echo $imsg;?>" class="thumb-lg  img img-responsive img-thumbnail" alt="<?php echo $ve->banner_image;?>" >
                        </a>
                    </td>
                    <?php if($dtct == '1'){?>
                    <td>
                        <?php if($ut == '1'){?>
                        <a href='<?php echo bildourl("update-banner/".$ve->banner_id);?>' data-toggle='tooltip' title="Update Banner" class="btn btn-sm btn-success tip-left"><i class="fa fa-edit"></i></a>
                        <?php } if($dt == '1'){?>
                        <a href="<?php echo bildourl("delete-banner/".$ve->banner_id);?>" data-toggle='tooltip' title="Delete Banner" class="btn btn-sm  btn-danger tip-left"><i class="fa fa-trash-o"></i></a>
                        <?php } ?>
                    </td>
                    <?php } ?>
                </tr>
                <?php
                }
            }else {
                echo '<tr class="text-center"><td colspan="5">Banners are  not available</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>                        
<?php echo $this->ajax_pagination->create_links();?>