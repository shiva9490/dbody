<?php
$cr     =   $this->session->userdata("create-addon");
$ur     =   $this->session->userdata("update-addon");
$dr     =   $this->session->userdata("delete-addon");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>

<div class="container-fluid">
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">addon</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item active">addon</li>
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
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h5 class="m-b-0 text-white">Add addon</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="validform forms-sample" id="sub_category" novalidate="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Addon Name <span class="required text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Addon Name">
                                <?php echo form_error('name');?>
                            </div>
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
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12">
                                    <label >Addon *</label>
                                </div>
                                <div class="col-lg-1 col-md-1"></div>
                                <div class="col-lg-5 col-md-5" id="catt" style="">
                                    <input id="urll" type="hidden" value="/Ajax-Addon-Items">
                                    <label >Category *</label> <br>
                                           <?php $category	=  $this->category_model->viewCategory();?>
                                      <?php foreach($category as $c){?>
                                           <input type="checkbox" name="cat[]" id="<?php echo $c->category_id;?>" value="<?php echo $c->category_id;?>" onchange="getProducts()" required>
                                           <label for="<?php echo $c->category_id;?>"><?php echo $c->category_name;?></label><br>
                                       <?php } ?>
                                 </div>  
                                 <div class="col-lg-6 col-md-6" id="produc" style="">
                                   <label >Products *</label> <br>
                                   <div id="productt"></div>
                                 </div>  
                                
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-custon-rounded-three btn-success" name="submit" value="submit"> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>          
    </div>
</div>
</div>