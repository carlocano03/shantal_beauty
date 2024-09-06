$(document).on('keypress', '.number-input', function (e) {
    // Allow only numeric and dot (.) characters
    var charCode = e.which || e.keyCode;
    if (charCode !== 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        e.preventDefault();
    }
});

$(document).on('input', '.amount-input', function(){
    var inputValue = $(this).val();
    // Remove non-numeric characters
    inputValue = inputValue.replace(/[^0-9.]/g, '');
    // Format the number with commas and limit decimal part to 2 digits
    inputValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    var decimalAdded = inputValue.split(".");

    if (decimalAdded.length > 1) {
        var integerPart = decimalAdded[0];
        var decimalPart = decimalAdded[1].slice(0, 2); // Limit decimal part to 2 digits
        inputValue = integerPart + "." + decimalPart;
    }
    // Set the formatted value back to the input field
    var numericValue = parseFloat(inputValue.replace(/,/g, ''));
    if (!isNaN(numericValue) && numericValue > 1000000) {
        inputValue = "1,000,000.00";
    }
    $(this).val(inputValue);
});