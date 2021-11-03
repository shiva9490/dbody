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
                        <h5 class="m-b-0 text-white">Update addon</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="validform forms-sample" id="sub_category" novalidate="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Addon Name <span class="required text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Addon Name" value="<?php echo $view['addon_name'] ?>">
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
                                        <option value="<?php echo $re->category_id?>" <?php if($view['category_id'] == $re->category_id){echo 'selected';}?>><?php echo $re->category_name;?></option>
                                        <?php
                                        }
                                    }
                                   ?>
                                </select>
                                <?php echo form_error('category_id');?>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Sub Category <span class="required text-danger">*</span></label>
                                    <select class="form-control vendorproduct_subcategory" name="subcategory_id" id="subcategory_name">
                                        <option value="">Select Sub Category</option>
                                         <?php  
                                            if(count($result) > 0){
                                                foreach ($result as $res){  
                                                    ?>
                                                <option value="<?php echo $res->subcategory_id?>" <?php if($view['subcategory_id'] == $res->subcategory_id){echo 'selected';}?>><?php echo $res->subcategory_name ?></option>
                                                    <?php
                                                }
                                            }
                                        ?> 
                                    </select>
                                    <?php echo form_error('subcategory_id');?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Add-on</label>
                                    <?php $prod = implode(',',$prod);?>
                                    <input id="produ" type="hidden" value="<?php echo $prod;?>">
                                    <input id="urll" type="hidden" value="/Ajax-Addon-Items">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php $category	=  $this->category_model->viewCategory();?>
                                            <label >Category *</label> <br>
                                            <?php foreach($category as $c){?>
                                                <input type="checkbox" name="cat[]" id="<?php echo $c->category_id;?>" value="<?php echo $c->category_id;?>" onchange="getProducts()" <?php if(in_array($c->category_id,$catt)){ echo 'checked';}?> required>
                                                <label for="<?php echo $c->category_id;?>"><?php echo $c->category_name;?></label><br>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-6" id="productt" style="">
                                            <label >Products *</label> <br>
                                            <div id="productt"></div>
                                        </div>
                                      </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-custon-rounded-three btn-success" name="submit" value="submit"> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>       
        </div>          
    </div>
</div>