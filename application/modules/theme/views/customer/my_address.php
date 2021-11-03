<div class="page-header-section">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between justify-content-md-start">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url();?>">Home</a></li>
                    <li><span>/</span></li>
                    <li>My Address</li>
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
                <div class="profile-address-book">
                    <h3 class="title">Address Book</h3>
                    <form class="container mt-10">
                        <div class="row">
                            <div class="col-md-2">
                                <select class="form-control limitvalue" onchange="searchFilter('','<?php echo base_url('viewAddresscustomer/');?>')" name="limitvalue">
                                    <?php $climit    =   $this->config->item("limit_values");
                                    foreach($climit as $ce){
                                    ?>
                                    <option value="<?php echo $ce;?>"><?php echo $ce;?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>  
                            <div class="col-sm-8">
                                <input type="text" id="FilterTextBox" name="keywords" class="form-control" placeholder="Search" value="<?php echo $this->input->get("keywords");?>">
                               <input type="hidden" id="orderby" name="orderby" value="<?php echo isset($orderby)?$orderby:"";?>">
                               <input type="hidden" id="tipoOrderby" name="tipoOrderby" value="<?php echo isset($tipoOrderby)?$tipoOrderby:"";?>">
                            </div> 
                            <div class="col-sm-2">
                                <input name="search" type="submit" value="Search"/>
                            </div>
                        </div>
                    </form>
                    <ul class="address-list postList"><?php $this->load->view("customer/ajaxaddress");?></ul>
                </div>
            </div>
        </div>
    </div>
</section>