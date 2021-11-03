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
                            <input type="text" class="form-control" name="reminder_title" Placeholder="Name *" value="<?php echo $view['reminder_title'];?>" required><br>
                            <select class="form-control" name="reminder_type" required>
                                <option value="">Select Occasion</option>
                                <?php 
                                    $occasion = $this->common_model->viewOccasion();
                                    foreach($occasion as $oc){
                                ?>
                                <option value="<?php echo $oc['occasion_id'];?>" <?php if($oc['occasion_id'] == $view['reminder_type']){echo 'selected';}?>><?php echo $oc['occasion'];?></option>
                                <?php } ?>
                            </select><br>
                            <input class="datepicker form-control" name="reminder_date" placeholder="Reminder Date" value="<?php echo date('d/m/Y', strtotime($view['reminder_date']));?>" data-date-format="dd/mm/yyyy" ><br>
                            <textarea class="form-control" name="reminder_desc" placeholder="Note..."><?php echo $view['reminder_desc'];?> </textarea><br>
                            <button class="btn btn-primary" name="submit" value="submit" type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>