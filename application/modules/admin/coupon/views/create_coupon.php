<div class="row layout-top-spacing" onload="coupon_gen();">
	<div id="fuSingleFile" class="col-lg-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<form method="POST" enctype="multipart/form-data" class="validform forms-sample" >
				<div class="container-fluid py-3 pt-4 bb-grey sticky">
					<div class="row">	
                        <div class="col-md-10 mx-auto box-shaow">	
                         <div class="row">					
                            <div class="col-md-6">
                                <h4><?php echo $title;?></h4>
                            </div>
                            <div class="col-md-6" align="right">
                                <a href="<?php echo base_url('Kart-Admin/Coupon');?>" class="btn btn-danger"> Cancel</a>
                                <button type="submit" class="btn btn-primary" name="publish" value="Publish">publish</button>
                            </div>
                         </div>
                        </div>    
					</div>
				</div>
				<div class="container-fluid py-3 pt-4">
					<?php $this->load->view('admin/success_error');?>
					<div class="row">
						<div class="col-md-10 mx-auto box-shaow">			
					         <div class="col-md-12 m-3">
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                         <label >Type of Coupon *</label>
                                         <select class="form-control" name="coupon_type" id="exampleFormControlSelect1" required onchange="discType()">
											<option value="">Select Coupon Type</option>
                                            <?php foreach($this->config->item('discountType') as $d){ ?>
                                                <option value="<?php echo $d; ?>" <?php if(set_value('coupon_type')==$d){echo 'selected';}?> ><?php echo $d; ?></option>
                                            <?php }	 ?>										
										</select>
                                        <div class="invalid-feedback discc">
                                                        Please provide a valid coupon type.
                                        </div>
                                        <span class="text-danger"><?php echo form_error('coupon_type'); ?></span>
                                    </div>
                                    <div class="col-md-4">
                                        <label > Discount *</label>
                                        <div class=" input-group b-grey">
                                            <input type="number" class="form-control" name="discount" placeholder="Enter discount" aria-label="notification" aria-describedby="basic-addon2"   value="<?php echo set_value('discount')?>"  required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-percent" aria-hidden="true"></i></span>
                                            </div>
                                            <span class="text-danger"><?php echo form_error('discount'); ?></span>
                                        </div> 
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <label >MIN Cart Value *</label>
                                        <div class="form-group b-grey">
                                            <div class="input-group ">
                                                <input type="number" class="form-control arabic_feild"  name="min_coupon"   aria-label="notification" aria-describedby="basic-addon3" value="<?php echo set_value('min_coupon')?>" required />
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon3"><i class="fa fa-inr" aria-hidden="true"></i></span>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('min_coupon'); ?></span>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label >Validity Period *</label>
                                     </div>
                                    
                                    <div class="col-md-4">
                                         <div class="form-group b-grey">
                                         <label >From *</label>
                                         <input class="form-control " type="datetime-local" name="from_date" min="<?php echo date('Y-m-d').'T00:00';?>" value="<?php echo set_value('from_date')?>" required>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('from_date'); ?></span>
                                    </div>
                                    <div class="col-md-4">
                                         <div class="form-group b-grey">
                                            <label >To *</label>
                                            <input class="form-control " type="datetime-local" name="to_date" min="<?php echo date('Y-m-d').'T00:00';?>"  value="<?php echo set_value('to_date')?>" required>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('to_date'); ?></span>
                                    </div>
                                    <div class="col-md-4">
                                         <div class="form-group b-grey">
                                         <label >Coupon Code *</label>
                                         <div class="input-group">
                                            <input class="form-control " type="text" name="coupon" placeholder="Enter Coupon code" value="<?php echo set_value('coupon')?>" aria-describedby="basic-addon5"  required readonly>                                            
                                            <div class="input-group-append"  onclick="coupon_read()">
                                                <span class="input-group-text" id="basic-addon5"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="input-group-append" onclick="coupon_gen()">
                                                <span class="input-group-text" id="basic-addon6"><i class="fa fa-refresh" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('coupon'); ?></span>
                                        </div>
                                    </div>
                                </div>    
                                <div class="row mb-4">                                    
                                    <div class="col-md-4">    
                                        <label >Type Of Customer *</label>                                  
                                         <div class="form-group b-grey">
                                                <input type="radio"  name="typeofcust" value="All" id="all" <?php if(set_value('typeofcust')=='All'){echo 'checked';}?> required onchange="typeofcustt()"/>
        										<label for="all">All</label>        		<br>
        										<input type="radio"  name="typeofcust" id="ftc" value="First Time Customer" <?php if(set_value('typeofcust')=='First Time Customer'){echo 'checked';}?> required onchange="typeofcustt()"/>
        										<label for="ftc">First Time Order </label><br>
                                                <input type="radio"  name="typeofcust" id="nth" value="nth Time Customer" <?php if(set_value('typeofcust')=='nth Time Customer'){echo 'checked';}?> required  onchange="typeofcustt()"/>
        										<label for="nth">N'th Time Order </label>  <br>
                                                <div id="nth_value" <?php if(empty(set_value('typeofcust')) || set_value('typeofcust')!='nth Time Customer'){echo 'style="display:none;"';}?>">
                                                    <input type="number" name="nth_value" value="<?php echo set_value('nth_value')?>" placeholder="Enter N value"  required>	
                                                </div>						
                                        </div>
                                        <span class="text-danger"><?php echo form_error('typeofcust'); ?></span>
                                    </div>
                                    <div class="col-md-4">
                                        <label >applicable per person *</label>  
                                        <input type="number" class="form-control arabic_feild"  name="per_person"   aria-label="notification" aria-describedby="basic-addon4" value="<?php echo set_value('per_person')?>" required />                                
                                        <span class="text-danger"><?php echo form_error('per_person'); ?></span>
                                     </div> 
                                     <div class="col-md-4" id="maxdis" style="display:none;">
                                        <label >Maximum Discount  *</label>  
                                        <input type="number" class="form-control arabic_feild"  name="max_discount"   aria-label="notification" aria-describedby="basic-addon4" value="<?php echo set_value('max_discount')?>" required />                                
                                        <span class="text-danger"><?php echo form_error('max_discount'); ?></span>
                                     </div>  
                                </div>  
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                            <input id="urll" type="hidden" value="/Ajax-Coupon-Items">
                                        <label >Applicable Outlets *</label> 
                                        <select id="tyyy" name="for_type" class="form-control" onchange="typeee()" required>
                                            <option value="">Select Type</option>
                                            <?php foreach($this->config->item('discountBased') as $d){ ?>
                                                <option value="<?php echo $d; ?>" <?php if(set_value('for_type')==$d){echo 'selected';}?> ><?php echo $d; ?></option>
                                            <?php }	 ?>	
                                        </select>    <br><br>                                    
                                     </div> 
                                                   
                                    <div class="col-md-1"></div>
                                     <div class="col-md-5" id="catt" style="display:none">
                                        <label >Category *</label> <br>
                                           <?php foreach($category as $c){?>
                                                <input type="checkbox" name="cat[]" id="<?php echo $c->category_id;?>" value="<?php echo $c->category_id;?>" onchange="getProducts('/Ajax-Coupon-Items')" required>
                                                <label for="<?php echo $c->category_id;?>"><?php echo $c->category_name;?></label><br>
                                            <?php } ?>
                                      </div>  
                                      <div class="col-md-6" id="produc" style="display:none">
                                        <label >Products *</label> <br>
                                        <div id="productt"></div>
                                      </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
