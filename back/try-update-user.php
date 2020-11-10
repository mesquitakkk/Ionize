<?php
    session_start();
    include_once("conn.php");
    //temp
    print_r($_POST);
    echo "<br>";
    echo "<br>";
    print_r($_SESSION);

    if($_POST["actualPassword"] != $_SESSION["ionize_tb_credentials_password"]) {
        // the typed password is incorrect
        $_SESSION["ionize_error_password"] = "Senha Incorreta";
        header("location:../user-profile.php");
    } else {
        // escape string
        $_POST['user_name'] = strtoupper(mysqli_real_escape_string($conn, $_POST['user_name']));
        $_POST['user_email'] = strtolower(mysqli_real_escape_string($conn, $_POST['user_email']));
        $_POST['user_cpf'] = mysqli_real_escape_string($conn, $_POST['user_cpf']);
        $_POST['user_birthday'] = mysqli_real_escape_string($conn, $_POST['user_birthday']);
        //update tb_user
        $sqlUpdUser = "UPDATE tb_user
                       SET username='".$_POST['user_name']."',
                       cpf='".$_POST['user_cpf']."',
                       birthday='".$_POST['user_birthday']."'
                       WHERE pk_user_id='".$_SESSION['ionize_tb_user_pk_user_id']."'";
        $queryUpdUser = mysqli_query($conn, $sqlUpdUser);

        if($queryUpdUser){
            echo "Tabela user alterada";
        } else {
            echo "Mysqli Erro: " . mysqli_error($conn);

        }
        //update tb_credentials
        $sqlUpdCred = "UPDATE tb_credentials
                       SET email='".$_POST['user_email']."'
                       WHERE pk_cred_id='".$_SESSION['ionize_tb_credentials_pk_cred_id']."'";
        $queryUpdCred = mysqli_query($conn, $sqlUpdCred);

        // if($queryUpdCred){
        //     echo "Tabela credentials alterada";
        // } else {
        //     echo "Mysqli Erro: " . mysqli_error($conn);
        // }
        // notify update status
        if ($queryUpdCred and $queryUpdUser) {
            $_SESSION["ionize_update_status"] = "success";
        } else {
            $_SESSION["ionize_update_status"] = "error";
        }
        header("location:../user-profile.php");

        // echo "<br>";
        // echo("senha certa");
        // echo "<br>";
    }
?>