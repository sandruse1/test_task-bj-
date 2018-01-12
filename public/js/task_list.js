/**
 * Created by sandruse on 10.01.2018.
 */
let page = 0;
let color = '';
let progress = '';
let prog_type1 = '';
let prog_type2 = '';
let sort_by = '';
let data_response = '';

function if_admin(response) {
    console.log(response);
    for (let i = 0; i < 3; i++) {
        if (response[i] && response[i].hasOwnProperty('status')) {

            if (response[i].status == 0) {
                color = '#ff4d4d'
                progress = 'in progress';
                prog_type1 = 'checked=checked';
                prog_type2 = "";
            }
            else {
                color = '#4dff4d';
                progress = 'done';
                prog_type1 = "";
                prog_type2 = 'checked=checked';
            }
            $(`<div class="task">
                                    <div class="col-sm-12 col-md-8 col-lg-6 col-xl-6 preview-div" data-set=${response[i].id} style="margin-left:auto; margin-right:auto; background-color: ${color}">
                                        <h6 id="progress">${progress}</h6>
                                        <label><input  type="radio" name=${i} ${prog_type1}>In Progress</label>
                                        <label><input  type="radio" name=${i} ${prog_type2}>Done</label>
                                        <hr>
                                        <input type="text" class="user-name-prev m-t-2" value=${response[i].user_name} />
                                        <input type="email" class="user-email-prev" value=${response[i].user_email} />
                                        <hr />
                                        <textarea class="task-text-prev" rows="5">${response[i].task_text}</textarea>
                                        <button onclick="editTask(this)" class="btn btn-info btn-admin" data-set=${response[i].id} >Save</button>
                                    </div>
                                </div>`).appendTo($('.task-list'));
            if (response[i].img_src) {

                img = "." + response[i].img_src;
                $(`<img src=${img} alt="" class="img-fluid img-user-prev-list">`).appendTo($(`div[data-set=${response[i].id}]`));
            }
        }
    }
}

function if_user(response) {
    console.log(response);
    for (let i = 0; i < 3; i++) {

        if (response[i] && response[i].hasOwnProperty('status')) {
            if (response[i].status == 0) {
                color = '#ff4d4d';
                progress = 'in progress';
            }
            else {
                color = '#4dff4d';
                progress = 'done';
            }
            $(`<div class="task">
                                    <div class="col-sm-12 col-md-8 col-lg-6 col-xl-6 preview-div" data-set=${response[i].id} style="margin-left:auto; margin-right:auto; background-color: ${color}">
                                        <h6 id="progress">${progress}</h6>
                                        <hr>
                                        <h3 class="user-name-prev m-t-2" style="">${response[i].user_name}</h3>
                                        <h5 class="user-email-prev">${response[i].user_email}</h5>
                                        <hr />
                                        <p class="task-text-prev">${response[i].task_text}</p>
                                    </div>
                                </div>`).appendTo($('.task-list'));
            if (response[i].img_src) {

                img = "." + response[i].img_src;
                $(`<img src=${img} alt="" class="img-fluid img-user-prev-list">`).appendTo($(`div[data-set=${response[i].id}]`));
            }
        }
    }
}

$(document).ready(function() {
    $.ajax({
        type: 'POST',
        url: '/count_task',
        dataType: 'json',
        success: function (response) {
            data_response = response;
            if (response[response.length - 1] > 1) {
                for (let i = 0; i < response[response.length - 1]; i++) {
                    $("#pagination").append('<li class="page-item" ><a class="page-link" onclick="get_task(' + (i + 1) +')" href="#">' + (i + 1) + '</a></li>');
                }
            }
            if (response[response.length - 2] != "0" && response[response.length - 1]) {
                if_admin(data_response);
            } else {
                if_user(data_response);
            }
        }
    })
});

function get_task(page) {
    $('.task-list').empty();
    var data = new FormData();
    data.append('page', page);
    data.append('sort', sort_by);
    $.ajax({
        type: 'POST',
        mimeType: 'multipart/form-data',
        contentType: false,
        cache: false,
        dataType: 'json',
        processData: false,
        url: 'get_task',
        data: data,
        success: function (response) {
            data_response = response;
            if (response[response.length - 1] != "0" && response[response.length - 1]) {
                if_admin(data_response);
            } else {
                if_user(data_response);
            }
        }
    });
}

function sort_task(by_what) {
        sort_by = by_what;
        get_task(1);
}

function editTask(elem){
    let name = $(`div[data-set=${elem.dataset.set}] input[type="text"]`).val().trim();
    let email = $(`div[data-set=${elem.dataset.set}] input[type="email"]`).val().trim();
    let task = $(`div[data-set=${elem.dataset.set}] textarea`).val().trim();
    let done = $(`div[data-set=${elem.dataset.set}] input[type="radio"]:checked`)[0]['labels'][0].innerText;
    let sender = true;

    if (!name || name.length < 2) {
        sender = false;
    }
    if (!validateEmail(email)) {
        sender = false;
    }
    if (!task || task.length < 2) {
        sender = false;
    }
    if (sender) {
        console.log('click');
        var data = new FormData();
        data.append('id', elem.dataset.set);
        data.append('name', name);
        data.append('email', email);
        data.append('task', task);
        data.append('done', done+'');

        $.ajax({
            type: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            url: '/admin_edit',
            data: data,
            success: function (response) {
                location.reload();
            }
        });
    }
}