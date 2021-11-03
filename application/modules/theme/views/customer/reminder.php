<div class="page-header-section">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between justify-content-md-start">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url();?>">Home</a></li>
                    <li><span>/</span></li>
                    <li>Reminders</li>
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
            <div class="col-md-4">
                <div class="dashboard-body wishlist">
                    <div class="wishlist-header">
                        <h6>Add Reminders</h6>
                    </div>
                    <div class="wish-list-container" style="padding:15px;">
                        <form method="post">
                            <input type="text" class="form-control" name="reminder_title" Placeholder="Name *" required><br>
                            <select class="form-control" name="reminder_type" required>
                                <option value="">Select Occasion</option>
                                <?php 
                                    $occasion = $this->common_model->viewOccasion();
                                    foreach($occasion as $oc){
                                ?>
                                <option value="<?php echo $oc['occasion_id'];?>"><?php echo $oc['occasion'];?></option>
                                <?php } ?>
                            </select><br>
                            <input class="datepicker form-control" name="reminder_date" placeholder="Reminder Date" data-date-format="dd/mm/yyyy" ><br>
                            <textarea class="form-control" name="reminder_desc" placeholder="Note..."> </textarea><br>
                            <button class="btn btn-primary" name="submit" value="submit" type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <!-- dashboard-section start -->
                <section id="dashboard-nav">
                   <div class="container">
                        <div class="dashboard-body">
                            <div class="profile-address-book">
                                <h3 class="title">Reminders List</h3>
                                <ul class="address-list">
                                    <?php foreach($view as $v){
                                        $occasion  = $this->common_model->get_Occasion($v['reminder_type']);
                                    ?>
                                    <li>
                                        <div class="address-text">
                                            <h6><?php echo $v['reminder_title']?></h6>
                                            <p class="address">Date: <?php echo $v['reminder_date']?></p>
                                            <p class="address">Occasion:  <?php echo ($occasion[0]['occasion'] !="")?$occasion[0]['occasion']:'';?></p>
                                            <p class="address">Note:  <?php echo $v['reminder_desc']?></p>
                                        </div> 
                                        <div class="edit-delete-btn">
                                            <a class="edit" href="<?php echo base_url().'Update-Reminder/'.$v['reminder_id'];?>"  data-target="#address-edit"><i class="fas fa-edit"></i></a>
                                            <a class="delete" href="<?php echo base_url().'Delete-Reminder/'.$v['reminder_id'];?>"><i class="fas fa-trash-alt"></i></a>
                                        </div>   
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- dashboard-section end -->
            </div>
        </div>
    </div>
</section>