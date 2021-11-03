<?php
$cr     =   $this->session->userdata("create-ingredients");
$ur     =   $this->session->userdata("update-ingredients");
$dr     =   $this->session->userdata("delete-ingredients");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>

<div class="container-fluid">
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">ingredients</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item active">ingredients</li>
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
            <?php if($cr == '1'){?>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h5 class="m-b-0 text-white">Add ingredients</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="validform forms-sample" id="sub_category" novalidate="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Category <span class="required text-danger">*</span></label>
                                <select class="form-control vendorproduct_category" name="category_id" id="category_id" required="">
                                   <option value="">Select Category</option>
                                   <?php  
                                    if(count($res) > 0){
                                        foreach ($res as $re){  
                                        ?>
                                        <option value="<?php echo $re->category_id?>" <?php if(set_value('category_id') == $re->category_id){echo 'selected';}?>><?php echo $re->category_name;?></option>
                                        <?php
                                        }
                                    }
                                   ?>
                                </select>
                                <?php echo form_error('category_id');?>
                            </div>
                            <div class="form-group">
                                <!--<label>Sub Category <span class="required text-danger">*</span></label>
                                <input name="sub_category" type="text" class="form-control sub_category" placeholder="Sub Category Name" value="<?php echo set_value('sub_category');?>" required="" minlength="3" maxlength="50"/>
                                <?php echo form_error('sub_category');?>-->
                                <div class="form-group">
                                      <label>Sub Category <span class="required text-danger">*</span></label>
                                      <select class="form-control vendorproduct_subcategory" name="subcategory_id" id="subcategory_name">
                                         <option value="">Select Sub Category</option>
                                       </select>
                                      <?php echo form_error('subcategory_id');?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>ingredients  <span class="required text-danger">*</span></label>
                                <input type="text" name="prod_indug" value="<?php echo set_value('prod_indug')?>" class="form-control">
                                <?php echo form_error('prod_indug');?>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-custon-rounded-three btn-success" name="submit" value="submit"> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header bg-success">
                        <h5 class="m-b-0 text-white">Sub Categories List</h5>
                    </div>
                    <div class="card-body">
                        <form method="get">
                            <div class="row form-group">
                                <div class="col-md-2">
                                    <select name="limitvalue" class="form-control limitvalue" onchange="searchFilter('','<?php echo bildourl('viewsubCategory/');?>')">
                                        <?php $climit    =   $this->config->item("limit_values");
                                        foreach($climit as $ce){
                                        ?>
                                        <option value="<?php echo $ce;?>"><?php echo $ce;?></option>
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
                            <?php echo $this->load->view("ajax_ingredients");?>
                        </div>
                    </div>
                </div>  
            </div>                        
        </div>          
    </div>
</div>