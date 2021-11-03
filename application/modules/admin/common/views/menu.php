<div class="container-fluid">
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Home Menu</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo bildourl('dashboard');?>">Home</a></li> 
                <li class="breadcrumb-item active">Home Menu</li>
            </ol>
        </div>
    </div>
 </div>
</div>

<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
        <?php $this->load->view("admin/success_error");?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                         <h5 class="m-b-0 text-white">Menu</h5>
                     </div>
                    <div class="card-body">
                        <form id="menu-form" action="" method="post">    
                            <input type="hidden" name="top_menu" id="top_menu" class='top_menu' values='<?php echo $menupage;?>'> 
                            <div class="dd">
                                <ol class="dd-list">
                                    <?php echo $this->common_model->menudata($menupage);?>
                                </ol>
                            </div>  
                        </form>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>