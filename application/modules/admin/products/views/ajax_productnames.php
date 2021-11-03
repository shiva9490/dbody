<?php
$cr     =   $this->session->userdata("create-product");
$ur     =   $this->session->userdata("update-product");
$dr     =   $this->session->userdata("delete-product");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>
<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
    <div class="table-responsive"> 
        <table class="table table-striped table-hover js-basic-example tablehrcover">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="product_name" urlvalue="<?php echo bildourl('viewproduct/');?>" onclick="getdatafiled($(this))">Product <i class="fa fa-sort pull-right"></i></a> </th>
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
                    <td><?php echo $ve->product_name;?></td> 
                    <?php if($ct == '1'){?>
                    <td>
                        <?php if($ur == '1'){?>
                        <a href="<?php echo bildourl("update-product-name/".$ve->product_id);?>" title="Update Product" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                        <?php } if($dr == '1'){?>
                        <a href="javascript:void(0)" onclick="confirmationDelete($(this),'Product Name')" attrvalue="<?php echo bildourl("delete-product-name/".$ve->product_id);?>"   title="Delete Product" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        <?php } ?>
                    </td>
                    <?php }  ?>
                </tr>
                    <?php
                    }
                }else {
                    echo '<tr class="text-center"><td colspan="15">Products are  not available</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>                        
    <?php echo $this->ajax_pagination->create_links();?>
</div>