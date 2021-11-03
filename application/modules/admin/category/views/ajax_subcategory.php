<?php
$cr     =   $this->session->userdata("create-sub-category");
$ur     =   $this->session->userdata("update-sub-category");
$dr     =   $this->session->userdata("delete-sub-category");
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
                    <th><a href="javascript:void(0);" data-type="order" data-field="category_name" urlvalue="<?php echo bildourl("viewsubCategory/");?>" onclick="getdatafiled($(this))">Category<i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="subcategory_name" urlvalue="<?php echo bildourl("viewsubCategory/");?>" onclick="getdatafiled($(this))">Sub Category<i class="fa fa-sort pull-right"></i></a> </th>
                    <th></th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                     if(count($view) > 0){
                        foreach($view as $ve){
                            $imsg =   $this->config->item("upload_url")."category/photo-not-available.png";
                            $target_dir =   $this->config->item("upload_url")."category/".$ve->subcategory_upload;
                            if(@getimagesize($target_dir)){
                                $imsg   =   $target_dir;
                            }
                            ?>
                    <tr>
                        <td><?php echo $limit++;?></td>
                        <td><?php echo $ve->category_name;?></td>
                        <td><?php echo $ve->subcategory_name;?></td>
                        <td>
                            <img src="<?php echo $imsg;?>" class="thumb-lg  img img-responsive img-thumbnail" width="100px"/>
                        </td>

                        <?php if($ct == '1'){?>
                        <td>
                            <?php if($ur == '1'){?>
                            <a href="<?php echo bildourl("update-sub-category/".$ve->subcategory_id);?>"   title="Update Sub Category" class="btn btn-sm  btn-success"><i class="fa fa-edit"></i></a>
                            <?php } if($dr == '1'){?>
                            <a href="javascript:void(0)" onclick="confirmationDelete($(this),'Sub Category')" attrvalue="<?php echo bildourl("delete-sub-category/".$ve->subcategory_id);?>"   title="Delete Sub Category" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                            <?php } ?>
                        </td>
                        <?php }  ?>
                    </tr>
                <?php
                     }
                    }else {
                        echo '<tr class="text-center"><td colspan="5">Subcategories are  not available</td></tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>                        
    <?php echo $this->ajax_pagination->create_links();?>
    </div>