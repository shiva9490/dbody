<?php
$cr     =   $this->session->userdata("create-category");
$ur     =   $this->session->userdata("update-category");
$dr     =   $this->session->userdata("delete-category");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>

<div class="container-fluid">
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Category</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item active">Category</li>
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
                        <h5 class="m-b-0 text-white">Add Category</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="validform forms-sample" id="category" novalidate="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Category Name <span class="required text-danger">*</span></label>
                                <input name="category_name" type="text" class="form-control category_name" placeholder="Category Name" required="" minlength="3" maxlength="50"/>
                                <?php echo form_error('category_name');?>
                            </div>
                            <div class="form-group">
                                <label>Category Image <span class="required text-danger">*</span></label>
                                <input type="file" name="category_upload" class="form-control category_upload"  required="" accept=".jpg,.png,.gif,.jpeg"/>
                                <?php echo form_error('category_upload');?>
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
                        <h5 class="m-b-0 text-white">Categories List</h5>
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-md-2">
                                <select class="form-control limitvalue" onchange="searchFilter('','<?php echo bildourl('viewCategory/');?>')">
                                    <?php $climit    =   $this->config->item("limit_values");
                                    foreach($climit as $ce){
                                    ?>
                                    <option value="<?php echo $ce;?>"><?php echo $ce;?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>  
                            <div class="col-sm-10">
                                <input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control" placeholder="Search" onkeyup="searchFilter('','<?php echo bildourl('viewCategory/');?>')">
                               <input type="hidden" id="orderby" name="orderby" value="">
                               <input type="hidden" id="tipoOrderby" name="tipoOrderby" value="">
                            </div> 
                        </div>
                        <div class="row port postList">
                            <?php $this->load->view("ajax_category");?>            
                        </div>
                     </div>
                </div>  
            </div>                        
        </div>          
    </div>
</div>