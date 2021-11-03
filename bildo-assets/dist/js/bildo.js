var valurl = "/dbody/"; 
var adminurl = "/dbody/Dbody-Admin";
function pageform(){
        $(".pageurl,.pagewidgets,.rightcontent,.contentpage,.leftcontent").hide();
        $(".left_widget,.contet_widget,.right_widget").hide();
        $(".page_url").removeAttr("required");
        var page_layout     =   $(".page_layout option:selected").attr("atrvalue");
        var content_from    =   $('.page_content option:selected').attr("atrvalue");  
        if(content_from == '1'){
                $(".page_layout").removeAttr("required");
                $(".pageurl").show();
                $(".page_url").attr("required","required");
        }
        if(content_from == '2' && page_layout == '1'){
                $(".leftcontent").show(); 
                $(".contentpage").show();
        }
        if(content_from == '2' && page_layout == '2'){
                $(".contentpage").show();
                $(".rightcontent").show(); 
        }
        if(content_from == '2' && page_layout == '3'){
                $(".contentpage").show(); 
        }
        if(content_from == '2' && page_layout == '4'){
                $(".leftcontent").show(); 
                $(".contentpage").show();
                $(".rightcontent").show(); 
        }
        if(content_from == '3'){ 
                $(".pagewidgets").show();
        }
        if(content_from == '3' && page_layout == '1'){ 
                $(".left_widget").removeClass().addClass("left_widget col-md-4").show(); 
                $(".contet_widget").removeClass().addClass("contet_widget col-md-8").show();
                $(".right_widget").removeClass().addClass("right_widget");
                
        }
        if(content_from == '3' && page_layout == '2'){ 
                $(".left_widget").removeClass().addClass("left_widget");
                $(".contet_widget").removeClass().addClass("contet_widget span7 col-md-7").show();
                $(".right_widget").removeClass().addClass("right_widget span4 col-md-4").show(); 
                
        }
        if(content_from == '3' && page_layout == '3'){  
                $(".left_widget").removeClass().addClass("left_widget");
                $(".right_widget").removeClass().addClass("right_widget");
                $(".contet_widget").removeClass().addClass("contet_widget col-md-12").show();
                
        }
        if(content_from == '3' && page_layout == '4'){ 
                $(".left_widget").removeClass().addClass("left_widget col-md-4").show(); 
                $(".contet_widget").removeClass().addClass("contet_widget col-md-4").show();
                $(".right_widget").removeClass().addClass("right_widget col-md-4").show();
                
        }
}
$(function () {
    $('#menu-form .dd').nestable(); 
    $('#menu-form .dd').on('change', function () {
            var data =  [];
            jQuery('.dd-item').each(function(){
                    var id 		= jQuery(this).attr('data-id');
                    var parent  = jQuery(this).parent().parent().attr('data-id');
                    if(typeof parent == 'undefined')
                            parent = 0;
                    var menu = {'id':id,'parent':parent};
                    data.push(menu);
            });
            $.post(adminurl+"/update_menu",{menu:JSON.stringify(data)},function(data){ 
            }); 
    });
    $('.row_nest .page_widgets .dd,.row_nest .left_widget .dd,.row_nest .contet_widget .dd,.row_nest .right_widget .dd').nestable({
            maxDepth:1
    });  
    menuInit();
});
function vendorview(evt){
    var vendorid    =   evt.attr("vendorid");
    $.post(adminurl+"/vendorview/"+vendorid,function(data){ 
            $(".viewModal .modal-title").html("Vendor View"); 
            $(".viewModal .modal-body").html(data);
            $(".viewModal").modal("show");
    }); 
}
var menuInit    =   function(){ 
    $('.row_nest .left_widget .dd').on('change', function () {
            var lefst = []; 
            $('.row_nest .left_widget .dd-item').each(function(){
                    var lid      =   $(this).attr('data-id');  
                    lefst.push(lid);  
            });
            $(".left_contentval").val(lefst.join(","));
    });
    $('.row_nest .contet_widget .dd').on('change', function () {
            var cnt = []; 
            $('.row_nest .contet_widget .dd-item').each(function(){
                    var lid      =   $(this).attr('data-id');  
                    cnt.push(lid);  
            });
            $(".page_conentval").val(cnt.join(",")); 
    });
    $('.row_nest .right_widget .dd').on('change', function () {
             var dcnt = []; 
            $('.row_nest .right_widget .dd-item').each(function(){
                    var lid      =   $(this).attr('data-id');  
                    dcnt.push(lid);  
            });
            $(".right_contentval").val(dcnt.join(",")); 
    });
}
var initPart = function () {
    $(document).find('a[data-type="order"]').each(function () {
        if ($(this).data("field") == $("#tipoOrderby").val()) {
            if ($("#orderby").val() == "ASC") {
                $(this).data("order", "DESC");
                $("i", this).addClass('fa-sort-desc');
            } else {
                $("i", this).addClass('fa-sort-asc');
                $(this).data("order", "ASC");
            }
        } else {
            $("i", this).addClass('fa-sort');
            $(this).data("order", "ASC");
        }

        $("i", this).css('color', "blue");
    });
}
var input_rest = function () {
    $(".input_num").keypress(function (event) {
        var inputValue = event.which;
        if (!(inputValue >= 48 && inputValue <= 57) && (inputValue != 0 && inputValue != 8)) {
            event.preventDefault();
        }
    });
    $(".input_geo").keypress(function (event) {
        var inputValue = event.which;
        if (!(inputValue >= 48 && inputValue <= 57) && (inputValue != 0 && inputValue != 8 && inputValue != 46)) {
            event.preventDefault();
        }
    });
    $(".input_char").keypress(function (event) {
        var inputValue = event.which;
        if (!(inputValue >= 65 && inputValue <= 122) && (inputValue != 0 && inputValue != 8 && inputValue != 32 && inputValue != 46 && inputValue != 0)) {
            event.preventDefault();
        }
    });
    $(".upperceaseval").keypress(function(event){
            $(this).css("text-transform","uppercase"); 
    });
    $(".capitalizeval").keypress(function(event){
            $(this).css("text-transform","capitalize"); 
    });
};
function getdatafiled(event) {
    initPart();
    $("#tipoOrderby").val(event.data("field"));
    $("#orderby").val(event.data("order"));
    searchFilter('', event.attr("urlvalue"));
}
function user_role() {
    $(".ajaxListPer").html("");
    $('.pageloaderwrapper').show();
    var vale = [];
    var modiul = [];
    $(".user_roles option:selected").map(function (i, el) {
        vale[i] = $(el).val();
    });
    $(".user_modules option:selected").map(function (fs, els) {
        modiul[fs] = $(els).val();
    });
    $.post(adminurl + "/ajaxPermission", {vale: vale, modiul: modiul}, function (data) {
        $('.pageloaderwrapper').hide();
        $(".ajaxListPer").html(data);
    });
} 
function changekeyvalue(event) {    
        var spval   =   event.attr("atrvalue");
        if(spval == '1'){
            event.html('<i class="fa font25rem fa-table text-info"></i>');
            event.attr("atrvalue","0");
            $(".grdview").val("0");
        }else{
            event.attr("atrvalue","1");
            $(".grdview").val("1");
            event.html('<i class="fa font25rem fa-th-large text-info"></i>');
        }
        searchFilter('',event.attr("urlvalue"));
} 
function master_check(evt){
        var svsp    =   evt.is(":checked");
        var svpp    =   evt.val();
        if(svsp){ 
                $(".check_"+svpp).attr("checked","checked");
        }else{
                $(".check_"+svpp).removeAttr("checked");
        } 
}
function searchFilter(page_num, url) {
    page_num = page_num ? page_num : 0;
    var modalval = $('.modalval').val() ? $('.modalval').val() : '0';
    var category = $('#category').val();
    var subcategory = $('#subcategory').val();
    var types = $('#types').val();
    var keywords = $('#FilterTextBox').val();
    var limitvalue = $('.limitvalue option:selected').val();
    var spclasss = 'postList';
    $('.' + spclasss).html("<i class='fa fa-4x text-success fa-spinner fa-spin'></i>");
    if (modalval == '1') {
        spclasss = 'postListper';
        keywords = $('#FilterTextBox1').val();
        limitvalue = $('.limitvalue1 option:selected').val();
    }
    $.ajax({
        type: 'POST',
        url: url + page_num,
        data: {
            tipoOrderby: $("#tipoOrderby").val(),
            orderby: $("#orderby").val(),
            keywords: keywords,
            limitvalue: limitvalue,
            category: category,
            subcategory: subcategory,
            types: types,
            inplay: $(".inplay option:selected").val(),
            reports: $(".reports option:selected").val()
        },
        beforeSend: function () {
            $('.pageloaderwrapper').show();
        },
        success: function (html) {
            $('.pageloaderwrapper').hide();
            $('.' + spclasss).html(html);
            initPart();
        }
    });
}

