<div class="page-header-section">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between justify-content-md-start">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url();?>">Home</a></li>
                    <li><span>/</span></li>
                    <li>Vendor Update Products</li>
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
                    <h5 class="title mb-5">Vendor Update Product</h5>
                        <form action="" method="post" class="formvalid container" id="" novalidate=""  enctype="multipart/form-data" >  
                            <?php $this->load->view("theme/success_error");?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Category <span class="required text-danger">*</span></label>
                                        <select class="form-control vendorproduct_category" name="category" id="category_id" required="">
                                           <option value="">Select Category</option>
                                           <?php  
                                            if(count($res) > 0){
                                                foreach ($res as $re){  
                                                ?>
                                                <option value="<?php echo $re->category_id?>" <?php echo ($re->category_id == $view["vendorproduct_category"])?"selected='selected'":"";?>><?php echo $re->category_name;?></option>
                                                <?php
                                                }
                                            }
                                           ?>
                                        </select>
                                        Category not listed ? <a data-toggle="modal" data-target="#categoryForm" href="javscript:void(0)">Create Category</a>
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
                                             <option value="<?php echo $res->subcategory_id?>" <?php echo ($res->subcategory_id == $view["vendorproduct_subcategory"])?"selected='selected'":"";?>><?php echo $res->subcategory_name ?></option>
                                                     <?php
                                                 }
                                             }
                                             ?>
                                           </select>
                                           Sub Category not listed ? <a  data-toggle="modal" data-target="#subcategoryForm" href="javscript:void(0)">Create Sub Category</a>
                                          <?php echo form_error('sub_category');?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                          <label>Product Name <span class="required text-danger">*</span></label> 
                                          <input type="hidden" class="form-control product_name" name="product_name" value="<?php echo $view["product_name"];?>" id="FilterTextBoxval" >
                                          <input type="hidden" name="vendor_mobile"  value="<?php echo $this->session->userdata("vendor_mobile");?>"/>
                                          <input type="text" class="form-control text-capitalize vendorproduct_product" id="FilterTextBox"  name="vendorproduct_product" placeholder="Product Name" onkeyup="autoproduct(jQuery(this))" required="" value="<?php echo ($view["vendorproduct_product"] != "")?$view["product_name"]:set_value('vendorproduct_product');?>"/> 
                                          <?php echo form_error('vendorproduct_product');?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                          <label>Product Description <span class="required text-danger">*</span></label>
                                          <textarea name="vendorproduct_description" id="vendorproduct_description" class="form-control" required placeholder="Product Description"><?php echo $view["vendorproduct_description"];?></textarea>
                                         <?php echo form_error('vendorproduct_description');?>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                          <label>Product Model <span class="required text-danger">*</span></label>
                                          <input type="text" class="form-control text-capitalize vendorproduct_model" name="vendorproduct_model" id="vendorproduct_model" required="" placeholder="Product Model" value="<?php echo $view["vendorproduct_model"];?>"> 
                                          <?php echo form_error('vendorproduct_model');?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                          <label>Product Brand <span class="required text-danger">*</span></label>
                                          <input type="text" class="form-control vendorproduct_brand  text-capitalize" name="vendorproduct_brand" id="vendorproduct_brand" required="" placeholder="Product Brand" value="<?php echo ($view["vendorproduct_brand"] != "")?$view["vendorproduct_brand"]: set_value('vendorproduct_brand');?>">
                                          <?php echo form_error('vendorproduct_brand');?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">   
                                <div class="col-md-3">
                                    <div class="form-group">
                                         <label>Quantity <span class="required text-danger">*</span></label>
                                       <input type="text" name="vendorproduct_quantity" class="quantity vendorproduct_bb_quantity form-control" id="quantity" placeholder="Quantity" value="<?php echo ($view['vendorproduct_quantity'] != '')?$view["vendorproduct_quantity"]:set_value('vendorproduct_quantity');?>"/>
                                        <?php echo form_error('vendorproduct_quantity');?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                            <label>Price<span class="required text-danger">*</span></label>
                                            <input type="text" name="vendorproduct_price" class="vendorproduct_bb_price form-control" id="price"  placeholder="Price" value="<?php echo ($view['vendorproduct_price'] != '')?$view["vendorproduct_price"]:set_value('vendorproduct_price');?>"/>
                                       <?php echo form_error('vendorproduct_price');?>
                                     </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                         <label>MRP<span class="required text-danger">*</span></label>
                                        <input type="text" name="vendorproduct_mrp" class="vendorproduct_bb_mrp form-control" id="MRP" placeholder="MRP" value="<?php echo ($view['vendorproduct_mrp'] != '')?$view["vendorproduct_mrp"]:set_value('vendorproduct_mrp');?>"/>
                                         <?php echo form_error('vendorproduct_mrp');?>
                                     </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                      <label>Measure<span class="required text-danger">*</span></label>
                                       <select class="form-control vendorproduct_bb_measure" name="vendorproduct_measure" id="measure" required="">
                                             <option value="">Select Measure</option>
                                             <?php  
                                             if(count($measure) > 0){
                                                 foreach ($measure as $me){  
                                                     ?>
                                             <option value="<?php echo $me->measure_id?>" <?php echo ($view["vendorproduct_measure"] == $me->measure_id)?"selected='selected'":set_select("vendorproduct_bb_measure",$me->measure_id);?>><?php echo $me->measure_unit ?></option>
                                                     <?php
                                                 }
                                             }
                                             ?>
                                           </select>
                                         <?php echo form_error('vendorproduct_measure');?>
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Shipping <span class="required text-danger">*</span></label>
                                        <div>
                                            <input type="radio" name="vendorproduct_shipping" <?php echo ($view['vendorproduct_shipping'] == "Yes")?"checked='checked'":set_radio('vendorproduct_shipping','Yes');?> class="vendorproduct_shipping" value="Yes" > Yes
                                            <input type="radio" name="vendorproduct_shipping" <?php echo ($view['vendorproduct_shipping'] == "No")?"checked='checked'":set_radio('vendorproduct_shipping','No');?> class="vendorproduct_shipping" value="No" > No
                                        </div>    
                                        <?php echo form_error('vendorproduct_shipping');?>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tax Class <span class="required text-danger">*</span></label> 
                                        <div>
                                           <input type="radio" name="vendorproduct_tax_class" class="vendorproduct_tax_class" <?php echo ($view['vendorproduct_tax_class'] == "Taxable")?"checked='checked'":set_radio('vendorproduct_tax_class','Taxable');?>  value="Taxable" > Taxable
                                           <input type="radio" name="vendorproduct_tax_class" class="vendorproduct_tax_class" <?php echo ($view['vendorproduct_tax_class'] == "Non-Taxable")?"checked='checked'":set_radio('vendorproduct_tax_class','Non-Taxable');?>  value="Non-Taxable" > Non-Taxable
                                        </div>
                                        <?php echo form_error('vendorproduct_tax_class');?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Product Image </label>
                                        <input type="file" name="product_upload[]" multiple="" class="form-control product_upload" accept=".jpg,.png,.gif,.jpeg" multiple=""/> 
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
</section>