<?php
$cr     =   $this->session->userdata("create-product");
$ur     =   $this->session->userdata("update-product");
$dr     =   $this->session->userdata("delete-product");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>
<div class="container-fluid">
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Product Name</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item active">Product Name</li>
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
            <?php if($cr == '1'){?>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h5 class="m-b-0 text-white">Update Product Name</h5>
                    </div>
                    <div class="card-body">
                       <form action="" method="post" class="validform" id="category" novalidate="" enctype="multipart/form-data" >  
                             <div class="row"> 
                                <div class='col-sm-12'>
                                     <div class="form-group">
                                         <label>Product <span class="required text-danger">*</span></label>
                                         <input placeholder="Products" name="product_name" value="<?php echo set_value("product_name");?>" required="" class="vendorproduct_product form-control" id="vendorproduct_product"/>
                                         <?php echo form_error("product_name");?>
                                     </div>
                                </div>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-success" name="submit" value="submit">Submit</button>
                            </div> 
                        </form>
                     </div>
                </div>
            </div>
            <?php } ?>                      
        </div>          
    </div>
</div>