function confirmationDelete(anchor, val) {
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        var atr     =   anchor.attr("attrvalue");
            $.post(atr,function(data){
                if(data == 1){
                    location.reload();
                }else if(data == 0){
                        swal("No permissions ....!!!", '');
                    } else {
                        swal("Not updated any ....!!!", '');
                    }
            });
            swal.close();
      } else {
        swal("Not Deleted any "+val);
      }
    });
    /*swal({
        title: "Delete " + val,
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((isConfirm) => {
        if (isConfirm) {
            var atr     =   anchor.attr("attrvalue");
            $.post(atr,function(data){
                if(data == 1){
                    location.reload();
                }else if(data == 0){
                        swal("No permissions ....!!!", '');
                    } else {
                        swal("Not updated any ....!!!", '');
                    }
            });
            swal.close();
        } else {
            swal("Not Deleted any "+val);
        }
    });*/
   
}
var validformInit   =   function(){
        $(".validform").validate({
            errorElement:"div",
            errorClass:"text-danger",
            errorPlacement: function (error, element) {
                if (element.attr("type") == "radio") {
                    error.insertAfter($(element).parent());
                }else if(element.parent().hasClass('input-group')){
                    error.insertAfter($(element).parent());
                }  else {
                    error.insertAfter($(element));
                } 
            },
            highlight: function ( element, errorClass, validClass ) {  
                $( element ).addClass( 'has-danger' ).removeClass( 'has-success' );
            },
            unhighlight: function (element, errorClass, validClass) {  
                $( element ).addClass( 'has-success' ).removeClass( 'has-danger' );
            },
            onfocusout: function(element) {
                this.element(element); //< inside 'validate()' method, this is like 'valid()'
            },
            rules:{
                 role_name:{
                    remote:{
                        url:adminurl+"/unique_role_name",
                        type:"post",
                        data:{
                            role_name:function(){
                                return  $(".role_name").val();
                            }
                        }
                    }
                },  
                category_name:{
                    remote:{
                        url:adminurl+"/unique_category_name",
                        type:"post",
                        data:{
                            category_name:function(){
                                return  $(".category_name").val();
                            }
                        }
                    }
                }, 
                sub_category:{
                    remote:{
                        url:adminurl+"/unique_subcategory_name",
                        type:"post",
                        data:{
                            sub_category:function(){
                                return  $(".sub_category").val();
                            }
                        }
                    }
                }, 
                 measure_unit:{
                    remote:{
                        url:adminurl+"/unique_measure_name",
                        type:"post",
                        data:{
                            sub_category:function(){
                                return  $(".measure_unit").val();
                            }
                        }
                    }
                }, 
                
                login_name:{
                    remote:{
                        url:adminurl+"/unique_check_user",
                        type:"post",
                        data:{
                            login_value:function(){
                                return  $(".login_name").val();
                            },
                            field:"l.login_name"
                        }
                    }
                },
                login_email:{
                    remote:{
                        url:adminurl+"/unique_check_user",
                        type:"post",
                        data:{
                            login_value:function(){
                                return  $(".login_email").val();
                            },
                            field:"l.login_email"
                        }
                    }
                }, 
                
            },
            messages:{
                 
                role_name:{
                        required:"Role Name is required",
                        remote: jQuery.validator.format('<span class="text-success">"{0}"</span> : Role Name already exists.') 
                },
                category_name:{
                        required:"Category Name is required",
                        remote: jQuery.validator.format('<span class="text-success">"{0}"</span> : Category Name already exists.') 
                },
                sub_category:{
                        required:"SubCategory Name is required",
                        remote: jQuery.validator.format('<span class="text-success">"{0}"</span> : SubCategory Name already exists.') 
                },
                 measure_unit:{
                        required:"Measure Unit is required",
                        remote: jQuery.validator.format('<span class="text-success">"{0}"</span> : Measure Unit already exists.') 
                },
                cpwd:"Confirm Password is Required",
                new_password:"Password is required",
                //category_name: "Category is required",
                category: "Category is required",
                 //sub_category: "Subcategory name is required",
                category_upload:"Category Image is required",
                banner_title : "Banner Name is required",
                banner_image : "Banner Image is required",
                package_name  : "Package Name is required",
                package_price  : "Package Price is required",
                package_expiry  : "Package Expiry is required",
                package_banners  : "No of Banners are required",
            }
        });
}
jQuery(document).ready(function(){
    jQuery('#category_id').change(function(){
        var category_id = jQuery('#category_id').val();
        var ids = jQuery('#category_id').attr('data-ids');
        var urls = jQuery('#category_id').attr('urlvalue');
        if(category_id != ''){
            var id = 0;
            jQuery.ajax({
                url:"/subcategory",
                method:"POST",
                data:{category_id:category_id},
                success:function(data){
                    jQuery('#category').val(category_id);
                    jQuery('#subcategory_name').html(data);
                    ingredients(category_id,id);
                    if(category_id == "CAT4"){
                        $('.price-list').css('display','none');
                        $('.prices-list').css('display','block');
                    }else{
                        $('.prices-list').css('display','none');
                        $('.price-list').css('display','block');
                    }
                    if(urls !=""){
                        //searchFilter('',urls);
                    }
                }
            });
        }
        else{
            jQuery('#subcategory_name').html('<option value="">Select Subcategory</option>');
        }
    });
});
jQuery(document).ready(function(){
    jQuery('#subcategory_name').change(function(){
        var category_id = jQuery('#category_id').val();
        var subcategory = jQuery('#subcategory_name').val();
        var urls = jQuery('#category_id').attr('urlvalue');
        if(subcategory != ''){
            jQuery('#subcategory').val(subcategory);
            if(urls !=""){
                //searchFilter('',urls);
            }
        }
    });
});

