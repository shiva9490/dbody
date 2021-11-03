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
                    <th><a href="javascript:void(0);" data-type="order" data-field="category_name" urlvalue="<?php echo bildourl('viewCategory/');?>" onclick="getdatafiled($(this))">Category Name <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="subcategory_name" urlvalue="<?php echo bildourl('viewCategory/');?>" onclick="getdatafiled($(this))">Sub Category Name <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="prod_indug" urlvalue="<?php echo bildourl('viewCategory/');?>" onclick="getdatafiled($(this))">ingredients <i class="fa fa-sort pull-right"></i></a> </th>
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
                    <td><?php echo $ve->category_name;?></td>
                    <td><?php echo $ve->subcategory_name;?></td>
                    <td><?php echo $ve->prod_indug;?></td>
                    <?php if($ct == '1'){?>
                    <td>
                        <?php if($ur == '1'){?>
                        <a href="<?php echo bildourl("update-Ingredients/".$ve->prodind);?>"   title="Update Ingredients" class="btn btn-sm  btn-success"><i class="fa fa-edit"></i></a>
                        <?php } if($dr == '1'){?>
                        <a href="javascript:void(0)" onclick="confirmationDelete($(this),'Ingredients')" attrvalue="<?php echo bildourl("delete-Ingredients/".$ve->prodind);?>"   title="Delete Ingredients" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        <?php } ?>
                    </td>
                    <?php }  ?>
                </tr>
                    <?php
                    }
                }else {
                    echo '<tr class="text-center"><td colspan="5">Categories are  not available</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>                        
    <?php echo $this->ajax_pagination->create_links();?>
</div>