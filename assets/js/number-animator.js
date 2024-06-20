function animateNumber(element, start, end, duration) {
    var range = Math.abs(end - start);
    var current = start;
    var increment = end > start ? 1 : -1;
    var stepTime = Math.abs(Math.floor(duration / range));
    var timer = setInterval(function() {
        current += increment;
        $(element).text(current);
        if ((increment === 1 && current >= end) || (increment === -1 && current <= end)) {
            clearInterval(timer);
            $(element).text(end); // Ensure the final value is accurate
        }
    }, stepTime);
}

function animateTextFade(element, newValue, duration) {
    $(element).stop(true, true).fadeOut(duration / 2, function() {
        $(this).text(newValue).fadeIn(duration / 2);
    });
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}