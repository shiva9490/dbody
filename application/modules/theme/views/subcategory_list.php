<div class="page-header-section">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between justify-content-md-end">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url();?>">Home</a></li>
                    <li><span>/</span></li>
                    <li><?php echo $categonmae;?></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- page-content -->
<section class="page-content section-ptb-90">
    <div class="container">
        <div class="row">
            <?php if(count($sub) > 0){
                foreach($sub as $ve){
                    $imsg   =  $this->config->item("upload_url")."category/photo-not-available.png";
                    $target_dir =  $this->config->item("upload_url")."category/".$ve['subcategory_upload'];
                    if(@getimagesize($target_dir)){
                        $imsg   =   $target_dir;
                    }
                    $vso    =   $ve["subcategory_keywords"];
            ?>
            <div class="col-sm-6 col-xl-4">
                <div class="product-item">
                    <div class="product-thumb">
                        <a href="<?php echo base_url($this->uri->segment("2")."/".$vso);?>"><img src="<?php echo $imsg;?>" alt="product"></a>
                    </div>
                    <div class="product-content">
                        <h6 class="text-center"><a href="<?php echo base_url($this->uri->segment("2")."/".$vso);?>" class="product-title"><?php echo $ve['subcategory_name'];?></a></h6>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>
    </div>
</section>
<!-- page-content -->
           
           
            
           
           