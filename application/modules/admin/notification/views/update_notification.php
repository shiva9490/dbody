 
<div class="container-fluid">
     <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Update Popup Notification</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo bildourl('notifications');?>">Popup Notifications</a></li>
                    <li class="breadcrumb-item active">Update Popup Notification</li>
                </ol>
            </div>
        </div>
     </div>
</div>

<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <?php $this->load->view("admin/success_error");?>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h5 class="m-b-0 text-white">Update Popup Notification</h5>
                    </div>
                    <div class="card-body">  
                        <form action="" method="post" class="validform" id="category" novalidate="" enctype = "multipart/form-data" >
                            <div class="form-group">
                                <label>Popup Notification Title </label>
                                <input name="notification_title" type="text" class="form-control notification_title" placeholder="Popup Notification Name" value="<?php echo $view['notification_title'];?>" minlength="3" maxlength="50"/>
                                 <?php echo form_error('notification_title');?>
                            </div>
                            <div class="form-group">
                                <label>Popup Notification (1348 X 500px)<span class="required text-danger">*</span></label>
                                <input name="notification_image" type="file" class="form-control notification_image" value="<?php echo $view['notification_image'];?>" accept=".jpg,.png,.gif,.jpeg"/>
                                    <?php
                                    $imsg   =   base_url()."uploads/notification-uploads/photo-not-available.png";
                                    $imagepath  =   $this->config->item("upload_url")."notification-uploads/"; 
                                    $target_dir =   $imagepath.$view['notification_image'];
                                    if(@getimagesize($target_dir)){
                                        $imsg   =   $target_dir;
                                    }
                                ?>
                                <br/>
                                <img src='<?php echo $imsg;?>' style='height:100px;'/>
                                <?php echo form_error('notification_image');?>  
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