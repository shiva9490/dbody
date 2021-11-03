<?php
$cr     =   $this->session->userdata("create-occasion");
$ur     =   $this->session->userdata("update-occasion");
$dr     =   $this->session->userdata("delete-occasion");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>

<div class="container-fluid">
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">event</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item active">occasion</li>
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
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h5 class="m-b-0 text-white">Update Occasion</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="validform forms-sample" id="sub_category" novalidate="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Occasion Name <span class="required text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Event Name" value="<?php echo $view['event_name']; ?>">
                                <?php echo form_error('name');?>
                            </div>
                            <div class="form-group">
                                <label>Occasion Image </label>
                                <input type="file" name="image" class="form-control category_upload" accept=".jpg,.png,.gif,.jpeg"/>
                                <?php echo form_error('image');?>
                                <?php
                                $imsg =   $this->config->item("upload_url")."category/photo-not-available.png";
                                $target_dir =   $this->config->item("upload_url")."category/".$view['event_image'];
                                if(@getimagesize($target_dir)){
                                    $imsg   =   $target_dir;
                                }
                                ?>
                                <img src="<?php echo $imsg;?>" class="img img-responsive imgpreview" width="100px"/>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-custon-rounded-three btn-success" name="submit" value="submit"> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>       
        </div>          
    </div>
</div>