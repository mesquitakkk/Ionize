<?php
    include_once('conn.php');
    session_start();

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
            $_SESSION["user_id"] = $fetch["fk_user_id"];
            $_SESSION["cred_id"] = $fetch["pk_cred_id"];
            header("location:../user-profile.php");
            
        } else {
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['error'] = "Usuário inválido. Verifique os valores corretamente.";
            header('location:../session.php');
        }
    }else{
        // Connection error
        $_SESSION['error'] = "Falha ao conectar ao banco de dados. Tente novamente mais tarde.";
        header('location:../session.php');
    }

    // print_r($fetch);
    // echo "<br><br>";
    // print_r($_POST);
?>