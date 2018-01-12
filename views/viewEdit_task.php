<?php
/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 10.01.2018
 * Time: 14:26
 */
    require_once (ROOT.'/views/viewHeader.php');
    $session = Session::getInstance();
?>
    <div class="container text-center p-t-3">
        <button class="btn btn-outline-success my-2 my-sm-0" id="back-editor">Back</button>
        <h1 class="display-2 m-t-3 header">Task Editor</h1>
        <div class="note-editor">
            <div id="error-editor" class="form-group error-editor">
            </div>
            <div class="form-group row">
                <label for="user-name" class="col-2 col-form-label">Name</label>
                <div class="col-10">
                    <input type="text" name="login" id="user-name" class="form-control" value="<?php echo $session->logged_user ?>" required />
                </div>
            </div>
            <div class="form-group row">
                <label for="user-email" class="col-2 col-form-label">Email</label>
                <div class="col-10">
                    <input type="email" name="email" class="form-control" value="<?php echo $session->user_email ?>" id="user-email" required />
                </div>
            </div>
            <div class="form-group row">
                <label for="user-task" class="col-2 col-form-label">Task</label>
                <div class="col-10">
                    <textarea  id="user-task" rows="5" class="textarea" required ></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="user-img" class="col-2 col-form-label">Photo</label>
                <div class="col-10">
                    <input type="file" name="task-img" class="form-control" id="user-img" accept="image/*,image/gif,image/jpg,image/png" onchange="uploadPhoto(this)"/>
                    <img src="" alt="" class="img-fluid" id="img-preview" style="display: none; width: 320px; height: 240px">
                </div>
            </div>
            <div class="from-group row">

            </div>
            <div class="row">
                <div class="col-sm-6">
                    <button class="btn btn-preview">Preview</button>
                </div>
                <div class="col-sm-6">
                    <button onclick="addTask()" class="btn add-button">Add</button>
                </div>
            </div>

        </div>

        <div class="row justify-content-md-center" style="margin-top: 20px; display: none ">
            <div class="col-sm-12 col-md-8 col-lg-6 col-xl-6 preview-div" style="text-align: left">
                <h3 class="user-name-prev m-t-2"></h3>
                <h5 class="user-email-prev"></h5>
                <hr />
                <p class="task-text-prev"></p>
                <img src="" alt="" class="img-fluid img-user-prev">
            </div>
        </div>
    </div>
<?php
    require_once (ROOT.'/views/viewFooter.php');
?>