<?php 
    //print_r($items);exit;
    ?>
    <input type="checkbox" onchange="itemCheckAll($(this))" id="sell">
    <label for="sell">Select All</label><br>
    <?php foreach($items as $i){?>
        <input type="checkbox" name="Prod[]" id="<?php echo $i->vendorproduct_id.'_'.$i->vendorproductprinceid;?>" value="<?php echo $i->vendorproduct_id.'_'.$i->vendorproductprinceid;?>" <?php if(!empty($prod) && in_array($i->vendorproduct_id.'_'.$i->vendorproductprinceid,$prod)){echo 'checked';}?> required>
        
        <label for="<?php echo $i->vendorproduct_id.'_'.$i->vendorproductprinceid;?>"><?php echo $i->product_name.'-'.$i->prod_indug.'-'.$i->vendorproduct_bb_quantity;?></label><br>
    <?php } 
?>