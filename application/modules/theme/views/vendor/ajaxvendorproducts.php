<?php if(count($view) > 0){?>
    <div class="row product-list container">
        <?php   foreach($view as $ve){
            $imsg   =   $this->config->item("upload_url")."products/photo-not-available.png";
            $target_dir =  $this->config->item("upload_url")."products/".$ve->vendorproductimg_name ;
            if(@getimagesize($target_dir)){
                    $imsg   =   $target_dir;
            }
            $vso    =   urlencode($ve->category_name);
            $vsso   =   urlencode($ve->product_name); 
            $vssdo   =   $ve->vendorproduct_bbtype."_".($ve->product_keywords)."_".$ve->vendor_storename_keywords;
            $vacde      =   $ve->vendorproduct_acde;
            if($vacde == 1){
                $sttau      =   0;
                $vstitle    =   "Hide";
            }else{
                $sttau      =   1;
                $vstitle    =   "Show";
            }
            ?>
        <div class="col-sm-4 col-xl-4">
            <div class="product-item">
                <div class="product-thumb">
                    <a onclick="openModal()"><img src="<?php echo $imsg;?>" alt="product"></a>
                </div>
                <div class="product-content">
                    <a href="<?php  echo base_url("Category-List/".$vso);?>">
                        <h3 class="m-t-15"><?php echo $ve->category_name;?></h3>
                    </a>
                    <h6><a href="<?php echo base_url("Product-View/".$vssdo);?>" class="product-title"><?php echo $ve->product_name;?></a></h6>
                    <p class="quantity"><?php echo $ve->vendorproduct_quantity." ".$ve->measure_unit;?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="price"><?php  echo $ve->vendorproduct_price;?> <del><i class="fas fa-inr"></i> <?php  echo $ve->vendorproduct_mrp;?></del></div>
                        <a href="<?php echo base_url("Update-Vendor-Product/$vssdo/".$ve->vendorproduct_code);?>"><i class="fas fa-edit"></i></a>
                        <a href="javascript:void(0)" onclick="activeblock(jQuery(this))" hrefvale="ajaxActivestatus" status="<?php echo $sttau;?>" vendrprod="<?php echo $ve->vendorproduct_id;?>"><?php echo $vstitle;?></a>
                        <a href="<?php echo base_url("Delete-Vendor-Product/$vssdo/".$ve->vendorproduct_code);?>"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="row container">
        <div class="col-md-12 mt-10 mb-5">
            <?php echo $this->ajax_pagination->create_links();?>
        </div>
    </div>
    <?php 
        }
        else{ ?>
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-primary"></h3>
            </div> 
        </div>
       <?php }
    ?>
</div>