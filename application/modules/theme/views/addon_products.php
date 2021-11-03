<?php
$country =  $this->session->userdata("currency_code");//echo $view['vendorproduct_id'];exit;
$cvso   =   ($view['category_keywords']);
//echo $view['category_id'].$view['subcategory_id'];
$cat_id	=	trim($view['category_id'],' ');
$sub_cat_id	=	trim($view['subcategory_id'],' ');$ress = array();
$addo['whereCondition'] = "category_id = '".$cat_id."' AND (subcategory_id = '".$sub_cat_id."' OR subcategory_id = '".$sub_cat_id."')  AND addon_open ='1'  AND addon_status ='Active'";
$cate    =   $this->addon_model->viewAddonItems($addo);$i=0;
if(count($cate)>0){
	foreach($cate as $ct){
        $addonnn    =   explode('_',$ct->addon_items_item_id);//print_r($addonnn);
        $aps =($addonnn[1])??'';
		if($i==0){
            $parms['whereCondition'] = "(vendorproduct_id = '".$addonnn[0]."' AND vendorproductprinceid ='".$aps."')"; 
        }else{
            $parms['whereCondition'] .= " OR (vendorproduct_id = '".$addonnn[0]."' AND vendorproductprinceid ='".$aps."')"; 
        }$i++;
		
	}
	$parms['columns']  =   'product_name,vendorproduct_id,vendorproductimg_name,category_name,product_keywords,vendorproduct_acde,vendorproduct_bb_price,vendorproduct_bb_mrp,vendorproductprinceid,prod_indug,vendorproduct_bb_quantity';
    $parms['group_by']  =   'product_name';
 	$rese =   $this->vendor_model->viewVendorproducts_list($parms);//echo $this->db->last_query();exit;
?>
<section id="addons" class="login-area" data-backdrop="static">
        <div onclick="clloseForm()" class="overlay"></div>
        <div class="login-body-wrapper" style="max-width: fit-content;">
            <div class="login-body pt-0">
            <input type="hidden" id="produc" value=""/>
                <div class="modal-header mt-3 row">
                    <div class="col-md-2">
                        <h6 class="addfont text-center"> PRICE <br> DETAILS</h6>
                    </div>
                    <div class="col-md-6 row">
                        
                        <div class="col-md-3 col-4 mt-2">
                            <h6 class="addfont">1 Base Item <br> <b id="base_price"> ₹ 749</b></h6>
                        </div>
                        <div class="col-md-1 col-2 mt-2">
                            <h6 class="addfont">+</h6>
                        </div>
                        <div class="col-md-2 col-4 mt-2">
                            <h6 class="addfont"><span id="cc"> 0 </span> Add-ons <br> <b id="addon_total"> ₹ 0</b></h6>
                        </div>
                        <div class="col-md-1 col-2 mt-2 ">
                            <h6 class="addfont">+</h6>
                        </div>
                        <div class="col-md-2 col-4 mt-2">
                            <h6 class="addfont">Shipping <br> <b><span id="del_price">₹240</span></b></h6>
                        </div>
                        <div class="col-md-1 col-2 mt-2">
                            <h6 class="addfont">=</h6>
                        </div>
                        <div class="col-md-2 col-4 mt-2">
                            <h6 class="addfont">Total <br> <b id="totals"> ₹ 240</b></h6>
                            <input type="hidden" value="" id="rowwww">
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="product-details-content p-0 mx-auto mt-2" >
                                <a href="javascript:void(0);" class="buy-now float-right" onclick="addonUpdatee()"> Continue with<span id="ccc">out</span> Add-ons</a>
                            </div>
                    </div>                    
                </div>
                <div class="login-header">
                    <h6>Add on something to make it extra special!</h6>
                </div>
                <div class="login-content">
                <div class="container">
                    <div class="section-wrapper row">
                                    <?php 
                                    if(count($rese) > 0){
                                        foreach($rese as $ve) {
                                            $imsg           =   $this->config->item("upload_url")."products/photo-not-available.png";
                                            $target_dir     =  $this->config->item("upload_url")."products/".$ve->vendorproductimg_name ;
                                            if(@getimagesize($target_dir)){
                                                    $imsg   =   $target_dir;
                                            }
                                            $vso        =   urlencode($ve->category_name);
                                            $vsso       =   urlencode($ve->product_name); 
                                            $vssdo      =   $ve->product_keywords;
                                            $vacde      =   $ve->vendorproduct_acde;
                                            $pid        =   $ve->vendorproduct_id.'_'.$ve->vendorproductprinceid;
                                            ?>
                                        <div class="col-md-2 product-item" align="center">
                                            <div class="product-thumb col-10">
                                                <!-- <a href="<?php echo base_url("Product-View/".$vssdo);?>"> -->
                                                    <img src="<?php echo $imsg;?>" alt="product">
                                                <!-- </a> -->
                                                
                                                
                                            </div>
                                            <div class="product-content" align="center">
                                                <p class="small text-truncate" title="<?php echo $ve->product_name.'-'.$ve->prod_indug.'-'.$ve->vendorproduct_bb_quantity;?>"><?php echo $ve->product_name.'-'.$ve->prod_indug.'-'.$ve->vendorproduct_bb_quantity;?></p>
                                                <!-- <a href="<?php echo base_url("Product-View/".$vssdo);?>" class=""></a> -->
                                                <div class="pricee">
                                                        <?php if($ve->vendorproduct_bb_price != $ve->vendorproduct_bb_mrp){ ?>
                                                            <?php echo $this->customer_model->currency_change($country,$ve->vendorproduct_bb_price);?>
                                                        <del>
                                                        <?php	if(!empty($ve->vendorproduct_bb_mrp)){ echo $this->customer_model->currency_change($country,$ve->vendorproduct_bb_mrp);}?>
                                                        </del>
                                                        <?php }else{ ?>
                                                        <?php echo $this->customer_model->currency_change($country,$ve->vendorproduct_bb_price);?>
                                                        <?php } ?>
                                                    </div>
                                                <div class="d-flex justify-content-between align-items-center bg-light p-1">
                                                <input type="checkbox" class="c<?php echo $pid;?>" value="<?php echo $pid;?>" onchange="cartcheckbox(jQuery(this))" name="addo[]">
                                                <div class="">
                                                    <div class="price-increase-decrese-group d-flex">
                                                        <span class="decrease-btn">
                                                            <button type="button" class="btn quantity-left-minus " data-type="minus" data-field="" min="0" valprp="0"  onclick="updateaddon(jQuery(this))" prodid="<?php echo $pid;?>">-</button> 
                                                        </span>
                                                        <?php
                                                            $price  = $this->customer_model->currency_change($country,$ve->vendorproduct_bb_price);
                                                            $price = preg_replace('/[^0-9.]+/', '', $price);
                                                        ?>
                                                        <input type="hidden" class="p<?php echo $pid;?>" value="<?php echo $price;?>">
                                                        
                                                        <input type="text" class="form-controls v<?php echo $pid;?>" title="Qty" value="0" name="" valprp="2" onchange="updateaddon(jQuery(this))"  prodid="<?php echo $pid;?>">
                                                        <span class="increase">
                                                            <button type="button" class="btn quantity-right-plus" data-type="plus" data-field="" valprp="1" onclick="updateaddon(jQuery(this))" prodid="<?php echo $pid;?>">+</button>
                                                        </span>
                                                        
                                                    </div>
                                                </div>
                                                    <!-- <div class="cart-btn-toggle" >
                                                        <a class="cart-btn" href="<?php echo base_url("Product-View/".$vssdo);?>"><i class="fas fa-shopping-cart"></i> Cart</a>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                            <?php
                                        }
                                    }
                                    ?>
                    </div>
                </div>
               
                </div>
            </div>
        </div>
    </section>
   
<?php } ?>
<script>
function updateaddon(evt){
    var prdid       =   evt.attr("prodid");
    var count       =   $('.v'+prdid).val();
    var val         =   evt.attr('valprp');
    if(val==0){
        if(count > 0){
            count--;
        }
        
    }else if(val==1){
        count++;
    }else if(val==2){
        if(count<1){
            count = 1;
        }
    }
    if(count > 0){
        $('.c'+prdid).prop( "checked", true );
    }else{
        $('.c'+prdid).prop( "checked", false );
    }
    $('.v'+prdid).val(count);
    total_calc();
    
}
function cartcheckbox(evt){
    var prdid       =   evt.attr("value");
    if($('.c'+prdid).prop( "checked")){
        $('.v'+prdid).val(1);
    }else{
        $('.v'+prdid).val(0);
    }
    total_calc();
    //alert(prdid);
}
function total_calc(){
    var currency    =   jQuery(".currency option:selected").val();
    switch (currency) {
        case 'INR':
            currency = '₹'
            break;
        case 'AUD':
            currency = '$'
            break;
        case 'EUR':
            currency = '€'
            break;
        case 'GBP':
            currency = '£'
            break;
        case 'USD':
            currency = '$'
            break;
    }
    var total = 0;var c = 0;
    $.each($("input[name='addo[]']:checked"), function(){
        var prodid  =   $(this).val();
        var counts       =   $('.v'+prodid).val();
        var price       =   $('.p'+prodid).val();
        total=  total + (counts * price);c++;
    });
    $('#cc').html(c);
    var base_price  =$('#base_price').text();
    var base_price = base_price.match(/[\d\.]+/g);
    var del_price  =$('#del_price').text();
    var del_price = del_price.match(/[\d\.]+/g);
    $('#addon_total').html(currency+' '+total);
    var ctotal  =   parseFloat(base_price)+parseFloat(del_price)+parseFloat(total);
    $('#totals').html(currency+' '+ctotal);
    if(c==0){
      $('#ccc').html('out ');
    }else{
        $('#ccc').html(' '+c);
    }
    //alert(val);
}
function addonUpdatee(){
    var date        =   $(".datepicker").val();
    var deltype     =   $(".delivery_id").val();
    var rowid   =  $('#rowwww').val();
    var total = 0;var c = 0;
    var product_ids =   $('#produc').val();
    const prodid =[]; const counts =[]; const price =[]; 
    $.each($("input[name='addo[]']:checked"), function(){
        prodid[c]  =   $(this).val();
        var prd_id  = prodid[c].split('_');
        counts[c]       =   $('.v'+prodid[c]).val();
        price[c]       =   $('.p'+prodid[c]).val();
        total=  total + (counts * price);
         jQuery.ajax({
                type    : "POST",
                url     : valurl+"addtocart",
                data    : "id="+prd_id[0]+"&quant="+counts[c]+"&size="+prd_id[1]+"&addon_id=addon",
                success: function (response) {
                    viewquantity();
                    viewcartprice();
                }
            });c++;
    }); 
    // jQuery.ajax({
    //             type    : "POST",
    //             url     : valurl+"updateaddons",
    //             data    : "rowid="+rowid+"&id="+prodid+"&quant="+counts, 
    //             success: function (response) {
    //             }
    // });
   
                    document.getElementById("addons").classList.remove('open-form');
}
</script>