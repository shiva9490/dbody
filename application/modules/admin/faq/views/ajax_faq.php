<?php
$sr     =   $this->session->userdata("active-deactive-role");
$cr     =   $this->session->userdata("create-role");
$ur     =   $this->session->userdata("update-role");
$dr     =   $this->session->userdata("delete-role");
$ct     =   "0";
if($ur  == 1 || $dr == '1' || $sr == 1){
        $ct     =   1;
}
?>

	<div class="table-responsive"> 
		<table class="table table-striped table-hover js-basic-example tablehrcover" id="myTable">
			<thead>
				<tr id="filters">
					<th>S.No</th>
					<th><a href="javascript:void(0);" data-type="order" data-field="ut_name" urlvalue="<?php echo adminurl('viewprodcategory/');?>" onclick="getdatafiled($(this))">Faq Title Name <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
					<th><a href="javascript:void(0);" data-type="order" data-field="ut_name" urlvalue="<?php echo adminurl('viewprodcategory/');?>" onclick="getdatafiled($(this))">Faq description <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
					<th><a href="javascript:void(0);" data-type="order" data-field="ut_name" urlvalue="<?php echo adminurl('viewprodcategory/');?>" onclick="getdatafiled($(this))">Add Date /Modification Date <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
					<th><a href="javascript:void(0);" data-type="order" data-field="ut_acde" urlvalue="<?php echo adminurl('viewprodcategory/');?>" onclick="getdatafiled($(this))">Status <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
					<?php if($ct == '1'){?>
					<th>Action</th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php  
				if(count($view) > 0){
				$limit = 1;
					foreach($view as $ve){
						$vad    =  $ve->faq_status;
						if($vad == 1){
							$status = "Active";
							$icon   =   "times-circle";
							$vadv   =   "2";
							$textico    =   "text-warning";
							$vdata  =   "<label class='label abelsctive label-success'>".$status."</label>";
						}else{
							$status ="Inactive";
							$vdata  =   "<label class='label abelsctive label-danger'>".$status."</label>";
							$vadv   =   "1";
							$textico    =   "text-primary";
							$icon   =   "check-circle";
						}
				?>
				<tr>
					<td><?php echo $limit++;?></td>
					<td><?php echo $ve->faq_name;?></td>
					<td><?php echo $ve->faq_desc;?></td>
					<td><?php echo $ve->faq_add_date;?> /<br>
						<?php echo $ve->faq_modification_date;?>
					</td>
					<td><?php echo $vdata;?></td>
					<?php if($ct == '1'){?>
					<td> 
						<?php if($sr == '1'){?>
						<a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Ajax-faq')" fields="<?php echo $ve->id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>"><i class="fa fa-<?php echo $icon;?> m-r-5"></i></a>
						<?php } if($ur == '1'){?>
						<a href='<?php echo adminurl("edit-faq/".$ve->id);?>' data-toggle='tooltip' data-original-title="Update Product Category" class="text-success tip-left"><i class="fa fa-edit m-r-5"></i></a>
						<?php } if($dr == '1'){?>
						<a href="javascript:void(0);" onclick="confirmationDelete($(this),'Role')"  data-toggle='tooltip' attrvalue="<?php echo adminurl("delete-faq/".$ve->id);?>"   data-original-title="Delete Product Category" class="text-danger"><i class="fa fa-trash"></i></a>
						<?php }  ?>
					</td>
					<?php }  ?>
				</tr>
					<?php
					}
				}else {
					echo '<tr class="text-center text-danger"><td colspan="6"><i class="zmdi zmdi-info-outline"></i> Faq list are  not available</td></tr>';
				}
				?>
			</tbody>
		</table>
	</div>
<?php echo $this->ajax_pagination->create_links();?>