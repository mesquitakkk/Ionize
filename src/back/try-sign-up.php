<?php
    print_r($_POST);

    include_once('conn.php');

    // verifying if email exists (in db)

    $sqlSelEmail = "SELECT email FROM tb_credentials WHERE email='".$_POST["useremail"]."';";
    $querySelEmail = mysqli_query($conn, $sqlSelEmail);

    // $sqlSelEmail = "SELECT cpf;";

    $sqlSelCpf = "SELECT cpf FROM tb_user WHERE cpf='".$_POST['usercpf']."';";
    $querySelCpf = mysqli_query($conn, $sqlSelCpf);

    // scape string
    $user_name = strtoupper(mysqli_real_escape_string($conn, $_POST["username"]));
    $user_birthday = mysqli_real_escape_string($conn, $_POST["userbirthday"]);
    $user_cpf = mysqli_real_escape_string($conn, $_POST["usercpf"]);
    $user_email = strtolower(mysqli_real_escape_string($conn, $_POST["useremail"]));
    $user_password = mysqli_real_escape_string($conn, $_POST["userpassword"]);

    $address_street = ucwords(mysqli_real_escape_string($conn, $_POST["address_street"]));
    $address_number = mysqli_real_escape_string($conn, $_POST["address_number"]);
    $address_city = ucwords(mysqli_real_escape_string($conn, $_POST["address_city"]));
    $address_state = strtoupper(mysqli_real_escape_string($conn, $_POST["address_state"]));
    $address_cep = mysqli_real_escape_string($conn, $_POST["address_cep"]);

    $address = $address_street . ", " . $address_number . ", " . $address_city .
               "-" . $address_state . ", " . $address_cep;

    
    // verifying if user email and cpf is already used
    if (mysqli_num_rows($querySelCpf) == 0 and mysqli_num_rows($querySelEmail) == 0) {
        echo("posso cadastrar");
    } else {
        echo("usuario já existe");
    }
?>