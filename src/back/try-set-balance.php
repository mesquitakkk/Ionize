<?php
    session_start();
    echo "<br>";
    print_r($_POST);
    echo "<br>";
    echo "<br>";
    print_r($_SESSION);
    echo "<br>";
    echo "<br>";

    include_once("conn.php");

    $newBalance = (float)$_POST['addBalance'] + (float)$_SESSION['ionize_tb_user_balance'];

    echo($newBalance ." ". $_POST['addBalance'] ." ". $_SESSION['ionize_tb_user_balance']);

    $sqlUpdBalance = "UPDATE tb_user 
            SET balance=".$newBalance."
            WHERE pk_user_id='".$_SESSION['ionize_tb_user_pk_user_id']."';";

    $queryUpdBalance = mysqli_query($conn, $sqlUpdBalance);

    if($queryUpdBalance) {
        echo "success";
        unset($_SESSION["ionize_tb_user_balance"]);
        unset($_POST['addBalance']);
        header("location:../virtual-wallet.php");
    } else {
        echo("erro: " . mysqli_error($conn));
    }

?>