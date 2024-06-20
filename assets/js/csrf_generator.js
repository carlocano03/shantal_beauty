var csrf_generator = {

    initialize: function()
    {
        setTimeout(function() {
            csrf_generator.get_csrf(function(csrf_token_value) {
                //console.log('CSRF Token Value: ' + csrf_token_value);
            });
        }, 2000);
    },

    get_csrf: function(callback)
    {
        // Retrieve the latest value of the CSRF hash and update the global JS variable
        $.get(baseURL + 'main/csrf', function(d) {
            var data = JSON.parse(d);
            if (data.csrf_hash !== "") { // check if the JSON string is not empty or undefined
                csrf_token_value = data.csrf_hash;
                //console.log('A New token - '+csrf_token_value);
                if (typeof callback === "function") {
                    callback(csrf_token_value);
                }
            }
        });
    }, 


}; //end of library

window.onload = csrf_generator.initialize();