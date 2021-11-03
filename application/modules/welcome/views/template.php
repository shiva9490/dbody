

           <?php $this->load->view('header'); ?>

            <?php $this->load->view('nav'); ?>
            
            
            <?php $this->load->view("$content");?>

            <?php $this->load->view('footer'); ?>

        </div><!-- #page -->

        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/tether.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/owl.carousel.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/echo.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/wow.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/jquery.easing.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/jquery.waypoints.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/electro.js"></script>

    </body>
</html>