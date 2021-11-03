
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
                                <h5 class="m-b-0 text-white">Refer List</h5>
                            </div>
                            <div class="col-md-6">
                                <!--<a href="<?php echo base_url('Kart-Admin/Create-Refer')?>" style="float:right;" class="btn btn-xs btn-raised btn-primary waves-effect">+Create New</a>-->
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="port postList">
                                    <?php $this->load->view("ajax_refer");?>      
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