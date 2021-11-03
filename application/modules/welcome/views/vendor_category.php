<?php $this->load->view('header'); ?>

<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h5 class="m-b-0 text-white">Add Category</h5></div>
                    <div class="card-body">
                      
                         <form action="" method="post" class="validform" id="category" novalidate="" enctype = "multipart/form-data" >
                                <?php $this->load->view("admin/success_error");?>
                                    <div class="form-group">
                                        <label>Category Name<span class="required text-danger">*</span></label>
                                        <input name="category_name" type="text" class="form-control category_name" placeholder="Category Name" required="" minlength="3" maxlength="50"/>
                                        <?php echo form_error('category_name');?>
                                    </div>
                                    <div class="form-group">
                                        <label>Category Image<span class="required text-danger">*</span></label>
                                        <input type="file" name="category_upload" class="form-control category_upload"  required="" accept=".jpg,.png,.gif,.jpeg"/>
                                        <?php echo form_error('category_upload');?>
                                    </div>
                                    <div class="form-actions form-group">
                                        <button type="submit" class="btn btn-custon-rounded-three btn-success" name="submit" value="submit"><i class="fa fa-check edu-checked-pro" aria-hidden="true"></i> Save</button>
                                    </div>
                            </form>
                    </div>
                </div>
            </div>
        
        
             <div class="col-md-8 col-sm-12 col-xs-12">
                   
                      <div class="card">
                          <div class="card-header bg-info">
                        <h5 class="m-b-0 text-white">Category List</h5></div>
                        <div class="card-body">
                            <form action="" method="get">
                              <div class="row form-group">
                                  <div class="col-md-2">
                                     <select class="form-control limitvalue" onchange="searchFilter('','<?php echo bildourl('viewCategory/');?>')">
                                    <?php $climit    =   $this->config->item("limit_values");
                                    foreach($climit as $ce){
                                    ?>
                                    <option value="<?php echo $ce;?>"><?php echo $ce;?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                  </div> 
                                    <div class="col-sm-10">
                                        <div class="row">
                                           <div class="col-md-9">
                                            <input type="text" id="FilterTextBox" name="keywords" class="form-control" placeholder="Search" value="<?php echo $this->input->get('keywords');?>"/>
                                            <input type="hidden" id="orderby" name="orderby" value="">
                                            <input type="hidden" id="tipoOrderby" name="tipoOrderby" value="">
                                           </div>
                                           <div class="col-sm-3">
                                            <input type="submit" name="search" id="submit" value="Search" class="btn btn-primary">
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </form> 
                             <hr>
                             <div class="col-md-12">
                             <div class="port postList">
                                             <?php $this->load->view("ajax_category");?>      
                                <?php echo $this->ajax_pagination->create_links();?>
                            </div>
                         </div>
                        </div>
                    </div>                        
                </div>          
            </div>
        </div>
    </div>


<footer id="colophon" class="site-footer">
<div class="copyright-bar" style="background-color: #fed700">
                    <div class="container">
                        <div class="pull-left flip copyright">&copy; <a href="">BILDO</a> - All Rights Reserved</div>
                        <div class="pull-right flip payment">
                            <div class="footer-payment-logo">
                                <ul class="cash-card card-inline">
                                    <li class="card-item"><img src="<?php echo $this->config->item("val_url");?>images/footer/payment-icon/1.png" alt="" width="52"></li>
                                    <li class="card-item"><img src="<?php echo $this->config->item("val_url");?>images/footer/payment-icon/2.png" alt="" width="52"></li>
                                    <li class="card-item"><img src="<?php echo $this->config->item("val_url");?>images/footer/payment-icon/3.png" alt="" width="52"></li>
                                    <li class="card-item"><img src="<?php echo $this->config->item("val_url");?>images/footer/payment-icon/4.png" alt="" width="52"></li>
                                    <li class="card-item"><img src="<?php echo $this->config->item("val_url");?>images/footer/payment-icon/5.png" alt="" width="52"></li>
                                </ul>
                            </div><!-- /.payment-methods -->
                        </div>
                    </div><!-- /.container -->
                </div><!-- /.copyright-bar -->
            </footer>
        
      
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/tether.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/owl.carousel.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/echo.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/wow.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/jquery.easing.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/jquery.waypoints.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item("val_url");?>js/electro.js"></script>

 