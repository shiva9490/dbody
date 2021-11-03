<?php  
$rtotl     =   $this->cart->contents();
if(count($rtotl) > 0){
    foreach($rtotl as $fr){
        $imsg       =  $this->config->item("upload_url")."products/photo-not-available.png";
        $target_dir =  $fr['image'] ;
        if(@getimagesize($target_dir)){
                $imsg   =   $target_dir;
        }
    ?>
    <li class="mini_cart_item">
        <a class="remove" href="javascript:void(0)" onclick="removecart('<?php echo $fr['id'] ?>','<?php echo $fr['rowid'] ?>')">×</a>
		<a href="single-product.html">
			<img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="<?php echo $imsg;?>" alt=""><?php echo $fr['name'];?>&nbsp;
		</a>
		<span class="quantity"><?php echo $fr["qty"];?> × <span class="amount"><i class="fa fa-inr"></i> <?php echo $fr["price"];?></span></span>
	</li>
    <?php   } 
}
?>