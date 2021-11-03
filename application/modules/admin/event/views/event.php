<?php
$cr     =   $this->session->userdata("create-occasion");
$ur     =   $this->session->userdata("update-occasion");
$dr     =   $this->session->userdata("delete-occasion");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>

<div class="container-fluid">
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Occasion</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item active">Occasion</li>
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header bg-success d-flex justify-content-between">
                        <h5 class="m-b-0 text-white">Occasion List</h5>
                        <a href="<?php echo base_url('Kart-Admin/Create-Event');?>" class="btn btn-primary btn-small float-right">Create Occasion</a>
                    </div>
                    <div class="card-body">
                        <form method="get">
                            <div class="row form-group">
                                <div class="col-md-2">
                                    <select name="limitvalue" class="form-control limitvalue" onchange="searchFilter('','<?php echo bildourl('viewEvent/');?>')">
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
                            <?php echo $this->load->view("ajax_event");?>
                        </div>
                    </div>
                </div>  
            </div>                        
        </div>          
    </div>
</div>
</div>