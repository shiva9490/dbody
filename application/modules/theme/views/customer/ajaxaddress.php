<?php 
if(count($view) > 0){
    foreach ($view as $ce){
        $locality   =   $ce->customeraddress_locality;
        $adre       =   $ce->customeraddress_address;
        $adsre      =   $ce->customeraddress_latitude.",".$ce->customeraddress_longitude;
        $acde   =   ($ce->customeraddress_acde == '1')?'<span class="postinval text-success"><i class="fa fa-3x fa-thumb-tack"></i></span>':"";
        ?>
        <li>
            <span class="icon"><i class="fas fa-check-circle"></i></span>
            <div class="address-text">
                <h6>Home2</h6>
                <p class="address"><?php echo $ce->customeraddress_fullname.',<br>'.$ce->customeraddress_mobile.'<br>';?></p>
                <p class="address"><?php echo $adre.'<br>'.$ce->customeraddress_locality.'<br>'.$ce->customeraddress_district.'<br>'.$ce->customeraddress_pincode;?></p>
                <p class="country"><?php echo $locality;?></p>
            </div> 
            <div class="edit-delete-btn">
                <a class="edit" href="<?php echo base_url().'Update-Address/'.$ce->customeraddress_id?>"><i class="fas fa-edit"></i></a>
                <a class="delete" href="<?php echo base_url().'Delete-Address/'.$ce->customeraddress_id?>"><i class="fas fa-trash-alt"></i></a>
            </div>   
        </li>
        <?php
    }
}else{
    ?>
<div class="col-sm-12 col-xs-12 mt-10 mb-5 col-md-12">
    <h4 class="text-center text-info"><i class="fa fa-info-circle"></i> No address are available as of now</h4>
</div>
    <?php
}
?>
<div class="col-xs-12 col-sm-12 col-md-12 m-t-1">
    <?php echo $this->ajax_pagination->create_links();?>
</div>