$('.container_price').change(function() {
    var price = parseInt($(this).val());
    var cost = parseInt($(this).parent().prev().children().next().val());
    var vat = $(this).parent().next().children().val();
    if(vat == 1) {
        var vat_price = 0;
    }else{
        var vat_price = parseInt(price * 5 / 100);
    }

    var total_price = parseInt(vat_price + price);
    var profit = formatNumber(parseFloat(total_price - cost).toFixed(2));
    
    $(this).parent().next().next().children().val(formatNumber(vat_price.toFixed(2)));
    $(this).parent().next().next().next().children().val(formatNumber(total_price.toFixed(2)));
    $(this).parent().next().next().next().next().children().val(profit);
});

$('.container_vat_choose').change(function() {
    var cost = parseInt($(this).parent().prev().prev().children().next().val());
    var price = parseInt($(this).parent().prev().children().val());
    var vat = $(this).val();
    if(vat == 1) {
        var vat_price = 0;
    }else{
        var vat_price = parseInt(price * 5 / 100);
    }

    var total_price = parseInt(vat_price + price);
    var profit = formatNumber(parseFloat(total_price - cost).toFixed(2));
    
    $(this).parent().next().children().val(formatNumber(vat_price.toFixed(2)));
    $(this).parent().next().next().children().val(formatNumber(total_price.toFixed(2)));
    $(this).parent().next().next().next().children().val(profit);
})

function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}