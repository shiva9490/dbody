<?php  if($this->session->flashdata("err") != ""){?>
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="fa fa-times-circle"></i> <?php echo $this->session->flashdata("err");?> </h4>
</div>
<?php }  if($this->session->flashdata("suc") != ""){?> 
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="fa fa-check-circle"></i>  <?php echo $this->session->flashdata("suc");?> </h4>
</div>
<?php } if($this->session->flashdata("war") != ""){?> 
<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="fa fa-warning"></i>  <?php echo $this->session->flashdata("war");?> </h4>
</div>
<?php } if($this->session->flashdata("info") != ""){?> 
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="fa fa-info-circle"></i>  <?php echo $this->session->flashdata("info");?> </h4>
</div>
<?php }?>