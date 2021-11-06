$(function() {
    "use strict";
    
    $('.rfq_btn').click(function() {    //new request function
        var product_name = $('#product_name').val();
        var quantity = $('#quantity').val();
        var hid_product_quantity = $('#hid_product_quantity').val();
        var volume = $('#volume').val();
        var unit = $('#unit').val();
        var port_of_destination = $('#port_of_destination').val();
        var description = $('#description').val();
        var human_check = $('#human_check').val();

        if(!product_name) {
            alert("Product Name is required.");
            return;
        }
        if(!quantity || quantity == 0) {
            alert("Quantity is required.");
            return;
        }if (parseInt(quantity) < parseInt(hid_product_quantity)) {
            alert("At least Quantity should be same or big than product quantity.");
            return;
        }
        if(!volume) {
            alert("Volume is required.");
            return;
        }if(!unit) {
            alert("Unit is required.");
            return;
        }if(!port_of_destination) {
            alert("Destination is required.");
            return;
        }if(!description) {
            alert("Additional Information is required.");
            return;
        }if(!human_check) {
            alert("Human Check is required.");
            return;
        }
        
        if(human_check) {
            if(human_check != 7) {
                alert('Human Check is not correct.');
                return;
            }
        }

        $('.rfq_btn_hide').click();
    });

    $('.request_callback').click(function() {
        $('#product_id_v').val();
        var val_id = $(this).attr('id');
        $('#product_id_v').val(val_id);
        $('#subscribe').click();

        var subscribe = $('#subscribe');
        subscribe.addClass('active');
        $('body').css('overflow', 'hidden');

        $('#P_name').val($('.username_hid').val());
        $('#P_email').val($('.useremail_hid').val());
    });

    $('#submit_request_call_back').click(function() {
        var name = $('#P_name').val();
        var product_id = $('#product_id_v').val();
        var email_add = $('#P_email').val();
        var mobile = $('#P_mobile').val();

        $('.error_area_name').text("");
        $('.error_area_mail').text("");
        $('.error_area_mobile').text("");

        if (!name) {
            $('.error_area_name').text('Name is required.');
            return;
        }
        if (!email_add) {
            $('.error_area_mail').text('Email is required.');
            return;
        }
        if (!mobile) {
            $('.error_area_mobile').text('Mobile is required.');
            return;
        }

        var formData = new FormData();
        formData.append("name", name);
        formData.append("product_id", product_id);
        formData.append("email_add", email_add);
        formData.append("mobile", mobile);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/requestcallback/storeCallback",
            type: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            data: formData,
            success: function(result, status) {
                $('.flash-message-area').empty();
                $('.flash-message-area').append('<h4 style="color: '+result.color+'">' + result.msg + '</h4>');

                setTimeout( function() {
                    $('.flash-message-area').empty();
                    $('#P_mobile').val("");
                }, 5000);
            }
        });
    });

    $('.rfq_send_btn').click(function() {
        var product_name = $('#new_quote #product_name').val();
        var volume = $('#new_quote #volume').val();
        var unit = $('#new_quote #unit').val();
        var product_price = $('#new_quote #product_price').val();
        var available = $('#new_quote #available').is(":checked");
        var alternative_product = $('#new_quote #alternative_product').val();
        var alternative_product_price = $('#new_quote #alternative_product_price').val();

        var shipping_price = $('#new_quote #shipping_price').val();
        var shipping_desc = $('#new_quote #shipping_desc').val();
        var shipping_weight = $('#new_quote #shipping_weight').val();
        var shipping_unit = $('#new_quote #shipping_unit').val();
        
        var other_price = $('#new_quote #other_price').val();
        var other_price_desc = $('#new_quote #other_price_desc').val();
        
        if(!product_name) {
            alert("Product Name is required.");
            return;
        }if(!volume) {
            alert("Volume is required.");
            return;
        }
        if(available == true && !product_price) {
            alert("Product Price is required.");
            return;
        }

        if(available == false && !alternative_product) {
            alert("Alternative Product is required.");
            return;
        }
        if(available == false && !alternative_product_price) {
            alert("Alternative Product Price is required.");
            return;
        }

        if (shipping_desc) {
            if (!shipping_weight) {
                alert("Shipping Weight is required.");
                return;   
            }
            if (!shipping_price) {
                alert("Shipping Unit Price is required.");
                return;
            }
        }
        if (shipping_weight) {
            if (!shipping_desc) {
                alert("Shipping Description is required.");
                return;
            }
            if (!shipping_price) {
                alert("Shipping Unit Price is required.");
                return;   
            }
        }
        if (shipping_price) {
            if (!shipping_desc) {
                alert("Shipping Description is required.");
                return;
            }
            if (!shipping_weight) {
                alert("Shipping Weight is required.");
                return;   
            }
        }

        if (other_price && !other_price_desc) {
            alert("Other Charge Description is required in case of put other charge price.");
            return;
        }
        if (!other_price && other_price_desc) {
            alert("Other Charge Price is required in case of put other charge description.");
            return;
        }

        $('.rfq_send_btn_hide').click();
    });

    
    var element = $('#new_quote #available').is(":checked");
    if (element == true) {
        $('#new_quote .alternative').hide();    
    }else{
        $('#new_quote .alternative').show();
    }

    $('#available').change(function() {
        if (this.checked == false) {
            $('#new_quote .alternative').show();
            $('#new_quote .product_price').attr('readonly', true);
            $('#new_quote #product_total_price').val('N/A');
        }else{
            $('#new_quote .alternative').hide();
            $('#new_quote .product_price').removeAttr('readonly');
            var val = $('#new_quote #product_price').val();
            if (val == '' || val == 0 ) {
                val = 0;
            }else{
                val = val;
            }
            $('#new_quote #product_total_price').val(parseInt($('#new_quote #volume').val()) * parseInt(val));
        }
    })
});

