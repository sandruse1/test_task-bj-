<?php
    require_once (ROOT.'/views/viewHeader.php');
    $session = Session::getInstance();
?>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Test BeeJee</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbars">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/edit_task">Edit Task</a>
                </li>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <?php if ($session->logged_user) {?>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="user-name-nav"><i class="fa fa-user-circle fa-2x fa-fw" aria-hidden="true"></i> <?php echo $session->logged_user ?></a>
                        </li>
                        <li class="nav-item">
                            <a href="/logout" class="btn btn-outline-danger my-2 my-sm-0" id="logout">Logout</a>
                        </li>
                    </ul>

                <?php } else {?>
                    <button type="button" class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#login-modal">Login</button>
                    <button type="button" class="btn btn-outline-primary my-2 my-sm-0" style="margin-left: 10px" data-toggle="modal" data-target="#reg-modal">Sign up</button>
                <?php }?>
            </div>
        </div>
    </nav>
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="loginmodallabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginmodallabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="signin-err" class="signin-err">

                    </div>
                    <div class="form-group row">
                        <label for="signup-name" class="col-2 col-form-label">Name</label>
                        <div class="col-10">
                            <input type="text" name="name" class="form-control" id="signin-name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="signin-password" class="col-2 col-form-label">Password</label>
                        <div class="col-10">
                            <input type="password" name="password" class="form-control" id="signin-password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="login()" class="btn btn-success btn-signin">Log In</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reg-modal" tabindex="-1" role="dialog" aria-labelledby="regmodallabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="regmodallabel">Sign up</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="signup-err" class="signup-err">

                    </div>
                    <div class="form-group row">
                        <label for="signup-name" class="col-2 col-form-label">Name</label>
                        <div class="col-10">
                            <input type="text" name="name" class="form-control" id="signup-name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="signup-email" class="col-2 col-form-label">Email</label>
                        <div class="col-10">
                            <input type="email" name="email" class="form-control" id="signup-email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="signup-password" class="col-2 col-form-label">Password</label>
                        <div class="col-10">
                            <input type="password" name="password" class="form-control" id="signup-password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="signup-rep-password" class="col-2 col-form-label">Repeat password</label>
                        <div class="col-10">
                            <input type="password" name="repeat-password" class="form-control" id="signup-rep-password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="sign_up()" class="btn btn-primary btn-signup">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <div class="jumbotron jumbotron-fluid">
        <div class="container" style="margin-top: 20px">
            <div class="sort-module text-center">
                <button onclick="sort_task('user_name')" class="btn btn-info btn-sort-name">sort by name</button>
                <button onclick="sort_task('user_email')" class="btn btn-info btn-sort-email">sort by email</button>
                <button onclick="sort_task('status')" class="btn btn-info btn-sort-done">sort by done</button>
            </div>
            <div class="task-list">

            </div>

        </div>
    </div>
<nav aria-label="Page navigation example">
    <ul id="pagination" class="pagination justify-content-center">

    </ul>
</nav>
<?php

    require_once (ROOT.'/views/viewFooter.php');
?>

