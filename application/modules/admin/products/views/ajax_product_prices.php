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
                    <!--<th>S.No</th>-->
                    <th><a href="javascript:void(0);" data-type="order" data-field="vendor_ingredientslist" urlvalue="<?php echo bildourl('viewproductprince/'.$this->uri->segment('3').'/');?>" onclick="getdatafiled($(this))">Ingredient <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="vendorproduct_bb_quantity" urlvalue="<?php echo bildourl('viewproductprince/'.$this->uri->segment('3').'/');?>" onclick="getdatafiled($(this))">Quantity <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="vendorproduct_bb_price" urlvalue="<?php echo bildourl('viewproductprince/'.$this->uri->segment('3').'/');?>" onclick="getdatafiled($(this))">Price <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="vendorproduct_bb_mrp" urlvalue="<?php echo bildourl('viewproductprince/'.$this->uri->segment('3').'/');?>" onclick="getdatafiled($(this))">MRP <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="vendorproduct_bb_measure" urlvalue="<?php echo bildourl('viewproductprince/'.$this->uri->segment('3').'/');?>" onclick="getdatafiled($(this))">Measure <i class="fa fa-sort pull-right"></i></a> </th>
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
                    <!--<td><?php echo $limit++;?></td>-->
                    <td>
                        <?php 
                            $par['where_condition'] = "product_Ingredients.prodind LIKE '".$ve->vendor_ingredientslist."'";
                            $inger = $this->ingredients_model->viewIngredients($par);
                            if(is_array($inger) && count($inger) >0){
                                echo ($inger[0]->prod_indug != "")?$inger[0]->prod_indug:'';
                            }
                        ?>
                    </td> 
                    <td><?php echo $ve->vendorproduct_bb_quantity;?></td> 
                    <td><?php echo $ve->vendorproduct_bb_price;?></td> 
                    <td><?php echo $ve->vendorproduct_bb_mrp;?></td> 
                    <td>
                        <?php
                            $measure = $this->measure_model->get_measure($ve->vendorproduct_bb_measure);
                            echo $measure['measure_unit'];?>
                    </td> 
                    <?php if($ct == '1'){?>
                    <td>
                        <?php if($ur == '1'){?>
                        <a href="<?php echo bildourl("update-product-Price/".$ve->vendorproductprinceid.'/'.$this->uri->segment('3'));?>" title="Update Product" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                        <?php } if($dr == '1'){?>
                        <a href="javascript:void(0)" onclick="confirmationDelete($(this),'Product')" attrvalue="<?php echo bildourl("delete-product-Price/".$ve->vendorproductprinceid.'/'.$this->uri->segment('3'));?>"   title="Delete Product" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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