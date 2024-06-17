$("#mainCat").change(function() {
    if ($(this).val() == "other") {
        $('#newMainCategory').show();
        $('#newSubCategory').hide();
        $('#mainCategory').attr('required','');
        $('#mainCategory').attr('data-error', 'This field is required.');
    } else {
        $('#newMainCategory').hide();
        $('#newSubCategory').show();
        $('#mainCategory').removeAttr('required');
        $('#mainCategory').removeAttr('data-error');				
    }
});
$("#mainCat").trigger("change");

$("#rentOrSell").change(function() {
    if ($(this).val() == "sell" || $(this).val() == "trade") {
        $('#deposit').hide();
        $('#depositText').removeAttr('required');
        $('#depositText').removeAttr('data-error');		
    } else {
        $('#deposit').show();
        $('#depositText').attr('required','');
        $('#depositText').attr('data-error', 'This field is required.');
    }
});
$("#rentOrSell").trigger("change");
