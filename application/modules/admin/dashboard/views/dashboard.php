            <div class="container-fluid">
               
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Dashboard</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                             </ol>
                        </div>
                    </div>
                </div>
                 
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-2">
                       <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="ti-user"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?php echo $this->vendor_model->cntviewvendors();?></h3>
                                        <h5 class="text-muted m-b-0">Vendors</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xlg-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info"><i class="fa fa-users"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?php echo $this->customer_model->cntviewcustomers();?></h3>
                                        <h5 class="text-muted m-b-0">Customers </h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-danger"><i class="ti-menu"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?php echo $this->category_model->cntviewCategory();?></h3>
                                        <h5 class="text-muted m-b-0">Categories</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-2">
                       <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info"><i class="ti-layout-list-thumb-alt"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?php echo $this->category_model->cntviewsubCategory();?></h3>
                                        <h5 class="text-muted m-b-0">Sub Categories</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
                
            </div>