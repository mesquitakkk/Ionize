<?php
    session_start();

    function sign_up_error($user_name, $user_birthday, $user_cpf, $user_email, $user_password, $address_street, $address_number, $address_city, $address_state, $address_cep) {
        $_SESSION["ionize_user_name"] = $user_name;
        $_SESSION["ionize_user_birthday"] = $user_birthday;
        $_SESSION["ionize_user_cpf"] = $user_cpf;
        $_SESSION["ionize_user_email"] = $user_email;
        $_SESSION["ionize_user_password"] = $user_password;
        $_SESSION["ionize_address_street"] = $address_street;
        $_SESSION["ionize_address_number"] = $address_number;
        $_SESSION["ionize_address_city"] = $address_city;
        $_SESSION["ionize_address_state"] = $address_state;
        $_SESSION["ionize_address_cep"] = $address_cep;
        header("location:../sign-up.php");
    }

    include_once('conn.php');

    // verifying if email exists (in db)

    $sqlSelEmail = "SELECT email FROM tb_credentials WHERE email='".$_POST["user_email"]."';";
    $querySelEmail = mysqli_query($conn, $sqlSelEmail);

    // $sqlSelEmail = "SELECT cpf;";

    $sqlSelCpf = "SELECT cpf FROM tb_user WHERE cpf='".$_POST['user_cpf']."';";
    $querySelCpf = mysqli_query($conn, $sqlSelCpf);

    // scape string
    $user_name = strtoupper(mysqli_real_escape_string($conn, $_POST["user_name"]));
    $user_birthday = mysqli_real_escape_string($conn, $_POST["user_birthday"]);
    $user_cpf = mysqli_real_escape_string($conn, $_POST["user_cpf"]);
    $user_email = strtolower(mysqli_real_escape_string($conn, $_POST["user_email"]));
    $user_password = mysqli_real_escape_string($conn, $_POST["user_password"]);

    $address_street = ucwords(mysqli_real_escape_string($conn, $_POST["address_street"]));
    $address_number = mysqli_real_escape_string($conn, $_POST["address_number"]);
    $address_city = ucwords(mysqli_real_escape_string($conn, $_POST["address_city"]));
    $address_state = strtoupper(mysqli_real_escape_string($conn, $_POST["address_state"]));
    $address_cep = mysqli_real_escape_string($conn, $_POST["address_cep"]);

    $address = $address_street . ", " . $address_number . ", " . $address_city .
               "-" . $address_state . ", " . $address_cep;

    
    // verifying if user email and cpf is already used
    $cpf_rows = mysqli_num_rows($querySelCpf);
    $email_rows = mysqli_num_rows($querySelEmail);

    if($cpf_rows + $email_rows == 0) {
        // create user
        $sqlInsertUser = "INSERT INTO tb_user(username, cpf, birthday, user_address, balance)
                          VALUES('$user_name', '$user_cpf', '$user_birthday', '$address', '0');";
        if(mysqli_query($conn, $sqlInsertUser)){
            echo("<p>Usuário: SUCCESS</p>");

            // get tb_user.pk_user_id
            $sqlUserId = "SELECT pk_user_id FROM tb_user WHERE cpf='".$user_cpf."';";
            $queryUserId = mysqli_query($conn, $sqlUserId);
            if($queryUserId){
                $fetch = mysqli_fetch_assoc($queryUserId);
                $fk_id = $fetch["pk_user_id"];

                // create credentials
                $sqlInsertCred = "INSERT INTO tb_credentials(email, password, fk_user_id)
                                  VALUES('".$user_email."', '".$user_password."', '".$fk_id."');";
                $queryInsertCred = mysqli_query($conn, $sqlInsertCred);

                if ($queryInsertCred) {
                    // echo("<p>Credenciais: SUCCESS</p>");
                    $_SESSION["ionize_sign_up_status"] = "Usuário cadastrado! Entre!";
                    $_SESSION["ionize_sign_up_email"] = $user_email;
                    header("location:../session.php");
                }else {
                    echo("<p>Credenciais: ERROR</p>");
                    echo(mysqli_error($conn));
                }
            } 
        } else {
            echo("<p>Usuário: ERROR</p>");
            echo(mysqli_error($conn));
        }
        } else {
            // user couldn't be created, cpf or email is already used
            if ($cpf_rows != 0) {
                $_SESSION["ionize_error_cpf"] = "CPF já em uso.";
            }
            if ($email_rows != 0) {
                $_SESSION["ionize_error_email"] = "Email já em uso.";
            }
            // retutn to sign-up page with previous values
            sign_up_error($user_name, $user_birthday, $user_cpf, $user_email, $user_password, $address_street, $address_number, $address_city, $address_state, $address_cep); 
        } 
?>