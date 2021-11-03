<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $this->config->item("admin_url");?>images/kart-logo.png">
    <title><?php echo sitedata("site_name");?></title>
    <link href="<?php echo $this->config->item("admin_url");?>dist/css/pages/login-register-lock.css" rel="stylesheet">
    <link href="<?php echo $this->config->item("admin_url");?>dist/css/style.min.css" rel="stylesheet">
    <style>
        .bg-f7a806{
            border-radius:10px;
            border:5px solid rgba(251,197,77,1);   
        }
        .login-box .form-control{
                background-image:none;
                border-radius:20px;
                border:1px solid #eaeaea;
                padding:0px 0.5rem;
        }
    </style>
<![endif]-->
</head>
<body class="skin-default card-no-border">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label"><?php echo sitedata("site_name");?> admin</p>
        </div>
    </div>
    <?php $this->load->view($content); ?>
    <script src="<?php echo $this->config->item("admin_url");?>node_modules/jquery/jquery-3.2.1.min.js"></script>
    <script src="<?php echo $this->config->item("admin_url");?>node_modules/popper/popper.min.js"></script>
    <script src="<?php echo $this->config->item("admin_url");?>node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>
    <script src="<?php echo $this->config->item("admin_url");?>dist/js/pages/jquery.min.js"></script> 
    <script src="<?php echo $this->config->item("admin_url");?>dist/js/pages/jquery.validate.js"></script> 
        <script>
            $(".loginform").validate({
                errorElement:"span",
                errorClass:"text-danger",
                errorPlacement: function (error, element) { 
                    error.insertAfter($(element)); 
                },
                password:{
                   required:true,
                   minlength: 5,
                   maxlength:10
                },
                messages:{
                    username:"Username is required",
                    password:{
                        required:"Password is required",
                        minlength:"Please enter more than 5 Characters",
                        maxlength:"Please enter less than 50 Characters"
                    }
                },
                highlight: function (element, errorClass) {
                    $(element).closest('.form-group').addClass('has-error');
                },
                unhighlight: function (element, errorClass) {
                    $(element).closest('.form-group').removeClass('has-error');
                }
            });
        </script>
</body>
</html>