function ingredients(category_id,id){
    if(category_id != ''){
        if(id !=""){ 
            jQuery.ajax({
                url:adminurl+"/Ingredients-List",
                method:"POST",
                data:{category_id:category_id},
                success:function(data){
                    $('.ingredientslist'+id).html(data);
                }
            });
        }else{
            jQuery.ajax({
                url:adminurl+"/Ingredients-List",
                method:"POST",
                data:{category_id:category_id},
                success:function(data){
                    $('.ingredientslist').html(data);
                    sizes();
                }
            });
        }
    }
}
function sizes(){
    if(category_id != ''){
        if(id !=""){
            jQuery.ajax({
                url:adminurl+"/Sizes-Lists",
                method:"POST",
                data:{category_id:category_id},
                success:function(data){
                    $('.ingredientslists').html(data);
                }
            });
        }
    }
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

function changeexpiry(ecvt){
    var vsp     =   ecvt.html();
    $(".btnpackage").html(vsp);
    $(".btnpackageval").val(vsp);
}
function productchange(){
    var vendorproduct_category  =   $(".vendorproduct_category option:selected").val();
    $.post(adminurl + "/ajaxSubcategory", {vendorproduct_category:vendorproduct_category}, function (data) {
        $('.vendorproduct_subcategory').html(data);
    });
}

function myevent(action){
    if($("#category_id option:selected").val()){
    var eve = $("#category_id").attr('data-value');
	localStorage.i = Number(1);
    var i = Number(localStorage.i);
    var div = document.createElement('div');
    if(action.id == "add"){
        var category_id = $("#category_id option:selected").val();
        //localStorage.i = Number(localStorage.i) + Number(1);
        var i = parseInt(eve)+parseInt(1);
        var id = i;
        var ids = i;
        div.id = id;
        ingredients(category_id,i);
        
        $.post(adminurl + "/Measure-List", function (data){
            var option  = data;
            $('.vendorproduct_bb_measure'+i).html(data);
        });
        
        $("#category_id").attr('data-value',i);
        div.innerHTML = '<div class="row"><div class="col-md-11"><div class="row">'
                        +'<div class="col-md-3">'
                            +'<div class="form-group">'
                                +'<label>Type <span class="required text-danger">*</span></label>'
                                +'<select class="form-control ingredientslist'+i+'" name="vendor_ingredientslist['+i+']" id="" required="">'
                                +'</select>'
                            +'</div>'
                        +'</div>'
                        +'<div class="col-md-2">'
                        +'    <div class="form-group">'
                        +'         <label>Quantity <span class="required text-danger">*</span></label>'
                        +'         <input type="text" name="vendorproduct_bb_quantity['+i+']" class="quantivendorproduct_bb_quantityty form-control"  id="quantity" placeholder="Quantity"  >'
                        +'    </div>'
                        +'</div>'
                        +'<div class="col-md-2">'
                        +'    <div class="form-group">'
                        +'        <label>Price<span class="required text-danger">*</span></label>'
                        +'        <input type="text" name="vendorproduct_bb_price['+i+']" class="vendorproduct_bb_price form-control" id="price" placeholder="Price">'
                        +'     </div>'
                        +'</div>'
                        +'<div class="col-md-2">'
                        +'    <div class="form-group">'
                        +'         <label>MRP</label>'
                        +'        <input type="text" name="vendorproduct_bb_mrp['+i+']" class="vendorproduct_bb_mrp form-control" id="MRP" placeholder="MRP" >'
                        +'    </div>'
                        +'</div>'
                        +'<div class="col-md-3">'
                        +'    <div class="form-group">'
                        +'      <label>Measure<span class="required text-danger">*</span></label>'
                        +'       <select class="form-control vendorproduct_bb_measure'+id+'" name="vendorproduct_bb_measure['+i+']" id="measure" required="">'
                        +'           </select>'
                        +'    </div>'
                        +'</div>'
                        +'</div>'
                    +'</div><div class="col-md-1">'
                    +'<input type="button" id='+id+' onclick="myevent(this)" value="Delete" class="btn btn-custon-rounded-three btn-danger mt-10"/></div></div>';

            document.getElementById('AddDel').appendChild(div);
        }else{
            var element = document.getElementById(action.id);
            element.parentNode.removeChild(element);
        }
    }else{
        alert('Select Categoty.');
    }
}

function deleteprice(eve){
    if(eve !=""){
        /*$.post(adminurl + "/ajaxDeletePrice/"+eve, {priceid:eve}, function (data) {
            if(data == 1){
                $('#prince'+eve).css("display","none");
            }
        });*/
        $.ajax({
            url:adminurl+"/ajaxDeletePrice",
            method:"POST",
            data:{vendorprice:eve},
            success:function(data){
                if(data > 0){
                    alert('Price Deleted Succfully');
                    $("#princes"+eve).css("display","none");
                }else{
                    alert('Price Deleted Failed');
                }
            }
        });
    }
}
function orderdetails(evt) {
    var orderid     =   evt.attr("orderid");
    $.post(adminurl + "/ajaxOrderview/"+orderid, function (data) { 
        $(".viewModal").modal("show");
        $(".viewModal .modal-title").html("OrderView ");
        $(".viewModal .modal-body").html(data);
    });
}

    function activeform(evt,page){
        var fields  =   evt.attr("fields");
        var status  =   evt.attr("title");
       swal({
          title: "Are you sure you want to " + status,
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.post(adminurl+"/"+page,{status:status,fields:fields},function(data){
                    if(data == 1){
                        location.reload();
                    }else if(data == 0){
                        swal("No permissions ....!!!", '');
                    } else {
                        swal("Not updated any ....!!!", '');
                    }
                });
                swal.close();
          } else {
            swal("Not updated any ....!!!", status);
          }
        });
       /* swal({
            title: "Are you sure you want to " + status,
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then((isConfirm) => {
            if (isConfirm) { 
                $.post(adminurl+"/"+page,{status:status,fields:fields},function(data){
                    if(data == 1){
                        location.reload();
                    }else if(data == 0){
                        swal("No permissions ....!!!", '');
                    } else {
                        swal("Not updated any ....!!!", '');
                    }
                });
                swal.close();
            }
            else {
                swal("Not updated any ....!!!", status);
            }
        });*/
    }
    function cusorderdetails(evt) {
        var customerid     =   evt.attr("customerid");
        $.post(adminurl + "/viewCusOrders/0",{customerid:customerid}, function (data) { 
            $(".viewModal").modal("show");
            $(".viewModal .modal-title").html("Orders ");
            $(".viewModal .modal-body").html(data);
        });
    }
    
