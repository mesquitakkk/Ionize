<?php 
    include_once('conn.php');

    $sqlUpdStatus = "UPDATE tb_transaction
                     SET status='done'
                     WHERE pk_tran_id='".$_POST['tran_id']."'";

    $queryUpdStatus = mysqli_query($conn, $sqlUpdStatus);
    if(!$queryUpdStatus) {
        die('MySQL Error: ' . mysqli_error($conn));
    } else {
        header('location:../purchases-historic.php');
    }
    // print_r($_POST);
?>