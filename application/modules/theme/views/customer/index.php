<div class="page-header-section">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between justify-content-md-start">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url();?>">Home</a></li>
                    <li><span>/</span></li>
                    <li>Profile</li>
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
        <div class="dashboard-body">
            <div class="profile">
                <h5 class="title">Your Profile <a title="Edit Profile" id="edit" class="edit" href="<?php echo base_url('Update-Profile')?>"><i class="fas fa-edit"></i></a></h5>
                <ul class="list-profile-info list-unstyled">
                    <li>
                        <span class="title">Your Name</span>
                        <span class="desc"><?php echo  $view["customer_name"];?></span>
                    </li>
                    <li>
                        <span class="title">Email</span>
                        <span class="desc"><?php echo  $view["customer_email_id"];?></span>
                    </li>
                    <li>
                        <span class="title">Mobile</span>
                        <span class="desc"><?php echo  $view["customer_mobile"];?></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>