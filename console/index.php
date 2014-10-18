<?php
session_start();

include_once('../inc/db.class.php');

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $r = DBobj::checkAdmin($username,$password);
    if ($r) {
        $_SESSION['username'] = $_POST['username'];
        $login_attempt = true;
    }
    else {
        session_destroy();
        $login_attempt = false;
    }
}


include_once('inc/admin.class.php');

echo Admin::makeHead('7bighas.com - Admin Console');
?>

        <?php

        if (!isset($_SESSION['username'])) {
            ?>
            <div id="admin-login-form">
                <h2>Log in</h2>
                <?php
                if (isset($login_attempt)) {
                    if (!$login_attempt) {
                        echo '<div class="alert alert-danger" role="alert">Login Unsucessful</div>';
                    }
                }
                ?>

                <form role="form" action="index.php" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="User Name"
                               autocomplete="on" name="username" />
                    </div>
                    <div class="form-group">
                        <label for="username">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password"
                               name="password" />
                    </div>
                    <div class="form-group">
                        <input type="reset" name="reset" value="Reset" class="btn btn-default">
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        <?php
        } else {

        ?>
        <div class="col-sm-10"> <!-- start main content area -->
            <h2>7bighas admin console</h2>
        </div> <!-- end right column - main content area -->
        <?php
        }
        ?>

<?php
echo Admin::makeFoot();
?>