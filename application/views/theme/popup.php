<?php 
$psm['where_condition']  =   "notification_abc = 'Active'";
$vue    =   $this->notification_model->viewNotifications($psm);
//print_r($vue);
foreach($vue as $vv){
    $vv   = (array) $vv;
    $image    =  $this->config->item("upload_url")."notification-uploads/".$vv['notification_image'];
} if(!empty($image)){
?>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="<?php echo $image;?>" alt="product">
      </div>
      
    </div>
  </div>
</div>
<script>
    $('#exampleModalCenter').modal({
      show: true
    })
</script>
<?php } ?>