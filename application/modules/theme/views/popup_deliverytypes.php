<?php if(is_array($deliverytype) && count($deliverytype) >0){
$country =  $this->session->userdata("currency_code");
?>
    <div class="row">
        <?php foreach($deliverytype as $deltype){?>
        <div class="col-md-12">
            <label class="cont"><?php echo $deltype->derliverytype;?>
                <input type="radio" class="type" data-title="<?php echo $deltype->derliverytype.' - '.$this->customer_model->currency_change($country,$deltype->deliverychg_amount);?>" data-type="<?php echo $deltype->derliverytype_id;?>" onchange="deliverytypeid('<?php echo $deltype->derliverytype_id;?>')" name="devliry_type">
                <span class="checkmark"></span>
            </label>
        </div>
        <?php } ?>
    </div>
<?php } ?>
