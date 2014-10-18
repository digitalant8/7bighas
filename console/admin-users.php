<?php
include('inc/check-loggedin.php');
include_once('../inc/db.class.php');
include_once('inc/admin.class.php');

echo Admin::makeHead('Add Admin Users - 7bighas.com - Admin Console');
?>

        <div class="col-sm-3"> <!-- start middle column -->
            <?php
            if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
                $insert = DBobj::insertAdmin($_POST['username'], $_POST['password'], $_POST['email']);
                if ($insert) {
                    echo '<div class="alert alert-success" role="alert">Record was inserted successfully</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Record was not inserted<br />';
                    echo $_POST['dname'].$email.$address.$street.$city.$state.$phone.$contact.'</div>';
                }
            }
            ?>
            <!-- start add users form -->
            <div id="addadmin">
                <form name="addadmin" id="addadmin-form" role="form" action="admin-users.php" method="post">
                    <div class="form-group">
                        <label>Username</label><input type="text" name="username" placeholder="Username"
                                autocomplete="on" required class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Password</label><input type="password" name="password" placeholder="Password"
                                                     required class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Email</label><input type="email" name="email" placeholder="Email" autocomplete="on"
                                                   required class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input type="reset" name="reset" value="Reset" class="btn btn-default">
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <!-- end add users form -->

        </div>
        <!-- end middle column -->

        <div class="col-sm-7">
            <?php
            $result = DBObj::adminFetchAll(10);

            if ($result) {
                ?>
                <table class="table table-bordered table-hover table-striped results-display">
                    <tr>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Email</th>
                    </tr>
                    <?php

                    foreach ($result as $row) {
                        echo '<tr>';
                        echo '<td>' . $row['admin_username'] . '</td>';
                        echo '<td>' . $row['admin_password'] . '</td>';
                        echo '<td>' . $row['admin_email'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </table>
            <?php
            }
            else {
                echo '<h2>No results found</h2>';
            }
            ?>

        </div>

<?php
echo Admin::makeFoot();
?>