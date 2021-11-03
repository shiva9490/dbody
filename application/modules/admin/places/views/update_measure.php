<?php
$cr     =   $this->session->userdata("create-measure");
$ur     =   $this->session->userdata("update-measure");
$dr     =   $this->session->userdata("delete-measure");
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
                <li class="breadcrumb-item"><a href="<?php echo bildourl('measures');?>">Measures</a></li>
                <li class="breadcrumb-item active">Update Measure</li>
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
                        <h5 class="m-b-0 text-white">Update Measure</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="validform" id="category" novalidate="" >
                            <div class="form-group">
                                <label>Measure Unit <span class="required text-danger">*</span></label>
                                <input name="measureunit" type="text" class="form-control" placeholder="Measure Unit" required="" minlength="1" maxlength="50" autocomplete="off" value="<?php echo $view['measure_unit'];?>" />
                                <p id="msg"></p>
                                <?php echo form_error('measureunit');?>
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
      