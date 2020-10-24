<?php
    include_once('conn.php');

    $sqlSelCred = "SELECT * FROM tb_credentials 
                   WHERE email='".$_POST["email"]."' 
                   AND password='".$_POST['password']."';";

    $querySelCred = mysqli_query($conn, $sqlSelCred);

    if($querySelCred){
        // echo("success connect");

        // verifying if user exists
        if(mysqli_num_rows($querySelCred) == 1) {
            $fetch = mysqli_fetch_assoc($querySelCred);

            foreach($fetch as $key => $value){
                $_POST[$key] = $value;
            }
        } else {
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['error'] = "Usuário inválido";
            header('location:../session.php');
        }
    }else{
        // Connection error
        echo(mysqli_error($conn));
    }

    print_r($fetch);
    echo "<br><br>";
    print_r($_POST);
?>