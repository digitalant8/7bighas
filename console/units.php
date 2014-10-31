<?php
include('inc/check-loggedin.php');
include_once('../inc/db.class.php');
include_once('inc/admin.class.php');

echo Admin::makeHead('Add Units - 7bighas.com - Admin Console');



?>

<div class="col-sm-6">
    <?php
    if(isset($_POST['prop_id'])) {
        $unit_name = (isset($_POST['unit_name']) ? $_POST['unit_name'] : '');
        $unit_desc = (isset($_POST['unit_desc']) ? $_POST['unit_desc'] : '');
        $unit_area = (isset($_POST['unit_area']) ? $_POST['unit_area'] : '');
        $unit_price = (isset($_POST['unit_price']) ? $_POST['unit_price'] : '');

        /* inserts Units gets generated unit_id */
        $unit_id = DBobj::insertUnit($_POST['prop_id'], $unit_name, $unit_desc, $unit_area, $unit_price);

        if (isset($_FILES['photo'])) {
            for ($i=0; $i < count($_FILES['photo']['name']) ; $i++) {
                $unit_photo_id = DBobj::insertUnitPhoto($unit_id, $_POST['alt'][$i]);
                switch ($_FILES["photo"]["type"][$i]) {
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
                move_uploaded_file($_FILES['photo']['tmp_name'][$i], 'upload/units/'.$unit_photo_id.$type);
                echo Admin::successAlert('stored in: upload/units/'.$unit_photo_id.$type);
            }
        }

        if (isset($_POST['feature_key']) || $_POST['feature_value']){
            for($i=0; $i < count($_POST['feature_key']); $i++) {
                DBobj::insertFeature($unit_id, addslashes($_POST['feature_key'][$i]), addslashes($_POST['feature_value'][$i]));
            }
        }

    }
    ?>
    <form method="post" action="units.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="prop_id"></label>
            <select id="prop_id" name="prop_id" class="form-control">
                <?php
                echo '<option value="" selected>Select a Property</option>';
                $users = DBobj::propFetchAllIds();
                foreach ($users as $user) {
                    echo '<option value="' . $user['prop_id'] . '">' . $user['prop_name'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="unit_name">Unit Name</label>
            <input type="text" name="unit_name" id="unit_name" class="form-control">
        </div>
        <div class="form-group">
            <label for="unit_desc">Description</label>
            <textarea id="unit_desc" name="unit_desc" class="wysiwyg form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="unit_area">Area</label>
            <input id="unit_area" name="unit_area" class="form-control">
        </div>
        <div class="form-group">
            <label for="unit_price">Price</label>
            <input id="unit_price" name="unit_price" class="form-control">
        </div>
        <div class="well well-sm" id="photo-well">
            <div class="photo_group clearfix">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Photo</label><input type="file" name="photo[]" class="form-control"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Alt</label><input type="text" name="alt[]" placeholder="Alt" autocomplete="on" class="form-control"/>
                    </div>
                </div>
            </div>
        </div>
        <p id="add_photo" class="btn btn-default">Add photo</p>
        <div id="feature_set">
            <div class="feature_group clearfix">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Key</label>
                        <input name="feature_key[]" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Value</label>
                        <input name="feature_value[]" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <p id="add_feature" class="btn btn-default">Add feature</p>
        <br /><br />
        <div class="form-group">
            <input class="btn btn-default" type="reset">
            <input class="btn btn-primary" type="submit">
        </div>

    </form>
</div>

<?php
echo Admin::makeFoot();
?>
<script>
    $('#add_photo').click(function () {
        $('.photo_group:first').clone().appendTo('#photo-well');
    });
    $('#add_feature').click(function() {
        $('.feature_group:first').clone().appendTo('#feature_set');
    });
</script>