<?php
$cr     =   $this->session->userdata("create-measure");
$ur     =   $this->session->userdata("update-measure");
$dr     =   $this->session->userdata("delete-measure");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>
<div class="container-fluid">
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Measure</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item active">Measure</li>
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
                        <h5 class="m-b-0 text-white">Add Measure</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="validform" id="category" novalidate="" >
                            <div class="form-group">
                                <label>Measure Unit<span class="required text-danger">*</span></label>
                                <input name="measure_unit" type="text" class="form-control measure_unit" placeholder="Measure Unit" required="" minlength="1" maxlength="50" autocomplete="off" />
                                <p id="msg"></p>
                                <?php echo form_error('measure_unit');?>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-success" name="submit" value="submit">Submit</button>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header bg-success">
                        <h5 class="m-b-0 text-white">Measures List</h5>
                    </div>
                    <div class="card-body">
                        <form method="get" action="">
                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <select name="limitvalue" class="form-control limitvalue" onchange="searchFilter('','<?php echo bildourl('viewMeasure/');?>')">
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
                            <?php $this->load->view("ajax_measure");?>          
                        </div>
                     </div>
                </div>  
            </div>                        
        </div>          
    </div>
</div>
      