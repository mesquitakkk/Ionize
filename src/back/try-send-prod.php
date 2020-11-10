<?php

    include_once('conn.php');

    // UPDATE tb_transaction.status to 'in_transit'

    $sqlUpdStatus =    "UPDATE tb_transaction 
                        SET status='in_transit'
                        WHERE pk_tran_id='".$_POST['tran_id']."';";
    
    $queryUpdStatus = mysqli_query($conn, $sqlUpdStatus) or die("MySQL Error: " . mysqli_error($conn));

    header('location:../sales-historic-to-send.php');

?>