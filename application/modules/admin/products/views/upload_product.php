<div class="container-fluid">
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><?php echo $title;?></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li> 
                <li class="breadcrumb-item active"><?php echo $title;?></li>
            </ol>
        </div>
    </div>
 </div>
</div>
<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                         <div class="row">
                            <div class="col-md-4">
                               <h5 class="m-b-0 text-white"><?php echo $title;?></h5>
                            </div>
                        </div>
                     </div>
                    <div class="card-body">
                        <form action="" method="post" class="formvalid " id="" novalidate=""  enctype="multipart/form-data" >  
                            <?php $this->load->view("theme/success_error");?>
                             <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Vendor <span class="required text-danger">*</span></label>
                                        <select class="form-control vendorid" name="vendor_mobile" id="vendorid" required="">
                                           <option value="">Select Vendor</option>
                                           <?php
                                            if(count($vendor) > 0){
                                                foreach ($vendor as $vendor){
                                                    //echo '<pre>';print_r($vendor);exit;
                                                ?>
                                                <option value="<?php echo $vendor['vendor_id']?>"><?php echo $vendor['vendor_name'];?></option>
                                                <?php
                                                }
                                            }
                                           ?>
                                        </select>
                                        <?php echo form_error('vendorid');?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>File <span class="required text-danger">*</span></label>
                                        <input type="file" name="excel" class="form-control" accept=".xlsx,.csv,.xls" required="">
                                        <?php echo form_error('vendorid');?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input type="submit" class="btn btn-custon-rounded-three btn-success" name="submit" value="Submit">
                                </div>
                            </div>
                        </form>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>