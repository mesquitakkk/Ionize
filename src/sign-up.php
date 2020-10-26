<!doctype html>
<html lang="pt-br">
  <head>
    <title>Ionize - Cadastre-se</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/background-font.css">
    <link rel="stylesheet" href="css/box.css">

    <!-- js -->
    <script src="js/functions.js"></script>
  </head>
  <body>

    <?php
        include_once('template/navbar-travel.php');
        include_once('back/util-functions.php');
    ?>

    <div class="container" id="box">
        <form action="back/try-sign-up.php" method="POST" class="box-form">
            <div class="form-group">
                <div class="center">
                    <h2>Registre-se!</h2>
                </div>
            </div>
            <!-- <div class="form-group">
                <div class="center">
                    <--?php 
                        print_r($_SESSION);
                    ?>
                </div>
            </div> -->
            <div class="form-group">
                <div class="row">
                    <div class="col-12">
                        <input type="text" name="user_name" class="form-control" placeholder="Nome completo" required <?php verify_field("ionize_user_name"); ?>>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <input type="date" name="user_birthday" class="form-control" required <?php verify_field("ionize_user_birthday"); ?>>
                    </div>
                    <div class="col">
                        <input type="text" name="user_cpf" class="form-control" placeholder="CPF" required onkeydown="javascript: fMasc( this, mCPF );" maxlength="14" <?php verify_field("ionize_user_cpf"); ?>>
                        <?php 
                            verify_field_already("cpf");
                        ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <input type="email" name="user_email" class="form-control" placeholder="E-mail" required <?php verify_field("ionize_user_email"); ?>>
                        <?php
                            verify_field_already("email");
                        ?>
                    </div>
                    <div class="col">
                        <input type="password" name="user_password" class="form-control" placeholder="Senha" required <?php verify_field("ionize_user_password"); ?>>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label>Endereço:</label>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-9">
                        <input type="text" name="address_street" class="form-control" placeholder="Rua" required <?php verify_field("ionize_address_street"); ?>>
                    </div>
                    <div class="col-3">
                        <input type="number" name="address_number" min=0 class="form-control" placeholder="Rua" required <?php verify_field("ionize_address_number"); ?>>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-5">
                        <input type="text" name="address_city" class="form-control" placeholder="Cidade" <?php verify_field("ionize_address_city"); ?>>
                    </div>
                    <div class="col-3">
                        <input type="text" name="address_state" class="form-control" placeholder="Estado" <?php verify_field("ionize_address_state"); ?>>
                    </div>
                    <div class="col-4">
                        <input type="text" name="address_cep" class="form-control" placeholder="CEP" onkeydown="javascript: fMasc( this, mCEP );" maxlength="9" <?php verify_field("ionize_address_cep"); session_unset(); ?>>
                    </div>
                </div>
            </div><br>

            <!-- submit button -->
            <div class="center">
                <div class="form-group">
                    <input type="submit" value="Cadastrar" class="btn btn-dark">
                </div>
            </div>
        </form>
        <div class="center">
            <a href="session.php"><button class="btn btn-dark">Voltar</button></a>
        </div>
</div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>