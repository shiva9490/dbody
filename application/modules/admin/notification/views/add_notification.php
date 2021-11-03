<?php
$ct     =   $this->session->userdata("create-notification");
?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Popup Notifications</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li>
                    <li class="breadcrumb-item active">Popup Notifications</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <?php $this->load->view("admin/success_error");?>
            </div>
            <?php if($ct == '1'){?>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h5 class="m-b-0 text-white">Add Popup Notification</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="validform" id="category" novalidate="" enctype = "multipart/form-data" >
                            <div class="form-group">
                                <label>Popup Notification Title</label>
                                <input name="notification_title" type="text" class="form-control notification_title" placeholder="Popup Notification Title" minlength="3" maxlength="50"/>
                                <?php echo form_error('notification_title');?>
                            </div>
                            <div class="form-group">
                                <label>Popup Notification Image (1348 X 500px) <span class="required text-danger">*</span></label>
                                <input type="file" name="notification_image" class="form-control notification_image"  required="" accept=".jpg,.png,.gif,.jpeg"/>
                                <?php echo form_error('notification_image');?>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-custon-rounded-three btn-success" name="submit" value="submit"><i class="fa fa-check edu-checked-pro" aria-hidden="true"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="col-md-8 col-sm-12 col-xs-12"> 
                <div class="card">
                    <div class="card-header bg-info">
                    <h5 class="m-b-0 text-white">Popup Notifications List</h5></div>
                    <div class="card-body">
                        <form action="" method="get">
                            <div class="row form-group">
                                <div class="col-md-2">
                                    <select class="form-control limitvalue" onchange="searchFilter('','<?php echo bildourl('viewNotifications/');?>')">
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
                                    <div class="row">
                                       <div class="col-md-9">
                                            <input type="text" id="FilterTextBox" name="keywords" class="form-control" placeholder="Search" value="<?php echo $this->input->get('keywords');?>"/>
                                            <input type="hidden" id="orderby" name="orderby" value="">
                                            <input type="hidden" id="tipoOrderby" name="tipoOrderby" value="">
                                       </div>
                                       <div class="col-sm-3">
                                            <input type="submit" name="search" id="submit" value="Search" class="btn btn-primary"/>
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </form> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="port postList">
                                    <?php $this->load->view("ajax_notification");?>      
                                    <?php echo $this->ajax_pagination->create_links();?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                        
            </div>          
        </div>
    </div>
</div>
