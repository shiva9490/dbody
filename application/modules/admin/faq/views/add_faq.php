<script src="<?php echo $this->config->item("nafasassets");?>ckeditor/ckeditor.js"></script>
<script src="<?php echo $this->config->item("nafasassets");?>ckeditor/samples/js/sample.js"></script>
<link rel="stylesheet" href="<?php echo $this->config->item("nafasassets");?>ckeditor/samples/css/samples.css">
<style>
.dt-buttons.btn-group.flex-wrap{
	display:none;
}
</style>
<!-- START: Breadcrumbs-->
<div class="row ">
	<div class="col-12  align-self-center">
		<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
			<div class="w-sm-100 mr-auto"><h4 class="mb-0">Add Faq</h4></div>

			<ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
				<li class="breadcrumb-item">Home</li>
				<li class="breadcrumb-item active"><a href="#">Add Faq</a></li>
			</ol>
		</div>
	</div>
</div>
<!-- END: Breadcrumbs-->

<!-- START: Card Data-->
<div class="row">
	<div class="col-12 mt-3">
		<div class="card">
			<div class="card-header  justify-content-between align-items-center">     
				<div class="row">
					<div class="col-md-6">
						<h4 class="card-title">Add Faq</h4> 
					</div>
					<div class="col-md-6">
					</div>
				</div>
			</div>
			<div class="card-body">
				<?php $this->load->view("success_error");?>
				<form class="needs-validation" action="" method="post" enctype="multipart/form-data" novalidate>
					<div class="row">
					    <div class="col-md-6">
        					<div class="form-row">
        						<div class="col-md-12 mb-3">
        							<label for="validationCustom03">Faq Name</label>
        							<input type="text" class="form-control" id="validationCustom03" name="faq_name"  placeholder="faq Name" value="<?php echo set_value('faq_name'); ?>" required>
        							<span class="error"><?php echo form_error('faq_name'); ?></span>
        							<div class="invalid-feedback">
        								Please provide a valid Faq Name.
        							</div>
        						</div>
        					</div>
				        </div>
				        <div class="col-md-6">
        					<div class="form-row">
        						<div class="col-md-12 mb-3">
        							<label for="validationCustom03">Faq Arabic Name</label>
        							<input type="text" class="form-control" id="validationCustom03" name="faq_arabic_name"  placeholder="faq Arabic Name" value="<?php echo set_value('faq_arabic_name'); ?>" required>
        							<span class="error"><?php echo form_error('faq_arabic_name'); ?></span>
        							<div class="invalid-feedback">
        								Please provide a valid Faq Name.
        							</div>
        						</div>
        					</div>
				        </div>
				        <div class="col-md-6">
        					<div class="form-row">
        						<div class="col-md-12 mb-3">
        							<label for="validationCustom03">Faq Description<span class="input-required">* </span></label>
        							<textarea name="faq_desc" class="form-control" required id="editor1"></textarea>
        							<span class="error"><?php echo form_error('faq_desc'); ?></span>
        							<div class="invalid-feedback">
        								Please provide a valid Faq description.
        							</div>
        						</div>
        					</div>
    					</div>
    					<div class="col-md-6">
        					<div class="form-row">
        						<div class="col-md-12 mb-3">
        							<label for="validationCustom03">Faq Arabic Description<span class="input-required">* </span></label>
        							<textarea name="faq_arabic_desc" class="form-control" required id="editor2"></textarea>
        							<span class="error"><?php echo form_error('faq_arabic_desc'); ?></span>
        							<div class="invalid-feedback">
        								Please provide a valid Faq Arabic description.
        							</div>
        						</div>
        					</div>
    					</div>
    				</div>
					<a href="<?php echo adminurl("faq");?>" class="btn btn-warning">Back</a>
					<button class="btn btn-primary"  style="float: right;" type="submit" name="submit" value="submit"> Submit</button>
				</form>
						
			</div>
		</div>
	</div>                  
</div>

<script>
	initSample();
</script>