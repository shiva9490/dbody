<?php
    $cik    =& get_instance();
    $params["tiporderby"]   =   "category_name";
    $params["order_by"]     =   "asc";
    $res    =   $cik->category_model->viewcategory($params);
?>
    <div class="widget-wrapper" id="scatagory-widget01">
        <?php 
            if(count($res) > 0){
		    $i=1;
		    foreach($res as $vvf){
                if($cik->uri->segment("1")==$vvf->category_keywords){
		        $vsik   =   $vvf->category_id;
		        $cnam   =   $vvf->category_name;
		        $cnamkey   =   $vvf->category_keywords;
		        $pms["where_condition"]      =   "subcategory_category = '".$vsik."'"; 
	            $vspl   =   $cik->category_model->viewsub_categories($pms);
	            $url = $cik->uri->segment("1");
	            if($cnamkey === $url){$show = "show";}else{$show="";}
                    ?>
                    <ul class="catagory-menu collapse show <?php echo $show;?>" id="catagory-main">
                        <li><a class="" data-toggle="collapse" href="#catagory-widget-s<?php echo $i;?>" role="button" aria-expanded="false" aria-controls="catagory-widget-s<?php echo $i;?>"><?php echo $cnam;?><span class="plus-minus"></span></a>
                            <?php if(count($vspl) > 0) { ?>
                            <ul class="catagory-submenu collapse show <?php echo $show;?>" id="catagory-widget-s<?php echo $i;?>">
                                <?php foreach($vspl as $vrt){ ?>
                                <li class="checkbox-item">
                                    <input type="checkbox" name="cat[]" value="<?php echo $vrt->subcategory_keywords;?>" <?php if($cik->uri->segment("2")==$vrt->subcategory_keywords){echo 'checked';} ?> onchange="searchFilter('','')">
                                    <span class="checkbox"></span>
                                    <span class="label"><?php echo $vrt->subcategory_name;?></span>
                                </li>
                                <?php } ?>
                            </ul>
                            <?php } ?>
                        </li>
                        
                    <?php $i++;
                }
         } } ?>
        </ul>
    </div>
