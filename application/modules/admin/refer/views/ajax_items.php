<?php 
    //print_r($items);exit;?>
    <input type="checkbox" onchange="itemCheckAll($(this))" id="sell">
    <label for="sell">Select All</label><br>
    <?php 
    if(!empty($items)){
        foreach($items as $i){?>
        <input type="checkbox" name="Prod[]" id="<?php echo $i->vendorproduct_id;?>" value="<?php echo $i->vendorproduct_id;?>" <?php if(!empty($prod) && in_array($i->vendorproduct_id,$prod)){echo 'checked';}?> required>
        <label for="<?php echo $i->vendorproduct_id;?>"><?php echo $i->product_name;?></label><br>
    <?php } }
?>