<?php
include('inc/check-loggedin.php');
include_once('../inc/db.class.php');
include_once('inc/admin.class.php');

echo Admin::makeHead('Add Developers - 7bighas.com - Admin Console');
?>

        <div class="col-sm-3"> <!-- start middle column -->
            <?php
            if (isset($_POST['name'])) {
                $email = (isset($_POST['email']) ? $_POST['email'] : '');
                $address = (isset($_POST['address']) ? $_POST['address'] : '');
                $street = (isset($_POST['street']) ? $_POST['street'] : '');
                $city = (isset($_POST['city']) ? $_POST['city'] : '');
                $state = (isset($_POST['state']) ? $_POST['state'] : '');
                $phone = (isset($_POST['phone']) ? $_POST['phone'] : '');
                $contact = (isset($_POST['contact']) ? $_POST['contact'] : '');

                $insert = DBobj::insertDev($_POST['name'], $email, $address, $street, $city, $state, $phone,
                    $contact);
                if ($insert) {
                    echo '<div class="alert alert-success" role="alert">Record was inserted successfully</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Record was not inserted</div>';
                }
            }
            ?>
            <!-- start add users form -->
            <div id="adddev">
                <form name="adddev" id="adddev-form" role="form" action="developers.php" method="post">
                    <div class="form-group">
                        <label>Name</label><input type="text" name="name" placeholder="Name" autocomplete="on"
                                                  required class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Email</label><input type="email" name="email" placeholder="Email" autocomplete="on"
                                                   class="form-control"/>
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
                        <label>Phone</label><input type="text" name="phone" placeholder="Phone" autocomplete="on"
                                                   class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Contact Person</label><input type="text" name="contact" placeholder="Contact Person"
                                                            autocomplete="on" class="form-control"/>
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
            $result = DBObj::devFetchAll(10);

            if ($result) {
                ?>
                <table class="table table-bordered table-hover table-striped results-display">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Street</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Phone</th>
                        <th>Contact</th>
                    </tr>
                    <?php

                    foreach ($result as $row) {
                        echo '<tr>';
                        echo '<td>' . $row['dev_id'] . '</td>';
                        echo '<td>' . $row['dev_name'] . '</td>';
                        echo '<td>' . $row['dev_email'] . '</td>';
                        echo '<td>' . $row['dev_address'] . '</td>';
                        echo '<td>' . $row['dev_street'] . '</td>';
                        echo '<td>' . $row['dev_city'] . '</td>';
                        echo '<td>' . $row['dev_state'] . '</td>';
                        echo '<td>' . $row['dev_phone'] . '</td>';
                        echo '<td>' . $row['dev_contact'] . '</td>';
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