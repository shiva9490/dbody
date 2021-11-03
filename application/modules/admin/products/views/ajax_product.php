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
                    <th><a href="javascript:void(0);" data-type="order" data-field="product_name" urlvalue="<?php echo bildourl('viewproducts/');?>" onclick="getdatafiled($(this))">Product <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="category_name" urlvalue="<?php echo bildourl('viewproducts/');?>" onclick="getdatafiled($(this))">Category <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="subcategory_name" urlvalue="<?php echo bildourl('viewproducts/');?>" onclick="getdatafiled($(this))">Sub Category <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="vendorproduct_brand" urlvalue="<?php echo bildourl('viewproducts/');?>" onclick="getdatafiled($(this))">Brand <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="vendorproduct_bb_price" urlvalue="<?php echo bildourl('viewproducts/');?>" onclick="getdatafiled($(this))">Price <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="vendorproduct_out_stock" urlvalue="<?php echo bildourl('viewproducts/');?>" onclick="getdatafiled($(this))">stock <i class="fa fa-sort pull-right"></i></a> </th>
                    <?php 
                        if($ct == '1'){
                            if($types ==""){
                    ?>
                    <th>Action</th>
                    <?php } }?>
                </tr>
            </thead>
            <tbody>
                <?php  
                if(count($view) > 0){ 
                    foreach($view as $ve){
                        //echo '<pre>';print_r($ve);exit;
                ?>
                <tr>
                    <td><?php echo $limit++;?></td>
                    <td><?php echo $ve->product_name;?></td> 
                    <td><?php echo $ve->category_name;?></td> 
                    <td><?php echo $ve->subcategory_name;?></td> 
                    <td><?php echo $ve->vendorproduct_brand;?></td> 
                    <td><?php echo $ve->vendorproduct_bb_price;?></td> 
                    <td><label class="badge abelsctive badge-<?php if($ve->vendorproduct_out_stock==0){echo 'success';}else{ echo 'danger';}?>"><?php if($ve->vendorproduct_out_stock==0){echo 'In Stock';}else{ echo 'Out of stock';}?></label></td> 
                    <?php 
                        if($ct == '1'){
                            if($types ==""){
                    ?>
                    <td>
                        <?php if($ur == '1'){?>
                        <a href="<?php echo bildourl("update-Prices/".$ve->vendorproduct_id);?>" title="Update Prices" class="btn btn-sm btn-warning"><i class="fa fa-money"></i></a>
                        <a href="<?php echo bildourl("update-product/".$ve->vendorproduct_id);?>" title="Update Product" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                        <?php } if($dr == '1'){?>
                        <a href="javascript:void(0)" onclick="confirmationDelete($(this),'Product')" attrvalue="<?php echo bildourl("delete-product/".$ve->vendorproduct_id);?>"   title="Delete Product" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        <?php } ?>
                    </td>
                    <?php } 
                    }?>
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