function orderdetailsreport(evt) {
    var orderid     =   evt.attr("orderid");
    $.post(adminurl + "/ajaxOrderReport/"+orderid, function (data) { 
        $(".viewModal").modal("show");
        $(".viewModal .modal-title").html("OrderView ");
        $(".viewModal .modal-body").html(data);
    });
}

function customerdetailsreport(evt) {
    var orderid     =   evt.attr("orderid");
    $.post(adminurl + "/ajaxCustomerReport/"+orderid, function (data) { 
        $(".viewModal").modal("show");
        $(".viewModal .modal-title").html("Customer Report View");
        $(".viewModal .modal-body").html(data);
    });
}
    function ajaxcusorderdetails(page_num,url) {
        var page_num = page_num ? page_num : 0;
        var customerid = $('#cus_id').val();
        var keywords = $('#FilterTextBox1').val();
        var limitvalue = $('.limitvalu option:selected').val();
        $.post(url+'/'+page_num,{customerid:customerid ,keywords:keywords ,limitvalue:limitvalue}, function (data) { 
            $(".viewModal").modal("show");
            $(".viewModal .modal-title").html("Orders ");
            $(".viewModal .modal-body").html(data);
        });
    }
    function orderstatusupdate(evt){
        var ordeid  =   evt.find('option:selected').val();
        var atrval  =   evt.attr("atrval"); 
        $.post(adminurl + "/orderstatusupda/"+atrval, {status: ordeid}, function (data) {
                $(".ordest"+atrval).html(ordeid);
        });
    }
    // function getProducts(){
    //     var productss     = $("#produ").val();
    //     var url     = $("#urll").val();
    //     var favorite = [];
    //     $.each($("input[name='cat[]']:checked"), function(){
    //         favorite.push($(this).val());
    //     });
    //     var cat_id =favorite.join(",");
    //     $.post(adminurl + url, {cat_id: cat_id ,product_id : productss}, function (data) { 
    //         $("#productt").html(data);
    //     });
    
    // }
    // getProducts();
    function itemCheckAll(evt){
        var svsp    =   evt.is(":checked");
        if(svsp){ 
                $("input[name='Prod[]'").attr("checked","checked");
        }else{
                $("input[name='Prod[]'").removeAttr("checked");
        } 
        
    }
    discType();
