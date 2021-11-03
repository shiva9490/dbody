<div class="container-fluid">
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Change Password</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item active">Change Password</li>
            </ol>
        </div>
    </div>
 </div>
</div>
<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
           
            
            <div class="col-lg-5 col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h5 class="m-b-0 text-white">Change Password</h5></div>
                    <div class="card-body">
                      
                        <form action="" method="post" class="validform" id="change_password" novalidate="">
                                        <?php $this->load->view("admin/success_error");?>
                                            <div class="form-group">
                                                <label>New Password <span class="required text-danger">*</span></label>
                                                <input name="new_password" type="password" class="form-control new_password" placeholder="New Password" value="<?php echo set_value('new_password');?>" required="" minlength="5" maxlength="50"/>
                                                <?php echo form_error('new_password');?>
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password <span class="required text-danger">*</span></label>
                                                <input type="password" name="cpwd" class="form-control cpwd" placeholder="Confirm Password" value="<?php echo set_value('cpwd');?>" required=""  minlength="5" maxlength="50"/>
                                                <?php echo form_error('cpwd');?>
                                            </div>
                                            <div class="form-actions form-group">
                                                <button type="submit" class="btn btn-custon-rounded-three btn-success" name="submit" value="submit"><i class="fa fa-check edu-checked-pro" aria-hidden="true"></i> Save</button>
                                            </div>
                                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>