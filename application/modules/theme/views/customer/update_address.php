<div class="page-header-section">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between justify-content-md-start">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url();?>">Home</a></li>
                    <li><span>/</span></li>
                    <li>Update Address</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section id="dashboard-nav" class="dashboard-section">
    <div class="container">
       <?php $this->load->view("customer_dashboard");?>
    </div>
    <div class="container">
        <div class="dashboard-body">
            <div class="profile">
                <div class="profile-address-book">
                    <h5 class="title">Update Address</h5>
                    <?php $this->load->view("theme/success_error");?>
                    <form class="container mt-10 mb-5" method="post">
                        <div id="" class="row"> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Full Name <span class="text-danger">*</span></label>
                                    <input type="text" id="fullname" name="fullname" class="form-control input-lg" placeholder="Full Name" value="<?php echo $address[0]->customeraddress_fullname;?>" required=""/>
                                    <?php echo form_error('fullname');?>
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mobile No <span class="text-danger">*</span></label>
                                    <input type="text" id="mobile" name="mobile" class="form-control input-lg" placeholder="Mobile No " value="<?php echo $address[0]->customeraddress_mobile;?>" required=""/>
                                    <?php echo form_error('mobile');?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Locality <span class="text-danger">*</span></label>
                                    <input type="text" id="locality" name="locality" class="form-control input-lg" placeholder="Locality" value="<?php echo $address[0]->customeraddress_locality;?>" required=""/>
                                    <?php echo form_error('locality');?>
                                </div>
                            </div>  
                            <div class="col-md-4">
                               <label>Address <span class="text-danger">*</span></label>
                               <textarea class="form-control" required="" name="address" placeholder="Address"><?php echo set_value("address");?><?php echo $address[0]->customeraddress_address;?></textarea>
                                <?php echo form_error('address');?>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>State <span class="required text-danger">*</span></label>
                                    <select class="form-control districtid" id="districtid" name="district" required="">
                                        <option value="">Select District</option>
                                        <?php
                                        $pre['where_condition']     = "pincodeopen = 1";
                                        $pre['group_by']    = "pincode_district";
                                        $states = $this->pincode_model->viewPincode($pre);
                                        if(is_array($states) && count($states) > 0){
                                            foreach ($states as $frt){
                                                ?>
                                        <option value="<?php echo $frt->pincode_district;?>" <?php if($address[0]->customeraddress_district == $frt->pincode_district){echo 'selected';}?>><?php echo $frt->pincode_district;?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('district');?>
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>State <span class="required text-danger">*</span></label>
                                    <select class="form-control Areaid" id="Areaid" name="area" data-value="<?php echo $address[0]->customeraddress_address;?>" required="">
                                        <option value="">Select Area</option>
                                    </select>
                                     <?php echo form_error('area');?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pincode <span class="text-danger">*</span></label> 
                                    <select class="form-control pincode" id="pincode" name="pincode" data-value="<?php echo $address[0]->customeraddress_pincode;?>" required="">
                                        <option value="">Select Pincode</option>
                                    </select>
                                    <?php echo form_error('pincode');?>
                                </div>
                           </div> 
                        </div> 
                        <div id="" class="row">
                            <div class="col-md-4">
                             <div class="form-group">
                                <input type="submit" name="submit"  value="Submit" class="btn btn-sm btn-primary">
                             </div>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>