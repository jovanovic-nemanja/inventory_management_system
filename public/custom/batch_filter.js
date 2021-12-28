$(document).ready(function() {
    $('.filter_container').change(function() {
        var val_chx = $(this).val();
        var element = '.filter_id_' + val_chx;

        if(this.checked) {
            $(element).show();
        }else{
            $(element).hide();
        }
    });
});