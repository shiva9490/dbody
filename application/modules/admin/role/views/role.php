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
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Role</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item active">Role</li>
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
                        <h5 class="m-b-0 text-white">Add Role</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="validform forms-sample" id="role" novalidate="">
                            <div class="form-group">
                                <label>Role Name<span class="required text-danger">*</span></label>
                                <input name="role_name" type="text" class="form-control role_name" placeholder="Role Name" value="<?php echo set_value('role_name');?>" required="" minlength="3" maxlength="50"/>
                                <?php echo form_error('role_name');?>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-custon-rounded-three btn-success" name="submit" value="submit"> Submit</button>
                            </div>
                       </form>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header bg-success">
                        <h5 class="m-b-0 text-white">Roles List</h5>
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-md-2">
                                <select class="form-control limitvalue" onchange="searchFilter('','<?php echo bildourl('viewRole/');?>')">
                                    <?php $climit    =   $this->config->item("limit_values");
                                    foreach($climit as $ce){
                                    ?>
                                    <option value="<?php echo $ce;?>"><?php echo $ce;?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>  
                            <div class="col-sm-10">
                                <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo bildourl('viewRole/');?>')">
                               <input type="hidden" id="orderby" name="orderby" value="">
                               <input type="hidden" id="tipoOrderby" name="tipoOrderby" value="">
                            </div> 
                        </div>
                        <div class="row port postList">
                            <?php $this->load->view("ajax_role");?>                        
                            <?php echo $this->ajax_pagination->create_links();?>
                        </div>
                     </div>
                </div>  
            </div>                        
        </div>          
    </div>
</div>
      