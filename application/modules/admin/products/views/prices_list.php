<?php
$cr     =   $this->session->userdata("create-product");
$ur     =   $this->session->userdata("update-product");
$dr     =   $this->session->userdata("delete-product");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>
<div class="container-fluid">
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Products Prices</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item active">Product Prices</li>
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
            <div class='col-lg-12 col-md-12'>
                <div class="card">
                    <div class="card-header bg-success">
                        <div class="row">
                            <div class="col-md-4">
                               <h5 class="m-b-0 text-white"><?php echo $title;?></h5>
                            </div>
                            <div class="col-md-8">
                                <?php $this->load->view('sidenav');?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php 
                $uri = $this->uri->segment('3');
                $par['whereCondition'] = "vendorproduct_id LIKE'".$uri."'";
                $prod = $this->vendor_model->getVendorproduct($par);
                //print_r($prod);exit;
            
            ?>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header bg-success">
                        <h5 class="m-b-0 text-white">Products Prices List</h5>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" name="vendorproductids" value="<?php echo $this->uri->segment('3');?>">
                                    <input type="hidden" name="vendorid" value="<?php echo $prod['vendorproduct_vendor_id'];?>">
                                    <?php     if($prod['category_name'] == "Cakes"){ ?>
                                    <label>Type <span class="required text-danger">*</span></label>
                                    <select class="form-control ingredientslist0" name="vendor_ingredientslist" value="<?php echo $per->vendorproduct_bb_quantity;?>" id="" required="">
                                        <option value=''>Select Type</option>
                                        <?php 
                                            $par['columns']         = "prodind,prod_indug,prod_indug_key_wrds";
                                            $par['where_condition'] = "product_Ingredients.category_id LIKE '".$prod['category_id']."'";
                                            $vue    =   $this->ingredients_model->viewIngredients($par);
                                            //print_r($vue);exit;
                                            if(isset($vue) && count($vue) > 0){
                                                foreach($vue as $r){ ?>
                                                    <option value="<?php echo $r->prodind;?>" <?php if($r->prodind == set_value('vendor_ingredientslist')){echo 'seleted';}?>><?php echo $r->prod_indug;?></option>
                                        <?php   }
                                            }
                                        ?>
                                    </select>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                     <label>Quantity </label>
                                   <input type="text" name="vendorproduct_bb_quantity" class="quantivendorproduct_bb_quantityty form-control"  value="<?php echo set_value('vendorproduct_bb_quantity');?>" id="quantity" placeholder="Quantity"  >
                                </div>
                                <span style="color:red;"><?php echo form_error('vendorproduct_bb_quantity');?></span>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Price<span class="required text-danger">*</span></label>
                                    <input type="text" name="vendorproduct_bb_price" class="vendorproduct_bb_price form-control" id="price0" value="<?php echo set_value('vendorproduct_bb_price');?>"  placeholder="Price">
                                 </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                     <label>MRP</label>
                                    <input type="text" name="vendorproduct_bb_mrp" class="vendorproduct_bb_mrp form-control" id="MRP0" value="<?php echo set_value('vendorproduct_bb_mrp');?>" placeholder="MRP" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Measure<span class="required text-danger">*</span></label>
                                    <select class="form-control vendorproduct_bb_measure" name="vendorproduct_bb_measure" id="measure" required="">
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
                            <div class="col-md-12">
                                <button class="btn btn-primary" name="submit" value="submit">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-8 col-md-12"> 
                <div class="card">
                    <div class="card-header bg-success">
                        <h5 class="m-b-0 text-white">Products Prices List</h5>
                    </div>
                    <div class="card-body">
                        <form method="get" action="">
                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <select name="limitvalue" class="form-control limitvalue" onchange="searchFilter('','<?php echo bildourl('viewproductprince/'.$this->uri->segment('3').'/');?>')">
                                        <?php $climit    =   $this->config->item("limit_values");
                                        foreach($climit as $ce){
                                        ?>
                                        <option value="<?php echo $ce;?>" <?php echo ($ce == $this->input->get("limitvalue"))?"selected='selected'":"";?>><?php echo $ce;?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>  
                                <div class="col-sm-8">
                                   <input type="text" id="FilterTextBox" name="keywords" class="form-control" placeholder="Search" value="<?php echo $this->input->get("keywords");?>">
                                    <input type="hidden" id="orderby" name="orderby" value="<?php echo $this->input->get("orderby");?>">
                                    <input type="hidden" id="tipoOrderby" name="tipoOrderby" value="<?php echo $this->input->get("tipoOrderby");?>">
                                </div> 
                                <div class="col-sm-2">
                                    <input type="submit" name="submit" class="btn btn-primary btn-small" value="Search"/>
                                </div>
                            </div>
                        </form>
                        <div class="row port postList">
                            <?php $this->load->view("ajax_product_prices");?>          
                        </div>
                     </div>
                </div>  
            </div>                        
        </div>          
    </div>
</div>
      