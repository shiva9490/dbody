<?php $country = $this->session->userdata("currency_code");?>
<!DOCTYPE html>
<html lang="en-US" itemscope="itemscope">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php echo isset($metadesc)?$metadesc:"";?>">
        <meta name="keywords" content="<?php echo isset($metakeys)?$metakeys:"";?>"> 
        <title><?php echo sitedata("site_name");?></title> 
        <link rel="shortcut icon" type="image/png" href="<?php echo $this->config->item("val_url");?>images/favicon.png" />
        <link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>css/all.min.css">
        <link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>css/animate.css">
        <link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>css/swiper.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("val_url");?>css/slick.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item("val_url");?>css/slick-theme.css">
        <link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>css/custom-select.css">
        <link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>js/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>css/style.css">
        <link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>css/bootstrap-datepicker3.min.css">
        <link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>css/jquery.timepicker.min.css">
    </head>
    <body id="top-page">
        <div class="container" >
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <center><img alt="" width="50%" src="<?php echo base_url().'assets/images/logo.png'?>"></center>
                    <div class="contact-form-area">
                        <?php $this->load->view("theme/success_error");?>
                        <form method="post" class="contact-form">
                            <div class="input-item">
                                <input type="password" name="password" placeholder="New Password">
                                <i class="fas fa-key"></i>
                                <?php echo form_error('password');?>
                            </div>
                            <div class="input-item">
                                <input type="password" name="cpassword" placeholder="Confirmation Password">
                                <i class="fas fa-key"></i>
                                <?php echo form_error('cpassword');?>
                            </div>
                            <div>
                                <button type="submit" name="submit" value="submit" class="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
        	</div>
        </div>
    </body>
    <script src='<?php echo $this->config->item("val_url");?>jquery.validate.js'></script>
    <script src='<?php echo $this->config->item("val_url");?>minikart.js'></script>