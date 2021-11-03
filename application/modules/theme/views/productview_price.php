<?php $country =  $this->session->userdata("currency_code");?>
<input type="hidden" class="prodid" value="<?php echo $view['vendorproductids'];?>">
<?php if(is_array($prices) && count($prices)){
if($prices[0]->vendorproduct_bb_quantity !=""){?>
<div class="row">
    <div class="col-md-12">
        Select Weight :
    </div>
    <div class="col-md-12 qty-rates" >
        <div class="radio-toolbar">
        <?php
           $i=1;
           foreach($prices as $p){
        ?>
        <input type="radio" class="size<?php echo $p->vendorproductprinceid;?>" id="<?php echo $p->vendorproductprinceid;?>" data-value="<?php echo $p->vendorproductprinceid;?>" onchange="changerate('<?php echo $p->vendorproductprinceid;?>')" name="quantity" value="<?php echo $p->vendorproduct_bb_quantity;?>" <?php if($i==1){echo 'checked';}?>>
        <label for="<?php echo $p->vendorproductprinceid;?>"><?php echo $p->vendorproduct_bb_quantity;?></label>
        <?php 
            $i++;}
        ?>
        </div>
    </div>
    <span class="new-qty-rates"></span>
</div>
<?php } 
}?>