<div class="page-header-section">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between justify-content-md-start">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url();?>">Home</a></li>
                    <li><span>/</span></li>
                    <li><?php echo $title;?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section id="dashboard-nav" class="dashboard-section">
    <div class="container">
       <?php $this->load->view("customer_dashboard");?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="dashboard-body wishlist">
                    <div class="wishlist-header">
                        <h6>Update Profile</h6>
                    </div>
                    <div class="wish-list-container" style="padding:15px;">
                        <form method="post">
                            <input type="text" class="form-control" name="customer_name" value="<?php echo $view['customer_name']?>" Placeholder="Name *" required><br>
                            <input type="email" class="form-control" name="customer_email_id" value="<?php echo $view['customer_email_id']?>" Placeholder="Email Id *" required><br>
                            <input type="no" class="form-control" name="customer_mobile" value="<?php echo $view['customer_mobile']?>" Placeholder="Mobile No *" required><br>
                            <button class="btn btn-primary" name="submit" value="submit" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>