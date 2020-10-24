<?php

    // db var's
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ionize";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Error MySQL connect: " . mysqli_connect_error() . " - " . mysqli_connect_errno());
    } else {
        // echo("Success to connect");
    }

?>