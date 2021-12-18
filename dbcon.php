<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "insurancedb";

    $con = mysqli_connect($server, $username, $password, $db);

    if(mysqli_connect_errno())
    {
        echo "Failed to connect to server/database: ".mysqli_connect_error();
    }
?>