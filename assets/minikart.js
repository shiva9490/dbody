var valurl = "/dbody/"; 
var initPart = function () {
   jQuery(document).find('a[data-type="order"]').each(function () {
        if (jQuery(this).data("field") ==jQuery("#tipoOrderby").val()) {
            if (jQuery("#orderby").val() == "ASC") {
               jQuery(this).data("order", "DESC");
               jQuery("i", this).addClass('fa-sort-desc');
            } else {
               jQuery("i", this).addClass('fa-sort-asc');
               jQuery(this).data("order", "ASC");
            }
        } else {
           jQuery("i", this).addClass('fa-sort');
           jQuery(this).data("order", "ASC");
        }
        jQuery("i", this).css('color', "blue");
    });
}
var input_rest = function () {
   jQuery(".input_num").keypress(function (event) {
        var inputValue = event.which;
        if (!(inputValue >= 48 && inputValue <= 57) && (inputValue != 0 && inputValue != 8)) {
            event.preventDefault();
        }
    });
   jQuery(".input_geo").keypress(function (event) {
        var inputValue = event.which;
        if (!(inputValue >= 48 && inputValue <= 57) && (inputValue != 0 && inputValue != 8 && inputValue != 46)) {
            event.preventDefault();
        }
    });
   jQuery(".input_char").keypress(function (event) {
        var inputValue = event.which;
        if (!(inputValue >= 65 && inputValue <= 122) && (inputValue != 0 && inputValue != 8 && inputValue != 32 && inputValue != 46 && inputValue != 0)) {
            event.preventDefault();
        }
    });
   jQuery(".upperceaseval").keypress(function(event){
           jQuery(this).css("text-transform","uppercase"); 
    });
   jQuery(".capitalizeval").keypress(function(event){
           jQuery(this).css("text-transform","capitalize"); 
    });
};
function getdatafiled(event) {
        initPart();
        jQuery("#tipoOrderby").val(event.data("field"));
        jQuery("#orderby").val(event.data("order"));
        searchFilter('', event.attr("urlvalue"));
} 
function changekeyvalue(event){
        var spval   =   event.attr("atrvalue");
        if(spval == '1'){
            event.html('<i class="fa font25rem fa-table text-info"></i>');
            event.attr("atrvalue","0");
           jQuery(".grdview").val("0");
        }else{
            event.attr("atrvalue","1");
           jQuery(".grdview").val("1");
            event.html('<i class="fa font25rem fa-th-large text-info"></i>');
        }
        searchFilter('',event.attr("urlvalue"));
}  
function searchFilter(page_num, url) {
    page_num = page_num ? page_num : 0;
    if(url==''){
        url=   $('#urll').val();
    }
    var modalval    =   jQuery('.modalval').val() ?jQuery('.modalval').val() : '0';
    var keywords    =   jQuery('#FilterTextBox').val();
    var limitvalue  =   jQuery('.limitvalue option:selected').val();
    var category    =   jQuery('#category').val();
    var subcategory =   jQuery('#subcategory').val();
    var search      =   jQuery('#search').val();
     var favorite = [];
    $.each($("input[name='cat[]']:checked"), function(){
        favorite.push($(this).val());
    });
    var cat_id =favorite.join(",");
    var categorys   =   jQuery('#categorys').val();
    var spclasss = 'postList'; 
    jQuery('.' + spclasss).html("");
    if (modalval == '1') {
            spclasss = 'postListper';
            keywords =jQuery('#FilterTextBox1').val();
            limitvalue =jQuery('.limitvalue1 option:selected').val();
    }
    jQuery.ajax({
        type: 'POST',
        url: url + page_num,
        data: {
            tipoOrderby:jQuery("#tipoOrderby").val(),
            orderby:jQuery("#orderby").val(),
            keywords: keywords,
            limitvalue: limitvalue,
            category:category,
            subcategory:subcategory,
            search:search,
            cat_id:cat_id,
            categorys:categorys,
            inplay:jQuery(".inplay option:selected").val(),
            reports:jQuery(".reports option:selected").val()
        },
        beforeSend: function () {
           jQuery('.pageloaderwrapper').show();
        },
        success: function (html) { 
           jQuery('.pageloaderwrapper').hide();
           jQuery('.' + spclasss).html(html);
           $("html, body").animate({ scrollTop: 0 }, "slow");
            initPart();
        }
    });
}  
jQuery(function(){
    jQuery(".formvalid").validate({
            errorElement:"div",
            errorClass:"text-danger",
            errorPlacement: function (error, element) { 
                if (element.attr("type") == "radio") {
                    error.insertAfter(jQuery(element).parent());
                }else{
                    error.insertAfter(jQuery(element)); 
                }
            },
            rules:{
                otp_mobile_no:{
                   required:true,
                   minlength: 10,
                   maxlength:10
                },
            },
            messages:{ 
                user_type:"User Type is required",
                otp_mobile_no:{
                    required:"Mobile No is required"
                },
                vendor_name:"Name is required",
                vendor_gender:"Gender is required",
                vendor_mobile:"Mobile No. is required",
                vendor_storename:"Store Name is required",
                vendor_profile:"Profile Image is required",
            },
            highlight: function (element, errorClass) {
                jQuery(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element, errorClass) {
                jQuery(element).closest('.form-group').removeClass('has-error');
            }
    });
}); 
var insEmil  =  jQuery(function(){
    jQuery(".validformsub").validate({
            errorElement:"div",
            errorClass:"text-danger",
            errorPlacement: function (error, element) {
                if (element.attr("type") == "radio") {
                    error.insertAfter(jQuery(element).parent());
                }else{
                    error.insertAfter(jQuery(element)); 
                }
            },
            messages:{
                user_type:"User Type is required",
                otp_mobile_no:{
                    required:"Mobile No is required"
                },
                vendor_name:"Name is required",
                vendor_gender:"Gender is required",
                vendor_mobile:"Mobile No. is required",
                vendor_storename:"Store Name is required",
                vendor_profile:"Profile Image is required",
            },
            highlight: function (element, errorClass) {
                jQuery(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element, errorClass) {
                jQuery(element).closest('.form-group').removeClass('has-error');
            }
    });
}); 
jQuery(".otpdivshide").hide();
function subscribe(){
    var emailid     =   jQuery(".emailid").val();
    if(emailid){
        jQuery.post(valurl+"subscribe",{emailid:emailid},function(data){
            if(data){
                jQuery('.msg').html(data);
                if("thank you for subscribe" == data){
                    jQuery(".emailid").val('');
                }
            }
        });                   
    }
}
function activeblock(evt){  
        var hrefvale = evt.attr("hrefvale");
        var status = evt.attr("status");
        var vendrprod = evt.attr("vendrprod"); 
        jQuery.post(valurl+hrefvale,{vendrprod:vendrprod,status:status},function(data){
            var hnk =   "Show";
            evt.attr("status","1");
            if(status == '1'){
                hnk =   "Hide";
                evt.attr("status",0);
            }
            evt.html(hnk);
        });    
}
function usertype(){ 
    jQuery(".labelradio0").removeClass("labelradio");
    jQuery(".labelradio1").removeClass("labelradio");
    var user_type     =   jQuery(".user_type:checked").val();
    jQuery(".labelradio"+user_type).addClass("labelradio");
    jQuery(".user_typeerrd").html("");
}
function submitform(){  
        jQuery(".otpdivshide").hide();  
        jQuery(".otp_key").val("");
        var vsldi = jQuery(".formvalid").valid();
        var user_type     =   1;//jQuery(".user_type:checked").val();
        jQuery("#loader").css('display','block');  
        if(vsldi && user_type != ""){
            jQuery(".user_typeerrd").html("");
            var loginmobile   =   jQuery("#otp_mobile_no").val();
            jQuery.post(valurl+"otp",{loginmobile:loginmobile,customer_mobile:loginmobile,user_type:user_type},function(data){
                if(data > 0){
                    jQuery("#loader").css('display','none');  
                    jQuery(".hideotp").hide();  
                    jQuery(".otpdivshide").show();  
                }
                else{
                    alert('Mobile No Can not be registered');
                }
            });
        }else{
            jQuery(".user_typeerrd").html("Please select Vendor / Customer");
            jQuery(".user_typeerrd").addClass("text-danger");
            jQuery(".user_typeerrd").css("display","block");
        }
}
function signupfirm(){
    jQuery(".eformvalid").validate({
            errorElement:"div",
            errorClass:"text-danger",
            errorPlacement: function (error, element) { 
                if (element.attr("type") == "radio") {
                    error.insertAfter(jQuery(element).parent());
                }else{
                    error.insertAfter(jQuery(element)); 
                }
            },
            rules:{
                email:{
                    remote:{
                        url:valurl+"unique_registeremail",
                        type:"post",
                        data:{
                            email:function(){
                                return  $(".eformvalid .emailvfomr").val();
                            }
                        }
                    }
                },  
            },
            messages:{ 
                fname:{
                    required:"Name is required",  
                },
                email:{
                    required:"Email Id is required",
                    remote: jQuery.validator.format('<span class="text-success">"{0}"</span> : Email Id already exists.') 
                },
                password:{
                    required:"Password is required",
                }
            },
            highlight: function (element, errorClass) {
                jQuery(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element, errorClass) {
                jQuery(element).closest('.form-group').removeClass('has-error');
            },
            submitHandler:function(){
                jQuery('.signupp').css('display','none');
                $('#loader3').show();
                jQuery.post(valurl+"Register",$(".eformvalid").serialize(),function(data){
                          datt    = $(".eformvalid .mobile").val();
                        var d    =   JSON.parse(data);
                        if(d.status=='1' || d.status=='5'){
                            document.getElementById("otp-verify").classList.add('open-form');
                            document.getElementById("signupFormarea").classList.remove('open-form');
                            $('#otp_mobile_no1').val(datt);
                            jQuery.post(valurl+"otp",{loginmobile:datt,customer_mobile:datt,user_type:1},function(data){
                            });
                        }else if(d.status=='4'){
                            $('.mobilee').html(d.status_messsage);
                            jQuery('.signupp').css('display','block');
                            $('#loader3').hide();
                        }
                });
            }
    });
}
function ProductReview(){
    jQuery(".eformvalid").validate({
            errorElement:"div",
            errorClass:"text-danger",
            messages:{
                message:{
                    required:"Messgae is required",  
                },
                rating:{
                    required:"Rating is required",
                }
            },
            submitHandler:function(){
                jQuery.post(valurl+"Rating",$(".eformvalid").serialize(),function(data){
                    alert("Successfully submit review");
                });
            }
    });
}
function loginform(){
    jQuery(".formvalidlogin").validate({
            errorElement:"div",
            errorClass:"text-danger",
            errorPlacement: function (error, element) {
                if (element.attr("type") == "radio") {
                    error.insertAfter(jQuery(element).parent());
                }else{
                    error.insertAfter(jQuery(element)); 
                }
            },
            messages:{
                email:{
                    required:"Email Id is required"
                },
                password:{
                    required:"Password is required",
                }
            },
            highlight: function (element, errorClass) {
                jQuery(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element, errorClass) {
                jQuery(element).closest('.form-group').removeClass('has-error');
            },
            submitHandler:function(){
                jQuery('.login').css('display','none');
                $('#loader2').show();
                datt    = $(".formvalidlogin .emailee").val();
                jQuery.post(valurl+"Api-Login-Register",$(".formvalidlogin").serialize(),function(data){
                    var json = $.parseJSON(data);
                    if(json.status == 1){
                       //location.reload();
                    }else if(json.status == 2){
                        alert(json.status_messsage);
                        jQuery('.login').css('display','block');
                        $('#loader2').hide();
                    }else if(json.status == 3 || json.status == 4){
                         document.getElementById("otp-verify").classList.add('open-form');
                        document.getElementById("login-area").classList.remove('open-form');
                        $('#otp_mobile_no1').val(datt);
                        jQuery.post(valurl+"otp",{loginmobile:datt,customer_mobile:datt,user_type:1},function(data){
                        });
                        $('.mess').html(json.status_messsage+'.  otp sent to registered email or mobile');
                    }
                });
            }
    });
}
function verifyotps(){ 
    var vsldi = jQuery(".formvalid1").valid();
    if(vsldi){
        jQuery("#loader1").css('display','block'); 
        jQuery('.veri').hide();
        var otp_key         =   jQuery(".otp_key1").val(); 
        var loginmobile     =   jQuery("#otp_mobile_no1").val();
        jQuery.post("/verifyotp",{loginmobile:loginmobile,customer_mobile:loginmobile,otp_key:otp_key,user_type:1},function(data){
            if(data == '0'){
                jQuery("#loader1").css('display','none'); 
                jQuery(".hideotp1").hide();  
                jQuery(".otpdivshide1").show();
                jQuery('.veri').show();
                $('.mess').hide();
                $('.messs').html('wrong Otp entered');
            }else{
                location.reload();
            }
        });
    }
}
function categoryform(){
        jQuery(".sucess,.erreer").html("");
        var vsldi = jQuery(".formvalidvsp").valid();
        let files = new FormData(); // you can consider this as 'data bag'
        files.append('category_upload', jQuery('#file')[0].files[0]); 
        files.append('vendor_mobile', jQuery('#vendor_mobile').val()); 
        files.append('category_name', jQuery('#category_name').val()); 
        if(vsldi){
            jQuery.ajax({
                type    : "POST",
                url     : valurl+"vendor_category_create",
                // data    : jQuery(".formvalidvsp").serialize(), 
                data: files,
                mimeTypes:"multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    var rense = jQuery.parseJSON(response); 
                    if(rense.status == "2"){
                        jQuery(".sucess").html(rense.status_messsage);
                        jQuery(".category_name").val("");
                        jQuery(".category_upload").val("");
                    }else{
                       jQuery(".erreer").html(rense.status_messsage);
                    }
                }
            });
        }
}
function subcategoryform(){
        jQuery(".sucess,.erreer").html("");
        var vsldi = jQuery(".formvsp").valid();
        let files = new FormData(); // you can consider this as 'data bag'
        files.append('subcategory_upload', jQuery('#subcategory_upload')[0].files[0]); 
        files.append('vendor_mobile', jQuery('#vendor_mobile').val());
        files.append('category', jQuery('#category').val());
        files.append('sub_category', jQuery('#sub_category').val()); 
        if(vsldi){
            jQuery.ajax({
                type    : "POST",
                url     : valurl+"vendor_subcategory_create", 
                data: files,
                mimeTypes:"multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    var rense = jQuery.parseJSON(response); 
                    if(rense.status == "2"){
                        jQuery(".sucess").html(rense.status_messsage);
                        jQuery(".sub_category").val("");
                        jQuery(".category").val("");
                        jQuery(".subcategory_upload").val("");
                    }else{
                       jQuery(".erreer").html(rense.status_messsage);
                    }
                }
            });
        }
}
jQuery('#categoryForm,#subcategoryForm').on('hidden.bs.modal', function () {
        location.reload();
})
function verifyotp(){ 
        var vsldi = jQuery(".formvalid").valid();
        if(vsldi){
            jQuery("#loader4").css('display','block'); 
            jQuery('.verii').hide(); 
            var otp_key         =   jQuery(".otp_key").val(); 
            var loginmobile     =   jQuery("#otp_mobile_no").val();
            jQuery.post("/verifyotp",{loginmobile:loginmobile,customer_mobile:loginmobile,otp_key:otp_key,user_type:1},function(data){
                if(data == '0'){
                    jQuery("#loader4").css('display','none');  
                    jQuery(".hideotp").hide();  
                    jQuery(".otpdivshide").show();
                    jQuery('.verii').show();
                    $('.mess').hide();
                    $('.messs').html('wrong Otp entered');
                }else{
                    location.reload();
                }
            });
        }
}
function OpenSignUpForm(){
    jQuery.ajax({
		url: valurl+"Login",
		method: "POST",
		success: function(data) {
			jQuery('.cartlog').html(data);
		}
	});
}
function OpenRegForm(){
    jQuery.ajax({
		url: valurl+"Registration",
		method: "POST",
		success: function(data) {
			jQuery('.cartlog').html(data);
		}
	});
}
function login(){
	var email = jQuery('.email').val();
	var password = jQuery('.password').val();
	jQuery.post(valurl+"Api-Login-Register",{email:email,password:password},function(data){
		alert(data);
		if(data.status =="1"){
			jQuery('.log').css('display','none');
		}else{
			
			jQuery('.msg').html(data.status_messsage);
		}
	});
}
function addtocart(evt){
        var product_id  =   evt.attr("prodid");
        var prodqu      =   evt.attr("prodqu")?evt.attr("prodqu"):jQuery(".qtyval").val();
        var size        =   $("input[name=quantity]:checked").attr('data-value');
        var type        =   $("input[name=indug]:checked").attr('data-type');
        var date        =   $(".datepicker").val();
        var message_on_cake =   $(".message").val();
        var deltype     =   $(".delivery_id").val();
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
            jQuery.ajax({
                type    : "POST",
                url     : valurl+"addtocart",
                data    : "id="+product_id+"&quant="+prodqu+"&size="+size,
                success: function (response) {
					viewquantity();
                    viewcartprice();	
                    jQuery(".cart_list").html(currency+' '+response);
                    //var amountt     =   $('#delamountt').val();
                    //var amountt = amountt.match(/[\d\.]+/g);
                    //jQuery("#del_price").html(currency+' '+amountt);
                    //var rowi     =   $('#rowww').val();
                    //jQuery("#rowwww").val(rowi);
                    //var basamountt     =   $('#baseamountt').val();
                    //var basamountt = basamountt.match(/[\d\.]+/g);
                    //jQuery("#base_price").html(currency+' '+basamountt);
                    //var tot = parseFloat(amountt)+parseFloat(basamountt);
                    //jQuery("#totals").html(currency+' '+tot);
                    //jQuery("#produc").val(product_id);
                    //document.getElementById("addons").classList.add('open-form');
					
                }
            });
        
}
function viewquantity(){
    jQuery.post(valurl+"viewquantity",function(data){
            jQuery(".count").html(data);
            jQuery(".count1").html(data);
            jQuery(".count2").html(data);
    });
}
function viewcartprice(){
    jQuery.post(valurl+"viewcartprice",function(data){
        jQuery.post(valurl+"ajax_checkout",function(data){
                jQuery("#ajax_cart_ddd").html(data);
            });
            //jQuery(".price1").html(data);
            //jQuery(".price2").html(data);
            //jQuery("input[name=cart_amount]").val(data);
             jQuery(".price").html(data);
            // jQuery(".price1").html(data);
            // jQuery(".price2").html(data);
    });
}
function removecart(id,rowid){
    // var answer = confirm ("Are you sure you want to delete ?");
    // if (answer){
        jQuery.ajax({
                type: "POST",
                url: valurl+"removecart",
                data: "id="+id+"&rowid="+rowid,
                success: function (response) {
                    jQuery(".cart_list").html(response);
                    viewquantity();
                    viewcartprice();
                    cartopen();
                    jQuery(".idvalue"+id).remove();                               
                }
        });
    // }
}

function calender(evt,page){
    var title   =   $('.datepicker').val();
    $.post(page,{title:title},function(data){
        $('#deliverytypes').css('display','none');
        $("#deliverytypes .deliverytypes-header").html(title);
        $("#deliverytypes .deliverytypes-content").html(data);
        $('#deliverytypes').css('display','flex');
        document.getElementById("deliverytypes").classList.add('open-form');
    });
}
function deliverytypeid(eve){
    var delitype = $("input[name=devliry_type]:checked").attr('data-type');
    var title    = $("input[name=devliry_type]:checked").attr('data-title');
    var date     = $(".datepicker").val();
    if(delitype !=""){
        document.getElementById("deliverytypes").classList.remove('open-form');
        $('#deliverytypes').css('display','none');
        jQuery.post(valurl+"Delivery-Chages",{delitype:delitype,date:date},function(data){
            if(data){
                document.getElementById("deliverychange").classList.add('open-form');
                $('#deliverychange').css('display','flex');
                $("#deliverychange .deliverychange-header").html(title);
                $("#deliverychange .deliverychange-content").html(data);
            }
        });
    }
}
function deliverychage(){
    var title = $('#delitype').attr('data-title');
    var datavalue = $('#delitype').attr('data-value');
    var date = $('.datepicker ').val();
    var value = $("input[name=devliry_chage]:checked").val();
    if(title !="" && datavalue !="" && value != ""){
        jQuery.post(valurl+"Delivery-Chages-Check",{title:title,datavalue,datavalue,value:value,date:date},function(data){
            if(data){
                document.getElementById("deliverychange").classList.remove('open-form');
                $('#deliverychange').css('display','none');
                $(".delichane").html(data);
            }
        });
    }
}
function backdeliver(){
    document.getElementById("deliverychange").classList.remove('open-form');
    $('#deliverychange').css('display','none');
    $('#deliverytypes').css('display','flex');
    document.getElementById("deliverytypes").classList.add('open-form');
}
function deliverytypesclose(){
    document.getElementById("deliverytypes").classList.remove('open-form');
}
function deliverychangeclose(){
    document.getElementById("deliverychange").classList.remove('open-form');
}
function autoproduct(evt){
    evt.autocomplete({
        source: function (request, response) { 
            jQuery.getJSON(valurl+"viewproducts?query=" + request.term, function (data) {  
                response(jQuery.map(data, function (value, key) { 
                    return {
                        label: value.name,
                        value: value.pid
                    };
                }));
            });
        },
        select: function (event, ui) {  
            var label = ui.item.label;
            var value = ui.item.value;  
            jQuery("#FilterTextBox").val(label); 
            jQuery("#FilterTextBoxval").val(label);
            jQuery("#FilterTextBox").attr("type","hidden"); 
            jQuery("#FilterTextBoxval").attr("type","text"); 
        }
    }); 
}
function cartopen(){
	$('.cartlog').html('<span class="postList"></span>');
    $("#sitebar-cart").addClass('open-cart');
    $("#sitebar-drawar").addClass('hide-drawer');
    var url = $('.opencart').attr('data-lar');
    searchFilter('', url);
}
function closecart(){
	$('.or-ofcanvas-cart-wrapper').removeClass("or-canvas-cart-on");
}
function opencart() {
      jQuery.ajax({
          type: "POST",
//                  url: "<?php echo base_url('welcome/opencart');?>",
          data: "",
          success: function (response) {
            jQuery(".displaycontent").html(response);
          }
      });
}
jQuery(document).ready(function() {
    jQuery('#vendor_state').change(function() {
        var state_id = jQuery('#vendor_state').val();
        if (state_id != '') {
            
            jQuery.ajax({
                url: valurl+"districts",
                method: "POST",
                data: {
                    state_id: state_id
                },
                success: function(data) {
                    jQuery('#vendor_district').html(data);
                }
            });
        } else {
            jQuery('#vendor_district').html('<option value="">Select District</option>');
        }
    });

    jQuery('#districtid').change(function() {
        var district_id = jQuery('#districtid').val();
        if (district_id != '') {
            jQuery('#pincode').html('<option value="">Select Pincode</option>');
            jQuery.ajax({
                url: valurl+"districtlist",
                method: "POST",
                data: {
                    district_id: district_id
                },
                success: function(data) {
                    jQuery('#Areaid').html(data);
                }
            });
        } else {
            jQuery('#Areaid').html('<option value="">Select Area</option>');
            jQuery('#pincode').html('<option value="">Select Pincode</option>');
        }
    });
    jQuery('#Areaid').change(function() {
        var district_id = jQuery('#districtid').val();
        var area_id     = jQuery('#Areaid').val();
        if (district_id != '') {
            jQuery.ajax({
                url: valurl+"AreaList",
                method: "POST",
                data: {
                    district_id: district_id,
                    area_id : area_id,
                },
                success: function(data) {
                    jQuery('#pincode').html(data);
                }
            });
        }
    });
    
    jQuery('#vendor_district').change(function() {
        var district_id = jQuery('#vendor_district').val();
        if (district_id != '') {
            jQuery.ajax({
                url: valurl+"mandals",
                method: "POST",
                data: {
                    district_id: district_id
                },
                success: function(data) {
                    jQuery('#vendor_mandal').html(data);
                }
            });
        } else {
            jQuery('#vendor_mandal').html('<option value="">Select Mandal</option>');
        }
    });

    jQuery('#vendor_mandal').change(function() {
        var mandal_id = jQuery('#vendor_mandal').val();
        if (mandal_id != '') {
            jQuery.ajax({
                url: valurl+"gramapanchayats",
                method: "POST",
                data: {
                    mandal_id: mandal_id
                },
                success: function(data) {
                    jQuery('#vendor_gramapanchayat').html(data);
                }
            });
        } else {
            jQuery('#vendor_gramapanchayat').html('<option value="">Select Gramapanchayat</option>');
        }
    });

});
jQuery(document).ready(function(){
    jQuery('#category_id').change(function(){
        var category_id = jQuery('#category_id').val();
        if(category_id != ''){
            jQuery.ajax({
                url:valurl+"subcategory",
                method:"POST",
                data:{category_id:category_id},
                success:function(data){
                    jQuery('#subcategory_name').html(data);
                }
            });
        }
        else{
            jQuery('#subcategory_name').html('<option value="">Select Subcategory</option>');
        }
    });
});
/*function updatecart(evt){
        var prdid       =   evt.attr("prodid"); //prod id
        var prodrowid   =   evt.attr("prodrowid"); //prod rowid
        var valprp      =   evt.attr("valprp"); //qty
        var lprp        =   jQuery(".qtyval"+prdid).val(); // qtyvalue+prod id
        var priceval    =   jQuery(".priceval"+prdid).val(); //+prod id
        if(valprp == "0"){
            var vsp     =   parseInt(lprp)-1;
        }else{
            var vsp     =   parseInt(lprp)+1;
        }
        var vspr        =   parseFloat(priceval)*parseFloat(vsp);
        jQuery(".qtyval"+prdid).val(vsp);
        jQuery(".amounval"+prdid).html("<i class='fa fa-inr'></i>"+vspr);
        jQuery.ajax({
                type    : "POST",
                url     : valurl+"updatetocart",
                data    : "id="+prodrowid+"&quant="+vsp, 
                success: function (response) {
                    jQuery(".cart_list").html(response);
                    viewquantity();
                    viewcartprice();
                    cartopen();
                }
        });
}
function updatecarts(evt){
        var prdid       =   evt.attr("prodid"); //prod id
        var prodrowid   =   evt.attr("prodrowid"); //prod rowid
        var valprp      =   evt.attr("valprp"); //qty
        var lprp        =   jQuery(".qtyval"+prdid).val(); // qtyvalue+prod id
        var priceval    =   jQuery(".priceval"+prdid).val(); //+prod id
        if(valprp == "0"){
            var vsp     =   parseInt(lprp)-1;
        }else{
            var vsp     =   parseInt(lprp)+1;
        }
        var vspr    =   parseFloat(priceval)*parseFloat(vsp);
        jQuery(".qtyval"+prdid).val(vsp);
        jQuery(".amounval"+prdid).html("<i class='fa fa-inr'></i>"+vspr);
        jQuery.ajax({
                type    : "POST",
                url     : valurl+"updatetocart",
                data    : "id="+prodrowid+"&quant="+vsp, 
                success: function (response) {
                    jQuery(".cart_list").html(response);
                    viewquantity();
                    viewcartprice();
                }
        });
}*/
function updatecart(evt){
    var prdid       =   evt.attr("prodid"); //prod id
    var prodrowid   =   evt.attr("prodrowid"); //prod rowid
    var valprp      =   evt.attr("valprp"); //qty
    var lprp        =   evt.val();  
    if(lprp ==''){
        var lprp        =   jQuery(".qtyval"+prdid).val(); // qtyvalue+prod id
    }  
    var priceval    =   jQuery(".priceval"+prdid).val(); //+prod id
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
    if(lprp > 0){
        if(valprp == "0"){
            var vsp     =   parseInt(lprp)-1;
            if(vsp == 1){
                jQuery('.dsc'+prodrowid).prop('disabled', true);   
            }else{
                jQuery('.dsc'+prodrowid).prop('disabled', false);  
            }
        }else  if(valprp == "2"){
            var vsp     =   parseInt(lprp);
            if(vsp == 1){
                jQuery('.dsc'+prodrowid).prop('disabled', true);   
            }else{
                jQuery('.dsc'+prodrowid).prop('disabled', false);  
            }
        }else  if(valprp == "1"){
            var vsp     =   parseInt(lprp)+1;
             if(vsp ==  1){
                jQuery('.dsc'+prodrowid).prop('disabled', false);   
            }else{
                jQuery('.dsc'+prodrowid).prop('disabled', false);  
            }
        }
    }else{
        var vsp     =   1;
    }
    var vspr    =   parseFloat(priceval)*parseFloat(vsp);//
    if (isNaN(vspr)) {
        vspr    =   "0";
    }
    jQuery(".qtyvals"+prdid).val(vsp);
    if(evt.val()){
        evt.val(vsp);
    }else{
        //jQuery(".qtyval"+prdid).val(vsp);
    }
    jQuery(".amounval"+prdid).html('<b>'+currency+vspr.toFixed(2)+'</b>');
    jQuery.ajax({
            type    : "POST",
            url     : valurl+"updatetocart",
            data    : "id="+prodrowid+"&quant="+vsp, 
            success: function (response) {
                $(".cart_list").html(response);
                viewquantity();
                viewcartprice();
            }
    });
    if(vsp==0){
        removecart(prdid,prodrowid);
    }
}
function updatecarts(evt){
    var prdid       =   evt.attr("prodid"); //prod id
    var prodrowid   =   evt.attr("prodrowid"); //prod rowid
    var valprp      =   evt.attr("valprp"); //qty
    var lprp        =   evt.val();  
    if(lprp ==''){
        var lprp        =   jQuery(".qtyval"+prdid).val(); // qtyvalue+prod id
    }  
    var priceval    =   jQuery(".priceval"+prdid).val(); //+prod id
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
    if(lprp > 0){
        if(valprp == "0"){
            var vsp     =   parseInt(lprp)-1;
            if(vsp == 1){
                jQuery('.dsc'+prodrowid).prop('disabled', true);   
            }else{
                jQuery('.dsc'+prodrowid).prop('disabled', false);  
            }
        }else  if(valprp == "2"){
            var vsp     =   parseInt(lprp);
            if(vsp == 1){
                jQuery('.dsc'+prodrowid).prop('disabled', true);   
            }else{
                jQuery('.dsc'+prodrowid).prop('disabled', false);  
            }
        }else  if(valprp == "1"){
            var vsp     =   parseInt(lprp)+1;
             if(vsp ==  1){
                jQuery('.dsc'+prodrowid).prop('disabled', false);   
            }else{
                jQuery('.dsc'+prodrowid).prop('disabled', false);  
            }
        }
    }else{
        var vsp     =   1;
    }
    var vspr    =   parseFloat(priceval)*parseFloat(vsp);//
    if (isNaN(vspr)) {
        vspr    =   "0";
    }
    jQuery(".qtyval"+prdid).val(vsp);
    if(evt.val()){
        evt.val(vsp);
    }else{
        //jQuery(".qtyvals"+prdid).val(vsp);
    }
    jQuery(".amounval"+prdid).html('<b>'+currency+vspr.toFixed(2)+'</b>');
    jQuery.ajax({
            type    : "POST",
            url     : valurl+"updatetocart",
            data    : "id="+prodrowid+"&quant="+vsp, 
            success: function (response) {
                $(".cart_list").html(response);
                viewquantity();
                viewcartprice();
            }
    });
    if(vsp==0){
        removecart(prdid,prodrowid);
    }
}

function loginotp(){
        jQuery("#modalLRForm").modal("show");
}
function wishlist(evt){
        //alert(evt.attr("vendorprdo"));
        var vendorprdo   =   evt.attr("vendorprdo");
        var wishlistid   =   evt.attr("wishlistid");
        var loginmpobile =   evt.attr("loginmpobile");
        var login        =   evt.attr("login");
        if(login == ''){
            jQuery("#modalLRForm").modal("show");
        }else{
            if(wishlistid == ''){
                jQuery.post(valurl+"customer_add_to_wishlist",{vendorproduct_id:vendorprdo,customer_mobile:loginmpobile},function(data){
                    var vsp     =   JSON.parse(data);
                    if(vsp.status == '4'){
                        jQuery('.wish'+vendorprdo).removeClass("fa-heart-o");
                        jQuery('.wish'+vendorprdo).addClass("fa-heart"); 
                    } 
                });
            }else{
                removewishlist(wishlistid,loginmpobile,vendorprdo);
            }
        }
}
function removewishlist(wishlistid,loginmpobile,vendorprdo){
    jQuery.post(valurl+"customer_delete_wishlist",{wishlist_id:wishlistid,customer_mobile:loginmpobile},function(data){
        var vsp     =   JSON.parse(data);
        if(vsp.status == '4'){
            jQuery('.wish'+vendorprdo).addClass("fa-heart-o");
            jQuery('.wish'+vendorprdo).removeClass("text-danger"); 
            jQuery('.wish'+vendorprdo).removeClass("fa-heart"); 
            jQuery('.removwish'+wishlistid).remove(""); 
            evt.attr("wishlistid",""); 
        } 
    });
}
function verifyotpvalue(){ 
        var vsldi = jQuery(".formvalid").valid();
        if(vsldi){
            var otp_key       =   jQuery(".otp_key").val();
            var user_type     =   "1";
            var loginmobile   =   jQuery("#otp_mobile_no").val();
            jQuery.post("/verifyotp",{loginmobile:loginmobile,customer_mobile:loginmobile,otp_key:otp_key,user_type:user_type},function(data){
                if(data == '0'){  
                    jQuery(".otpdivshide").hide();   
                    jQuery(".palced").attr("onclick","checkoutvalue()");  
                    jQuery(".palced").val("Place Order");  
                } else{
                    jQuery(".checkout").submit();
                }
            });
        }
}
function checkoutvalue(){
        var vsformvalid     =   jQuery(".formvalid").valid();
        if(vsformvalid){
            var loginmobile   =   jQuery("#otp_mobile_no").val();
            jQuery.post(valurl+"otp",{loginmobile:loginmobile,customer_mobile:loginmobile,user_type:1},function(data){
                if(data){ 
                    jQuery(".otpdivshide").show();   
                    jQuery(".palced").attr("onclick","verifyotpvalue()");  
                    jQuery(".palced").val("Verify OTP");  
                }
            });
        }
}

function openModal(evt,page){  
    $(".postList").html("");
    var title   =   evt.attr("title");
    $.post(page,function(data){ 
        $(".product-details-popup .modal-title").html(title);
        $(".product-details-popup .modal-body").html(data);
        $(".product-details-popup").addClass("open-side");
    });
}
function changecurrency(){
    var currency  =   jQuery('.currency option:selected').val();
    jQuery.ajax({
            type    : "POST",
            url     : valurl+"Update-Currency",
            data    :  "currency="+currency,
            success: function (response) {
               location.reload(true);
               //console.log(response);
            }
    });
}
function changerate(eve){
    var size = $('.size'+eve).attr('data-value');
    var type = $("input[name=indug]:checked").attr('data-type');
    var prodid = $(".buy-now").attr('prodid');
    if(size !="" && prodid !=""){
        jQuery.post(valurl+"Change-Price",{size:size,type:type,prodid:prodid},function(data){
            if(data){
                jQuery(".prices").css('display','none');
                jQuery(".pricedetails").html(data);
            }
        });
    }
}
function changeratess(eve){
    var size = $('.size'+eve).attr('data-value');
    var type = $("input[name=indug]:checked").attr('data-type');
    var prodid = $('.size'+eve).attr('data-ids');
    if(size !="" && type !="" && prodid !=""){
        jQuery.post(valurl+"Change-Price",{size:size,type:type,prodid:prodid},function(data){
            if(data){
                jQuery(".buy-now").attr("prodid",prodid);
                jQuery(".prices").css('display','none');
                jQuery(".pricedetails").html(data);
            }
        });
    }
}
function changerates(eve){
    var type = $("input[name=indug]:checked").attr('data-type');
    var prodid = $(".prodid").val();
    if(type !="" && prodid !=""){
        jQuery.post(valurl+"Change-Rates",{prodid:prodid,type:type},function(data){
            if(data){
                jQuery(".qty-rates").css('display','none');
                jQuery(".new-qty-rates").html(data);
                changerate(eve);
            }
        });
    }
}
function paybutton(eve){
    var type = eve;
    if(type !=""){
        if(type == "Razorpay"){
            $('.Razorpay').css('display','block');
            $('.Ccavenue').css('display','none');
        }else if(type =="Ccavenue"){
            $('.Razorpay').css('display','none');
            $('.Ccavenue').css('display','block');
        }
       //jQuery.post(valurl+"Pay-Button",{type:type},function(data){
       //    if(data){
       //        jQuery(".paybutton").html(data);
       //    }
       //});
    }
}
function checkoutaddress(eve){
    var che = $('#addressids:checked').length;
    if(che == 0){
        $('.addressid').val('');
        $('.msg').html('Choose Delivery Address.');
        $('.CheckOut').attr("disabled", "disabled");
        $('.razorpay-payment-button').attr("disabled", "disabled");
    }else{
        $('.msg').html('');
        $('.addressid').val(eve);
        $('.CheckOut').removeAttr('disabled');
        $('.razorpay-payment-button').removeAttr('disabled');
    }
}
    function districtida(){
        var district_id = $('#districtid').val();
        var select  =   $('.Areaid').attr('data-value');
        if (district_id != '' && select != '') {
            $('#pincode').html('<option value="">Select Pincode</option>');
            $.ajax({
                url: valurl+"districtlist",
                method: "POST",
                data: {
                    district_id: district_id,
                    select:select
                },
                success: function(data) {
                    $('#Areaid').html(data);
                }
            });
        } else {
            $('#Areaid').html('<option value="">Select Area</option>');
            $('#pincode').html('<option value="">Select Pincode</option>');
        }
    }
    function Areaid(){
        var district_id = $('#districtid').val();
        var area_id     = $('#Areaid').val();
        var pincode     = $('#pincode').attr('data-value');
        if (district_id != '') {
            $.ajax({
                url: valurl+"AreaList",
                method: "POST",
                data: {
                    district_id: district_id,
                    area_id : area_id,
                    pincode:pincode
                },
                success: function(data) {
                    $('#pincode').html(data);
                }
            });
        }
    }
    function newsletter(){
        alert($('#newsletter').val());
    }
    
    function buynoww(evt){
        addtocart(evt);
        var date        =   $(".datepicker").val();
        if(date !=""){
            window.location.href = 'https://www.minikart.in/View-Cart';
        }
    }
    
    function applyCoupon(){
        coupon = $('#coupon').val();
        jQuery.post(valurl+"Coupon",{coupon_code:coupon},function(data){
                var data    = JSON.parse(data);
                var message = data['status_messsage'];
                if(data['status']=="4"){
                    $('#coupon_error').empty();
                    $('#coupon_error').append('<span class="text-success"><i class="fa fa-check" aria-hidden="true"></i> Coupon Applied</span>');
                }else{
                    $('#coupon_error').empty();
                    $('#coupon_error').append('<span class="text-danger"><i class="fa fa-times" aria-hidden="true"></i> '+message+'</span>');
                }
                    viewquantity();
                    viewcartprice();
            });
        
    }
    
jQuery(function () {
    initPart();  
    input_rest();
});