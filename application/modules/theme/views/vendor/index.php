<div class="page-header-section">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between justify-content-md-start">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url();?>">Home</a></li>
                    <li><span>/</span></li>
                    <li>Vendor</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section id="dashboard-nav" class="dashboard-section">
    
    <div class="container">
       <?php $this->load->view("vendor_dashboard");?>
    </div>
    <div class="container">
        <div class="dashboard-body">
            <div class="profile">
                <div class="profile-address-book">
                    <h5 class="title mb-5">Vendor</h5>
                    <form action="#" class="container formvalid" method="post" name="checkout" novalidate enctype="multipart/form-data">
                        <?php $this->load->view("admin/success_error");?>
                        <div id="customer_details" class="col2-set">
                            <div id="" class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Vendor Image <span class="required text-danger">*</span></label>
                                        <input type="file" name="vendor_profile" class="form-control vendor_profile" <?php echo (count($view) == 0)?'required=""':"";?> accept=".jpg,.png,.gif,.jpeg" />
                                        <?php echo form_error('vendor_profile');?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name <span class="required text-danger">*</span></label>
                                        <input type="text" class="form-control input-lg input_char" name="vendor_name" value="<?php echo (count($view) > 0)?$view["vendor_name"]:set_value('vendor_name');?>" id="vendor_name" placeholder="Name" required=""/>
                                        <?php echo form_error('vendor_name');?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Gender <span class="required text-danger">*</span></label>
                                        <div>
                                            <input type="radio" name="vendor_gender" <?php echo (count($view) >  0 && $view['vendor_gender'] == "Male")?'checked="checked"':"";?> id="gender" value="Male" class="" required>&nbsp;Male &nbsp;
                                            <input type="radio" name="vendor_gender" <?php echo (count($view) >  0 && $view['vendor_gender'] == "Female")?'checked="checked"':"";?> id="gender" value="Female">&nbsp;Female
                                        </div>
                                        <?php echo form_error('vendor_gender');?>
                                    </div>
                                </div>
                            </div>
                            <div id="" class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input class="input-lg form-control" type="date" placeholder="Date of birth" value="<?php echo (count($view) > 0)?$view["vendor_dob"]:'';?>" name="vendor_dob" id="vendor_dob">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email Id</label>
                                        <input type="email" id="vendor_email_id" name="vendor_email_id" class="form-control input-lg" placeholder="Email" value="<?php echo (count($view) > 0)?$view["vendor_email_id"]:'';?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mobile Number <span class="required text-danger">*</span></label>
                                        <input type="text" id="vendor_mobile" name="vendor_mobile" class="form-control input-lg input_num" placeholder="Mobile Number" required minlength="10" maxlength="10" value="<?php echo ($this->session->userdata('otpmobileno') != "")?$this->session->userdata('otpmobileno'):set_value('vendor_mobile');?>"/>
                                        <?php echo form_error('vendor_mobile');?>
                                    </div>
                                </div>
                            </div>
                            <div id="" class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Store Name <span class="required text-danger">*</span></label>
                                        <input type="text" class="form-control input-lg" name="vendor_storename" id="vendor_storename" placeholder="Store Name" required="" value="<?php echo (count($view) > 0)?$view["vendor_storename"]:set_value('vendor_storename');?>">
                                        <?php echo form_error('vendor_storename');?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State</label>
                                        <select class="form-control input-lg" name="vendor_state" id="vendor_state">
                                            <option value="">Select State</option>
                                            <?php
                                            if(count($result) > 0){
                                                foreach ($result as $row){
                                                ?>
                                                <option value="<?php echo $row['state_id'] ?>" <?php echo ($view["vendor_state"] == $row["state_id"])?"selected='selected'":"";?>><?php echo $row['state_name'];?></option>
                                                <?php }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> District</label>
                                        <select name="vendor_district" id="vendor_district" class="form-control input-lg">
                                            <option value="">Select District</option>
                                            <?php
                                            if(count($districts) > 0){
                                                foreach ($districts as $rows){
                                                ?>
                                                <option value="<?php echo $rows['district_id'] ?>" <?php echo ($view["vendor_district"] == $rows["district_id"])?"selected='selected'":"";?>><?php echo $rows['district_name'];?></option>
                                                <?php }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="" class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mandal </label>
                                        <select name="vendor_mandal" id="vendor_mandal" class="form-control input-lg">
                                            <option value="">Select Mandal</option>
                                            <?php
                                            if(count($mandals) > 0){
                                                foreach ($mandals as $ws){
                                                ?>
                                                <option value="<?php echo $ws['mandal_id'] ?>" <?php echo ($view["vendor_mandal"] == $ws["mandal_id"])?"selected='selected'":"";?>><?php echo $ws['mandal_name'];?></option>
                                                <?php }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Gramapanchayat</label>
                                        <select name="vendor_gramapanchayat" id="vendor_gramapanchayat" class="form-control input-lg">
                                            <option value="">Select Garamapanchayat</option>
                                            <?php
                                            if(count($gramss) > 0){
                                                foreach ($gramss as $wcs){
                                                ?>
                                                <option value="<?php echo $wcs['gram_panchayat_id'] ?>" <?php echo ($view["vendor_gramapanchayat"] == $wcs["gram_panchayat_id"])?"selected='selected'":"";?>><?php echo $wcs['gram_panchayat_name'];?></option>
                                                <?php }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Postal Code</label>
                                        <input type="text" id="reg_postal_code" name="vendor_pincode" class="form-control input-lg input_num" value="<?php echo (count($view) > 0)?$view['vendor_pincode']:'';?>" placeholder="Postal code" mijn>
                                    </div>
                                </div>
                            </div>
                            <div id="" class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea id="reg_address" name="vendor_address" class="form-control input-lg" placeholder="Address"><?php echo (count($view) > 0)?$view['vendor_address']:'';?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Submit" class="btn btn-sm btn-primary"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>