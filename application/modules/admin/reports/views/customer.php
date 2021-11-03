<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Customers</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li>
                    <li class="breadcrumb-item active">Customers</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <?php $this->load->view("admin/success_error");?>
            </div> 
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12"> 
                <div class="card">
                    <div class="card-header bg-info">
                    <h5 class="m-b-0 text-white">Customer Report</h5></div>
                    <div class="card-body">
                        <form action="" method="get">
                            <div class="row form-group">
                                <div class="col-md-2">
                                    <label>Per Page</label>
                                    <select class="form-control limitvalue" onchange="searchFilter('','<?php echo bildourl('viewCustomerReport/');?>')">
                                        <?php $climit    =   $this->config->item("limit_values");
                                        foreach($climit as $ce){
                                            ?>
                                            <option value="<?php echo $ce;?>"><?php echo $ce;?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div> 
                                <div class="col-md-2 form-group">
                                    <label>From Date </label>
                                    <input type="date" id="fromDate" name="fromDate" class="form-control" placeholder="dd-mm-yyyy" value="<?php echo $this->input->get('fromDate');?>"/>
                                </div> 
                                <div class="col-md-2 form-group">
                                    <label>To Date </label>
                                    <input type="date" id="toDate" name="toDate" class="form-control" placeholder="dd-mm-yyyy" value="<?php echo $this->input->get('toDate');?>"/>
                                </div> 
                                <div class="col-md-2 form-group">
                                    <label>Status </label>
                                    <select class="form-control" id="Statuss" name="status"  onchange="searchFilter('','<?php echo bildourl('viewCustomerReport/');?>')">
                                        <option value=''>select status</option>
                                    <?php
                                    foreach($this->config->item('orderstatus') as $s){?>
                                        <option value="<?php echo $s;?>" <?php if($s==$status){echo 'selected="selected"';} ?>><?php echo $s;?></option>   
                                    <?php } 
                                    ?>
                                    </select>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label>Pay Mode</label>
                                    <select class="form-control" id="pay_mode" name="pay_mode"  onchange="searchFilter('','<?php echo bildourl('viewCustomerReport/');?>')">
                                        <option value=''>select status</option>
                                    <?php
                                    foreach($this->config->item('pay_mode') as $s){?>
                                        <option value="<?php echo $s;?>" <?php if($s==$pay_mode){echo 'selected="selected"';} ?>><?php echo $s;?></option>   
                                    <?php } 
                                    ?>
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                       <div class="col-md-5 form-group">
                                            <input type="text" id="FilterTextBox" name="keywords" class="form-control" placeholder="Search" value="<?php echo $this->input->get('keywords');?>"/>
                                            <input type="hidden" id="orderby" name="orderby" value="">
                                            <input type="hidden" id="tipoOrderby" name="tipoOrderby" value="">
                                       </div>
                                       <div class="col-sm-4">
                                            <input type="submit" name="search" id="submit" value="Generate" class="btn btn-primary"/>
                                            <input type="submit" name="excel" id="submit" value="Excel" class="btn btn-primary"/>
                                            <input type="submit" name="pdf" id="submit" value="PDF" class="btn btn-primary"/>
                                       </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </form> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="port postList">
                                    <?php $this->load->view("ajaxcust");?>        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                        
            </div>          
        </div>
    </div>
</div>