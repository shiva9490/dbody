<?php 
    //print_r($prod);exit;
    ?>
    <input type="checkbox" onchange="itemCheckAll($(this))" id="sell">
    <label for="sell">Select All</label><br>
    <?php foreach($items as $i){?>
        <input type="checkbox" name="Prod[]" id="<?php echo $i->subcategory_id;?>" value="<?php echo $i->subcategory_id;?>" <?php if(!empty($prod) && in_array($i->subcategory_id,$prod)){echo 'checked';}?> required>
        <label for="<?php echo $i->subcategory_id;?>"><?php echo $i->subcategory_name;?></label><br>
    <?php } 
?>