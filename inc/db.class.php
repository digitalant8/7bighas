<?php

class DBobj {

    private $host;
    private $dbname;
    private $dbpass;
    private $dbuser;

    function __construct () {
        $this->host = 'localhost';
        if ($_SERVER['SERVER_NAME'] != 'localhost') {
            $this->dbname = 'positrix_7bighas';
            $this->dbpass = 'ica8$rus9$#';
            $this->dbuser = 'positrix_7buser';
        } else {
            $this->dbname = '7bighas';
            $this->dbpass = 'icarus';
            $this->dbuser = '7bighas';
        }
    }

    private static function runQuery ($sql) {
        $db = new DBobj;
        $con = mysqli_connect($db->host,$db->dbuser,$db->dbpass,$db->dbname);
        $r = mysqli_query($con,$sql);
        mysqli_close($con);
        return $r;
    }

    private static function runQueryReturnId ($sql) {
        $db = new DBobj;
        $con = mysqli_connect($db->host,$db->dbuser,$db->dbpass,$db->dbname);
        $result = mysqli_query($con,$sql);
        $r = mysqli_insert_id($con);
        mysqli_close($con);
        return $r;
    }

    public static function insertUser($realname, $username, $password, $email, $address, $street, $city, $state,
$phone) {
        $sql = "INSERT INTO users (user_id, user_realname, user_username, user_password, user_email, user_address, user_street, user_city, user_state, user_phone) VALUES ('','".$realname."', '".$username."', '".$password."', '".$email."',
        '".$address."', '".$street."', '".$city."', '".$state."', '".$phone."')";
        $r = DBobj::runQuery($sql);
        return $r;
    }

    public static function insertDev($devname, $email, $address, $street, $city, $state, $phone, $contact){
        $sql = "INSERT INTO developers (dev_id, dev_name, dev_email, dev_address, dev_street, dev_city, dev_state, dev_phone, dev_contact) VALUES ('', '".$devname."', '".$email."', '".$address."', '".$street."',
        '".$city."', '".$state."', '".$phone."', '".$contact."')";
        $r = DBobj::runQuery($sql);
        return $r;
    }

    public static function insertAdmin($username, $password, $email){
        $sql = "INSERT INTO admin (admin_username, admin_password, admin_email) VALUES ('".$username."',
        '".$password."',
        '".$email."')";
        $r = DBobj::runQuery($sql);
        return $r;
    }

    public static function insertProp($user, $dev, $name, $desc, $address, $street, $city, $state){
        $sql = "INSERT INTO properties (prop_id, prop_user_id, prop_dev_id, prop_name,
        prop_description, prop_address, prop_street, prop_city, prop_state) VALUES ('',
        '".$user."','".$dev."', '".$name."', '".$desc."', '".$address."',
        '".$street."', '".$city."', '".$state."')";
        $r = DBobj::runQueryReturnId($sql);
        return $r;
    }

    public static function insertUnit ($unit_prop_id, $unit_name, $unit_desc, $unit_area, $unit_price) {
        $sql="INSERT INTO unit (unit_id, unit_prop_id, unit_name, unit_desc, unit_area, unit_price) VALUES ('', '".$unit_prop_id."', '".$unit_name."', '".$unit_desc."', '".$unit_area."', '".$unit_price."')";
        $r = DBobj::runQueryReturnId($sql);
        return $r;
    }

    public static function insertUnitPhoto ($unit_id, $unit_photo_alt) {
        $sql = "INSERT INTO unit_photos (unit_photo_id, unit_id, unit_photo_alt) VALUES ('', '".$unit_id."', '".$unit_photo_alt."')";
        $r = DBobj::runQueryReturnId($sql);
        return $r;
    }

    public static function insertFeature ($feature_unit_id, $feature_key, $feature_value) {
        $sql = "INSERT INTO unit_features (feature_id, feature_unit_id, feature_key, feature_value) VALUES ('', '".$feature_unit_id."', '".$feature_key."', '".$feature_value."')";
        $r = DBobj::runQuery($sql);
        return $r;
    }

    public static function insertPhoto($propid, $alt){
        $sql = "INSERT INTO photos (photo_id, photo_alt, photo_prop_id) VALUES ('', '".$alt."', '".$propid."')";
        $r = DBobj::runQueryReturnId($sql);
        return $r;
    }

    public static function usersFetchAll ($limit) {
        $r = array();
        $sql =  "SELECT * FROM users ORDER BY user_id DESC LIMIT " . $limit;
        $result = DBobj::runQuery($sql);
        while($row = mysqli_fetch_array($result)) {
            $r[] = $row;
        }
        return $r;
    }

    public static function devFetchAll ($limit) {
        $r = array();
        $sql =  "SELECT * FROM developers ORDER BY dev_id DESC LIMIT " . $limit;
        $result = DBobj::runQuery($sql);
        while($row = mysqli_fetch_array($result)) {
            $r[] = $row;
        }
        return $r;
    }

    public static function adminFetchAll ($limit) {
        $r = array();
        $sql =  "SELECT * FROM admin ORDER BY admin_username ASC LIMIT " . $limit;
        $result = DBobj::runQuery($sql);
        while($row = mysqli_fetch_array($result)) {
            $r[] = $row;
        }
        return $r;
    }

    public static function propFetchAll ($limit) {
        $r = array();
        $sql =  "SELECT * FROM properties ORDER BY prop_id ASC LIMIT " . $limit;
        $result = DBobj::runQuery($sql);
        while($row = mysqli_fetch_array($result)) {
            $r[] = $row;
        }
        return $r;
    }

    public static function userFetchAllIds () {
        $r = array();
        $sql =  "SELECT user_id, user_realname FROM users ORDER BY user_realname ASC";
        $result = DBobj::runQuery($sql);
        while($row = mysqli_fetch_array($result)) {
            $r[] = $row;
        }
        return $r;
    }

    public static function devFetchAllIds () {
        $r = array();
        $sql =  "SELECT dev_id, dev_name FROM developers ORDER BY dev_name ASC";
        $result = DBobj::runQuery($sql);
        while($row = mysqli_fetch_array($result)) {
            $r[] = $row;
        }
        return $r;
    }

    public static function propFetchAllIds () {
        $r = array();
        $sql =  "SELECT prop_id, prop_name FROM properties ORDER BY prop_name ASC";
        $result = DBobj::runQuery($sql);
        while($row = mysqli_fetch_array($result)) {
            $r[] = $row;
        }
        return $r;
    }

    public static function checkAdmin ($username, $password) {
        $sql = "SELECT * FROM admin WHERE admin_username = '".$username."' AND admin_password = '".$password."'";
        $r = DBobj::runQuery($sql);
        $rbool = ($r->num_rows > 0 ? true : false);
        return $rbool;
    }

    public static function setDefaultImage ($prop_id, $photo_id) {
        $sql = 'UPDATE properties SET prop_def_image_id = '.$photo_id.' WHERE prop_id = ' . $prop_id;
        $r = DBobj::runQuery($sql);
        return $r;
    }
}
?>