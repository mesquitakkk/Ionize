<!doctype html>
<html lang="pt-br">
<head>
    <title>Ionize - Perfil de usuário</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/box.css">
    <link rel="stylesheet" href="css/background-font.css">
    <link rel="stylesheet" href="css/nav.css">

    <!-- JS -->
    <script src="js/functions.js"></script>
</head>
<body>
<?php
    session_start();
    if (!isset($_SESSION["ionize_tb_credentials_email"]) and !isset($_SESSION["ionize_tb_credentials_password"])) {
        header('location:index.php');
    } 
    include_once('template/navbar-aut.php');
?>

<div class="box">
    <div class="container">
        <form class="box-form" action="back/try-update-user.php" method="POST">
            <div class="group-form">
                <label class="title">Informações Básicas</label>
            </div>
            <?php
                if(isset($_SESSION["ionize_update_status"])){
                    if($_SESSION["ionize_update_status"] == "error"){
                        echo "
                        <div class='alert alert-danger'>
                        Falha na alteração dos dados. Verifique os valores inseridos.
                        </div>";
                    } else {
                        echo "
                        <div class='alert alert-success'>
                        Dados alterados com sucesso.
                        </div>";
                    }
                }
                unset($_SESSION["ionize_update_status"]);
            ?>
            <div class="group-form">
                <label for="">Nome:</label>
                <input type="text" id="input-name" name="user_name" class="form-control" value="<?php echo($_SESSION["ionize_tb_user_username"]);?>" readonly required>
            </div><br>
            <div class="group-form">
                <label for="">E-mail:</label>
                <input type="email" name="user_email" class="form-control" value="<?php echo($_SESSION["ionize_tb_credentials_email"])?>" readonly required>
            </div><br>
            <div class="group-form">
                <label for="">CPF:</label>
                <input type="text" name="user_cpf" class="form-control" value="<?php echo($_SESSION["ionize_tb_user_cpf"])?>" onkeydown="javascript: fMasc( this, mCPF );" maxlength="14" readonly required>
            </div><br>
            <div class="group-form">
                <label for="">Data de Nascimento:</label>
                <input type="date" name="user_birthday" class="form-control" value="<?php echo($_SESSION["ionize_tb_user_birthday"])?>" readonly required><br>
            </div>
            <hr>
            <div class="group-form">
                <label for="">Senha Atual: *</label>
                <input type="password" name="actualPassword" required class="form-control"><br>
            </div>
            <?php
                if(isset($_SESSION["ionize_error_password"])) {
                    echo('
                    <div class="alert alert-danger">
                        '.$_SESSION['ionize_error_password'].'
                    </div>
                    ');
                    unset($_SESSION["ionize_error_password"]);
                }
            ?>
            <div class="group-form">
                <div class="center">
                    <input type="submit" value="Enviar" class="btn btn-dark">
                </div>
            </div>
        </form>
        <div class="center">
            <button class="btn btn-warning" onclick="edit()">Editar</button>
        </div>
    </div>
</div>



<!-- Optional JavaScript -->
<script>
    function edit() {
        let element = document.querySelectorAll(".form-control");
        element.forEach(function(currentValue, index){
            if(index != 0){
                currentValue.removeAttribute('readonly');
            }
        }) 
    }
</script>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

<!-- <-?php
    echo("<br>");
    print_r($_SESSION);
    echo("</br>");
    print_r($categories);
?> -->