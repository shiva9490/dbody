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
                                <label>Delivery Type<span class="required text-danger">*</span></label>
                                <select class="form-control" name="delivery_type" required>
                                    <option value="">Selecte Delivery Type </option>
                                    <?php foreach($types as $types){?>
                                    <option value="<?php echo $types->derliverytype_id;?>" <?php if($view['delivery_type'] ==$types->derliverytype_id){echo 'selected';}?>><?php echo $types->derliverytype;?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('delivery_type');?>
                            </div>
                            <div class="form-group">
                                <label>Delivery Start Time<span class="required text-danger">*</span></label>
                                <input name="deliverychg_start" type="time" class="form-control " value="<?php echo $view['deliverychg_start'];?>" placeholder="Measure Unit" required="" minlength="1" maxlength="50" autocomplete="off" />
                                <p id="msg"></p>
                                <?php echo form_error('deliverychg_start');?>
                            </div>
                            <div class="form-group">
                                <label>Delivery End Time<span class="required text-danger">*</span></label>
                                <input name="deliverychg_end" type="time" class="form-control " value="<?php echo $view['deliverychg_end'];?>" placeholder="Measure Unit" required="" minlength="1" maxlength="50" autocomplete="off" />
                                <p id="msg"></p>
                                <?php echo form_error('deliverychg_end');?>
                            </div>
                            <div class="form-group">
                                <label>Delivery Amount<span class="required text-danger">*</span></label>
                                <input name="deliverychg_amount" type="text" class="form-control " value="<?php echo $view['deliverychg_amount']?>" placeholder="Delivery Amount" required="" minlength="1" maxlength="50" autocomplete="off" />
                                <p id="msg"></p>
                                <?php echo form_error('deliverychg_amount');?>
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
      