<?php
#This file functions as a template for the configuration files. Copy this file and rename it to config_app.php after cloning the repo.
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER_app', '185.220.175.56:3306');
define('DB_USERNAME_app', 'u39570p56178');
define('DB_PASSWORD_app', 'Inmerce789');
define('DB_NAME_app', 'u39570p56178_app');

$link = @new mysqli(DB_SERVER_app, DB_USERNAME_app, DB_PASSWORD_app, DB_NAME_app);

/* Attempt to connect to MySQL database */
if($link->connect_errno){

    define('DB_SERVER_app_local', '185.220.175.56:3306');
    $link = mysqli_connect(DB_SERVER_app_local, DB_USERNAME_app, DB_PASSWORD_app, DB_NAME_app);

    if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
}
}
?>
