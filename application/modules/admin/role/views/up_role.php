<?php
$cr     =   $this->session->userdata("create-role");
$ur     =   $this->session->userdata("update-role");
$dr     =   $this->session->userdata("delete-role");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>
<div class="container-fluid">
 <div class="row page-titles">
     <div class="card-header bg-info">
                        <h5 class="m-b-0 text-white">Update Role</h5></div>
    <div class="col-md-5 align-self-center">
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item active"><a href="<?php echo bildourl('roles');?>">Role</a></li>
                <li class="breadcrumb-item active">Update Role</li>
            </ol>
        </div>
    </div>
 </div>
</div>

     <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="card-body">
                <?php  if($cr == '1'){?>
                    <h5 class="card-title ">Update Role</h5>
                       <form action="" method="post" class="validform forms-sample" id="role" novalidate="">
                            <?php $this->load->view("admin/success_error");?>
                                 <div class="form-group">
                                    <label>Role Name<span class="required text-danger">*</span></label>
                                      <input name="role_name" type="text" class="form-control role_name" placeholder="Role Name" value="<?php echo $view['ut_name'];?>" required="" minlength="3" maxlength="50"/>
                                         <?php echo form_error('role_name');?>
                                  </div>
                                    <div class="form-actions form-group">
                                        <button type="submit" class="btn btn-custon-rounded-three btn-success" name="submit" value="submit"> Submit</button>
                                    </div>
                        </form>
                 <?php  } ?>
             </div>
       </div>
    </div>
        