<?php
    require'Database.php';
?>
<!DOCTYPE html>
<html lang = "fr">
    <head>
        <meta charset = "utf-8">
        <title> Mon blog </title>
    </head>
    <body>
        <div>
            <h1>Mon blog</h1>
            <p>En Construction</p>
            <?php
                $db = new Database();
                echo $db -> getConnection();
            ?>
        </div>
    </body>
<html>