function getformatnumber(val) {
    if (val == '' || val == 0 || val == 'N/A') {
        return 0;
    }else{
        return val;
    }
}

var volume = $('#new_quote #volume').val();

function myFuntion(val) {   //main price
    var main_price = getformatnumber(val);
    var shipping_price = getformatnumber($('#new_quote #shipping_price').val());
    var shipping_weight = $('#new_quote #shipping_weight').val();
    var other_price = getformatnumber($('#new_quote #other_price').val());
    var alternative_product_price = getformatnumber($('#new_quote #alternative_product_price').val());
    
    $('#new_quote #product_total_price').val(formatNumber(parseInt(main_price*volume).toFixed(2)));
    
    getTotalprice(main_price, alternative_product_price, shipping_price*shipping_weight, other_price);
}

function myFuntion1(val) {   //shipping price
    var shipping_price = getformatnumber(val);
    var shipping_weight = $('#new_quote #shipping_weight').val();
    var main_price = getformatnumber($('#new_quote #product_price').val());
    var other_price = getformatnumber($('#new_quote #other_price').val());
    var alternative_product_price = getformatnumber($('#new_quote #alternative_product_price').val());

    $('#new_quote #shipping_total_price').val(formatNumber(parseInt(shipping_price*shipping_weight).toFixed(2)));

    getTotalprice(main_price, alternative_product_price, shipping_price*shipping_weight, other_price);
}

function myFuntion4(val) {   //shipping weight
    var weight = getformatnumber(val);
    var shipping_price = getformatnumber($('#new_quote #shipping_price').val());
    var main_price = getformatnumber($('#new_quote #product_price').val());
    var other_price = getformatnumber($('#new_quote #other_price').val());
    var alternative_product_price = getformatnumber($('#new_quote #alternative_product_price').val());

    $('#new_quote #shipping_total_price').val(formatNumber(parseInt(shipping_price*weight).toFixed(2)));

    getTotalprice(main_price, alternative_product_price, shipping_price*weight, other_price);
}

function myFuntion2(val) {   //other price
    var other_price = getformatnumber(val);
    var alternative_product_price = getformatnumber($('#new_quote #alternative_product_price').val());
    var main_price = getformatnumber($('#new_quote #product_price').val());
    var shipping_price = getformatnumber($('#new_quote #shipping_price').val());
    var shipping_weight = $('#new_quote #shipping_weight').val();

    getTotalprice(main_price, alternative_product_price, shipping_price*shipping_weight, other_price);
}

function myFuntion3(val) {   //alternative product price
    var alternative_product_price = getformatnumber(val);
    var main_price = getformatnumber($('#new_quote #product_price').val());
    var shipping_price = getformatnumber($('#new_quote #shipping_price').val());
    var shipping_weight = $('#new_quote #shipping_weight').val();
    var other_price = getformatnumber($('#new_quote #other_price').val());

    $('#new_quote #alternative_product_total_price').val(parseInt(alternative_product_price*volume));

    getTotalprice(main_price, alternative_product_price, shipping_price*shipping_weight, other_price);
}

function getTotalprice(main_price, alternative_product_price, shipping_price, other_price) {
    var available = $('#new_quote #available').is(":checked");
    if (available == false) {    //alternative product
        var tt = parseInt(alternative_product_price*volume) + parseInt(shipping_price) + parseInt(other_price);
        
        $('#new_quote #total_price').val(formatNumber(parseInt(tt).toFixed(2)));
        $('#new_quote #real_total_price').val(tt);
    }else{  //product price
        var tt = parseInt(main_price*volume) + parseInt(shipping_price) + parseInt(other_price);

        $('#new_quote #total_price').val(formatNumber(parseInt(tt).toFixed(2)));       
        $('#new_quote #real_total_price').val(tt);
    }
}

function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}