<div class="row layout-top-spacing">
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
                                <a href="<?php echo base_url('Kart-Admin/Refer');?>" class="btn btn-danger"> Cancel</a>
                                <button type="submit" class="btn btn-primary" name="update" value="update">Update</button>
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
                                         <label >Type of Refer *</label>
                                         <select class="form-control" name="refer_type" id="exampleFormControlSelect1" required onchange="discType()">
											<option value="">Select Refer Type</option>
                                            <?php foreach($this->config->item('discountType') as $d){ ?>
                                                <option value="<?php echo $d; ?>" <?php if($view['refer_type']==$d){echo 'selected';}?> ><?php echo $d; ?></option>
                                            <?php }	 ?>										
										</select>
                                    </div>
                                    <div class="col-md-4">
                                        <label > Discount *</label>
                                        <div class=" input-group b-grey">
                                            <input type="number" class="form-control" name="discount" placeholder="Enter Discount" aria-label="notification" aria-describedby="basic-addon2"   value="<?php echo $view['refer_discount']?>" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-percent" aria-hidden="true"></i></span>
                                            </div>
                                        </div> 
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <label >MIN Cart Value *</label>
                                        <div class="form-group b-grey">
                                            <div class="input-group ">
                                                <input type="number" class="form-control arabic_feild"  name="min_refer"   aria-label="notification" aria-describedby="basic-addon3" value="<?php echo $view['refer_min_value']?>" required />
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon3"><i class="fa fa-inr" aria-hidden="true"></i></span>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row mb-4" style="<?php if($view['refer_refer']=='refer'){echo 'display:none';} ?>">
                                    <div class="col-md-12">
                                        <label >Validity Period *</label>
                                     </div>
                                     <div class="col-md-4">
                                         <div class="form-group b-grey">
                                         <label >Days *</label>
                                         <input class="form-control " type="number" name="days"  value="<?php echo $view['refer_validity']?>" required>
                                        </div>
                                    </div>
                                    
                                    <!--<div class="col-md-4">-->
                                    <!--     <div class="form-group b-grey">-->
                                    <!--     <label >From *</label>-->
                                    <!--     <input class="form-control " type="datetime-local" name="from_date"  value="<?php echo $view['refer_date_from']?>" required>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!--<div class="col-md-4">-->
                                    <!--     <div class="form-group b-grey">-->
                                    <!--        <label >To *</label>-->
                                    <!--        <input class="form-control " type="datetime-local" name="to_date" min="<?php echo date('Y-m-d').'T00:00';?>"  value="<?php echo $view['refer_date_to']?>" required>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!--<div class="col-md-4">-->
                                    <!--  <div class="form-group b-grey">-->
                                    <!--     <label >Refer Code *</label>-->
                                    <!--     <div class="input-group">-->
                                    <!--        <input class="form-control " type="text" name="refer" placeholder="Enter Refer code" value="<?php echo $view['refer_refer']?>" required readonly>                                            -->
                                    <!--        <div class="input-group-append"  onclick="refer_read()">-->
                                    <!--            <span class="input-group-text" id="basic-addon5"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>-->
                                    <!--        </div>-->
                                    <!--        <div class="input-group-append" onclick="refer_gen()">-->
                                    <!--            <span class="input-group-text" id="basic-addon6"><i class="fa fa-refresh" aria-hidden="true"></i></span>-->
                                    <!--        </div>-->
                                    <!--     </div>-->
                                    <!--    <span class="text-danger"><?php echo form_error('refer'); ?></span>-->
                                    <!--   </div>-->
                                    <!--</div>-->
                                </div>    
                 <!--               <div class="row mb-4">                                   -->
                 <!--                   <div class="col-md-4">                                        -->
                 <!--                        <div class="form-group b-grey">-->
                 <!--                           <label >Type Of Order *</label><br> -->
                 <!--                           <input type="radio"  name="typeofcust" value="All" id="all" <?php if($view['refer_cust_type']=='All'){echo 'checked';}?> required onchange="typeofcustt()"/>-->
        									<!--<label for="all">All</label>        	<br>-->
        									<!--<input type="radio"  name="typeofcust" id="ftc" value="First Time Customer" <?php if($view['refer_cust_type']=='First Time Customer'){echo 'checked';}?> required  onchange="typeofcustt()"/>-->
        									<!--<label for="ftc">First Time Order </label> <br>-->
                 <!--                           <input type="radio"  name="typeofcust" id="nth" value="nth Time Customer" <?php if($view['refer_cust_type']=='nth Time Customer'){echo 'checked';}?> required  onchange="typeofcustt()"/>-->
        									<!--<label for="nth">N'th Time Order </label>  <br>-->
                 <!--                           <div id="nth_value" <?php if($view['refer_cust_type']!='nth Time Customer'){echo 'style="display:none;"';}?>>-->
                 <!--                               <input type="number" name="nth_value" value="<?php echo $view['refer_nth_value']?>" placeholder="Enter N value"  required>	-->
                 <!--                           </div>								-->
                 <!--                       </div>-->
                 <!--                   </div>-->
                 <!--                   <div class="col-md-4">-->
                 <!--                       <label >applicable per person *</label>  -->
                 <!--                       <input type="number" class="form-control arabic_feild"  name="per_person"   aria-label="notification" aria-describedby="basic-addon4" value="<?php echo $view['refer_per_person']?>" required />                                -->
                 <!--                    </div>-->
                 <!--               </div>  -->

                                <?php $prod = implode(',',$prod);?>
                                 <input id="produ" type="hidden" value="<?php echo $prod;?>">
                                 <input id="urll" type="hidden" value="/Ajax-Refer-Items">
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label >Applicable Outlets *</label> 
                                        <select id="tyyy" name="for_type" class="form-control" onchange="typeee()" required>
                                            <option value="">Select Type</option>
                                            <?php foreach($this->config->item('discountBased') as $d){ ?>
                                                <option value="<?php echo $d; ?>" <?php if($view['refer_applicable']==$d){echo 'selected';}?> ><?php echo $d; ?></option>
                                            <?php }	 ?>	
                                        </select>    <br><br>                                    
                                     </div>               
                                    <div class="col-md-1"></div>
                                     <div class="col-md-5" id="catt" style="display:none">
                                        <label >Category *</label> <br>
                                           <?php                                          
                                           foreach($category as $c){?>
                                                <input type="checkbox" name="cat[]" id="<?php echo $c->category_id;?>" value="<?php echo $c->category_id;?>" <?php if(in_array($c->category_id,$catt)){echo 'checked';}?> onchange="getProducts()" required>
                                                <label for="<?php echo $c->category_id;?>"><?php echo $c->category_name;?></label><br>
                                            <?php } ?>
                                      </div>  
                                      <div class="col-md-6" id="produc" style="display:none">
                                        <label >Products *</label> <br>
                                        <div id="productt">
                                            <?php $this->load->view("ajax_items");?> 
                                        </div>
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
