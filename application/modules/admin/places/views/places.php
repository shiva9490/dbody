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
        <h4 class="text-themecolor">Places</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item active">Places</li>
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
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header bg-success">
                        <h5 class="m-b-0 text-white">Places List</h5>
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
                            <?php $this->load->view("ajax_pincode");?>          
                        </div>
                     </div>
                </div>  
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header bg-success">
                        <h5 class="m-b-0 text-white">Places Adding List</h5>
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
                        <div class="table-responsive"> 
                            <table class="table table-striped table-hover js-basic-example tablehrcover" id="myTable">
                                <thead>
                                    <tr id="filters">
                                        <th>S.No</th>
                                        <th><a href="javascript:void(0);" data-type="order" data-field="pincode_district" urlvalue="<?php echo bildourl('viewPincode/');?>" onclick="getdatafiled($(this))">District Name <i class="fa fa-sort pull-right"></i></a> </th>
                                        <?php if($ct == '1'){?>
                                        <th>Action</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                    if(count($views) > 0){
                                        foreach($views as $ve){
                                    ?>
                                    <tr>
                                        <td><?php echo $limit++;?></td>
                                        <td><?php echo $ve->pincode_district;?></td>
                                        <?php if($ct == '1'){?>
                                        <td>
                                            <?php if($ur == '1'){?>
                                            <form method="post" action="<?php echo bildourl("Update-Pincode/".$ve->pincode_district);?>" method="POST">
                                                <input type="hidden" name="district" value="<?php echo $ve->pincode_district;?>">
                                                <input type="hidden" name="status" value="0">
                                                <button type="submit" name="submit" value="submit" class="btn btn-sm btn-success tip-left">Remove</button>
                                            </form>
                                            <?php } ?>
                                        </td>
                                        <?php }  ?>
                                    </tr>
                                        <?php
                                        }
                                    }else {
                                        echo '<tr class="text-center"><td colspan="5">Places are  not available</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>          
                    </div>
                </div>
            </div>
        </div>          
    </div>
</div>
      