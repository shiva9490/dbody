<div class="container-fluid">
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Create Product</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li> 
                <li class="breadcrumb-item active">Create Product</li>
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
                         <h5 class="m-b-0 text-white">Create Product</h5>
                     </div>
                    <div class="card-body">
                       <!-- <form action="" method="post" class="validform" id="category" novalidate="" enctype="multipart/form-data" >  
                             <div class="row"> 
                                <div class='col-sm-4'>
                                     <div class="form-group">
                                         <label>Product <span class="required text-danger">*</span></label>
                                         <input placeholder="Products" name="product_name" value="<?php echo set_value("product_name");?>" required="" class="vendorproduct_product form-control" id="vendorproduct_product"/>
                                         <?php echo form_error("product_name");?>
                                     </div>
                                </div>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-success" name="submit" value="submit">Submit</button>
                            </div> 
                        </form>-->
                        <form action="" method="post" class="formvalid " id="" novalidate=""  enctype="multipart/form-data">  
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
                                        <select class="form-control vendorproduct_category" name="category" id="category_id" data-value="0" required="">
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
                                             if(is_array($result) && count($result) > 0){
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                          <label>Product Name <span class="required text-danger">*</span></label> 
                                          <input type="hidden" class="form-control product_name" name="product_name" id="FilterTextBoxval" >
                                          <input type="text" class="form-control vendorproduct_product" id="FilterTextBox"  name="vendorproduct_product" placeholder="Product Name" onkeyup="autoproduct(jQuery(this))" required="" value="<?php echo set_value('vendorproduct_product');?>"/> 
                                          <?php echo form_error('vendorproduct_product');?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                          <label>Short Description <span class="required text-danger">*</span></label>
                                          <textarea name="vendorproduct_description" id="vendorproduct_description" class="form-control" required placeholder="Product Description"><?php echo set_value("vendorproduct_description");?></textarea>
                                         <?php echo form_error('vendorproduct_description');?>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                          <label>Product Model <span class="required text-danger">*</span></label>
                                          <input type="text" class="form-control vendorproduct_model" name="vendorproduct_model" id="vendorproduct_model" value="<?php echo set_value("vendorproduct_model");?>" required="" placeholder="Product Model">
                                          <?php echo form_error('vendorproduct_model');?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                          <label>Product Brand <span class="required text-danger">*</span></label>
                                          <input type="text" class="form-control vendorproduct_brand" name="vendorproduct_brand" id="vendorproduct_brand" value="<?php echo set_value("vendorproduct_brand");?>" required="" placeholder="Product Brand">
                                          <?php echo form_error('vendorproduct_brand');?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row prices-list" style="display:none;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="button" id="add" onclick="myevent(this)" value="Add" style="float: right;" class="btn btn-custon-rounded-three btn-primary"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row" id="AddDel">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Type <span class="required text-danger">*</span></label>
                                                <select class="form-control ingredientslist" name="vendor_ingredientslist[0]" id="" required="">
                                                    <option value="">Select Measure</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                 <label>Quantity <span class="required text-danger">*</span></label>
                                               <input type="text" name="vendorproduct_bb_quantity[0]" class="quantivendorproduct_bb_quantityty form-control"  value="<?php echo set_value("vendorproduct_bb_quantity[0]");?>" id="quantity" placeholder="Quantity"  >
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Price<span class="required text-danger">*</span></label>
                                                <input type="text" name="vendorproduct_bb_price[0]" class="vendorproduct_bb_price form-control" id="price0" value="<?php echo set_value("vendorproduct_bb_price[0]");?>"  placeholder="Price">
                                             </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                 <label>MRP</label>
                                                <input type="text" name="vendorproduct_bb_mrp[0]" class="vendorproduct_bb_mrp form-control" id="MRP0" value="<?php echo set_value("vendorproduct_bb_mrp[0]");?>" placeholder="MRP" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Measure<span class="required text-danger">*</span></label>
                                                <select class="form-control vendorproduct_bb_measure0" name="vendorproduct_bb_measure[0]" id="measure" required="">
                                                    <option value="">Select Measure</option>
                                                    <?php  
                                                    if(count($measure) > 0){
                                                        foreach ($measure as $me){
                                                            ?>
                                                    <option value="<?php echo $me->measure_id?>" <?php if(set_value('vendorproduct_bb_measure') == $me->measure_id){echo 'selected';}?>><?php echo $me->measure_unit ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <?php echo form_error('vendorproduct_bb_measure');?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row price-list" style="display:none;">
                                <div class="col-md-12">
                                    <div class="row" id="AddDel">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Price<span class="required text-danger">*</span></label>
                                                <input type="text" name="vendorproduct_bb_prices"  class="vendorproduct_bb_price form-control" id="price"  placeholder="Price">
                                                <?php echo form_error('vendorproduct_bb_prices');?>
                                             </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>MRP</label>
                                                <input type="text" name="vendorproduct_bb_mrps" class="vendorproduct_bb_mrp form-control" id="MRP" placeholder="MRP">
                                                <?php echo form_error('vendorproduct_bb_mrps');?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="AddDel"></div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Shipping <span class="required text-danger">*</span></label>
                                        <div>
                                            <input type="radio" name="vendorproduct_shipping" <?php echo set_radio('vendorproduct_shipping','Yes');?> class="vendorproduct_shipping" value="Yes" > Yes
                                            <input type="radio" name="vendorproduct_shipping" <?php echo set_radio('vendorproduct_shipping','No');?> class="vendorproduct_shipping" value="No" > No
                                        </div>    
                                        <?php echo form_error('vendorproduct_shipping');?>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tax Class <span class="required text-danger">*</span></label> 
                                        <div>
                                           <input type="radio" name="vendorproduct_tax_class" <?php echo set_radio('vendorproduct_tax_class','Taxable');?> class="vendorproduct_tax_class" value="Taxable" > Taxable
                                           <input type="radio" name="vendorproduct_tax_class" <?php echo set_radio('vendorproduct_tax_class','Non-Taxable');?> class="vendorproduct_tax_class" value="Non-Taxable" > Non-Taxable
                                        </div>
                                        <?php echo form_error('vendorproduct_tax_class');?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Product Image (650 X 650px) <span class="required text-danger">*</span></label>
                                        <input type="file" name="product_upload[]" multiple="" class="form-control product_upload"  required="" accept=".jpg,.png,.gif,.jpeg" multiple=""/>
                                        <?php echo form_error('product_upload[]');?>
                                   </div>
                                </div>
                            </div>   
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Photo Upload Option</label>
                                        <input type="checkbox" name="photo_upload" value="1" class="" <?php if(set_value('photo_upload') == 1){echo 'checked';}?>/>
                                        <?php echo form_error('photo_upload');?>
                                   </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Product Description</label>
                                    <textarea class="form-control" rows="8" name="vendorproduct_descc"><?php echo set_value('vendorproduct_descc');?></textarea>
                                </div>
                            </div>
                            <!--<div class="row">-->
                            <!--    <label> &nbsp;&nbsp;Occasions</label>-->
                            <!--    <div class="col-md-12 ml-2">-->
                            <!--        <?php foreach($event as $e){ ?>-->
                            <!--                <input type="checkbox" name="event[]" id="<?php echo $e->event_id;?>" value="<?php echo $e->event_id;?>" onchange="getProducts()" required>-->
                            <!--                <label for="<?php echo $e->event_id;?>"><?php echo $e->event_name;?></label><br>-->
                            <!--        <?php } ?>-->
                            <!--    </div>-->
                            <!--</div>-->
                             <div class="form-group row">
                                <div class="col-lg-12 col-md-12">
                                    <label >Category Maping *</label>
                                </div>
                                <div class="col-lg-1 col-md-1"></div>
                                <div class="col-lg-5 col-md-5" id="catt" style="">
                                    <input id="urll" type="hidden" value="/Ajax-Category-Maping-Items">
                                    <label >Category *</label> <br>
                                           <?php $category	=  $this->category_model->viewCategory();?>
                                      <?php foreach($category as $c){?>
                                           <input type="checkbox" name="cat[]" id="<?php echo $c->category_id;?>" value="<?php echo $c->category_id;?>" onchange="getProducts()" required>
                                           <label for="<?php echo $c->category_id;?>"><?php echo $c->category_name;?></label><br>
                                       <?php } ?>
                                 </div>  
                                 <div class="col-lg-6 col-md-6" id="produc" style="">
                                   <label >Sub Categories *</label> <br>
                                   <div id="productt"></div>
                                 </div>  
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Out of Stock</label>
                                            <input type="checkbox" name="out_stock" value="1" class="" <?php if(set_value('out_stock') == 1){echo 'checked';}?>/>
                                            <?php echo form_error('out_stock');?>
                                       </div>
                                    </div>
                                </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input type="submit" class="btn btn-custon-rounded-three btn-primary" name="submit" value="Submit">
                                </div>
                             </div>
                      </form>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>