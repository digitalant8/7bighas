<?php
include('inc/check-loggedin.php');
include_once('../inc/db.class.php');
include_once('inc/admin.class.php');

echo Admin::makeHead('Add Photos - 7bighas.com - Admin Console');
?>

    <div class="col-sm-3"> <!-- start middle column -->
        <?php

        if (isset($_POST['prop'])) {
            $alt = (isset($_POST['alt']) ? $_POST['alt'] : '');
            $insert = DBobj::insertPhoto($_POST['prop'], $alt);
            if ($insert) {
                echo '<div class="alert alert-success" role="alert">Photo was inserted successfully. Photo id'.
                    $insert.'</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Photo was not inserted</div>';
            }
        }


        if (isset($_FILES['photo']) && $insert) {
            if ($_FILES["photo"]["error"] > 0) {
                echo '<div class="alert alert-danger" role="alert">Error: ' . $_FILES["photo"]["error"] . '</div>';
            } else {
                echo '<div class="alert alert-success" role="alert">Upload: ' . $_FILES["photo"]["name"] . '<br>';
                echo "Type: " . $_FILES["photo"]["type"] . "<br>";
                echo "Size: " . ($_FILES["photo"]["size"] / 1024) . " kB<br>";
                switch ($_FILES["photo"]["type"]) {
                    case "image/gif" :
                        $type = ".gif";
                        break;
                    case "image/jpeg" :
                        $type = ".jpg";
                        break;
                    case "image/png" :
                        $type = ".png";
                        break;
                }
                if (file_exists("upload/" . $_FILES["photo"]["name"])) {
                    echo $_FILES["photo"]["name"] . " already exists. ";
                } else {
                    move_uploaded_file($_FILES["photo"]["tmp_name"],
                        "upload/" . $insert . $type);
                    echo "Stored in: " . "upload/" . $insert . $type . "</div>";
                }
            }
        }

        if (isset($_POST['default']) && $_POST['default']) {
            DBobj::setDefaultImage($_POST['prop'], $insert);
        }


        ?>
        <!-- start add users form -->
        <div id="addphotos">
            <form name="addphotos" id="addphotos-form" role="form" action="photos.php" method="post"
                  enctype="multipart/form-data">
                <div class="form-group">
                    <label>Property</label>
                    <select class="form-control" name="prop" required>
                        <option value="">Select a property</option>
                        <?php
                        $props = DBobj::propFetchAllIds();
                        foreach ($props as $prop) {
                            echo '<option value="' . $prop['prop_id'] . '">' . $prop['prop_name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="well well-sm" id="photo-well">
                    <div class="photo-unit">
                        <div class="form-group">
                            <label>Photo</label><input type="file" name="photo" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Alt</label><input type="text" name="alt" placeholder="Alt" autocomplete="on"
                                                     class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Default Image</label>
                            <input type="checkbox" name="default">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="reset" name="reset" value="Reset" class="btn btn-default">
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                </div>
            </form>
        </div>
        <!-- end add users form -->

    </div> <!-- end middle column -->

    <div class="col-sm-7">
        <table class="table table-bordered table-hover table-striped results-display">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
                <th>Address</th>
                <th>Street</th>
                <th>City</th>
                <th>State</th>
                <th>Phone</th>
            </tr>
            <?php
            $result = DBObj::usersFetchAll(10);
            foreach ($result as $row) {
                echo '<tr>';
                echo '<td>' . $row['user_id'] . '</td>';
                echo '<td>' . $row['user_realname'] . '</td>';
                echo '<td>' . $row['user_username'] . '</td>';
                echo '<td>' . $row['user_password'] . '</td>';
                echo '<td>' . $row['user_email'] . '</td>';
                echo '<td>' . $row['user_address'] . '</td>';
                echo '<td>' . $row['user_street'] . '</td>';
                echo '<td>' . $row['user_city'] . '</td>';
                echo '<td>' . $row['user_state'] . '</td>';
                echo '<td>' . $row['user_phone'] . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>

<?php
echo Admin::makeFoot();
?>
