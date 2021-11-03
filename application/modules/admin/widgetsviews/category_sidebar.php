<?php
$cik    =& get_instance();
$params["tiporderby"]   =   "category_order";
$params["order_by"]     =   "asc";
$res    =   $cik->category_model->viewcategory($params);
?>
<div class="catagory-sidebar-area">
	<div class="catagory-sidebar-area-inner">
		<div class="catagory-sidebar all-catagory-option">
			<ul class="catagory-submenu">
				<?php 
				//echo '<pre>';print_r($res);
				if(count($res) > 0){
				    foreach($res as $vvf){
				        $vsik   =   $vvf->category_id;
				        $cnam   =   $vvf->category_name;
				        $cnamkey   =   $vvf->category_keywords;
				        $pms["where_condition"]      =   "subcategory_category = '".$vsik."'"; 
			            $vspl   =   $cik->category_model->viewsub_categories($pms);
				        ?>
		        <li>
		            <?php
		                if(count($vspl) > 0) {
		            ?>
		                
		            <a data-toggle="collapse" href="#<?php echo $vsik;?>" role="button" aria-expanded="false" aria-controls="<?php echo $vsik;?>"><?php echo $cnam;?><i class="fas fa-angle-down"></i></a>
					<ul class="catagory-submenu collapse" id="<?php echo $vsik;?>">
		                <?php
		                    foreach($vspl as $vrt){
		                ?>
						<li><a href="<?php echo base_url().$cnamkey.'/'.$vrt->subcategory_keywords;?>"><?php echo $vrt->subcategory_name;?></a></li>
		                <?php
		                     }
		                ?>
					</ul>  
		                <?php
		                    }else{
		                ?>
	                <a href="<?php echo base_url().'product-list/'.$cnamkey;?>"><?php echo $cnam;?></a>
		                <?php
		                    }
		                ?>
				</li>
				        <?php
				    }
				}
				?>
			</ul>
		</div>
	</div>
</div>