<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $this->config->item("admin_url");?>images/favicon.png">
    <title><?php echo sitedata("site_name");?> :: <?php echo $title;?></title>
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="<?php echo $this->config->item("admin_url");?>node_modules/morrisjs/morris.css" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="<?php echo $this->config->item("admin_url");?>node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
    <link href="<?php echo $this->config->item("admin_url");?>node_modules/nestable/nestable.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo $this->config->item("admin_url");?>dist/css/style.min.css" rel="stylesheet">
    <link href="<?php echo $this->config->item("admin_url");?>node_modules/sweetalert/sweetalert.css" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="<?php echo $this->config->item("admin_url");?>dist/css/pages/dashboard1.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>js/jquery-ui.css">
</head>
<body class="skin-default fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label"><?php echo sitedata("site_name");?> admin</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
         <?php $this->load->view("admin/navbar");?>
        <?php $this->load->view("admin/sidebar");?>
        
         <div class="page-wrapper"> 
                <?php $this->load->view("$content");?>
        </div>  
        <footer class="footer">
            © 2019 <?php echo sitedata("site_name");?> by <a href="http://advitsoft.com" target="_blank">ADVIT</a>
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <div class="modal viewModal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo $this->config->item("admin_url");?>node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="<?php echo $this->config->item("admin_url");?>node_modules/popper/popper.min.js"></script>
    <script src="<?php echo $this->config->item("admin_url");?>node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo $this->config->item("admin_url");?>dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo $this->config->item("admin_url");?>dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo $this->config->item("admin_url");?>dist/js/sidebarmenu.js"></script>
    <script src="<?php echo $this->config->item("admin_url");?>node_modules/nestable/jquery.nestable.js"></script>
    <script src="<?php echo $this->config->item("admin_url");?>dist/js/custom.js"></script>
    <script src="<?php echo $this->config->item("admin_url");?>node_modules/tinymce/tinymce.min.js"></script>
    <script src='<?php echo $this->config->item("admin_url");?>node_modules/sweetalert/sweetalert.min.js'></script>
    <?php if($this->uri->segment("2") == "dashboard") { ?>
    <script src="<?php echo $this->config->item("admin_url");?>node_modules/raphael/raphael-min.js"></script>
    <script src="<?php echo $this->config->item("admin_url");?>node_modules/morrisjs/morris.min.js"></script>
    <script src="<?php echo $this->config->item("admin_url");?>node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo $this->config->item("admin_url");?>dist/js/dashboard1.js"></script>
    <?php } ?>
    <script>
    $(function(){
        tinymce.init({
                selector: 'textarea.texatval',
                height: 500,
                //menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code wordcount'
                ],
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    });
    var uri     =   '<?php echo $this->uri->segment("2");?>';
    $("."+uri).addClass("active");
    var menudepth    =   function(){
        $('#menu-form .dd').nestable({
            maxDepth:4
        }); 
        $('#menu-form .dd').on('change', function () {
                var data =  [];
                jQuery('.dd-item').each(function(){
                        var id 		= jQuery(this).attr('data-id');
                        var parent  = jQuery(this).parent().parent().attr('data-id');
                        if(typeof parent == 'undefined')
                                parent = 0;
                        var menu = {'id':id,'parent':parent};
                        data.push(menu);
                });
                $(".top_menu").val(JSON.stringify(data)); 
        });
        $('.row_nest .pagewidgets .dd,.row_nest .left_widget .dd,.row_nest .contet_widget .dd,.row_nest .right_widget .dd').nestable({
                maxDepth:1
        });
    }
    var menuInit    =   function(){  
        $('.row_nest .left_widget .dd').on('change', function () {
                var lefst = []; 
                $('.row_nest .left_widget .dd-item').each(function(){
                        var lid      =   $(this).attr('data-id');  
                        lefst.push(lid);  
                });
                $(".left_contentval").val(lefst.join(","));
        });
        $('.row_nest .contet_widget .dd').on('change', function () {
                var cnt = []; 
                $('.row_nest .contet_widget .dd-item').each(function(){
                        var lid      =   $(this).attr('data-id');  
                        cnt.push(lid);  
                });
                $(".page_conentval").val(cnt.join(",")); 
        });
        $('.row_nest .right_widget .dd').on('change', function () {
                 var dcnt = []; 
                $('.row_nest .right_widget .dd-item').each(function(){
                        var lid      =   $(this).attr('data-id');  
                        dcnt.push(lid);  
                });
                $(".right_contentval").val(dcnt.join(",")); 
        });
    }
    $(function(){ 
            menudepth();
            menuInit();
    });
    </script>
    <script src="<?php echo $this->config->item("admin_url");?>dist/js/bildo.js"></script> 
    <script src="<?php echo $this->config->item("admin_url");?>dist/js/pages/jquery.validate.js"></script>
    <script src='<?php echo $this->config->item("val_url");?>js/jquery-ui.js'></script>
    
</body>

</html>