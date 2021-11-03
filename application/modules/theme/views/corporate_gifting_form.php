<div class="col-md-7 mx-auto pt-5 mt-5">
<div class="card mt-5 mb-2 bg-white">
    <div class="card-header newsletter-heading" align="center">
        <h5><?php echo $title;?></h5>
    </div>
    <div class="card-body">
        <?php $this->load->view("admin/success_error");?>
        <form method="post"  enctype="multipart/form-data">
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
            <?php echo form_error("name");?>
          </div>
          <div class="form-group">
            <label>Email address</label>
            <input type="email" class="form-control" name="email" placeholder="Enter your email">
            <?php echo form_error("email");?>
            <small id="emailHelp" class="form-text text-muted">This email used for contact you.</small>
          </div>
          <div class="form-group">
            <label>Mobile Number</label>
            <input type="text" class="form-control" name="mobile" placeholder="Enter your mobile number" required>
            <?php echo form_error("mobile");?>
            <small id="emailHelp" class="form-text text-muted">This mobile number used for contact you</small>
          </div>
          <div class="form-group">
            <label>Company Name</label>
            <input type="text" class="form-control" name="company_name" placeholder="Enter your company name" required>
            <?php echo form_error("company_name");?>
          </div>
          <div class="form-group">
            <label>Role</label>
            <input type="text" class="form-control" name="company_role" placeholder="Enter your role in company" required>
            <?php echo form_error("company_role");?>
          </div>
          <div class="form-group">
                <div class="custom-file-container" data-upload-id="mySecondImage">
					<label>Photo Samples (Allow Multiple) * <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
					<label class="custom-file-container__custom-file" >
						<input type="file" class="custom-file-container__custom-file__custom-file-input" name="file[]" multiple required>
						<input type="hidden"  />
						<span class="custom-file-container__custom-file__custom-file-control"></span>
						<div class="invalid-feedback">
							Please provide a valid Resturant Images.
						</div>
					</label>
					<div class="custom-file-container__image-preview"></div>
				</div>	
          </div>
          <div class="form-group">
            <label>Description (if any)</label>
            <textarea class="form-control" name="description" placeholder="write description here (if any)"></textarea>
            <?php echo form_error("description");?>
          </div>
          
          <input type="submit" class="btn btn-success" name="submit" value="Submit">
        </form>
    </div>
    </div>
</div>
