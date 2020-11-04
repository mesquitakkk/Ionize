<?php

    // db var's
    $servername = "den1.mysql3.gear.host";
    $username = "piti95ionize";
    $password = "Vl1lh~?U0Gx9";
    $dbname = "piti95ionize";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Error MySQL connect: " . mysqli_connect_error() . " - " . mysqli_connect_errno());
    } else {
        // echo("Success to connect");
    }

?>