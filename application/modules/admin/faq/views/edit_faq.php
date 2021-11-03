<script src="<?php echo $this->config->item("nafasassets");?>ckeditor/ckeditor.js"></script>
<script src="<?php echo $this->config->item("nafasassets");?>ckeditor/samples/js/sample.js"></script>
<link rel="stylesheet" href="<?php echo $this->config->item("nafasassets");?>ckeditor/samples/css/samples.css">
<!-- START: Breadcrumbs-->
<div class="row ">
	<div class="col-12  align-self-center">
		<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
			<div class="w-sm-100 mr-auto"><h4 class="mb-0">Edit Faq</h4></div>

			<ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
				<li class="breadcrumb-item">Home</li>
				<li class="breadcrumb-item active"><a href="#">Edit Faq</a></li>
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
						<h4 class="card-title">Edit Faq</h4> 
					</div>
					<div class="col-md-6">
						
					</div>
				</div>
			</div>
			<div class="card-content">
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<?php $this->load->view("success_error");?>
							<?php foreach($edit_faq as $e){?>
							<form class="needs-validation" action="" method="post" enctype="multipart/form-data" novalidate>
							    <div class="row">
							        <div class="col-md-6">
        								<div class="form-row">
        									<div class="col-md-12 mb-3">
        										<label for="validationCustom03">Faq Name</label>
        										<input type="text" class="form-control" id="validationCustom03" name="faq_name"  placeholder="Faq Name" value="<?php echo $e->faq_name; ?>" required>
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
        										<label for="validationCustom03">Faq Name</label>
        										<input type="text" class="form-control" id="validationCustom03" name="faq_arabic_name"  placeholder="Faq Arabic Name" value="<?php echo $e->faq_arabic_name; ?>" required>
        										<span class="error"><?php echo form_error('faq_arabic_name'); ?></span>
        										<div class="invalid-feedback">
        											Please provide a valid Faq Arabic Name.
        										</div>
        									</div>
        								</div>
    								</div>
    								<div class="col-md-6">
        								<div class="form-row">
        									<div class="col-md-12 mb-3">
        										<label for="validationCustom03">Faq description <span class="input-required">* </span></label>
        										<textarea name="faq_desc" class="form-control" required id="editor1"><?php echo $e->faq_desc;?></textarea>
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
        										<label for="validationCustom03">Faq description <span class="input-required">* </span></label>
        										<textarea name="faq_arabic_desc" class="form-control" required id="editor2"><?php echo $e->faq_arabic_desc;?></textarea>
        										<span class="error"><?php echo form_error('faq_arabic_desc'); ?></span>
        										
        										<div class="invalid-feedback">
        											Please provide a valid Faq Arabic description.
        										</div>
        									</div>
        								</div>
    								</div>
    							</div>
								<a href="<?php echo adminurl("Faq");?>" class="btn btn-warning">Back </a>
								<button class="btn btn-primary"  style="float: right;" type="submit" name="submit" value="submit">Update</button>
							</form>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>                  
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	$(".image").change(function () {
		if (typeof (FileReader) != "undefined") {
			var dvPreview = $("#divImageMediaPreview");
			dvPreview.html("");            
			$($(this)[0].files).each(function () {
				var file = $(this);                
					var reader = new FileReader();
					reader.onload = function (e) {
						var img = $("<img />");
						img.attr("style", "width: 150px; height:100px; padding: 10px");
						img.attr("src", e.target.result);
						dvPreview.append(img);
					}
					reader.readAsDataURL(file[0]);                
			});
		} else {
			alert("This browser does not support HTML5 FileReader.");
		}
	});
</script>
<script>
	initSample();
</script>
<script>
	function onlyNumberKey(evt){
		// Only ASCII charactar in that range allowed 
		var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
		if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
			return false; 
		return true;
	} 
</script>
<script>
	$(".image").change(function () {
		if (typeof (FileReader) != "undefined") {
			var dvPreview = $("#divImageMediaPreview");
			dvPreview.html("");            
			$($(this)[0].files).each(function () {
				var file = $(this);                
				var reader = new FileReader();
				reader.onload = function (e) {
					var img = $("<img />");
					img.attr("style", "width: 150px; height:100px; padding: 10px");
					img.attr("src", e.target.result);
					dvPreview.append(img);
				}
				reader.readAsDataURL(file[0]);                
			});
		} else {
			alert("This browser does not support HTML5 FileReader.");
		}
	});
</script>