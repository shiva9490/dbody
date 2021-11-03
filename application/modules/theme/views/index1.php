<?php  
$leftbar    =   $layout['cpage_leftsidebar'];
$rightbar   =   $layout['cpage_rightbar'];
$contentbar     =   $layout['cpage_content'];
$cpage_layout     =   $layout['cpage_layout'];
$cpage_content_from     =   $layout['cpage_content_from'];
if($cpage_layout == '1layout'){
	?>
	<div class="row">
		<div class="col-sm-4 col-xs-12">
			<?php 
			if($cpage_content_from == "2cfrom"){
				echo $leftbar;
			}
			if($cpage_content_from == "3cfrom"){
				$vsp    =   array_filter(explode(",",$leftbar));
				if(count($vsp) > 0){
					foreach($vsp as $vtg){
						$vsps    =   $this->widget_model->get_widget($ve);
						include_widget($vsps['widget_alias_name']);
					}
				}
			}
			?>
		</div>
		<div class="col-sm-8 col-xs-12">
			<?php 
			if($cpage_content_from == "2cfrom"){
				echo $contentbar;
			}
			if($cpage_content_from == "3cfrom"){
				$vsp    =   array_filter(explode(",",$contentbar));
				if(count($vsp) > 0){
					foreach($vsp as $vtg){
						$vsps    =   $this->widget_model->get_widget($ve);
						include_widget($vsps['widget_alias_name']);
					}
				}
			}
			?>
		</div>
	</div>
	<?php
}
if($cpage_layout == '2layout'){
	?>
	<div class="row">
		<div class="col-sm-8 col-xs-12">
			<?php 
			if($cpage_content_from == "2cfrom"){
				echo $contentbar;
			}
			if($cpage_content_from == "3cfrom"){
				$vsp    =   array_filter(explode(",",$contentbar));
				if(count($vsp) > 0){
					foreach($vsp as $vtg){
						$vsps    =   $this->widget_model->get_widget($ve);
						include_widget($vsps['widget_alias_name']);
					}
				}
			}
			?>
		</div>
		<div class="col-sm-4 col-xs-12">
			<?php 
			if($cpage_content_from == "2cfrom"){
				echo $rightbar;
			}
			if($cpage_content_from == "3cfrom"){
				$vsp    =   array_filter(explode(",",$rightbar));
				if(count($vsp) > 0){
					foreach($vsp as $vtg){
						$vsps    =   $this->widget_model->get_widget($ve);
						include_widget($vsps['widget_alias_name']);
					}
				}
			}
			?>
		</div>
	</div>
	<?php
}
if($cpage_layout == '3layout'){
	if($cpage_content_from == "2cfrom"){
	    ?>
    <div class="row">
		<div class="col-sm-12 col-xs-12">
		    <?php 	echo $contentbar;?>
	    </div>
    </div>
    <?php }
	if($cpage_content_from == "3cfrom"){
		$vsp    =   array_filter(explode(",",$contentbar));
		if(count($vsp) > 0){
			foreach($vsp as $vtg){
				$vsps    =   $this->widget_model->get_widget($vtg);
				include_widget($vsps['widget_alias_name']);
			}
		}
	}
}
if($cpage_layout == '4layout'){
	?>
	<div class="row">
		<div class="col-sm-4 col-xs-12">
			<?php 
			if($cpage_content_from == "2cfrom"){
				echo $leftbar;
			}
			if($cpage_content_from == "3cfrom"){
				$vsp    =   array_filter(explode(",",$leftbar));
				if(count($vsp) > 0){
					foreach($vsp as $vtg){
						$vsps    =   $this->widget_model->get_widget($vtg);
						include_widget($vsps['widget_alias_name']);
					}
				}
			}
			?>
		</div>
		<div class="col-sm-4 col-xs-12">
			<?php 
			if($cpage_content_from == "2cfrom"){
				echo $contentbar;
			}
			if($cpage_content_from == "3cfrom"){
				$vsp    =   array_filter(explode(",",$contentbar));
				if(count($vsp) > 0){
					foreach($vsp as $vtg){
						$vsps    =   $this->widget_model->get_widget($vtg);
						include_widget($vsps['widget_alias_name']);
					}
				}
			}
			?>
		</div>
		<div class="col-sm-4 col-xs-12">
			<?php 
			if($cpage_content_from == "2cfrom"){
				echo $rightbar;
			}
			if($cpage_content_from == "3cfrom"){
				$vsp    =   array_filter(explode(",",$rightbar));
				if(count($vsp) > 0){
					foreach($vsp as $vtg){
						$vsps    =   $this->widget_model->get_widget($vtg);
						include_widget($vsps['widget_alias_name']);
					}
				}
			}
			?>
		</div>
	</div>
	<?php
}
?>