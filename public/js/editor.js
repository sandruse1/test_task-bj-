/**
 * Created by sandruse on 10.01.2018.
 */
let taskPhoto = '';
let status = '#ff4d4d';
$('#back-editor').on('click', function() {
    location.href = 'http://localhost:8080';
});

function addTask() {
    $('.justify-content-md-center').css('display', 'none');
    $('#error-editor').empty();
    let [name, email, task] = [$('#user-name').val().trim(), $('#user-email').val().trim(), $('#user-task').val().trim()];
    if (name && email && task) {
        if (!validateEmail(email)){
            $('#error-editor').append( "<p class='error_form'>Please enter a valid e-mail address</p>" );
        } else {
            var data = new FormData();
            if (taskPhoto) {
                data.append('img', taskPhoto);
            }
            data.append('name', name);
            data.append('email', email);
            data.append('task', task);

            $.ajax({
                type: 'POST',
                mimeType: 'multipart/form-data',
                contentType: false,
                cache: false,
                processData: false,
                url: 'add_task',
                data: data,
                success: function (response) {
                    if (response == 'OK'){
                        $('#user-name').val('');
                        $('#user-email').val('');
                        $('#user-task').val('');
                        $('#user-img').val('');
                        $('#img-preview').css('display', 'none');
                        $('#img-preview').attr('src', '');
                        $(`<p class="success_form">Your Task was successfully added</p>`).appendTo($('.error-editor'));
                    }
                    else {
                        $('#error-editor').append( "<p class='error_form'>"+ response +"</p>" );
                    }
                }
            });
        }
    } else{
        $('#error-editor').append( "<p class='error_form'>Please fill in all fields</p>" );
    }
}

function uploadPhoto(photo){
    var reader  = new FileReader();

    reader.onloadend = function () {
        $('#img-preview').css('display', 'block');
        $('#img-preview').attr('src', reader.result);
    }
    if (photo.files[0]) {
        reader.readAsDataURL(photo.files[0]);
    } else {
        $('#img-preview').css('display', 'none');
        $('#img-preview').attr('src', '');
    }
    taskPhoto = photo.files[0];
}

$('.btn-preview').on('click', function() {
    $('.justify-content-md-center').css('display', 'block');
    if ($('#user-name').val().trim() && $('#user-email').val().trim() && $('#user-task').val().trim()) {
        $('.user-name-prev').text('Name: ' + $('#user-name').val().trim());
        $('.user-email-prev').text('Email: ' + $('#user-email').val().trim());
        $('.task-text-prev').text('Task: ' + $('#user-task').val().trim());
        if ($('#img-preview').attr('src')) {
            $('.img-user-prev').attr('src', $('#img-preview').attr('src'));
        }
        $('.preview-div').css('background-color', status);
    }
})