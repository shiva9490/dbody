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
        <?php $this->load->view("admin/success_error");?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                         <h5 class="m-b-0 text-white"><?php echo $title;?></h5>
                     </div>
                    <div class="card-body">
                        <form action="" method="post" class="formvalid " id="" novalidate=""  enctype="multipart/form-data">  
                            <?php $this->load->view("theme/success_error");?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Vendor <span class="required text-danger">*</span></label>
                                        <select class="form-control vendorid" name="vendor_mobile" id="vendorid" required="">
                                           <option value="">Select Venodr</option>
                                           <?php
                                            if(count($vendor) > 0){
                                                foreach ($vendor as $vendor){
                                                ?>
                                                <option value="<?php echo $vendor['vendor_mobile']?>" <?php if(set_value('vendor_mobile') ==$vendor['vendor_mobile']){echo 'selected';}?>><?php echo $vendor['vendor_name'].'('.$vendor['vendor_mobile'].').';?></option>
                                                <?php
                                                }
                                            }
                                           ?>
                                        </select>
                                        <?php echo form_error('vendorid');?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Category <span class="required text-danger">*</span></label>
                                        <select class="form-control vendorproduct_category" name="category" urlvalue="<?php echo bildourl('viewproducts/');?>" id="category_id" data-ids="update"  required="">
                                           <option value="">Select Category</option>
                                           <?php  
                                            if(count($res) > 0){
                                                foreach ($res as $re){
                                                ?>
                                                <option value="<?php echo $re->category_id?>" <?php if(set_value('category') == $re->category_id){echo 'selected';}?>><?php echo $re->category_name;?></option>
                                                <?php
                                                }
                                            }
                                           ?>
                                        </select>
                                        <?php echo form_error('category');?>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                          <label>Sub Category <span class="required text-danger">*</span></label>
                                          <select class="form-control vendorproduct_subcategory" name="sub_category" id="subcategory_name" required="">
                                             <option value="">Select Sub Category</option>
                                             <?php  
                                             if(count($result) > 0){
                                                 foreach ($result as $res){
                                                     ?>
                                             <option value="<?php echo $res->subcategory_id?>" <?php if(set_value('sub_category') == $re->subcategory_id){echo 'selected';}?>><?php echo $res->subcategory_name ?></option>
                                                     <?php
                                                 }
                                             }
                                             ?>
                                           </select>
                                          <?php echo form_error('sub_category');?>
                                    </div>
                                </div>
                            </div>
                            <div class="row ingredientslists"></div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Price value *<span class="required text-danger">*</span></label> <br>
                                        <input type="radio" name="price_value" <?php echo set_radio('price_value','Increase');?> class="vendorproduct_tax_class" value="Increase" > Increase
                                        <input type="radio" name="price_value" <?php echo set_radio('price_value','Decrease');?> class="vendorproduct_tax_class" value="Decrease" > Decrease
                                        <?php echo form_error('price_value');?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Price Type *<span class="required text-danger">*</span></label> <br>
                                        <input type="radio" name="price_type" <?php echo set_radio('price_type','Percentage');?> class="vendorproduct_tax_class" value="Percentage" > Percentage
                                        <input type="radio" name="price_type" <?php echo set_radio('price_type','Amount');?> class="vendorproduct_tax_class" value="Amount" > Amount
                                        <?php echo form_error('price_type');?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Price Amount *<span class="required text-danger">*</span></label> <br>
                                        <input type="number" name="price_amount" class="form-control" value="<?php echo set_value('price_amount');?>">
                                        <?php echo form_error('price_type');?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input type="submit" class="btn btn-custon-rounded-three btn-primary" name="submit" value="Submit">
                                </div>
                             </div>
                        </form>
                        <input type="hidden" id="orderby" name="orderby" value="<?php echo $this->input->get("orderby");?>">
                        <input type="hidden" id="tipoOrderby" name="tipoOrderby" value="<?php echo $this->input->get("tipoOrderby");?>">
                        <input type="hidden" id="types" name="types" value="1">
                        <input type="hidden" id="category" name="category">
                        <input type="hidden" id="subcategory" name="subcategory">
                        <div class="row port postList"></div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>