<?php
include('inc/check-loggedin.php');
include_once('../inc/db.class.php');
include_once('inc/admin.class.php');

echo Admin::makeHead('Add Properties - 7bighas.com - Admin Console');
?>

    <div class="col-sm-3"> <!-- start middle column -->
        <?php
        if (isset($_POST['name']) && isset($_POST['user'])) {

            /* adds default values */
            $dev = (isset($_POST['dev']) ? $_POST['dev'] : '');
            $desc = (isset($_POST['description']) ? $_POST['description'] : '');
            $address = (isset($_POST['address']) ? $_POST['address'] : '');
            $street = (isset($_POST['street']) ? $_POST['street'] : '');
            $city = (isset($_POST['city']) ? $_POST['city'] : '');
            $state = (isset($_POST['state']) ? $_POST['state'] : '');
            $landmarks = (isset($_POST['landmarks']) ? $_POST['landmarks'] : '');

            /* insert the property and return the property id */
            $prop_id = DBobj::insertProp($_POST['user'], $dev, $_POST['name'], $desc, $address, $street, $city,
                $state, $landmarks);
            if ($prop_id) {
                echo Admin::successAlert('Record was inserted successfully');
                if (isset($_FILES['photo'])) {
                    $alt = (isset($_POST['alt']) ? $_POST['alt'] : '');

                    /* adds a photo record using the property id returned above */
                    $photo_id = DBobj::insertPhoto($prop_id, $alt);
                    if ($photo_id) {
                        echo Admin::successAlert('Photo record was added successfully');
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Photo record was not added</div>';
                    }

                    /* uploads the file */
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
                        move_uploaded_file($_FILES["photo"]["tmp_name"],
                            "upload/" . $photo_id . $type);
                        echo "Stored in: " . "upload/" . $photo_id . $type . "</div>";

                        /* updates the property table to add the image id as a default image */
                        DBobj::setDefaultImage($prop_id, $photo_id);
                    }
                }
            } else {
                echo Admin::dangerAlert('Record was not inserted');
            }
        }
        ?>
        <!-- start add users form -->
        <div id="addprop">
            <form name="addprop" id="addprop-form" role="form" action="properties.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Name</label><input type="text" name="name" placeholder="Name" autocomplete="on"
                                              required class="form-control"/>
                </div>
                <div class="form-group">
                    <label>User</label>
                    <select class="form-control" name="user">
                        <?php
                        echo '<option value="" selected>Select a user</option>';
                        $users = DBobj::userFetchAllIds();
                        foreach ($users as $user) {
                            echo '<option value="' . $user['user_id'] . '">' . $user['user_realname'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Developer</label>
                    <select class="form-control" name="dev">
                        <?php
                        echo '<option value="" selected>Select a user</option>';
                        $devs = DBobj::devFetchAllIds();
                        foreach ($devs as $dev) {
                            echo '<option value="' . $dev['dev_id'] . '">' . $dev['dev_name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Description</label><textarea name="description" placeholder="Description"
                                                        class="wysiwyg form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Address</label><input type="text" name="address" placeholder="Address"
                                                 class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Street</label><input type="text" name="street" placeholder="Street" autocomplete="on"
                                                class="form-control"/>
                </div>
                <div class="form-group">
                    <label>City / Town</label><input type="text" name="city" placeholder="City"
                                                     autocomplete="on" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>State</label>
                    <select class="form-control" name="state">
                        <option value="" selected>Select a state</option>
                        <option value="an">Andaman and Nicobar Islands</option>
                        <option value="ap">Andhra Pradesh</option>
                        <option value="ar">Arunachal Pradesh</option>
                        <option value="as">Assam</option>
                        <option value="br">Bihar</option>
                        <option value="ch">Chandigarh</option>
                        <option value="ct">Chhattisgarh</option>
                        <option value="dn">Dadra and Nagar Haveli</option>
                        <option value="dd">Daman and Diu</option>
                        <option value="dl">National Capital Territory of Delhi</option>
                        <option value="go">Goa</option>
                        <option value="gj">Gujarat</option>
                        <option value="hr">Haryana</option>
                        <option value="hp">Himachal Pradesh</option>
                        <option value="jk">Jammu and Kashmir</option>
                        <option value="jh">Jharkhand</option>
                        <option value="ka">Karnataka</option>
                        <option value="kl">Kerala</option>
                        <option value="lk">Lakshadweep</option>
                        <option value="mp">Madhya Pradesh</option>
                        <option value="mh">Maharashtra</option>
                        <option value="mn">Manipur</option>
                        <option value="ml">Meghalaya</option>
                        <option value="mz">Mizoram</option>
                        <option value="nl">Nagaland</option>
                        <option value="od">Odisha</option>
                        <option value="pu">Puducherry</option>
                        <option value="pj">Punjab</option>
                        <option value="rj">Rajasthan</option>
                        <option value="sk">Sikkim</option>
                        <option value="tn">Tamil Nadu</option>
                        <option value="tl">Telangana</option>
                        <option value="tr">Tripura</option>
                        <option value="up">Uttar Pradesh</option>
                        <option value="ut">Uttarakhand</option>
                        <option value="wb">West Bengal</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Landmarks</label><textarea name="landmarks" placeholder="Landmarks"
                                                      class="form-control"></textarea>
                </div>
                <div class="well well-sm" id="photo-well">
                    <div class="form-group">
                        <label>Photo</label><input type="file" name="photo" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Alt</label><input type="text" name="alt" placeholder="Alt" autocomplete="on"
                                                 class="form-control"/>
                    </div>
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
        $result = DBObj::propFetchAll(10);

        if ($result) {
            ?>
            <table class="table table-bordered table-hover table-striped results-display">
                <tr>
                    <th>ID</th>
                    <th>UID</th>
                    <th>Dev ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Address</th>
                    <th>Street</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Landmarks</th>
                </tr>
                <?php

                foreach ($result as $row) {
                    echo '<tr>';
                    echo '<td>' . $row['prop_id'] . '</td>';
                    echo '<td>' . $row['prop_user_id'] . '</td>';
                    echo '<td>' . $row['prop_dev_id'] . '</td>';
                    echo '<td>' . $row['prop_name'] . '</td>';
                    echo '<td>' . substr($row['prop_description'], 0, 200) . '</td>';
                    echo '<td>' . $row['prop_address'] . '</td>';
                    echo '<td>' . $row['prop_street'] . '</td>';
                    echo '<td>' . $row['prop_city'] . '</td>';
                    echo '<td>' . $row['prop_state'] . '</td>';
                    echo '<td>' . substr($row['prop_landmarks'], 0, 200) . '</td>';
                    echo '</tr>';
                }
                ?>
            </table>
        <?php
        } else {
            echo '<h2>No results found</h2>';
        }
        ?>

    </div>

<?php
echo Admin::makeFoot();
?>