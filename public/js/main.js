function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function sign_up() {
    $('#signup-err').empty();
    let [user_name, user_email, pass, repass] = [$('#signup-name').val().trim(), $('#signup-email').val().trim(), $('#signup-password').val().trim(), $('#signup-rep-password').val().trim()];

   if (user_email && user_name && pass && repass) {

       if (!validateEmail(user_email)){
           $('#signup-err').append( "<p class='error_form'>Please enter a valid e-mail address</p>" );
       } else if (pass != repass){
           $('#signup-err').append( "<p class='error_form'>Your password and confirmation password do not match</p>" );
       }

       else {
           let data = new FormData();
           data.append('name', user_name);
           data.append('email', user_email);
           data.append('password', pass);
           $.ajax({
               type: "POST",
               url: '/sign_up',
               contentType: false,
               cache: false,
               processData: false,
               data: data,
               success: function (response) {
                   if (response == 'OK'){
                       location.reload();
                   }
                   else {
                       $('#signup-err').append( "<p class='error_form'>"+ response +"</p>" );
                   }
               }
           });
       }
    } else {
        $('#signup-err').append( "<p class='error_form'>Please fill in all fields</p>" );
    }
}

function login() {
    $('#signin-err').empty();
    let [user_name, pass] = [$('#signin-name').val().trim(), $('#signin-password').val().trim()];
    console.log(user_name,pass);
    if ( user_name && pass) {
        let data = new FormData();
        data.append('name', user_name);
        data.append('password', pass);
        $.ajax({
            type: "POST",
            url: '/login',
            contentType: false,
            cache: false,
            processData: false,
            data: data,
            success: function (response) {
                console.log(response);
                if (response == 'OK'){
                    location.reload();
                }
                else {
                    $('#signin-err').append( "<p class='error_form'>"+ response +"</p>" );
                }
            }
        });
    } else {
        $('#signin-err').append( "<p class='error_form'>Please fill in all fields</p>" );
    }
}