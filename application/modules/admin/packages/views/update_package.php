<?php
$cr     =   $this->session->userdata("create-package");
$ur     =   $this->session->userdata("update-package");
$dr     =   $this->session->userdata("delete-package");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>
<div class="container-fluid">
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Measure</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo bildourl('pacakges');?>">Packages</a></li>
                <li class="breadcrumb-item active">Update Package</li>
            </ol>
        </div>
    </div>
 </div>
</div>
<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class='col-lg-12 col-md-12'>
                <?php $this->load->view("admin/success_error");?>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h5 class="m-b-0 text-white">Update Package</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="validform" id="category" novalidate="" >
                            <div class="form-group">
                                <label>Package Name <span class="required text-danger">*</span></label>
                                <input name="package_name" type="text" class="form-control" placeholder="Package Name" required="" minlength="1" maxlength="50" autocomplete="off" value="<?php echo $view["package_name"];?>"/>
                                <?php echo form_error('package_name');?>
                            </div>
                            <div class="form-group">
                                <label>Package Price <span class="required text-danger">*</span></label>
                                <input name="package_price" type="text" class="form-control input_geo" placeholder="Package Price" required="" minlength="1" maxlength="50" autocomplete="off" value="<?php echo $view["package_price"];?>"/>
                                <?php echo form_error('package_price');?>
                            </div>
                            <div class="form-group">
                                <label>No of Banners <span class="required text-danger">*</span></label>
                                <input name="package_banners" type="text" class="form-control input_num" placeholder="No of Banners" required="" minlength="1" maxlength="3" autocomplete="off" value="<?php echo $view["package_banners"];?>"/>
                                <?php echo form_error('package_banners');?>
                            </div>
                            <div class="form-group">
                                <label>Package Expiry  <span class="required text-danger">*</span></label>
                                <div class="input-group">
                                    <input class="btnpackageval" type="hidden" name="btnpackageval" value="<?php echo $view["package_expiry_value"];?>"/>
                                    <input type="text" class="form-control input_num" placeholder="Package Expiry" required="" name="package_expiry" value="<?php echo $view["package_expiry"];?>" aria-label="Text input with dropdown button">
                                    <div class="input-group-append">
                                        <button class="btn btnpackage btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $view["package_expiry_value"];?></button>
                                        <div class="dropdown-menu">
                                            <?php 
                                            if(count($packgesmode) > 0){
                                                foreach($packgesmode as $cd)    {
                                                    ?>
                                            <a class="dropdown-item" onclick="changeexpiry($(this))" href="javascript:void(0)"><?php echo $cd->pmode_name;?></a> 
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php echo form_error('package_expiry');?>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-success" name="submit" value="submit">Submit</button>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>                   
        </div>          
    </div>
</div>
      