getProducts();
typeee();
function discType(){
    var disc =  $("#exampleFormControlSelect1 option:selected").val();
    if(disc == ''){
    }else if(disc=='Percentage'){
        $('#basic-addon2').html('<i class="fa fa-percent" aria-hidden="true"></i>');
        $('#maxdis').show();
    }else if(disc=='Amount'){
        $('#basic-addon2').html('<i class="fa fa-inr" aria-hidden="true"></i>');
        $('#maxdis').hide();
    }
}
function getProducts(){
    var productss     = $("#produ").val();
    var url     = $("#urll").val();
    var favorite = [];
    $.each($("input[name='cat[]']:checked"), function(){
        favorite.push($(this).val());
    });
    var cat_id =favorite.join(",");
    $.post(adminurl + url, {cat_id: cat_id ,product_id : productss}, function (data) { 
        $("#productt").html(data);
    });

}
function typeee(){
    var type =  $("#tyyy option:selected").val();
    if(type=='Category wise'){
        $("#catt").show();
        $("#produc").hide();
    }else if(type=='Product wise'){
        $("#produc").show();
        $("#catt").show();
    }else{
        $("#catt").hide();
        $("#produc").hide();
    }
}
function typeofcustt(){
    var cust =$("input[name='typeofcust']:checked").val();
    if(cust=='nth Time Customer'){
        $('#nth_value').show();
    }else{
        $('#nth_value').hide();
    }
}
function coupon_read(){
    var coupon =document.getElementsByName("coupon");
    if ( $('input[name="coupon"]').is('[readonly]') ) {
        $("input[name='coupon']").removeAttr("readonly");
        $('#basic-addon5').html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
    }else{
        $("input[name='coupon']").attr("readonly", "readonly");
        $('#basic-addon5').html('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>');
    }
}
// function itemCheckAll(evt){
//     // if ( $('input[name="Prod[]"]').is('[checked]') ) {
//     //     $("input[name='Prod[]']").attr("checked","false");
//     // }else{
//     //     $("input[name='Prod[]']").attr("checked", "checked");
//     // }
//     var svsp    =   evt.is(":checked");
//     if(svsp){ 
//             $("input[name='Prod[]'").attr("checked","checked");
//     }else{
//             $("input[name='Prod[]'").removeAttr("checked");
//     } 
    
// }
function coupon_gen(){
    $.post(adminurl + "/Ajax-Coupon/", function (data) { 
        $('input[name="coupon"]').val(data);
    });
    
}
function imageDetails(evt) {
    var images     =   evt.attr("iimages");
    var url     = $('#media_url').val();
    const im =images.split(',');
    var data ='';
    for(var i=0;i< im.length;i++) {
        data += '<img src="'+url+im[i]+'" class="p-2" width="100%"><hr>';
    }
    
        $(".viewModal").modal("show");
        $(".viewModal .modal-title").html("Images View ");
        $(".viewModal .modal-body").html(data);
    
}
$(function () {
    pageform();
    initPart();
    validformInit(); 
    input_rest();
});