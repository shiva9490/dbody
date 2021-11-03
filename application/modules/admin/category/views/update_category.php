<?php
$cr     =   $this->session->userdata("create-category");
$ur     =   $this->session->userdata("update-category");
$dr     =   $this->session->userdata("delete-category");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>

<div class="container-fluid">
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Category</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo bildourl('category');?>">Category</a></li>
                <li class="breadcrumb-item active">Update Category</li>
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
                        <h5 class="m-b-0 text-white">Update Category</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="validform forms-sample" id="category" novalidate="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Category Name <span class="required text-danger">*</span></label>
                                <input name="categoryname" type="text" class="form-control categoryname" placeholder="Category Name" required="" minlength="3" maxlength="50" value="<?php echo $view["category_name"];?>"/>
                                <?php echo form_error('categoryname');?>
                            </div>
                            <div class="form-group">
                                <label>Category Image </label>
                                <input type="file" name="category_upload" class="form-control category_upload" accept=".jpg,.png,.gif,.jpeg"/>
                                <?php echo form_error('category_upload');?>
                                <?php
                                $imsg =   $this->config->item("upload_url")."category/photo-not-available.png";
                                $target_dir =   $this->config->item("upload_url")."category/".$view['category_upload'];
                                if(@getimagesize($target_dir)){
                                    $imsg   =   $target_dir;
                                }
                                ?>
                                <img src="<?php echo $imsg;?>" class="img img-responsive imgpreview"/>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-custon-rounded-three btn-success" name="submit" value="submit"> Submit</button>
                            </div>
                       </form>
                    </div>
                </div>
            </div>         
        </div>          
    </div>
</div>