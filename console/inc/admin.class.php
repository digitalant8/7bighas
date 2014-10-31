<?php

class Admin
{
    public static function makeHead($title)
    {
        $r = '<!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <title>' . $title . '</title>
                    <meta name="robots" content="noindex, nofollow">

                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
                    <link rel="stylesheet" href="../css/bselect.min.css">
                    <link rel="stylesheet" href="css/admin-styles.css">

                </head>
                <body>
                    <div class="container-fluid">
                        <header class="row">
                            <h1>' . $title . '</h1>
                        </header> <!-- end first row -->

                        <div class="row">
                            <div class="col-sm-1">
                                    <ul class="nav nav-pills nav-stacked">
                                        <li><a href="admin-users.php">Admin</a></li>
                                        <li><a href="properties.php">Properties</a></li>
                                        <li><a href="developers.php">Developers</a></li>
                                        <li><a href="users.php">Users</a></li>
                                        <li><a href="units.php">Units</a></li>
                                        <li><a href="photos.php">Photos</a></li>
                                        <li><a href="logout.php">Logout</a></li>
                                    </ul>
                            </div> <!-- end left column -->';
        return $r;
    }

    public static function makeFoot()
    {
        $r = '</div> <!-- end second row -->
            </div> <!-- end container -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
            <script src="https://anothercdn.googlecode.com/files/jquery.lazyload.js"></script>
            <script src="../ckeditor/ckeditor.js"></script>
    <script src="../ckeditor/adapters/jquery.js"></script>
            <script type="text/javascript" src="js/admin-custom.js"></script>
            <script src="../js/bselect.min.js" type="text/javascript"></script>
            <script type="text/javascript">
                $("select").bselect();
                $(".wysiwyg").ckeditor();
            </script>

            </body>
            </html>';
        return $r;
    }

    public static function successAlert ($msg) {
        $r = '<div class = "alert alert-success" role = "alert">'.$msg.'</div>';
        return $r;
    }

    public static function dangerAlert ($msg) {
        $r = '<div class = "alert alert-danger" role = "alert">'.$msg.'</div>';
        return $r;
    }

}

?>