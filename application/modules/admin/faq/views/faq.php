<style>
.dt-buttons.btn-group.flex-wrap{
	display:none;
}
</style>
<!-- START: Breadcrumbs-->
<div class="row ">
	<div class="col-12  align-self-center">
		<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
			<div class="w-sm-100 mr-auto"><h4 class="mb-0">Faq List</h4></div>

			<ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
				<li class="breadcrumb-item">Home</li>
				<li class="breadcrumb-item active"><a href="#">Faq List</a></li>
			</ol>
		</div>
	</div>
</div>
<!-- END: Breadcrumbs-->

<!-- START: Card Data-->
<div class="row">
	<div class="col-12 mt-3">
		<div class="card">
			<div class="card-header  justify-content-between align-items-cen ter"> 
				<div class="row">
					<div class="col-md-6">
						<h4 class="card-title">Faq List</h4> 
					</div>
					<div class="col-md-6">
						<a style="float: right;" href="<?php echo adminurl("Add-faq");?>" class="btn btn-primary">Add Faq</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="row">                                           
					<div class="col-12">
						<?php $this->load->view("success_error");?>
						<form action="" method="get" class="validform formssample" id="role" novalidate="">
							<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"> 
									<select class="form-control limitvalue show-tick" name="limitvalue" onchange="searchFilter('','<?php echo adminurl('viewRole/');?>')">
										<?php $climit    =   $this->config->item("limit_values");
										foreach($climit as $ce){
										?>
										<option value="<?php echo $ce;?>" <?php echo ($this->input->get('limitvalue') == $ce)?"selected='selected'":'';?>><?php echo $ce;?></option>
										<?php
										}
										?> 
									</select>  
								</div> 
								<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="text" id="FilterTextBox" name="keywords" value="<?php echo $this->input->get('keywords');?>" class="form-control" placeholder="Search">
											<input type="hidden" id="orderby" name="orderby" value="<?php echo isset($orderby)?$orderby:'';?>">
											<input type="hidden" id="tipoOrderby" name="tipoOrderby" value="<?php echo isset($tipoOrderby)?$tipoOrderby:'';?>">
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> 
									<div class="form-group">
										<button type="submit" class="btn btn-xs btn-raised btn-primary waves-effect" name="submit" value="submit"> <i class="mdi mdi-search-web"></i> Search </button>
									</div>
								</div>
							</div>
							<div class="row">
								<input type="hidden" id="urlvalue" name="urlvalue" value="<?php echo adminurl('viewfaq/');?>"> 
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<?php $this->load->view("admin/loader");?>                        
									<div class="postList"></div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>                  
</div>