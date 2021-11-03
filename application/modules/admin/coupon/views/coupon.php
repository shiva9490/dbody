
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12">
                <?php $this->load->view('admin/success_error');?> 
            <div class="mail-box-container">                                    
                <div id="todo-inbox" class="accordion todo-inbox">
                     <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-body">                     
                        <div class="card">
                    <div class="card-header bg-info">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="m-b-0 text-white">Coupon List</h5>
                            </div>
                            <div class="col-md-6">
                                <a href="<?php echo base_url('Kart-Admin/Create-Coupon')?>" style="float:right;" class="btn btn-xs btn-raised btn-primary waves-effect">+Create New</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="get">
                            <div class="row form-group">
                                <div class="col-md-2">
                                    <select class="form-control limitvalue" onchange="searchFilter('','<?php echo $urlvalue;?>')">
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
                                            <input type="submit" name="search" id="submit" value="Search" class="btn btn-primary"/>
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </form> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="port postList">
                                    <?php $this->load->view("ajax_coupon");?>      
                                    <?php echo $this->ajax_pagination->create_links();?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                        </div>
                    </div>      
                </div>
            </div> 
        </div>
    </div>
</div>