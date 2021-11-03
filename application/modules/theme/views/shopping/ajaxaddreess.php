<?php 
if(is_array($view) && count($view) > 0){
    foreach ($view as $ce){
        $locality   =   $ce->customeraddress_locality;
        $customeraddress_id       =   $ce->customeraddress_id;
        $adre       =   $ce->customeraddress_address;
        $adsre      =   $ce->customeraddress_latitude.",".$ce->customeraddress_longitude; 
        $cdsre      =   ($ce->customeraddress_acde == '1')?"checked='checked'":""; 
        $msg      =   ($ce->customeraddress_acde == '1')?"<span class='btn-sm btn-gradioent'>Delivery Here</span>":"";  
        ?>
<div class="col-sm-4 col-md-4 col-xs-12">  
    <div class="border-ddd">
        <div class="pad-10">  
            <div><?php echo $adre;?></div>
            <span class="text-bold"><?php echo $ce->state_name.", ".$ce->customeraddress_pincode;?></span>
            <div class="mtop-15">  
                <label class="containerlabel"> 
                    <input type="radio"  name="customeraddress_id" onclick="" <?php echo $cdsre;?> value="<?php echo $customeraddress_id;?>"/> &nbsp;
                    <span class="checkmark"></span>
                </label>
                <a href="https://maps.google.com/maps?q=<?php echo $adsre;?>" class="popup-gmaps btn-info btn-sm">
                    <i class="fa fa-map-marker fa-x blinking"></i> <?php echo $locality;?>
                </a> &nbsp;
                <span class="btnsm<?php echo $customeraddress_id;?>">
                    <?php echo $msg;?>
                </span>
            </div>
        </div>
    </div>
</div>
        <?php
    }
}
?>