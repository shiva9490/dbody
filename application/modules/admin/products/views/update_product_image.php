<?php
$cr     =   $this->session->userdata("create-product");
$ur     =   $this->session->userdata("update-product");
$dr     =   $this->session->userdata("delete-product");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}// print_r($view);
?>
<div class="container-fluid">
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Products image Update</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo bildourl('update-images/'.$view['vendorproduct_productid']);?>">Product Images</a></li>
                <li class="breadcrumb-item active">Product Image Update</li>
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
                    <div class="card-header bg-success">
                        <h5 class="m-b-0 text-white">Products image Update</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="formvalid container" id="" novalidate=""  enctype="multipart/form-data">  
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" name="old_image" value="<?php echo $view['vendorproductimg_name'];?>">
                                    <label>Product Image (650 X 650px) <span class="required text-danger">*</span></label>
                                    <input type="file" name="product_image" multiple="" class="form-control product_upload"  required="" accept=".jpg,.png,.gif,.jpeg"/>
                                    <?php echo form_error('product_image');?>
                               </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Old Image </label>
                                    <img src="<?php echo base_url('uploads/products/'.$view['vendorproductimg_name']);?>" width="100%"/>
                               </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary" name="update" value="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                                   
        </div>          
    </div>
</div>