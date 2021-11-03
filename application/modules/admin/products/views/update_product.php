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
                         <div class="row">
                            <div class="col-md-4">
                               <h5 class="m-b-0 text-white"><?php echo $title;?></h5>
                            </div>
                            <div class="col-md-8">
                                <?php $this->load->view('sidenav');?>
                            </div>
                        </div>
                     </div>
                    <div class="card-body">
                        <?php //echo '<pre>';print_r($view);exit;?>
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
                                                <option value="<?php echo $vendor['vendor_mobile']?>" <?php if($view['vendor_mobile'] ==$vendor['vendor_mobile']){echo 'selected';}?>><?php echo $vendor['vendor_name'].'('.$vendor['vendor_mobile'].').';?></option>
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
                                        <select class="form-control vendorproduct_category" name="category" id="category_id" data-value="<?php echo count($price)-1?>" required="">
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
                                          <?php echo form_error('sub_category');?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                          <label>Product Name <span class="required text-danger">*</span></label> 
                                          <input type="hidden" class="form-control product_name" name="product_name" value="<?php echo $view["product_name"];?>" id="FilterTextBoxval" >
                                          <input type="hidden" name="vendor_mobile"  value="<?php echo $view["vendor_mobile"];?>"/>
                                          <input type="text" class="form-control text-capitalize vendorproduct_product" id="FilterTextBox"  name="vendorproduct_product" placeholder="Product Name" onkeyup="autoproduct(jQuery(this))" required="" value="<?php echo ($view["vendorproduct_product"] != "")?$view["product_name"]:set_value('vendorproduct_product');?>"/> 
                                          <?php echo form_error('vendorproduct_product');?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                          <label>Short Description <span class="required text-danger">*</span></label>
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
                                
                            </div>      
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Photo Upload Option</label>
                                        <input type="checkbox" name="photo_upload" value="1" class="" <?php if($view['photo_upload'] == 1){echo 'checked';}?>/>
                                        <?php echo form_error('photo_upload');?>
                                   </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Product Description</label>
                                    <textarea class="form-control" rows="8" name="vendorproduct_descc"><?php echo $view['vendorproduct_descc']?></textarea>
                                </div>
                            </div>
                            <!--<div class="row">
                                <label> &nbsp;&nbsp;Occasions</label>
                                <div class="col-md-12 ml-2">
                                    <?php $ev_id    =   explode(',',$view['vendorproduct_event_id']);
                                        foreach($event as $e){ ?>
                                            <input type="checkbox" name="event[]" id="<?php echo $e->event_id;?>" value="<?php echo $e->event_id;?>" <?php if(!empty($ev_id) && in_array($e->event_id,$ev_id)){echo 'checked';}?>>
                                            <label for="<?php echo $e->event_id;?>"><?php echo $e->event_name;?></label><br>
                                    <?php } ?>
                                </div>
                            </div>-->
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Category Maping</label>
                                    <?php $prod = $view['vendorproduct_catmap_scat_id'];
                                    $catt   =   explode(',',$view['vendorproduct_catmap_cat_id']);
                                    // echo $prod;
                                     ?>
                                    <input id="produ" type="hidden" value="<?php echo $prod;?>">
                                    <input id="urll" type="hidden" value="/Ajax-Category-Maping-Items">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php $category	=  $this->category_model->viewCategory();?>
                                            <label >Category *</label> <br>
                                            <?php foreach($category as $c){?>
                                                <input type="checkbox" name="cat[]" id="<?php echo $c->category_id;?>" value="<?php echo $c->category_id;?>" onchange="getProducts()" <?php if(in_array($c->category_id,$catt)){ echo 'checked';}?> required>
                                                <label for="<?php echo $c->category_id;?>"><?php echo $c->category_name;?></label><br>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-6" id="" style="">
                                            <label >Products *</label> <br>
                                            <div id="productt"></div>
                                        </div>
                                      </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Out of Stock</label>
                                        <input type="checkbox" name="out_stock" value="1" class="" <?php if($view['vendorproduct_out_stock'] == 1){echo 'checked';}?>/>
                                        <?php echo form_error('out_stock');?>
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