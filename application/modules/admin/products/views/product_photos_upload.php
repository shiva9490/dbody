<link href="<?php echo $this->config->item("admin_url");?>dist/css/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
                    <?php $this->load->view("admin/success_error");?>
                    <form  method="post" enctype="multipart/form-data">
                        <div class="container">
                            <div class="row">
								<div class="col-lg-10 mx-auto mt-3" align="right">
    								   <button type="submit" class="btn btn-custon-rounded-three btn-success" name="submit" value="submit"> Submit</button>
								</div>
								<div class="col-lg-10 mx-auto mt-3">
									<div class="custom-file-container" data-upload-id="mySecondImage">
										<label>Product Images (Allow Multiple) * <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
										<label class="custom-file-container__custom-file" >
											<input type="file" class="custom-file-container__custom-file__custom-file-input" name="file[]" multiple required>
											<input type="hidden"  />
											<span class="custom-file-container__custom-file__custom-file-control"></span>
											<div class="invalid-feedback">
												Please provide a valid Resturant Images.
											</div>
										</label>
										<pre><br>Note :- image Name should be same as product Id (ex : VEPR000001), if multiple images are there then rename it with id_count
										</pre>
										<div class="custom-file-container__image-preview"></div>
									</div>						  
								</div> 
							</div>
                        </div>
                    </form>        

<script src="<?php echo $this->config->item("admin_url");?>dist/js/file-upload-with-preview.min.js"></script>
<script>
    
        //Second upload
        var secondUpload = new FileUploadWithPreview('mySecondImage')
		//3rd upload
</script>