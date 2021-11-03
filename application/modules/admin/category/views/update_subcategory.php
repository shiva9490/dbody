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
                <li class="breadcrumb-item"><a href="<?php echo bildourl('subcategory');?>">Sub Category</a></li>
                <li class="breadcrumb-item active">Update Sub Category</li>
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
                        <h5 class="m-b-0 text-white">Update Sub Category</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="validform forms-sample" id="category" novalidate="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Category <span class="required text-danger">*</span></label>
                                <select class="form-control category" name="category" id="category_name" required="">
                                    <option value="">Select Category</option>
                                    <?php  
                                    if(count($res) > 0){
                                        foreach ($res as $re){  
                                           ?>
                                    <option value="<?php echo $re->category_id?>" <?php  echo ($re->category_id == $view["subcategory_category"])?"selected='selected'":set_select("category", $re->category_id);?>><?php echo $re->category_name;?></option>
                                           <?php
                                        }
                                    }
                                   ?>
                                </select>
                                <?php echo form_error('category');?>
                            </div>
                            <div class="form-group">
                                 <label>Sub Category <span class="required text-danger">*</span></label>
                                 <input name="sub_category" type="text" class="form-control sub_category" placeholder="Sub Category Name" value="<?php echo ($view["subcategory_name"] != "")?$view["subcategory_name"]:set_value('sub_category');?>" required="" minlength="3" maxlength="50"/>
                                 <?php echo form_error('sub_category');?>
                            </div>
                            <div class="form-group">
                                <label>Sub Category Image </label>
                                <input type="file" name="subcategory_upload" class="form-control subcategory_upload" accept=".jpg,.png,.gif,.jpeg"/>
                                <?php echo form_error('subcategory_upload');?>
                                <?php
                                $imsg =   $this->config->item("upload_url")."category/photo-not-available.png";
                                $target_dir =   $this->config->item("upload_url")."category/".$view['subcategory_upload'];
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