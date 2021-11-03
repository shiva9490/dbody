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
            
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header bg-success">
                        <h5 class="m-b-0 text-white">Products Prices List</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="formvalid container" id="" novalidate=""  enctype="multipart/form-data">  
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" name="venid" value="<?php echo $this->uri->segment('3');?>">
                                    <label>Product Image (650 X 650px)<span class="required text-danger">*</span></label>
                                    <input type="file" name="product_upload[]" multiple="" class="form-control product_upload"  required="" accept=".jpg,.png,.gif,.jpeg" multiple=""/>
                                    <?php echo form_error('product_upload[]');?>
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
                            <?php $this->load->view("ajax_product_images");?>          
                        </div>
                     </div>
                </div>  
            </div>                        
        </div>          
    </div>
</div>