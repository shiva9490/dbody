<?php
$cr     =   $this->session->userdata("create-package");
$ur     =   $this->session->userdata("update-package");
$dr     =   $this->session->userdata("delete-package");
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
                    <th><a href="javascript:void(0);" data-type="order" data-field="package_name" urlvalue="<?php echo bildourl('viewPackage/');?>" onclick="getdatafiled($(this))">Package Name <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="package_price" urlvalue="<?php echo bildourl('viewPackage/');?>" onclick="getdatafiled($(this))">Price <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="package_banners" urlvalue="<?php echo bildourl('viewPackage/');?>" onclick="getdatafiled($(this))">No of Banners <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="package_expiry" urlvalue="<?php echo bildourl('viewPackage/');?>" onclick="getdatafiled($(this))">Package Expiry <i class="fa fa-sort pull-right"></i></a> </th>
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
                    <td><?php echo $ve->package_name;?></td> 
                    <td><i class="fa fa-inr"></i> <?php echo $ve->package_price;?></td> 
                    <td><?php echo $ve->package_banners;?></td> 
                    <td><?php echo $ve->package_expiry." ".$ve->package_expiry_value;?></td> 
                    <?php if($ct == '1'){?>
                    <td>
                        <?php if($ur == '1'){?>
                        <a href="<?php echo bildourl("update-package/".$ve->package_id);?>"   title="Update Package" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                        <?php } if($dr == '1'){?>
                        <a href="javascript:void(0)" onclick="confirmationDelete($(this),'Package')" attrvalue="<?php echo bildourl("delete-package/".$ve->package_id);?>"   title="Delete Category" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        <?php } ?>
                    </td>
                    <?php }  ?>
                </tr>
                    <?php
                    }
                }else {
                    echo '<tr class="text-center"><td colspan="5">Packages are  not available</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>                        
    <?php echo $this->ajax_pagination->create_links();?>
</div>