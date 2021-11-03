<?php  
$country    =   $this->session->userdata("currency_code");
$rtotl     =   $this->cart->contents();//print_r($rtotl);exit;
$id= '';
if(count($rtotl) > 0){
    foreach($rtotl as $fr){
        $imsg       =  $this->config->item("upload_url")."products/photo-not-available.png";
        $target_dir =  $fr['image'] ;
        if(@getimagesize($target_dir)){
                $imsg   =   $target_dir;
        }$id=$fr['rowid'];
    ?>
    <li class="mini_cart_item">
        <a class="remove" href="javascript:void(0)" onclick="removecart('<?php echo $fr['id'] ?>','<?php echo $fr['rowid'] ?>')">×</a>
		<a href="single-product.html">
			<img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="<?php echo $imsg;?>" alt=""><?php echo $fr['name'];?>&nbsp;
		</a>
		<span class="quantity"><?php echo $fr["qty"];?> × <span class="amount"><i class="fa fa-inr"></i> <?php echo $fr["price"];?></span></span>
	</li>
    <?php   } 
   
}$delivery = ($delivery)??'';
$amount =   ($amount)??'';
?>

<input type="hidden" id="rowww" value="<?php echo $id;?>">
<input type="hidden" id="delamountt" value="<?php echo $this->customer_model->currency_change($country,$delivery);?>">
<input type="hidden" id="baseamountt" value="<?php echo $this->customer_model->currency_change($country,$amount);?>">