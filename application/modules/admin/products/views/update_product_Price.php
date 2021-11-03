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
            <div class="card">
                    <div class="card-header bg-success">
                        <div class="row">
                            <div class="col-md-6">
                               <h5 class="m-b-0 text-white"><?php echo $title;?></h5>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php 
                                        $uri = $this->uri->segment('4');
                                        $par['whereCondition'] = "vendorproduct_id LIKE'".$uri."'";
                                        $prod = $this->vendor_model->getVendorproduct($par);
                                        //print_r($prod);exit;
                                    ?>
                                    <input type="hidden" name="vendorproductids" value="<?php echo $this->uri->segment('3');?>">
                                    <input type="hidden" name="vendorid" value="<?php echo $prod['vendorproduct_vendor_id'];?>">
                                    
                                    <?php //echo $prod['category_id'];
                                            $par['columns']         = "prodind,prod_indug,prod_indug_key_wrds";
                                            $par['where_condition'] = "product_Ingredients.category_id LIKE '".$prod['category_id']."'";
                                            $vue    =   $this->ingredients_model->viewIngredients($par);
                                            if(!empty($vue)){
                                    ?>
                                    <label>Type </label>
                                    <select class="form-control ingredientslist0" name="vendor_ingredientslist" value="<?php echo $view['vendor_ingredientslist'];?>" id="" >
                                        <option value="">select type</option>
                                        <?php
                                            //print_r($vue);exit;
                                            if(isset($vue) && count($vue) > 0){
                                                foreach($vue as $r){ ?>
                                                    <option value="<?php echo $r->prodind;?>" <?php if($r->prodind == $view['vendor_ingredientslist']){echo 'selected';}?>><?php echo $r->prod_indug;?></option>
                                        <?php   }
                                            }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                     <label>Quantity </label>
                                   <input type="text" name="vendorproduct_bb_quantity" class="quantivendorproduct_bb_quantityty form-control"  value="<?php echo $view['vendorproduct_bb_quantity'];?>" id="quantity" placeholder="Quantity"  >
                                </div>
                                <span style="color:red;"><?php echo form_error('vendorproduct_bb_quantity');?></span>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Price<span class="required text-danger">*</span></label>
                                    <input type="text" name="vendorproduct_bb_price" class="vendorproduct_bb_price form-control" id="price0" value="<?php echo $view['vendorproduct_bb_price'];?>"  placeholder="Price">
                                 </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                     <label>MRP</label>
                                    <input type="text" name="vendorproduct_bb_mrp" class="vendorproduct_bb_mrp form-control" id="MRP0" value="<?php echo $view['vendorproduct_bb_mrp'];?>" placeholder="MRP" >
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
                                        <option value="<?php echo $me->measure_id?>" <?php if($view['vendorproduct_bb_measure'] == $me->measure_id){echo 'selected';}?>><?php echo $me->measure_unit ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('vendorproduct_bb_measure');?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary" name="submit" value="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>          
    </div>
</div>
      