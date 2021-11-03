<?php 
    $country    =   $this->session->userdata("currency_code");
    $rtotl      =   $this->cart->contents();
    if(count($rtotl) > 0){ 
?>
<div class="cart-product-container">
    <?php  
        $rirl   =   "0";$i=1;
        foreach($rtotl as $fr){
            //echo '<pre?';print_r($fr);exit;
            $vtoal      =  "0";
            $vsso       =  $fr['name'];
            $delivery   =  isset($fr['delamount'])?$fr['delamount']:'0';
            $total      =  $fr["qty"]*$fr["price"] ;
            $rirl   +=  $fr["qty"]*$fr["price"]+$delivery;
    ?>
    <div class="cart-product-item">
        <div class="close-item"><a onclick="removecart('<?php echo $fr['id'] ?>','<?php echo $fr['rowid'] ?>')"><i class="fas fa-times"></i></a></div>
        <div class="row align-items-center">
            <div class="col-4 p-0">
                <div class="thumb">
                    <a href="#"><img src="<?php echo $fr['image'];?>" alt="products"></a>
                </div>
            </div>
            <div class="col-8">
                <div class="product-content">
                    <a href="<?php echo base_url("Product-View/".$vsso);?>" class="product-title"><?php echo $fr["name"];?></a>
                    <div class="product-cart-info">
                        <?php echo 'Width : '.$fr['size']?><br>
                        <?php if($fr['type'] !=''){echo 'Type : '.$fr['type'].'<br>';}?>
                        <?php if($fr['deldate'] !=''){echo 'Delivery : '.$fr['deldate'].'<br>';}?>
                        <?php if($fr['deltime'] !=''){echo 'Time : '.$fr['deltime'].'<br>';}?>
                        <?php echo 'Delivery Amount :'.$this->customer_model->currency_change($country,$fr['delamount']);?><br>
                    </div>
                </div>
                <b><?php echo $this->customer_model->currency_change($country,$fr["price"]).' X '.$fr["qty"];?></b>
            </div>
        </div>
        <div class="row align-items-center" <?php if($i == count($rtotl)){ echo 'style="margin-bottom: 30px"';} ?>>
            <div class="col-6">
                <div class="price-increase-decrese-group d-flex">
                    <span class="decrease-btn">
                        <button type="button"class="btn quantity-left-minus  dsc<?php echo $fr['rowid'];?>" data-type="minus" data-field="" min="0" valprp='0' prodrowid="<?php echo $fr['rowid'];?>" onclick="updatecarts(jQuery(this))" prodid="<?php echo $fr["id"];?>">-</button> 
                    </span>
                            <?php
                            $price  = $this->customer_model->currency_change($country,$fr['price']);
                            $price = preg_replace('/[^0-9.]+/', '', $price);
                            ?>
                    <input type="hidden" class="priceval<?php echo $fr["id"];?>" value="<?php echo $price;?>"/>
                    <input type="text" class="form-controls input-number qty qtyval<?php echo $fr["id"];?> text" title="Qty" value="<?php echo $fr['qty'];?>" name="cart[<?php echo $fr['rowid'] ?>][qty]" valprp='2' prodrowid="<?php echo $fr['rowid'];?>" onchange="updatecart(jQuery(this))" prodid="<?php echo $fr["id"];?>">
                    <span class="increase">
                        <button type="button" class="btn quantity-right-plus" data-type="plus" data-field="" valprp='1' min="1"prodrowid="<?php echo $fr['rowid'];?>" onclick="updatecarts(jQuery(this))" prodid="<?php echo $fr["id"];?>">+</button>
                    </span>
                </div>
            </div>
            <div class="col-6">
                <div class="product-price">
                    <span class="ml-4">
                        <span class="amount amounval<?php echo $fr['id'];?>">
                            <b><?php echo $this->customer_model->currency_change($country,$total);?></b>
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <?php $i++;} ?>
</div>
<div class="cart-footer">
    <div class="product-other-charge">
        <p class="d-flex justify-content-between">
            <span>Delivery charges</span> 
            <span><?php echo $this->session->userdata("symboles").'0';?></span>
        </p>
        <a href="#">Do you have a voucher?</a>
    </div>
    <div class="cart-total">
        <!--<p class="saving d-flex justify-content-between">
            <span>Total Savings</span> 
            <span><?php echo $this->session->userdata("symboles").'0';?></span>
        </p>-->
        <p class="total-price d-flex justify-content-between">
            <span>Total</span>
            <span class="price2">
                <?php echo $this->customer_model->currency_change($country,$rirl);?>
            </span>
        </p>
        <?php if($this->session->userdata('customer_id') == ""){ ?>
                <a onclick="OpenSignUpForm()" href="#" class="procced-checkout">Proceed Checkout</a>
        <?php }else{?>
            <a href="<?php echo base_url("/View-Cart");?>" class="procced-checkout">Proceed Checkout</a>
        <?php } ?>
        
    </div>
</div>
<?php } ?>