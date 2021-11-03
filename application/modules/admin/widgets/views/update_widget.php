<?php
$cr     =   $this->session->userdata("create-role");
$ur     =   $this->session->userdata("update-role");
$dr     =   $this->session->userdata("delete-role");
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
                <li class="breadcrumb-item"><a href="<?php echo bildourl('widgets');?>">Widgets</a></li>
                <li class="breadcrumb-item active">Update Widget</li>
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
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h5 class="m-b-0 text-white">Update Widget : <?php echo $view['widget_display_name'];?></h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="validform forms-sample" id="role" novalidate="">
                            <div class="form-group">
                                <?php
                                    $widget_alias_name  =   $view['widget_alias_name'];
                                    $filename   =   sitedata("widget_path")."/".$widget_alias_name.".php";
                                    $dta  =   read_file($filename);
                                ?>
                                <label>Widget Name <span class="required text-danger">*</span></label>
                                <input type="hidden" value="<?php echo $widget_alias_name;?>" name="widget_alias_name"/>
                                <textarea class="form-control" name="widgetvalue" rows="15"><?php echo $dta;?></textarea> 
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-custon-rounded-three btn-success" name="submit" value="submit"> Submit</button>
                            </div>
                       </form>
                    </div>
                </div>
            </div>                        
        </div>          
    </div>
</div>
      