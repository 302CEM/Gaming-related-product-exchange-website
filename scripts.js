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
