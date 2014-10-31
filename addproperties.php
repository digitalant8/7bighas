<?php
include_once ('inc/ui.class.php');
include_once ('inc/db.class.php');
include_once ('console/inc/admin.class.php');
echo Ui::makeContainerFormHead('7bighas.com - Add Properties');
?>
<div class="row">
    <div class="col-md-8">
        <h1>Add Properties</h1>

        <?php
        /* main form processing logic starts */
        if (isset($_POST['name']) && isset($_POST['user'])) {

            /* adds default values to the optional fields */
            $dev = (isset($_POST['dev']) ? $_POST['dev'] : '');
            $desc = (isset($_POST['description']) ? $_POST['description'] : '');
            $address = (isset($_POST['address']) ? $_POST['address'] : '');
            $street = (isset($_POST['street']) ? $_POST['street'] : '');
            $city = (isset($_POST['city']) ? $_POST['city'] : '');
            $state = (isset($_POST['state']) ? $_POST['state'] : '');

            /* insert the property and return the property id */
            $prop_id = DBobj::insertProp($_POST['user'], $dev, $_POST['name'], $desc, $address, $street, $city,
                $state);
            if ($prop_id) {
                echo Admin::successAlert('Record was inserted successfully');
                if (isset($_FILES['photo']) && $_FILES["photo"]["error"] != 4) {
                    $alt = (isset($_POST['alt']) ? $_POST['alt'] : '');

                    /* adds a photo record using the property id returned above */
                    $photo_id = DBobj::insertPhoto($prop_id, $alt);
                    if ($photo_id) {
                        echo Admin::successAlert('Photo record was added successfully');
                    } else {
                        echo Admin::dangerAlert('Photo record was not added');
                    }

                    /* uploads the file */
                    if ($_FILES["photo"]["error"] > 0) {
                        echo Admin::dangerAlert('Error: ' . $_FILES["photo"]["error"]);
                    } else {
                        echo Admin::successAlert('Photo uploaded sucessfully ' . $_FILES["photo"]["name"]);
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
                        echo Admin::successAlert('Stored in: upload/' . $photo_id . $type);

                        /* updates the property table to add the image id as a default image */
                        DBobj::setDefaultImage($prop_id, $photo_id);
                    }
                }
            } else {
                echo Admin::dangerAlert('Record was not inserted');
            }
        }
        ?>
        <form action="addproperties.php" method="post" enctype="multipart/form-data" role="form">
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
    <div class="col-md-4">


    </div>
</div>
<?php
echo Ui::makeContainerFormFooter();
?>