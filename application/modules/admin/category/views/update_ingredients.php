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
                        <h5 class="m-b-0 text-white">Update ingredients</h5>
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
                                            <option value="<?php echo $res->subcategory_id?>" <?php if($view['subcategory_id'] == $re->subcategory_id){echo 'selected';}?>><?php echo $res->subcategory_name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('subcategory_id');?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>ingredients  <span class="required text-danger">*</span></label>
                                <input type="text" name="prod_indug" value="<?php echo $view['prod_indug']?>" class="form-control">
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
        </div>          
    </div>
</div>