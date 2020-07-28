<?php 
    $servername = "89.46.111.136";
    $username = "Sql1373592";
    $password = "08an4646u0";
    $dbname = "Sql1373592_1";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully";
?>