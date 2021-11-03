<?php $country = $this->session->userdata("currency_code");?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo sitedata("site_name");?></title> 
	<meta name="description" content="<?php echo isset($metadesc)?$metadesc:"";?>">
    <meta name="keywords" content="<?php echo isset($metakeys)?$metakeys:"";?>"> 
	<meta name="author" content="Themexriver">
	<link rel="shortcut icon" href="<?php echo $this->config->item("val_url");?>img/logo/ficon.png" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>css/fontawesome-all.css">
	<link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>css/flaticon.css">
	<link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>css/animate.css">
	<link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>css/video.min.css">
	<link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>css/rs6.css">
	<link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>assets/css/zoomit.css">
	<link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>css/slick.css">
	<link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>css/slick-theme.css">
	<link rel="stylesheet" href="<?php echo $this->config->item("val_url");?>css/style.css">
</head>
<body class="organio-wrapper">
	<div id="preloader"></div>
	<div class="up">
		<a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
	</div>
		<?php $this->load->view("theme/header");?>
		<div class="page-layout">
			<?php// include_widget("category_sidebar");?>
			<div class="main-content-area">
				<!--- Content Section -->
				<?php $this->load->view($content);?>
				<!--- Content Section -->
				<!-- footer section -->
				<?php $this->load->view("theme/footer");?>
				<!-- footer section -->
			</div>
		</div>		
	<!-- For Js Library -->
	<script src="<?php echo $this->config->item("val_url");?>js/jquery.min.js"></script>
	<script src="<?php echo $this->config->item("val_url");?>js/bootstrap.min.js"></script>
	<script src="<?php echo $this->config->item("val_url");?>js/popper.min.js"></script>
	<script src="<?php echo $this->config->item("val_url");?>js/jquery.magnific-popup.min.js"></script>
	<script src="<?php echo $this->config->item("val_url");?>js/appear.js"></script>
	<script src="<?php echo $this->config->item("val_url");?>js/slick.js"></script>
	<script src="<?php echo $this->config->item("val_url");?>js/jquery.counterup.min.js"></script>
	<script src="<?php echo $this->config->item("val_url");?>js/waypoints.min.js"></script>
	<script src="<?php echo $this->config->item("val_url");?>js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="<?php echo $this->config->item("val_url");?>js/wow.min.js"></script>
	<script src="<?php echo $this->config->item("val_url");?>js/imagesloaded.pkgd.min.js"></script>
	<script src="<?php echo $this->config->item("val_url");?>js/jquery.zoomit.min.js"></script>
	<script src="<?php echo $this->config->item("val_url");?>js/jquery.inputarrow.js"></script>
	<script src="<?php echo $this->config->item("val_url");?>js/parallax-scroll.js"></script>
	<script src="<?php echo $this->config->item("val_url");?>js/rbtools.min.js"></script>
	<script src="<?php echo $this->config->item("val_url");?>js/rs6.min.js"></script>
	<script src="<?php echo $this->config->item("val_url");?>js/script.js"></script>	
	<script src='<?php echo $this->config->item("val_url");?>minikart.js'></script>
</body>
</html>		