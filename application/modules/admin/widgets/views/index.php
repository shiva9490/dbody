<?php
$cr     =   $this->session->userdata("create-widget");
$ur     =   $this->session->userdata("update-widget");
$dr     =   $this->session->userdata("delete-widget");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>

<div class="container-fluid">
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Widget</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item active">Widget</li>
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
                        <h5 class="m-b-0 text-white">Add Widget</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="validform forms-sample" id="role" novalidate="">
                            <div class="form-group">
                                <label>Widget Name<span class="required text-danger">*</span></label>
                                <input name="widget_display_name" type="text" class="form-control widget_display_name" placeholder="Widget Name" value="<?php echo set_value('widget_display_name');?>" required="" minlength="3" maxlength="50"/>
                                <?php echo form_error('widget_display_name');?>
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
                        <h5 class="m-b-0 text-white">Widgets List</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="get">
                            <div class="row form-group">
                                <div class="col-md-2">
                                    <select class="form-control limitvalue" onchange="searchFilter('','<?php echo bildourl('viewWidget/');?>')">
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
                                   <input type="hidden" id="orderby" name="orderby"  value="<?php echo $this->input->get("orderby");?>">
                                   <input type="hidden" id="tipoOrderby" name="tipoOrderby"  value="<?php echo $this->input->get("tipoOrderby");?>">
                                </div>
                                <div class="col-sm-2">
                                    <input type="submit" name="search" id="submit" value="Search" class="btn btn-primary"/>
                                </div>
                            </div>
                        </form>
                        <div class="row port postList">
                            <?php $this->load->view("ajax_widgets");?>                        
                            <?php echo $this->ajax_pagination->create_links();?>
                        </div>
                     </div>
                </div>  
            </div>                        
        </div>          
    </div>
</div>
      